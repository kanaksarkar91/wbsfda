<section class="gray">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				
			<?php if($this->session->userdata('logged_in') && $this->session->userdata('user_type') == 'frontend') { ?>
				<div class="checkout-wrap">
					<div class="checkout-body pt-0">
						<h5 class="thm-txt fw-bold"><?= $serviceData['service_definition'];?></h5>
						<p class="fw-bold text-dark"><?= $serviceData['division_name'];?></p>
						<div class="row m-0">
							<div class="col-12 col-sm-12 col-md-4 col-xl-2 small bg-light border p-2">
								<strong>Starting Point</strong>
								<div>
									<?= $serviceData['start_point'];?>
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-4 col-xl-2 small bg-light border p-2">
								<strong>End Point</strong>
								<div>
									<?= $serviceData['end_point'];?>
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-4 col-xl-2 small bg-light border p-2">
								<strong>Reporting Place</strong>
								<div>
									<?= $serviceData['reporting_place'];?>
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-4 col-xl-2 small bg-light border p-2">
								<strong>Safari Date</strong>
								<div>
									<?= $saf_booking_date;?>
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-4 col-xl-2 small bg-light border p-2">
								<strong>Slot</strong>
								<div>
									<?= $foundSlot['slot_desc'].': '.$foundSlot['start_time'].' to '.$foundSlot['end_time'];?>
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-4 col-xl-2 small bg-light border p-2">
								<strong>Reporting Time:</strong>
								<div>
									<?= $foundSlot['reporting_time'];?>
								</div>
							</div>

							<div class="col-12 small bg-light border p-2">
								<strong>Route</strong>
								<div>
									<?= $serviceData['route_desc'];?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 mt-3">
								<h6 class="fw-bold">Important Information:</h6>
								<p class="fst-italic small">
									<b class="thm-txt"><?= $serviceData['division_name'];?>:</b><br>
									<span><?= $serviceData['additional_info'];?></span>
								</p>
							</div>
						</div>
					</div>
				</div>


				<!-- 1st Step Checkout -->
				<div class="checkout-wrap">
					<div class="checkout-head">
						<ul>
							<li class="active"><span><i class="bi bi-check-lg"></i></span>Visitor Detail</li>
							<li><span>2</span>Payment Information</li>
							<li><span>3</span>Confirmation!</li>
						</ul>
					</div>

					<form action="" method="post" id="paymentForm" autocomplete="off">
						<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
						<div class="checkout-body">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group text-center <?php if(isset($err_msg) && $err_msg != '') { ?> alert alert-danger <?php } ?>">
										<?php /*?><?= validation_errors();?><?php */?>
										<?= isset($err_msg) && $err_msg != '' ? $err_msg : ''; ?>
									</div>
								</div>
							
								<div class="col-lg-3 col-md-6 col-sm-12">
									<div class="form-group">
										<label>Nationality <i class="req">*</i></label><br />
										<h5 class="text-dark"><?= $safariCatData['cat_name'];?></h5>
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-sm-12">
									<div class="form-group">
										<label>No of Person <i class="req">*</i></label><br />
										<h5 class="text-dark"><?= $no_of_visitor;?></h5>
									</div>
								</div>

								<div class="col-lg-3 col-md-6 col-sm-12">
									<div class="form-group">
										<label>Email <i class="req">*</i></label><br />
										<h5 class="text-dark"><?= isset($customer_det) && $customer_det->email != '' ? $customer_det->email : ''; ?></h5>
									</div>
								</div>

								<div class="col-lg-3 col-md-6 col-sm-12">
									<div class="form-group">
										<label>Mobile No.<i class="req">*</i></label><br />
										<h5 class="text-dark"><?= isset($customer_det) && $customer_det->mobile != '' ? $customer_det->mobile : ''; ?></h5>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<h5 class="mb-3 fw-bold thm-txt">Add Visitor Details:</h5>
									<div class="table-responsive border border-bottom-0 my-3">
										<table class="table table-hover table-sm align-middle mb-0">
											<thead>
												<tr class="table-light">
													<th class="light-grn-bg">Name</th>
													<th class="light-grn-bg">Gender</th>
													<th class="light-grn-bg">Age</th>
													<th class="light-grn-bg">ID Type</th>
													<th class="light-grn-bg">ID Number</th>
												</tr>
											</thead>
											<tbody>
											<?php for($i = 0; $i <= $no_of_visitor - 1; $i++) { ?>
												<tr>
													<td>
														<input type="text" name="visitor_name[]" class="form-control form-control-sm" autocomplete="off" value="<?= set_value('visitor_name['.$i.']'); ?>" >
														<span class="text-danger" style="font-size:12px;"><?= form_error('visitor_name['.$i.']'); ?></span>
													</td>
													<td>
														<select class="form-select form-select-sm" name="visitor_gender[]" required>
															<option value="">Select Gender</option>
															<option value="Male" <?= set_select('visitor_gender['.$i.']', 'Male'); ?>>Male</option>
															<option value="Female" <?= set_select('visitor_gender['.$i.']', 'Female'); ?>>Female</option>																
															<option value="Transgender" <?= set_select('visitor_gender['.$i.']', 'Transgender'); ?>>Transgender</option>
														</select>
														
														<span class="text-danger" style="font-size:12px;"><?= form_error('visitor_gender['.$i.']'); ?></span>
													</td>
													<td>
														<select class="form-select form-select-sm" name="visitor_age[]" required>
															<option value="">Select Age</option>
															<?php for ($a = MAX_AGE_FOR_FREE_TICKET; $a <= 120; $a++) { ?>
															<option value="<?= $a; ?>" <?= set_select('visitor_age['.$i.']', $a); ?>><?= $a; ?></option>
															<?php } ?>
														</select>
														
														<span class="text-danger" style="font-size:12px;"><?= form_error('visitor_age['.$i.']'); ?></span>
													</td>
													<td>
													<?php
													if($safariCatData['safari_cat_id'] == 1){//Indian
													?>
														<select class="form-select form-select-sm" name="visitor_id_type[]" required>
															<option value="">Select ID Type</option>
															<option value="Voter ID" <?= set_select('visitor_id_type['.$i.']', 'Voter ID'); ?>>Voter ID</option>
															<option value="Aadhar Card" <?= set_select('visitor_id_type['.$i.']', 'Aadhar Card'); ?>>Aadhar Card</option>																
															<option value="Passport" <?= set_select('visitor_id_type['.$i.']', 'Passport'); ?>>Passport</option>
															<option value="Driving Licence" <?= set_select('visitor_id_type['.$i.']', 'Driving Licence'); ?>>Driving Licence</option>
															<option value="Photo ID card issued by Central/State Govt." <?= set_select('visitor_id_type['.$i.']', 'Photo ID card issued by Central/State Govt.'); ?>>Photo ID card issued by Central/State Govt.</option>
														</select>
														
														<span class="text-danger" style="font-size:12px;"><?= form_error('visitor_id_type['.$i.']'); ?></span>
													<?php
													}
													else {
													?>
														<select class="form-select form-select-sm" name="visitor_id_type[]" required>
															<option value="">Select Card Type</option>
															<option value="Passport" <?= set_select('visitor_id_type['.$i.']', 'Passport'); ?>>Passport</option>
														</select>
														
														<span class="text-danger" style="font-size:12px;"><?= form_error('visitor_id_type['.$i.']'); ?></span>
													<?php } ?>
													</td>
													<td>
													<input type="text" name="visitor_id_no[]" class="form-control form-control-sm" autocomplete="off" value="<?= set_value('visitor_id_no['.$i.']'); ?>">
													<span class="text-danger" style="font-size:12px;"><?= form_error('visitor_id_no['.$i.']'); ?></span>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
									
								</div>
								
								<div class="col-lg-12 col-md-12 col-sm-12">
									<button type="button" class="btn btn-primary px-4" id="add_row_child">Add Child Below <?= MAX_AGE_FOR_FREE_TICKET;?> Years</button>
									<div class="table-responsive border border-bottom-0 my-3">
										<table class="table table-sm align-middle mb-0 text-center" id="myTablechild">
												
										</table>
									</div>
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12 mt-3">
									<h5 class="mb-3 fw-bold thm-txt">Booking Details:</h5>
									<div class="table-responsive border border-bottom-0 my-3">
										<table class="table table-sm align-middle mb-0 text-center">
											<thead>
												<tr class="table-light">
													<th class="light-grn-bg">Rate per Person (Rs.)</th>
													<th class="light-grn-bg">Total Visitor</th>
													<th class="light-grn-bg">Price (Rs.)</th>
													<th class="light-grn-bg">GST</th>
													<th class="light-grn-bg">Total Payment (Rs.)</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><?= formatIndianCurrency($foundSlot['base_price']);?></td>
													<td><?= $no_of_visitor;?></td>
													<td><?= formatIndianCurrency($price);?></td>
													<td><?= formatIndianCurrency($gstAmt);?></td>
													<td><strong><?= formatIndianCurrency($payable_amount);?></strong></td>
												</tr>
										</table>
									</div>
								</div>

								<div class="col-lg-12 col-sm-12">
									<div class="form-group">
										<input id="checkbox" type="checkbox" checked="checked" class="checkbox-custom" autocomplete="off">
										<label for="checkbox" class="checkbox-custom-label"><a href="#." class="text-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewTerms">I accept Terms & Conditions, Privacy Policy and Cancellation Rules.</a></label>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<input type="submit" class="btn btn-green px-4" value="Proceed To Pay" id="pay_btn" autocomplete="off">
									</div>
								</div>

							</div>
						</div>
					</form>
				</div>
			<?php
			} else {
			?>
				<div class="checkout-wrap">
					<div class="checkout-body">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<h5 class="text-center fw-bold mb-3">Please Login to continue with the booking.</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="form-group text-center">
									<input id="checkbox" type="checkbox" checked="checked" class="checkbox-custom" autocomplete="off">
									<label for="checkbox" class="checkbox-custom-label"><a href="#." class="text-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewTerms">I accept Terms & Conditions, Privacy Policy and Cancellation Rules.</a></label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="form-group text-center">
									<a href="#" id="booking_login" class="btn-green px-4" data-bs-toggle="modal" data-bs-target="#login" data-redirect="1">Login to Continue</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			</div>


		</div>
	</div>
</section>

<!--View Terms Modal -->
    <div class="modal fade" id="viewTerms" tabindex="-1" aria-labelledby="viewTermsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header light-grn-bg">
                    <h1 class="modal-title fw-bold thm-txt fs-5" id="viewTermsModalLabel">Terms & Conditions, Privacy Policy and Cancellation Rules.</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Terms & Conditions:</h5>
                    <ol class="small text-justify">
                        <li>Visitors are required to carry the same ID proof in original at the time of visiting the national park.</li>
                        <li>The reservations of safari/ride are not transferable. The visitor should carry with him/her Print-out of the Electronic Reservation Slip.</li>
                        <li>One child below 5 years of age may ride with parents without additional charges.</li>
                        <li>Reservation may be cancelled in acute administrative requirement. No cancellation charge will be deducted in such case.</li>
                        <li>WBSFDA will not be liable against non-availability of amenities/services caused by irreparable technical faults or natural inconvenience.</li>
                    </ol>

                    <h5>Privacy Policy:</h5>
                    <ol class="small text-justify">
                        <li>As a general rule, this web site does not collect personal Information about you when you visit the site. You can generally visit this site, without revealing any personal information, unless you choose to provide such information.</li>
                        <li>Any personal information collected shall be used only for the stated purpose and shall NOT be shared with any other department/organization (Public/private).</li>
                        <li>This site may contain links to Governmental/Non-governmental sites whose data protection and privacy practices may differ from ours. We are not responsible for the content and privacy practices of these other websites and encourage
                            you to consult the privacy notices of those sites.</li>
                    </ol>

                    <h5>Cancellation Rules :</h5>
                    <ol class="small text-justify">
                        <li>More than clear 16 (Sixteen) days: 20% of the entry fee will be deducted.</li>
                        <li>Between Clear 08(Eight) to clear15(Fifteen)days:40% of the entry fee will be deducted.</li>
                        <li>Between Clear04(Four)to clear 07(Seven)days:80% of the entry fee will be deducted.</li>
                        <li>Less than or equal to 3 (Three)days: No refund.</li>
                        <li>"Clear Days" means that the date of occupation and the date of cancellation would not be counted. Moreover, Sunday & Holiday would not be excluded for calculation of cancellation charges.</li>
                        <li>For part cancellation, normal refund rules will be charged as per rules.</li>
                        <li>Refund admissible only upon production of the original reservation ticket.</li>
                        <li>Visitors have to pay vehicle entry free, Guide charge, Vehicle hiring charge and other requires charges at the entry gate/reporting point.</li>
                        <li>Visitors have to pay other charges for Folk dance, Handicrafts etc. for afternoon trips of Gorumara at the entry gate/reporting point.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
	
	
<script>
$(document).ready(function() {
	$('#myTablechild').on('click', '#delete_row_child', function () {
		$(this).closest('tr').remove();
	});
	
	$('#add_row_child').click(function () {
		
		var counter = $('.text-box').length + 1;
		
		$('#myTablechild').append('<tr class="text-box"><td><input type="text" name="child_name[]" class="form-control form-control-sm" autocomplete="off" placeholder="Child Name" required><span class="text-danger" style="font-size:12px;"></span></td><td><select class="form-select form-select-sm" name="child_gender[]" required><option value="">Select Gender</option><option value="Male">Male</option><option value="Female">Female</option><option value="Transgender">Transgender</option></select><span class="text-danger" style="font-size:12px;"></span></td><td><select class="form-select form-select-sm" name="child_age[]" required><option value="">Select Age</option><?php for ($ca = 1; $ca <= (MAX_AGE_FOR_FREE_TICKET - 1); $ca++) { ?><option value="<?= $ca; ?>"><?= $ca; ?></option><?php } ?></select><span class="text-danger" style="font-size:12px;"></span></td><td><?php if($safariCatData['safari_cat_id'] == 1){//Indian?><select class="form-select form-select-sm" name="child_id_type[]" required><option value="">Select ID Type</option><option value="Aadhar Card" >Aadhar Card</option><option value="Passport">Passport</option><option value="School ID Card">School ID Card</option></select><span class="text-danger" style="font-size:12px;"></span><?php } else { ?><select class="form-select form-select-sm" name="child_id_type[]" required><option value="">Select Card Type</option><option value="Passport">Passport</option></select><span class="text-danger" style="font-size:12px;"></span><?php } ?></td><td><input type="text" name="child_id_no[]" class="form-control form-control-sm" autocomplete="off" placeholder="ID No."><span class="text-danger" style="font-size:12px;"></span></td><td><button type="button" class="btn btn-danger btn-sm text-white" id="delete_row_child"><i class="bi bi-trash-fill"></i></button></td></tr>')
		
	
	});
	
	
	
	
	$("#pay_btn").on("click", function() {
		$("#pay_btn").attr('disabled', 'disabled');
		$("#paymentForm").submit();
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