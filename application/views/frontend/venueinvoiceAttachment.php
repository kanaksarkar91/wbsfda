<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VENUE TAX INVOICE</title>

	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>-->

    <script src="<?= base_url(); ?>public/admin_assets/js/jquery.min.js"></script>
	<script src="<?= base_url(); ?>public/admin_assets/js/jspdf.umd.min.js"></script>
	<script src="<?= base_url(); ?>public/admin_assets/js/html2canvas.min.js"></script>

    <style type="text/css">
        @page {
            size: A4;
            margin: .25cm;
        }
    </style>
</head>

<body role="document">
    <table id="printArea" cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin: 0 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 11px; padding: 0;text-align: center; border:1px solid #000;">
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
                            <h2 style="text-align:center;font-size:12px;font-weight: 600;">Tax Invoice</h2>
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
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left;">
                    <tr>
                        <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Tax Invoice No.</td>
                        <td width="18%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_slip['order_id']; ?></td>
                        <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">GSTIN</td>
                        <td width="17%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_slip['property_gst_no']; ?></td>
                        <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">Booking ID</td>
                        <td width="26%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;"><?= $booking_slip['booking_id']; ?></td>
                    </tr>
                    <tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Date</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= date('d/m/Y',strtotime($booking_slip['venue_booking_created_at'])); ?></td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">State & Code</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_slip['state_name'].' ( '.$booking_slip['property_state_code'].' )'; ?></td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">Transaction Date</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;"><?= date('d/m/Y',strtotime($booking_slip['venue_booking_created_at'])); ?></td>
                    </tr>
                    <tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">RCM Applicable</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">No. </td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">Income Tax PAN</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">NA</td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">Source</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;"><?php if($booking_slip['booking_from'] == 'C'){ echo 'Website'; } else { echo 'Admin'; } ?></td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left;">
                    <tr>
                        <td colspan="6" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">
                            Place of Service Delivery (Property Information)
                        </td>
                    </tr>
                    <tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">
                            Venue
                        </td>
                        <td colspan="5" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_slip['venue_names']; ?></td>
                    </tr>
                    <tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">
                            Address
                        </td>
                        <td colspan="5" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_slip['property_name']; ?>, <?= $booking_slip['property_address_line_1']; ?>, <?= $booking_slip['property_pincode']; ?></td>
                    </tr>
                    <tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">City / Village</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_slip['property_city']; ?></td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">District</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $booking_slip['district_name']; ?></td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">PIN Code</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;"><?= $booking_slip['property_pincode']; ?></td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left;">
                    <tr>
                        <td colspan="6" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">
                            Details of Receiver (Bill to)
                        </td>
                    </tr>
                    <tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Name</td>
                        <td colspan="3" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($booking_slip['business_full_name'])){ echo $booking_slip['business_full_name']; } else { echo $booking_slip['indivisual_full_name']; } ?></td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">GSTIN</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($booking_slip['business_full_name'])){ if(!empty($booking_slip['business_gst_no'])){ echo $booking_slip['business_gst_no']; } } else { echo 'NA'; } ?></td>
                    </tr>
                    <tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">
                            Address
                        </td>
                        <td colspan="5" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($booking_slip['business_full_address'])){ echo $booking_slip['business_full_address']; } else { echo $booking_slip['indivisual_full_address']; } ?></td>
                    </tr>
                    <!--<tr>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">City / Village</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">PIN Code</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td width="13.33%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">State & Code</td>
                        <td width="20%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;"></td>
                    </tr>-->
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid;">
                    <tr>
                        <td colspan="9" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">
                            Booking Details
                        </td>
                    </tr>
                    <tr>
                        <td width="5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Sl No.</td>
                        <td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Date</td>
                        <td width="30%" style="text-align: left; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Particulars</td>
                        <td width="12%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Base Rate per Day</td>
                        <td width="6%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">No. of Day</td>
                        <td width="12%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Price before Discount</td>
                        <td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Discount (if any)</td>
                        <td width="15%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Price before GST</td>
                    </tr>
					<?php $i = 1; ?>
					<?php foreach($booking_slip_details as $bdetails){ ?>
						<tr>
							<td width="5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $i; ?></td>
							<td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= date('d/m/Y',strtotime($bdetails['start_date'])); ?></td>
							<td width="30%" style="text-align: left; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($bdetails['extra_hours'])){ echo $bdetails['venue_names'].' (Additional Hours: '.$bdetails['extra_hours'].' X 1000 = '.$bdetails['extra_rate'].')';  } else { echo $bdetails['venue_names']; } ?></td>
							<td class="baseRate" width="12%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $bdetails['rate']; ?></td>
							<td class="noDays" width="6%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">01</td>
							<td class="ratebeforeDiscount" width="12%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $bdetails['rate'] + $bdetails['extra_rate']; ?></td>
							<td class="discountAmount" width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($bdetails['discount_amount'])){ echo $bdetails['discount_amount']; } else { echo '0.00'; } ?></td>
							<td class="rateafterDiscount" width="15%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= number_format((float)(($bdetails['rate'] + $bdetails['extra_rate']) - $bdetails['discount_amount']), 2, '.', ''); ?></td>
						</tr>
						<?php $i++; ?>
					<?php } ?>
                    <tr>
                        <td colspan="3" style="text-align: left; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><b>Sub Total</b></td>
                        <td class="totalbaseRate" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">XX</td>
			            <td class="totalnoDays" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">XX</td>
                        <td class="totalratebeforeDiscount" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">XX</td>
                        <td class="totaldiscountAmount" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">XX</td>
                        <td class="totalrateafterDiscount" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">XX</td>
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
                        <td width="15%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Price before GST</td>
                        <td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">SAC</td>
                        <td width="7.5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">SGST Rate</td>
                        <td width="15%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">SGST Amount</td>
                        <td width="7.5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">CGST Rate</td>
                        <td width="15%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">CGST Amount</td>
                        <td width="10%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Total GST</td>
                        <td width="15%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Price after GST</td>
                    </tr>

					<?php $i = 1; ?>
					<?php foreach($booking_slip_details as $amtdetails){ ?>
						<tr>
							<td width="5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $i; ?></td>
							<td class="pricebeforeGst" width="15%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= number_format((float)(($amtdetails['rate'] + $amtdetails['extra_rate']) - $amtdetails['discount_amount']), 2, '.', ''); ?></td>
							<td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $amtdetails['hsn_sac_code']; ?></td>
							<td width="7.5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $amtdetails['v_sgst']; ?></td>
							<td class="sgstAmount" width="15%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= number_format((float)(($amtdetails['v_sgst'] * (($amtdetails['rate'] + $amtdetails['extra_rate']) - $amtdetails['discount_amount'])) / 100), 2, '.', ''); ?></td>
							<td width="7.5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= $amtdetails['v_cgst']; ?></td>
							<td class="cgstAmount" width="15%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= number_format((float)(($amtdetails['v_cgst'] * (($amtdetails['rate'] + $amtdetails['extra_rate']) - $amtdetails['discount_amount'])) / 100), 2, '.', ''); ?></td>
							<td class="gstAmount" width="10%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= number_format((float)((($amtdetails['v_cgst'] * (($amtdetails['rate'] + $amtdetails['extra_rate']) - $amtdetails['discount_amount'])) / 100) + (($amtdetails['v_sgst'] * (($amtdetails['rate'] + $amtdetails['extra_rate']) - $amtdetails['discount_amount'])) / 100)), 2, '.', ''); ?></td>
							<td class="priceafterGst" width="15%" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?= number_format((float)((($amtdetails['rate'] + $amtdetails['extra_rate']) - $amtdetails['discount_amount']) + ((($amtdetails['v_cgst'] * (($amtdetails['rate'] + $amtdetails['extra_rate']) - $amtdetails['discount_amount'])) / 100) + (($amtdetails['v_sgst'] * (($amtdetails['rate'] + $amtdetails['extra_rate']) - $amtdetails['discount_amount']))) / 100)), 2, '.', ''); ?></td>
						</tr>
						<?php $i++; ?>
					<?php } ?>                    
                    <tr>
                        <td style="text-align: left; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><b>Total</b></td>
                        <td class="totalpricebeforeGst" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
						<td colspan="2" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td class="totalsgstAmount" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td class="totalcgstAmount" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                        <td class="totalgstAmount" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
						<td class="totalpriceafterGst" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"></td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                    <tr>
                        <td width="20%" style="text-align: left; padding: 3px;"><b>Total Invoice Value : </b></td>
                        <td width="80%" style="text-align: left; padding: 3px;">Indian Rupees <span id="amountInWords">XXXXXXXXX</span> Only </td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid;margin-top: 20px;">
                    <tr>
                        <td colspan="4" style="text-align: left; background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Payment Information</td>
                        <td style="text-align: center; background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Mode</td>
                        <td style="text-align: center; background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Processed / Taken by</td>
                        <td style="text-align: center; background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Transaction ID</td>
                        <td style="text-align: center; background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Date & Time</td>
                        <td style="text-align: right; background-color:#d9d9d9; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Amount Paid</td>
                    </tr>
                    <!--<tr>
                        <td colspan="4" style="text-align: left; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Advance Payment</td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($booking_slip['advance_amount'])){ echo $booking_slip['payment_method']; } ?></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($booking_slip['advance_amount'])){ if($booking_slip['payment_method'] == 'Online'){ echo 'CCavenue'; } } ?></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($booking_slip['advance_amount'])){ echo $booking_slip['txnid']; } ?></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($booking_slip['advance_amount'])){ echo date('d/m/Y H:i:s',strtotime($booking_slip['venue_booking_created_at'])); } ?></td>
                        <td style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($booking_slip['advance_amount'])){ echo $booking_slip['advance_amount']; } ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: left; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Final Payment</td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if($booking_slip['status'] == '2' || $booking_slip['status'] == '3' || $booking_slip['status'] == '4' || $booking_slip['status'] == '5' || $booking_slip['status'] == '6'){ echo $payment_details_online[1]['payment_mode']; } ?></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if($booking_slip['status'] == '2' || $booking_slip['status'] == '3' || $booking_slip['status'] == '4' || $booking_slip['status'] == '5' || $booking_slip['status'] == '6'){ if($payment_details_online[1]['payment_mode'] == 'Credit Card'){ echo 'CCavenue'; } } ?></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if($booking_slip['status'] == '2' || $booking_slip['status'] == '3' || $booking_slip['status'] == '4' || $booking_slip['status'] == '5' || $booking_slip['status'] == '6'){ echo $payment_details_online[1]['txnid']; } ?></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if($booking_slip['status'] == '2' || $booking_slip['status'] == '3' || $booking_slip['status'] == '4' || $booking_slip['status'] == '5' || $booking_slip['status'] == '6'){ echo date('d/m/Y H:i:s',strtotime($payment_details_online[1]['payment_date'])); } ?></td>
                        <td style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if($booking_slip['status'] == '2' || $booking_slip['status'] == '3' || $booking_slip['status'] == '4' || $booking_slip['status'] == '5' || $booking_slip['status'] == '6'){ echo $payment_details_online[1]['amount']; } ?></td>
                    </tr>-->

                    <?php 
                        $jSon = json_decode($payment_details_online[0]['response_txt']);
                    ?>
                    <tr>
                        <td colspan="4" style="text-align: left; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Advance Payment</td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if($jSon->merchant_param3 != '0'){ if(!empty($booking_slip['advance_amount'])){ echo $payment_details_online[0]['payment_mode']; } } else { echo '--'; } ?></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if($jSon->merchant_param3 != '0'){ if(!empty($booking_slip['advance_amount'])){ if($payment_details_online[0]['payment_mode'] == 'Credit Card'){ echo 'CCavenue'; } } } else { echo '--'; } ?></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if($jSon->merchant_param3 != '0'){ if(!empty($booking_slip['advance_amount'])){ echo $payment_details_online[0]['txnid']; } } else { echo '--'; } ?></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if($jSon->merchant_param3 != '0'){ if(!empty($booking_slip['advance_amount'])){ echo date('d/m/Y H:i:s',strtotime($payment_details_online[0]['payment_date'])); } } else { echo '--'; } ?></td>
                        <td style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if($jSon->merchant_param3 != '0'){ if(!empty($booking_slip['advance_amount'])){ echo $payment_details_online[0]['amount']; } } else { echo '--'; } ?></td>
                    </tr>                    
                    <tr>
                        <td colspan="4" style="text-align: left; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Final Payment</td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if($jSon->merchant_param3 != '0'){ if($booking_slip['status'] == '2' || $booking_slip['status'] == '3' || $booking_slip['status'] == '4' || $booking_slip['status'] == '5' || $booking_slip['status'] == '6'){ echo $payment_details_online[1]['payment_mode']; } } else { if($booking_slip['status'] == '2' || $booking_slip['status'] == '3' || $booking_slip['status'] == '4' || $booking_slip['status'] == '5' || $booking_slip['status'] == '6'){ echo $payment_details_online[0]['payment_mode']; } } ?></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if($jSon->merchant_param3 != '0'){ if($booking_slip['status'] == '2' || $booking_slip['status'] == '3' || $booking_slip['status'] == '4' || $booking_slip['status'] == '5' || $booking_slip['status'] == '6'){ if($payment_details_online[1]['payment_mode'] == 'Credit Card'){ echo 'CCavenue'; } } } else { if($booking_slip['status'] == '2' || $booking_slip['status'] == '3' || $booking_slip['status'] == '4' || $booking_slip['status'] == '5' || $booking_slip['status'] == '6'){ if($payment_details_online[0]['payment_mode'] == 'Credit Card'){ echo 'CCavenue'; } } } ?></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if($jSon->merchant_param3 != '0'){ if($booking_slip['status'] == '2' || $booking_slip['status'] == '3' || $booking_slip['status'] == '4' || $booking_slip['status'] == '5' || $booking_slip['status'] == '6'){ echo $payment_details_online[1]['txnid']; } } else { if($booking_slip['status'] == '2' || $booking_slip['status'] == '3' || $booking_slip['status'] == '4' || $booking_slip['status'] == '5' || $booking_slip['status'] == '6'){ echo $payment_details_online[0]['txnid']; } } ?></td>
                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if($jSon->merchant_param3 != '0'){ if($booking_slip['status'] == '2' || $booking_slip['status'] == '3' || $booking_slip['status'] == '4' || $booking_slip['status'] == '5' || $booking_slip['status'] == '6'){ echo date('d/m/Y H:i:s',strtotime($payment_details_online[1]['payment_date'])); } } else { if($booking_slip['status'] == '2' || $booking_slip['status'] == '3' || $booking_slip['status'] == '4' || $booking_slip['status'] == '5' || $booking_slip['status'] == '6'){ echo date('d/m/Y H:i:s',strtotime($payment_details_online[0]['payment_date'])); } } ?></td>
                        <td style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if($jSon->merchant_param3 != '0'){ if($booking_slip['status'] == '2' || $booking_slip['status'] == '3' || $booking_slip['status'] == '4' || $booking_slip['status'] == '5' || $booking_slip['status'] == '6'){ echo $payment_details_online[1]['amount']; } } else { if($booking_slip['status'] == '2' || $booking_slip['status'] == '3' || $booking_slip['status'] == '4' || $booking_slip['status'] == '5' || $booking_slip['status'] == '6'){ echo $payment_details_online[0]['amount']; } } ?></td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                    <tr>
                        <td width="70%" style="text-align: left; padding: 3px;">
                            <ul>
                                <li style="list-style:none;padding-bottom:5px;"><span style="text-align: left;"><b>Note:</b></span></li>
                                <li>All amount shown hereinabove are in Indian Rupees.</li>
                                <li>This is a computer-generated Invoice hence no signature is mandatory.</li>
                                <li>Please obtain the NOC to avail the services at the venue on the date of booking</li>
                                <li>To obtain NOC you may need to procure one or more permission/licence/document as applicable for your event from the competent authorities and submit to the Person-in-Charge of the Venue at least 7 days before the scheduled date of your event.</li>
                                <li>The Permissions/Licences/Documents are to be procured from the following authorities :</li>
                                <li style="list-style: none;padding-left:5px;">1) Department of Excise</li>
                                <li style="list-style: none;padding-left:5px;">2) Office of the Director General, West Bengal Fire & Emergency Services</li>
                                <li style="list-style: none;padding-left:5px;">3) Police Authority</li>
                                <li style="list-style: none;padding-left:5px;">4) Concerned Municipal /Panchayat Authority</li>
                                <li style="list-style: none;padding-left:5px;">5) Novex Communications</li>
                                <li style="list-style: none;padding-left:5px;">6) Phonographic Performance Limited</li>
                                <li style="list-style: none;padding-left:5px;">7) The Indian Performing Right Society Limited</li>
                            </ul>
                        </td>
                        <td width="30%" style="text-align: center; padding: 3px;">
                            <span>E & O.E</span><br><span>For SFDC Ltd</span><br><br><br><br>
                            <span>(Authorised Signatory)</span><br><br>
                            <span><b>This is a system generated document hence no signature and/or seal is required.</b></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


	<script>
		$( document ).ready(function() {

			//Total Sum Calculation
			var baseRateSum = 0;
			var noDaysSum = 0;
			var ratebeforeDiscountSum = 0;
			var discountAmountSum = 0;
			var rateafterDiscountSum = 0;

			$('td.baseRate').each(function() {
				var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
				if (!isNaN(value)) { // Check if it's a valid number
					baseRateSum += value; // Add it to the sum
				}
			});	

			$('td.noDays').each(function() {
				var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
				if (!isNaN(value)) { // Check if it's a valid number
					noDaysSum += value; // Add it to the sum
				}
			});

			$('td.ratebeforeDiscount').each(function() {
				var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
				if (!isNaN(value)) { // Check if it's a valid number
					ratebeforeDiscountSum += value; // Add it to the sum
				}
			});

			$('td.discountAmount').each(function() {
				var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
				if (!isNaN(value)) { // Check if it's a valid number
					discountAmountSum += value; // Add it to the sum
				}
			});

			$('td.rateafterDiscount').each(function() {
				var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
				if (!isNaN(value)) { // Check if it's a valid number
					rateafterDiscountSum += value; // Add it to the sum
				}
			});	
			
			var formattedNumber = noDaysSum < 10 ? '0' + noDaysSum : noDaysSum;

			$('.totalbaseRate').text(baseRateSum.toFixed(2));
			$('.totalnoDays').text(formattedNumber);
			$('.totalratebeforeDiscount').text(ratebeforeDiscountSum.toFixed(2));
			$('.totaldiscountAmount').text(discountAmountSum.toFixed(2));
			$('.totalrateafterDiscount').text(rateafterDiscountSum.toFixed(2));


			//Total Sum Calculation
			var pricebeforeGstSum = 0;
			var sgstAmountSum = 0;
			var cgstAmountSum = 0;
			var gstAmountSum = 0;
			var priceafterGstSum = 0;

			$('td.pricebeforeGst').each(function() {
				var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
				if (!isNaN(value)) { // Check if it's a valid number
					pricebeforeGstSum += value; // Add it to the sum
				}
			});	

			$('td.sgstAmount').each(function() {
				var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
				if (!isNaN(value)) { // Check if it's a valid number
					sgstAmountSum += value; // Add it to the sum
				}
			});

			$('td.cgstAmount').each(function() {
				var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
				if (!isNaN(value)) { // Check if it's a valid number
					cgstAmountSum += value; // Add it to the sum
				}
			});

			$('td.gstAmount').each(function() {
				var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
				if (!isNaN(value)) { // Check if it's a valid number
					gstAmountSum += value; // Add it to the sum
				}
			});

			$('td.priceafterGst').each(function() {
				var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
				if (!isNaN(value)) { // Check if it's a valid number
					priceafterGstSum += value; // Add it to the sum
				}
			});	

			$('.totalpricebeforeGst').text(pricebeforeGstSum.toFixed(2));
			$('.totalsgstAmount').text(sgstAmountSum.toFixed(2));
			$('.totalcgstAmount').text(cgstAmountSum.toFixed(2));
			$('.totalgstAmount').text(gstAmountSum.toFixed(2));
			$('.totalpriceafterGst').text(priceafterGstSum.toFixed(2));

			//Convert Into Words
			var amountInWords = convertToWords(priceafterGstSum);
            $('#amountInWords').text(amountInWords);

			function convertToWords(num) {
                var ones = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"];
                var teens = ["Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
                var tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];

                //if (num === 0) {
                    //return "Zero";
                //}

                if (num < 10) {
                    return ones[num];
                }

                if (num < 20) {
                    return teens[num - 10];
                }

                if (num < 100) {
                    return tens[Math.floor(num / 10)] + " " + ones[num % 10];
                }

                if (num < 1000) {
                    return ones[Math.floor(num / 100)] + " Hundred " + convertToWords(num % 100);
                }

                if (num < 1000000) {
                    return convertToWords(Math.floor(num / 1000)) + " Thousand " + convertToWords(num % 1000);
                }

                return "Number too large";
            }

		});
	</script>

</body>

</html>
