<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wages extends MY_Controller
{
	//private $menu_id;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model(array('admin/mwages', 'mcommon'));
		//$this->menu_id = 24;

	}

	public function index()
	{	
		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){

			$property_id = $this->input->post('property_id');
			$financial_year = $this->input->post('financial_year');
			$billing_month = $this->input->post('billing_month');

			$data['wage_estimate_list'] = $this->mwages->wage_estimate_list($property_id,$financial_year,$billing_month);

			$data['property_id'] = $property_id;
			$data['financial_year'] = $financial_year;
			$data['billing_month'] = $billing_month;

		} else {

			$data['wage_estimate_list'] = '';

			$data['property_id'] = '';
			$data['financial_year'] = '';
			$data['billing_month'] = '';

		}

		$data['property_list'] = $this->mwages->property_list($curUser);

		$data['content'] = 'admin/wages/list';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function update_wages()
	{

		$roleId = $this->admin_session_data['role_id'];

		$estimateId = $this->input->post('wages_estimate_id');
		$wageRemarks = $this->input->post('wage_remarks');
		$wageStatus = $this->input->post('wage_status');

		//echo "<pre>"; print_r($this->input->post()); die;

		$result = $this->mwages->update_wages($roleId,$estimateId,$wageRemarks,$wageStatus);

		if($result){

			if($wageStatus == 2){

				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Wages Estimate Successfully Rejected.</div>');
				redirect("admin/wages");

			} else {

				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Wages Estimate Successfully Approved.</div>');
				redirect("admin/wages");

			}			

		} else {

			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
			redirect("admin/wages");

		}

	}

	public function approval_submit()
	{

		$wagedetailid = $this->input->post('wagedetailid');
		$approvedPaybleday = $this->input->post('approvedPaybleday');
		$approvedTotalwages = $this->input->post('approvedTotalwages');

		$wagesEstimateid = $this->input->post('wagesEstimateid');

		$result = $this->mwages->approval_submit($wagedetailid,$approvedPaybleday,$approvedTotalwages,$wagesEstimateid);

		if($result){
			echo 1;
		}

	}


	public function approval_submit_adm()
	{

		$wagedetailid = $this->input->post('wagedetailid');
		$approvedPaybleday = $this->input->post('approvedPaybleday');
		$approvedTotalwages = $this->input->post('approvedTotalwages');

		$result = $this->mwages->approval_submit_adm($wagedetailid,$approvedPaybleday,$approvedTotalwages);

		if($result){
			echo 1;
		}

	}


	public function approval_submit_cao()
	{

		$wagedetailid = $this->input->post('wagedetailid');

		$result = $this->mwages->approval_submit_cao($wagedetailid);

		if($result){
			echo 1;
		}

	}


	public function approval_submit_md()
	{

		$wagedetailid = $this->input->post('wagedetailid');

		$result = $this->mwages->approval_submit_md($wagedetailid);

		if($result){
			echo 1;
		}

	}


	public function reject_submit_adm()
	{

		$wagedetailid = $this->input->post('wagedetailid');

		$result = $this->mwages->reject_submit_adm($wagedetailid);

		if($result){
			echo 1;
		}

	}


	public function reject_submit_cao()
	{

		$wagedetailid = $this->input->post('wagedetailid');

		$result = $this->mwages->reject_submit_cao($wagedetailid);

		if($result){
			echo 1;
		}

	}

	public function reject_submit_md()
	{

		$wagedetailid = $this->input->post('wagedetailid');

		$result = $this->mwages->reject_submit_md($wagedetailid);

		if($result){
			echo 1;
		}

	}

	public function add_wage_estimate()
	{	
		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){
			
			if(check_user_permission(89, 'add_flag')){ //Draft Estimate

				$wagearray = array(
					'harbour_id' => $this->input->post('property_id'),
					'financial_year'=> $this->input->post('financial_year'),
					'estimate_month' => $this->input->post('billing_month'),
					'cash_in_hand' => $this->input->post('cash_in_hand'),
					'cash_at_bank' => $this->input->post('cash_at_bank'),
					'estimated_remarks' => $this->input->post('wage_remarks'),
					'is_publish' => '0',
					'created_by' => $this->admin_session_data['user_id']
				);
	
				$checkWage = $this->mwages->check_wage_estimate($wagearray);
	
				if($checkWage){
	
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Wages Estimate already exist for this Unit, Financial Year and Month.</div>');
					redirect("admin/wages");
	
				} else {
	
					$result = $this->mwages->add_wage_estimate($wagearray);
	
					if($result){
	
						//Multiple File Upload
						$dataFiles = array();
	
						if(!empty($_FILES['wage_files']['name'][0])){
	
							$count = count($_FILES['wage_files']['name']);
	
							for($j=0;$j<$count;$j++){
	
								$_FILES['file']['name'] = $_FILES['wage_files']['name'][$j];			  
								$_FILES['file']['type'] = $_FILES['wage_files']['type'][$j];			  
								$_FILES['file']['tmp_name'] = $_FILES['wage_files']['tmp_name'][$j];			  
								$_FILES['file']['error'] = $_FILES['wage_files']['error'][$j];			  
								$_FILES['file']['size'] = $_FILES['wage_files']['size'][$j];		  
						
					
								$config['upload_path'] = './public/wage_files'; 			  
								$config['allowed_types'] = 'jpg|jpeg|png|pdf';			  
								$config['max_size'] = '5000';			  
								$config['file_name'] = $_FILES['wage_files']['name'][$j];
	
								$this->load->library('upload',$config); 		  
								$this->upload->initialize( $config );
					
								if($this->upload->do_upload('file')){
					
									$uploadData = $this->upload->data();			  
									$filename = $uploadData['file_name'];	
	
									$dataFiles['wage_file_title'] = $filename;
									$dataFiles['wages_details_id'] = $result;
	
									$this->mwages->wage_details_file_insert($dataFiles);
					
								}
	
							}
	
						}
						//Multiple File Upload
	
						$worker_id = $this->input->post('worker_id');
						$daily_wage_amount = $this->input->post('daily_wage_amount');
						$payable_days = $this->input->post('payable_days');
						$festive_bonus = $this->input->post('festive_bonus');
						$gross_wages = $this->input->post('gross_wages');
						$p_tax = $this->input->post('p_tax');
						$employee_cnt = $this->input->post('employee_cnt');
						$employer_cnt = $this->input->post('employer_cnt');
						$total_deduct = $this->input->post('total_deduct');
						$total_wage_amount = $this->input->post('total_wage_amount');
	
						$wagedetailsarray = array();
	
						$i = 0;
						foreach($worker_id as $wid){
	
							$detailArray = array();
	
							$detailArray['estimate_id'] = $result;
							$detailArray['worker_id'] = $wid;
							$detailArray['daily_wages_amount'] = $daily_wage_amount[$i];
							$detailArray['payable_day'] = $payable_days[$i];
							$detailArray['festive_bonus'] = $festive_bonus[$i];
							$detailArray['gross_wages'] = $gross_wages[$i];
							$detailArray['p_tax'] = $p_tax[$i];
							$detailArray['pf_employee_contribution'] = $employee_cnt[$i];
							$detailArray['pf_employer_contribution'] = $employer_cnt[$i];
							$detailArray['total_deduct'] = $total_deduct[$i];
							$detailArray['total_wages_amount'] = $total_wage_amount[$i];
							$detailArray['created_by'] = $this->admin_session_data['user_id'];
	
							$wagedetailsarray[] = $detailArray;
	
							$i++;
	
						}					
			
						$detailsresult = $this->mwages->add_wage_estimatedetails($wagedetailsarray);
	
						if($detailsresult){
	
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Wages Estimation Successfully Drafted.</div>');
							redirect("admin/wages");
	
						} else {
							$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
							redirect("admin/wages");
						}
						
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
						redirect("admin/wages");
					}
	
				}

			} else if(check_user_permission(90, 'add_flag')){ //Publish Estimate

				$wagearray = array(
					'harbour_id' => $this->input->post('property_id'),
					'financial_year'=> $this->input->post('financial_year'),
					'estimate_month' => $this->input->post('billing_month'),
					'cash_in_hand' => $this->input->post('cash_in_hand'),
					'cash_at_bank' => $this->input->post('cash_at_bank'),
					'estimated_remarks' => $this->input->post('wage_remarks'),
					'is_publish' => '1',
					'created_by' => $this->admin_session_data['user_id']
				);
	
				$checkWage = $this->mwages->check_wage_estimate($wagearray);
	
				if($checkWage){
	
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Wages Estimate already exist for this Unit, Financial Year and Month.</div>');
					redirect("admin/wages");
	
				} else {
	
					$result = $this->mwages->add_wage_estimate($wagearray);
	
					if($result){
	
						//Multiple File Upload
						$dataFiles = array();
	
						if(!empty($_FILES['wage_files']['name'][0])){
	
							$count = count($_FILES['wage_files']['name']);
	
							for($j=0;$j<$count;$j++){
	
								$_FILES['file']['name'] = $_FILES['wage_files']['name'][$j];			  
								$_FILES['file']['type'] = $_FILES['wage_files']['type'][$j];			  
								$_FILES['file']['tmp_name'] = $_FILES['wage_files']['tmp_name'][$j];			  
								$_FILES['file']['error'] = $_FILES['wage_files']['error'][$j];			  
								$_FILES['file']['size'] = $_FILES['wage_files']['size'][$j];		  
						
					
								$config['upload_path'] = './public/wage_files'; 			  
								$config['allowed_types'] = 'jpg|jpeg|png|pdf';			  
								$config['max_size'] = '5000';			  
								$config['file_name'] = $_FILES['wage_files']['name'][$j];
	
								$this->load->library('upload',$config); 		  
								$this->upload->initialize( $config );
					
								if($this->upload->do_upload('file')){
					
									$uploadData = $this->upload->data();			  
									$filename = $uploadData['file_name'];	
	
									$dataFiles['wage_file_title'] = $filename;
									$dataFiles['wages_details_id'] = $result;
	
									$this->mwages->wage_details_file_insert($dataFiles);
					
								}
	
							}
	
						}
						//Multiple File Upload
	
						$worker_id = $this->input->post('worker_id');
						$daily_wage_amount = $this->input->post('daily_wage_amount');
						$payable_days = $this->input->post('payable_days');
						$festive_bonus = $this->input->post('festive_bonus');
						$gross_wages = $this->input->post('gross_wages');
						$p_tax = $this->input->post('p_tax');
						$employee_cnt = $this->input->post('employee_cnt');
						$employer_cnt = $this->input->post('employer_cnt');
						$total_deduct = $this->input->post('total_deduct');
						$total_wage_amount = $this->input->post('total_wage_amount');
	
						$wagedetailsarray = array();
	
						$i = 0;
						foreach($worker_id as $wid){
	
							$detailArray = array();
	
							$detailArray['estimate_id'] = $result;
							$detailArray['worker_id'] = $wid;
							$detailArray['daily_wages_amount'] = $daily_wage_amount[$i];
							$detailArray['payable_day'] = $payable_days[$i];
							$detailArray['festive_bonus'] = $festive_bonus[$i];
							$detailArray['gross_wages'] = $gross_wages[$i];
							$detailArray['p_tax'] = $p_tax[$i];
							$detailArray['pf_employee_contribution'] = $employee_cnt[$i];
							$detailArray['pf_employer_contribution'] = $employer_cnt[$i];
							$detailArray['total_deduct'] = $total_deduct[$i];
							$detailArray['total_wages_amount'] = $total_wage_amount[$i];
							$detailArray['created_by'] = $this->admin_session_data['user_id'];
	
							$wagedetailsarray[] = $detailArray;
	
							$i++;
	
						}					
			
						$detailsresult = $this->mwages->add_wage_estimatedetails($wagedetailsarray);
	
						if($detailsresult){
	
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Wages Estimation Successfully Published.</div>');
							redirect("admin/wages");
	
						} else {
							$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
							redirect("admin/wages");
						}
						
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
						redirect("admin/wages");
					}
	
				}

			} else {

				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Do not have permission for Draft or Submit Estimate.</div>');

			}			

		}

		$data['property_list'] = $this->mwages->property_list($curUser);

		$data['content'] = 'admin/wages/add_wage_estimate';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function review_publish_wages($estId){

		$data['wage_estimate_details'] = $this->mwages->wage_estimate_details($estId);

		$data['content'] = 'admin/wages/review_publish';
		$this->load->view('admin/layouts/index', $data);

	}


	public function publish_wages(){

		$estimate_id = $this->input->post('estimate_id');

		$wagearray = array(
			'cash_in_hand' => $this->input->post('cash_in_hand'),
			'cash_at_bank' => $this->input->post('cash_at_bank'),
			'estimated_remarks' => $this->input->post('wage_remarks'),
			'is_publish' => '1'
		);

		$result = $this->mwages->publish_wage_estimate($wagearray,$estimate_id);

		if($result){

			//Multiple File Upload
			$dataFiles = array();
	
			if(!empty($_FILES['wage_files']['name'][0])){

				$this->mwages->wage_details_file_delete($estimate_id);

				$count = count($_FILES['wage_files']['name']);

				for($j=0;$j<$count;$j++){

					$_FILES['file']['name'] = $_FILES['wage_files']['name'][$j];			  
					$_FILES['file']['type'] = $_FILES['wage_files']['type'][$j];			  
					$_FILES['file']['tmp_name'] = $_FILES['wage_files']['tmp_name'][$j];			  
					$_FILES['file']['error'] = $_FILES['wage_files']['error'][$j];			  
					$_FILES['file']['size'] = $_FILES['wage_files']['size'][$j];		  
			
		
					$config['upload_path'] = './public/wage_files'; 			  
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';			  
					$config['max_size'] = '5000';			  
					$config['file_name'] = $_FILES['wage_files']['name'][$j];

					$this->load->library('upload',$config); 		  
					$this->upload->initialize( $config );
		
					if($this->upload->do_upload('file')){
		
						$uploadData = $this->upload->data();			  
						$filename = $uploadData['file_name'];	

						$dataFiles['wage_file_title'] = $filename;
						$dataFiles['wages_details_id'] = $estimate_id;

						$this->mwages->wage_details_file_insert($dataFiles);
		
					}

				}

			}
			//Multiple File Upload

			$estdetail_id = $this->input->post('estdetail_id');
			$worker_id = $this->input->post('worker_id');
			$daily_wage_amount = $this->input->post('daily_wage_amount');
			$payable_days = $this->input->post('payable_days');
			$festive_bonus = $this->input->post('festive_bonus');
			$gross_wages = $this->input->post('gross_wages');
			$p_tax = $this->input->post('p_tax');
			$employee_cnt = $this->input->post('employee_cnt');
			$employer_cnt = $this->input->post('employer_cnt');
			$total_deduct = $this->input->post('total_deduct');
			$total_wage_amount = $this->input->post('total_wage_amount');

			$wagedetailsarray = array();

			$i = 0;
			foreach($estdetail_id as $did){

				$detailArray = array();

				$detailArray['wages_details_id'] = $did;
				$detailArray['worker_id'] = $worker_id[$i];
				$detailArray['daily_wages_amount'] = $daily_wage_amount[$i];
				$detailArray['payable_day'] = $payable_days[$i];
				$detailArray['festive_bonus'] = $festive_bonus[$i];
				$detailArray['gross_wages'] = $gross_wages[$i];
				$detailArray['p_tax'] = $p_tax[$i];
				$detailArray['pf_employee_contribution'] = $employee_cnt[$i];
				$detailArray['pf_employer_contribution'] = $employer_cnt[$i];
				$detailArray['total_deduct'] = $total_deduct[$i];
				$detailArray['total_wages_amount'] = $total_wage_amount[$i];

				$wagedetailsarray[] = $detailArray;

				$i++;

			}					

			$detailsresult = $this->mwages->update_wage_estimatedetails($wagedetailsarray);

			if($detailsresult){
	
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Wages Estimation Successfully Published.</div>');
				redirect("admin/wages");

			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
				redirect("admin/wages");
			}

		}


	}


	public function wage_workerlist()
	{

		$curUser = $this->admin_session_data['user_id'];
		$propertyId = $this->input->post('propertyId');

		$result = $this->mwages->wage_workerlist($propertyId);

		//echo "<pre>"; print_r($result); die;

		$html = '';

		foreach($result as $res){

			$html .= '<tr class="wageItem">
						<td width="" class="cell fw-bold">'.$res['worker_name'].'<input type="hidden" class="" name="worker_id[]" value="'.$res['worker_master_id'].'"></td>
						<td width="" class="cell text-end">
							<div class="input-group">
								<!--<span class="input-group-text" id="basic-addon1">Rs.</span>-->
								<input type="text" class="form-control text-end fw-bold daily_wage_amount" name="daily_wage_amount[]" value="'.$res['daily_wage_amount'].'" readonly>
							</div>
						</td>
						<td width="" class="cell">
							<div class="input-group">
								<input type="number" class="form-control payable_days" name="payable_days[]" placeholder="0" value="">
							</div>
						</td>
						<td width="" class="cell">
							<div class="input-group">
								<input type="number" class="form-control text-end fw-bold festive_bonus" name="festive_bonus[]" placeholder="0.00" value="">
							</div>
						</td>
						<td width="" class="cell">
							<div class="input-group">
								<input type="text" class="form-control text-end fw-bold gross_wages" name="gross_wages[]" placeholder="0.00" value="" readonly>
							</div>
						</td>
						<td width="" class="cell">
							<div class="input-group">
								<input type="number" class="form-control text-end fw-bold p_tax" name="p_tax[]" placeholder="0.00" value="">
							</div>
						</td>
						<td width="" class="cell">
							<div class="input-group">
								<input type="number" class="form-control text-end fw-bold employee_cnt" name="employee_cnt[]" placeholder="0.00" value="">
							</div>
						</td>
						<td width="" class="cell">
							<div class="input-group">
								<input type="number" class="form-control text-end fw-bold employer_cnt" name="employer_cnt[]" placeholder="0.00" value="">
							</div>
						</td>
						<td width="" class="cell">
							<div class="input-group">
								<input type="text" class="form-control text-end fw-bold total_deduct" name="total_deduct[]" placeholder="0.00" value="" readonly>
							</div>
						</td>
						<td width="" class="cell text-end">
							<div class="input-group">
								<input type="text" class="form-control text-end fw-bold total_wage_amount" name="total_wage_amount[]" placeholder="0.00" value="" readonly>
							</div>
						</td>
					</tr>';

		}

		echo json_encode($html);

	}


	public function worker_list()
	{	
		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){

			$property_id = $this->input->post('property_id');

			$data['wage_worker_list'] = $this->mwages->wage_worker_list_unit($curUser,$property_id);
			$data['property_id'] = $property_id;

		} else {

			$data['wage_worker_list'] = $this->mwages->wage_worker_list($curUser);
			$data['property_id'] = '';

		}
		
		$data['property_list'] = $this->mwages->property_list($curUser);

		$data['content'] = 'admin/wages/worker_list';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function add_worker()
	{	
		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){

			$this->form_validation->set_rules('worker_name','Name','trim|required|regex_match[/^([a-z ])+$/i]');
			$this->form_validation->set_rules('property_id','Unit','trim|required|numeric');
			$this->form_validation->set_rules('worker_gender', 'Gender', 'trim|in_list[Female,Transgender,Male]');
			$this->form_validation->set_rules('mobile_no', 'Mobile', 'trim|required|numeric|min_length[10]|max_length[10]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('msg', validation_errors());
				redirect("admin/wages/add_worker");
			}
			else {
				$wagearray = array(
					'harbour_id' => $this->input->post('property_id'),
					'worker_name'=> $this->input->post('worker_name'),
					'worker_gender' => $this->input->post('worker_gender'),
					'mobile_no' => $this->input->post('mobile_no'),
					'beneficiary_account_name' => $this->input->post('beneficiary_account_name'),
					'beneficiary_account_no' => $this->input->post('beneficiary_account_no'),
					'beneficiary_bank' => $this->input->post('beneficiary_bank'),
					'beneficiary_ifsc' => $this->input->post('beneficiary_ifsc'),
					'created_by' => $this->admin_session_data['user_id']
				);
	
				$result = $this->mwages->wage_worker_insert($wagearray);
	
				if($result){
	
					$wagemaparray = array(
						'worker_id' => $result,
						'wage_amount'=> $this->input->post('wage_amount'),
						'applicable_date' => date("Y-m-d", strtotime($this->input->post('bill_date'))),
						'created_by' => $this->admin_session_data['user_id']
					);
		
					$mapresult = $this->mwages->wage_workermap_insert($wagemaparray);
	
					if($mapresult){
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Wage Worker Successfully Added.</div>');
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
					}
					
				} else {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
				}
			}

		}

		$data['property_list'] = $this->mwages->property_list($curUser);

		$data['content'] = 'admin/wages/add_worker';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function edit_worker($wid)
	{	
		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){

			$this->form_validation->set_rules('worker_name','Name','trim|required|regex_match[/^([a-z ])+$/i]');
			$this->form_validation->set_rules('property_id','Unit','trim|required|numeric');
			$this->form_validation->set_rules('worker_gender', 'Gender', 'trim|in_list[Female,Transgender,Male]');
			$this->form_validation->set_rules('mobile_no', 'Mobile', 'trim|required|numeric|min_length[10]|max_length[10]');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('msg', validation_errors());
				redirect("admin/wages/add_worker");
			}
			else {
				$workerID = $this->input->post('worker_id');

				$wagearray = array(
					'harbour_id' => $this->input->post('property_id'),
					'worker_name'=> $this->input->post('worker_name'),
					'worker_gender' => $this->input->post('worker_gender'),
					'mobile_no' => $this->input->post('mobile_no'),
					'beneficiary_account_name' => $this->input->post('beneficiary_account_name'),
					'beneficiary_account_no' => $this->input->post('beneficiary_account_no'),
					'beneficiary_bank' => $this->input->post('beneficiary_bank'),
					'beneficiary_ifsc' => $this->input->post('beneficiary_ifsc'),
					'is_active' => $this->input->post('is_active'),
					'updated_by' => $this->admin_session_data['user_id']
				);
	
				$result = $this->mwages->wage_worker_update($wagearray,$workerID);
	
				if($result){
	
					$wagemaparray = array(
						'worker_id' => $workerID,
						'wage_amount'=> $this->input->post('wage_amount'),
						'applicable_date' => date("Y-m-d", strtotime($this->input->post('bill_date'))),
						'created_by' => $this->admin_session_data['user_id']
					);
		
					$mapresult = $this->mwages->wage_workermap_insert($wagemaparray);
	
					if($mapresult){
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Wage Worker Successfully Updated.</div>');
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
					}
					
				} else {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
				}
			}
		}

		$data['property_list'] = $this->mwages->property_list($curUser);
		$data['worker_details'] = $this->mwages->wage_worker_details($wid);

		$data['content'] = 'admin/wages/edit_worker';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function map_details()
	{

		$curUser = $this->admin_session_data['user_id'];
		$mapId = $this->input->post('mapId');

		$result = $this->mwages->map_details($mapId);

		echo json_encode($result);

	}


	public function submit_wages()
	{

		$curUser = $this->admin_session_data['user_id'];

		$wagemaparray = array(
			'worker_id' => $this->input->post('wworkerId'),
			'wage_amount'=> $this->input->post('wageAmount'),
			'applicable_date' => date("Y-m-d", strtotime($this->input->post('applicableDate'))),
			'created_by' => $this->admin_session_data['user_id']
		);

		$mapresult = $this->mwages->wage_workermap_insert($wagemaparray);

		if($mapresult){
			echo 1;
		}

	}


}
