<style>
.result-msg{
    font-weight: 600;
    font-size: 18px;
}
.chosen-container-multi .chosen-choices li.search-field input[type=text]{
    height: 33px !important;
    border-radius: 7px !important;
}
</style>
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Edit User </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/user') ?>">
                                VIEW ALL USER
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
            <div class="app-card-body">
                <form class="edit-user-form" id="edit-user-form" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">
				<input type="hidden" name="hid_user_id" value="<?=$user['user_id']?>">
                    
                    <div class="row g-3">
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="" class="form-label">User Role<span class="asterisk"> </span></label>
                            <select id="role_id" name="role_id" class="form-select select2" required>
                                <option selected="">Select User Role</option>
                                <?php foreach($roles as $role){ ?>
                                    <option value="<?=$role['role_id']?>" <?=($role['role_id']==$user['role_id']) ? 'selected' : '' ?>><?=$role['role_name']?></option>
                                <?php } ?>
                                </select>
                        </div>
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="designation" class="form-label">Designation<span class="asterisk"> *</span></label>
                            <input type="text" class="form-control" id="" name="designation" value="<?=$user['designation']?>" required>
                        </div>
                        
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="" class="form-label">Email ID<span class="asterisk"> *</span></label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Email ID" name="email" value="<?=$user['email']?>" required>
                        </div>
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="" class="form-label">Full Name<span class="asterisk"> *</span></label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="<?=$user['full_name']?>" required>
                        </div>
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="" class="form-label">Mobile No.<span class="asterisk"> *</span></label>
                            <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?=$user['contact_no']?>" required>
                        </div>
                        
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="gender" class="form-label">Gender<span class="asterisk"> *</span></label>
                            <select id="gender" name="gender" class="form-select" required>
                                <option>Select Gender</option>
                                <option value="Male" <?= $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                <option value="Other" <?= $user['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                                </select>
                        </div>
                        <?php
                            if(in_array($this->admin_session_data['role_id'], [ROLE_SUPERADMIN])){
                        ?>
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="" class="form-label">Password<span class="asterisk"> </span></label>
                            <input type="password" class="form-control" id="password" name="password" value="">
                        </div>
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="" class="form-label">Confirm Password<span class="asterisk"> </span></label>
                            <input type="password" class="form-control" id="" name="confirm_password" value="">
                        </div>
                        <?php
                            }
                        ?>
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="property_id" class="form-label">Properties<span class="asterisk"> </span></label>
                            <select id="property_id" name="property_id[]" class="form-select chosen-select" data-placeholder="Choose Properties..." multiple>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-12 col-md-12 mb-3">
                            <label for="" class="form-label me-3">Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="FieldStatusRadio1" value="0" <?=($user['status'] == 0) ? 'checked':''?>>
                                <label class="form-check-label" for="FieldStatusRadio1">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="FieldStatusRadio2" value="1" <?=($user['status'] == 1) ? 'checked':''?>>
                                <label class="form-check-label" for="FieldStatusRadio2">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn app-btn-primary" id="btn-form-submit">UPDATE</button>
                    <a class="btn app-btn-danger" href="<?=base_url('admin/user')?>">CANCEL</a>
                </form>
            </div>
            <!--//app-card-body-->
        </div>
    </div>
    <!--//container-fluid-->
</div>
<link rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/css/chosen.min.css') ?>">
<script src="<?= base_url('public/admin_assets/js/chosen.jquery.min.js') ?>"></script>
<script type='text/javascript'>
    const user_property = <?= json_encode($user_property) ?>;
    $(document).ready(function(){
        $(".chosen-select").chosen({});
        populate_property();

        $('#edit-user-form').submit(function(e){
            e.preventDefault();
            $('#btn-form-submit').prop('disabled', true);
            $.ajax({
                url:'<?= base_url("admin/user/updateuser/".$user['user_id']) ?>',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response){
                    $('#btn-form-submit').prop('disabled', false);
                    if(response.success){
                        window.location.href = "<?= base_url('admin/user') ?>";
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
                    $('#btn-form-submit').before('<p class="result-msg text-danger">'+response.message+'</p>');
                }
            });
        })
    });


    function populate_property(){
        var result='';
        $.ajax({
            type: 'POST',	
            url: "<?php echo base_url('admin/property/ajaxPropertyLocationHandler'); ?>",
            data: {
                csrf_test_name: '<?php echo $this->csrf['hash']; ?>',
				'action_type': 'PROPERTY_UNIT_MASTER'
            },
            dataType: 'json',
            encode: true,
            async: false
        })
        .done(function(data){
            if(data.status){
                result +='';
                $.each(data.list,function(key,value){
                    console.log(user_property, value.property_id, user_property.includes(value.property_id));
                    //user_property
                    let has_select = user_property.includes(value.property_id) ? 'selected' : '';
                    result +='<option value="'+value.property_id+'" '+has_select+' >'+value.property_name+'</option>';
                });
            }
            $("#property_id").html(result);
            $(".chosen-select").trigger("chosen:updated");
        })
        .fail(function(data){
            // show the any errors
            console.log(data);
        });
    }
</script>