<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Recovery Credit Sale</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<!--<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/revenue">
									Back
								</a>-->
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


			<form method="POST" action="" id="recovtransactionform">

				<input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

				<input type="hidden" name="transaction_type" value="RC">

				<div class="app-card app-card-settings shadow-sm p-3 mb-3">
					<!-- <div class="app-card-header mb-3">
						<div class="col-md-12 details_head">
							<h5 class="text-info"><span class="propName"></span> RECOVERY CREDIT SALE</h5>
						</div>
					</div> -->
					<div class="app-card-body">
						<div class="row g-3">
							<div class="col-sm-6 col-md-4 col-lg-4">
								<label for="" class="form-label">Select Harbour</label>
								<select name="property_id" class="form-control select2 property_id" id="property_id">
									<option value="">Select Harbour</option>
									<?php if(!empty($property_list)){ ?>

										<?php foreach($property_list as $property){ ?>
											<option value="<?= $property['property_id']; ?>"><?= $property['property_name']; ?></option>
										<?php } ?>

									<?php } ?>									
								</select>
							</div>
							<div class="col-sm-6 col-md-4 col-lg-4">
								<label for="" class="form-label">Select Transaction Date</label>
								<div class="date-container">
									<input type="text" name="bill_date" class="form-control bill_date" id="salebill-date">
									<i class="date-icon fa fa-calendar"></i>
								</div>
							</div>
							<div class="col-sm-6 col-md-4 col-lg-4">
								<label for="" class="form-label">Select Buyer</label>
								<select name="buyer_id" class="form-control select2 buyer_id" id="buyer_id">
									<!--<option value="">Select Buyer</option>-->									
								</select>
							</div>

							<div class="col-sm-6 col-md-6 col-lg-6">
								<label for="" class="form-label">Outstanding Balance as on (current date)</label>
								<input type="text" name="outstanding_amt" class="form-control outstanding_amt" id="outstanding_amt" readonly>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<label for="" class="form-label">Amount Received</label>
								<input type="text" name="received_amount" class="form-control received_amount" id="received_amount">
							</div>

							<div class="col-sm-6 col-md-12 col-lg-12">
								<label for="" class="form-label">Remarks (if any)</label>
								<textarea class="form-control remarks" name="remarks"></textarea>
							</div>
							<div class="col-md-12 text-end">
								<!--<button id="" type="button" class="btn app-btn-primary">SUBMIT</button>-->
								<input type="submit" class="btn app-btn-primary submitRecovarysale" value="SUBMIT">
							</div>
						</div>
					</div>
				</div>

				
			</form>


		</div>
	</div>
	<!--//app-content-->

	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Please verify the information before submit. The data can not be deleted or modified once submitted</h5>
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
								<th scope="row">Buyer:</th>
								<td class="buyerView"></td>
							</tr>
							<tr>
								<th scope="row">Outstanding Balance:</th>
								<td class="outstandingView"></td>
							</tr>
							<tr>
								<th scope="row">Amount Received:</th>
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
				<button type="button" class="btn btn-secondary cancleSale" data-dismiss="modal">Back to modify</button>
				<button type="button" class="btn app-btn-primary submitSale">Submit anyway</button>
			</div>
			</div>
		</div>
	</div>

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
				url: baseUrl+'admin/revenue/buyer_list',
				data: {"propertyId":propertyId,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					$('#buyer_id').html(response);
							
				}
			});

		});


		$(document).on('change', '#buyer_id', function() {

			var baseUrl = $('#base_url').val();
			var buyerId = $(this).val();

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

			//alert(propertyId);

			$.ajax({
				type: "POST",
				url: baseUrl+'admin/revenue/outstanding_amount',
				data: {"buyerId":buyerId,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					$('#outstanding_amt').val(response);
							
				}
			});

		});

		$(document).on('click', '.submitRecovarysale', function(e) {

			e.preventDefault();

			var property_id = $('.property_id :selected').text();
			var bill_date = $('.bill_date').val();
			var buyer_id = $('.buyer_id :selected').text();
			var outstanding_amt = $('.outstanding_amt').val();
			var received_amount = $('.received_amount').val();			
			var remarks = $('.remarks').val();

			$('.harboutView').text(property_id);
			$('.tdateView').text(bill_date);
			$('.buyerView').text(buyer_id);
			$('.outstandingView').text(outstanding_amt);
			$('.amountView').text(received_amount);
			$('.remarksView').text(remarks);

			$('#exampleModalCenter').modal('show');

		});

		$(document).on('click', '.cancleSale', function(e) {
			$('#exampleModalCenter').modal('hide');
		});

		$(document).on('click', '.submitSale', function(e) {
			$('#recovtransactionform').submit();
		});

	});
</script>
