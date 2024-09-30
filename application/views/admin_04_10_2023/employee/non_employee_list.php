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
                        <h1 class="app-page-title mb-0">Gymnasium Non Employee</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <button id="download_excel" type="submit" class="btn app-btn-primary">EXCEL DOWNLOAD</button>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>
                <!--//row-->

                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body"> 
                    <form method="post" class="p-2 table-search-form row gx-1 align-items-center" action="<?=base_url('admin/employee/non_employee_list')?>" autocomplete="off">
                            <div class="col-auto">
                            <select name="fieldunit_id" class="form-select" id="fieldunit_id">
                                    <option value="" selected>Select Division / Workshop</option>
                                    <?php foreach($fieldunits as $fieldunit){ ?>
                                        <option value="<?=$fieldunit['fieldunit_id']?>" <?=($request_data['fieldunit_id'] == $fieldunit['fieldunit_id'])?'selected':''?>><?=$fieldunit['fieldunit_name']?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-auto">
                                <select name="location_id" class="form-select" id="location_id">
                                    <option value="" selected>Select Location</option>
                                </select>
                            </div>

                            <div class="col-auto">
                                <select name="sports_facilities_id" class="form-select" id="sports_facilities_id">
                                    <option value="" selected>Select Gymnasium</option>
                                </select>
                            </div>

                            
                            <div class="col-auto">
                                <input type="text" id="daterange" name="daterange" class="form-control" value="<?=(isset($request_data['daterange']) && !empty($request_data['daterange']))?$request_data['daterange']:''?>" style="height: 38px;" />
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn app-btn-primary">Search</button>
                                <a href="<?=base_url('admin/employee/non_employee_list')?>" class="btn app-btn-primary">Clear</a>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left" id="jobrole">
                                <thead>
                                    <tr>
                                        <th class="cell">ID</th>
                                        <th class="cell">Name</th>
                                        <th class="cell">Mobile no</th>
                                        <th class="cell">Address</th> 
                                        <th class="cell">Date of Birth</th>
                                        <th class="cell">Gender</th>
                                        <th class="cell">Profession</th>
                                        <th class="cell">Gymnasium</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(!empty($non_employee_list)){
                                    foreach($non_employee_list as $non_employee){?>
                                    <tr>
                                        <td class="cell"><?=$non_employee['users_gymnasium_id']?></td>
                                        <td class="cell"><?=$non_employee['name']?></td>
                                        <td class="cell"><?=$non_employee['phone']?></td>
                                        <td class="cell"><?=$non_employee['full_address']?></td>
                                        <td class="cell"><?=date('d-m-Y',strtotime($non_employee['dob']))?></td>
                                        <td class="cell"><?=$non_employee['gender']?></td>
                                        <td class="cell"><?=$non_employee['profession_name']?></td>
                                        <td class="cell"><?=$non_employee['sports_facilities_name']?></td>

                                        <td class="cell">
                                            <button type="button" class="btn-sm app-btn-secondary view_details" data-users_gymnasium_id="<?=$non_employee['users_gymnasium_id']?>" data-name="<?=$non_employee['name']?>" data-phone="<?=$non_employee['phone']?>" data-email="<?=$non_employee['email']?>" data-dob="<?=date('d-m-Y',strtotime($non_employee['dob']))?>" data-gender="<?=$non_employee['gender']?>" data-profession_name="<?=$non_employee['profession_name']?>" data-full_address="<?=$non_employee['full_address']?>" data-sports_facilities_name="<?=$non_employee['sports_facilities_name']?>" >View Details</button>
                                        </td>
                                    </tr>
                                    <?php } }  ?>
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


        <div class="modal fade" id="employeeFullview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="employeeFullviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeFullviewLabel">Non Employee Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>ID</small>
                            <span class="fw-bold" id="users_gymnasium_id"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Name</small>
                            <span class="fw-bold" id="name"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Mobile No</small>
                            <span class="fw-bold" id="phone"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Email ID</small>
                            <span class="fw-bold" id="email"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Address</small>
                            <span class="fw-bold" id="full_address"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Date of Birth</small>
                            <span class="fw-bold" id="dob"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Gender</small>
                            <span class="fw-bold" id="gender"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Designation</small>
                            <span class="fw-bold" id="profession_name"></span>
                        </li>
                        
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Gymnasium Name</small>
                            <span class="fw-bold" id="sports_facilities_name"></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
                
<script>
   

    $(document).ready(function() { 
        
        var fieldunit_id  = "<?=($request_data['fieldunit_id'])?$request_data['fieldunit_id']:''?>";
            var location_id  = "<?=($request_data['location_id'])?$request_data['location_id']:''?>";
            var sports_facilities_id  = "<?=($request_data['sports_facilities_id'])?$request_data['sports_facilities_id']:''?>";
            var autoUpdateInput  = (($('input[name="daterange"]').val() !='')?true:false);

$('input[name="daterange"]').daterangepicker({ 
    opens: 'left',
    showDropdowns:true,
    autoUpdateInput: autoUpdateInput,
    maxDate: moment(),
    locale: {
        format: 'DD-MM-YYYY', 
        cancelLabel: 'Clear'
    }
}, function(start, end, label) { 
    //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
}); 

$('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
});

$('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val(''); 
});
        $('#jobrole').DataTable({
           
            "bInfo": false,
            "ordering": false
        
        });

        $('#fieldunit_id').change(function(){
            var fieldunit_id = $(this).val();

                $.ajax({
                    url:'<?php echo base_url("admin/Gymnasiumrate/getlocation"); ?>',
                    method: 'post',
                    data: {fieldunit_id: fieldunit_id},
                    dataType: 'json',
                    async:false,
                    success: function(response){
                    var resultHTML = '<option value="" selected>Select Location</option>';
                    $.each(response,function(index,data){
                        
                    resultHTML +='<option value="'+data.location_id+'" '+((location_id == data.location_id)?"selected":"")+'>'+data.location_name+'</option>';
                    
                    });
                    $('#location_id').html(resultHTML);
                    }
                });
            });


            $('#location_id').change(function(){
            var location_id = $(this).val();
            var slug = 'Gymnasium facilities';

                $.ajax({
                    url:'<?php echo base_url("admin/Gymnasiumrate/getGymnasiums"); ?>',
                    method: 'post',
                    data: {location_id: location_id, slug: slug},
                    dataType: 'json',
                    async:false,
                    success: function(response){
                    var resultHTML = '<option value="" selected>Select Gymnasium</option>';
                    $.each(response,function(index,data){
                        
                    resultHTML +='<option value="'+data.sports_facilities_id+'" '+((sports_facilities_id == data.sports_facilities_id)?"selected":"")+'>'+data.sports_facilities_name+'</option>';
                    
                    });
                    $('#sports_facilities_id').html(resultHTML);
                    }
                });
            });
    

            if(fieldunit_id){
                $("#fieldunit_id").trigger("change"); 
            }

            if(location_id){
                $("#location_id").trigger("change"); 
            }

    });

    $(".view_details").on('click',function(){
        $("#employeeFullview").modal('show');
        $("#users_gymnasium_id").text($(this).data('users_gymnasium_id'));
        $("#name").text($(this).data('name'));
        $("#phone").text($(this).data('phone'));
        $("#email").text($(this).data('email'));
        $("#dob").text($(this).data('dob')); 
        $("#gender").text($(this).data('gender'));
        $("#profession_name").text($(this).data('profession_name'));
        $("#full_address").text($(this).data('full_address'));
        $("#sports_facilities_name").text($(this).data('sports_facilities_name'));
    })

    $("#download_excel").on('click',function(){
        var fieldunit_id=$("#fieldunit_id").val();
        var location_id=$("#location_id").val();
        var sports_facilities_id=$("#sports_facilities_id").val();
        var daterange=$("#daterange").val();

        window.location.href = '<?php echo base_url()?>' +'admin/employee/download_non_employee_list?fieldunit_id='+fieldunit_id+'&location_id='+location_id+'&sports_facilities_id='+sports_facilities_id+'&daterange='+daterange;
    })
    
    
</script>