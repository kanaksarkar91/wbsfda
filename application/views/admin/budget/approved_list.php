<!--<div class="app-wrapper">-->
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Approved Estimate</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<!--<a class="btn app-btn-primary" href="">
									Add New Estimation
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
							<div class="col-lg-3 col-sm-12 col-md-4 mb-3">
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
							<div class="col-lg-3 col-sm-12 col-md-4 mb-3">
								<label for="" class="form-label">Select Financial Year <span class="asterisk"></span></label>
								<select name="financial_year" class="form-select select2" id="financial_year">
									<option value="">Select Year</option>
									<option value="2022-2023" <?php if(!empty($financial_year)){ if($financial_year == '2022-2023'){ echo 'selected'; } } ?>>2022-23</option>
									<option value="2023-2024" <?php if(!empty($financial_year)){ if($financial_year == '2023-2024'){ echo 'selected'; } } ?>>2023-24</option>
									<option value="2024-2025" <?php if(!empty($financial_year)){ if($financial_year == '2024-2025'){ echo 'selected'; } } ?>>2024-25</option>
								</select>
							</div>
							<div class="col-lg-3 col-sm-12 col-md-4 mb-3">
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
							<div class="col-lg-2 col-sm-12 col-md-4 mb-3">
								<label for="" class="form-label">&nbsp;&nbsp;<span class="asterisk"> </span></label>
								<input type="submit" class="form-select btn app-btn-primary" name="search" value="Search">
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="app-card app-card-settings shadow-sm mb-3 pt-2">
				<div class="app-card-header p-3">
					<div class="col-md-12 details_head">
						<!-- <h5 class="text-info">Property Name</h5> -->
						<h6><span class="fMonth">Month</span> <span class="fYear">Year</span></h6>
					</div>
				</div>
				<div class="app-card-body">
					<div class="table-responsive">
						<table class="table table-bordered align-middle app-table-hover mb-0 small">
							<thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">
								<tr>
									<th>Unit</th>
									<th>Submitted on</th>
									<th>Submitted by</th>
									<th class="text-end">Estimated Expenses</th>
									<th class="text-end">Approved Expenses</th>
									<th>Approved on</th>
									<th>Approved by</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>

								<?php if(!empty($approved_list)){ ?>

									<?php foreach($approved_list as $approved){ ?>

										<tr>
											<td><?= $approved['property_name']; ?></td>
											<td><?= date("d-m-Y", strtotime($approved['estimated_ts'])); ?></td>
											<td><?= $approved['full_name']; ?></td>
											<td class="text-end estimatedTotal"><?= $approved['estimated_expence_total']; ?></td>
											<td class="text-end approvedTotal"><?= $approved['approved_expence_total']; ?></td>
											<td><?php if($approved['ceo_approval_status'] == '1' && $approved['md_approval_status'] == '0'){ echo date("d-m-Y", strtotime($approved['ceo_approved_ts'])); } else if($approved['ceo_approval_status'] == '1' && $approved['md_approval_status'] == '1'){ echo date("d-m-Y", strtotime($approved['md_approved_ts'])); } else { echo '--'; } ?></td>
											<td><?php if($approved['ceo_approval_status'] == '1' && $approved['md_approval_status'] == '0'){ echo $approved['ceo_approval_person']; } else if($approved['ceo_approval_status'] == '1' && $approved['md_approval_status'] == '1'){ echo $approved['md_approval_person']; } else { echo 'Pending'; } ?></td>
											<td><a href="<?= base_url(); ?>admin/budget/approved_details/<?= $approved['budget_header_id']; ?>" type="button" class="btn-sm app-btn-primary" title="View Details">View Details</a></td>
										</tr>

									<?php } ?>									

								<?php } else { ?>
									<tr><td colspan="8">No Data Found</td></tr>
								<?php } ?>
								
								<tr style="background-color: #1a4919; font-size: 1.1rem; color: #fff;">
									<td colspan="3">Total </td>
									<td class="text-end grandestimatedTotal"></td>
									<td class="text-end grandapprovedTotal"></td>
									<td colspan="3">&nbsp;</td>
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

		setTimeout(function () {
			$('.alert-dismissible').hide();
		}, 3000);

		if($('#billing_month option:selected')){

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

		});


		var estimatedSum = 0;
		var approvedSum = 0;

		$('td.estimatedTotal').each(function() {
			var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				estimatedSum += value; // Add it to the sum
			}
		});

		$('td.approvedTotal').each(function() {
			var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				approvedSum += value; // Add it to the sum
			}
		});

		$('.grandestimatedTotal').text(estimatedSum.toFixed(2));
		$('.grandapprovedTotal').text(approvedSum.toFixed(2));

	});
</script>
