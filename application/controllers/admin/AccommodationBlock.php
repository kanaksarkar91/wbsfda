<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccommodationBlock extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/Properties', 'admin/mproperty', 'admin/maccommodation', 'admin/maccommodationblock', 'admin/mreservation'));
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data = array('menu_id'=> 25);
		
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		if($this->input->post()){
			if($this->input->post('property_id') != 0){
				$where['blocked_accommodation.property_id = '] = $this->input->post('property_id');
			}
		}
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN){
			$data['accommodations'] = $this->maccommodationblock->get($where);
		}else{
			$data['accommodations'] = array();
			if(check_user_permission($data['menu_id'], 'delete_flag')){
				$parent_properties = $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$parent_properties = !empty($parent_properties) ? array_column($parent_properties, 'property_id') : array();
				if(!empty($parent_properties)){
					$data['accommodations'] = $this->maccommodationblock->get_accommodation_block_list_property_id($parent_properties);
				}
			}
		}
		$data['content'] = 'admin/accommodation-block/index';
		$this->load->view('admin/layouts/index', $data);
	}

	public function add($pre_data = array())
	{
		$data = array();
		// $data['properties'] = $this->Properties->get();
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['content'] = 'admin/accommodation-block/add';
		$this->load->view('admin/layouts/index', $data);
	}

	public function edit($id)
	{
		$data = array();
		$data['accommodation'] = $this->maccommodationblock->get(array('blocked_id' => $id));
		$data['accommodation'] = $data['accommodation'][0];
		// $data['properties'] = $this->Properties->get();
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['content'] = 'admin/accommodation-block/edit';
		$this->load->view('admin/layouts/index', $data);
	}

	public function save()
	{
		//echo '<pre>'; print_r($this->input->post()); die;
		$from_date = $this->input->post('start_date');
		$to_date = $this->input->post('end_date');
		$accommodation_id = $this->input->post('accommodation_id');
		$property_id = $this->input->post('property_id');
		$room_no = $this->input->post('room_no');
		$no_of_room = !empty($this->input->post('room')) ? $this->input->post('room') : 1;
		if($from_date > $to_date){
			echo json_encode(array('success'=> FALSE, 'message'=> 'Sorry!!, To date must be grater than Start date.'));
			exit;
		}
		if(empty($property_id)){
			echo json_encode(array('success'=> FALSE, 'message'=> 'Sorry!!, Property id is required.'));
			exit;
		}
		if($accommodation_id != 'all' && $accommodation_id<=0){
			echo json_encode(array('success'=> FALSE, 'message'=> 'Sorry!!, Please input a valid accommodation.'));
			exit;
		}
		// if try to block for a selected accommodation
		if($accommodation_id != 'all' && $accommodation_id >0){
			// $accommodation_list = $this->maccommodation->get_accommodation_list_property_id($property_id);
			/*
				*call get_property_accomm_availability_proc(property_id, accommodation_id, 'from_date', 'to_date');
				** accommodation_id===0 [get all]
			*/
			$accommodation_list = $this->maccommodation->get_property_accomm_availability($property_id, $accommodation_id, $from_date, $to_date);
			mysqli_next_result( $this->db->conn_id );
			// print_r($accommodation_list);
			if(!empty($accommodation_list)){
				foreach($accommodation_list as $accommodation){
					if($accommodation['accommodation_id'] == $accommodation_id){
						// echo $no_of_room .'>'. $accommodation['no_of_accomm'];
						if($no_of_room > $accommodation['available_room_cnt']){
							echo json_encode(array('success'=> FALSE, 'message'=> 'Sorry!!, Maximum room/s available-'.$accommodation['available_room_cnt']));
							exit;
						}
					}
				}
			}
		}
		// if try to block for a selected accommodation
		if($accommodation_id == 'all'){
			/*
				*call get_property_accomm_availability_proc(property_id, accommodation_id, 'from_date', 'to_date');
				** accommodation_id===0 [get all]
			*/
			// echo '<pre>';
			$accommodation_list = $this->maccommodation->get_property_accomm_availability($property_id, 0, $from_date, $to_date);
			mysqli_next_result( $this->db->conn_id );
			// print_r($accommodation_list);
			// print_r($accommodation_list);
			$is_accommodation_booked = FALSE;
			if(!empty($accommodation_list)){
				foreach($accommodation_list as $accommodation){
					if($accommodation['booked_room_cnt'] >0 ){
						$is_accommodation_booked = TRUE;
					}
				}
			}
			if($is_accommodation_booked){
				echo json_encode(array('success'=> FALSE, 'message'=> 'Sorry!!, All accommodations are not available for this property.'));
				exit;
			}
		}
		
		foreach($room_no as $roomn){
			$data[] = array(
				'property_id' => $property_id,
				'accommodation_id' => $accommodation_id=='all'?0:$accommodation_id,
				'no_of_accommodation' => $no_of_room,
				'room_no' => $roomn,
				'from_date' => $from_date,
				'to_date' => $to_date,
				'remarks' => !empty($this->input->post('remarks')) ? $this->input->post('remarks') : '',
			);
		}
		
		if (!empty($data)) {
			$result = $this->db->insert_batch('blocked_accommodation', $data);
		}

		/*$get_accommodation_block_status = $this->maccommodationblock->get_accommodation_status($data);
		// echo '<pre>'.$this->db->last_query(); die;
		if($get_accommodation_block_status){
			$this->session->set_flashdata('success_msg', 'Sorry!! Accommodation Block. Please check your selection.');
			echo json_encode(array('success'=> FALSE, 'message'=> 'Sorry!! Accommodation Block. Please check your selection.'));
			exit;
		}

		$result = $this->maccommodationblock->add($data);*/
			
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Accommodation Block Added Successfully.');
			echo json_encode(array('success'=> TRUE, 'message'=> 'Accommodation Block Added Successfully.'));
			exit;
		}else{
			$this->session->set_flashdata('error_msg', 'Unable to add Accommodation Block.');
			echo json_encode(array('success'=> FALSE, 'message'=> 'Unable to add Accommodation Block.'));
			exit;
		}
	}

	public function update($id = '')
	{
		$from_date = date('Y-m-d', strtotime($this->input->post('start_date')));
		$to_date = date('Y-m-d', strtotime($this->input->post('end_date')));
		$accommodation_id = $this->input->post('accommodation_id');
		$property_id = $this->input->post('property_id');
		$no_of_room = !empty($this->input->post('room')) ? $this->input->post('room') : 0;
		if($from_date > $to_date){
			echo json_encode(array('success'=> FALSE, 'message'=> 'Sorry!!, To date must be grater than Start date.'));
			exit;
		}
		if(empty($property_id)){
			echo json_encode(array('success'=> FALSE, 'message'=> 'Sorry!!, Property id is required.'));
			exit;
		}
		if($accommodation_id != 'all' && $accommodation_id<=0){
			echo json_encode(array('success'=> FALSE, 'message'=> 'Sorry!!, Please input a valid accommodation.'));
			exit;
		}
		// if try to block for a selected accommodation
		// if try to block for a selected accommodation
		if($accommodation_id != 'all' && $accommodation_id >0){
			// $accommodation_list = $this->maccommodation->get_accommodation_list_property_id($property_id);
			/*
				*call get_property_accomm_availability_proc(property_id, accommodation_id, 'from_date', 'to_date');
				** accommodation_id===0 [get all]
			*/
			$accommodation_list = $this->maccommodation->get_property_accomm_availability($property_id, $accommodation_id, $from_date, $to_date);
			mysqli_next_result( $this->db->conn_id );
			if(!empty($accommodation_list)){
				foreach($accommodation_list as $accommodation){
					if($accommodation['accommodation_id'] == $accommodation_id){
						// echo $no_of_room .'>'. $accommodation['no_of_accomm'];
						if($no_of_room > $accommodation['available_room_cnt']){
							echo json_encode(array('success'=> FALSE, 'message'=> 'Sorry!!, Maximum room/s available-'.$accommodation['available_room_cnt']));
							exit;
						}
					}
				}
			}
		}
		// if try to block for a selected accommodation
		if($accommodation_id == 'all'){
			/*
				*call get_property_accomm_availability_proc(property_id, accommodation_id, 'from_date', 'to_date');
				** accommodation_id===0 [get all]
			*/
			// echo '<pre>';
			$accommodation_list = $this->maccommodation->get_property_accomm_availability($property_id, 0, $from_date, $to_date);
			mysqli_next_result( $this->db->conn_id );
			// print_r($accommodation_list);
			$is_accommodation_booked = FALSE;
			if(!empty($accommodation_list)){
				foreach($accommodation_list as $accommodation){
					if($accommodation['booked_room_cnt'] >0 ){
						$is_accommodation_booked = TRUE;
					}
				}
			}
			if($is_accommodation_booked){
				echo json_encode(array('success'=> FALSE, 'message'=> 'Sorry!!, All accommodations are not available for this property.'));
				exit;
			}
		}
		$data = array(
			'property_id' => $property_id,
			'accommodation_id' => $accommodation_id=='all'?0:$accommodation_id,
			'no_of_accommodation' => $no_of_room,
			'from_date' => $from_date,
			'to_date' => $to_date,
			'remarks' => !empty($this->input->post('remarks')) ? $this->input->post('remarks') : '',
		);
		$get_accommodation_block_status = $this->maccommodationblock->get_accommodation_status($data, $id);
		// echo '<pre>'.$this->db->last_query();
		if($get_accommodation_block_status){
			$this->session->set_flashdata('success_msg', 'Sorry!! Accommodation Block. Please check your selection.');
			echo json_encode(array('success'=> FALSE, 'message'=> 'Sorry!! Accommodation Block. Please check your selection.'));
			exit;
		}
		$result = $this->maccommodationblock->update($id, $data);
			
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Accommodation Block Updated Successfully.');
			echo json_encode(array('success'=> TRUE, 'message'=> 'Accommodation Block Updated Successfully.'));
			exit;
		}else{
			$this->session->set_flashdata('error_msg', 'Unable to Updated Accommodation Block.');
			echo json_encode(array('success'=> FALSE, 'message'=> 'Unable to Updated Accommodation Block.'));
			exit;
		}
	}
	
	public function delete($id)
	{
		$row = $this->db->where('blocked_id', $id)->get('blocked_accommodation')->row();
        if(!empty($row)){
            $data = array(
				'blocked_id'=> $row->blocked_id,
				'property_id' => $row->property_id,
				'accommodation_id' => $row->accommodation_id,
				'no_of_accommodation' => $row->no_of_accommodation,
				'room_no' => $row->room_no,
				'from_date' => $row->from_date,
				'to_date' => $row->to_date,
				'remarks' => $row->remarks,
			);

			$this->db->insert('blocked_accommodation_archive', $data);
        }

		$this->db->where('blocked_id', $id)->delete('blocked_accommodation');
			
		$this->session->set_flashdata('success_msg', 'Accommodation Block Deleted Successfully');

		redirect('admin/AccommodationBlock/index');
	}
	
	public function getPropertyDetails()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$property_id = $this->input->post('property_id');
		$result = $this->mproperty->get_property_details_by_sp($property_id, $start_date, $end_date);
		echo json_encode(array('success'=>TRUE, 'list'=> $result));
		exit;
	}
	
	public function getRoomDetails()
	{
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$accommodation_id = $this->input->post('accommodation_id');
		$result = $this->mreservation->get_available_room($accommodation_id, $start_date, $end_date);
		
		echo json_encode(array('success'=>TRUE, 'list'=> $result));
		exit;
	}
	
}
