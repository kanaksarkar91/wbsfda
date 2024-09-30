<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mcommon');
	}

	public function aboutUs() {
		$data = array();
		$data['content'] = 'frontend/pages/aboutUs';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function BoardOfDirectors() {
		$data = array();
		$data['content'] = 'frontend/pages/boardOfDirectors';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function keyManagerialPersonnel() {
		$data = array();
		$data['content'] = 'frontend/pages/keyManagerialPersonnel';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function history() {
		$data = array();
		$data['content'] = 'frontend/pages/history';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function ourObjective() {
		$data = array();
		$data['content'] = 'frontend/pages/ourObjective';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function annualReports() {
		$data = array();
		$data['content'] = 'frontend/pages/annualReports';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function activityChart() {
		$data = array();
		$data['content'] = 'frontend/pages/activityChart';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function privacyPolicy() {
		$data = array();
		$data['content'] = 'frontend/pages/privacyPolicy';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function termsConditionGuestHouseBooking() {
		$data = array();
		$data['content'] = 'frontend/pages/termsConditionGuestHouseBooking';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function generalTermsCondition() {
		$data = array();
		$data['content'] = 'frontend/pages/generalTermsCondition';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function depositWorkProject() {
		$data = array();
		$data['content'] = 'frontend/pages/depositWorkProject';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function fisheryProjects() {
		$data = array();
		$data['content'] = 'frontend/pages/fisheryProjects';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function learnAboutPisciculture() {
		$data = array();
		$data['content'] = 'frontend/pages/learnAboutPisciculture';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function fishSaleWholesaleRetail() {
		$data = array();
		$data['content'] = 'frontend/pages/fishSaleWholesaleRetail';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function briefReportsCulture() {
		$data = array();
		$data['content'] = 'frontend/pages/briefReportsCulture';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function glimpseMajorWork() {
		$data = array();
		$data['content'] = 'frontend/pages/glimpseMajorWork';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function departments() {
		$data = array();
		$data['content'] = 'frontend/pages/departments';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function officeOrders() {
		$data = array();
		$data['content'] = 'frontend/pages/officeOrders';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function organisationChart() {
		$data = array();
		$data['content'] = 'frontend/pages/organisationChart';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function recruitments() {
		$data = array();
		$data['content'] = 'frontend/pages/recruitments';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function headOfficeContact() {
		$data = array();
		$data['content'] = 'frontend/pages/headOfficeContact';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function guestHouseContact() {
		$data = array();
		$data['content'] = 'frontend/pages/guestHouseContact';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function photoGallery() {
		$data = array();
		$data['content'] = 'frontend/pages/photoGallery';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function videoGallery() {
		$data = array();
		$data['content'] = 'frontend/pages/videoGallery';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function pressRelease() {
		$data = array();
		$data['content'] = 'frontend/pages/pressRelease';
		$this->load->view('frontend/layouts/index', $data);
	}
	public function tenders() {
		$data = array();
		$data['content'] = 'frontend/pages/tenders';
		$this->load->view('frontend/layouts/index', $data);
	}

	public function submitenquiryform()
	{
			$customer_name=$this->input->post('customer_name');
			$customer_phone=$this->input->post('customer_phone');
			$customer_email=$this->input->post('customer_email');
			$mail_subject=$this->input->post('mail_subject');
			$mail_message=$this->input->post('mail_message');
			$data = array(
				'customer_name' => $customer_name,
				'customer_phone' => $customer_phone,
				'customer_email' => $customer_email,
				'mail_subject' => $mail_subject,
				'mail_message' => $mail_message
			);
			$result = $this->mcommon->insert('enquiry_details', $data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Thank you so much for contacting with us. We will get back to you soon.');
			}else{
				$this->session->set_flashdata('error_msg', 'Oops ! Something went wrong');
			}
			redirect("frontend/pages/contactUs");
	}


}
