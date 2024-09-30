<?php defined('BASEPATH') or exit('No direct script access allowed');
    $seletedUserManagementMenu = array('role', 'user', 'permission');
    $seletedMasterMenu = array('customer','district', 'property', 'rates', 'accomodation', 'location', 'sports_facilities', 'sportsfacilitiesrate', 'gymnasiumrate', 'trainingcenterrate', 'CancellationPolicy');
    $seletedCmsMasterMenu = array('banner', 'cms');
    $seletedReservationMenu = array('reservation', 'AccommodationBlock');
    $seletedEmployeeManagementMenu = array('employee');
    $seletedEnquiryMenu = array('enquiry');

    /*
        ** collect & ready menu dataset
        ** Collect & get sidebar menu for loggesin users as per his role
    */
    $menues = getSidebarMenu($this->session->userdata('admin')['role_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Department of Fisheries Admin</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta content="noindex, nofollow" name="robots">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <meta name="description" content="Department of Fisheries Admin">
    <meta name="author" content="Department of Fisheries Admin">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/css/font-awesome.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('public/summernote/summernote-bs4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/admin_assets/css/jquery.dataTables.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/css/jquery.datetimepicker.css') ?>" />
    <link rel="stylesheet" type="text/css" href=<?= base_url('public/admin_assets/css/main.min.css') ?> />


    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/css/style.css') ?>">
    <link id="theme-style" rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/css/theme.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/admin_assets/css/jquery.timepicker.min.css');?>">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('public/admin_assets/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="<?= base_url('public/admin_assets/plugins/popper.min.js') ?>"></script>
    <script src="<?= base_url('public/admin_assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tooltip.js/1.3.1/tooltip.min.js"></script> -->

    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            cursor: default;
            color: #fff !important;
            border: 1px solid transparent;
            background: #800000;
            box-shadow: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #000 !important;
            border: 1px solid #fbbe2d;
            background-color: #fbbe2d;
            background: #fbbe2d !important;

        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {

            color: #fff !important;
            background: #098bf9;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding-top: 15px;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            padding: 15px 10px;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #fbbe2d;
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(251, 190, 45, .075), 0 0 8px rgba(251, 190, 45, .6);
            box-shadow: inset 0 1px 1px rgba(251, 190, 45, .075), 0 0 8px rgba(251, 190, 45, .6);

            transition-duration: 0.5s;
            -webkit-transition-duration: 0.5s;

        }

        .asterisk {
            color: #e32;
        }

        .app-nav .nav-link,
        .app-btn-primary {
            text-transform: uppercase;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #e7e9ed;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #800000;
            border: 1px solid #800000;
            border-radius: 4px;
            cursor: default;
            float: left;
            margin-right: 5px;
            margin-top: 5px;
            padding: 0 20px 0 5px;
            color: #fff;
            position: relative;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-weight: bold;
            margin-right: 2px;
            position: absolute;
            right: 5px;
        }

        .wrap {
            border: #eee 1px solid;
            border-radius: 4px;
            padding: 5px 10px 6px;
        }

        label.file__input--label {
            background: #800000;
            color: #fff;
            padding: 3px 12px;
            float: right;
            border-radius: 4px;
            font-weight: 600;
        }

        .file__value {
            width: 100%;
            height: auto;
            border: #c7c7c7 1px dotted;
            margin-top: 8px;
            padding: 5px 12px;
            background: #f5f6fe;
            position: relative;
            border-radius: 5px;
        }

        .file__value:hover:after {
            color: #000;
        }

        .file__value:after {
            content: "X";
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 6px;
        }

        .file__value:after:hover {
            color: rgb(68, 68, 68);
        }

        .profile-pic {
            position: relative;
            display: inline-block;
        }

        .profile-pic:hover .edit {
            display: block;
        }

        .edit {
            position: absolute;
            right: 20px;
            top: 10px;
            padding: 4px 11px;
            border-radius: 35px;
            width: 35px;
            height: 35px;
            background: #FFF;
            display: none;
        }

        .edit a {
            font-size: 12px;
            color: darkred;
        }
        .hidden {
			visibility: hidden;
		}
		
		.blur   {
			filter: blur(5px);
			-webkit-filter: blur(5px);
			-moz-filter: blur(5px);
			-o-filter: blur(5px);
			-ms-filter: blur(5px);
		}
    </style>
</head>

<body class="app" id="blurme">
    <header class="app-header fixed-top">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">

                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div>
                        <!--//col-->
                        <!-- <div class="search-mobile-trigger d-sm-none col">
                            <i class="search-mobile-trigger-icon fas fa-search"></i>
                        </div> -->
                        <!--//col-->
                        <!-- <div class="app-search-box col">
                            <form class="app-search-form">
                                <input type="text" placeholder="Search..." name="search" class="form-control search-input">
                                <button type="submit" class="btn search-btn btn-primary" value="Search"><i class="fa fa-search"></i></button>
                            </form>
                        </div> -->
                        <!--//app-search-box-->

                        <div class="app-utilities col-auto">
                            
                            <div class="app-utility-item app-user-dropdown dropdown">
                                <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                    <?php
                                        if(empty($this->session->userdata('admin'))){
                                            ?>
                                        <img id="" src="<?= base_url('public/admin_assets/images/user.png') ?>" width="100%">
                                        <?php
                                        }else{
                                            if(empty($this->session->userdata('admin')['user_image'])){
                                                ?>
                                            <i class="fa fa-user-circle-o" aria-hidden="true" style="font-size: 37px;"></i>
                                                <?php
                                            }else{
                                            ?>
                                        <img id="" src="<?= base_url('public/admin_images/user_images/'.$this->session->userdata('admin')['user_image']) ?>" width="100%">
                                        <?php
                                            }
                                        }
                                    ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                    <!-- <li><a class="dropdown-item" href="account.html">Account</a></li> -->
                                    <!-- <li>
                                        <hr class="dropdown-divider">
                                    </li> -->
                                    <li><a class="dropdown-item" href="<?= base_url('admin/account') ?>"><i class="fa fa-user"></i> My Account</a></li>
                                    <!-- <li><a class="dropdown-item" href="<?= base_url('admin/change_password') ?>"><i class="fa fa-unlock-alt"></i> Change Password</a></li> -->
                                    <li><a class="dropdown-item" href="<?= base_url('admin/logout') ?>"><i class="fa fa-sign-out"></i> Log Out</a></li>
                                </ul>
                            </div>
                            <!--//app-user-dropdown-->
                        </div>
                        <!--//app-utilities-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-header-content-->
            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-header-inner-->
        <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
                <div class="app-branding">
                    <a class="app-logo" href="<?= base_url('admin/') ?>">
                    <img class="logo-icon me-1" src="<?= base_url('public/admin_assets/images/logo.jpg') ?>" alt="logo">
                        <span class="logo-text">SFDC, West Bengal</span>
                    </a>
                </div>

                <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= base_url('admin/') ?>">
                                <span class="nav-icon">
                                    <i class="fa fa-home"></i>
                                </span>
                                <span class="nav-link-text">DASHBOARD</span>
                            </a>
                        </li>
                        <?php
                            if(!empty($menues)){
                                foreach($menues as $index => $main_menu){
                                    ?>
                                    <li class="nav-item has-submenu">
                                        <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-<?=$index?>" aria-expanded="false" aria-controls="submenu-<?=$index?>">
                                            <span class="nav-icon">
                                                <?= $main_menu['menu_icon'] ?>
                                            </span>
                                            <span class="nav-link-text"><?= ucwords($main_menu['menu_name']) ?></span>
                                            <span class="submenu-arrow">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                            </span>
                                        </a>
                                        <?php
                                            if(count($main_menu['child_menu']) >0 ){
                                        ?>
                                        <div id="submenu-<?=$index?>" class="collapse submenu submenu-<?=$index?>" data-bs-parent="#menu-accordion">
                                            <ul class="submenu-list list-unstyled">
                                                <?php
                                                    foreach($main_menu['child_menu'] as $key => $option_menu){
                                                ?>
                                                <li class="submenu-item">
                                                    <a class="submenu-link" data-parent="submenu-<?=$index?>" href="<?= base_url($option_menu['menu_link']) ?>"><?= ucwords($option_menu['menu_name']) ?></a>
                                                </li>
                                                <?php
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    </li>
                                    <?php
                                }
                            }
                        ?>
                    </ul>
                    <!--//app-menu-->
                </nav>
                <!--//app-nav-->
                <div class="app-sidepanel-footer">
                    <nav class="app-nav app-nav-footer">
                        <ul class="app-menu footer-menu list-unstyled">
                            
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('admin/login') ?>">
                                    <span class="nav-icon">
                                        <i class="fa fa-sign-out"></i>
                                    </span>
                                    <span class="nav-link-text">LOGOUT</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!--//app-sidepanel-footer-->

            </div>
            <!--//sidepanel-inner-->
        </div>
        <!--//app-sidepanel-->
    </header>
    <div class="app-wrapper">