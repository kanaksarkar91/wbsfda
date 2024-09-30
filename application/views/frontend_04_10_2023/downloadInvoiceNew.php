<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
    <title>TAX INVOICE</title>
    <style type="text/css">
        @page {
        size: A4;
        margin: .25cm;
    }
    </style>
</head>

<body role="document">
    <table id="printArea" cellpadding="0" cellspacing="0" border="0" style="width: 100%;; margin: 0 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 11px; padding: 0;text-align: center;">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom: 10px;">
                    <tr>
                        <td width="20%" style="text-align: left;padding:10px;">
                            <img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/Biswa_Bangla_logo.jpg" width="64" alt="..."/>
                        </td>
                        <td width="60%" style="text-align: center;">
                            <h3 style="margin-top:10px; font-size:14px;margin-bottom: 0px;line-height:1;font-weight:600;">The State Fisheries Development Corporation Limited</h3>
                            <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">(A Government of West Bengal Undertaking)<br>An ISO: 9001:2015 Company</p>
                            <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">Bikash Bhawan, North Block, 1st Floor, Salt Lake, Kolkata - 700 091, West Bengal</p>
							<h2 style="text-align:center;font-size:12px;font-weight: 600;">Tax Invoice</h2>
                        </td>
                        <td width="20%" style="text-align: right;padding-right:10px;">
                            <img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/SFDC_logo.jpg" width="64" alt="..." style="margin-top:10px;"/>
                        </td>                       
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid;">
                    <tr>
                        <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Tax Invoice No.</td>
                        <td width="18%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_header['booking_no'] ?></td>
                        <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">GSTIN</td>
                        <td width="17%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['gst_no']?></td>
                        <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">Booking ID</td>
                        <td width="26%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;">
						<?= $booking_header['booking_no'] ?>
						</td>
                    </tr>
                    <tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Date</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_header['customer_title'] . ' ' . $booking_header['first_name'] . ' ' . $booking_header['middle_name'] . ' ' . $booking_header['last_name'] ?></td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">State & Code</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_header['mobile_country_code'] . ' ' . $booking_header['mobile'] ?></td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">Booking Date</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;"><?=date('d/m/Y',strtotime($booking_header['created_ts'])) ?></td>
                    </tr>
                    <tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">RCM Applicable</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">No. </td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">Income Tax PAN</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_header['mobile_country_code'] . ' ' . $booking_header['mobile'] ?></td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">Source</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;">
						<?php
						if($booking_header['booking_source'] == 'B'){
							echo 'Admin';
						}else{
							echo 'Guest';
						}
						?>
						</td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid;">
                    <tr>
                        <td colspan="6" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">
                            Place of Service Delivery (Property Information)
                        </td>
                    </tr>
                    <tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">
                            Property
                        </td>
                        <td colspan="5" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['property_name']?></td>
                    </tr>
                    <tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">
                            Address
                        </td>
                        <td colspan="5" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['address_line_1'].','.$property_details['address_line_2'] ?></td>
                    </tr>
                    <tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">City / Village</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['city'] ?></td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">District</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['district_name'] ?></td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">PIN Code</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;"><?=$property_details['pincode'] ?></td>
                    </tr>
                </table>    
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid;">
                    <tr>
                        <td colspan="6" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">
                            Details of Receiver (Bill to)
                        </td>
                    </tr>
                    <tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Name</td>
                        <td colspan="3" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['customer_title'].' '. $booking_header['first_name'] .' '. $booking_header['middle_name'] .' '. $booking_header['last_name'] ?></td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">GSTIN</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['gst_number'] ?></td>
                    </tr>
                    <tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">
                            Address
                        </td>
                        <td colspan="5" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['personal_address'] ?></td>
                    </tr>
                    <tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">City / Village</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['company_city'] ?></td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">PIN Code</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['company_pincode'] ?></td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">State & Code</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;"><?=$booking_header['company_pincode'] ?></td>
                    </tr>
                </table>    
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid;">
                    <tr>
                        <td colspan="8" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">
                            Guest Information
                        </td>
                    </tr>
                    <tr>
						<td width="13.33%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Primary Guest </td>
						<td colspan="3" width="43%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo $primary_guest_details['name'];?></td>
						<td width="10.33%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">Gender </td>
						<td width="15%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo $primary_guest_details['gender'];?></td>
						<td width="6.33%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">Age</td>
						<td width="12%" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?php echo $primary_guest_details['age'];?> &nbsp;Years</td>
					</tr>
                    <tr>
						<td width="13.33%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Contact No. </td>
						<td width="15%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo $primary_guest_details['phone'];?></td>
						<td width="13%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Contact No.</td>
						<td width="15%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">&nbsp;</td>
						<td width="10.33%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">e-mail ID </td>
						<td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;">&nbsp;</td>
					</tr>
                    <tr>
						<td width="13.33%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Nationality</td>
						<td width="15%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">XXX</td>
						<td width="13%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Total Adult</td>
						<td width="15%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_details[0]['adults']?></td>
						<td width="10.33%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">Total Child</td>
						<td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?=$booking_details[0]['children']?></td>
					</tr>
                </table>    
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid;">
                    <tr>
                        <td colspan="9" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">
                            Stay & Booking Information (Accommodation Details)
                        </td>
                    </tr>
                    <tr>
                        <td width="5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Sl No.</td>
                        <td width="25%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;" colspan="2">Accommodation Category & No.</td>
                        <td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Date</td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Base Rate per Day/Night</td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Charge for Extra Person per Day/Night</td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Price before Discount</td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Discount Allowed</td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Price before GST</td>
                    </tr>
					<?php
					if(!empty($booking_details)){
						foreach($booking_details as $booking_detail){
					?>
                    <tr>
                        <td width="5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo ++$sl;?></td>
                        <td width="22%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_detail['accommodation_name'];?></td>
                        <td width="3%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">XX</td>
                        <td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=date('d/m/Y', strtotime($booking_detail['in_date']));?></td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_detail['room_rate'] ?></td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=($booking_detail['extra_bed_cnt'] >0) ? number_format((float)$booking_detail['extra_bed_rate'], 2, '.', '') : '0.00' ?></td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_detail['room_charge'] ?></td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_detail['room_total_discount'] ?></td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=$booking_detail['room_taxable_amount'] ?></td>
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
                        <td colspan="4" style="text-align: left; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><b>Sub Total</b></td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=number_format((float)$totalRoomRate, 2, '.', '')?></td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=number_format((float)$totalExtraBedRate, 2, '.', '')?></td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=number_format((float)$totalRoomBasePrice, 2, '.', '')?></td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=number_format((float)$totalRoomDiscount, 2, '.', '')?></td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?=number_format((float)$totalRoomPriceBeforeTax, 2, '.', '')?></td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid;">
                    <tr>
                        <td colspan="9" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">
                            GST Information (according to above line items)
                        </td>
                    </tr>
                    <tr>
                        <td width="5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Sl No.</td>
                        <td width="15%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Price before GST</td>
                        <td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">HSN/SAC</td>
                        <td width="7.5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">SGST Rate</td>
                        <td width="15%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">SGST Amount</td>
                        <td width="7.5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">CGST Rate</td>
                        <td width="15%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">CGST Amount</td>
                        <td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Total GST</td>
                        <td width="15%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Price after GST</td>
                    </tr>
					<?php
					if(!empty($gst_details)){
						foreach($gst_details as $gstD){
					?>
                    <tr>
                        <td width="5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo ++$no;?></td>
                        <td width="15%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo $gstD['room_charge'];?></td>
                        <td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo $gstD['hsn_sac_code'];?></td>
                        <td width="7.5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo $gstD['room_sgst_percent'];?></td>
                        <td width="15%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo $gstD['room_sgst'];?></td>
                        <td width="7.5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo $gstD['room_cgst_percent'];?></td>
                        <td width="15%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo $gstD['room_cgst'];?></td>
                        <td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo $gstD['room_igst'];?></td>
                        <td width="15%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo $gstD['room_net_amount'];?></td>
                    </tr>
                    <?php
							$totalGst +=$gstD['room_igst'];
							$totalPriceAfterGst +=$gstD['room_net_amount'];
						}
					}
					?>
                    <tr>
                        <td colspan="4" style="text-align: left; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><b>Total</b></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo number_format((float)$totalGst, 2, '.', '');?></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo number_format((float)$totalPriceAfterGst, 2, '.', '');?></td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                    <tr>
                        <td width="20%" style="text-align: left; padding: 3px;"><b>Total Invoice Value : </b></td>
                        <td width="80%" style="text-align: left; padding: 3px;">Indian Rupees <?php echo getIndianCurrencyNumberToWord($totalPriceAfterGst);?> </td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                    <tr>
                        <td width="70%" style="text-align: left; padding: 3px;">
                            <ul>
                                <li style="list-style:none;padding-bottom:5px;"><span style="text-align: left;"><b>Note:</b></span></li>
                                <li>All amount shown hereinabove are in Indian Rupees.</li>
                                <li>This is a computer-generated Invoice hence no signature is mandatory.</li>
                                <li>Please settle the Invoice in full prior to leave the property.</li>
                            </ul>
                        </td>
                        <td width="30%" style="text-align: center; padding: 3px;">
                            <span>E & O.E</span><br><span>For SFDC Ltd</span><br><br><br><br>
                            <span>(Authorised Signatory)</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>