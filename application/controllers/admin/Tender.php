<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tender extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mtender');
	}


    public function index()
	{

        $data = array('menu_id'=> 87);

        $data['tender_list'] = $this->mtender->tender_list();
		
		$data['content'] = 'admin/tender/tender_list';
		$this->load->view('admin/layouts/index', $data);
	}


    public function add_tender()
	{

        $curUser = $this->admin_session_data['user_id'];
		$curRole = $this->admin_session_data['role_id'];

        $data = array();

        if($this->input->post()){
			
			$this->form_validation->set_rules('tender_title','Title','trim|required');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/tender");
			}
			else {
				$_FILES['file']['name'] = $_FILES['tender_file']['name'];			  
				$_FILES['file']['type'] = $_FILES['tender_file']['type'];			  
				$_FILES['file']['tmp_name'] = $_FILES['tender_file']['tmp_name'];			  
				$_FILES['file']['error'] = $_FILES['tender_file']['error'];			  
				$_FILES['file']['size'] = $_FILES['tender_file']['size'];
	
				$config['upload_path']          = './public/tender_images';
				$config['allowed_types']        = 'pdf';
				$config['max_size']             = 5000;
				//$config['encrypt_name'] = TRUE;
				//$config['max_width']            = 1024;
				//$config['max_height']           = 768;
	
				$this->load->library('upload', $config);				
	
				if ($this->upload->do_upload('file')) {
					$uploadData = $this->upload->data();			  
					$filename = $uploadData['file_name'];
	
					$fileName =  $filename;
				} else {
					//echo $this->upload->display_errors();
				}
	
				$data = array(
					'tender_title' => $this->input->post('tender_title'),
					'tender_file' => $fileName,
					'created_by' => $curUser
				);
	
				$this->mtender->add_tender($data);
	
				$this->session->set_flashdata('success_msg', '<div class="alert alert-success alert-dismissible">Tender Successfully Submitted.</div>');
				redirect("admin/tender");
			}

            

        } else {

            $data['content'] = 'admin/tender/add_tender';
		    $this->load->view('admin/layouts/index', $data);

        }        

    }


    public function delete_tender($tenderId)
	{

        $result = $this->mtender->delete_tender($tenderId);

        if($result){

            $this->session->set_flashdata('success_msg', 'Tender Successfully Deleted.');
            redirect("admin/tender");

        } else {

            $this->session->set_flashdata('error_msg', 'Something is wrong. Try again.');
            redirect("admin/tender");

        }

    }

}