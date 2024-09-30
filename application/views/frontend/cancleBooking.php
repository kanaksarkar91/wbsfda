<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Booking Acknowledgement Slip</title>

	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>-->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.1/css/bootstrap.min.css" integrity="sha512-siwe/oXMhSjGCwLn+scraPOWrJxHlUgMBMZXdPe2Tnk3I0x3ESCoLz7WZ5NTH6SZrywMY+PB1cjyqJ5jAluCOg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style type="text/css">
        @page {
            size: A4;
            margin: .25cm;
        }
    </style>
</head>

<body role="document">
    <table id="printArea" cellpadding="0" cellspacing="0" border="0" style="width: 1240px; margin: 0 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 11px; padding: 0;text-align: center; border:1px solid #000;">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom: 10px;">
                    <tr>
                        <td width="20%" style="text-align: left;padding:10px;">
                            <img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/Biswa_Bangla_logo.jpg" width="64" alt="..." />
                        </td>
                        <td width="60%" style="text-align: center;">
                            <h3 style="margin-top:10px; font-size:14px;margin-bottom: 0px;line-height:1;font-weight:600;">The State Fisheries Development Corporation Limited</h3>
                            <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">(A Government of West Bengal Undertaking)<br>An ISO: 9001:2015 Company</p>
                            <!-- <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">Bikash Bhawan, North Block, 1st Floor, Salt Lake, Kolkata - 700 091, West Bengal</p> -->
                            <h2 style="text-align:center;font-size:12px;font-weight: 600;">Booking Acknowledgement Slip</h2>
                        </td>
                        <td width="20%" style="text-align: right;padding-right:10px;">
                            <img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/SFDC_logo.jpg" width="64" alt="..." style="margin-top:10px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-bottom:10px; text-align:left;">
                    <tr>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Booking ID</b></td>
                        <td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= $booking_details[0]['booking_id']; ?></td>
                        <td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Transaction Date</b></td>
                        <td width="14%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= date('d/m/Y',strtotime($booking_details[0]['transaction_date'])); ?></td>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Booking Source</b></td>
                        <td width="24%" colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if($booking_details[0]['booking_from'] == 'C'){ ?> <?= 'Website';?> <?php } else { ?> <?= 'Admin';?> <?php } ?></td>
                    </tr>
                    <tr>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Booked by</b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= $booking_details[0]['booking_by_name']; ?></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No.</b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= $booking_details[0]['booking_by_mobile']; ?></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>e-mail ID</b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= $booking_details[0]['booking_by_email']; ?></td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-bottom:10px; text-align:left;">
                    <tr>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Booked in favour of</b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['business_full_name'])){ ?> <?= $booking_details[0]['business_full_name'];?> <?php } else { ?> <?= $booking_details[0]['indivisual_full_name'];?> <?php } ?></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>GSTIN</b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['business_full_name'])){ if(!empty($booking_details[0]['business_gst_no'])){ ?> <?= $booking_details[0]['business_gst_no'];?> <?php } } else { ?> <?= 'NA';?> <?php } ?></td>
                    </tr>
                    <tr>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Address</b></td>
                        <td colspan="5" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($booking_details[0]['business_full_address'])){ ?> <?= $booking_details[0]['business_full_address'];?> <?php } else { ?> <?= $booking_details[0]['indivisual_full_address'];?> <?php } ?></td>
                    </tr>
                    <tr>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>e-mail ID </b></td>
                        <td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['business_email'])){ ?> <?= $booking_details[0]['business_email'];?> <?php } else { ?> <?= $booking_details[0]['indivisual_email'];?> <?php } ?></td>
                        <td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No.</b></td>
                        <td width="14%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['business_contact_no'])){ ?> <?= $booking_details[0]['business_contact_no'];?> <?php } else { ?> <?= $booking_details[0]['indivisual_contact_no'];?> <?php } ?></td>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact Person</b></td>
                        <td width="24%" style="border-bottom: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['contact_person_name'])){ ?> <?= $booking_details[0]['contact_person_name'];?> <?php } ?></td>
                    </tr>
                    <tr>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Designation of the Contact Person</b></td>
                        <td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['contact_person_designation'])){ ?> <?= $booking_details[0]['contact_person_designation'];?> <?php } ?></td>
                        <td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No.</b></td>
                        <td width="14%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['contact_person_contact_no'])){ ?> <?= $booking_details[0]['contact_person_contact_no'];?> <?php } ?></td>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>e-mail ID</b></td>
                        <td width="24%" colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['contact_person_email'])){ ?> <?= $booking_details[0]['contact_person_email'];?> <?php } ?></td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-bottom:10px; text-align:left;">
                    <tr>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Venue</b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= $booking_details[0]['venue_names']; ?></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>GSTIN</b></td>
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;text-align: left;"></td>
                    </tr>
                    <tr>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Address</b></td>
                        <td colspan="7" style="border-bottom: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= $booking_details[0]['property_address_line_1']; ?></td>
                    </tr>
                    <tr>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>City / Village</b></td>
                        <td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= $booking_details[0]['property_city']; ?></td>
                        <td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>District</b></td>
                        <td width="14%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= $booking_details[0]['property_district']; ?></td>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>State</b></td>
                        <td width="24%" colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= $booking_details[0]['property_state']; ?></td>
                    </tr>
                    <tr>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Pin Code</b></td>
                        <td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= $booking_details[0]['property_pincode']; ?></td>
                        <td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No.</b></td>
                        <td width="14%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= $booking_details[0]['property_phone_no']; ?></td>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>e-mail ID</b></td>
                        <td width="24%" colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?= $booking_details[0]['property_email']; ?></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; font-size: 12px;">
                    <tbody>
                        <tr>
                            <td colspan="11" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;">
                                <b>Booking Details</b>
                            </td>
                        </tr>
                        <tr style="font-size: 11px;">
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Date</b></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Base Amount</b></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Discount</b><br><small>(if any)</small></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Amount</b><br><small>(before GST)</small></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>HSN / SAC</b></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>CGST Rate(%)</b></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>CGST</b><br><small>(Amount)</small></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>SGST Rate(%)</b></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>SGST</b><br><small>(Amount)</small></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>GST </b><br><small>(Amount)</small></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Amount Payable</b><br><small>(after GST)</small></td>
                        </tr>
						<?php foreach($booking_details[0]['booking_details'] as $bdetails){ ?>

							<tr style="font-size: 11px;" class="bookingDetailsTR">
								<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?= date('d/m/Y',strtotime($bdetails['start_date'])); ?></td>
								<td class="basepriceTD" width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?= $bdetails['rate']; ?></td>
								<td class="discountpriceTD" width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?php if(!empty($bdetails['discount_amount'])){ ?> <?= $bdetails['discount_amount'];?> <?php } else { ?> <?= '0.00';?> <?php } ?></td>
								<td class="amountTD" width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?= number_format((float)($bdetails['rate'] - $bdetails['discount_amount']), 2, '.', ''); ?></td>
								<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?= $bdetails['hsn_sac_code']; ?></td>
								<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?= $bdetails['v_cgst']; ?></td>
								<td class="cgstamountTD" width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?= number_format((float)(($bdetails['v_cgst'] * ($bdetails['rate'] - $bdetails['discount_amount'])) / 100), 2, '.', ''); ?></td>
								<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?= $bdetails['v_sgst']; ?></td>
								<td class="sgstamountTD" width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?= number_format((float)(($bdetails['v_sgst'] * ($bdetails['rate'] - $bdetails['discount_amount'])) / 100), 2, '.', ''); ?></td>
								<td class="gstamountTD" width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?= number_format((float)((($bdetails['v_cgst'] * ($bdetails['rate'] - $bdetails['discount_amount'])) / 100) + (($bdetails['v_sgst'] * ($bdetails['rate'] - $bdetails['discount_amount'])) / 100)), 2, '.', ''); ?></td>
								<td class="payableamountTD" width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?= number_format((float)(($bdetails['rate'] - $bdetails['discount_amount']) + ((($bdetails['v_cgst'] * ($bdetails['rate'] - $bdetails['discount_amount'])) / 100) + (($bdetails['v_sgst'] * ($bdetails['rate'] - $bdetails['discount_amount']))) / 100)), 2, '.', ''); ?></td>
							</tr>

						<?php } ?>

                        <tr style="font-size: 11px;">
                            <td width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Total</b></td>
                            <td class="totalbasepriceTD" width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>&nbsp;</b></td>
                            <td class="totaldiscountpriceTD" width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>&nbsp;</b></td>
                            <td class="totalamountTD" width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>&nbsp;</b></td>
                            <td width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>&nbsp;</b></td>
                            <td width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>&nbsp;</b></td>
                            <td class="totalcgstamountTD" width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>&nbsp;</b></td>
                            <td width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>&nbsp;</b></td>
                            <td class="totalsgstamountTD" width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>&nbsp;</b></td>
                            <td class="totalgstamountTD" width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>&nbsp;</b></td>
                            <td class="totalpayableamountTD" width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>&nbsp;</b></td>
                        </tr>

                    </tbody>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-top: 10px;">
                    <tbody>
                        <tr>
                            <td width="15%" rowspan="2" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Details of Advance Payment</b> </td>
                            <td width="19%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Mode</b></td>
                            <td width="18%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Processed / Taken by</b></td>
                            <td width="18%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Transaction ID</b></td>
                            <td width="18%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Date &amp; Time</b></td>
                            <td width="12%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Amount Paid</b></td>
                        </tr>
                        <tr>
                            <td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b><?= $booking_details[0]['payment_method']; ?></b></td>
                            <td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b><?php if($booking_details[0]['payment_method'] == 'Online'){ ?> <?= 'CCavenue';?> <?php } ?></b></td>
                            <td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><?= $booking_details[0]['txnid']; ?></td>
                            <td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><?= date('d/m/Y H:i:s',strtotime($booking_details[0]['transaction_date'])); ?></td>
                            <td class="totaladvanceamountTD" style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><?= $booking_details[0]['advance_amount']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; margin-top: 10px;">
                    <tbody>
                        <tr>
                            <td width="88%" style="background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b>Outstanding Amount</b> </td>
                            <td width="12%" style="border-bottom: #9e9e9e 1px solid;padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b class="outStandingAmt"></b></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <ul style="list-style: none;text-align: left;line-height:15px;">
                    <li style="margin-top: 8px; margin-bottom: 10px; font-weight:bold;">Note :</li>
                    <li><b>(a)</b> This is only a statement showing details of Booking including Booking Amount, Advance Payment and Outstanding Amount (if any) to be paid.</li>
                    <li><b>(b)</b> This is not a confirmation of Booking and not also a GST Invoice. GST Invoice will be provided upon payment of the outstanding amount as shown hereinabove.</li>
                    <li><b>(c)</b> The Booking will be considered as Confirmed only upon payment of the Outstanding Amount (if any) as shown hereinabove and obtaining the NOC from SFDC Ltd subsequent to accomplishment of the other formalities as required.</li>
                    <li><b>(d)</b> Please Login to <a href="#.">www.sfdcltd.com</a> and submit the 'Mandatory Information' form as available in respect to this Booking with the required information and complete the other required compliance formalities at
                        least before 7 days of the date / first date of Booking as applicable to obtain the NOC from SFDC Ltd and get the Booking Confirmed.</li>
                    <li><b>(e)</b> Amount shown in each of the fields of this document are in Indian Rupees. </li>
                    <li><b>(f)</b> In case of Cancellation of this booking and/or no show up on the date booking as mentioned hereinabove, Cancellation Charges will be imposed according to the Cancellation Policy as applicable on the date of Cancellation
                        and/or date/ first date of booking as applicable.</li>
                    <li><b>(g)</b> Please visit www.wbsfdcltd.com for Terms & Conditions, Cancellation Policy, Refund Policy, Privacy Policy and other information as this document may not contain all the important and required details that is applicable under
                        any of the circumstances before, during and even after the stay.</li>
                    <li><b>(h)</b> The amount paid as GST as shown hereinabove will not be refunded under any circumstances even if the guest and/or the user of the website cancels the booking.</li>
                    <li><b>(i)</b> For any queries & clarification please contact with the Contact No.(s) & email ID given along with the Property Information as mentioned hereinabove.</li>
                    <li><b>(j)</b> This is a system generated document hence no signature and/or seal is required.</li>
                </ul>
            </td>
        </tr>
    </table>
	<table cellpadding="0" cellspacing="0" border="0" style="width: 1240px; margin: 10px auto; font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 11px; padding: 0;text-align: center; border:#000 1px solid;">
		<tr>
			<input type="hidden" id="booking_id" name="booking_id" value="<?= $booking_details[0]['booking_id']; ?>">
			<?php if(($booking_details[0]['status'] == '1' || $booking_details[0]['status'] == '2' || $booking_details[0]['status'] == '3' || $booking_details[0]['status'] == '4') && strtotime($booking_details[0]['booking_details'][0]['start_date']) >= time()){ ?>
				<td style="padding: 10px;">
				<h4>Cancellation Information</h4><br>
				<?php 
					$cancel_percent = $cancellation_details['cancellation_per'];

					if($booking_details[0]['status'] == '1'){

						$advanceAmountwithGST = $booking_details[0]['advance_amount'];
						

					} else {

						$cancel_charge = intval((($booking_details[0]['total_rate'] * $cancellation_details['cancellation_per']) / 100)*100)/100;
						$refund_amt = intval(($booking_details[0]['total_rate'] - $cancel_charge)*100)/100;

					}
					
				?>
				<h6>Cancellation Charge (Rs.) : <?= number_format((float)$cancel_charge, 2, '.', ''); ?></h6>
				<h6>Refund Amount (Rs.) : <?= number_format((float)$refund_amt, 2, '.', ''); ?></h6>
				<textarea type="text" class="form-control" id="cancel_remarks" name="cancel_remarks" placeholder="Cancel Remarks" rows="4" cols="50"></textarea>
				<input type="hidden" id="paid_amount" name="paid_amount" value="<?=$booking_details[0]['total_rate']?>">
				<input type="hidden" id="cancel_percent" name="cancel_percent" value="<?=$cancel_percent?>">
				<input type="hidden" id="cancel_charge" name="cancel_charge" value="<?=number_format((float)$cancel_charge, 2, '.', '');?>">
				<input type="hidden" id="refund_amt" name="refund_amt" value="<?=number_format((float)$refund_amt, 2, '.', '');?>">
				
				
				<input type="button" id="cancel_booking_btn" style="float:right;margin-bottom:10px;margin-top:10px;" value="Cancel Booking" class="btn btn-danger">  
				</td>
			<?php } ?>
			<!--<?php if($booking_header['booking_status'] == 'C' && isset($booking_header['cancellation_remarks'])){ ?>
				<td style="padding: 10px;">
					<h4>Cancellation Information</h4><br>
					<h6>Cancellation Percentage : <?= $cancellation_request_details['cancel_percent'] ?></h6>
					<h6>Cancellation Charge (Rs.) : <?= $cancellation_request_details['cancel_charge'] ?></h6>
					<h6>Refund Amount (Rs.) : <?= $cancellation_request_details['refund_amt'] ?></h6>
					<h6>Refund Status : <?= ($cancellation_request_details['is_refunded'] == '1') ? 'Refunded' :'Refund Initiated'?></h6>
					
					<textarea type="text" class="form-control" placeholder="Cancel Remarks" rows="4" cols="50" disabled><?=$booking_header['cancellation_remarks']?></textarea>
				</td>
			<?php } ?>-->
        </tr>
	</table>




<script>
	$( document ).ready(function() {

		//Total Sum Calculation
		var basepriceSum = 0;
		var discountpriceSum = 0;
		var amountSum = 0;
		var cgstamountSum = 0;
		var sgstamountSum = 0;
		var gstamountSum = 0;
		var payableamountSum = 0;
		
		$('td.basepriceTD').each(function() {
			var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				basepriceSum += value; // Add it to the sum
			}
		});	


		$('td.discountpriceTD').each(function() {
			var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				discountpriceSum += value; // Add it to the sum
			}
		});

		$('td.amountTD').each(function() {
			var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				amountSum += value; // Add it to the sum
			}
		});

		$('td.cgstamountTD').each(function() {
			var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				cgstamountSum += value; // Add it to the sum
			}
		});

		$('td.sgstamountTD').each(function() {
			var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				sgstamountSum += value; // Add it to the sum
			}
		});

		$('td.gstamountTD').each(function() {
			var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				gstamountSum += value; // Add it to the sum
			}
		});

		$('td.payableamountTD').each(function() {
			var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				payableamountSum += value; // Add it to the sum
			}
		});


		$('.totalbasepriceTD').text(basepriceSum.toFixed(2));
		$('.totaldiscountpriceTD').text(discountpriceSum.toFixed(2));
		$('.totalamountTD').text(amountSum.toFixed(2));
		$('.totalcgstamountTD').text(cgstamountSum.toFixed(2));
		$('.totalsgstamountTD').text(sgstamountSum.toFixed(2));
		$('.totalgstamountTD').text(gstamountSum.toFixed(2));
		$('.totalpayableamountTD').text(payableamountSum.toFixed(2));


		//Outsatnding Amount
		var getPayable = $('.totalpayableamountTD').text();
		var getAdvance = $('.totaladvanceamountTD').text();

		var totalOutstanding = parseInt(getPayable) - parseInt(getAdvance);

		$('.outStandingAmt').text(totalOutstanding.toFixed(2));	

		//Cancel Venue Booking
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
				});

				return false;

			} else {

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
									url: '<?= base_url("frontend/profile/cancel_booking_venue"); ?>',
									method: 'post',
									data: {
										csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>',
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
											});

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
				});

			}

		});

	});
</script>
</body>

</html>
