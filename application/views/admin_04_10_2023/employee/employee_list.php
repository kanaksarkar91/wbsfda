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
                        <h1 class="app-page-title mb-0">Gymnasium Employee</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <button id="download_excel" type="button" class="btn app-btn-primary">EXCEL DOWNLOAD</button>
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
                        <form method="post" class="p-2 table-search-form row gx-1 align-items-center" action="<?=base_url('admin/employee/employee_list')?>" autocomplete="off">
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
                                <a href="<?=base_url('admin/employee/employee_list')?>" class="btn app-btn-primary">Clear</a>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left" id="jobrole">
                                <thead>
                                    <tr>
                                        <th class="cell">Employee ID</th>
                                        <th class="cell">Employee Name</th>
                                        <th class="cell">Mobile no</th>
                                        <th class="cell">Division</th>
                                        <th class="cell">Department</th>
                                        <th class="cell">Designation</th>
                                        <th class="cell">Status</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($employee_list)){
                                    foreach($employee_list as $employee){?>
                                    <tr>
                                        <td class="cell"><?=$employee['employee_id']?></td>
                                        <td class="cell"><?=$employee['name']?></td>
                                        <td class="cell"><?=$employee['phone']?></td>
                                        <td class="cell"><?=$employee['fieldunit_name']?></td>
                                        <td class="cell"><?=$employee['department']?></td>
                                        <td class="cell"><?=$employee['designation']?></td>
                                        <td class="cell">
                                            <span class="<?= (($employee['employee_approval_status'] == 1) ? 'badge bg-success' : (($employee['employee_approval_status'] == 2)?'badge bg-danger':'badge bg-warning')) ?>"><?= (($employee['employee_approval_status'] == 1) ? 'Approved' : (($employee['employee_approval_status'] == 2)?'Rejected':'Pending')) ?></span>
                                        </td>
                                        <td class="cell">
                                            <?php if($employee['employee_approval_status'] == 0){ ?>
                                                <button class="btn-sm app-btn-secondary view_details" data-users_gymnasium_id="<?=$employee['users_gymnasium_id']?>" data-name="<?=$employee['name']?>" data-phone="<?=$employee['phone']?>" data-email="<?=$employee['email']?>" data-dob="<?=date('d-m-Y',strtotime($employee['dob']))?>" data-gender="<?=$employee['gender']?>" data-fieldunit_name="<?=$employee['fieldunit_name']?>" data-department="<?=$employee['department']?>" data-designation="<?=$employee['designation']?>" data-employee_id="<?=$employee['employee_id']?>" data-employee_approval_status="<?=$employee['employee_approval_status']?>" data-billing_unit="<?=$employee['billing_unit']?>" >Update Status</button>
                                            <?php } ?> 
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
                    <h5 class="modal-title" id="employeeFullviewLabel">Employee Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="update_employee_status_form" method="post" action="<?php echo base_url('admin/Employee/update_employee_status'); ?>" autocomplete="off">
                    <input type="hidden" name="users_gymnasium_id" id="users_gymnasium_id" class="form-control" value="" />
                    <div class="d-flex justify-content-between mb-3">
                        <div class="fw-bold">Change Status:</div>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="employee_approval_status" id="employee_approval_status_1" value="1" checked>
                                <label class="form-check-label" for="employee_approval_status_1">APPROVED</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="employee_approval_status" id="employee_approval_status_2" value="2">
                                <label class="form-check-label" for="employee_approval_status_2">DECLINED</label>
                            </div>
                        </div>
                    </div>
                </form>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Status</small>
                            <span id="employee_approval_status_cls" class=""></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Employee ID</small>
                            <span class="fw-bold" id="employee_id"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Employee Name</small>
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
                            <small>Date of Birth</small>
                            <span class="fw-bold" id="dob"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Gender</small>
                            <span class="fw-bold" id="gender">Male</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Division</small>
                            <span class="fw-bold" id="fieldunit_name"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Department</small>
                            <span class="fw-bold" id="department"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Designation</small>
                            <span class="fw-bold" id="designation"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small>Billing Unit</small>
                            <span class="fw-bold" id="billing_unit"></span>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary text-white" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-success text-white" id="save_changes">Save Changes</button>
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

    $(".view_details").on('click',function(){
        $("#employeeFullview").modal('show');
        var employee_approval_status = $(this).data('employee_approval_status');
        

        $("#employee_approval_status_cls").text(((employee_approval_status == 1)?'Approved':((employee_approval_status == 2)?'Declined':'Pending')));
        $("#employee_approval_status_cls").addClass(((employee_approval_status == 1)?'badge bg-success':((employee_approval_status == 2)?'badge bg-danger':'badge bg-warning')));
        $("#users_gymnasium_id").val($(this).data('users_gymnasium_id'));
        $("#employee_id").text($(this).data('employee_id'));
        $("#name").text($(this).data('name'));
        $("#phone").text($(this).data('phone'));
        $("#email").text($(this).data('email'));
        $("#dob").text($(this).data('dob')); 
        $("#gender").text($(this).data('gender'));
        $("#fieldunit_name").text($(this).data('fieldunit_name')); 
        $("#department").text($(this).data('department'));
        $("#designation").text($(this).data('designation'));
        $("#billing_unit").text($(this).data('billing_unit'));
    })

    $("#save_changes").on('click',function(){
            
        var users_gymnasium_id = $("#users_gymnasium_id").val();
        var employee_approval_status = $('input[name=employee_approval_status]:checked').val();

        $.confirm({
            title: 'Confirm!',
            content: 'Do you want to change the status?',
            type: 'blue',
            typeAnimated: true,
            buttons: {
                confirm: function () {
                    
                    $("#update_employee_status_form").submit();
                    
                    // $.ajax({
                    //     url:'<?php echo base_url("admin/Employee/update_employee_status"); ?>',
                    //     method: 'post',
                    //     data: {users_gymnasium_id: users_gymnasium_id,employee_approval_status:employee_approval_status},
                    //     dataType: 'json',
                    //     success: function(response){
                            
                    //     },
                    //     error: function(xhr, status, error) {
                    //         var err = eval("(" + xhr.responseText + ")");
                    //         $.alert(err.Message);
                    //     }
                    // });
                },
                cancel: function () {
                    //close
                },
            }
        });
    })

    $("#download_excel").on('click',function(){
        var fieldunit_id=$("#fieldunit_id").val();
        var location_id=$("#location_id").val();
        var sports_facilities_id=$("#sports_facilities_id").val();
        var daterange=$("#daterange").val();

        window.location.href = '<?php echo base_url()?>' +'admin/employee/download_employee_list?fieldunit_id='+fieldunit_id+'&location_id='+location_id+'&sports_facilities_id='+sports_facilities_id+'&daterange='+daterange;
    })
    
});
</script>