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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>-->

    <style type="text/css">
        @page {
            size: A4;
            margin: .25cm;
        }
    </style>
</head>

<body role="document">
    <?php if($booking_details[0]['status'] == '6'){ ?>
        <div class="waterMark" style="position: absolute; top: 605px; left: 580px; z-index: 99; opacity: 0.2;"><img src="https://wbsfdc.devserv.in/public/frontend_assets/images/cancle.png"></div>
    <?php } ?>
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
                        <td width="24%" colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if($booking_details[0]['booking_from'] == 'C'){ echo 'Website'; } else { echo 'Admin'; } ?></td>
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
                        <td colspan="3" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['business_full_name'])){ echo $booking_details[0]['business_full_name']; } else { echo $booking_details[0]['indivisual_full_name']; } ?></td>
                        <td style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>GSTIN</b></td>
                        <td style="border-bottom: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['business_full_name'])){ if(!empty($booking_details[0]['business_gst_no'])){ echo $booking_details[0]['business_gst_no']; } } else { echo 'NA'; } ?></td>
                    </tr>
                    <tr>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Address</b></td>
                        <td colspan="5" style="border-bottom: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($booking_details[0]['business_full_address'])){ echo $booking_details[0]['business_full_address']; } else { echo $booking_details[0]['indivisual_full_address']; } ?></td>
                    </tr>
                    <tr>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>e-mail ID </b></td>
                        <td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['business_email'])){ echo $booking_details[0]['business_email']; } else { echo $booking_details[0]['indivisual_email']; } ?></td>
                        <td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No.</b></td>
                        <td width="14%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['business_contact_no'])){ echo $booking_details[0]['business_contact_no']; } else { echo $booking_details[0]['indivisual_contact_no']; } ?></td>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact Person</b></td>
                        <td width="24%" style="border-bottom: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['contact_person_name'])){ echo $booking_details[0]['contact_person_name']; } ?></td>
                    </tr>
                    <tr>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>Designation of the Contact Person</b></td>
                        <td width="21%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['contact_person_designation'])){ echo $booking_details[0]['contact_person_designation']; } ?></td>
                        <td width="15%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>Contact No.</b></td>
                        <td width="14%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['contact_person_contact_no'])){ echo $booking_details[0]['contact_person_contact_no']; } ?></td>
                        <td width="14%" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;"><b>e-mail ID</b></td>
                        <td width="24%" colspan="3" style="border-bottom: #9e9e9e 1px solid;padding: 3px;text-align: left;"><?php if(!empty($booking_details[0]['contact_person_email'])){ echo $booking_details[0]['contact_person_email']; } ?></td>
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
                            <td colspan="<?php if($booking_details[0]['total_extra_hours'] > 0){ echo '12'; } else { echo '11'; } ?>" style="background-color:#d9d9d9;padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;">
                                <b>Booking Details</b>
                            </td>
                        </tr>
                        <tr style="font-size: 11px;">
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Date</b></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Base Amount</b></td>

                            <?php if($booking_details[0]['total_extra_hours'] > 0){ ?>
                                <td width="7%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Additional Hours Charge</b></td>
                            <?php } ?>

                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Discount</b><br><small>(if any)</small></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Amount</b><br><small>(before GST)</small></td>
                            <td width="7%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>HSN / SAC</b></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>CGST Rate(%)</b></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>CGST</b><br><small>(Amount)</small></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>SGST Rate(%)</b></td>
                            <td width="7%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>SGST</b><br><small>(Amount)</small></td>
                            <td width="7%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>GST </b><br><small>(Amount)</small></td>
                            <td width="9%" style="background-color:#d9d9d9;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Amount Payable</b><br><small>(after GST)</small></td>
                        </tr>
						<?php foreach($booking_details[0]['booking_details'] as $bdetails){ ?>

							<tr style="font-size: 11px;" class="bookingDetailsTR">
								<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?= date('d/m/Y',strtotime($bdetails['start_date'])); ?></td>
								<td class="basepriceTD" width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><?= $bdetails['rate']; ?></td>

                                <?php if($booking_details[0]['total_extra_hours'] > 0){ ?>

                                    <td class="" width="7%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($bdetails['extra_hours'])){ echo '1000 X '.$bdetails['extra_hours'].' = '.$bdetails['extra_rate']; } else { echo '--'; } ?></td>

                                <?php } ?>

								<td class="discountpriceTD" width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><?php if(!empty($bdetails['discount_amount'])){ echo $bdetails['discount_amount']; } else { echo '0.00'; } ?></td>
								<td class="amountTD" width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><?= number_format((float)(($bdetails['rate'] + $bdetails['extra_rate']) - $bdetails['discount_amount']), 2, '.', ''); ?></td>
								<td width="7%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><?= $bdetails['hsn_sac_code']; ?></td>
								<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><?= $bdetails['v_cgst']; ?></td>
								<td class="cgstamountTD" width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><?= number_format((float)(($bdetails['v_cgst'] * (($bdetails['rate'] + $bdetails['extra_rate']) - $bdetails['discount_amount'])) / 100), 2, '.', ''); ?></td>
								<td width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><?= $bdetails['v_sgst']; ?></td>
								<td class="sgstamountTD" width="7%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><?= number_format((float)(($bdetails['v_sgst'] * (($bdetails['rate'] + $bdetails['extra_rate']) - $bdetails['discount_amount'])) / 100), 2, '.', ''); ?></td>
								<td class="gstamountTD" width="7%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><?= number_format((float)((($bdetails['v_cgst'] * (($bdetails['rate'] + $bdetails['extra_rate']) - $bdetails['discount_amount'])) / 100) + (($bdetails['v_sgst'] * (($bdetails['rate'] + $bdetails['extra_rate']) - $bdetails['discount_amount'])) / 100)), 2, '.', ''); ?></td>
								<td class="payableamountTD" width="9%" style="border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><?= number_format((float)((($bdetails['rate'] + $bdetails['extra_rate']) - $bdetails['discount_amount']) + ((($bdetails['v_cgst'] * (($bdetails['rate'] + $bdetails['extra_rate']) - $bdetails['discount_amount'])) / 100) + (($bdetails['v_sgst'] * (($bdetails['rate'] + $bdetails['extra_rate']) - $bdetails['discount_amount']))) / 100)), 2, '.', ''); ?></td>
							</tr>

						<?php } ?>

                        <tr style="font-size: 11px;">
                            <td width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>Total</b></td>
                            <td class="totalbasepriceTD" width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><b>&nbsp;</b></td>

                            <?php if($booking_details[0]['total_extra_hours'] > 0){ ?>

                                <td class="" width="7%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><b>&nbsp;</b></td>

                            <?php } ?>    

                            <td class="totaldiscountpriceTD" width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><b>&nbsp;</b></td>
                            <td class="totalamountTD" width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><b>&nbsp;</b></td>
                            <td width="7%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: center;"><b>&nbsp;</b></td>
                            <td width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><b>&nbsp;</b></td>
                            <td class="totalcgstamountTD" width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><b>&nbsp;</b></td>
                            <td width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><b>&nbsp;</b></td>
                            <td class="totalsgstamountTD" width="7%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><b>&nbsp;</b></td>
                            <td class="totalgstamountTD" width="7%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><b>&nbsp;</b></td>
                            <td class="totalpayableamountTD" width="9%" style="background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;text-align: right;"><b>&nbsp;</b></td>
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
                            <td width="12%" style="border-bottom: #9e9e9e 1px solid;background-color:#d9d9d9;padding: 3px;border-right: #9e9e9e 1px solid;text-align: right;"><b>Amount Paid</b></td>
                        </tr>
                        <tr>
                            <td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b><?= $booking_details[0]['payment_method']; ?></b></td>
                            <td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><b><?php if($booking_details[0]['payment_method'] == 'Online'){ echo 'CCavenue'; } ?></b></td>
                            <td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><?= $booking_details[0]['txnid']; ?></td>
                            <td style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: center;"><?= date('d/m/Y H:i:s',strtotime($booking_details[0]['transaction_date'])); ?></td>
                            <td class="totaladvanceamountTD" style="padding: 3px;border-right: #9e9e9e 1px solid;text-align: right;"><?php if($booking_details[0]['advance_amount'] != '0.00'){ echo $booking_details[0]['advance_amount']; } else { echo $booking_details[0]['net_amount']; } ?></td>
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
                    <li><b>(c)</b> However, this Booking will be confirmed and you will be allowed to enter the venue when the NOC will be obtained by you from the competent authority of SFDC Ltd subject to full and final payment of the Booking amount including the applicable GST.</li>
                    <li><b>(d)</b> To obtain NOC you may need to procure one or more permission/licence/document as applicable for your event from the competent authorities and submit to the Person-in-Charge of the Venue at least 7 days before the scheduled date of your event.</li>
                    <li><b>(e)</b> The Permissions/Licences/Documents are to be procured from the following authorities :</li>
                    <li style="padding-left:24px;"><b>1)</b> Department of Excise</li>
					<li style="padding-left:24px;"><b>2)</b> Office of the Director General, West Bengal Fire & Emergency Services</li>
					<li style="padding-left:24px;"><b>3)</b> Police Authority</li>
					<li style="padding-left:24px;"><b>4)</b> Concerned Municipal /Panchayat Authority</li>
                    <li style="padding-left:24px;"><b>5)</b> Novex Communications</li>
                    <li style="padding-left:24px;"><b>6)</b> Phonographic Performance Limited</li>
                    <li style="padding-left:24px;"><b>7)</b> The Indian Performing Right Society Limited</li>
                    <li><b>(f)</b> Please Login to <a href="#.">www.sfdcltd.com</a> and submit the 'Mandatory Information' form as available in respect to this Booking with the required information and complete the other required compliance formalities at
                        least before 7 days of the date / first date of Booking as applicable to obtain the NOC from SFDC Ltd and get the Booking Confirmed.</li>
                    <li><b>(g)</b> Amount shown in each of the fields of this document are in Indian Rupees. </li>
                    <li><b>(h)</b> In case of Cancellation of this booking and/or no show up on the date booking as mentioned hereinabove, Cancellation Charges will be imposed according to the Cancellation Policy as applicable on the date of Cancellation
                        and/or date/ first date of booking as applicable.</li>
                    <li><b>(i)</b> Please visit www.wbsfdcltd.com for Terms & Conditions, Cancellation Policy, Refund Policy, Privacy Policy and other information as this document may not contain all the important and required details that is applicable under
                        any of the circumstances before, during and even after the stay.</li>
                    <li><b>(j)</b> The amount paid as GST as shown hereinabove will not be refunded under any circumstances even if the guest and/or the user of the website cancels the booking.</li>
                    <li><b>(k)</b> For any queries & clarification please contact with the Contact No.(s) & email ID given along with the Property Information as mentioned hereinabove.</li>
                    <li><b>(l)</b> This is a system generated document hence no signature and/or seal is required.</li>
                </ul>

                <ul style="list-style: none;text-align: left;line-height:15px;">
					<li><h6 style="margin-top: 8px; margin-bottom: 10px; font-weight:bold;">Cancellation Policy :</h6></li>
					<li><b>(1)</b> Cancellation will be calculated from the date of event. </li>
					<li><b>(2)</b> Deposited GST and other Taxes if any against venue rent will not be refunded to the party.</li>
					<li><b>(3)</b> Reservation may be cancelled in case of acute administrative requirement. No cancellation charge will be deducted under such scenario.</li>
					<li><b>(4)</b> The amount of refund will be reversed to the debit/credit card/bank account after deducting the cancellation charges as per policy.</li>
					
					<li><b>(5)</b> Modified cancellation rule for the Banquet Hall & Cottage Ground, White House Hall& Lawn, Red Fort Hall & Lawn on genuine grounds, may be as follows: -</li>
					<li style="padding-left:24px;"><b>(i)</b> Cancellation charge before 365 days to 270 days from the date of the event is 10% of the deposited amount.</li>
					<li style="padding-left:24px;"><b>(ii)</b> Cancellation charge before 270 days to 180 days from the date of the event is 20% of the deposited amount.</li>
					<li style="padding-left:24px;"><b>(iii)</b> Cancellation charge before 180 days to 120 days from the date of the event is 30% of the deposited amount.</li>
					<li style="padding-left:24px;"><b>(iv)</b> Cancellation charge before 120 days to 60 days from the date of the event is 50% of the deposited amount.</li>					
					
					<li><b>(6)</b> GST on cancellation charge will not be deducted from the deposited room rent of the concerned party. Hence, after cancellation the concerned party will get the refund amount after deduction of the cancellation charge.</li>
					<li><b>(7)</b> No Partial cancellation will be allowed; only full booking cancellation will be considered.</li>
					<li><b>(8)</b> No spot cancellation by any party will be allowed under any circumstances and no demand for refund of the booking amount will be entertained if the party do not occupy and organize the event in the booked venue as booked schedule.</li>
				</ul>
            </td>
        </tr>
    </table>
	<table cellpadding="0" cellspacing="0" border="0" style="width: 1240px; margin: 10px auto; font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 11px; padding: 0;text-align: center;">
		<tr class="btnTR">
            <td>
				<!--<button class="printAcc" onclick='printDiv();'>Print</button>-->
				<button style="background: #00bdd6; padding: 6px 10px; color: #FFF; border-radius: 6px;" id="printAcc">Print</button>
				<button style="background: #198754; padding: 6px 10px; color: #FFF; border-radius: 6px;" id="downloadAcc">Download</button>
            </td>
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

		// Function to trigger printing
		function printTable() {
			var printWindow = window.open('', '', 'width=600,height=600');
			var content = $("#printArea").clone();

			// Set A4 page size in CSS (210mm x 297mm)
			content.css('width', '220mm');
			content.css('height', '297mm');

			printWindow.document.open();
			printWindow.document.write('<html><head><title>Acknowledgement Slip</title></head><body>');
			printWindow.document.write(content.prop('outerHTML'));
			printWindow.document.write('</body></html>');
			printWindow.document.close();

			// Trigger the print dialog
			printWindow.print();
			printWindow.close();
		}

		// Call the printTable function on a specific event, e.g., a button click
		$(document).on('click', '#printAcc', function() {
			printTable();
		});


		$(document).on('click', '#downloadAcc', function() {
			// Get the table element
			var table = document.getElementById('printArea');

			html2canvas(table).then((canvas) => {
				window.jsPDF = window.jspdf.jsPDF
				var imgWidth = 287;
				var pageHeight = 295;
				var imgHeight = (canvas.height * imgWidth) / canvas.width;
				var heightLeft = imgHeight;
				var position = 5;
				heightLeft -= pageHeight;
				var doc = new jsPDF('l', 'mm');
				doc.addImage(canvas, 'PNG', 5, position, imgWidth, imgHeight);
				while (heightLeft >= 0) {
					position = heightLeft - imgHeight;
					doc.addPage();
					doc.addImage(canvas, 'PNG', 5, position, imgWidth, imgHeight);
					heightLeft -= pageHeight;
				}
				doc.save('acknowledgement_slip.pdf');
			});

			// Use html2canvas to capture the table as an image
			/*html2canvas(table).then(function(canvas) {
				window.jsPDF = window.jspdf.jsPDF
				var imgData = canvas.toDataURL('image/png');				
				
				var pdf = new jsPDF({
									orientation: 'l', // landscape
									unit: 'px',
                        			format: 'a4'
							});

				pdf.addImage(imgData, 'PNG', 15, 60, 605, 380);

				// Save the PDF with a specific name
				pdf.save('acknowledgement_slip.pdf');
				
			});*/
			
		});		

	});
</script>
</body>

</html>
