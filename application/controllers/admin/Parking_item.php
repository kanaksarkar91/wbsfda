<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parking_item extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('mcommon', 'admin/mparking_item', 'admin/mproperty', 'admin/muser'));
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
	public function index($value1 = null)
	{
		$link_arr = !is_null($value1) ? unserialize($this->encryption->decrypt(base64_decode($value1))) : array();
		$link_condn = isset($link_arr['link_condn']) ? $link_arr['link_condn'] : NULL;
		
		if (isset($_POST['search'])) {
			$property_id = $this->input->post('property_id');
			
			$search_condn = array();
			$search_condn = $property_id != '' ? array_merge($search_condn, array('property_id' => $property_id)) : $search_condn;
			
			$value1 = base64_encode($this->encryption->encrypt(serialize(array('link_condn' => $search_condn))));
			
			redirect(base_url('admin/parking_item/index/' . $value1));
		}
		
		$data = array('menu_id'=> 13);
		$data['items'] = array();
		
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1, 'property_master.p_type' => 'G')) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		if (isset($link_condn['property_id']) && !is_null($link_condn['property_id'])) {
			$condn['property_master.property_id'] = $link_condn['property_id'];
			$data['d_property_id'] = $link_condn['property_id'];
		}
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN){
			$data['items'] = $this->mparking_item->get_item_list($condn);
		}else{
			if(check_user_permission($data['menu_id'], 'delete_flag')){
				$parent_properties = $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$parent_properties = !empty($parent_properties) ? array_column($parent_properties, 'property_id') : array();
				if(!empty($parent_properties)){
					$data['items'] = $this->mparking_item->get_item_list_property_id($parent_properties);
				}
			}
		}
		 //echo '<pre>',print_r($data['items']);die;
		$data['content'] = 'admin/parking_item/list';
		$this->load->view('admin/layouts/index', $data);
	}

	public function additem()
	{
		//echo $this->session_data['role_id'];
		$data = array();
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['uoms'] = $this->mcommon->getDetails('uom_master', array('is_active' => '1'));
		$data['taxs'] = $this->mcommon->getDetails('tax_master', array('is_active' => '1'));
		$data['sacs'] = $this->mcommon->getDetails('sac_code_master', array('is_active' => '1'));
		
		$data['content'] = 'admin/parking_item/add';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function insertitem() {
		
		if($this->input->post()){
			$this->form_validation->set_rules('property_id','Property','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('item_name','Item Name','trim|required');
			$this->form_validation->set_rules('uom_id','UOM','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('gst_percentage','GST Rate(%) ','trim|required|numeric');
			$this->form_validation->set_rules('sac_code','SAC Code','trim|required');
			$this->form_validation->set_rules('gst_include_in_price', 'Whether GST will be include in Price', 'trim|required|in_list[Yes,No]');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|greater_than[0.99]');
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,2]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/parking_item");
			}
			else {
				
				$item_name = $this->input->post('item_name');
				$property_id = $this->input->post('property_id');
				$uom_id = $this->input->post('uom_id');
				$gst_percentage = $this->input->post('gst_percentage');
				$sac_code = $this->input->post('sac_code');
				$gst_include_in_price = $this->input->post('gst_include_in_price');
				$price = $this->input->post('price');
				$is_active = $this->input->post('is_active');
				
				$itemDataFound = $this->mcommon->getRow('master_parking_item', array('property_id'=>$property_id, 'item_name' =>$item_name));
				
				if(!$itemDataFound) {
		
					$dividedBy = floatval($gst_percentage) + 100;
					$base_price = ($gst_include_in_price == "Yes") ? (100 / $dividedBy) * $price : $price;
					$igst_amt = (floatval($base_price) * $gst_percentage) / 100;
					$cgst_amt = $sgst_amt = floatval($igst_amt) / 2;
					$price = ($gst_include_in_price == "Yes") ? $price : (floatval($price) + floatval($igst_amt));
					
					$data = array(
						'property_id' => $property_id,
						'is_active' => $is_active,
						'item_name' => $item_name,
						'uom_id' => $uom_id,
						'gst_percentage' => $gst_percentage,
						'sac_code' => $sac_code,
						'gst_include_in_price' => $gst_include_in_price,
						'base_price' => $base_price,
						'cgst_amt' => $cgst_amt,
						'sgst_amt' => $sgst_amt,
						'igst_amt' => $igst_amt,
						'price' => $price,
						'created_by' => $this->admin_session_data['user_id'],
						'created_ts' => date('Y-m-d H:i:s')
					);
					 //echo '<pre>';print_r($data);die;
					$result = $this->mcommon->insert('master_parking_item', $data);
					if ($result) {
						$this->session->set_flashdata('success_msg', 'Item Added Successfully');
						redirect("admin/parking_item");
					}
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate Item Found In Same Property.');
					redirect("admin/parking_item");
				}
			}
		}
	
	}

	public function edititem($itemId)
	{
		$data = array();
		$item_id = decode_url($itemId);
		
		$data['property_details'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['uoms'] = $this->mcommon->getDetails('uom_master', array('is_active' => '1'));
		$data['taxs'] = $this->mcommon->getDetails('tax_master', array('is_active' => '1'));
		$data['sacs'] = $this->mcommon->getDetails('sac_code_master', array('is_active' => '1'));
		$data['item'] = $this->mcommon->getRow('master_parking_item', array('item_id' => $item_id));
		//echo '<pre>',print_r($data['item']);die;
		$data['content'] = 'admin/parking_item/edit';
		$this->load->view('admin/layouts/index', $data);
	}

	public function updateitem()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('property_id','Property','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('item_name','Item Name','trim|required');
			$this->form_validation->set_rules('uom_id','UOM','trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
			$this->form_validation->set_rules('gst_percentage','GST Rate(%) ','trim|required|numeric');
			$this->form_validation->set_rules('sac_code','SAC Code','trim|required');
			$this->form_validation->set_rules('gst_include_in_price', 'Whether GST will be include in Price', 'trim|required|in_list[Yes,No]');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|greater_than[0.99]');
			$this->form_validation->set_rules('is_active', 'Status', 'trim|required|in_list[1,2]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/parking_item");
			}
			else {
				
				$item_id = decode_url($this->input->post('item_id'));
				$item_name = $this->input->post('item_name');
				$property_id = $this->input->post('property_id');
				$uom_id = $this->input->post('uom_id');
				$gst_percentage = $this->input->post('gst_percentage');
				$sac_code = $this->input->post('sac_code');
				$gst_include_in_price = $this->input->post('gst_include_in_price');
				$price = $this->input->post('price');
				$is_active = $this->input->post('is_active');
				
				$itemDataFound = $this->mcommon->getRow('master_parking_item', array('item_id !=' => $item_id, 'item_name'=>$item_name, 'property_id' =>$property_id));
				
				if(!$itemDataFound) {
					
					$dividedBy = floatval($gst_percentage) + 100;
					$base_price = ($gst_include_in_price == "Yes") ? (100 / $dividedBy) * $price : $price;
					$igst_amt = (floatval($base_price) * $gst_percentage) / 100;
					$cgst_amt = $sgst_amt = floatval($igst_amt) / 2;
					$price = ($gst_include_in_price == "Yes") ? $price : (floatval($price) + floatval($igst_amt));
					
					$data = array(
						'property_id' => $property_id,
						'is_active' => $is_active,
						'item_name' => $item_name,
						'uom_id' => $uom_id,
						'gst_percentage' => $gst_percentage,
						'sac_code' => $sac_code,
						'gst_include_in_price' => $gst_include_in_price,
						'base_price' => $base_price,
						'cgst_amt' => $cgst_amt,
						'sgst_amt' => $sgst_amt,
						'igst_amt' => $igst_amt,
						'price' => $price,
						'updated_by' => $this->admin_session_data['user_id'],
						'updated_ts' => date('Y-m-d H:i:s')
					);
					
					$condition = array('item_id' => $item_id);
					// echo '<pre>';print_r($data);die;
					$result = $this->mcommon->update('master_parking_item', $condition,$data);
					if ($result) {
						$this->session->set_flashdata('success_msg', 'Item Updated Successfully');
						redirect("admin/parking_item");
					}
					
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate Item Found In Same Property.');
					redirect("admin/parking_item");
				}
				
			}
		}
		
	}

	function uploadImages($fieldName)
	{

		$dir = 'room_images';

		$config['upload_path']          = './public/admin_images/' . $dir;
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['max_size']             = 5000;
		$config['encrypt_name'] = TRUE;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;

		$this->load->library('upload', $config);

		$img_ret = array();

		if ($this->upload->do_upload($fieldName)) {
			$upload_data = $this->upload->data();
			$image_path = $dir . '/' . $upload_data['file_name'];

			$img_ret = array('status' => true, 'img_path' => $image_path);
		} else {
			$img_ret = array('status' => false, 'error' => $this->upload->display_errors());
		}

		return $img_ret;
	}


}
