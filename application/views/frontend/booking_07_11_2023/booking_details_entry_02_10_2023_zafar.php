<!-- ============================ Page Title Start================================== -->
<div class="image-cover page-title" style="background:url(<?= base_url('public/frontend_assets/assets/img/slider/06.jpg'); ?>) no-repeat; background-size: cover; background-position: center;" data-overlay="6">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">

				<h2 class="ipt-title">Checkout</h2>
				<span class="ipn-subtitle text-light">Checkout page short tagline</span>

			</div>
		</div>
	</div>
</div>
<!-- ============================ Page Title End ================================== -->


<!-- =================== Sidebar Search ==================== -->
<section class="gray">
	<div class="container">
		<div class="row">
			<?php if($this->session->userdata('logged_in') && $this->session->userdata('user_type') == 'frontend') { ?>
			<div class="col-lg-8 col-md-7">

				<!-- 1st Step Checkout -->
				<div class="checkout-wrap">

					<div class="checkout-head">
						<ul>
							<li class="active"><span><i class="ti-check"></i></span>Customer Detail</li>
							<li><span>2</span>Payment Information</li>
							<li><span>3</span>Confirmation!</li>
						</ul>
					</div>
					
					<form action="" method="post" id="paymentForm">
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
					<div class="checkout-body">
                        <div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<h4 class="mb-3 fw-normal thm-txt">Guest Detail</h4>
							</div>
							<div class="col-12">
							    <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="guest_type" id="guestType1" value="1" <?= set_checkbox('guest_type', '1', true); ?>>
                                  <label class="form-check-label" for="guestType1">Individual</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="guest_type" id="guestType2" value="2" <?= set_checkbox('guest_type', '2'); ?>>
                                  <label class="form-check-label" for="guestType2">Organization</label>
                                </div>
							</div>
						</div>

                        <div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label>First Name<i class="req">*</i></label>
									<input type="text" name="booking_fname" id="booking_fname" class="form-control text_capitalized">
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label>Last Name<i class="req">*</i></label>
									<input type="text" name="booking_lname" id="booking_lname" class="form-control text_capitalized">
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label>Gender<i class="req">*</i></label>
									<select class="form-control" name="booking_gender" id="booking_gender">
										<option value="">Select Gender</option>
										<option value="Male" <?= set_select('booking_gender', 'Male'); ?>>Male</option>
										<option value="Female" <?= set_select('booking_gender', 'Female'); ?>>Female</option>
										<option value="Other" <?= set_select('booking_gender', 'Other'); ?>>Transgender</option>
									</select>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label>Age<i class="req">*</i></label>
									<select class="form-control" name="booking_age" id="booking_age">
										<option value="">Select Age</option>
										<?php for ($i = 18; $i <= 120; $i++) { ?>
										<option value="<?= $i; ?>" <?= set_select('booking_age', $i); ?>><?= $i; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label>Email<i class="req">*</i></label>
									<input type="email" name="booking_email" id="booking_email" class="form-control">
								</div>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label>Mobile No.<i class="req">*</i></label>
									<input type="number" name="booking_mobile" id="booking_mobile" class="form-control">
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-12" id="org_name" style="display: none;">
								<div class="form-group">
									<label>Organisation Name</label>
									<input type="text" name="booking_organisation_name" id="booking_organisation_name" class="form-control text_capitalized">
								</div>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12" id="org_gstin" style="display: none;">
								<div class="form-group">
									<label>GSTIN</label>
									<input type="text" name="booking_organisation_gstin" id="booking_organisation_gstin" class="form-control">
								</div>
							</div>
							
							<!--
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label>Country<i class="req">*</i></label>
									<select name="booking_country" id="country" class="form-control">
										<option value="101" selected>India</option>
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label>State<i class="req">*</i></label>
									<select name="booking_state" id="choose-state" class="form-control">
										<?php
										if (isset($states))
											foreach ($states as $state) {
										?>
											<option value="<?= $state['state_id']; ?>"><?= $state['state_name']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label>City<i class="req">*</i></label>
									<input type="text" name="booking_city" class="form-control">
								</div>
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="form-group">
									<label>Address</label>
									<textarea name="booking_address" class="form-control"></textarea>
								</div>
							</div>-->
							
							<?php /*?><div class="col-lg-12 col-md-12 col-sm-12">
								<div class="table-responsive">
									<table class="table app-table-hover mb-0 text-left table-bordered">
										<thead class="thead-dark">
											<tr>
												<th class="cell">Date Range</th>
												<th class="cell">Cancellation Charge (%)</th>
												<th class="cell">Refund Amount (₹)</th>
											</tr>
										</thead>
										<tbody>
										<?php 
											$i=0;
											if(!empty($plicies)){
												$cancellation_amount = '';
												$refund_amount = '';
												
												foreach($plicies as $policy) {
													
													if($policyId >= $policy->cancellation_policy_id){
													
														$dateFrom = '';
														$dateTo = '';
														$today = date('Y-m-d');
														
														$dateFrom = date("Y-m-d", strtotime("$checkInDt -$policy->day_from days"));
														$dateTo = date("Y-m-d", strtotime("$checkInDt -$policy->day_to days"));
														
														$dateToShow = ($dateTo < date('Y-m-d')) ? date('Y-m-d') : $dateTo;
														
														$cancellation_amount = (($policy->cancellation_per * $amounts['total_amount']) / 100);
														$refund_amount = ($amounts['total_amount'] - $cancellation_amount);
													
										?>
													<tr>
														<th class="cell"><?= date('d M Y', strtotime($dateToShow)).' To '.date('d M Y', strtotime($dateFrom));?></th>
														<th class="cell text-center"><?= number_format($policy->cancellation_per);?></th>
														<th class="cell text-right"><?= '₹&nbsp;'.number_format(floatval($refund_amount), 2, '.', ','); ?></th>
													</tr>
											<?php
													}
												} 
											}
											?>
		
										</tbody>
									</table>
								</div>
							</div><?php */?>

							 <div class="col-lg-6 col-md-6 col-sm-12" style="margin-top:20px;">
								<div class="form-group">
									<input id="checkbox" type="checkbox" checked="checked"  class="checkbox-custom">
									<label for="checkbox" class="checkbox-custom-label"><a href="#." class="text-dark" id="view_terms">I accept the terms & conditions.</a><!--  <a style="text-decoration:underline; cursor:pointer; color:#8080FF;" data-toggle="modal" data-target="#termsModal" id="view_terms">View terms</a> --></label>
								</div>
							</div> 
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="form-group text-center">
									<?= validation_errors();?>
									<?= isset($err_msg) && $err_msg != '' ? $err_msg : ''; ?>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="form-group text-center">
									<input type="submit" class="btn btn-theme" value="Proceed to Pay" id="pay_btn">
								</div>
							</div>

						</div>
					</div>
					</form>
				</div>
			</div>
			<?php } else { ?>
			<div class="col-lg-8 col-md-7">
				<div class="checkout-wrap">
					<div class="checkout-body">
                        <div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 mb-3">
								<h5 class="text-center">Please Login to continue with the booking.</h5>
							</div>
						</div>
						
						
						<?php /*?><div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="table-responsive">
									<table class="table app-table-hover mb-0 text-left table-bordered">
										<thead class="thead-dark">
											<tr>
												<th class="cell">Date Range</th>
												<th class="cell">Cancellation Charge (%)</th>
												<th class="cell">Refund Amount (₹)</th>
											</tr>
										</thead>
										<tbody>
										<?php 
											$i=0;
											if(!empty($plicies)){
												$cancellation_amount = '';
												$refund_amount = '';
												
												foreach($plicies as $policy) {
													
													if($policyId >= $policy->cancellation_policy_id){
													
														$dateFrom = '';
														$dateTo = '';
														$today = date('Y-m-d');
														
														$dateFrom = date("Y-m-d", strtotime("$checkInDt -$policy->day_from days"));
														$dateTo = date("Y-m-d", strtotime("$checkInDt -$policy->day_to days"));
														
														$dateToShow = ($dateTo < date('Y-m-d')) ? date('Y-m-d') : $dateTo;
														
														$cancellation_amount = (($policy->cancellation_per * $amounts['total_amount']) / 100);
														$refund_amount = ($amounts['total_amount'] - $cancellation_amount);
													
										?>
													<tr>
														<th class="cell"><?= date('d M Y', strtotime($dateToShow)).' To '.date('d M Y', strtotime($dateFrom));?></th>
														<th class="cell text-center"><?= number_format($policy->cancellation_per);?></th>
														<th class="cell text-right"><?= '₹&nbsp;'.number_format(floatval($refund_amount), 2, '.', ','); ?></th>
													</tr>
											<?php
													}
												} 
											}
											?>
		
										</tbody>
									</table>
								</div>
							</div>
						</div><?php */?>
						
						
						
						<div class="row" style="margin-top:40px;">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="form-group text-center">
										<input id="checkbox" type="checkbox" checked="checked"  class="checkbox-custom">
										<label for="checkbox" class="checkbox-custom-label"><a href="#." class="text-dark" id="view_terms">I accept the terms & conditions.</a><!--  <a style="text-decoration:underline; cursor:pointer; color:#8080FF;" data-toggle="modal" data-target="#termsModal" id="view_terms">View terms</a> --></label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="form-group text-center">
									<a href="#" id="booking_login" class="btn btn-theme" data-toggle="modal" data-target="#login" data-redirect="1">Login to Continue</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
				
			<div class="col-lg-4 col-md-5">
				<div class="checkout-side">
					<div class="booking-short">
						<img src="assets/images/hotel/hotel-inner-1.jpg" class="img-fluid" alt="" />
						<h5 class="thm-txt fw-normal"><?= $property['property_name']; ?></h5>
						<p><small><?= $property['address_line_1'] . ', ' . $property['address_line_2'] . ', ' . $property['city']; ?></small></p>
						<p class="text-dark fw-bold">Total Length of Stay:</p>
						<p><span><?= $no_nights; ?> Night <?= $no_nights + 1; ?> Days</span></p>
					</div>

					<div class="booking-short-side">
						<div class="accordion" id="accordionExample">
							<div class="card">
								<div class="card-header" id="bookinDet">
									<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#bookinSer" aria-expanded="true" aria-controls="bookinSer">
										Booking Details
									</button>
								</div>
								<div id="bookinSer" class="collapse show" aria-labelledby="bookinDet" data-parent="#accordionExample">
									<div class="card-body p-0 paybox">
										<ul class="booking-detail-list">
										    <li><b class="text-dark"> <strong> Check in - Check out:</strong></b><?= date('d M Y', strtotime($checkInDt)) . ' - ' . date('d M Y', strtotime($checkOutDt)); ?></li>
										    <li><b class="text-dark"> <strong> Total Length of Stay: </strong></b><?= $no_nights; ?> Night <?= $no_nights + 1; ?> Days</li> 
											<li>Adults:<span><?= $adultCount; ?></span></li>
											<li>Children:<span><?= $childCount; ?></span></li>
											<li>Price: <span class="h6">₹<?= isset($amounts['total_amount']) && $amounts['total_amount'] != '' ? number_format(floatval($amounts['total_amount']), 2, '.', ',') : ''; ?></span></li>
											<li>
											    <!--<div>Coupon: </div>-->
											        <div class="input-group">
														<input type="hidden" name="coupon_property_id" id="coupon_property_id" value="<?= isset($property['property_id']) && $property['property_id'] != '' ? $property['property_id'] : ''; ?>" />
														<input type="text" name="coupon" id="coupon" class="form-control" placeholder="Add Coupon" style="height:42px;border:1px solid #e6eaf3;border-radius:0;" <?= isset($coupon_det) && $coupon_det->coupon_code != '' ? 'value="' . $coupon_det->coupon_code . '" readonly="true"' : ''; ?> />
                                                        <div class="btn btn-sm btn-theme pt-2"><?= isset($coupon_det) && $coupon_det->coupon_code != '' ? '<span id="coupon_action" data-type="remove" class="text-white">Remove</span>' : '<span id="coupon_action" data-type="apply" class="text-white">Apply</span>'; ?>
											            </div>
                                                    </div>
											    <p id="coupon_msg"></p>
											</li>
											<?php if(isset($coupon_det) && $coupon_det->coupon_code != '') { ?>
											<li>Discount: <span class="h6">₹<?= isset($amounts['discount_amount']) && $amounts['discount_amount'] != '' ? number_format(floatval($amounts['discount_amount']), 2, '.', ',') : '0.00'; ?></span></li>
											<?php } ?>
											<li>GST: <span class="h6">₹<?= isset($amounts['gst_amount']) && $amounts['gst_amount'] != '' ? number_format(floatval($amounts['gst_amount']), 2, '.', ',') : '0.00'; ?></span></li>
											<li class="totalprice">Total Payment <span class="h5">₹<?= isset($amounts['grand_total']) && $amounts['grand_total'] != '' ? number_format(floatval($amounts['grand_total']), 2, '.', ',') : ''; ?></span></li>
											
										</ul>
									</div>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="max-width: 80%;" role="document">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Terms & Conditions</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="close_modal" style="cursor:pointer;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 15px;">
                
                        <div class="row">
                            <div class="col-md-12">
								<strong>1. Cancellation Charges:</strong><br /><br />
                                <p style="font-size:13px;">Cancellation charges will be applied on the following terms: -<br />
 
								<strong>i).</strong> No refund is admissible if the booking cancels before 48 hours from the date & time of Check-in as mentioned in the booking slip.<br />
								
								<strong>ii).</strong> 50% out of the total booking amount (excluding GST) will be deducted if the booking cancels before 49 to 144 hours (i.e. 3 to 6 days) from the date & time of Check-in as mentioned in the booking slip.<br />
								
								<strong>iii).</strong> 30% out of the total booking amount (excluding GST) will be deducted if the booking cancels before 145 to 360 hours (i.e. 7 to 15 days) from the date & time of Check-in as mentioned in the booking slip.<br />
								
								<strong>iv).</strong> 20% out of the total booking amount (excluding GST) will be deducted if the booking cancels before 361 to 720 hours (i.e. 16 to 30 days) from the date & time of Check-in as mentioned in the booking slip.<br />
								
								<strong>v).</strong> 10% out of the total booking amount (excluding GST) will be deducted if the booking cancels beyond 721 hours (i.e. 30 days onwards) from the date & time of Check-in as mentioned in the booking slip.<br /><br />
								 
								
								<strong>***</strong> Check-in date & time is when the border will enter in the booking property as mentioned in the booking slip generated from the Panchayat Tourism portal after completion of full payment by the border.<br />
								
								<strong>****</strong> All the calculations of cancellation will be based on the Check-in date & time.</p>

                            </div>
                        </div>
						
						<div class="row" style="margin-top:10px;">
                            <div class="col-md-12">
                                <strong>2. Refund Rules:</strong><br /><br />
                                <p style="font-size:13px;">
 
								<strong>i).</strong> Amount collected as GST with a booking transaction will not be refunded under any circumstances if the cancellation of the booking is initiated by the guest/user.<br />
								
								<strong>ii).</strong> No amount will be refunded in a case of NO SHOW.</p>
                            </div>
                        </div>
                    
                
            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-primary" id="close_button">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- =================== Sidebar Search ==================== -->
<script type="text/javascript">
	window.history.forward();
	function noBack() {
		window.history.forward();
	}
</script>
<script>
$(document).ready(function() {
	customerSection();
});

function customerSection() {
	var guestType = $('input:radio[name="guest_type"]:checked').val();
	var firstName = "<?= isset($customer_det) && $customer_det->first_name != '' ? $customer_det->first_name : ''; ?>";
	var lastName = "<?= isset($customer_det) && $customer_det->last_name != '' ? $customer_det->last_name : ''; ?>";
	var gender = "<?= isset($customer_det) && $customer_det->gender != '' ? $customer_det->gender : ''; ?>";
	var age = "<?= isset($customer_det) && $customer_det->age != '' ? $customer_det->age : ''; ?>";
	var email = "<?= isset($customer_det) && $customer_det->email != '' ? $customer_det->email : ''; ?>";
	var mobile = "<?= isset($customer_det) && $customer_det->mobile != '' ? $customer_det->mobile : ''; ?>";
	
	if (guestType == "1") {
		$("#booking_fname").val(firstName);
		$("#booking_lname").val(lastName);
		$('#booking_gender [value='+ gender +']').attr('selected', 'true');
		$('#booking_age [value='+ <?= $customer_det->age;?> +']').attr('selected', 'true');
		$("#booking_email").val("<?= $customer_det->email;?>");
		$("#booking_mobile").val(mobile);
		
		//$("#booking_fname").attr("readonly", "true");
		//$("#booking_lname").attr("readonly", "true");
		//$("#booking_gender").attr("readonly", "true");
		//$("#booking_age").attr("readonly", "true");
		//$("#booking_email").attr("readonly", "true");
		//$("#booking_mobile").attr("readonly", "true");
		$("#org_name").css("display", "none");
		$("#org_gstin").css("display", "none");
	}
	if (guestType == "2") {
		$("#booking_fname").val("<?= set_value('booking_fname'); ?>");
		$("#booking_lname").val("<?= set_value('booking_lname'); ?>");
		//$("#booking_gender").val("<?= set_value('booking_gender'); ?>");
		//$("#booking_age").val("<?= set_value('booking_age'); ?>");
		$("#booking_email").val("<?= set_value('booking_email'); ?>");
		$("#booking_mobile").val("<?= set_value('booking_mobile'); ?>");
		$("#booking_organisation_name").val("<?= set_value('booking_organisation_name'); ?>");
		$("#booking_organisation_gstin").val("<?= set_value('booking_organisation_gstin'); ?>");
		
		//$("#booking_fname").removeAttr("readonly");
		//$("#booking_lname").removeAttr("readonly");
		//$("#booking_gender").removeAttr("disabled");
		//$("#booking_age").removeAttr("disabled");
		//$("#booking_email").removeAttr("readonly");
		//$("#booking_mobile").removeAttr("readonly");
		$("#org_name").css("display", "block");
		$("#org_gstin").css("display", "block");
	}
}
</script>
<script>
$(document).ready(function() {
	$('input[name="guest_type"]').on("change", function() {
		customerSection();
	});
});
</script>
<script>customerSection();</script>
<script>
$(document).ready(function() {
	$("#coupon_action").on("click", function() {
		if ($(this).data('type') == 'apply') {
			var coupon_code = $("#coupon").val();
			var property_id = $("#coupon_property_id").val();
			$('#coupon_msg').html("");
			
			if (coupon_code != '') {
				$.ajax({
					url: '<?= base_url('frontend/booking/booking_coupon'); ?>',
					method: 'post',
					data: {coupon_code: coupon_code, propertyId: property_id, csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'},
					dataType: 'json',
				}).done(function(data) {
					if (data != null) {
						if (data.success) {
							window.location.reload(true);
						} else {
							$('#coupon_msg').html(data.msg);
						}
					} else {
						$('#coupon_msg').html("An unexpected error occured.");
					}
				});
			} else {
				alert('Please enter a coupon code first.');
			}
		}
		if ($(this).data('type') == 'remove') {
			$.ajax({
					url: '<?= base_url('frontend/booking/booking_coupon'); ?>',
					method: 'post',
					data: {type: 'remove', csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'},
					dataType: 'json',
				}).done(function(data) {
					if (data != null) {
						if (data.success) {
							window.location.reload(true);
						} else {
							$('#coupon_msg').html(data.msg);
						}
					} else {
						$('#coupon_msg').html("An unexpected error occured.");
					}
				});
		}
		console.log($(this).data('type'));
	});
});
</script>
<script>
$(document).ready(function() {
	$("#pay_btn").on("click", function() {
		$("#pay_btn").attr('disabled', 'disabled');
		$("#paymentForm").submit();
	});
	
	$(document).on('click', '#view_terms', function() {
	   $('#myModal').modal('show');
    });
	
	$(document).on('click', '#close_button', function() {
	   $('#myModal').modal('hide');
    });
	
	$('#checkbox').click(function() {
	  if(!$(this).is(':checked')){
		$('#booking_login').bind('click', function(){ 
			
			return false; 
		
		});
		$('#pay_btn').attr("disabled","disabled"); 
	  }else{
		$('#booking_login').unbind('click');
		$('#pay_btn').removeAttr('disabled');
	  }
	});
});
</script>