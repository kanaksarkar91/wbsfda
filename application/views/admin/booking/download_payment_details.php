<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Payment Details</title>
    <style type="text/css">
        @page {
            size: A4;
            margin: .25cm;
        }
    </style>
</head>

<body role="document">
    <table id="printArea" cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin: 0 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 11px; padding: 0;text-align: center;">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom: 10px;">
                    <tr>
                        <td width="17.5%" style="text-align: left;padding:10px;">
                            <img src="<?= base_url();?>public/frontend_assets/assets/img/Biswa_Bangla_logo.jpg" width="64" alt="..." />
                        </td>
                        <td width="65%" style="text-align: center;">
                            <h3 style="margin-top:10px; font-size:14px;margin-bottom: 0px;line-height:1;font-weight:600;">The State Fisheries Development Corporation Limited</h3>
                            <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">(A Government of West Bengal Undertaking)<br>An ISO: 9001:2015 Company</p>
                            <h2 style="text-align:center;font-size:12px;font-weight: 600; margin-top:10px;">Payment Details</h2>
                        </td>
                        <td width="17.5%" style="text-align: right;padding-right:10px;">
                            <img src="<?= base_url();?>public/frontend_assets/assets/img/SFDC_logo.jpg" width="64" alt="..." style="margin-top:10px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-bottom:5px;">
                    <tbody>
                        <tr>
                            <td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Booking No.</b></td>
                            <td width="39%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?=(isset($booking_details[0]['booking_no'])?$booking_details[0]['booking_no']:'')?></td>
                            <td width="20%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Booking Date</b></td>
                            <td width="26%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?=(isset($booking_details[0]['created_ts'])?date('d-m-Y H:i:s',strtotime($booking_details[0]['created_ts'])):'')?></td>
                        </tr>
                        <tr>
                            <td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b><?= ($booking_details[0]['first_name'] != '') ? 'Guest Name' : 'Company Name';?></b></td>
                            <td width="39%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= ($booking_details[0]['first_name'] != '') ? $booking_details[0]['first_name']." ".$booking_details[0]['last_name'] : $booking_details[0]['company_name']; ?></td>
                            <td width="20%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b><?= ($booking_details[0]['mobile'] != '') ? 'Mobile No.' : 'Company Phone';?></b></td>
                            <td width="26%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= ($booking_details[0]['mobile'] != '') ? $booking_details[0]['mobile'] : $booking_details[0]['company_phone']; ?></td>
                        </tr>
                        <tr>
                            <td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Check-in</b></td>
                            <td width="39%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?=(isset($booking_details[0]['check_in'])?date('d-m-Y',strtotime($booking_details[0]['check_in'])):'')?></td>
                            <td width="20%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Check-out</b></td>
                            <td width="26%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?=(isset($booking_details[0]['check_out'])?date('d-m-Y',strtotime($booking_details[0]['check_out'])):'')?></td>
                        </tr>
                        <tr>
                            <td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Booking For</b></td>
                            <td width="39%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?=(isset($booking_details[0]['property_name'])?$booking_details[0]['property_name']:'')?></td>
                            <td width="20%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Payable Amount</b></td>
                            <td width="26%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?=number_format($payable_amount['payable_amt'],2);?></td>
                        </tr>
                        <tr>
                            <td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Booking Status</b></td>
                            <td width="39%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?=(isset($booking_details[0]['booking_status'])?(($booking_details[0]['booking_status'] =='I')?'Initiated':(($booking_details[0]['booking_status'] =='C')?'Cancelled':(($booking_details[0]['booking_status'] =='A')?'Approved':(($booking_details[0]['booking_status'] =='F')?'Payment Failed':($booking_details[0]['booking_status'] =='O' ? 'Check-Out' : '')))   )):'')?></td>
                            <td width="20%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Adults/Child</b></td>
                            <td width="26%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= $booking_details[0]['adults'] . '/' . $booking_details[0]['children'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-bottom:5px;">
                    <tbody>
                        <tr>
                            <td width="7%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;"><b>Sl. No.</b></td>
                            <td width="33%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Particulars</b></td>
                            <td width="18%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Allotment Status</b></td>
                            <td width="26%" colspan="2" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;"><b>Date of Stay</b></td>
                            <td width="16%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;"><b>Net Amount</b></td>
                        </tr>
						<?php 
						if(!empty($booking_details)){
							foreach($booking_details as $details_key => $booking_detail){
						?>
                        <tr>
                            <td width="7%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?=($details_key + 1)?></td>
                            <td width="32%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?=$booking_detail['accommodation_name']?></td>
                            <td width="18%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?=(($booking_detail['allotment_status'] == 'B') ? 'Booked' : (($booking_detail['allotment_status'] == 'C')?'Cancelled':(($booking_detail['allotment_status'] == 'I')?'Checked in / Allotted':'Checked Out')))?></td>
                            <td width="13%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?=date('d-m-Y',strtotime($booking_detail['in_date']))?></td>
                            <td width="13%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?=date('d-m-Y',strtotime($booking_detail['out_date']))?></td>
                            <td width="16%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><?=$booking_detail['room_net_amount']?></td>
                        </tr>
						<?php
							}
						}
						?>
                    </tbody>
                </table>
				
				<?php
				if(!empty($pos_details)){
				?>
				<table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-bottom:5px;">
                    <tbody>
                        <tr>
                            <td width="7%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;"><b>Sl. No.</b></td>
                            <td width="33%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Particulars</b></td>
                            <td width="18%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Date & Time</b></td>
                            <td width="26%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;"><b>Invoice No.</b></td>
                            <td width="16%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;"><b>Net Amount</b></td>
                        </tr>
						<?php 
						if(!empty($pos_details)){
							foreach($pos_details as $pos_key => $pos_detail){
						?>
                        <tr>
                            <td width="7%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?=($pos_key + 1)?></td>
                            <td width="32%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?=$pos_detail['cost_center_name']?></td>
                            <td width="18%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?=date('d-m-Y H:i',strtotime($pos_detail['order_generate_time']))?></td>
                            <td width="13%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?= $pos_detail['invoice_no'];?></td>
							
							<td width="16%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;">
							<?php
							$_pos_amount = round($pos_detail['net_bill_amount']);
							echo number_format($_pos_amount,2);
							?>
							</td>
                        </tr>
						<?php
							}
						}
						?>
                    </tbody>
                </table>
				<?php
				}
				?>
				
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-bottom:5px;">
                    <tbody>
                        <tr>
                            <td width="7%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;"><b>Sl. No.</b></td>
                            <td width="19%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;"><b>Payment Date</b></td>
                            <td width="19%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;"><b>Payment Mode</b></td>
							<td width="19%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;"><b>Transaction ID/MR No. & Date</b></td>
                            <td width="19%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;"><b>Payment Status</b></td>
                            <td width="20%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;"><b>Remarks</b></td>
                            <td width="16%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;"><b>Amount</b></td>
                        </tr>
						
						<?php 
						$total_payment_amount = 0;
						$net_payable_booking_amount = (isset($booking_details[0]['net_payable_amount'])?$booking_details[0]['net_payable_amount']:0);
						
							if(!empty($booking_payment_details)){
								foreach($booking_payment_details as $payment_key => $booking_payment_detail){

									if(strtolower($booking_payment_detail['status']) =='success'){
										$total_payment_amount +=$booking_payment_detail['amount'];
									}
						?>
                        <tr>
                            <td width="7%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?=($payment_key + 1)?></td>
                            <td width="19%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?=date('d-m-Y H:i:s',strtotime($booking_payment_detail['payment_date']))?></td>
                            <td width="19%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?=$booking_payment_detail['payment_mode']?></td>
							<td width="19%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;">
							<?= ($booking_payment_detail['money_receipt_no'] == '') ? (($booking_payment_detail['order_id'] != '') ? $booking_payment_detail['order_id'] : $booking_payment_detail['transaction_ref_id']) : $booking_payment_detail['money_receipt_no'] .' & '.date('d/m/Y', strtotime($booking_payment_detail['money_receipt_date']));
										?>
							</td>
                            <td width="19%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?=ucfirst($booking_payment_detail['status'])?></td>
                            <td width="20%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?=$booking_payment_detail['remarks']?></td>
                            <td width="16%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><?=$booking_payment_detail['amount']?></td>
                        </tr>
						<?php
								}
							}
							else{
						?>
							<tr><td colspan="7" style="text-align:center;">No Data Available</td></tr>
						<?php
							}
						?>
                    </tbody>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-bottom:5px;">
                    <tbody>
                        <tr>
                            <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Payable Amount</b></td>
                            <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><b><?php
$payableAmt = ($payable_amount['payable_amt'] + $pos_net_amt);
echo number_format($payableAmt,2);
?></b></td>
                            <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Paid Amount</b></td>
                            <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><b><?=number_format($total_payment_amount,2)?></b></td>
                            <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Due Amount</b></td>
                            <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><b><?=number_format(($payableAmt - $total_payment_amount),2)?></b></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>