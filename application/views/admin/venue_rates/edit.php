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
                <h1 class="app-page-title mb-0">Edit Rate </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/rates') ?>">
                                VIEW ALL Rate
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
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="property_id" class="form-label">Property<span class="asterisk"> *</span></label>
                            <select name="property_id" class="form-select select2" id="" required onchange="populate_venue(this.value)">
                                <option value="" selected disabled>Select Property</option>
                                <?php
                                    if(!empty($properties)){
                                        foreach($properties as $propertie){
                                            ?>
                                            <?php if($propertie['is_venue'] == '1'){ ?>
                                                <option value="<?= $propertie['property_id'] ?>" 
                                                    <?= $propertie['property_id'] == $rate[0]->property_id ? "selected" : "" ?>
                                                ><?= $propertie['property_name'] ?></option>
                                            <?php } ?>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="venue_id" class="form-label">Venue<span class="asterisk"> *</span></label>
                            <select name="venue_id" class="form-select select2" id="venue_id" required>
                                <option value="" selected disabled>Select Venue </option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6  d-none">
                            <label for="rate_category_id" class="form-label">Rate Category <span class="asterisk"> *</span></label>
                            <select name="rate_category_id" class="form-select" id="" required>
                                <!-- <option value="" selected disabled>Select Rate Category </option> -->
                                <?php
                                    if(!empty($rate_categories)){
                                        foreach($rate_categories as $rate_categorie){
                                            ?>
                                            <option value="<?= $rate_categorie->rate_category_id ?>" 
                                                <?= $rate_categorie->rate_category_id == $rate[0]->plan_id ? "selected" : "" ?>
                                            ><?= $rate_categorie->rate_category_code ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="base_rate" class="form-label">Basic Rack Rate  <span class="asterisk"> *</span></label>
                            <input type="number" min="0" step=".01" class="form-control" name="base_rate" id="base_rate" onkeyup="apply_base_rate(this.value);" value="<?= round($rate[0]->base_price) ?>" placeholder="Basic Rack Rater" required>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6  d-none">
                            <label for="food_rate" class="form-label">Charge per person<span class="asterisk"> *</span></label>
                            <input type="number" min="0" step=".01" class="form-control" name="food_rate" id="food_rate" onkeyup="apply_food_rate(this.value);" value="<?= round($rate[0]->food_rate) ?>" placeholder="Charge per person" required>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6  d-none">
                            <label for="child_rate" class="form-label">Charge per Child<span class="asterisk"> *</span></label>
                            <input type="number" min="0" step=".01" class="form-control" name="child_rate" id="child_rate" onkeyup="apply_child_rate, 2(this.value);" value="<?= round($rate[0]->child_rate) ?>" placeholder="Charge per Child" required>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="start_date" class="form-label">Effective Start Date <span class="asterisk">*</span></label>
                            <input type="date" class="form-control" name="start_date" id="start_date" value="<?= $rate[0]->eff_start_date ?>" placeholder="Effective Start Date" required>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="end_date" class="form-label">Effective End Date<span class="asterisk"> </span></label>
                            <input type="date" class="form-control" name="end_date" value="<?= $rate[0]->eff_end_date ?>" placeholder="Effective End Date">
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6">
                                <label class="form-label">Is Hourly Booking Applicable?<span class="asterisk"> *</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hourly_booking_applicable" id="hourly_booking_yes" value="yes" <?= ($rate[0]->is_hourly_booking == 1) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="hourly_booking_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hourly_booking_applicable" id="hourly_booking_no" value="no" <?= ($rate[0]->is_hourly_booking == 0) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="hourly_booking_no">No</label>
                                </div>
                            </div>
                            <div id="hourly_booking_panel" style="display: <?= ($rate[0]->is_hourly_booking == 1) ? 'block' : 'none'; ?>">
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="form-label">Number of Hours<span class="asterisk"> *</span></label>
                                    <select name="number_of_hours" class="form-select select2" id="number_of_hours">
                                        <option value="" <?= ($rate[0]->number_of_hours=== 0) ? 'selected' : ''; ?>>--Select Number of Hours--</option>
                                        <?php foreach ($hourly_options as $option) { ?>
                                            <option value="<?= $option['no_of_hours']; ?>" <?= ($rate[0]->booking_hours === $option['no_of_hours']) ? 'selected' : ''; ?>><?= $option['no_of_hours']; ?> Hours</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <div class="col-md-12">
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
                                                <input type="number" min="0" step=".01" name="price[]" id="" value="<?= round($rate[0]->mon_price, 2) ?>" class="form-control price" >   
                                            </td>
                                            <td id="tuesday" align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" value="<?= round($rate[0]->tue_price, 2) ?>" class="form-control price">   
                                            </td>
                                            <td id="wednesday" align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" value="<?= round($rate[0]->wed_price, 2) ?>" class="form-control price">   
                                            </td>
                                            <td id="thursday" align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" value="<?= round($rate[0]->thu_price, 2) ?>" class="form-control price">   
                                            </td>
                                            <td id="friday" align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" value="<?= round($rate[0]->fri_price, 2) ?>" class="form-control price">   
                                            </td>
                                            <td id="saturday" align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" value="<?= round($rate[0]->sat_price, 2) ?>" class="form-control price">   
                                            </td>
                                            <td id="sunday" align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" value="<?= round($rate[0]->sun_price, 2) ?>" class="form-control price">   
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                                            <div class="col-12">
                                                <button type="submit" id="btn-form-submit" class="btn app-btn-primary">Update</button>
                                                <a class="btn app-btn-danger" id="reset-rate-form" href="<?= base_url('admin/venue_rates/edit/'.$rate[0]->rate_id) ?>">CANCEL</a>
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
    const venue_id = <?= $rate[0]->single_venue_id?>;
    const property_id = <?= $rate[0]->property_id?>;
    $(document).ready(function(){
        $('#add-rate-form').submit(function(e){
            e.preventDefault();
            var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";
            var formSerializedData = $(this).serialize(); // Serialize form data
            $('#btn-form-submit').prop('disabled', true);
            $.ajax({
                url:'<?= base_url("admin/venue_rates/updateRateData/".$rate[0]->rate_id) ?>',
                method: 'POST',
                //data: $(this).serialize(),
                data: {
                    formSerializedData: formSerializedData,
                    "<?= $this->security->get_csrf_token_name(); ?>": csrf_token
                },
                dataType: 'json',
                success: function(response){
                    $('#btn-form-submit').prop('disabled', false);
                    if(response.success){
                        // ajax_status = true;
                        // $('#btn-form-submit').before('<p class="result-msg text-success">'+response.message+'</p>');
                        window.location.href = "<?= base_url('admin/venue_rates') ?>";
                    }else{
                        $('#btn-form-submit').before('<p class="result-msg text-danger">'+response.message+'</p>');
                    }
                },
                complete: function(){
                    document.getElementById("container-xl").scrollTop;
                    setTimeout(function(){
                        $('.result-msg').remove();
                    }, 5000);
                },
                error: function(er){
                    $('#btn-form-submit').before('<p class="result-msg text-danger">'+er.message+'</p>');
                }
            });
        })
        if(venue_id){
            populate_venue(property_id);
        }
    });

    function populate_venue(property_id){
        var result='';
        $.ajax({
            type: 'GET',	
            url: "<?= base_url('admin/venue/getVenueByProperty'); ?>",
            data: {
                'property_id':property_id
            },
            dataType: 'json',
            encode: true,
            async: false
        })
        .done(function(data){
            if(data.status){
                result +='<option value="">Select Venue</option>';
                $.each(data.list,function(key,value){
                    var selected_txt= venue_id == value.venue_id ? 'selected' : '';
                    
                    result +='<option value="'+value.venue_id+'" '+selected_txt+'>'+value.venue_name+'</option>';
                });
            }
            else{
                result +='<option value="">No Unit selected</option>'
            }
            $("#venue_id").html(result);
        
        })
        .fail(function(data){
            // show the any errors
            console.log(data);
        });
    }
    
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