
            <div class="breadcrumb-area section-bg-2 breadcrumb-padding">
                <div class="container custom-container-one">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb-contents">
                                <h4 class="breadcrumb-contents-title"> Property Details </h4>
                                <ul class="breadcrumb-contents-list list-style-none">
                                    <li class="breadcrumb-contents-list-item"> <a href="<?= base_url()?>" class="breadcrumb-contents-list-item-link"> Home </a> </li>
                                    <li class="breadcrumb-contents-list-item"> <a href="#." class="breadcrumb-contents-list-item-link prevUrl"> Hall &amp; Venue Booking </a> </li>
                                    <li class="breadcrumb-contents-list-item"> Property Details </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section class="hotel-details-area pat-30 pab-30">
                <div class="container">
                    <div class="row g-4">
					<?php if(isset($venues)){?>

                        <div class="col-xl-8 col-lg-7">
                            <div class="details-left-wrapper">
                                <div class="details-contents bg-white radius-10">
                                    <div class="details-contents-header">
                                        <h4 class="mb-3 thm-txt fw-normal"> <?=$venues['venue_names'] ?> </h4>
                                        <div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                            <div class="carousel-inner">

                                                <!--<div class="carousel-item active"><img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/19.jpg" class="d-block w-100" alt=""></div>
                                                <div class="carousel-item"><img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/20.jpg" class="d-block w-100" alt=""></div>    
                                                <div class="carousel-item"><img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/19.jpg" class="d-block w-100" alt=""></div> 
                                                <div class="carousel-item"><img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/20.jpg" class="d-block w-100" alt=""></div>--> 

                                                <!--<?php //if($venues['image1'] || $venues['image2'] || $venues['image3'] || $venues['image4']){ ?>

                                                    <?php //if($venues['image1']){ ?>
                                                        <div class="carousel-item active"><img src="<?=base_url('/public/admin_images/').$venues['image1'] ?>" class="d-block w-100" alt=""></div>
                                                    <?php //} ?>

                                                    <?php //if($venues['image1']){ ?>
                                                        <div class="carousel-item"><img src="<?=base_url('/public/admin_images/').$venues['image2'] ?>" class="d-block w-100" alt=""></div>
                                                    <?php //} ?>

                                                    <?php //if($venues['image1']){ ?>
                                                        <div class="carousel-item"><img src="<?=base_url('/public/admin_images/').$venues['image3'] ?>" class="d-block w-100" alt=""></div>
                                                    <?php //} ?>

                                                    <?php //if($venues['image1']){ ?>
                                                        <div class="carousel-item"><img src="<?=base_url('/public/admin_images/').$venues['image4'] ?>" class="d-block w-100" alt=""></div>
                                                    <?php //} ?>

                                                <?php //} else { ?>-->

                                                <?php if(!empty($venues['venue_image'])){ ?>

                                                    <?php $i = 1; ?>

                                                    <?php foreach($venues['venue_image'] as $vimage){ ?>
                                                        
                                                        <div class="carousel-item <?php if($i == 1){ echo 'active'; } ?>"><img src="<?=base_url('/public/admin_images/').$vimage['image_path'] ?>" class="d-block w-100" alt=""></div>

                                                        <?php $i++; ?>

                                                    <?php } ?>

                                                <?php } else { ?>
                                                    <div class="carousel-item active"><img src="<?=base_url('/public/frontend_assets/images/'); ?>placeholder.jpg" class="d-block w-100" alt=""></div>
                                                <?php } ?>
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button> <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
                                        </div>
                                        <!-- <div class="details-contents-thumb details-contents-main-thumb bg-image"> -->
                                            <!-- <img src="<?=base_url('/public/admin_images/').$venues[0]->image1 ?>" alt="img" class="img-fluid d-block mx-auto"> -->
                                            <!-- style="background-image: url(assets/img/nalban-food-park.png);"> -->
                                        <!-- </div> -->
										<!--<div class="details-contents-header-flex">
                                            <div class="details-contents-header-thumb">
                                                <img src="assets/img/DSC0294.jpg" alt="img">
                                            </div>
                                            <div class="details-contents-header-thumb">
                                                <img src="assets/img/hall.jpg" alt="img">
                                            </div>
                                        </div>-->
                                    </div>
									<div class="hotel-view-contents">
                                        <div class="hotel-view-contents-header">
                                            <div class="hotel-view-contents-location mt-2">
                                                <span class="hotel-view-contents-location-icon"> <i class="las la-map-marker-alt"></i> </span>
                                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Location:</span> <?=$venues['property_name']?> </span>
                                            </div>
                                            <div class="hotel-view-contents-location mt-2">
                                                <span class="hotel-view-contents-location-icon"> <i class="las la-map-marked-alt"></i> </span>
                                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Address:</span> <?=$venues['property_address_line_1']?> </span>
                                            </div>
                                            <div class="hotel-view-contents-location mt-2">
                                                <span class="hotel-view-contents-location-icon"> <i class="las la-phone"></i> </span>
                                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Contact No.:</span> <?=$venues['property_phone_no']?> </span>
                                            </div>
                                            <div class="hotel-view-contents-location mt-2">
                                                <span class="hotel-view-contents-location-icon"> <i class="las la-envelope"></i> </span>
                                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">e-mail ID:</span> <?=$venues['property_email']?> </span>
                                            </div>
                                            <?php if($venues['approx_capacity']) {?>
                                            <div class="hotel-view-contents-location mt-2">
                                                <span class="hotel-view-contents-location-icon"> <i class="las la-users"></i> </span>
                                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Approx Maximum Capacity:</span> <?=$venues['approx_capacity']?></span>
                                            </div>
                                            <?php }?>
                                            <?php if($venues['available_timming']) {?>
                                            <div class="hotel-view-contents-location mt-2">
                                                <span class="hotel-view-contents-location-icon"><i class="las la-user-clock"></i> </span>
                                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Available Timming:</span> <?=$venues['available_timming']?></span>
                                            </div>
                                            <?php }?>
                                        </div>
                                        <!-- <div class="hotel-view-contents-middle">
                                    <div class="hotel-view-contents-flex">
                                        <div class="hotel-view-contents-icon d-flex gap-1">
                                            <span> <i class="las la-chevron-circle-right"></i> </span>
                                            <p class="hotel-view-contents-icon-title flex-fill"> Parking </p>
                                        </div>
                                        <div class="hotel-view-contents-icon d-flex gap-1">
                                            <span> <i class="las la-chevron-circle-right"></i> </span>
                                            <p class="hotel-view-contents-icon-title flex-fill"> Wifi </p>
                                        </div>
                                        <div class="hotel-view-contents-icon d-flex gap-1">
                                            <span> <i class="las la-chevron-circle-right"></i> </span>
                                            <p class="hotel-view-contents-icon-title flex-fill"> Breakfast </p>
                                        </div>
                                        <div class="hotel-view-contents-icon d-flex gap-1">
                                            <span> <i class="las la-chevron-circle-right"></i> </span>
                                            <p class="hotel-view-contents-icon-title flex-fill"> Room Service </p>
                                        </div>
                                        <div class="hotel-view-contents-icon d-flex gap-1">
                                            <span> <i class="las la-chevron-circle-right"></i> </span>
                                            <p class="hotel-view-contents-icon-title flex-fill"> Pool </p>
                                        </div>
                                        <div class="hotel-view-contents-icon d-flex gap-1">
                                            <span> <i class="las la-chevron-circle-right"></i> </span>
                                            <p class="hotel-view-contents-icon-title flex-fill"> Reception </p>
                                        </div>
                                        <div class="hotel-view-contents-icon d-flex gap-1">
                                            <span> <i class="las la-chevron-circle-right"></i> </span>
                                            <p class="hotel-view-contents-icon-title flex-fill"> Gym </p>
                                        </div>
                                    </div>
                                </div> -->
                                    </div>
                                    <div class="details-contents-tab">
                                        <ul class="tabs details-tab details-tab-border">
                                            <li class="active" data-tab="description"> Description </li>
                                            <!-- <li data-tab="reviews"> Reviews </li> -->
                                        </ul>
                                        <div id="description" class="tab-content-item active">
                                            <div class="about-tab-contents">
                                                <p class="about-tab-contents-para"> <?=$venues['venue_description']?> </p>
                                                <!--<p class="about-tab-contents-para mt-4"> He lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many
                                                    legs, pitifully thin compared with the size of the rest of him. </p>
                                                <p class="about-tab-contents-para mt-4">
                                                    So many legs pitifully thin compared with the size of the rest of him waved about helplessly as he looked What's happened to me. </p>-->
                                            </div>
                                        </div>


                                        <!-- <div id="reviews" class="tab-content-item">
                                <div class="review-tab-contents">
                                    <div class="review-tab-contents-single">
                                        <div class="rating-wrap">
                                            <div class="ratings">
                                                <span class="hide-rating"></span>
                                                <span class="show-rating"></span>
                                            </div>
                                            <p> <span class="total-ratings">(167)</span></p>
                                        </div>
                                        <p class="about-review-para mt-3"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a egestas leo. Aliquam ut ante lobortis tellus cursus pellentesque. Praesent feugiat tellus quis aliquet </p>
                                        <div class="review-tab-contents-author mt-4">
                                            <h4 class="review-tab-contents-author-name"> Sandra M. Hurt </h4>
                                            <p class="review-tab-contents-author-para mt-2"> TrustPilot </p>
                                        </div>
                                    </div>
                                    <div class="review-tab-contents-single">
                                        <div class="rating-wrap">
                                            <div class="ratings">
                                                <span class="hide-rating"></span>
                                                <span class="show-rating"></span>
                                            </div>
                                            <p> <span class="total-ratings">(236)</span></p>
                                        </div>
                                        <p class="about-review-para mt-3"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a egestas leo. Aliquam ut ante lobortis tellus cursus pellentesque. Praesent feugiat tellus quis aliquet </p>
                                        <div class="review-tab-contents-author mt-4">
                                            <h4 class="review-tab-contents-author-name"> Robert Fox </h4>
                                            <p class="review-tab-contents-author-para mt-2"> Designer </p>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                                    </div>
                                    <div class="hotel-view-contents-bottom">
                                        <div class="hotel-view-contents-bottom-flex">
                                            <!-- <div class="hotel-view-contents-bottom-contents">
                                        <h4 class="hotel-view-contents-bottom-title"> Rs. <small class="text-decoration-line-through">7000</small> 6000.00 </h4>
                                        <p class="hotel-view-contents-bottom-para"> Per calender day </p>
                                    </div> -->
                                            <div class="btn-wrapper">
                                                <a href="<?= base_url('check-venue-available-rate/') ?><?= $venues['rate_id'].'/'.$check_in_date_formatted.'/'.$check_out_date_formatted ?>" class="cmn-btn btn-bg-1 btn-small"> Check Availability & Rates </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5">
                            <div class="details-contents bg-white radius-10 p-3">
                                <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDK4rMTf9bUlqpg1g8SF2zUnV4HQmatsVo&q=<?= $venues['property_google_map_address'] ?>"
                                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
					<?php } ?>

                </div>
            </section>


