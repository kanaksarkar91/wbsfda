
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>


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
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Estimate Expenditure Details</h1>
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

			<form action="<?= base_url(); ?>admin/budget/approval_submit" method="post" enctype="multipart/form-data" id="approvalForm">

				<input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

				<!--<input type="hidden" name="budget_header_id" value="<?php //echo $estimation_details['budget_header_id']; ?>">-->

				<div class="app-card app-card-orders-table shadow-sm mb-3">
					<div class="app-card-body px-2">
						

							<div class="row g-2">
								<div class="col-lg-4 col-sm-12 col-md-12 mb-3">
									<label for="" class="form-label">Unit <span class="asterisk"></span></label>
									<select name="" class="form-select select2" id="property_id" disabled>
									<option value="">Select Unit</option>

										<?php if(!empty($property_list)){ ?>

											<?php foreach($property_list as $property){ ?>
												<option value="<?= $property['property_id']; ?>" <?php if(!empty($estimation_details)){ if($property['property_id'] == $estimation_details['property_id']){ echo 'selected'; } } ?>><?= $property['property_name']; ?></option>
											<?php } ?>

										<?php } ?>
									</select>
								</div>
								<div class="col-lg-4 col-sm-12 col-md-4 mb-3">
									<label for="" class="form-label">Financial Year <span class="asterisk"></span></label>
									<select name="" class="form-select select2" id="financial_year" disabled>
										<option value="">Select Year</option>
										<option value="2022-2023" <?php if(!empty($estimation_details)){ if($estimation_details['financial_year'] == '2022-2023'){ echo 'selected'; } } ?>>2022-23</option>
										<option value="2023-2024" <?php if(!empty($estimation_details)){ if($estimation_details['financial_year'] == '2023-2024'){ echo 'selected'; } } ?>>2023-24</option>
										<option value="2024-2025" <?php if(!empty($estimation_details)){ if($estimation_details['financial_year'] == '2024-2025'){ echo 'selected'; } } ?>>2024-25</option>
									</select>
								</div>
								<div class="col-lg-4 col-sm-12 col-md-4 mb-3">
									<label for="" class="form-label">Estimated Expenses for the Month of<span class="asterisk"></span></label>
									<select name="" class="form-select select2" id="billing_month" disabled>
										<option value="">Select Month</option>
										<option value="01" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '01'){ echo 'selected'; } } ?>>Jan</option>
										<option value="02" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '02'){ echo 'selected'; } } ?>>Feb</option>
										<option value="03" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '03'){ echo 'selected'; } } ?>>Mar</option>
										<option value="04" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '04'){ echo 'selected'; } } ?>>Apr</option>
										<option value="05" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '05'){ echo 'selected'; } } ?>>May</option>
										<option value="06" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '06'){ echo 'selected'; } } ?>>June</option>
										<option value="07" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '07'){ echo 'selected'; } } ?>>July</option>
										<option value="08" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '08'){ echo 'selected'; } } ?>>Aug</option>
										<option value="09" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '09'){ echo 'selected'; } } ?>>Sep</option>
										<option value="10" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '10'){ echo 'selected'; } } ?>>Oct</option>
										<option value="11" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '11'){ echo 'selected'; } } ?>>Nov</option>
										<option value="12" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '12'){ echo 'selected'; } } ?>>Dec</option>
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
					<div class="app-card-body pb-3">
						<h6 class="p-3"><span class="mainDate">Proposed Estimate Expenditure for the Month of: <?= $fYear; ?></span></h6>
						<div class="table-responsive">

							<?php //if($this->admin_session_data['role_id'] == '2' || $this->admin_session_data['role_id'] == '39'){ ?>

								<button style="background: #00bdd6; padding: 6px 10px; color: #FFF; border-radius: 6px;" id="printAcc">Print</button>

								<table id="estiDetailtab" class="table table-sm table-bordered align-middle table-hover" style="display:none;">
									<thead style="background-color: #608d5f;">
										<tr>
											<th width="" class="cell text-white">SN. NO.</th>
											<th width="" class="cell text-white">Particulars</th>
											<th width="" class="cell text-white text-end">Amount (Rs.)</th>
											<th width="" class="cell text-white">Remarks</th>
											<th width="" class="cell text-white text-end" style="background:#3F51B5;"><span style="display: block; font-size: 11px;">Total estimate already submitted during this month</span> Amount
												(In Rs.)</th>
											<th width="" class="cell text-white text-end" style="background:#2196F3;"><span style="display: block; font-size: 11px;">Total amount already approved during this month</span> Amount
												(In Rs.) </th>
											<th width="" class="cell text-white text-end" style="background:#00BCD4;"><span style="display: block; font-size: 11px;">Actual Expenditure of the Previous Month</span> Amount
												(In Rs.)</th>
											<th width="" class="cell text-white text-end"><span style="display: block; font-size: 11px;">Approved Estimate</span> Amount (Rs.)</th>
											<th width="" class="cell text-white">Approve Remarks</th>
										</tr>
									</thead>
									<tbody>

										<?php $i = 1; ?>
										<?php foreach($estimation_details['budget_details'] as $estimation){ ?>

											<tr>
												<td width="" class="cell"><?= $i; ?></td>
												<td width="" class="cell" style="font-size: 12px;"><?= $estimation['particular_title']; ?></td>
												<td width="" class="cell text-end"><?php if(!empty($estimation['estimated_expence_amount'])){ echo $estimation['estimated_expence_amount']; } else { echo '0.00'; } ?></td>

												<td width="" class="cell"><?php if(!empty($estimation['estimated_remarks'])){ echo $estimation['estimated_remarks']; } else { echo '--'; } ?></td>

												<td width="" class="cell text-end"><?= $estimation['total_estimate_curmonth']; ?></td>

												<td width="" class="cell text-end"><?= $estimation['total_approved_curmonth']; ?></td>

												<td width="" class="cell text-end"><?= $estimation['total_actualexpendature_prevmonth']; ?></td>

												<td width="" class="cell text-end"><?php if(!empty($estimation['approved_expence_amount'])){ echo $estimation['approved_expence_amount']; } else { echo '0.00'; } ?></td>

												<td width="" class="cell"><?php if(!empty($estimation['approved_remarks'])){ echo $estimation['approved_remarks']; } else { echo '--'; } ?></td>
											</tr>

											<?php $i++; ?>

										<?php } ?>
										
										<tr style="background-color: #1a4919; font-size: 1.1rem;">
											<td width="" class="cell text-white">50</td>
											<td width="" class="cell text-white">Total</td>
											<td width="" class="cell text-white text-end total_estimated_amount_text"><?= $estimation_details['estimated_expence_total'] ?></td>
											<td width="" class="cell text-white"></td>
											<td width="" class="cell text-white text-end total_estimated_amount_thismonth">0.00</td>
											<td width="" class="cell text-white text-end total_approved_amount_thismonth">0.00</td>
											<td width="" class="cell text-white text-end total_actual_amount_prevmonth">0.00</td>
											<td width="" class="cell text-white text-end total_approved_amount_text"><?= $estimation_details['approved_expence_total'] ?></td>
											<td width="" class="cell text-white"></td>
										</tr>
									</tbody>
								</table>

							<?php //} ?>

							<table id="estiDetailtab1" class="table table-sm table-bordered align-middle table-hover" style="border:1px solid #e7e9ed;">
								<thead style="background-color: #608d5f;">
									<tr>
										<th width="" class="cell text-white">Particulars</th>
										<th width="" class="cell text-white text-end">Amount (Rs.)</th>
										<th width="" class="cell text-white">Remarks</th>
										<th width="" class="cell text-white">Download File</th>
										<th width="" class="cell text-white text-end" style="background:#3F51B5;"><span style="display: block; font-size: 11px;">Total estimate already submitted during this month</span> Amount
                                            (In Rs.)</th>
										<th width="" class="cell text-white text-end" style="background:#2196F3;"><span style="display: block; font-size: 11px;">Total amount already approved during this month</span> Amount
                                            (In Rs.) </th>
										<th width="" class="cell text-white text-end" style="background:#00BCD4;"><span style="display: block; font-size: 11px;">Actual Expenditure of the Previous Month</span> Amount
                                            (In Rs.)</th>
										<th width="" class="cell text-white text-end">Approved Amount (Rs.)</th>
										<th width="" class="cell text-white">Approve Remarks</th>
									</tr>
								</thead>
								<tbody>

									<?php foreach($estimation_details['budget_details'] as $estimation){ ?>

										<tr>
											<td width="" class="cell" style="font-size: 12px;"><?= $estimation['particular_title']; ?></td>
											<td width="" class="cell text-end">
												
													<input type="text" class="form-control text-end fw-bold estimated_expence_amount" name="" value="<?= $estimation['estimated_expence_amount']; ?>" placeholder="0.00" readonly>
													<!--<input type="hidden" name="budget_details_id[]" value="<?php //echo $estimation['budget_details_id']; ?>">-->
												
											</td>

											<td width="" class="cell">
												<div class="input-group">
													<textarea name="" id="" cols="" rows="2" class="form-control estimation_remarks" readonly><?= $estimation['estimated_remarks']; ?></textarea>
												</div>
											</td>

											<td width="" class="cell">
												<?php foreach($estimation['supportingfiles'] as $suppFile){ ?>
													<a class="btn-sm app-btn-primary m-1 pull-left" href="<?= base_url(); ?>public/estimated_files/<?= $suppFile['file_title']; ?>" title="<?= $suppFile['file_title']; ?>" download><i class="fa fa-download"></i></a>
												<?php } ?>
											</td>

											<td width="" class="cell">
												
													<input type="text" class="form-control text-end fw-bold estimated_expence_amount_thismonth" name="" value="<?= $estimation['total_estimate_curmonth']; ?>" placeholder="0.00" readonly>
												
											</td>

											<td width="" class="cell">
													<input type="text" class="form-control text-end fw-bold approved_expence_amount_thismonth" name="" value="<?= $estimation['total_approved_curmonth']; ?>" placeholder="0.00" readonly>
												
											</td>

											<td width="" class="cell">
													<input type="text" class="form-control text-end fw-bold estimated_expence_amount_prevmonth" name="" value="<?= $estimation['total_actualexpendature_prevmonth']; ?>" placeholder="0.00" readonly>
												
											</td>

											<td width="" class="cell text-end">
												
													<input type="text" class="form-control text-end fw-bold approved_expence_amount" name="" value="<?= $estimation['approved_expence_amount']; ?>" placeholder="0.00" readonly>
													<!--<input type="hidden" name="budget_details_id[]" value="<?php //echo $estimation['budget_details_id']; ?>">-->
												
											</td>

											<td width="" class="cell">
												<div class="input-group">
													<textarea name="" id="" cols="" rows="2" class="form-control approved_remarks" readonly><?= $estimation['approved_remarks']; ?></textarea>
												</div>
											</td>
										</tr>

									<?php } ?>
									
									<tr style="background-color: #1a4919; font-size: 1.1rem;">
										<td width="" class="cell text-white">Total</td>
										<td width="" class="cell text-white text-end total_estimated_amount_text"><?= $estimation_details['estimated_expence_total'] ?></td>
										<td width="" class="cell text-white" colspan="2"></td>
										<td width="" class="cell text-white text-end total_estimated_amount_thismonth">0.00</td>
										<td width="" class="cell text-white text-end total_approved_amount_thismonth">0.00</td>
										<td width="" class="cell text-white text-end total_actual_amount_prevmonth">0.00</td>
										<td width="" class="cell text-white text-end total_approved_amount_text"><?= $estimation_details['approved_expence_total'] ?></td>
										<td width="" class="cell text-white"></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="row">
							<!--<div class="col-md-4">
								<label for="" class="form-label">Remarks</label>
								<textarea name="" id="" cols="" rows="4" class="form-control" readonly><?php if(!empty($estimation_details['estimation_remarks'])){ echo $estimation_details['estimation_remarks']; } ?></textarea>
							</div>
							<div class="col-md-3">
								<label for="" class="form-label">Uploaded File</label>
								<?php if(!empty($estimation_details['supporting_file'])){ ?>

									<?php
										$filename = $estimation_details['supporting_file'];

										$extension = pathinfo($filename, PATHINFO_EXTENSION);

										//echo "The file extension is: $extension";

										if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg'){
									?>

										<a href="<?= base_url(); ?>public/estimated_files/<?= $estimation_details['supporting_file']; ?>" download=""><img src="<?= base_url(); ?>public/estimated_files/<?= $estimation_details['supporting_file']; ?>" width="305"></a>
										

									<?php } else { ?>

										<embed src="<?= base_url(); ?>public/estimated_files/<?= $estimation_details['supporting_file']; ?>" type="application/pdf" width="305" height="305">
										
									<?php } ?>
									
								<?php } else { ?>
									<p>No Uploaded file found.</p>
								<?php } ?>
							</div>-->

							<!--<div class="col-md-10">
								<label for="" class="form-label">Remarks</label>
								<textarea name="approval_remarks" id="" cols="" rows="4" class="form-control"></textarea>
							</div>
							<div class="col-md-2">
								<label for="" class="form-label w-100">&nbsp;</label>
								<input type="submit" class="btn app-btn-primary approvalFormsubmit" name="" value="Submit">
							</div>-->
						</div>
					</div>
				</div>

			</form>

		</div>
	</div>
	<!--//app-content-->


<!--</div>
//app-wrapper-->

<script type="text/javascript">
	$( document ).ready(function() {

		// Listen for keypress events on the number-input fields
		$('.approved_expence_amount').on('input', function() {
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


		$(document).on('click', '.approvalFormsubmit', function(e) {

			e.preventDefault();

			$.confirm({

				title: "Alert!!",
				content: "Are you sure to submit details? You are not able to change details once submitted. Please check details before submit.",
				buttons: {
					Ok: {
						text: 'Yes',
						btnClass: 'btn-green',
						action: function(){  							
							$("#approvalForm").submit();
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


		$('#estiDetailtab').DataTable( {
			/*"columnDefs": [
				{
					"targets": [ 0 ],
					"visible": false,
					"searchable": false
				}
			],*/
			bInfo: false,
			searching: false,
			paging: false,
			dom: 'Bfrtip', // Buttons configuration
			//buttons: [
				//'pdf', 'print' // Include the HTML5 print button
			//]
			/*buttons: [
				//'copyHtml5',
				//'excelHtml5',
				//'csvHtml5',
				'pdfHtml5',
			]*/
			buttons: [
				{
					extend: 'pdf',
					text: 'Download PDF',
					className: 'btn btn-default',
					exportOptions: {
						columns: 'th:not(:first-child)'
					}
				},
			]
		}).buttons().container().appendTo('#estiDetailtab_wrapper .col-md-6:eq(0)');


		// Function to trigger printing
		function printTable() {
			var printWindow = window.open('', '', 'width=600,height=600');
			var content = $("#estiDetailtab1").clone();

			// Set A4 page size in CSS (210mm x 297mm)
			content.css('width', '220mm');
			content.css('height', '297mm');

			printWindow.document.open();
			printWindow.document.write('<html><head><title>Department of Fisheries-Estimation Details</title></head><body>');
			printWindow.document.write(content.prop('outerHTML'));
			printWindow.document.write('</body></html>');
			printWindow.document.close();

			// Trigger the print dialog
			printWindow.print();
			printWindow.close();
		}

		// Call the printTable function on a specific event, e.g., a button click
		$(document).on('click', '#printAcc', function() {
			printTable();
		});

	});
</script>

