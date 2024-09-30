<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Other Sale</h1><!--<h1 class="app-page-title mb-0">PRODUCT SALE</h1>-->
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


			<form method="POST" action="" id="osaleform">

				<input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
				<input type="hidden" class="csrfToken1" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

				<input type="hidden" name="transaction_type" value="OS">

				<div class="app-card app-card-settings shadow-sm p-3 mb-3">
					<!-- <div class="app-card-header mb-3">
						<div class="col-md-12 details_head">
							<h5 class="text-info"><span class="propName"></span> OTHER SALE</h5>
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
								<label for="" class="form-label w-100">&nbsp;</label>
								<div>
									<label for="" class="form-label">Long Term</label>
									<input type="radio" name="term" class="term" value="LT" data-saletype="Long Term" checked>

									<label for="" class="form-label">Short Term</label>
									<input type="radio" name="term" class="term" value="ST" data-saletype="Short Term">
								</div>
							</div>

							<div class="col-sm-6 col-md-4 col-lg-4 facilityDiv">
								<label for="" class="form-label">Select Facility</label>
								<select name="product_id" class="form-control select2 product_id" id="product_id">
									<option value="">Select Facility</option>
									<?php if(!empty($product_list)){ ?>

										<?php foreach($product_list as $product){ ?>
											<option value="<?= $product['harbour_product_id']; ?>">Income from <?= $product['harbour_product_name']; ?></option>
										<?php } ?>

									<?php } ?>									
								</select>
							</div>
							<div class="col-sm-6 col-md-4 col-lg-4 licenceeDiv" style="position:relative; z-index:0;">
								<label for="" class="form-label">Select Licensee</label>
								<div class="input-group d-flex">
									<div style="width:calc(100% - 130px);">
										<select name="buyer_id" class="form-select select2 buyer_id" id="buyer_id">
											<option value="">Select Licensee</option>									
										</select>
									</div>
									<div style="width:130px;">
										<button type="button" class="btn app-btn-primary agreementBtn" disabled>View Details</button><!-- style="position: absolute; bottom: 127px; right: 442px;" -->
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-4 col-lg-4 amountDiv">
								<label for="" class="form-label">Amount Received Rs.</label>
								<input type="text" name="total_amount" class="form-control total_amount" id="total_amount">
								<p id="amount_error" style="color: red;"></p>
							</div>

							<div class="col-sm-6 col-md-12 col-lg-12">
								<label for="" class="form-label">Remarks (if any)</label>
								<textarea class="form-control remarks" name="remarks"></textarea>
							</div>

							<div class="col-md-12 text-end">
								<!--<button id="" type="button" class="btn app-btn-primary">SUBMIT</button>-->
								<input type="submit" class="btn app-btn-primary submitAgreement" value="SUBMIT">
							</div>

						</div>
					</div>
				</div>
				
			</form>


		</div>
	</div>
	<!--//app-content-->

	<!-- Modal -->
	<div class="modal fade" id="agreementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Agreement Details</h5>
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
								<td class="aharboutView"></td>
							</tr>
							<tr>
								<th scope="row">Licensee:</th>
								<td class="abuyerView"></td>
							</tr>
							<tr>
								<th scope="row">Facility:</th>
								<td class="afacilityView"></td>
							</tr>
							<tr>
								<th scope="row">Security Deposit:</th>
								<td class="asdepositeView"></td>
							</tr>
							<tr>
								<th scope="row">Refundable:</th>
								<td class="arefundableView"></td>
							</tr>
							<tr>
								<th scope="row">Agreement Start Date:</th>
								<td class="asdateView"></td>
							</tr>
							<tr>
								<th scope="row">Agreement End Date:</th>
								<td class="aedateView"></td>
							</tr>
							<tr>
								<th scope="row">Payable Amount (Rs.):</th>
								<td class="aamountView"></td>
							</tr>
							<tr>
								<th scope="row">Period:</th>
								<td class="aperiodView"></td>
							</tr>
							<tr>
								<th scope="row">Remarks:</th>
								<td class="aremarksView"></td>
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
								<td class="dateView"></td>
							</tr>
							<tr>
								<th scope="row">Term:</th>
								<td class="termView"></td>
							</tr>
							<tr>
								<th scope="row">Facility:</th>
								<td class="facilityView"></td>
							</tr>
							<tr>
								<th scope="row">Licensee:</th>
								<td class="buyerView"></td>
							</tr>
							<tr>
								<th scope="row">Received Amount (Rs.):</th>
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
				<button type="button" class="btn btn-secondary cancleosale" data-dismiss="modal">Back to modify</button>
				<button type="button" class="btn app-btn-primary submitosalemodal">Submit anyway</button>
			</div>
			</div>
		</div>
	</div>

	<input type="hidden" id="base_url" value="<?= base_url(); ?>">


<!--</div>
//app-wrapper-->

<script type="text/javascript">
	$( document ).ready(function() {

		$(document).on('change', '.term', function() {

			var subType = $(this).val();

			if(subType == 'LT'){
				//$('.facilityDiv, .amountDiv').removeClass('col-sm-6 col-md-4 col-lg-4').addClass('col-sm-6 col-md-6 col-lg-6');
				$('.licenceeDiv').slideDown();
			} else {
				//$('.facilityDiv, .amountDiv').removeClass('col-sm-6 col-md-6 col-lg-6').addClass('col-sm-6 col-md-4 col-lg-4');
				$('.licenceeDiv').slideUp();
			}

		});

		$(document).on('change', '#property_id', function() {

			var baseUrl = $('#base_url').val();
			var propertyId = $(this).val();

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

			//alert(propertyId);

			$.ajax({
				type: "POST",
				url: baseUrl+'admin/revenue/licencee_list',
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
			var propertyId = $('#property_id :selected').val();
			var productId = $('#product_id :selected').val();

			var csrfName = $('.csrfToken1').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken1').val(); // CSRF hash

			//alert(buyerId);

			$.ajax({
				type: "POST",
				url: baseUrl+'admin/revenue/agreement_details',
				data: {"propertyId":propertyId,"productId":productId,"buyerId":buyerId,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					$('.aharboutView').text(response.property_name);
					$('.abuyerView').text(response.harbour_buyer_name);
					$('.afacilityView').text(response.harbour_product_name);
					$('.asdepositeView').text(response.security_deposite_amount);

					if(response.is_refundable == 'Y'){
						$('.arefundableView').text('Yes');
					} else {
						$('.arefundableView').text('No');
					}					

					$('.asdateView').text(moment(response.start_date).format('DD-MM-YYYY'));
					$('.aedateView').text(moment(response.end_date).format('DD-MM-YYYY'));

					$('.aamountView').text(response.payable_amount);
					$('.aperiodView').text(response.period);
					$('.aremarksView').text(response.remarks);

					$('.agreementBtn').addClass('viewAgreement');
					$('.agreementBtn').prop('disabled', false);
							
				}
			});

		});

		$(document).on('click', '.viewAgreement', function(e) {

			$('#agreementModal').modal('show');

		});

		$(document).on('click', '.cancleDetails', function(e) {
			$('#agreementModal').modal('hide');
		});


		$(document).on('click', '.submitAgreement', function(e) {

			e.preventDefault();

			var property_id = $('.property_id :selected').text();
			var bill_date = $('.bill_date').val();
			var sub_type = $('.term:checked').data('saletype');			
			var product_id = $('.product_id :selected').text();
			var buyer_id = $('.buyer_id :selected').text();			
			var total_amount = $('.total_amount').val();		
			var remarks = $('.remarks').val();

			$('.harboutView').text(property_id);
			$('.dateView').text(bill_date);
			$('.termView').text(sub_type);
			$('.facilityView').text(product_id);
			$('.buyerView').text(buyer_id);
			$('.amountView').text(total_amount);
			$('.remarksView').text(remarks);

			$('#exampleModalCenter').modal('show');

		});

		$(document).on('click', '.cancleosale', function(e) {
			$('#exampleModalCenter').modal('hide');
		});

		$(document).on('click', '.submitosalemodal', function(e) {
			$('#osaleform').submit();
		});


		$('#total_amount').on('input', function() {
			var value = $(this).val();
			if (value !== '' && !/^\d+$/.test(value)) {
				$('#amount_error').text('Please enter a valid integer');
				$(this).val('');
			} else {
				$('#amount_error').text('');
			}
		});

	});
</script>
