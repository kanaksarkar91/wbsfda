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
			<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
                <div class="app-card-body mb-3">
                    <div class="row g-3">
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="property_id" class="form-label">Property<span class="asterisk"> *</span></label>
                            <select name="property_id" class="form-select select2" id="" required onchange="populate_accommodation(this.value)">
                                <option value="" selected disabled>Select Property</option>
                                <?php
                                    if(!empty($properties)){
                                        foreach($properties as $propertie){
                                            ?>
                                            <option value="<?= $propertie['property_id'] ?>" 
                                                <?= $propertie['property_id'] == $rate[0]->property_id ? "selected" : "" ?>
                                            ><?= $propertie['property_name'] ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="accommodation_id" class="form-label">Accommodation<span class="asterisk"> *</span></label>
                            <select name="accommodation_id" class="form-select select2" id="accommodation_id" required>
                                <option value="" selected disabled>Select Accommodation </option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="base_rate" class="form-label">Basic Rack Rate  <span class="asterisk"> *</span></label>
                            <input type="number" min="0" step=".01" class="form-control" name="base_rate" id="base_rate" onkeyup="apply_base_rate(this.value);" value="<?= round($rate[0]->base_price) ?>" placeholder="Basic Rack Rater" required>
                        </div>
						<!--<div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="extra_bed" class="form-label">Aditional Pax (in Rs.)<span class="asterisk"> </span></label>
                            <input type="number" min="0" step=".01" class="form-control" name="extra_bed" id="extra_bed" onkeyup="apply_extra_bed(this.value);" value="<?= round($rate[0]->extra_bed) ?>" placeholder="Aditional Pax">
                        </div>-->
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="start_date" class="form-label">Effective Start Date <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="start_date" id="start_date" value="<?= date('d-m-Y', strtotime($rate[0]->eff_start_date)); ?>" placeholder="Effective Start Date" readonly="" required>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="end_date" class="form-label">Effective End Date<span class="asterisk"> </span></label>
                            <input type="text" class="form-control" name="end_date" id="end_date" value="<?= date('d-m-Y', strtotime($rate[0]->eff_end_date)); ?>" placeholder="Effective End Date" readonly="">
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive rate-table-sec">
                                <table class="table table-striped table-hover mb-0 text-left" id="">
                                    <thead>
                                        <tr>
                                            <th>Days</th>
                                            <!-- <th>Add/Subtract </th>
                                            <th>Rate(%)</th> -->
                                            <th>Price</th>
                                            <!--<th>Aditional Pax (in Rs.)</th>-->
                                            <!-- <th>Charge per Person</th>
                                            <th>Charge per Child</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="monday">    
                                            <td align="center">Monday</td>  
                                            <!-- <td align="center">   
                                                <select name="method[]" id="monday_method" data-ref="monday" class="form-control method monday-method">     
                                                    <option value="">Select Method</option>     
                                                    <option value="A" <?= $rate[0]->mon_method == "A" ? "selected" : "" ?>>
                                                    Add</option>      
                                                    <option value="S" <?= $rate[0]->mon_method == "S" ? "selected" : "" ?>>
                                                    Subtract</option>   
                                                </select> 
                                            </td>   
                                            <td align="center">     
                                                <input type="number" min="0" step=".01" name="percentage[]" id="" value="<?= round($rate[0]->mon_per) ?>" class="form-control percentage" > 
                                            </td> -->
                                            <td align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" value="<?= round($rate[0]->mon_price, 2) ?>" class="form-control price" >   
                                            </td>   
                                            <!--<td align="center">   
                                                <input type="number" min="0" step=".01" name="ex_bed[]" id="" value="<?= round($rate[0]->mon_ex_price, 2) ?>" class="form-control extra_bed" > 
                                            </td>-->   
                                            <!-- <td align="center">   
                                                <input type="number" min="0" step=".01" name="per_persion[]" id="" value="<?= round($rate[0]->mon_food_rate, 2) ?>" class="form-control per_persion" >   
                                            </td>   
                                            <td align="center">   
                                                <input type="number" min="0" step=".01" name="per_child[]" id="" value="<?= round($rate[0]->mon_child_rate, 2) ?>" class="form-control per_child" >    
                                            </td> -->
                                        </tr>
                                        <tr id="tuesday">    
                                            <td align="center">Tuesday</td>  
                                            <!-- <td align="center">   
                                                <select name="method[]" id="tuesday_method" data-ref="tuesday" class="form-control method tuesday-method">     
                                                    <option value="">Select Method</option>     
                                                    <option value="A" <?= $rate[0]->tue_method == "A" ? "selected" : "" ?>>
                                                    Add</option>      
                                                    <option value="S" <?= $rate[0]->tue_method == "S" ? "selected" : "" ?>>
                                                    Subtract</option> 
                                                </select> 
                                            </td>   
                                            <td align="center">     
                                                <input type="number" min="0" step=".01" name="percentage[]" id="" value="<?= round($rate[0]->tue_per) ?>" class="form-control percentage" > 
                                            </td> -->
                                            <td align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" value="<?= round($rate[0]->tue_price, 2) ?>" class="form-control price">   
                                            </td>   
                                            <!--<td align="center">   
                                                <input type="number" min="0" step=".01" name="ex_bed[]" id="" value="<?= round($rate[0]->tue_ex_price, 2) ?>" class="form-control extra_bed" > 
                                            </td>-->   
                                            <!-- <td align="center">   
                                                <input type="number" min="0" step=".01" name="per_persion[]" id="" value="<?= round($rate[0]->tue_food_rate, 2) ?>" class="form-control per_persion" >   
                                            </td>   
                                            <td align="center">   
                                                <input type="number" min="0" step=".01" name="per_child[]" id="" value="<?= round($rate[0]->tue_child_rate, 2) ?>" class="form-control per_child" >    
                                            </td> -->
                                        </tr>
                                        <tr id="wednesday">    
                                            <td align="center">Wednesday</td>  
                                            <!-- <td align="center">   
                                                <select name="method[]" id="wednesday_method" data-ref="wednesday" class="form-control method wednesday-method">     
                                                    <option value="">Select Method</option>     
                                                    <option value="A" <?= $rate[0]->wed_method == "A" ? "selected" : "" ?>>
                                                    Add</option>      
                                                    <option value="S" <?= $rate[0]->wed_method == "S" ? "selected" : "" ?>>
                                                    Subtract</option> 
                                                </select> 
                                            </td>   
                                            <td align="center">     
                                                <input type="number" min="0" step=".01" name="percentage[]" id="" value="<?= round($rate[0]->wed_per) ?>" class="form-control percentage" > 
                                            </td> -->
                                            <td align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" value="<?= round($rate[0]->wed_price, 2) ?>" class="form-control price">   
                                            </td>   
                                            <!--<td align="center">   
                                                <input type="number" min="0" step=".01" name="ex_bed[]" id="" value="<?= round($rate[0]->wed_ex_price, 2) ?>" class="form-control extra_bed" > 
                                            </td>-->   
                                            <!-- <td align="center">   
                                                <input type="number" min="0" step=".01" name="per_persion[]" id="" value="<?= round($rate[0]->wed_food_rate, 2) ?>" class="form-control per_persion" >   
                                            </td>   
                                            <td align="center">   
                                                <input type="number" min="0" step=".01" name="per_child[]" id="" value="<?= round($rate[0]->wed_child_rate, 2) ?>" class="form-control per_child" >    
                                            </td> -->
                                        </tr>
                                        <tr id="thursday">    
                                            <td align="center">Thursday</td>  
                                            <!-- <td align="center">   
                                                <select name="method[]" id="thursday_method" data-ref="thursday" class="form-control method thursday-method">     
                                                    <option value="">Select Method</option>     
                                                    <option value="A" <?= $rate[0]->thu_method == "A" ? "selected" : "" ?>>
                                                    Add</option>      
                                                    <option value="S" <?= $rate[0]->thu_method == "S" ? "selected" : "" ?>>
                                                    Subtract</option> 
                                                </select> 
                                            </td>   
                                            <td align="center">     
                                                <input type="number" min="0" step=".01" name="percentage[]" id="" value="<?= round($rate[0]->thu_per) ?>" class="form-control percentage" > 
                                            </td> -->
                                            <td align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" value="<?= round($rate[0]->thu_price, 2) ?>" class="form-control price">   
                                            </td>   
                                            <!--<td align="center">   
                                                <input type="number" min="0" step=".01" name="ex_bed[]" id="" value="<?= round($rate[0]->thu_ex_price, 2) ?>" class="form-control extra_bed" > 
                                            </td>-->   
                                            <!-- <td align="center">   
                                                <input type="number" min="0" step=".01" name="per_persion[]" id="" value="<?= round($rate[0]->thu_food_rate, 2) ?>" class="form-control per_persion" >   
                                            </td>   
                                            <td align="center">   
                                                <input type="number" min="0" step=".01" name="per_child[]" id="" value="<?= round($rate[0]->thu_child_rate, 2) ?>" class="form-control per_child" >    
                                            </td> -->
                                        </tr>
                                        <tr id="friday">    
                                            <td align="center">Friday</td>  
                                            <!-- <td align="center">   
                                                <select name="method[]" id="friday_method" data-ref="friday" class="form-control method friday-method">     
                                                    <option value="">Select Method</option>     
                                                    <option value="A" <?= $rate[0]->fri_method == "A" ? "selected" : "" ?>>
                                                    Add</option>      
                                                    <option value="S" <?= $rate[0]->fri_method == "S" ? "selected" : "" ?>>
                                                    Subtract</option> 
                                                </select> 
                                            </td>   
                                            <td align="center">     
                                                <input type="number" min="0" step=".01" name="percentage[]" id="" value="<?= round($rate[0]->fri_per) ?>" class="form-control percentage" > 
                                            </td> -->
                                            <td align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" value="<?= round($rate[0]->fri_price, 2) ?>" class="form-control price">   
                                            </td>   
                                            <!--<td align="center">   
                                                <input type="number" min="0" step=".01" name="ex_bed[]" id="" value="<?= round($rate[0]->fri_ex_price, 2) ?>" class="form-control extra_bed" > 
                                            </td>-->   
                                            <!-- <td align="center">   
                                                <input type="number" min="0" step=".01" name="per_persion[]" id="" value="<?= round($rate[0]->fri_food_rate, 2) ?>" class="form-control per_persion" >   
                                            </td>   
                                            <td align="center">   
                                                <input type="number" min="0" step=".01" name="per_child[]" id="" value="<?= round($rate[0]->fri_child_rate, 2) ?>"class="form-control per_child" >    
                                            </td> -->
                                        </tr>
                                        <tr id="saturday">    
                                            <td align="center">Saturday</td>  
                                            <!-- <td align="center">   
                                                <select name="method[]" id="saturday_method" data-ref="saturday" class="form-control method saturday-method">     
                                                    <option value="">Select Method</option>     
                                                    <option value="A" <?= $rate[0]->sat_method == "A" ? "selected" : "" ?>>
                                                    Add</option>      
                                                    <option value="S" <?= $rate[0]->sat_method == "S" ? "selected" : "" ?>>
                                                    Subtract</option> 
                                                </select> 
                                            </td>   
                                            <td align="center">     
                                                <input type="number" min="0" step=".01" name="percentage[]" id="" value="<?= round($rate[0]->sat_per) ?>" class="form-control percentage" > 
                                            </td>-->
                                            <td align="center">   
                                                <input type="number" min="0" step=".01" name="price[]" id="" value="<?= round($rate[0]->sat_price, 2) ?>" class="form-control price">   
                                            </td>   
                                            <!--<td align="center">   
                                                <input type="number" min="0" step=".01" name="ex_bed[]" id="" value="<?= round($rate[0]->sat_ex_price, 2) ?>" class="form-control extra_bed" > 
                                            </td>-->   
                                            <!-- <td align="center">   
                                                <input type="number" min="0" step=".01" name="per_persion[]" id="" value="<?= round($rate[0]->sat_food_rate, 2) ?>" class="form-control per_persion" >   
                                            </td>   
                                            <td align="center">   
                                                <input type="number" min="0" step=".01" name="per_child[]" id="" value="<?= round($rate[0]->sat_child_rate, 2) ?>" class="form-control per_child" >    
                                            </td> -->
                                        </tr>
                                        <tr id="sunday">    
                                            <td align="center">Sunday</td>  
                                            <!-- <td align="center">   
                                                <select name="method[]" id="sunday_method" data-ref="sunday" class="form-control method sunday-method">     
                                                    <option value="">Select Method</option>     
                                                    <option value="A" <?= $rate[0]->sun_method == "A" ? "selected" : "" ?>>
                                                    Add</option>      
                                                    <option value="S" <?= $rate[0]->sun_method == "S" ? "selected" : "" ?>>
                                                    Subtract</option> 
                                                </select> 
                                            </td>   
                                            <td align="center">     
                                                <input type="number" min="0" step=".01" name="percentage[]" id="" value="<?= round($rate[0]->sun_per) ?>" class="form-control percentage" > 
                                            </td>    -->
                                            <td align="center">
                                                <input type="number" min="0" step=".01" name="price[]" id="" value="<?= round($rate[0]->sun_price, 2) ?>" class="form-control price">   
                                            </td>   
                                            <!--<td align="center">   
                                                <input type="number" min="0" step=".01" name="ex_bed[]" id="" value="<?= round($rate[0]->sun_ex_price, 2) ?>" class="form-control extra_bed" > 
                                            </td>-->   
                                            <!-- <td align="center">   
                                                <input type="number" min="0" step=".01" name="per_persion[]" id="" value="<?= round($rate[0]->sun_food_rate, 2) ?>" class="form-control per_persion" >   
                                            </td>   
                                            <td align="center">   
                                                <input type="number" min="0" step=".01" name="per_child[]" id="" value="<?= round($rate[0]->sun_child_rate, 2) ?>" class="form-control per_child" >    
                                            </td> -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" id="btn-form-submit" class="btn app-btn-primary">Update</button>
                <a class="btn app-btn-danger" id="reset-rate-form" href="<?= base_url('admin/rates/edit/'.$rate[0]->rate_id) ?>">CANCEL</a>
            </form>
        </div>
        <!--//app-card-body-->
    </div>
</div>
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script type='text/javascript'>
    var ajax_status = false;
    const accommodation_id = <?= $rate[0]->accommodation_id?>;
    const property_id = <?= $rate[0]->property_id?>;
    $(document).ready(function(){
        
		$(function() {
			$('#start_date').datepicker({ 
				//maxDate: new Date,
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
        		changeYear: true,
				minDate: new Date()
				
			});
			
			var dateToday = new Date();
			$('#end_date').datepicker({ 
				/*maxDate: new Date,*/
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
        		changeYear: true,
				yearRange: dateToday.getFullYear()+':' + '9999'
			});
	
		});
		
		$('#add-rate-form').submit(function(e){
            e.preventDefault();
            $('#btn-form-submit').prop('disabled', true);
            $.ajax({
                url:'<?= base_url("admin/Rates/updateRateData/".$rate[0]->rate_id) ?>',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response){
                    $('#btn-form-submit').prop('disabled', false);
                    if(response.success){
                        // ajax_status = true;
                        // $('#btn-form-submit').before('<p class="result-msg text-success">'+response.message+'</p>');
                        window.location.href = "<?= base_url('admin/rates') ?>";
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
                    $('#btn-form-submit').before('<p class="result-msg text-danger">'+response.message+'</p>');
                }
            });
        })
        if(accommodation_id){
            populate_accommodation(property_id);
        }
    });

    function populate_accommodation(property_id){
        var result='';
        $.ajax({
            type: 'GET',	
            url: "<?= base_url('admin/accommodation/getAccommodationByProperty'); ?>",
            data: {
                'property_id':property_id
            },
            dataType: 'json',
            encode: true,
            async: false
        })
        .done(function(data){
            if(data.status){
                result +='<option value="">Select Accommodation</option>';
                $.each(data.list,function(key,value){
                    var selected_txt= accommodation_id == value.accommodation_id ? 'selected' : '';
                    
                    result +='<option value="'+value.accommodation_id+'" '+selected_txt+'>'+value.accommodation_name+'</option>';
                });
            }
            else{
                result +='<option value="">No Unit selected</option>'
            }
            $("#accommodation_id").html(result);
        
        })
        .fail(function(data){
            // show the any errors
            console.log(data);
        });
    }
    
    function apply_base_rate(value){
        $('.price').each(function(index, element) {
            var day = $(this).closest("tr").attr('id');
            // calculate_rate(day);
            $('#' + day + ' .price').val(value);
        });
    }

    function apply_extra_bed(value){
        $('.extra_bed').each(function(index, element) {
            var day = $(this).closest("tr").attr('id');
            // cal_extra_bed(day);
            $('#' + day + ' .extra_bed').val(value);
        });
    }

    function apply_food_rate(value){
        $('.per_persion').each(function(index, element) {
            var day = $(this).closest("tr").attr('id');
            call_food_rate(day);
        });
    }

    function apply_child_rate(value){
        $('.per_child').each(function(index, element) {
            var day = $(this).closest("tr").attr('id');
            call_child_rate, 2(day);
        });
    }

    $('.method').change(function (){
        var day = $(this).closest("tr").attr('id');
        calculate_rate(day);
        cal_extra_bed(day);
        call_food_rate(day);
        call_child_rate, 2(day);
    });
    $('.percentage').keyup(function (){
        var day = $(this).closest("tr").attr('id');
        calculate_rate(day);
        cal_extra_bed(day);
        call_food_rate(day);
        call_child_rate, 2(day);
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

    function cal_extra_bed(day){
        var method = $('#' + day + '_method').val();
        var extra_bed = $('#extra_bed').val();
        
        if(extra_bed != '') {
            if(method != ''){
                var rate_val = $('#' + day + ' .percentage').val();
                if(rate_val != ''){
                    if(method == 'A'){
                        var modifi_price = ((parseFloat(rate_val)/100)*parseFloat(extra_bed))+parseFloat(extra_bed);
                        $('#' + day + ' .extra_bed').val(modifi_price);
                    }
                    else{
                        var modifi_price = parseFloat(extra_bed)-((parseFloat(rate_val)/100)*parseFloat(extra_bed));
                        $('#' + day + ' .extra_bed').val(modifi_price);
                    }
                }
                else{
                    $('#' + day + ' .extra_bed').val(extra_bed);
                }
            }
            else{
                $('#' + day + ' .extra_bed').val(extra_bed);
            }
        }else{
            $('#' + day + ' .extra_bed').val(extra_bed);
        }
    }

    function call_food_rate(day){
        var method = $('#' + day + '_method').val();
        var food_rate = $('#food_rate').val();
        
        if(food_rate != '') {
            if(method != ''){
                var rate_val = $('#' + day + ' .percentage').val();
                if(rate_val != ''){
                    if(method == 'A'){
                        var modifi_price = ((parseFloat(rate_val)/100)*parseFloat(food_rate))+parseFloat(food_rate);
                        $('#' + day + ' .per_persion').val(modifi_price);
                    }
                    else{
                        var modifi_price = parseFloat(food_rate)-((parseFloat(rate_val)/100)*parseFloat(food_rate));
                        $('#' + day + ' .per_persion').val(modifi_price);
                    }
                }
                else{
                    $('#' + day + ' .per_persion').val(food_rate);
                }
            }
            else{
                $('#' + day + ' .per_persion').val(food_rate);
            }
        }else{
            $('#' + day + ' .per_persion').val(food_rate);
        }
    }

    function call_child_rate(day){
        var method = $('#' + day + '_method').val();
        var child_rate = $('#child_rate').val();
        
        if(child_rate != '') {
            if(method != ''){
                var rate_val = $('#' + day + ' .percentage').val();
                if(rate_val != ''){
                    if(method == 'A'){
                        var modifi_price = ((parseFloat(rate_val)/100)*parseFloat(child_rate))+parseFloat(child_rate);
                        $('#' + day + ' .per_child').val(modifi_price);
                    }
                    else{
                        var modifi_price = parseFloat(child_rate)-((parseFloat(rate_val)/100)*parseFloat(child_rate));
                        $('#' + day + ' .per_child').val(modifi_price);
                    }
                }
                else{
                    $('#' + day + ' .per_child').val(child_rate);
                }
            }
            else{
                $('#' + day + ' .per_child').val(child_rate);
            }
        }else{
            $('#' + day + ' .per_child').val(child_rate);
        }
    }

</script>