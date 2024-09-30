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

    .rate-table-sec .table > thead > tr > th {
        color: #fff;
        background: #800000;
    }
    .result-msg{
        font-weight: 600;
        font-size: 18px;
    }
</style>
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl" id="container-xl">
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Add New Rate </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/venue_rates/multi_venue') ?>">
                                View All Rate
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
            <form class="settings-form" id="add-rate-form" method="post" action="" enctype="multipart/form-data" autocomplete="off">
    
            <div class="app-card-body mb-3">
                    <div class="row g-3">
                         <div class="col-lg-6 col-sm-12 col-md-6">
                            <label for="" class="form-label">Select Property<span class="asterisk"> *</span></label>
                            <select name="property_id" class="form-select select2" id="property_id" required>
                                <option value="" selected disabled>Select Property</option>
                                <?php foreach ($properties as $property) { ?>
                                    <?php if($property['is_venue'] == '1'){ ?>
                                        <option value="<?= $property['property_id'] ?>"><?= $property['property_name'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6">
                            <label for="" class="form-label">Select Venues<span class="asterisk"> *</span></label>
                            <select name="selected_venues[]" class="form-select select2" multiple="multiple" id="selected_venues" required>
                                <!-- Venues will be dynamically populated using jQuery -->
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6  d-none">
                            <label for="rate_category_id" class="form-label">Rate Category <span class="asterisk"> *</span></label>
                            <select name="rate_category_id" class="form-select" id="" required>
                                <!-- <option value="" selected disabled>Select Rate Category </option> -->
                                <?php
                                    if(!empty($rate_categories)){
                                        foreach($rate_categories as $index => $rate_categorie){
                                            ?>
                                            <option value="<?= $rate_categorie->rate_category_id ?>" <?= $index==0 ? 'selected' : '' ?>>
                                                <?= $rate_categorie->rate_category_code ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="base_rate" class="form-label">Basic Rack Rate (in Rs.)  <span class="asterisk"> *</span></label>
                            <input type="number" min="0" step=".01" class="form-control" name="base_rate" id="base_rate" onkeyup="apply_base_rate(this.value);" placeholder="Basic Rack Rate" required>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6  d-none">
                            <label for="food_rate" class="form-label">Charge per person<span class="asterisk"> *</span></label>
                            <input type="number" min="0" step=".01" class="form-control" value="0" name="food_rate" id="food_rate" onkeyup="apply_food_rate(this.value);" placeholder="Charge per person" required>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6  d-none">
                            <label for="child_rate" class="form-label">Charge per Child<span class="asterisk"> *</span></label>
                            <input type="number" min="0" step=".01" class="form-control" value="0" name="child_rate" id="child_rate" onkeyup="apply_child_rate(this.value);" placeholder="Charge per Child" required>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="start_date" class="form-label">Effective Start Date <span class="asterisk">*</span></label>
                            <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Effective Start Date" required>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="end_date" class="form-label">Effective End Date<span class="asterisk"> </span></label>
                            <input type="date" class="form-control" name="end_date" placeholder="Effective End Date">
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6">
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
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <label class="form-label">Number of Hours<span class="asterisk"> *</span></label>
                                <select name="number_of_hours" class="form-select select2" id="number_of_hours">
                                    <option value="" <?= ($venue['number_of_hours'] === 0) ? 'selected' : ''; ?>>--Select Number of Hours--</option>
                                    <?php foreach ($hourly_options as $option) { ?>
                                        <option value="<?= $option['no_of_hours']; ?>" <?= ($venue['booking_hours'] === $option['no_of_hours']) ? 'selected' : ''; ?>><?= $option['no_of_hours']; ?> Hours in a Day</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mt-0">
                            <hr class="ex_bold">
                            <p>Do you want different rate for different days in a week?<br> If yes, then over write the rate for the specific day(s) in the below form.</p>
                            <div class="table-responsive rate-table-sec">
                                <table class="table table-striped table-hover mb-0 text-left" id="">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Days</th>
                                            <td align="center">Monday</td>
                                            <td align="center">Tuesday</td>
                                            <td align="center">Wednesday</td>
                                            <td align="center">Thursday</td>
                                            <td align="center">Friday</td>
                                            <td align="center">Saturday</td>
                                            <td align="center">Sunday</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-center" style="min-width:200px;">Basic Rack Rate (in Rs.)</th>
                                            <td id="monday" align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" class="form-control price" >   
                                            </td>
                                            <td id="tuesday" align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" class="form-control price">   
                                            </td>
                                            <td id="wednesday" align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" class="form-control price">   
                                            </td>
                                            <td id="thursday" align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" class="form-control price">   
                                            </td>
                                            <td id="friday" align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" class="form-control price">   
                                            </td>
                                            <td id="saturday" align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" class="form-control price">   
                                            </td>
                                            <td id="sunday" align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" class="form-control price">   
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" id="btn-form-submit" class="btn app-btn-primary">SUBMIT</button>
                            <a class="btn app-btn-danger" id="reset-rate-form" href="<?= base_url('admin/venue_rates/multi_add') ?>">CANCEL</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--//app-card-body-->
    </div>
</div>
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script type='text/javascript'>
    var ajax_status = false;
    $(document).ready(function(){
        $('#add-rate-form').submit(function(e){
            e.preventDefault();
            var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";
            var formSerializedData = $(this).serialize(); // Serialize form data
            // Add the CSRF token to the serialized form data
            //formSerializedData += "&" + "<?= $this->security->get_csrf_token_name(); ?>" + "=" + csrf_token;


            $('#btn-form-submit').prop('disabled', true);

              // Debug: Output form data to console
        console.log("Form Data:", formSerializedData);
            $.ajax({
                url:'<?= base_url("admin/venue_rates/submitRateMultiVenueData") ?>',
                method: 'POST',
                //data: formSerializedData,
                data: {
                    formSerializedData: formSerializedData,
                    "<?= $this->security->get_csrf_token_name(); ?>": csrf_token
                },
                dataType: 'json',
                encode: true,
                    async: false,
                success: function(response){
                    $('#btn-form-submit').prop('disabled', false);
                    // Debug: Output raw response to console
                console.log("Raw Response:", response);
                    if(response.success){
                        // $('#btn-form-submit').before('<p class="result-msg text-success">'+response.message+'</p>');
                        window.location.href = "<?= base_url('admin/venue_rates/multi_venue') ?>";
                    }else{
                        $('#btn-form-submit').before('<p class="result-msg text-danger">'+response.message+'</p>');
                    }
                },
                complete: function(){
                    setTimeout(function(){
                        $('.result-msg').remove();
                    }, 5000);
                },
                error: function(er){
                    $('#btn-form-submit').before('<p class="result-msg text-danger">'+er.message+'</p>');
                }
            });
        })
    });

    $("#property_id").change(function() {
            var property_id = $(this).val();
            var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";
            if (property_id) {
                $.ajax({
                    type: 'GET',	
                    url: "<?= base_url('admin/venue/getVenuesListByProperty'); ?>",
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

    
    function apply_base_rate(value){
        $('.price').each(function(index, element) {
            var day = $(this).closest("td").attr('id');
            // calculate_rate(day);
            $('#' + day + ' .price').val(value);
        });
    }

   
    $('.method').change(function (){
        var day = $(this).closest("tr").attr('id');
        calculate_rate(day);
     
    });
    $('.percentage').keyup(function (){
        var day = $(this).closest("tr").attr('id');
        calculate_rate(day);
        
    });

    function calculate_rate(day){
        var method = $('#' + day + '_method').val();
        var base_price = $('#base_rate').val();
        if(base_price != '') {
            if(method != ''){
                var rate_val = $('#' + day + ' .percentage').val();
                if(rate_val != ''){
                    if(method == 'A'){
                        var modifi_price= ((parseFloat(rate_val)/100)*parseFloat(base_price))+parseFloat(base_price);
                        $('#' + day + ' .price').val(modifi_price);
                    }
                    else{
                        var modifi_price= parseFloat(base_price)-((parseFloat(rate_val)/100)*parseFloat(base_price));
                        $('#' + day + ' .price').val(modifi_price);
                    }
                }
                else{
                    $('#' + day + ' .price').val(base_price);
                }
            }
            else{
                $('#' + day + ' .price').val(base_price);
            }
        }else{
            $('#' + day + ' .price').val('');
        }
    }

   
</script>