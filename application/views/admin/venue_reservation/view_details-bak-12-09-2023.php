
<style>
    .text-right{
        text-align: right;
    }

    .text-center{
        text-align: center;
    }

    .right-inner-addon i {
        position: absolute;
        right: 20px;
        top: 38px;
        pointer-events: none;
        font-size: 1.5em;
    }
    .right-inner-addon {
        position: relative;
    }
</style>
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Venue Reservation Details</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">

                        </div>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
                    <!--//col-auto-->
        </div>
                <!--//row-->

                
        <form class="settings-form" method="post" action="<?= base_url('admin/venue_reservation/submitreservation'); ?>" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" class="form-control" name="booking_id" value="<?= $reservation[0]['booking_id'] ?>" id="booking_id" readonly>
                <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
            
                <!-- <div class="app-card-body">     -->                   
                <div class="app-card app-card-settings shadow-sm p-3 mb-3">
                    <div class="app-card-header mb-3">
                        <div class="col-md-12 details_head">
                            <h5 class="text-info">Venue Details</h5>
                        </div>
                    </div>
                    <div class="app-card-body">
                        <div class="row g-2">
                            <div class="col-sm-12 col-md-4 col-lg-3">
                                <label for="" class="form-label">Location</label>
                                <input type="text" class="form-control" value="<?= $reservation[0]['property_name'] ?>" readonly>
                            </div>
                            <div class="col-sm-12 col-md-8 col-lg-9">
                                <label for="" class="form-label">Venue Name</label>
                                <input type="text" class="form-control" value="<?= $reservation[0]['venue_names'] ?>" readonly>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-3">
                                <label for="" class="form-label">Booking ID</label>
                                <input type="text" class="form-control" value="<?=$reservation[0]['booking_id']?>" readonly>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-5">
                                <label for="" class="form-label">Reservation Request Received on</label>
                                <input type="text" class="form-control" value="<?=date('d-m-Y H:i:s',strtotime($reservation[0]['created_at']))?>" readonly>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="" class="form-label">Booking Amount</label>
                                <input type="text" class="form-control" value="<?= $reservation[0]['total_rate'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="app-card app-card-settings shadow-sm p-3 mb-3">
                    <div class="app-card-header mb-3">
                        <div class="col-md-12 details_head">
                            <h5 class="text-info">Details of the Reservee </h5>
                        </div>
                    </div>
                    <div class="app-card-body">
                        <div class="row g-2">
                            <?php /*?><div class="col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Category </label>
                                <input type="text" class="form-control" value="<?= $reservation[0]['category_name'] ?>" readonly>
                            </div><?php */?>
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label"><?=($reservation[0]['is_indivisual']==1)? 'Individual Name' : 'Business Name'?> </label>
                                <input type="text" class="form-control" value="<?= ($reservation[0]['is_indivisual']==1)? $reservation[0]['indivisual_full_name'] :  $reservation[0]['business_full_name'] ?>" readonly>
                            </div>                                    
                            <div class="col-sm-12 col-md-4">                                        
                                <label for="" class="form-label">Contact No.</label>
                                <input type="text" class="form-control" value="<?= ($reservation[0]['is_indivisual']==1)? $reservation[0]['indivisual_contact_no'] :  $reservation[0]['business_contact_no']   ?>" readonly>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">e-mail ID</label>
                                <input type="email" class="form-control" value="<?= ($reservation[0]['is_indivisual']==1)? $reservation[0]['indivisual_email'] :  $reservation[0]['business_email']  ?>" readonly>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="" class="form-label">Mailing Address with PIN Code </label>
                                <textarea class="form-control" name="" id="" cols="" rows="3" readonly><?= ($reservation[0]['is_indivisual']==1)? $reservation[0]['indivisual_full_address'] :  $reservation[0]['business_full_address']?></textarea>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="" class="form-label">Purpose</label>
                                <textarea class="form-control" name="" id="" cols="" rows="3" readonly></textarea>
                            </div>
                            
                            <!--if individual this section will hide, visible if it is filled by organisation-->
                            <h5 class="mt-3 text-info">Contact Person Information</h5>
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" value="<?= ($reservation[0]['contact_person_name']) ?>" readonly>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">Contact No.</label>
                                <input type="number" class="form-control" value="<?= ($reservation[0]['contact_person_contact_no']) ?>" readonly>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">e-mail ID</label>
                                <input type="number" class="form-control" value="<?= ($reservation[0]['contact_person_email']) ?>" readonly>
                            </div> 
                            
                            <!-- <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">Designation</label>
                                <input type="text" class="form-control" value="<?= ($reservation[0]['contact_person_designation']) ?>" readonly>
                            </div> -->
                            
                        </div>
                    </div>
                </div> 

                <!--  <div class="app-card app-card-settings shadow-sm p-3 mb-3">
                    <div class="app-card-header mb-3">
                        <div class="col-md-12 details_head">
                            <h5 class="text-info"> Details</h5>
                        </div>
                    </div>
                    <div class="app-card-body">
                        <div class="row g-2">
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">Location </label>
                                <input type="text" class="form-control" value="<?= $reservation[0]['property_name'] ?>" readonly>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">Venue Name </label>
                                <input type="text" class="form-control" value="<?= $reservation[0]['venue_names'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div> -->

                <?php
                        if( $reservation[0]['is_agency']==1)
                        { ?>
                        <div class="app-card app-card-settings shadow-sm p-3 mb-3">
                        
                            <div class="app-card-header mb-3">
                                <div class="col-md-12 details_head">
                                    <h5 class="text-info">Agency Details </h5>
                                </div>
                            </div>
                            <div class="app-card-body">
                                <div class="row g-2">
                                    <div class="col-sm-12 col-md-4">
                                        <label for="" class="form-label">Name </label>
                                        <input type="text" class="form-control" value="<?= $reservation[0]['agency_full_name'] ?>" readonly>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label for="" class="form-label">Contact No.</label>
                                        <input type="text" class="form-control" value="<?=  $reservation[0]['agency_contact_no']  ?>" readonly>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label for="" class="form-label">e-mail ID</label>
                                        <input type="email" class="form-control" value="<?= $reservation[0]['agency_email'] ?>" readonly>
                                    </div>
                                    <div class="col-sm-12 col-md-8">
                                        <label for="" class="form-label">Mailing Address with PIN Code </label>
                                        <textarea class="form-control" name="" id="" cols="" rows="2" readonly><?=$reservation[0]['agency_full_address']?></textarea>
                                    </div>
                                    
                                        <?php
                                            if( $reservation[0]['agency_gst_no'])
                                            { 
                                        ?>
                                        <div class="col-sm-12 col-md-4">
                                            <label for="" class="form-label">GSTIN</label>
                                            <input type="email" class="form-control" value="<?= $reservation[0]['agency_gst_no'] ?>" readonly>
                                        </div>
                                        <?php
                                        }
                            }
                        ?>
                                </div>
                                
                            </div>
                            
                        </div>  
                        
            
            <div class="clearfix w-100"></div>
                <div class="app-card app-card-settings shadow-sm p-3 mb-3">
                    <div class="app-card-header mb-3">
                        <div class="col-md-12 details_head">
                            <h5 class="text-info">Payment Details</h5>
                        </div>
                    </div>
                    <div class="app-card-body">
                        <div class="row g-2">                                     
                            <div class="col-sm-12 mb-3">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered app-table-hover mb-0 text-left">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="cell text-center">Date </th>
                                                <th class="cell text-right">Payable for the day Amount (INR)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($reservation[0]['booking_details']) && $reservation[0]['booking_details']){
                                                foreach($reservation[0]['booking_details'] as $reservation_detail){ ?>
                                            <tr>
                                                <td class="cell text-center"><?=date('d-m-Y',strtotime($reservation_detail['start_date']))?> </td>
                                                <td class="cell text-right"><?= $reservation_detail['rate'] ?> </td>
                                            </tr>
                                            <?php } } ?>
                                            <tr>
                                                <td class="cell text-center"><b>Total Payable</b></td>
                                                <td class="cell text-right fw-bold"><?= $reservation[0]['total_rate'] ?> </td>
                                                <input type="hidden" class="form-control" id="total_rate" name="total_rate" value="<?= $reservation[0]['total_rate'] ?>">
                                                <input type="hidden" class="form-control" id="net_amount" name="net_amount" value="<?= $reservation[0]['total_rate'] ?>">
                                            </tr>
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-2 mb-2">
                                <label for="" class="col-form-label form-label">Remarks</label>
                            </div>
                            <div class="col-12 col-md-9 col-lg-10 mb-2">
                                <textarea class="form-control" id="remarks" name="remarks"><?= $reservation[0]['remarks'] ?></textarea>
                            </div>


                            <!-- <div class="row">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Remarks</label>
                                    <input type="text" class="form-control" id="remarks" name="remarks" value="<?= $reservation[0]['remarks'] ?>">
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>


                <!-- <div class="app-card app-card-settings shadow-sm p-3 mb-3">
                    <div class="app-card-header mb-3">
                        <div class="col-md-12 details_head">
                            <h5 class="text-info">History</h5>
                        </div>
                    </div>
                    <div class="app-card-body">
                        <div class="row g-2">
                            <div class="col-sm-12 mb-3">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered app-table-hover mb-0 small">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="cell" width="17%">Status Submitted Date-Time</th>
                                                <th class="cell" width="17%">Status</th>
                                                <th class="cell" width="17%">Status Changed By</th>
                                                <th class="cell" width="50%">Related Contents & Descriptions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="cell">09-09-2023 14:47</td>
                                                <td class="cell"><span class="badge bg-warning">Request In Waiting</span></td>
                                                <td class="cell">Admin</td>
                                                <td class="cell">
                                                    <p class="mb-1"><b class="me-3">Approval is valid till:</b> 09-09-2023 14:47</p>
                                                    <p class="mb-1"><b class="me-3">Approval Letter:</b> <a href="#." target="_blank">xxxxx_filenameXXX123.pdf <i class="fa fa-download"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cell">09-09-2023 14:47</td>
                                                <td class="cell"><span class="badge bg-info">Request Approved</span></td>
                                                <td class="cell">Admin</td>
                                                <td class="cell">
                                                    <p class="mb-1"><b class="me-3">Reject Reason:</b> lorem set dummy text lorem set dummy text</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cell">09-09-2023 14:47</td>
                                                <td class="cell"><span class="badge bg-danger">Request Rejected</span></td>
                                                <td class="cell">Admin</td>
                                                <td class="cell">
                                                    <p class="mb-1"><b class="me-3">NOC Letter:</b> <a href="#." target="_blank">xxxxx_filenameXXX123.pdf <i class="fa fa-download"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cell">09-09-2023 14:47</td>
                                                <td class="cell"><span class="badge bg-success">Confirmed</span></td>
                                                <td class="cell">Admin</td>
                                                <td class="cell">
                                                    <p class="mb-1"><b class="me-3">Approved by:</b> Name</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cell">09-09-2023 14:47</td>
                                                <td class="cell"><span class="badge bg-primary">Cancelled</span></td>
                                                <td class="cell">Admin</td>
                                                <td class="cell">
                                                    <p class="mb-1"><b class="me-3">Reject Reason:</b> lorem set dummy text lorem set dummy text</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cell">09-09-2023 14:47</td>
                                                <td class="cell"><span class="badge bg-danger">Approval Expired</span></td>
                                                <td class="cell">Admin</td>
                                                <td class="cell">
                                                    <p class="mb-1"><b class="me-3">Approval is valid till:</b> 09-09-2023 14:47</p>
                                                    <p class="mb-1"><b class="me-3">Approval Letter:</b> <a href="#." target="_blank">xxxxx_filenameXXX123.pdf <i class="fa fa-download"></i></a>
                                                    <p class="mb-1"><b class="me-3">Reject Reason:</b> lorem set dummy text lorem set dummy text</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cell">09-09-2023 14:47</td>
                                                <td class="cell"><span class="badge bg-info">Paid But Not Confirmed</span></td>
                                                <td class="cell">Admin</td>
                                                <td class="cell">
                                                    <p class="mb-1"><b class="me-3">Approval is valid till:</b> 09-09-2023 14:47</p>
                                                    <p class="mb-1"><b class="me-3">Approval Letter:</b> <a href="#." target="_blank">xxxxx_filenameXXX123.pdf <i class="fa fa-download"></i></a>
                                                    <p class="mb-1"><b class="me-3">Reject Reason:</b> lorem set dummy text lorem set dummy text</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cell">09-09-2023 14:47</td>
                                                <td class="cell"><span class="badge bg-danger">Request Expired</span></td>
                                                <td class="cell">Admin</td>
                                                <td class="cell">
                                                    <p class="mb-1"><b class="me-3">Approval is valid till:</b> 09-09-2023 14:47</p>
                                                    <p class="mb-1"><b class="me-3">Approval Letter:</b> <a href="#." target="_blank">xxxxx_filenameXXX123.pdf <i class="fa fa-download"></i></a>
                                                    <p class="mb-1"><b class="me-3">Reject Reason:</b> lorem set dummy text lorem set dummy text</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cell">09-09-2023 14:47</td>
                                                <td class="cell"><span class="badge bg-primary">Approval Revoked</span></td>
                                                <td class="cell">Admin</td>
                                                <td class="cell">
                                                    <p class="mb-1"><b class="me-3">Approval is valid till:</b> 09-09-2023 14:47</p>
                                                    <p class="mb-1"><b class="me-3">Approval Letter:</b> <a href="#." target="_blank">xxxxx_filenameXXX123.pdf <i class="fa fa-download"></i></a>
                                                    <p class="mb-1"><b class="me-3">Reject Reason:</b> lorem set dummy text lorem set dummy text</p>
                                                </td>
                                            </tr>                                        
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class=" app-card app-card-settings shadow-sm p-3">
                    <!-- <div class="app-card-header">
                        <div class="col-md-12 details_head">
                            <h5 class="text-info">Details of the Reservee </h5>
                        </div>
                    </div> -->
                    <div class="app-card-body">
                        <div class="row g-2">
                            <div class="col-12 mb-3 d-flex">
                                <label for="" class="form-label me-3">Current Status</label>
                                <!--<h4><?= ($reservation[0]['booking_status'] == 1) ? 'Request Approved' : (($reservation[0]['booking_status'] == 2)?'Request Rejected':(($reservation[0]['booking_status'] == 3)?'Confirmed':(($reservation[0]['booking_status'] == 4)?'Cancelled':(($reservation[0]['booking_status'] == 5)?'Approval Expired':(($reservation[0]['booking_status'] == 6)?'Paid But Not Confirmed':(($reservation[0]['booking_status'] == 7)?'Request Expired':(($reservation[0]['booking_status'] == 8)?'Approval Revoked':'Request In Waiting'))))))) ?></h4>-->
                                <span class="<?= (($reservation[0]['booking_status'] == 1) ? 'badge rounded-pill request-approved' : (($reservation[0]['booking_status'] == 2)?'badge rounded-pill request-reject':(($reservation[0]['booking_status'] == 3)?'badge rounded-pill status-confirmed':(($reservation[0]['booking_status'] == 4)?'badge rounded-pill status-cancelled':(($reservation[0]['booking_status'] == 5)?'badge rounded-pill approval-expired':(($reservation[0]['booking_status'] == 6)?'badge rounded-pill paid-not-confirm':(($reservation[0]['booking_status'] == 7)?'badge rounded-pill request-expire':(($reservation[0]['booking_status'] == 8)?'badge rounded-pill approval-revoke':'badge rounded-pill request-waiting')))))))) ?>"><?= ($reservation[0]['booking_status'] == 1) ? 'Request Approved' : (($reservation[0]['booking_status'] == 2)?'Request Rejected':(($reservation[0]['booking_status'] == 3)?'Confirmed':(($reservation[0]['booking_status'] == 4)?'Cancelled':(($reservation[0]['booking_status'] == 5)?'Approval Expired':(($reservation[0]['booking_status'] == 6)?'Paid But Not Confirmed':(($reservation[0]['booking_status'] == 7)?'Request Expired':(($reservation[0]['booking_status'] == 8)?'Approval Revoked':'Request In Waiting'))))))) ?></span>                            </div>
                        
                                <!-- <?php if($reservation[0]['payment_method'] == 'Offline' && $reservation[0]['booking_status'] == '3') { ?>
                                    <div class="col-sm-12 col-md-2 mb-3">
                                        <label for="" class="form-label me-3">Check Draft No</label>
                                        <h5><?= $payment_details_offline['check_draft_no']?></h5>
                                    </div>
                                    <div class="col-sm-12 col-md-2 mb-3">
                                        <label for="" class="form-label me-3">Branch Name</label>
                                        <h5><?= $payment_details_offline['branch_name']?></h5>
                                    </div>
                                    <div class="col-sm-12 col-md-2 mb-3">
                                        <label for="" class="form-label me-3">Bank Name</label>
                                        <h5><?= $payment_details_offline['bank_name']?></h5>
                                    </div>
                                    <div class="col-sm-12 col-md-2 mb-3">
                                        <label for="" class="form-label me-3">Check Draft Date</label>
                                        <h5><?= date('d-m-Y',strtotime($payment_details_offline['check_draft_date']))?></h5>
                                    </div>
                                <?php } ?>-->

                            <?php if($reservation[0]['payment_method'] == 'Online' && $reservation[0]['booking_status'] == '3') { ?>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="" class="form-label me-3"><h6>Transaction Id: </h6></label>
                                <b><?= $payment_details_online['txnid']?></b>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="" class="form-label me-3"><h6>Mihpay Id: </h6></label>
                                <b><?= $payment_details_online['mihpayid']?></b>
                            </div>
                            <?php if($reservation[0]['noc_uploaded_by'] != '') { ?>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 mb-3 noc_div">
                                        <label for="" class="form-label">NOC Letter Uploaded by</label>
                                        <input type="text" class="form-control" value="<?= $reservation[0]['approvedorRejected_by_name'] ?>" readonly>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3 noc_div">
                                        <label for="" class="form-label">NOC Letter Uploaded on</label>
                                        <input type="text" class="form-control" value="<?= date('d-m-Y H:i',strtotime($reservation[0]['noc_uploaded_at'])) ?>" readonly>
                                    </div>
                                </div>
                                <?php } ?> 
                            <?php } ?>

                            <div class="col-sm-12 col-md-4 mb-3" style="<?=(in_array($reservation[0]['booking_status'],array('0','3')) && $reservation[0]['is_event_started'] == 0)?'display:block;':'display:none;'?>">
                            <?php if($reservation[0]['booking_status'] == '0') 
                                {  
                                    $booked_dates='';
                                    if (isset($venue_booking_details) && ($venue_booking_details)) {
                                        if (count($venue_booking_details['details']) > 0) {
                                            foreach($venue_booking_details['details'] as $details){ 
                                                if (isset($details) && ($details)) {
                                                    foreach($details as $reservation_detail){ 

                                                   $start_date=$reservation_detail['start_date'];
                                                // Check if the start_date already exists in the booked_dates
                                               $formatted_start_date = date('d-m-Y', strtotime($start_date));

                                               if (strpos($booked_dates, $formatted_start_date) === false) {
                                                   // The start_date does not exist in booked_dates, so add it
                                                   if (!empty($booked_dates)) {
                                                       $booked_dates .= ', ';
                                                   }
                                                   $booked_dates .= $formatted_start_date;                                                 
                                                   // Save the updated booked_dates back to your database or source
                                                   // You should have a model or function to do this
                                               }
                                            }
                                        } 
                                    }?>
                                            <span class="text-danger"><b>You can't approve this booking due to get already approval for the mentioned date for other booking : <?=$booked_dates ?></b></span>

                                    <?php } 
                                        }}?> 
                                 <hr/>         
                                <label for="" class="form-label me-3">Status</label>
                                <!-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_0" value="0" checked>
                                    <label class="form-check-label" for="status_0">Pending</label>
                                </div> -->
                                <div>
                                        <div class="form-check form-check-inline" style="float:left; <?=($reservation[0]['booking_status'] == '0')?'display:block;':'display:none;'?>">
                                        <input class="form-check-input" type="radio" name="status" id="status_1" value="1"  <?=($reservation[0]['booking_status'] == '0')? 'required' : '' ?> <?= ($reservation[0]['booking_status'] == '1')?'checked':'' ?> <?= (isset($venue_booking_details) && ($venue_booking_details))?((count($venue_booking_details['details']) > 0)?'disabled':'') :'' ?>>
                                        <label class="form-check-label" for="status_1">Approve</label>
                                    </div>
                                   
                                    <div class="form-check form-check-inline" style="float:left; <?=($reservation[0]['booking_status'] == '0')?'display:block;':'display:none;'?>">
                                        <input class="form-check-input" type="radio" name="status" id="status_2" value="2" <?=($reservation[0]['booking_status'] == '0')? 'required' : '' ?> <?= ($reservation[0]['booking_status'] == '2')?'checked':'' ?>>
                                        <label class="form-check-label" for="status_2">Reject</label>
                                    </div>
                                    <div class="form-check form-check-inline" style="float:left; <?=(($reservation[0]['booking_status'] == '3' && $reservation[0]['is_event_started'] == 0))?'display:block;':'display:none;'?>">
                                        <input class="form-check-input" type="radio" name="status" id="status_4" value="4" <?=($reservation[0]['booking_status'] == '3')? 'required' : '' ?> <?= ($reservation[0]['booking_status'] == '4')?'checked':'' ?>>
                                        <label class="form-check-label" for="status_4">Cancel</label>
                                    </div>
                                </div>                             
                            </div> 

                        

                            <div class="col-sm-12 col-md-8 mb-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 mb-3 approve_div right-inner-addon" style="<?= ($reservation[0]['booking_status'] == '1')?'display: block;':'display: none;' ?>">
                                        <label for="" class="form-label">Aprroval is Valid till	</label>
                                        <input type="text" id="approval_valid_till" name="approval_valid_till" class="form-control" value="<?= ($reservation[0]['approval_valid_till'])? date('d-m-Y H:i',strtotime($reservation[0]['approval_valid_till'])) : date('d-m-Y H:i') ?>" <?= ($reservation[0]['booking_status'] == '3')?'readonly':'' ?>>
                                        <i class="fa fa-calendar"></i>
                                    </div>

                                        <div class="col-sm-12 col-md-6 mb-3" id="fileInput" style="display: none;">
                                            <label for="userfile" class="form-label">Upload Approval Letter <span class="small text-success">(.pdf extension file only)</span> <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="userfile" id="approval_lt" accept=".pdf"  <?=($reservation[0]['booking_status'] == '0')? 'required' : '' ?>>
                                        </div>
                                    <!--<div class="col-sm-12 col-md-6 mb-3 approve_div" style="<?= ($reservation[0]['booking_status'] == '1')?'display: block;':'display: none;' ?>">
                                        <label for="" class="form-label">Payment Method	</label>
                                        <select name="payment_method" id="payment_method" class="form-select" <?= ($reservation[0]['booking_status'] == '0')?'':'disabled' ?>> 
                                            <option value="" selected disabled>Select Payment Method</option>
                                            <option value="Online" <?=($reservation[0]['payment_method'] == 'Online')?'selected':''?>>Online</option>
                                            <option value="Offline" <?=($reservation[0]['payment_method'] == 'Offline')?'selected':''?>>Offline</option>
                                        </select> 
                                        
                                    </div>-->
                                </div>

                                    
                                    <?php if( $reservation[0]['booking_status'] == '6') { ?>
                                        <div class="row">
                                        <input type="hidden" name="booking_status" value="<?=$reservation[0]['booking_status']?>">
                                    <!-- File upload input that accepts all file types -->
                                        <div class="col-sm-12 col-md-6 mb-3" id="nocFileInput">
                                            <label for="nocfile" class="form-label">Upload NOC Letter <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control"  name="nocfile" <?=($reservation[0]['booking_status'] == '6')? 'required' : '' ?>>
                                        </div>
                                        </div> 
                                    <?php } ?>


                                <div class="row">
                                    
                                    <?php if($reservation[0]['approved_by'] != '' && $reservation[0]['booking_status'] == '1') { ?>
                                    
                                    <div class="col-sm-12 col-md-6 mb-3 approve_div">
                                        <label for="" class="form-label">Approved by</label>
                                        <input type="text" class="form-control" value="<?= $reservation[0]['approvedorRejected_by_name'] ?>" readonly>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3 approve_div">
                                        <label for="" class="form-label">Approved on</label>
                                        <input type="text" class="form-control" value="<?= date('d-m-Y H:i',strtotime($reservation[0]['approved_ts'])) ?>" readonly>
                                    </div>

                                    <?php } ?>
                                    <div class="col-sm-12 col-md-12 mb-3 reject_div" style="<?= ($reservation[0]['booking_status'] == '2')?'display: block;':'display: none;' ?>">
                                        <label for="" class="form-label">Reason </label>
                                        <textarea name="rejection_reason" id="rejection_reason" cols="" rows="4" class="form-control" placeholder="Reason"><?= $reservation[0]['rejection_reason'] ?></textarea>
                                    </div>

                                    <?php if($reservation[0]['rejected_by'] != '' && $reservation[0]['booking_status'] == '2') { ?>
                                        <div class="col-sm-12 col-md-6 mb-3 reject_div">
                                            <label for="" class="form-label">Rejected by</label>
                                            <input type="text" class="form-control" value="<?= $reservation[0]['approvedorRejected_by_name'] ?>" readonly>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-3 reject_div">
                                            <label for="" class="form-label">Rejected on</label>
                                            <input type="text" class="form-control" value="<?= date('d-m-Y H:i',strtotime($reservation[0]['rejected_ts'])) ?>" readonly>
                                        </div>
                                    <?php } ?> 

                                </div> 

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 mb-3 cancellation_div" style="<?= !empty($reservation[0]['cancellation_reason'])?'display: block;':'display: none;' ?>">
                                        <label for="" class="form-label">Reason of Cancellation </label>
                                        <textarea name="cancellation_reason" id="cancellation_reason" cols="" rows="4" class="form-control" placeholder="Reason of Cancellation"><?= $reservation[0]['cancellation_reason'] ?></textarea>
                                    </div>
                                    <?php if($reservation[0]['cancelled_by'] != '' && $reservation[0]['booking_status'] == '4') { ?>
                                        <div class="col-sm-12 col-md-6 mb-3 cancel_div">
                                            <label for="" class="form-label">Cancelled by </label>
                                            <input type="text" class="form-control" value="<?= $reservation[0]['approvedorRejected_by_name'] ?>" readonly>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-3 cancel_div">
                                            <label for="" class="form-label">Cancelled on</label>
                                            <input type="text" class="form-control" value="<?= date('d-m-Y H:i',strtotime($reservation[0]['cancelled_ts'])) ?>" readonly>
                                        </div>
                                    <?php } ?> 
                                </div>
                                <?php if($reservation[0]['revoked_by'] != '' && $reservation[0]['booking_status'] == '8') { ?>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 mb-3 revoke_div">
                                            <label for="" class="form-label">Revoked by</label>
                                            <input type="text" class="form-control" value="<?= $reservation[0]['approvedorRejected_by_name'] ?>" readonly>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-3 revoke_div">
                                            <label for="" class="form-label">Revoked on</label>
                                            <input type="text" class="form-control" value="<?= date('d-m-Y H:i',strtotime($reservation[0]['revoked_ts'])) ?>" readonly>
                                        </div>
                                    </div>
                                    <?php } ?> 
                            </div>
                        </div>
                    </div>


                    <div class="accordion mb-3" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <h5 class="text-info mb-0">View Reservation Summary</h5>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered app-table-hover mb-0 small">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="cell" width="17%">Status Submitted Date-Time</th>
                                                    <th class="cell" width="17%">Status</th>
                                                    <th class="cell" width="17%">Status Changed By</th>
                                                    <th class="cell" width="50%">Related Contents & Descriptions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                        if(!empty($booking_status_history)){
                                            /*echo '<pre>';
                                            print_r($booking_status_history);
                                            die;*/
                                        foreach($booking_status_history as $history) {  ?>
                                                <tr>
                                                    <td class="cell"><?=date('d-m-Y H:i:s',strtotime($history->vbsm_created_ts))?></td>
                                                    <td class="cell"><span class="<?= (($history->vbsm_status == 1) ? 'badge rounded-pill request-approved' : (($history->vbsm_status == 2)?'badge rounded-pill request-reject':(($history->vbsm_status == 3)?'badge rounded-pill status-confirmed':(($history->vbsm_status== 4)?'badge rounded-pill status-cancelled':(($history->vbsm_status== 5)?'badge rounded-pill approval-expired':(($history->vbsm_status == 6)?'badge rounded-pill paid-not-confirm':(($history->vbsm_status == 7)?'badge rounded-pill request-expire':(($history->vbsm_status == 8)?'badge rounded-pill approval-revoke':'badge rounded-pill request-waiting')))))))) ?>"><?= ($history->vbsm_status == 1) ? 'Request Approved' : (($history->vbsm_status== 2)?'Request Rejected':(($history->vbsm_status == 3)?'Confirmed':(($history->vbsm_status== 4)?'Cancelled':(($history->vbsm_status == 5)?'Approval Expired':(($history->vbsm_status == 6)?'Paid But Not Confirmed':(($history->vbsm_status == 7)?'Request Expired':(($history->vbsm_status == 8)?'Approval Revoked':'Request In Waiting'))))))) ?></span></td>
                                                    <td class="cell"><?=$history->action_by_name?></td>
                                                    <td class="cell">
                                                        <?php if($history->vbsm_status==1){ ?>
                                                        <p class="mb-1"><b class="me-3">Approval is valid till:</b><?= date('d-m-Y H:i:s',strtotime($history->approval_valid_till)) ?></p>
                                                        <p class="mb-1"><b class="me-3">Approval Letter:</b> <a href="<?= base_url($history->approval_letter_filepath) ?>" target="_blank"><?=$history->approval_letter_filename?><i class="fa fa-download"></i></a>
                                                    <?php } else if($history->vbsm_status==3) { ?>
                                                    <p class="mb-1"><b class="me-3">Uploaded At:</b><?= date('d-m-Y H:i:s',strtotime($history->noc_uploaded_at)) ?></p>
                                                        <p class="mb-1"><b class="me-3">NOC Letter:</b> <a href="<?= base_url($history->noc_file_path) ?>" target="_blank"><?=$history->noc_file_name ?><i class="fa fa-download"></i></a>
                                                    <?php  } else{ ?>
                                                        <p class="mb-1"></p>
                                                        <p class="mb-1"></p>
                                                        <?php } ?>
                                                        </td>
                                                </tr>
                                                <?php }} ?>                                  
                                            </tbody>
                                        </table> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if($reservation[0]['booking_status'] == '0' || $reservation[0]['booking_status'] == '1' || $reservation[0]['booking_status'] == '3'  || $reservation[0]['booking_status'] == '6') { ?> 
                    <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                    <?php } ?>
                    <?php if($reservation[0]['booking_status'] == '1') { ?> 
                    <button type="button" class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#revokeModal" id="revoke">REVOKE APPROVAL</button>
                    <?php } ?>
                    <a href="<?=base_url('admin/venue_reservation')?>" class="btn app-btn-secondary">Go Back</a>
                </div>

                <!--  <div class="app-card app-card-settings shadow-sm p-3">
                    <div class="app-card-header">
                        <div class="col-md-12 details_head">
                            <h5 class="text-info">Details of the Reservee </h5>
                        </div>
                    </div>
                    <div class="app-card-body">
                        <div class="row g-3">

                        </div>
                    </div>
                </div> -->

                    
            <!-- </div> -->
                
                <!-- </div> -->
                

            
        </form>

    </div>
</div>
        <!--//container-fluid-->
<div class="modal fade" id="revokeModal" tabindex="-1" role="dialog" aria-labelledby="revokeModalLabel" aria-hidden="true">
    <form method="post" id="revokeModalForm" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reason for revoke approval</h5>
                    <button type="button" class="close btn btn-danger text-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 10px;">
                
                    <div class="row">
                        <div class="col-sm-12 col-md-12 mb-3">
                        <label for="" class="form-label">Reason</label>
                            <textarea class="form-control" name="revokeReason" id="revokeReason"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button  class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                    <!-- <button type="button" class="btn btn_visitor_book">Submit</button> -->
                    <button class="btn app-btn-primary" id="submit_request" type="button" href="#." >Submit Request</button>
                </div>
            </div>
        </div>
    </form>
</div>
        <script>

            $(document).ready(function(){ 
                var status = "<?=$reservation[0]['booking_status']?>";
                if(status != '0'){
                    calculate_total();
                }

                $('#approval_valid_till').datetimepicker({ 
                    format:'d-m-Y H:i',
                    minDate: new Date(),
                    maxDate: "<?= $reservation[0]['booking_details'][0]['start_date'] ?>"
                });


                $(document).on('click','#submit_request', function() {
                var booking_id=$('#booking_id').val();   
                var reason=$('#revokeReason').val(); 
                var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";
                let data = {
                    booking_id: booking_id,
                    status:status,   
                    reason:reason,                                     
                    "<?= $this->security->get_csrf_token_name(); ?>": csrf_token
                };
                $.ajax({
                    url: "<?=base_url('admin/venue_reservation/updateRevokeApprovalStatus')?>",
                    cache: false,
                    type: "POST",
                    data: data,
                    dataType: "JSON",
                    success: function(res){
                        $('#revokeModal').modal('hide');
                        window.location.replace("<?= base_url('admin/venue_reservation')?>");

                    }
                });
    }); 
                
            })
            $("input[name='status']").change(function(){
                var status = $(this).val();
                var fileInput = $("#fileInput"); // Replace with your file input field's ID
                var approval_lt=$('#approval_lt');
                if(status == '1'){ 
                        $(".approve_div").show();
                        // Show file upload input and set validation rules
                        fileInput.show();
                        approval_lt.prop('required', true);

                        // Allow only PDF files
                        approval_lt.attr('accept', '.pdf');

                        $(".reject_div").hide();
                        $('#approval_valid_till').datetimepicker({ 
                            format:'d-m-Y H:i',
                            minDate: new Date()
                        });
                        
                } else if(status == '2'){
                    $(".approve_div").hide();
                    fileInput.hide();
                    approval_lt.prop('required', false);
                    approval_lt.val(''); // Clear the file input
                        $(".reject_div").show();
                        $("#discount").val(0);
                        calculate_total();

                } else if(status == '4'){
                    $(".approve_div").hide();
                    fileInput.hide();
                    approval_lt.prop('required', false);
                    approval_lt.val(''); // Clear the file input
                    $(".reject_div").hide();
                    $(".cancellation_div").show();
                    calculate_total();

                } 
                
                else{
                    $(".approve_div").hide();
                    fileInput.hide();
                    fileInput.prop('required', false);
                    fileInput.val(''); // Clear the file input
                        $(".reject_div").hide();
                }
            })

            $(".calculate_total").keyup(function(){
                calculate_total();
                
            })

            function calculate_total(){
                var total_rate = $("#total_rate").val();
                var discount = $("#discount").val();
                var gst_amount = $("#gst_amount").val();
                var status = "<?=$reservation[0]['booking_status']?>";
                //var organization_type = $("#organization_type").val();

                if(Number(discount) > Number(total_rate)){

                    $.alert({
                        type:'red',
                        title: 'Alert!',
                        content: 'Discount should not greater than total amount'
                    });

                    return false;
                }

                var amount_after_discount = parseFloat(Number(total_rate) - Number(discount)).toFixed(2);
                $("#amount_after_discount").val(amount_after_discount);
                $("#amount_after_discount_txt").text(amount_after_discount);
                var net_amount = parseFloat(Number(amount_after_discount) + Number(gst_amount)).toFixed(2);
                $("#net_amount").val(net_amount);
                $("#net_amount_txt").text(net_amount);
                
                if(status == '0'){

                    
                    if(net_amount == 0){
                        // $("#payment_method").val('Offline'); 
                        // $("#payment_method").attr('disabled',true);
                        $("#remarks").attr('required',true);
                    } else {
                        $("#payment_method").val('');
                        $("#payment_method").attr('disabled',false);
                    }

                }
                
            }

        </script>