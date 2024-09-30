<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
    .app-nav .nav-link,
        .app-btn-primary {
            text-transform: uppercase;
        }
        /* Style the tab */
        
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }
        /* Style the buttons that are used to open the tab content */
        
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            width: 19.5%;
            min-height: 114px;
            font-size: 14px;
            position: relative;
        }
        
        .tab button:after {
            width: 1px;
            height: 80px;
            content: "";
            background-color: #cfcccc;
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            margin: auto;
        }
        
        .tab button:last-child:after {
            display: none;
        }
        /* Change background color of buttons on hover */
        
        .tab button.active {
            background-color: #800000;
            color: #fff;
        }
        /* Create an active/current tablink class */
        
        .tab button.active {
            background-color: #800000;
            color: #fff;
        }
        /* Style the tab content */
        
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
        /***********/
        
        .tabcontent {
            animation: fadeEffect 1s;
            /* Fading effect takes 1 second */
        }
        /* Go from zero to full opacity */
        
        @keyframes fadeEffect {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
</style>
<div class="app-content pt-3 p-md-3 p-lg-3">
            <div class="container-xl">
            <?php if ($this->session->flashdata('success_msg')) : ?>  
               <div class="alert alert-success">
                     <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                    <?php echo $this->session->flashdata('success_msg') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('error_msg')) : ?>
                <div class="alert alert-danger">
                    <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                    <?php echo $this->session->flashdata('error_msg') ?>
                </div>
            <?php endif ?>

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">List of Rate Card</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

                                <!--//col-->
                                <div class="col-auto">
                                    <!-- <a class="btn app-btn-primary" href="master-rate-card-add.html">
                                        ADD NEW Rate Card
                                    </a> -->
                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>
                <!--//row-->

                <div class="app-card app-card-orders-table shadow-sm mb-5 p-4">
                    <div class="app-card-body">
                            <div class="row g-3">
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Division / Workshop<span class="asterisk"> *</span></label>
                                    <select name="fieldunit_id" class="form-select" id="fieldunit_id" required>
                                    <option value="" selected disabled>Select Division / Workshop</option>
                                    <?php foreach($fieldunits as $fieldunit){ ?>
                                        <option value="<?=$fieldunit['fieldunit_id']?>"><?=$fieldunit['fieldunit_name']?></option>
                                    <?php } ?>
                                </select>
                                    
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Location<span class="asterisk"> *</span></label>

                                    <select name="location_id" class="form-select" id="location_id">
                                    <option value="" selected disabled>Select Location</option>
                                        
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Sports Facilities<span class="asterisk"> *</span></label>
                                    <select name="sports_facilities_id" class="form-select" id="sports_facilities_id">
                                    <option value="" selected disabled>Select Sports Facilities</option>
                                        
                                    </select> 
                                </div>
                            </div>

                        

                        <div class="col-md-12">
                            <!-- Tab links -->
                            <div class="tab">

                                <?php foreach($organization_categories as $category_key => $organization_category){ ?>
                                    <button class="tablinks <?=($category_key == 0)?'active':''?>" onclick="openCity(event, 'Category_<?=$organization_category['organization_category_id']?>')" data-organization_category_id="<?=$organization_category['organization_category_id']?>"><?=$organization_category['category_name']?> </button>
                                    
                                <?php } ?>
                            </div>

                            <!-- Tab content -->
                            <?php foreach($organization_categories as $category_key1 => $organization_category){ ?>
                            <div id="Category_<?=$organization_category['organization_category_id']?>" class="tabcontent" style="<?=($category_key1 == 0)?'display: block;':''?>">

                                        <div class="col-md-12">
                                    <form class="rate_form" id="rate_form_<?=$organization_category['organization_category_id']?>" method="post" action="#" autocomplete="off">
                                        
                                        <input type="hidden" class="form-control" name="organization_category_id" value="<?=$organization_category['organization_category_id']?>">

                                        <div class="row g-3">
                                            <div class="col-sm-12 col-md-6 mb-3">
                                                <label for="" class="form-label">Rate per Day (in INR)<span class="asterisk"> *</span></label>
                                                <input type="text" class="form-control" name="rate" placeholder="Rate per Day (in INR)">

                                            </div>
                                            <div class="col-sm-12 col-md-6 mb-3">
                                                <label for="" class="form-label">Effective Start Date<span class="asterisk"> *</span></label>
                                                <input type="text" class="form-control effective_start_date" name="effective_start_date" value="" placeholder="DD-MM-YYYY" required="">
                                            </div>

                                            <!-- <div class="col-sm-12 col-md-6 mb-3">
                                                <label for="" class="form-label">Effective End Date</label>
                                                <h4>31-12-9999</h4>
                                            </div> -->
                                        </div>


                                        <button type="button" class="btn app-btn-primary rate_submit" data-organization_category_id="<?=$organization_category['organization_category_id']?>">SUBMIT</button>
                                        <a class="btn app-btn-danger" href="<?=base_url('admin/sportsfacilitiesrate')?>">CANCEL</a>
                                    </form>
                                    <hr>
                                </div>


                                <div class="table-responsive">
                                    <table class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Rate per Day (in INR) </th>
                                                <th class="cell">Effective Start Date</th>

                                                <th class="cell">Effective End Date</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        
                                        
                                        
                                        <tbody id="rate_table_<?=$organization_category['organization_category_id']?>">

                                        <tr><td colspan="4">No Data Available</td></tr>
                                            

                                        </tbody>
                                    </table>
                                </div>

                                
                            </div>
                            <?php } ?>

                            

                            

                                







                        </div>
 


                        <!--//table-responsive-->

                    </div>
                    <!--//app-card-body-->
                </div>
            </div>
            <!--//container-fluid-->
        </div>
           
            
            
                
<script>
 $(document).ready(function() {
    
        $('#fieldunit_id').change(function(){
        var fieldunit_id = $(this).val();

            $.ajax({
                url:'<?php echo base_url("admin/Sportsfacilitiesrate/getlocation"); ?>',
                method: 'post',
                data: {fieldunit_id: fieldunit_id},
                dataType: 'json',
                success: function(response){
                var resultHTML = '<option value="" selected disabled>Select Location</option>';
                $.each(response,function(index,data){
                    
                  resultHTML +='<option value="'+data.location_id+'">'+data.location_name+'</option>';
                
                });
                $('#location_id').html(resultHTML);
                }
            });
        });


        $('#location_id').change(function(){
        var location_id = $(this).val();
        var slug = 'Sports facilities';

            $.ajax({
                url:'<?php echo base_url("admin/Sportsfacilitiesrate/getsportsfacilities"); ?>',
                method: 'post',
                data: {location_id: location_id, slug: slug},
                dataType: 'json',
                success: function(response){
                var resultHTML = '<option value="" selected disabled>Select Sports Facilities</option>';
                $.each(response,function(index,data){
                    
                  resultHTML +='<option value="'+data.sports_facilities_id+'">'+data.sports_facilities_name+'</option>';
                
                });
                $('#sports_facilities_id').html(resultHTML);
                }
            });
        });
    
    

        $('.effective_start_date').datepicker({
            format: 'dd-mm-yyyy',
            startDate: '+0d',
            autoclose:true
        });
});

        function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }


        $(".rate_submit").click(function(){




            var organization_category_id = $(this).data('organization_category_id');
            var fieldunit_id = $("#fieldunit_id").val();
            var location_id = $("#location_id").val();
            var sports_facilities_id = $("#sports_facilities_id").val();
            if(!sports_facilities_id){
                $.alert({
                        type:'red',
                        title: 'Alert!',
                        content: 'Please select sports facilities'
                    });

                    return false;

            }
            var formdata = $('#rate_form_'+organization_category_id).serializeArray();
            formdata.push({ name: "fieldunit_id", value: fieldunit_id });
            formdata.push({ name: "location_id", value: location_id });
            formdata.push({ name: "sports_facilities_id", value: sports_facilities_id });
            
            $.ajax({
                url: "<?php echo base_url('admin/sportsfacilitiesrate/submit_rate'); ?>",
                type: 'POST',
                data: formdata,
                dataType: 'json',
                encode: true,
            }).done(function (data) {
                if(data.status){
                    
                
                    $.confirm({
                        type:'green',
                        title: 'Success!',
                        content: data.msg,
                        buttons: {
                            OK: function () {
                                window.location.href = "<?=base_url('admin/sportsfacilitiesrate')?>";
                            }
                        }
                    });
                    
    
                }else{
                        
                    $.alert({
                        type:'red',
                        title: 'Alert!',
                        content: data.msg
                    });
    
                }
            }).fail(function (data) {
                $.alert({
                        type:'red',
                        title: 'Alert!',
                        content: 'Oops!Something went wrong...'
                    });
            });

        
        })


        $('#sports_facilities_id').change(function(){
            get_previous_rates();
        });

        $('.tablinks').click(function(){
            get_previous_rates();
        });

        function get_previous_rates(){
            var sports_facilities_id = $("#sports_facilities_id").val();
            var organization_category_id = $(".tablinks.active").data('organization_category_id');
            //alert(organization_category_id);
            $.ajax({
                url:'<?php echo base_url("admin/Sportsfacilitiesrate/getpreviousrate"); ?>',
                method: 'post',
                data: {sports_facilities_id: sports_facilities_id,organization_category_id : organization_category_id},
                dataType: 'json',
                success: function(response){
                var resultHTML = '';
                var i =0;
                if(response.status){
                    $.each(response.sports_facilities_rates,function(key,value){i++;
                        
                    resultHTML +=`<tr>
                                <td class="cell">`+value.rate+`</td>
                                <td class="cell">`+moment(value.effective_start_date).format('DD-MM-YYYY')+`</td>
                                <td class="cell">`+moment(value.effective_end_date).format('DD-MM-YYYY')+`</td>
                                <td class="cell">`;
                                    if(i == 1){
                                        resultHTML +=`<a class="btn-sm app-btn-secondary" href="<?=base_url('admin/Sportsfacilitiesrate/edit_rate/')?>`+value.rate_id+`">Edit</a>`;
                                        } 
                                        resultHTML +=`</td>
                            </tr>`;
                    
                    });
                } else {
                    resultHTML += '<tr><td colspan="4">No Data Available</td></tr>';
                }
                $('#rate_table_'+organization_category_id).html(resultHTML);
                }
            });
        }
</script>