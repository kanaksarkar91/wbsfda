<link rel="stylesheet" href="<?= base_url('public/admin_assets/plugins/sweetalert2/sweetalert2.min.css');?>">
<style>
    .error{
        color:#CC0000 !important;
    }
</style>
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

        <?php if ($this->session->flashdata('success_msg')) : ?>
            <div class="alert alert-success">
                    <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                <?= $this->session->flashdata('success_msg') ?>
            </div>
        <?php endif ?>
        <?php if ($this->session->flashdata('error_msg')) : ?> 
            <div class="alert alert-danger">
                <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                <?= $this->session->flashdata('error_msg') ?>
            </div>
        <?php endif ?>

        <div class="row g-3 mb-2 align-items-center justify-content-between">
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
                                <input type="text" class="form-control" value="<?= $reservation[0]['net_amount'] ?>" readonly>
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
                            <div class="col-sm-12 col-md-12">
                                <label for="" class="form-label">Mailing Address with PIN Code </label>
                                <textarea class="form-control" name="" id="" cols="" rows="3" readonly><?= ($reservation[0]['is_indivisual']==1)? $reservation[0]['indivisual_full_address'] :  $reservation[0]['business_full_address']?></textarea>
                            </div>
                            <!--<div class="col-sm-12 col-md-6">
                                <label for="" class="form-label">Purpose</label>
                                <textarea class="form-control" name="" id="" cols="" rows="3" readonly><?= ($reservation[0]['is_indivisual']==1)? $reservation[0]['indivisual_purpose'] :  $reservation[0]['business_purpose']?></textarea>
                            </div>-->
                           <?php   if( $reservation[0]['is_indivisual']==0)
                            { ?>
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
                                <input type="email" class="form-control" value="<?= ($reservation[0]['contact_person_email']) ?>" readonly>
                            </div> 
                         <?php }?>   
                            <!-- <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">Designation</label>
                                <input type="text" class="form-control" value="<?= ($reservation[0]['contact_person_designation']) ?>" readonly>
                            </div> -->
                            
                        </div>
                    </div>
                </div> 
                <div class="clearfix w-100"></div>
                <!-- <div class="app-card app-card-settings shadow-sm p-3 mb-3"> -->
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
                                        
                                </div>                                
                            </div>                            
                        </div>  
                        <?php
                                        }
                            }
                        ?>
                <!-- </div>    -->          
            
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
                                                <th class="cell text-center">Date</th>
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
                                                <td class="cell text-center fw-bold">Total Amount</td>
                                                <td class="cell text-right fw-bold"><?= $reservation[0]['total_rate'] ?> </td>
                                            </tr>
                                            <tr><td class="cell text-center fw-bold">GST Amount(<?=$reservation[0]['gst_percentage']  ?>%)</td>
                                                <td class="cell text-right fw-bold"><?=$reservation[0]['gst_amount']  ?></td>
                                            </tr>
                                            <tr style="background: #4fd8f4;font-size: 1.1rem;"><td class="cell text-center fw-bold">Total Payable Amount</td>
                                            <td class="cell text-right fw-bold"><?=$reservation[0]['net_amount']?></td>
                                            </tr>
											<tr><td class="cell text-center fw-bold">Advance Paid</td>
                                                <td class="cell text-right fw-bold"><?= number_format((float)($reservation[0]['advance_amount']), 2, '.', '');  ?></td>
                                            </tr>
											<tr><td class="cell text-center fw-bold">Outstanding Amount</td>
                                                <td class="cell text-right fw-bold"><?php if($reservation[0]['advance_amount'] == '0' || $reservation[0]['advance_amount'] == '0.00'){ echo '0.00'; } else { echo number_format((float)($reservation[0]['net_amount'] - $reservation[0]['advance_amount']), 2, '.', ''); } ?></td>
                                            </tr>
                                            <tr>
                                                <input type="hidden" class="form-control" id="total_rate" name="total_rate" value="<?= $reservation[0]['total_rate'] ?>">
                                                <input type="hidden" class="form-control" id="net_amount" name="net_amount" value="<?= $reservation[0]['net_amount'] ?>">
                                                <input type="hidden" class="form-control" id="gst_amount" name="gst_amount" value="<?= $reservation[0]['gst_amount'] ?>">
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-2 mb-2">
                                <label for="" class="col-form-label form-label">Remarks</label>
                            </div>
                            <div class="col-12 col-md-9 col-lg-10 mb-2">
                                <textarea class="form-control" id="remarks" rows="2" name="remarks"><?= $reservation[0]['remarks'] ?></textarea>
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

                <?php if(empty($_GET['type'])){ ?>

                        <div class="app-card app-card-settings shadow-sm p-3">
                            <!-- <div class="app-card-header">
                                <div class="col-md-12 details_head">
                                    <h5 class="text-info">Details of the Reservee </h5>
                                </div>
                            </div> -->
                            <div class="app-card-body">
                                <div class="row g-2">
                                    <div class="col-12 mb-3">
                                        <div class="d-flex">                                
                                            <label for="" class="form-label me-3">Current Status</label>
                                            <!--<h4><?= ($reservation[0]['booking_status'] == 1) ? 'Request Approved' : (($reservation[0]['booking_status'] == 2)?'Request Rejected':(($reservation[0]['booking_status'] == 3)?'Confirmed':(($reservation[0]['booking_status'] == 4)?'Cancelled':(($reservation[0]['booking_status'] == 5)?'Approval Expired':(($reservation[0]['booking_status'] == 6)?'Paid But Not Confirmed':(($reservation[0]['booking_status'] == 7)?'Request Expired':(($reservation[0]['booking_status'] == 8)?'Approval Revoked':'Request In Waiting'))))))) ?></h4>-->
                                            <div>
                                            <span class="<?= (($reservation[0]['booking_status'] == 1) ? 'badge rounded-pill request-approved' : (($reservation[0]['booking_status'] == 2)?'badge rounded-pill status-confirmed':(($reservation[0]['booking_status'] == 3)?'badge rounded-pill request-waiting':(($reservation[0]['booking_status'] == 4)?'badge rounded-pill approval-expired':(($reservation[0]['booking_status'] == 5)?'badge rounded-pill status-cancelled':(($reservation[0]['booking_status'] == 6)?'badge rounded-pill paid-not-confirm':(($reservation[0]['booking_status'] == 7)?'badge rounded-pill request-reject':(($reservation[0]['booking_status'] == 8)?'badge rounded-pill request-waiting':'badge rounded-pill request-waiting')))))))) ?>"><?= ($reservation[0]['booking_status'] == 1) ? 'Advance paid' : (($reservation[0]['booking_status'] == 2)?'Fully Paid & Invoice Generated':(($reservation[0]['booking_status'] == 3)?'FOC(Free of Cost)':(($reservation[0]['booking_status'] == 4)?'NOC Issued':(($reservation[0]['booking_status'] == 5)?'Cancellation Request':(($reservation[0]['booking_status'] == 6)?'Refunded':(($reservation[0]['booking_status'] == 7)?'Payment Failed':(($reservation[0]['booking_status'] == 8)?'Payment Pending':''))))))) ?></span>                                    
                                        </div>
                                        </div>
                                    </div>
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

                                    <?php if($reservation[0]['payment_method'] == 'Online' && ($reservation[0]['booking_status'] == '1' || $reservation[0]['booking_status'] == '2')) { ?>
                                    <?php if(!empty($payment_details_online)){                             		       
                                            $row_count =count($payment_details_online);
                                            $i=1;
                                            if($row_count>1){
                                            foreach($payment_details_online as $pd) {
                                            ?>

                                            <?php if($pd['status'] == 'Success'){ ?>

                                                <label for="" class="form-label me-3"><?='<h6>'.(($i==1)?'Advance Payment:': 'Final Payment:').'</h6> ₹'.$pd['amount']?></label>
                                                <div class="col-sm-12 col-md-4 mb-3">
                                                    <label for="" class="form-label me-3"><h6>Transaction Id: </h6></label>
                                                    <b><?= $pd['txnid']?></b>
                                                </div>
                                                <div class="col-sm-12 col-md-4 mb-3">
                                                    <label for="" class="form-label me-3"><h6>Mihpay Id: </h6></label>
                                                    <b><?= $pd['transaction_ref_id']?></b>
                                                </div>
                                                <div class="col-sm-12 col-md-4 mb-3">
                                                    <label for="" class="form-label me-3"><h6>Order Id: </h6></label>
                                                    <b><?= $pd['order_id']?></b>
                                                </div>
                                                <div class="col-sm-12 col-md-4 mb-3">
                                                    <label for="" class="form-label me-3"><h6>Transaction Date: </h6></label>
                                                    <b><?= date('d/m/Y H:i:s',strtotime($pd['payment_date']))?></b>
                                                </div>
                                                <div class="col-sm-12 col-md-4 mb-3">
                                                    <label for="" class="form-label me-3"><h6>Transaction Amount: </h6></label>
                                                    <b><?= $pd['amount']?></b>
                                                </div>

                                            <?php } ?>
                                    <?php $i++;}} else{ ?>

                                        <?php if($payment_details_online[0]['status'] == 'Success'){ ?>

                                            <div class="col-sm-12 col-md-4 mb-3">
                                                <label for="" class="form-label me-3"><h6>Transaction Id: </h6></label>
                                                <b><?= $payment_details_online[0]['txnid']?></b>
                                            </div>
                                            <div class="col-sm-12 col-md-4 mb-3">
                                                <label for="" class="form-label me-3"><h6>Mihpay Id: </h6></label>
                                                <b><?= $payment_details_online[0]['transaction_ref_id']?></b>
                                            </div>
                                            <div class="col-sm-12 col-md-4 mb-3">
                                                <label for="" class="form-label me-3"><h6>Order Id: </h6></label>
                                                <b><?= $payment_details_online[0]['order_id']?></b>
                                            </div>
                                            <div class="col-sm-12 col-md-4 mb-3">
                                                <label for="" class="form-label me-3"><h6>Transaction Date: </h6></label>
                                                <b><?= date('d/m/Y H:i:s',strtotime($payment_details_online[0]['payment_date']))?></b>
                                            </div>
                                            <div class="col-sm-12 col-md-4 mb-3">
                                                <label for="" class="form-label me-3"><h6>Transaction Amount: </h6></label>
                                                <b><?= $payment_details_online[0]['amount']?></b>
                                            </div>

                                        <?php } ?>
                                        
                                    <?php } } if($reservation[0]['noc_uploaded_by'] != '') { ?>
                                        <div class="col-sm-12 mb-3">
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
                                        </div>
                                        <?php } ?> 
                                    <?php } ?>
                                    

                                    <!--<div class="col-sm-12 mb-3" style="<?=(in_array($reservation[0]['booking_status'],array('0','3','6')) && $reservation[0]['is_event_started'] == 0)?'display:block;':'display:none;'?>">-->
                                    <!--<?php if($reservation[0]['booking_status'] == '0') 
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
                                                }}?> -->
                                        <hr/>  
                                        <div class="row">
                                                <input type="hidden" name="booking_status" value="<?=$reservation[0]['booking_status']?>">
                                            <!-- File upload input that accepts all file types -->
                                            <div class="col-sm-12 col-md-6 mb-3" id="nocFileInput" style="display: none;">
                                                <label for="nocfile" class="form-label">Upload NOC Letter <span class="text-danger">*</span></label>
                                                <input type="file" class="form-control" id="noc_lt" accept=".pdf" name="nocfile" <?=($reservation[0]['booking_status'] == '2'||$reservation[0]['booking_status'] == '3')? 'required' : '' ?>>
                                            </div>
                                        </div>        
                                        <!-- <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_0" value="0" checked>
                                            <label class="form-check-label" for="status_0">Pending</label>
                                        </div> -->
                                        <div>
                                                <!--<div class="form-check form-check-inline" style="float:left; <?=($reservation[0]['booking_status'] == '0')?'display:block;':'display:none;'?>">
                                                <input class="form-check-input" type="radio" name="status" id="status_1" value="1"  <?=($reservation[0]['booking_status'] == '0')? 'required' : '' ?> <?= ($reservation[0]['booking_status'] == '1')?'checked':'' ?> <?= (isset($venue_booking_details) && ($venue_booking_details))?((count($venue_booking_details['details']) > 0)?'disabled':'') :'' ?>>
                                                <label class="form-check-label" for="status_1">Approve</label>
                                            </div>
                                        
                                            <div class="form-check form-check-inline" style="float:left; <?=($reservation[0]['booking_status'] == '0')?'display:block;':'display:none;'?>">
                                                <input class="form-check-input" type="radio" name="status" id="status_2" value="2" <?=($reservation[0]['booking_status'] == '0')? 'required' : '' ?> <?= ($reservation[0]['booking_status'] == '2')?'checked':'' ?>>
                                                <label class="form-check-label" for="status_2">Reject</label>
                                            </div>

                                            <div class="form-check form-check-inline" style="float:left; <?=($reservation[0]['booking_status'] == '6')?'display:block;':'display:none;'?>">
                                                <input class="form-check-input" type="radio" name="status" id="status_3" value="3"  <?=($reservation[0]['booking_status'] == '6')? 'required' : '' ?> <?= ($reservation[0]['booking_status'] == '3')?'checked':'' ?> <?= (isset($venue_booking_details) && ($venue_booking_details))?((count($venue_booking_details['details']) > 0)?'disabled':'') :'' ?>>
                                                <label class="form-check-label" for="status_3">Confirm</label>
                                            </div>-->

                                            <!--<div class="form-check form-check-inline" style="float:left; <?=(($reservation[0]['booking_status'] == '1' || $reservation[0]['booking_status'] == '2'|| $reservation[0]['booking_status'] == '3' ))?'display:block;':'display:none;'?>">
                                                <label class="form-check-label" for="status_4">Cancel</label>
                                            </div>-->
                                            <div class="form-check form-check-inline" style="float:left; <?=(($reservation[0]['booking_status'] == '1' || $reservation[0]['booking_status'] == '2' || $reservation[0]['booking_status'] == '3' || $reservation[0]['booking_status'] == '8' || $reservation[0]['booking_status'] == '5'))?'display:block;':'display:none;'?>">
                                                <!--<label class="form-label me-3">Do you want to cancel this booking ?</label>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="status_4" value="4" <?= ($reservation[0]['booking_status'] == '5')?'checked':'' ?>>
                                                    <label class="form-check-label" for="status_4">Yes</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="status_5" value="5">
                                                    <label class="form-check-label" for="status_5">No</label>
                                                </div>-->
                                                <button class="btn btn-warning" id="btn_booking_cancel" data-bs-toggle="modal" data-bs-target="bookingCancelModal"><?php if($reservation[0]['booking_status'] == '5'){ echo 'APPROVE CANCEL REQUEST'; } else { echo 'CANCEL BOOKING'; } ?></button>
                                            </div>
                                        </div>                             
                                    </div> 

                                

                                    <div class="col-sm-12 col-md-8 mb-3">
                                        <div class="row">
                                            <!--<div class="col-sm-12 col-md-5 mb-3 approve_div right-inner-addon" style="<?= ($reservation[0]['booking_status'] == '1')?'display: block;':'display: none;' ?>">
                                                <label for="" class="form-label">Aprroval is Valid till	</label>
                                                <input type="text" id="approval_valid_till" name="approval_valid_till" class="form-control" value="<?= ($reservation[0]['approval_valid_till'])? date('d-m-Y H:i',strtotime($reservation[0]['approval_valid_till'])) : date('d-m-Y H:i') ?>" <?= ($reservation[0]['booking_status'] == '3')?'readonly':'' ?>>
                                                <i class="fa fa-calendar"></i>
                                            </div>

                                                <div class="col-sm-12 col-md-7 mb-3" id="fileInput" style="display: none;">
                                                    <label for="userfile" class="form-label">Upload Approval Letter <span class="small text-success">(.pdf extension file only)</span> <span class="text-danger">*</span></label>
                                                    <input type="file" class="form-control" name="userfile" id="approval_lt" accept=".pdf"  <?=($reservation[0]['booking_status'] == '0')? 'required' : '' ?>>
                                                </div>-->
                                            <!--<div class="col-sm-12 col-md-6 mb-3 approve_div" style="<?= ($reservation[0]['booking_status'] == '1')?'display: block;':'display: none;' ?>">
                                                <label for="" class="form-label">Payment Method	</label>
                                                <select name="payment_method" id="payment_method" class="form-select" <?= ($reservation[0]['booking_status'] == '0')?'':'disabled' ?>> 
                                                    <option value="" selected disabled>Select Payment Method</option>
                                                    <option value="Online" <?=($reservation[0]['payment_method'] == 'Online')?'selected':''?>>Online</option>
                                                    <option value="Offline" <?=($reservation[0]['payment_method'] == 'Offline')?'selected':''?>>Offline</option>
                                                </select> 
                                                
                                            </div>-->
                                        </div>

                                        <!--<div class="row">
                                            
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

                                        </div> -->

                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 mb-3 cancellation_div" style="<?= !empty($reservation[0]['cancellation_reason'])?'display: block;':'display: none;' ?>">
                                                <label for="" class="form-label">Reason of Cancellation <?=($reservation[0]['booking_status'] == '1' || $reservation[0]['booking_status'] == '2'|| $reservation[0]['booking_status'] == '3')? '<span class="text-danger">*</span>' : '' ?> </label>
                                                <textarea name="cancellation_reason" id="cancellation_reason" cols="" rows="4" class="form-control" placeholder="Reason of Cancellation" <?=($reservation[0]['booking_status'] == '1' || $reservation[0]['booking_status'] == '2'|| $reservation[0]['booking_status'] == '3')? 'required' : '' ?>><?= $reservation[0]['cancellation_reason'] ?></textarea>
                                            </div>
                                            <?php if($reservation[0]['cancelled_by'] != '' && $reservation[0]['booking_status'] == '5') { ?>
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
                                        <!--<?php if($reservation[0]['revoked_by'] != '' && $reservation[0]['booking_status'] == '8') { ?>
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
                                            <?php } ?>--> 
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
                                                        <?php if(!empty($history->vbsm_status)){ ?>
                                                            <tr>
                                                                <td class="cell"><?=date('d-m-Y H:i:s',strtotime($history->vbsm_created_ts))?></td>
                                                                <td class="cell"><span class="<?= (($history->vbsm_status == 1) ? 'badge rounded-pill request-approved' : (($history->vbsm_status == 2)?'badge rounded-pill status-confirmed':(($history->vbsm_status == 3)?'badge rounded-pill request-waiting':(($history->vbsm_status == 4)?'badge rounded-pill approval-expired':(($history->vbsm_status == 5)?'badge rounded-pill status-cancelled':(($history->vbsm_status== 6)?'badge rounded-pill paid-not-confirm':(($history->vbsm_status == 7)?'badge rounded-pill request-reject':(($history->vbsm_status == 8)?'badge rounded-pill request-waiting':'badge rounded-pill request-waiting')))))))) ?>"><?= ($history->vbsm_status == 1) ? 'Advance paid' : (($history->vbsm_status == 2)?'Fully Paid & Invoice Generated':(($history->vbsm_status == 3)?'FOC(Free of Cost)':(($history->vbsm_status == 4)?'NOC Issued':(($history->vbsm_status == 5)?'Cancellation Request':(($history->vbsm_status== 6)?'Refunded':(($history->vbsm_status == 7)?'Payment Failed':(($history->vbsm_status == 8)?'Payment Pending':''))))))) ?></span></td>
                                                                <td class="cell"><?=($history->vbsm_status==1 || ($history->vbsm_status==2))? $history->cust_name:$history->action_by_name?></td>
                                                                <td class="cell">
                                                                <?php if($history->vbsm_status==4) { ?>
                                                                <p class="mb-1"><b class="me-3">Uploaded At:</b><?= date('d-m-Y H:i:s',strtotime($history->noc_uploaded_at)) ?></p>
                                                                    <p class="mb-1"><b class="me-3">NOC Letter:</b> <a href="<?= base_url($history->noc_file_path) ?>" target="_blank"><?=$history->noc_file_name ?><i class="fa fa-download"></i></a></p>
                                                                <?php } else if($history->vbsm_status==5) { ?>
                                                                    <p class="mb-1"><b class="me-3">Cancelled At:</b><?= date('d-m-Y H:i:s',strtotime($history->cancelled_ts)) ?></p>
                                                                    <p class="mb-1"><b class="me-3">Reason:</b> <?= $history->cancellation_reason ?></p>
                                                                    <?php } else if($history->vbsm_status==1||$history->vbsm_status==2) { ?>
                                                                    <p class="mb-1"><b class="me-3">Transaction Id:</b><?= $history->txnid ?></p>
                                                                    <p class="mb-1"><b class="me-3"></p>

                                                                    <?php  } else{ ?>
                                                                    <p class="mb-1"></p>
                                                                    <p class="mb-1"></p>
                                                                    <?php } ?>
                                                                    </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <?php }} ?>                                  
                                                    </tbody>
                                                </table> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col">
                            <?php if( $reservation[0]['booking_status'] == '1' || $reservation[0]['booking_status'] == '2'  || $reservation[0]['booking_status'] == '3'|| $reservation[0]['booking_status'] == '4') { ?> 
                            <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                            <?php } ?>
                            <!--<?php if($reservation[0]['booking_status'] == '1') { ?> 
                            <button type="button" class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#revokeModal" id="revoke">REVOKE APPROVAL</button>
                            <?php } ?>-->
                            <a href="<?=base_url('admin/venue_reservation')?>" class="btn app-btn-primary">Go Back</a>
                            </div>
                        </div>

                <?php } else { ?>

                    <div class="app-card app-card-settings shadow-sm p-3">

                        <div class="row g-2 mb-3">

                            <div class="col-md-6">
                                <a href="<?=base_url('admin/venue_reservation')?>" class="btn app-btn-primary">Go Back</a>
                            </div>

                            <div class="col-md-6 text-end">
                                <button class="btn app-btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMakePayment" aria-expanded="false" aria-controls="collapseMakePayment">
                                    Make Payment
                                </button>
                            </div>

                        </div>

                        <div class="collapse" id="collapseMakePayment">
                            <form id="booking_payment_form" class="settings-form" method="post" enctype="multipart/form-data" autocomplete="off">

                                <input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                <input type="hidden" id="booking_id" name="booking_id" value="<?=(isset($reservation[0]['booking_id'])?$reservation[0]['booking_id']:'')?>" required>

                                <table class="mb-3 w-100 table-sm table table-bordered">
                                    <tr>
                                        <th>Money Receipt No<span class="asterisk"> *</span></th>    
                                        <th>Receipt Date<span class="asterisk"> *</span></th>
                                        <th>Select Payment Mode<span class="asterisk"> *</span></th>
                                        <th>Amount<span class="asterisk"> *</span></th>
                                        <th colspan="2">Remarks<span class="asterisk"></span></th>
                                    </tr>
                                    <tr>
                                        <td width="20%">
                                            <input type="text" class="form-control" id="receipt_no" name="receipt_no" required="">
                                            <span class="receipt_no_error" style="color: #CC0000;"></span>
                                        </td>
                                        <td width="15%">
                                            <input type="date" class="form-control" id="payment_date" name="payment_date" min="<?= date('Y-m-d') ?>" required="">
                                            <span class="payment_date_error" style="color: #CC0000;"></span>
                                        </td>
                                        <td width="20%">
                                            <select class="form-select" id="payment_mode_admin" name="payment_mode_admin">
                                                <option value="Cash">Cash</option>
                                                <option value="Cheque">Cheque</option>
                                                <!--<option value="Bank Transfer">Bank Transfer</option>                                                
                                                <option value="EDC">EDC</option>-->
                                                <option value="Standalone EDC">Standalone EDC</option>
                                                <!--<option value="UPI">UPI</option>-->
                                                <!--<option value="Adjustment">Adjustment</option>-->
                                            </select>
                                        </td>
                                        <td width="15%">
                                            <input type="text" class="form-control" id="amount" name="amount_admin" placeholder="0.00" required="" value="<?php if($reservation[0]['advance_amount'] == '0' || $reservation[0]['advance_amount'] == '0.00'){ echo '0.00'; } else { echo number_format((float)($reservation[0]['net_amount'] - $reservation[0]['advance_amount']), 2, '.', ''); } ?>" max="" readonly>
                                            <span class="amount_error" style="color: #CC0000;"></span>
                                        </td>
                                        <td width="30%">
                                            <textarea class="form-control" id="remarks" name="remarks_admin"></textarea>
                                        </td>
                                        <td class="text-end">
                                            <button class="btn app-btn-primary paymentSubmit" type="button">Submit</button>
                                        </td>
                                    </tr>
                                </table>

                            </form>
                        </div>

                    </div>

                <?php } ?>

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

<!-- Modal -->
<div class="modal fade" id="bookingCancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancel Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
            <h6>Cancellation Information</h6><br>
        <?php
        
        //if($booking_source == 'F'){
            //$cancel_percent = ($booking_details[0]['booking_status'] =='I')?0:$cancellation_details['cancellation_per'];
            //$cancel_charge = ($booking_details[0]['booking_status'] =='I')?0:intval((($booking_details[0]['room_price_before_tax'] * $cancellation_details['cancellation_per']) / 100) *100)/100;
            //$refund_amt = ($booking_details[0]['booking_status'] =='I')?0:intval(($booking_details[0]['room_price_before_tax'] - $cancel_charge)*100)/100;
        //}
        ?>
        <?php // if($booking_source == 'F'){ ?>

            <input type="hidden" id="booking_id" name="booking_id" value="<?=$reservation[0]['booking_id']?>">

            <?php 
                $booking_status = $reservation[0]['booking_status'];
                $cancel_percent = $cancellation_details['cancellation_per'];

                if($booking_status == 1){

                    $netAmount = $reservation[0]['net_amount'];
                    $advanceAmount = $reservation[0]['advance_amount'];
                    $gstAmount = $reservation[0]['gst_amount'];

                    $calGstamount = ($gstAmount * $advanceAmount) / $netAmount;
                    $amountminusGST = $advanceAmount - $calGstamount;

                    $cancel_charge = ($amountminusGST * $cancel_percent) / 100;
                    $refund_amt = $amountminusGST - $cancel_charge;

                } else {

                    $netAmount = $booking_slip['net_amount'];
                    //$advanceAmount = $booking_slip['advance_amount'];
                    $gstAmount = $booking_slip['gst_amount'];

                    //$calGstamount = ($gstAmount * $advanceAmount) / $netAmount;
                    $amountminusGST = $netAmount - $gstAmount;

                    $cancel_charge = ($amountminusGST * $cancel_percent) / 100;
                    $refund_amt = $amountminusGST - $cancel_charge;

                }
            ?>

            <h6>Booking Amount Before GST (Rs.) : <?= $reservation[0]['total_rate']; ?></h6>
            <h6>Booking Amount After GST (Rs.) : <?= $reservation[0]['net_amount']; ?></h6>
            <h6>Cancellation Charge (Rs.) : <?= $cancel_charge; ?></h6>
            <h6>GST (Rs.) : <?= $reservation[0]['gst_amount']; ?></h6>

            <h6>Refund Amount (Rs.) : <input type="text" id="refund_amt" name="refund_amt" value="<?= $refund_amt; ?>"></h6>
            
            
            <input type="hidden" id="paid_amount" name="paid_amount" value="<?= $netAmount; ?>">
            <input type="hidden" id="cancel_percent" name="cancel_percent" value="<?= $cancel_percent; ?>">
            <input type="hidden" id="cancel_charge" name="cancel_charge" value="<?= $cancel_charge; ?>">
            <!--<input type="hidden" id="refund_amt" name="refund_amt" value="<?php //echo $refund_amt; ?>">-->
            <input type="hidden" id="booking_status" name="booking_status" value="<?= $booking_status; ?>">
        <?php // } ?>        
        
            <textarea name="cancellation_remarks" id="cancellation_remarks" rows="4" style="width: 100%" placeholder="Cancellation Reason"></textarea>
                
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary" id="cancel_booking_btn">Submit</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('public/admin_assets/plugins/sweetalert2/sweetalert2.all.min.js')?>"></script>
<script>

    $(document).ready(function(){ 

        $('#btn_booking_cancel').on('click', function(e){

            e.preventDefault();
            $('#bookingCancelModal').modal('show');

        });

        $('#bookingCancelModal .close').on('click', function(e){

            e.preventDefault();
            $('#cancellation_remarks').val('');
            $('#bookingCancelModal').modal('hide');

        });


        $(document).on('click',".paymentSubmit",function(e){

            e.preventDefault();

            //alert();

            //$('#booking_payment_form').validate({
                //submitHandler:function(f){
                    //f.preventDefault();

                    var bookingId = $("#collapseMakePayment #booking_id").val();                    

                    var receiptNo = $("#collapseMakePayment #receipt_no").val();
                    var paymentDate = $("#collapseMakePayment #payment_date").val();
                    var paymentMode = $("#collapseMakePayment #payment_mode_admin").val();
                    var amount = $("#collapseMakePayment #amount").val();
                    var remarks = $("#collapseMakePayment #remarks").val();

                    //alert(amount);

                    if(receiptNo == '' && paymentDate != '' && amount != ''){
                        $('.receipt_no_error').text('Please provide receipt no.');
                        $('.payment_date_error').text('');
                        $('.amount_error').text('');
                    } else if(receiptNo != '' && paymentDate == '' && amount != ''){
                        $('.receipt_no_error').text('');
                        $('.payment_date_error').text('Please select date.');
                        $('.amount_error').text('');
                    } else if(receiptNo != '' && paymentDate != '' && amount == '') {
                        $('.receipt_no_error').text('');
                        $('.payment_date_error').text('');
                        $('.amount_error').text('Please provide amount.');
                    } else if(receiptNo == '' && paymentDate == '' && amount != ''){
                        $('.receipt_no_error').text('Please provide receipt no.');
                        $('.payment_date_error').text('Please select date.');
                        $('.amount_error').text('');
                    } else if(receiptNo == '' && paymentDate != '' && amount == ''){
                        $('.receipt_no_error').text('Please provide receipt no.');
                        $('.payment_date_error').text('');
                        $('.amount_error').text('Please provide amount.');
                    } else if(receiptNo != '' && paymentDate == '' && amount == '') {
                        $('.receipt_no_error').text('');
                        $('.payment_date_error').text('Please select date.');
                        $('.amount_error').text('Please provide amount.');
                    } else if(receiptNo == '' && paymentDate == '' && amount == '') {
                        $('.receipt_no_error').text('Please provide receipt no.');
                        $('.payment_date_error').text('Please select date.');
                        $('.amount_error').text('Please provide amount.');
                    } else {
                        $('.receipt_no_error').text('');
                        $('.payment_date_error').text('');
                        $('.amount_error').text('');

                        var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	            var csrfHash = $('.csrfToken').val(); // CSRF hash

                        $.ajax({
                            type:'POST',
                            url: "<?= base_url('admin/venue_reservation/submit_payment'); ?>",
                            //data:$('#booking_payment_form').serialize(),
                            data: {"bookingId":bookingId,"receiptNo":receiptNo,"paymentDate":paymentDate,"paymentMode":paymentMode,"amount":amount,"remarks":remarks,[csrfName]: csrfHash},
                            dataType: 'json',
                            encode: true,
                            async: false,
                            beforeSend:function(){
                                $("#blurme").addClass("blur");
                                //$("#spinner-div").show();
                            },
                            success:function(d){
                                if(d.success){                                
                                    
                                    $("#blurme").removeClass("blur");
                                    Swal.fire({
                                    icon: 'success',
                                    title: d.msg,
                                    confirmButtonText:'Ok',
                                    confirmButtonColor:'#69da68',
                                    allowOutsideClick: false,
                                        }).then((result) => {
                                    if(result.value){
                                            window.location.replace(d.redirect_link);
                                        }
                                    });

                                }else if(d.error){

                                    $("#blurme").removeClass("blur");
                                    clearInterval(interval);
                                    Swal.fire({
                                    icon: 'error',
                                    title: d.msg,
                                    confirmButtonText:'Ok',
                                    confirmButtonColor:'#69da68',
                                    allowOutsideClick: false,
                                        }).then((result) => {
                                    if(result.value){
                                            window.location.replace(d.redirect_link);
                                        }
                                    });

                                }else{
                    
                                }
                            }
                        });

                    }                  
                    
                //}
            //});
        });


        $(document).on('click',"#cancel_booking_btn",function(e){

            e.preventDefault();

            var booking_id = $("#booking_id").val();
            var cancel_remarks = $("#cancellation_remarks").val();
            var paid_amount = $("#paid_amount").val();
            var cancel_percent = $("#cancel_percent").val();
            var cancel_charge = $("#cancel_charge").val();
            var refund_amt = $("#refund_amt").val();
            var booking_status = $("#booking_status").val();

            //alert(cancel_remarks);

            if (!refund_amt) {

                $.alert({
                    title: 'Alert!',
                    content: 'Please enter refund amount',
                    type: 'red',
                    typeAnimated: true,
                })
                return false;

            } else if (!cancel_remarks) {

                $.alert({
                    title: 'Alert!',
                    content: 'Please enter cancellation reason',
                    type: 'red',
                    typeAnimated: true,
                })
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
                                    url: '<?= base_url("admin/venue_reservation/cancel_booking_venue"); ?>',
                                    method: 'post',
                                    data: {
                                        csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>',
                                        booking_id: booking_id,
                                        cancel_remarks : cancel_remarks,
                                        paid_amount : paid_amount,
                                        cancel_percent : cancel_percent,
                                        cancel_charge : cancel_charge,
                                        refund_amt : refund_amt, 
                                        booking_status : booking_status,
                                    },
                                    dataType: 'json',
                                    async: false,
                                    success: function(response) {
                                        if (response.status) {
                                            //$("#cancel_booking_btn").prop('disabled',false);
                                            //$("#cancel_booking_btn").val('Cancel Booking');
                    
                                            $.confirm({
                                                type: 'green',
                                                title: 'Success!',
                                                content: response.msg,
                                                buttons: {

                                                    OK: {
                                                        btnClass: 'btn-default',
                                                        action: function() {  
                                                            window.location.href="<?=base_url('admin/venue_reservation')?>";
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
                });

            }

        });	


        var status = "<?=$reservation[0]['booking_status']?>";
        if(status != '0'){
            //calculate_total();
        }
        $('#cancellation_reason').prop('required',false);

        if(status==='2' || status==='3')
        {
            var noc_lt=$('#noc_lt');

            var nocfileInput = $("#nocFileInput"); // Replace with your file input field's ID
            nocfileInput.show();
            noc_lt.prop('required', true);

        }
        /*$('#approval_valid_till').datetimepicker({ 
            format:'d-m-Y H:i',
            minDate: new Date(),
            maxDate: "<?= $reservation[0]['booking_details'][0]['start_date'] ?>"
        });*/


        /*$(document).on('click','#submit_request', function() {
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
        }); */
        
    })
    
    $("input[name='status']").change(function(){
        var status_action = $(this).val();
        var fileInput = $("#fileInput"); // Replace with your file input field's ID
        var approval_lt=$('#approval_lt');
        var noc_lt=$('#noc_lt');

        var nocfileInput = $("#nocFileInput"); // Replace with your file input field's ID
        if(status_action == '4'){ 
                $('#cancellation_reason').prop('required',true);
                $(".cancellation_div").show();
                var noc_lt=$('#noc_lt');

                var nocfileInput = $("#nocFileInput"); // Replace with your file input field's ID
                nocfileInput.hide();
                noc_lt.prop('required', false);
                
        } 
        else{
            $('#cancellation_reason').prop('required',false);
                $(".cancellation_div").hide();
                var noc_lt=$('#noc_lt');

            var nocfileInput = $("#nocFileInput"); // Replace with your file input field's ID
            nocfileInput.show();
            noc_lt.prop('required', true);
        }
    })

    /*$(".calculate_total").keyup(function(){
        calculate_total();
        
    })*/

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
