<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Enquiry extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/menquiry');
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
		$data = array('menu_id'=> 29);
		$data['enquirys'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['enquirys'] = $this->menquiry->get_enquiry();
		}
		// print_r($data['fieldunits']);die;
		$data['content'] = 'admin/enquiry/list';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function reply_email()
	{
		$enquiry_id = $this->input->post('enquiry_id');
		$customer_name = $this->input->post('customer_name');
		$customer_email = $this->input->post('customer_email');
		$reply_subject = $this->input->post('reply_subject');
		$reply_message = $this->input->post('reply_message');
		
		$data = array(
			'reply_subject' => $reply_subject,
			'reply_message' => $reply_message,
			'reply_date' => date('Y-m-d'),
			'replied_by' => $this->admin_session_data['user_id']
		);

		$condition = array('enquiry_id' => $enquiry_id);

        $result = $this->menquiry->update_data($condition, $data);
		
		if($result){
		
			$config = email_config(); 
			$email_from = $config['email_from'];
			unset($config['email_from']);
	
			$subject = $reply_subject;
	
			$message = 'Hi '.$customer_name.',
						
'.$reply_message.'
			
Panchayat Tourism
Department of Panchayat & Rural Development
Government of West Bengal';
	
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from($email_from,EMAIL_FROM_NAME); // change it to yours
			$this->email->to($customer_email); // change it to yours 
	
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();
			
			$this->session->set_flashdata('success_msg', 'Replied successfully.');
			redirect("admin/enquiry");
		
		}
	}
	

}
