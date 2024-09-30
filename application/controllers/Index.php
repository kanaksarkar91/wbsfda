<?php 

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . "third_party/paytm/PaytmChecksum.php";

class Index extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('otp', 'sms', 'email', 'crypto'));
		$this->load->model(array('mcommon', 'frontend/mbooking', 'frontend/query', 'admin/mreport', 'admin/mpos'));
	}

	public function index()
	{
		$data = array();
		$data['districts'] = $this->mbooking->get_property_districts(array('is_active' => 1, 'district_id <>' => 21));
		$data['terrains'] = $this->mbooking->get_property_terrains(array('is_active' => 1));
		$data['landscape_properties'] = $this->mbooking->get_landscape_properties(array('terrain_master.is_active' => 1, 'property_master.is_active' => 1, 'property_master.is_venue' => '1'));
		$data['property_types'] = $this->mbooking->get_property_types(array('is_active' => 1));
		$data['content'] = 'frontend/home';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function sendResetPasswordOtp()
	{
		$contact_no = $this->input->post('contact_no');
		if($contact_no != ''){
			$is_already_exist = $this->mcommon->getRow('master_admin', array('contact_no' => $contact_no));
			//echo '<pre>'; print_r($is_already_exist); die;
			if(empty($is_already_exist)){
				$return_data = array('status'=>false,'msg'=>'Phone no. does not register!');
			}
			else {
				
				$sms_data = generateotp($contact_no, 'login');
				$otp = $sms_data['otp'];
				$data = array(
					'mobile' => $contact_no,
					'otp' => $otp, 
					'created_at' => date('Y-m-d H:i:s'),
					'expires_at' => date('Y-m-d H:i:s', strtotime('+15 mins')),
					'attempt_count' => 0
				);
				
				$exit_in_customer_otp = $this->mcommon->getRow('customers_otp', array('mobile' => $contact_no));
				
				if(empty($exit_in_customer_otp)){
					$result = $this->mcommon->insert('customers_otp', $data);
				}
				else{
					$result = $this->mcommon->update('customers_otp', array('mobile' => $contact_no), $data);
				}
				
				if($result){
					$redirect_link = base_url()."index/resetPasswordLink/".encode_url($contact_no);
					
					$this->session->set_flashdata('success_msg', 'Rassword Reset OTP Send Successfully. Please enter OTP & New Password.');
					$return_data = array('status'=>true,'msg'=>'Rassword Reset OTP Send Successfully.','redirect_link' => $redirect_link); 
				}
	
			}
		
		}
		else{
			$return_data = array('status'=>false,'msg'=>'Please enter Phone no.!');
		}
		
		echo json_encode($return_data);
	}
	public function resetPasswordLink()
	{
		$this->load->view('admin/reset_password', $data);
	}
	public function submitNewPassword()
	{
		$this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]|max_length[25]|callback_check_strong_password');
		
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error_msg', validation_errors());
			redirect('index/resetPasswordLink/'.$this->input->post('contact_no'));
		}
		else{
			$contact_no = decode_url($this->input->post('contact_no'));
			$getUser = $this->mcommon->getRow('master_admin', array('contact_no' => $contact_no));
			
			$otp = $this->input->post('otp');
			$new_password = $this->input->post('new_password');
			$confirm_password = $this->input->post('confirm_password');
			
			$customers_otp = $this->mcommon->getRow('customers_otp',array('mobile'=>$contact_no));
			
			if($customers_otp['otp'] != $otp){
				$this->session->set_flashdata('error_msg','Invalid OTP.');
				redirect('index/resetPasswordLink/'.$this->input->post('contact_no'));
			}
			else {
				if(strtotime($customers_otp['expires_at']) <= strtotime(date('Y-m-d H:i:s'))){
					$this->session->set_flashdata('error_msg','OTP expires.');
					redirect('index/resetPasswordLink/'.$this->input->post('contact_no'));
				}
				else{
					if(!empty($getUser) && $new_password != '' && $confirm_password != ''){
						if($new_password == $confirm_password){
							$result = $this->mcommon->update('master_admin', array('user_id' => $getUser['user_id']), array('password' => password_hash($new_password, PASSWORD_BCRYPT, array('cost' => 12))));
							
							if($result){
								
								$data = array(
									'log_datetime' => date('Y-m-d H:i:s'),
									'process_name' => 'Password Change',
									'log_desc' => 'User-'.$getUser['user_id'].' has been change his password.'
								);
								
								$this->mcommon->insert('activity_log', $data);
								
								$this->session->set_flashdata('success_msg','Password changed successfully. Please Login');
								redirect('index/resetPasswordLink/'.$this->input->post('contact_no'));
							}
						}
						else{
							$this->session->set_flashdata('error_msg','Your password & confirm password does not matched.');
							redirect('index/resetPasswordLink/'.$this->input->post('contact_no'));
						}
						
					}
					else {
						$this->session->set_flashdata('error_msg','Please Fill Up Proper Data.');
						redirect('index/resetPasswordLink/'.$this->input->post('contact_no'));
					}
				}
			}
		}
	}
	public function getOTP()
	{
		$mobile = $this->input->post('mobile');
		$type = $this->input->post('type');

		$is_already_exist = $this->mcommon->getRow('customer_master', array('mobile' => $mobile));
		if($type == 'login' && empty($is_already_exist)){
			$return_data = array('status'=>false,'msg'=>'Mobile number does not exist! Please signup...');
		} elseif($type == 'register' && !empty($is_already_exist)){
			$return_data = array('status'=>false,'msg'=>'Mobile number already exist! Please login...');
		} else {
			$customers_otp = $this->mcommon->getRow('customers_otp',array('mobile'=>$mobile));
			if($customers_otp['attempt_count'] >= 3){
				$curTime = date('Y-m-d H:i:s');
				$nextAttemptTime = date("d-m-Y H:i:s", strtotime($customers_otp['created_at'].' +1 hour'));
				if(strtotime($curTime) > strtotime($nextAttemptTime)){
					$sms_data = generateotp($mobile, $type);
					$otp = $sms_data['otp'];
					$data = array(
						'mobile' => $mobile,
						'otp' => $otp, 
						'created_at' => date('Y-m-d H:i:s'),
						'expires_at' => date('Y-m-d H:i:s', strtotime('+15 mins')),
						'attempt_count' => 0
					);
					//$this->mcommon->delete('customers_otp', array('mobile' => $mobile));
					if(empty($customers_otp)){
						$this->mcommon->insert('customers_otp', $data);
					}
					else {
						$this->mcommon->update('customers_otp', array('mobile' => $mobile), $data);
					}
					$return_data = array('status'=>true,'msg'=>'Otp generated');
				}
				else {
					$return_data = array('status'=>false,'msg'=>'Your mobile no has been blocked for 1 hour!!');
				}
			}
			else {
				$sms_data = generateotp($mobile, $type);
				$otp = $sms_data['otp'];
				$data = array(
					'mobile' => $mobile,
					'otp' => $otp, 
					'created_at' => date('Y-m-d H:i:s'),
					'expires_at' => date('Y-m-d H:i:s', strtotime('+15 mins'))
				);
				//$this->mcommon->delete('customers_otp', array('mobile' => $mobile));
				if(empty($customers_otp)){
					$this->mcommon->insert('customers_otp', $data);
				}
				else {
					$this->mcommon->update('customers_otp', array('mobile' => $mobile), $data);
				}
				$return_data = array('status'=>true,'msg'=>'Otp generated');
			}

		}
		//$query = $this->mcommon->getRow('customers_otp',array('mobile'=>$mobile));
		
		echo json_encode($return_data);
	}
	public function signup()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('mobile','Mobile','trim|required|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('first_name','Full Name','trim|required');
			//$this->form_validation->set_rules('last_name','Last Name','trim|required');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			
			if($this->form_validation->run()==FALSE){
				echo json_encode(array('error' => 1, 'msg' => validation_errors()));
			}
			else{
				
				$mobile = $this->input->post('mobile');
				$first_name = $this->input->post('first_name');
				//$last_name = $this->input->post('last_name');
				$email = $this->input->post('email');
				
				$splitName = explode(' ', $first_name);
		
				$is_already_exist = $this->mcommon->getRow('customer_master', array('mobile' => $mobile));
				if (empty($is_already_exist)) {
		
					$customers_otp = $this->mcommon->getRow('customers_otp', array('mobile' => $mobile));
					if ($customers_otp) {
						if (strtotime($customers_otp['expires_at']) <= strtotime(date('Y-m-d H:i:s'))) {
							echo json_encode(array('error' => 1, 'msg' => 'OTP expires'));
						} 
						else if($customers_otp['attempt_count'] >= 3){
							echo json_encode(array('error'=>1,'msg'=>'Your mobile no has been blocked for 1 hour!!'));
						}
						else {
		
							if ($customers_otp['otp'] == $this->input->post('otp')) {
		
								$data = array(
									'mobile_country_code' => '+91',
									'mobile' => $mobile,
									'first_name' => $first_name,
									//'last_name' => $splitName[1],
									'email' => $email,
									'customer_type' => 'I',
									'created_ts' => date('Y-m-d H:i:s'),
									'signup_date' => date('Y-m-d')
		
								);
								$this->mcommon->insert('customer_master', $data);
								$customer_id = $this->db->insert_id();
		
								if ($customer_id > 0) {
		
									$user_data = $this->mcommon->getRow('customer_master', array('customer_id' => $customer_id));
									$session_data = $user_data;
									$session_data['user_type'] = 'frontend';
									$session_data['logged_in'] = TRUE;
									$this->session->set_userdata($session_data);
									//signup($mobile);
									echo json_encode(array('error' => 0, 'msg' => 'Signup successful'));
								} else {
		
									echo json_encode(array('error' => 1, 'msg' => 'Oops!Somwthing went wrong...'));
								}
							} else {
								$data = array(
									'attempt_count' => ($customers_otp['attempt_count'] + 1)
								);
								$this->mcommon->update('customers_otp', array('mobile' => $mobile), $data);
								
								echo json_encode(array('error' => 1, 'msg' => 'OTP mismatch'));
							}
						}
					} else {
						echo json_encode(array('error' => 1, 'msg' => 'OTP not exists'));
					}
				} else {
					echo json_encode(array('error' => 1, 'msg' => 'Mobile number already exist'));
				}
				
			}
		}
		
		
	}

	public function login() {
		if($this->input->post()){
			$this->form_validation->set_rules('login_mobile','Mobile','trim|numeric|min_length[10]|max_length[10]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				echo json_encode(array('error'=> 1, 'msg'=> validation_errors()));
				exit;
			}
			else {
				$first_time = 0;
				$mobile = $this->input->post('login_mobile');
		
				$check_login = $this->mcommon->getRow('customer_master', array('mobile' => $mobile));
				if (!empty($check_login)) {
		
					$customers_otp = $this->mcommon->getRow('customers_otp',array('mobile'=>$mobile));
				if($customers_otp) {
					if(strtotime($customers_otp['expires_at']) <= strtotime(date('Y-m-d H:i:s'))){
						echo json_encode(array('error'=>1,'msg'=>'OTP expires'));
					}
					else if($customers_otp['attempt_count'] >= 3){
						echo json_encode(array('error'=>1,'msg'=>'Your mobile no has been blocked for 1 hour!!'));
					}
					else{
						if($customers_otp['otp'] == $this->input->post('login_otp')){
							
							
							$session_data = $check_login;
							$session_data['user_type'] = 'frontend';
							$session_data['logged_in'] = TRUE;
							$this->session->set_userdata($session_data);
							echo json_encode(array('error' => 0, 'msg' => 'Logged In successful'));
							
							// if($first_time) {
							// 	echo json_encode(array('error'=>0,'first_time'=>1));
							// }else{
							// 	echo json_encode(array('error'=>0,'first_time'=>0));
							// }
						}else{
							$data = array(
								'attempt_count' => ($customers_otp['attempt_count'] + 1)
							);
							$this->mcommon->update('customers_otp', array('mobile' => $mobile), $data);
							
							echo json_encode(array('error'=>1,'msg'=>'OTP mismatch'));
						}
					}
				}else{
					echo json_encode(array('error'=>1,'msg'=>'OTP not exists'));
				}
		
				} else{
					echo json_encode(array('error'=>1,'msg'=>'Mobile number not exists'));
				}
			}
		}
	}
	
	public function notify_me()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('mobile','Mobile','trim|required|numeric|max_length[10]');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			
			if($this->form_validation->run()==FALSE){
				echo json_encode(array('error' => 1, 'msg' => validation_errors()));
			}
			else{
				
				$mobile = $this->input->post('mobile');
				$email = $this->input->post('email');
				$property_id = $this->input->post('notify_property_id');
				$_from_date = $this->input->post('notify_from_date');
				$_to_date = $this->input->post('notify_to_date');
				
				$form_date_arr = explode('/', $_from_date);
				$from_date = date('Y-m-d', strtotime($form_date_arr[2] . '-' . $form_date_arr[1] . '-' . $form_date_arr[0]));
				
				$to_date_arr = explode('/', $_to_date);
				$to_date = date('Y-m-d', strtotime($to_date_arr[2] . '-' . $to_date_arr[1] . '-' . $to_date_arr[0]));
				
				$data = array(
					'mobile' => $mobile,
					'email' => $email,
					'property_id' => $property_id,
					'from_date' => $from_date,
					'to_date' => $to_date,
					'created_ts' => date('Y-m-d H:i:s')

				);
				
				$insertData = $this->mcommon->insert('notify_request', $data);
				
				if($insertData){
					echo json_encode(array('error' => 0, 'msg' => 'Successful Submitted'));
				}
				else{
					echo json_encode(array('error' => 1, 'msg' => 'Something went wrong. Please try again.'));
				}
				
			}
		}
		
		
	}

	public function searchProperties()
	{
		$data['content'] = 'frontend/searchList';
		$this->load->view('frontend/layouts/index', $data);
	}

	public function propertyDetails()
	{
		$data['content'] = 'frontend/propertyDetails';
		$this->load->view('frontend/layouts/index', $data);
	}

	
	public function bookingPaymentVerify(){
		//$payments = $this->mbooking->get_booking_payment(array("status in ('PENDING','NOT-FOUND')" => NULL, 'booking_header.booking_status' => 'I'));
		$payments = $this->mbooking->get_booking_payment(array("status IN ('PENDING','NOT-FOUND','FAILURE', 'Failure', 'FAILED','AWAITED','INITIATED','UNSUCCESSFUL','Aborted', 'TIMEOUT') OR status IS NULL" => NULL, "booking_header.booking_status IN ('I','F')" => NULL));
		
		//echo $this->db->last_query(); die;
		
		//$payments = $this->mbooking->get_booking_payment(array('booking_header.txnid' => '03fae1938e1dbb0a4129'));
		
		$cron_status = "Cron job started.";
		
		if ($payments->num_rows() > 0) {
			foreach ($payments->result() as $payment) {
					if(!is_null($payment)){
						$working_key = $payment->WORKING_KEY;
						$access_code = $payment->ACCESS_CODE;
						$command = "verify_payment";
						
						if ($payment->order_id) {
							$var1 = $payment->order_id;
							$cron_det = $this->mbooking->update_booking_payment_info(array('cronjob_start_time' => date('Y-m-d H:i:s')), array('order_id' => $var1));
							
							
							$merchant_json_data =
							array(
								'order_no' => $var1
							);
							
							$merchant_data = json_encode($merchant_json_data);
							$encrypted_data = encrypt($merchant_data, $working_key);
							$final_data = 'enc_request='.$encrypted_data.'&access_code='.$access_code.'&command=orderStatusTracker&request_type=JSON&response_type=JSON';
							
							//echo $final_data; die;
							
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, $payment->API_BASE_URL);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_VERBOSE, 1);
							curl_setopt($ch, CURLOPT_HTTPHEADER,'Content-Type: application/json') ;
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
							curl_setopt($ch, CURLOPT_POST, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);
							// Get server response ...
							$result = curl_exec($ch);
							$info = curl_getinfo($ch);
							curl_close($ch);
							$status = '';
							$information = explode('&', $result);
							
							$dataSize = sizeof($information);
							for ($i = 0; $i < $dataSize; $i++) {
								$info_value = explode('=', $information[$i]);
								if ($info_value[0] == 'enc_response') {
									$status = decrypt(trim($info_value[1]), $working_key);
									
								}
							}
							
							//echo 'Status revert is: ' . $status.'<pre>';
							$obj = json_decode($status,true);
							//echo '<pre>'; print_r($info); die;
							//echo '<pre>'; print_r($obj); die;
							//echo $obj['Order_Status_Result']['order_status']; die;
							
							//echo $obj->Order_Status_Result->order_no; die;
									
							//echo '<pre>'; print_r($status); die;
							
							$orderStatus = '';
							$errorMsg = '';
							
							if (!empty($obj)) {
								
								try{
								
									$orderStatus = $obj['Order_Status_Result']['order_status'];
								
									$payment_data = array(
										'payment_date' => $obj['Order_Status_Result']['order_status_date_time'],
										'transaction_ref_id' => $obj['Order_Status_Result']['reference_no'],
										'bank_ref_num' => $obj['Order_Status_Result']['order_bank_ref_no'],
										'amount' => $obj['Order_Status_Result']['order_amt'],
										'payment_mode' => $transaction_details['mode'],
										'remarks' => 'Payment Settled',
										'status' => ($orderStatus == 'Shipped') ? 'Success' : strtoupper($orderStatus)
									);
									
									$payment_data['cronjob_data'] = $status;
									$payment_data['cronjob_status'] = 'COMPLETED';
									$payment_data['cronjob_end_time'] = date('Y-m-d H:i:s');
									
									$this->db->trans_start(); # Starting Transaction
									
									if($var1 != ''){
										$cron_det = $this->mbooking->update_booking_payment_info($payment_data, array('order_id' => $var1));
									}
									
									if ($orderStatus == 'Shipped' || $orderStatus == 'SUCCESSFUL'){
										$booking_success_det = $this->mbooking->update_booking_header(array('booking_header.booking_status' => 'A', 'updated_ts' => date('Y-m-d H:i:s')), array('booking_header.booking_id' => $payment->booking_id));
										if($booking_success_det){
											$cron_status = "Update Successful for ORDER ID: " . $var1;
										}
										else{
											$cron_status =  $this->db->error()['message'] ."Booking table update failed for ORDER ID: " . $var1;
										}
									}
									
									$this->db->trans_complete(); # Completing transaction
									
									
									if (((strtotime(date('Y-m-d H:i:s')) - strtotime($payment->created_ts)) > 1020) && ($orderStatus != 'Shipped' || $orderStatus != 'SUCCESSFUL')) {
										$booking_failed_det = $this->mbooking->update_booking_to_failed($payment->booking_id);
										if($booking_failed_det){
											$this->mbooking->update_booking_payment_to_failed($var1);
										}
									
										$cron_status = "Record successfull moved to failed table ORDER ID: " . $var1;
									} else {
										$cron_status = "No data found in verify receipt for ORDER ID: " . $var1;
									}
									
								} catch (Exception $e) {
									$this->db->trans_rollback();
									$errorMsg = $e->getMessage();
									$cron_status = $errorMsg.' for ORDER ID: '.$var1;
								}
							
						} else {
							$cron_status = "No Payment ORDER ID found";
						}
					} else {
						$cron_status = "No pending payment details found";
					}
					
					$add_data = $this->mbooking->add_cron_job_activity_log(array('log_datetime' => date('Y-m-d H:i:s'), 'process_name' => 'booking-payment-verify-cron', 'log_desc' => $cron_status));
					//echo $cron_status . "<br>";
				}
			}
		} else {
			$cron_status .= " No Pending transactions found.";
			$add_data = $this->mbooking->add_cron_job_activity_log(array('log_datetime' => date('Y-m-d H:i:s'), 'process_name' => 'booking-payment-verify-cron', 'log_desc' => $cron_status));
			//echo $cron_status . "<br>";
		}
    }


	
	public function api_to_send_pos_bridge_notification_on_paytm_device($param1)
	{
		$paramList = array();
		$det_arr = unserialize($this->encryption->decrypt(base64_decode($param1)));
		
		if($det_arr['receive_from'] === 'pos'){
			$invData = $this->mpos->get_receivable_invoice_details($det_arr['sale_order_id']);
		}
		else if($det_arr['receive_from'] === 'property') {
			$bookingData = $this->mcommon->getRow('bank_edc_terminal_master', array('property_id' => $det_arr['property_id']));
		}
		
		$paytmMid = (!empty($invData)) ? $invData['PAYTM_MID'] : $bookingData['PAYTM_MID'];
		$merchant_key = (!empty($invData)) ? $invData['PAYTM_MERCHANT_KEY'] : $bookingData['PAYTM_MERCHANT_KEY'];
		$channelId = STAGING_PAYTM_CHANNEL_ID;
		
		//echo $paytmMid.'<br>'.$merchant_key.'<br>'.$channelId; die;
		
		$payable_amount = (!empty($invData)) ? (round($invData['net_bill_amount']) * 100) : (round($det_arr['amount']) * 100);
		$merchantTransactionId = substr(hash('sha256', rand_string(6) . microtime()), 0, 20);
		$transactionDateTime = date('Y-m-d H:i:s');
		
		$headers = array(
		   "Content-Type: application/json",
		);
		
		$paramList["paytmMid"] = $paytmMid;// 
		$paramList["paytmTid"] = (!empty($invData)) ? $invData['edc_terminal_id'] : $bookingData['edc_terminal_id'];//
		$paramList["transactionDateTime"] = $transactionDateTime;//date("Y-m-d h:i:s")
		$paramList["merchantTransactionId"] = $merchantTransactionId;
		$paramList["transactionAmount"] = $payable_amount;
		//$paramList["merchantReferenceNo"] = 'Test-Transaction';
		
		$checksum = PaytmChecksum::generateSignature($paramList, $merchant_key);
		
		$paytmParams["body"] = $paramList;
		
		$paytmParams["head"] = array(
			"version" => "3.1",
			"requestTimeStamp"    => date('Y-m-d H:i:s'),
			"channelId" => $channelId,
			"checksum" => $checksum
		);
		
		$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
		
		$url = STAGING_PAYTM_SALE_API_URL;

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
										
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		
		$response = curl_exec($curl);
		curl_close($curl);
		
		$responseData = json_decode($response, true);
		
		//echo "<pre>"; print_r($paytmParams);
		//echo "<pre>"; print_r($responseData);
		//echo $responseData['body']['resultInfo']['resultStatus']; die;
		
		if($responseData['body']['resultInfo']['resultStatus'] === "ACCEPTED_SUCCESS"){
		
			if($det_arr['receive_from'] === 'pos'){
				
				$payment_data = array(
					'sale_order_id' => $det_arr['sale_order_id'],
					'payment_date' => date('Y-m-d H:i:s'),
					'order_id' => $merchantTransactionId,
					'device_id' => $invData['edc_terminal_id'],
					'transaction_ref_id' => NULL,
					'bank_ref_num' => NULL,
					'amount' => round($invData['net_bill_amount']),
					'payment_mode' => '',
					'remarks' => $det_arr['remarks'],
					'status' => 'PENDING',
					'created_by' => ($this->admin_session_data['user_id'] != '') ? $this->admin_session_data['user_id'] : 0,
					'created_ts' => date('Y-m-d H:i:s'),
				);
				
			}
			else if($det_arr['receive_from'] === 'property') {
				
				$payment_data = array(
					'booking_id' => $det_arr['booking_id'],
					'customer_id' => $det_arr['customer_id'],
					'payment_date' => date('Y-m-d H:i:s'),
					'order_id' => $merchantTransactionId,
					'device_id' => $bookingData['edc_terminal_id'],
					'transaction_ref_id' => NULL,
					'bank_ref_num' => NULL,
					'amount' => round($det_arr['amount']),
					'payment_mode' => '',
					'remarks' => $det_arr['remarks'],
					'status' => 'PENDING',
					'created_by' => ($this->admin_session_data['user_id'] != '') ? $this->admin_session_data['user_id'] : 0,
					'created_ts' => date('Y-m-d H:i:s'),
				);
				
			}
			
			$payment_id = $this->mcommon->insert('booking_payment', $payment_data);
			
			if($payment_id){
				
				$return['success']='Record Update successfully';
				$return['amount']=$payable_amount;
				$return['merchantTransactionId']=$responseData['body']['merchantTransactionId'];
				$return['device_id']=(!empty($invData)) ? $invData['edc_terminal_id'] : $bookingData['edc_terminal_id'];
				$return['transactionDateTime']=$transactionDateTime;
				$return['receive_from']=$det_arr['receive_from'];
				
			}
			else {
				$return['success']='Something Went Wrong!! Please Try Again.';
			}
		}
		
		header('Content-Type: application/json');
        echo json_encode($return);
	}
	
	public function api_to_get_status_of_pos_bridge_notification_sent_on_paytm_device()
	{
		$paramList = array();
		
		$merchantTransactionId =  $this->input->post('merchantTransactionId');
		$amount = $this->input->post('amount');
		$device_id = $this->input->post('device_id');
		$transactionDateTime = $this->input->post('transactionDateTime');
		$receive_from = $this->input->post('receive_from');
		
		$bank_edc_data = $this->mcommon->getRow('bank_edc_terminal_master', array('edc_terminal_id' => $device_id));
		
		$paytmMid = $bank_edc_data['PAYTM_MID'];
		$merchant_key = $bank_edc_data['PAYTM_MERCHANT_KEY'];
		$channelId = STAGING_PAYTM_CHANNEL_ID;
		
		//echo $merchantTransactionId.'<br>'.$amount.'<br>'.$device_id.'<br>'.$transactionDateTime.'<br>'.$paytmMid; die;
		
		$cron_status = "Status Cron job started.";
		
		if($merchantTransactionId != '' && $amount != ''){
			
			$headers = array(
			   "Content-Type: application/json",
			);
			
			$paramList["paytmMid"] = $paytmMid;// 
			$paramList["paytmTid"] = $device_id;//
			$paramList["transactionDateTime"] = $transactionDateTime;//date("Y-m-d h:i:s")
			$paramList["merchantTransactionId"] = $merchantTransactionId;
			//$paramList["transactionAmount"] = $amount;
			
			$checksum = PaytmChecksum::generateSignature($paramList, $merchant_key);
			
			$paytmParams["body"] = $paramList;
			
			$paytmParams["head"] = array(
				"version" => "3.1",
				"requestTimeStamp"    => date('Y-m-d H:i:s'),
				"channelId" => $channelId,
				"checksum" => $checksum
			);
			
			$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
			
			$url = STAGING_PAYTM_STATUS_API_URL;
	
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
											
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			
			$response = curl_exec($curl);
			curl_close($curl);
			
			$responseData = json_decode($response, true);
			
			//echo "<pre>"; print_r($responseData); die;
			//echo $responseData['body']['resultInfo']['resultStatus']; die;
			
			$booking_payment_detail = $this->mcommon->getRow('booking_payment', array('order_id' => $responseData['body']['merchantTransactionId']));
			if($receive_from === 'pos'){
				$pos_sale_header_data = $this->mcommon->getRow('pos_sale_header', array('sale_order_id' => $booking_payment_detail['sale_order_id']));
			}
			
			//print_r($booking_payment_detail);
			//print_r($pos_sale_header_data); die;
			
			if(!empty($responseData)){
				if($responseData['body']['merchantTransactionId'] != ''){
					if($responseData['body']['resultInfo']['resultStatus']){
						
						if(($amount == $responseData['body']['transactionAmount']) && ($merchantTransactionId == $responseData['body']['merchantTransactionId'])){
							
							$cron_det = $this->mcommon->update('booking_payment', array('order_id' => $responseData['body']['merchantTransactionId']), array('cronjob_start_time' => date('Y-m-d H:i:s')));
							$orderStatus = $responseData['body']['resultInfo']['resultStatus'];
							//$date = str_replace('/', '-', $responseData['readableChargeSlipDate']);
							$transaction_date =  $responseData['body']['transactionDateTime'];
							$payment_data = array(
								'payment_date' => $transaction_date,
								'transaction_ref_id' => $responseData['body']['acquirementId'],
								//'bank_upi_ref_num' => $obj['Order_Status_Result']['order_bank_ref_no'],
								//'amount' => $booking_payment_detail['amount'],
								'payment_mode' => $responseData['body']['payMethod'],
								'response_txt' => $response,
								//'remarks' => $responseData['body']['resultInfo']['resultMsg'],
								'status' => $orderStatus
							);
							
							$payment_data['cronjob_data'] = $response;
							$payment_data['cronjob_status'] = 'COMPLETED';
							$payment_data['cronjob_end_time'] = date('Y-m-d H:i:s');
							
							if($responseData['body']['merchantTransactionId'] != ''){
								$cron_det = $this->mcommon->update('booking_payment', array('order_id' => $responseData['body']['merchantTransactionId']), $payment_data);
							}
							
							if ($responseData['body']['resultInfo']['resultStatus'] === 'SUCCESS') {
								
								$this->session->set_flashdata('success_msg', 'Payment accepted successfully');
								$return['success']='Payment accepted successfully';
								$return['property_id']=encode_url($pos_sale_header_data['property_id']);
								$return['cost_center_id']=encode_url($pos_sale_header_data['cost_center_id']);
								$return['pid']=$pos_sale_header_data['property_id'];
								$return['redirect_link'] = ($receive_from == 'pos') ? base_url()."admin/pos/pos_invoice_list/".encode_url($pos_sale_header_data['property_id'])."/".encode_url($pos_sale_header_data['cost_center_id']) : base_url()."admin/booking/booking_details/".$booking_payment_detail['booking_id'];
								header('Content-Type: application/json');
								echo json_encode($return);
							}
							if ($responseData['body']['resultInfo']['resultStatus'] === 'FAIL') {
								
								if($responseData['body']['merchantTransactionId'] != ''){
									$this->mbooking->update_booking_payment_to_failed($responseData['body']['merchantTransactionId']);
								}
								
								$this->session->set_flashdata('error_msg', 'Payment Failed!!');
								$return['error']='Payment Failed!!';
								$return['property_id']=encode_url($pos_sale_header_data['property_id']);
								$return['cost_center_id']=encode_url($pos_sale_header_data['cost_center_id']);
								$return['redirect_link'] = ($receive_from == 'pos') ? base_url()."admin/pos/receive_against_pos/".encode_url($pos_sale_header_data['sale_order_id']) : base_url()."admin/booking/booking_details/".$booking_payment_detail['booking_id'];
								header('Content-Type: application/json');
								echo json_encode($return);
								
							}
							if (((strtotime(date('Y-m-d H:i:s')) - strtotime($booking_payment_detail['created_ts'])) > PAYTM_PAYMENT_RESPONSE_WAITING_TIME) && ($responseData['body']['resultInfo']['resultStatus'] != 'SUCCESS')) {
								
								if($responseData['body']['merchantTransactionId'] != ''){
									$this->mbooking->update_booking_payment_to_failed($responseData['body']['merchantTransactionId']);
								}
								
								$this->session->set_flashdata('error_msg', 'Payment Failed!!');
								$return['error']='Payment Failed!!';
								$return['property_id']=encode_url($pos_sale_header_data['property_id']);
								$return['cost_center_id']=encode_url($pos_sale_header_data['cost_center_id']);
								$return['redirect_link'] = ($receive_from == 'pos') ? base_url()."admin/pos/receive_against_pos/".encode_url($pos_sale_header_data['sale_order_id']) : base_url()."admin/booking/booking_details/".$booking_payment_detail['booking_id'];
								header('Content-Type: application/json');
								echo json_encode($return);
							}
							$cron_status = "Update Successful for Order ID: " . $responseData['body']['merchantTransactionId'];
						}
						else{
							
							if($responseData['body']['resultInfo']['resultStatus'] === 'FAIL') {
								
								if($responseData['body']['merchantTransactionId'] != ''){
									$this->mbooking->update_booking_payment_to_failed($responseData['body']['merchantTransactionId']);
								}
								
								$this->session->set_flashdata('error_msg', 'Payment Declined!!');
								$return['error']='Payment Declined!!';
								$return['property_id']=encode_url($pos_sale_header_data['property_id']);
								$return['cost_center_id']=encode_url($pos_sale_header_data['cost_center_id']);
								$return['redirect_link'] = ($receive_from == 'pos') ? base_url()."admin/pos/receive_against_pos/".encode_url($pos_sale_header_data['sale_order_id']) : base_url()."admin/booking/booking_details/".$booking_payment_detail['booking_id'];
								header('Content-Type: application/json');
								echo json_encode($return);
							}
							
						}
					}
					else {
						
						if($responseData['body']['resultInfo']['resultStatus'] === 'PENDING') {
							
							if (strtotime(date('Y-m-d H:i:s')) - strtotime($booking_payment_detail['created_ts']) > PAYTM_PAYMENT_RESPONSE_WAITING_TIME) {
								
								if($responseData['body']['merchantTransactionId'] != ''){
									$this->mbooking->update_booking_payment_to_failed($responseData['body']['merchantTransactionId']);
								}
								
								$this->session->set_flashdata('error_msg', 'Payment Failed!!');
								$return['error']='Payment Failed!!';
								$return['property_id']=encode_url($pos_sale_header_data['property_id']);
								$return['cost_center_id']=encode_url($pos_sale_header_data['cost_center_id']);
								$return['redirect_link'] = ($receive_from == 'pos') ? base_url()."admin/pos/receive_against_pos/".encode_url($pos_sale_header_data['sale_order_id']) : base_url()."admin/booking/booking_details/".$booking_payment_detail['booking_id'];
								header('Content-Type: application/json');
								echo json_encode($return);
							}
						}
						else {
							
							if($responseData['body']['merchantTransactionId'] != ''){
								$this->mbooking->update_booking_payment_to_failed($responseData['body']['merchantTransactionId']);
							}
							
							$this->session->set_flashdata('error_msg', 'Payment Failed!!');
							$return['error']='Payment Failed!!';
							$return['property_id']=encode_url($pos_sale_header_data['property_id']);
							$return['cost_center_id']=encode_url($pos_sale_header_data['cost_center_id']);
							$return['redirect_link'] = ($receive_from == 'pos') ? base_url()."admin/pos/receive_against_pos/".encode_url($pos_sale_header_data['sale_order_id']) : base_url()."admin/booking/booking_details/".$booking_payment_detail['booking_id'];
							header('Content-Type: application/json');
							echo json_encode($return);
						}
						
					}
				}
			}
			else {
				
				if($responseData['body']['merchantTransactionId'] != ''){
					$this->mbooking->update_booking_payment_to_failed($responseData['body']['merchantTransactionId']);
				}
				
				$this->session->set_flashdata('error_msg', 'Payment Failed!!');
				$return['error']='Payment Failed!!';
				$return['redirect_link'] = ($receive_from == 'pos') ? base_url()."admin/pos/receive_against_pos/".encode_url($pos_sale_header_data['sale_order_id']) : base_url()."admin/booking/booking_details/".$booking_payment_detail['booking_id'];
				header('Content-Type: application/json');
				echo json_encode($return);
			}
			
		}
		$add_data = $this->mcommon->insert('activity_log', array('log_datetime' => date('Y-m-d H:i:s'), 'process_name' => 'status-cron', 'log_desc' => $cron_status));
		
	}
	
	public function posPaymentVerify()
	{
		$paramList = array();
		
		$payments = $this->mbooking->get_pos_booking_payment(array('status' => 'PENDING', 'booking_payment_id' => 353));
		
		if(!empty($payments)){
			foreach($payments as $payment){
				if(!is_null($payment)){
					$merchantTransactionId =  $payment['order_id'];
					$amount = round($payment['amount']) * 100;
					$device_id = $payment['device_id'];
					$transactionDateTime = $payment['payment_date'];
					$receive_from = $payment['order_id'];
					
					$bank_edc_data = $this->mcommon->getRow('bank_edc_terminal_master', array('edc_terminal_id' => $device_id));
					
					$paytmMid = $bank_edc_data['PAYTM_MID'];
					$merchant_key = $bank_edc_data['PAYTM_MERCHANT_KEY'];
					$channelId = STAGING_PAYTM_CHANNEL_ID;
					
					//echo $paytmMid.'--->'.$device_id.'--->'.$transactionDateTime.'--->'.$merchantTransactionId.'--->'.$merchant_key; die;
					
					$cron_status = "Status Cron job started.";
					
					if($merchantTransactionId != '' && $amount != ''){
						
						$headers = array(
						   "Content-Type: application/json",
						);
						
						$paramList["paytmMid"] = $paytmMid;// 
						$paramList["paytmTid"] = $device_id;//
						$paramList["transactionDateTime"] = $transactionDateTime;//date("Y-m-d h:i:s")
						$paramList["merchantTransactionId"] = $merchantTransactionId;
						//$paramList["transactionAmount"] = $amount;
						
						$checksum = PaytmChecksum::generateSignature($paramList, $merchant_key);
						
						$paytmParams["body"] = $paramList;
						
						$paytmParams["head"] = array(
							"version" => "3.1",
							"requestTimeStamp"    => date('Y-m-d H:i:s'),
							"channelId" => $channelId,
							"checksum" => $checksum
						);
						
						$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
						
						$url = STAGING_PAYTM_STATUS_API_URL;
				
						$curl = curl_init($url);
						curl_setopt($curl, CURLOPT_URL, $url);
						curl_setopt($curl, CURLOPT_POST, true);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
						curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
														
						curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
						curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
						
						$response = curl_exec($curl);
						curl_close($curl);
						
						$responseData = json_decode($response, true);
						
						//echo "<pre>"; print_r($responseData); die;
						//echo $responseData['body']['resultInfo']['resultStatus']; die;
						
						if(!empty($responseData)){
							if($responseData['body']['merchantTransactionId'] != ''){
								if($responseData['body']['resultInfo']['resultStatus']){
									if(($amount == $responseData['body']['transactionAmount']) && ($merchantTransactionId == $responseData['body']['merchantTransactionId'])){
										$cron_det = $this->mcommon->update('booking_payment', array('order_id' => $responseData['body']['merchantTransactionId']), array('cronjob_start_time' => date('Y-m-d H:i:s')));
										$orderStatus = $responseData['body']['resultInfo']['resultStatus'];
										//$date = str_replace('/', '-', $responseData['readableChargeSlipDate']);
										$transaction_date =  $responseData['body']['transactionDateTime'];
										$payment_data = array(
											'payment_date' => $transaction_date,
											'transaction_ref_id' => $responseData['body']['acquirementId'],
											//'bank_upi_ref_num' => $obj['Order_Status_Result']['order_bank_ref_no'],
											//'amount' => $booking_payment_detail['amount'],
											'payment_mode' => $responseData['body']['payMethod'],
											'response_txt' => $response,
											//'remarks' => $responseData['body']['resultInfo']['resultMsg'],
											'status' => $orderStatus
										);
										
										$payment_data['cronjob_data'] = $response;
										$payment_data['cronjob_status'] = 'COMPLETED';
										$payment_data['cronjob_end_time'] = date('Y-m-d H:i:s');
										
										if($responseData['body']['merchantTransactionId'] != ''){
											$cron_det = $this->mcommon->update('booking_payment', array('order_id' => $responseData['body']['merchantTransactionId']), $payment_data);
										}
										
										$cron_status = "Update Successful for Order ID: " . $responseData['body']['merchantTransactionId'];
									}
									$add_data = $this->mbooking->add_cron_job_activity_log(array('log_datetime' => date('Y-m-d H:i:s'), 'process_name' => 'booking-payment-verify-cron', 'log_desc' => $cron_status));
								}
							}
						}
					}
				}
			}
		} else {
			$cron_status .= " No Pending transactions found.";
			$add_data = $this->mbooking->add_cron_job_activity_log(array('log_datetime' => date('Y-m-d H:i:s'), 'process_name' => 'pos-booking-payment-verify-cron', 'log_desc' => $cron_status));
			//echo $cron_status . "<br>";
		}
		
		
	}
 
	public function logout()
	{
		$this->session->sess_destroy();
		//echo true;
		redirect(base_url());
	}
	
	public function check_strong_password($str) {
       if($str != ''){
		   if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $str)) {
			 return TRUE;
		   }
		   $this->form_validation->set_message('check_strong_password', 'Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.');
		   return FALSE;
	   }
    }
}
