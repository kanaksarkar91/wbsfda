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


<style>
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

        .btn-print:focus,
        .btn-print:hover {
            background: #5dc6e6;
            color: #fff;
            border: #5dc6e6 2px solid;
            text-decoration: none;
            transition-duration: 0.5s;
            -webkit-transition-duration: 0.5s;
            outline: 0;
        }

</style>

</head>

<body role="document">
	<table id="printArea" cellpadding="0" cellspacing="0" border="0" style="width: 1240px; margin: 0 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 11px;border:#9e9e9e 1px solid; padding: 15px;text-align: center;">
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
                                        /* img {
                                            -webkit-filter: grayscale(100%);
                                            filter: grayscale(100%);
                                        } */
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
                                        /*table { page-break-inside:auto }
                                        tr    { page-break-inside:avoid; page-break-after:auto }
                                        thead { display:table-header-group; }
                                        tfoot { display:table-footer-group; }*/
                                    }
                                </style>
		<tr>
			<td>
				<table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom: 0px;">
					<tr>
						<td width="25%" style="text-align: left;padding:10px;">
							<img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/Biswa_Bangla_logo.png" width="48" alt="...">
						</td>
						<td width="50%" style="text-align: center;">
							<h3 style="margin-top:10px; font-size:14px;margin-bottom: 0px;line-height:1;font-weight:600;">The State Fisheries Development Corporation Limited</h3>
                            <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">(A Government of West Bengal Undertaking)<br>An ISO: 9001:2015 Company</p>
							<h2 style="text-align:center;font-size:12px;font-weight: 600; margin-top:10px;">Booking Acknowledgement</h2>
						</td>
						<td width="25%" style="text-align: right;padding-right:10px;">
							<img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/SFDC_logo.png" width="48" alt="..." style="margin-top:16px;">
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
							echo 'Admin';
						}else{
							echo 'Guest';
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
						<td width="10%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['gender']?></td>
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
						<td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">XXXXXXXX</td>
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
					<?php /*?><tr>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Contact Person 1 </b></td>
						<td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['contact_person_1_name'] ?></td>
						<td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No. </b></td>
						<td width="14%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['contact_person_1_mobile_no'] ?></td>
						<td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No.</b></td>
						<td width="24%" colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;">XXXXXXXXXXXXXXXXX</td>
					</tr><?php */?>
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
					<!-- <tr>
						<td width="7%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;"><b>Booking from</b> </td>
						<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;border-bottom: #9e9e9e 1px solid;"><?=date('d/m/Y',strtotime($booking_header['check_in'])) ?></td>
						<td width="7%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;" colspan="2"><b>Booking up to</b></td>
						<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?=date('d/m/Y',strtotime($booking_header['check_out'])) ?></td>
						<td width="15%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;"><b>No. of Day(s) / Night(s)</b></td>
						<td width="18%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;border-bottom: #9e9e9e 1px solid;text-align: center;"> 
						<?php $check_in_date=date_create($booking_header['check_in']);
						$check_out_date=date_create($booking_header['check_out']);
						$diff_check_in_out=date_diff($check_in_date,$check_out_date);
						echo $diff_check_in_out_nights = $diff_check_in_out->format("%a");
						?>
					</td>
						<td width="9%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;"><b>Adults/Child</b></td>
						<td width="18%" style="border-bottom: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?=($booking_details[0]['is_hall'] == 1)?'N/A':$booking_details[0]['adults'].'/'.$booking_details[0]['children'] ?></td>
						<td width="9%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;"><b>Mode</b></td>
						<td width="18%" style="border-bottom: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?=($booking_header['booking_source'] == 'F') ? 'Online' : 'Offline' ?></td>
					</tr> -->
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
						<td width="9%" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"><?=$booking_detail['extra_bed_cnt']?></td>
						<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;" rowspan="2"><?=$booking_detail['room_charge'] ?></td>
						<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;" rowspan="2"><?=$booking_detail['room_total_discount'] ?></td>
						<td width="9%" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;" rowspan="2"><?=$booking_detail['room_taxable_amount'] ?></td>
						<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?= (($booking_detail['room_igst_percent'] > 0) ? $booking_detail['room_igst_percent'].'%' : 'N/A') ?></td>
						<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;" rowspan="2"><?= ($booking_detail['room_igst']) ?></td>
						<td width="12%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;" rowspan="2"><?= $booking_detail['room_net_amount'] ?></td>
					</tr>
					<tr>
						<td style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"><?=($booking_detail['extra_bed_cnt'] >0) ? number_format((float)$booking_detail['extra_bed_rate'], 2, '.', '') : '0.00' ?></td>
						<td style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"><?= ($booking_detail['room_igst']) ?></td>
					</tr>
					<?php 
					$totalAdult += ($booking_detail['is_hall'] == 1)?0:$booking_detail['adults'];
					$totalChild += ($booking_detail['is_hall'] == 1)?0:$booking_detail['children'];
					$totalRoomRate +=$booking_detail['room_rate'];
					$totalExtraBedRate +=($booking_detail['extra_bed_cnt'] >0) ? $booking_detail['extra_bed_rate'] : 0;
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
						<td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><?=date('d/m/Y H:i:s',strtotime($booking_payment_listing['payment_date'])) ?></td>
						<td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><?=$booking_payment_listing['amount'] ?></td>
						<!-- <td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;">
							<?php
							if($booking_payment_listing['status'] == 'success'){
								echo '<span style="color:#008040; font-weight:bold;">Success</span>';
							} else if($booking_payment_listing['status'] == 'failure'){
								echo '<span style="color:red; font-weight:bold;">Failed</span>';
							} else {
								echo '<span style="font-weight:bold;">Pending</span>';
							}
							?>
						</td> -->
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

		<!-- <td style="text-align: left;">
		        <h6 style="padding-top: 5pt;text-align: center;"><bDepartment of Fisheries, Aquaculture, Aquatic Resources and Fishing Harbour<span class="s1"> </span>SFDC</b></h6>
                <h6 style="padding-left: 5pt;text-align: center;"><b>Uniform Reservation &amp; Cancellation Policy for Guest Houses &amp; Homestays<span class="s1"> </span> under SFDC owned &amp; maintained by Department of Fisheries, Aquaculture, Aquatic Resources and Fishing Harbour, Govt of West Bengal.</b></h6>
                <p style="text-align: left;"></p>
                <p class="s2" style="padding-top: 2pt;padding-left: 10pt;text-align: left;"><b>Uniform Reservation &amp; Cancellation Policy; Rules &amp; Regulation:</b></p>
                <p style="text-align: left;"></p>
                <ol id="l1">
                    <li data-list-text="1.">
                        <p style="padding-top: 2pt;padding-left: 20pt;text-align: left;">Guests are requested to follow the restriction imposed and guidelines as being issued from time to time by the Government and Local Authorities of the District before booking.</p>
                    </li>
                    <li data-list-text="2.">
                        <p style="padding-left: 20pt;text-align: left;">Booking can be made 90 days in advance against Full Online Payment.</p>
                    </li>
                    <li data-list-text="3.">
                        <p style="padding-top: 1pt;padding-left: 20pt;text-align: left;">Valid Reservation cum Money Receipt and Original Identity Proof (Voter Identity card / Passport / Pan Card/ Driving License / Photo ID card issued by Central / State Govt. for their employees etc.) of all Guest Name appearing in the Reservation Slip have to be shown at the time of checkin. The guest will also record relationship with accompanying members during check in.</p>
                    </li>
                    <li data-list-text="4.">
                        <p style="padding-left: 20pt;text-align: left;">The booking at the chosen Property is not transferable and is valid only if one of the ID cards noted above is presented during the check in.</p>
                    </li>
                    <li data-list-text="5.">
                        <p style="padding-left: 20pt;text-align: left;">No change of date and place are permitted.</p>
                    </li>
                    <li data-list-text="6.">
                        <p style="padding-top: 1pt;padding-left: 20pt;text-align: left;">Check in - After 11:00 AM &amp; Check Out - Before 09:00 A.M.</p>
                    </li>
                    <li data-list-text="7.">
                        <p style="padding-top: 2pt;padding-left: 20pt;text-align: left;">Only two children below 8-years of age may stay with parents without additional room tariff subject to size of the room booked. Extra bed is available on additional payment, subject to availability of space in room.</p>
                    </li>
                    <li data-list-text="8.">
                        <p style="padding-left: 20pt;text-align: left;">Guests are responsible for loss or damage of any article, caused by them inside the Guest House/Homestay. For such damage or breakage, the cost of the articles has to be paid by the Guests.</p>
                    </li>
                    <li data-list-text="9.">
                        <p style="padding-left: 20pt;text-align: left;">In case of power failure, where generator is available, it will run from 6.00 P.M. to 10.00 P.M. in the evening. The facility of Air-Conditioner or Geyser will be withdrawn temporarily in case of power failure.</p>
                    </li>
                    <li data-list-text="10.">
                        <p style="padding-left: 20pt;text-align: left;">Carrying of firearms or any inflammable materials inside the Guest House/Homestay is strictly prohibited.</p>
                    </li>
                    <li data-list-text="11.">
                        <p style="padding-left: 20pt;text-align: left;">Attendant / Staff of resort will check the articles inside the room before the Guests vacate it.</p>
                    </li>
                    <li data-list-text="12.">
                        <p style="padding-top: 2pt;padding-left: 20pt;text-align: left;">Guests are requested to ensure that other Guests are not disturbed by indiscipline or nuisance inside the Guest House/Homestay. If any Guest commits indiscipline or nuisance inside the Guest House/Homestay, he/she may be forced to leave the place.</p>
                    </li>
                    <li data-list-text="13.">
                        <p style="padding-left: 20pt;text-align: left;">Food is available at prescribed rates on prior intimation. No Guest will be allowed to cook food inside the Guest House/Homestay.</p>
                    </li>
                    <li data-list-text="14.">
                        <p style="padding-left: 20pt;text-align: left;">Guest House/ Homestay owner will not be liable for non-availability of amenities / services caused by irreparable technical faults or natural calamity.</p>
                    </li>
                    <li data-list-text="15.">
                        <p style="padding-left: 20pt;text-align: left;">Visitors to wear mask, follow social distancing, use sanitizer and comply all COVID-19 protocols, double vaccination should be completed, Aarogya Setu app must be installed in Guest’s phone.</p>
                    </li>
                    <li data-list-text="16.">
                        <p style="padding-left: 20pt;text-align: left;">Due to the ongoing renovation work at the Guest House/ Homestay, we deeply regret the inconvenience that you might face during your stay.</p>
                    </li>
                    <li data-list-text="17."><p style="padding-left: 20pt;text-align: left;">Anyone found using or under the influence of illegal drugs or substances classified under the Narcotic Drugs and Psychotropic Substances Act, 1985 will be reported to the police and asked to leave the property. Any evidence or suspicion of drug use at the property will also be reported immediately to the police.</p>
                    </li>
                    <li data-list-text="18.">
                        <p style="padding-left: 20pt;text-align: left;">Drinking alcohol is prohibited in all public areas including; in the property’s lobby, hallways, and parking areas.</p>
                    </li>
                    <li data-list-text="19.">
                        <p style="padding-left: 20pt;text-align: left;">No pets are allowed inside the Guest House/Homestay.</p>
                    </li>
                    <li data-list-text="20.">
                        <p style="padding-top: 2pt;padding-left: 20pt;text-align: left;">Reservation from Admin Login (Property Owner)<span class="p">: Reservation on discounted / full exemption on room rent on special ground can be made from Admin Login Property Owner).</span></p>
                    </li>
                    <li data-list-text="21.">
                        <p style="padding-left: 20pt;text-align: left;">Spot Reservation<span class="p">: Spot reservation can be made from Care Taker Login &amp; booking amount shall be recorded in the Portal as “Pay by Cash”.</span></p>
                    </li>
                    <li data-list-text="22."><p style="padding-left: 20pt;text-align: left;">Tax Rules<span class="p">: GST-12% When Room rent upto Rs. 7500/- per day, GST-18% When Room rent between Rs. 7,501/- and above per day as per notification 13/07/2022 with effect from 18/07/2022.</span></p>
                    </li>
                    <li data-list-text="23."><p style="padding-left: 20pt;text-align: left;">Extra Charges<span class="p">: Extra charges if any will be levied at the spot.</span></p>
                    </li>
                    <li data-list-text="24.">
						<p style="padding-top: 2pt;padding-left: 20pt;text-align: left;"> Discount on Room Rent<span class="p">: i). Inaugural Offer: Discount may be offered by Property Owner. ii). Property Owner may also decide on discount on room rent as per their decision.</span></p>
					</li>
                    <li data-list-text="25.">
						<p style="padding-left: 20pt;text-align: left;"><b>Cancellation Rules<span class="p">:</span></b></p>
						<ol id="l2">
							<li data-list-text="i)">
								<p style="padding-top: 2pt;padding-left: 20pt;text-align: left;">The reservation of accommodation may be cancelled by Property Owner in certain unavoidable circumstances / acute administrative requirement. In such cases Property Owner’s liability shall be restricted to refund of booking amount inclusive of taxes. No cancellation charge will be deducted under such scenario.</p>
							</li>
							<li data-list-text="ii)">
								<p style="padding-left: 20pt;text-align: left;">If accommodation is not provided due to unavoidable circumstances, compensation limited to book value of permit including taxes will be admissible.</p>
							</li>
							<li data-list-text="iii)">
								<p style="padding-left: 20pt;text-align: left;">Reservation may be cancelled by the Guest through the portal (only for online payments made by an Indian citizen). The amount of refund will be reversed to the debit/credit card/bank account after deducting the cancellation charges as per policy.</p>
							</li>
							<li data-list-text="iv)">
								<p style="padding-left: 20pt;text-align: left;">In case of cancellation of Booking made through online system, admissible amount will be refunded within 7 working days automatically in the account from which payment was made. If refund is not received within 7 working days, applicant may submit, an application for refund as admissible stating name of booking person, Bank name, Branch name, Account No. and IFSC Code.</p>
							</li>
						</ol>
					</li>
					<li data-list-text="26.">
						<p style="padding-left: 20pt;text-align: left;"><b>Cancellation Charges<span class="p">:</span></b></p>
						<p style="padding-left: 20pt;text-align: left;">Cancellation charges will be applied on the following terms: -<span class="p">:</span></p>
						<ol id="l3">
							<li data-list-text="i.">
								<p style="padding-left: 20pt;text-align: left;">No refund is admissible if the booking cancels before 48 hours from the date & time of Check-in as mentioned in the booking slip.</p>
							</li>
							<li data-list-text="ii.">
								<p style="padding-top: 3pt;padding-left: 20pt;text-align: left;">50% out of the total booking amount (excluding GST) will be deducted if the booking cancels before 49 to 144 hours (i.e. 3 to 6 days) from the date & time of Check-in as mentioned in the booking slip.</p>
							</li>
							<li data-list-text="iii.">
								<p style="padding-top: 3pt;padding-left: 20pt;text-align: left;">30% out of the total booking amount (excluding GST) will be deducted if the booking cancels before 145 to 360 hours (i.e. 7 to 15 days) from the date & time of Check-in as mentioned in the booking slip.</p>
							</li>
							<li data-list-text="iv.">
								<p style="padding-top: 3pt;padding-left: 20pt;text-align: left;">20% out of the total booking amount (excluding GST) will be deducted if the booking cancels before 361 to 720 hours (i.e. 16 to 30 days) from the date & time of Check-in as mentioned in the booking slip.</p>
							</li>
							<li data-list-text="v.">
								<p style="padding-top: 3pt;padding-left: 20pt;text-align: left;">10% out of the total booking amount (excluding GST) will be deducted if the booking cancels beyond 721 hours (i.e. 30 days onwards) from the date & time of Check-in as mentioned in the booking slip.</p>
							</li>
						</ol>
						<p style="padding-left: 20pt;text-align: left;"><span style="font-size:20px;">***</span> Check-in date & time is when the border will enter in the booking property as mentioned in the booking slip generated from the Panchayat Tourism portal after completion of full payment by the border.</p>
						<p style="padding-left: 20pt;text-align: left;"><span style="font-size:20px;">****</span> All the calculations of cancellation will be based on the Check-in date & time.</p>
					</li>
                    <li data-list-text="27.">
                        <p style="padding-top: 1pt;padding-left: 20pt;text-align: left;"><b>Refund Rules:</b></p>
                        <p style="text-align: left;"></p>
                        <ol id="l4">
                            <li data-list-text="(i)">
                                <p style="padding-left: 20pt;text-align: left;">Amount collected as GST with a booking transaction will not be refunded under any circumstances if the cancellation of the booking is initiated by the guest/user.</p>
                            </li>
                            <li data-list-text="(ii)">
                                <p style="padding-top: 1pt;padding-left: 20pt;text-align: left;">No amount will be refunded in a case of NO SHOW.</p>
                            </li>
                        </ol>
                    </li>
                    <li data-list-text="28.">
                        <p style="padding-left: 20pt;text-align: left;">The respective Property Owner undertakes the GST liability arising due to Cancellation of a Booking.</p>
                    </li>
                    <li data-list-text="29.">
                        <p style="padding-left: 20pt;text-align: left;">Department of Panchayats &amp; Rural Development of the Government of West Bengal is nothing but the facilitator, which is providing this online booking system and does not own or manage any of the property as displayed in this portal.</p>
                    </li>
                    <li data-list-text="30.">
                        <p style="padding-left: 20pt;text-align: left;">It is the whole and sole liability of the respective property owner in terms of providing the services, facilities, amenities etc. as mentioned or displayed in the interface of this portal through text content and images.</p>
                    </li>
                    <li data-list-text="31.">
                        <p style="padding-left: 20pt;text-align: left;">Each and every information and data as shown in the interface of this web portal through text contents and images against each property are the sole prerogative and responsibility of the respective property owner.</p>
                    </li>
                    <li data-list-text="32.">
                        <p style="padding-left: 20pt;text-align: left;">The liabilities in terms of deposit of GST with the concerned government authorities and filling of the returns are the responsibilities of the respective property owner.</p>
                    </li>
                    <li data-list-text="33.">
                        <p style="padding-left: 20pt;text-align: left;">The Department of Panchayats &amp; Rural Development of the Government of West Bengal cannot be held responsible under any circumstances for any dispute arising in terms of (i) not at all providing a service, which was somehow previously committed (ii) providing such services, which are not satisfactory to the guests, (iii) settlement of final invoice, (iv) discharging of GST liabilities and (v) modifications in booking details.</p>
                    </li>
                </ol>
			</td>-->
		

		
				
	</table>

	<table cellpadding="0" cellspacing="0" border="0" style="width: 1240px; margin: 10 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;border:#9e9e9e 1px solid; padding: 15px;text-align: center;">
	<tr>
			<input type="hidden" id="booking_id" name="booking_id" value="<?=$booking_header['booking_id']?>">
			<?php if(($booking_header['booking_status'] == 'I' || $booking_header['booking_status'] == 'A') && strtotime($booking_header['check_in']) >= time()){ ?>
				<td style="padding: 10px;">
				<h4>Cancellation Information</h4><br>
				<?php 
					$cancel_percent = $cancellation_details['cancellation_per'];
					$cancel_charge = intval((($booking_header['room_price_before_tax'] * $cancellation_details['cancellation_per']) / 100)*100)/100;
					$refund_amt = intval(($booking_header['room_price_before_tax'] - $cancel_charge)*100)/100;
				?>
				<h6>Cancellation Charge (Rs.) : <?= $cancel_charge ?></h6>
				<h6>Refund Amount (Rs.) : <?= $refund_amt ?></h6>
				<textarea type="text" class="form-control" id="cancel_remarks" name="cancel_remarks" placeholder="Cancel Remarks" rows="4" cols="50"></textarea>
				<input type="hidden" id="paid_amount" name="paid_amount" value="<?=$booking_header['room_price_before_tax']?>">
				<input type="hidden" id="cancel_percent" name="cancel_percent" value="<?=$cancel_percent?>">
				<input type="hidden" id="cancel_charge" name="cancel_charge" value="<?=$cancel_charge?>">
				<input type="hidden" id="refund_amt" name="refund_amt" value="<?=$refund_amt?>">
				
				
				<input type="button" id="cancel_booking_btn" style="float:right;margin-bottom:10px;margin-top:10px;" value="Cancel Booking" class="btn btn-danger">  
				</td>
			<?php } ?>
			<?php if($booking_header['booking_status'] == 'C' && isset($booking_header['cancellation_remarks'])){ ?>
				<td style="padding: 10px;">
					<h4>Cancellation Information</h4><br>
					<h6>Cancellation Percentage : <?= $cancellation_request_details['cancel_percent'] ?></h6>
					<h6>Cancellation Charge (Rs.) : <?= $cancellation_request_details['cancel_charge'] ?></h6>
					<h6>Refund Amount (Rs.) : <?= $cancellation_request_details['refund_amt'] ?></h6>
					<h6>Refund Status : <?= ($cancellation_request_details['is_refunded'] == '1') ? 'Refunded' :'Refund Initiated'?></h6>
					
					<textarea type="text" class="form-control" placeholder="Cancel Remarks" rows="4" cols="50" disabled><?=$booking_header['cancellation_remarks']?></textarea>
				</td>
			<?php } ?> 

		</tr>
	</table>

	<script>
		function printpart() {
		   var printwin = window.open("");
		   printwin.document.write(document.getElementById("printArea").innerHTML);
		   printwin.stop();
		   printwin.print();
		   printwin.close();
	   }

	   $(document).on('click',"#cancel_booking_btn",function(){


	   

var booking_id = $("#booking_id").val();
var cancel_remarks = $("#cancel_remarks").val();
var paid_amount = $("#paid_amount").val();
var cancel_percent = $("#cancel_percent").val();
var cancel_charge = $("#cancel_charge").val();
var refund_amt = $("#refund_amt").val();
if (!cancel_remarks) {

$.alert({
	title: 'Alert!',
	content: 'Please enter cancellation reason',
	type: 'red',
	typeAnimated: true,
})
return false;
}

$.confirm({
	type: 'red',
	title: 'Confirm',
	content: 'Do you want to cancel this booking?',
	buttons: {

		confirm: {
			action: function() {
				$("#cancel_booking_btn").prop('disabled',true);
				$("#cancel_booking_btn").val('Processing...');
				
				$.ajax({
					url: '<?php echo base_url("frontend/profile/cancel_booking"); ?>',
					method: 'post',
					data: {
						booking_id: booking_id,
						cancel_remarks : cancel_remarks,
						paid_amount : paid_amount,
						cancel_percent : cancel_percent,
						cancel_charge : cancel_charge,
						refund_amt : refund_amt, 
					},
					dataType: 'json',
					async: false,
					success: function(response) {
						if (response.status) {
							$("#cancel_booking_btn").prop('disabled',false);
							$("#cancel_booking_btn").val('Cancel Booking');
	
							$.confirm({
								type: 'green',
								title: 'Success!',
								content: response.msg,
								buttons: {

									OK: {
										btnClass: 'btn-default',
										action: function() {
											

												window.location.href="<?=base_url('my-booking')?>";
											}
											
										}
									}
							})

						} else {
							$("#cancel_booking_btn").prop('disabled',false);
							$("#cancel_booking_btn").val('Cancel Booking');

							$.alert({ 
								title: 'Alert!',
								content: response.msg,
								type: 'red',
								typeAnimated: true,
							})
						}
					}
				})

			}
				
		},
		cancel: {
			btnClass: 'btn-default',
			action: function() {

			}
		}
	}
})
})
   </script>
</body>
</html>
