<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Transaction List</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<!--<a class="btn app-btn-primary" href="<?php //echo base_url(); ?>admin/budget/add_budget_estimate">
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


			<div class="app-card app-card-orders-table shadow-sm mb-3">
				<div class="app-card-body p-3">
					<form action="" method="post">

						<input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

						<div class="row g-3">
							<div class="col-lg-3 col-sm-12 col-md-4">
								<label for="" class="form-label">Select Harbour <span class="asterisk"></span></label>
								<select name="property_id" class="form-control select2 property_id" id="property_id">
									<option value="">Select Harbour</option>
									<?php if(!empty($property_list)){ ?>

										<?php foreach($property_list as $property){ ?>
											<option value="<?= $property['property_id']; ?>" <?php if(!empty($harbourId)){ if($harbourId == $property['property_id']){ echo 'selected'; } } ?>><?= $property['property_name']; ?></option>
										<?php } ?>

									<?php } ?>									
								</select>
							</div>
							<div class="col-lg-3 col-sm-12 col-md-4">
								<label for="" class="form-label">Select Date</label>
								<div class="date-container">
									<input type="text" name="bill_date" class="form-control bill_date" id="bill-date" placeholder="DD-MM-YYYY" value="<?php if(!empty($transDate)){ echo $transDate; } ?>">
									<i class="date-icon fa fa-calendar"></i>
								</div>
							</div>
							<div class="col-lg-2 col-sm-12 col-md-4">
								<label for="" class="form-label">&nbsp;&nbsp;<span class="asterisk"> </span></label>
								<input type="submit" class="form-select btn app-btn-primary" name="search" value="Search">
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="app-card app-card-settings shadow-sm mb-3">
				<div class="app-card-body">
					<div class="table-responsive">
						<table class="table table-bordered align-middle app-table-hover mb-0 small">
							<thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">
								<tr>
									<th>Date</th>
									<th>Transaction ID</th>
									<th>Harbour</th>
									<th>Transaction Type</th>
									<th>Transaction Sub-Type</th>
									<th>Quantity</th>
									<th>UOM</th>
									<th>Mode of Transaction</th>
									<th>Term</th>
									<th>Party</th>
									<th class="text-end">Amount (Rs)</th>
									<th style="width:128px;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($transaction_list)){ ?>

									<?php foreach($transaction_list as $transaction){ ?>

										<?php
											if($transaction['transaction_type'] == 'PS'){
												$transType = 'Product Sale';
											} else if($transaction['transaction_type'] == 'RC'){
												$transType = 'Recovery of Credit Sale';
											} else if($transaction['transaction_type'] == 'OS'){
												$transType = 'Other Sale';
											}

											if(!empty($transaction['term'])){

												if($transaction['term'] == 'LT'){
													$term = 'Long Term';
												} else {
													$term = 'Short Term';
												}

											} else {
												$term = '--';
											}
											
										?>

										<tr>											
											<td><?= date("d-m-Y", strtotime($transaction['transaction_date'])); ?></td>
											<td><?= $transaction['sale_transaction_id']; ?></td>
											<td><?= $transaction['property_name']; ?></td>
											<td><?= $transType; ?></td>
											<td><?php if(!empty($transaction['harbour_product_name'])){ echo $transaction['harbour_product_name']; } else { echo '--'; } ?></td>
											<td><?php if(!empty($transaction['qty'])){ echo $transaction['qty']; } else { echo '--'; } ?></td>
											<td><?php if(!empty($transaction['uom_name'])){ echo $transaction['uom_name']; } else { echo '--'; } ?></td>
											<td><?php if(!empty($transaction['payment_mode'])){ echo $transaction['payment_mode']; } else { echo '--'; } ?></td>
											<td><?= $term; ?></td>
											<td><?php if(!empty($transaction['harbour_buyer_name'])){ echo $transaction['harbour_buyer_name']; } else { echo '--'; } ?></td>
											<td class="text-end estimatedTotal"><?= $transaction['total_amount']; ?></td>
											<td><a href="javascript:void(0)" type="button" class="btn-sm app-btn-primary transDetails" data-rtransactionid="<?= $transaction['transaction_id']; ?>"<?= $transaction['harbour_buyer_name']; ?> title="View Details">View Details</a></td>											
										</tr>

									<?php } ?>									

								<?php } else { ?>
									<tr><td colspan="12">No Data Found</td></tr>
								<?php } ?>
								
								
							</tbody>
						</table>
					</div>
				</div>
			</div>


		</div>
	</div>
	<!--//app-content-->

	<!-- Modal -->
	<div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Transaction Details</h5>
				<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>-->
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table">
						<tbody>
							<tr>
								<th scope="row">Harbour:</th>
								<td class="harboutView"></td>
							</tr>
							<tr>
								<th scope="row">Transaction Date:</th>
								<td class="tdateView"></td>
							</tr>
							<tr>
								<th scope="row">Transaction Type:</th>
								<td class="saletypeView"></td>
							</tr>
							<tr>
								<th scope="row">Transaction Sub-Type:</th>
								<td class="salesubtypeView"></td>
							</tr>
							<tr>
								<th scope="row">Quantity:</th>
								<td class="quantityView"></td>
							</tr>
							<tr>
								<th scope="row">Rate / <span class="rateViewuom"></span>:</th>
								<td class="rateView"></td>
							</tr>
							<tr>
								<th scope="row">Mode of Transaction:</th>
								<td class="modeView"></td>
							</tr>
							<tr>
								<th scope="row">Term:</th>
								<td class="termView"></td>
							</tr>
							<tr>
								<th scope="row">Party:</th>
								<td class="buyerView"></td>
							</tr>
							<tr>
								<th scope="row">Amount (Rs.):</th>
								<td class="amountView"></td>
							</tr>
							
							<tr>
								<th scope="row">Remarks:</th>
								<td class="remarksView"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary cancleDetails" data-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
	</div>

	<input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
	<input type="hidden" id="base_url" value="<?= base_url(); ?>">


<!--</div>
//app-wrapper-->

<script type="text/javascript">
	$( document ).ready(function() {

		$(document).on('click', '.transDetails', function(e) {

			var baseUrl = $('#base_url').val();
			var transactionId = $(this).data('rtransactionid');

			//alert(transactionId);

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

			$.ajax({
				type: "POST",
				url: baseUrl+'admin/revenue/transaction_details',
				data: {"transactionId":transactionId,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					if(response.transaction_type == 'PS'){
						var transType = 'Product Sale';
					} else if(response.transaction_type == 'RC'){
						var transType = 'Recovery of Credit Sale';
					} else if(response.transaction_type == 'OS'){
						var transType = 'Other Sale';
					}

					if(response.harbour_product_name){
						var transProd = response.harbour_product_name;
					} else {
						var transProd = 'Not Applicable';
					}

					if(response.qty){
						var transQty = response.qty;
					} else {
						var transQty = 'Not Applicable';
					}

					if(response.rate_uom){
						var transRate = response.rate_uom+' ('+response.uom_name+')';
					} else {
						var transRate = 'Not Applicable';
					}

					if(response.term){
						if(response.term == 'LT'){
							var transTerm = 'Long Term';
						} else {
							var transTerm = 'Short Term';
						}						
					} else {
						var transTerm = 'Not Applicable';
					}

					if(response.harbour_buyer_id != '0'){
						var transBuyer = response.harbour_buyer_name;
					} else {
						var transBuyer = '--';
					}

					$('.harboutView').text(response.property_name);
					$('.tdateView').text(response.transaction_date);
					$('.saletypeView').text(transType);
					$('.salesubtypeView').text(transProd);
					$('.quantityView').text(transQty);
					$('.rateView').text(transRate);
					$('.modeView').text(response.payment_mode);
					$('.termView').text(transTerm);
					$('.buyerView').text(transBuyer);
					$('.amountView').text(response.total_amount);					
					$('.remarksView').text(response.remarks);

					if(response.rate_uom != ''){
						$('.rateViewuom').text(response.uom_name);
					}					

					$('#transactionModal').modal('show');
							
				}
			});

		});


		$(document).on('click', '.cancleDetails', function(e) {
			$('#transactionModal').modal('hide');
		});

	});
</script>
