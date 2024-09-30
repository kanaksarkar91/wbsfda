<!DOCTYPE html>
<html>

<head>
    <!-- ============================ INVOICE START ================================== -->
    <style type="text/css">
        .container {
            width: 100%;
            height: 100% !important;
            overflow: scroll;
            margin: 10px;
        }

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
        b {
            font-size: 11px;
            line-height: 1.5;
            font-family: Arial, Helvetica, sans-serif;
        }

        /*img {
            -webkit-filter: grayscale(100%);
            filter: grayscale(100%);
    }*/
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
            margin-bottom: 5px;
        }

        table tr {
            border: 0;
        }

        table tr td,
        table tr th {
            border: 1px solid #000;
            padding: 2px 5px;
        }

        p,
        small {
            padding: 0;
        }

        h5.dashboard-title {
            font-size: 13px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tr-single-box">
                    <div class="tr-single-header align-items-center justify-content-between">
                        <h5 class="dashboard-title">View Invoice</h5>
                    </div>
                    <div>

                        <div class="detail-wrapper padd-top-30 padd-bot-30">
                            <table class="noBorder-table border-0 mb-3 w-100 table-sm table-bordered">
                                <tr>
                                    <td style="border:0;"><img src="https://panchayet.syscentricdev.com/public/frontend_assets/images/West_Bengal_logo.jpg" width="68"></td>
                                    <td align="right" style="border:0;">
                                        <h5>PNRD Tourism</h5>
                                        <h5>Department of Panchayats &amp; Rural Development</h5>
                                        <p class="mb-0">
                                            Government of West Bengal<br> GSTIN No : 19AAABB1234C5DE
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <table class="noBorder-table border-0 mb-3 w-100 table-sm table-bordered">
                                <tr>
                                    <td align="center" style="border:0;">
                                        <strong><u>e-Ticketing Service</u></strong>
                                        <p>Electronic Reservation Slip (Personal User)</p>
                                    </td>
                                </tr>
                            </table>
                            <table class="mb-3 w-100 table-sm table-bordered">
                                <tr>
                                    <th width="15%">Booking No.</th>
                                    <td width="35%"><?= $booking_details['booking_no'] ?></td>
                                    <th width="15%">Booking Date</th>
                                    <td width="35%"><?= date('d/m/Y', strtotime($booking_details['created_ts'])) ?></td>
                                </tr>
                            </table>
                            <table class="mb-3 w-100 table-sm table-bordered">
                                <tr>
                                    <th width="15%">Booked by</th>
                                    <td width="35%"><?= $customer_details['customer_title'] . ' ' . $customer_details['first_name'] . ' ' . $customer_details['middle_name'] . ' ' . $booking_details['last_name'] ?></td>
                                    <th width="15%">Mobile No</th>
                                    <td width="35%"><?= $customer_details['mobile_country_code'] . ' ' . $customer_details['mobile'] ?></td>
                                </tr>
                                <tr>
                                    <th width="15%">Address</th>
                                    <td width="35%"><?= $customer_details['address'] ?></td>
                                    <th width="15%">Email</th>
                                    <td width="35%"><?= $customer_details['email'] ?></td>
                                </tr>
                                <tr>
                                    <th width="15%">Pincode</th>
                                    <td width="35%"><?= $customer_details['pincode'] ?></td>
                                    <th width="15%">State</th>
                                    <td width="35%"><?= $customer_details['state_name'] ?></td>
                                </tr>
                                <tr>
                                    <th width="15%">City</th>
                                    <td width="35%"><?= $customer_details['city'] ?></td>
                                    <th width="15%">Country</th>
                                    <td width="35%"><?= $customer_details['country_name'] ?></td>
                                </tr>
                            </table>
                            <h5 class="mb-2">Property Details</h5>
                            <table class="mb-3 w-100 table-sm table-bordered">
                                <tr>
                                    <th>Name</th>
                                    <td colspan="3"><?= $booking_details['property_name'] . ', ' . $booking_details['property_district_name'] ?></td>
                                </tr>
                                <tr>
                                    <th>Address 1</th>
                                    <td><?= $booking_details['property_address1'] ?></td>
                                    <th>Address 2</th>
                                    <td><?= $booking_details['property_address2'] ?></td>
                                </tr>
                                <tr>
                                    <th>Contact No. 1</th>
                                    <td>+91-<?= $booking_details['property_phone_no'] ?> ( Manager )</td>
                                    <th>Contact No. 2</th>
                                    <td>+91-<?= $booking_details['property_mobile_no'] ?></td>
                                </tr>
                                <tr>
                                    <th>Check-in</th>
                                    <td><?= date('d F Y', strtotime($booking_details['check_in'])) ?> ( from 09:00 Hrs)</td>
                                    <th>Check-out</th>
                                    <td><?= date('d F Y', strtotime($booking_details['check_out'])) ?> ( until 08:00 Hrs)</td>
                                </tr>
                            </table>

                            <h5 class="mb-2">Payment details</h5>
                            <table class="mb-3 w-100 table-sm table-bordered">
                                <tr>
                                    <th>From</th>
                                    <th>To</th>
                                    <th colspan="2">Room(s) / Family</th>
                                    <th>Total</th>
                                    <th>Discount / Deduction</th>
                                    <!-- <th>Discount Type</th> -->
                                    <th>Net Amount</th>
                                    <th>Cancellation Charge</th>
                                    <th>Status</th>
                                </tr>
                                <tr>
                                    <th>Room Type</th>
                                    <th colspan="6"><?= $booking_details['accommodation_name'] . ',' . $booking_details['accomm_desc'] ?></th>
                                    <th>Tariff (Per Night)</th>
                                    <th><?= $booking_details['room_rate'] ?></th>
                                </tr>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($booking_details['in_date'])) ?></td>
                                    <td><?= date('d/m/Y', strtotime($booking_details['out_date'])) ?></td>
                                    <td>Adult : <?= $booking_details['adults'] ?></td>
                                    <td>Children : <?= $booking_details['children'] ?></td>
                                    <td><?= $booking_details['room_taxable_amount'] ?></td>
                                    <td><?= $booking_details['room_discount_amount'] ?> (<?= $booking_details['room_discount_percent'] ?> %)</td>
                                    <!-- <td>Cancer</td> -->
                                    <td><?= $booking_details['room_net_amount'] ?></td>
                                    <td>&nbsp;</td>
                                    <td><?= ($booking_details['booking_status'] == 'I') ? 'Initiate' : (($booking_details['booking_status'] == 'A') ? 'Approved' : (($booking_details['booking_status'] == 'C') ? 'Cancelled' : 'Check out')) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="9"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Total Room Charges</td>
                                    <td colspan="2"><?= $booking_details['no_of_accomm'] ?></td>
                                    <td><?= ($booking_details['room_rate'] * $booking_details['no_of_accomm']) ?></td>
                                    <td><?= $booking_details['room_discount_amount'] ?></td>
                                    <td>&nbsp;</td>
                                    <td><?= $booking_details['room_net_amount'] ?></td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                            <table class="mb-3 w-100 table-sm table-bordered">
                                <tr>
                                    <th colspan="2">Mode of Payment</th>
                                    <th>&nbsp;</th>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                                <tr>
                                    <td><?= $booking_payment_listing['payment_mode'] ?></td>
                                    <td>Online</td>
                                    <td>PayU</td>
                                    <td><?= $booking_payment_listing['transaction_ref_id'] ?></td>
                                    <td><?= $booking_payment_listing['amount'] ?></td>
                                    <td><?= date('d/m/Y H:i:s', strtotime($booking_payment_listing['payment_date'])) ?></td>
                                </tr>
                            </table>
                            <h5 class="mb-2">Guest Details</h5>
                            <table class="mb-3 w-100 table-sm table-bordered">
                                <tr>
                                    <th>Sl No</th>
                                    <th>Name</th>
                                    <th>Family</th>
                                    <th>Age</th>
                                    <th>&nbsp;</th>
                                    <th>Sex</th>
                                    <th>ID Type</th>
                                    <th>ID No</th>
                                </tr>
                                <?php foreach ($guest_details as $guest) {
                                    $i = 1;
                                ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $guest['name'] ?></td>
                                        <td><?= $guest['relation'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($guest['dob'])) ?></td>
                                        <td>&nbsp;</td>
                                        <td><?= $guest['gender'] ?></td>
                                        <td><?= (($guest['document_type'] == 1) ? 'Aadhar Card' : ($guest['document_type'] == 2 ? 'Voter Card' : ($guest['document_type'] == 3 ? 'Driving Licence' : ($guest['document_type'] == 4 ? 'Pan Card' : 'Passport')))) ?></td>
                                        <td><?= $guest['document_no'] ?></td>
                                    </tr>
                                <?php
                                    $i++;
                                } ?>
                            </table>
                            <h4 class="mb-2">Terms & conditions</h4>
                            <h5 class="my-3"><strong>Terms & Conditions for Guest House/ Homestay Tourism Properties</strong></h5>
                            <h6><strong>A. Reservation Rules</strong></h6>
                            <ol>
                                <li><strong>Please Follow the Restriction Imposed and Guidelines as Being Issued Time to Time By the Government and Local Authorities of the
                                        District Before Booking.</strong></li>
                                <li> During check-in time all guest will have to produce an identity card (Voter Identity card / Passport / Pan Card/ Driving License/Photo ID card issued by Central / State Govt. for their employees etc.) in original
                                    as mentioned in reservation slip. The guest will also record relationship with accompanying members during check in</li>
                                <li>The booking at the chosen Property is not transferable and is valid only if one of the ID cards noted above is presented during the check in. The guest should carry with him/her a print out of the e-reservation
                                    slip.
                                </li>
                                <li>Two children below 8-years of age may stay with parents without additional room tariff subject to size of the room booked. Extra bed is available on additional payment, subject to availability of space in room.
                                </li>
                                <li>Guest House/ Homestay owner will not be liable for non-availability of amenities / services caused by irreparable technical faults or natural calamity.
                                </li>
                                <li>Due to the ongoing renovation work at the Guest House/ Homestay, we deeply regret the inconvenience that you might face during your stay.</li>
                                <li>Please do not pay any tips to the staffs of the Guest House/ Homestay.</li>
                                <li><strong><u>Pet are not allowed in any Tourism Property</u></strong></li>
                            </ol>
                            <h6><strong>B. Tax Rules</strong></h6>
                            <ol>
                                <li>GST-12% with Full ITC to be paid on spot during check-in (When Room rent between Rs. 1,001/- to Rs. 7500/- per day)</li>
                                <li>. GST-18% with Full ITC to be paid on spot during check-in (When Room rent between Rs. 7,501/- and above per day</li>
                                <li>As per notification 30/09/2019 with effect from 1/10/2019</li>
                            </ol>
                            <h6><strong>C. Extra Charges</strong></h6>
                            <ol>
                                <li>Extra charges if any will be levied at the spot</li>
                            </ol>
                            <h6><strong>D. Special Cases</strong></h6>
                            <ol>
                                <li>Dynamically provided by Property owner T&C</li>
                            </ol>
                            <h6><strong>E. Cancellation Policy</strong></h6>
                            <ol>
                                <li>Reservation may be cancelled by the guest through this portal (<strong>only for online payments made by an Indian citizen)</strong>. The amount of refund will be reversed to the debit/credit card/bank account after
                                    deducting the cancellation charges as per policy.</li>
                                <li>Reservation may be cancelled in case of acute administrative requirement. No cancellation charge will be deducted under such scenario.</li>
                                <li>Refund admissible only upon production of the original reservation slip.</li>
                            </ol>
                            <p><strong>*** All the calculation of cancellation will be based from Check-in date & time.</strong></p>

                        </div>
                        <div>&nbsp;<br></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================ INVOICE END ================================== -->
</body>

</html>