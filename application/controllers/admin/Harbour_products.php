<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Harbour_products extends MY_Controller
{
	//private $menu_id;
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/mharbour_products', 'mcommon'));
		//$this->menu_id = 24;

	}


	public function index()
	{	

		//$curUser = $this->admin_session_data['user_id'];
		
		$data['product_list'] = $this->mharbour_products->hurbor_product_list();

		$data['content'] = 'admin/harbour_product/list';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function add_product()
	{	
		if($this->input->post()){
			$this->form_validation->set_rules('product_name','Name','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('uom_id', 'UOM', 'trim|required|numeric');
			$this->form_validation->set_rules('product_type', 'Type', 'trim|required|in_list[P,F]');
			
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/harbour_products");
			}
			else {
				$uomarray = array(
					'harbour_product_name' => $this->input->post('product_name'),
					'uom_id'=> $this->input->post('uom_id'),
					'product_type'=> $this->input->post('product_type'),
					'created_by' => $this->admin_session_data['user_id']
				);
	
				$result = $this->mharbour_products->uom_insert($uomarray);
	
				if($result){
	
					if($this->input->post('product_type') == 'P'){
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Harbour Product Successfully Submitted.</div>');
						redirect("admin/harbour_products");
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Harbour Facility Successfully Submitted.</div>');
						redirect("admin/harbour_products");
					}				
					
				} else {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
					redirect("admin/harbour_products");
				}
			}
		}

		$data['uom_list'] = $this->mharbour_products->uom_list();

		$data['content'] = 'admin/harbour_product/add';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function edit_product($productId)
	{	
		if($this->input->post()){
			$this->form_validation->set_rules('product_name','Name','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('uom_id', 'UOM', 'trim|required|numeric');
			$this->form_validation->set_rules('product_type', 'Type', 'trim|required|in_list[P,F]');
			
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/harbour_products");
			}
			else {
				$product_id = $this->input->post('product_id');

				$uomarray = array(
					'harbour_product_name' => $this->input->post('product_name'),
					'uom_id'=> $this->input->post('uom_id'),
					'product_type'=> $this->input->post('product_type'),
					'updated_by' => $this->admin_session_data['user_id']
				);
	
				$result = $this->mharbour_products->uom_update($uomarray,$product_id);
	
				if($result){
	
					if($this->input->post('product_type') == 'P'){
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Harbour Product Successfully Updated.</div>');
						redirect("admin/harbour_products");
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Harbour Facility Successfully Updated.</div>');
						redirect("admin/harbour_products");
					}				
					
				} else {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
					redirect("admin/harbour_products");
				}
			}
		}

		$data['product_details'] = $this->mharbour_products->product_details($productId);

		$data['uom_list'] = $this->mharbour_products->uom_list();

		$data['content'] = 'admin/harbour_product/edit';
		$this->load->view('admin/layouts/index', $data); 
	}


}
