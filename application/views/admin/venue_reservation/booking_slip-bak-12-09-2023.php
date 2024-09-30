<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Booking Slip</title>




</head>

<body role="document" style="padding-top: 0px;">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

        body,
        p,
        b {
            font-size: 14px;
            line-height: 1.5;
            font-family: 'Poppins', sans-serif;

        }

        p {
            padding: 0;
            margin: 0;
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
    <div style="width:1000px; height: auto; padding:10ox; text-align: center;margin: 0 auto;"> 
        <input type="button" value="Print this invoice" class="btn btn-print" onClick="printpart()" />
        <!-- <input type="button" value="Print this invoice" class="btn btn-theme" onclick="printpart()" /> -->
    </div>
    <table cellpadding="0" cellspacing="0" border="0" style="width:1000px;margin: 0 auto;border: #ddd 1px solid;" id="printArea">
    <tr>
        <td style="padding-bottom: 20px;">
            <div class="header-top-bar d-flex align-items-center justify-content-center">
            <a class="mx-4" href="<?= base_url();?>"><img src="<?= base_url();?>public/frontend_assets/assets/img/SFDC_logo.png" width="64" alt="..." /></a>
                    <div class="taglinetext">
                        <h1>The State Fisheries Development Corporation Limited <span>(Government of West Bengal Undertaking)</span>
                            <small>An ISO: 9001:2015 Company &nbsp; &nbsp; <!-- <em>fssai</em> Licence No. 12815013001570 &nbsp; &nbsp; --> GSTIN : 19AABCT2090D1ZJ</small>
                        </h1>
                    </div>
                    <a class="mx-4" href="<?= base_url();?>"><img src="<?= base_url();?>public/frontend_assets/assets/img/Biswa_Bangla_logo.png" width="48" alt="..." /></a>
                </div>           
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 84%;padding: 20px 20px 10px 35px;margin: 0 auto;">
                    <tr>
                        <td style="padding-bottom:10px;">
                            <p>Date : <span><?=($booking_slip['payment_method'] == 'Online')?date('d-m-Y',strtotime($payment_details_online['created_at'])):date('d-m-Y',strtotime($payment_details_offline['created_ts'])) ?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom:9px;">
                            <p>To, </p>
                            <p><span><?=$booking_slip['contact_person_name']?> </span></p>
                            <p><span><?=$booking_slip['contact_person_designation']?></span></p> 
                            <p><span>To be reserved in favour of <?=($booking_slip['is_indivisual']==1)? 'Indivisual Name' : 'Business Name'?></span></p>
                            <p><span>Mailing Address : <?=($booking_slip['is_indivisual']==1)? $booking_slip['indivisual_full_address'] :  $booking_slip['business_full_address']?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom:9px;">
                            <p><span style="margin-right:20px ;">Sub  :</span>  Confirmation of Booking Request No. <span><?= str_pad($booking_slip['booking_id'],6,"0",STR_PAD_LEFT) ?></span> dated <span><?=date('d-m-Y',strtotime($booking_slip['venue_booking_created_at'])) ?></span> </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom:9px;">
                            <p style="margin-bottom: 15px;">Dear Sir / Madam,</p>

                            <p>We do hereby confirm your request to book WBSFDC <?=$booking_slip['venue_names']?> with Booking Request No. <span><?= str_pad($booking_slip['booking_id'],6,"0",STR_PAD_LEFT) ?></span> dated <span><?=($booking_slip['payment_method'] == 'Online')?date('d-m-Y',strtotime($payment_details_online['created_at'])):date('d-m-Y',strtotime($payment_details_offline['created_ts'])) ?></span>. </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom:9px;"><p>The details of the Booking are as follows :</p></td>
                    </tr>

                    <tr>
                        <td>
                            <table style="width: 100%; border: #000 1px solid;" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td colspan="2" style="width: 33%; border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">Venue
                                    </p></td>
                                   
                                    <td colspan="4" style="width: 67%; border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=$booking_slip['venue_names']?></span></p></td>
                                   
                                    
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">Location </p></td>
                                    <td colspan="4" style="border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=$booking_slip['property_name']?></span></p></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">Address
                                    </p></td>
                                    <td colspan="4" style="border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=$booking_slip['property_address_line_1'].' '.$booking_slip['property_address_line_2']?></span></p></td>
                                    </p></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">Booked in favour of
                                    </p></td>
                                    <td colspan="4" style="border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?= ($booking_slip['is_indivisual']==1)? $booking_slip['indivisual_full_name'] :  $booking_slip['business_full_name'] ?></span>
                                    </p></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">Mailing Address
                                    </p></td>
                                    <td colspan="4" style="border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=($booking_slip['is_indivisual']==1)? $booking_slip['indivisual_full_address'] :  $booking_slip['business_full_address']?></span>
                                    </p></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">Contact No.
                                    </p></td>
                                    <td colspan="4" style="border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=($booking_slip['is_indivisual']==1)? $booking_slip['indivisual_contact_no'] :  $booking_slip['business_contact_no'] ?></span>
                                    </p></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">e-mail ID
                                    </p></td>
                                    <td colspan="4" style="border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=($booking_slip['is_indivisual']==1)? $booking_slip['indivisual_email'] :  $booking_slip['business_email']?></span></p></td>
                                </tr>
                                <tr>
                                    <td style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;text-align: center;"><p style="font-size: 13px;">Date</p></td>
                                    <td style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;text-align: center;"><p style="font-size: 13px;">Amount (in INR)</p></td>
                                    
                                    <td colspan="4" style="border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;text-align: center;">Remarks</p></td>
                                    
                                </tr>
                                    <?php 
                                    if(!empty($booking_slip_details)){
                                        $rowCount=count($booking_slip_details);
                                        foreach($booking_slip_details as $key=>$booking_slip_detail){ ?>
                                        <tr>
                                            <td style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?= date('d-m-Y',strtotime($booking_slip_detail['start_date']))?></span></p></td>
                                            <td style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?= $booking_slip_detail['rate']?></span></p></td>
                                        <?php if($key==0){ ?>
                                            <td colspan="4" rowspan="<?= $rowCount + 1 ?>" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=$booking_slip['remarks']?></span></p></td>
                                   <?php }
                                        } ?>
                                        </tr>
                                    <?php }else{ ?>
                                        <tr>
                                            <td style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span>&nbsp;</span></p></td>
                                            <td style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span>&nbsp;</span></p></td>

                                            <td colspan="4" rowspan="2" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=$booking_slip['remarks']?></span></p></td> 
                                    
                                        </tr>
                                <?php  } ?>
                                  
                                <tr>
                                    <td style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;text-align: center;"><p style="font-size: 13px;"><span>Gross </span></p></td>
                                    <td style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=($booking_slip['amount_after_discount'] >0) ? $booking_slip['amount_after_discount'] : '' ?></span></p></td>
                                   
                                    
                                </tr>
                                <tr>
                                    <td style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;text-align: center;"><p style="font-size: 13px;"><span>Less : Concession</span></p></td>
                                    <td style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=($booking_slip['discount'] >0) ? $booking_slip['discount'] : '' ?></span></p></td>
                                    <td style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;text-align: center;"><p style="font-size: 13px;"><span>Payment Mode</span></p></td>
                                    <td style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;text-align: center;"><p style="font-size: 13px;"><span>Payment Date</span></p></td>
                                    <td colspan="2" style="border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;text-align: center;"><p style="font-size: 13px;"><span>Payment Reference</span></p></td>
                                    
                                </tr>
                                <tr>
                                    <td style="border-right: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;text-align: center;"><p style="font-size: 13px;"><span>Net</span></p></td>
                                    <td style="border-right: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=$booking_slip['total_rate']?></span></p></td>
                                    <?php if(!empty($payment_details_offline)){ ?>
                                        <td style="border-right: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span>Offline</span></p></td>
                                        <td style="border-right: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=date('d-m-Y',strtotime($payment_details_offline['created_ts'])) ?></span></p></td>
                                        <td style="border-right: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=$payment_details_offline['check_draft_no'] ?></span></p></td>
                                    <?php } ?>
                                    <?php if(!empty($payment_details_online)){ ?>
                                        <td style="border-right: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span>Online</span></p></td>
                                        <td style="border-right: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=date('d-m-Y',strtotime($payment_details_online['created_at'])) ?></span></p></td>
                                        <td style="border-right: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=$payment_details_online['txnid'] ?></span></p></td>
                                    <?php } ?>
                                    <td style="padding: 2px 8px;"><p style="font-size: 13px;"><span>&nbsp;</span></p></td>
                                    
                                </tr>
                                
                               
                                
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom:9px;padding-top: 9px;">
                            <p>Terms & Conditions :</p>

                            <ul style="font-size:13px ;">
                                <li>Your access to the above mentioned sports facility is allowed between <time> to <time> on the above mentioned date(s) only.</li>
                                <li>Loudspeakers are strictly prohibited.</li>
                                <li>Processions/gatherings are not allowed beyond the sports facility especially within the railway colony.</li>
                                <li>Blocking of the roads of the railway colony is strictly prohibited.</li>
                                <li>Construction neither temporary nor permanent is allowed within or outside the sports facility.</li>
                                <li>Commercial use of the WBSFDC utilities including the ground is strictly prohibited.</li>
                                <li>WBSFDC reserves the right to cancel this booking at any moment without any prior intimation. Under such circumstances you may need to vacate the sports facility immediately.  </li>
                                <li>WBSFDC reserves not to disclose the reason for cancellation of this booking.</li>
                                <li>Usage of plastics are prohibited </li>
                                <li>COVID protocols to be strictly followed.</li>
                              
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Please check the other terms & conditions in our website</p>
                        </td>
                    </tr>
                    


                </table>
            </td>
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
    </script>
</body>

</html>