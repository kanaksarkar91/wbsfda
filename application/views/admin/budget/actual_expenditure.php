<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Expenditure List</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<!--<a class="btn app-btn-primary" href="<?php //echo base_url(); ?>admin/budget/add_budget_estimate">
									Add New Estimate
								</a>-->
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

            <div class="app-card app-card-orders-table shadow-sm mb-3">
					<div class="app-card-body px-2">

                        <form action="" method="post">

                            <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

							<div class="row g-2">
								<div class="col-lg-6 col-sm-12 col-md-12 mb-3 property_id">
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
								<!--<div class="col-lg-4 col-sm-12 col-md-4 mb-3 financial_year">
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
								</div>-->
								<div class="col-lg-2 col-sm-12 col-md-4 mb-3">
									<label for="" class="form-label">&nbsp;&nbsp;<span class="asterisk"> </span></label>
									<input type="submit" class="form-select btn app-btn-primary" name="search" value="Search">
								</div>

							</div>

                        </form>
						
					</div>
				</div>

			<div class="app-card app-card-settings shadow-sm mb-3">
				<!-- <div class="app-card-header p-3 mb-3">
					<div class="col-md-12 details_head">
						<h5 class="text-info">Property Name</h5> 
					</div>
				</div>-->
				<div class="app-card-body">
					<div class="table-responsive">
						<table id="expenditureTable" class="table table-bordered align-middle app-table-hover mb-0 small">
							<thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">
								<tr>
									<th>Unit</th>
									<th>Submitted on</th>
                                    <th>Financial Year</th>
									<th>Expenditure Month</th>
									<th class="text-end">Expenditure</th>
                                    <th>Download File</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($actual_expenditure)){ ?>

									<?php foreach($actual_expenditure as $expenditure){ ?>

										<tr>
											<td><?= $expenditure['property_name']; ?></td>
											<td><?= date("d-m-Y", strtotime($expenditure['estimated_ts'])); ?></td>
											<td><?= $expenditure['financial_year']; ?></td>
                                            <td><?= $expenditure['expense_month']; ?></td>
											<td class="text-end estimatedTotal"><?php if(!empty($expenditure['actual_expenditure_total'])){ echo $expenditure['actual_expenditure_total']; } else { echo '0.00'; } ?></td>
											<!--<td class="text-end">100000</td>
											<td>12-9-2023</td>-->
											<td>
                                                <?php foreach($expenditure['budget_details'] as $budget_details){ ?>

                                                    <?php if(!empty($budget_details['supportingfiles'])){ ?>

                                                        <?php foreach($budget_details['supportingfiles'] as $suppFile){ ?>
                                                            <a class="pull-left m-1 btn-sm app-btn-primary" href="<?= base_url(); ?>public/estimated_files/<?= $suppFile['file_title']; ?>" title="<?= $suppFile['file_title']; ?>" download><i class="fa fa-download"></i></a>
                                                        <?php } ?>

                                                    <?php } ?>

                                                <?php } ?>
                                            </td>
											<td>
												<a href="<?= base_url(); ?>admin/budget/update_expenditure/<?= $expenditure['budget_header_id']; ?>" type="button" class="btn-sm app-btn-primary" title="View Details">Add / Update Expenditure</a>
											</td>
										</tr>

									<?php } ?>									

								<?php } else { ?>
									<tr><td colspan="7">No Data Found</td></tr>
								<?php } ?>
								
								<tr style="background-color: #1a4919; font-size: 1.1rem; color: #fff;">
									<td colspan="4">Total </td>
									<td class="text-end grandestimatedTotal"></td>
									<!--<td class="text-end">100000</td>-->
									<td colspan="2">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>


		</div>
	</div>
	<!--//app-content-->


<!--</div>
//app-wrapper-->

<script type="text/javascript">
	$( document ).ready(function() {

		/*if($('#billing_month option:selected')){

			var billingMonth = $('#billing_month :selected').text();
			var billingMonthdigit = $('#billing_month :selected').val();
			var financialYear = $('#financial_year :selected').val();

			var startYear = financialYear.substring(0, financialYear.indexOf('-'));
			var endYear = financialYear.substr(financialYear.indexOf("-") + 1);

			if(billingMonthdigit > '03'){
				var displayMonth = billingMonth;
				var diaplayYear = startYear;
			} else {
				var displayMonth = billingMonth;
				var diaplayYear = endYear;
			}

			$('.fMonth').text(displayMonth);
			$('.fYear').text(diaplayYear);

		}

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
				var displayMonth = billingMonth;
				var diaplayYear = startYear;
			} else {
				var displayMonth = billingMonth;
				var diaplayYear = endYear;
			}

			$('.fMonth').text(displayMonth);
			$('.fYear').text(diaplayYear);

		});*/


		var estimatedSum = 0;

		$('td.estimatedTotal').each(function() {
			var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				estimatedSum += value; // Add it to the sum
			}
		});

		$('.grandestimatedTotal').text(estimatedSum.toFixed(2));


        //new DataTable('#expenditureTable');

	});
</script>
