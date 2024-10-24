<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Safari Booking Slip</title>
    <style type="text/css">
        @page {
            size: A4;
            margin: 0cm;
        }
		
		.btn-print {
            background: #1c93b7;
            color: #fff;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            font-family: 'Poppins', sans-serif;
            border: #1c93b7 2px solid;
            padding: 11px 25px;
            font-size: 14px;
            font-weight: 400;
            text-decoration: none;
            text-transform: uppercase;
            transition-duration: 0.5s;
            -webkit-transition-duration: 0.5s;
            display: inline-block;
            margin-bottom: 30px;
            cursor: pointer;
        }
    </style>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>public/frontend_assets/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('public/admin_assets/css/sweetalert2.min.css'); ?>">
	
	<script src="<?= base_url('public/frontend_assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url(); ?>public/admin_assets/js/sweetalert2.min.js"></script>
</head>

<body role="document">
    <table id="printArea" cellpadding="0" cellspacing="0" border="0" style="width: 90%; margin: 0 auto; font-family: Arial, Helvetica, sans-serif; font-size: 11px; padding: 0;text-align: center;color: #000;">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%; margin-bottom: 5px;">
                    <tr>
                        <td colspan="3">
                            <img src="<?= base_url('public/frontend_assets/assets/img/logo.png');?>" width="228" height="88" alt="..." />
                        </td>
                    </tr>
                    <tr>
                        <td width="15%" style="text-align: right;padding-right:10px;">
                            <img src="<?= base_url('public/frontend_assets/assets/img/forest-2.jpg');?>" width="84" height="108" alt="..." style="margin-top:10px;" />
                        </td>
                        <td width="70%" style="text-align: center;">
                            <h3 style="margin-top:5px; font-size:18px;margin-bottom: 0px;line-height:1;font-weight:600;"><?= COM_NAME;?></h3>
                            <h3 style="margin-top:5px; font-size:16px;margin-bottom: 5px;line-height:1;font-weight:600;">Govt.Notification No. 1130-FR/11M-19/2003, On 10th June -2014</h3>
                            <h3 style="margin-top:0px; font-size:16px;margin-bottom: 5px;line-height:1;font-weight:600;">Reservation Slip for Car safari / Elephant Ride</h3>
                            <p style="font-size:14px; font-weight: 400;margin-bottom: 0;margin-top:0;font-weight:bold;">PNR No.: <?= $sBooking[0]['booking_number'];?></p>
                            <p style="font-size:14px; font-weight: 400;margin-bottom: 0;margin-top:0;font-weight:bold;">Contact No.: 9734190119</p>
                            <p style="font-size:12px;">Kindly Note down the PNR No for future reference</p>
                        </td>
                        <td width="15%" style="text-align: left; padding:10px;">
                            <img src="<?= base_url('public/frontend_assets/assets/img/forest-1.jpg');?>" width="84" height="108" alt="..." style="margin-top:10px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
		
		<?php
		if($_GET['type'] == 'cancel'){
			if(!$this->admin_session_data['user_id']){
		?>
			<tr>
				<td>
					<table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left;margin-top: 3px;">
						<tr>
							<th colspan="7" style="font-size:14px; padding: 6px 3px; text-align: left; background-color: #f5f5f5;">Visitor's Information</th>
						</tr>
						<tr>
							<th width="" style="font-size:12px; padding: 6px 3px; text-align: left; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Visitor's Name</th>
							<th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Gender</th>
							<th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Age</th>
							<th width="" style="font-size:12px; padding: 6px 3px; text-align: left; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">ID Card Type</th>
							<th width="" style="font-size:12px; padding: 6px 3px; text-align: left; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">ID Card No. </th>
							<th width="" style="font-size:12px; padding: 6px 3px; text-align: left; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Status</th>
							<th width="" style="font-size:12px; padding: 6px 3px; text-align: left; background-color: #f5f5f5; border-top: #9e9e9e 1px solid;">Action</th>
						</tr>
						<?php
						if(!empty($visitorDetail)){
							foreach($visitorDetail as $vrow){
						?>
						<tr>
							<td width="" style="font-size:12px; padding: 6px 3px; text-align: left; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $vrow['visitor_name'];?></td>
							<td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $vrow['visitor_gender'];?></td>
							<td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $vrow['visitor_age'];?></td>
							<td width="" style="font-size:12px; padding: 6px 3px; text-align: left; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $vrow['visitor_id_type'];?></td>
							<td width="" style="font-size:12px; padding: 6px 3px; text-align: left; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $vrow['visitor_id_no'];?></td>
							<td width="" style="font-size:12px; padding: 6px 3px; text-align: left; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $vrow['is_status'] == 1 ? '<span class="badge bg-success">Confirmed</span>' : '<span class="badge bg-danger">Cancelled</span>';?></td>
							<td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid;">
							<?php
							if($vrow['is_status'] == 1){
							?>
							<input class="form-check-input checkbox" type="checkbox" name="safari_booking_detail_id[]" value="<?= $vrow['safari_booking_detail_id'];?>">
							<input type="hidden" id="is_free<?= $vrow['safari_booking_detail_id'];?>" value="<?=$vrow['is_free']?>">
							<input type="hidden" id="visitor_age<?= $vrow['safari_booking_detail_id'];?>" value="<?=$vrow['visitor_age']?>">
							<?php } ?>
							</td>
						</tr>
						<?php } } ?>
					</table>
				</td>
			</tr>
			
			<tr>
				<td>
					<table cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin: 10 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;border:#9e9e9e 1px solid; padding: 5px;text-align: center;">
					<tr>
							<input type="hidden" id="booking_id" name="booking_id" value="<?= encode_url($sBooking[0]['booking_id']);?>">
							<?php 
							if($sBooking[0]['booking_status'] == 'A' && $calcelButtonVisible){
								if($sBooking[0]['source'] == 'F'){
							?>
								<td style="padding: 2px;">
								<h4>Cancellation Information</h4><br>
								<h6 id="cancelCharge"></h6>
								<h6 id="refundAmt"></h6>
								<textarea type="text" class="form-control" id="cancel_remarks" name="cancel_remarks" placeholder="Cancellation Reason" rows="4" cols="50" style="width:80%; margin-left:150px;"></textarea><br>
								<input type="hidden" id="paid_amount" name="paid_amount" value="<?=$sBooking[0]['base_price']?>">
								<input type="hidden" id="cancel_percent" name="cancel_percent" value="<?=$cancel_percent?>">
								<input type="hidden" id="cancel_charge" name="cancel_charge" value="<?=$cancel_charge?>">
								<input type="hidden" id="refund_amt" name="refund_amt" value="<?=$refund_amt?>">
								
								
								<input type="button" id="cancel_booking_btn" style="float:right;margin-bottom:10px;margin-top:10px; margin-right:10px;" value="Cancel Safari" class="btn btn-sm btn-danger">  
								</td>
							<?php 
								}
							}
							?>
							
							<?php if($sBooking[0]['booking_status'] == 'C' && isset($sBooking[0]['cancellation_remarks'])){ ?>
								<!--<td style="padding: 10px;">
									<h4>Cancellation Information</h4><br>
									<h6>Cancellation Percentage : <?= $cancellation_request_details['cancel_percent'] ?></h6>
									<h6>Cancellation Charge (Rs.) : <?= $cancellation_request_details['cancel_charge'] ?></h6>
									<h6>Refund Amount (Rs.) : <?= $cancellation_request_details['refund_amt'] ?></h6>
									<h6>Refund Status : <?= ($cancellation_request_details['is_refunded'] == '1') ? 'Refunded' :'Refund Initiated'?></h6>
									
									<textarea type="text" class="form-control" placeholder="Cancellation Reason" rows="4" cols="50" disabled><?=$sBooking[0]['cancellation_remarks']?></textarea>
								</td>-->
							<?php } ?> 
						</tr>
						
						
					</table>
				</td>
			</tr>
		<?php
			}
		}
		?>

        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left;">
                    <tr>
                        <th colspan="7" style="font-size:14px; padding: 6px 3px; text-align: left; background-color: #f5f5f5;"><span><?= $sBooking[0]['division_name'];?></span> - <span><?= $sBooking[0]['service_definition'];?></span></th>
                    </tr>
                    <!-- <tr>
                        <th colspan="7" style="font-size:14px; padding: 6px 3px; text-align: left; background-color: #f5f5f5;border-bottom: #9e9e9e 1px solid;">Booking Details:</th>
                    </tr> -->
                    <tr>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Nationality</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Booking Type</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Date of Booking</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Safari Date</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Total Amount</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Slot Time</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid;">Total Seat</th>
                    </tr>
                    <tr>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $sBooking[0]['cat_name'];?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= 'Public';?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= date('d-m-Y', strtotime($sBooking[0]['created_ts']));?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= date('d-m-Y', strtotime($sBooking[0]['booking_date']));?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= formatIndianCurrency($sBooking[0]['total_price']);?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $sBooking[0]['slot_desc'].': '.$sBooking[0]['start_time'].' - '.$sBooking[0]['end_time'];?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid;"><?= $sBooking[0]['no_of_person'];?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left;">
                    <tr>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Route Start Point</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Route End Point</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Reporting Place</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; ">Reporting Time</th>
                    </tr>
                    <tr>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $sBooking[0]['start_point'];?> </td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $sBooking[0]['end_point'];?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $sBooking[0]['reporting_place'];?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid;"><?= $sBooking[0]['reporting_time'];?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left;margin-top: 3px;">
                    <tr>
                        <th colspan="6" style="font-size:14px; padding: 6px 3px; text-align: left; background-color: #f5f5f5;border-bottom: #9e9e9e 1px solid;">Customer Details:</th>
                    </tr>
                    <tr>
                        <td width="14%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid;text-align: left;"><b>Customer Name</b></td>
                        <td width="15%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px;"><?= $sBooking[0]['first_name'];?></td>
                        <td width="12%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid;text-align: left;"><b>Phone No.</b></td>
                        <td width="15%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px;"><?= $sBooking[0]['mobile'];?></td>
                        <td width="14%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid;"><b>Email ID</b></td>
                        <td width="30%" style="font-size:12px;  padding: 6px 3px;"><?= $sBooking[0]['email'];?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left;margin-top: 3px;">
                    <tr>
                        <th colspan="6" style="font-size:14px; padding: 6px 3px; text-align: left; background-color: #f5f5f5;">Booked Visitor's Information</th>
                    </tr>
                    <tr>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: left; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Visitor's Name</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Gender</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Age</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: left; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">ID Card Type</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: left; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">ID Card No. </th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: left; background-color: #f5f5f5; border-top: #9e9e9e 1px solid;">Status</th>
                    </tr>
					<?php
					if(!empty($sBookingDetail)){
						foreach($sBookingDetail as $row){
					?>
                    <tr>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: left; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $row['visitor_name'];?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $row['visitor_gender'];?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $row['visitor_age'];?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: left; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $row['visitor_id_type'];?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: left; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $row['visitor_id_no'];?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: left; border-top: #9e9e9e 1px solid;"><?= $row['is_status'] == 1 ? '<span class="badge bg-success">Confirmed</span>' : '<span class="badge bg-danger">Cancelled</span>';?></td>
                    </tr>
					<?php } } ?>
                </table>
            </td>
        </tr>
		<tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left;margin-top: 3px;">
                    <tr>
                        <th colspan="6" style="font-size:14px; padding: 6px 3px; text-align: left; background-color: #f5f5f5;">Booked Child's Information</th>
                    </tr>
                    <tr>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: left; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Child's Name</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Gender</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Age</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: left; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">ID Card Type</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: left; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">ID Card No. </th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: left; background-color: #f5f5f5; border-top: #9e9e9e 1px solid;">Status</th>
                    </tr>
					<?php
					if(!empty($sBookingChildDetail)){
						foreach($sBookingChildDetail as $crow){
					?>
                    <tr>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: left; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $crow['visitor_name'];?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $crow['visitor_gender'];?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $crow['visitor_age'];?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: left; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $crow['visitor_id_type'];?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: left; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $crow['visitor_id_no'];?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: left; border-top: #9e9e9e 1px solid;"><?= $crow['is_status'] == 1 ? '<span class="badge bg-success">Confirmed</span>' : '<span class="badge bg-danger">Cancelled</span>';?></td>
                    </tr>
					<?php } } ?>
                </table>
            </td>
        </tr>
		<tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left;margin-top: 3px;">
                    <tr>
                        <th colspan="6" style="padding: 10px 3px; border-bottom: #9e9e9e 1px solid;"><b>Total Amount Payable (in words):</b> <span><?= getIndianCurrencyNumberToWord($sBookingPayment['amount']);?></span></th>
                    </tr>
                    <tr style="text-align: center;">
                        <th rowspan="2" style="border-right: #9e9e9e 1px solid; background-color: #f5f5f5; padding: 6px 3px;">Payment Information</th>
                        <th style="border-right: #9e9e9e 1px solid; background-color: #f5f5f5; padding: 6px 3px;">Mode</th>
                        <th style="border-right: #9e9e9e 1px solid; background-color: #f5f5f5; padding: 6px 3px;">Processed / Taken by</th>
                        <th style="border-right: #9e9e9e 1px solid; background-color: #f5f5f5; padding: 6px 3px;">Payment ID</th>
                        <th style="border-right: #9e9e9e 1px solid; background-color: #f5f5f5; padding: 6px 3px;">Date & Time</th>
                        <th style="background-color: #f5f5f5; padding: 6px 3px;">Amount Paid</th>
                    </tr>
                    <tr style="text-align: center;">
                        <td style="border-right: #9e9e9e 1px solid; border-top: #9e9e9e 1px solid; padding: 6px 3px;">Online</td>
                        <td style="border-right: #9e9e9e 1px solid; border-top: #9e9e9e 1px solid; padding: 6px 3px;">Internet Payment Gateway</td>
                        <td style="border-right: #9e9e9e 1px solid; border-top: #9e9e9e 1px solid; padding: 6px 3px;"><?= $sBookingPayment['razorpay_payment_id'];?></td>
                        <td style="border-right: #9e9e9e 1px solid; border-top: #9e9e9e 1px solid; padding: 6px 3px;"><?= formatIndianCurrency($sBookingPayment['amount']);?></td>
                        <td style="border-top: #9e9e9e 1px solid; padding: 6px 3px;"><?= date('d-m-Y H:i', strtotime($sBookingPayment['payment_date']));?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                    <tr>
                        <td width="100%" style="text-align: left; font-size: 11px; padding: 6px 3px;">
                            <ul style="margin-bottom: 0;">
                                <li style="list-style:none;padding-bottom:5px;"><span style="text-align: left;"><b>Terms & conditions:</b></span></li>
                                <li style="list-style:disc;padding-bottom:5px;">Visitors are required to carry the same ID proof in original at the time of visiting the national park.</li>
                                <li style="list-style:disc;padding-bottom:5px;">The reservations of safari/ride are not transferable. The visitor should carry with him/her Print out of the Electronic Reservation Slip.</li>
                                <li style="list-style:disc;padding-bottom:5px;">One child below 5 years of age may ride with parents without additional charges.</li>
                                <li style="list-style:disc;padding-bottom:5px;">Reservation may be cancelled in acute administrative requirement. No cancellation charge will be deducted in such case.</li>
                                <li style="list-style:disc;padding-bottom:5px;">WBSFDA will not be liable against non-availability of amenities/services caused by irreparable technical faults or natural inconvenience.</li>
                            </ul>
                        </td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                    <tr>
                        <td width="100%" style="text-align: left; font-size: 11px; padding: 6px 3px;">
                            <ul style="margin-bottom: 0;">
                                <li style="list-style:none;padding-bottom:5px;"><span style="text-align: left;"><b>Privacy Policy:</b></span></li>
                                <li style="list-style:disc;padding-bottom:5px;">As a general rule, this web site does not collect personal Information about you when you visit the site. You can generally visit this site, without revealing any personal information, unless you choose to provide such
                                    information.
                                </li>
                                <li style="list-style:disc;padding-bottom:5px;">Any personal information collected shall be used only for the stated purpose and shall NOT be shared with any other department/organization (Public/private).</li>
                                <li style="list-style:disc;padding-bottom:5px;">This site may contain links to Governmental/Non governmental sites whose data protection and privacy practices may differ from ours. We are not responsible for the content and privacy practices of these other websites and
                                    encourage you to consult the privacy notices of those sites.</li>
                            </ul>
                        </td>
                    </tr>
                </table>
				<?php
				if($_GET['type'] != 'cancel'){
				?>
                <table cellpadding="10" cellspacing="0" style="width:100%; border: #9e9e9e 1px solid; font-size: 11px;">
                    <thead>
                        <tr>
                            <th width="6%" style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid; background-color: #f5f5f5;">SL</th>
                            <th width="18%" style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid; background-color: #f5f5f5;">ROUTES</th>
                            <th width="18%" style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid; background-color: #f5f5f5;">WINTER <br>1<sup>st</sup> October to 28/29<sup>th</sup> February<br>Timing</th>
                            <th width="18%" style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid; background-color: #f5f5f5;">SUMMER <br>1<sup>st</sup> March to 30<sup>th</sup> September<br>Timing</th>
                            <th width="20%" style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid; background-color: #f5f5f5;">Reporting time</th>
                            <th width="20%" style="padding: 6px 3px; border-bottom: #9e9e9e 1px solid; background-color: #f5f5f5;">Reporting point</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">1</td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">(i) Madarihat-Harindanga <br>(ii) Madarihat-Lankapara</td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">
                                6.00 AM – 7.30 AM <br> 8.30 AM – 10.00 AM <br> 1.30 PM – 3.00 PM <br> 3.30 PM – 5.00 PM
                            </td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">
                                5.30 AM – 7.00 AM <br> 7.30 AM – 9.00 AM <br> 1.30 PM – 3.30 PM <br> 4.00 PM – 5.30 PM
                            </td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">
                                8 PM of previous day <br> 8 PM of previous day <br> 10 AM of same day <br> 10 AM of same day
                            </td>
                            <td style="padding: 6px 3px; border-bottom: #9e9e9e 1px solid;">AWLW Office, Madarihat</td>
                        </tr>
                        <tr>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">2</td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">Salkumar gate-Jaldapara</td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">
                                6.00 AM – 7.30 AM <br> 8.30 AM – 10.00 AM <br> 1.30 PM – 3.00 PM <br> 3.30 PM – 5.00 PM
                            </td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">
                                5.30 AM – 7.00 AM <br> 7.30 AM – 9.00 AM <br> 2.00 PM – 3.30 PM <br> 4.00 PM – 5.30 PM
                            </td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">
                                8 PM of previous day <br> 8 PM of previous day <br> 10 AM of same day <br> 10 AM of same day
                            </td>
                            <td style="padding: 6px 3px; border-bottom: #9e9e9e 1px solid;">Jaldapara East Range office</td>
                        </tr>
                        <tr>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">3</td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">Kodalbasty-Mendabari Watch Tower</td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">
                                6.00 AM – 7.30 AM <br> 8.30 AM – 10.00 AM <br> 1.30 PM – 3.00 PM <br> 3.30 PM – 5.00 PM
                            </td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">
                                5.30 AM – 7.00 AM <br> 7.30 AM – 9.00 AM <br> 2.00 PM – 3.30 PM <br> 4.00 PM – 5.30 PM
                            </td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">
                                8 PM of previous day <br> 8 PM of previous day <br> 10 AM of same day <br> 10 AM of same day
                            </td>
                            <td style="padding: 6px 3px; border-bottom: #9e9e9e 1px solid;">Kodalbasty Range Office</td>
                        </tr>
                        <tr>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">4</td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">Chilapata Range-Mendabari</td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">
                                6.00 AM – 7.30 AM <br> 8.30 AM – 10.00 AM <br> 1.30 PM – 3.00 PM <br> 3.30 PM – 5.00 PM
                            </td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">
                                5.30 AM – 7.00 AM <br> 7.30 AM – 9.00 AM <br> 2.00 PM – 3.30 PM <br> 4.00 PM – 5.30 PM
                            </td>
                            <td style="padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;">
                                8 PM of previous day <br> 8 PM of previous day <br> 10 AM of same day <br> 10 AM of same day
                            </td>
                            <td style="padding: 6px 3px; border-bottom: #9e9e9e 1px solid;">Chilapata Range Office</td>
                        </tr>
                    </tbody>
                </table>
				<?php } ?>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                    <tr>
                        <td width="100%" style="text-align: left; font-size: 11px; padding: 6px 3px;">
                            <ul style="margin-bottom: 0;">
                                <li style="list-style:none;padding-bottom:5px;"><span style="text-align: left;"><b>Cancellation Rules:</b></span></li>
                                <li style="list-style:disc;padding-bottom:5px;">More than clear 16 (Sixteen) days: 20% of the entry fee will be deducted.</li>
                                <li style="list-style:disc;padding-bottom:5px;">Between Clear 08(Eight) to clear15(Fifteen)days:40% of the entry fee will be deducted</li>
                                <li style="list-style:disc;padding-bottom:5px;">Between Clear04(Four)to clear 07(Seven)days:80% of the entry fee will be deducted.</li>
                                <li style="list-style:disc;padding-bottom:5px;">Less than or equal to 3 (Three)days: No refund.</li>
                                <li style="list-style:disc;padding-bottom:5px;">"Clear Days" means that the date of occupation and the date of cancellation would not be counted. Moreover, Sunday & Holiday would not be excluded for calculation of cancellation charges.</li>
                                <li style="list-style:disc;padding-bottom:5px;">For part cancellation, normal refund rules will be charged as per rules.</li>
                                <li style="list-style:disc;padding-bottom:5px;">Refund admissible only upon production of the original reservation ticket.</li>
                                <li style="list-style:disc;padding-bottom:5px;">Visitors have to pay vehicle entry free, Guide charge, Vehicle hiring charge and other requires charges at the entry gate/reporting point.</li>
                                <li style="list-style:disc;padding-bottom:5px;">Visitors have to pay other charges for Folk dance, Handicrafts etc. for afternoon trips of Gorumara at the entry gate/reporting point.</li>
                            </ul>
                        </td>
                    </tr>
                </table>
				
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                    <tr>
                        <td width="100%" style="text-align: center; font-size: 14px; border-top: #9e9e9e 1px solid;padding: 5px 0;">
                            <p style="margin:3px 0;">For more information please contact</p>
                            <p style="margin:3px 0;"><?= COM_NAME;?></p>
                            <p style="margin:3px 0;"><?= COM_ADDRESS;?></p>
                            <p style="margin:3px 0;">PH:<?= COM_PHONE;?> | Email :<?= COM_EMAIL;?> | <?= COM_WEBSITE;?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

<script>
function printpart() {
   $('#print_button').hide();
   var printwin = window.open("");
   printwin.document.write(document.getElementById("printArea").innerHTML);
   printwin.stop();
   printwin.print();
   printwin.close();
}

$(document).on("click",".checkbox",function() {
			
	var tHis = $(this);
	var isChecked = false;
	var checkedValues = [];
	var isFreeValues = [];
	var booking_id = $("#booking_id").val();
	// Iterate through each checked checkbox
	$('.checkbox:checked').each(function() {
		if($(this).is(':checked')){
			isChecked = true;
			checkedValues.push($(this).val());
			isFreeValues.push($('#is_free'+$(this).val()).val());
		}
		
	});
	
	console.log(isFreeValues);
	
	  $.ajax({
		type:'POST',
		url:"<?php echo base_url('cancellation-information'); ?>",
		data:{safari_booking_detail_ids: checkedValues, booking_id: booking_id, is_frees: isFreeValues, csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'},
		dataType: 'json',
		encode: true,
		success:function(d){
		  if(d.success){
			$("#cancelCharge").html('Cancellation Charge (Rs.) :'+ d.cancel_charge);
			$("#refundAmt").html('Refund Amount (Rs.) :'+ d.refund_amt);
			
			$("#cancel_percent").val(d.cancel_percent);
			$("#cancel_charge").val(d.cancel_charge);
			$("#refund_amt").val(d.refund_amt);
		  }else{
			
		  }
		}
	  });
});

$(document).on('click', "#cancel_booking_btn", function() {
    var booking_id = $("#booking_id").val();
    var cancel_remarks = $("#cancel_remarks").val();
    var paid_amount = $("#paid_amount").val();
    var cancel_percent = $("#cancel_percent").val();
    var cancel_charge = $("#cancel_charge").val();
    var refund_amt = $("#refund_amt").val();
	
	var tHis = $(this);
	var isChecked = false;
	var checkedValues = [];
	var checkedAgeValues = [];
	var isFreeValues = [];
	// Iterate through each checked checkbox
	$('.checkbox:checked').each(function() {
		if($(this).is(':checked')){
			isChecked = true;
			checkedValues.push($(this).val());
			checkedAgeValues.push($('#visitor_age'+$(this).val()).val());
			isFreeValues.push($('#is_free'+$(this).val()).val());
		}
		
	});
	
	// Get the PHP string into JavaScript
	var visitorAgesString = '<?= $visitorAges; ?>';
	
	// Convert the comma-separated string to an array
	var visitorAgesArray = visitorAgesString.split(',').map(function(value) {
		return parseInt(value); // Convert each value to a number
	});
	
	// Convert array2 values to numbers for comparison
	var array2Numeric = checkedAgeValues.map(function(value) {
		return parseInt(value);
	});
	
	// Filter out values from array1 that are present in array2
	var newArray = visitorAgesArray.filter(function(value) {
		return !array2Numeric.includes(value);
	});
	
	var hasValueGreaterThan18 = newArray.some(function(value) {
		return parseInt(value) >= 18;
	});
	
	// Get the count of elements in the first array
	var arrayLength = visitorAgesArray.length;
	var arrayLength2 = array2Numeric.length;
	
	if(arrayLength != arrayLength2){//partial cancellation
		if (!hasValueGreaterThan18) {
			Swal.fire({
			  icon: 'error',
			  title: 'No adults are present on this booking!!',
			  confirmButtonText:'Ok',
			  confirmButtonColor:'#69da68',
			  allowOutsideClick: false,
			});
			return false;
		}
	}
	
	console.log(arrayLength2);
	
	if(!isChecked){
		Swal.fire({
		  icon: 'error',
		  title: 'Please check at least one visitor!!',
		  confirmButtonText:'Ok',
		  confirmButtonColor:'#69da68',
		  allowOutsideClick: false,
		});
		return false;
	}

    if (!cancel_remarks) {
        Swal.fire({
            icon: 'error',
            title: 'Please enter cancellation reason!!',
            confirmButtonText: 'Ok',
            confirmButtonColor: '#69da68',
            allowOutsideClick: false,
        });
        return false;
    }

    // Confirmation before making the AJAX call
    Swal.fire({
        title: 'Are you sure you want to cancel the safari?',
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, cancel it!',
        cancelButtonText: 'No, keep it',
        allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
            
			$("#cancel_booking_btn").prop('disabled',true);
			$("#cancel_booking_btn").val('Processing...');
			// User confirmed, proceed with the AJAX call
            $.ajax({
                type: 'POST',
                url: '<?= base_url('cancel-safari-booking'); ?>',
                data: {
                    csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>',
					booking_id: booking_id,
					cancel_remarks : cancel_remarks,
					paid_amount : paid_amount,
					cancel_percent : cancel_percent,
					cancel_charge : cancel_charge,
					refund_amt : refund_amt,
					safari_booking_detail_ids: checkedValues,
					visitor_ages: checkedAgeValues,
					is_free: isFreeValues,
                },
                dataType: 'json',
                encode: true,
                //async: false,
				/*beforeSend:function(){
					$("#cancel_booking_btn").html('<i class="fa fa-spinner fa-spin"></i>Wait..');
				 },*/
            })
            .done(function(response) {
                if (response.status) {
                    $("#cancel_booking_btn").prop('disabled',false);
					$("#cancel_booking_btn").val('Cancel Booking');
					Swal.fire({
                        icon: 'success',
                        title: response.msg,
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#69da68',
                        allowOutsideClick: false,
                    }).then(result => {
						if (result.value) {
							location.reload();
						}
					});
                } else {
                    $("#cancel_booking_btn").prop('disabled',false);
					$("#cancel_booking_btn").val('Cancel Booking');
					
					Swal.fire({
                        icon: 'error',
                        title: response.msg,
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#69da68',
                        allowOutsideClick: false,
                    });
                }
            });
        }
    });
});
</script>

</body>

</html>