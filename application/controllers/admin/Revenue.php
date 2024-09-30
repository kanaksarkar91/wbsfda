<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Revenue extends MY_Controller
{
	//private $menu_id;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model(array('admin/mrevenue', 'mcommon'));
		//$this->menu_id = 24;

	}


	public function index()
	{	
		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){

			$propertyId = $this->input->post('property_id');
			$billingMonth = $this->input->post('bill_month'); 

			$data['revenue_list'] = $this->mrevenue->revenue_list($propertyId, $billingMonth);
			
			$data['property_id']= $propertyId; 
			$data['bill_month']= $billingMonth;

		} else {

			$data['revenue_list'] = '';

			$data['property_id']= ''; 
			$data['bill_month']= '';

		}

		$data['property_list'] = $this->mrevenue->property_list($curUser);
		$data['head_list'] = $this->mrevenue->head_list();

		$data['content'] = 'admin/revenue/list';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function add_daily_income()
	{	

		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){

			//echo "<pre>"; print_r($this->input->post()); die;

			$propertyId = $this->input->post('property_id');
			$billingMonth = $this->input->post('bill_month');
			$billingDate = $this->input->post('bill_date');

			$head_id = $this->input->post('head_id');
			$cash_qty = $this->input->post('cash_qty');
			$cash_amount = $this->input->post('cash_amount');
			$cheque_qty = $this->input->post('cheque_qty');
			$cheque_amount = $this->input->post('cheque_amount');
			$credit_qty = $this->input->post('credit_qty');
			$credit_amount = $this->input->post('credit_amount');

			$totalCashamount = $this->input->post('total_cash_amount');
			$totalChequeamount = $this->input->post('total_cheque_amount');
			$totalCreditamount = $this->input->post('total_credit_amount');
			$totalGrandamount = $this->input->post('total_grand_amount');

			$checkDetails = $this->mrevenue->check_transaction_details($propertyId, $billingMonth, date("Y-m-d", strtotime($billingDate)));

			if($checkDetails){

				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Transaction History already exist for this Unit, Month, Date.</div>');

			} else {

				$transHeaderarray = array(
					'property_id' => $propertyId,
					'total_cash_amount'=> $totalCashamount,
					'total_credit_amount' => $totalCreditamount,
					'total_cheque_amount' => $totalChequeamount,
					'grand_total' => $totalGrandamount,
					'billing_month_year' => $billingMonth,
					'billing_date' => date("Y-m-d", strtotime($billingDate)),
					'created_by' => $this->admin_session_data['user_id']
				);

				//echo "<pre>"; print_r($transHeaderarray); die;

				$headerResult = $this->mrevenue->transaction_header_insert($transHeaderarray);

				$transDetailsarray = array();

				$i = 0;
				foreach($head_id as $hid){

					$detailArray = array();

					$detailArray['transaction_header_id'] = $headerResult;
					$detailArray['header_id'] = $hid;
					$detailArray['qty_ltr_cash'] = $cash_qty[$i];
					$detailArray['cash_amount'] = $cash_amount[$i];
					$detailArray['qty_ltr_credit'] = $credit_qty[$i];
					$detailArray['credit_amount'] = $credit_amount[$i];
					$detailArray['qty_ltr_cheque'] = $cheque_qty[$i];
					$detailArray['cheque_amount'] = $cheque_amount[$i];

					$transDetailsarray[] = $detailArray;

					$i++;

				}

				//echo "<pre>"; print_r($transDetailsarray); die;

				$detailsResult = $this->mrevenue->transaction_details_insert($transDetailsarray);

				if($detailsResult){
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Revenue Transaction Successfully Submitted.</div>');
				} else {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
				}

			}

			$data['property_list'] = $this->mrevenue->property_list($curUser);
			$data['head_list'] = $this->mrevenue->head_list();

		} else {

			$data = array();

			$data['property_list'] = $this->mrevenue->property_list($curUser);
			$data['head_list'] = $this->mrevenue->head_list();

		}

		$data['content'] = 'admin/revenue/add';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function product_sale()
	{			
		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){

			//echo "<pre>"; print_r($this->input->post()); die;

			$saleTransactionID = rand(10000, 99999);

			$transarray = array(
				'harbour_id' => $this->input->post('property_id'),
				'transaction_date'=> date("Y-m-d", strtotime($this->input->post('bill_date'))),
				'transaction_type' => $this->input->post('transaction_type'),
				'payment_mode' => $this->input->post('sale_type'),
				'harbour_product_id' => $this->input->post('product_id'),
				'qty' => $this->input->post('quantity'),
				'rate_uom' => $this->input->post('rate_per_uom'),
				'total_amount' => $this->input->post('total_amount'),
				'harbour_buyer_id' => $this->input->post('buyer_id'),
				'remarks' => $this->input->post('remarks'),
				'sale_transaction_id' => $saleTransactionID,
				'created_by' => $this->admin_session_data['user_id']
			);

			$result = $this->mrevenue->product_sales_insert($transarray);

			if($result){
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Product Sale Successfully Submitted.</div>');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
			}

		}

		$data['property_list'] = $this->mrevenue->property_list($curUser);
		$data['product_list'] = $this->mrevenue->product_list_product();

		$data['content'] = 'admin/revenue/product_sale';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function buyer_list()
	{

		$curUser = $this->admin_session_data['user_id'];
		$propertyId = $this->input->post('propertyId');

		$buyer_list = $this->mrevenue->product_buyer_list($propertyId);

		//echo "<pre>"; print_r($buyer_list); die;

		$html = '<option value=""></option>';
		

		foreach($buyer_list as $buyerL){
			$html .= '<option value="'.$buyerL['harbour_buyer_id'].'">'.$buyerL['harbour_buyer_name'].'</option>';
		}

		//console.log($html);

		echo json_encode($html);

	}


	public function licencee_list()
	{

		$curUser = $this->admin_session_data['user_id'];
		$propertyId = $this->input->post('propertyId');

		$buyer_list = $this->mrevenue->product_licencee_list($propertyId);

		//echo "<pre>"; print_r($buyer_list); die;

		$html = '<option value="">Select Licensee / Party</option>';
		

		foreach($buyer_list as $buyerL){
			$html .= '<option value="'.$buyerL['harbour_buyer_id'].'">'.$buyerL['harbour_buyer_name'].'</option>';
		}

		//console.log($html);

		echo json_encode($html);

	}


	public function agreement_details()
	{

		$curUser = $this->admin_session_data['user_id'];
		$propertyId = $this->input->post('propertyId');
		$productId = $this->input->post('productId');
		$buyerId = $this->input->post('buyerId');

		$agreementDetails = $this->mrevenue->agreement_details($propertyId,$productId,$buyerId);

		//echo "<pre>"; print_r($agreementDetails); die;		

		echo json_encode($agreementDetails);

	}


	public function recovary_credit_sale()
	{	
		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){

			$recovaryTransactionID = rand(10000, 99999);

			$oustandingAmount = $this->input->post('outstanding_amt');

			$transarray = array(
				'harbour_id' => $this->input->post('property_id'),
				'transaction_date'=> date("Y-m-d", strtotime($this->input->post('bill_date'))),
				'transaction_type' => $this->input->post('transaction_type'),
				'harbour_buyer_id' => $this->input->post('buyer_id'),
				'total_amount' => $this->input->post('received_amount'),				
				'remarks' => $this->input->post('remarks'),
				'sale_transaction_id' => $recovaryTransactionID,
				'payment_mode' => 'Cash',
				'created_by' => $this->admin_session_data['user_id']
			);

			$result = $this->mrevenue->recovery_sales_insert($transarray,$oustandingAmount);

			if($result){
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Recovery Credit Sale Successfully Submitted.</div>');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
			}

		}

		$data['property_list'] = $this->mrevenue->property_list($curUser);

		$data['content'] = 'admin/revenue/recovary_credit_sale';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function other_sale()
	{	
		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){

			$otherTransactionID = rand(10000, 99999);

			$salearray = array(
				'harbour_id' => $this->input->post('property_id'),
				'transaction_type'=> $this->input->post('transaction_type'),
				'transaction_date' => date("Y-m-d", strtotime($this->input->post('bill_date'))),
				'term' => $this->input->post('term'),
				'harbour_product_id' => $this->input->post('product_id'),
				'harbour_buyer_id' => $this->input->post('buyer_id'),
				'total_amount' => $this->input->post('total_amount'),
				'remarks' => $this->input->post('remarks'),
				'payment_mode' => 'Cash',
				'sale_transaction_id' => $otherTransactionID,
				'created_by' => $this->admin_session_data['user_id']
			);

			$result = $this->mrevenue->othersale_insert($salearray);

			if($result){
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Sale Successfully Submitted.</div>');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
			}

		}

		$data['property_list'] = $this->mrevenue->property_list($curUser);
		$data['product_list'] = $this->mrevenue->facility_product_list();

		$data['content'] = 'admin/revenue/other_sale';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function agreement()
	{	
		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){

			$agreementarray = array(
				'harbour_id' => $this->input->post('property_id'),
				'licencee_id'=> $this->input->post('buyer_id'),
				'facility_id' => $this->input->post('product_id'),
				'security_deposite_amount' => $this->input->post('security_deposite'),
				'is_refundable' => $this->input->post('refundable'),
				'start_date' => date("Y-m-d", strtotime($this->input->post('agreement_start_date'))),				
				'end_date' => date("Y-m-d", strtotime($this->input->post('agreement_end_date'))),
				'payable_amount' => $this->input->post('payable_amount'),
				'period' => $this->input->post('period'),
				'remarks' => $this->input->post('remarks'),
				'created_by' => $this->admin_session_data['user_id']
			);

			$result = $this->mrevenue->agreement_insert($agreementarray);

			if($result){
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Agreement Successfully Submitted.</div>');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Something is wrong. Try again.</div>');
			}			

		}

		$data['property_list'] = $this->mrevenue->property_list($curUser);
		$data['product_list'] = $this->mrevenue->facility_product_list();

		$data['content'] = 'admin/revenue/agreement';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function outstanding_amount()
	{

		$buyerId = $this->input->post('buyerId');

		$amount = $this->mrevenue->outstanding_amount($buyerId);		

		echo json_encode($amount);

	}


	public function transaction_list()
	{	
		$curUser = $this->admin_session_data['user_id'];

		if($this->input->post()){

			$harbourId = $this->input->post('property_id');
			$transDate = date("Y-m-d", strtotime($this->input->post('bill_date')));

			$data['transaction_list'] = $this->mrevenue->transaction_list($harbourId,$transDate);

			$data['harbourId'] = $harbourId;
			$data['transDate'] = $this->input->post('bill_date');

		} else {

			$data['transaction_list'] = '';

			$data['harbourId'] = '';
			$data['transDate'] = '';

		}

		$data['property_list'] = $this->mrevenue->property_list($curUser);

		$data['content'] = 'admin/revenue/transaction_list';
		$this->load->view('admin/layouts/index', $data); 
	}


	public function transaction_details()
	{

		$transactionId = $this->input->post('transactionId');

		$result = $this->mrevenue->transaction_details($transactionId);		

		echo json_encode($result);

	}


}
