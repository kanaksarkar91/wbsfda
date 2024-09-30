<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mcommon');
	}

	public function verify_cancel_refund_API()
	{


		$cancel_request_details = $this->db->from('cancel_request_tbl')->where('is_refunded',0)->order_by('cancel_request_id','ASC')->get()->result_array();
		//echo '<pre>';print_r($booking_payment_details);die;
		if(!empty($cancel_request_details)){

			foreach($cancel_request_details as $cancel_request_detail){

				if($cancel_request_detail['cancel_refund_request_id']){

					$hash_string  = _STAGE_MERCHANT_KEY . '|' . 'check_action_status' . '|' . $cancel_request_detail['cancel_refund_request_id'];
					$hash_string .= '|'._STAGE_SALT;
					$payu_hash =  hash("sha512", $hash_string);

					/* Endpoint */
					$url = _STAGE_PAYU_API_BASE_URL;

					/* eCurl */
					$curl = curl_init($url);
			
					/* Data */
					$data = [
						'key'=> _STAGE_MERCHANT_KEY, 
						'command'=>'check_action_status',
						'hash'=> $payu_hash,
						'var1'=> $cancel_request_detail['cancel_refund_request_id']
					];
			
					//echo '<pre>'; print_r($data);die;
					/* Set JSON data to POST */
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
						
					/* Return json */
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					//curl_setopt($curl, CURLOPT_FAILONERROR, true); 
						
					/* make request */
					$result = curl_exec($curl);
					
					/* close curl */
					curl_close($curl);

					$result_decoded = json_decode($result,true);
					if(!empty($result_decoded)){

						if(isset($result_decoded['transaction_details'][$data['var1']][$data['var1']]['status'])){

							
							$cancel_request_data = array(
								'cancel_status'=>$result_decoded['transaction_details'][$data['var1']][$data['var1']]['status'],
								'is_refunded'=>($result_decoded['transaction_details'][$data['var1']][$data['var1']]['status'] == 'success')?1:0,
								'refund_verify_response'=>$result,	
								'updated_by'=>$this->session->userdata('customer_id'),
								'updated_ts'=>date('Y-m-d H:i:s')
							);
							$this->db->update('cancel_request_tbl',$cancel_request_data,array('cancel_request_id'=>$cancel_request_detail['cancel_request_id']));

							$this->db->update('booking_header',array('is_refunded'=>($result_decoded['transaction_details'][$data['var1']][$data['var1']]['status'] == 'success')?1:0),array('booking_id'=>$cancel_request_detail['booking_id']));

						}
					}

				}

				

			}

			

		}
		
		
		echo 'Execution Completed';die;
		

	}

}
