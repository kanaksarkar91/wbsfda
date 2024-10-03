<style>
    #map {
  height: 400px;
}

/* 
 * Optional: Makes the sample page fill the window. 
 */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}
</style>
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">

        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Terminate Safari Service Pricing </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/safari_service_pricing'); ?>">
                                View All Safari Service Pricing
                            </a>
                        </div>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>
        <!--//row-->

        <div class="app-card app-card-settings shadow-sm p-3">

            <form class="settings-form" method="post" id="pricingForm" action="<?= base_url('admin/safari_service_pricing/terminate_service_pricing'); ?>" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
			<input type="hidden" name="safari_service_header_id" value="<?= $safari_service_header_id; ?>" readonly="">
			<input type="hidden" name="service_period_master_id" value="<?= $service_period_master_id; ?>" readonly="">

                <div class="app-card-body">
                        <div class="row g-3">
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="safari_type_id" class="form-label">Safari Type <span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" value="<?= $service_slot_pricing_mapping[0]['type_name'];?>" readonly="">
                            </div>
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="safari_service_header_id" class="form-label">Service <span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" value="<?= $service_slot_pricing_mapping[0]['service_definition'];?>" readonly="">
                            </div>
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="service_period_master_id" class="form-label">Season <span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" value="<?= $service_slot_pricing_mapping[0]['showing_desc'];?>" readonly="">
                            </div>
							
							<div class="col-lg-4 col-sm-12 col-md-6">
								<label for="start_date" class="form-label">Effective Start Date <span class="asterisk">*</span></label>
								<input type="text" class="form-control" value="<?= date('d/m/Y', strtotime($service_slot_pricing_mapping[0]['eff_start_date']));?>" readonly="">
							</div>
							<div class="col-lg-4 col-sm-12 col-md-6">
								<label for="end_date" class="form-label">Effective End Date<span class="asterisk"> </span></label>
								<input type="text" class="form-control" value="<?= date('d/m/Y', strtotime($service_slot_pricing_mapping[0]['eff_end_date']));?>" readonly="">
							</div>
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="service_status" class="form-label">Status<span class="asterisk"> *</span></label>
                                <select name="is_active" class="form-select" id="is_active" required>
                                    <option value="1" >Active</option>
                                    <option value="0" >Inactive</option>
                                </select>
                            </div>
							
							<div class="col-md-12 mt-0">
                                <hr class="ex_bold">
                                <h4>Slot & Pricing Information</h4>
                            </div>
							
							<div class="col-12">
							<?php
							foreach($safari_pricing_details as $key => $val){
							?>
								<div class="table-responsive">
								<table class="table table-sm align-middle table-bordered mb-0">
									<tr>
										<th>
										<?= $val['slot_desc'].' : '.$val['start_time'].' to '. $val['end_time'];?>
										</th>
									</tr>
									
									<tr>
										<td>
											<table class="table table-sm align-middle table-bordered mb-0">
												<tr>
													<th>Category</th>
													<th>Capacity</th>
												</tr>
												<?php
												if(!empty($val['pricingDetails'])){
													foreach($val['pricingDetails'] as $key2 => $pDtl){
												?>
												<tr>
													<td>
														<input type="text" class="form-control" value="<?= $pDtl['cat_name'];?>" readonly>
													</td>
													<td>
														<input type="text" class="form-control" value="<?= $pDtl['base_price'];?>" readonly>
													</td>
												</tr>
												<?php } } ?>
											</table>
										</td>
									</tr>
								</table>
									
								</div>
							<?php } ?>
							</div>
                            
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn app-btn-danger">Terminate</button>
                                <a class="btn app-btn-primary" href="<?= base_url('admin/safari_service_capacity'); ?>">CANCEL</a>
                            </div>
                        </div>
                </div>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>

<script type="text/javascript">
    document.getElementById('pricingForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        
        // Show SweetAlert confirmation dialog
        swal({
            title: "Are you sure?",
            text: "Do you really want to terminate the pricing?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willSubmit) => {
            if (willSubmit) {
                // If user confirms, submit the form
                document.getElementById('pricingForm').submit();
            } else {
                // If user cancels, you can optionally do something here
                swal("Termination cancelled!", {
                    icon: "error",
                });
            }
        });
    });
</script>
