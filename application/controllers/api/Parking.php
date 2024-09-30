<?php

use Dompdf\Positioner\NullPositioner;

defined('BASEPATH') or exit('No direct script access allowed');
class Parking extends CI_Controller
{
	var $arr;
	var $obj;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('mcommon', 'api/mparking'));
		$this->arr = array();
		$this->obj = new stdClass();
		$this->http_methods = array('POST', 'GET', 'PUT', 'DELETE');
	}
	
	private function displayOutput($response)
	{
		header('Content-Type: application/json');
		echo json_encode($response);
		exit(0);
	}
	
	private function checkHttpMethods($http_method_type)
	{
		if ($_SERVER['REQUEST_METHOD'] == $http_method_type) {
		  return 1;
		}
	}

	//Login 
	public function login()
	{
	
	  $data = json_decode(file_get_contents('php://input'), true);
	
	  if ($this->checkHttpMethods($this->http_methods[0])) {
	
		if (sizeof($data)) {
	
		  if (empty($data['email']) && empty($data['password'])) {
			$response = array('status' =>  0, 'message' => 'Email and password fields are required', 'user_details' => $this->obj);
			$this->displayOutput($response);
		  }
	
		  if (empty($data['email'])) {
			$response = array('status' =>  0, 'message' => 'Email field is required', 'user_details' => $this->obj);
			$this->displayOutput($response);
		  }
	
		  if (empty($data['password'])) {
			$response = array('status' => 0, 'message' => 'Password field is required', 'user_details' => $this->obj);
			$this->displayOutput($response);
		  }
		  
		  $condition['email']=$data['email'];
		  $user_details=$this->mcommon->getRow('master_admin',$condition);
			if (password_verify($data['password'], $user_details['password'])) {
				if(empty($user_details)){
					$response = array('status' => 0, 'message' => 'Invalid email or password', 'user_details' => $this->obj);
				}else{
					if($user_details['status'] !='0'){
						$response = array('status' => 0, 'message' => 'Account Deactivated', 'user_details' => $this->obj);
					}
					
					$response = array('status' => 1, 'message' => 'Login Successfully', 'user_details' => $user_details);
				}
			}
			else{
				$response = array('status' => 0, 'message' => 'Invalid email or password', 'user_details' => $this->obj);
			}
		  
		} else {
		  $response = array('status' => 0, 'message' => 'Please fill up all required fields', 'user_details' => $this->obj);
		}
	  } else {
		$response = array('status' =>  0, 'message' => 'Wrong http method type', 'user_details' => $this->obj);
	  }
	  $this->displayOutput($response);
	}
	
	
	//Parking Type
	public function getParkingType(){
		
		$data = json_decode(file_get_contents('php://input'), true);
		
		if ($this->checkHttpMethods($this->http_methods[0])) {
			
			if (sizeof($data)) {
				
				if (empty($data['user_id'])) {
					$response = array('status' =>  0, 'message' => 'Please Login', 'parking_type' => $this->obj);
				}
				else{
					$getParkingTypeData = $this->mcommon->getDetails('master_parking_type', array('is_active' => 1));
					if(!empty($getParkingTypeData)){
						$response = array('status' => 1, 'message' => 'Success', 'parking_type' => $getParkingTypeData);
					}
					else{
						$response = array('status' =>  0, 'message' => 'No Data Found', 'parking_type' => $this->obj);
					}
				}
			}
			else{
				$response = array('status' =>  0, 'message' => 'Please Login', 'parking_type' => $this->obj);
			}
		}
		else{
			$response = array('status' =>  0, 'message' => 'POST Not Found', 'parking_type' => $this->obj);
		}
		$this->displayOutput($response);
		
	}
	
	//Vehicle Type And Rate
	public function getVehicleTypeAndRate(){
		
		$data = json_decode(file_get_contents('php://input'), true);
		
		if ($this->checkHttpMethods($this->http_methods[0])) {
			
			if (sizeof($data)) {
				
				if (empty($data['parking_type_id'])) {
					$response = array('status' =>  0, 'message' => 'Parking Type Not Found', 'vehicle_data' => $this->obj);
				}
				if (empty($data['vehicle_type_id'])) {
					$response = array('status' =>  0, 'message' => 'Vehicle Type Not Found', 'vehicle_data' => $this->obj);
				}
				if(!empty($data['parking_type_id'])){
					if($data['parking_type_id'] == PARKING_TYPE_PRODUCT_SALE){
						
						$where_condition = array('user_id' => $data['user_id']);
			  			$userPropertyFind = $this->mparking->get_user_property($where_condition);
						//echo $this->db->last_query(); die;
						if(!empty($userPropertyFind)){
							$getData = $this->mparking->get_parking_items(array('master_parking_item.property_id' => $userPropertyFind['property_id'], 'master_parking_item.is_active' => 1));
						}
						else{
							$response = array('status' =>  0, 'message' => 'Property not mapping to user', 'vehicle_data' => $this->obj);
						}
						
					}
					else{
						$getData = $this->mcommon->getDetails('master_vehicle_type_and_rate', array('parking_type_id' => $data['parking_type_id'], 'is_active' => 1));
					}
					
					if(!empty($getData)){
						$response = array('status' => 1, 'message' => 'Success', 'vehicle_data' => $getData);
					}
					else{
						$response = array('status' =>  0, 'message' => 'No Data Found', 'vehicle_data' => $this->obj);
					}
				}
				if(!empty($data['vehicle_type_id'])){
					$getVehicleTypeData = $this->mcommon->getDetails('master_vehicle_type_and_rate', array('vehicle_type_id' => $data['vehicle_type_id'], 'is_active' => 1));
					if(!empty($getVehicleTypeData)){
						$response = array('status' => 1, 'message' => 'Success', 'vehicle_data' => $getVehicleTypeData);
					}
					else{
						$response = array('status' =>  0, 'message' => 'No Data Found', 'vehicle_data' => $this->obj);
					}
				}
			}
			else{
				$response = array('status' =>  0, 'message' => 'Parking Type Not Found', 'vehicle_data' => $this->obj);
			}
		}
		else{
			$response = array('status' =>  0, 'message' => 'POST Not Found', 'vehicle_data' => $this->obj);
		}
		$this->displayOutput($response);
		
	}
	  
	
	//Parking fees calculation
	public function calculateParkingFees(){
		
		$data = json_decode(file_get_contents('php://input'), true);
		
		if ($this->checkHttpMethods($this->http_methods[0])) {
			
			if (sizeof($data)) {
				
				if (empty($data['user_id'])) {
					$response = array('status' =>  0, 'message' => 'User is Missing', 'parking_details' => $this->obj);
				}
				if (empty($data['parking_type_id'])) {
					$response = array('status' =>  0, 'message' => 'Parking Type is Missing', 'parking_details' => $this->obj);
				}
				/*if (empty($data['vehicle_type_id'])) {
					$response = array('status' =>  0, 'message' => 'Vehicle Type is Missing', 'parking_details' => $this->obj);
				}
				if(empty($data['vehicle_number'])){
					$response = array('status' =>  0, 'message' => 'Vehicle Number is Missing', 'parking_details' => $this->obj);
					$this->displayOutput($response);
				}
				if(empty($data['in_date'])){
					$response = array('status' =>  0, 'message' => 'In Date is Missing', 'parking_details' => $this->obj);
				}
				if(empty($data['in_time'])){
					$response = array('status' =>  0, 'message' => 'In Time is Missing', 'parking_details' => $this->obj);
				}
				if(empty($data['out_date'])){
					$response = array('status' =>  0, 'message' => 'Out Date is Missing', 'parking_details' => $this->obj);
				}
				if(empty($data['out_time'])){
					$response = array('status' =>  0, 'message' => 'Out Time is Missing', 'parking_details' => $this->obj);
				}*/
				if(empty($data['payable_amount'])){
					$response = array('status' =>  0, 'message' => 'Amount is Missing', 'parking_details' => $this->obj);
				}
				else{
					$where_condition = array('user_id' => $data['user_id']);
			  		$userPropertyFind = $this->mparking->get_user_property($where_condition);
					if(!empty($userPropertyFind)){
						
						$insertData = array(
							'property_id' => $userPropertyFind['property_id'],
							'parking_type_id' => $data['parking_type_id'],
							'vehicle_type_id' => ($data['parking_type_id'] == PARKING_TYPE_PRODUCT_SALE) ? 0 : $data['vehicle_type_id'],
							'vehicle_number' => ($data['parking_type_id'] == PARKING_TYPE_PRODUCT_SALE) ? 0 : $data['vehicle_number'],
							'in_date' => $data['in_date'],
							'in_time' => $data['in_time'],
							'out_date' => $data['out_date'],
							'out_time' => $data['out_time'],
							'no_of_vehicle' => $data['no_of_vehicle'],
							'payable_amount' => $data['payable_amount'],
							'order_id' => $data['order_id'],
							'payment_date' => $data['payment_date'],
							'payment_mode' => $data['payment_mode'],
							'response_txt' => $data['response_txt'],
							'payment_status' => $data['payment_status'],
							'created_by' => $data['user_id'],
							'created_ts' => date('Y-m-d H:i:s')
						);
						
						$result = $this->mcommon->insert('parking', $insertData);
						
						if($result){
							if($data['parking_type_id'] == PARKING_TYPE_PRODUCT_SALE){
								if(!empty($data['items'])){
									foreach($data['items'] as $row){
										$insertDetailData = array(
											"parking_id"=>$result,
											"property_id"=>$userPropertyFind['property_id'],
											"item_id"=>$row['item_id'],
											"item_qty"=>$row['item_qty'],
											"item_price"=>$row['item_price'],
											"tot_amt"=>$row['item_qty'] * $row['item_price']
										);
										
										$insertDetails = $this->mcommon->insert('parking_detail', $insertDetailData);
									}
								}
							}
							
							$response = array('status' =>  1, 'message' => 'Data saved successfully', 'parking_details' => $result);
						}
					}
				}
			}
		}
		
		$this->displayOutput($response);
	}  
  
}
