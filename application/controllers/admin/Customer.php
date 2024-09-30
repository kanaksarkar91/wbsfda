<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mcustomer');
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
		$data = array('menu_id'=> 21);
		$data['customers'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['customers'] = $this->mcustomer->get_customer();
		}
		// print_r($data['banners']);die;
		$data['content'] = 'admin/customer_master/list';
		$this->load->view('admin/layouts/index', $data);
	}

	public function edit_customer($customer_id)
	{
		$data['customer'] = $this->mcustomer->edit_customer($customer_id);
		$data['content'] = 'admin/customer_master/edit';
		$this->load->view('admin/layouts/index', $data);
	}

	public function updatecustomer()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('customer_title','Title','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('first_name','Name','trim|required|regex_match[/^([a-z ])+$/i]');
			$this->form_validation->set_rules('mobile_country_code','Country Code','trim|required|numeric');
			$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('address','Address','trim|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('city','City/Village','trim|regex_match[/^([a-z ])+$/i]');
			$this->form_validation->set_rules('pincode','Pin Code','trim|required|numeric|min_length[6]|max_length[6]');
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,0]');
			
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/customer");
			}
			else {
				$customer_id = $this->input->post('customer_id');
				$profile_pic_old = $this->input->post('profile_pic_old');
				$customer_title = $this->input->post('customer_title');
				$first_name = $this->input->post('first_name');
				$middle_name = $this->input->post('middle_name');
				$last_name = $this->input->post('last_name');
				$dob = $this->input->post('dob');
				$mobile_country_code = $this->input->post('mobile_country_code');
				$mobile = $this->input->post('mobile');
				$email = $this->input->post('email');
				$gender = $this->input->post('gender');
				$address = $this->input->post('address');
				$city = $this->input->post('city');
				$pincode = $this->input->post('pincode');
				$signup_date = $this->input->post('signup_date');
				$is_active = $this->input->post('is_active');
				$data = array(
					'customer_title' => $customer_title,
					'first_name' => $first_name,
					'middle_name' => $middle_name,
					'last_name' => $last_name,
					'dob' => date('Y-m-d',strtotime($dob)),
					'mobile_country_code' => $mobile_country_code,
					'mobile' => $mobile,
					'email' => $email,
					'gender' => $gender,
					'address' => $address,
					'city' => $city,
					'pincode' => $pincode,
					'signup_date' => date('Y-m-d',strtotime($signup_date)),
					'is_active' => $is_active,
					'updated_by' => $this->admin_session_data['user_id'],
					'updated_ts' => date('Y-m-d H:i:s')
				);
				// Upload folder location***
				$config['upload_path'] = './public/customer_images';
				// Allowed file type***
				$config['allowed_types'] = '*';
				$config['encrypt_name'] = TRUE;
				// load upload library***            
				$this->load->library('upload', $config);
		
				if ($this->upload->do_upload('profile_pic')) {
					$data['profile_pic'] = $this->upload->data()['file_name'];
					@unlink('./public/customer_images/' . $profile_pic_old);
				} else {
					$data['profile_pic'] = $profile_pic_old;
				}
				$condition = array('customer_id' => $customer_id);
		
				$result = $this->mcustomer->update_customer($condition, $data);
		
				if ($result) {
					$this->session->set_flashdata('success_msg', 'Customer Updated Successfully');
					redirect("admin/customer");
				}
			}
		}
		
		
	}
}
