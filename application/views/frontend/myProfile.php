<?php
// print_r($customer_details);
?>
<section class="gray">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="dashboard-navbar dashboard-left-content">

                    <div class="d-user-avater">
                        <img src="<?= !is_null($this->session->userdata('profile_pic')) ? base_url('public/customer_images/' . $this->session->userdata('profile_pic')) : base_url('public/frontend_assets/images/user-icon.jpg') ?>" class="img-fluid avater w-75" alt="">
                        <h5 class="fw-bold thm-txt mt-3"><?=$this->session->userdata('first_name')?> </h5>
                        <span></span>
                    </div>

                    <div class="d-navigation">
                        <ul class="dashboard-list">
                            <li class="list active"><a href="<?= base_url('my-profile');?>"><i class="bi bi-person-fill"></i> My Profile</a></li>
							<li class="list"><a href="<?= base_url('my-booking');?>"><i class="bi bi-clipboard2-check-fill"></i> My Booking</a></li>
							<li class="list"><a href="<?= base_url('logout');?>"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="dashboard-wraper single-reservation bg-white base-padding">
				<?php if ($this->session->flashdata('success_msg')) : ?>
				   <div class="alert alert-success">
						 
						<?= $this->session->flashdata('success_msg') ?>
					</div>
				<?php endif ?>
				<?php if ($this->session->flashdata('error_msg')) : ?>
					<div class="alert alert-danger">
						
						<?= $this->session->flashdata('error_msg') ?>
					</div>
				<?php endif ?>
                    <!-- Basic Information -->
                    <div class="form-submit">
                        <h5 class="fw-bold thm-txt mb-4">My Account</h5>
                        <form action="<?= base_url('update-profile') ?>" method="post" id="update_profile" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
							<input type="hidden" class="form-control" name="customer_id" value="<?= $customer_details['customer_id'] ?>">

                            <div class="submit-section">
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label>Full Name<i class="req">*</i></label>
                                        <input type="text" class="form-control text_capitalized" name="first_name" value="<?= $customer_details['first_name']; ?>">
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label>Gender<i class="req">*</i></label>
                                        <select class="form-select" name="gender">
											<option value="Male" <?= set_select('gender', 'Male', $customer_details['gender'] == 'Male' ? true : false); ?>>Male</option>
											<option value="Female" <?= set_select('gender', 'Female', $customer_details['gender'] == 'Female' ? true : false); ?>>Female</option>
											<option value="Other" <?= set_select('gender', 'Other', $customer_details['gender'] == 'Other' ? true : false); ?>>Transgender</option>
										</select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Age<i class="req">*</i></label>
                                        <select class="form-select" name="age" >
											<?php for ($i = 18; $i <= 120; $i++) { ?>
											<option value="<?= $i; ?>" <?= set_select('age', $i, $customer_details['age'] == $i ? true : false); ?>><?= $i; ?></option>
											<?php } ?>
										</select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Email<i class="req">*</i></label>
                                        <input type="email" class="form-control" name="email" value="<?= $customer_details['email'] ?>" readonly="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Phone<i class="req">*</i></label>
                                        <input type="text" class="form-control" name="mobile" value="<?= $customer_details['mobile'] ?>" readonly="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Your Address<i class="req">*</i></label>
                                        <input type="text" class="form-control" name="address" value="<?= $customer_details['address'] ?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>City / Village<i class="req">*</i></label>
                                        <input type="text" class="form-control" name="city" value="<?= $customer_details['city'] ?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Country<i class="req">*</i></label>
                                        <select id="country_id" name="country_id" class="form-select">
                                            <option value="">Select Country</option>
                                            <?php foreach ($countries as $country) { ?>
                                                <option value="<?= $country['country_id'] ?>" <?= ($country['country_id'] == $customer_details['country_id']) ? 'selected' : '' ?>><?= $country['country_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>State<i class="req">*</i></label>
                                        <select id="state_id" name="state_id" class="form-select">
                                            <option value="">Select State</option>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Pincode<i class="req">*</i></label>
                                        <input type="text" class="form-control" name="pincode" value="<?= $customer_details['pincode'] ?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Profile Image</label>
                                        <img src="<?= !is_null($customer_details['profile_pic']) ? base_url('public/customer_images/' . $customer_details['profile_pic']) : base_url('public/frontend_assets/images/user-icon.jpg') ?>" id="profile_pic_img" alt="" class="img-fluid avater" height="78" width="78">
                                        <input type="file" class="form-control" accept="image/*" id="profile_pic" name="profile_pic" style="display:none;" capture>
                                    </div>


                                    <div class="clearfix w-100"></div>

                                    <div class="form-group col-md-6">
                                        <button type="submit" class="btn-green">Update Changes</button>
                                    </div>


                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
</section>

<script>
    $(document).ready(function() {

        var country_id = "<?= ($customer_details['country_id']) ? $customer_details['country_id'] : '' ?>";
        var state_id = "<?= ($customer_details['state_id']) ? $customer_details['state_id'] : '' ?>";

        $("#profile_pic_img").click(function(e) {
            $("#profile_pic").click();
        });

        $('#country_id').change(function() {
            var country_id = $(this).val();
            $.ajax({
                url: '<?= base_url("frontend/profile/getstate"); ?>',
                method: 'post',
                data: {
                    country_id: country_id,
					csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'
                },
                dataType: 'json',
                async: false,
                success: function(response) {
                    var resultHTML = '<option value="" selected>Select State</option>';
                    $.each(response, function(index, data) {

                        resultHTML += '<option value="' + data.state_id + '" ' + ((state_id == data.state_id) ? "selected" : "") + '>' + data.state_name + '</option>';

                    });
                    $('#state_id').html(resultHTML);
                }
            });
        });

        if (country_id) {
            $("#country_id").trigger("change");
        }


    });

    function fasterPreview(uploader, preview_div) {
        if (uploader.files && uploader.files[0]) {
            $('#' + preview_div).attr('src', window.URL.createObjectURL(uploader.files[0]));
        }
    }

    $("#profile_pic").change(function() {

        fasterPreview(this, 'profile_pic_img');
    });
</script>