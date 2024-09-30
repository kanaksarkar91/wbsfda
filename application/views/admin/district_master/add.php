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
        <h1 class="app-page-title mb-0">Add New District Master </h1>
      </div>
      <div class="col-auto">
        <div class="page-utilities">
          <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
            <!--//col-->
            <div class="col-auto">
              <a class="btn app-btn-secondary" href="<?= base_url('admin/district_master'); ?>">
                VIEW ALL District Master
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

      <form class="settings-form" method="post" action="<?= base_url('admin/district/submit_district'); ?>" enctype="multipart/form-data" autocomplete="off">

        <div class="app-card-body">
          <div class="row g-3">
            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
              <label for="tax_name" class="form-label">District Name <span class="asterisk"> *</span></label>
              <input type="text" class="form-control" name="district_name" placeholder="District Name" required>

            </div>
            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
              <label for="tax_percentage" class="form-label">District Code <span class="asterisk"> *</span></label>
              <input type="text" class="form-control" name="district_code" placeholder="District Code" required>
            </div>

            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
              <label for="cgst_percentage" class="form-label">State Name <span class="asterisk"> *</span></label>
              <select class="form-select" name="state_id" required>
                <option value="">Select State Name</option>
                <?php foreach ($states as $state) { ?>
                  <option value="<?= $state['state_id'] ?>"><?= $state['state_name'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
              <label for="sgst_percentage" class="form-label">Image</label>
              <input type="file" class="form-control" name="district_image" placeholder="Image">
            </div>

            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                <label for="" class="form-label">Status<span class="asterisk"> *</span></label>
                <select name="is_active" class="form-select" id="is_active" required>
                    <option value="">Select Status</option>
                    <option value="1" selected>Active</option>
                    <option value="0" >Inactive</option>
                </select>
            </div>

          </div>

        </div>

        <button type="submit" class="btn app-btn-primary">SUBMIT</button>
        <a class="btn app-btn-danger" href="<?= base_url('admin/district'); ?>">CANCEL</a>
      </form>
    </div>
    <!--//app-card-body-->

  </div>
</div>

<script type='text/javascript'>
  $(document).ready(function() {

    $('#fieldunit_id').change(function() {
      var fieldunit_id = $(this).val();

      $.ajax({
        url: '<?= base_url("admin/Sports_facilities/getlocation"); ?>',
        method: 'post',
        data: {
          fieldunit_id: fieldunit_id
        },
        dataType: 'json',
        success: function(response) {

          $.each(response, function(index, data) {
            $('#location_id').append('<option value="' + data.location_id + '">' + data.location_name + '</option>');

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
      center: {
        lat: 40.749933,
        lng: -73.98633
      },
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