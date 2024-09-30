<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/mdashboard', 'mcommon', 'admin/mproperty'));

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
		$data = array();
		
		$data['financial_years'] = $this->mcommon->getDetails('financial_year_master', array('is_active' => 1));
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mcommon->getDetailsOrder('property_master', array('property_master.is_active' => 1), 'property_id', 'ASC') : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		//echo '<pre>'; print_r($data['properties']); die;
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN){
			$data['dashBoardDetail'] = $this->mdashboard->get_dashboard_details();
			$data['total_revenue'] = $this->mdashboard->get_total_revenue();
			//echo '<pre>'; print_r($data['dashBoardDetail']); die;
		}
		else {
			$parent_properties = $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
			$parent_properties = !empty($parent_properties) ? array_column($parent_properties, 'property_id') : array();
			if(!empty($parent_properties)){
				$data['guestHouseBooking'] = $this->mdashboard->get_guest_house_booking_property_id($parent_properties);
				$data['guestHouseRevenue'] = $this->mdashboard->get_guest_house_revenue_property_id($parent_properties, 'booking');
				$data['posRevenue'] = $this->mdashboard->get_restaurant_revenue_property_id($parent_properties);
			}
		}
		//echo "<pre>"; print_r($data['guestHouseBooking']); die;
		
		
		//for revenue graph
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : (($this->admin_session_data['role_id'] == ROLE_SUPERADMIN) ? 2 : $data['properties'][0]['property_id']);
		$data['financialYear']= $this->input->post('financial_year') != '' ? $this->input->post('financial_year') : getFinancialYear(date('Y-m-d'), 'Y', 'y');
		
		
		$get_financial_year_data = $this->mcommon->getRow('financial_year_master', array('financial_year' => $data['financialYear']));
		$start    = (new DateTime($get_financial_year_data['fin_start_date']))->modify('first day of this month');
		$end      = (new DateTime($get_financial_year_data['fin_end_date']))->modify('first day of next month');
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);
		
		$lists = $this->mdashboard->get_revenue_details($period,$data['property']);
		
		if(!empty($lists)){
			foreach($lists as $key => $row){
				$month_arr[] = '"'.$key.'"';
				
				foreach($row as $rr){
					$revenue_arr[] = ($rr['total_revenue'] != '') ? $rr['total_revenue'] : 0;
				}
			}
			
			$data['months'] = implode(',', $month_arr);
			$data['revenues'] = implode(',', $revenue_arr);
		}
		
		//end revenue graph
		
		//for booking graph
		$data['property_b']= $this->input->post('property_b') != '' ? $this->input->post('property_b') : (($this->admin_session_data['role_id'] == ROLE_SUPERADMIN) ? 2 : $data['properties'][0]['property_id']);
		$data['financialYearB']= $this->input->post('financial_year_b') != '' ? $this->input->post('financial_year_b') : getFinancialYear(date('Y-m-d'), 'Y', 'y');
		
		
		$get_financial_year_dataB = $this->mcommon->getRow('financial_year_master', array('financial_year' => $data['financialYearB']));
		$startB    = (new DateTime($get_financial_year_dataB['fin_start_date']))->modify('first day of this month');
		$endB      = (new DateTime($get_financial_year_dataB['fin_end_date']))->modify('first day of next month');
		$intervalB = DateInterval::createFromDateString('1 month');
		$periodB   = new DatePeriod($startB, $intervalB, $endB);
		
		/*foreach($periodB as $dt){
			echo $dt->format("m").'<br>';
		}
		die;*/
		
		$listsB = $this->mdashboard->get_booking_details($periodB,$data['property_b']);
		//echo "<pre>"; print_r($listsB); die;
		
		if(!empty($listsB)){
			foreach($listsB as $key2 => $row2){
				$monthB_arr[] = '"'.$key2.'"';
				
				foreach($row2 as $rr2){
					$booking_arr[] = ($rr2['total_booking'] != '') ? $rr2['total_booking'] : 0;
				}
			}
			
			$data['monthsB'] = implode(',', $monthB_arr);
			$data['booking'] = implode(',', $booking_arr);
		}
		
		//end revenue graph
		
		//echo $data['property'].'<br>'.$data['property_b']; die;
		
		$data['content'] = 'admin/dashboard';
		$this->load->view('admin/layouts/index', $data);
	}
	

}
