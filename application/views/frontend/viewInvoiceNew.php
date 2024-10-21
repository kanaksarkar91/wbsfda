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
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Booking Acknowledgement</title>
    <style type="text/css">
        @page {
            size: A4;
            margin: 0cm;
        }
    </style>
</head>

<body role="document">
    <table id="printArea" cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin: 0 auto; font-family: Arial, Helvetica, sans-serif; font-size: 11px; padding: 0;text-align: center;color: #000;">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%; margin-bottom: 5px;">
                    <tr>
                        <td width="15%" style="text-align: right;padding-right:10px;">
                            <img src="<?= base_url('public/frontend_assets/assets/img/forest-2.jpg'); ?>" width="84" height="84" alt="..." style="margin-top:20px;" />
                        </td>
                        <td width="70%" style="text-align: center;">
                            <img src="<?= base_url('public/frontend_assets/assets/img/logo.png'); ?>" width="228" height="88" alt="..." />
                            <h3 style="margin-top:5px; font-size:18px;margin-bottom: 0px;line-height:1;font-weight:600;">WESTBENGAL STATE FOREST DEVELOPMENT AGENCY</h3>
                            <h3 style="margin-top:5px; font-size:16px;margin-bottom: 5px;line-height:1;font-weight:600;">Booking Acknowledgement</h3>
                        </td>
                        <td width="15%" style="text-align: left; padding:10px;">
                            <img src="<?= base_url('public/frontend_assets/assets/img/forest-1.jpg'); ?>" width="84" height="84" alt="..." style="margin-top:20px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <?php
        if ($_GET['type'] == 'cancel') {
            if (!$this->admin_session_data['user_id']) {
        ?>
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 1240px; margin: 10 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;border:#9e9e9e 1px solid; padding: 15px;text-align: center;">
                            <tr>
                                <input type="hidden" id="booking_id" name="booking_id" value="<?= $booking_header['booking_id'] ?>">
                                <?php
                                if (($booking_header['booking_status'] == 'I' || $booking_header['booking_status'] == 'A') && strtotime($booking_header['check_in']) >= time()) {
                                    if ($booking_header['booking_source'] == 'F') {
                                ?>
                                        <td style="padding: 10px;">
                                            <h4>Cancellation Information</h4><br>
                                            <?php
                                            $cancel_percent = $cancellation_details['cancellation_per'];
                                            $cancel_charge = intval((($booking_header['room_price_before_tax'] * $cancellation_details['cancellation_per']) / 100) * 100) / 100;
                                            $refund_amt = intval(($booking_header['room_price_before_tax'] - $cancel_charge) * 100) / 100;
                                            ?>
                                            <h6>Cancellation Charge (Rs.) : <?= $cancel_charge ?></h6>
                                            <h6>Refund Amount (Rs.) : <?= $refund_amt ?></h6>
                                            <textarea type="text" class="form-control" id="cancel_remarks" name="cancel_remarks" placeholder="Cancel Remarks" rows="4" cols="50"></textarea>
                                            <input type="hidden" id="paid_amount" name="paid_amount" value="<?= $booking_header['room_price_before_tax'] ?>">
                                            <input type="hidden" id="cancel_percent" name="cancel_percent" value="<?= $cancel_percent ?>">
                                            <input type="hidden" id="cancel_charge" name="cancel_charge" value="<?= $cancel_charge ?>">
                                            <input type="hidden" id="refund_amt" name="refund_amt" value="<?= $refund_amt ?>">


                                            <input type="button" id="cancel_booking_btn" style="float:right;margin-bottom:10px;margin-top:10px;" value="Cancel Booking" class="btn btn-danger">
                                        </td>
                                <?php
                                    }
                                }
                                ?>
                                <?php if ($booking_header['booking_status'] == 'C' && isset($booking_header['cancellation_remarks'])) { ?>
                                    <td style="padding: 10px;">
                                        <h4>Cancellation Information</h4><br>
                                        <h6>Cancellation Percentage : <?= $cancellation_request_details['cancel_percent'] ?></h6>
                                        <h6>Cancellation Charge (Rs.) : <?= $cancellation_request_details['cancel_charge'] ?></h6>
                                        <h6>Refund Amount (Rs.) : <?= $cancellation_request_details['refund_amt'] ?></h6>
                                        <h6>Refund Status : <?= ($cancellation_request_details['is_refunded'] == '1') ? 'Refunded' : 'Refund Initiated' ?></h6>

                                        <textarea type="text" class="form-control" placeholder="Cancel Remarks" rows="4" cols="50" disabled><?= $booking_header['cancellation_remarks'] ?></textarea>
                                    </td>
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
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:center;">
                    <tr>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Booking ID</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"><?= $booking_header['booking_no']; ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Transaction Date</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"><?= date('d/m/Y H:i:s A', strtotime($booking_header['created_ts'])) ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Booking Source</b></td>
                        <td width="16%" style="font-size:12px;  padding: 6px 3px; border-bottom: #9e9e9e 1px solid;">
                            <?php
                            if ($booking_header['booking_source'] == 'B') {
                            ?>
                                <?= 'Admin'; ?>
                            <?php
                            } else {
                            ?>
                                <?= 'Guest'; ?>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid;"><b>Booked by</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left;"><?= $Initiated_by['full_name']; ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid;"><b>Contact No.</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left;"><?= $Initiated_by['mobile'] . $Initiated_by['contact_no']; ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid;"><b>e-mail ID</b></td>
                        <td width="16%" style="font-size:12px;  padding: 6px 3px;"><?= $Initiated_by['email']; ?></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:center;margin-top: 3px;">
                    <tr>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Booked for</b></td>
                        <td colspan="3" width="48%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"><?= ($booking_header['first_name'] != '') ? $booking_header['customer_title'] . ' ' . $booking_header['first_name'] . ' ' . $booking_header['middle_name'] . ' ' . $booking_header['last_name'] : $booking_header['company_name'] ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>GSTIN</b></td>
                        <td width="16%" style="font-size:12px;  padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"><?= $booking_header['gst_number'] ?></td>
                    </tr>
                    <tr>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Primary Guest</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"><?= $booking_header['first_name']; ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Gender</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"><?= $booking_header['gender']; ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Age (in yrs)</b></td>
                        <td width="16%" style="font-size:12px;  padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"><?= ($booking_header['age'] != '') ? $booking_header['age'] . ' Years' : ''; ?></td>
                    </tr>
                    <tr>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Contact No.</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"><?= $booking_header['mobile']; ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Contact No.</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>e-mail ID</b></td>
                        <td width="16%" style="font-size:12px;  padding: 6px 3px; border-bottom: #9e9e9e 1px solid;"><?= $booking_header['email'] ?></td>
                    </tr>
                    <tr>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Nationality</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;">Indian</td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Total No. of Adult</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;">2</td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Total No. of Child</b></td>
                        <td width="16%" style="font-size:12px;  padding: 6px 3px; border-bottom: #9e9e9e 1px solid;">1</td>
                    </tr>
                    <tr>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid;"><b>Check In Date</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left;"><?= date('d/m/Y', strtotime($booking_header['check_in'])); ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid;"><b>Check Out Date</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left;"><?= date('d/m/Y', strtotime($booking_header['check_out'])); ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid;"><b>Accommodation Count</b></td>
                        <td width="16%" style="font-size:12px;  padding: 6px 3px;"><?= $booking_header['room_count'] ?></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:center;margin-top: 3px;">
                    <tr>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Property</b></td>
                        <td colspan="3" width="48%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"><?= $property_details['property_name'] ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>GSTIN</b></td>
                        <td width="16%" style="font-size:12px;  padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"><?= $property_details['gst_no'] ?></td>
                    </tr>
                    <tr>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Address</b></td>
                        <td colspan="5" width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"><?= $property_details['address_line_1'] . ',' . $property_details['address_line_2'] ?></td>
                    </tr>
                    <tr>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>City / Village</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"><?= $property_details['city'] ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>District</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"><?= $property_details['district_name'] ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>State</b></td>
                        <td width="16%" style="font-size:12px;  padding: 6px 3px; border-bottom: #9e9e9e 1px solid;"><?= $property_details['state_name'] ?></td>
                    </tr>
                    <tr>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>PIN Code</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"><?= $property_details['pincode'] ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Contact No.</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left; border-bottom: #9e9e9e 1px solid;"><?= $property_details['phone_no'] ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid; border-bottom: #9e9e9e 1px solid;"><b>Contact No.</b></td>
                        <td width="16%" style="font-size:12px;  padding: 6px 3px; border-bottom: #9e9e9e 1px solid;"><?= $property_details['mobile_no'] ?></td>
                    </tr>
                    <tr>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid;"><b>e-mail ID</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left;"><?= $property_details['email'] ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid;"><b>Check In Time</b></td>
                        <td width="16%" style="font-size:12px;  border-right: #9e9e9e 1px solid;padding: 6px 3px; text-align: left;"><?= $property_details['checkin_time']; ?></td>
                        <td width="16%" style="font-size:12px; background-color: #f5f5f5; padding: 6px 3px; border-right: #9e9e9e 1px solid;"><b>Check Out Time</b></td>
                        <td width="16%" style="font-size:12px;  padding: 6px 3px;"><?= $property_details['checkout_time']; ?></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left;margin-top: 3px;">
                    <tr>
                        <th colspan="11" style="font-size:14px; padding: 6px 3px; text-align: left; background-color: #f5f5f5;">Booking Details</th>
                    </tr>
                    <tr>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Accommodation Category</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Date</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Price before GST<br>(per Day/Night)</th>
                        <!--<th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">HSN/SAC</th>-->
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">CGST<br>(%)</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">CGST<br>(Amount)</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">SGST<br>(%)</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">SGST<br>(Amount)</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">GST<br>(%)</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">GST<br>(Amount)</th>
                        <th width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid;">Price after GST<br>(per Day/Night)</th>
                    </tr>
                    <?php
                    $totalAdult = $totalChild = $totalRoomRate = $totalExtraBedRate = $totalRoomBasePrice = $totalRoomDiscount = $totalRoomPriceBeforeTax = $totalGSTAmount = $totalPayableAmount = 0;
                    if (!empty($booking_details)) {
                        foreach ($booking_details as $booking_detail) {
                    ?>
                            <tr>
                                <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $booking_detail['accommodation_name']; ?></td>
                                <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= date('d/m/Y', strtotime($booking_detail['in_date'])); ?></td>
                                <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $booking_detail['room_rate'] ?></td>
                                <!--<td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"></td>-->
                                <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= (($booking_detail['room_cgst_percent'] > 0) ? $booking_detail['room_cgst_percent'] . '%' : 'N/A') ?></td>
                                <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $booking_detail['room_cgst'] ?></td>
                                <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= (($booking_detail['room_sgst_percent'] > 0) ? $booking_detail['room_sgst_percent'] . '%' : 'N/A') ?></td>
                                <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $booking_detail['room_sgst'] ?></td>
                                <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= (($booking_detail['room_igst_percent'] > 0) ? $booking_detail['room_igst_percent'] . '%' : 'N/A') ?></td>
                                <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= $booking_detail['room_igst'] ?></td>
                                <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid;"><?= $booking_detail['room_net_amount'] ?></td>
                            </tr>
                    <?php
                            $totalAdult += ($booking_detail['is_hall'] == 1) ? 0 : $booking_detail['adults'];
                            $totalChild += ($booking_detail['is_hall'] == 1) ? 0 : $booking_detail['children'];
                            $totalRoomRate += $booking_detail['room_rate'];
                            $totalExtraBedRate += ($booking_detail['is_select_extra_bed'] > 0) ? $booking_detail['extra_bed_rate'] : 0;
                            $totalRoomBasePrice += ($booking_detail['room_rate'] + $booking_detail['extra_bed_rate']);
                            $totalRoomDiscount += $booking_detail['room_total_discount'];
                            $totalRoomPriceBeforeTax += $booking_detail['room_taxable_amount'];
                            $totalCGSTAmount += $booking_detail['room_cgst'];
                            $totalSGSTAmount += $booking_detail['room_sgst'];
                            $totalGSTAmount += $booking_detail['room_igst'];
                            $totalPayableAmount += $booking_detail['room_net_amount'];
                        }
                    }
                    ?>

                    <tr>
                        <td width="" colspan="2" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;">Total</td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= number_format((float)$totalRoomRate, 2, '.', '') ?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"></td>
                        <!--<td width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"></td>-->
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= number_format((float)$totalCGSTAmount, 2, '.', '') ?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= number_format((float)$totalSGSTAmount, 2, '.', '') ?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; background-color: #f5f5f5; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid; border-right: #9e9e9e 1px solid;"><?= number_format((float)$totalGSTAmount, 2, '.', '') ?></td>
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: center; border-top: #9e9e9e 1px solid;"><?= number_format((float)$totalPayableAmount, 2, '.', '') ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left;margin-top: 3px;">
                    <tr>
                        <th colspan="6" style="padding: 10px 3px; border-bottom: #9e9e9e 1px solid;"><b>Total Amount Payable (in words):</b> <span><?= getIndianCurrencyNumberToWord($totalPayableAmount); ?></span></th>
                    </tr>
                    <tr style="text-align: center;">
                        <th rowspan="2" style="border-right: #9e9e9e 1px solid; background-color: #f5f5f5; padding: 6px 3px;">Payment Information</th>
                        <th style="border-right: #9e9e9e 1px solid; background-color: #f5f5f5; padding: 6px 3px;">Mode</th>
                        <th style="border-right: #9e9e9e 1px solid; background-color: #f5f5f5; padding: 6px 3px;">Processed / Taken by</th>
                        <th style="border-right: #9e9e9e 1px solid; background-color: #f5f5f5; padding: 6px 3px;">Payment ID</th>
                        <th style="border-right: #9e9e9e 1px solid; background-color: #f5f5f5; padding: 6px 3px;">Date & Time</th>
                        <th style="background-color: #f5f5f5; padding: 6px 3px;">Amount Paid</th>
                    </tr>
                    <?php
                    if (!empty($booking_payment_listings)) {
                        foreach ($booking_payment_listings as $booking_payment_listing) {
                    ?>
                            <tr style="text-align: center;">
                                <td style="border-right: #9e9e9e 1px solid; border-top: #9e9e9e 1px solid; padding: 6px 3px;">Online</td>
                                <td style="border-right: #9e9e9e 1px solid; border-top: #9e9e9e 1px solid; padding: 6px 3px;">Internet Payment Gateway</td>
                                <td style="border-right: #9e9e9e 1px solid; border-top: #9e9e9e 1px solid; padding: 6px 3px;"><?= $booking_payment_listing['razorpay_payment_id']; ?></td>
                                <td style="border-right: #9e9e9e 1px solid; border-top: #9e9e9e 1px solid; padding: 6px 3px;">
                                    <?php
                                    if ($booking_payment_listing['payment_date'] == '' || $booking_payment_listing['payment_date'] == '0000-00-00') {
                                    ?>
                                        <?= ''; ?>
                                    <?php
                                    } else {
                                    ?>
                                        <?= date('d/m/Y H:i:s', strtotime($booking_payment_listing['payment_date'])); ?>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td style="border-top: #9e9e9e 1px solid; padding: 6px 3px;"><?= $booking_payment_listing['amount'] ?></td>
                            </tr>
                    <?php }
                    } ?>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                    <tr>
                        <td width="100%" style="text-align: left; font-size: 11px; padding: 6px 3px;">
                            <span style="padding-bottom:5px; padding-left: 20px; text-align: left;"><b>Note:</b></span>
                            <ul style="margin-bottom: 0;">
                                <li style="list-style:lower-latin;padding-bottom:5px;">This is a statement showing Booking & Payment details and not a GST Invoice. </li>
                                <li style="list-style:lower-latin;padding-bottom:5px;">The amount shown as GST in this document is an estimated value of the consolidated rate and amount of the applicable CGST and SGST.</li>
                                <li style="list-style:lower-latin;padding-bottom:5px;">Final GST Invoice will be provided from the respective Property at the time of Check Out based on the services actually availed and GST rate as applicable during the period of stay and Checking Out.</li>
                                <li style="list-style:lower-latin;padding-bottom:5px;">Amount shown in each of the fields of this document are in Indian Rupees. </li>
                                <li style="list-style:lower-latin;padding-bottom:5px;">For any queries & clarification please contact with the Contact No.(s) & email ID given along with the Property Information as mentioned hereinabove.</li>
                                <li style="list-style:lower-latin;padding-bottom:5px;">In case of Cancellation of this booking and/or no show up on the date of scheduled Check In as mentioned hereinabove, Cancellation Charges will be imposed according to the Cancellation Policy as applicable on the date of
                                    Cancellation and/or Check In.</li>
                                <li style="list-style:lower-latin;padding-bottom:5px;">The amount paid as GST as shown hereinabove will not be refunded under any circumstances even if the guest and/or the user of the website cancels the booking.</li>
                                <li style="list-style:lower-latin;padding-bottom:5px;">Please visit www.wbsfdcltd.com for Terms & Conditions, Cancellation Policy, Refund Policy, Privacy Policy and other information as this document may not contain all the important and required details that is applicable
                                    under any of the circumstances before, during and even after the stay.</li>
                                <li style="list-style:lower-latin;padding-bottom:5px;">The Check In will be allowed only on or after the Check In Time on the date of scheduled Check In i.e. first day of this Booking as mentioned hereinabove. </li>
                                <li style="list-style:lower-latin;padding-bottom:5px;">Checking Out is mandatory on or before the Check Out Time on the date of scheduled Check Out or in other words on the next date of the last day of this Booking as mentioned hereinabove.</li>
                                <li style="list-style:lower-latin;padding-bottom:5px;">This is a system generated document hence no signature and/or seal is required.</li>
                            </ul>
                        </td>
                    </tr>
                </table>
                <?php
                if ($_GET['type'] != 'cancel') {
                    if (!$this->admin_session_data['user_id']) {
                ?>
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 1240px; margin: 10 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;border:#9e9e9e 1px solid; padding: 15px;text-align: center;">
                            <tr>
                                <input type="hidden" id="booking_id" name="booking_id" value="<?= $booking_header['booking_id'] ?>">
                                <?php
                                if (($booking_header['booking_status'] == 'I' || $booking_header['booking_status'] == 'A') && strtotime($booking_header['check_in']) >= time()) {
                                    if ($booking_header['booking_source'] == 'F') {
                                ?>
                                        <td style="padding: 10px;">
                                            <h4>Cancellation Information</h4><br>
                                            <?php
                                            $cancel_percent = $cancellation_details['cancellation_per'];
                                            $cancel_charge = intval((($booking_header['room_price_before_tax'] * $cancellation_details['cancellation_per']) / 100) * 100) / 100;
                                            $refund_amt = intval(($booking_header['room_price_before_tax'] - $cancel_charge) * 100) / 100;
                                            ?>
                                            <h6>Cancellation Charge (Rs.) : <?= $cancel_charge ?></h6>
                                            <h6>Refund Amount (Rs.) : <?= $refund_amt ?></h6>
                                            <textarea type="text" class="form-control" id="cancel_remarks" name="cancel_remarks" placeholder="Cancel Remarks" rows="4" cols="50"></textarea>
                                            <input type="hidden" id="paid_amount" name="paid_amount" value="<?= $booking_header['room_price_before_tax'] ?>">
                                            <input type="hidden" id="cancel_percent" name="cancel_percent" value="<?= $cancel_percent ?>">
                                            <input type="hidden" id="cancel_charge" name="cancel_charge" value="<?= $cancel_charge ?>">
                                            <input type="hidden" id="refund_amt" name="refund_amt" value="<?= $refund_amt ?>">


                                            <input type="button" id="cancel_booking_btn" style="float:right;margin-bottom:10px;margin-top:10px;" value="Cancel Booking" class="btn btn-danger">
                                        </td>
                                <?php
                                    }
                                }
                                ?>
                                <?php if ($booking_header['booking_status'] == 'C' && isset($booking_header['cancellation_remarks'])) { ?>
                                    <td style="padding: 10px;">
                                        <h4>Cancellation Information</h4><br>
                                        <h6>Cancellation Percentage : <?= $cancellation_request_details['cancel_percent'] ?></h6>
                                        <h6>Cancellation Charge (Rs.) : <?= $cancellation_request_details['cancel_charge'] ?></h6>
                                        <h6>Refund Amount (Rs.) : <?= $cancellation_request_details['refund_amt'] ?></h6>
                                        <h6>Refund Status : <?= ($cancellation_request_details['is_refunded'] == '1') ? 'Refunded' : 'Refund Initiated' ?></h6>

                                        <textarea type="text" class="form-control" placeholder="Cancel Remarks" rows="4" cols="50" disabled><?= $booking_header['cancellation_remarks'] ?></textarea>
                                    </td>
                                <?php } ?>

                            </tr>
                        </table>
                <?php
                    }
                }
                ?>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                    <tr>
                        <td width="100%" style="text-align: center; font-size: 14px; border-top: #9e9e9e 1px solid;padding: 5px 0;">
                            <p style="margin:3px 0;">For more information please contact</p>
                            <p style="margin:3px 0;"><?= COM_NAME; ?></p>
                            <p style="margin:3px 0;"><?= COM_ADDRESS; ?></p>
                            <p style="margin:3px 0;">PH:<?= COM_PHONE; ?> | Email :<?= COM_EMAIL; ?> | <?= COM_WEBSITE; ?></p>
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

        $(document).on('click', "#cancel_booking_btn", function() {




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
                            $("#cancel_booking_btn").prop('disabled', true);
                            $("#cancel_booking_btn").val('Processing...');

                            $.ajax({
                                url: '<?= base_url("frontend/profile/cancel_booking"); ?>',
                                method: 'post',
                                data: {
                                    csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>',
                                    booking_id: booking_id,
                                    cancel_remarks: cancel_remarks,
                                    paid_amount: paid_amount,
                                    cancel_percent: cancel_percent,
                                    cancel_charge: cancel_charge,
                                    refund_amt: refund_amt,
                                },
                                dataType: 'json',
                                async: false,
                                success: function(response) {
                                    if (response.status) {
                                        $("#cancel_booking_btn").prop('disabled', false);
                                        $("#cancel_booking_btn").val('Cancel Booking');

                                        $.confirm({
                                            type: 'green',
                                            title: 'Success!',
                                            content: response.msg,
                                            buttons: {

                                                OK: {
                                                    btnClass: 'btn-default',
                                                    action: function() {


                                                        window.location.href = "<?= base_url('my-booking') ?>";
                                                    }

                                                }
                                            }
                                        })

                                    } else {
                                        $("#cancel_booking_btn").prop('disabled', false);
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