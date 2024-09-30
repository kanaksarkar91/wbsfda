<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sports_facilities extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/msports_facilities'); 
		$this->load->model('admin/mfieldunit'); 
		$this->load->model('admin/mlocation'); 
		$this->load->model('admin/msports_infrastructure'); 
		$this->load->model('admin/mfacilities_amenitis'); 
		$this->load->model('mcommon'); 

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
	{   $data['slug'] =  $this->input->get('slug');
		$data['sports_facilitiess'] = $this->msports_facilities->get_sports_facilities($data['slug']);
		// print_r($data['fieldunits']);die;
		$data['content'] = 'admin/sports_facilities/list';
		$this->load->view('admin/layouts/index', $data);
	}
	public function addsports_facilities()
	{
		$data = array();
		$data['slug'] =  $this->input->get('slug');
		$data['fieldunits'] = $this->mfieldunit->get_fieldunit();
		$data['sports_infrastructures'] = $this->msports_infrastructure->get_sports_infrastructure();
		$data['facilities_amenitiss'] = $this->mfacilities_amenitis->get_facilities_amenitis();
		$data['content'] = 'admin/sports_facilities/add';
		$this->load->view('admin/layouts/index', $data);
	}
	public function editsports_facilities($sports_facilities_id)
	{
		$data['slug'] =  $this->input->get('slug');
		$data['fieldunits'] = $this->mfieldunit->get_fieldunit();
		$data['locations'] = $this->mlocation->get_location();
		$data['sports_infrastructures'] = $this->msports_infrastructure->get_sports_infrastructure();
		$data['facilities_amenitiss'] = $this->mfacilities_amenitis->get_facilities_amenitis();
		$data['sports_facilities_amenitis'] = $this->msports_facilities->get_sports_facilities_amenitis($sports_facilities_id);
		$data['sports_facilities_infrastructure'] = $this->msports_facilities->get_sports_facilities_infrastructure($sports_facilities_id);
		$data['sports_facilities_images'] = $this->msports_facilities->get_sports_facilities_images($sports_facilities_id);
		$data['sports_facilities'] = $this->msports_facilities->edit_sports_facilities($sports_facilities_id);
		$data['content'] = 'admin/sports_facilities/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	public function submitsports_facilities()
	{

		$facilities_amenitis_id=$this->input->post('facilities_amenitis_id');
		$sports_infrastructure_id=$this->input->post('sports_infrastructure_id');

			$data = array(
				'fieldunit_id' => $this->input->post('fieldunit_id'),
				'location_id' => $this->input->post('location_id'),
				'sports_facilities_name' => $this->input->post('sports_facilities_name'),
				'latitude' => $this->input->post('latitude'),
				'longitude' => $this->input->post('longitude'),
				'address' => $this->input->post('address'),
				'contact_no' => $this->input->post('contact_no'),
				'alternate_contact_no' => $this->input->post('alternate_contact_no'),
				'email' => $this->input->post('email'),
				'slug' => $this->input->post('slug'),
				'page_type' => $this->input->post('slug'),
				'alternate_email' => $this->input->post('alternate_email'),
				'status' => $this->input->post('status'),
				'created_by' => $this->admin_session_data['user_id'],
				'created_ts' => date('Y-m-d H:i:s')
			);
			$last_insert_id = $this->msports_facilities->submit_sports_facilities($data);

			if($last_insert_id){

				if(!empty($facilities_amenitis_id)){
			
					foreach($facilities_amenitis_id as $row){
						$data_facilities_amenitis[] = array(
							'sports_facilities_id' => $last_insert_id,
							'facilities_amenitis_id' => $row
						);
					}
					$this->db->insert_batch('sports_facilities_amenitis',$data_facilities_amenitis);
				}

				if(!empty($sports_infrastructure_id)){

					foreach($sports_infrastructure_id as $row){
						$data_sports_infrastructure[] = array(
							'sports_facilities_id' => $last_insert_id,
							'sports_infrastructure_id' => $row
						);
					}
					$this->db->insert_batch('sports_facilities_infrastructure',$data_sports_infrastructure);
				}

				$dataInfo = array();
				$files = $_FILES;
				$cpt = count($_FILES['sports_facilities_image_file']['name']);
				for($i=0; $i<$cpt; $i++)
				{           
					$_FILES['sports_facilities_image_file']['name']= $files['sports_facilities_image_file']['name'][$i];
					$_FILES['sports_facilities_image_file']['type']= $files['sports_facilities_image_file']['type'][$i];
					$_FILES['sports_facilities_image_file']['tmp_name']= $files['sports_facilities_image_file']['tmp_name'][$i];
					$_FILES['sports_facilities_image_file']['error']= $files['sports_facilities_image_file']['error'][$i];
					$_FILES['sports_facilities_image_file']['size']= $files['sports_facilities_image_file']['size'][$i];    

					$config['upload_path'] = './public/admin_images/sports_facilities';
					$config['allowed_types'] = '*';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('sports_facilities_image_file')) {

						$imgt = $this->upload->data()['file_name'];
						$dataInfo[] = $imgt;
					} else {
						echo $this->upload->display_errors();
					}
				}

				if(!empty($dataInfo)){

					foreach($dataInfo as $row){
						$data_facilities_images[] = array(
							'sports_facilities_id' => $last_insert_id,
							'sports_facilities_image_file' => $row
						);
					}
					$this->db->insert_batch('sports_facilities_images',$data_facilities_images);
				}

			}
				
				$this->session->set_flashdata('success_msg', $this->input->post('slug').' Added Successfully');
				redirect("admin/sports_facilities?slug=".$this->input->post('slug'));
			
	}
	public function updatesports_facilities()
	{

		$sports_facilities_id=$this->input->post('sports_facilities_id');
		$facilities_amenitis_id=$this->input->post('facilities_amenitis_id');
		$sports_infrastructure_id=$this->input->post('sports_infrastructure_id');

			$data = array(
				'fieldunit_id' => $this->input->post('fieldunit_id'),
				'location_id' => $this->input->post('location_id'),
				'sports_facilities_name' => $this->input->post('sports_facilities_name'),
				'latitude' => $this->input->post('latitude'),
				'longitude' => $this->input->post('longitude'),
				'address' => $this->input->post('address'),
				'contact_no' => $this->input->post('contact_no'),
				'alternate_contact_no' => $this->input->post('alternate_contact_no'),
				'email' => $this->input->post('email'),
				'slug' => $this->input->post('slug'),
				'page_type' => $this->input->post('slug'),
				'alternate_email' => $this->input->post('alternate_email'),
				'status' => $this->input->post('status'),
				'updated_by' => $this->admin_session_data['user_id'],
				'updated_ts' => date('Y-m-d H:i:s')
			);
			
			$condition = array('sports_facilities_id' => $sports_facilities_id);
			
			$result = $this->msports_facilities->update_sports_facilities($condition,$data);

			if($result){

				if(!empty($facilities_amenitis_id)){
			
					foreach($facilities_amenitis_id as $row){
						$data_facilities_amenitis[] = array(
							'sports_facilities_id' => $sports_facilities_id,
							'facilities_amenitis_id' => $row
						);
					}
					$this->msports_facilities->delete_sports_facilities_amenitis($condition);
					$this->db->insert_batch('sports_facilities_amenitis',$data_facilities_amenitis);
				}

				if(!empty($sports_infrastructure_id)){

					foreach($sports_infrastructure_id as $row){
						$data_sports_infrastructure[] = array(
							'sports_facilities_id' => $sports_facilities_id,
							'sports_infrastructure_id' => $row
						);
					}
					$this->msports_facilities->delete_sports_facilities_infrastructure($condition);
					$this->db->insert_batch('sports_facilities_infrastructure',$data_sports_infrastructure);
				}

				$dataInfo = array();
				$files = $_FILES;
				$cpt = count($_FILES['sports_facilities_image_file']['name']);
				for($i=0; $i<$cpt; $i++)
				{           
					$_FILES['sports_facilities_image_file']['name']= $files['sports_facilities_image_file']['name'][$i];
					$_FILES['sports_facilities_image_file']['type']= $files['sports_facilities_image_file']['type'][$i];
					$_FILES['sports_facilities_image_file']['tmp_name']= $files['sports_facilities_image_file']['tmp_name'][$i];
					$_FILES['sports_facilities_image_file']['error']= $files['sports_facilities_image_file']['error'][$i];
					$_FILES['sports_facilities_image_file']['size']= $files['sports_facilities_image_file']['size'][$i];    

					$config['upload_path'] = './public/admin_images/sports_facilities';
					$config['allowed_types'] = '*';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('sports_facilities_image_file')) {

						$imgt = $this->upload->data()['file_name'];
						$dataInfo[] = $imgt;
					} else {
						echo $this->upload->display_errors();
					}
				}

				if(!empty($dataInfo)){

					foreach($dataInfo as $row){
						$data_facilities_images[] = array(
							'sports_facilities_id' => $sports_facilities_id,
							'sports_facilities_image_file' => $row
						);
					}
					$this->db->insert_batch('sports_facilities_images',$data_facilities_images);
				}

			}
				
				$this->session->set_flashdata('success_msg', $this->input->post('slug').'  Updated Successfully');
				redirect("admin/sports_facilities?slug=".$this->input->post('slug'));
			
	}
	public function img_delete()
	{
			$sports_facilities_images_id=$this->input->post('sports_facilities_images_id');

			$condition = array('sports_facilities_images_id' => $sports_facilities_images_id);
			$prevData = $this->mcommon->getRow('sports_facilities_images',$condition);

			$delete = $this->msports_facilities->delete_sports_facilities_images($condition);
				
			if ($delete) {
				@unlink('./public/admin_images/sports_facilities/'.$prevData['sports_facilities_image_file']); 
				$status = 'ok'; 
			}else{ 
				$status  = 'err'; 
			} 
			echo json_encode(array('status'=>$status)); 
	}

	
	public function getlocation()
	{
		$data = array();
		$fieldunit_id=$this->input->post('fieldunit_id');
		$data = $this->msports_facilities->get_location($fieldunit_id);
		echo json_encode($data); 
	}

}
