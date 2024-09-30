<div class="app-content pt-3 p-md-3 p-lg-3">
            <div class="container-xl">
            <?php if ($this->session->flashdata('success_msg')) : ?>
               <div class="alert alert-success">
                     <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                    <?= $this->session->flashdata('success_msg') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('error_msg')) : ?>
                <div class="alert alert-danger">
                    <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                    <?= $this->session->flashdata('error_msg') ?>
                </div>
            <?php endif ?>
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Registration Fee / Monthly Coaching Fee</h1>
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
                        <form class="settings-form" method="post" action="<?= base_url('admin/trainingcenterrate/submittrainingcenterrate'); ?>" enctype="multipart/form-data" autocomplete="off">
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

                                    <select name="location_id" class="form-select" id="location_id" required>
                                        <option value="" selected disabled>Select Location</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Training Center<span class="asterisk"> *</span></label>
                                    <select name="sports_facilities_id" class="form-select" id="sports_facilities_id" required>
                                        <option value="" selected disabled>Select Training Center</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-12 col-md-12 mb-3">
                                    <label for="" class="form-label me-3">User Type: For the</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_type" id="user_type1" value="Employees" checked>
                                        <label class="form-check-label" for="user_type1">Employees & Family Members</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_type" id="user_type2" value="Non-employees">
                                        <label class="form-check-label" for="user_type2">Non - Employees</label>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Registration Fee (INR) :<span class="asterisk"> *</span></label>
                                    <input type="text" id="registration_fee" name="registration_fee" class="form-control" required>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Monthly Subscription Fee (INR) :<span class="asterisk"> *</span></label>
                                    <input type="text" id="monthly_subscription_fee" name="monthly_subscription_fee" class="form-control" required>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Effective for<span class="asterisk"> *</span></label>

                                    <select name="effective_year_id" class="form-select" id="effective_year_id" required>
                                        <option value="" selected disabled>Select Financial Year</option>
                                        <?php foreach($effective_years as $effective_year){ ?>
                                            <option value="<?=$effective_year['effective_year_id']?>"><?=$effective_year['effective_year']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                            <a class="btn app-btn-danger" href="<?=base_url('admin/trainingcenterrate')?>">CANCEL</a>
                        </form>
                        <hr>
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Registration Fee</th>
                                        <th class="cell">Monthly Subscription Fee</th>
                                        <th class="cell">Effective In (Financial Year)</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="training_center_list">
                                    <tr><td colspan="3">No Data Available</td></tr>
                                            
                                </tbody>
                            </table>
                        </div>

                        <!--//table-responsive-->

                    </div>
                    <!--//app-card-body-->
                </div>
            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-content-->

    <script>
        $(document).ready(function() {
    
            $('#fieldunit_id').change(function(){
            var fieldunit_id = $(this).val();

                $.ajax({
                    url:'<?= base_url("admin/Trainingcenterrate/getlocation"); ?>',
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
            var slug = 'Training centre';

                $.ajax({
                    url:'<?= base_url("admin/Trainingcenterrate/getTrainingcenters"); ?>',
                    method: 'post',
                    data: {location_id: location_id, slug: slug},
                    dataType: 'json',
                    success: function(response){
                    var resultHTML = '<option value="" selected disabled>Select Training Center</option>';
                    $.each(response,function(index,data){
                        
                    resultHTML +='<option value="'+data.sports_facilities_id+'">'+data.sports_facilities_name+'</option>';
                    
                    });
                    $('#sports_facilities_id').html(resultHTML);
                    }
                });
            }); 
        });

        $('#sports_facilities_id').change(function(){
            var sports_facilities_id = $("#sports_facilities_id").val();
            
            $.ajax({
                url:'<?= base_url("admin/Trainingcenterrate/getpreviousrate"); ?>',
                method: 'post',
                data: {sports_facilities_id: sports_facilities_id},
                dataType: 'json',
                success: function(response){
                var resultHTML = '';
                var i =0;
                if(response.status){
                    $.each(response.trainingcenter_rates,function(key,value){i++;
                        
                    resultHTML +=`<tr>
                                <td class="cell">`+value.registration_fee+`</td>
                                <td class="cell">`+value.monthly_subscription_fee+`</td>
                                <td class="cell">`+value.effective_year+`</td>
                                <td class="cell">`;
                                    if(i == 1){
                                        resultHTML +=`<a class="btn-sm app-btn-secondary" href="<?=base_url('admin/Trainingcenterrate/edit_rate/')?>`+value.trainingcenter_rate_id+`">Edit</a>`;
                                        } 
                                        resultHTML +=`</td>
                            </tr>`;
                    
                    });
                } else {
                    resultHTML += '<tr><td colspan="3">No Data Available</td></tr>';
                }
                $('#training_center_list').html(resultHTML);
                }
            });
        });
    </script>