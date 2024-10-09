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
    <link rel="shortcut icon" href="<?=base_url('public/admin_assets/images/favicon.ico')?>" />

    <!-- FontAwesome CSS-->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" crossorigin="anonymous" /> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/css/font-awesome.min.css') ?>" />
    <!-- <link href="https://fonts.googleapis.com/css2?family=Onest:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet"> -->

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="<?=base_url('public/admin_assets/css/style.css')?>" />

	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
	<script src="<?= base_url('public/admin_assets/js/jquery.min.js') ?>"></script>
</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4">
                        <a class="app-logo" href="<?=base_url('admin/login')?>">
                            <img src="<?=base_url('public/frontend_assets/assets/img/logo.png')?>" alt="logo">
                        </a>
                    </div>
                    <h2 class="auth-heading text-center fs-2 mb-5">ADMIN LOGIN</h2>

                    <div class="auth-form-container text-start" id="loginform">
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
                    <form class="settings-form" method="post" action="<?= base_url('admin/login/submitlogin'); ?>" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <div class="email mb-3">
                                <label class="col-md-4 control-label">Email</label>
                                <input id="signin-email" name="email" type="email" class="form-control signin-email" placeholder="Email address" required="required" autocomplete="off">
                            </div>
							
							
							<div class="form-group mb-3">
								<label class="col-md-4 control-label">Password</label>
								<div>
								  <input id="password-field" type="password" class="form-control signin-password" name="password" autocomplete="off">
								  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								</div>
							</div>
							
							
                            <!--//form-group-->
                            <?php /*?><div class="password mb-3">
                                <label class="sr-only" for="signin-password">Password</label>
                                <input id="signin-password" name="password" type="password" class="form-control signin-password" placeholder="Password" required="required">
                                <!-- <div class="extra mt-3 row justify-content-between"> -->
                                    <!-- <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="RememberPassword">
                                            <label class="form-check-label" for="RememberPassword">
											Remember me
											</label>
                                        </div>
                                    </div> -->
                                    <!--//col-6-->
                                    <!-- <div class="col-6">
                                        <div class="forgot-password text-end">
                                            <a href="reset-password.html">Forgot password?</a>
                                        </div>
                                    </div> -->
                                    <!--//col-6-->
                                <!-- </div> -->
                                <!--//extra-->
                            </div><?php */?>
                            <!--//form-group-->
                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button>
                                <!-- <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button> -->
                            </div>
                            
                        </form>

                        <div class="auth-option text-center pt-5"><a href="javascript:void(0)" id="to-recover" class="text-link">Forgot Password ?</a></div>
                    </div>
                    <!--//auth-form-container-->
					
					<div class="auth-form-container text-start" id="recoverform" style="display:none;">
                    <form class="settings-form" method="post" action="#" enctype="multipart/form-data" autocomplete="off">
					
							<span class="text-left">Enter your registered Phone no. and a OTP will be sent to your registered Phone no.</span>
					
                            <div class="email mb-3">
                                <label class="sr-only" for="signin-email">Phone No.</label>
                                <input id="register_phone" name="register_phone" type="text" class="form-control" placeholder="Phone No." required="required">
                            </div>
							
							<div class="email mb-3">
                                <p class="mb-0 text-danger" id="email-invalid"></p>
								<p class="mb-0 text-success" id="email-success"></p>
                            </div>
                            <!--//form-group-->
                            
                            <!--//form-group-->
                            <div class="text-center">
                                <button type="button" class="btn app-btn-primary w-100 theme-btn mx-auto" id="reset_password_submit">Submit</button>
                                <!-- <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button> -->
                            </div>
                            
                        </form>

                         <div class="auth-option text-center pt-5"><a href="<?= base_url();?>admin" class="text-link">Back To Login</a></div> 
                    </div>

                </div>
                <!--//auth-body-->

                <footer class="app-auth-footer">
                    <div class="container text-center py-3">
                        <small class="copyright">© Copyright <?= date('Y');?> All Rights Reserved by WBSFDA</small>
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
$(document).ready(function(){
	$('form').attr('autocomplete', 'off');
	$("input").attr("autocomplete", "off"); 
});
</script>

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

$('#to-recover').on("click", function() {
	$("#loginform").slideUp();
	$("#recoverform").fadeIn();
	$(".text_change").html("Reset Password");
});

$('#reset_password_submit').on("click", function() {
	
	var tHis = $(this);
	
	tHis.html('<i class="fa fa-spinner fa-spin"></i>Wait..');
	
	$.ajax({
		url: "<?= base_url('index/sendResetPasswordOtp') ?>",
		cache: false,
		type: "POST",
		data: {
			contact_no: $('#register_phone').val(),
			csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'
		},
		dataType: "JSON",
		success: function(res) {
		console.log(res.status);
			if(res.status){
				tHis.html('Submit');
				$('#email-success').html(res.msg);
				$("#email-success").removeClass("hidden");
				$("#email-invalid").hide();
				window.location.replace(res.redirect_link);
			} else { 
				tHis.html('Submit');
				
				$('#email-invalid').html(res.msg);
				$("#email-invalid").removeClass("hidden");
				$("#email-success").hide();

			}
			
		}
	});
	
});
</script>

</html>