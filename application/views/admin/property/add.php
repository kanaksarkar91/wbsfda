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
                <h1 class="app-page-title mb-0">Add Property </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/property'); ?>">
                                View All Property
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

            <form class="settings-form" method="post" action="<?= base_url('admin/property/submit_property'); ?>" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
			<input type="hidden" name="slug" value="<?=$slug;?>">

                <div class="app-card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <h4>Property Details</h4>
                                <hr class="ex_bold">
                            </div>
                            <div class="col-md-12 mt-0">
                                <?php /*?><h5>Owner Details <?= $this->admin_session_data['role_id'] ?></h5><?php */?>
                            </div>
                            
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <label for="property_name" class="form-label">Property Name <span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="property_name" placeholder="Property Name" required>
                                
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_type" class="form-label">Property Type <span class="asterisk"> *</span></label>
                                <select name="property_type" class="form-select select2" id="property_type" required>
                                    <option value="">Select Property Type</option>
									<?php
									if (isset($property_types))
										foreach($property_types as $property_type) {
									?>
                                    <option value="<?= $property_type['id']; ?>" ><?= $property_type['property_type_name']; ?></option>
									<?php } ?>
                                </select>
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="terrain_type" class="form-label">Location<span class="asterisk"> *</span></label>
                                <select name="terrain_type" class="form-select" id="terrain_type" required>
                                    <option value="">Select Location</option>
									<?php
									if (isset($terrain_types))
										foreach($terrain_types as $terrain_type) {
									?>
                                    <option value="<?= $terrain_type['terrain_id']; ?>" ><?= $terrain_type['terrain_name']; ?></option>
									<?php } ?>
                                </select>
                            </div>
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_gstin" class="form-label">GSTIN<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="property_gstin" placeholder="GSTIN" required>
                            </div>
							
							<div class="col-lg-12 col-sm-12 col-md-12">
								<label for="property_description" class="form-label">Property Description <span class="asterisk"> *</span></label>
								<textarea name="property_description" id="property_description" class="form-control" placeholder="Property Description" rows="3" required></textarea>
							</div>
                            
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_phn_no" class="form-label">Contact No. 1 <span class="asterisk"> *</span></label>
                                <input type="number" class="form-control" name="property_phn_no" placeholder="Contact No. 1" required>
                            </div>


                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_mobile_no" class="form-label">Contact No. 2<span class="asterisk"> </span></label>
                                <input type="number" class="form-control" name="property_mobile_no" placeholder="Contact No. 2">
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_email" class="form-label">E-mail<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="property_email" placeholder="E-mail" required>
                            </div>
                            <div class="col-lg-8 col-sm-12 col-md-6">
                                <label for="property_address_line_1" class="form-label">Address<span class="asterisk"> *</span></label>
                                <textarea name="property_address_line_1" id="property_address_line_1" class="form-control" placeholder="Address" rows="3" required></textarea>
                            </div>


                            <!--<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_address_line_2" class="form-label">Address Line 2<span class="asterisk"></span></label>
                                <input type="text" class="form-control" name="property_address_line_2" placeholder="Address Line 2" >
                            </div>-->

                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_city" class="form-label">City/Village<span class="asterisk"> </span></label>
                                <input type="text" class="form-control" name="property_city" placeholder="City" >
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_state" class="form-label">State<span class="asterisk"> *</span></label>
                                <select name="property_state" class="form-select select2" id="property_state" required>
									<?php
									if (isset($states))
										foreach($states as $s) {
									?>
                                    <option value="<?= $s['state_id']; ?>" selected><?= $s['state_name']; ?></option>
									<?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_district" class="form-label">District<span class="asterisk"> *</span></label>
                                <select name="property_district" class="form-select select2" id="property_district" required>
                                    <option value="">Select District</option>
									<?php
									if (isset($districts))
										foreach ($districts as $d) { 
									?>
                                    <option value="<?= $d['district_id']; ?>" ><?= $d['district_name']; ?></option>
									<?php } ?>
                                   
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_pin_code" class="form-label">Pin Code<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="property_pin_code" placeholder="Pin Code" required>
                            </div>
                            
                             <div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_status" class="form-label">Status<span class="asterisk"> *</span></label>
                                <select name="property_status" class="form-select" id="property_status" required>
                                    <option value="1" >Active</option>
                                    <option value="0" >Inactive</option>
                                </select>
                            </div>
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="checkin_time" class="form-label">Check In<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control timepicker" name="checkin_time" placeholder="Check In" required="" readonly="">
                            </div>
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="checkout_time" class="form-label">Check Out<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control timepicker" name="checkout_time" placeholder="Check Out" required="" readonly="">
                            </div>

							<div class="col-md-12 mt-0">
							    <hr class="ex_bold">
                                <h4>Facilities</h4>
                            </div>
							<div class="col-lg-12 col-sm-12 col-md-12">
								<div class="d-flex flex-wrap">
								<?php
								if (isset($facilities))
									foreach ($facilities as $f) {
								?>
									<div class="p-2 me-2">
										<label><input type="checkbox" name="property_facilities[]" value="<?= $f['facility_id']; ?>" class="me-1"><?= $f['facility_name']; ?></label>
									</div>
								<?php } ?>
								</div>
							</div>

                            <div class="col-md-12 mt-0">
                                <hr class="ex_bold">
                                <h4>Search</h4>
                            </div>
				
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <label for="property_search_keywords" class="form-label">Search Keywords<span class="asterisk"> </span></label>
                                <input type="text" class="form-control" name="property_search_keywords" id="property_search_keywords" placeholder="property search keywords ">
                            </div>


                            <!--<div class="col-md-12 mt-0">
                                <hr class="ex_bold">
                                <h4>Location</h4>
                            </div>
							
							<div class="col-lg-12 col-sm-12 col-md-12">
			   
							  <div class="form-group">
								<input type="text" class="form-control" id="pac-input" placeholder="Search Location in Google Maps" name="location_name" value="" required >
							   </div>
							  <input type="hidden" id="geo_latitude" name="geo_latitude"> 
							  <input type="hidden" id="geo_longitude" name="geo_longitude"> 
							  <div id="infowindow-content">
								<img src="" width="16" height="16" id="place-icon">
								<span id="place-name"  class="title"></span><br>
								<span id="place-address"></span>
							  </div>			   
						   
							</div>
							
							<div class="col-sm-12"> 
								<div id="googleMap" style="width:100%;height:200px;"></div>
							</div>-->


                            <div class="col-md-12 mt-0">
                                <hr class="ex_bold">
                                <h4>Images</h4>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image 1<span class="asterisk"> </span></label>
                                <img src="https://panchayet.syscentricdev.com/public/admin_assets/images/property_default_image.png" id="image1" alt="" height="50" width="75">
								<input id="image1Upload" style="display:none;" class="imageUpload" type="file"  accept="image/*" name="image1" placeholder="Photo" capture>	
								<div id="delete_image1_div" style="display:none;">
									<button id="delete_image1" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
								<input type="hidden" id="imageUpload_base64" value="">	
                            </div>
                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image 2<span class="asterisk"> </span></label>
                                <img src="https://panchayet.syscentricdev.com/public/admin_assets/images/property_default_image.png" id="image2" alt="" height="50" width="75">
								<input id="image2Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image2" placeholder="Photo" >	
								<div id="delete_image2_div" style="display:none;">
									<button id="delete_image2" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image 3<span class="asterisk"> </span></label>
                                <img src="https://panchayet.syscentricdev.com/public/admin_assets/images/property_default_image.png" id="image3" alt="" height="50" width="75">
								<input id="image3Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image3" placeholder="Photo" >	
								<div id="delete_image3_div" style="display:none;">
									<button id="delete_image3" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image 4<span class="asterisk"> </span></label>
                                <img src="https://panchayet.syscentricdev.com/public/admin_assets/images/property_default_image.png" id="image4" alt="" height="50" width="75">
								<input id="image4Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image4" placeholder="Photo" >	
								<div id="delete_image4_div" style="display:none;">
									<button id="delete_image4" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div>
							<div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image 5<span class="asterisk"> </span></label>
                                <img src="https://panchayet.syscentricdev.com/public/admin_assets/images/property_default_image.png" id="image5" alt="" height="50" width="75">
								<input id="image5Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image5" placeholder="Photo" >	
								<div id="delete_image5_div" style="display:none;">
									<button id="delete_image5" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div>
							<div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image 6<span class="asterisk"> </span></label>
                                <img src="https://panchayet.syscentricdev.com/public/admin_assets/images/property_default_image.png" id="image6" alt="" height="50" width="75">
								<input id="image6Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image6" placeholder="Photo" >	
								<div id="delete_image6_div" style="display:none;">
									<button id="delete_image6" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div>
							<div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image 7<span class="asterisk"> </span></label>
                                <img src="https://panchayet.syscentricdev.com/public/admin_assets/images/property_default_image.png" id="image7" alt="" height="50" width="75">
								<input id="image7Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image7" placeholder="Photo" >	
								<div id="delete_image7_div" style="display:none;">
									<button id="delete_image7" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div>
							<div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image 8<span class="asterisk"> </span></label>
                                <img src="https://panchayet.syscentricdev.com/public/admin_assets/images/property_default_image.png" id="image8" alt="" height="50" width="75">
								<input id="image8Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image8" placeholder="Photo" >	
								<div id="delete_image8_div" style="display:none;">
									<button id="delete_image8" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div>
							<div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image 9<span class="asterisk"> </span></label>
                                <img src="https://panchayet.syscentricdev.com/public/admin_assets/images/property_default_image.png" id="image9" alt="" height="50" width="75">
								<input id="image9Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image9" placeholder="Photo" >	
								<div id="delete_image9_div" style="display:none;">
									<button id="delete_image9" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div>
							<div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image 10<span class="asterisk"> </span></label>
                                <img src="https://panchayet.syscentricdev.com/public/admin_assets/images/property_default_image.png" id="image10" alt="" height="50" width="75">
								<input id="image10Upload" style="display:none;" class="imageUpload" type="file" accept="image/*" name="image10" placeholder="Photo" >	
								<div id="delete_image4_div" style="display:none;">
									<button id="delete_image10" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
                            </div>
							
							<div class="col-lg-12 col-sm-12 col-md-12">
                                <label for="property_bank_name" class="form-label">YouTube Video Link<span class="asterisk"> </span></label>
                                <input type="text" class="form-control" name="youtube_video_link" placeholder="YouTube Video Link" value="<?= $property['youtube_video_link']; ?>" >
                            </div>
                            
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                                <a class="btn app-btn-danger" href="<?= base_url('admin/property'); ?>">CANCEL</a>
                            </div>
                        </div>
                </div>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>
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
$("#image6Upload").change(function(){
	//$("#delete_profile_image_div").show();
	fasterPreview( this );
    
});
$("#image7Upload").change(function(){
	//$("#delete_profile_image_div").show();
	fasterPreview( this );
    
});
$("#image8Upload").change(function(){
	//$("#delete_profile_image_div").show();
	fasterPreview( this );
    
});
$("#image9Upload").change(function(){
	//$("#delete_profile_image_div").show();
	fasterPreview( this );
    
});
$("#image10Upload").change(function(){
	//$("#delete_profile_image_div").show();
	fasterPreview( this );
    
});
</script>
<script>
$(document).ready(function(){

	$('.timepicker').timepicker({
		timeFormat: 'HH:mm',
		interval: 30,
		minTime: '7',
		maxTime: '18:00',
		defaultTime: '11',
		startTime: '7:00',
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
	$("#image6").click(function(e) {
		$("#image6Upload").click();
	});
	$("#image7").click(function(e) {
		$("#image7Upload").click();
	});
	$("#image8").click(function(e) {
		$("#image8Upload").click();
	});
	$("#image9").click(function(e) {
		$("#image9Upload").click();
	});
	$("#image10").click(function(e) {
		$("#image10Upload").click();
	});

	initMap();

});
</script>
