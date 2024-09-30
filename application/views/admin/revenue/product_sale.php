<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Product Sale</h1>
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


			<form method="POST" action="" id="saletransactionform">

				<input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

				<input type="hidden" name="transaction_type" value="PS">

				<div class="app-card app-card-settings shadow-sm p-3 mb-3">
					<!-- <div class="app-card-header mb-3">
						<div class="col-md-12 details_head">
							<h5 class="text-info"><span class="propName"></span> PRODUCT SALE</h5>
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
									<input type="radio" name="sale_type" class="sale_type" value="Cash" data-saletype="Cash" checked>
									<label for="" class="form-label">Cash Sale</label>
									

									<input type="radio" name="sale_type" class="sale_type" value="Credit" data-saletype="Credit">
									<label for="" class="form-label">Credit Sale</label>
									
								</div>
							</div>

							<div class="col-sm-6 col-md-3 col-lg-3" id="selectProductdiv">
								<label for="" class="form-label">Select Product</label>
								<select name="product_id" class="form-control select2 product_id" id="product_id">
									<option value="" data-uomname="">Select Product</option>
									<?php if(!empty($product_list)){ ?>

										<?php foreach($product_list as $product){ ?>
											<option value="<?= $product['harbour_product_id']; ?>" data-uomname="<?= $product['uom_name']; ?>"><?= $product['harbour_product_name']; ?></option>
										<?php } ?>

									<?php } ?>									
								</select>
							</div>
							<div class="col-sm-6 col-md-3 col-lg-3">
								<label for="" class="form-label">Quantity</label>
								<div class="input-group mb-3">
									<input type="text" name="quantity" class="form-control quantity" id="quantity" readonly>
									<span class="input-group-text qty_uom btn app-btn-primary">UOM</span>
									<p id="qty_error" style="color: red;"></p>
								</div>

								<!-- <div class="date-container">
									<input type="text" name="quantity" class="form-control quantity" id="quantity">
									<span class="qty_uom" style="position: relative; bottom: 30px; left: 255px;">UOM</span>
								</div> -->
							</div>
							<div class="col-sm-6 col-md-3 col-lg-3">
								<label for="" class="form-label">Rate / <span class="qty_uom qUom">UOM</span></label>
								<input type="text" name="rate_per_uom" class="form-control rate_per_uom" id="rate_per_uom" readonly>
							</div>

							<div class="col-sm-6 col-md-3 col-lg-3">
								<label for="" class="form-label">Amount (Rs.)</label>
								<input type="text" name="total_amount" class="form-control total_amount" id="total_amount" readonly>
							</div>

							<div class="col-sm-6 col-md-12 col-lg-12 hurbourByer" style="display: none;">
								<label for="" class="form-label">Select Buyer</label>
								<select name="buyer_id" class="form-control select2 buyer_id" id="buyer_id">
									<!--<option value="">Select Buyer</option>-->									
								</select>
							</div>

							<div class="col-sm-6 col-md-12 col-lg-12">
								<label for="" class="form-label">Remarks (if any)</label>
								<textarea class="form-control remarks" name="remarks"></textarea>
							</div>
							<div class="col-md-12 text-end">
								<!--<button id="" type="button" class="btn app-btn-primary">SUBMIT</button>-->
								<input type="submit" class="btn app-btn-primary submitProductsale" value="SUBMIT">
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
								<th scope="row">Sale Type:</th>
								<td class="saletypeView"></td>
							</tr>
							<tr>
								<th scope="row">Product:</th>
								<td class="productView"></td>
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
								<th scope="row">Amount (Rs.):</th>
								<td class="amountView"></td>
							</tr>
							<tr>
								<th scope="row">Buyer:</th>
								<td class="buyerView"></td>
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

		$(document).on('change', '.sale_type', function() {

			var saleType = $(this).val();

			if(saleType == 'Credit'){
				$('.hurbourByer').slideDown();
			} else {
				$('.hurbourByer').slideUp();
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
				url: baseUrl+'admin/revenue/buyer_list',
				data: {"propertyId":propertyId,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					$('#buyer_id').html(response);
							
				}
			});

		});

		$(document).on('change', '#product_id', function() {

			var uomname = $('#product_id :selected').data('uomname');

			$('#quantity, #rate_per_uom, #total_amount').val('');
			$('#qty_error').text('');

			if(uomname != ''){
				$('#quantity, #rate_per_uom').prop('readonly',false);
				$('.qty_uom').text(uomname);
			} else {
				$('#quantity, #rate_per_uom').prop('readonly',true);
				$('.qty_uom').text('UOM');
			}
			

		});


		$(document).on('click', '.submitProductsale', function(e) {

			e.preventDefault();

			var property_id = $('.property_id :selected').text();
			var bill_date = $('.bill_date').val();
			var sale_type = $('.sale_type:checked').data('saletype');
			var product_id = $('.product_id :selected').text();
			var quantity = $('.quantity').val();
			var rate_per_uom = $('.rate_per_uom').val();
			var total_amount = $('.total_amount').val();
			var buyer_id = $('.buyer_id :selected').text();
			var remarks = $('.remarks').val();

			var getUom = $('.qUom').text();

			$('.harboutView').text(property_id);
			$('.tdateView').text(bill_date);
			$('.saletypeView').text(sale_type);
			$('.productView').text(product_id);
			$('.quantityView').text(quantity+' ('+getUom+')');
			$('.rateView').text(rate_per_uom);
			$('.amountView').text(total_amount);
			$('.buyerView').text(buyer_id);
			$('.remarksView').text(remarks);

			$('.rateViewuom').text(getUom);

			$('#exampleModalCenter').modal('show');

		});

		$(document).on('click', '.cancleSale', function(e) {
			$('#exampleModalCenter').modal('hide');
		});

		$(document).on('click', '.submitSale', function(e) {
			$('#saletransactionform').submit();
		});


		// Cache the input fields and result field
		var $quantityInput = $('#quantity');
		var $rateInput = $('#rate_per_uom');
		var $resultInput = $('#total_amount');

		// Function to calculate the result and update the result field
		function calculateResult() {
			var quantity = parseFloat($quantityInput.val()) || 0;
			var rate = parseFloat($rateInput.val()) || 0;
			var result = Math.round(quantity * rate);
			$resultInput.val(result.toFixed(2)); // Display result with 2 decimal places
		}

		// Listen for input changes in the quantity and rate fields
		//$quantityInput.on('input', calculateResult);
		$rateInput.on('input', calculateResult);

		$quantityInput.on('input', function() {

			var value = $(this).val();
			var qtyType = $(this).closest('div').find('.qty_uom').text();

			if(qtyType == 'Piece(s)'){

				if (value !== '' && !/^\d+$/.test(value)) {
					$('#qty_error').text('Please enter a valid integer');
					$(this).val('');
					calculateResult();
				} else {
					$('#qty_error').text('');
					calculateResult();
				}
				
			} else {
				$('#qty_error').text('');
				calculateResult();
			}

		});

	});
</script>
