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
    <style type="text/css">
        @page {
        size: A4;
        margin: .5cm;
    }
    @media print {
        .page {
            margin: .5cm;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
    </style>
</head>

<body role="document">

    <table class="tr-single-body" id="printArea" cellpadding="0" cellspacing="0" border="0" style="width: 100%;; margin: 0 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 11px;border:#9e9e9e 1px solid; padding: 0;text-align: center;">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom: 10px;">
                    <tr>
                        <td width="25%" style="text-align: center;padding:15px 0 0 15px;">
                            <img src="<?= base_url('public/frontend_assets/assets/img/bbl.png')?>" width="48" height="63" style="padding-right:10px;">
                        </td>
                        <td width="50%" style="text-align: center;">
                            <h3 style="font-size:14px;margin-bottom: 0px;line-height:1;">The State Fisheries Development Corporation Limited</h3>
                            <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">(A Government of West Bengal Undertaking)<br>
                            An ISO: 9001:2015 Company</p>
                            <h2 style="text-align:center;font-size:12px;">Booking Acknowledgement</h2>
                        </td>
                        <td width="25%" style="text-align: center;">
                            <img src="<?= base_url('public/frontend_assets/assets/img/sfdcl.png')?>" width="64" height="64" style="margin-top:10px; padding-left:10px;">
                        </td>                       
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid;">
                    <tr>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Booking ID</b></td>
                        <td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_header['booking_no'] ?></td>
                        <td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Transaction Date</b></td>
                        <td width="19%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= date('d/m/Y', strtotime($booking_header['created_ts'])) ?></td>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Booking Source</b></td>
                        <td width="19%" colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;">
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
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_header['customer_title'] . ' ' . $booking_header['first_name'] . ' ' . $booking_header['middle_name'] . ' ' . $booking_header['last_name'] ?></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No.</b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_header['mobile_country_code'] . ' ' . $booking_header['mobile'] ?></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>e-mail ID</b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?= $booking_header['email'] ?></td>
                    </tr>
                    <tr>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Booked for </b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_header['customer_title'] . ' ' . $booking_header['first_name'] . ' ' . $booking_header['middle_name'] . ' ' . $booking_header['last_name'] ?></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>GSTIN</b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?= $booking_header['gst_number'] ?></td>
                    </tr>
                    <tr>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Primary Guest </b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_header['customer_title'] . ' ' . $booking_header['first_name'] . ' ' . $booking_header['middle_name'] . ' ' . $booking_header['last_name'] ?></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Gender </b></td>
                        <td width="10%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_header['gender'] ?></td>
                        <td width="3%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Age</b></td>
                        <td width="10%" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?= $booking_header['age'] ?>&nbsp;<b>Years</b></td>
                    </tr>
                    <tr>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Contact No. </b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_header['mobile_country_code'] . ' ' . $booking_header['mobile'] ?></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No.</b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>e-mail ID</b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"></td>
                    </tr>

                    <tr>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Nationality</b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Total No. of Adult</b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Total No. of Child</b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"></td>
                    </tr>
                    <tr>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Check In Date</b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Check Out Date</b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Accommodation Count</b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"></td>
                    </tr>

                    <tr>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Property Name </b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $property_details['property_name'] ?></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>GSTIN</b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"></td>
                    </tr>
                    <tr>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Address </b></td>
                        <td colspan="7" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?= $property_details['property_address1'] . ',' . $property_details['property_address2'] ?></td>
                    </tr>
                    <tr>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>City / Village </b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $property_details['city'] ?></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>District </b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $property_details['district_name'] ?></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>State</b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?= $property_details['state_name'] ?></td>
                    </tr>
                    <tr>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>PIN Code </b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $property_details['pincode'] ?></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No. </b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $property_details['phone_no'] ?></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No.</b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"></td>
                    </tr>
                    <tr>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>e-mail ID</b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Check In Time</b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Check Out Time</b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-top: 10px; font-size: 12px;">
                    <tr>
                        <td colspan="10" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;"><b>Booking Details</b></td>
                    </tr>
                    <tr style="font-size: 10px;">
                        <td width="15%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"><b>Accommodation Category</b></td>
                        <td width="7%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Date</b></td>
                        <td width="10%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Base Rate</b><br><small>(per day/night)</small></td>
                        <td width="10%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"><b>Extra Person & Charge</b><br><small>(per day/night)</small></td>
                        <td width="10%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Price</b><br><small>(before Discount)</small></td>
                        <td width="7%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Discount</b><br><small>(if any)</small></td>
                        <td width="8%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"><b>Price</b><br><small>(before GST)</small></td>
                        <td width="10%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>GST Rate (%) & SAC</b></td>
                        <td width="10%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Consolidated GST</b></td>
                        <td width="12%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Amount Payable</b></td>
                    </tr>
                    <tr>
                        <td width="15%" rowspan="2" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: left;"></td>
                        <td width="7%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"></td>
                        <td width="10%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="10%" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"></td>
                        <td width="10%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="7%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"></td>
                        <td width="8%" rowspan="2" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: right;"></td>
                        <td width="10%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="10%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="12%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                    </tr>
                    <tr>
                        <td style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: right;"></td>
                        <td style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: right;"></td>
                    </tr>
                    <tr>
                        <td width="15%" rowspan="2" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: left;"></td>
                        <td width="7%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"></td>
                        <td width="10%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="10%" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"></td>
                        <td width="10%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="7%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"></td>
                        <td width="8%" rowspan="2" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: right;"></td>
                        <td width="10%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="10%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="12%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                    </tr>
                    <tr>
                        <td style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: right;"></td>
                        <td style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: right;"></td>
                    </tr>
                    <tr>
                        <td width="15%" rowspan="2" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: left;"></td>
                        <td width="7%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"></td>
                        <td width="10%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="10%" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"></td>
                        <td width="10%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="7%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"></td>
                        <td width="8%" rowspan="2" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: right;"></td>
                        <td width="10%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="10%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="12%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                    </tr>
                    <tr>
                        <td style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: right;"></td>
                        <td style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: right;"></td>
                    </tr>
                    <tr>
                        <td width="15%" rowspan="2" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: left;"></td>
                        <td width="7%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"></td>
                        <td width="10%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="10%" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"></td>
                        <td width="10%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="7%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"></td>
                        <td width="8%" rowspan="2" style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: right;"></td>
                        <td width="10%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="10%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                        <td width="12%" rowspan="2" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"></td>
                    </tr>
                    <tr>
                        <td style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: right;"></td>
                        <td style="padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: right;"></td>
                    </tr>
                    <tr>
                        <td width="15%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"><b>Total</b></td>
                        <td width="7%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b></b></td>
                        <td width="10%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b></b></td>
                        <td width="10%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"><b></b></td>
                        <td width="10%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b></b></td>
                        <td width="7%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b></b></td>
                        <td width="8%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;border-bottom: #9e9e9e 1px solid;text-align: center;"><b></b></td>
                        <td width="10%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b></b></td>
                        <td width="10%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b></b></td>
                        <td width="12%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b></b></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-top: 10px; font-size: 11px;">
                    <tr style="font-size: 10px;">
                        <td width="22%" rowspan="2" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Payment Information</b> </td>
                        <td width="9%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Mode</b></td>
                        <td width="15%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Processed by</b></td>
                        <td width="25%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Transaction ID</b></td>
                        <td width="17%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Date & Time</b></td>
                        <td width="12%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Amount</b></td>
						<td width="12%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Status</b></td>
                    </tr>
                    <tr>
                        <td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b><?= $booking_payment_listing['payment_mode'] ?></b></td>
                        <td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b><?= (($booking_payment_listing['transaction_ref_id'] != '') || ($booking_payment_listing['transaction_ref_id'] != NULL)) ? 'CCavenue' : '' ?></b></td>
                        <td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><?= $booking_payment_listing['txnid'] ?></td>
                        <td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><?= ($booking_payment_listing['payment_date'])?date('d/m/Y H:i:s', strtotime($booking_payment_listing['payment_date'])):'' ?></td>
                        <td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: right;"><b><?= $booking_payment_listing['amount'] ?></b></td>
						<td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;">
							<?php
							if(strtoupper($booking_payment_listing['status']) == 'SUCCESS'){
								echo '<span style="color:#008040; font-weight:bold;">Success</span>';
							} else if(strtoupper($booking_payment_listing['status']) == 'FAILURE'){
								echo '<span style="color:red; font-weight:bold;">Failed</span>';
							} else {
								echo '<span style="font-weight:bold;">Pending</span>';
							}
							?>
						</td>
                    </tr>
                </table>

            </td>
        </tr>
        
        <div>
            <p class="s2" style="padding-top: 0;padding-left: 10pt;text-align: left;"><b>Note:</b></p>
            <p style="text-align: left;"></p>
            <ol id="l1" style="text-align:left;">
                <li data-list-text="a.">
                    <span style="padding-left: 0pt;text-align: left;">This is a statement showing Booking & Payment details and not a GST Invoice. </span>
                </li>
                <li data-list-text="b.">
                    <span style="padding-left: 0pt;text-align: left;">The amount shown as GST in this document is an estimated value of the consolidated rate and amount of the applicable CGST and SGST.</span>
                </li>
                <li data-list-text="c.">
                    <span style="padding-left: 0pt;text-align: left;">Final GST Invoice will be provided from the respective Property at the time of Check Out based on the services actually availed and GST rate as applicable during the period of stay and Checking Out.</span>
                </li>
                <li data-list-text="d.">
                    <span style="padding-left: 0pt;text-align: left;">Amount shown in each of the fields of this document are in Indian Rupees. </span>
                </li>
                <li data-list-text="e.">
                    <span style="padding-left: 0pt;text-align: left;">For any queries & clarification please contact with the Contact No.(s) & email ID given along with the Property Information as mentioned hereinabove.</span>
                </li>
                <li data-list-text="f.">
                    <span style="padding-left: 0pt;text-align: left;">In case of Cancellation of this booking and/or no show up on the date of scheduled Check In as mentioned hereinabove, Cancellation Charges will be imposed according to the Cancellation Policy as applicable on the date of Cancellation and/or Check In.</span>
                </li>
                <li data-list-text="g.">
                    <span style="padding-left: 0pt;text-align: left;">The amount paid as GST as shown hereinabove will not be refunded under any circumstances even if the guest and/or the user of the website cancels the booking.</span>
                </li>
                <li data-list-text="h.">
                    <span style="padding-left: 0pt;text-align: left;">Please visit www.wbsfdcltd.com for Terms & Conditions, Cancellation Policy, Refund Policy, Privacy Policy and other information as this document may not contain all the important and required details that is applicable under any of the circumstances before, during and even after the stay.</span>
                </li>
                <li data-list-text="i.">
                    <span style="padding-left: 0pt;text-align: left;">The Check In will be allowed only on or after the Check In Time on the date of scheduled Check In i.e. first day of this Booking as mentioned hereinabove.</span>
                </li>
                <li data-list-text="j.">
                    <span style="padding-left: 0pt;text-align: left;">Checking Out is mandatory on or before the Check Out Time on the date of scheduled Check Out or in other words on the next date of the last day of this Booking as mentioned hereinabove.</span>
                </li>
                <li data-list-text="k.">
                    <span style="padding-left: 0pt;text-align: left;">This is a system generated document hence no signature and/or seal is required.</span>
                </li>
            </ol>
        </div>
    </table>
</body>

</html>