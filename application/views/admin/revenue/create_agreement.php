<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Create Agreement</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/revenue/agreement">
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


			<form method="POST" action="" id="agreementform">

				<input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

				<div class="app-card app-card-settings shadow-sm p-3 mb-3">
					<!-- <div class="app-card-header mb-3">
						<div class="col-md-12 details_head">
							<h5 class="text-info"><span class="propName"></span> CREATE AGREEMENT</h5>
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
								<label for="" class="form-label">Select Licensee</label>
								<select name="buyer_id" class="form-control select2 buyer_id" id="buyer_id">
									<option value="">Select Licensee</option>									
								</select>
							</div>
							<div class="col-sm-6 col-md-4 col-lg-4">
								<label for="" class="form-label">Select Facility</label>
								<select name="product_id" class="form-control select2 product_id" id="product_id">
									<option value="">Select Facility</option>
									<?php if(!empty($product_list)){ ?>

										<?php foreach($product_list as $product){ ?>
											<option value="<?= $product['harbour_product_id']; ?>"><?= $product['harbour_product_name']; ?></option>
										<?php } ?>

									<?php } ?>									
								</select>
							</div>

							<div class="col-sm-6 col-md-6 col-lg-6">
								<label for="" class="form-label">Security Deposit (if any) Rs.</label>
								<input type="text" name="security_deposite" class="form-control security_deposite" id="security_deposite">
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<label for="" class="form-label w-100">&nbsp;</label>
								<div>
									<label for="" class="form-label">Refundable (Yes)</label>
									<input type="radio" name="refundable" class="refundable" value="Y" data-refundable="Yes" checked>

									<label for="" class="form-label">Refundable (No)</label>
									<input type="radio" name="refundable" class="refundable" value="N" data-refundable="No">
								</div>
							</div>

							<div class="col-sm-6 col-md-6 col-lg-3">
								<label for="" class="form-label">Agreement Start Date</label>
								<div class="date-container">
									<input type="text" name="agreement_start_date" class="form-control agreement_start_date" id="agreement_start_date">
									<i class="date-icon fa fa-calendar"></i>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-3">
								<label for="" class="form-label">Agreement End Date</label>
								<div class="date-container">
									<input type="text" name="agreement_end_date" class="form-control agreement_end_date" id="agreement_end_date">
									<i class="date-icon fa fa-calendar"></i>
								</div>
							</div>

							<div class="col-sm-6 col-md-6 col-lg-3">
								<label for="" class="form-label">Payable Amount (Rs.)</label>
								<input type="text" name="payable_amount" class="form-control payable_amount" id="payable_amount">
							</div>
							<div class="col-sm-6 col-md-6 col-lg-3">
								<label for="" class="form-label">Period</label>
								<select name="period" class="form-control select2 period" id="period">
									<option value="">Select Period</option>	
									<option value="Daily">Daily</option>
									<option value="Weekly">Weekly</option>
									<option value="Fortnightly">Fortnightly</option>
									<option value="Monthly">Monthly</option>
									<option value="Bi-Monthly">Bi-Monthly</option>
									<option value="Quarterly">Quarterly</option>
									<option value="Half Yearly">Half Yearly</option>
									<option value="Yearly">Yearly</option>							
								</select>
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
								<th scope="row">Licensee / Party:</th>
								<td class="buyerView"></td>
							</tr>
							<tr>
								<th scope="row">Facility:</th>
								<td class="facilityView"></td>
							</tr>
							<tr>
								<th scope="row">Security Deposit:</th>
								<td class="sdepositeView"></td>
							</tr>
							<tr>
								<th scope="row">Refundable:</th>
								<td class="refundableView"></td>
							</tr>
							<tr>
								<th scope="row">Agreement Start Date:</th>
								<td class="sdateView"></td>
							</tr>
							<tr>
								<th scope="row">Agreement End Date:</th>
								<td class="edateView"></td>
							</tr>
							<tr>
								<th scope="row">Payable Amount (Rs.):</th>
								<td class="amountView"></td>
							</tr>
							<tr>
								<th scope="row">Period:</th>
								<td class="periodView"></td>
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
				<button type="button" class="btn btn-secondary cancleAgreement" data-dismiss="modal">Back to modify</button>
				<button type="button" class="btn app-btn-primary submitAgreementmodal">Submit anyway</button>
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
				url: baseUrl+'admin/revenue/licencee_list',
				data: {"propertyId":propertyId,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					$('#buyer_id').html(response);
							
				}
			});

		});


		$(document).on('click', '.submitAgreement', function(e) {

			e.preventDefault();

			var property_id = $('.property_id :selected').text();
			var buyer_id = $('.buyer_id :selected').text();
			var product_id = $('.product_id :selected').text();
			var security_deposite = $('.security_deposite').val();
			var refundable = $('.refundable:checked').data('refundable');			
			var start_date = $('.agreement_start_date').val();
			var end_date = $('.agreement_end_date').val();
			var payable_amount = $('.payable_amount').val();
			var period = $('.period :selected').text();			
			var remarks = $('.remarks').val();

			$('.harboutView').text(property_id);
			$('.buyerView').text(buyer_id);
			$('.facilityView').text(product_id);
			$('.sdepositeView').text(security_deposite);
			$('.refundableView').text(refundable);
			$('.sdateView').text(start_date);
			$('.edateView').text(end_date);
			$('.amountView').text(payable_amount);
			$('.periodView').text(period);
			$('.remarksView').text(remarks);

			$('#exampleModalCenter').modal('show');

		});

		$(document).on('click', '.cancleAgreement', function(e) {
			$('#exampleModalCenter').modal('hide');
		});

		$(document).on('click', '.submitAgreementmodal', function(e) {
			$('#agreementform').submit();
		});

	});
</script>
