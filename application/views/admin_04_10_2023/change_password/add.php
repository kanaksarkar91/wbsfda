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

                <div class="app-card app-card-settings shadow-sm p-4"> 
                
                    <form class="settings-form" method="post" action="<?php echo base_url('admin/change_password/updatepassword'); ?>" enctype="multipart/form-data" autocomplete="off">
                        
                        <div class="app-card-body"> 
                        
                                <div class="row g-3">
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">Old Password<span class="asterisk"> *</span></label>
                                        <input type="text" class="form-control" id="old_password" name="old_password" value="<?php echo set_value('old_password');?>" required>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">New Password<span class="asterisk"> *</span></label>
                                        <input type="text" class="form-control" id="password" name="password" value="<?php echo set_value('password');?>" required>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">Confirm Password<span class="asterisk"> *</span></label>
                                        <input type="text" class="form-control" id="confirm_password" name="confirm_password" value="<?php echo set_value('confirm_password');?>" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                    </form>
                    </div>
                    <!--//app-card-body-->

                </div>
            </div>