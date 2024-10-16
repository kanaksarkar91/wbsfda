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
    </style>
</head>

<body role="document">
    <table id="printArea" cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin: 0 auto; font-family: Arial, Helvetica, sans-serif; font-size: 11px; padding: 0;text-align: center;color: #000;">
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
                            <p style="font-size:14px; font-weight: 400;margin-bottom: 0;margin-top:0;font-weight:bold;">PNR No.: CSCCS1211202441743</p>
                            <p style="font-size:14px; font-weight: 400;margin-bottom: 0;margin-top:0;font-weight:bold;">Contact No.: 9734190119</p>
                            <p style="font-size:12px;">Kindly Note down the PNR NO for future reference</p>
                        </td>
                        <td width="15%" style="text-align: left; padding:10px;">
                            <img src="<?= base_url('public/frontend_assets/assets/img/forest-1.jpg');?>" width="84" height="108" alt="..." style="margin-top:10px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

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
                        <th colspan="7" style="font-size:14px; padding: 6px 3px; text-align: left; background-color: #f5f5f5;">Booked Visitor's Information</th>
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
                        <td width="" style="font-size:12px; padding: 6px 3px; text-align: left; border-top: #9e9e9e 1px solid;">Confirmed</td>
                    </tr>
					<?php } } ?>
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
</body>

</html>