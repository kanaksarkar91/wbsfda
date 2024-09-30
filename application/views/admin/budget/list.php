<style type="text/css">
table.dataTable.no-footer {
    border-bottom: 1px solid #e7e9ed!important;
}
table.dataTable{
border-collapse: collapse;
}
.dt-buttons{
margin-bottom: .25rem;
}
</style>

<!--<div class="app-wrapper">-->
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-3 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Budget Estimate List</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<?php if(check_user_permission(60, 'add_flag')){ ?>
									<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/budget/add_budget_estimate">
										Add New Estimate
									</a>
								<?php } ?>
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
				<div class="app-card-header p-3 mb-0">
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
									<th>Head Office Action Status</th>
									<th>CAO Approval Status</th>
									<th>MD Approval Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($estimation_list)){ ?>

									<?php foreach($estimation_list as $estimation){ ?>

										<?php  
											if($estimation['admin_approval_status'] == '0'){
												$adminApprove = '<span class="badge bg-secondary">Pending</span>';
											} else if($estimation['admin_approval_status'] == '1'){
												$adminApprove = '<span class="badge bg-success">Processed</span>';
											} else {
												$adminApprove = '<span class="badge bg-danger">Rejected</span>';
											}


											if($estimation['ceo_approval_status'] == '0'){
												$ceoApprove = '<span class="badge bg-secondary">Pending</span>';
											} else if($estimation['ceo_approval_status'] == '1'){
												$ceoApprove = '<span class="badge bg-success">Approved</span>';
											} else {
												$ceoApprove = '<span class="badge bg-danger">Rejected</span>';
											}


											if($estimation['md_approval_status'] == '0'){
												$mdApprove = '<span class="badge bg-secondary">Pending</span>';
											} else if($estimation['md_approval_status'] == '1'){
												$mdApprove = '<span class="badge bg-success">Approved</span>';
											} else {
												$mdApprove = '<span class="badge bg-danger">Rejected</span>';
											}
										?>

										<tr>
											<?php if($this->admin_session_data['role_id'] == '2' || $this->admin_session_data['role_id'] == '39'){ //Admin and Subadmin ?>
												<td><?= $estimation['property_name']; ?></td>
												<td><?= date("d-m-Y", strtotime($estimation['estimated_ts'])); ?></td>
												<td><?= $estimation['full_name']; ?></td>
												<td class="text-end estimatedTotal"><?= $estimation['estimated_expence_total']; ?></td>
												<td><?= $adminApprove; ?></td>
												<td><?= $ceoApprove; ?></td>
												<td><?= $mdApprove; ?></td>
												<td>
													<div class="m-1"><a href="<?= base_url(); ?>admin/budget/estimate_details/<?= $estimation['budget_header_id']; ?>" type="button" class="btn-sm app-btn-primary" title="View Details">View Details</a></div>
													<?php if($estimation['admin_approval_status'] == '0'){ ?>
														<div class="m-1"><a href="<?= base_url(); ?>admin/budget/approve_estimate/<?= $estimation['budget_header_id']; ?>" type="button" class="btn-sm app-btn-primary" title="Process">Process</a></div>
													<?php } else if($estimation['ceo_approval_status'] == '2' || $estimation['md_approval_status'] == '2'){ ?>
														<div class="m-1"><a href="<?= base_url(); ?>admin/budget/check_modify_estimate/<?= $estimation['budget_header_id']; ?>" type="button" class="btn-sm app-btn-primary" title="Check & Modify">Check & Modify</a></div>
													<?php } ?>
												</td>
											<?php } else if($this->admin_session_data['role_id'] == '20'){ //CAO ?>
												<td><?= $estimation['property_name']; ?></td>
												<td><?= date("d-m-Y", strtotime($estimation['estimated_ts'])); ?></td>
												<td><?= $estimation['full_name']; ?></td>
												<td class="text-end estimatedTotal"><?= $estimation['estimated_expence_total']; ?></td>
												<td><?= $adminApprove; ?></td>
												<td><?= $ceoApprove; ?></td>
												<td><?= $mdApprove; ?></td>
												<td>
													<a href="<?= base_url(); ?>admin/budget/estimate_details/<?= $estimation['budget_header_id']; ?>" type="button" class="btn-sm app-btn-primary" title="View Details">View Details</a>
												</td>
											<?php } else if($this->admin_session_data['role_id'] == '21'){ //MD ?>
												<td><?= $estimation['property_name']; ?></td>
												<td><?= date("d-m-Y", strtotime($estimation['estimated_ts'])); ?></td>
												<td><?= $estimation['full_name']; ?></td>
												<td class="text-end estimatedTotal"><?= $estimation['estimated_expence_total']; ?></td>
												<td><?= $adminApprove; ?></td>
												<td><?= $ceoApprove; ?></td>
												<td><?= $mdApprove; ?></td>
												<td>
													<a href="<?= base_url(); ?>admin/budget/estimate_details/<?= $estimation['budget_header_id']; ?>" type="button" class="btn-sm app-btn-primary" title="View Details">View Details</a>
												</td>
											<?php } else { ?>
												<td><?= $estimation['property_name']; ?></td>
												<td><?= date("d-m-Y", strtotime($estimation['estimated_ts'])); ?></td>
												<td><?= $estimation['full_name']; ?></td>
												<td class="text-end estimatedTotal"><?= $estimation['estimated_expence_total']; ?></td>
												<td><?= $adminApprove; ?></td>
												<td><?= $ceoApprove; ?></td>
												<td><?= $mdApprove; ?></td>
												<td>
													<a href="<?= base_url(); ?>admin/budget/estimate_details/<?= $estimation['budget_header_id']; ?>" type="button" class="btn-sm app-btn-primary" title="View Details">View Details</a>
													<?php if($estimation['is_publish'] == '0'){ ?>

														<?php if(check_user_permission(84, 'add_flag')){ ?>
															<a href="<?= base_url(); ?>admin/budget/verify_draftestimate/<?= $estimation['budget_header_id']; ?>" type="button" class="btn-sm app-btn-primary" title="Submit Estimate">Submit Estimate</a>
														<?php } ?>

													<?php } else { ?>
														
														<?= 'Submitted Estimate'; ?>

													<?php } ?>
												</td>
											<?php } ?>											
										</tr>

									<?php } ?>									

								<?php } else { ?>
									<?php if($this->admin_session_data['role_id'] == '2' || $this->admin_session_data['role_id'] == '39'){ ?>
										<tr><td colspan="8">No Data Found</td></tr>
									<?php } else if($this->admin_session_data['role_id'] == '20'){ ?>
										<tr><td colspan="8">No Data Found</td></tr>
									<?php } else if($this->admin_session_data['role_id'] == '21'){ ?>
										<tr><td colspan="8">No Data Found</td></tr>
									<?php } else { ?>
										<tr><td colspan="8">No Data Found</td></tr>
									<?php } ?>
								<?php } ?>
								
								<tr style="background-color: #1a4919; font-size: 1.1rem; color: #fff;">									
									<?php if($this->admin_session_data['role_id'] == '2' || $this->admin_session_data['role_id'] == '39'){ ?>
										<td colspan="3">Total </td>
										<td class="text-end grandestimatedTotal"></td>
										<td colspan="">&nbsp;</td>
										<td colspan="">&nbsp;</td>
										<td colspan="">&nbsp;</td>
										<td colspan="">&nbsp;</td>
									<?php } else if($this->admin_session_data['role_id'] == '20'){ ?>
										<td colspan="3">Total </td>
										<td class="text-end grandestimatedTotal"></td>
										<td colspan="">&nbsp;</td>
										<td colspan="">&nbsp;</td>
										<td colspan="">&nbsp;</td>
										<td colspan="">&nbsp;</td>
									<?php } else if($this->admin_session_data['role_id'] == '21'){ ?>
										<td colspan="3">Total </td>
										<td class="text-end grandestimatedTotal"></td>
										<td colspan="">&nbsp;</td>
										<td colspan="">&nbsp;</td>
										<td colspan="">&nbsp;</td>
										<td colspan="">&nbsp;</td>
									<?php } else { ?>
										<td colspan="3">Total </td>
										<td class="text-end grandestimatedTotal"></td>
										<td colspan="">&nbsp;</td>
										<td colspan="">&nbsp;</td>
										<td colspan="">&nbsp;</td>
										<td colspan="">&nbsp;</td>
									<?php } ?>
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

		$('td.estimatedTotal').each(function() {
			var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				estimatedSum += value; // Add it to the sum
			}
		});

		$('.grandestimatedTotal').text(estimatedSum.toFixed(2));


		setTimeout(function () {
			$('.alert-dismissible').hide();
		}, 3000);

	});
</script>
