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


</head>

<body role="document">
    <!-- Navbar Start -->
    <header class="fixed-header">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <a href="index.html" class="logo_area"><img src="<?= base_url(); ?>public/frontend_assets/assets/img/logo.png" alt=""></a>
                <div class="col-auto">
                    <div class="d-flex align-items-center">
                        <div class="stellarnav">
                            <ul>
                                <li class="active"><a href="">Home</a></li>
                                <li><a href="">Destination</a>
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
                                </li>
                                <li><a href="">What’s New</a></li>
                                <li><a href="">Information</a></li>
                                <li class="drop-left"><a href="">Dos & Don'ts</a> </li>
                            </ul>
                        </div>
                        <ul class="log_list">
                            <li><button type="button" class="btn btn-yellow" data-bs-toggle="modal" data-bs-target="#LoginModal">Login</button></li>
                            <li><button type="button" class="btn btn-yellow" data-bs-toggle="modal" data-bs-target="#SignnModal">Sign Up</button></li>
                        </ul>
                    </div>

                </div>


            </div>
        </div>
    </header>