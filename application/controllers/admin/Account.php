<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/maccount');
		$this->load->model('admin/mproperty');
		$this->load->model('admin/muser');
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
		//b487b2684798ced3143a3eef8a82ae8f | b487b2684798ced3143a3eef8a82ae8f
		$data['districts'] = $this->maccount->get_district();
		$data['states'] = $this->maccount->get_state();
		$data['zilla_parishads'] = $this->mproperty->get_property_unit(array('parent_unit_id' => 0));
		$data['user_details'] = $this->maccount->get_user_details($this->admin_session_data['user_id']);
		$data['user'] = $this->muser->edit_user($this->admin_session_data['user_id']);
		
		$data['roles'] = $this->muser->get_role();
		$data['content'] = 'admin/account/list';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function updateaccount($user_id = '')
	{
		if($this->input->post()){
			$this->form_validation->set_rules('full_name','Full Name','trim|required|regex_match[/^([a-z ])+$/i]');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('contact_no','Mobile','trim|required|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required|in_list[Male,Female,Other]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/account");
			}
			else {
				
				$can_proceed = true;
				$where = array(
					'ma.email' => $this->input->post('email'),
					'ma.status <>' => 2,
					'ma.user_id <>' => $user_id
				);
				$has_useremail = $this->muser->get_user($where);
				if(!empty($has_useremail)){
					$can_proceed = false;
					$this->session->set_flashdata('error_msg', 'Email is already used.');
					// $response = array(
					// 	'success' => FALSE,
					// 	'message' => 'Email is already used.',
					// );
					// echo json_encode($response); exit;
				}
		
				/*$where = array(
					'ma.user_name' => $this->input->post('user_name'),
					'ma.status <>' => 2,
					'ma.user_id <>' => $user_id
				);
				$has_username = $this->muser->get_user($where);
				if($can_proceed && !empty($has_username)){
					$can_proceed = false;
					$this->session->set_flashdata('error_msg', 'Username is already used.');
					// $response = array(
					// 	'success' => FALSE,
					// 	'message' => 'Username is already used.',
					// );
					// echo json_encode($response); exit;
				}*/
				if($can_proceed){
					$data = array(
						'full_name' => $this->input->post('full_name'),
						'user_name' => $this->input->post('user_name'),
						'email' => $this->input->post('email'),
						'gender' => $this->input->post('gender'),
						'contact_no' => $this->input->post('contact_no'),
						'updated_by' => $this->admin_session_data['user_id'],
						'updated_ts' => date('Y-m-d H:i:s')
					);
		
					if(!empty($_FILES['user_image']['name'])){
						// Upload folder location***
						$config['upload_path'] = './public/admin_images/user_images';
						// Allowed file type***
						$config['allowed_types'] = '*';
						$config['encrypt_name'] = TRUE;
						// load upload library***            
						$this->load->library('upload', $config);
						
						$profile_pic_old = $this->input->post('profile_pic_old');
						if ($this->upload->do_upload('user_image')) {
							$data['user_image'] = $this->upload->data()['file_name'];
							@unlink('./public/admin_images/user_images/' . $profile_pic_old);
						} else {
							$data['user_image'] = $profile_pic_old;
						}
					}
		
					$condition = array('user_id' => $user_id);
					$result = $this->muser->update_user($condition, $data);
		
					if ($result) {
						if(isset($data['user_image']) && !empty($data['user_image'])){
							$user_data_set = $this->session->userdata('admin');
							$user_data_set['user_image'] = $data['user_image'];
							$this->session->set_userdata('admin', $user_data_set);
						}
						$this->session->set_flashdata('success_msg', 'User Updated Successfully');
						redirect("admin/account");
					}
				}else{
					redirect("admin/account");
				}
				
			}
		}
		
	}

}
