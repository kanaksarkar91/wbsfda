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
                <h1 class="app-page-title mb-0">Add Venues -Property Mapping</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/venue/multiVenueList') ?>">
                                View All 
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
            <form class="settings-form" id="propertyVenueMappingForm" method="post" action="">
            <input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">
                <div class="app-card-body">
                    <div class="row g-3">
                        <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                            <label for="" class="form-label">Select Property<span class="asterisk"> *</span></label>
                            <select name="property_id" class="form-select select2" id="property_id" required>
                                <option value="" selected disabled>Select Property</option>
                                <?php foreach ($property_details as $property) { ?>
                                    <option value="<?= $property['property_id'] ?>"><?= $property['property_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                            <label for="" class="form-label">Select Venues<span class="asterisk"> *</span></label>
                            <select name="selected_venues[]" class="form-select select2" multiple="multiple" id="selected_venues" required>
                                <!-- Venues will be dynamically populated using jQuery -->
                            </select>
                        </div>

                    </div>
                </div>
                <input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">
                <input type="submit" class="btn app-btn-primary" value="Submit">
                <a class="btn app-btn-danger" href="">CANCEL</a>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#property_id").change(function() {
            var property_id = $(this).val();
            var csrf_token = "<?php echo $this->security->get_csrf_hash(); ?>";
            if (property_id) {
                $.ajax({
                    type: 'GET',	
                    url: "<?php echo base_url('admin/venue/getVenuesListByProperty'); ?>",
                    data:{property_id: property_id} ,
                    dataType: 'json',
                    encode: true,
                    async: false,
                    headers: {
        'X-CSRF-TOKEN': csrf_token
    },
                })
                .done(function(data){
                    var options = '';
                        $.each(data, function(index, venue) {
                            options += '<option value="' + venue.venue_id + '">' + venue.venue_name + '</option>';
                        });
                        $("#selected_venues").html(options);
                        $("#selected_venues").select2();
                
                })
                .fail(function(data){
                    // show the any errors
                    console.log(data);
                });
            } else {
                $("#selected_venues").html('');
                $("#selected_venues").select2();
            }
        });

        $("#propertyVenueMappingForm").submit(function(e) {
            e.preventDefault();
            
            var property_id = $("#property_id").val();
            var selected_venues = $("#selected_venues").val();
            var csrf_token = "<?php echo $this->security->get_csrf_hash(); ?>";
            
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('admin/venue/saveVenueMapping'); ?>",
                data: {
                    property_id: property_id,
                    selected_venues: selected_venues,
                    "<?php echo $this->security->get_csrf_token_name(); ?>": csrf_token
                },
                dataType: 'json',
                encode: true,
            })
            .done(function(data) {
                if (data.success) {
                    // Handle success, show a message or redirect
                    $("#redirect_link").attr("href", "<?php echo base_url('admin/venue/multiVenueList');?>");
                    $('#redirect_link').removeAttr('data-bs-dismiss');
                    $('#modal_header_msg').html("");
                    $('#modal_header_msg').html("Add Venue Mapping");
                    $('#modal_msg').html(data.message);
                    $('#add_modal').modal('show');
                } else {
                    // Handle failure, show an error message
                    var customCloseButton = $('#redirect_link');

                    // Check if the data-bs-dismiss attribute does not exist
                    if (!customCloseButton.attr('data-bs-dismiss')) {
                        // Add data-bs-dismiss attribute
                        customCloseButton.attr('data-bs-dismiss', 'modal');
                    }
                    $('#modal_header_msg').html("");
                    $('#modal_header_msg').html("Add Venue Mapping");
                    $('#modal_msg').html(data.message);
                    $('#add_modal').modal('show');
                    console.log(data.message);
                }
            })
            .fail(function(data) {
                // Handle any errors here
                console.log(data);
            });
        });
    });
</script>