<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Wage List</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<?php if($this->admin_session_data['role_id'] == '19' || $this->admin_session_data['role_id'] == '22' || $this->admin_session_data['role_id'] == '34' || $this->admin_session_data['role_id'] == '25'){ ?>
									<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/wages/add_wage_estimate">
										Add Estimate Wage
									</a>
								<?php } else { ?>

									<?php if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN && check_user_permission('88', 'add_flag')){ ?>

										<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/wages/add_wage_estimate">
											Add Estimate Wage
										</a>
										
									<?php } ?>

								<?php } ?>
							</div>
						</div>
						<!--//row-->
					</div>
					<!--//table-utilities-->
				</div>
				<!--//col-auto-->
			</div>

			<div class="row g-3 mb-3 align-items-center updateMsg">
				<?= $this->session->flashdata('msg'); ?>
			</div>

			<div class="app-card app-card-orders-table shadow-sm mb-3">
				<div class="app-card-body p-3">
					<form action="" method="post">

						<input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

						<div class="row g-3">
							<div class="col-lg-3 col-sm-12 col-md-4">
								<label for="" class="form-label">Unit <span class="asterisk"></span></label>
								<select name="property_id" class="form-select select2" id="property_id">
								<option value="">Select Unit</option>

									<?php if(!empty($property_list)){ ?>

										<?php foreach($property_list as $property){ ?>
											<option value="<?= $property['property_id']; ?>" <?php if(!empty($property_id)){ if($property['property_id'] == $property_id){ echo 'selected'; } } ?>><?= $property['property_name']; ?></option>
										<?php } ?>

									<?php } ?>
								</select>
							</div>
							<div class="col-lg-3 col-sm-12 col-md-4">
								<label for="" class="form-label">Select Financial Year <span class="asterisk"></span></label>
								<select name="financial_year" class="form-select select2" id="financial_year">
									<option value="">Select Year</option>
									<option value="2022-2023" <?php if(!empty($financial_year)){ if($financial_year == '2022-2023'){ echo 'selected'; } } ?>>2022-23</option>
									<option value="2023-2024" <?php if(!empty($financial_year)){ if($financial_year == '2023-2024'){ echo 'selected'; } } ?>>2023-24</option>
									<option value="2024-2025" <?php if(!empty($financial_year)){ if($financial_year == '2024-2025'){ echo 'selected'; } } ?>>2024-25</option>
								</select>
							</div>
							<div class="col-lg-3 col-sm-12 col-md-4">
								<label for="" class="form-label">Select Month<span class="asterisk"></span></label>
								<select name="billing_month" class="form-select select2" id="billing_month">
									<option value="">Select Month</option>
									<option value="01" <?php if(!empty($billing_month)){ if($billing_month == '01'){ echo 'selected'; } } ?>>Jan</option>
									<option value="02" <?php if(!empty($billing_month)){ if($billing_month == '02'){ echo 'selected'; } } ?>>Feb</option>
									<option value="03" <?php if(!empty($billing_month)){ if($billing_month == '03'){ echo 'selected'; } } ?>>Mar</option>
									<option value="04" <?php if(!empty($billing_month)){ if($billing_month == '04'){ echo 'selected'; } } ?>>Apr</option>
									<option value="05" <?php if(!empty($billing_month)){ if($billing_month == '05'){ echo 'selected'; } } ?>>May</option>
									<option value="06" <?php if(!empty($billing_month)){ if($billing_month == '06'){ echo 'selected'; } } ?>>June</option>
									<option value="07" <?php if(!empty($billing_month)){ if($billing_month == '07'){ echo 'selected'; } } ?>>July</option>
									<option value="08" <?php if(!empty($billing_month)){ if($billing_month == '08'){ echo 'selected'; } } ?>>Aug</option>
									<option value="09" <?php if(!empty($billing_month)){ if($billing_month == '09'){ echo 'selected'; } } ?>>Sep</option>
									<option value="10" <?php if(!empty($billing_month)){ if($billing_month == '10'){ echo 'selected'; } } ?>>Oct</option>
									<option value="11" <?php if(!empty($billing_month)){ if($billing_month == '11'){ echo 'selected'; } } ?>>Nov</option>
									<option value="12" <?php if(!empty($billing_month)){ if($billing_month == '12'){ echo 'selected'; } } ?>>Dec</option>
								</select>
							</div>
							<div class="col-lg-2 col-sm-12 col-md-4">
								<label for="" class="form-label">&nbsp;&nbsp;<span class="asterisk"> </span></label>
								<input type="submit" class="form-select btn app-btn-primary" name="search" value="Search">
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="app-card app-card-settings shadow-sm mb-3 p-3">
				<form id="wageEstimateform" action="<?= base_url(); ?>admin/wages/update_wages" method="post">

					<input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

					<input type="hidden" name="wages_estimate_id" class="wages_estimate_id" value="<?= $wage_estimate_list['wages_estimate_id']; ?>">

					<div class="app-card-body">
						<div class="row g-2" style="margin-bottom: 10px;">
							<div class="col-lg-6 col-sm-12 col-md-6">
								<label for="" class="form-label">Cash in Hand <span class="asterisk"></span></label>
								<input type="text" name="cash_in_hand" class="form-control cash_in_hand" value="<?php if($wage_estimate_list){ echo $wage_estimate_list['cash_in_hand']; } else { echo '0.00'; } ?>" readonly>
							</div>
							<div class="col-lg-6 col-sm-12 col-md-6">
								<label for="" class="form-label">Cash at Bank <span class="asterisk"></span></label>
								<input type="text" name="cash_at_bank" class="form-control cash_at_bank" value="<?php if($wage_estimate_list){ echo $wage_estimate_list['cash_at_bank']; } else { echo '0.00'; } ?>" readonly>
							</div>
						</div>
					</div>
					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table table-bordered align-middle app-table-hover mb-0 small">
								<thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">
									<tr>
										<th>Name</th>
										<th>Daily Wages</th>
										<th>Payable Days</th>
										<th class="text-end">Wages for the month</th>
										<th>Appoved Payable Days</th>
										<th class="text-end">Approved Wages for the month</th>
										<th style="background:#0D47A1;">ADM Approval Status</th>
										<th style="background:#2196f3;">CAO Approval Status</th>
										<th style="background:#29B6F6;">MD Approval Status</th>

										<?php if($this->admin_session_data['role_id'] == '35' || $this->admin_session_data['role_id'] == '19' || $this->admin_session_data['role_id'] == '22' || $this->admin_session_data['role_id'] == '34' || $this->admin_session_data['role_id'] == '25'){ ?>
											<th>Action</th>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($wage_estimate_list['estimate_list'])){ ?>

										<?php foreach($wage_estimate_list['estimate_list'] as $estimate){ ?>										

											<tr class="wageItem">											

												<td><?= $estimate['worker_name']; ?></td>
												<td class="text-end"><?= $estimate['daily_wages_amount']; ?><input type="hidden" class="form-control daily_wage_amount" value="<?= $estimate['daily_wages_amount']; ?>"></td>

												<td><?= $estimate['payable_day']; ?></td>
												<td class="text-end"><?= $estimate['total_wages_amount']; ?></td>

												<td><input type="text" class="form-control approved_payable_days" value="<?php if(!empty($estimate['approved_payable_day'])){ echo $estimate['approved_payable_day']; } else { echo $estimate['payable_day']; } ?>" <?php if($this->admin_session_data['role_id'] == '2' || $this->admin_session_data['role_id'] == '20' || $this->admin_session_data['role_id'] == '21' || $this->admin_session_data['role_id'] == '35'){ echo 'readonly'; } else { if($estimate['approved_status'] != '2' && $estimate['cao_approved_status'] != '2' && $estimate['md_approved_status'] != '2'){ echo 'readonly'; } } ?>></td>
												<!--<td><input type="text" class="form-control approved_payable_days" value="<?php if(!empty($estimate['approved_payable_day'])){ echo $estimate['approved_payable_day']; } else { echo $estimate['payable_day']; } ?>" <?php if($this->admin_session_data['role_id'] == '2' || $this->admin_session_data['role_id'] == '20' || $this->admin_session_data['role_id'] == '21' || $this->admin_session_data['role_id'] == '35'){ echo 'readonly'; } else if($this->admin_session_data['role_id'] == '19' || $this->admin_session_data['role_id'] == '22' || $this->admin_session_data['role_id'] == '34' || $this->admin_session_data['role_id'] == '25'){ if(!check_user_permission('90', 'add_flag')){ echo 'readonly'; } } ?>></td>-->
												<td class="text-end"><input type="text" class="form-control approved_total_wages_amount text-end" value="<?php if(!empty($estimate['approved_total_wages_amount'])){ echo $estimate['approved_total_wages_amount']; } else { echo $estimate['total_wages_amount']; } ?>" readonly></td>
												
												<td class="wageStatus"><?php if($estimate['approved_status'] == '0'){ echo 'Pending'; } else if($estimate['approved_status'] == '1'){ echo 'Approved'; } else { echo 'Rejected'; } ?></td>
												<td class=""><?php if($estimate['cao_approved_status'] == '0'){ echo 'Pending'; } else if($estimate['cao_approved_status'] == '1'){ echo 'Approved'; } else { echo 'Rejected'; } ?></td>
												<td class=""><?php if($estimate['md_approved_status'] == '0'){ echo 'Pending'; } else if($estimate['md_approved_status'] == '1'){ echo 'Approved'; } else { echo 'Rejected'; } ?></td>

												<?php if($this->admin_session_data['role_id'] == '35' && $wage_estimate_list['is_publish'] == '1'){ ?>
													<td class="actionBtn">												
														<?php if($estimate['approved_status'] == '0'){ ?>
															<a href="javascript:void(0)" type="button" class="btn-sm app-btn-primary admwageApprove" data-wagedetailid="<?= $estimate['wages_details_id']; ?>" title="Approve Details">Submit to CAO</a>
															<a href="javascript:void(0)" type="button" class="btn-sm app-btn-danger admwageReject" data-wagedetailid="<?= $estimate['wages_details_id']; ?>" title="Reject Details">Reject</a>
														<?php } else { ?>
															--
														<?php } ?>
													</td>
												<?php } else if($this->admin_session_data['role_id'] == '19' || $this->admin_session_data['role_id'] == '22' || $this->admin_session_data['role_id'] == '34' || $this->admin_session_data['role_id'] == '25'){ ?>
													<td class="actionBtn">												
														<?php if($estimate['approved_status'] == '2' || $estimate['cao_approved_status'] == '2' || $estimate['md_approved_status'] == '2'){ ?>
															<a href="javascript:void(0)" type="button" class="btn-sm app-btn-primary wageApprove" data-wagedetailid="<?= $estimate['wages_details_id']; ?>" title="View Details">Modify & Update</a>
														<?php }	else { ?>
															--
														<?php } ?>
													</td>
												<?php } ?>											
											</tr>

										<?php } ?>									

									<?php } else { ?>
										<tr><td colspan="12">No Data Found</td></tr>
									<?php } ?>
									
									
								</tbody>
							</table>
						</div>
					</div>

					<div class="app-card-body">
						<div class="row g-2" style="margin-bottom: 10px;">
							<div class="col-lg-6 col-sm-12 col-md-6">
								<label for="" class="form-label">Download Files <span class="asterisk"></span></label><br>
								<?php if(!empty($wage_estimate_list['wage_files'])){ ?>
									<?php foreach($wage_estimate_list['wage_files'] as $suppFile){ ?>
										<a class="btn-sm app-btn-primary" href="<?= base_url(); ?>public/wage_files/<?= $suppFile['wage_file_title']; ?>" title="<?= $suppFile['wage_file_title']; ?>" download><i class="fa fa-download"></i></a>
									<?php } ?>
								<?php } else { ?>
									<?= 'No files available.'; ?>
								<?php } ?>
							</div>
							<div class="col-lg-6 col-sm-12 col-md-6">
								<label for="" class="form-label">Remarks <span class="asterisk"></span></label>
								<textarea name="wage_remarks" id="" cols="" rows="2" class="form-control wage_remarks"><?php if($wage_estimate_list['estimated_remarks']){ echo $wage_estimate_list['estimated_remarks']; } ?></textarea>
							</div>

							<?php if($this->admin_session_data['role_id'] == '20' || $this->admin_session_data['role_id'] == '21'){ ?>

								<input type="hidden" name="wage_status" class="wage_status">

								<?php if($this->admin_session_data['role_id'] == '20' && $wage_estimate_list['adm_status'] == '1' && $wage_estimate_list['cao_status'] == '0'){ ?>

									<div class="col-md-12 text-end">
										<a href="javascript:void(0)" type="button" class="btn-sm app-btn-primary upApprove" title="Approve Details">Submit to MD</a>
										<a href="javascript:void(0)" type="button" class="btn-sm app-btn-danger upReject" title="Reject Details">Reject</a>
									</div>

								<?php } else if($this->admin_session_data['role_id'] == '21' && $wage_estimate_list['adm_status'] == '1' && $wage_estimate_list['cao_status'] == '1' && $wage_estimate_list['md_status'] == '0'){ ?>

									<div class="col-md-12 text-end">
										<a href="javascript:void(0)" type="button" class="btn-sm app-btn-primary upApprove" title="Approve Details">Approve</a>
										<a href="javascript:void(0)" type="button" class="btn-sm app-btn-danger upReject" title="Reject Details">Reject</a>
									</div>

								<?php } ?>
							<?php //} ?>
							<?php } else { ?>

								<?php if($this->admin_session_data['role_id'] != ROLE_SUPERADMIN && !empty($wage_estimate_list) && $wage_estimate_list['is_publish'] == '0' && check_user_permission('90', 'add_flag')){ ?>

									<div class="col-md-12 text-end">
										<a href="<?= base_url(); ?>admin/wages/review_publish_wages/<?= $wage_estimate_list['wages_estimate_id']; ?>" type="button" class="btn-sm app-btn-primary" title="Approve Details">Review & Publish</a>
									</div>
									
								<?php } ?>

							<?php } ?>

						</div>
					</div>

				</form>
			</div>


		</div>
	</div>
	<!--//app-content-->

	
	<input type="hidden" id="base_url" value="<?= base_url(); ?>">


<!--</div>
//app-wrapper-->

<script type="text/javascript">
	$( document ).ready(function() {

		$(document).on('click', '.wageApprove', function() {

			var baseUrl = $('#base_url').val();
			var wagedetailid = $(this).data('wagedetailid');
			var approvedPaybleday = $(this).closest('tr').find('.approved_payable_days').val();
			var approvedTotalwages = $(this).closest('tr').find('.approved_total_wages_amount').val();

			var wagesEstimateid = $('.wages_estimate_id').val();

			var thIs = $(this);

			//alert(approvedTotalwages);

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash
			
			if (approvedPaybleday == "") {
				$(this).closest('tr').find('.approved_payable_days').addClass("redClass").css('border-color','red');
			} else {
				$(this).closest('tr').find('.approved_payable_days').removeClass("redClass").css('border-color','#e7e9ed');

				thIs.html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');

				$.ajax({
					type: "POST",
					url: baseUrl+'admin/wages/approval_submit',
					data: {"wagesEstimateid":wagesEstimateid,"wagedetailid":wagedetailid,"approvedPaybleday":approvedPaybleday,"approvedTotalwages":approvedTotalwages,[csrfName]: csrfHash},
					dataType: "json",
					success: function(response) { 

						setTimeout(function () {
							thIs.remove();
							//thIs.parent('.actionBtn').text('--');
							//thIs.closest('tr').find('.wageStatus').text('Approved');
							$('.updateMsg').html('<div class="alert alert-success alert-dismissible">Wages Successfully Updated.</div>');
						}, 4000);

						setTimeout(function () {
							$('.updateMsg').html('');
							location.reload();
						}, 5000);
								
					}
				});
			}

		});


		$(document).on('click', '.admwageApprove', function() {

			var baseUrl = $('#base_url').val();
			var wagedetailid = $(this).data('wagedetailid');
			var approvedPaybleday = $(this).closest('tr').find('.approved_payable_days').val();
			var approvedTotalwages = $(this).closest('tr').find('.approved_total_wages_amount').val();

			var thIs = $(this);

			//alert(approvedTotalwages);

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

			thIs.html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
			
			$.ajax({
				type: "POST",
				url: baseUrl+'admin/wages/approval_submit_adm',
				data: {"wagedetailid":wagedetailid,"approvedPaybleday":approvedPaybleday,"approvedTotalwages":approvedTotalwages,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					setTimeout(function () {
						thIs.remove();
						//thIs.parent('.actionBtn').text('--');
						//thIs.closest('tr').find('.wageStatus').text('Approved');
						$('.updateMsg').html('<div class="alert alert-success alert-dismissible">Wages Successfully Approved.</div>');
					}, 4000);

					setTimeout(function () {
						$('.updateMsg').html('');
						location.reload();
					}, 5000);
							
				}
			});

		});


		$(document).on('click', '.caowageApprove', function() {

			var baseUrl = $('#base_url').val();
			var wagedetailid = $(this).data('wagedetailid');

			var thIs = $(this);

			//alert(approvedTotalwages);

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

			thIs.html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
			
			$.ajax({
				type: "POST",
				url: baseUrl+'admin/wages/approval_submit_cao',
				data: {"wagedetailid":wagedetailid,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					setTimeout(function () {
						thIs.remove();
						//thIs.parent('.actionBtn').text('--');
						//thIs.closest('tr').find('.wageStatus').text('Approved');
						$('.updateMsg').html('<div class="alert alert-success alert-dismissible">Wages Successfully Approved.</div>');
					}, 4000);

					setTimeout(function () {
						$('.updateMsg').html('');
						location.reload();
					}, 5000);
							
				}
			});

		});


		$(document).on('click', '.mdwageApprove', function() {

			var baseUrl = $('#base_url').val();
			var wagedetailid = $(this).data('wagedetailid');

			var thIs = $(this);

			//alert(approvedTotalwages);

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

			thIs.html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
			
			$.ajax({
				type: "POST",
				url: baseUrl+'admin/wages/approval_submit_md',
				data: {"wagedetailid":wagedetailid,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					setTimeout(function () {
						thIs.remove();
						//thIs.parent('.actionBtn').text('--');
						//thIs.closest('tr').find('.wageStatus').text('Approved');
						$('.updateMsg').html('<div class="alert alert-success alert-dismissible">Wages Successfully Approved.</div>');
					}, 4000);

					setTimeout(function () {
						$('.updateMsg').html('');
						location.reload();
					}, 5000);
							
				}
			});

		});


		$(document).on('click', '.admwageReject', function() {

			var baseUrl = $('#base_url').val();
			var wagedetailid = $(this).data('wagedetailid');

			var thIs = $(this);

			//alert(approvedTotalwages);

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

			thIs.html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
			
			$.ajax({
				type: "POST",
				url: baseUrl+'admin/wages/reject_submit_adm',
				data: {"wagedetailid":wagedetailid,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					setTimeout(function () {
						thIs.remove();
						//thIs.parent('.actionBtn').text('--');
						//thIs.closest('tr').find('.wageStatus').text('Approved');
						$('.updateMsg').html('<div class="alert alert-danger alert-dismissible">Wages Successfully Rejected.</div>');
					}, 4000);

					setTimeout(function () {
						$('.updateMsg').html('');
						location.reload();
					}, 5000);
							
				}
			});

		});


		$(document).on('click', '.caowageReject', function() {

			var baseUrl = $('#base_url').val();
			var wagedetailid = $(this).data('wagedetailid');

			var thIs = $(this);

			//alert(approvedTotalwages);

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

			thIs.html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
			
			$.ajax({
				type: "POST",
				url: baseUrl+'admin/wages/reject_submit_cao',
				data: {"wagedetailid":wagedetailid,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					setTimeout(function () {
						thIs.remove();
						//thIs.parent('.actionBtn').text('--');
						//thIs.closest('tr').find('.wageStatus').text('Approved');
						$('.updateMsg').html('<div class="alert alert-danger alert-dismissible">Wages Successfully Rejected.</div>');
					}, 4000);

					setTimeout(function () {
						$('.updateMsg').html('');
						location.reload();
					}, 5000);
							
				}
			});

		});


		$(document).on('click', '.mdwageReject', function() {

			var baseUrl = $('#base_url').val();
			var wagedetailid = $(this).data('wagedetailid');

			var thIs = $(this);

			//alert(approvedTotalwages);

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

			thIs.html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
			
			$.ajax({
				type: "POST",
				url: baseUrl+'admin/wages/reject_submit_md',
				data: {"wagedetailid":wagedetailid,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					setTimeout(function () {
						thIs.remove();
						//thIs.parent('.actionBtn').text('--');
						//thIs.closest('tr').find('.wageStatus').text('Approved');
						$('.updateMsg').html('<div class="alert alert-danger alert-dismissible">Wages Successfully Rejected.</div>');
					}, 4000);

					setTimeout(function () {
						$('.updateMsg').html('');
						location.reload();
					}, 5000);
							
				}
			});

		});


		$(document).on('input', '.approved_payable_days', function() {

			$('.approved_payable_days').each(function() {

				var monthDigit = parseInt($("#billing_month :selected").val());
                if (monthDigit >= 1 && monthDigit <= 12) {
                    var year = new Date().getFullYear(); // Get the current year
                    var lastDay = new Date(year, monthDigit, 0).getDate();

					var inputValue = $(this).val();

					if(inputValue <= lastDay){

						var numericValue = inputValue.replace(/[^0-9]/g, '');
						$(this).val(numericValue);

					} else {
						alert('Days should not exceed of selected month');
						$(this).val('');
					}
                    
                } else {
                    alert("Invalid month digit. Please enter a number between 1 and 12.");
                }

				//var inputValue = $(this).val();
				// Remove non-numeric characters using a regular expression
				//var numericValue = inputValue.replace(/[^0-9]/g, '');
				//$(this).val(numericValue);

				//var item = $('.wageItem');
				//calculateTotal(item);

			});

			$('.wageItem').each(function() {

				var item = $(this);
				calculateTotal(item);						

			});

		});


		$(document).on('click', '.upApprove', function(e) {

			e.preventDefault();

			$.confirm({

				title: "Alert!!",
				content: "Are you sure to approve details? Please check details before submit.",
				buttons: {
					Ok: {
						text: 'Yes',
						btnClass: 'btn-green',
						action: function(){  							
							$('.wage_status').val('1');
							$("#wageEstimateform").submit();
						}
					},
					cancelAction: { //Close the confirmation Modal
						text: 'No',
						btnClass: 'btn-red',
						action: function(){
						
						}
					}
				}

			});			

		});


		$(document).on('click', '.upReject', function(e) {

			e.preventDefault();

			$.confirm({

				title: "Alert!!",
				content: "Are you sure to reject details? Please check details before submit.",
				buttons: {
					Ok: {
						text: 'Yes',
						btnClass: 'btn-green',
						action: function(){  							
							$('.wage_status').val('2');
							$("#wageEstimateform").submit();
						}
					},
					cancelAction: { //Close the confirmation Modal
						text: 'No',
						btnClass: 'btn-red',
						action: function(){
						
						}
					}
				}

			});			

		});


		function calculateTotal(item) {
			var payableInput = item.find('.approved_payable_days');
			var priceInput = item.find('.daily_wage_amount');
			var totalInput = item.find('.approved_total_wages_amount');

			//alert(payableInput);
			
			var days = parseFloat(payableInput.val()) || 0;
			var price = parseFloat(priceInput.val()) || 0;
			var total = days * price;
			
			totalInput.val(total.toFixed(2)); // Display the total with 2 decimal places
		}


		setTimeout(function () {
			$('.alert').slideUp();
		}, 2500);

	});
</script>
