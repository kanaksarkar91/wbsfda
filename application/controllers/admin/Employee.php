<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/memployee');
		$this->load->model('admin/msportsfacilitiesrate');
		$this->load->model('admin/mgymnasiumrate');

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
	public function employee_list()
	{
		$request_data = array();
		if(!empty($this->input->post())){

			$request_data = $this->input->post();

		}
		$data['content'] = 'admin/employee/employee_list';
		$data['fieldunits'] = $this->mgymnasiumrate->get_fieldunit();  
		$data['employee_list'] = $this->memployee->get_employee_list($request_data);
		$data['request_data'] = $request_data;

		$this->load->view('admin/layouts/index', $data); 
	}

	public function payment_list()
	{
		
		$request_data = array();
		if(!empty($this->input->post())){

			$request_data = $this->input->post();

		}
		$data['content'] = 'admin/employee/payment_list';
		$data['fieldunits'] = $this->mgymnasiumrate->get_fieldunit(); 
		
		$month_start_date = date('Y-m-01');
		$month_end_date = date('Y-m-31');
		if (isset($request_data['daterange']) && !empty($request_data['daterange'])) {

            $daterange = explode(' - ', $request_data['daterange']);
            $month_start_date = date('Y-m-d', strtotime(trim($daterange[0])));
            $month_end_date = date('Y-m-d', strtotime(trim($daterange[1])));
		}
		
		$data['member_list'] = $this->memployee->get_payment_list($month_start_date,$month_end_date,$request_data);
		$data['request_data'] = $request_data;

		$this->load->view('admin/layouts/index', $data); 
	}

	

	public function member_list()
	{
		
		$request_data = array();
		if(!empty($this->input->post())){

			$request_data = $this->input->post();

		}
		$data['content'] = 'admin/employee/member_list';
		$data['fieldunits'] = $this->mgymnasiumrate->get_fieldunit(); 

		$data['member_list'] = $this->memployee->get_member_list($request_data);
		$data['request_data'] = $request_data;


		$this->load->view('admin/layouts/index', $data); 
	}

	public function non_employee_list()
	{
		
		$request_data = array();
		if(!empty($this->input->post())){

			$request_data = $this->input->post();

		}
		$data['content'] = 'admin/employee/non_employee_list';
		$data['fieldunits'] = $this->mgymnasiumrate->get_fieldunit();  

		$data['non_employee_list'] = $this->memployee->get_non_employee_list($request_data);
		$data['request_data'] = $request_data;

		//echo '<pre>';print_r($data['non_employee_list']);die;
		$this->load->view('admin/layouts/index', $data); 
	}

	public function update_employee_status(){
		//echo 1;die;
		
		$result = $this->db->update('users_gymnasium', array('employee_approval_status'=>$this->input->post('employee_approval_status'),'booking_status'=>$this->input->post('employee_approval_status')), array('users_gymnasium_id' => $this->input->post('users_gymnasium_id')));
			
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Employee approval status changed successfully');
			redirect("admin/employee/employee_list");
		}
	}

	public function update_member_status(){
		//echo 1;die;
		$result = $this->db->update('gymnasium_member', array('status'=>$this->input->post('employee_approval_status')), array('gymnasium_member_id' => $this->input->post('gymnasium_member_id')));
			
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Member approval status changed successfully');
			redirect("admin/employee/member_list");
		}
	}

	public function update_payment_status(){
		//echo 1;die;
		$payment_data = array(
			'user_id' => $this->input->post('user_id'),
			'gymnasium_rate_id' => $this->input->post('gymnasium_rate_id'),
			'gymnasium_member_id' => $this->input->post('gymnasium_member_id'),
			'month_year' => date('Y-m-01'),
			'subscription_amount' => $this->input->post('subscription_amount'),
			'payment_status' => 0,
			'created_at' => date('Y-m-d H:i:s')

		);
		
		$result = $this->db->insert('gymnasium_schedule', $payment_data);
			
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Payment settled successfully');
			redirect("admin/employee/payment_list");
		}
	}

	public function register()
	{
		$data = array();
		$reservations = array();
		$data['content'] = 'admin/reservation/register'; 
		$request_data = array();

		if(!empty($this->input->post())){
			
			$request_data['fieldunit_id'] = $this->input->post('fieldunit_id');
			$request_data['location_id'] = $this->input->post('location_id');
			$request_data['sports_facilities_id'] = $this->input->post('sports_facilities_id');
			
		} 
		
		$reservation_details = $this->mreservation->get_reservation_booking_details($request_data); 
		//print_r($reservation_details);die;
		foreach ($reservation_details as $key => $reservation) { 
			
            $description = '';
			$reservations[$key]['title'] = $reservation["sports_facilities_name"];
            $reservations[$key]['start'] = date('Y-m-d',strtotime($reservation["start_date"]));
            $reservations[$key]['end'] = NULL;
            
            

			$reservations[$key]['backgroundColor'] = ($reservation['status'] == 1) ? 'blue' : (($reservation['status'] == 2)?'red':(($reservation['status'] == 3)?'green':'orange')); 
			$reservations[$key]['borderColor'] = ($reservation['status'] == 1) ? 'blue' : (($reservation['status'] == 2)?'red':(($reservation['status'] == 3)?'green':'orange')); 
			
            $reservations[$key]['textColor'] = "white";
            //$reservations[$key]['display'] = "background";
			$reservations[$key]['eventColor'] = ($reservation['status'] == 1) ? 'blue' : (($reservation['status'] == 2)?'red':(($reservation['status'] == 3)?'green':'orange')); 
			

			$description .= 'Booking ID : Re-'.str_pad($reservation['booking_id'],6,"0",STR_PAD_LEFT);
			$description .= '<br> Fieldunit : '.$reservation["fieldunit_name"];
			$description .= '<br> Location : '.$reservation["location_name"];
			$description .= '<br> Organization Type : '.$reservation["category_name"];
			$description .= '<br> Organization Name : '.$reservation["organization_name"];
			$description .= '<br> Contact No : '.$reservation["contact_no"];
			$description .= '<br> Total Amount : '.$reservation["total_rate"]; 
			$description .= '<br> Status : '.(($reservation['status'] == 1) ? 'Approved' : (($reservation['status'] == 2)?'Rejected':(($reservation['status'] == 3)?'Confirmed':'Pending')));

			$reservations[$key]['description'] = $description;  
			$reservations[$key]['status'] = $reservation['status']; 

		 
            
		
		}

		
        $data['reservations'] = $reservations;
		$data['request_data'] = $request_data;

		//print_r($data['reservations']);die;

		$data['fieldunits'] = $this->msportsfacilitiesrate->get_fieldunit();

		$this->load->view('admin/layouts/index', $data);
	}
	public function view_details($booking_id)
	{
		$data = array();
		$data['reservation'] = $this->mreservation->get_reservation_details($booking_id);
		$data['reservation_details'] = $this->mreservation->get_sports_facilities_booking_details($booking_id);
		$data['content'] = 'admin/reservation/view_details';
		$this->load->view('admin/layouts/index', $data);
	}

	public function payment($booking_id)
	{
		$data = array();
		$data['reservation'] = $this->mreservation->get_reservation_details($booking_id);
		$data['reservation_details'] = $this->mreservation->get_sports_facilities_booking_details($booking_id);
		$data['content'] = 'admin/reservation/payment';
		$this->load->view('admin/layouts/index', $data);
	}

	
	public function submitreservation()
	{
		//echo '<pre>';print_r($this->input->post());die;
		
		
			$data = array(
				'discount' => $this->input->post('discount'),
				'amount_after_discount' => $this->input->post('amount_after_discount'),
				'gst_percentage' => $this->input->post('gst_percentage'),
				'gst_amount' => $this->input->post('gst_amount'),
				'net_amount' => $this->input->post('net_amount'),
				'remarks' => $this->input->post('remarks'),
				'status' => $this->input->post('status'),
				'updated_at' => date('Y-m-d H:i:s')
			);

			

			if($this->input->post('discount') > 0){

				$data['discount_given_by'] = $this->admin_session_data['user_id'];
				$data['discount_given_ts'] = date('Y-m-d H:i:s');
				
			}
			if($this->input->post('status') == 1){ 

				$data['approval_valid_till'] = date('Y-m-d H:i:59',strtotime($this->input->post('approval_valid_till')));
				$data['payment_method'] = $this->input->post('payment_method');
				$data['approved_by'] = $this->admin_session_data['user_id'];
				$data['approved_ts'] = date('Y-m-d H:i:s');


			} elseif($this->input->post('status') == 2){
				
				$data['rejection_reason'] = $this->input->post('rejection_reason');
				$data['rejected_by'] = $this->admin_session_data['user_id'];
				$data['rejected_ts'] = date('Y-m-d H:i:s');

			}

			if($this->input->post('net_amount') == 0){
				$data['status'] = '3';
				$data['payment_method'] = 'Offline';

			}

			if($this->input->post('organization_type') == 5){
				
				$data['payment_method'] = 'Offline';

			}

			

			$condition = array('booking_id'=>$this->input->post('booking_id'));

			$result = $this->mreservation->update_reservation($data,$condition);
				
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Booking Updated Successfully');
				redirect("admin/reservation");
			}
	}


	public function submitpayment()
	{
		//echo '<pre>';print_r($this->input->post());die;
		
		
			$data = array(
				'booking_id' => $this->input->post('booking_id'),
				'check_draft_no' => $this->input->post('check_draft_no'),
				'branch_name' => $this->input->post('branch_name'),
				'bank_name' => $this->input->post('bank_name'),
				'check_draft_date' => date('Y-m-d',strtotime($this->input->post('check_draft_date'))),
				'amount' => $this->input->post('net_amount'),
				'remarks' => $this->input->post('remarks'),
				'created_by' => $this->admin_session_data['user_id'],
				'created_ts' => date('Y-m-d H:i:s')
			);

			$this->db->insert('sports_facilities_booking_payments',$data);

			$result = $this->db->update('sports_facilities_booking', array('status'=>'3'), array('booking_id' => $this->input->post('booking_id')));
			
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Payment Collected Successfully');
				redirect("admin/reservation");
			}
	}

	public function download_employee_list()
    {   
		$request_data = array();
		if(!empty($this->input->get())){

			$request_data = $this->input->get();

		} 
		$employee_list = $this->memployee->get_employee_list($request_data);
		
		// include('Classes/PHPExcel.php');
		$this->load->library('excel');
	
		// $objPHPExcel    =   new PHPExcel();
	
		$this->excel->setActiveSheetIndex(0);
	
		$this->excel->getActiveSheet()->SetCellValue('A1', "SL NO.");
		$this->excel->getActiveSheet()->SetCellValue('B1', "Employee ID");
		$this->excel->getActiveSheet()->SetCellValue('C1', "Employee Name");
		$this->excel->getActiveSheet()->SetCellValue('D1', "Mobile no");
		$this->excel->getActiveSheet()->SetCellValue('E1', 'Division');
		$this->excel->getActiveSheet()->SetCellValue('F1', "Department");
		$this->excel->getActiveSheet()->SetCellValue('G1', "Designation");
		$this->excel->getActiveSheet()->SetCellValue('H1', "Created Date");
		$this->excel->getActiveSheet()->SetCellValue('I1', "Status");
	
		$this->excel->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true);
	
		$rowCount   =   2;
		$sl_no   =   1;
		foreach ($employee_list as $row) {
	
			$this->excel->getActiveSheet()->SetCellValue('A' . $rowCount, $sl_no);
			$this->excel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['employee_id']);
			$this->excel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['name']);
			$this->excel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['phone']);
			$this->excel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['fieldunit_name']);
			$this->excel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['department']);
			$this->excel->getActiveSheet()->SetCellValue('G' . $rowCount, $row['designation']);
			$this->excel->getActiveSheet()->SetCellValue('H' . $rowCount, date('d-m-Y', strtotime($row['created_at'])));
			$this->excel->getActiveSheet()->SetCellValue('I' . $rowCount, (($row['employee_approval_status'] == 1) ? 'Approved' : (($row['employee_approval_status'] == 2)?'Rejected':'Pending')));

			$rowCount++;
			$sl_no++;
		}
	
		$filename = 'Employee_List_' . time() . '.xlsx';
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit;
    }

	public function download_member_list()
    {   
		$request_data = array();
		if(!empty($this->input->get())){

			$request_data = $this->input->get();

		} 
		$member_list = $this->memployee->get_member_list($request_data);
		
		// include('Classes/PHPExcel.php');
		$this->load->library('excel');
	
		// $objPHPExcel    =   new PHPExcel();
	
		$this->excel->setActiveSheetIndex(0);
	
		$this->excel->getActiveSheet()->SetCellValue('A1', "SL NO.");
		$this->excel->getActiveSheet()->SetCellValue('B1', "Member Name");
		$this->excel->getActiveSheet()->SetCellValue('C1', "Sponsor Person");
		$this->excel->getActiveSheet()->SetCellValue('D1', "Relationship");
		$this->excel->getActiveSheet()->SetCellValue('E1', 'Division');
		$this->excel->getActiveSheet()->SetCellValue('F1', "Gymnasium");
		$this->excel->getActiveSheet()->SetCellValue('G1', "Created Date");
		$this->excel->getActiveSheet()->SetCellValue('H1', "Status");
	
		$this->excel->getActiveSheet()->getStyle("A1:H1")->getFont()->setBold(true);
	
		$rowCount   =   2;
		$sl_no   =   1;
		foreach ($member_list as $row) {
	
			$this->excel->getActiveSheet()->SetCellValue('A' . $rowCount, $sl_no);
			$this->excel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['member_name']);
			$this->excel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['sponsored_person']." Emp ID:".$row['employee_id']." Phone:".$row['phone']);
			$this->excel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['relation']);
			$this->excel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['fieldunit_name']);
			$this->excel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['sports_facilities_name']);
			$this->excel->getActiveSheet()->SetCellValue('G' . $rowCount, date('d-m-Y', strtotime($row['created_at'])));
			$this->excel->getActiveSheet()->SetCellValue('H' . $rowCount, (($row['status'] == 0) ? 'Approved' : (($row['status'] == 2)?'Rejected':'Pending')));

			$rowCount++;
			$sl_no++;
		}
	
		$filename = 'Member_List_' . time() . '.xlsx';
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit;
    }

	public function download_non_employee_list()
    {   
		$request_data = array();
		if(!empty($this->input->get())){

			$request_data = $this->input->get();

		} 
		$non_employee_list = $this->memployee->get_non_employee_list($request_data);
		
		// include('Classes/PHPExcel.php');
		$this->load->library('excel');
	
		// $objPHPExcel    =   new PHPExcel();
	
		$this->excel->setActiveSheetIndex(0);
	
		$this->excel->getActiveSheet()->SetCellValue('A1', "SL NO.");
		$this->excel->getActiveSheet()->SetCellValue('B1', "Name");
		$this->excel->getActiveSheet()->SetCellValue('C1', "Mobile no");
		$this->excel->getActiveSheet()->SetCellValue('D1', "Address");
		$this->excel->getActiveSheet()->SetCellValue('E1', 'Date of Birth');
		$this->excel->getActiveSheet()->SetCellValue('F1', "Gender");
		$this->excel->getActiveSheet()->SetCellValue('G1', "Profession");
		$this->excel->getActiveSheet()->SetCellValue('H1', "Gymnasium");
		$this->excel->getActiveSheet()->SetCellValue('I1', "Created Date");
	
		$this->excel->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true);
	
		$rowCount   =   2;
		$sl_no   =   1;
		foreach ($non_employee_list as $row) {
	
			$this->excel->getActiveSheet()->SetCellValue('A' . $rowCount, $sl_no);
			$this->excel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['name']);
			$this->excel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['phone']);
			$this->excel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['full_address']);
			$this->excel->getActiveSheet()->SetCellValue('E' . $rowCount, date('d-m-Y',strtotime($row['dob'])));
			$this->excel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['gender']);
			$this->excel->getActiveSheet()->SetCellValue('G' . $rowCount, $row['profession_name']);
			$this->excel->getActiveSheet()->SetCellValue('H' . $rowCount, $row['sports_facilities_name']);
			$this->excel->getActiveSheet()->SetCellValue('I' . $rowCount, date('d-m-Y', strtotime($row['created_at'])));

			$rowCount++;
			$sl_no++;
		}
	
		$filename = 'Non_Employee_List_' . time() . '.xlsx';
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit;
    }

	public function download_payment_list()
    {   
		$request_data = array();
		if(!empty($this->input->get())){

			$request_data = $this->input->get();

		} 
		$month_start_date = date('Y-m-01');
		$month_end_date = date('Y-m-31');
		if (isset($request_data['daterange']) && !empty($request_data['daterange'])) {

            $daterange = explode(' - ', $request_data['daterange']);
            $month_start_date = date('Y-m-d', strtotime(trim($daterange[0])));
            $month_end_date = date('Y-m-d', strtotime(trim($daterange[1])));
		}
		
		$payment_list = $this->memployee->get_payment_list($month_start_date,$month_end_date,$request_data);
		
		// include('Classes/PHPExcel.php');
		$this->load->library('excel');
	
		// $objPHPExcel    =   new PHPExcel();
	
		$this->excel->setActiveSheetIndex(0);
	
		$this->excel->getActiveSheet()->SetCellValue('A1', "SL NO.");
		$this->excel->getActiveSheet()->SetCellValue('B1', "Member Name");
		$this->excel->getActiveSheet()->SetCellValue('C1', "Sponsor Person");
		$this->excel->getActiveSheet()->SetCellValue('D1', "Relationship");
		$this->excel->getActiveSheet()->SetCellValue('E1', 'Division');
		$this->excel->getActiveSheet()->SetCellValue('F1', "Gymnasium");
		$this->excel->getActiveSheet()->SetCellValue('G1', "Amount");
		$this->excel->getActiveSheet()->SetCellValue('H1', "Paid Date");
		$this->excel->getActiveSheet()->SetCellValue('I1', "Status");
	
		$this->excel->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true);
	
		$rowCount   =   2;
		$sl_no   =   1;
		foreach ($payment_list as $row) {

			$monthly_subscription_fee_str =  $row['monthly_subscription_fee'];
			$monthly_subscription_fee_arr = explode('|#|',$monthly_subscription_fee_str);

			$monthly_subscription_fee =  $monthly_subscription_fee_arr[0];
			$gymnasium_rate_id =  $monthly_subscription_fee_arr[1];
			$registration_fee = $monthly_subscription_fee_arr[2];
	
			$this->excel->getActiveSheet()->SetCellValue('A' . $rowCount, $sl_no);
			$this->excel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['member_name']);
			$this->excel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['sponsored_person']." Emp ID:".$row['employee_id']." Phone:".$row['phone']);
			$this->excel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['relation']);
			$this->excel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['fieldunit_name']);
			$this->excel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['sports_facilities_name']);
			$this->excel->getActiveSheet()->SetCellValue('G' . $rowCount, ($row['subscription_amount'])?$row['subscription_amount']:$monthly_subscription_fee);
			$this->excel->getActiveSheet()->SetCellValue('H' . $rowCount, ($row['payment_time'])?$row['payment_time']:'N/A');
			$this->excel->getActiveSheet()->SetCellValue('I' . $rowCount, (($row['payment_status'] == 0) ? 'Settled' : 'Unsettled'));

			$rowCount++;
			$sl_no++;
		}
	
		$filename = 'Payment_List_' . time() . '.xlsx';
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit;
    }
	

}
