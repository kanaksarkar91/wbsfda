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
    <title>Department of WBSFDA Admin</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta content="noindex, nofollow" name="robots">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <meta name="description" content="Department of WBSFDA Admin" />
    <meta name="author" content="Department of WBSFDA Admin" />
    <link rel="shortcut icon" href="<?=base_url('public/frontend_assets/assets/img/favicon.png')?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/css/font-awesome.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/css/daterangepicker.css') ?>" />

    <!-- summernote -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/summernote/summernote-bs4.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/css/jquery.dataTables.min.css') ?>" />

    <link rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/css/jquery.datetimepicker.css') ?>" />
    <link rel="stylesheet" type="text/css" href=<?= base_url('public/admin_assets/css/main.min.css') ?> />


    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/css/style.css') ?>" />
    <link id="theme-style" rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/css/theme.css') ?>" />
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/css/jquery.timepicker.min.css');?>" />

    <!-- Select2 -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/select2/css/select2.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/css/jquery-ui.css') ?>" />

    
	

    <script src="<?= base_url('public/admin_assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('public/admin_assets/js/jquery-ui.js') ?>"></script>
    <script src="<?= base_url('public/admin_assets/plugins/popper.min.js') ?>"></script>
    <script src="<?= base_url('public/admin_assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/admin_assets/css/jquery-confirm.min.css') ?>" />
    <script src="<?= base_url('public/admin_assets/js/jquery-confirm.min.js') ?>"></script>
	
	<script src="<?= base_url('public/admin_assets/js/jquery.validate.min.js') ?>"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tooltip.js/1.3.1/tooltip.min.js"></script> -->

</head>

<body class="app"  id="blurme">
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
                        <span class="logo-text">SFDA, West Bengal</span>
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

                                                        //echo $option_menu['menu_link']."<br>";

                                                        $slug = explode("/", $option_menu['menu_link'])[1];
                                                        $slugsec = explode("/", $option_menu['menu_link'])[2];
                                                ?>
                                                <li class="submenu-item">
                                                    <a class="submenu-link" data-parent="submenu-<?=$index?>" href="<?= base_url($option_menu['menu_link']) ?>" data-slug="<?= $slug; ?>" data-slugsec="<?= $slugsec; ?>"><?= ucwords($option_menu['menu_name']) ?></a>
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