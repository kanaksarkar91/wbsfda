<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Pending Estimate List</h1>
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

			<div class="app-card app-card-settings shadow-sm mb-3">
				<!--<div class="app-card-header p-3 mb-3">
					<div class="col-md-12 details_head">
						<h5 class="text-info">Property Name</h5>
					</div>
				</div>-->
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
									<th style="width:157px;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($estimation_list)){ ?>

									<?php foreach($estimation_list as $estimation){ ?>

										<?php  
											if($estimation['admin_approval_status'] == '0'){
												$adminApprove = '<span class="badge bg-secondary">Pending</span>';
											} else if($estimation['admin_approval_status'] == '1'){
												$adminApprove = '<span class="badge bg-success">Forwarded</span>';
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
											<?php if($this->admin_session_data['role_id'] == '2' || $this->admin_session_data['role_id'] == '39'){ ?>
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
														<div class="m-1"><a href="<?= base_url(); ?>admin/budget/approve_estimate/<?= $estimation['budget_header_id']; ?>" type="button" class="btn-sm app-btn-primary" title="Forward">Forward</a></div>
													<?php } else if($estimation['ceo_approval_status'] == '2' || $estimation['md_approval_status'] == '2'){ ?>
														<div class="m-1"><a href="<?= base_url(); ?>admin/budget/check_modify_estimate/<?= $estimation['budget_header_id']; ?>" type="button" class="btn-sm app-btn-primary" title="Check & Modify">Check & Modify</a></div>
													<?php } ?>
												</td>
											<?php } else if($this->admin_session_data['role_id'] == '20'){ ?>
												<td><?= $estimation['property_name']; ?></td>
												<td><?= date("d-m-Y", strtotime($estimation['estimated_ts'])); ?></td>
												<td><?= $estimation['full_name']; ?></td>
												<td class="text-end estimatedTotal"><?= $estimation['estimated_expence_total']; ?></td>
												<td><?= $adminApprove; ?></td>
												<td><?= $ceoApprove; ?></td>
												<td><?= $mdApprove; ?></td>
												<td>
													<a href="<?= base_url(); ?>admin/budget/ceo_estimate_details/<?= $estimation['budget_header_id']; ?>" type="button" class="btn-sm app-btn-primary" title="View Details">View Details</a>
												</td>
											<?php } else if($this->admin_session_data['role_id'] == '21'){ ?>
												<td><?= $estimation['property_name']; ?></td>
												<td><?= date("d-m-Y", strtotime($estimation['estimated_ts'])); ?></td>
												<td><?= $estimation['full_name']; ?></td>
												<td class="text-end estimatedTotal"><?= $estimation['estimated_expence_total']; ?></td>
												<td><?= $adminApprove; ?></td>
												<td><?= $ceoApprove; ?></td>
												<td><?= $mdApprove; ?></td>
												<td>
													<a href="<?= base_url(); ?>admin/budget/md_estimate_details/<?= $estimation['budget_header_id']; ?>" type="button" class="btn-sm app-btn-primary" title="View Details">View Details</a>
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

	});
</script>
