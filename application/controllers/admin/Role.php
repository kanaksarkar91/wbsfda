<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('mcommon', 'admin/mrole'));

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
		$data = array('menu_id'=> 19);
		$data['roles'] = array();
		if(check_user_permission($data['menu_id'], 'delete_flag')){
			$data['roles'] = $this->mrole->get_role();
		}
		// print_r($data['roles']);die;
		$data['content'] = 'admin/role/list';
		$this->load->view('admin/layouts/index', $data);
	}
	public function addrole()
	{
		$data = array();
		$data['content'] = 'admin/role/add';
		$this->load->view('admin/layouts/index', $data);
	}
	public function editrole($role_id)
	{
		$data['role'] = $this->mrole->edit_role($role_id);
		$data['content'] = 'admin/role/edit';
		$this->load->view('admin/layouts/index', $data);
	}
	public function submitrole()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('role_name','Job Role Name','trim|required|callback_check_textbox_with_some_special_character');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/role");
			}
			else {
				$role_name=$this->input->post('role_name');
				$status=$this->input->post('status');
				
				$roleDataFound = $this->mcommon->getRow('master_role', array('role_name' =>$role_name));
				
				if(!$roleDataFound) {
					$data = array(
						'role_name' => $role_name,
						'status' => $status,
						'created_by' => $this->admin_session_data['user_id'],
						'created_ts' => date('Y-m-d H:i:s')
					);
					$result = $this->mrole->submit_role($data);
						
					if ($result) {
						$this->session->set_flashdata('success_msg', 'Role Added Successfully');
						redirect("admin/role");
					}
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate Job Role Found!!');
					redirect("admin/role");
				}
			}
		}
	}

	public function updaterole()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('role_name','Job Role Name','trim|required|callback_check_textbox_with_some_special_character');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect("admin/role");
			}
			else {
				$role_id=$this->input->post('hid_role_id');
				$role_name=$this->input->post('role_name');
				$status=$this->input->post('status');
				
				$roleDataFound = $this->mcommon->getRow('master_role', array('role_id !=' => $role_id, 'role_name'=>$role_name));
				
				if(!$roleDataFound) {
					$data = array(
						'role_name' => $role_name,
						'status' => $status,
						'updated_by' => $this->admin_session_data['user_id'],
						'updated_ts' => date('Y-m-d H:i:s')
					);
		
					$condition = array('role_id' => $role_id);
					
					$result = $this->mrole->update_role($condition,$data);
						
					if ($result) {
						$this->session->set_flashdata('success_msg', 'Role Updated Successfully');
						redirect("admin/role");
					}
				}
				else {
					$this->session->set_flashdata('error_msg', 'Duplicate Job Role Found!!');
					redirect("admin/role");
				}
			}
		}
	}

	public function deleterole($role_id)
	{
			$data = array('status' => '2');
			$condition = array('role_id' => $role_id);

			$result = $this->mrole->delete_role($condition,$data);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Role Deleted Successfully');
				redirect("admin/role");
			}
	}
	

}
