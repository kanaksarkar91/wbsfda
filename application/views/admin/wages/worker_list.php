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
					<h1 class="app-page-title mb-0">Wage Worker List</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/wages/add_worker">
									Add Worker
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

							<div class="col-lg-6 col-sm-12 col-md-4">
								<label for="" class="form-label">Unit <span class="asterisk"></span></label>
								<select name="property_id" class="form-select select2" id="property_id">
								<option value="">Select Unit</option>

									<?php if(!empty($property_list)){ ?>

										<?php foreach($property_list as $property){ ?>
											<option value="<?= $property['property_id']; ?>" <?php if(!empty($property_id)){ if($property['property_id'] == $property_id){ echo 'selected'; } } ?>><?= $property['property_name']; ?></option>
										<?php } ?>

									<?php } ?>
								</select>
							</div>

							<div class="col-lg-2 col-sm-12 col-md-4">
								<label for="" class="form-label">&nbsp;&nbsp;<span class="asterisk"> </span></label>
								<input type="submit" class="form-select btn app-btn-primary" name="search" value="Search">
							</div>

						</div>
						
					</form>
				</div>
			</div>

			<div class="app-card app-card-settings shadow-sm mb-3 pt-2">
				<div class="app-card-body">
					<div class="table-responsive">
						<table id="workerList" class="table table-bordered align-middle app-table-hover mb-0 small">
							<thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">
								<tr>
									<th>Unit Name</th>	
									<th>Name</th>									
									<th>Contact No.</th>
									<th class="text-end">Daily Wages</th>
									<th>Applicable Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($wage_worker_list)){ ?>

									<?php foreach($wage_worker_list as $workers){ ?>

										<tr>
											<td><?= $workers['property_name']; ?></td>											
											<td><?= $workers['worker_name']; ?></td>											
											<td><?= $workers['mobile_no']; ?></td>
											<td class="text-end"><?= $workers['daily_wage_amount']; ?></td>
											<td><?= date("d-m-Y", strtotime($workers['applicable_date'])); ?></td>
											<td><?php if($workers['is_active'] == 1){ echo '<span class="badge bg-success">Active</span>'; } else { echo '<span class="badge bg-danger">In-active</span>'; } ?></td>
											<td><a href="<?= base_url(); ?>admin/wages/edit_worker/<?= $workers['worker_master_id']; ?>" type="button" class="btn-sm app-btn-primary editMap" data-workerid="<?= $workers['worker_master_id']; ?>" data-mapid="<?= $workers['wage_map_id']; ?>" title="Edit">Edit</a></td>											
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
	<div class="modal fade" id="workereditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Edit Wage</h5>
				<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>-->
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<input type="hidden" class="wworkerId" >
					<div class="row g-2">
						<div class="col-sm-6 col-md-6 col-lg-6">
							<label for="" class="form-label">Daily Wages</label>
							<input type="text" name="" class="form-control edit_wage_amount" id="edit_wage_amount">
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6">
							<label for="" class="form-label">Applicable From Date</label>
							<div class="date-container">
								<input type="text" name="" class="form-control edit_bill_date" id="edit-bill-date">
								<i class="date-icon fa fa-calendar" style="position: relative; bottom: 30px; left: 596px;"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary cancleworker" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary submitworkermodal">Submit</button>
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

		/*$(document).on('click', '.editMap', function() {

			var baseUrl = $('#base_url').val();
			var mapId = $(this).data('mapid');
			var workerId = $(this).data('workerid');

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

			//alert(propertyId);

			$.ajax({
				type: "POST",
				url: baseUrl+'admin/wages/map_details',
				data: {"mapId":mapId,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 

					$('#edit_wage_amount').val(response.wage_amount);
					$('#edit-bill-date').val(response.applicable_date);
					$('.wworkerId').val(workerId);

					$('#workereditModal').modal('show');
							
				}
			});

		});


		$(document).on('click', '.submitworkermodal', function() {

			var baseUrl = $('#base_url').val();
			var wageAmount = $('#edit_wage_amount').val();
			var applicableDate = $('#edit-bill-date').val();
			var wworkerId = $('.wworkerId').val();

			var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

			//alert(propertyId);

			$.ajax({
				type: "POST",
				url: baseUrl+'admin/wages/submit_wages',
				data: {"wageAmount":wageAmount,"applicableDate":applicableDate,"wworkerId":wworkerId,[csrfName]: csrfHash},
				dataType: "json",
				success: function(response) { 					

					$('#workereditModal').modal('hide');
					$('.updateMsg').html('<div class="alert alert-success alert-dismissible">Wages Successfully Updated.</div>');

					setTimeout(function () {
						$('.updateMsg').html('');
						location.reload();
					}, 1000);
							
				}
			});

		});

		$(document).on('click', '.cancleworker', function(e) {
			$('#workereditModal').modal('hide');
		});*/


		new DataTable('#workerList');

	});
</script>
