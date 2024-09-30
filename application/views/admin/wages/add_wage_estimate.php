<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">New Wages Estimate</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/wages">
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

			<div class="row g-3 mb-3 align-items-center">
				<?= $this->session->flashdata('msg'); ?>
			</div>

			<form action="" method="post" id="estimatedForm" enctype="multipart/form-data">

				<input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

				<div class="app-card app-card-orders-table shadow-sm mb-3 p-3">
					<div class="app-card-body">
						

							<div class="row g-2">
								<div class="col-lg-4 col-sm-12 col-md-12">
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
								<div class="col-lg-4 col-sm-12 col-md-4">
									<label for="" class="form-label">Financial Year <span class="asterisk"></span></label>
									<select name="financial_year" class="form-select select2" id="financial_year">
										<option value="">Select Year</option>
										<option value="2022-2023">2022-23</option>
										<option value="2023-2024">2023-24</option>
										<option value="2024-2025">2024-25</option>
									</select>
								</div>
								<div class="col-lg-4 col-sm-12 col-md-4">
									<?php

										//$currentMonthdays =  date('t');

										//if($currentMonthdays == '31'){

											//$previousMonth = sprintf("%02d", ((date('n') - 1) % 12));
											//$currentMonth = sprintf("%02d", (date('n')% 12)); // n returns the month without leading zeros

										//} else {

											$previousMonth = date('m', strtotime('-1 month'));
											$currentMonth = date('m'); // n returns the month without leading zeros

										//}	

										//$previousMonth = date('m', strtotime('-1 month'));
										//$currentMonth = date('m'); // n returns the month without leading zeros
										//$nextMonth = date('m', strtotime('+1 month'));										
									?>
									<label for="" class="form-label">Estimated Expenses for the Month of<span class="asterisk"></span></label>
									<select name="billing_month" class="form-select select2" id="billing_month">
										<option value="">Select Month</option>
										<option value="01" <?php if('01' != $currentMonth && '01' != $previousMonth){ echo 'disabled'; } ?>>Jan</option>
										<option value="02" <?php if('02' != $currentMonth && '02' != $previousMonth){ echo 'disabled'; } ?>>Feb</option>
										<option value="03" <?php if('03' != $currentMonth && '03' != $previousMonth){ echo 'disabled'; } ?>>Mar</option>
										<option value="04" <?php if('04' != $currentMonth && '04' != $previousMonth){ echo 'disabled'; } ?>>Apr</option>
										<option value="05" <?php if('05' != $currentMonth && '05' != $previousMonth){ echo 'disabled'; } ?>>May</option>
										<option value="06" <?php if('06' != $currentMonth && '06' != $previousMonth){ echo 'disabled'; } ?>>June</option>
										<option value="07" <?php if('07' != $currentMonth && '07' != $previousMonth){ echo 'disabled'; } ?>>July</option>
										<option value="08" <?php if('08' != $currentMonth && '08' != $previousMonth){ echo 'disabled'; } ?>>Aug</option>
										<option value="09" <?php if('09' != $currentMonth && '09' != $previousMonth){ echo 'disabled'; } ?>>Sep</option>
										<option value="10" <?php if('10' != $currentMonth && '10' != $previousMonth){ echo 'disabled'; } ?>>Oct</option>
										<option value="11" <?php if('11' != $currentMonth && '11' != $previousMonth){ echo 'disabled'; } ?>>Nov</option>
										<option value="12" <?php if('12' != $currentMonth && '12' != $previousMonth){ echo 'disabled'; } ?>>Dec</option>
									</select>

									<!--<label for="" class="form-label">Estimated Expenses for the Month of<span class="asterisk"></span></label>
									<select name="billing_month" class="form-select select2" id="billing_month">
										<option value="">Select Month</option>
										<option value="01">Jan</option>
										<option value="02">Feb</option>
										<option value="03">Mar</option>
										<option value="04">Apr</option>
										<option value="05">May</option>
										<option value="06">June</option>
										<option value="07">July</option>
										<option value="08">Aug</option>
										<option value="09">Sep</option>
										<option value="10">Oct</option>
										<option value="11">Nov</option>
										<option value="12">Dec</option>
									</select>-->
								</div>
								<!-- <div class="col-lg-2 col-sm-12 col-md-4 mb-3">
									<label for="" class="form-label">&nbsp;&nbsp;<span class="asterisk"> </span></label>
									<input type="submit" class="form-select btn app-btn-primary" name="search" value="Search">
								</div> -->

							</div>
						
					</div>
				</div>

				<div class="app-card app-card-settings shadow-sm mb-3 p-3">
					<div class="app-card-body">
						<div class="row g-2" style="margin-bottom: 10px;">
							<div class="col-lg-6 col-sm-12 col-md-6">
								<label for="" class="form-label">Cash in Hand <span class="asterisk"></span></label>
								<input type="text" name="cash_in_hand" class="form-control cash_in_hand" value="" required>
							</div>
							<div class="col-lg-6 col-sm-12 col-md-6">
								<label for="" class="form-label">Cash at Bank <span class="asterisk"></span></label>
								<input type="text" name="cash_at_bank" class="form-control cash_at_bank" value="" required>
							</div>
						</div>
					</div>
					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table align-middle table-hover" style="border:1px solid #e7e9ed;">
								<thead style="background-color: #608d5f;">
									<tr>
										<th width="" class="cell text-white">Name</th>
										<th width="" class="cell text-white text-end">Daily Wages (Rs.)</th>
										<th width="" class="cell text-white">Payable Days</th>
										<th width="" class="cell text-white">Festival Bonus (Rs.)</th>
										<th width="" class="cell text-white">Gross Wages (Rs.)</th>
										<th width="" class="cell text-white">Profession Tax (Rs.)</th>
										<th width="" class="cell text-white">PF Employee's Contribution (Rs.)</th>
										<th width="" class="cell text-white">PF Employer's Contribution (Rs.)</th>
										<th width="" class="cell text-white">Total Deduction (Rs.)</th>
										<th width="" class="cell text-white">Wages Payable for the month <span class="mainDate"></span> (Rs.)</th>
									</tr>
								</thead>
								<tbody class="appendWages">																	
									
								</tbody>
							</table>
						</div>						
					</div>
					<div class="app-card-body remarksSec" style="display: none;">
						<div class="row g-2" style="margin-bottom: 10px;">
							<div class="col-lg-6 col-sm-12 col-md-6">
								<label for="" class="form-label">Upload Files <span class="asterisk"></span></label>
								<input type="file" multiple class="form-control wage_files" name="wage_files[]" value="">
							</div>
							<div class="col-lg-6 col-sm-12 col-md-6">
								<label for="" class="form-label">Remarks <span class="asterisk"></span></label>
								<textarea name="wage_remarks" id="" cols="" rows="2" class="form-control wage_remarks"></textarea>
							</div>
						</div>
					</div>
					<div class="app-card-body">
						<div class="row">
							<div class="col-md-12 text-end">
								<!--<button id="" type="button" class="btn app-btn-primary">SUBMIT</button>-->
								<?php 
									if($this->admin_session_data['role_id'] == '19' || $this->admin_session_data['role_id'] == '22' || $this->admin_session_data['role_id'] == '34' || $this->admin_session_data['role_id'] == '25'){ //PIC/Special Officer Users
										$buttonText = 'Submit to Head Office';
									} else if($this->admin_session_data['role_id'] == '38'){ //DEO Users
										$buttonText = 'Submit to PIC / Special Officer';
									}
								?>
								
								<input type="submit" class="btn app-btn-primary submitWages" value="<?= $buttonText; ?>">
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

		$(document).on('change', '#property_id', function() {

			var baseUrl = $('#base_url').val();
			var propertyId = $(this).val();

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

			//alert(propertyId);

			$.ajax({
				type: "POST",
				url: baseUrl+'admin/wages/wage_workerlist',
				data: {"propertyId":propertyId,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					$('.appendWages').html(response);

					$('.remarksSec').slideDown();
							
				}
			});

		});


		$(document).on('change', '#billing_month', function() {

			//var billingDate = moment($(this).val()).format('MMM YYYY');

			//$('.billDate').text(billingDate);
			//$('.mainDate').text('for the Month '+billingDate);

			var billingMonth = $('#billing_month :selected').text();
			var billingMonthdigit = $('#billing_month :selected').val();
			var financialYear = $('#financial_year :selected').val();

			var startYear = financialYear.substring(0, financialYear.indexOf('-'));
			var endYear = financialYear.substr(financialYear.indexOf("-") + 1);

			if(billingMonthdigit > '03'){
				var displayMonth = billingMonth+' '+startYear;
			} else {
				var displayMonth = billingMonth+' '+endYear;
			}

			$('.mainDate').text(displayMonth);

		});		

		
		$(document).on('input', '.payable_days', function() {

			$('.payable_days').each(function() {

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
                    
                } /*else {
                    alert("Invalid month digit. Please enter a number between 1 and 12.");
                }*/

				
				//var inputValue = $(this).val();
				// Remove non-numeric characters using a regular expression
				//var numericValue = inputValue.replace(/[^0-9]/g, '');
				//$(this).val(numericValue);

				//var item = $('.wageItem');
				//calculateTotal(item);

			});

			$('.wageItem').each(function() {

				var item = $(this);
				calculategrossTotal(item);						

			});

		});


		$(document).on('input', '.festive_bonus, .p_tax, .employee_cnt, .employer_cnt', function() {

			$('.wageItem').each(function() {

				var item = $(this);
				calculategrossTotal(item);						

			});

		});


		$(document).on('click', '.submitWages', function(e) {

			e.preventDefault();

			var counter = 0;
			$(".payable_days").each(function() {
				if ($(this).val() === "") {
					$(this).addClass("redClass").css('border-color','red');
					counter++;
				} else {
					$(this).removeClass("redClass").css('border-color','#e7e9ed');
				}
			});
			if(counter == 0){

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


		function calculategrossTotal(item) {
			var payableInput = item.find('.payable_days');
			var priceInput = item.find('.daily_wage_amount');
			var bonusInput = item.find('.festive_bonus');
			var grossInput = item.find('.gross_wages');

			var p_tax = item.find('.p_tax');
			var employee_cnt = item.find('.employee_cnt');
			var employer_cnt = item.find('.employer_cnt');

			var total_deduct = item.find('.total_deduct');
			var total_wage_amount = item.find('.total_wage_amount');
			
			var days = parseFloat(payableInput.val()) || 0;
			var price = parseFloat(priceInput.val()) || 0;
			var bonus = parseFloat(bonusInput.val()) || 0;

			var pTax = parseFloat(p_tax.val()) || 0;
			var employeeCnt = parseFloat(employee_cnt.val()) || 0;
			var employerCnt = parseFloat(employer_cnt.val()) || 0;

			var totalGross = (days * price) + bonus;
			var totalDeduct = pTax + employeeCnt + employerCnt;

			var totalWage = totalGross - totalDeduct;
			
			grossInput.val(totalGross.toFixed(2)); // Display the total gross with 2 decimal places
			total_deduct.val(totalDeduct.toFixed(2)); // Display the total deduct with 2 decimal places
			total_wage_amount.val(totalWage.toFixed(2)); // Display the total wages with 2 decimal places
		}
		

	});
</script>
