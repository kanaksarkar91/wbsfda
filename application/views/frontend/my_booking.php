<section class="gray">
	<div class="container">
		<div class="row">

			<div class="col-lg-3 col-md-4 col-sm-12">
				<div class="dashboard-navbar dashboard-left-content">

					<div class="d-user-avater">
						<img src="<?= !is_null($this->session->userdata('profile_pic')) ? base_url('public/customer_images/' . $this->session->userdata('profile_pic')) : base_url('public/frontend_assets/images/user-icon.jpg') ?>" class="img-fluid avater w-75 rounded-circle" alt="">
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
							
							<input type="hidden" class="form-control" name="safari_type_id" id="safari_type_id" readonly="">
						</div>
					</div>

					<ul class="nav nav-pills mb-3 wbsfda_tab" id="pills-tab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="pills-ght-tab" data-bs-toggle="pill" data-bs-target="#pills-ght" type="button" role="tab" aria-controls="pills-ght" aria-selected="true"><i class="fas fa-hotel me-2"></i> Guest House</button>
						</li>
						<?php
						if(!empty($safariTypes)){
							foreach($safariTypes as $key => $row){
						?>
						<li class="nav-item" role="presentation">
							<button class="nav-link serviceType" id="pills-tab<?= $row['safari_type_id'];?>" data-bs-toggle="pill" data-bs-target="#pills-<?= $row['safari_type_id'];?>" type="button" role="tab" aria-controls="pills-<?= $row['safari_type_id'];?>" aria-selected="false" data-typeid="<?= $row['safari_type_id'];?>"><i class="<?= $row['safari_type_id'] == 1 ? 'fas fa-truck-pickup me-2' : 'fas fa-republican me-2';?>"></i> <?= $row['type_name'];?></button>
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
								<ul class="p-0 row">
								<?php
								if (!empty($booking_details)) {
                                    foreach ($booking_details as $bd) {
								?>
									<li class="pending-booking mb-3 col-12 col-lg-6 py-0 border-0">
										<div class="list-box-listing bookings border p-3 rounded">
											<!-- <div class="list-box-listing-img"><img src="https://wbsfdc.devserv.in/public/admin_images/property_images/1667898383172.jpg" alt=""></div> -->
											<div class="list-box-listing-content">
												<div class="inner">
													<h3><?= $bd['property_name'] ?> <span class="booking-status pending"><?= ($bd['booking_status'] == 'I') ? 'Initiate' : (($bd['booking_status'] == 'A') ? 'Approved' : (($bd['booking_status'] == 'C') ? 'Cancelled' : 'Check out')) ?></span>
													<?php if($bd['booking_status'] == 'C') { ?>
														<span class="badge badge-pill <?= ($bd['is_refunded'] == '1') ? 'badge-success' :'badge-warning'?>"><?= ($bd['is_refunded'] == '1') ? 'Refunded' :'Refund Initiated'?></span>
													<?php } ?>
													</h3>
													<div class="inner-booking-list d-flex">
														<span class="thm-txt fw-normal me-3">Booking No.:</span><span><?= $bd['booking_no']; ?></span>
													</div>
													<div class="inner-booking-list d-flex">
														<span class="thm-txt fw-normal me-3">Booking Date:</span><span><?= date('d-m-Y', strtotime($bd['check_in'])) ?> to <?= date('d-m-Y', strtotime($bd['check_out'])) ?></span>
													</div>
													<div class="inner-booking-list d-flex">
														<span class="thm-txt fw-normal me-3">Price:</span><span>₹ <?= $bd['net_payable_amount'] ?></span>
													</div>
													<div class="mt-3">
														<?php 
														if (($bd['booking_status'] == 'I' || $bd['booking_status'] == 'A') && strtotime($bd['check_in']) >= time()) { 
														if($bd['booking_source'] == 'F'){
														?> 
															<a target="_blank" class="btn btn-sm btn-danger" href="<?= base_url('view-invoice/' . encode_url($bd['booking_id']).'/?type=cancel') ?>">Cancel Booking</a>
														<?php } } ?>
														<a class="btn btn-dark btn-sm" href="<?= base_url('view-invoice/' . encode_url($bd['booking_id'])) ?>" target="_blank">View Details</a>
														<?php
														if ($bd['booking_status'] == 'A') {
														?>
														<a class="btn btn-sm btn-success" href="<?= base_url('download-invoice/' . encode_url($bd['booking_id'])) ?>" target="_blank"><i class="fa fa-download"></i> Download</a>
															

														<?php } ?>
													</div>
												</div>
											</div>
										</div>
									</li>
								<?php 
									} 
								}
								else{
								?>
									<li class="pending-booking mb-3 col-12 col-lg-6 py-0 border-0">No Booking Found!!</li>
								<?php } ?>
									
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
		$("#tabContentHtml").show();
		getSafariBookingHtml(safari_type_id, booking_type);
	});
	
	$("#booking_type").change(function(){ 
		var safari_type_id = $('#safari_type_id').val();
		var booking_type = $('#booking_type').val();
		getSafariBookingHtml(safari_type_id, booking_type);
	});
	
	$("#pills-ght-tab").click(function(){ 
		$("#tabContentHtml").hide();
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
			$("#safari_type_id").val(response.safari_type_id);
		}
		else{
			$("#tabContentHtml").html(response.html);
			$("#safari_type_id").val(response.safari_type_id);
		}
		
	});
}
</script>