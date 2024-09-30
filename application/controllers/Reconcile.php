<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reconcile extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('mcommon', 'frontend/mbooking'));
		$this->load->model('frontend/query');
	}
	
	public function payment()
	{
		$posted_data = $this->input->post();
		
		if ($posted_data) 
		{
			$txnid = $posted_data['txnid'];
			
			$data['booking_det'] = $booking_det = $this->mbooking->get_booking_header(array('booking_header.txnid' => $txnid))->last_row();
			
			$booking_id = $booking_det->booking_id;
			
			if ($booking_det)
			{
				$payment_data = array();

				if ($posted_data['amount'] == $booking_det->net_payable_amount)
				{
					$payment_data = array(
						'transaction_ref_id' => $posted_data['mihpayid'],
						//'bank_ref_num' => $posted_data['bank_ref_num'],
						'amount' => $posted_data['amount'],
						'payment_mode' => $posted_data['mode'],
						'response_txt' => json_encode($posted_data),
						'remarks' => 'Payment Successful using Webhook',
						'status' => strtoupper($posted_data['status']),
						//'updated_by' => $user_id,
						'updated_ts' => date('Y-m-d H:i:s'),
					);
					
					if (strtoupper($posted_data['status']) == 'SUCCESS')
						$booking_header_condn = array('booking_status' => 'A');
					else
						$booking_header_condn = array();
					
					$payment_id = $this->mbooking->update_booking_payment_info($payment_data, array('txnid' => $txnid));

					$booking_header_det = $this->mbooking->update_booking_header($booking_header_condn, array('txnid' => $txnid));
				} else {
					echo "Posted amount and the Booking amount do not match";
				}
			} else {
				echo "No booking details found with the provided Transaction ID";
			}
		} else {
			echo "No data received yet.";
		}
	}
	
}