<!-- ============================ Page Title Start================================== -->
<div class="image-cover page-title" style="background:url(<?= base_url('public/frontend_assets/assets/img/slider/06.jpg'); ?>) no-repeat; background-size: cover; background-position: center;" data-overlay="6">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <h2 class="ipt-title">My Bookings</h2>
                <!-- <span class="ipn-subtitle text-light">My Booking Short Description</span> -->

            </div>
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ Dashboard Start ================================== -->
<section class="gray">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="dashboard-navbar dashboard-left-content">

                    <div class="d-user-avater">
                        <img src="<?= !is_null($this->session->userdata('profile_pic')) ? base_url('public/customer_images/' . $this->session->userdata('profile_pic')) : base_url('public/frontend_assets/images/user-icon.jpg') ?>" class="img-fluid avater w-75" alt="">
                        <h4 class="fw-normal thm-txt mt-4"><?= $this->session->userdata('first_name') ?> <?= $this->session->userdata('last_name') ?></h4>
                        <span><?= $this->session->userdata('city') ?></span>
                    </div>

                    <div class="d-navigation">
                        <ul class="dashboard-list list-style-none">
                            <li class="list"><a href="<?php echo base_url('my-profile') ?>"><i class="ti-user"></i>My Profile</a></li>
                            <li class="list active"><a href="<?php echo base_url('my-booking') ?>"><i class="ti-layers"></i>My Booking List</a></li>
                            <li class="list"><a href="<?php echo base_url('logout') ?>"><i class="ti-power-off"></i>Log Out</a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="dashboard-wraper single-reservation bg-white base-padding">
                    <?php if ($this->session->flashdata('success_msg')) : ?>
                        <div class="alert alert-success">

                            <?php echo $this->session->flashdata('success_msg') ?>
                        </div>
                    <?php endif ?>
                    <?php if ($this->session->flashdata('error_msg')) : ?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('error_msg') ?>
                        </div>
                    <?php endif ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fw-normal thm-txt">Booking List</h4>
                        <div>
							<select id="booking-type" name="booking_type" class="form-select">
									<option value="ALL" <?= set_select('booking_type', 'ALL', isset($type) && ($type == 'ALL' || $type == '') ? true : false); ?>>All Booking</option>
									<option value="UPCOMING" <?= set_select('booking_type', 'UPCOMING', isset($type) && $type == 'UPCOMING' ? true : false); ?>>Upcoming Booking</option>
									<option value="PAST" <?= set_select('booking_type', 'PAST', isset($type) && $type == 'PAST' ? true : false); ?>>Past Booking</option>
                                </select>
                            <!--<div class="btn-group">
                                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    All Booking
                                </button>
                                
                            </div>-->
                        </div>
                    </div>
                    <ul class="tabs details-tab details-tab-border mt-3">
                        <li id="guest" class="ml-0 nav-link active" data-tab="guest-house" data-bs-target="#pills-guest-house"> Guest House </li>
                        <li id="hall" class="nav-link" data-tab="hall-venue" data-bs-target="#pills-hall-venue"> Hall & Venue </li>
                    </ul>
                    <div id="guest-house" class="tab-content-item active">                        
                        <div class="dashboard-gravity-list mt-3">
                            <ul>
                                <?php
                                if (!empty($booking_details)) {
                                    foreach ($booking_details as $bd) { ?>
                                        <li class="pending-booking mb-3">
                                            <div class="list-box-listing bookings">
                                                <div class="list-box-listing-img"><img src="<?= isset($bd['image1']) && $bd['image1'] != '' ? base_url('public/admin_images/' . $bd['image1']) : base_url('public/admin_images/property_images/no-image.jpg') ?>" alt=""></div>
                                                <div class="list-box-listing-content">
                                                    <div class="inner">
                                                        <h3><?= $bd['property_name'] ?> <span class="booking-status pending"><?= ($bd['booking_status'] == 'I') ? 'Initiate' : (($bd['booking_status'] == 'A') ? 'Approved' : (($bd['booking_status'] == 'C') ? 'Cancelled' : 'Check out')) ?></span>
                                                        <?php if($bd['booking_status'] == 'C') { ?>
                                                            <span class="badge badge-pill <?= ($bd['is_refunded'] == '1') ? 'badge-success' :'badge-warning'?>"><?= ($bd['is_refunded'] == '1') ? 'Refunded' :'Refund Initiated'?></span>
                                                        <?php } ?>
                                                        </h3>
                                                        <div class="inner-booking-list d-flex">
                                                            <span class="thm-txt fw-normal me-3">Booking No.:</span>
                                                            <!-- <ul class="booking-list">
                                                                <li class="highlighted"> --><span><?= $bd['booking_no']; ?></span><!-- </li> -->
                                                            <!-- </ul> -->
                                                        </div>
                                                        <div class="inner-booking-list d-flex">
                                                            <span class="thm-txt fw-normal me-3">Booking Date:</span>
                                                            <!-- <ul class="booking-list">
                                                                <li class="highlighted"> --><span><?= date('d-m-Y', strtotime($bd['check_in'])) ?> to <?= date('d-m-Y', strtotime($bd['check_out'])) ?></span><!-- </li> -->
                                                            <!-- </ul> -->
                                                        </div>
                                                        <div class="inner-booking-list d-flex">
                                                            <span class="thm-txt fw-normal me-3">Price:</span>
                                                        <!--  <ul class="booking-list">
                                                                <li class="highlighted"> --><span>₹ <?= $bd['net_payable_amount'] ?></span><!-- </li>
                                                            </ul> -->
                                                        </div>
                                                        <div class="mt-3">
                                                            <?php if (($bd['booking_status'] == 'I' || $bd['booking_status'] == 'A') && strtotime($bd['check_in']) >= time()) { ?> 
                                                                <a target="_blank" class="btn btn-sm btn-danger" href="<?= base_url('view-invoice/' . encode_url($bd['booking_id'])) ?>">Cancel Booking</a>
                                                            <?php } ?>
                                                            <a class="btn btn-sm btn-primary" href="<?= base_url('view-invoice/' . encode_url($bd['booking_id'])) ?>" target="_blank">View Details</a>
                                                            <a class="btn btn-sm btn-success" href="<?= base_url('download-invoice/' . encode_url($bd['booking_id'])) ?>" target="_blank"><i class="fa fa-download"></i> Download</a>
                                                            <?php if ($bd['booking_status'] == 'O') { ?>
                                                                <!-- Trigger the modal with a button -->
                                                                <button type="button" class="btn btn-sm btn-info feed_back" data-booking_id="<?=$bd['booking_id']?>">Provide Feedback</button>

                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                        </div>
                    </div>

                    <div id="hall-venue" class="tab-content-item">
                        <div class="dashboard-gravity-list mt-3">
                            <ul>
                                <?php
                                if (!empty($venue_booking_details)) {
                                    foreach ($venue_booking_details as $vd) { ?>
                                        <li class="pending-booking mb-3 <?=($vd['is_form_filledup'] == 0)? 'item-blinking' : ''?>">
                                            <div class="list-box-listing bookings">
                                                <div class="list-box-listing-img"><img src="<?= isset($vd['image1']) && $vd['image1'] != '' ? base_url('public/admin_images/' . $vd['image1']) : base_url('public/admin_images/property_images/no-image.jpg') ?>" alt=""></div>
                                                <div class="list-box-listing-content">
                                                    <div class="inner">

                                                        <h3><?= $vd['venue_names'] ?> <span class="<?= (($vd['booking_status'] == 1) ? 'badge rounded-pill request-approved' : (($vd['booking_status'] == 2)?'badge rounded-pill status-confirmed':(($vd['booking_status'] == 3)?'badge rounded-pill request-waiting':(($vd['booking_status'] == 4)?'badge rounded-pill approval-expired':(($vd['booking_status'] == 5)?'badge rounded-pill status-cancelled':(($vd['booking_status'] == 6)?'badge rounded-pill paid-not-confirm':(($vd['booking_status'] == 7)?'badge rounded-pill request-reject':(($vd['booking_status'] == 8)?'badge rounded-pill request-waiting':'badge rounded-pill request-waiting')))))))) ?>"><?= ($vd['booking_status'] == 1) ? 'Advance paid' : (($vd['booking_status'] == 2)?'Fully Paid & Invoice Generated':(($vd['booking_status'] == 3)?'FOC(Free of Cost)':(($vd['booking_status'] == 4)?'NOC Issued':(($vd['booking_status'] == 5)?'Cancellation Request':(($vd['booking_status'] == 6)?'Refunded':(($vd['booking_status'] == 7)?'Payment Failed':(($vd['booking_status'] == 8)?'Payment Pending':''))))))) ?></span></h3>
                                                        <!-- <h3><?= $vd['venue_names'] ?> <span class="<?= (($vd['booking_status'] == 1) ? 'badge bg-info' : (($vd['booking_status'] == 2)?'badge bg-danger':(($vd['booking_status'] == 3)?'badge bg-success':(($vd['booking_status'] == 4)?'badge bg-primary':(($vd['booking_status'] == 5)?'badge bg-secondary':(($vd['booking_status'] == 6)?'badge bg-info':(($vd['booking_status'] == 7)?'badge bg-danger':(($vd['booking_status'] == 8)?'badge bg-primary':'badge bg-warning')))))))) ?>"><?= ($vd['booking_status'] == 1) ? 'Request Approved' : (($vd['booking_status'] == 2)?'Request Rejected':(($vd['booking_status'] == 3)?'Confirmed':(($vd['booking_status'] == 4)?'Cancelled':(($vd['booking_status'] == 5)?'Approval Expired':(($vd['booking_status'] == 6)?'Paid But Not Confirmed':(($vd['booking_status'] == 7)?'Request Expired':(($vd['booking_status'] == 8)?'Approval Revoked':'Request In Waiting'))))))) ?></span>
                                                        </h3> -->
                                                        <div class="inner-booking-list d-flex">
                                                            <span class="thm-txt fw-normal me-3">Booking No.:</span>
                                                            <span><?= $vd['booking_id']; ?></span>
                                                        </div>
    
                                                        <div class="inner-booking-list d-flex">
                                                            <span class="thm-txt fw-normal me-3">Booking Date:</span>
                                                            <?php 
																if (isset($vd['booking_details']) && is_array($vd['booking_details'])) {
																	// Extract 'start_date' values from 'booking_details'
																	$startDates = array_column($vd['booking_details'], 'start_date');
																	// Format 'start_date' values and then implode with a comma separator
																	$formattedDates = array_map(function ($date) {
																		return date('d-m-Y', strtotime($date));
																	}, $startDates);
																	// Implode 'start_date' values with a comma separator
																	$startDatesString = implode(' to ', $formattedDates);
																	echo '<span>' . $startDatesString . '</span>'; // Display the imploded 'start_date' values
																} 
															?>                    
                                                        </div>

                                                         <?php if(($vd['booking_status'] == 1)){ ?>

															<span class="thm-txt fw-normal me-3">Payable Total:</span>
                                                        	<span>₹ <?= $vd['net_amount'] ?></span>
															
                                                            <div class="inner-booking-list d-flex">
                                                                <span class="thm-txt fw-normal me-3">Advance Paid:</span>
																<span>₹ <?= $vd['advance_amount'] ?></span>
                                                            </div>

                                                            <div class="inner-booking-list d-flex">
                                                                <span class="thm-txt fw-normal me-3">Due Amount:</span>
																<span>₹ <?php echo number_format((float)($vd['net_amount'] - $vd['advance_amount']), 2, '.', ''); ?></span>
                                                            </div>

                                                        <?php } else if(($vd['booking_status'] == 8)){ ?>

															<span class="thm-txt fw-normal me-3">Payable Total:</span>
                                                        	<span>₹ <?= $vd['net_amount'] ?></span>

															<?php if($vd['advance_amount']>0){ ?>
																<div class="inner-booking-list d-flex">
																	<span class="thm-txt fw-normal me-3">Advance Paid:</span>
																	<span>₹ <?= $vd['advance_amount'] ?></span>
																</div>
                                                            <?php } ?> 

                                                        <?php } else { ?>    

															<div class="inner-booking-list d-flex">
																<span class="thm-txt fw-normal me-3">Payable Total:</span>
																<span>₹ <?= $vd['net_amount'] ?></span>
															</div>

                                                        <?php } ?>

                                                        <?php if($vd['booking_status'] == 5) {?>
															<div class="inner-booking-list d-flex">
																<span class="thm-txt fw-normal me-3">Reason:</span>
																<span><?=$vd['cancellation_reason']?></span>
															</div>
                                                        <?php } ?>

                                                        <?php if($vd['is_form_filledup'] == 1) {?>
															<div class="inner-booking-list d-flex">
																<span class="fw-bold text-success"><i class="las la-check-circle me-1"></i>Mandatory Information submited.</span>
															</div>
                                                        <?php } ?>

                                                        <div class="mt-3">

															<?php if($vd['is_form_filledup'] == 0) {?>
															<button type="button" class="btn btn-sm btn-dark item-blinking submit_agency" data-bs-toggle="modal" data-id="<?= $vd['booking_id'] ?>">Add Mandatory Information</button>
															<?php } $booking_date = array();?>

															<?php if(isset($vd['booking_details']) && $vd['booking_details']): foreach($vd['booking_details'] as $details) :?>
																<?php $booking_date[] = date("d-m-Y", strtotime($details['start_date']))?>
															<?php endforeach; endif ?>

                                                        	<!--<a class="btn btn-sm btn-primary view_details" href="javascript:void(0)" data-booking_id="<?php //echo $vd['booking_id']?>" >View Details</a>-->
															<a class="btn btn-sm btn-view-detail" href="<?= base_url('frontend/profile/booking_acknoledgement/' . encode_url($vd['booking_id'])) ?>" target="_blank">View Details</a>
                                                        	<!--<?php if($vd['booking_status'] == '1' || $vd['booking_status'] == '3'|| $vd['booking_status'] == '6') {?>
                                                                <a target="_blank" class="btn btn-sm btn-approval-letter" href="<?= base_url($vd['approval_letter_filepath']) ?>">Approval Letter</a>
                                                            <?php } ?>-->

                                                            <?php if(($vd['booking_status'] == '2' && $vd['net_amount']>0)||($vd['booking_status'] == '4' && $vd['net_amount']>0)) {?>
                                                                <a target="_blank" class="btn btn-sm btn-booking-slip" href="<?= base_url('frontend/venue_booking/booking_slip/'.$vd['booking_id']) ?>">Invoice</a>
                                                            <?php } ?>

                                                            <?php if($vd['booking_status'] == '4') {?>
                                                                <a target="_blank" class="btn btn-sm btn-NOC-letter" href="<?= base_url($vd['noc_file_path']) ?>">NOC Letter</a>
                                                            <?php } ?>

															<?php if($vd['booking_status'] == '1'){ ?>
																<button class="btn btn-sm btn-pay-now pay_now" data-booking_id = "<?php echo $vd['booking_id']?>" data-amount="<?= $vd['net_amount'] - $vd['advance_amount']?>">Pay Now</button>
															<?php } ?>

															<?php if($vd['booking_status'] == '8' && $vd['net_amount']>0){ ?>
																<button class="btn btn-sm btn-pay-now pay_now" data-booking_id = "<?php echo $vd['booking_id']?>" data-amount="<?=($vd['advance_amount']>0)? $vd['advance_amount']:$vd['net_amount']?>">Pay Now</button>
															<?php } ?>

															<?php if(($vd['booking_status'] == '1' || $vd['booking_status'] == '2' || $vd['booking_status'] == '3' || $vd['booking_status'] == '4')){ ?>
																<a target="_blank" class="btn btn-sm btn-danger" href="<?= base_url('cancel-booking/' . encode_url($vd['booking_id'])) ?>">Cancel Booking</a>
															<?php } ?>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

<div class="modal fade" id="agencyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="agencyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agencyModalLabel">Add Mandatory Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="padding: 10px;">
        <div id="agencyInformationBlock">            
            <form action="<?php echo base_url('frontend/venue_booking/submit_agency'); ?>" class="custom-form" id="agencyForm" autocomplete="off"  method="post">
            <div class="row g-2">
             <input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">

             <input type="hidden" id="booking_id_agency" name="booking_id_agency">  

                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="" class="form-label">Event Owner <span class="asterisk text-danger"> *</span></label>
                    <input class="form-control required-field" type="text" name="agency_full_name" id="agency_full_name" placeholder="Event Owner" required>
                    <span class="validation-message text-danger hidden">Please enter the input field.</span>
                </div>
				<div class="col-sm-12 col-md-6 col-lg-6">
                    <label class="form-label">Contact No. <span class="asterisk text-danger"> *</span></label>
                    <input class="form-control contact required-field" type="text" name="agency_contact_no" id="agency_contact_no" placeholder="Type Contact No" maxlength="10"  required>
                    <span id="mob-invalid" class="hidden small text-danger">
                        You have entered an Invalid Mobile Number
                    </span>
                            <span id="mob-invalid_digits" class="hidden small text-danger">
                            Please enter 10 digits Mobile Number
                    </span>
                    <span class="validation-message text-danger hidden">Please enter the input field.</span>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label class="form-label">e-mail ID<span class="asterisk text-danger"> *</span></label>
                    <input class="form-control required-field" type="email" name="agency_email" id="agency_email" placeholder="Type Email ID" required>
                    <span class="validation-message text-danger hidden">Please enter the input field.</span>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label class="form-label"> Full Address with Pincode <span class="asterisk text-danger"> *</span></label>
                    <input class="form-control required-field" type="text" name="agency_full_address" id="agency_full_address" placeholder="Type Full Address" required>
                    <span class="validation-message text-danger hidden">Please enter the input field.</span>
                </div>
				<div class="col-sm-12 col-md-6 col-lg-6">
                    <label class="form-label"> Event Type <span class="asterisk text-danger"> *</span></label>
					<select class="form-control required-field" name="agency_event_type" id="agency_event_type" required>
						<option value="">Select Event Type</option>
						<option value="Marriage">Marriage</option>
						<option value="Music Concert">Music Concert</option>
					</select>
                    <span class="validation-message text-danger hidden">Please enter the input field.</span>
                </div>
				<div class="col-sm-12 col-md-6 col-lg-6">
                    <label class="form-label"> Estimated number of person that will attend the Event <span class="asterisk text-danger"> *</span></label>
                    <input class="form-control required-field" type="text" name="agency_number_person" id="agency_number_person" placeholder="Estimated number of person" required>
                    <span class="validation-message text-danger hidden">Please enter the input field.</span>
                </div>
				<div class="col-sm-12">
                    <label class="form-label"> Event Description <span class="asterisk text-danger"> *</span></label>
                    <textarea class="form-control required-field" type="text" name="agency_event_description" id="agency_event_description" placeholder="Event Description" required></textarea>
                    <span class="validation-message text-danger hidden">Please enter the input field.</span>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-dark btn-bg-1 rounded-0 w-100">Submit Details</button>
                </div>
            </div>
            </form>            
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Provide Feedback</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 15px;">
                <form class="settings-form" method="post" action="<?= base_url('frontend/profile/submit_feedback'); ?>" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" class="form-control" id="booking_id" name="booking_id">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="tax_name" class="form-label">Feedback <span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="provide_feedback" placeholder="Write your feedback here" required>

                            </div>
                            <div class="col-md-12">
                                <label for="feedback_image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="feedback_image" placeholder="Image">
                            </div>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">SUBMIT</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="bookingModal" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking details</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 10px;">
                <div>
                    <h6 class="text-info mb-2">Venue Details</h6>
                    <div class="row g-2">
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <label for="" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location_name" readonly="">
                        </div>
                        <div class="col-sm-12 col-md-8 col-lg-9">
                            <label for="" class="form-label">Venue Name</label>
                            <input type="text" class="form-control" id="venue_name" readonly="">
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <label for="" class="form-label">Booking ID</label>
                            <input type="text" class="form-control" id="booking_id_dtl" readonly="">
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-5">
                            <label for="" class="form-label">Reservation Request Received on</label>
                            <input type="text" class="form-control" id="created_at" readonly="">
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="" class="form-label">Booking Amount</label>
                            <input type="text" class="form-control" id="booking_amount" readonly="">
                        </div>
                    </div>
                </div>
                <div>
                    <h6 class="text-info mt-3 mb-2">Details of the Reservee </h6>
                        <div class="row g-2">
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label nameType">Business Name </label>
                                <input type="text" class="form-control" id="name" readonly="">
                            </div>                                    
                            <div class="col-sm-12 col-md-4">                                        
                                <label for="" class="form-label">Contact No.</label>
                                <input type="text" class="form-control" id="contact" readonly="">
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">e-mail ID</label>
                                <input type="email" class="form-control" id="email" readonly="">
                            </div>
                            <div class="col-sm-12">
                                <label for="" class="form-label">Mailing Address with PIN Code </label>
                                <textarea class="form-control" name="" id="address" cols="" rows="3" readonly=""></textarea>
                            </div>
                            <!--<div class="col-sm-12 col-md-6">
                                <label for="" class="form-label">Purpose</label>
                                <textarea class="form-control" name="" id="purpose" cols="" rows="3" readonly=""></textarea>
                            </div>-->
                            
                            <!--if individual this section will hide, visible if it is filled by organisation-->
                                <!-- Contact Person Information Block (Initially Hidden) -->
                            <div class="col-12 contact-person-info" style="display: none;">
                                <h6 class="mt-3 text-info">Contact Person Information</h6>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4">
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="c_name" readonly="">
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label for="" class="form-label">Contact No.</label>
                                        <input type="text" class="form-control" id="c_contact" readonly="">
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label for="" class="form-label">e-mail ID</label>
                                        <input type="email" class="form-control" id="c_email" readonly="">
                                    </div>
                                </div>
                            <div>
                        </div>
                </div>   
                <div>
                    <!-- Agency Details Block (Initially Hidden) -->
                    <div class="agency-details" style="display: none;">   
                        <h6 class="text-info mb-2">Agency Details </h6>
                        <div class="row g-2">
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">Name </label>
                                <input type="text" class="form-control" id="a_name" readonly="">
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">Contact No.</label>
                                <input type="text" class="form-control" id="a_contact" readonly="">
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">e-mail ID</label>
                                <input type="email" class="form-control" id="a_email" readonly="">
                            </div>                                    
                            <div class="col-sm-12 col-md-8">
                                <label for="" class="form-label">Mailing Address with PIN Code </label>
                                <textarea class="form-control" name="" id="a_address" cols="" rows="2" readonly=""></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">GSTIN</label>
                                <input type="text" class="form-control" id="a_gst" value="" readonly="">
                            </div>
                        </div>
                    </div>
                </div>                  
                <div>
                    <h6 class="text-info mb-2">Payment Details</h6>
                    <!-- <div class="row g-2">                                     
                        <div class="col-sm-12 mb-3"> -->
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered app-table-hover mb-0 text-left paymentDetails">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="cell text-center">Date </th>
                                            <th class="cell text-right">Payable for the day Amount (INR)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="payment-details-body">
                                    </tbody>
                                </table> 
                            </div>
                       <!--  </div>
                    </div> -->
                </div>
                <div class="text-end"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>   
</div>

<div>
    <form action="<?php echo base_url('proceed-to-booking-payment')?>" method="POST" id="proceedPayment" style="display: none;">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <button class="btn btn-blue" id="ajaxSubmit">Proceed to Pay <i class="fa fa-long-arrow-right ml-2"></i></button>
    </form>
</div>
</section>
<!-- ============================ Dashboard End ================================== -->
<script>
    $('.feed_back').click(function() {
       var booking_id= $(this).data("booking_id")
        $('#myModal').modal('show');
        $('#booking_id').val(booking_id);
    });
</script>
<script>
$(document).ready(function() {    
	$("#booking-type").on("change", function() {
		var listType = $("#booking-type").val().toUpperCase();
	
		if (listType == 'UPCOMING') {
			$(location).attr("href", "<?= base_url('my-booking/' . base64_encode($this->encryption->encrypt('upcoming'))); ?>");
		}
		if (listType == 'PAST') {
			$(location).attr("href", "<?= base_url('my-booking/' . base64_encode($this->encryption->encrypt('past'))); ?>");
		}
		if (listType == 'ALL' || listType == '') {
			$(location).attr("href", "<?= base_url('my-booking/' . base64_encode($this->encryption->encrypt('all'))); ?>");
		}
	});

    /*$(document).on('click','.view_details', function() {
        let booking_id = $(this).data('booking_id');
        let venue_name=$(this).data('venue_name');
        let location_name=$(this).data('location_name');
        let created_at=$(this).data('created_at'); 
        let total_rate=$(this).data('total_rate'); 
        let organization_name=$(this).data('organization_name'); 
        let mailing_address=$(this).data('mailing_address'); 
        let contact_no=$(this).data('contact_no'); 
        let email=$(this).data('email'); 
        let contact_person=$(this).data('contact_person'); 
        let designation=$(this).data('designation');
        let reservation_date=$(this).data('reservation_date');

        $('#booking_id').text(booking_id);
        $('#venue_name').text(venue_name);
        $('#location_name').text(location_name);
        $('#reservation_date').text(reservation_date);
        $('#created_at').text(created_at);
        $('#total_rent').text(total_rate);
        $('#organization_name').text(organization_name);
        $('#mailing_address').text(mailing_address);
        $('#contact_no').text(contact_no);
        $('#email').text(email);
        $('#category_name').text(organization_name);
        $('#contact_person').text(contact_person);
        $('#designation').text(designation);

        $('#bookingModal').modal('show');
    })*/

     // Add a click event listener to the 'view details' button
     $(document).on('click', '.view_details', function() {
        let booking_id = $(this).data('booking_id');
        var csrf_token = "<?php echo $this->security->get_csrf_hash(); ?>";

        // Make an AJAX call to your controller method
        $.ajax({
            url: '<?php echo base_url('frontend/venue_booking/myVenueBookingList');?>',
            method: 'POST',
            data: { booking_id: booking_id,
            "<?php echo $this->security->get_csrf_token_name(); ?>": csrf_token
            },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    const booking = response.booking_list[0]; // Assuming there's only one booking
                    $('#bookingModal').modal('show');

                    // Populate the readonly input fields in the bookingModal
                    $('#booking_id_dtl').val(booking_id);
                    $('#venue_name').val(booking.venue_names);
                    $('#location_name').val(booking.property_name);
                    $('#created_at').val(formatDate(booking.created_at));
                    $('#booking_amount').val(booking.net_amount);
                          // Determine whether it's an agency or individual booking
                    if(booking.is_indivisual === "1")
                    {
                        $('.contact-person-info').hide();
                        $('.nameType').text('');
                        $('.nameType').text('Individual Name');
                        $('#name').val(booking.indivisual_full_name);
                        $('#address').text(booking.indivisual_full_address);
                        $('#contact').val(booking.indivisual_contact_no);
                        $('#email').val(booking.indivisual_email);
                        $('#purpose').text(booking.indivisual_purpose);

                    }
                    else
                    {
                        $('.nameType').text('');
                        $('.nameType').text('Organisation Name');
                        $('#name').val(booking.business_full_name);
                        $('#address').text(booking.business_full_address);
                        $('#contact').val(booking.business_contact_no);
                        $('#email').val(booking.business_email);
                        $('#purpose').text(booking.business_purpose);
                        $('.contact-person-info').show();
                        // Populate contact person details
                        $('#c_name').val(booking.contact_person_name);
                        $('#c_contact').val(booking.contact_person_contact_no);
                        $('#c_email').val(booking.contact_person_email);

                    }
                    
               
              
                   if (booking.is_agency === "1") {

                    // Populate agency details
                    $('#a_name').val(booking.agency_full_name);
                    $('#a_contact').val(booking.agency_contact_no);
                    $('#a_email').val(booking.agency_email);
                    $('#a_address').text(booking.agency_full_address);
                    $('#a_gst').val(booking.agency_gst_no);
                    // Agency booking, show agency details block
                    $('.agency-details').show();

                } else {
                    // Individual booking, show contact person info block
                    $('.agency-details').hide(); // Hide agency details
                }

                // Populate payment details dynamically
                const paymentDetailsBody = $('.paymentDetails .payment-details-body');
                paymentDetailsBody.empty(); // Clear existing rows

                booking.booking_details.forEach((detail) => {
                    const row = $('<tr>');
                    const dateCell = $('<td class="cell text-center">').text(formatDate(detail.start_date));
                    const rateCell = $('<td class="cell text-right">').text(detail.rate);

                    row.append(dateCell, rateCell);
                    paymentDetailsBody.append(row);
                });
                const dateCell = $('<td class="cell text-center fw-bold">').text('Total Amount');
                const rateCell = $('<td class="cell text-right fw-bold" id="total_amount"">').text(booking.total_rate);
                const row = $('<tr>');
                row.append(dateCell, rateCell);
                const dateCell1 = $('<td class="cell text-center fw-bold">').text((booking.gst_percentage)?'GST Amount('+booking.gst_percentage+'%)':'GST Amount(0.00%)');
                const rateCell1 = $('<td class="cell text-right fw-bold" id="gst_amount"">').text((booking.gst_amount)? booking.gst_amount:'0.00');
                const row1 = $('<tr>');

                row1.append(dateCell1, rateCell1);
                const dateCell2 = $('<td class="cell text-center fw-bold">').text('Total Payable Amount');
                const rateCell2 = $('<td class="cell text-right fw-bold" id="booking_amount"">').text(booking.net_amount);
                const row2 = $('<tr style="background: #4fd8f4;font-size: 1.1rem;">');

                row2.append(dateCell2, rateCell2);
                paymentDetailsBody.append(row);
                paymentDetailsBody.append(row1);
                paymentDetailsBody.append(row2);

                // Show the booking modal
                $('#bookingModal').modal('show');
                } else {
                    // Handle the case where the AJAX call did not return data
                    alert('Failed to retrieve booking details.');
                }
            },
            error: function() {
                // Handle AJAX call errors if needed
                alert('An error occurred during the AJAX call.');
            }
        });
    });

    // Function to format date as "dd-mm-YYYY H:i:s"
function formatDate(dateString) {
    const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
    const date = new Date(dateString);
    return date.toLocaleDateString('en-IN', options);}
     // Get the URL parameters
 const urlParams = new URLSearchParams(window.location.search);
        const tabType = urlParams.get('tab');
        // Get the lead_id from the URL path
        const pathArray = window.location.pathname.split('/');
        const lead_id_url = parseInt(pathArray[pathArray.length - 1]);
         // Activate the selected tab
         if (tabType === 'hall-venue') {
            $('#hall').addClass('active');
            $('#hall-venue').addClass('show active');
            $('#guest').removeClass('active');
            $('#guest-house').removeClass('show active');

        } else {
            $('#guest-house').addClass('active');
            $('#guest').addClass('show active');
            $('#hall').removeClass('active');
            $('#hall-venue').removeClass('show active');
        }
       // Add click event listeners to update the URL when a tab is clicked
       $('.nav-link').on('click', function() {
            const tabType = $(this).attr('data-bs-target').replace('#pills-', '');
            const contentType = $(this).attr('aria-controls');
            const url = '<?php echo base_url('my-booking');?>'+ '?tab=' + tabType;
            history.pushState(null, '', url);
        });

   $(document).on('click', '.pay_now', function() {
        //let amount = $(this).data('amount');
        let booking_id = $(this).data('booking_id');
        let surl = "<?php echo base_url('booking-venue-success')?>";
        let furl = "<?php echo base_url('booking-venue-failure')?>";
        var csrf_token = "<?php echo $this->security->get_csrf_hash(); ?>";

        //alert(amount);
        $.ajax({
            url:'<?php echo base_url('generate-venue-txnid')?>',
            method: 'post',
            data: {booking_id:booking_id,surl:surl,furl:furl, "<?php echo $this->security->get_csrf_token_name(); ?>": csrf_token,
},
            dataType: 'json',
            success: function(response){
                //console.log(response.txnid);
                if(response) {
                    
                    $( "#proceedPayment" ).submit();
                }
            }
        });    
       
    });
    $('.submit_agency').click(function () {
            // Get the data-id attribute value from the clicked button
            var dataId = $(this).data('id');
            
            // Set the value of the hidden input field in the modal
            $('#booking_id_agency').val(dataId);
            
            // Open the modal
            $('#agencyModal').modal('show');
        });

  // Handle form submission via AJAX
  $('#agencyForm').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            
            // Serialize the form data
            var formData = $(this).serialize();
               // Get the CSRF token from the hidden input field
            var csrf_token = "<?php echo $this->security->get_csrf_hash(); ?>";

            // Add the CSRF token to the data
            formData +='&<?php echo $this->security->get_csrf_token_name(); ?>='+ csrf_token;
            // Send an AJAX request to submit the form data
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'), // Form action URL
                data: formData,
                success: function (response) {
                    // Close the modal on success
                    $('#agencyModal').modal('hide');

                    // Redirect to the controller method's URL
                    window.location.href = "<?php echo base_url('my-booking?tab=hall-venue'); ?>";
                },
                error: function () {
                    // Handle errors if needed
                }
            });
        });
        
});
</script>
