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
                        <h1 class="app-page-title mb-0">Gymnasium Payment List</h1>
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
                    <form method="post" class="p-2 table-search-form row gx-1 align-items-center" action="<?=base_url('admin/employee/payment_list')?>" autocomplete="off">
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
                                <a href="<?=base_url('admin/employee/payment_list')?>" class="btn app-btn-primary">Clear</a>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left" id="jobrole">
                                <thead>
                                    <tr class="small">
                                        <th class="cell">ID</th>
                                        <th class="cell">Member Name</th>
                                        <th class="cell">Sponsor Person</th>
                                        <th class="cell text-center">Relationship</th>
                                        <th class="cell text-center">Division</th>
                                        <th class="cell text-center">Gymnasium</th>
                                        <th class="cell text-center">Amount</th>
                                        <th class="cell text-center">Paid Date</th>
                                        <th class="cell text-center">Status</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($member_list)){
                                    foreach($member_list as $member){
                                        $monthly_subscription_fee_str =  $member['monthly_subscription_fee'];
                                        $monthly_subscription_fee_arr = explode('|#|',$monthly_subscription_fee_str);

                                        $monthly_subscription_fee =  $monthly_subscription_fee_arr[0];
                                        $gymnasium_rate_id =  $monthly_subscription_fee_arr[1];
                                        $registration_fee = $monthly_subscription_fee_arr[2];
                                        
                                    ?>
                                    <tr>
                                    <td class="cell small"><?=$member['gymnasium_member_id']?></td>
                                        <td class="cell"><?=$member['member_name']?></td>
                                        <td class="cell"><?=$member['sponsored_person']?><br><small>Emp ID: <?=$member['employee_id']?></small><br><small>Phone: <?=$member['phone']?></small></td>
                                        <td class="cell text-center"><?=$member['relation']?></td>
                                        <td class="cell text-center"><?=$member['fieldunit_name']?></td>
                                        <td class="cell text-center"><?=$member['sports_facilities_name']?></td>
                                        <td class="cell text-center"><?=($member['subscription_amount'])?$member['subscription_amount']:$monthly_subscription_fee?></td>
                                        <td class="cell text-center small"><?=($member['payment_time'])?$member['payment_time']:'N/A'?></td>
                                        <td class="cell text-center">
                                            <span class="<?= (($member['payment_status'] == 0) ? 'badge bg-success' : 'badge bg-danger') ?>"><?= (($member['payment_status'] == 0) ? 'Settled' : 'Unsettled') ?></span>
                                        </td>
                                        <td class="cell">
                                        <?php if($member['payment_status'] == 1){ ?>
                                            <button class="btn-sm app-btn-secondary mark_as_settle" data-gymnasium_member_id="<?=$member['gymnasium_member_id']?>" data-user_id="<?=$member['user_id']?>" data-monthly_subscription_fee="<?=$monthly_subscription_fee?>" data-gymnasium_rate_id="<?=$gymnasium_rate_id?>" data-registration_fee="<?=$registration_fee?>" >Mark as Settle</button>
                                        <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } }  ?>
                                    

                                </tbody>
                            </table>
                        </div>
                        <!--//table-responsive-->

                        <form id="update_payment_form" method="post" action="<?php echo base_url('admin/Employee/update_payment_status'); ?>" autocomplete="off">
                    <input type="hidden" name="gymnasium_member_id" id="gymnasium_member_id" class="form-control" value="" />
                    <input type="hidden" name="gymnasium_rate_id" id="gymnasium_rate_id" class="form-control" value="" />
                    <input type="hidden" name="subscription_amount" id="subscription_amount" class="form-control" value="" />
                    <input type="hidden" name="user_id" id="user_id" class="form-control" value="" />
                    
                    
                    
                    
                    
                    
                </form>

                    </div>
                    <!--//app-card-body-->
                </div>
            </div>
            <!--//container-fluid-->
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

    

    $(".mark_as_settle").on('click',function(){
            
        
        $("#gymnasium_member_id").val($(this).data("gymnasium_member_id"));
        $("#user_id").val($(this).data("user_id"));
        $("#subscription_amount").val($(this).data("monthly_subscription_fee"));
        $("#gymnasium_rate_id").val($(this).data("gymnasium_rate_id"));
        $("#registration_fee").val($(this).data("registration_fee"));
        
        
        
        

        $.confirm({
            title: 'Confirm!',
            content: 'Do you want to mark as settled?',
            type: 'blue',
            typeAnimated: true,
            buttons: {
                confirm: function () {
                    
                    $("#update_payment_form").submit();
                    
                    // $.ajax({
                    //     url:'<?php echo base_url("admin/Employee/update_payment_status"); ?>',
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

        window.location.href = '<?php echo base_url()?>' +'admin/employee/download_payment_list?fieldunit_id='+fieldunit_id+'&location_id='+location_id+'&sports_facilities_id='+sports_facilities_id+'&daterange='+daterange;
    })

</script>