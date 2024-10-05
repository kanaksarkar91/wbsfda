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
                <h1 class="app-page-title mb-0">Add Safari Service Capacity </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/safari_service_capacity'); ?>">
                                View All Safari Service Capacity
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

            <form class="settings-form" method="post" action="<?= base_url('admin/safari_service_capacity/submit_service_capacity'); ?>" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">

                <div class="app-card-body">
                        <div class="row g-3">
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="safari_type_id" class="form-label">Safari Type <span class="asterisk"> *</span></label>
                                <select name="safari_type_id" class="form-select select2" id="safari_type_id" required>
                                    <option value="">Select Safari Type</option>
									<?php
									if (isset($safariTypes))
										foreach($safariTypes as $stRow) {
									?>
                                    <option value="<?= $stRow['safari_type_id']; ?>" ><?= $stRow['type_name']; ?></option>
									<?php } ?>
                                </select>
                            </div>
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="safari_service_header_id" class="form-label">Service <span class="asterisk"> *</span></label>
                                <select name="safari_service_header_id" class="form-select select2" id="safari_service_header_id" required>
                                    <option value="">Select Service</option>
                                </select>
                            </div>
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="service_period_master_id" class="form-label">Season <span class="asterisk"> *</span></label>
                                <select name="service_period_master_id" class="form-select select2" id="service_period_master_id" required>
                                    <option value="">Select Season</option>
                                </select>
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
                                <h4>Slot Information</h4>
                            </div>
							
							<div class="col-12" id="slot_details"></div>
                            
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                                <a class="btn app-btn-danger" href="<?= base_url('admin/safari_service_capacity'); ?>">CANCEL</a>
                            </div>
                        </div>
                </div>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>

<script>
$(document).ready(function(){

	$("#safari_type_id").change(function(){ 
		var safari_type_id = $(this).val();
		var result = '';
		$.ajax({
			type: 'POST',	
			url: '<?= base_url("admin/safari_service_capacity/getServices"); ?>',
			data: {
				safari_type_id: safari_type_id,
				csrf_test_name: '<?= $this->csrf['hash']; ?>'
			},
			dataType: 'json',
			encode: true,
			async: false
		})
		//ajax response
		.done(function(response){
			if(response.status){
				result +='<option value="">Select Service</option>';
                $.each(response.list,function(key,value){
                    result +='<option value="'+value.safari_service_header_id+'">'+value.service_definition+'</option>';
                });
			}
			else{
                result +='<option value="">No Data found</option>'
            }
			$("#safari_service_header_id").html(result);
		});
	});
	
	$("#safari_service_header_id").change(function(){ 
		var safari_service_header_id = $(this).val();
		var result = '';
		$.ajax({
			type: 'POST',	
			url: '<?= base_url("admin/safari_service_capacity/getServiceSeasons"); ?>',
			data: {
				safari_service_header_id: safari_service_header_id,
				csrf_test_name: '<?= $this->csrf['hash']; ?>'
			},
			dataType: 'json',
			encode: true,
			async: false
		})
		//ajax response
		.done(function(response){
			if(response.status){
				result +='<option value="">Select Season</option>';
                $.each(response.list,function(key,value){
                    result +='<option value="'+value.service_period_master_id+'">'+value.showing_desc+'</option>';
                });
			}
			else{
                result +='<option value="">No Data found</option>'
            }
			$("#service_period_master_id").html(result);
		});
	});
	
	$("#service_period_master_id").change(function(){ 
		var service_period_master_id = $(this).val();
		
		$.ajax({
			type: 'POST',	
			url: '<?= base_url("admin/safari_service_capacity/getSlots"); ?>',
			data: {
				service_period_master_id: service_period_master_id,
				csrf_test_name: '<?= $this->csrf['hash']; ?>'
			},
			dataType: 'json',
			encode: true,
			async: false
		})
		//ajax response
		.done(function(response){
			if(response.status){
				$("#slot_details").html(response.html);
			}
			else{
                $("#slot_details").html(response.html);
            }
			
		});
	});
	
});
</script>

