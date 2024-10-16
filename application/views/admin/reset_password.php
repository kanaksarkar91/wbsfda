<!DOCTYPE html>
<html lang="en">

<head>
    <title>ADMIN</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="ADMIN">
    <meta name="author" content="ADMIN">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" crossorigin="anonymous" />    
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="<?=base_url('public/admin_assets/css/style.css')?>">
    <style type="">
        body {font-family: 'Onest', sans-serif;}
		.field-icon {
		  float: right;
		  margin-left: -25px;
		  margin-top: -25px;
		  position: relative;
		  z-index: 2;
		}
    </style>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-1">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4">
                        <a class="app-logo" href="<?=base_url('admin/login')?>">
				<img class="logo-icon me-2" src="<?=base_url('public/admin_assets/images/logo.jpg')?>" alt="logo">
				<!-- <img class="logo-icon me-2" src="<?=base_url('public/admin_assets/images/SFDC_logo.png')?>" alt="logo"> -->
			</a>
                    </div>
		            <h4 class="text-center text-info mb-3">SFDC LTD. WEST BENGAL</h4>
                    <h2 class="auth-heading text-center fs-2 mb-5">Reset Password</h2>

                    <div class="auth-form-container text-start">
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
                    <form class="settings-form" method="post" action="<?= base_url('index/submitNewPassword'); ?>" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
					
					<input id="contact_no" name="contact_no" type="hidden" value="<?= $this->uri->segment(3);?>">
                            
							<div class="form-group mb-3">
								<label class="col-md-4 control-label">OTP</label>
								<div>
								  <input id="otp" type="password" class="form-control" name="otp" required>
								</div>
							</div>
							<div class="form-group mb-3">
								<label class="col-md-12 control-label">New Password <br>(<strong>Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.</strong>)</label>
								<div>
								  <input id="password-field" type="password" class="form-control" name="new_password" required>
								  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								</div>
							</div>
                            <!--//form-group-->
                            <div class="form-group mb-3">
								<label class="col-md-6 control-label">Confirm Password</label>
								<div>
								  <input id="password-field2" type="password" class="form-control" name="confirm_password" >
								  <span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
								</div>
							</div>
                            <!--//form-group-->
                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Submit</button>
                                <!-- <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button> -->
                            </div>
                            
                        </form>
						
						<div class="auth-option text-center pt-4"><a href="<?= base_url();?>admin" class="text-link">Back To Login</a></div> 

                    </div>
                    <!--//auth-form-container-->

                </div>
                <!--//auth-body-->

                <footer class="app-auth-footer">
                    <div class="container text-center py-3">
                        <small class="copyright">© <?= date('Y');?> State Fisheries Development Corporation Limited | Government of West Bengal</small>
                    </div>
                </footer>
                <!--//app-auth-footer-->
            </div>
            <!--//flex-column-->
        </div>
        <!--//auth-main-col-->
        <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
            <div class="auth-background-holder">
            </div>
            <div class="auth-background-mask"></div>
            <!--//auth-background-overlay-->
        </div>
        <!--//auth-background-col-->

    </div>
    <!--//row-->


</body>

<script>
$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

$(".toggle-password2").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>

</html>