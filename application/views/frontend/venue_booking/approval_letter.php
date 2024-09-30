<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Approval Letter</title>




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
                            <p>Date : <span><?=date('d-m-Y',strtotime($approval_letter['created_at'])) ?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom:9px;">
                        <p>To, </p>
                            <p><span><?=$approval_letter['contact_person_name']?> </span></p>
                            <p><span><?=$approval_letter['contact_person_designation']?></span></p> 
                            <p><span>To be reserved in favour of <?=($approval_letter['is_indivisual']==1)? 'Indivisual Name' : 'Business Name'?></span></p>
                            <p><span>Mailing Address : <?=($approval_letter['is_indivisual']==1)? $approval_letter['indivisual_full_address'] :  $approval_letter['business_full_address']?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom:9px;">
                            <p><span style="margin-right:20px ;">Sub  :</span>  Approval of Booking Request No. <span><?= str_pad($approval_letter['booking_id'],6,"0",STR_PAD_LEFT) ?></span> dated <span><?=date('d-m-Y',strtotime($approval_letter['created_at'])) ?></span> </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom:9px;">
                            <p style="margin-bottom: 15px;">Dear Sir / Madam,</p>

                            <p>We would like to inform you that, your request to book WBSFDC <?=$approval_letter['venue_names']?> with Booking Request No. <span><?= str_pad($approval_letter['booking_id'],6,"0",STR_PAD_LEFT) ?></span> dated <span><?=date('d-m-Y',strtotime($approval_letter['created_at'])) ?></span> has been approved by the competent authority. </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom:9px;"><p>The details of the Booking Request are as follows :</p></td>
                    </tr>

                    <tr>
                        <td>
                            <table style="width: 100%; border: #000 1px solid;" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td colspan="2" style="width: 33%; border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">Venue
                                    </p></td>
                                   
                                    <td colspan="4" style="width: 67%; border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=$approval_letter['venue_names']?></span></p></td>
                                   
                                    
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">Location </p></td>
                                    <td colspan="4" style="border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=$approval_letter['property_name']?></span></p></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">Address
                                    </p></td>
                                    <td colspan="4" style="border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=$approval_letter['property_address_line_1'] .' '.$approval_letter['property_address_line_2'] ?></span>
                                    </p></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">Booked in favour of
                                    </p></td>
                                    <td colspan="4" style="border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?= ($approval_letter['is_indivisual']==1)? $approval_letter['indivisual_full_name'] :  $approval_letter['business_full_name'] ?></span>
                                    </p></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">Mailing Address
                                    </p></td>
                                    <td colspan="4" style="border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=($approval_letter['is_indivisual']==1)? $approval_letter['indivisual_full_address'] :  $approval_letter['business_full_address']?></span>
                                    </p></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">Contact No.
                                    </p></td>
                                    <td colspan="4" style="border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=($approval_letter['is_indivisual']==1)? $approval_letter['indivisual_contact_no'] :  $approval_letter['business_contact_no'] ?></span>
                                    </p></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">e-mail ID
                                    </p></td>
                                    <td colspan="4" style="border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=($approval_letter['is_indivisual']==1)? $approval_letter['indivisual_email'] :  $approval_letter['business_email']?></span></p></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">To be Booked on
                                    </p></td>
                                    <td colspan="4" style="border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span><?=$approval_letter['start_date']?></span></p></td>
                                </tr>
                               <!-- <tr>
                                    <td colspan="2" style="border-right: #000 1px solid; border-bottom: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">No. of Day(s)
                                    </p></td>
                                    <td colspan="4" style="border-bottom: #000 1px solid;padding: 2px 8px;"><p style="font-size: 13px;"><span></span></p></td>
                                </tr> -->
                                 <tr>
                                    <td colspan="2" style="border-right: #000 1px solid;padding: 2px 8px;background-color: #d9d9d9;"><p style="font-size: 13px;">Total Payable Amount (in INR)
                                    </p></td>
                                    <td colspan="4" style="padding: 2px 8px;"><p style="font-size: 13px;"><span><?=$approval_letter['total_rate']?></span></p></td>
                                </tr>
                                                                                             
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom:9px;padding-top: 9px;">
                            <p>We request you to please login to WBTC portal and pay the aforesaid amount of <span><?=$approval_letter['total_rate']?></span> within <span>timestamp</span> to get the Booking Confirmed. </p>

                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom:9px;padding-top: 9px;">
                           <p>WBTC reserves the right to revoke this Booking Approval and may allot the sports facility on the same date to any other entity if the aforesaid amount is not paid within the above mentioned timeline.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom:9px;padding-top: 9px;">
                           <p>For any queries or clarification you may talk to us at <span title="as given in the master data for this sports facility">Contact No.</span> or <span title="as given in the master data for this sports facility">Contact No.</span> You may also send e-mail to us at <span title="as given in the master data for this sports facility">email ID</span> or <span title="as given in the master data for this sports facility">email ID</span>.</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <p>Please check the other terms & conditions in our website</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center ;"><p>(This is a computer generated document hence no signature is required)</p></td>
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