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
                <h1 class="app-page-title mb-0">Add New <?= $slug;?></h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/sports_facilities?slug='.$slug) ?>">
                                VIEW ALL <?= strtoupper($slug);?>
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

            <form class="settings-form" method="post" action="<?php echo base_url('admin/sports_facilities/submitsports_facilities'); ?>" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="slug" value="<?=$slug;?>">

                <div class="app-card-body">
                    <form class="settings-form">
                        <div class="row g-3">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Division / Workshop<span class="asterisk"> *</span></label>

                                <select name="fieldunit_id" class="form-select" id="fieldunit_id" required>
                                    <option value="" selected disabled>Select Division / Workshop</option>
                                    <?php foreach($fieldunits as $fieldunit){ ?>
                                        <option value="<?=$fieldunit['fieldunit_id']?>"><?=$fieldunit['fieldunit_name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Location<span class="asterisk"> *</span></label>
                                <select name="location_id" class="form-select" id="location_id" required>
                                    <option value="" selected disabled>Select Location</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 mb-3">
                                <label for="" class="form-label">Name<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="sports_facilities_name" placeholder="Name" required>

                            </div>

                            <div class="col-sm-12 col-md-12 mb-3">
                                <label for="" class="form-label">Address<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" id="address_autocomplete" name="address_autocomplete" placeholder="Address" required>

                            </div>
                            <div class="col-sm-12 col-md-12 mb-3">
                                <label for="" class="form-label">Geo Location</label>
                                
                                
                                <input type="hidden" name="latitude" id="latitude" value="">
                                <input type="hidden" name="longitude" id="longitude" value="">
                                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58940.9501933034!2d88.45778149168144!3d22.586231403804486!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0275350398a5b9%3A0x75e165b244323425!2sNewtown%2C%20Kolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1653471260110!5m2!1sen!2sin" width="100%" height="240" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->


                            </div>
                            <div id="map"></div>
                            <div id="infowindow-content">
                                <span id="place-name" class="title"></span><br />
                                <span id="place-address"></span>
                                </div>
                            
                            <div class="col-sm-12 col-md-12 mb-3">
                                <label for="" class="form-label">Address<span class="asterisk"> *</span></label>
                                <textarea name="address" id="address" cols="" class="form-control" rows="9" placeholder="Address" style="height:auto;"></textarea>

                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Contact No.<span class="asterisk"> *</span></label>
                                    <input type="number" class="form-control" name="contact_no" id="contact_no" placeholder="Contact No." required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Alternative Contact No</label>
                                    <input type="number" class="form-control" name="alternate_contact_no" id="alternate_contact_no" placeholder="Alternative Contact No">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">E-mail ID<span class="asterisk"> *</span></label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="E-mail ID" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Alternative E-mail ID</label>
                                    <input type="email" class="form-control" name="alternate_email" id="alternate_email" placeholder="E-mail ID">
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Available Facilities & Amenities<span class="asterisk"> *</span></label>
                                    <div class="select2-purple">
                                        <select class="select2" multiple="multiple" name="facilities_amenitis_id[]" data-placeholder="Select Available Facilities & Amenities" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
                                            <?php foreach($facilities_amenitiss as $facilities_amenitis){ ?>
                                                <option value="<?=$facilities_amenitis['facilities_amenitis_id']?>"><?=$facilities_amenitis['facilities_amenitis_name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Images<span class="asterisk"> *</span></label>
                                    <div class="wrap">
                                        <!-- <h1>File upload multiple</h1> -->

                                        <div class="file">
                                            <div class="file__input" id="file__input">
                                                <input class="file__input--file" type="file" multiple="multiple" name="sports_facilities_image_file[]" />
                                                <label class="file__input--label" for="customFile" data-text-btn="Upload">Add file:</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Available Sports Infrastructure<span class="asterisk"> *</span></label>

                                    <div class="select2-purple">
                                        <select class="select2" multiple="multiple" name="sports_infrastructure_id[]" data-placeholder="Select Available Sports" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
                                            <?php foreach($sports_infrastructures as $sports_infrastructure){ ?>
                                                <option value="<?=$sports_infrastructure['sports_infrastructure_id']?>"><?=$sports_infrastructure['sports_infrastructure_name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 mb-3">
                                <label for="" class="form-label me-3">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="FieldStatusRadio1" value="0" checked="">
                                    <label class="form-check-label" for="FieldStatusRadio1">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="FieldStatusRadio2" value="1">
                                    <label class="form-check-label" for="FieldStatusRadio2">Inactive</label>
                                </div>
                            </div>
                        </div>
                </div>

                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                            <a class="btn app-btn-danger" href="<?=base_url('admin/sports_facilities?slug='.$slug)?>">CANCEL</a>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>

<script type='text/javascript'>
 
  $(document).ready(function(){
 
        $('#fieldunit_id').change(function(){
        var fieldunit_id = $(this).val();

            $.ajax({
                url:'<?php echo base_url("admin/Sports_facilities/getlocation"); ?>',
                method: 'post',
                data: {fieldunit_id: fieldunit_id},
                dataType: 'json',
                success: function(response){
             
                $.each(response,function(index,data){
                    $('#location_id').append('<option value="'+data.location_id+'">'+data.location_name+'</option>');
                  
                });
                }
            });
        });
    });

</script>

    
    <script type="text/javascript">
        /**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
window.initMap = initMap;

function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 40.749933, lng: -73.98633 },
    zoom: 13,
    mapTypeControl: false,
  });
  
  const input = document.getElementById("address_autocomplete");
  
  const options = {
    fields: ["formatted_address", "geometry", "name"],
    strictBounds: false,
    types: ["establishment"],
  };

  

  const autocomplete = new google.maps.places.Autocomplete(input, options);

  // Bind the map's bounds (viewport) property to the autocomplete object,
  // so that the autocomplete requests use the current map bounds for the
  // bounds option in the request.
  autocomplete.bindTo("bounds", map);

  const infowindow = new google.maps.InfoWindow();
  const infowindowContent = document.getElementById("infowindow-content");

  infowindow.setContent(infowindowContent);

  const marker = new google.maps.Marker({
    map,
    anchorPoint: new google.maps.Point(0, -29),
  });

  autocomplete.addListener("place_changed", () => {
    infowindow.close();
    marker.setVisible(false);

    const place = autocomplete.getPlace();

    if (!place.geometry || !place.geometry.location) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);
    }

    marker.setPosition(place.geometry.location);
    marker.setVisible(true);
    infowindowContent.children["place-name"].textContent = place.name;
    infowindowContent.children["place-address"].textContent =
      place.formatted_address;
    infowindow.open(map, marker);
  });

}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-nrrt7qM9VkwOfkWQCG5161Y4W024yG8&callback=initMap&libraries=places"></script>
