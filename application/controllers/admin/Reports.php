<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/mreport', 'admin/mreservation', 'admin/mproperty', 'admin/mpos', 'mcommon', 'admin/mrevenue', 'admin/msafari_service'));
	}

	public function occupancy_report() {
		$data = array();
		$data = array('menu_id'=> 31);
		
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : ''; 
		$data['start_date']= $this->input->post('start_date') != '' ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-01'); 
		$data['end_date']= $this->input->post('end_date') != '' ? date('Y-m-d', strtotime($this->input->post('end_date'))) : date('Y-m-t');
		if($this->input->post()){
			if($this->input->post('property')){
				$where['a.property_id ='] = $this->input->post('property');
			}
		}
		
		$order_by = 'pm.property_name ASC';
		$group_by = 'a.accommodation_id';
		$data['lists'] = array();
		$property_ids = array();
		
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$properties =  $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$property_ids = array_column($properties, 'property_id');
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($property_ids)){
				$lists = $this->mreport->get_occupancy_report($where, $order_by, $property_ids, $group_by);
			}
		}
		
		//echo $this->db->last_query(); die;
		//echo '<pre>'; print_r($lists); die;
		
		if(!empty($lists)){
			foreach($lists as $key => $value){
				
				$whereB['start_date'] = date('Y-m-d', strtotime($data['start_date']));
				$whereB['end_date'] = date('Y-m-d', strtotime($data['end_date']));
				$whereB['accommodation_id'] = $value->accommodation_id;
				$getBookingDetail = $this->mreport->get_booking($whereB);
				
				//$accomCount = $this->mreport->getAccomNumRow();
				
				$data['occupancyLists'][] = array(
					'property_id' => $value->property_id,
					'accommodation_name' => $value->accommodation_name,
					'no_of_accomm' => $value->no_of_accomm,
					'property_name' => $value->property_name,
					'base_price' => $value->base_price,
					'is_dormitory' => $value->is_dormitory,
					'no_of_booking_through_month' => $getBookingDetail['total_count'],
					//'totalAccommodationCount' => $accomCount
				);
				
			}
			//die;
		}
		else {
			$data['occupancyLists'] = '';
		}
		
		//echo '<pre>'; print_r($data['occupancyLists']); die;

		$data['content'] = 'admin/reports/occupancy_report_view';
		$this->load->view('admin/layouts/index', $data);
	}
	
	
	public function revenue_report() {
		$data = array();
		$data = array('menu_id'=> 32);
		
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : ''; 
		$data['start_date']= $this->input->post('start_date') != '' ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-01'); 
		$data['end_date']= $this->input->post('end_date') != '' ? date('Y-m-d', strtotime($this->input->post('end_date'))) : date('Y-m-t');
		if($this->input->post()){
			if($this->input->post('property')){
				$where['a.property_id ='] = $this->input->post('property');
			}
		}
		
		$order_by = 'pm.property_name ASC';
		$group_by = 'a.accommodation_id';
		$data['lists'] = array();
		$property_ids = array();
		
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$properties =  $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$property_ids = array_column($properties, 'property_id');
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($property_ids)){
				$lists = $this->mreport->get_occupancy_report($where, $order_by, $property_ids, $group_by);
			}
		}
		
		//echo $this->db->last_query(); die;
		//echo '<pre>'; print_r($lists); die;
		
		if(!empty($lists)){
			foreach($lists as $key => $value){
				
				$whereB['start_date'] = date('Y-m-d', strtotime($data['start_date']));
				$whereB['end_date'] = date('Y-m-d', strtotime($data['end_date']));
				$whereB['accommodation_id'] = $value->accommodation_id;
				$getBookingDetail = $this->mreport->get_booking($whereB);
				
				//$accomCount = $this->mreport->getAccomNumRow();
				
				$data['occupancyLists'][] = array(
					'property_id' => $value->property_id,
					'accommodation_name' => $value->accommodation_name,
					'no_of_accomm' => $value->no_of_accomm,
					'property_name' => $value->property_name,
					'base_price' => $value->base_price,
					'is_dormitory' => $value->is_dormitory,
					'no_of_booking_through_month' => $getBookingDetail['total_count'],
					//'totalAccommodationCount' => $accomCount
				);
				
			}
			//die;
		}
		else {
			$data['occupancyLists'] = '';
		}
		
		//echo '<pre>'; print_r($data['occupancyLists']); die;

		$data['content'] = 'admin/reports/revenue_report_view';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function expenditure_report() {
		$data = array();
		$data = array('menu_id'=> 35);
		
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : ''; 
		$data['start_date']= $this->input->post('start_date') != '' ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-01'); 
		$data['end_date']= $this->input->post('end_date') != '' ? date('Y-m-d', strtotime($this->input->post('end_date'))) : date('Y-m-t');
		if($this->input->post()){
			if($this->input->post('property')){
				$where['a.property_id ='] = $this->input->post('property');
			}
		}
		
		$order_by = 'pm.property_name ASC';
		$group_by = 'a.accommodation_id';
		$data['lists'] = array();
		$property_ids = array();
		
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$properties =  $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$property_ids = array_column($properties, 'property_id');
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($property_ids)){
				$lists = $this->mreport->get_occupancy_report($where, $order_by, $property_ids, $group_by);
			}
		}
		
		//echo $this->db->last_query(); die;
		//echo '<pre>'; print_r($lists); die;
		
		if(!empty($lists)){
			foreach($lists as $key => $value){
				
				$whereB['start_date'] = date('Y-m-d', strtotime($data['start_date']));
				$whereB['end_date'] = date('Y-m-d', strtotime($data['end_date']));
				$whereB['accommodation_id'] = $value->accommodation_id;
				$getBookingDetail = $this->mreport->get_booking($whereB);
				
				//$accomCount = $this->mreport->getAccomNumRow();
				
				$data['occupancyLists'][] = array(
					'property_id' => $value->property_id,
					'accommodation_name' => $value->accommodation_name,
					'no_of_accomm' => $value->no_of_accomm,
					'property_name' => $value->property_name,
					'base_price' => $value->base_price,
					'is_dormitory' => $value->is_dormitory,
					'no_of_booking_through_month' => $getBookingDetail['total_count'],
					//'totalAccommodationCount' => $accomCount
				);
				
			}
			//die;
		}
		else {
			$data['occupancyLists'] = '';
		}
		
		//echo '<pre>'; print_r($data['occupancyLists']); die;

		$data['content'] = 'admin/reports/expenditure_report_view';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function cancellation_register() {
		$data = array('menu_id'=> 39);
		$where = array('bh.booking_status' => 'C');
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : ''; 
		$data['start_date']= $this->input->post('start_date') != '' ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-01'); 
		$data['end_date']= $this->input->post('end_date') != '' ? date('Y-m-d', strtotime($this->input->post('end_date'))) : date('Y-m-t');
		if($this->input->post()){
			if($this->input->post('property')){
				$where['bh.property_id ='] = $this->input->post('property');
			}
			if($this->input->post('start_date')){
				$where['bh.created_ts >='] = date('Y-m-d 0:0:1', strtotime($this->input->post('start_date')));
				$data['s_dt'] = $this->input->post('start_date');
			}
			if($this->input->post('end_date')){
				$where['bh.created_ts <='] = date('Y-m-d 23:59:50', strtotime($this->input->post('end_date')));
				$data['e_dt'] = $this->input->post('end_date');
			}
		}
		$where['crt.is_refunded'] = 1;
		$order_by = 'bh.booking_id DESC';
		$data['reservations'] = array();
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag') || 1){
			$data['reservations'] = $this->mreport->get_cancellation_lists($where,$order_by);
		}
		//echo $this->db->last_query(); die;
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1)) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);

		//echo '<pre>'; print_r($data['reservations']); die;
		$data['content'] = 'admin/reports/cancellation_list';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function complex_wise_revenue_report() {
		$data = array();
		$data = array('menu_id'=> 37);
		
		$data['financial_years'] = $this->mcommon->getDetails('financial_year_master', array('is_active' => 1));
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mcommon->getDetailsOrder('property_master', array('property_master.is_active' => 1), 'property_id', 'ASC') : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		$data['financialYear']= $this->input->post('financial_year') != '' ? $this->input->post('financial_year') : getFinancialYear(date('Y-m-d', 'Y', 'y')); 
		
		//
		$get_financial_year_data = $this->mcommon->getRow('financial_year_master', array('financial_year' => $data['financialYear']));
		$start    = (new DateTime($get_financial_year_data['fin_start_date']))->modify('first day of this month');
		$end      = (new DateTime($get_financial_year_data['fin_end_date']))->modify('first day of next month');
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);
		
		//$data['lists'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mreport->get_revenue_details($period) : $this->mreport->get_revenue_details($period);
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN){
			$data['lists'] = $this->mreport->get_revenue_details($period);
		}else{
			if(check_user_permission($data['menu_id'], 'delete_flag')){
				$parent_properties = $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$parent_properties = !empty($parent_properties) ? array_column($parent_properties, 'property_id') : array();
				if(!empty($parent_properties)){
					$data['lists'] = $this->mreport->get_revenue_details_property_id($period, $parent_properties);
				}
			}
		}
		
		//
		
		//echo $this->db->last_query(); die;
		//echo '<pre>'; print_r($data['lists']); die;
		
		$data['content'] = 'admin/reports/complex_revenue_report_view';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function sale_of_food() {
		$data = array();
		$data = array('menu_id'=> 38);
		
		$data['financial_years'] = $this->mcommon->getDetails('financial_year_master', array('is_active' => 1));
		$data['cost_centers'] = $this->mcommon->getDetailsOrder('cost_center_master', array('is_active' => 1), 'cost_center_id', 'ASC');
		
		$data['financialYear']= $this->input->post('financial_year') != '' ? $this->input->post('financial_year') : getFinancialYear(date('Y-m-d', 'Y', 'y')); 
		
		
		//
		$get_financial_year_data = $this->mcommon->getRow('financial_year_master', array('financial_year' => $data['financialYear']));
		$start    = (new DateTime($get_financial_year_data['fin_start_date']))->modify('first day of this month');
		$end      = (new DateTime($get_financial_year_data['fin_end_date']))->modify('first day of next month');
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);
		
		$data['lists'] = $this->mreport->get_food_sale_details($period);
		
		//
		
		//echo $this->db->last_query(); die;
		//echo '<pre>'; print_r($lists); die;
		
		$data['content'] = 'admin/reports/sale_food_report_view';
		$this->load->view('admin/layouts/index', $data);
	}
	
	
	public function payment_summary() {
		$data = array();
		$property_ids = array();
		$datesArr = array();
		$data = array('menu_id'=> 82);
		
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : '';
		$data['cost_center_id']= $this->input->post('cost_center_id') != '' ? $this->input->post('cost_center_id') : ''; 
		$data['start_date']= $this->input->post('start_date') != '' ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-01'); 
		$data['end_date']= $this->input->post('end_date') != '' ? date('Y-m-d', strtotime($this->input->post('end_date'))) : date('Y-m-t');
		
		$data['cost_centers'] = $this->mcommon->getDetails('cost_center_master', array('property_id' => $data['property']));
		$data['propertyData'] = $this->mcommon->getRow('property_master', array('property_id' => $data['property']));
		$data['costCenterData'] = $this->mcommon->getRow('cost_center_master', array('cost_center_id' => $data['cost_center_id']));
		
		if($this->input->post()){
			if($this->input->post('property')){
				$where['b.property_id ='] = $this->input->post('property');
			}
			if($this->input->post('cost_center_id')){
				$where['c.cost_center_id ='] = $this->input->post('cost_center_id');
			}
		}
		
		$datesArr = date_range($data['start_date'], $data['end_date'], '+1 day', 'Y-m-d');
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$properties =  $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$property_ids = array_column($properties, 'property_id');
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($property_ids)){
				//$lists = $this->mreport->get_occupancy_report($where, $order_by, $property_ids, $group_by);
				
				if(!empty($datesArr)){
			
					foreach($datesArr as $key => $value){
						
						$cashCollection = $this->mreport->payment_summary_data($data['property'], $data['cost_center_id'], 'Cash', $value, $property_ids, '');
						$upiCollection = $this->mreport->payment_summary_data($data['property'], $data['cost_center_id'], 'Standalone EDC', $value, $property_ids, '');
						$cardCollection = $this->mreport->payment_summary_data($data['property'], $data['cost_center_id'], '', $value, $property_ids, array('Credit Card','DEBIT_CARD'));
						
						//echo $this->db->last_query(); die;
						//echo "<pre>"; print_r($cashCollection); die;
						
						$data['paymentSummaryList'][] = array(
							'date' => date('d/m/Y', strtotime($value)),
							'cash_collection' => round($cashCollection->total),
							'upi_collection' => round($upiCollection->total),
							'card_collection' => round($cardCollection->total),
							'all_total' => round($cashCollection->total + $upiCollection->total + $cardCollection->total)
							
						);
						
					}
					
				}
				else {
					$data['paymentSummaryList'] = array();
				}
			}
		}
		
		//echo $this->db->last_query(); die;
		//echo '<pre>'; print_r($data['paymentSummaryList']); die;

		$data['content'] = 'admin/reports/payment_summary_view';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function item_wise_sales() {
		$data = array();
		$property_ids = array();
		$datesArr = array();
		$data = array('menu_id'=> 81);
		
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : 0;
		$data['cost_center_id']= $this->input->post('cost_center_id') != '' ? $this->input->post('cost_center_id') : ''; 
		$data['start_date']= $this->input->post('start_date') != '' ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-01'); 
		$data['end_date']= $this->input->post('end_date') != '' ? date('Y-m-d', strtotime($this->input->post('end_date'))) : date('Y-m-t');
		
		$data['cost_centers'] = $this->mcommon->getDetails('cost_center_master', array('property_id' => $data['property']));
		$data['propertyData'] = $this->mcommon->getRow('property_master', array('property_id' => $data['property']));
		$data['costCenterData'] = $this->mcommon->getRow('cost_center_master', array('cost_center_id' => $data['cost_center_id']));
		
		if($this->input->post()){
			if($this->input->post('property')){
				$where['b.property_id ='] = $this->input->post('property');
			}
			if($this->input->post('cost_center_id')){
				$where['c.cost_center_id ='] = $this->input->post('cost_center_id');
			}
		}
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$properties =  $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$property_ids = array_column($properties, 'property_id');
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($property_ids)){
				
				$categories = $this->mreport->get_sale_categories($data['property'], $data['cost_center_id'], $data['start_date'], $data['end_date']);
				//echo "<pre>"; print_r($categories); die;
				
				if(!empty($categories)){
			
					foreach($categories as $cat_key => $cat_value){
						
						$products = $this->mreport->get_sale_products($data['property'], $data['cost_center_id'], $cat_value['category_id'], $data['start_date'], $data['end_date']);
						
						foreach($products as $prod_key => $prod_value){
							
							$product_wise_sale = $this->mreport->get_product_wise_revenue($prod_value['product_service_id'], $data['start_date'], $data['end_date']);
							
							$data['records'][$cat_value['category_name']][] = array(
								'product_name' => $product_wise_sale['product_service_name'],
								'product_qty' => $product_wise_sale['tot_qty'],
								'product_price' => $product_wise_sale['tot_price'],
								'product_gst' => $product_wise_sale['tot_gst'],
								'product_total' => ($product_wise_sale['tot_price'] + $product_wise_sale['tot_gst']),
								'category_id' => $product_wise_sale['category_id']
							);
							
						}
						
					}
					 
				}
				else {
					$data['records'] = array();
				}
			}
		}
		
		//echo $this->db->last_query(); die;
		//echo '<pre>'; print_r($data['records']); die;

		$data['content'] = 'admin/reports/item_wise_sales_view';
		$this->load->view('admin/layouts/index', $data);
	}
	
	
	public function guest_house_collection_report() {
		$data = array();
		$property_ids = array();
		$datesArr = array();
		$data = array('menu_id'=> 93);
		
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : 0;
		$data['cost_center_id']= $this->input->post('cost_center_id') != '' ? $this->input->post('cost_center_id') : ''; 
		$data['start_date']= $this->input->post('start_date') != '' ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-01'); 
		$data['end_date']= $this->input->post('end_date') != '' ? date('Y-m-d', strtotime($this->input->post('end_date'))) : date('Y-m-t');
		
		$data['cost_centers'] = $this->mcommon->getDetails('cost_center_master', array('property_id' => $data['property']));
		$data['propertyData'] = $this->mcommon->getRow('property_master', array('property_id' => $data['property']));
		$data['costCenterData'] = $this->mcommon->getRow('cost_center_master', array('cost_center_id' => $data['cost_center_id']));
		
		if($this->input->post()){
			if($this->input->post('start_date')){
				$where['DATE(bp.payment_date) >='] = date('Y-m-d', strtotime($this->input->post('start_date')));
			}
			if($this->input->post('end_date')){
				$where['DATE(bp.payment_date) <='] = date('Y-m-d', strtotime($this->input->post('end_date')));
			}
		}
		
		$condition['property_id'] = $data['property'];
		$condition['cost_center_id'] = $data['cost_center_id'];
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$properties =  $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$property_ids = array_column($properties, 'property_id');
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($property_ids)){
				$records = $this->mreport->getGuestHouseCollection($condition, $where);
				if(!empty($records)){
					$data['records'] = $records;
				}
				else {
					$data['records'] = array();
				}
			}
		}
		
		//echo $this->db->last_query(); die;
		//echo '<pre>'; print_r($data['records']); die;

		$data['content'] = 'admin/reports/guest_house_collection_report_view';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function pos_transaction_report() {
		$data = array();
		$property_ids = array();
		$datesArr = array();
		$data = array('menu_id'=> 94);
		
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : 0;
		$data['cost_center_id']= $this->input->post('cost_center_id') != '' ? $this->input->post('cost_center_id') : ''; 
		$data['start_date']= $this->input->post('start_date') != '' ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-01'); 
		$data['end_date']= $this->input->post('end_date') != '' ? date('Y-m-d', strtotime($this->input->post('end_date'))) : date('Y-m-t');
		
		$data['cost_centers'] = $this->mcommon->getDetails('cost_center_master', array('property_id' => $data['property']));
		$data['propertyData'] = $this->mcommon->getRow('property_master', array('property_id' => $data['property']));
		$data['costCenterData'] = $this->mcommon->getRow('cost_center_master', array('cost_center_id' => $data['cost_center_id']));
		
		if($this->input->post()){
			if($this->input->post('start_date')){
				$where['DATE(psh.created_ts) >='] = date('Y-m-d', strtotime($this->input->post('start_date')));
			}
			if($this->input->post('end_date')){
				$where['DATE(psh.created_ts) <='] = date('Y-m-d', strtotime($this->input->post('end_date')));
			}
		}
		
		$where['psh.cost_center_id ='] = ($this->input->post('cost_center_id') != '') ? $this->input->post('cost_center_id') : $data['cost_center_id'];
		
		$where['psh.sale_flag ='] = 1;
		$where['psh.open_status ='] = 1;
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$properties =  $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$property_ids = array_column($properties, 'property_id');
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($property_ids)){
				$records = $this->mreport->getPosTransaction($where);
				if(!empty($records)){
					foreach($records as $row){
						$getTransactiondata = $this->mreport->getPosSaleDetailHeaderWise(array('sale_order_id' => $row['sale_order_id']));
					
						$data['pos_transaction_data'][] = array(
							'trns_date' => date('d/m/Y', strtotime($row['created_ts'])),
							'trns_time' => date('H:i:s', strtotime($row['created_ts'])),
							'property_name' => $row['property_name'],
							'cost_center_name' => $row['cost_center_name'],
							'invoice_no' => $row['invoice_no'],
							'amt_before_gst' => $getTransactiondata['amt_before_gst'],
							'gst' => $getTransactiondata['gst'],
							'amt_after_gst' => $getTransactiondata['amt_after_gst']
						);
					}
				}
				else {
					$data['pos_transaction_data'] = array();
				}
			}
		}
		
		//echo $this->db->last_query(); die;
		//echo '<pre>'; print_r($data['records']); die;

		$data['content'] = 'admin/reports/pos_transaction_report_view';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function subsidiary_booking_report() {
		$data = array();
		$property_ids = array();
		$datesArr = array();
		$data = array('menu_id'=> 103);
		
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : 0;
		$data['cost_center_id']= $this->input->post('cost_center_id') != '' ? $this->input->post('cost_center_id') : ''; 
		$data['start_date']= $this->input->post('start_date') != '' ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-01'); 
		$data['end_date']= $this->input->post('end_date') != '' ? date('Y-m-d', strtotime($this->input->post('end_date'))) : date('Y-m-t');
		
		$data['cost_centers'] = $this->mcommon->getDetails('cost_center_master', array('property_id' => $data['property']));
		$data['propertyData'] = $this->mcommon->getRow('property_master', array('property_id' => $data['property']));
		$data['costCenterData'] = $this->mcommon->getRow('cost_center_master', array('cost_center_id' => $data['cost_center_id']));
		
		if($this->input->post()){
			if($this->input->post('start_date')){
				$where['DATE(psh.created_ts) >='] = date('Y-m-d', strtotime($this->input->post('start_date')));
			}
			if($this->input->post('end_date')){
				$where['DATE(psh.created_ts) <='] = date('Y-m-d', strtotime($this->input->post('end_date')));
			}
		}
		
		$where['psh.property_id ='] = ($this->input->post('property') != '') ? $this->input->post('property') : $data['property'];
		
		$where['psh.sale_flag ='] = 1;
		$where['psh.open_status ='] = 1;
		$where['ccm.is_it_pos ='] = 2;//for non pos
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
				$properties =  $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
				$property_ids = array_column($properties, 'property_id');
			}
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($property_ids)){
				$records = $this->mreport->getSubsidiaryTransaction($where);
				if(!empty($records)){
					foreach($records as $row){
						$getTransactiondata = $this->mreport->getPosSaleDetailHeaderWise(array('sale_order_id' => $row['sale_order_id']));
					
						$data['pos_transaction_data'][] = array(
							'trns_date' => date('d/m/Y', strtotime($row['created_ts'])),
							'check_in' => date('d/m/Y', strtotime($row['check_in'])),
							'check_out' => date('d/m/Y', strtotime($row['check_out'])),
							'property_name' => $row['property_name'],
							'first_name' => $row['first_name'],
							'booking_no' => $row['booking_no'],
							'no_of_days' => daysBetween($row['check_in'],$row['check_out']),
							'amt_before_gst' => $getTransactiondata['amt_before_gst'],
							'gst' => $getTransactiondata['gst'],
							'amt_after_gst' => $getTransactiondata['amt_after_gst']
						);
					}
				}
				else {
					$data['pos_transaction_data'] = array();
				}
			}
		}
		
		//echo $this->db->last_query(); die;
		//echo '<pre>'; print_r($data['records']); die;

		$data['content'] = 'admin/reports/subsidiary_booking_report_view';
		$this->load->view('admin/layouts/index', $data);
	}
	
	
	public function harbour_income_report() {
		$data = array();
		$records = array();
		$data = array('menu_id'=> 95);
		
		$curUser = $this->admin_session_data['user_id'];
		
		$data['property_list'] = $this->mrevenue->property_list($curUser);
		$data['product_list'] = $this->mcommon->getDetails('harbour_products_master', array('is_active' => 1));
		
		$data['harbourId']= $this->input->post('property_id') != '' ? $this->input->post('property_id') : 0;
		$data['productID']= $this->input->post('harbour_product_id') != '' ? $this->input->post('harbour_product_id') : 0;
		$data['start_date']= $this->input->post('start_date') != '' ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-01'); 
		$data['end_date']= $this->input->post('end_date') != '' ? date('Y-m-d', strtotime($this->input->post('end_date'))) : date('Y-m-t');
		
		if($this->input->post()){
			if($this->input->post('start_date')){
				$where['DATE(temp.transaction_date) >='] = date('Y-m-d', strtotime($this->input->post('start_date')));
			}
			if($this->input->post('end_date')){
				$where['DATE(temp.transaction_date) <='] = date('Y-m-d', strtotime($this->input->post('end_date')));
			}
			if($this->input->post('harbour_product_id')){
				$where['temp.harbour_product_id ='] = $this->input->post('harbour_product_id');
			}
		}
		
		$where['temp.harbour_id ='] = ($this->input->post('property_id') != '') ? $this->input->post('property_id') : $data['property_id'];
		
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($data['property_list'])){
				$records = $this->mreport->getHarbourSaleProduct($where);
				if(!empty($records)){
					foreach($records as $row){
						$data['harbour_income_data'][] = array(
							'property_name' => $row['property_name'],
							'harbour_product_name' => $row['harbour_product_name'],
							'amount' => $row['total_income']
						);
					}
				}
				else {
					$data['harbour_income_data'] = array();
				}
			}
		}
		
		//echo $this->db->last_query(); die;
		//echo '<pre>'; print_r($data['harbour_income_data']); die;

		$data['content'] = 'admin/reports/harbour_income_report_view';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function harbour_expenditure_report() {
		$data = array();
		$records = array();
		$data = array('menu_id'=> 96);
		//echo "<pre>"; print_r($this->input->post()); die;
		$curUser = $this->admin_session_data['user_id'];
		
		$data['property_list'] = $this->mrevenue->property_list($curUser);
		$data['product_list'] = $this->mcommon->getDetails('harbour_products_master', array('is_active' => 1));
		
		$data['harbourId']= ($this->input->post('property_id') != '') ? $this->input->post('property_id') : 0;
		$data['financial_year']= $this->input->post('financial_year') != '' ? $this->input->post('financial_year') : 0;
		$data['mf']= $this->input->post('month_from') != '' ? $this->input->post('month_from') : 0; 
		$data['mt']= $this->input->post('month_to') != '' ? $this->input->post('month_to') : 0;
		
		//echo $data['harbourId'].'-->'.$data['financial_year'].'-->'.$data['month_from'].'-->'.$data['month_to']; die;
		
		if($data['mf'] > $data['mt']){
			$this->session->set_flashdata('error_msg', 'Month To is less than Month From!!');
			redirect("admin/reports/harbour_expenditure_report");
		}
		else{
			$data['month_from']= ($data['mf'] < 10) ? '0'.$data['mf'] : $data['mf']; 
			$data['month_to']= ($data['mt'] < 10) ? '0'.$data['mt'] : $data['mt']; 
			
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
				if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || !empty($data['property_list'])){
					$records = $this->mreport->get_budget_particulars($data['harbourId'], $data['financial_year'], $data['month_from'], $data['month_to']);
					if(!empty($records)){
						foreach($records as $row){
							$data['harbour_expenditure_data'][] = array(
								'property_name' => $row['property_name'], 
								'particular_title' => $row['particular_title'],
								'amount' => $row['tot_amount']
							);
						}
					}
					else {
						$data['harbour_expenditure_data'] = array();
					}
				}
			}
		}
		
		//echo $this->db->last_query(); die;
		//echo '<pre>'; print_r($data['harbour_income_data']); die;

		$data['content'] = 'admin/reports/harbour_expenditure_report_view';
		$this->load->view('admin/layouts/index', $data);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function unit_summary_report() {
		
		$data['report_det'] = $this->mreport->get_unit_summary_report();

		$data['content'] = 'admin/reports/unit_summary_report_view';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function approved_booking_register() {
		$data = array('menu_id'=> 32);
		$where = array('bh.booking_status' => 'A');
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : ''; 
		$data['start_date']= $this->input->post('start_date') != '' ? date('Y-m-d', strtotime($this->input->post('start_date'))) : ''; 
		$data['end_date']= $this->input->post('end_date') != '' ? date('Y-m-d', strtotime($this->input->post('end_date'))) : '';
		if($this->input->post()){
			if($this->input->post('property')){
				$where['bh.property_id ='] = $this->input->post('property');
			}
			if($this->input->post('start_date')){
				$where['bh.created_ts >='] = date('Y-m-d 0:0:1', strtotime($this->input->post('start_date')));
				$data['s_dt'] = $this->input->post('start_date');
			}
			if($this->input->post('end_date')){
				$where['bh.created_ts <='] = date('Y-m-d 23:59:50', strtotime($this->input->post('end_date')));
				$data['e_dt'] = $this->input->post('end_date');
			}
		}
		$order_by = 'bh.booking_id DESC';
		$data['reservations'] = array();
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag') || 1){
			$data['reservations'] = $this->mreservation->get($where,$order_by);
		}
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1)) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		//$data['properties'] = $this->mproperty->get_property(array('property_master.is_active' => 1));
		$data['content'] = 'admin/reports/approved_list';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function checkin_checkout_register() {
		$data = array('menu_id'=> 35);
		$where = array('bh.checked_in' => '1');
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : ''; 
		$data['start_date']= $this->input->post('start_date') != '' ? date('Y-m-d', strtotime($this->input->post('start_date'))) : ''; 
		$data['end_date']= $this->input->post('end_date') != '' ? date('Y-m-d', strtotime($this->input->post('end_date'))) : '';
		if($this->input->post()){
			if($this->input->post('property')){
				$where['bh.property_id ='] = $this->input->post('property');
			}
			if($this->input->post('start_date')){
				$where['bh.check_in >='] = date('Y-m-d 0:0:1', strtotime($this->input->post('start_date')));
			}
			if($this->input->post('end_date')){
				$where['bh.check_in <='] = date('Y-m-d 23:59:59', strtotime($this->input->post('end_date')));
			}
		}
		$order_by = 'bh.booking_id DESC';
		$data['check_ins'] = array();
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag')){
			$data['check_ins'] = $this->mreservation->get($where,$order_by);//$this->mreservation->checkin_checkout_details($where);
			//echo $this->db->last_query();
		}
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1)) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		//$data['properties'] = $this->mproperty->get_property(array('property_master.is_active' => 1));
		$data['content'] = 'admin/reports/checkin_checkout_list';
		$this->load->view('admin/layouts/index', $data);
	}

	public function booking_register() {
		$data = array('menu_id'=> 42);
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : 0; 
		$this->load->helper('date');
		//$data['start_date']= ($this->input->post('start_date') != ''|| $this->input->post('start_date') != '1970-01-01')  ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-d', strtotime($format));
		//$data['start_date']=  (empty($this->input->post('start_date')) || !date('d-m-Y',strtotime($this->input->post('start_date')))) ? date('Y-m-d', strtotime(date('Y-m')." -1 month")) : date('Y-m-d', strtotime($this->input->post('start_date')));

		//$data['end_date']=  (empty($this->input->post('end_date')) || !date('d-m-Y',strtotime($this->input->post('end_date')))) ? date('Y-m-d') : date('Y-m-d', strtotime($this->input->post('end_date')));
		$data['start_date']= $this->input->post('start_date') != '' ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-d',strtotime("-1 days")); 
		$data['end_date']= $this->input->post('end_date') != '' ? date('Y-m-d', strtotime($this->input->post('end_date'))) : date('Y-m-d');
		$data['bookingsource']= $this->input->post('bookingsource') != '' ? $this->input->post('bookingsource') :''; 
		$data['canceledby']= $this->input->post('canceledby') != '' ? $this->input->post('canceledby') :''; 

		$data['reservations'] = array();
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag') || 1){
			$data['reservations'] = $this->mreport->get_booking_details_summary_by_sp($data['property'],$data['start_date'],$data['end_date'],$data['bookingsource'],"'".'B'."'",$data['canceledby']);
		}
		//echo nl2br($this->db->last_query()); die;
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1)) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		
		if(!empty($data['reservations'])){
			foreach($data['reservations'] as $row){
				
				$inviceData = $this->mreport->get_invoice_data(array('booking_id' => $row['booking_id']));
				$bookingHeaderData = $this->mcommon->getRow('booking_header', array('booking_id' => $row['booking_id']));
				$moneyReceiptData = $this->mcommon->getRow('booking_payment', array('booking_id' => $row['booking_id']));
				
				$data['booking_register_data'][] = array(
					'property_id' => $row['property_id'],
					'property_name' => $row['property_name'],
					'booking_id' => $row['booking_id'],
					'booking_no' => $row['booking_no'],
					'booking_date' => $row['booking_date'],
					'booked_by' => $row['booked_by'],
					'txnid' => $row['txnid'],
					'Booking_Amount_before_GST' => $row['Booking_Amount_before_GST'],
					'gst' => $row['gst'],
					'Booking_Amount_after_GST' => $row['Booking_Amount_after_GST'],
					'Check_In_Date' => $row['Check_In_Date'],
					'Check_Out_Date' => $row['Check_Out_Date'],
					'booking_status' => $row['booking_status'],
					'first_name' => $bookingHeaderData['first_name'],
					'mobile' => $bookingHeaderData['mobile'],
					'cancel_percent' => $row['cancel_percent'],
					'checked_in' => $row['checked_in'],
					'actual_cancellation_Charge' => $row['actual_cancellation_Charge'],
					'cancel_gst_percent' => $row['cancel_gst_percent'],
					'Refund_Amount' => $row['Refund_Amount'],
					'amount_receivable' => $row['amount_receivable'],
					'canceled_by' => $row['canceled_by'],
					'cancel_datetime_ts' => $row['cancel_datetime_ts'],
					'invoice_amount_before_gst' => $inviceData['invoice_amount_before_gst'],
					'invoice_gst' => $inviceData['invoice_gst'],
					'invoice_amount_after_gst' => $inviceData['invoice_amount_after_gst'],
					'money_receipt_no' => $moneyReceiptData['money_receipt_no'],
					'money_receipt_date' => date('d/m/Y', strtotime($moneyReceiptData['money_receipt_date'])),
					'tot_extra_bed_amt' => $inviceData['tot_extra_bed_amt'],
					'actual_booking_amt' => ($row['Booking_Amount_before_GST'] + $inviceData['tot_extra_bed_amt']),
					'order_id' => $bookingHeaderData['order_id'],
					'previous_room_base_price' => $bookingHeaderData['previous_room_base_price'],
					'previous_room_total_igst' => $bookingHeaderData['previous_room_total_igst'],
					'previous_net_payable_amount' => $bookingHeaderData['previous_net_payable_amount'],
				);
				
			}
		}
		else{
			$data['booking_register_data'] = array();
		}
		
		//echo "<pre>"; print_r($data['reservations']); die;

		//$data['properties'] = $this->mproperty->get_property(array('property_master.is_active' => 1));
		$data['content'] = 'admin/reports/booking_register';
		$this->load->view('admin/layouts/index', $data);
	}

	public function booking_recievable_statement() {
		$data = array('menu_id'=> 43);
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : 0; 
		$this->load->helper('date');
		/*$data['start_date']=  empty($this->input->post('start_date')) || !date('d-m-Y',strtotime($this->input->post('start_date'))) ? date('Y-m-d', strtotime(date('Y-m')." -1 month")) : date('Y-m-d', strtotime($this->input->post('start_date')));
		$data['end_date']=  empty($this->input->post('end_date')) || !date('d-m-Y',strtotime($this->input->post('end_date'))) ? date('Y-m-d') : date('Y-m-d', strtotime($this->input->post('end_date')));*/
		$data['start_date']= $this->input->post('start_date') != '' ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-d',strtotime("-1 days")); 
		$data['end_date']= $this->input->post('end_date') != '' ? date('Y-m-d', strtotime($this->input->post('end_date'))) : date('Y-m-d',strtotime("-1 days"));
		$data['bookingsource']= 'F'; 
		$data['canceledby']= $this->input->post('canceledby') != '' ? $this->input->post('canceledby') :''; 		
			$data['reservations'] = array();
				if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag') || 1){
					$data['reservations'] = $this->mreport->get_booking_details_summary_by_sp($data['property'],$data['start_date'],$data['end_date'],$data['bookingsource'],"'".'C'."'",$data['canceledby']);
				}
			//$data['properties'] = $this->mproperty->get_property(array('property_master.is_active' => 1));
			$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1)) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);

		$data['content'] = 'admin/reports/booking_recievable_statement';
		$this->load->view('admin/layouts/index', $data);
	}

	public function booking_financial_statement() {
		$data = array('menu_id'=> 44);
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : 0; 
		$this->load->helper('date');
		//$data['start_date']= ($this->input->post('start_date') != ''|| $this->input->post('start_date') != '1970-01-01')  ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-d', strtotime($format));
		//$data['start_date']=  (empty($this->input->post('start_date')) || !date('d-m-Y',strtotime($this->input->post('start_date')))) ? date('Y-m-d', strtotime(date('Y-m')." -1 month")) : date('Y-m-d', strtotime($this->input->post('start_date')));

		//$data['end_date']=  (empty($this->input->post('end_date')) || !date('d-m-Y',strtotime($this->input->post('end_date')))) ? date('Y-m-d') : date('Y-m-d', strtotime($this->input->post('end_date')));
		$data['cuttoffDates']= $this->input->post('cuttoffDates') != '' ? date('Y-m-d', strtotime($this->input->post('cuttoffDates'))) : ''; 
		$data['bookingsource']= 'F'; 
		$data['canceledby']='';


		$data['reservations'] = array();
		$data['transferDetails'] = array();
		if($data['property']>0 && $data['cuttoffDates']!='')
		{
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag') || 1){
				$data['reservations'] = $this->mreport->get_booking_details_summary_by_sp($data['property'],'2022-09-01',$data['cuttoffDates'],$data['bookingsource'],"'".'C'."'",$data['canceledby']);
				$data['transferDetails'] =$this->mreport->getTransferDetailsByFilters(array('transfer_details.cutoff_date<=' => $data['cuttoffDates'],'transfer_details.property_id' => $data['property'],'transfer_details.status' => 1));
			}
				$total_booking_Amount_before_GST=0;
				$total_gst=0;
				$total_booking_Amount_after_GST=0;
				$total_actual_cancellation_Charge=0;
				$total_cancel_gst_percent=0;
				$total_Refund_Amount=0;
				$total_amount_receivable=0;	
				$total_transferdtls_amount=0;					
				if($data['reservations'])
				{
					foreach($data['reservations'] as $reservation)
					{
						$total_booking_Amount_before_GST += $reservation['Booking_Amount_before_GST'];
						$total_gst+= $reservation['gst'];
						$total_booking_Amount_after_GST+= $reservation['Booking_Amount_after_GST'];
						$total_actual_cancellation_Charge+= $reservation['actual_cancellation_Charge'];
						$total_cancel_gst_percent+= $reservation['cancel_gst_percent'];
						$total_Refund_Amount+= $reservation['Refund_Amount'];
						$total_amount_receivable+= $reservation['amount_receivable'];						

					}
					$data['total_booking_Amount_before_GST']=number_format($total_booking_Amount_before_GST,2);
					$data['total_gst']=number_format($total_gst,2);
					$data['total_booking_Amount_after_GST']=number_format($total_booking_Amount_after_GST,2);
					$data['total_actual_cancellation_Charge']=number_format($total_actual_cancellation_Charge,2);
					$data['total_cancel_gst_percent']=number_format($total_cancel_gst_percent,2);
					$data['total_Refund_Amount']=number_format($total_Refund_Amount,2);
					$data['total_amount_receivable']=number_format($total_amount_receivable,2);
				}	
				if($data['transferDetails'])
				{
					foreach($data['transferDetails'] as $transferDetail)
					{
						$total_transferdtls_amount += $transferDetail['amount'];
					}
					$data['total_transferdtls_amount']=number_format($total_transferdtls_amount,2);					
				}			
				$data['outstanding_amount']=number_format(($total_amount_receivable - $total_transferdtls_amount),2);
		}		
		//$data['properties'] = $this->mproperty->get_property(array('property_master.is_active' => 1));
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1)) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);

		$data['cutoffDates'] = $this->mreport->getCutoffDates(array('status' => 1));
		
		$data['content'] = 'admin/reports/booking_financial_statement';
		$this->load->view('admin/layouts/index', $data);
	}

	public function ledger_statement() {
		$data = array('menu_id'=> 45);
		$data['property']= $this->input->post('property') != '' ? $this->input->post('property') : 0; 
		$this->load->helper('date');
		//$data['start_date']= ($this->input->post('start_date') != ''|| $this->input->post('start_date') != '1970-01-01')  ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-d', strtotime($format));
		//$data['start_date']=  (empty($this->input->post('start_date')) || !date('d-m-Y',strtotime($this->input->post('start_date')))) ? date('Y-m-d', strtotime(date('Y-m')." -1 month")) : date('Y-m-d', strtotime($this->input->post('start_date')));

		//$data['end_date']=  (empty($this->input->post('end_date')) || !date('d-m-Y',strtotime($this->input->post('end_date')))) ? date('Y-m-d') : date('Y-m-d', strtotime($this->input->post('end_date')));
		$data['start_date']= $this->input->post('start_date') != '' ? date('Y-m-d', strtotime($this->input->post('start_date'))) : date('Y-m-d',strtotime("-1 days")); 
		$data['end_date']= $this->input->post('end_date') != '' ? date('Y-m-d', strtotime($this->input->post('end_date'))) : date('Y-m-d');
		
		$data['ledger_statements'] = array();
		if($data['property']>0)
		{
		if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag') || 1){
			$data['ledger_statements'] = $this->mreport->get_ledge_statement_by_sp($data['property'],$data['start_date'],$data['end_date']);
			}
		}
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property(array('property_master.is_active' => 1)) : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		//$data['properties'] = $this->mproperty->get_property(array('property_master.is_active' => 1));
		$data['content'] = 'admin/reports/ledger_statement';
		$this->load->view('admin/layouts/index', $data);
	}

	public function availability_status($val1 = null, $val2 = null) {
		$this->load->model('admin/maccommodation');
		
		$data = array('menu_id'=> 39);
		
		if (!is_null($val1) && !is_null($val2)) {
			//$data_condn = unserialize($this->encryption->encrypt(base64_decode($val1)));
			
			$rangArray = []; 
			
			$startDate = date('Y-m-d', strtotime($val2));
			$endDate = date('Y-m-d', strtotime('+7 days', strtotime($startDate)));
			
			//echo $val1.'<br>'.$endDate.'<br>';
			
			$startDt = strtotime($startDate);
			$endDt = strtotime(date('Y-m-d', strtotime('+7 days', $startDt)));
			
			//echo $startDt.'<br>'.$endDt; die;
            
			$i = 0;
			for ($currentDate = $startDt; $currentDate < $endDt; $currentDate += (86400)) {                               
				$rangArray[$i]['date'] = date('jS M Y', $currentDate);
				$rangArray[$i]['day'] = date('l', $currentDate);
				$i++;
			}
			
			$data['dates'] = $rangArray;
			
			$accomodation_availability = array();
			
			$accomms = $this->maccommodation->get_accommodation_list_property_id($val1);
			
			$i = 0;
			foreach ($accomms as $accomm) {
				$accomm_availibility = $this->maccommodation->get_property_accomm_availability($accomm["property_id"], $accomm["accommodation_id"], $startDate, $endDate);
				
				$accomodation_availability[$i]['accommodation'] = $accomm;
				$accomodation_availability[$i]['availability'] = $accomm_availibility;
				
				$i++;
			}
			
			$data['accomodation_availability'] = $accomodation_availability;
			
			$data['d_prop'] = $val1;
			$data['d_date'] = $startDate;
		}
		
		$data['properties'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mproperty->get_property() : $this->mproperty->get_user_property_details($this->admin_session_data['user_id']);
		$data['content'] = 'admin/reports/availability_status';
		$this->load->view('admin/layouts/index', $data);
	}
	

	public function bank_details() {
		$data['user_property_det'] = $this->mproperty->get_user_property_details_view();
		$data['content'] = 'admin/reports/bank_details';
		$this->load->view('admin/layouts/index', $data);
	}


	public function credit_sale() {

		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){

			$property_id = $this->input->post('property_id');
			$product_id = $this->input->post('product_id');
			$financial_year = $this->input->post('financial_year');
			$billing_month = $this->input->post('billing_month');

			$data['creditsale_list'] = $this->mreport->creditsale_list($property_id,$product_id,$financial_year,$billing_month);

			$data['property_id'] = $property_id;
			$data['product_id'] = $product_id;
			$data['financial_year'] = $financial_year;
			$data['billing_month'] = $billing_month;

			$data['fDate'] = $this->input->post('fDate');
			$data['tDate'] = $this->input->post('tDate');

		} else {

			$data['creditsale_list'] = '';

			$data['property_id'] = '';
			$data['product_id'] = '';
			$data['financial_year'] = '';
			$data['billing_month'] = '';

			$data['fDate'] = '';
			$data['tDate'] = '';

		}


		$data['property_list'] = $this->mrevenue->property_list($curUser);
		$data['product_list'] = $this->mrevenue->product_list_product();

		$data['content'] = 'admin/reports/credit_sale';
		$this->load->view('admin/layouts/index', $data);

	}


	public function credit_sale_report($property_id,$product_id,$financial_year,$billing_month) {

		$property_id = decode_url($property_id);
		$product_id = decode_url($product_id);
		$financial_year = decode_url($financial_year);
		$billing_month = decode_url($billing_month);

		if($billing_month >= '01' && $billing_month <= '03'){ //2023-2024		

			$fYear = $financial_year + 1;
			$fMonth = sprintf("%02d", $billing_month);

		} else if($billing_month > '03' && $billing_month <= '12') {

			$fYear = $financial_year;
			$fMonth = sprintf("%02d", $billing_month);

		}
		

		$data['fDate'] = '01.'.$fMonth.'.'.$fYear;
		$data['tDate'] = '30'.$fMonth.'.'.$fYear;

		$data['financial_year'] = $financial_year;
		$data['billing_month'] = date("F", mktime(0, 0, 0, $billing_month, 10));

		$data['property_details'] = $this->mreport->property_details($property_id);
		$data['product_details'] = $this->mreport->product_details($product_id);
		$data['creditsale_list'] = $this->mreport->creditsale_list($property_id,$product_id,$financial_year,$billing_month);

		$this->load->view('admin/reports/credit_sale_report', $data);

	}


	public function credit_sale_statement() {

		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){

			$property_id = $this->input->post('property_id');
			$bill_from_date = date("Y-m-d", strtotime($this->input->post('bill_from_date'))); 
			$bill_to_date = date("Y-m-d", strtotime($this->input->post('bill_to_date')));

			$data['creditsale_statement'] = $this->mreport->creditsale_statement($property_id,$bill_from_date,$bill_to_date);
			$data['creditsale_recovary'] = $this->mreport->creditsale_recovary($property_id,$bill_from_date,$bill_to_date);

			$data['property_id'] = $property_id;
			$data['bill_from_date'] = $this->input->post('bill_from_date');
			$data['bill_to_date'] = $this->input->post('bill_to_date');

			$data['fDate'] = $bill_from_date;
			$data['tDate'] = $bill_to_date;

		} else {

			$data['creditsale_list'] = '';
			$data['creditsale_recovary'] = '';

			$data['property_id'] = '';
			$data['bill_from_date'] = '';
			$data['bill_to_date'] = '';

			$data['fDate'] = '';
			$data['tDate'] = '';

		}


		$data['property_list'] = $this->mrevenue->property_list($curUser);

		$data['content'] = 'admin/reports/credit_sale_statement';
		$this->load->view('admin/layouts/index', $data);

	}


	public function credit_sale_statement_report($property_id,$bill_from_date,$bill_to_date) {

		$property_id = decode_url($property_id);
		$bill_from_date = date("Y-m-d", strtotime(decode_url($bill_from_date)));
		$bill_to_date = date("Y-m-d", strtotime(decode_url($bill_to_date)));		

		$data['creditsale_statement'] = $this->mreport->creditsale_statement($property_id,$bill_from_date,$bill_to_date);
		$data['creditsale_recovary'] = $this->mreport->creditsale_recovary($property_id,$bill_from_date,$bill_to_date);

		$data['property_id'] = $property_id;
		$data['bill_from_date'] = decode_url($bill_from_date);
		$data['bill_to_date'] = decode_url($bill_to_date);

		$data['fDate'] = $bill_from_date;
		$data['tDate'] = $bill_to_date;

		$data['property_details'] = $this->mreport->property_details($property_id);

		$this->load->view('admin/reports/credit_sale_statement_report', $data);

	}


	public function venue_booking_report() {
		$data = array();
		
		//$data = array('menu_id'=> 97);
		
		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){			

			$propertyId = $this->input->post('property_id');
			$venueId = $this->input->post('venue_id');
			$startDate = date('Y-m-d', strtotime($this->input->post('start_date')));
			$endDate = date('Y-m-d', strtotime($this->input->post('end_date')));

			$data['booking_report'] = $this->mreport->booking_report($propertyId,$venueId,$startDate,$endDate);
			$data['venue_list'] = $this->mreport->venue_list($propertyId);

			$data['propertyId'] = $propertyId;
			$data['venueId'] = $venueId;
			$data['startDate'] = $startDate;
			$data['endDate'] = $endDate;

		} else {

			$data['booking_report'] = '';
			$data['venue_list'] = '';

			$data['propertyId'] = '';
			$data['venueId'] = '';
			$data['startDate'] = '';
			$data['endDate'] = '';

		}

		$data['property_list'] = $this->mvenuebooking->get_landscape_properties(array('terrain_master.is_active' => 1, 'property_master.is_active' => 1, 'property_master.is_venue' => 1));			

		$data['content'] = 'admin/reports/venue_booking_report';
		$this->load->view('admin/layouts/index', $data);
	}


	public function venue_cancellation_report() {
		$data = array();
		
		//$data = array('menu_id'=> 98);
		
		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){	

			$propertyId = $this->input->post('property_id');
			$venueId = $this->input->post('venue_id');
			$startDate = date('Y-m-d', strtotime($this->input->post('start_date')));
			$endDate = date('Y-m-d', strtotime($this->input->post('end_date')));

			$data['booking_report'] = $this->mreport->cancel_booking_report($propertyId,$venueId,$startDate,$endDate);
			$data['venue_list'] = $this->mreport->venue_list($propertyId);

			//echo "<pre>"; print_r($data['booking_report']); die;

			$data['propertyId'] = $propertyId;
			$data['venueId'] = $venueId;
			$data['startDate'] = $startDate;
			$data['endDate'] = $endDate;

		} else {

			$data['booking_report'] = '';
			$data['venue_list'] = '';

			$data['propertyId'] = '';
			$data['venueId'] = '';
			$data['startDate'] = '';
			$data['endDate'] = '';

		}

		$data['property_list'] = $this->mvenuebooking->get_landscape_properties(array('terrain_master.is_active' => 1, 'property_master.is_active' => 1, 'property_master.is_venue' => 1));			

		$data['content'] = 'admin/reports/venue_cancellation_report';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function getSlots()
	{
		$data_list = array();
		$safari_service_header_id = $this->input->post('safari_service_header_id');
		$booking_date = $this->input->post('booking_date');
		if(is_numeric($safari_service_header_id) && $safari_service_header_id > 0){
			
			$service_period_master_id = get_period_from_date($booking_date);
			
			$data_list = $this->msafari_service->getSlotsASC(array('is_active' => 1, 'safari_service_header_id' => $safari_service_header_id, 'service_period_master_id' => $service_period_master_id));
			
			$response = array("status"=> true, "list"=>$data_list);
		}
		else{
			$response = array("status"=> false, "list"=>$data_list);
		}
		
		echo json_encode($response);
		exit;
	}
	
	public function approved_safari_register() {
		$data = array('menu_id'=> 75);
		
		if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN){
			$safari_service_header_ids =  $this->mcommon->get_user_service(array('user_id' => $this->admin_session_data['user_id']));
		}
		$data['serviceDefinitions'] = $this->admin_session_data['role_id'] == ROLE_SUPERADMIN ? $this->mcommon->getDetailsOrder('safari_service_header', ['service_status' => 1], 'service_definition', 'ASC') : $this->msafari_service->get_user_wise_service($safari_service_header_ids);
		
		$data['booking_date']= $this->input->post('booking_date') != '' ? date('Y-m-d', strtotime($this->input->post('booking_date'))) : date('Y-m-d');
		$data['safari_service_header_id'] = $this->input->post('safari_service_header_id');
		$data['period_slot_dtl_id'] = $this->input->post('period_slot_dtl_id');
		
		if($this->input->post()){
			if($this->input->post('safari_service_header_id')){
				$where['a.safari_service_header_id ='] = $this->input->post('safari_service_header_id');
			}
			if($this->input->post('period_slot_dtl_id')){
				$where['a.period_slot_dtl_id ='] = $this->input->post('period_slot_dtl_id');
			}
			if($this->input->post('booking_date')){
				$where['a.booking_date ='] = date('Y-m-d', strtotime($this->input->post('booking_date')));
			}
			
			$where['a.booking_status = '] = 'A';
			$order_by = 'DATE(a.created_ts) ASC';
			
			if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || check_user_permission($data['menu_id'], 'delete_flag') || 1){
				$data['safariReservations'] = $this->mreport->get_safari_booking($where, $order_by);
			}
			
		}

		//echo '<pre>'; print_r($data['safariReservations']); die;
		$data['content'] = 'admin/reports/approved_safari_booking_register';
		$this->load->view('admin/layouts/index', $data);
	}
	
	public function downloadSafariBookigListPdf()
	{
		$this->load->library('pdf');
		$data = [];
		$where = [];
		$safari_service_header_id = decode_url($this->uri->segment('2'));
		$booking_date = decode_url($this->uri->segment('3'));
		$period_slot_dtl_id = decode_url($this->uri->segment('4'));
		
		if(is_numeric($safari_service_header_id) && $safari_service_header_id > 0 && is_numeric($period_slot_dtl_id) && $period_slot_dtl_id > 0){
			$where['a.safari_service_header_id ='] = $safari_service_header_id;
			$where['a.booking_date ='] = date('Y-m-d', strtotime($booking_date));
			$where['a.period_slot_dtl_id ='] = $period_slot_dtl_id;
			$where['a.booking_status = '] = 'A';
			$order_by = 'DATE(a.created_ts) ASC';
			
			$data['safariReservations'] = $this->mreport->get_safari_booking($where, $order_by);
			
			$filename = 'Safari-Booking-List' .$booking_date;
			$html = $this->load->view('admin/reports/downloadSafariBookingList', $data, true);
			// $this->pdf->create($html, $filename);
			// echo $html;die;
	
			$this->pdf->loadHtml($html);
			$this->pdf->set_paper("A4", "landscape");
			$this->pdf->render();
	
			$this->pdf->stream("" . $filename . ".pdf", array("Attachment" => 0));
		}
		
	}


}