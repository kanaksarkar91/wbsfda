<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserPermission extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/muser');
		$this->load->model('admin/mproperty');
		$this->load->model('admin/mmenu');
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
		$data = array('menu_id'=> 22);
		$data['menues'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['menues'] = $this->mmenu->get_permission_menu();
		}
		$data['roles'] = $this->muser->get_role();
		$data['content'] = 'admin/user-permission/index';
		$this->load->view('admin/layouts/index', $data);
	}
	

	public function ajaxUserPermissionHandler()
	{
		$result = '';
		if(!array_key_exists('permission', $this->input->post()) || empty($this->input->post('permission'))){
			$this->session->set_flashdata('error_msg', 'Permission is required to do the action.');
			$response = array(
				'success' => FALSE,
				'message' => 'Permission is required to do the action.',
			);
			echo json_encode($response); exit;
		}
		if(!array_key_exists('user_role', $this->input->post()) || empty($this->input->post('user_role'))){
			$this->session->set_flashdata('error_msg', 'User Role is required to do the action.');
			$response = array(
				'success' => FALSE,
				'message' => 'User Role is required to do the action.',
			);
			echo json_encode($response); exit;
		}
		try{
			$permission_array = $this->input->post('permission');
			/**
			 * ['menu_id'] == 0  Referred to all menu
			*/
			$data = array(
				'role_id' => $this->input->post('user_role'),
				'is_active' => 1,
			);
			if($permission_array[0]['menu_id'] > 0){
				$data['menu_id'] = $permission_array[0]['menu_id'];
				$data['menu_name'] = $permission_array[0]['menu_name'];
			}else{
				//get amm menus
				//$data['menues'] = $this->mmenu->get_permission_menu();
				$data['menu_id'] = 0;
				$data['menu_name'] = 'All';
			}
			$insert_count_on = false;
			foreach($permission_array as $permission){
				if($permission['action'] == 'add'){
					$data['add_flag'] = (int)$permission['status'];
					if($data['add_flag'] >0){
						$insert_count_on = true;
					}
				}
				if($permission['action'] == 'edit'){
					$data['edit_flag'] = (int)$permission['status'];
					if($data['edit_flag'] >0){
						$insert_count_on = true;
					}
				}
				if($permission['action'] == 'delete'){
					$data['delete_flag'] = (int)$permission['status'];
					if($data['delete_flag'] >0){
						$insert_count_on = true;
					}
				}
				if($permission['action'] == 'print'){
					$data['download_flag'] = (int)$permission['status'];
					if($data['download_flag'] >0){
						$insert_count_on = true;
					}
				}
			}
			$result = $this->muser->add_edit_permission($data, $insert_count_on);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Permission Added Successfully');
				$response = array(
					'success' => TRUE,
					'message' => 'Permission Added Successfully.',
					'data'=> $result
				);
			}else{
				$response = array(
					'success' => FALSE,
					'message' => 'Unable to save Permission.',
					'data'=> $result
				);
			}
		}catch(Exception $ex){
			$response = array(
				'success' => FALSE,
				'message' => 'Something went wrong.',
				'data'=> $result
			);
		}

		echo json_encode($response); exit;
	}

	public function ajaxGetUserPermission()
	{
		$result = '';
		try{
			$result = $this->muser->get_role_permission($this->input->get('role_id'));
			$response = array(
				'success' => TRUE,
				'message' => 'Permission Added Successfully.',
				'data'=> $result
			);
		}
		catch(Exception $ex){
			$response = array(
				'success' => FALSE,
				'message' => 'Something went wrong.',
				'data'=> $result
			);
		}

		echo json_encode($response); exit;
	}

	public function updateuser($user_id = '')
	{
		$where = array(
			'ma.user_name' => $this->input->post('user_name'),
			'ma.status <>' => 2,
			'ma.user_id <>' => $user_id
		);
		$has_username = $this->muser->get_user($where);
		if(!empty($has_username)){
			$this->session->set_flashdata('error_msg', 'Username is already used.');
			$response = array(
				'success' => FALSE,
				'message' => 'Username is already used.',
			);
			echo json_encode($response); exit;
		}
		if(!empty($this->input->post('password')) && empty($this->input->post('confirm_password'))){
			$response = array(
				'success' => FALSE,
				'message' => 'Confirm Password is required when you have used password.',
			);
			echo json_encode($response); exit;
		}
		if(!empty($this->input->post('password')) && !empty($this->input->post('confirm_password'))){
			if($this->input->post('password') != $this->input->post('confirm_password')){
				$response = array(
					'success' => FALSE,
					'message' => 'Password & Confirm Password are not same.',
				);
				echo json_encode($response); exit;
			}
		}
		try{
			$data = array(
				'role_id' => $this->input->post('role_id'),
				'full_name' => $this->input->post('full_name'),
				'user_name' => $this->input->post('user_name'),
				'email' => $this->input->post('email'),
				'gender' => $this->input->post('gender'),
				'contact_no' => $this->input->post('contact_no'),
				'property_unit_master_id'=> $this->input->post('unit_id'),
				'status' => $this->input->post('status'),
				'updated_by' => $this->admin_session_data['user_id'],
				'updated_ts' => date('Y-m-d H:i:s')
			);

			if($this->input->post('password') == $this->input->post('confirm_password')){
				$data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT, array('cost' => 12));
			}

			$condition = array('user_id' => $user_id);
				
			$result = $this->muser->update_user($condition, $data);
				
			if ($result) {
				$property_id = $this->input->post('property_id');
				if(!empty($property_id)){
					$this->muser->delete_user_property(array('user_id' => $user_id));
					foreach($property_id as $p_id){
						$user_property = array(
							'user_id' => $user_id,
							'property_id' => $p_id,
						);
						$this->muser->submit_user_property($user_property);
					}
				}
				$this->session->set_flashdata('success_msg', 'User Updated Successfully');
				$response = array(
					'success' => TRUE,
					'message' => 'User Details Added Successfully.',
					'data'=> $result
				);
			}else{
				$response = array(
					'success' => FALSE,
					'message' => 'Unable to update user details.',
					'data'=> $result
				);
			}
		}
		catch(Exception $ex){
			$response = array(
				'success' => FALSE,
				'message' => 'Something went wrong.',
				'data'=> $result
			);
		}

		echo json_encode($response); exit;
	}
	
	public function get_district()
	{
		$data = array();
		$state_id=$this->input->post('state_id');
		$data = $this->muser->get_district($state_id);
		echo json_encode($data); 
	}
}
