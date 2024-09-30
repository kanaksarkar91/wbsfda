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
                <h1 class="app-page-title mb-0">Edit Venue </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/venue') ?>">
                                VIEW ALL Venue
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

            <form class="settings-form" method="post" action="<?= base_url('admin/venue/updatevenue'); ?>" enctype="multipart/form-data" autocomplete="off" id="editVenueEntry">
                <input type="hidden" name="slug" value="<?= $slug; ?>">
                <input type="hidden" name="venue_id" value="<?= $venue['venue_id']; ?>">
                <input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">
                <div class="app-card-body">
                    <form class="settings-form">
                        <div class="row g-3">
                                <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">Property<span class="asterisk"> *</span></label>
                                            <select name="property_id" class="form-select select2" id="property_id" required>
                                                <option value="" selected disabled>Select Property</option>
                                                <?php foreach ($property_details as $property) { ?>
                                                    <option value="<?= $property['property_id'] ?>" <?= ($venue['property_id'] == $property['property_id']) ? 'selected' : '' ?>><?= $property['property_name'] ?></option>
                                                <?php } ?>

                                            </select>
                                </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Name<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="venue_name" value="<?= $venue['venue_name']; ?>" placeholder="Enter Venue Name" required>                              
                            </div>                        
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Contact No.<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" id="contact" name="contact" value="<?= $venue['contact_no']; ?>" placeholder="Enter Contact No." maxlength="10" required>                              
                            <span id="mob1-invalid" class="hidden small text-danger">
                            You have entered an Invalid Mobile Number
                            </span>
                            <span id="mob1-invalid_digits" class="hidden small text-danger">
                            Please enter 10 digits Mobile Number
                           </span>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Alternaitve Contact No.</label>
                                <input type="text" class="form-control" id="alt_contact" name="alt_contact" value="<?= $venue['alternative_contact_no']; ?>" placeholder="Enter Alternative Contact No." maxlength="10">                              
                                <span id="alt_mob1-invalid" class="hidden small text-danger">
                            You have entered an Invalid Mobile Number
                                </span>
                            <span id="alt_mob1-invalid_digits" class="hidden small text-danger">
                            Please enter 10 digits Mobile Number
                            </span>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Email-Id<span class="asterisk"> *</span></label>
                                <input type="email" class="form-control" name="email" value="<?= $venue['email']; ?>" placeholder="Enter Email address" required>                              
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Alternaitve Email-Id</label>
                                <input type="email" class="form-control" name="alt_email" value="<?= $venue['alternative_email']; ?>" placeholder="Enter Alternative Contact No.">                              
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label class="form-label">Is Hourly Booking Applicable?<span class="asterisk"> *</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hourly_booking_applicable" id="hourly_booking_yes" value="yes" <?= ($venue['is_hourly_booking'] == 1) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="hourly_booking_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hourly_booking_applicable" id="hourly_booking_no" value="no" <?= ($venue['is_hourly_booking'] == 0) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="hourly_booking_no">No</label>
                                </div>
                            </div>
                            <div id="hourly_booking_panel" style="display: <?= ($venue['is_hourly_booking'] == 1) ? 'block' : 'none'; ?>">
                                <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                    <label class="form-label">Number of Hours<span class="asterisk"> *</span></label>
                                    <select name="number_of_hours" class="form-select select2" id="number_of_hours">
                                        <option value="" <?= ($venue['number_of_hours'] === 0) ? 'selected' : ''; ?>>--Select Number of Hours--</option>
                                        <?php foreach ($hourly_options as $option) { ?>
                                            <option value="<?= $option['no_of_hours']; ?>" <?= ($venue['booking_hours'] === $option['no_of_hours']) ? 'selected' : ''; ?>><?= $option['no_of_hours']; ?> Hours</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 col-md-12 mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea class="form-control" name="desc" placeholder="Venue Description..."><?= $venue['venue_description']; ?></textarea>                             
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12 mb-3">
                                <label for="" class="form-label">Available Facilities</label>
                                <textarea class="form-control" name="available_facilities" placeholder="Available Facilities..."><?= $venue['available_facilities']; ?></textarea>                             
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Status<span class="asterisk"> *</span></label>
                                <select name="is_active" class="form-select" id="is_active" required>
                                    <option value="">Select Status</option>
                                    <option value="1" <?= ($venue['is_active'] == 1) ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?= ($venue['is_active'] == 0) ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <h4>Images</h4>
                            </div>

                            <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">Image<span class="asterisk"> </span></label>
                                            <img src="<?= !is_null($venue['image1']) ? base_url('public/admin_images/' . $venue['image1']) : base_url().'/public/admin_assets/images/property_default_image.png'; ?>" id="image1" alt="" height="50" width="75">
                                            <input id="image1Upload" style="display:none;" class="imageUpload" type="file"  accept="image/*" name="image1" placeholder="Photo" capture>	
                                            <div id="delete_image1_div" style="display:none;">
                                                <button id="delete_image1" class="btn btn-theme-warn" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
                                            </div>
                                            <input type="hidden" id="imageUpload_base64" value="">	
                                        </div>
                        </div>
                    
                </div>
                <input type="hidden" name="submit" value="1"/>                               
                <button type="submit" class="btn app-btn-primary">EDIT</button>
                <a class="btn app-btn-danger" href="">CANCEL</a>
            </form>
        </div>

        <!--//app-card-body-->

    </div>
</div>

<script type='text/javascript'>
$(document).ready(function() {
    
	$(document).on('change', '#extra_bed, #adult', function() {
	   var extra_bed = $('#extra_bed :selected').val();
	   var adult_val = $('#adult :selected').val();
	   
	   if(adult_val == '5000'){
	   	var adult = 0;
	   }else{
	   	var adult = adult_val;
	   }
	   
	   var max_adult = Number(extra_bed) + Number(adult);
	   //console.log(max_adult);
	   
	   $('#max_adult').val(max_adult);
	   
	   manageAdultOptions(value);
	   
    });

    // Add this script inside your existing script section
$("#is_active").change(function() {
    var venueId = <?= $venue['venue_id']; ?>;
    var propertyId = $("#property_id").val();
    var selectedValue = $(this).val();
    var csrf_token = "<?php echo $this->security->get_csrf_hash(); ?>";

    if (selectedValue === "0") { // If switching to Inactive
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('admin/venue/checkVenueMapping'); ?>",
            data: {
                venue_id: venueId,
                property_id: propertyId,
                "<?php echo $this->security->get_csrf_token_name(); ?>": csrf_token
            },
            dataType: 'json',
            encode: true,
        })
        .done(function(data) {
            if (data.is_mapped) {
                // Show modal
                $('#modal_header_msg').html("");
                $('#modal_header_msg').html("Alert");
                $('#modal_msg').html('This venue is already mapped with a property and active.');
                $('#add_modal').modal('show');
                // Change the dropdown back to active
                $("#is_active").val("1");
            }
        })
        .fail(function(data) {
            console.log(data);
        });
    }
});

	
});
</script>

<script type='text/javascript'>
    $(document).ready(function() {

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
