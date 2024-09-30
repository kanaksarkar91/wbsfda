<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Property Details</h1>
            </div>
            <div class="col-auto">
                
            </div>
        </div>

        <div class="row g-3">
            <?php if(isset($venues)){?>
                <div class="col-xl-8 col-lg-7">
                    <div class="app-card app-card-settings shadow-sm p-3">
                        <h4 class="mb-3 thm-txt fw-normal"> <?=$venues[0]->venue_names ?> </h4>
                        
                        <div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">

                                <!--<div class="carousel-item active"><img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/19.jpg" class="d-block w-100" alt=""></div>
                                <div class="carousel-item"><img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/20.jpg" class="d-block w-100" alt=""></div>    
                                <div class="carousel-item"><img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/19.jpg" class="d-block w-100" alt=""></div> 
                                <div class="carousel-item"><img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/20.jpg" class="d-block w-100" alt=""></div>--> 

                                <?php if($venues[0]->image1 || $venues[0]->image2 || $venues[0]->image3 || $venues[0]->image4){ ?>

                                    <?php if($venues[0]->image1){ ?>
                                        <div class="carousel-item active"><img src="<?=base_url('/public/admin_images/').$venues[0]->image1 ?>" class="d-block w-100" alt=""></div>
                                    <?php } ?>

                                    <?php if($venues[0]->image2){ ?>
                                        <div class="carousel-item"><img src="<?=base_url('/public/admin_images/').$venues[0]->image2 ?>" class="d-block w-100" alt=""></div>
                                    <?php } ?>

                                    <?php if($venues[0]->image3){ ?>
                                        <div class="carousel-item"><img src="<?=base_url('/public/admin_images/').$venues[0]->image3 ?>" class="d-block w-100" alt=""></div>
                                    <?php } ?>

                                    <?php if($venues[0]->image4){ ?>
                                        <div class="carousel-item"><img src="<?=base_url('/public/admin_images/').$venues[0]->image4 ?>" class="d-block w-100" alt=""></div>
                                    <?php } ?>

                                <?php } else { ?>
                                    <div class="carousel-item active"><img src="<?=base_url('/public/frontend_assets/images/'); ?>placeholder.jpg" class="d-block w-100" alt=""></div>
                                <?php } ?>

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button> <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
                        </div>
                        <!-- <div class="details-contents-thumb details-contents-main-thumb bg-image">
                            <img src="<?=base_url('/public/admin_images/').$venues[0]->image1 ?>" alt="img" class="img-fluid d-block mx-auto rounded">
                        </div> -->

                        <ul class="list-unstyled">
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-map-marker"></i> </span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Location:</span> <?=$venues[0]->property_name?> </span>
                            </li>
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-street-view"></i> </span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Address:</span> <?=$venues[0]->property_address_line_1?> </span>
                            </li>
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-phone"></i> </span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Contact No.:</span> <?=$venues[0]->property_phone_no?> </span>
                            </li>
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-envelope-o"></i> </span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">e-mail ID:</span> <?=$venues[0]->property_email?> </span>
                            </li>
                            <?php if($venues[0]->approx_capacity) {?>
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-users"></i> </span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Approx Capacity:</span> <?=$venues[0]->approx_capacity?></span>
                            </li>
                            <?php }?>
                            <?php if($venues[0]->available_timming) {?>
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-clock-o"></i> </span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Available Timming:</span> <?=$venues[0]->available_timming?></span>
                            </li>
                            <?php }?>
                        </ul>

                        <div class="details-contents-tab">
                            <ul class="tabs details-tab details-tab-border list-unstyled">
                                <li class="fw-bold active" data-tab="description" style="color: #00bdd6;"> Description </li>
                            </ul>
                            <div id="description" class="tab-content-item active">
                                <div class="about-tab-contents">
                                    <p class="about-tab-contents-para"> <?=$venues[0]->venue_description?> </p>
                                </div>
                            </div>
                        </div>

                        <a href="<?= base_url('check-admin-venue-available-rate/') ?><?= $venues[0]->rate_id.'/'.$check_in_date_formatted.'/'.$check_out_date_formatted ?>" class="btn app-btn-primary"> Check Availability & Rates </a>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="app-card app-card-settings shadow-sm p-3">
                        <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDK4rMTf9bUlqpg1g8SF2zUnV4HQmatsVo&q=<?= $venues[0]->property_google_map_address ?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>



