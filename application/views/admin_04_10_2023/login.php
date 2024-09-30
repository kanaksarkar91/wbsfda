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
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="<?=base_url('public/admin_assets/css/style.css')?>">

</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4">
                        <a class="app-logo" href="<?=base_url('admin/login')?>"><img class="logo-icon me-2" src="<?=base_url('public/admin_assets/images/logo.jpg')?>" alt="logo"></a>
                    </div>
                    <h2 class="auth-heading text-center mb-5">ADMIN LOGIN</h2>
                    <div class="auth-form-container text-start">
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
                    <form class="settings-form" method="post" action="<?php echo base_url('admin/login/submitlogin'); ?>" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="email mb-3">
                                <label class="sr-only" for="signin-email">Email</label>
                                <input id="signin-email" name="email" type="email" class="form-control signin-email" placeholder="Email address" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="password mb-3">
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
                            </div>
                            <!--//form-group-->
                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button>
                                <!-- <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button> -->
                            </div>
                            
                        </form>

                        <!-- <div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="#">here</a>.</div> -->
                    </div>
                    <!--//auth-form-container-->

                </div>
                <!--//auth-body-->

                <footer class="app-auth-footer">
                    <div class="container text-center py-3">

                        <small class="copyright">© <?php echo date('Y');?> Department of Fisheries, Aquaculture, Aquatic Resources and Fishing Harbour | Govt. of West Bengal</small>

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

</html>