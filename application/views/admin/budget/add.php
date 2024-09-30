<!--<div class="app-wrapper">-->
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Proposed Estimate Expenditure</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/budget">
									Back
								</a>
							</div>
						</div>
						<!--//row-->
					</div>
					<!--//table-utilities-->
				</div>
				<!--//col-auto-->
			</div>

			<div class="row g-3 mb-4 align-items-center">
				<?= $this->session->flashdata('msg'); ?>
			</div>

			<form action="" method="post" enctype="multipart/form-data" id="estimatedForm">

				<input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

				<div class="app-card app-card-orders-table shadow-sm mb-3">
					<div class="app-card-body px-2">
						

							<div class="row g-2">
								<div class="col-lg-4 col-sm-12 col-md-12 mb-3 property_id">
									<label for="" class="form-label">Unit <span class="asterisk"></span></label>
									<select name="property_id" class="form-select select2" id="property_id" required>
									<option value="">Select Unit</option>

										<?php if(!empty($property_list)){ ?>

											<?php foreach($property_list as $property){ ?>
												<option value="<?= $property['property_id']; ?>" <?php if(!empty($property_id)){ if($property['property_id'] == $property_id){ echo 'selected'; } } ?>><?= $property['property_name']; ?></option>
											<?php } ?>

										<?php } ?>
									</select>
								</div>
								<div class="col-lg-4 col-sm-12 col-md-4 mb-3 financial_year">
									<label for="" class="form-label">Financial Year <span class="asterisk"></span></label>
									<select name="financial_year" class="form-select select2" id="financial_year" required>
										<option value="">Select Year</option>
										<option value="2022-2023" <?php if(!empty($financial_year)){ if($financial_year == '2022-2023'){ echo 'selected'; } } ?>>2022-23</option>
										<option value="2023-2024" <?php if(!empty($financial_year)){ if($financial_year == '2023-2024'){ echo 'selected'; } } ?>>2023-24</option>
										<option value="2024-2025" <?php if(!empty($financial_year)){ if($financial_year == '2024-2025'){ echo 'selected'; } } ?>>2024-25</option>
									</select>
								</div>
								<div class="col-lg-4 col-sm-12 col-md-4 mb-3 billing_month">
									<?php
										$previousMonth = date('m', strtotime('-1 month'));
										$currentMonth = date('m'); // n returns the month without leading zeros
										$nextMonth = date('m', strtotime('+1 month'));
									?>
									<label for="" class="form-label">Estimated Expenses for the Month of<span class="asterisk"></span></label>
									<select name="billing_month" class="form-select select2" id="billing_month" required>
										<option value="">Select Month</option>
										<option value="01" <?php if(!empty($billing_month)){ if($billing_month == '01'){ echo 'selected'; } } ?> <?php if('01' != $previousMonth && '01' != $currentMonth && '01' != $nextMonth){ echo 'disabled'; } ?>>Jan</option>
										<option value="02" <?php if(!empty($billing_month)){ if($billing_month == '02'){ echo 'selected'; } } ?> <?php if('02' != $previousMonth && '02' != $currentMonth && '02' != $nextMonth){ echo 'disabled'; } ?>>Feb</option>
										<option value="03" <?php if(!empty($billing_month)){ if($billing_month == '03'){ echo 'selected'; } } ?> <?php if('03' != $previousMonth && '03' != $currentMonth && '03' != $nextMonth){ echo 'disabled'; } ?>>Mar</option>
										<option value="04" <?php if(!empty($billing_month)){ if($billing_month == '04'){ echo 'selected'; } } ?> <?php if('04' != $previousMonth && '04' != $currentMonth && '04' != $nextMonth){ echo 'disabled'; } ?>>Apr</option>
										<option value="05" <?php if(!empty($billing_month)){ if($billing_month == '05'){ echo 'selected'; } } ?> <?php if('05' != $previousMonth && '05' != $currentMonth && '05' != $nextMonth){ echo 'disabled'; } ?>>May</option>
										<option value="06" <?php if(!empty($billing_month)){ if($billing_month == '06'){ echo 'selected'; } } ?> <?php if('06' != $previousMonth && '06' != $currentMonth && '06' != $nextMonth){ echo 'disabled'; } ?>>June</option>
										<option value="07" <?php if(!empty($billing_month)){ if($billing_month == '07'){ echo 'selected'; } } ?> <?php if('07' != $previousMonth && '07' != $currentMonth && '07' != $nextMonth){ echo 'disabled'; } ?>>July</option>
										<option value="08" <?php if(!empty($billing_month)){ if($billing_month == '08'){ echo 'selected'; } } ?> <?php if('08' != $previousMonth && '08' != $currentMonth && '08' != $nextMonth){ echo 'disabled'; } ?>>Aug</option>
										<option value="09" <?php if(!empty($billing_month)){ if($billing_month == '09'){ echo 'selected'; } } ?> <?php if('09' != $previousMonth && '09' != $currentMonth && '09' != $nextMonth){ echo 'disabled'; } ?>>Sep</option>
										<option value="10" <?php if(!empty($billing_month)){ if($billing_month == '10'){ echo 'selected'; } } ?> <?php if('10' != $previousMonth && '10' != $currentMonth && '10' != $nextMonth){ echo 'disabled'; } ?>>Oct</option>
										<option value="11" <?php if(!empty($billing_month)){ if($billing_month == '11'){ echo 'selected'; } } ?> <?php if('11' != $previousMonth && '11' != $currentMonth && '11' != $nextMonth){ echo 'disabled'; } ?>>Nov</option>
										<option value="12" <?php if(!empty($billing_month)){ if($billing_month == '12'){ echo 'selected'; } } ?> <?php if('12' != $previousMonth && '12' != $currentMonth && '12' != $nextMonth){ echo 'disabled'; } ?>>Dec</option>


									</select>
								</div>
								<!-- <div class="col-lg-2 col-sm-12 col-md-4 mb-3">
									<label for="" class="form-label">&nbsp;&nbsp;<span class="asterisk"> </span></label>
									<input type="submit" class="form-select btn app-btn-primary" name="search" value="Search">
								</div> -->

							</div>
						
					</div>
				</div>

				<div class="app-card app-card-settings shadow-sm mb-3 pt-2">
					<div class="app-card-body px-2 pb-4">
						<h6 class="mb-2"><span class="mainDate"></span></h6>
						<div class="table-responsive">
							<table class="table align-middle table-hover" style="border:1px solid #e7e9ed;">
								<thead style="background-color: #608d5f;">
									<tr>
										<th width="" class="cell text-white">Particulars</th>
										<th width="" class="cell text-white text-end">Amount (Rs.)</th>
										<th width="" class="cell text-white">Remarks</th>
										<th width="" class="cell text-white">Upload File</th>
										<th width="" class="cell text-white text-end"><span style="display: block; font-size: 11px;">Total estimate already submitted during this month</span> Amount
                                            (In Rs.)</th>
										<th width="" class="cell text-white text-end"><span style="display: block; font-size: 11px;">Total amount already approved during this month</span> Amount
                                            (In Rs.) </th>
										<th width="" class="cell text-white text-end"><span style="display: block; font-size: 11px;">Actual Expenditure of the Previous Month</span> Amount
                                            (In Rs.)</th>
										<th width="" class="cell text-white text-end"><span style="display: block; font-size: 11px;">Approved Estimate</span> Amount (Rs.)</th>
										<th width="" class="cell text-white">Approve Remarks</th>
									</tr>
								</thead>
								<tbody class="budgetTable">

									<!--<?php foreach($particular_list as $particularL){ ?>

										<tr>
											<td width="30%" class="cell fw-bold"><?= $particularL['particular_title']; ?></td>
											<td width="20%" class="cell text-end">
												<div class="input-group">
													<span class="input-group-text" id="basic-addon1">Rs.</span>
													<input type="text" class="form-control text-end fw-bold estimated_expence_amount" name="estimated_expence_amount[]" value="" placeholder="0.00">
													<input type="hidden" name="particular_id[]" value="<?= $particularL['particular_id']; ?>">
												</div>
											</td>

											<td width="30%" class="cell">
												<div class="input-group">
													<textarea name="estimation_remarks[]" id="" cols="" rows="2" class="form-control estimation_remarks"></textarea>
												</div>
											</td>

											<td width="20%" class="cell">
												<div class="input-group">
													<input type="file" multiple class="form-control estimated_files" name="estimated_files[]">
												</div>
											</td>
										</tr>

									<?php } ?>
									
									<tr style="background-color: #1a4919; font-size: 1.1rem;">
										<td width="30%" class="cell text-white" colspan="3">Total Estimated Cost for the month <span class="mainDate"><?= date('M Y'); ?></span></td>
										<td width="20%" class="cell text-white text-end total_estimated_amount_text">0.00</td>
										<input type="hidden" name="total_estimated_amount" class="total_estimated_amount" value="">
									</tr>-->
								</tbody>
							</table>
						</div>
						<div class="row">
							<div class="col-md-6">
								<!--<label for="" class="form-label">Remarks</label>
								<textarea name="estimation_remarks" id="" cols="" rows="4" class="form-control"></textarea>-->
							</div>
							<div class="col-md-4">
								<!--<label for="" class="form-label">Upload File</label>
								<input type="file" class="form-control" name="supporting_file" id="">-->
							</div>
							<div class="col-md-12 text-end">
								<label for="" class="form-label w-100">&nbsp;</label>
								<?php
									if($this->admin_session_data['role_id'] == '38'){
										$buttonTitle = 'Submit to PIC / Special Officer';
									} else if($this->admin_session_data['role_id'] == '19' || $this->admin_session_data['role_id'] == '22' || $this->admin_session_data['role_id'] == '34' || $this->admin_session_data['role_id'] == '25'){
										$buttonTitle = 'Submit to Head Office';
									} 
								?>
								<input type="submit" class="btn app-btn-primary estimatedFormsubmit" name="" value="<?= $buttonTitle; ?>">
							</div>
						</div>
					</div>
				</div>

			</form>

		</div>
	</div>
	<!--//app-content-->

	<input type="hidden" id="base_url" value="<?= base_url(); ?>">


<!--</div>
//app-wrapper-->

<script type="text/javascript">
	$( document ).ready(function() {

		/*$(document).on('change', '#property_id', function() {

			var baseUrl = $('#base_url').val();
			var propertyId = $(this).val();

			//alert(propertyId); exit;

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

			//alert(propertyId);

			$.ajax({
				type: "POST",
				url: baseUrl+'admin/budget/budget_particular_list',
				data: {"propertyId":propertyId,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					//console.log(response);

					$('.budgetTable').html(response);
							
				}
			});

		});*/

		if($('#billing_month option:selected')){

			var billingMonth = $('#billing_month :selected').text();
			var billingMonthdigit = $('#billing_month :selected').val();
			var financialYear = $('#financial_year :selected').val();

			var startYear = financialYear.substring(0, financialYear.indexOf('-'));
			var endYear = financialYear.substr(financialYear.indexOf("-") + 1);

			if(billingMonthdigit == ''){
				var displayMonth = '';
			} else if(billingMonthdigit > '03'){
				var displayMonth = 'Proposed Estimate Expenditure for the Month of: '+billingMonth+' '+startYear;
			} else {
				var displayMonth = 'Proposed Estimate Expenditure for the Month of: '+billingMonth+' '+endYear;
			}

			$('.mainDate').text(displayMonth);

		}

		$(document).on('change', '#billing_month', function() {

			//var billingDate = moment($(this).val()).format('MMM YYYY');

			//$('.billDate').text(billingDate);
			//$('.mainDate').text('for the Month '+billingDate);

			var baseUrl = $('#base_url').val();
			var propertyId = $('#property_id :selected').val();

			//alert(propertyId); exit;

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash


			var billingMonth = $('#billing_month :selected').text();
			var billingMonthdigit = $('#billing_month :selected').val();
			var financialYear = $('#financial_year :selected').val();

			if(billingMonthdigit == '01'){
				var billingMonthdigitprev = '12'
			} else {
				var billingMonthdigitprev = ('0' + (billingMonthdigit - 1)).slice(-2);
			}
			 

			var startYear = financialYear.substring(0, financialYear.indexOf('-'));
			var endYear = financialYear.substr(financialYear.indexOf("-") + 1);

			if(billingMonthdigit == ''){
				var displayMonth = '';
			} else if(billingMonthdigit > '03'){
				var displayMonth = 'Proposed Estimate Expenditure for the Month of: '+billingMonth+' '+startYear;
			} else {
				var displayMonth = 'Proposed Estimate Expenditure for the Month of: '+billingMonth+' '+endYear;
			}

			$('.mainDate').text(displayMonth);	

			$.ajax({
				type: "POST",
				url: baseUrl+'admin/budget/budget_particular_list',
				data: {"propertyId":propertyId,"billingMonth":billingMonthdigit,"billingMonthdigitprev":billingMonthdigitprev,"financialYear":financialYear,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					//console.log(response);

					$('.budgetTable').html(response);

					setTimeout(function () {						
						
						var estimatedSum = 0;
						var approvedSum = 0;
						var actualSum = 0;

						$('td .estimated_expence_amount_thismonth').each(function() {
							
							var value = parseInt($(this).val()); // Get the content of the <td> and parse it as an integer
							if (!isNaN(value)) { // Check if it's a valid number
								estimatedSum += value; // Add it to the sum
							}
						});

						$('td .approved_expence_amount_thismonth').each(function() {
							
							var value = parseInt($(this).val()); // Get the content of the <td> and parse it as an integer
							if (!isNaN(value)) { // Check if it's a valid number
								approvedSum += value; // Add it to the sum
							}
						});

						$('td .estimated_expence_amount_prevmonth').each(function() {
							
							var value = parseInt($(this).val()); // Get the content of the <td> and parse it as an integer
							if (!isNaN(value)) { // Check if it's a valid number
								actualSum += value; // Add it to the sum
							}
						});

						$('.total_estimated_amount_thismonth').text(estimatedSum.toFixed(2));
						$('.total_approved_amount_thismonth').text(approvedSum.toFixed(2));
						$('.total_actual_amount_prevmonth').text(actualSum.toFixed(2));

					}, 1000);					
							
				}
			});
			

		});

		setTimeout(function () {
			$('.alert-dismissible').hide();
		}, 3000);


		// Listen for keypress events on the number-input fields
		//$('.estimated_expence_amount').on('input', function() {
		$(document).on('input', '.estimated_expence_amount', function() {
			// Initialize the total sum to zero
			var total = 0;

			// Loop through each input field
			$('.estimated_expence_amount').each(function() {
				// Parse the value as a float and add it to the total
				total += parseFloat($(this).val()) || 0;
			});

			// Update the result element with the calculated total
			$('.total_estimated_amount_text').text(total.toFixed(2));
			$('.total_estimated_amount').val(total.toFixed(2));

		});


		$(document).on('input', '.approved_expence_amount', function() {
			// Initialize the total sum to zero
			var total = 0;

			// Loop through each input field
			$('.approved_expence_amount').each(function() {
				// Parse the value as a float and add it to the total
				total += parseFloat($(this).val()) || 0;
			});

			// Update the result element with the calculated total
			$('.total_approved_amount_text').text(total.toFixed(2));
			$('.total_approved_amount').val(total.toFixed(2));

		});


		$(document).on('click', '.estimatedFormsubmit', function(e) {

			e.preventDefault();

			var propertyId = $('#property_id').find(":selected").val();
			var financialYear = $('#financial_year').val();
			var billingMonth = $('#billing_month').val();

			// Check if empty of not
			if (propertyId  === '') {
				$('.property_id .select2-selection--single').css('border-color','red');
				$('.financial_year .select2-selection--single').css('border','1px solid #B3D6EC');
				$('.billing_month .select2-selection--single').css('border','1px solid #B3D6EC');

				$('.property_id .select2-selection--single').focus();
				return false;
			} else if (financialYear  === '') {
				$('.financial_year .select2-selection--single').css('border-color','red');
				$('.property_id .select2-selection--single').css('border','1px solid #B3D6EC');
				$('.billing_month .select2-selection--single').css('border','1px solid #B3D6EC');

				$('.financial_year .select2-selection--single').focus();
				return false;
			} else if (billingMonth  === '') {
				$('.billing_month .select2-selection--single').css('border-color','red');
				$('.property_id .select2-selection--single').css('border','1px solid #B3D6EC');
				$('.financial_year .select2-selection--single').css('border','1px solid #B3D6EC');

				$('.billing_month .select2-selection--single').focus();
				return false;
			} else {

				$('.property_id .select2-selection--single').css('border','1px solid #B3D6EC');
				$('.financial_year .select2-selection--single').css('border','1px solid #B3D6EC');
				$('.billing_month .select2-selection--single').css('border','1px solid #B3D6EC');

				$.confirm({

					title: "Alert!!",
					content: "Are you sure to submit details? You are not able to change details once submitted. Please check details before submit.",
					buttons: {
						Ok: {
							text: 'Yes',
							btnClass: 'btn-green',
							action: function(){  							
								$("#estimatedForm").submit();
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

			}

		});
		

	});
</script>
