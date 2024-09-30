<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="noindex, nofollow" name="robots">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>THE STATE FISHERIES DEVELOPMENT CORPORATION LIMITED (GOVERNMENT OF WEST BENGAL UNDERTAKING)</title>

    <!-- All Plugins Css -->
    <link rel="stylesheet" href="<?= base_url('public/frontend_assets/css/plugins.css'); ?>">

    <!-- Custom CSS -->
    <link href="<?= base_url('public/frontend_assets/css/styles.css'); ?>" rel="stylesheet">

    <!-- Custom Color Option -->
    <link href="<?= base_url('public/frontend_assets/css/colors.css'); ?>" rel="stylesheet">
	
	<link rel="icon" href="favicon.png" sizes="16x16" type="icon/png">

    <link rel="stylesheet" href="<?php echo base_url();?>public/frontend_assets/assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url();?>public/frontend_assets/assets/css/line-awesome.min.css">

    <link rel="stylesheet" href="<?php echo base_url();?>public/frontend_assets/assets/css/animate.css">

    <link rel="stylesheet" href="<?php echo base_url();?>public/frontend_assets/assets/css/slick.css">

    <link rel="stylesheet" href="<?php echo base_url();?>public/frontend_assets/assets/css/magnific-popup.css">

    <link rel="stylesheet" href="<?php echo base_url();?>public/frontend_assets/assets/css/flatpicker.css">

    <link rel="stylesheet" href="<?php echo base_url();?>public/frontend_assets/assets/css/intlTelInput.css">

    <link rel="stylesheet" href="<?php echo base_url();?>public/frontend_assets/assets/css/nice-select.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="<?php echo base_url();?>public/frontend_assets/assets/css/style.css">
	
	<script src="<?= base_url('public/frontend_assets/js/jquery.min.js'); ?>"></script>
	

</head>
<body>

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div id="preloader">
        <div class="preloader"><span></span><span></span></div>
    </div>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">

        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->
        <!-- End Navigation -->
        <div class="header header-light">
            <div class="container">
                <nav id="navigation" class="navigation navigation-landscape">
                    <div class="nav-header">
                        <a class="nav-brand" href="<?= base_url(); ?>">
                            <img src="https://panchayet.syscentricdev.com/public/frontend_assets/images/logo.png" class="logo" alt="">
                            <div class="d-flex flex-column ml-2">
                                <span><b style=" font-size: 26px; color: #004598;
    font-family: 'Inter';">Panchayat Tourism</b></span>
                                <span>Department of Panchayats & Rural Development</span>
                                <span class="small">Government of West Bengal</span>
                            </div>
                        </a>
                        <div class="nav-toggle"></div>
                    </div>
                    <div class="nav-menus-wrapper" style="transition-property: none;">
                        <ul class="nav-menu menu-item">
                            <li>
                                <a href="<?= base_url(); ?>">Home</a>
                            </li>
                          <!--   <li>
                                <a href="<?php echo base_url('about-us')?>">About Us</a>
                            </li> -->
                           
							<li>
                                <a href="<?php echo base_url('frontend/booking/property')?>">Room Booking</a>
                            </li>
							<li>
                                <a href="<?php echo base_url('frontend/booking/hall')?>">Hall Booking</a>
                            </li>
                             <li>
                                <a href="<?php echo base_url('contact-us')?>">Contact</a>
                            </li>
                        </ul>

                        <ul class="nav-menu nav-menu-social align-to-right">
                        <!--<a class="btn btn-sm btn-dark text-uppercase rounded" href="#">Online Booking</a>-->
							<li><a href="#" id="search-btn"><i class="fas fa-search"></i></i>Search</a></li>
                        <?php if(!$this->session->userdata('logged_in') && !$this->session->userdata('user_type') == 'frontend'):?>
                            <li><a href="#" data-toggle="modal" data-target="#login"><i class="fas fa-user-circle text-info mr-1"></i>Log In</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#signup"><i class="fas fa-arrow-alt-circle-right text-warning mr-1"></i>Sign Up</a></li>
                        <?php endif; ?>
                            <!--<li class="login-attri">
                                <div class="btn-group account-drop">
                                    <button type="button" class="btn btn-order-by-filt theme-cl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="ti-shopping-cart-full"></i>
											<span class="cart-count">1</span>
										</button>
                                    <div class="dropdown-menu p-0 dm-lg pull-right animated flipInX">
                                        <div class="cart-card">
                                            <div class="cart-card-header">
                                                <h4>Your Cart</h4>
                                            </div>

                                            <div class="cart-card-body">
                                                <div class="single-cart-wrap">
                                                    <a href="#" class="cart-close"><i class="ti-close"></i></a>
                                                    <div class="single-cart-thumb">
                                                        <img src="assets/images/hotel/hotel-3.jpg" alt="" />
                                                    </div>
                                                    <div class="single-cart-detail">
                                                        <h3 class="sc-title">Mandarmoni</h3>
                                                        <span><i class="ti-location-pin mr-1"></i>Purba Medinipur</span>
                                                        <h4 class="sc-price theme-cl">₹1120</h4>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="cart-card-footer">
                                                <a href="#" class="btn btn-theme">Go To Checkout</a>
                                                <h4 class="totla-prc">₹1120</h4>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>-->
                            <?php if($this->session->userdata('logged_in') && $this->session->userdata('user_type') == 'frontend'):?>
                            <li class="login-attri">
                                <div class="btn-group account-drop">
                                    <button type="button" class="btn btn-order-by-filt theme-cl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?= !is_null($this->session->userdata('profile_pic')) ? base_url('public/customer_images/' . $this->session->userdata('profile_pic')) : base_url('public/frontend_assets/images/user-icon.jpg') ?>" class="avater-img" alt="">Hi, <?=$this->session->userdata('first_name')?>
										</button>
                                    <div class="dropdown-menu pull-right animated flipInX">
                                        <a href="<?php echo base_url('my-booking')?>"><i class="ti-plus"></i>My Booking</a>
                                        <a href="<?php echo base_url('my-profile')?>"><i class="ti-user"></i>My Profile</a>
                                        <a href="<?php echo base_url('logout')?>"><i class="ti-power-off"></i>Logout</a>
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- End Navigation -->
        <div class="clearfix"></div>
        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->