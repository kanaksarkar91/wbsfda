<!--<div class="app-wrapper">-->
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">DAILY INCOME REPORT</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/revenue">
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


			<form method="POST" action="" id="dailyIncomeform">

				<input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">


				<div class="app-card app-card-settings shadow-sm p-3 mb-3">
					<div class="app-card-header mb-3">
						<div class="col-md-12 details_head">
							<h5 class="text-info"><span class="propName"></span> FISHING HARBOUR</h5>
						</div>
					</div>
					<div class="app-card-body">
						<div class="row g-2">
							<div class="col-sm-6 col-md-4 col-lg-4">
								<label for="" class="form-label">Select Unit</label>
								<select name="property_id" class="form-control select2" id="property_id">
									<option value="">Select Unit</option>
									<?php if(!empty($property_list)){ ?>

										<?php foreach($property_list as $property){ ?>
											<option value="<?= $property['property_id']; ?>"><?= $property['property_name']; ?></option>
										<?php } ?>

									<?php } ?>									
								</select>
							</div>
							<div class="col-sm-6 col-md-4 col-lg-4">
								<label for="" class="form-label">Daily income report for the month of</label>
								<input type="month" name="bill_month" class="form-control">
							</div>
							<div class="col-sm-6 col-md-4 col-lg-4">
								<label for="" class="form-label">Select Date</label>
								<div class="date-container">
									<input type="text" name="bill_date" class="form-control" id="bill-date">
									<i class="date-icon fa fa-calendar"></i>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php foreach($head_list as $headList){ ?>

					<?php if($headList['head_title'] == 'Sales of HSD' || $headList['head_title'] == 'Sales of Ice'){ ?>

						<div class="app-card app-card-settings shadow-sm p-3 mb-3">
							<div class="app-card-header">
								<div class="col-md-12 details_head">
									<h5 class="text-info"><?= strtoupper($headList['head_title']); ?></h5>
									<input type="hidden" name="head_id[]" value="<?= $headList['head_id']; ?>">
								</div>
							</div>

							<div class="app-card-body">
								<div class="row g-3">
									<div class="col-md-4 pt-3">
										<div class="card">
											<div class="card-header py-1 px-2">
												<b class="text-uppercase">Cash Sale</b>
											</div>
											<div class="card-body px-2">
												<div class="row">
													<div class="col-md-6">
														<label>Quantity in ltr.</label>
														<input type="text" name="cash_qty[]" class="form-control cash_qty" placeholder="Quantity in ltr.">
													</div>
													<div class="col-md-6">
														<label>Cash Amount (In Rs.)</label>
														<input type="text" name="cash_amount[]" class="form-control cash_amount" placeholder="Received Cash Amount (In Rs.)">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4 pt-3">
										<div class="card">
											<div class="card-header py-1 px-2">
												<b class="text-uppercase">Cheque Sale</b>
											</div>
											<div class="card-body px-2">
												<div class="row">
													<div class="col-md-6">
														<label>Quantity in ltr.</label>
														<input type="text" name="cheque_qty[]" class="form-control cheque_qty" placeholder="Quantity in ltr.">
													</div>
													<div class="col-md-6">
														<label>Cheque Amount (In Rs.)</label>
														<input type="text" name="cheque_amount[]" class="form-control cheque_amount" placeholder="Credit Amount (In Rs.)">
													</div>
												</div>
											</div>
										</div>

									</div>
									<div class="col-md-4 pt-3">
										<div class="card">
											<div class="card-header py-1 px-2">
												<b class="text-uppercase">Credit Sale</b>
											</div>
											<div class="card-body px-2">
												<div class="row">
													<div class="col-md-6">
														<label>Quantity in ltr.</label>
														<input type="text" name="credit_qty[]" class="form-control credit_qty" placeholder="Quantity in ltr.">
													</div>
													<div class="col-md-6">
														<label>Credit Amount (In Rs.)</label>
														<input type="text" name="credit_amount[]" class="form-control credit_amount" placeholder="Credit Amount (In Rs.)">
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>

						</div>

					<?php } ?>

				<?php } ?>

				<!--<div class="app-card app-card-settings shadow-sm p-3 mb-3">
					<div class="app-card-header">
						<div class="col-md-12 details_head">
							<h5 class="text-info">SALES OF HSD</h5>
						</div>
					</div>
					<div class="app-card-body">
						<div class="row g-3">
							<div class="col-md-4 pt-3">
								<div class="card">
									<div class="card-header py-1 px-2">
										<b class="text-uppercase">Cash Sale</b>
									</div>
									<div class="card-body px-2">
										<div class="row">
											<div class="col-md-6">
												<label>Quantity in ltr.</label>
												<input type="text" name="hsd_cash_qty" class="form-control" placeholder="Quantity in ltr.">
											</div>
											<div class="col-md-6">
												<label>Cash Amount (In Rs.)</label>
												<input type="text" name="hsd_cash_amount" class="form-control" placeholder="Received Cash Amount (In Rs.)">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4 pt-3">
								<div class="card">
									<div class="card-header py-1 px-2">
										<b class="text-uppercase">Cheque Sale</b>
									</div>
									<div class="card-body px-2">
										<div class="row">
											<div class="col-md-6">
												<label>Quantity in ltr.</label>
												<input type="text" name="hsd_cheque_qty" class="form-control" placeholder="Quantity in ltr.">
											</div>
											<div class="col-md-6">
												<label>Cheque Amount (In Rs.)</label>
												<input type="text" name="hsd_cheque_amount" class="form-control" placeholder="Credit Amount (In Rs.)">
											</div>
										</div>
									</div>
								</div>

							</div>
							<div class="col-md-4 pt-3">
								<div class="card">
									<div class="card-header py-1 px-2">
										<b class="text-uppercase">Credit Sale</b>
									</div>
									<div class="card-body px-2">
										<div class="row">
											<div class="col-md-6">
												<label>Quantity in ltr.</label>
												<input type="text" name="hsd_credit_qty" class="form-control" placeholder="Quantity in ltr.">
											</div>
											<div class="col-md-6">
												<label>Credit Amount (In Rs.)</label>
												<input type="text" name="hsd_credit_amount" class="form-control" placeholder="Credit Amount (In Rs.)">
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>

				<div class="app-card app-card-settings shadow-sm p-3 mb-3">
					<div class="app-card-header">
						<div class="col-md-12 details_head">
							<h5 class="text-info">SALES OF ICE</h5>
						</div>
					</div>
					<div class="app-card-body">
						<div class="row g-3">
							<div class="col-md-4 pt-3">
								<div class="card">
									<div class="card-header py-1 px-2">
										<b class="text-uppercase">Cash Sale</b>
									</div>
									<div class="card-body px-2">
										<div class="row">
											<div class="col-md-6">
												<label>Quantity in Pcs.</label>
												<input type="text" name="ice_cash_qty" class="form-control" placeholder="Quantity in Pcs.">
											</div>
											<div class="col-md-6">
												<label>Cash Amount (In Rs.)</label>
												<input type="text" name="ice_cash_amount" class="form-control" placeholder="Received Cash Amount (In Rs.)">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4 pt-3">
								<div class="card">
									<div class="card-header py-1 px-2">
										<b class="text-uppercase">Cheque Sale</b>
									</div>
									<div class="card-body px-2">
										<div class="row">
											<div class="col-md-6">
												<label>Quantity in ltr.</label>
												<input type="text" name="ice_cheque_qty" class="form-control" placeholder="Quantity in ltr.">
											</div>
											<div class="col-md-6">
												<label>Cheque Amount (In Rs.)</label>
												<input type="text" name="ice_cheque_amount" class="form-control" placeholder="Credit Amount (In Rs.)">
											</div>
										</div>
									</div>
								</div>

							</div>
							<div class="col-md-4 pt-3">
								<div class="card">
									<div class="card-header py-1 px-2">
										<b class="text-uppercase">Credit Sale</b>
									</div>
									<div class="card-body px-2">
										<div class="row">
											<div class="col-md-6">
												<label>Quantity in Pcs.</label>
												<input type="text" name="ice_credit_qty" class="form-control" placeholder="Quantity in Pcs.">
											</div>
											<div class="col-md-6">
												<label>Credit Amount (In Rs.)</label>
												<input type="text" name="ice_credit_amount" class="form-control" placeholder="Credit Amount (In Rs.)">
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>-->

				<div class="app-card app-card-settings shadow-sm p-3 mb-3">
					<div class="app-card-header mb-3">
						<div class="col-md-12 details_head">
							<h5 class="text-info">INCOME FROM VARIOUS SOURCES</h5>
						</div>
					</div>
					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table align-middle table-hover mb-0" style="border:1px solid #e7e9ed;">
								<thead style="background-color: #608d5f;">
									<tr>
										<th width="70%" class="cell text-white">Income from</th>
										<th width="30%" class="cell text-white text-end">Received Cash Amount (In Rs.)</th>
									</tr>
								</thead>
								<tbody>

									<?php foreach($head_list as $headList){ ?>

										<?php if($headList['head_title'] != 'Sales of HSD' && $headList['head_title'] != 'Sales of Ice'){ ?>

											<tr>
												<td width="70%" class="cell fw-bold"><?= $headList['head_title']; ?></td>
												<input type="hidden" name="head_id[]" value="<?= $headList['head_id']; ?>">
												<td width="30%" class="cell text-end">
													<div class="input-group">
														<span class="input-group-text" id="basic-addon1">Rs.</span>
														<input type="hidden" name="cash_qty[]" class="cash_qty" value="0">

														<input type="text" class="form-control text-end fw-bold cash_amount" id="" name="cash_amount[]" value="" placeholder="0.00">
														
														<input type="hidden" name="cheque_qty[]" class="cheque_qty" value="0">
														<input type="hidden" name="cheque_amount[]" class="cheque_amount" value="0.00">
														<input type="hidden" name="credit_qty[]" class="credit_qty" value="0">
														<input type="hidden" name="credit_amount[]" class="credit_amount" value="0.00">
													</div>
												</td>
											</tr>

										<?php } ?>

									<?php } ?>

								</tbody>
							</table>
							<!--<table class="table align-middle table-hover mb-0" style="border:1px solid #e7e9ed;">
								<thead style="background-color: #608d5f;">
									<tr>
										<th width="70%" class="cell text-white">Miscllenious Receipt Income from</th>
										<th width="30%" class="cell text-white text-end">Received Cash Amount (In Rs.)</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td width="70%" class="cell fw-bold">Security Deposit</td>
										<td width="30%" class="cell text-end">
											<div class="input-group">
												<span class="input-group-text" id="basic-addon1">Rs.</span>
												<input type="text" class="form-control text-end fw-bold" id="" name="" value="00">
											</div>
										</td>
									</tr>
									<tr>
										<td width="70%" class="cell fw-bold">Electricity Recovery</td>
										<td width="30%" class="cell text-end">
											<div class="input-group">
												<span class="input-group-text" id="basic-addon1">Rs.</span>
												<input type="text" class="form-control text-end fw-bold" id="" name="" value="00">
											</div>
										</td>
									</tr>
									<tr>
										<td width="70%" class="cell fw-bold">EMD</td>
										<td width="30%" class="cell text-end">
											<div class="input-group">
												<span class="input-group-text" id="basic-addon1">Rs.</span>
												<input type="text" class="form-control text-end fw-bold" id="" name="" value="00">
											</div>
										</td>
									</tr>
									<tr>
										<td width="70%" class="cell fw-bold">Late Fees</td>
										<td width="30%" class="cell text-end">
											<div class="input-group">
												<span class="input-group-text" id="basic-addon1">Rs.</span>
												<input type="text" class="form-control text-end fw-bold" id="" name="" value="00">
											</div>
										</td>
									</tr>
								</tbody>
							</table>-->
						</div>
					</div>
				</div>

				<div class="app-card app-card-settings shadow-sm p-3 mb-3">
					<div class="app-card-header mb-3">
						<div class="col-md-12 details_head">
							<h5 class="text-info">TOTAL INCOME</h5>
						</div>
					</div>
					<div class="app-card-body">
						<div class="row g-2">
							<div class="col-sm-6 col-md-3 col-lg-3">
								<div class="border rounded d-flex justify-content-between p-2">
									<span>Received Cash Amount</span>
									<h4 class="mb-0 total_cash_amount_text">0.00</h4>
									<input type="hidden" name="total_cash_amount" class="total_cash_amount" value="0.00">
								</div>
							</div>
							<div class="col-sm-6 col-md-3 col-lg-3">
								<div class="border rounded d-flex justify-content-between p-2">
									<span>Cheque Amount</span>
									<h4 class="mb-0 total_cheque_amount_text">0.00</h4>
									<input type="hidden" name="total_cheque_amount" class="total_cheque_amount" value="0.00">
								</div>
							</div>
							<div class="col-sm-6 col-md-3 col-lg-3">
								<div class="border rounded d-flex justify-content-between p-2">
									<span>Credit Amount</span>
									<h4 class="mb-0 total_credit_amount_text">0.00</h4>
									<input type="hidden" name="total_credit_amount" class="total_credit_amount" value="0.00">
								</div>
							</div>
							<div class="col-sm-6 col-md-3 col-lg-3">
								<div class="border rounded d-flex justify-content-between p-2">
									<span>Grand Total</span>
									<h4 class="mb-0 total_grand_amount_text">0.00</h4>
									<input type="hidden" name="total_grand_amount" class="total_grand_amount" value="0.00">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12 text-end">
					<!--<button id="" type="button" class="btn app-btn-primary">SUBMIT</button>-->
					<input type="submit" class="btn app-btn-primary dailyIncomesubmit" value="SUBMIT">
				</div>
			</form>


		</div>
	</div>
	<!--//app-content-->


<!--</div>
//app-wrapper-->

<script type="text/javascript">
	$( document ).ready(function() {
		
		$(document).on('change', '#property_id', function() {

			var propertyName = $('#property_id :selected').text();

			$('.propName').text(propertyName);
		
		});

		setTimeout(function () {
			$('.alert-dismissible').hide();
		}, 3000);


		// Listen for keypress events on the number-input fields
		$('.cash_amount').on('input', function() {
			// Initialize the total sum to zero
			var total = 0;
			var grandTotal = 0;

			var total_cheque_amount = $('.total_cheque_amount').val();
			var total_credit_amount = $('.total_credit_amount').val();

			// Loop through each input field
			$('.cash_amount').each(function() {
				// Parse the value as a float and add it to the total
				total += parseFloat($(this).val()) || 0;
			});

			// Update the result element with the calculated total
			$('.total_cash_amount_text').text(total.toFixed(2));
			$('.total_cash_amount').val(total.toFixed(2));
			
			grandTotal = total + parseFloat(total_cheque_amount) + parseFloat(total_credit_amount);

			$('.total_grand_amount_text').text(grandTotal.toFixed(2));
			$('.total_grand_amount').val(grandTotal.toFixed(2));
		});


		$('.cheque_amount').on('input', function() {
			// Initialize the total sum to zero
			var total = 0;
			var grandTotal = 0;

			var total_cash_amount = $('.total_cash_amount').val();
			var total_credit_amount = $('.total_credit_amount').val();

			// Loop through each input field
			$('.cheque_amount').each(function() {
				// Parse the value as a float and add it to the total
				total += parseFloat($(this).val()) || 0;
			});

			// Update the result element with the calculated total
			$('.total_cheque_amount_text').text(total.toFixed(2));
			$('.total_cheque_amount').val(total.toFixed(2));
			
			grandTotal = total + parseFloat(total_cash_amount) + parseFloat(total_credit_amount);

			$('.total_grand_amount_text').text(grandTotal.toFixed(2));
			$('.total_grand_amount').val(grandTotal.toFixed(2));
		});


		$('.credit_amount').on('input', function() {
			// Initialize the total sum to zero
			var total = 0;
			var grandTotal = 0;

			var total_cash_amount = $('.total_cash_amount').val();
			var total_cheque_amount = $('.total_cheque_amount').val();

			// Loop through each input field
			$('.credit_amount').each(function() {
				// Parse the value as a float and add it to the total
				total += parseFloat($(this).val()) || 0;
			});

			// Update the result element with the calculated total
			$('.total_credit_amount_text').text(total.toFixed(2));
			$('.total_credit_amount').val(total.toFixed(2));
			
			grandTotal = total + parseFloat(total_cash_amount) + parseFloat(total_cheque_amount);

			$('.total_grand_amount_text').text(grandTotal.toFixed(2));
			$('.total_grand_amount').val(grandTotal.toFixed(2));
		});


		$(document).on('click', '.dailyIncomesubmit', function(e) {

			e.preventDefault();

			$.confirm({

				title: "Alert!!",
				content: "Are you sure to submit details? You are not able to change details once submitted. Please check details before submit.",
				buttons: {
					Ok: {
						text: 'Yes',
						btnClass: 'btn-green',
						action: function(){  							
							$("#dailyIncomeform").submit();
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

	});
</script>
