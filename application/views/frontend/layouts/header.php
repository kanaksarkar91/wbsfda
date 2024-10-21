<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= base_url(); ?>public/frontend_assets/assets/img/favicon.png">
    <title>WBSFDA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>public/frontend_assets/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>public/frontend_assets/assets/css/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>public/frontend_assets/assets/css/all.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>public/frontend_assets/assets/css/jquery-ui.css">

    <!-- for Gallery-->
    <link href="<?= base_url(); ?>public/frontend_assets/assets/css/simplelightbox.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>public/frontend_assets/assets/css/demo.css" rel="stylesheet" type="text/css">
    <!-- / for Gallery-->

    <link rel="stylesheet" href="<?= base_url(); ?>public/frontend_assets/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>public/frontend_assets/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>public/frontend_assets/assets/css/stellarnav.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>public/frontend_assets/assets/css/theme.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>public/frontend_assets/assets/css/responsive.css">
    <link rel="stylesheet" href="<?php echo base_url('public/admin_assets/css/sweetalert2.min.css'); ?>">

    <script src="<?= base_url('public/frontend_assets/js/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('public/admin_assets/js/jquery-ui.js'); ?>"></script>
    <script src="<?php echo base_url(); ?>public/admin_assets/js/sweetalert2.min.js"></script>


</head>

<body role="document">
    <!-- Navbar Start -->
    <header class="fixed-header">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <a href="<?= base_url(); ?>" class="logo_area"><img src="<?= base_url(); ?>public/frontend_assets/assets/img/logo.png" alt=""></a>
                <div class="col-auto">
                    <div class="d-flex align-items-center">
                        <div class="stellarnav">
                            <ul>
                                <li class="<?= $this->uri->uri_string() == '' ? 'active' : ''; ?>"><a href="<?= base_url(); ?>">Home</a></li>
                                <!-- <li><a href="">Destination</a>
                                    <ul>
                                        <li><a href="">Sub menu</a></li>
                                        <li><a href="">Sub menu</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Book Safari</a>
                                    <ul>
                                        <li><a href="">Sub menu</a></li>
                                        <li><a href="">Sub menu</a></li>
                                    </ul>
                                </li> -->
                                <li class="<?= $this->uri->uri_string() == 'cms/whats-new' ? 'active' : ''; ?>"><a href="<?= base_url('cms/whats-new') ?>">What's New</a></li>
                                <li class="<?= $this->uri->uri_string() == 'cms/information' ? 'active' : ''; ?>"><a href="<?= base_url('cms/information') ?>">Information</a></li>
                                <li class="drop-left <?= $this->uri->uri_string() == 'cms/dos-donts' ? 'active' : ''; ?>"><a href="<?= base_url('cms/dos-donts') ?>">Dos & Don'ts</a> </li>
                            </ul>
                        </div>
                        <?php if (!$this->session->userdata('logged_in') && !$this->session->userdata('user_type') == 'frontend') { ?>
                            <ul class="log_list">
                                <li><button type="button" class="btn btn-yellow" data-bs-toggle="modal" data-bs-target="#login">Login</button></li>
                                <li><button type="button" class="btn btn-yellow" data-bs-toggle="modal" data-bs-target="#signup">Sign Up</button></li>
                            </ul>
                        <?php
                        }
                        if ($this->session->userdata('logged_in') && $this->session->userdata('user_type') == 'frontend') {
                        ?>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="<?= !is_null($this->session->userdata('profile_pic')) ? base_url('public/customer_images/' . $this->session->userdata('profile_pic')) : base_url('public/frontend_assets/images/user-icon.png') ?>" class="avatar img-fluid rounded" width="20" alt=""></a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="<?= base_url('my-profile') ?>"><i class="bi bi-person-fill"></i> My Profile</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('my-booking') ?>"><i class="bi bi-clipboard2-check-fill"></i> My Bookings</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>


                </div>


            </div>
        </div>
    </header>