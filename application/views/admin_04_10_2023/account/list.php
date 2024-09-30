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
                <h1 class="app-page-title mb-0">My Account </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <!-- <a class="btn app-btn-secondary" href="list.html">
                                VIEW ALL Customer 
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
        <style type="text/css">
            .profile_left_panel {
                width: 100%;
                height: auto;
                border-right: #dee2e6 1px solid;
                min-height: 600px;
            }

            .profile_img_sec {
                text-align: center;
                padding: 35px 0;
            }

            .profile_img_area {
                width: 120px;
                height: 120px;
                border-radius: 50%;
                border: #fff 5px solid;
                -webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.25);
                -moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.25);
                box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.25);
                margin: 0 auto 15px auto;
                overflow: hidden;
            }

            /* Style the tab */
            .profile_left_panel .tab {
                border: 0px solid #fff;
                background-color: #fff;
                width: 100%;
                height: auto;
                border-top: 1px solid #ddd !important;
            }

            /* Style the buttons inside the tab */
            .profile_left_panel .tab button {
                display: block;
                background-color: inherit;
                color: black;
                padding: 15px 20px;
                border-bottom: 1px solid #ddd !important;
                width: 100%;
                border: none;
                outline: none;
                text-align: left;
                cursor: pointer;
                transition: 0.3s;
                font-size: 17px;
                min-height: 30px;
            }

            /* Change background color of buttons on hover */
            .profile_left_panel .tab button:hover {
                background-color: #246fc9;
                color: #fff;
            }

            /* Create an active/current "tab button" class */
            .profile_left_panel .tab button.active {
                background-color: #246fc9;
                color: #fff;
            }

            /* Style the tab content */
            .profile_sec .tabcontent {
                padding: 0px 25px 0 10px;
                border: 0px solid #ccc;
                width: 100%;
                border-left: none;
                height: auto;
            }
        </style>

        <div class="app-card app-card-settings shadow-sm">

            <!-- <form class="settings-form" method="post" action="https://panchayet.syscentricdev.com/admin/tax/submit_tax" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="slug" value=""> -->

                <div class="app-card-body profile_sec">
                    <div class="row g-3">

                        <div class="col-md-3 mt-0">
                            <div class="profile_left_panel">
                                <div class="profile_img_sec">
                                    <div class="profile_img_area">
                                        <?php
                                            if(empty($user['user_image'])){
                                                ?>
                                            <i class="fa fa-user-circle-o" aria-hidden="true" style="font-size: 110px;"></i>
                                            <?php
                                            }else{
                                                ?>
                                            <img id="profile_image_preview" src="<?= base_url('public/admin_images/user_images/'.$user['user_image']) ?>" width="100%">
                                            <?php
                                            }
                                            ?>
                                    </div>
                                    <h3>Welcome,<br/><?= ucwords($user_details['full_name'])?></h3>
                                </div>
                                <div>
                                    <div class="tab">
                                        <button class="tablinks" onclick="openCity(event, 'myAccount')" id="defaultOpen">
                                            <i class="fa fa-home text-center mr-1"></i>
                                            My Account
                                        </button>
                                        <button class="tablinks" onclick="openCity(event, 'change-password')" id="defaultOpen"><i class="fa fa-unlock-alt"></i> Change Password</button>
                                        <button class="tablinks"><a href="<?= base_url('admin/logout') ?>"><i class="fa fa-sign-out"></i> Log Out</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div id="myAccount" class="tabcontent">
                            <form class="settings-form" method="post" action="<?= base_url('admin/account/updateaccount/'.$user['user_id']); ?>" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" name="profile_pic_old" value="<?=$user['user_image']?>">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 mt-3">
                                            <h4>My Account</h4>
                                            <hr>
                                        </div>
                                        <!--<div class="col-sm-12 col-md-4 mb-3">
                                            <label for="property_zp" class="form-label">Zilla Parishad & Others<span class="asterisk"> *</span></label>
                                            <select id="property_zp" name="property_zp" class="form-select" disabled onchange="populate_panchayat_samity($(this).val()); update_unit_id($(this).val());">
                                                <option selected="">Select Zilla Parishad</option>
                                                <?php
                                                    if ($zilla_parishads){
                                                        foreach($zilla_parishads as $zp) {
                                                    ?>
                                                        <option value="<?= $zp['id']; ?>" <?= set_select('property_zp', $zp['id'], $zp['id'] == $user['zilla_id'] ? true : false); ?>>
                                                            <?= $zp['unit_name']; ?>
                                                        </option>
                                                    <?php 
                                                        }
                                                    }
                                                ?>
                                                </select>
                                        </div>
                                        <div class="col-sm-12 col-md-4 mb-3">
                                            <label for="property_panchayat_samiti" class="form-label">Panchayat Samity <span class="asterisk"> </span></label>
                                            <select id="property_panchayat_samiti" name="property_panchayat_samiti" class="form-select" disabled onchange="populate_gram_panchayat($(this).val()); update_unit_id($(this).val());">
                                                <option>Select Panchayet Samity</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-12 col-md-4 mb-3">
                                            <label for="property_gram_panchayat" class="form-label">Gram Panchayat <span class="asterisk"> </span></label>
                                            <select id="property_gram_panchayat" name="property_gram_panchayat" class="form-select" disabled onchange="update_unit_id($(this).val());">
                                                <option>Select Gram Panchayet</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-12 col-md-4 mb-3">
                                            <label for="" class="form-label">User Role<span class="asterisk"> </span></label>
                                            <select id="role_id" name="role_id" class="form-select" disabled>
                                                <option selected="">Select User Role</option>
                                                <?php foreach($roles as $role){ ?>
                                                    <option value="<?=$role['role_id']?>" <?=($role['role_id']==$user['role_id']) ? 'selected' : '' ?>><?=$role['role_name']?></option>
                                                <?php } ?>
                                                </select>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">User Name <span class="asterisk"> *</span></label>
                                            <input type="text" class="form-control" name="user_name" value="<?=$user_details['user_name']?>" placeholder="User Name" required="">
                                        </div>-->
                                        <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">Full Name <span class="asterisk"> *</span></label>
                                            <input type="text" class="form-control" name="full_name" value="<?=$user_details['full_name']?>" placeholder="Name" required="">
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">Email <span class="asterisk"> *</span></label>
                                            <input type="text" class="form-control" name="email" value="<?=$user_details['email']?>" placeholder="Email" required="true" readonly>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">Mobile No <span class="asterisk">* </span></label>
                                            <input type="text" class="form-control" name="contact_no" value="<?=$user_details['contact_no']?>" placeholder="Mobile No" required="">
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                            <label for="tax_status" class="form-label">Gender<span class="asterisk"> *</span></label>
                                            <select name="gender" class="form-select" id="gender" required="">
                                                <option>Select Gender</option>
                                                <option value="Male" <?= ($user_details['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                                                <option value="Female" <?= ($user_details['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                                                <option value="Other" <?= ($user_details['gender'] == 'Other') ? 'selected' : '' ?>>Other</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">Profile Photo</label>
                                            <input type="file" class="form-control" name="user_image" id="user_image">
                                        </div>
                                        <!-- <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">Alternate Phone No <span class="asterisk">* </span></label>
                                            <input type="text" class="form-control" name="alternate_contact_no" value="<?=$user_details['alternate_contact_no']?>" placeholder="Alternate Phone No">
                                        </div>
                                        <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">Address Line 1 <span class="asterisk">* </span></label>
                                            <input type="text" class="form-control" name="address_line_1" value="<?=$user_details['address_line_1']?>" placeholder="Address" required="">
                                        </div>
                                        <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">Address Line 2</label>
                                            <input type="text" class="form-control" name="address_line_2" value="<?=$user_details['address_line_2']?>" placeholder="Address">
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">State <span class="asterisk">* </span></label>
                                            <select class="form-select" id="state_id" name="state_id" required>
                                                <option>Select State</option>
                                                <?php foreach($states as $state){ ?>
                                                    <option value="<?=$state['state_id']?>" <?= ($user_details['state_id'] == $state['state_id']) ? 'selected' : '' ?>><?=$state['state_name']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">District <span class="asterisk">* </span></label>
                                            <select class="form-select" id="district_id" name="district_id" required>
                                                <option>Select District</option>
                                                <?php foreach($districts as $district){ ?>
                                                    <option value="<?=$district['district_id']?>" <?= ($user_details['district_id'] == $district['district_id']) ? 'selected' : '' ?>><?=$district['district_name']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">City/Village <span class="asterisk">* </span></label>
                                            <input type="text" class="form-control" name="" value="<?=$user_details['city']?>" placeholder="City/Village" required="">
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">Pin Code <span class="asterisk">* </span></label>
                                            <input type="text" class="form-control" name="" value="<?=$user_details['pincode']?>" placeholder="Pin Code" required="">
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">Aadhaar No. <span class="asterisk">* </span></label>
                                            <input type="text" class="form-control" name="" value="<?=$user_details['aadhaar_no']?>" placeholder="Aadhaar No" required="">
                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                            <label for="" class="form-label">Income Tax PAN <span class="asterisk">* </span></label>
                                            <input type="text" class="form-control" name="" value="<?=$user_details['pan_no']?>" placeholder="PAN No" required="">
                                        </div> -->
                                        
                                        <div class="col-md-12">
                                            <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                                            <a class="btn app-btn-danger" href="javascript:void(0)" onclick="location.reload()">CANCEL</a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            </div>
                            <div id="change-password" class="tabcontent">
                                <form class="settings-form" method="post" action="<?= base_url('admin/change_password/updatepassword'); ?>" enctype="multipart/form-data" autocomplete="off">                           
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 mt-3">
                                                <h4> Change Password</h4>
                                                <hr>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-md-6 mb-3">
                                                <label for="" class="form-label">Old Password<span class="asterisk"> </span></label>
                                                <input type="password" class="form-control" name="old_password" placeholder="Old Password" required="">

                                            </div>
                                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                                <label for="" class="form-label">New Password <span class="asterisk"> </span></label>
                                                <input type="password" class="form-control" name="password" placeholder="Password" required="">
                                            </div>


                                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                                <label for="" class="form-label">Confirm New Password <span class="asterisk"> </span></label>
                                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm New Password" required="">
                                            </div>

                                            <div class="col-md-12">
                                                <button type="submit" class="btn app-btn-primary">Save Change</button>
                                                <a class="btn app-btn-danger" href="javascript:void(0)" onclick="location.reload()">CANCEL</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!--//app-card-body-->

    </div>
</div>

<script>
    $(document).ready(function(){
        populate_panchayat_samity("<?= $user['panchayet_id'] != '' ? $user['panchayet_id'] : ''; ?>");
        populate_gram_panchayat("<?= $user['gram_id'] != '' ? $user['gram_id'] : ''; ?>");
    })

    function showImage() {
        var fr=new FileReader();
        // when image is loaded, set the src of the image where you want to display it
        fr.onload = function(e) { target.src = this.result; };
        src.addEventListener("change",function() {
            // fill fr with image data    
            fr.readAsDataURL(src.files[0]);
        });
    }

    var src = document.getElementById("user_image");
    var target = document.getElementById("profile_image_preview");
    showImage(src,target);

    function populate_panchayat_samity(selected){
        var parent_id=$("#property_zp").val();
        var result='';
        $.ajax({
            type: 'POST',	
            url: "<?php echo base_url('admin/property/ajaxPropertyLocationHandler'); ?>",
            data: {action_type:'panchayat_samiti','parent_id':parent_id},
            dataType: 'json',
            encode: true,
            async: false
        })
        //ajax response
        .done(function(data){
            if(data.status){
                result +='<option value="">Select Panchayat Samiti</option>';
                $.each(data.PSlist,function(key,value){
                    var selected_txt='';
                    if(selected == value.id){
                        selected_txt='selected';
                    }
                    result +='<option value="'+value.id+'" '+selected_txt+'>'+value.unit_name+'</option>';
                });
            }
            else{
                result +='<option value="">No Unit selected</option>'
            }
            $("#property_panchayat_samiti").html(result);
        })
        .fail(function(data){
            // show the any errors
            console.log(data);
        });
    }


    function populate_gram_panchayat(selected){
        var parent_id=$("#property_panchayat_samiti").val();
        var result='';
        $.ajax({
            type: 'POST',	
            url: "<?php echo base_url('admin/property/ajaxPropertyLocationHandler'); ?>",
            data: {action_type:'gram_panchayat', 'parent_id':parent_id},
            dataType: 'json',
            encode: true,
            async: false
        })
        .done(function(data){
            if(data.status){
                result +='<option value="" selected >Select Gram Panchayat</option>';
                $.each(data.GPlist,function(key,value){
                    var selected_txt='';
                    if(selected == value.id){
                        selected_txt='selected';
                    }
                    result +='<option value="'+value.id+'" '+selected_txt+'>'+value.unit_name+'</option>';
                });
            }
            else{
                result +='<option value="">No Unit selected</option>'
            }
            $("#property_gram_panchayat").html(result);
        
        })
        .fail(function(data){
            // show the any errors
            console.log(data);
        });
    }

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>