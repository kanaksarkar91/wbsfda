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

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Edit accommodation </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/accommodation') ?>">
                                VIEW ALL Accommodation
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

        <div class="app-card app-card-settings shadow-sm p-4">

            <form class="settings-form" method="post" action="<?= base_url('admin/accommodation/updateaccommodation'); ?>" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">
				<input type="hidden" name="slug" value="<?= $slug; ?>">
                <input type="hidden" name="accommodation_id" value="<?= $accommodation['accommodation_id']; ?>">

                <div class="app-card-body">
                        <div class="row g-3">
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Property<span class="asterisk"> *</span></label>
                                <select name="property_id" class="form-select select2" id="property_id" required>
                                    <option value="" selected disabled>Select Property</option>
                                    <?php foreach ($property_details as $property) { ?>
                                        <option value="<?= $property['property_id'] ?>" <?= ($accommodation['property_id'] == $property['property_id']) ? 'selected' : '' ?>><?= $property['property_name'] ?></option>
                                    <?php } ?>

                                </select>
                            </div>
							<div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Accommodation Name<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="accommodation_name" value="<?= $accommodation['accommodation_name']; ?>" placeholder="Accommodation Category Name" required>
                            </div>
                            
                            <div class="col-lg-12 col-sm-12 col-md-12 mb-3">
                                <label for="" class="form-label">Accommodation Detail Information</label>
                                <textarea class="form-control" name="accommodation_information" placeholder="Accommodation Detail Information..."><?= $accommodation['accommodation_information']; ?></textarea>                             
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Accommodation Classification<span class="asterisk"> *</span></label>
                                <select name="accomm_class_id" class="form-select" id="accomm_class_id" required>
                                    <option value="" selected disabled>select class</option>
                                    <?php foreach ($accomm_class as $accomm) { ?>
                                        <option value="<?= $accomm['accomm_class_id'] ?>" <?= ($accommodation['accomm_class_id'] == $accomm['accomm_class_id']) ? 'selected' : '' ?>><?= $accomm['accomm_class_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Accommodation Type<span class="asterisk"> *</span></label>
                                <select class="form-select select2" disabled="disabled">
                                    <option value="" selected disabled>select type</option>
                                    <?php foreach ($accomm_type as $accommType) { ?>
                                        <option value="<?= $accommType['accomm_type_id'] ?>" <?= ($accommodation['accomm_type_id'] == $accommType['accomm_type_id']) ? 'selected' : '' ?>><?= $accommType['accomm_type_name'] ?></option>
                                    <?php } ?>
                                </select>
								
								<input type="hidden" name="accomm_type_id" value="<?= $accommodation['accomm_type_id']; ?>" readonly="">
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">No. Of accommodation <span class="asterisk"> *</span></label>
                                <select class="form-select select2" disabled="disabled">
                                    <option value="">Select No. Of accommodation</option>
                                    <?php for ($x = 1; $x <= 50; $x++) { ?>
										<option value="<?=$x?>" <?= ($x == $accommodation['no_of_accomm']) ? 'selected' : '' ?>><?= $x ?></option>
                                    <?php } ?>
									
                                </select>
								
								<input type="hidden" name="no_of_accomm" value="<?= $accommodation['no_of_accomm']; ?>" readonly="">
                            </div>
							<div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Allowed Adult <span class="asterisk"> *</span></label>
                                <select class="form-select" name="adult" id="adult" required>
                                    <option value="">Select Allowed Adult</option>
                                    <?php for ($x = 1; $x <= 10; $x++) { ?>
                                    <option value="<?=$x?>" <?= ($x == $accommodation['adult']) ? 'selected' : '' ?>><?= $x ?></option>
                                    <?php } ?>
									<option value="5000"<?=(5000 == $accommodation['adult']) ? 'selected' : '' ?>>Not Applicable</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Allowed Child <span class="asterisk"> *</span></label>
                                <select class="form-select adult-option" name="child" <?=5000 == $accommodation['adult'] ? 'disabled' : '' ?> required>
                                    <option value="">Select Allowed Child</option>
                                    <?php for ($x = 1; $x <= 5; $x++) { ?>
                                    <option value="<?=$x?>" <?= ($x == $accommodation['child']) ? 'selected' : '' ?>><?= $x ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Status<span class="asterisk"> *</span></label>
                                <select name="is_active" class="form-select" id="is_active" required>
                                    <option value="">Select Status</option>
                                    <option value="1" <?= ($accommodation['is_active'] == 1) ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?= ($accommodation['is_active'] == 0) ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
							
                            <div class="col-md-12">
                                <hr class="ex_bold">
								<h4>Facilities</h4>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12 mb-3">
                                <div class="d-flex flex-wrap">
                                    <?php
                                    $accommodation_arr = explode(',', $accommodation['facilities']);
                                    if (isset($facilities))
                                        foreach ($facilities as $f) {
                                    ?>
                                        <div class="p-2 me-2">
                                            <label><input type="checkbox" name="property_facilities[]" value="<?= $f['facility_id']; ?>" class="me-1" <?= set_checkbox('property_facilities', $f['facility_id'], in_array($f['facility_id'], $accommodation_arr) ? true : false); ?>><?= $f['facility_name']; ?></label>
                                        </div>
                                    <?php } ?>
								</div>
                            </div>
                            <div class="col-md-12">
                                <hr class="ex_bold">
								<h4>Images</h4>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Image 1<span class="asterisk"> </span></label>
                                <img src="<?= !is_null($accommodation['image1']) ? base_url('public/admin_images/' . $accommodation['image1']) : 'https://jmd.syscentricdev.com/hotel_pms/assets/images/property_default_image.png'; ?>" id="image1" alt="" height="50" width="75">
								<input id="image1Upload" style="display:none;" class="imageUpload" type="file"  accept="image/*" name="image1" placeholder="Photo" capture>	
								<div id="delete_image1_div" style="display:none;">
									<button id="delete_image1" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
								<input type="hidden" id="imageUpload_base64" value="">	
                            </div>
                            <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Image 2<span class="asterisk"> </span></label>
                                <img src="<?= !is_null($accommodation['image2']) ? base_url('public/admin_images/' . $accommodation['image2']) : 'https://jmd.syscentricdev.com/hotel_pms/assets/images/property_default_image.png'; ?>" id="image2" alt="" height="50" width="75">
								<input id="image2Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image2" placeholder="Photo" >	
								<div id="delete_image2_div" style="display:none;">
									<button id="delete_image2" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Image 3<span class="asterisk"> </span></label>
                                <img src="<?= !is_null($accommodation['image3']) ? base_url('public/admin_images/' . $accommodation['image3']) : 'https://jmd.syscentricdev.com/hotel_pms/assets/images/property_default_image.png'; ?>" id="image3" alt="" height="50" width="75">
								<input id="image3Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image3" placeholder="Photo" >	
								<div id="delete_image3_div" style="display:none;">
									<button id="delete_image3" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Image 4<span class="asterisk"> </span></label>
                                <img src="<?= !is_null($accommodation['image4']) ? base_url('public/admin_images/' . $accommodation['image4']) : 'https://jmd.syscentricdev.com/hotel_pms/assets/images/property_default_image.png'; ?>" id="image4" alt="" height="50" width="75">
								<input id="image4Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image4" placeholder="Photo" >	
								<div id="delete_image4_div" style="display:none;">
									<button id="delete_image4" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div>
							
							<div class="col-md-12">
                                <hr class="ex_bold">
								<h4>Accommodation Details</h4>
                            </div>
							
							<div class="col-6">
								
								<div class="table-responsive applicants-data-add-table">
									<table class="table table-sm align-middle table-bordered mb-0" id="myTableRoom">
										<tr>
											<th style="min-width: 180px;">Accommodation No.</th>
										</tr>
										
										<tbody id="added_row_tr">
										<?php
										if(!empty($accomo_room_mapping_dtl)) {
											foreach($accomo_room_mapping_dtl as $row) {
												$counter++;
										?>
											<tr class="text-box">
												<td><input type="text" class="form-control" name="room_no[]" id="room_no<?php echo $counter;?>" placeholder="Room No." onchange="return check_room_no_availability(<?php echo $counter;?>);" value="<?php echo $row['room_no'];?>" readonly="" required>
												<span id="show_msg<?php echo $counter;?>"></span>
												</td>
												
											</tr>
										<?php
											}
										}
										?>
										</tbody>
									</table>
								</div>
								
								<div class="text-end mt-3"></div>
							</div>
							
                        </div>

                </div>
                <input type="hidden" name="submit" value="1" />
                <button type="submit" class="btn app-btn-primary">UPDATE</button>
                <a class="btn app-btn-danger" href="">CANCEL</a>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>


<script type='text/javascript'>
    $(document).ready(function() {

        $('#myTableRoom').on('click', '#delete_row_room', function () {
			$(this).closest('tr').remove();
		});
		
		$('#add_row_room').click(function () {
			
			var counter = $('.text-box').length + 1;
			
			$('#myTableRoom').append('<tr class="text-box"><td><input type="text" class="form-control" name="room_no[]" id="room_no' + counter + '" placeholder="Room No." onchange="return check_room_no_availability('+counter+');" required><span id="show_msg' + counter + '"></span></td><td><button type="button" class="btn btn-danger btn-sm text-white" id="delete_row_room"><i class="fa fa-trash"></i></button></td></tr>')
			
		});
		
		$(document).on('change', '#no_of_accomm', function(){ 
			
			var no_of_accomm = $('#no_of_accomm :selected').val();
			
			$.ajax({
				type: 'POST',	
				url: "<?php echo base_url('getRoomHtml'); ?>",
				data: {csrf_test_name: '<?php echo $this->csrf['hash']; ?>', no_of_accomm: no_of_accomm},
				dataType: 'json',
				encode: true,
				async: false,
				beforeSend: function(){
					$('#added_row_tr').empty();
				}
			})
			//ajax response
			.done(function(data){
				
				if(data.status){
					$('#added_row_tr').append(data.html);
				}
			})
			.fail(function(data){
				// show the any errors
				console.log(data);
			});
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

    });
	
	function check_room_no_availability(counter){
		var room_no = document.getElementById("room_no"+counter).value;
		var property_id = $('#property_id :selected').val();
		console.log(property_id);
		
		$.ajax({
			type: 'POST',	
			url: "<?php echo base_url('checkRoomNoAvailability'); ?>",
			data: {
				room_no: room_no,
				property_id : property_id,
				csrf_test_name: '<?php echo $this->csrf['hash']; ?>', 
			},
			dataType: 'json',
			encode: true,
			async: false
		})
		//ajax response
		.done(function(response){
			if(!response.success){
				//$('#show_msg'+counter).addClass("alert-success text-center");
				//$("#show_msg"+counter).html(response.message);
				$('#show_msg'+counter).addClass("alert-danger text-center");
				$("#show_msg"+counter).html(response.message);
			}
			
			return false;
		})
		.fail(function(data){
			// show the any errors
			console.log(data);
		});
		
	}

    function manageAdultOptions(value){
        if(value == '5000'){
            $('.adult-option').prop('disabled', true);
        }else{
            $('.adult-option').prop('disabled', false);
        }
    }

    function fasterPreview(uploader) {
        if (uploader.files && uploader.files[0]) {
            $('#' + uploader.name).attr('src', window.URL.createObjectURL(uploader.files[0]));
        }
    }

    $("#image1Upload").change(function() {
        //$("#delete_profile_image_div").show();
        //console.log(this.name);	
        fasterPreview(this);
    });

    $("#image2Upload").change(function() {
        //$("#delete_profile_image_div").show();
        fasterPreview(this);

    });

    $("#image3Upload").change(function() {
        //$("#delete_profile_image_div").show();
        fasterPreview(this);

    });
    $("#image4Upload").change(function() {
        //$("#delete_profile_image_div").show();
        fasterPreview(this);

    });
</script>


