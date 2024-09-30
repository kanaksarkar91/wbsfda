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
                <h1 class="app-page-title mb-0">Add Safari Service </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/safari_service'); ?>">
                                View All Safari Service
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

            <form class="settings-form" method="post" action="<?= base_url('admin/safari_service/submit_service'); ?>" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">

                <div class="app-card-body">
                        <div class="row g-3">
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_type" class="form-label">District <span class="asterisk"> *</span></label>
                                <select name="district_id" class="form-select select2" id="district_id" required>
                                    <option value="">Select District</option>
									<?php
									if (isset($districts))
										foreach($districts as $dRow) {
									?>
                                    <option value="<?= $dRow['district_id']; ?>" ><?= $dRow['district_name']; ?></option>
									<?php } ?>
                                </select>
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="terrain_type" class="form-label">Division<span class="asterisk"> *</span></label>
                                <select name="division_id" class="form-select" id="division_id" required>
                                    <option value="">Select Division</option>
                                </select>
                            </div>
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_type" class="form-label">Safari Type <span class="asterisk"> *</span></label>
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
							
							<div class="col-lg-12 col-sm-12 col-md-6">
                                <label for="service_definition" class="form-label">Service Definition<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="service_definition" placeholder="Service Definition" required>
                            </div>
							
							<!--<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="service_route" class="form-label">Route <span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="service_route" placeholder="Route" required>
                            </div>-->
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="start_point" class="form-label">Start Point <span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="start_point" placeholder="Start Point" required>
                            </div>
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="end_point" class="form-label">End Point <span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="end_point" placeholder="End Point" required>
                            </div>
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="reporting_place" class="form-label">Reporting Place <span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="reporting_place" placeholder="Reporting Place" required>
                            </div>
							
							<div class="col-lg-12 col-sm-12 col-md-12">
								<label for="route_desc" class="form-label">Route Description <span class="asterisk"> *</span></label>
								<textarea name="route_desc" id="route_desc" class="form-control" placeholder="Route Description" rows="3" required></textarea>
							</div>
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="service_status" class="form-label">Status<span class="asterisk"> *</span></label>
                                <select name="service_status" class="form-select" id="service_status" required>
                                    <option value="1" >Active</option>
                                    <option value="0" >Inactive</option>
                                </select>
                            </div>
							
							<div class="col-md-12 mt-0">
                                <hr class="ex_bold">
                                <h4>Season Information</h4>
                            </div>
							
							<div class="text-end mb-1">
								<button type="button" class="btn btn-success text-white" id="add_row_period">Add Season</button>
							</div>
							
							<div class="col-12">
								
								<div class="table-responsive" id="myDivPeriod">
								<table class="table table-sm align-middle table-bordered mb-0">
									<tr>
										<th>
										<h5>Season</h5>
										<select name="service_period_master_id[]" class="form-select" id="service_period_master_id" required>
											<option value="">Select Season</option>
											<?php
											if ($periods){
												foreach($periods as $period) {
											?>
											<option value="<?= $period['service_period_master_id']; ?>"><?= $period['showing_desc']; ?></option>
											<?php } } ?>
										</select>
										</th>
									</tr>
									
									<tr class="m-text-box">
										<td>
											<table class="table table-sm align-middle table-bordered mb-0" id="myTableSlot1">
												<tr>
													<th>Slot Desc.</th>
													<th>Start Time</th>
													<th>End Time</th>
													<th>Reporting Time</th>
													<th>Ticket Sale Closing Time</th>
													<th>
														<div class="text-end mt-3">
															<button type="button" class="btn btn-success text-white add_row_slot" id="add_row_slot1" data-tableid="1"><i class="fa fa-plus"></i></button>
														</div>
													</th>
												</tr>
												
												<tr>
													<td><input type="text" class="form-control" name="slot_desc1[]" placeholder="Slot Desc." required></td>
													<td><input type="text" class="form-control timepickerStart" name="start_time1[]" placeholder="Start Time" required></td>
													<td><input type="text" class="form-control timepickerEnd" name="end_time1[]" placeholder="End Time" required></td>
													<td><input type="text" class="form-control" name="reporting_time1[]" placeholder="Reporting Time" required></td>
													<td><input type="checkbox" value="2" name="ticket_sale_closing_flag1[]" /> Previous Day<input type="text" class="form-control timepicker" name="ticket_sale_closing_time1[]" placeholder="Ticket Sale Closing Time" required></td>
													<td></td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
									
								</div>
							</div>
                            
                            <?php /*?><div class="col-md-12 mt-0">
                                <hr class="ex_bold">
                                <h4>Images</h4>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image 1<span class="asterisk"> </span></label>
                                <img src="<?= base_url();?>public/admin_assets/images/property_default_image.png" id="image1" alt="" height="50" width="75">
								<input id="image1Upload" style="display:none;" class="imageUpload" type="file"  accept="image/*" name="image1" placeholder="Photo" capture>	
								<div id="delete_image1_div" style="display:none;">
									<button id="delete_image1" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
								<input type="hidden" id="imageUpload_base64" value="">	
                            </div>
                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image 2<span class="asterisk"> </span></label>
                                <img src="<?= base_url();?>public/admin_assets/images/property_default_image.png" id="image2" alt="" height="50" width="75">
								<input id="image2Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image2" placeholder="Photo" >	
								<div id="delete_image2_div" style="display:none;">
									<button id="delete_image2" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image 3<span class="asterisk"> </span></label>
                                <img src="<?= base_url();?>public/admin_assets/images/property_default_image.png" id="image3" alt="" height="50" width="75">
								<input id="image3Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image3" placeholder="Photo" >	
								<div id="delete_image3_div" style="display:none;">
									<button id="delete_image3" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image 4<span class="asterisk"> </span></label>
                                <img src="<?= base_url();?>public/admin_assets/images/property_default_image.png" id="image4" alt="" height="50" width="75">
								<input id="image4Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image4" placeholder="Photo" >	
								<div id="delete_image4_div" style="display:none;">
									<button id="delete_image4" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div>
							<div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image 5<span class="asterisk"> </span></label>
                                <img src="<?= base_url();?>public/admin_assets/images/property_default_image.png" id="image5" alt="" height="50" width="75">
								<input id="image5Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image5" placeholder="Photo" >	
								<div id="delete_image5_div" style="display:none;">
									<button id="delete_image5" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div><?php */?>
							
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                                <a class="btn app-btn-danger" href="<?= base_url('admin/safari_service'); ?>">CANCEL</a>
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

	$('#add_row_period').click(function () {
		
		var counter = $('.m-text-box').length + 1;
		console.log(counter);
		
		$('#myDivPeriod').append('<table class="table table-sm align-middle table-bordered mb-0"><tr><th><h5>Season</h5><select name="service_period_master_id[]" class="form-select" id="service_period_master_id" required><option value="">Select Season</option><?php if ($periods) { foreach($periods as $period) { ?><option value="<?= $period['service_period_master_id']; ?>"><?= $period['showing_desc']; ?></option><?php } } ?></select></th></tr><tr class="m-text-box"><td><table class="table table-sm align-middle table-bordered mb-0" id="myTableSlot'+counter+'"><tr><th>Slot Desc.</th><th>Start Time</th><th>End Time</th><th>Reporting Time</th><th>Ticket Sale Closing Time</th><th><div class="text-end mt-3"><button type="button" class="btn btn-success text-white add_row_slot" id="add_row_slot'+counter+'" data-tableid="'+counter+'"><i class="fa fa-plus"></i></button></div></th></tr><?php $counter++;?><tr class="text-box"><td><input type="text" class="form-control" name="slot_desc'+counter+'[]" placeholder="Slot Desc." required></td><td><input type="text" class="form-control timepickerStart" name="start_time'+counter+'[]" placeholder="Start Time" required></td><td><input type="text" class="form-control timepickerEnd" name="end_time'+counter+'[]" placeholder="End Time" required></td><td><input type="text" class="form-control" name="reporting_time'+counter+'[]" placeholder="Reporting Time" required></td><td><input type="checkbox" value="2" name="ticket_sale_closing_flag'+counter+'[]" /> Previous Day<input type="text" class="form-control timepicker" name="ticket_sale_closing_time'+counter+'[]" placeholder="Ticket Sale Closing Time" required></td><td></td></tr></table></td></tr></table>');
		
		$('.timepicker').timepicker({
			timeFormat: 'hh:mm p',
			interval: 30,
			minTime: '4:00Am',
			maxTime: '12:00Pm',
			defaultTime: '5:00Am',
			startTime: '4:00Am',
			dynamic: false,
			dropdown: true,
			scrollbar: true
		});
		
		$('.timepickerStart').timepicker({
			timeFormat: 'hh:mm p',
			interval: 30,
			minTime: '4:00Am',
			maxTime: '6:00Pm',
			defaultTime: '5:00Am',
			startTime: '4:00Am',
			dynamic: false,
			dropdown: true,
			scrollbar: true,
			change: function(time) {
				var startTime = $(this).timepicker('getTime'); // Get selected Start Time
				$('.timepickerEnd').timepicker('option', 'minTime', startTime); // Set minTime for End Time
			}
		});
		
		$('.timepickerEnd').timepicker({
			timeFormat: 'hh:mm p',
			interval: 30,
			minTime: '4:00Am',
			maxTime: '6:00Pm',
			defaultTime: '5:00pm',
			dynamic: false,
			dropdown: true,
			scrollbar: true
		});
		
	
	});
	
	
	$(document).on('click', '.delete_row_plot', function() {
		var tableID = $(this).data('tableid');
		$(this).closest('tr').remove();
	});
	
	
	$(document).on('click', '.add_row_slot', function() {
		
		var tableID = $(this).data('tableid');
		console.log(tableID);
		
		
		$('#myTableSlot'+tableID).append('<tr><td><input type="text" class="form-control" name="slot_desc'+tableID+'[]" placeholder="Slot Desc."></td><td><input type="text" class="form-control timepickerStart" name="start_time'+tableID+'[]" placeholder="Start Time"></td><td><input type="text" class="form-control timepickerEnd" name="end_time'+tableID+'[]" placeholder="End Time" required></td><td><input type="text" class="form-control" name="reporting_time'+tableID+'[]" placeholder="Reporting Time" required></td><td><input type="checkbox" value="2" name="ticket_sale_closing_flag'+tableID+'[]" /> Previous Day<input type="text" class="form-control timepicker" name="ticket_sale_closing_time'+tableID+'[]" placeholder="Ticket Sale Closing Time" required></td><td><button type="button" class="btn btn-danger btn-sm text-white delete_row_plot" id="delete_row_plot" data-tableid="'+tableID+'"><i class="fa fa-sm fa-trash"></i></button></td></tr>');
		
		$('.timepicker').timepicker({
			timeFormat: 'hh:mm p',
			interval: 30,
			minTime: '4:00Am',
			maxTime: '12:00Pm',
			defaultTime: '5:00Am',
			startTime: '4:00Am',
			dynamic: false,
			dropdown: true,
			scrollbar: true
		});
		
		$('.timepickerStart').timepicker({
			timeFormat: 'hh:mm p',
			interval: 30,
			minTime: '4:00Am',
			maxTime: '6:00Pm',
			defaultTime: '5:00Am',
			startTime: '4:00Am',
			dynamic: false,
			dropdown: true,
			scrollbar: true,
			change: function(time) {
				var startTime = $(this).timepicker('getTime'); // Get selected Start Time
				$('.timepickerEnd').timepicker('option', 'minTime', startTime); // Set minTime for End Time
			}
		});
		
		$('.timepickerEnd').timepicker({
			timeFormat: 'hh:mm p',
			interval: 30,
			minTime: '4:00Am',
			maxTime: '6:00Pm',
			defaultTime: '5:00pm',
			dynamic: false,
			dropdown: true,
			scrollbar: true
		});
		
	});
	
	$("#district_id").change(function(){ 
		var district_id = $(this).val();
		var result = '';
		$.ajax({
			type: 'POST',	
			url: '<?= base_url("admin/safari_service/getDivision"); ?>',
			data: {
				district_id: district_id,
				csrf_test_name: '<?= $this->csrf['hash']; ?>'
			},
			dataType: 'json',
			encode: true,
			async: false
		})
		//ajax response
		.done(function(response){
			if(response.status){
				result +='<option value="">Select Division</option>';
                $.each(response.list,function(key,value){
                    result +='<option value="'+value.division_id+'">'+value.division_name+'</option>';
                });
			}
			else{
                result +='<option value="">No Data found</option>'
            }
			$("#division_id").html(result);
		});
	});
	
	$('.datepicker').datepicker({
		dateFormat: 'dd-mm'  // Month-Day format
	});
	
	$('.timepicker').timepicker({
		timeFormat: 'hh:mm p',
		interval: 30,
		minTime: '4:00Am',
		maxTime: '12:00Pm',
		defaultTime: '5:00Am',
		startTime: '4:00Am',
		dynamic: false,
		dropdown: true,
		scrollbar: true
	});
	
	$('.timepickerStart').timepicker({
		timeFormat: 'hh:mm p',
		interval: 30,
		minTime: '4:00Am',
		maxTime: '6:00Pm',
		defaultTime: '5:00Am',
		startTime: '4:00Am',
		dynamic: false,
		dropdown: true,
		scrollbar: true,
		change: function(time) {
			var startTime = $(this).timepicker('getTime'); // Get selected Start Time
			$('.timepickerEnd').timepicker('option', 'minTime', startTime); // Set minTime for End Time
		}
	});
	
	$('.timepickerEnd').timepicker({
		timeFormat: 'hh:mm p',
		interval: 30,
		minTime: '4:00Am',
		maxTime: '6:00Pm',
		defaultTime: '5:00pm',
		dynamic: false,
		dropdown: true,
		scrollbar: true
	});
	
	$("#image1").click(function(e) {
		$("#image1Upload").click();
	});	
	$("#image2").click(function(e) {
		$("#image2Upload").click();
	});
	$("#image3").click(function(e) {
		$("#image3Upload").click();
	});
	$("#image4").click(function(e) {
		$("#image4Upload").click();
	});	
	$("#image5").click(function(e) {
		$("#image5Upload").click();
	});

});
</script>

<script type="text/javascript">

function fasterPreview( uploader) {
    if ( uploader.files && uploader.files[0] ){        
        $('#'+uploader.name).attr('src',window.URL.createObjectURL(uploader.files[0]) ); 
    }
}

$("#image1Upload").change(function(){
	//$("#delete_profile_image_div").show();
	//console.log(this.name);	
	fasterPreview( this );    
});

$("#image2Upload").change(function(){
	//$("#delete_profile_image_div").show();
	fasterPreview( this );
    
});

$("#image3Upload").change(function(){
	//$("#delete_profile_image_div").show();
	fasterPreview( this );
    
});

$("#image4Upload").change(function(){
	//$("#delete_profile_image_div").show();
	fasterPreview( this );
    
});

$("#image5Upload").change(function(){
	//$("#delete_profile_image_div").show();
	fasterPreview( this );
    
});
</script>
