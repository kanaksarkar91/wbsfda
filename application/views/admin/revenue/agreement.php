<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Agreement List</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/revenue/create_agreement">
									Create Agreement
								</a>
							</div>
						</div>
						<!--//row-->
					</div>
					<!--//table-utilities-->
				</div>
				<!--//col-auto-->
			</div>

			<div class="row g-3 mb-3 align-items-center updateMsg">
				<?= $this->session->flashdata('msg'); ?>
			</div>

			<div class="app-card app-card-orders-table shadow-sm mb-3">
				<div class="app-card-body p-3">
					<form action="" method="post">

						<input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

						<div class="row g-3">
							<div class="col-lg-6 col-sm-12 col-md-6">
								<label for="" class="form-label">Select Harbour <span class="asterisk"></span></label>
								<select name="property_id" class="form-select select2" id="property_id">
								<option value="">Select Harbour</option>

									<?php if(!empty($property_list)){ ?>

										<?php foreach($property_list as $property){ ?>
											<option value="<?= $property['property_id']; ?>" <?php if(!empty($property_id)){ if($property['property_id'] == $property_id){ echo 'selected'; } } ?>><?= $property['property_name']; ?></option>
										<?php } ?>

									<?php } ?>
								</select>
							</div>
							
							<div class="col-lg-2 col-sm-12 col-md-6">
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
									<th>Harbour</th>
									<th>Licensee</th>
									<th>Facility</th>
									<th>Start Date</th>
									<th style="width:116px;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($agreement_list)){ ?>

									<?php foreach($agreement_list as $agreement){ ?>										

										<tr class="wageItem">											
											<td><?= $agreement['property_name']; ?></td>
											<td><?= $agreement['harbour_buyer_name']; ?></td>
											<td><?= $agreement['harbour_product_name']; ?></td>
											<td><?= date('d-m-Y', strtotime($agreement['start_date'])); ?></td>
											<td class="actionBtn">
												<a href="javascript:void(0)" type="button" class="btn-sm app-btn-primary agreementDetails" data-agreementid="<?= $agreement['agreement_id']; ?>" title="View Details">View Details</a>												
											</td>											
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
								<th scope="row">Licensee / Party:</th>
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

	
	<input type="hidden" id="base_url" value="<?= base_url(); ?>">


<!--</div>
//app-wrapper-->

<script type="text/javascript">
	$( document ).ready(function() {

		$(document).on('click', '.agreementDetails', function() {

			var baseUrl = $('#base_url').val();
			var agreementId = $(this).data('agreementid');

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

			$.ajax({
				type: "POST",
				url: baseUrl+'admin/revenue/list_agreement_details',
				data: {"agreementId":agreementId,[csrfName]: csrfHash},
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

					$('#agreementModal').modal('show');
							
				}
			});

		});


		$(document).on('click', '.cancleDetails', function(e) {
			$('#agreementModal').modal('hide');
		});

	});
</script>
