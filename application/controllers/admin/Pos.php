<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pos extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('mcommon', 'admin/mpos', 'admin/mproperty', 'admin/muser'));
	}
	
	public function index($value1 = null)
	{
		$link_arr = !is_null($value1) ? unserialize($this->encryption->decrypt(base64_decode($value1))) : array();
		$link_condn = isset($link_arr['link_condn']) ? $link_arr['link_condn'] : NULL;
		
		if (isset($_POST['search'])) {
			$property_id = $this->input->post('property_id');
			
			$search_condn = array();
			$search_condn = $property_id != '' ? array_merge($search_condn, array('property_id' => $property_id)) : $search_condn;
			
			$value1 = base64_encode($this->encryption->encrypt(serialize(array('link_condn' => $search_condn))));
			
			redirect(base_url('admin/pos/index/' . $value1));
		}
		
		$data = array('menu_id'=> 52);
		$data['pos'] = array();
		
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1, 'property_master.p_type' => 'G')) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		if (isset($link_condn['property_id']) && !is_null($link_condn['property_id'])) {
			$condn['property_master.property_id'] = $link_condn['property_id'];
			$data['d_property_id'] = $link_condn['property_id'];
		}
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN){
			$data['pos'] = $this->mpos->get_pos_list($condn);
		}else{
			if(check_user_permission($data['menu_id'], 'delete_flag')){
				$parent_properties = $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$parent_properties = !empty($parent_properties) ? array_column($parent_properties, 'property_id') : array();
				if(!empty($parent_properties)){
					$data['pos'] = $this->mpos->get_pos_list_property_id($parent_properties);
				}
			}
		}
		//echo '<pre>',print_r($data['property_details']);die;
		$data['content'] = 'admin/pos/list';
		$this->load->view('admin/layouts/index', $data);
	}

	public function addpos()
	{
		//echo $this->session_data['role_id'];
		$data = array();
		// $data['property_details'] = $this->maccommodation->get_property_details();
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1, 'property_master.p_type' => 'G')) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		// echo '<pre>';print_r($data); die;
		$data['content'] = 'admin/pos/add';
		$data['slug'] = 'pos';

		$this->load->view('admin/layouts/index', $data);
	}
	
	public function insertpos() {
		
		if($this->input->post()){
			$this->form_validation->set_rules('property_id','Property','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('is_it_pos', 'Is it a POS', 'trim|required|in_list[1,2]');
			$this->form_validation->set_rules('cost_center_name','POS Name','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('gstin','GSTIN','trim|required|alpha_numeric_spaces');
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,0]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/pos");
			}
			else {
				$is_it_pos = $this->input->post('is_it_pos');
				$cost_center_name = $this->input->post('cost_center_name');
				$property_id = $this->input->post('property_id');
				$gstin = $this->input->post('gstin');
				$fssai = $this->input->post('fssai');
				$status = $this->input->post('is_active');
				
				$csDataFound = $this->mcommon->getRow('cost_center_master', array('property_id'=>$property_id, 'cost_center_name' =>$cost_center_name));
				
				if(!$csDataFound) {
		
					$data = array(
						'is_it_pos' => $is_it_pos,
						'cost_center_name' => $cost_center_name,
						'property_id' => $property_id,
						'gstin' => $gstin,
						'fssai' => $fssai,
						'is_active' => $status,
						'created_by' => $this->admin_session_data['user_id'],
						'created_ts' => date('Y-m-d H:i:s')
					);
					 //echo '<pre>';print_r($data);die;
					$result = $this->mcommon->insert('cost_center_master', $data);
					if ($result) {
						$this->session->set_flashdata('success_msg', 'POS Added Successfully');
						redirect("admin/pos");
					}
					
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate POS Found In Same Property.');
					redirect("admin/pos");
				}
			}
		}
	
	}

	public function editpos($costCenterId)
	{
		$cost_center_id = decode_url($costCenterId);
		
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1, 'property_master.p_type' => 'G')) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['pos'] = $this->mcommon->getRow('cost_center_master', array('cost_center_id' => $cost_center_id));
		$data['content'] = 'admin/pos/edit';
		$data['slug'] = 'pos';
		$this->load->view('admin/layouts/index', $data);
	}

	public function updatepos()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('property_id','Property','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('is_it_pos', 'Is it a POS', 'trim|required|in_list[1,2]');
			$this->form_validation->set_rules('cost_center_name','POS Name','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('gstin','GSTIN','trim|required|alpha_numeric_spaces');
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,0]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/pos");
			}
			else {
				
				$cost_center_id = decode_url($this->input->post('cost_center_id'));
				$is_it_pos = $this->input->post('is_it_pos');
				$cost_center_name = $this->input->post('cost_center_name');
				$property_id = $this->input->post('property_id');
				$gstin = $this->input->post('gstin');
				$fssai = $this->input->post('fssai');
				$status = $this->input->post('is_active');
				
				$csDataFound = $this->mcommon->getRow('cost_center_master', array('cost_center_id !=' => $cost_center_id, 'cost_center_name'=>$cost_center_name, 'property_id' =>$property_id));
				
				if(!$csDataFound) {
					
					$data = array(
						'is_it_pos' => $is_it_pos,
						'cost_center_name' => $cost_center_name,
						'property_id' => $property_id,
						'gstin' => $gstin,
						'fssai' => $fssai,
						'is_active' => $status,
						'updated_by' => $this->admin_session_data['user_id'],
						'updated_ts' => date('Y-m-d H:i:s')
					);
			
					$condition = array('cost_center_id' => $cost_center_id);
					
					$result = $this->mcommon->update('cost_center_master', $condition, $data);
					
					if ($result) {
						$this->session->set_flashdata('success_msg', 'POS Updated Successfully');
						redirect("admin/pos");
					}
					
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate POS Found In Same Property.');
					redirect("admin/pos");
				}
				
			}
		}
		
	}
	
	/*For POS Category*/
	public function category($value1 = null)
	{
		$link_arr = !is_null($value1) ? unserialize($this->encryption->decrypt(base64_decode($value1))) : array();
		$link_condn = isset($link_arr['link_condn']) ? $link_arr['link_condn'] : NULL;
		
		if (isset($_POST['search'])) {
			$property_id = $this->input->post('property_id');
			
			$search_condn = array();
			$search_condn = $property_id != '' ? array_merge($search_condn, array('property_id' => $property_id)) : $search_condn;
			
			$value1 = base64_encode($this->encryption->encrypt(serialize(array('link_condn' => $search_condn))));
			
			redirect(base_url('admin/pos/category/' . $value1));
		}
		
		$data = array('menu_id'=> 53);
		$data['categories'] = array();
		
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1, 'property_master.p_type' => 'G')) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		if (isset($link_condn['property_id']) && !is_null($link_condn['property_id'])) {
			$condn['property_master.property_id'] = $link_condn['property_id'];
			$data['d_property_id'] = $link_condn['property_id'];
		}
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN){
			$data['categories'] = $this->mpos->get_pos_category_list($condn);
		}else{
			if(check_user_permission($data['menu_id'], 'delete_flag')){
				$parent_properties = $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$parent_properties = !empty($parent_properties) ? array_column($parent_properties, 'property_id') : array();
				if(!empty($parent_properties)){
					$data['categories'] = $this->mpos->get_pos_category_list_property_id($parent_properties);
				}
			}
		}
		 //echo '<pre>',print_r($data['categories']);die;
		$data['content'] = 'admin/pos/category/list';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function addcategory()
	{
		//echo $this->session_data['role_id'];
		$data = array();
		// $data['property_details'] = $this->maccommodation->get_property_details();
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1, 'property_master.p_type' => 'G')) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		// echo '<pre>';print_r($data); die;
		$data['content'] = 'admin/pos/category/add';
		$data['slug'] = 'category';

		$this->load->view('admin/layouts/index', $data);
	}
	
	public function insertposcategory() {
		
		if($this->input->post()){
			$this->form_validation->set_rules('property_id','Property','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('cost_center_id','POS','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('category_name','Category Name','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('category_flag', 'Category', 'trim|required|in_list[P,S]');
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,0]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/pos/category");
			}
			else {
				
				$category_name = $this->input->post('category_name');
				$property_id = $this->input->post('property_id');
				$cost_center_id = $this->input->post('cost_center_id');
				$category_flag = $this->input->post('category_flag');
				$status = $this->input->post('is_active');
				
				$cateDataFound = $this->mcommon->getRow('category_master', array('property_id'=>$property_id, 'cost_center_id' => $cost_center_id, 'category_name' =>$category_name));
				
				if(!$cateDataFound) {
		
					$data = array(
						'category_name' => $category_name,
						'property_id' => $property_id,
						'cost_center_id' => $cost_center_id,
						'category_flag' => $category_flag,
						'is_active' => $status,
						'created_by' => $this->admin_session_data['user_id'],
						'created_ts' => date('Y-m-d H:i:s')
					);
					 //echo '<pre>';print_r($data);die;
					$result = $this->mcommon->insert('category_master', $data);
					if ($result) {
						$this->session->set_flashdata('success_msg', 'Category Added Successfully');
						redirect("admin/pos/category");
					}
					
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate Category Found In Same Property.');
					redirect("admin/pos/category");
				}
			}
		}
	
	}
	
	public function editcategory($categoryId)
	{
		$category_id = decode_url($categoryId);
		
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1, 'property_master.p_type' => 'G')) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['category'] = $this->mcommon->getRow('category_master', array('category_id' => $category_id));
		$data['cost_centers'] = $this->mcommon->getDetails('cost_center_master', array('property_id' => $data['category']['property_id']));
		$data['content'] = 'admin/pos/category/edit';
		$data['slug'] = 'pos';
		$this->load->view('admin/layouts/index', $data);
	}

	public function updateposcategory()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('property_id','Property','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('cost_center_id','POS','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('category_name','Category Name','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('category_flag', 'Category', 'trim|required|in_list[P,S]');
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,0]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/pos/category");
			}
			else {
				
				$category_id = decode_url($this->input->post('category_id'));
				$category_name = $this->input->post('category_name');
				$property_id = $this->input->post('property_id');
				$cost_center_id = $this->input->post('cost_center_id');
				$category_flag = $this->input->post('category_flag');
				$status = $this->input->post('is_active');
				
				$cateDataFound = $this->mcommon->getRow('category_master', array('category_id !=' => $category_id, 'category_name'=>$category_name, 'property_id' =>$property_id, 'cost_center_id' => $cost_center_id));
				
				if(!$cateDataFound) {
					
					$data = array(
						'category_name' => $category_name,
						'property_id' => $property_id,
						'cost_center_id' => $cost_center_id,
						'category_flag' => $category_flag,
						'is_active' => $status,
						'updated_by' => $this->admin_session_data['user_id'],
						'updated_ts' => date('Y-m-d H:i:s')
					);
			
					$condition = array('category_id' => $category_id);
					
					$result = $this->mcommon->update('category_master', $condition, $data);
					
					if ($result) {
						$this->session->set_flashdata('success_msg', 'Category Updated Successfully');
						redirect("admin/pos/category");
					}
					
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate Category Found In Same Property.');
					redirect("admin/pos/category");
				}
				
			}
		}
		
	}
	/*End For POS Category*/
	
	
	/*For POS Product & Service*/
	public function product_service($value1 = null)
	{
		$link_arr = !is_null($value1) ? unserialize($this->encryption->decrypt(base64_decode($value1))) : array();
		$link_condn = isset($link_arr['link_condn']) ? $link_arr['link_condn'] : NULL;
		
		if (isset($_POST['search'])) {
			$property_id = $this->input->post('property_id');
			
			$search_condn = array();
			$search_condn = $property_id != '' ? array_merge($search_condn, array('property_id' => $property_id)) : $search_condn;
			
			$value1 = base64_encode($this->encryption->encrypt(serialize(array('link_condn' => $search_condn))));
			
			redirect(base_url('admin/pos/product_service/' . $value1));
		}
		
		$data = array('menu_id'=> 54);
		$data['products'] = array();
		
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1, 'property_master.p_type' => 'G')) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		if (isset($link_condn['property_id']) && !is_null($link_condn['property_id'])) {
			$condn['property_master.property_id'] = $link_condn['property_id'];
			$data['d_property_id'] = $link_condn['property_id'];
		}
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN){
			$data['products'] = $this->mpos->get_product_service_list($condn);
		}else{
			if(check_user_permission($data['menu_id'], 'delete_flag')){
				$parent_properties = $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$parent_properties = !empty($parent_properties) ? array_column($parent_properties, 'property_id') : array();
				if(!empty($parent_properties)){
					$data['products'] = $this->mpos->get_product_service_list_property_id($parent_properties);
				}
			}
		}
		// echo '<pre>',print_r($data['accommodation']);die;
		$data['content'] = 'admin/pos/product_service/list';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function addproductservice()
	{
		//echo $this->session_data['role_id'];
		$data = array();
		// $data['property_details'] = $this->maccommodation->get_property_details();
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1, 'property_master.p_type' => 'G')) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['uoms'] = $this->mcommon->getDetails('uom_master', array('is_active' => '1'));
		// echo '<pre>';print_r($data); die;
		$data['content'] = 'admin/pos/product_service/add';
		$data['slug'] = 'product';

		$this->load->view('admin/layouts/index', $data);
	}
	
	public function insertproductservice() {
		
		if($this->input->post()){
			$this->form_validation->set_rules('property_id','Property','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('product_service_flag', 'Product/Service', 'trim|required|in_list[P,S]');
			$this->form_validation->set_rules('category_id','Category','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('product_service_name','Product/Service Name','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('uom_id','Unit of Measurement','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,0]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/pos/product_service");
			}
			else {
				
				$property_id = $this->input->post('property_id');
				$product_service_flag = $this->input->post('product_service_flag');
				$category_id = $this->input->post('category_id');
				$product_service_name = $this->input->post('product_service_name');
				$uom_id = $this->input->post('uom_id');
				$status = $this->input->post('is_active');
				
				$productDataFound = $this->mcommon->getRow('product_service_master', array('property_id'=>$property_id, 'category_id' => $category_id, 'product_service_name' =>$product_service_name));
				
				if(!$productDataFound) {
		
					$data = array(
						'property_id' => $property_id,
						'product_service_flag' => $product_service_flag,
						'category_id' => $category_id,
						'product_service_name' => $product_service_name,
						'uom_id' => $uom_id,
						'is_active' => $status,
						'created_by' => $this->admin_session_data['user_id'],
						'created_ts' => date('Y-m-d H:i:s')
					);
					 //echo '<pre>';print_r($data);die;
					$result = $this->mcommon->insert('product_service_master', $data);
					if ($result) {
						$product_service_code = $product_service_flag.str_pad($result,4,"0",STR_PAD_LEFT);
						$this->mcommon->update('product_service_master', array('product_service_id' => $result), array('product_service_code' => $product_service_code));
						$this->session->set_flashdata('success_msg', 'Product/Service Added Successfully');
						redirect("admin/pos/product_service");
					}
					
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate Product/Service Found In Same Category.');
					redirect("admin/pos/product_service");
				}
			}
		}
	
	}
	
	public function editproductservice($productServiceId)
	{
		$product_service_id = decode_url($productServiceId);
		
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1, 'property_master.p_type' => 'G')) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['uoms'] = $this->mcommon->getDetails('uom_master', array('is_active' => '1'));
		$data['product_service'] = $this->mcommon->getRow('product_service_master', array('product_service_id' => $product_service_id));
		$data['categories'] = $this->mcommon->getDetails('category_master', array('category_flag' => $data['product_service']['product_service_flag'], 'is_active' => '1'));
		$data['content'] = 'admin/pos/product_service/edit';
		$data['slug'] = 'product';
		$this->load->view('admin/layouts/index', $data);
	}

	public function updateproductservice()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('property_id','Property','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('product_service_flag', 'Product/Service', 'trim|required|in_list[P,S]');
			$this->form_validation->set_rules('category_id','Category','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('product_service_name','Product/Service Name','trim|required|callback_check_textbox_with_some_special_character');
			$this->form_validation->set_rules('uom_id','Unit of Measurement','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,0]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/pos/product_service");
			}
			else {
				
				$product_service_id = decode_url($this->input->post('product_service_id'));
				$property_id = $this->input->post('property_id');
				$product_service_flag = $this->input->post('product_service_flag');
				$category_id = $this->input->post('category_id');
				$product_service_name = $this->input->post('product_service_name');
				$uom_id = $this->input->post('uom_id');
				$status = $this->input->post('is_active');
				
				$productDataFound = $this->mcommon->getRow('product_service_master', array('product_service_id !=' => $product_service_id, 'product_service_name'=>$product_service_name, 'property_id' =>$property_id, 'category_id' => $category_id));
				
				if(!$cateDataFound) {
					
					$data = array(
						'property_id' => $property_id,
						'product_service_flag' => $product_service_flag,
						'category_id' => $category_id,
						'product_service_name' => $product_service_name,
						'uom_id' => $uom_id,
						'is_active' => $status,
						'updated_by' => $this->admin_session_data['user_id'],
						'updated_ts' => date('Y-m-d H:i:s')
					);
			
					$condition = array('product_service_id' => $product_service_id);
					
					$result = $this->mcommon->update('product_service_master', $condition, $data);
					
					if ($result) {
						$this->session->set_flashdata('success_msg', 'Product/Service Updated Successfully');
						redirect("admin/pos/product_service");
					}
					
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate Product/Service Found In Same Category.');
					redirect("admin/pos/product_service");
				}
				
			}
		}
		
	}
	
	public function getCategoryFlagWise(){
		if($this->input->post()){
			$return_data = array();
			$category_flag = $this->input->post('category_flag');
			$property_id = $this->input->post('property_id');
			$categoryData = $this->mcommon->getDetails('category_master', array('category_flag' => $category_flag, 'property_id' => $property_id, 'is_active' => '1'));
			if(!empty($categoryData)){
				$return_data = array("status"=>true,"categorylist"=>$categoryData);
			}
			else{
				$return_data = array("status"=>false);
			}
			
			echo json_encode($return_data);
		}
	}
	/*End For POS Product & Service*/
	
	
	/*For Product & Service Sale Rate*/
	public function sale_rate($productServiceId)
	{
		$data = array('menu_id'=> 54);
		$data['ps_sale_rates'] = array();
		$product_service_id = decode_url($productServiceId);
		
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['product_service'] = $this->mcommon->getRow('product_service_master', array('product_service_id' => $product_service_id));
			$data['ps_sale_rates'] = $this->mpos->get_product_service_sale_rate_list(array('product_service_sale_rate.product_service_id' => $product_service_id));
			$data['cost_centers'] = $this->mcommon->getDetails('cost_center_master', array('property_id' => $data['product_service']['property_id']));
		}
		//print_r($data['cost_centers']);die;
		$data['content'] = 'admin/pos/product_service/sale_rate';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function insertsalerate() {
		
		if($this->input->post()){
			$this->form_validation->set_rules('cost_center_id','POS','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('rate', 'Rate', 'trim|required');
			$this->form_validation->set_rules('is_taxable','Taxable','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('tax_id','Tax','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('sac_code_id','SAC Code','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/pos/sale_rate/".$this->input->post('product_service_id'));
			}
			else {
				$product_service_sale_rate_id = intval($this->input->post('product_service_sale_rate_id'));
				$product_service_id = decode_url($this->input->post('product_service_id'));
				$cost_center_id = $this->input->post('cost_center_id');
				$rate = $this->input->post('rate');
				$is_taxable = $this->input->post('is_taxable');
				$tax_id = $this->input->post('tax_id');
				$sac_code_id = $this->input->post('sac_code_id');
				$eff_start_date = $this->input->post('eff_start_date');
				$eff_end_date = $this->input->post('eff_end_date');
				
				$check_cnt = $this->mpos->checkSaleRateData($this->input->post());
				
				if($check_cnt['cnt'] == 0){
					$data = array(
						'product_service_id' => $product_service_id,
						'cost_center_id' => $cost_center_id,
						'rate' => $rate,
						'is_taxable' => $is_taxable,
						'tax_id' => $tax_id,
						'sac_code_id' => $sac_code_id,
						'eff_start_date' => $eff_start_date,
						'eff_end_date' => ($eff_end_date != '') ? $eff_end_date : '9999-12-31'
					);
					 //echo '<pre>';print_r($data);die;
					 if($product_service_sale_rate_id != 0){
					 	$data['updated_by'] = $this->admin_session_data['user_id'];
						$data['updated_ts'] = date('Y-m-d H:i:s');
						$updated = $this->mcommon->update('product_service_sale_rate', array('product_service_sale_rate_id' => $product_service_sale_rate_id), $data);
						if ($updated) {
							$this->session->set_flashdata('success_msg', 'Sale Rate Updated Successfully');
							redirect("admin/pos/sale_rate/".$this->input->post('product_service_id'));
						}
					 }
					 else {
					 	$data['created_by'] = $this->admin_session_data['user_id'];
						$data['created_ts'] = date('Y-m-d H:i:s');
						$result = $this->mcommon->insert('product_service_sale_rate', $data);
						if ($result) {
							$this->session->set_flashdata('success_msg', 'Sale Rate Added Successfully');
							redirect("admin/pos/sale_rate/".$this->input->post('product_service_id'));
						}
					 }
					
				}
				else {
					$this->session->set_flashdata('error_msg', 'Rate conflicts with previous data for this Product/Service and the date range!!');
					redirect("admin/pos/sale_rate/".$this->input->post('product_service_id'));
				}
					
			}
		}
	
	}
	
	public function getTaxSacData(){
		if($this->input->post()){
			$taxWhere = array();
			$sacWhere = array();
			$return_data = array();
			$html_tax = '';
			$html_sac = '';
			
			$is_taxable = $this->input->post('is_taxable');
			
			if($is_taxable == 1){
				$taxWhere = array('tax_id != ' => 3, 'is_active' => '1');
				$sacWhere = array('sac_code_id != ' => 1, 'is_active' => '1');
			}
			else {
				$taxWhere = array('tax_id' => 3, 'is_active' => '1');
				$sacWhere = array('sac_code_id' => 1, 'is_active' => '1');
			}
			$taxData = $this->mcommon->getDetails('tax_master', $taxWhere);
			$sacData = $this->mcommon->getDetails('sac_code_master', $sacWhere);
			
			//for Tax dropdown
			if(!empty($taxData)){
				if($is_taxable == 1){
					$html_tax .= '<option value="">Please Select Tax Percentage</option>';
				}
				foreach($taxData as $row){
					$html_tax .= '<option value="'.$row['tax_id'].'">'.$row['tax_percentage'].'</option>';
				}
			}
			//end Tax dropdown
			
			
			//for SAC dropdown
			if(!empty($sacData)){
				if($is_taxable == 1){
					$html_sac .= '<option value="">Please Select SAC Code</option>';
				}
				foreach($sacData as $row2){
					$html_sac .= '<option value="'.$row2['sac_code_id'].'">'.$row2['sac_code'].'</option>';
				}
			}
			//end SAC dropdown
			
			$return_data = array("status"=>true, "tax_dropdown"=>$html_tax, "sac_dropdown"=>$html_sac);
			
			echo json_encode($return_data);
		}
	}
	
	public function getSaleRateData(){
		if($this->input->post()){
			$return_data = array();
			
			$product_service_sale_rate_id = $this->input->post('product_service_sale_rate_id');
			$details = $this->mcommon->getRow('product_service_sale_rate', array('product_service_sale_rate_id' => $product_service_sale_rate_id));
			
			$return_data = array('status' => true, 'edit_rate_data'=>$details);
			echo json_encode($return_data);
		}
	}
	
	public function getAjaxData(){
		if($this->input->post()){
			$return_data = array();
			
			$action_type = $this->input->post('action_type');
			$property_id = $this->input->post('property_id');
			$is_taxable = $this->input->post('is_taxable');
			
			if($action_type == 'cost_center_data'){
				$ret = $this->mcommon->getDetails('cost_center_master', array('property_id' => $property_id, 'is_active' => '1'));
				$return_data = array('status' => true, "cost_center_list"=>$ret);
			}
			
			if($action_type == 'tax_data'){
				if($is_taxable == 1){
					$ret = $this->mcommon->getDetails('tax_master', array('tax_id !=' => 3, 'is_active' => '1'));
				}
				else{
					$ret = $this->mcommon->getDetails('tax_master', array('tax_id' => 3, 'is_active' => '1'));
				}
				
				$return_data = array('status' => true, "tax_master_list"=>$ret);
			}
			
			if($action_type == 'sac_code_data'){
				if($is_taxable == 1){
					$ret = $this->mcommon->getDetails('sac_code_master', array('sac_code_id !=' => 1, 'is_active' => '1'));
				}
				else{
					$ret = $this->mcommon->getDetails('sac_code_master', array('sac_code_id' => 1, 'is_active' => '1'));
				}
				
				$return_data = array('status' => true, "sac_code_master_list"=>$ret);
			}
			
			if($action_type == 'pos_data'){
				$posData = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mcommon->getDetails('cost_center_master', array('property_id' => $property_id, 'is_active' => '1')) : $this->mpos->user_wise_pos($property_id,$this->admin_session_data['user_id']);
				
				$html = '';
				
				foreach($posData as $key=>$row){
					
					$div_card_class = ($key == 0) ? 'card bg-blue4 py-4' : (($key == 1) ? 'card bg-orng py-4' : (($key == 2) ? 'card bg-green py-4' : (($key == 3) ? 'card bg-orng3 py-4' : (($key == 4) ? 'card bg-blue3 py-4' : 'card bg-vl py-4'))));
					
					$html .= '<div class="col-md-4 text-center mb-3">
								<a href="'.base_url().'admin/pos/product_sale/'.encode_url($row['cost_center_id']).'/'.encode_url($property_id).'" style="text-decoration: none;">
									<div class="'.$div_card_class.'">
										<div class="card-body">
											<h4 class="mb-0 text-white">'.$row['cost_center_name'].'</h4>
											<p class=" text-white mb-0"><small>&nbsp;</small></p>
										</div>
									</div>
								</a>
							</div>';
					
				}
				
				$return_data = array('status' => true, "html"=>$html, "costCenterList"=>$posData);
			}
			
			echo json_encode($return_data);
		}
	}
	/*End For Product & Service Sale Rate*/
	
	
	/*For POS Sale*/
	public function pos_sale($value1 = null)
	{
		$data = array('menu_id'=> 55);
		$data['property_details'] = array();
		
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1, 'property_master.p_type' => 'G')) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
			
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				
			}
		}
		
		//print_r($data['property_details']);die;
		$data['content'] = 'admin/pos/pos_sale/list';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function product_sale($cost_center_id = 0, $property_id = 0)
	{
		$data = array();
		
		$data['cost_center_id'] = decode_url($cost_center_id);
		$data['property_id'] = decode_url($property_id);
		
		$data['costCenterData'] = $this->mcommon->getRow('cost_center_master', array('cost_center_id' => $data['cost_center_id']));
		/*$categoryData = $this->mcommon->getDetails('category_master', array('property_id' => $data['property_id'], 'is_active' => '1'));
		
		if(!empty($categoryData)){
			foreach($categoryData as $row){
				$productCountCatWise = $this->mpos->product_count($row['category_id']);
				
				$data['catData'][] = array(
					'category_id' => $row['category_id'],
					'category_name' => $row['category_name'],
					'productCount' => $productCountCatWise['tot_product']
				);
			}
		}
		else {
			$data['catData'] = array();
		}*/
		//echo '<pre>'; print_r($data['catData']); die;
		$data['content'] = 'admin/pos/pos_sale/product_sale';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function getCategoryList(){
		if($this->input->post()){
			$return_data = array();
			
			$query = $this->input->post('query');
			$property_id = $this->input->post('property_id');
			$cost_center_id = $this->input->post('cost_center_id');
			
			$categoryData = $this->mpos->getCatagories($property_id, $query, $cost_center_id);
		
			if(!empty($categoryData)){
				foreach($categoryData as $row){
					$productCountCatWise = $this->mpos->product_count($row['category_id']);
					
					$catData[] = array(
						'category_id' => $row['category_id'],
						'category_name' => $row['category_name'],
						'productCount' => $productCountCatWise['tot_product']
					);
				}
			}
			else {
				$catData = array();
			}
			//echo '<pre>'; print_r($catData); die;
			$return_data = array('status' => true, 'cat_list'=>$catData);
			echo json_encode($return_data);
		}
	}
	
	public function getProductServiceList(){
		if($this->input->post()){
			$return_data = array();
			
			$query = $this->input->post('query');
			$cost_center_id = $this->input->post('cost_center_id');
			$category_id = $this->input->post('category_id');
			
			$product_list = $this->mpos->getProductServiceList($cost_center_id, $query, $category_id);
			//echo '<pre>'; print_r($product_list); die;
			$return_data = array('status' => true, 'product_list'=>$product_list);
			echo json_encode($return_data);
		}
	}
	
	public function holdPos(){
		//echo '<pre>'; print_r($this->input->post()); die;
		if($this->input->post()){
			$return_data = array();
			$data_header = array();
			$data_details = array();
			$status = false;
			
			$selectedItems = $this->input->post('selectedItems');
			$table_no = $this->input->post('table_no');
			$sale_order_id = $this->input->post('sale_order_id');
			$cost_center_id = $this->input->post('cost_center_id');
			$property_id = $this->input->post('property_id');
			
			if($sale_order_id == ''){
			
				$data_header['order_no'] = 'SFDC'.time();
				$data_header['cost_center_id'] = $cost_center_id;
				$data_header['property_id'] = $property_id;
				$data_header['table_no'] = $table_no;
				$data_header['sale_flag'] = '1';
				$data_header['open_status'] = 0;
				$data_header['created_by'] = $this->admin_session_data['user_id'];
				$data_header['created_ts'] = date('Y-m-d H:i:s');
				$data_header['order_generate_time'] = date('Y-m-d H:i:s');
				
				$result_header = $this->mcommon->insert('pos_sale_header', $data_header);
				
				if($result_header){
					
					foreach($selectedItems as $item){
						$getProductSaleRate = $this->mpos->get_product_sale_rate($item['product_service_id'], $cost_center_id);
						
						$data_details['sale_order_id'] = $result_header;
						$data_details['product_service_id'] = $item['product_service_id'];
						$data_details['quantity'] = $item['qty'];
						$data_details['uom_id'] = $item['uom_id'];
						$data_details['rate'] = $item['price'];
						$data_details['price'] = ($item['price'] * $item['qty']);
						$data_details['taxable_amount'] = (($getProductSaleRate['tax_percentage'] * $data_details['price']) / 100);
						$data_details['cgst_percent'] = $getProductSaleRate['cgst_percentage'];
						$data_details['sgst_percent'] = $getProductSaleRate['sgst_percentage'];
						$data_details['igst_percent'] = $getProductSaleRate['tax_percentage'];
						$data_details['cgst'] = (($getProductSaleRate['cgst_percentage'] * $data_details['price']) / 100);
						$data_details['sgst'] = (($getProductSaleRate['sgst_percentage'] * $data_details['price']) / 100);
						$data_details['igst'] = $data_details['taxable_amount'];
						$data_details['payable_amount'] = ($data_details['price'] + $data_details['taxable_amount']);
						$data_details['created_by'] = $this->admin_session_data['user_id'];
						$data_details['created_ts'] = date('Y-m-d H:i:s');
						
						$result_details = $this->mcommon->insert('pos_sale_detail', $data_details);
						
						if($result_details){
							$status = true;
						}
					}
				}
				
				$return_data = array('status' => $status, 'sale_order_id' => $result_header);
			}
			else {
				$headerData = $this->mcommon->getRow('pos_sale_header', array('sale_order_id' => $sale_order_id));
				
				$this->mcommon->update('pos_sale_header', array('sale_order_id' => $sale_order_id), array('updated_by' => $this->admin_session_data['user_id'], 'updated_ts' => date('Y-m-d H:i:s')));
				
				if($headerData){
					$deleteDetailData = $this->mcommon->delete('pos_sale_detail', array('sale_order_id' => $sale_order_id));
					
					foreach($selectedItems as $item){
						$getProductSaleRate = $this->mpos->get_product_sale_rate($item['product_service_id'], $cost_center_id);
						
						$data_details['sale_order_id'] = $sale_order_id;
						$data_details['product_service_id'] = $item['product_service_id'];
						$data_details['quantity'] = $item['qty'];
						$data_details['uom_id'] = $item['uom_id'];
						$data_details['rate'] = $item['price'];
						$data_details['price'] = ($item['price'] * $item['qty']);
						$data_details['taxable_amount'] = (($getProductSaleRate['tax_percentage'] * $data_details['price']) / 100);
						$data_details['cgst_percent'] = $getProductSaleRate['cgst_percentage'];
						$data_details['sgst_percent'] = $getProductSaleRate['sgst_percentage'];
						$data_details['igst_percent'] = $getProductSaleRate['tax_percentage'];
						$data_details['cgst'] = (($getProductSaleRate['cgst_percentage'] * $data_details['price']) / 100);
						$data_details['sgst'] = (($getProductSaleRate['sgst_percentage'] * $data_details['price']) / 100);
						$data_details['igst'] = $data_details['taxable_amount'];
						$data_details['payable_amount'] = ($data_details['price'] + $data_details['taxable_amount']);
						$data_details['updated_by'] = $this->admin_session_data['user_id'];
						$data_details['updated_ts'] = date('Y-m-d H:i:s');
						
						$result_details = $this->mcommon->insert('pos_sale_detail', $data_details);
						
						if($result_details){
							$status = true;
						}
					}
				}
				
				$return_data = array('status' => $status, 'sale_order_id' => $sale_order_id);
			}
			
			
			echo json_encode($return_data);
		}
	}
	
	public function holdPosListing(){
		//echo '<pre>'; print_r($this->input->post()); die;
		if($this->input->post()){
			$return_data = array();
			
			$cost_center_id = $this->input->post('cost_center_id');
			
			$holdPosData = $this->mpos->get_hold_pos($cost_center_id);
			
			if($holdPosData){
				$return_data = array('status' => true, 'open_folder_list' => $holdPosData);
			}
			
			echo json_encode($return_data);
		}
	}
	
	public function getFolderDetails(){
		//echo '<pre>'; print_r($this->input->post()); die;
		if($this->input->post()){
			$return_data = array();
			
			$sale_order_id = $this->input->post('sale_order_id');
			
			$folderDetailsData = $this->mpos->get_folder_details($sale_order_id);
			
			if($folderDetailsData){
				$return_data = array('status' => true, 'open_folder_detail' => $folderDetailsData);
			}
			
			echo json_encode($return_data);
		}
	}
	
	public function getOpenFolio(){
		//echo '<pre>'; print_r($this->input->post()); die;
		if($this->input->post()){
			$return_data = array();
			
			$property_id = $this->input->post('property_id');
			
			$open_folio_list = $this->mpos->get_open_folio($property_id);
			
			if($open_folio_list){
				$return_data = array('status' => true, 'open_folio' => $open_folio_list);
			}
			
			echo json_encode($return_data);
		}
	}
	
	public function transferToFolio(){
		//echo '<pre>'; print_r($this->input->post()); die;
		if($this->input->post()){
			$return_data = array();
			
			$action_type = $this->input->post('action_type');
			$sale_order_id = $this->input->post('sale_order_id');
			$booking_id = $this->input->post('booking_id');
			
			if($sale_order_id != ''){
				$financialStartYear = getFinancialStartYear(date('Y-m-d'));
				$posSaleHeaderData = $this->mpos->getPosSaleHeaderWithCostCenterCode(array('sale_order_id' => $sale_order_id));
				
				if(!empty($posSaleHeaderData)){
					$cost_center_code = ($posSaleHeaderData['cost_center_code'] != '') ? $posSaleHeaderData['cost_center_code'] : 'SFDC'.$posSaleHeaderData['cost_center_id'];
					$likeString = $cost_center_code.'/'.$financialStartYear;
					$invoiceData = $this->mpos->getMaxInvoiceNo($posSaleHeaderData['cost_center_id'], $financialStartYear, $likeString);
					//echo $this->db->last_query(); die;
					
					if((empty($invoiceData)) || $invoiceData['highest_invoice_number'] == ''){
						$str = 1;
						$cost_center_wise_serial_no = str_pad($str,5,"0",STR_PAD_LEFT);
					}
					else{
						$explode_serial_no = explode('/', $invoiceData['highest_invoice_number']);
						$str = ($explode_serial_no[2] + 1);
						$cost_center_wise_serial_no = str_pad($str,5,"0",STR_PAD_LEFT);
					}
				}
				
				$condition = array('sale_order_id' => $sale_order_id);
				
				$payment_option = ($action_type == 'transfer_to_folio') ? '2' : '1';
				$data['invoice_no'] = $cost_center_code.'/'.$financialStartYear.'/'.$cost_center_wise_serial_no;
				//$data['invoice_no'] = 'INV'.time();
				$data['open_status'] = '1';
				$data['order_generate_time'] = date('Y-m-d H:i:s');
				$data['payment_option'] = $payment_option;
				$data['booking_id'] = $booking_id;
				
				$this->mcommon->update('pos_sale_header', $condition, $data);
				$return_data = array('status' => true);
			}
			
			echo json_encode($return_data);
		}
	}
	
	public function pos_invoice($sale_order_id = 0)
	{
		$data = array();
		$data['sale_order_id'] = $sale_order_id;
		$data['posHeader'] = $this->mcommon->getRow('pos_sale_header', array('sale_order_id' => $sale_order_id));
		$data['content'] = 'admin/pos/pos_sale/invoice_pos';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function getPosDetail(){
		//echo '<pre>'; print_r($this->input->post()); die;
		if($this->input->post()){
			$return_data = array();
			
			$sale_order_id = $this->input->post('sale_order_id');
			
			if($sale_order_id != ''){
				$pos_header = $this->mpos->get_pos_header_details($sale_order_id);
				$pos_details = $this->mpos->get_pos_details($sale_order_id, $pos_header['cost_center_id']);
				
				$return_data = array('status' => true, 'pos_header' => $pos_header, 'pos_detail' => $pos_details);
			}
			
			echo json_encode($return_data);
		}
	}
	/*End For POS Sale*/
	
	
	/*For Invoice Payment*/
	public function pos_invoice_list($_property_id = '', $_cost_center_id = '')
	{
		$data['pos_invoice_list'] = array();
		$property_id = decode_url($_property_id);
		$cost_center_id = decode_url($_cost_center_id);
		
		$pos_invoice_list = $this->mpos->__get_receivable_invoice_list($property_id, $cost_center_id);
		//echo $this->db->last_query(); die;
		if(!empty($pos_invoice_list)){
			foreach($pos_invoice_list as $row){
				$receivableInvoicePaymentData = $this->mpos->get_receivable_invoice_payment($row['sale_order_id']);
				$receivableInvoiceArr[] = array(
					'net_bill_amount' => $row['net_bill_amount'],
					'paid_amount' => $receivableInvoicePaymentData['paid_amount'],
					'order_generate_time' => $row['order_generate_time'],
					'invoice_no' => $row['invoice_no'],
					'cost_center_name' => $row['cost_center_name'],
					'table_no' => $row['table_no'],
					'payment_mode' => $receivableInvoicePaymentData['payment_mode'],
					'sale_order_id' => $row['sale_order_id'],
					'cost_center_name' => $row['cost_center_name']
				);
			}
			
			$data['pos_invoice_list'] = $receivableInvoiceArr;
		}
		else{
			$data['pos_invoice_list'] = '';
		}
		//print_r($data['cost_centers']);die;
		$data['content'] = 'admin/pos/pos_sale/pos_invoice_list';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function receive_against_pos($_sale_order_id = '')
	{
		$data = array();
		$sale_order_id = decode_url($_sale_order_id);
		
		$data['inv_det'] = $this->mpos->get_receivable_invoice_details($sale_order_id);
		$data['sale_order_id'] = $_sale_order_id;
		//echo '<pre>'; print_r($data['inv_det']);die;
		$data['content'] = 'admin/pos/pos_sale/receive_against_pos';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function submit_pos_invoice() {
		
		if($this->input->post()){
			$this->form_validation->set_rules('payment_mode','Payment Mode','trim|required|in_list[Cash,EDC,Standalone EDC,UPI]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				//redirect("admin/pos/receive_against_pos/".$this->input->post('sale_order_id'));
				$link = base_url()."admin/pos/receive_against_pos/".$this->input->post('sale_order_id');
				$return_data = array('success' => false, 'msg' => validation_errors(), 'redirect_link' => $link);
			}
			else {
				
				$sale_order_id = decode_url($this->input->post('sale_order_id'));
				$payment_mode = $this->input->post('payment_mode');
				$customer_name = $this->input->post('customer_name');
				$mobile_no = $this->input->post('mobile_no');
				$customer_gstin = $this->input->post('customer_gstin');
				$remarks = $this->input->post('remarks');
				
				$invData = $this->mpos->get_receivable_invoice_details($sale_order_id);
				$net_bill_amount = round($invData['net_bill_amount']);
				
				if($payment_mode == 'Cash' || $payment_mode == 'UPI' || $payment_mode == 'Standalone EDC'){
					
					$data = array(
						'payment_date' => date('Y-m-d H:i:s'),
						'amount' => $net_bill_amount,
						'payment_mode' => $payment_mode,
						'remarks' => $remarks,
						'status' => 'success',
						'created_by' => $this->admin_session_data['user_id'],
						'created_ts' => date('Y-m-d H:i:s'),
						'sale_order_id' => $sale_order_id
					);
					
					$result = $this->mcommon->insert('booking_payment', $data);
					if ($result) {
						$this->mcommon->update('pos_sale_header', array('sale_order_id' => $sale_order_id), array('customer_name' => $customer_name, 'mobile_no' => $mobile_no, 'customer_gstin' => $customer_gstin));
						
						$this->session->set_flashdata('success_msg', 'Payment accepted successfully');
						//redirect("admin/pos/pos_invoice_list/".encode_url($invData['property_id']));
						$link = base_url()."admin/pos/pos_invoice_list/".encode_url($invData['property_id'])."/".encode_url($invData['cost_center_id']);
						$return_data = array('success' => true, 'msg' => 'Payment accepted successfully', 'redirect_link' => $link, 'payment_mode' => $payment_mode);
					}
					
				}
				else {
					$this->mcommon->update('pos_sale_header', array('sale_order_id' => $sale_order_id), array('customer_name' => $customer_name, 'mobile_no' => $mobile_no, 'customer_gstin' => $customer_gstin));
					
					redirect("index/api_to_send_pos_bridge_notification_on_paytm_device/".base64_encode($this->encryption->encrypt(serialize(array('sale_order_id' => $sale_order_id, 'mode' => $payment_mode, 'receive_from' => 'pos', 'remarks' => $this->input->post('remarks'))))));
				}
				
			}
			
			echo json_encode($return_data);
			
		}
	
	}
	
	public function cancel_pos_invoice(){
		//echo '<pre>'; print_r($this->input->post()); die;
		if($this->input->post()){
			$return_data = array();
			
			$sale_order_id = $this->input->post('sale_order_id');
			$cancel_remarks = $this->input->post('cancel_remarks');
			
			if($sale_order_id != ''){
				$update_header = $this->mcommon->update('pos_sale_header', array('sale_order_id' => $sale_order_id), array('sale_flag' => 0, 'cancel_remarks' => $cancel_remarks));
				if($update_header){
					$return_data = array('status' => true, 'sale_order_id' => $sale_order_id);
				}
			}
			
			echo json_encode($return_data);
		}
	}
	/*End For Invoice Payment*/
	
	
	/*For Invoice Cancel*/
	public function pos_cancel()
	{
		$data = array('menu_id'=> 77);
		$data['lists'] = array();
		$property_ids = array();
		$invoicePaymentData = array();
		
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : ''; 
		$data['cost_center_id']= $this->input->post('cost_center_id') != '' ? $this->input->post('cost_center_id') : '';
		if($this->input->post()){
			if($this->input->post('property')){
				$where['psh.property_id ='] = $this->input->post('property');
			}
			if($this->input->post('cost_center_id')){
				$where['psh.cost_center_id ='] = $this->input->post('cost_center_id');
			}
		}
		
		$order_by = 'psh.order_generate_time DESC';
		$group_by = 'psd.sale_order_id';
		
		
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		$data['cost_centers'] = $this->mcommon->getDetails('cost_center_master', array('property_id' => $data['property']));
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$properties =  $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$property_ids = array_column($properties, 'property_id');
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($property_ids)){
				$lists = $this->mpos->get_pos_invoice_list_for_cancel($where, $order_by, $property_ids, $group_by);
				
				if(!empty($lists)){
					foreach($lists as $row){
						$invoicePaymentData = $this->mpos->get_receivable_invoice_payment($row->sale_order_id);
						
						$cancelInvoiceArr[] = array(
							'net_bill_amount' => $row->net_bill_amount,
							'paid_amount' => $invoicePaymentData['paid_amount'],
							'order_generate_time' => $row->order_generate_time,
							'invoice_no' => $row->invoice_no,
							'cost_center_name' => $row->cost_center_name,
							'table_no' => $row->table_no,
							'payment_mode' => $invoicePaymentData['payment_mode'],
							'sale_order_id' => $row->sale_order_id,
							'cost_center_name' => $row->cost_center_name
						);
					}
					
					$data['lists'] = $cancelInvoiceArr;
				}
				else{
					$data['lists'] = '';
				}
			}
			
			
		}
		//echo $this->db->last_query(); die;
		//echo '<pre>',print_r($data['lists']);die;
		$data['content'] = 'admin/pos/pos_sale/pos_cancel_list';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function getCostCenterByProperty()
	{
		$property_id = ($this->input->get('property_id') != '') ? $this->input->get('property_id') : $this->input->post('property_id');
		$show_type = $this->input->post('show_type');
		//$data_list = $this->mcommon->getDetails('cost_center_master', array('property_id' => $property_id));
		if($show_type == 'all'){
			$data_list = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mcommon->getDetails('cost_center_master', array('property_id' => $property_id, 'is_active' => '1')) : $this->mpos->user_wise_pos($property_id,$this->admin_session_data['user_id']);
		}
		else{
			$data_list = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mcommon->getDetails('cost_center_master', array('property_id' => $property_id, 'is_active' => '1', 'is_it_pos' => 1)) : $this->mpos->user_wise_pos($property_id,$this->admin_session_data['user_id']);
		}
		
		
		$response = array("status"=> true, "list"=>$data_list);
		echo json_encode($response);
		exit;
	}
	
	public function pos_received_invoice_list($_property_id = '', $_cost_center_id = '')
	{
		$data['pos_received_invoice_list'] = array();
		$property_id = decode_url($_property_id);
		$cost_center_id = decode_url($_cost_center_id);
		
		$pos_received_invoice_list = $this->mpos->__get_received_invoice_list($property_id, $cost_center_id);
		//echo $this->db->last_query(); die;
		if(!empty($pos_received_invoice_list)){
			foreach($pos_received_invoice_list as $row){
				$receivedInvoicePaymentData = $this->mpos->get_receivable_invoice_payment($row['sale_order_id']);
				$receivedInvoiceArr[] = array(
					'net_bill_amount' => $row['net_bill_amount'],
					'paid_amount' => $receivedInvoicePaymentData['paid_amount'],
					'order_generate_time' => $row['order_generate_time'],
					'invoice_no' => $row['invoice_no'],
					'cost_center_name' => $row['cost_center_name'],
					'table_no' => $row['table_no'],
					'payment_mode' => $receivedInvoicePaymentData['payment_mode'],
					'sale_order_id' => $row['sale_order_id'],
					'cost_center_name' => $row['cost_center_name']
				);
			}
			
			$data['pos_received_invoice_list'] = $receivedInvoiceArr;
		}
		else{
			$data['pos_received_invoice_list'] = '';
		}
		//print_r($data['pos_received_invoice_list']);die;
		$data['content'] = 'admin/pos/pos_sale/pos_received_invoice_list';
		$this->load->view('admin/layouts/index', $data);
	}

}
