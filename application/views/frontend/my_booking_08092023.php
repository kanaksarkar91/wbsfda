<!-- ============================ Page Title Start================================== -->
<div class="image-cover page-title" style="background:url(<?= base_url('public/frontend_assets/assets/img/slider/06.jpg'); ?>) no-repeat; background-size: cover; background-position: center;" data-overlay="6">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <h2 class="ipt-title">My Booking</h2>
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
                        <img src="<?= !is_null($this->session->userdata('profile_pic')) ? base_url('public/customer_images/' . $this->session->userdata('profile_pic')) : base_url('public/frontend_assets/images/user-icon.jpg') ?>" class="img-fluid avater" alt="">
                        <h4 class="fw-normal thm-txt mt-4"><?= $this->session->userdata('first_name') ?> <?= $this->session->userdata('last_name') ?></h4>
                        <span><?= $this->session->userdata('city') ?></span>
                    </div>

                    <div class="d-navigation">
                        <ul class="dashboard-list list-style-none">
                            <li class="list"><a href="<?= base_url('my-profile') ?>"><i class="ti-user"></i>My Profile</a></li>
                            <li class="list active"><a href="<?= base_url('my-booking') ?>"><i class="ti-layers"></i>My Booking List</a></li>
                            <li class="list"><a href="<?= base_url('logout') ?>"><i class="ti-power-off"></i>Log Out</a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="dashboard-wraper single-reservation bg-white base-padding">
                    <?php if ($this->session->flashdata('success_msg')) : ?>
                        <div class="alert alert-success">

                            <?= $this->session->flashdata('success_msg') ?>
                        </div>
                    <?php endif ?>
                    <?php if ($this->session->flashdata('error_msg')) : ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error_msg') ?>
                        </div>
                    <?php endif ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fw-normal thm-txt">My Booking List</h4>
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
                        <li class="ml-0 active" data-tab="guest-house"> Guest House </li>
                        <li data-tab="hall-venue"> Hall & Venue </li>
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
                                <li class="pending-booking mb-3">
                                    <div class="list-box-listing bookings">
                                        <div class="list-box-listing-img"><img src="https://wbsfdc.devserv.in/public/admin_images/property_images/06fd9846-64ee-440c-b01f-3bc54f194e8c1.jpg" alt=""></div>
                                        <div class="list-box-listing-content">
                                            <div class="inner">
                                                <h3>Red Fort Hall with AC (area 893 sq. ft.) <span class="booking-status pending">Pending</span></h3>                                                        
                                                <div class="inner-booking-list d-flex">
                                                    <span class="thm-txt fw-normal me-3">Address:</span> <span>NALBAN FOOD PARK</span> <span>Salt Lake</span>
                                                </div>
                                                <div class="inner-booking-list d-flex">
                                                    <span class="thm-txt fw-normal me-3">Booking ID.:</span><span>PB20230831774624</span>
                                                </div>
                                                <div class="inner-booking-list d-flex">
                                                    <span class="thm-txt fw-normal me-3">Booking Date:</span><span>01-09-2023 to 02-09-2023</span>
                                                </div>
                                                <div class="inner-booking-list d-flex">
                                                    <span class="thm-txt fw-normal me-3">Price:</span><span>₹ 4928.00</span>
                                                </div>
                                                <div class="mt-3">
                                                    <a class="btn btn-sm btn-primary" href="#." target="_blank">View Details</a>
                                                    <a class="btn btn-sm btn-success" href="#." target="_blank"><i class="fa fa-download"></i> Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<!-- ============================ Dashboard End ================================== -->

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
});
</script>