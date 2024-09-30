<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Budget extends MY_Controller
{
	//private $menu_id;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model(array('admin/mbudget', 'mcommon'));
		//$this->menu_id = 24;

	}


	public function index()
	{	
		if($this->input->post()){
			
			$financial_year = $this->input->post('financial_year');
			$billing_month = $this->input->post('billing_month');

			$data['estimation_list'] = $this->mbudget->estimation_list($financial_year, $billing_month);

			$data['financial_year'] = $financial_year;
			$data['billing_month'] = $billing_month;

		} else {

			$data['estimation_list'] = '';

			$data['financial_year'] = '';
			$data['billing_month'] = '';

		}

		$data['content'] = 'admin/budget/list';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function approved_budget()
	{	
		if($this->input->post()){
			
			$financial_year = $this->input->post('financial_year');
			$billing_month = $this->input->post('billing_month');


			$data['approved_list'] = $this->mbudget->approved_list($financial_year, $billing_month);

			$data['financial_year'] = $financial_year;
			$data['billing_month'] = $billing_month;

		} else {

			$data['estimation_list'] = '';

			$data['financial_year'] = '';
			$data['billing_month'] = '';

		}

		$data['content'] = 'admin/budget/approved_list';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function add_budget_estimate()
	{			

		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){

			//echo "<pre>"; print_r($this->input->post()); die;
			//echo "<pre>"; print_r($_FILES['estimated_files']['name']); die;

			$property_id = $this->input->post('property_id');
			$financial_year = $this->input->post('financial_year');
			$billing_month = $this->input->post('billing_month');

			$particular_id = $this->input->post('particular_id');
			$edtimatedAmt = $this->input->post('estimated_expence_amount');
			$totaledtimatedAmt = $this->input->post('total_estimated_amount');
			$estimation_remarks = $this->input->post('estimation_remarks');


			$checkDetails = $this->mbudget->check_budget_details($property_id, $billing_month, $financial_year);

			if($checkDetails){

				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Estimated Budget already exist for this Unit, Financial Year, Month.</div>');

			} else {

				$budgetHeaderarray = array(
					'property_id' => $property_id,
					'financial_year'=> $financial_year,
					'expense_month' => $billing_month,
					'estimated_expence_total' => $totaledtimatedAmt,
					'estimated_by' => $this->admin_session_data['user_id'],
					'estimated_ts' => date('Y-m-d H:i:s'),
					//'estimation_remarks' => $estimation_remarks,
					'created_by' => $this->admin_session_data['user_id']
				);

				$headerResult = $this->mbudget->budget_header_insert($budgetHeaderarray);


				$i = 0;
				foreach($particular_id as $pid){

					$detailArray = array();

					$detailArray['budget_header_id'] = $headerResult;
					$detailArray['particulars_id'] = $pid;
					$detailArray['estimated_expence_amount'] = $edtimatedAmt[$i];
					$detailArray['estimated_remarks'] = $estimation_remarks[$i];
					$detailArray['created_by'] = $this->admin_session_data['user_id'];

					$detailsResult = $this->mbudget->budget_details_insert($detailArray);

					// If files are selected to upload 
					$dataFiles = array();

					if(!empty($_FILES['estimated_files']['name'][$i][0])){

						$count = count($_FILES['estimated_files']['name'][$i]);

						for($j=0;$j<$count;$j++){

							$_FILES['file']['name'] = $_FILES['estimated_files']['name'][$i][$j];			  
							$_FILES['file']['type'] = $_FILES['estimated_files']['type'][$i][$j];			  
							$_FILES['file']['tmp_name'] = $_FILES['estimated_files']['tmp_name'][$i][$j];			  
							$_FILES['file']['error'] = $_FILES['estimated_files']['error'][$i][$j];			  
							$_FILES['file']['size'] = $_FILES['estimated_files']['size'][$i][$j];		  
					
				
							$config['upload_path'] = './public/estimated_files'; 			  
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';			  
							$config['max_size'] = '5000';			  
							$config['file_name'] = $_FILES['estimated_files']['name'][$i][$j];

							$this->load->library('upload',$config); 		  
							$this->upload->initialize( $config );
			  
							if($this->upload->do_upload('file')){
				
								$uploadData = $this->upload->data();			  
								$filename = $uploadData['file_name'];	

								$dataFiles['file_title'] = $filename;
								$dataFiles['budget_details_id'] = $detailsResult;

								$this->mbudget->budget_details_file_insert($dataFiles);
				
							}

						}

					}


					$i++;

				}

				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Estimated Budget Successfully Submitted.</div>');

			}

			$data['property_id'] = $property_id;
			$data['financial_year'] = $financial_year;
			$data['billing_month'] = $billing_month;

		} else {

			$data['property_id'] = '';
			$data['financial_year'] = '';
			$data['billing_month'] = '';

		}

		$data['property_list'] = $this->mbudget->property_list($curUser);
		//$data['particular_list'] = $this->mbudget->particular_list();

		$data['content'] = 'admin/budget/add';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function budget_particular_list()
	{

		$propertyId = $this->input->post('propertyId');

		$particulat_list = $this->mbudget->budget_particular_list($propertyId);

		$html = '';
		
		$i = 0;
		foreach($particulat_list as $list){

			$html .= '<tr>';
			$html .= '<td width="30%" class="cell fw-bold">'.$list['particular_title'].'</td>';
			$html .= '<td width="20%" class="cell text-end"><div class="input-group"><span class="input-group-text" id="basic-addon1">Rs.</span><input type="text" class="form-control text-end fw-bold estimated_expence_amount" name="estimated_expence_amount[]" value="" placeholder="0.00"><input type="hidden" name="particular_id[]" value="'.$list['particular_id'].'"></div></td>';
			$html .= '<td width="30%" class="cell"><div class="input-group"><textarea name="estimation_remarks[]" id="" cols="" rows="2" class="form-control estimation_remarks"></textarea></div></td>';
			$html .= '<td width="20%" class="cell"><div class="input-group"><input type="file" multiple class="form-control estimated_files" name="estimated_files['.$i.'][]"></div></td>';
			$html .= '</tr>';

			$i++;

		}

		$html .= '<tr style="background-color: #1a4919; font-size: 1.1rem;"><td width="30%" class="cell text-white" colspan="3">Total Estimated Cost for the month <span class="mainDate">'.date("M Y").'</span></td><td width="20%" class="cell text-white text-end total_estimated_amount_text">0.00</td><input type="hidden" name="total_estimated_amount" class="total_estimated_amount" value=""></tr>';
		
		echo json_encode($html);

	}


	public function estimate_details($hid)
	{	
		$curUser = $this->admin_session_data['user_id'];

		$data['estimation_details'] = $this->mbudget->estimation_details($hid);

		$financial_year = $data['estimation_details']['financial_year'];
		$billing_month = $data['estimation_details']['expense_month'];
			
		$arr = explode("-", $financial_year, 2);
		$startYear = $arr[0];
		$endYear = $arr[1];

		$month_name = date("M", mktime(0, 0, 0, $billing_month, 10));

		if($billing_month > '03'){
			$data['fYear'] = $month_name.' '.$startYear;
		} else {
			$data['fYear'] = $month_name.' '.$endYear;
		}

		$data['property_list'] = $this->mbudget->property_list($curUser);

		$data['content'] = 'admin/budget/estimate_details';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function approval_submit()
	{	

		$budget_header_id = $this->input->post('budget_header_id');
		$total_approved_amount = $this->input->post('total_approved_amount');
		$approval_remarks = $this->input->post('approval_remarks');

		$budget_details_id = $this->input->post('budget_details_id');
		$approved_expence_amount = $this->input->post('approved_expence_amount');

		$budgetHeaderarray = array(
			'approved_expence_total' => $total_approved_amount,
			'approval_remarks'=> $approval_remarks,
			'approved_by' => $this->admin_session_data['user_id'],
			'approved_ts' => date('Y-m-d H:i:s'),
			'updated_by' => $this->admin_session_data['user_id']
		);

		$conditionHeader = array('budget_header_id'=> $budget_header_id);

		$this->mbudget->budget_header_update($budgetHeaderarray,$conditionHeader);


		$budgetDetailsarray = array();

		$i = 0;
		foreach($budget_details_id as $did){

			$detailArray = array();

			$detailArray['budget_details_id'] = $did;
			$detailArray['approved_expence_amount'] = $approved_expence_amount[$i];
			$detailArray['updated_by'] = $this->admin_session_data['user_id'];

			$budgetDetailsarray[] = $detailArray;

			$i++;

		}

		//echo "<pre>"; print_r($transDetailsarray); die;

		$detailsResult = $this->mbudget->budget_details_update($budgetDetailsarray);

		if($detailsResult){
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Approved Budget Successfully Submitted.</div>');
			redirect("admin/budget/approved_budget");
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
			redirect("admin/budget/approved_budget");
		}

		
	}


	public function approved_details($hid)
	{	
		$curUser = $this->admin_session_data['user_id'];

		$data['estimation_details'] = $this->mbudget->estimation_details($hid);

		$financial_year = $data['estimation_details']['financial_year'];
		$billing_month = $data['estimation_details']['expense_month'];
			
		$arr = explode("-", $financial_year, 2);
		$startYear = $arr[0];
		$endYear = $arr[1];

		$month_name = date("M", mktime(0, 0, 0, $billing_month, 10));

		if($billing_month > '03'){
			$data['fYear'] = $month_name.' '.$startYear;
		} else {
			$data['fYear'] = $month_name.' '.$endYear;
		}

		$data['property_list'] = $this->mbudget->property_list($curUser);

		$data['content'] = 'admin/budget/approved_details';
		$this->load->view('admin/layouts/index', $data); 
	}

}
