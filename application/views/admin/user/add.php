<style>
    .chosen-container-multi .chosen-choices li.search-field input[type=text]{
        height: 33px !important;
        border-radius: 7px !important;
    }
</style>
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">

        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Add User</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/user') ?>">
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

        <div class="app-card app-card-settings shadow-sm p-3">
            <div class="app-card-body">
                <?php
                    if($msg = $this->session->flashdata('error_msg')){
                        echo '<p class="text-danger validation_message">'.$msg.'</p>';
                    }
                ?>
                <form class="settings-form" id="add-user-form" method="post" action="" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
                    
                    <div class="row g-3">
                        <div class="col-sm-12 col-md-4">
                            <label for="role_id" class="form-label">User Role<span class="asterisk"> *</span></label>
                            <select id="role_id" name="role_id" class="form-select select2" required>
                                <option value="">Select User Role</option>
                                <?php
                                    if($roles){
                                        foreach($roles as $role){
                                            ?>
                                            <option value="<?= $role['role_id'] ?>"><?= $role['role_name'] ?></option>
                                            <?php
                                        }
                                    }
                                ?>                                       
                                </select>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="designation" class="form-label">Designation<span class="asterisk"> *</span></label>
                            <input type="text" class="form-control" id="" name="designation" value="" required>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="email" class="form-label">User ID (Email)<span class="asterisk"> *</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email ID" value="" required>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="full_name" class="form-label">Full Name<span class="asterisk"> *</span></label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="" required>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="contact_no" class="form-label">Mobile No.<span class="asterisk"> *</span></label>
                            <input type="text" class="form-control" id="contact_no" name="contact_no" value="" required>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="gender" class="form-label">Gender<span class="asterisk"> *</span></label>
                            <select id="gender" name="gender" class="form-select" required>
                                <option selected="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                                </select>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="password" class="form-label">Password<span class="asterisk"> </span></label>
                            <input type="password" class="form-control" id="password" name="password" value="" required>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="confirm_password" class="form-label">Confirm Password<span class="asterisk"> </span></label>
                            <input type="password" class="form-control" id="" name="confirm_password" value="" required>
                        </div>
                        
                        <div class="col-sm-12 col-md-4">
                            <label for="property_id" class="form-label">Properties<span class="asterisk"> </span></label>
                            <select id="property_id" name="property_id[]" class="form-select chosen-select" data-placeholder="Choose Properties..." multiple>
							<?php
							if(!empty($property_details)){
								foreach ($property_details as $property) { 
							?>
								<option value="<?= $property['property_id'] ?>"><?= $property['property_name'] ?></option>
							<?php 
								}
							} 
							?>
                            </select>
                        </div>
						
						<div class="col-sm-12 col-md-4">
                            <label for="safari_service_header_id" class="form-label">Safari Service<span class="asterisk"> </span></label>
                            <select id="safari_service_header_id" name="safari_service_header_id[]" class="form-select chosen-select" data-placeholder="Choose Services..." multiple>
							<?php
							if(!empty($safariServiceDetails)){
								foreach ($safariServiceDetails as $row) { 
							?>
								<option value="<?= $row['safari_service_header_id'] ?>"><?= $row['service_definition'];?></option>
							<?php 
								}
							} 
							?>
                            </select>
                        </div>
                        
                        <div class="col-sm-12 col-md-12">
                            <label for="status" class="form-label me-3">Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="FieldStatusRadio1" value="0" checked="">
                                <label class="form-check-label" for="FieldStatusRadio1">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="FieldStatusRadio2" value="1">
                                <label class="form-check-label" for="FieldStatusRadio2">Inactive</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn app-btn-primary" id="btn-form-submit">SUBMIT</button>
                            <a class="btn app-btn-danger" href="<?=base_url('admin/user')?>">CANCEL</a>
                        </div>
                    </div>
                    
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
    $(document).ready(function(){
        $(".chosen-select").chosen({});

        $('#add-user-form').submit(function(e){
            e.preventDefault();
            $('#btn-form-submit').prop('disabled', true);
            $.ajax({
                url:'<?= base_url("admin/user/submitUser") ?>',
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
                    $('#btn-form-submit').before('<p class="result-msg text-danger">'+er.message+'</p>');
                }
            });
        })

        setTimeout(function(){
            $('.validation_message').text('');
        }, 5000);
		
		
		
		$("#property_id").change(function(){ 
			var result='';
			
			var selectedValuePRopertyId = [];    
			$("#property_id :selected").each(function(){
				selectedValuePRopertyId.push($(this).val()); 
			});
			console.log(selectedValuePRopertyId);
			$.ajax({
				type: 'POST',	
				url: '<?= base_url("admin/user/getPos"); ?>',
				data: {
					property_ids: selectedValuePRopertyId,
					csrf_test_name: '<?= $this->csrf['hash']; ?>'
				},
				dataType: 'json',
				encode: true,
				async: false
			})
			//ajax response
			.done(function(data){
				if(data.status){
					
					$.each(data.lists,function(key,value){
						var selected_txt='';
						result +='<option value="'+value.cost_center_id+'">'+value.cost_center_name+'</option>';
					});
				}
				else{
					result +='<option value="">No POS selected</option>'
				}
				$("#cost_center_id").html(result);
				$(".chosen-select").trigger("chosen:updated");
			});
		});
		
    });


</script>