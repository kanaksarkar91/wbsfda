<?php
//echo '<pre>'; print_r($booking_payment_listing); die;
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.1/css/bootstrap.min.css" integrity="sha512-siwe/oXMhSjGCwLn+scraPOWrJxHlUgMBMZXdPe2Tnk3I0x3ESCoLz7WZ5NTH6SZrywMY+PB1cjyqJ5jAluCOg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<title>Booking Confirmation</title>

</head>

<body role="document">
	<table id="printArea" cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin: 0 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 11px;border:#9e9e9e 1px solid; padding: 15px;text-align: center;">
	    <style type="text/css">
                                        body,
                                        p,
                                        ol,
                                        li,
                                        tr,
                                        th,
                                        td,
                                        small,
                                        strong,
                                        i,
                                        u,
                                        em,
                                        h5,
                                        h4,
                                        h3,
                                        h2,
                                        h1,
                                        b {font-family: Arial, Helvetica, sans-serif!important;line-height:1.4;}
                                        table,p,ol,ul,li{font-size: 12px;}
                                    @media print {
                                        @page {
                                            size: portrait;
                                            font-family: Arial, Helvetica, sans-serif;
                                        }
                                        .tr-single-body {
                                            width: 75mm;
                                            height: 100%!important;
                                            overflow: scroll;
                                            margin: 1cm .5cm;
                                        }
                                        body,
                                        p,
                                        ol,
                                        li,
                                        table,
                                        tr,
                                        th,
                                        td,
                                        small,
                                        strong,
                                        i,
                                        u,
                                        em,
                                        h5,
                                        h4,
                                        h3,
                                        h2,
                                        h1,
                                        b {
                                            font-size: 10.5pt;
                                            line-height: 1.4;
                                            font-family: Arial, Helvetica, sans-serif;
                                        }
                                        h6,
                                        h5,
                                        p,
                                        small,
                                        tr,
                                        th,
                                        td,
                                        ol,
                                        li {
                                            margin: 0px;
                                        }
                                        table {
                                            width: 100%;
                                            border-collapse: collapse;
                                            border: 0;
                                            margin-bottom: 4mm;
                                        }
                                        table tr {
                                            border: 0;
                                        }
                                        table tr td,
                                        table tr th {
                                            border: 1px solid #666;
                                            padding: 3px 5px;
                                            font-size: 10.5pt;
                                            line-height:1;
                                        }
                                        p,
                                        small {
                                            padding: 0;
                                        }
                                    }
                                </style>
		<tr>
			<td>
				<table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom: 0px;">
					<tr>
						<td width="25%" style="text-align: left;padding:10px;">
							<img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/Biswa_Bangla_logo.png" width="64" alt="...">
						</td>
						<td width="50%" style="text-align: center;">
							<h3 style="margin-top:10px; font-size:14px;margin-bottom: 0px;line-height:1;font-weight:600;">The State Fisheries Development Corporation Limited</h3>
                            <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">(A Government of West Bengal Undertaking)<br>An ISO: 9001:2015 Company</p>
							<h2 style="text-align:center;font-size:12px;font-weight: 600; margin-top:10px;">Booking Acknowledgement</h2>
						</td>
						<td width="25%" style="text-align: right;padding-right:10px;">
							<img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/SFDC_logo.png" width="64" alt="..." style="margin-top:16px;">
						</td>
					</tr>
				</table>
				
			</td>
		</tr>
		<tr>
			<td>
			<table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-bottom:10px;">
					<tr>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Booking ID</b></td>
						<td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['booking_no'] ?></td>
						<td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Transaction Date</b></td>
						<td width="14%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=date('d/m/Y',strtotime($booking_header['created_ts'])) ?></td>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Booking Source</b></td>
						<td width="24%" colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;">
						<?php
						if($booking_header['booking_source'] == 'B'){
						?>
							<?= 'Admin';?>
						<?php
						}else{
						?>
							<?= 'Guest';?>
						<?php
						}
						?>
						</td>
					</tr>
					<tr>
						<td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Booked by</b></td>
						<td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$customer_details['customer_title'].' '. $customer_details['first_name'] .' '. $customer_details['middle_name'] .' '. $customer_details['last_name'] ?></td>
						<td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No.</b></td>
						<td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$customer_details['mobile_country_code'].' '. $customer_details['mobile'] ?></td>
						<td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>e-mail ID</b></td>
						<td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?=$customer_details['email'] ?></td>
					</tr>
			</table>
			<table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-bottom:10px;">					
					<tr>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Booked for </b></td>
						<td colspan="3" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['customer_title'].' '. $booking_header['first_name'] .' '. $booking_header['middle_name'] .' '. $booking_header['last_name'] ?></td>
						<td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>GSTIN</b></td>
						<td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['gst_number']?></td>
					</tr>
					<tr>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Primary Guest </b></td>
						<td colspan="3" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['customer_title'].' '. $booking_header['first_name'] .' '. $booking_header['middle_name'] .' '. $booking_header['last_name'] ?></td>
						<td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Gender </b></td>
						<td width="10%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['gender'];?></td>
						<td width="3%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Age</b></td>
						<td width="10%" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['age']?>&nbsp;<b>Years</b></td>
					</tr>
					<tr>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Contact No. </b></td>
						<td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['mobile_country_code'].' '.$booking_header['mobile']?></td>
						<td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No.</b></td>
						<td width="14%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>e-mail ID</b></td>
						<td width="24%" colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['email']?></td>
					</tr>
					<tr>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Nationality </b></td>
						<td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Indian</td>
						<td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Total No. of Adult</b></td>
						<td width="14%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_details[0]['adults']?></td>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Total No. of Child</b></td>
						<td width="24%" colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?=$booking_details[0]['children']?></td>
					</tr>
					<tr>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Check In Date </b></td>
						<td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=date('d/m/Y', strtotime($booking_header['check_in']));?></td>
						<td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Check Out Date</b></td>
						<td width="14%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=date('d/m/Y', strtotime($booking_header['check_out']));?></td>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Accommodation Count</b></td>
						<td width="24%" colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['room_count']?></td>
					</tr>
			</table>
			
			<table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-bottom:10px;">
					<tr>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Property Name </b></td>
						<td colspan="3" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['property_name']?></td>
						<td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>GSTIN</b></td>
						<td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['gst_no']?></td>
					</tr>
					<tr>
						<td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Address </b></td>
						<td colspan="7" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['address_line_1'].','.$property_details['address_line_2'] ?></td>
					</tr>
					<tr>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>City / Village </b></td>
						<td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['city'] ?></td>
						<td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>District </b></td>
						<td width="14%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['district_name'] ?></td>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>State</b></td>
						<td width="24%" colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['state_name'] ?></td>
					</tr>
					<tr>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>PIN Code </b></td>
						<td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['pincode'] ?></td>
						<td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No 1. </b></td>
						<td width="14%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['phone_no'] ?></td>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No 2.</b></td>
						<td width="24%" colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['mobile_no'] ?></td>
					</tr>
					<tr>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: left;"><b>e-mail ID </b></td>
						<td width="21%" style="border-right: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['email'] ?></td>
						<td width="15%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;"><b>Check In Time </b></td>
						<td width="14%" style="border-right: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['checkin_time'] ?></td>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;"><b>Check Out Time</b></td>
						<td width="24%" colspan="3" style="padding: 3px;"><?=$property_details['checkout_time'] ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
			<table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; font-size: 12px;">
					<tr>
						<td colspan="10" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;">
						    <b>Booking Details</b>
					    </td>
					</tr>
					<tr style="font-size: 11px;">
						<td width="15%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"><b>Accommodation Category </b> </td>
						<td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Date</b></td>
						<td width="10%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Base Rate</b><br><small>(per day/night)</small></td>
						<td width="9%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"><b>Extra Person & Charge</b><br><small>(per day/night)</small></td>
						<td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Price</b><br><small>(before Discount)</small></td>
						<td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Discount</b><br><small>(if any)</small></td>
						<td width="9%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"><b>Price</b><br><small>(before GST)</small></td>
						<td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>GST Rate (%) & SAC</b></td>
						<td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Consolidated GST</b></td>
						<td width="12%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Amount Payable</b></td>
					</tr>
					<?php 
						$totalAdult=$totalChild=$totalRoomRate=$totalExtraBedRate=$totalRoomBasePrice=$totalRoomDiscount=$totalRoomPriceBeforeTax=$totalGSTAmount=$totalPayableAmount=0;
					if(!empty($booking_details)){
							foreach($booking_details as $booking_detail){ ?>
					<tr>
						<td width="15%" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;" rowspan="2"><?=$booking_detail['accommodation_name'];?></td>
						<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;" rowspan="2"><?=date('d/m/Y', strtotime($booking_detail['in_date']));?></td>
						<td width="10%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;" rowspan="2"><?=$booking_detail['room_rate'] ?></td>
						<td width="9%" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"><?=$booking_detail['is_select_extra_bed']?></td>
						<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;" rowspan="2"><?=$booking_detail['room_charge'] ?></td>
						<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;" rowspan="2"><?=$booking_detail['room_total_discount'] ?></td>
						<td width="9%" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;" rowspan="2"><?=$booking_detail['room_taxable_amount'] ?></td>
						<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?= (($booking_detail['room_igst_percent'] > 0) ? $booking_detail['room_igst_percent'].'%' : 'N/A') ?></td>
						<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;" rowspan="2"><?= ($booking_detail['room_igst']) ?></td>
						<td width="12%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;" rowspan="2"><?= $booking_detail['room_net_amount'] ?></td>
					</tr>
					<tr>
						<td style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"><?=($booking_detail['is_select_extra_bed'] >0) ? number_format((float)$booking_detail['extra_bed_rate'], 2, '.', '') : '0.00' ?></td>
						<td style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"><?= ($booking_detail['room_igst']) ?></td>
					</tr>
					<?php 
					$totalAdult += ($booking_detail['is_hall'] == 1)?0:$booking_detail['adults'];
					$totalChild += ($booking_detail['is_hall'] == 1)?0:$booking_detail['children'];
					$totalRoomRate +=$booking_detail['room_rate'];
					$totalExtraBedRate +=($booking_detail['is_select_extra_bed'] >0) ? $booking_detail['extra_bed_rate'] : 0;
					$totalRoomBasePrice +=$booking_detail['room_charge'];
					$totalRoomDiscount +=$booking_detail['room_total_discount'];
					$totalRoomPriceBeforeTax +=$booking_detail['room_taxable_amount'];
					$totalGSTAmount += $booking_detail['room_igst'];
                    $totalPayableAmount +=$booking_detail['room_net_amount'];					
						}
					}
					 ?>
					<tr>
						<td width="15%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;"><b>Total </b></td>
						<td width="9%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;"><b></b></td>
						<td width="10%" style="background-color:#d9d9d9;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b><?=number_format((float)$totalRoomRate, 2, '.', '')?></b></td>
						<td width="9%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b><?=number_format((float)$totalExtraBedRate, 2, '.', '')?></b></td>
						<td width="9%" style="background-color:#d9d9d9;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b><?=number_format((float)$totalRoomBasePrice, 2, '.', '')?></b> </td>
						<td width="9%" style="background-color:#d9d9d9;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b><?=number_format((float)$totalRoomDiscount, 2, '.', '')?></b></td>
						<td width="9%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b><?=number_format((float)$totalRoomPriceBeforeTax, 2, '.', '')?></b></td>
						<td width="9%" style="background-color:#d9d9d9;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b></b></td>
						<td width="9%" style="background-color:#d9d9d9;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b><?=number_format((float)$totalGSTAmount, 2, '.', '')?></b></td>
						<td width="12%" style="background-color:#d9d9d9;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b><?=number_format((float)$totalPayableAmount, 2, '.', '')?></b></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
			<table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-top: 10px;">
					<tr>
						<td width="15%" rowspan="2" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Payment Information</b> </td>
						<td width="19%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Mode</b></td>
						<td width="18%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Processed by</b></td>
						<td width="18%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Transaction ID</b></td>
						<td width="18%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Date & Time</b></td>
						<td width="12%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Amount</b></td>
					</tr>
					<tr>
						<td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b><?=$booking_payment_listing['payment_mode']?></b></td>
						<td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b><?=(($booking_payment_listing['transaction_ref_id'] !='') || ($booking_payment_listing['transaction_ref_id'] !=NULL)) ? 'CCavenue' : '' ?></b></td>
						<td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><?=$booking_payment_listing['txnid'] ?></td>
						<td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;">
						<?php
						if($booking_payment_listing['payment_date'] == '' || $booking_payment_listing['payment_date'] == '0000-00-00'){
						?>
							<?= '';?>
						<?php
						}
						else{
						?>
							<?= date('d/m/Y H:i:s',strtotime($booking_payment_listing['payment_date']));?>
						<?php
						}
						?>
						</td>
						<td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><?=$booking_payment_listing['amount'] ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<ul style="list-style: none;text-align: left;">
					<li><h6 style="margin-top: 8px; margin-bottom: 8px; font-weight:bold;">Note :</h6></li>
					<li><b>(a)</b> This is a statement showing Booking & Payment details and not a GST Invoice. </li>
					<li><b>(b)</b> The amount shown as GST in this document is an estimated value of the consolidated rate and amount of the applicable CGST and SGST.</li>
					<li><b>(c)</b> Final GST Invoice will be provided from the respective Property at the time of Check Out based on the services actually availed and GST rate as applicable during the period of stay and Checking Out.</li>
					<li><b>(d)</b> Amount shown in each of the fields of this document are in Indian Rupees. </li>
					<li><b>(e)</b> For any queries & clarification please contact with the Contact No.(s) & email ID given along with the Property Information as mentioned hereinabove.</li>
					<li><b>(f)</b> In case of Cancellation of this booking and/or no show up on the date of scheduled Check In as mentioned hereinabove, Cancellation Charges will be imposed according to the Cancellation Policy as applicable on the date of Cancellation and/or Check In.</li>
					<li><b>(g)</b> The amount paid as GST as shown hereinabove will not be refunded under any circumstances even if the guest and/or the user of the website cancels the booking.</li>
					<li><b>(h)</b> Please visit www.wbsfdcltd.com for Terms & Conditions, Cancellation Policy, Refund Policy, Privacy Policy and other information as this document may not contain all the important and required details that is applicable under any of the circumstances before, during and even after the stay.</li>
					<li><b>(i)</b> The Check In will be allowed only on or after the Check In Time on the date of scheduled Check In i.e. first day of this Booking as mentioned hereinabove. </li>
					<li><b>(j)</b> Checking Out is mandatory on or before the Check Out Time on the date of scheduled Check Out or in other words on the next date of the last day of this Booking as mentioned hereinabove.</li>
					<li><b>(k)</b> This is a system generated document hence no signature and/or seal is required.</li>
				</ul>
			</td>
		</tr>

				
	</table>
</body>
</html>
