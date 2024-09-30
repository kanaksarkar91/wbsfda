<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('mcommon', 'admin/muser', 'admin/mproperty'));
		$this->load->helper('email');
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
		$data = array('menu_id'=> 20);
		$where = array('ma.user_id <>'=> $this->admin_session_data['user_id']);
		$data['users'] = array();
		$data['parent_user'] = $this->muser->edit_user($this->admin_session_data['user_id']);
		$data['property_unit_master_id'] = $data['parent_user']['property_unit_master_id'];
		$post_array = $this->input->post();
		$data['unit_id'] = isset($post_array['unit_id']) ? $post_array['unit_id'] : "";
		$data['property_zp'] = isset($post_array['property_zp']) ? $post_array['property_zp'] : "";
		$data['property_panchayat_samiti'] = isset($post_array['property_panchayat_samiti']) ? $post_array['property_panchayat_samiti'] : "";
		$data['property_gram_panchayat'] = isset($post_array['property_gram_panchayat']) ? $post_array['property_gram_panchayat'] : "";
		
		$property_unit_master_id = isset($post_array['unit_id']) ? $post_array['unit_id'] : $this->admin_session_data['property_unit_master_id'];
		
		if($this->input->post()){
			$where['ma.property_unit_master_id'] = $property_unit_master_id;
			$data['property_unit_master_id'] = $data['unit_id'];
		}
		if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN && $this->admin_session_data['property_unit_master_id'] > 0){
			if(check_user_permission($data['menu_id'], 'delete_flag')){
				/* for nodal admin user where user role=District Nodal Admin(id=1)*/
				if ($this->admin_session_data['role_id'] == ROLE_NODAL ) {

					$data['users'] = $this->muser->get_user_nodal($this->admin_session_data['user_id'], $property_unit_master_id);
				}
				else {
					$where['ma.property_unit_master_id'] = $property_unit_master_id;
					$data['users'] = $this->muser->get_user($where);
				}
			}
		}
		else{
			$data['users'] = $this->muser->get_user($where);
		}

		// echo $this->db->last_query();
		$data['zilla_parishads'] = $this->mproperty->get_property_unit(array('parent_unit_id' => 0));
		$data['content'] = 'admin/user/list';
		$this->load->view('admin/layouts/index', $data);
	}

	public function adduser($pre_data = array())
	{
		$data = array();
		$data = $pre_data;
		$data['roles'] = $this->muser->get_role();
		//$data['zilla_parishads'] = $this->mproperty->get_property_unit(array('parent_unit_id' => 0));
		//$data['states'] = $this->muser->get_state();
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['parent_user'] = $this->muser->edit_user($this->admin_session_data['user_id']);
		$data['content'] = 'admin/user/add';
		$this->load->view('admin/layouts/index', $data);
	}

	public function edituser($user_id)
	{
		$data['user'] = $this->muser->edit_user($user_id);
		//var_dump($data['user']);
		$data['roles'] = $this->muser->get_role();
		$data['zilla_parishads'] = $this->mproperty->get_property_unit(array('parent_unit_id' => 0));
		$data['user_property'] = $this->muser->get_user_property(array('user_id' => $user_id));
		$data['user_property'] = !empty($data['user_property']) ? array_column($data['user_property'], 'property_id') : array();
		
		$data['user_pos'] = $this->mcommon->getDetails('user_pos_mapping', array('user_id' => $user_id));
		$data['user_pos'] = !empty($data['user_pos']) ? array_column($data['user_pos'], 'cost_center_id') : array();
		//$data['districts'] = $this->muser->get_district($data['user']['state_id']);
		//echo '<pre>'; print_r($data['user_property']); die;
		$data['content'] = 'admin/user/edit';
		$this->load->view('admin/layouts/index', $data);
	}

	public function submitUser()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('role_id','User Role','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('designation','Designation','trim|required|alpha_numeric_spaces');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('full_name','Full Name','trim|required|alpha_numeric_spaces');
			$this->form_validation->set_rules('contact_no','Mobile No.','trim|required|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required|in_list[Male,Female,Other]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[25]|callback_check_strong_password');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg',  validation_errors());
				$response = array(
					'success' => FALSE,
					'message' => validation_errors(),
				);
				echo json_encode($response); exit;
			}
			else {
				
				$where = array(
					'ma.email' => $this->input->post('email'),
					'ma.status <>' => 2,
				);
				$has_useremail = $this->muser->get_user($where);
				if(!empty($has_useremail)){
					$this->session->set_flashdata('error_msg', 'Email is already used.');
					$response = array(
						'success' => FALSE,
						'message' => 'Email is already used.',
					);
					echo json_encode($response); exit;
				}
				if($this->input->post('password') != $this->input->post('confirm_password')){
					$this->session->set_flashdata('error_msg', 'Password & Confirm Password not matched.');
					$response = array(
						'success' => FALSE,
						'message' => 'Password & Confirm Password not matched.',
					);
					echo json_encode($response); exit;
				}
				try{
					$data = array(
						'role_id' => $this->input->post('role_id'),
						'full_name' => $this->input->post('full_name'),
						'designation' => $this->input->post('designation'),
						'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT, array('cost' => 12)),
						'email' => $this->input->post('email'),
						'property_unit_master_id' => 9999,
						'gender' => $this->input->post('gender'),
						'contact_no' => $this->input->post('contact_no'),
						'status' => $this->input->post('status'),
						'created_by' => $this->admin_session_data['user_id'],
						'created_ts' => date('Y-m-d H:i:s')
					);
					$result = $this->muser->submit_user($data);
						
					if ($result) {
						$property_id = $this->input->post('property_id');
						if(!empty($property_id)){
							foreach($property_id as $p_id){
								$user_property = array(
									'user_id' => $result,
									'property_id' => $p_id,
								);
								$this->muser->submit_user_property($user_property);
							}
						}
						
						$cost_center_id = $this->input->post('cost_center_id');
						if(!empty($cost_center_id)){
							foreach($cost_center_id as $c_id){
								$ccd = $this->mcommon->getRow('cost_center_master', array('cost_center_id' => $c_id));
								$user_pos_data = array(
									'user_id' => $result,
									'property_id' => $ccd['property_id'],
									'cost_center_id' => $c_id,
								);
								$this->mcommon->insert('user_pos_mapping', $user_pos_data);
							}
						}
						
						$this->session->set_flashdata('success_msg', 'User Added Successfully');
						$response = array(
							'success' => TRUE,
							'message' => 'User Details Added Successfully.',
							'data'=> $result
						);
					}else{
						$response = array(
							'success' => FALSE,
							'message' => 'Unable to save user details.',
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
				
			}
		}

		echo json_encode($response); exit;
	}

	public function updateuser($user_id = '')
	{
		if($this->input->post()){
			$this->form_validation->set_rules('role_id','User Role','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('designation','Designation','trim|required|alpha_numeric_spaces');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('full_name','Full Name','trim|required|alpha_numeric_spaces');
			$this->form_validation->set_rules('contact_no','Mobile No.','trim|required|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required|in_list[Male,Female,Other]');
			$this->form_validation->set_rules('password', 'Password', 'min_length[8]|max_length[25]|callback_check_strong_password');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg',  validation_errors());
				$response = array(
					'success' => FALSE,
					'message' => validation_errors(),
				);
				echo json_encode($response); exit;
			}
			else {
				
				$where = array(
					'ma.email' => $this->input->post('email'),
					'ma.status <>' => 2,
					'ma.user_id <>' => $user_id
				);
				$has_useremail = $this->muser->get_user($where);
				if(!empty($has_useremail)){
					$this->session->set_flashdata('error_msg', 'Email is already used.');
					$response = array(
						'success' => FALSE,
						'message' => 'Email is already used.',
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
						'designation' => $this->input->post('designation'),
						'email' => $this->input->post('email'),
						'property_unit_master_id' => 9999,
						'gender' => $this->input->post('gender'),
						'contact_no' => $this->input->post('contact_no'),
						'status' => $this->input->post('status'),
						'updated_by' => $this->admin_session_data['user_id'],
						'updated_ts' => date('Y-m-d H:i:s')
					);
		
					if(!empty($this->input->post('password'))){
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
						
						$cost_center_id = $this->input->post('cost_center_id');
						if(!empty($cost_center_id)){
							$this->mcommon->delete('user_pos_mapping', array('user_id' => $user_id));
							foreach($cost_center_id as $c_id){
								$ccd = $this->mcommon->getRow('cost_center_master', array('cost_center_id' => $c_id));
								$user_pos_data = array(
									'user_id' => $user_id,
									'property_id' => $ccd['property_id'],
									'cost_center_id' => $c_id,
								);
								$this->mcommon->insert('user_pos_mapping', $user_pos_data);
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
				
			}
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
	
	public function getPos(){
		if($this->input->post()){
			$return_data = array();
			
			$property_ids = $this->input->post('property_ids');
			$property_id_comma_seperated = implode(',', $property_ids);
			
			$posData = $this->muser->get_pos($property_id_comma_seperated);
			
			$return_data = array('status' => true, 'lists'=>$posData);
			echo json_encode($return_data);
		}
	}
}
