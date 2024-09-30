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
                <h1 class="app-page-title mb-0">Add New Venue Details</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/venue') ?>">
                                View All Venue
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

            <form class="settings-form" method="post" action="" enctype="multipart/form-data" autocomplete="off" id="venueEntry">
            <input type="hidden" name="slug" value="<?=$slug;?>">
            <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
                <div class="app-card-body">
                    <form class="settings-form">
                        <div class="row g-3">
                        <div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">Property<span class="asterisk"> *</span></label>
                                <select name="property_id" class="form-select select2" id="property_id" required>
                                    <option value="" selected disabled>Select Property</option>
                                    <?php foreach ($property_details as $property) { ?>
                                        <option value="<?= $property['property_id'] ?>"><?= $property['property_name'] ?></option>
                                    <?php } ?>
                                   
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">Name<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="venue_name" placeholder="Enter Venue Name" required>                              
                            </div>                        
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">Contact No.<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter Contact No." maxlength="10" required>                              
                                <span id="mob1-invalid" class="hidden small text-danger">
                            You have entered an Invalid Mobile Number
                                </span>
                            <span id="mob1-invalid_digits" class="hidden small text-danger">
                            Please enter 10 digits Mobile Number
                            </span>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">Alternaitve Contact No.</label>
                                <input type="text" class="form-control" id="alt_contact" name="alt_contact" placeholder="Enter Alternative Contact No." maxlength="10">                              
                                <span id="alt_mob1-invalid" class="hidden small text-danger">
                            You have entered an Invalid Mobile Number
                                </span>
                            <span id="alt_mob1-invalid_digits" class="hidden small text-danger">
                            Please enter 10 digits Mobile Number
                            </span>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">Email-Id<span class="asterisk"> *</span></label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email address" required>                              
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">Alternaitve Email-Id</label>
                                <input type="email" class="form-control" name="alt_email" placeholder="Enter Alternative Contact No.">                              
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">Approx Capacity</label>
                                <input type="text" class="form-control" name="approx_capacity" placeholder="Enter Approx Capacity">                              
                            </div> 
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">Available Timming</label>
                                <input type="text" class="form-control" name="available_timming" placeholder="Enter Available Timming">                              
                            </div> 
                            <!--<div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Is Hourly Booking Applicable?</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hourly_booking_applicable" id="hourly_booking_yes" value="yes">
                                    <label class="form-check-label" for="hourly_booking_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hourly_booking_applicable" id="hourly_booking_no" value="no" checked>
                                    <label class="form-check-label" for="hourly_booking_no">No</label>
                                </div>
                            </div>
                            <div id="hourly_booking_panel" style="display: none;">
                                <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Number of Hours<span class="asterisk"> *</span></label>
                                    <select name="number_of_hours" class="form-select select2" id="number_of_hours">
                                    <option value="" selected>--Select Number of Hours--</option>
                                    <?php foreach ($hourly_options as $option) { ?>
                                        <option value="<?= $option['no_of_hours']; ?>"><?= $option['no_of_hours']; ?> Hours</option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>-->
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <label for="" class="form-label">Description</label>
                                <textarea class="form-control" name="desc" placeholder="Venue Description..."></textarea>                             
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <label for="" class="form-label">Available Facilities</label>
                                <textarea class="form-control" name="available_facilities" placeholder="Available Facilities..."></textarea>                             
                            </div>
                            <div class="col-md-12">
                                <h4>Images</h4>
                            </div>

                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <label for="" class="form-label">Select Multiple Image<span class="asterisk"> </span></label>
                                <input id="" class="form-control" type="file" multiple accept="image/*" name="venue_image[]" placeholder="Photo">
                            </div>

                            <!--<div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image<span class="asterisk"> </span></label>
                                <img src=<?=base_url().'/public/admin_assets/images/property_default_image.png'?> id="image1" alt="" height="50" width="75">
								<input id="image1Upload" style="display:none;" class="imageUpload" type="file"  accept="image/*" name="image1" placeholder="Photo" capture>	
								<div id="delete_image1_div" style="display:none;">
									<button id="delete_image1" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
								<input type="hidden" id="imageUpload_base64" value="">	
                            </div>

                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image<span class="asterisk"> </span></label>
                                <img src=<?=base_url().'/public/admin_assets/images/property_default_image.png'?> id="image2" alt="" height="50" width="75">
								<input id="image1Upload2" style="display:none;" class="imageUpload2" type="file"  accept="image/*" name="image2" placeholder="Photo" capture>	
								<div id="delete_image2_div" style="display:none;">
									<button id="delete_image2" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
								<input type="hidden" id="imageUpload_base642" value="">	
                            </div>

                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image<span class="asterisk"> </span></label>
                                <img src=<?=base_url().'/public/admin_assets/images/property_default_image.png'?> id="image3" alt="" height="50" width="75">
								<input id="image1Upload3" style="display:none;" class="imageUpload3" type="file"  accept="image/*" name="image3" placeholder="Photo" capture>	
								<div id="delete_image3_div" style="display:none;">
									<button id="delete_image3" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
								<input type="hidden" id="imageUpload_base643" value="">	
                            </div>

                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <label for="" class="form-label">Image<span class="asterisk"> </span></label>
                                <img src=<?=base_url().'/public/admin_assets/images/property_default_image.png'?> id="image4" alt="" height="50" width="75">
								<input id="image1Upload4" style="display:none;" class="imageUpload4" type="file"  accept="image/*" name="image4" placeholder="Photo" capture>	
								<div id="delete_image4_div" style="display:none;">
									<button id="delete_image4" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
								</div>
								<input type="hidden" id="imageUpload_base644" value="">	
                            </div>-->

                            <div class="col-sm-12 col-md-12">
                                <input type="hidden" name="submit" value="1"/>                               
                                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                                <a class="btn app-btn-danger" href="<?= base_url('admin/venue') ?>">CANCEL</a>
                            </div>

                        </div>
                       
                </div>
                 
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>

<script type='text/javascript'>

</script>

<script type='text/javascript'>
 
  $(document).ready(function(){
 
        $("#image1").click(function(e) {
            $("#image1Upload").click();
        });
        
        $("#image2").click(function(e) {
            $("#image1Upload2").click();
        });

        $("#image3").click(function(e) {
            $("#image1Upload3").click();
        });

        $("#image4").click(function(e) {
            $("#image1Upload4").click();
        });

    });

        
    function fasterPreview( uploader) {
        if ( uploader.files && uploader.files[0] ){        
            $('#'+uploader.name).attr('src',window.URL.createObjectURL(uploader.files[0]) ); 
        }
    }

    function fasterPreview2( uploader) {
        if ( uploader.files && uploader.files[0] ){        
            $('#'+uploader.name).attr('src',window.URL.createObjectURL(uploader.files[0]) ); 
        }
    }

    function fasterPreview3( uploader) {
        if ( uploader.files && uploader.files[0] ){        
            $('#'+uploader.name).attr('src',window.URL.createObjectURL(uploader.files[0]) ); 
        }
    }

    function fasterPreview4( uploader) {
        if ( uploader.files && uploader.files[0] ){        
            $('#'+uploader.name).attr('src',window.URL.createObjectURL(uploader.files[0]) ); 
        }
    }

    $("#image1Upload").change(function(){
        //$("#delete_profile_image_div").show();
        //console.log(this.name);	
        fasterPreview( this );    
    });

    $("#image1Upload2").change(function(){
        //$("#delete_profile_image_div").show();
        //console.log(this.name);	
        fasterPreview2( this );    
    });

    $("#image1Upload3").change(function(){
        //$("#delete_profile_image_div").show();
        //console.log(this.name);	
        fasterPreview3( this );    
    });

    $("#image1Upload4").change(function(){
        //$("#delete_profile_image_div").show();
        //console.log(this.name);	
        fasterPreview4( this );    
    });

</script>
