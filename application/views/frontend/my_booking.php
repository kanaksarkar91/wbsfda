<section class="gray">
	<div class="container">
		<div class="row">

			<div class="col-lg-3 col-md-4 col-sm-12">
				<div class="dashboard-navbar dashboard-left-content">

					<div class="d-user-avater">
						<img src="<?= !is_null($this->session->userdata('profile_pic')) ? base_url('public/customer_images/' . $this->session->userdata('profile_pic')) : base_url('public/frontend_assets/images/user-icon.jpg') ?>" class="img-fluid avater w-75" alt="">
						<h5 class="fw-bold thm-txt mt-3"><?=$this->session->userdata('first_name')?> </h5>
						<span></span>
					</div>

					<div class="d-navigation">
						<ul class="dashboard-list">
							<li class="list"><a href="<?= base_url('my-profile');?>"><i class="bi bi-person-fill"></i> My Profile</a></li>
							<li class="list active"><a href="<?= base_url('my-booking');?>"><i class="bi bi-clipboard2-check-fill"></i> My Booking</a></li>
							<li class="list"><a href="<?= base_url('logout');?>"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
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
						<h4 class="fw-normal thm-txt">Booking List</h4>
						<div>
							<select id="booking_type" name="booking_type" class="form-select">
								<option value="ALL" selected="selected">All Booking</option>
								<option value="UPCOMING">Upcoming Booking</option>
								<option value="PAST">Past Booking</option>
							</select>
						</div>
					</div>

					<ul class="nav nav-pills mb-3 wbsfda_tab" id="pills-tab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="pills-ght-tab" data-bs-toggle="pill" data-bs-target="#pills-ght" type="button" role="tab" aria-controls="pills-ght" aria-selected="true">Guest House</button>
						</li>
						<?php
						if(!empty($safariTypes)){
							foreach($safariTypes as $key => $row){
						?>
						<li class="nav-item" role="presentation">
							<button class="nav-link serviceType" id="pills-tab<?= $row['safari_type_id'];?>" data-bs-toggle="pill" data-bs-target="#pills-<?= $row['safari_type_id'];?>" type="button" role="tab" aria-controls="pills-<?= $row['safari_type_id'];?>" aria-selected="false" data-typeid="<?= $row['safari_type_id'];?>"><?= $row['type_name'];?></button>
						</li>
						<?php } } ?>
						<!--<li class="nav-item" role="presentation">
							<button class="nav-link" id="pills-est-tab" data-bs-toggle="pill" data-bs-target="#pills-est" type="button" role="tab" aria-controls="pills-est" aria-selected="false">Elephant Safari</button>
						</li>-->
					</ul>
					<div class="tab-content" id="pills-tabContent">
						
						
						<div class="tab-pane fade show active" id="pills-ght" role="tabpanel" aria-labelledby="pills-ght-tab" tabindex="0">
							<!--Guest House Tab-->
							<div class="dashboard-gravity-list mt-3">
								<ul class="p-0">
									<li class="pending-booking mb-3">
										<div class="list-box-listing bookings">
											<div class="list-box-listing-img"><img src="https://wbsfdc.devserv.in/public/admin_images/property_images/1667898383172.jpg" alt=""></div>
											<div class="list-box-listing-content">
												<div class="inner">
													<h3>Amrapali Guest House Complex <span class="booking-status pending">Approved</span>
													</h3>
													<div class="inner-booking-list d-flex">
														<span class="thm-txt fw-normal me-3">Booking No.:</span><span>AB20230929518165</span>
													</div>
													<div class="inner-booking-list d-flex">
														<span class="thm-txt fw-normal me-3">Booking Date:</span><span>30-09-2023 to 01-10-2023</span>
													</div>
													<div class="inner-booking-list d-flex">
														<span class="thm-txt fw-normal me-3">Price:</span><span>₹ 3136.00</span>
													</div>
													<div class="mt-3">
														<a class="btn btn-dark btn-sm" href="#." target="_blank">View Details</a>
													</div>
												</div>
											</div>
										</div>
									</li>
									<li class="pending-booking mb-3">
										<div class="list-box-listing bookings">
											<div class="list-box-listing-img"><img src="https://wbsfdc.devserv.in/public/admin_images/property_images/1667898383172.jpg" alt=""></div>
											<div class="list-box-listing-content">
												<div class="inner">
													<h3>Amrapali Guest House Complex <span class="booking-status pending">Approved</span>
													</h3>
													<div class="inner-booking-list d-flex">
														<span class="thm-txt fw-normal me-3">Booking No.:</span>
														<span>AB20231031278835</span>
													</div>
													<div class="inner-booking-list d-flex">
														<span class="thm-txt fw-normal me-3">Booking Date:</span>
														<span>01-11-2023 to 02-11-2023</span>
													</div>
													<div class="inner-booking-list d-flex">
														<span class="thm-txt fw-normal me-3">Price:</span>
														<span>₹ 896.00</span>
													</div>
													<div class="mt-3">
														<a class="btn btn-dark btn-sm" href="#." target="_blank">View Details</a>
													</div>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<!--// Guest House Tab-->
						</div>
						
						<div id="tabContentHtml">
						
						</div>
						
						<?php /*?><div class="tab-pane fade" id="pills-est" role="tabpanel" aria-labelledby="pills-est-tab" tabindex="0">
							<!--Elephant Safari Tab-->
							<h5>Elephant Safari</h5>
							<!--// Elephant Safari Tab-->
						</div><?php */?>
						
						
						
					</div>



					<div id="guest-house" class="tab-content-item active">

					</div>

					<div id="hall-venue" class="tab-content-item">
						<div class="dashboard-gravity-list mt-3">
							<ul>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
	
<script>
$(document).ready(function(){

	$(".serviceType").click(function(){ 
		var safari_type_id = $(this).data('typeid');
		var booking_type = $('#booking_type').val();
		getSafariBookingHtml(safari_type_id, booking_type);
	});
	
	$("#booking_type").change(function(){ 
		var safari_type_id = $('.serviceType').data('typeid');
		var booking_type = $('#booking_type').val();
		getSafariBookingHtml(safari_type_id, booking_type);
	});
});

function getSafariBookingHtml(safari_type_id, booking_type){
	
	$.ajax({
		type: 'POST',	
		url: '<?= base_url("safari-booking-html"); ?>',
		data: {
			safari_type_id: safari_type_id,
			booking_type: booking_type,
			csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'
		},
		dataType: 'json',
		encode: true,
		async: false
	})
	//ajax response
	.done(function(response){
		if(response.status){
			$("#tabContentHtml").html(response.html);
		}
		else{
			$("#tabContentHtml").html(response.html);
		}
		
	});
}
</script>