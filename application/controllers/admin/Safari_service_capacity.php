<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Safari_service_capacity extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->session_data = $this->session->userdata('admin');
		$this->load->model(array('mcommon', 'admin/muser', 'admin/msafari_service'));
		$this->load->helper('email');
	}
	
	public function index($value1 = null)
	{
		$where = [];
		$data['serviceCapacities'] = [];
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['divisions'] = $this->mcommon->getDetailsOrder('division_master', array('is_active' => 1, 'state_id' => 41), 'division_name', 'ASC');
			$data['division_id']= $this->input->post('division_id') != '' ? $this->input->post('division_id') : ""; 
			
			if($this->input->post()){
				if($this->input->post('division_id')){
					$where['d.division_id'] = $this->input->post('division_id');
				}
			}
			$where['a.is_active'] = 1;
			$data['serviceCapacities'] = in_array($this->session_data['role_id'], array(2)) ? $this->msafari_service->get_service_capacities($where) : $this->msafari_service->get_service_capacities(array('a.created_by' => $this->session_data['user_id']));
		}
		$data['content'] = 'admin/safari_service_capacity/list';
		$this->load->view('admin/layouts/index', $data);
	}
	public function getServices()
	{
		$data_list = array();
		$safari_type_id = $this->input->post('safari_type_id');
		if(is_numeric($safari_type_id) && $safari_type_id > 0){
			$data_list = $this->mcommon->getDetailsOrder('safari_service_header', array('service_status' => 1, 'safari_type_id' => $safari_type_id), 'service_definition', 'ASC');
			$response = array("status"=> true, "list"=>$data_list);
		}
		else{
			$response = array("status"=> false, "list"=>$data_list);
		}
		
		echo json_encode($response);
		exit;
	}
	public function getServiceSeasons()
	{
		$data_list = array();
		$safari_service_header_id = $this->input->post('safari_service_header_id');
		if(is_numeric($safari_service_header_id) && $safari_service_header_id > 0){
			$data_list = $this->msafari_service->getSeasonsServiceWise(array('a.safari_service_header_id' => $safari_service_header_id));
			$response = array("status"=> true, "list"=>$data_list);
		}
		else{
			$response = array("status"=> false, "list"=>$data_list);
		}
		
		echo json_encode($response);
		exit;
	}
	public function getSlots()
	{
		$data_list = [];
		$html = '';
		if($this->input->post()){
			$service_period_master_id = $this->input->post('service_period_master_id');
			if(is_numeric($service_period_master_id) && $service_period_master_id > 0){
				$data_list = $this->mcommon->getDetailsOrder('safari_service_period_slot_detail', array('is_active' => 1, 'service_period_master_id' => $service_period_master_id), 'service_period_master_id', 'ASC');
				
				$quota_list = $this->mcommon->getDetailsOrder('safari_quota_master', array('is_active' => 1), 'quota', 'ASC');
				
				if(!empty($data_list)){
					foreach($data_list as $key => $val){
						$html .= '<div class="table-responsive">
								<table class="table table-sm align-middle table-bordered mb-0">
									<tr>
										<th>
										'.$val['slot_desc'].' : '.$val['start_time'].' to '. $val['end_time'].'
										</th>
									</tr>
									
									<tr>
										<td>
											<table class="table table-sm align-middle table-bordered mb-0">
												<tr>
													<th>Category</th>
													<th>Capacity</th>
												</tr>';
												
												if(!empty($quota_list)){
													foreach($quota_list as $key2 => $qRow){
													++$i;
											$html .= '<tr>
													<td>
														<input type="text" class="form-control" value="'.$qRow['quota'].'" readonly>
														<input type="hidden" name="safari_quota_id['.$val['period_slot_dtl_id'].$i.']" value="'.$qRow['safari_quota_id'].'">
														<input type="hidden" name="period_slot_dtl_id[]" value="'.$val['period_slot_dtl_id'].'">
													</td>
													<td>
														<input type="text" class="form-control" name="capacity['.$val['period_slot_dtl_id'].$i.']" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" placeholder="Capacity" required>
													</td>
												</tr>';
												
													}
												}
											$html .= '</table>
										</td>
									</tr>
								</table>
									
								</div>';
					}
					
					$response = array("status"=> true, "html"=>$html);
				}else{
					$response = array("status"=> false, "html"=>'Slot Not Found!!');
				}
			}
			else{
				$response = array("status"=> false, "html"=>$html);
			}
			
			echo json_encode($response);
			exit;
		}
	}	
	public function add_service_capacity() 
	{
		$data = array();
		//state_id=41 for West Bengal
		$data['districts'] = $this->mcommon->getDetailsOrder('district_master', array('is_active' => 1, 'state_id' => 41), 'district_name', 'ASC');
		$data['safariTypes'] = $this->mcommon->getDetailsOrder('safari_type_master', array('is_active' => 1), 'type_name', 'ASC');
		$data['periods'] = $this->mcommon->getDetailsOrder('safari_service_period_master', array('is_active' => 1), 'service_period_master_id', 'ASC');
		$data['parent_user'] = $this->muser->edit_user($this->admin_session_data['user_id']);
		$data['content'] = 'admin/safari_service_capacity/add';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function submit_service_capacity()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('safari_type_id','Safari Type','trim|required|numeric|greater_than[0.99]');
			$this->form_validation->set_rules('safari_service_header_id','Service','trim|required|numeric|greater_than[0.99]');
			$this->form_validation->set_rules('service_period_master_id','Season', 'trim|required|numeric|greater_than[0.99]');
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,0]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/safari_service_capacity");
			}
			else {
				
				$safari_type_id = $this->input->post('safari_type_id');
				$safari_service_header_id = $this->input->post('safari_service_header_id');
				$service_period_master_id = $this->input->post('service_period_master_id');
				$is_active = $this->input->post('is_active');
				
				$period_slot_dtl_id = $this->input->post('period_slot_dtl_id');
				$safari_quota_id = $this->input->post('safari_quota_id');
				$capacity = $this->input->post('capacity');
				
				$duplicateFound = $this->mcommon->getRow('safari_service_slot_capacity_mapping', array('safari_service_header_id' => $safari_service_header_id, 'service_period_master_id' => $service_period_master_id, 'is_active' => 1));
				
				if(empty($duplicateFound)){
					if(!empty($period_slot_dtl_id)){
						foreach($period_slot_dtl_id as $slotId){
							++$i;
							$quotaId = $safari_quota_id[$slotId.$i];
							$quotaCapacity = $capacity[$slotId.$i];
							
							$capacityData[] = array(
								'safari_service_header_id' => $safari_service_header_id,
								'safari_type_id' => $safari_type_id,
								'service_period_master_id' => $service_period_master_id,
								'period_slot_dtl_id' => $slotId,
								'safari_quota_id' => $quotaId,
								'capacity' => $quotaCapacity,
								'is_active' => $is_active,
								'created_by' => $this->admin_session_data['user_id'],
								'created_ts' => date('Y-m-d H:i:s')
							);
						}
						//echo "<pre>"; print_r($capacityData); die;
						$result = $this->msafari_service->capacityBatchInsert($capacityData);
					}
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate Slot Capacity Found');
					redirect("admin/safari_service_capacity");
				}
					
				if ($result) {
					$this->session->set_flashdata('success_msg', 'Service Capacity Added Successfully');
					redirect("admin/safari_service_capacity");
				}
				
			}
		}
		
	}
	
	public function edit_service_capacity($_safari_service_header_id, $_service_period_master_id)
	{
		$data = [];
		$service = [];
		$service_slot_capacity_mapping = [];
		$safari_service_header_id = decode_url($_safari_service_header_id);
		$service_period_master_id = decode_url($_service_period_master_id);
		$data['safari_service_header_id'] = $_safari_service_header_id;
		$data['service_period_master_id'] = $_service_period_master_id;
		
		if(is_numeric($safari_service_header_id) && $safari_service_header_id > 0 && is_numeric($service_period_master_id) && $service_period_master_id > 0){
			//$data['user_property_det'] = $user_property_det = $this->mproperty->get_user_property_details($this->session_data['user_id']);
			$data['user'] = $this->muser->edit_user($this->session_data['user_id']);
			
			$service_slot_capacity_mapping = $this->msafari_service->get_service_capacity_details(array('a.safari_service_header_id' => $safari_service_header_id, 'a.service_period_master_id' => $service_period_master_id, 'a.is_active' => 1));
		
			if(!empty($service_slot_capacity_mapping)){
				$data['service_slot_capacity_mapping'] = $service_slot_capacity_mapping;
			}
			$data['content'] = 'admin/safari_service_capacity/edit';
			$this->load->view('admin/layouts/index', $data);
		}
	}
	
	public function terminate_service_capacity() 
	{
		if($this->input->post()){
				
			$safari_service_header_id = decode_url($this->input->post('safari_service_header_id'));
			$service_period_master_id = decode_url($this->input->post('service_period_master_id'));
			
			$data = array(
				'is_active' => 0,
				'terminated_by' => $this->admin_session_data['user_id'],
				'terminated_ts' => date('Y-m-d H:i:s')
			);
			
			$condition = array('safari_service_header_id' => $safari_service_header_id, 'service_period_master_id' => $service_period_master_id);
			
			$result = $this->mcommon->update('safari_service_slot_capacity_mapping', $condition, $data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Service Capacity Terminated Successfully');
				redirect("admin/safari_service_capacity");
			}
		}
		
	}
	
	function uploadImages($fieldName) {
		
		$dir = 'service_images';

		$config['upload_path']          = './public/admin_images/' . $dir;
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['max_size']             = 5000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;

		$this->load->library('upload', $config);
		
		$img_ret = array();

		if ($this->upload->do_upload($fieldName)) {
			$upload_data = $this->upload->data();
			$image_path = $dir . '/' . $upload_data['file_name'];
			
			$img_ret = array('status' => true, 'img_path' => $image_path);
		} else {
			$img_ret = array('status' => false, 'error' => $this->upload->display_errors());
		}
		
		return $img_ret;
	}
}