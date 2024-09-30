

            <section class="hotel-details-area pat-30 pab-30">
                <div class="container">
                    <div class="row g-4">
					<?php if(isset($venues)){?>

                        <div class="col-xl-8 col-lg-7">
                            <div class="details-left-wrapper">
                                <div class="details-contents bg-white radius-10">
                                    <div class="details-contents-header">
                                        <h4 class="mb-3"> <?=$venues[0]->venue_names ?> </h4>
                                        <div class="details-contents-thumb details-contents-main-thumb bg-image">
                                            <img src="<?=base_url('/public/admin_images/').$venues[0]->image1 ?>" alt="img" class="img-fluid d-block mx-auto">
                                            <!-- style="background-image: url(assets/img/nalban-food-park.png);"> -->
                                        </div>
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
                                                <span class="hotel-view-contents-location-para"> Location: <?=$venues[0]->property_name?> </span>
                                            </div>
                                            <div class="hotel-view-contents-location mt-2">
                                                <span class="hotel-view-contents-location-icon"> <i class="las la-map-marked-alt"></i> </span>
                                                <span class="hotel-view-contents-location-para"> Address: <?=$venues[0]->property_address_line_1?> </span>
                                            </div>
                                            <div class="hotel-view-contents-location mt-2">
                                                <span class="hotel-view-contents-location-icon"> <i class="las la-phone"></i> </span>
                                                <span class="hotel-view-contents-location-para"> Contact: <?=$venues[0]->property_phone_no?> </span>
                                            </div>
                                            <div class="hotel-view-contents-location mt-2">
                                                <span class="hotel-view-contents-location-icon"> <i class="las la-envelope"></i> </span>
                                                <span class="hotel-view-contents-location-para"> Email: <?=$venues[0]->property_email?> </span>
                                            </div>
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
                                                <p class="about-tab-contents-para"> <?=$venues[0]->venue_description?> </p>
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
                                                <a href="<?php echo base_url('check-venue-available-rate/') ?><?php echo $venues[0]->rate_id ?>" class="cmn-btn btn-bg-1 btn-small"> Check Availability & Rates </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5">
                            <div class="details-contents bg-white radius-10 p-3">
                                <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDK4rMTf9bUlqpg1g8SF2zUnV4HQmatsVo&q=<?= $venues[0]->property_google_map_address ?>"
                                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
					<?php } ?>

                </div>
            </section>


