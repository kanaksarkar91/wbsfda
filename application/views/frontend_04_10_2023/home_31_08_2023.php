<style>
.form-group .form-content { padding-left:0px !important;}
</style>

<div class="hall-spot-booking">
	<div class="text-center">
		<h6 class="thm-txt fw-normal">Hall & Venue Booking</h6>
	</div>
	<hr>
	<div class="banner-location-flex flex-column">
		<div class="banner-location-single w-100">
			<div class="banner-location-single-flex">
				<div class="banner-location-single-contents">
					<span class="banner-location-single-contents-subtitle"><i class="las la-home"></i> Type </span>
					<select class="form-select" name="state">
						<option value="2">Hall & Venue Booking</option>
					</select>
				</div>
			</div>
		</div>
		<div class="banner-location-single w-100">
			<div class="banner-location-single-flex">
				<div class="banner-location-single-contents">
					<span class="banner-location-single-contents-subtitle"><i class="las la-map-marker-alt"></i> Location </span>
					<select class="form-select" name="state">
						<option value="1">Nalban Food Park</option>
						<option value="2">Oceana Guest House Complex</option>
						<option value="3">Amarabati Park</option>
					</select>
				</div>
			</div>
		</div>
		<div class="banner-location-single w-100">
			<div class="banner-location-single-flex">
				<div class="banner-location-single-contents">
					<span class="banner-location-single-contents-subtitle"><i class="las la-calendar"></i> Check In - Check Out </span>
					<input class="form-control" type="text" name="daterange" value="01/01/2018 - 01/15/2018">
				</div>
			</div>
		</div>
		<div class="banner-location-single-search w-100">
			<button class="btn btn-primary w-100">
				Submit <i class="las la-chevron-circle-right"></i> 
			</button>
		</div>
	</div>
</div>

<!-- ======================= Start Banner ===================== -->
<div id="carouselExampleFade" class="carousel slide carousel-fade">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="<?php echo base_url();?>public/frontend_assets/assets/img/slider/02.jpg" class="d-block w-100" alt="...">
			<div class="carousel-caption d-none d-md-block">
				<h5>Oceana Guest House Complex</h5>
			</div>
		</div>
		<div class="carousel-item">
			<img src="<?php echo base_url();?>public/frontend_assets/assets/img/slider/03.jpg" class="d-block w-100" alt="...">
			<div class="carousel-caption d-none d-md-block">
				<h5>Matshyagandha Guest House at Shankarpur</h5>
			</div>
		</div>
		<div class="carousel-item">
			<img src="<?php echo base_url();?>public/frontend_assets/assets/img/slider/04.jpg" class="d-block w-100" alt="...">
			<div class="carousel-caption d-none d-md-block">
				<h5>Shankarpur</h5>
			</div>
		</div>
		<div class="carousel-item">
			<img src="<?php echo base_url();?>public/frontend_assets/assets/img/slider/05.jpg" class="d-block w-100" alt="...">
			<div class="carousel-caption d-none d-md-block">
				<h5>Nalban Fisheries Project</h5>
			</div>
		</div>
		<div class="carousel-item">
			<img src="<?php echo base_url();?>public/frontend_assets/assets/img/slider/06.jpg" class="d-block w-100" alt="...">
			<div class="carousel-caption d-none d-md-block">
				<h5>Nalban Food Park</h5>
			</div>
		</div>
		<div class="carousel-item">
			<img src="<?php echo base_url();?>public/frontend_assets/assets/img/slider/07.jpg" class="d-block w-100" alt="...">
			<div class="carousel-caption d-none d-md-block">
				<h5>Oceana Guest House Complex</h5>
			</div>
		</div>
		<div class="carousel-item">
			<img src="<?php echo base_url();?>public/frontend_assets/assets/img/slider/08.jpg" class="d-block w-100" alt="...">
			<div class="carousel-caption d-none d-md-block">
				<h5>Nalban Food Park</h5>
			</div>
		</div>
		<div class="carousel-item">
			<img src="<?php echo base_url();?>public/frontend_assets/assets/img/slider/09.jpg" class="d-block w-100" alt="...">
			<div class="carousel-caption d-none d-md-block">
				<h5>Jamunadighi Fisheries Project</h5>
			</div>
		</div>
		<div class="carousel-item">
			<img src="<?php echo base_url();?>public/frontend_assets/assets/img/slider/11.jpg" class="d-block w-100" alt="...">
			<div class="carousel-caption d-none d-md-block">
				<h5>Bhuribhoj Restaurant at Nalban Food Park</h5>
			</div>
		</div>
		<div class="carousel-item">
			<img src="<?php echo base_url();?>public/frontend_assets/assets/img/slider/12.jpg" class="d-block w-100" alt="...">
			<div class="carousel-caption d-none d-md-block">
				<h5>Bhuribhoj Restaurant at Nalban Food Park</h5>
			</div>
		</div>
		<div class="carousel-item">
			<img src="<?php echo base_url();?>public/frontend_assets/assets/img/slider/13.jpg" class="d-block w-100" alt="...">
			<div class="carousel-caption d-none d-md-block">
				<h5>Nalban Fisheries Project</h5>
			</div>
		</div>
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
	  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	  <span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
	  <span class="carousel-control-next-icon" aria-hidden="true"></span>
	  <span class="visually-hidden">Next</span>
	</button>
</div>
<!-- ======================= End Banner ===================== -->

<!-- ======================= Search Form ===================== -->
	<div class="location-area">
        <div class="container">
            <div class="banner-location bg-white radius-5">
			<form action="<?= base_url('frontend/booking/search/'); ?>" method="get" class="st-search-form-tour icon-frm withlbl">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="banner-location-flex">
                    <div class="banner-location-single">
                        <div class="banner-location-single-flex">
                            <div class="banner-location-single-contents">
                                <span class="banner-location-single-contents-subtitle"><i class="las la-home"></i> Type </span>
                                <select class="form-select" name="type" id="property_type">
									<!--<option value="" data-hall="0">Select Type</option>-->
									<?php
									if (isset($property_types))
										foreach ($property_types as $type) {
									?>
									<option value="<?= $type['id']; ?>" data-hall="<?= $type['is_hall'];?>"><?= $type['property_type_name']; ?></option>
									<?php } ?>
								</select>
                            </div>
                        </div>
                    </div>
                    <div class="banner-location-single">
                        <div class="banner-location-single-flex">
                            <div class="banner-location-single-contents">
                                <span class="banner-location-single-contents-subtitle"><i class="las la-map-marker-alt"></i> Location </span>
                               <select class="form-select" name="landscape" id="landscape">
									<option value="">Select Location</option>
									<?php
									if (isset($terrains))
										foreach ($terrains as $loc) {
									?>
									<option value="<?= $loc['terrain_id']; ?>"><?= $loc['terrain_name']; ?></option>
									<?php } ?>
								</select>
                            </div>
                        </div>
                    </div>
                    <div class="banner-location-single">
                        <div class="banner-location-single-flex">
                            <div class="banner-location-single-contents">
                                <span class="banner-location-single-contents-subtitle"><i class="las la-calendar"></i> Check In - Check Out </span>
                                <input type="text" id="checkInOut" class="form-control check-in-out" value="<?= date('d/m/Y', strtotime('+1 day'));?> - <?= date('d/m/Y', strtotime('+2 days'));?>" />
								<input type="hidden" name="checkindt" id="checkindt" value="<?= date('dmY', strtotime('+1 day'));?>" />
								<input type="hidden" name="checkoutdt" id="checkoutdt" value="<?= date('dmY', strtotime('+2 days'));?>" />
                            </div>
                        </div>
                    </div>
					
					<div class="col-lg-2 col-md-6 border-right dropdown form-select-guests mnbr">
						<div class="form-group">
							<span class="banner-location-single-contents-subtitle"><i class="ti-user field-icon"></i> Guests </span>
							<div class="form-content dropdown-toggle" data-toggle="dropdown">
								<div class="wrapper-more">
									<div class="render">
										<span class="adults"><span class="one ">1 Adult</span> <span class=" d-none  multi" data-html=":count Adults">1 Adults</span></span>-
										<span class="children">
										<span class="one " data-html=":count Child">0 Child</span>
										<span class="multi  d-none" data-html=":count Children">0 Children</span>
										</span>
									</div>
								</div>
							</div>
							<div class="dropdown-menu select-guests-dropdown">
								<input type="hidden" name="adults" value="1" min="1" max="20">
								<input type="hidden" name="children" value="0" min="0" max="20">
								<div class="dropdown-item-row">
									<div class="label">Adults</div>
									<div class="val">
										<span class="btn-minus" data-input="adults"><i class="ti-minus"></i></span>
										<span class="count-display">1</span>
										<span class="btn-add" data-input="adults"><i class="ti-plus"></i></span>
									</div>
								</div>
								<div class="dropdown-item-row">
									<div class="label">Children</div>
									<div class="val">
										<span class="btn-minus" data-input="children"><i class="ti-minus"></i></span>
										<span class="count-display">0</span>
										<span class="btn-add" data-input="children"><i class="ti-plus"></i></span>
									</div>
								</div>
							</div>
						</div>
					</div>

                    <div class="banner-location-single-search">
                        <button class="btn btn-primary w-100" type="submit">BOOK NOW <i class="las la-chevron-circle-right"></i></button>
                    </div>
                </div>
			</form>
            </div>
        </div>
    </div>
<!-- ======================= Search Form ===================== -->

	<section>
        <div class="container">
            <div class="card-header" style="background:#00bdd6; border-radius: 0 0 12px 12px;">
                <marquee width="100%" direction="left" height="36px" onMouseOver="this.stop()" onMouseOut="this.start()">
                    <h4 class="mb-0 mt-2 text-white fw-bold blink"><a href="#.">Lawns and halls are available at Nalban Food Park for the purposes of business conferences, seminars, marriages, parties and cocktails.For booking or details, kindly contact Mr. Tushar Mukherjee (Project- In- Charge) at 9433087402 or at our head office at Bikash Bhawan at (033) 23376469.</a></h4>
                </marquee>
            </div>
        </div>
    </section>
	
	<section class="attraction-area pat-50 pab-50">
        <div class="container">
            <div class="section-title center-text">
                <h2 class="title"> Attractive Places </h2>
                <div class="section-title-line"> </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="global-slick-init attraction-slider nav-style-one nav-color-two slider-inner-margin" data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="4" data-swipeToSlide="true" data-autoplay="true" data-autoplaySpeed="2500" data-prevArrow="<div class=&quot;prev-icon radius-parcent-50&quot;><i class=&quot;las la-angle-left&quot;></i></div>"
                        data-nextArrow="<div class=&quot;next-icon radius-parcent-50&quot;><i class=&quot;las la-angle-right&quot;></i></div>" data-responsive="[{&quot;breakpoint&quot;: 1400,&quot;settings&quot;: {&quot;slidesToShow&quot;: 4}},{&quot;breakpoint&quot;: 1200,&quot;settings&quot;: {&quot;slidesToShow&quot;: 3}},{&quot;breakpoint&quot;: 992,&quot;settings&quot;: {&quot;slidesToShow&quot;: 3}},{&quot;breakpoint&quot;: 768,&quot;settings&quot;: {&quot;slidesToShow&quot;: 2}},{&quot;breakpoint&quot;: 576, &quot;settings&quot;: {&quot;slidesToShow&quot;: 1} }]">
                        <div class="attraction-item">
                            <div class="single-attraction-two radius-20">
                                <div class="single-attraction-two-thumb">
                                    <a href="property-details.html"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/place-1.jpg" alt="img"> </a>
                                </div>
                                <div class="single-attraction-two-contents center-text">
                                    <h4 class="single-attraction-two-contents-title"> <a href="property-details.html"> Places Name </a> </h4>
                                    <a href="property-details.html" class="single-attraction-two-contents-para"> Book Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="attraction-item">
                            <div class="single-attraction-two radius-20">
                                <div class="single-attraction-two-thumb">
                                    <a href="property-details.html"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/place-2.png" alt="img"> </a>
                                </div>
                                <div class="single-attraction-two-contents center-text">
                                    <h4 class="single-attraction-two-contents-title"> <a href="property-details.html"> Places Name </a> </h4>
                                    <a href="property-details.html" class="single-attraction-two-contents-para"> Book Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="attraction-item">
                            <div class="single-attraction-two radius-20">
                                <div class="single-attraction-two-thumb">
                                    <a href="property-details.html"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/place-3.jpg" alt="img"> </a>
                                </div>
                                <div class="single-attraction-two-contents center-text">
                                    <h4 class="single-attraction-two-contents-title"> <a href="property-details.html"> Places Name </a> </h4>
                                    <a href="property-details.html" class="single-attraction-two-contents-para"> Book Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="attraction-item">
                            <div class="single-attraction-two radius-20">
                                <div class="single-attraction-two-thumb">
                                    <a href="property-details.html"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/place-4.jfif" alt="img"> </a>
                                </div>
                                <div class="single-attraction-two-contents center-text">
                                    <h4 class="single-attraction-two-contents-title"> <a href="property-details.html"> Places Name </a> </h4>
                                    <a href="property-details.html" class="single-attraction-two-contents-para"> Book Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="attraction-item">
                            <div class="single-attraction-two radius-20">
                                <div class="single-attraction-two-thumb">
                                    <a href="property-details.html"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/place-5.jpg" alt="img"> </a>
                                </div>
                                <div class="single-attraction-two-contents center-text">
                                    <h4 class="single-attraction-two-contents-title"> <a href="property-details.html"> Places Name </a> </h4>
                                    <a href="property-details.html" class="single-attraction-two-contents-para"> Book Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="attraction-item">
                            <div class="single-attraction-two radius-20">
                                <div class="single-attraction-two-thumb">
                                    <a href="property-details.html"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/place-6.jpg" alt="img"> </a>
                                </div>
                                <div class="single-attraction-two-contents center-text">
                                    <h4 class="single-attraction-two-contents-title"> <a href="property-details.html"> Places Name </a> </h4>
                                    <a href="property-details.html" class="single-attraction-two-contents-para"> Book Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="attraction-item">
                            <div class="single-attraction-two radius-20">
                                <div class="single-attraction-two-thumb">
                                    <a href="property-details.html"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/place-7.jpg" alt="img"> </a>
                                </div>
                                <div class="single-attraction-two-contents center-text">
                                    <h4 class="single-attraction-two-contents-title"> <a href="property-details.html"> Places Name </a> </h4>
                                    <a href="property-details.html" class="single-attraction-two-contents-para"> Book Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="attraction-item">
                            <div class="single-attraction-two radius-20">
                                <div class="single-attraction-two-thumb">
                                    <a href="property-details.html"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/place-8.jpg" alt="img"> </a>
                                </div>
                                <div class="single-attraction-two-contents center-text">
                                    <h4 class="single-attraction-two-contents-title"> <a href="property-details.html"> Places Name </a> </h4>
                                    <a href="property-details.html" class="single-attraction-two-contents-para"> Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
	<section class="about">
        <div class="container">
            <div class="section-title center-text">
                <h2 class="title"> What SFDC Offers </h2>
                <div class="section-title-line"> </div>
            </div>
            <div class="row">
                <div class="mx-auto col-md-10 col-lg-9 center-text">
                    <p>In course of unfolding its array, the SFDC Limited has shaped up some guest houses at diversified extensive and attractive places, alongside delightful and alluring locations of its projects in the state. They have gained popularity
                        owing to the solitary natural scenic elegance twined with feasibility of appetizing and flavorsome fish food items. Oceana Complex near Udaypur sea beach, New Digha, Old Digha Bungalow, Krishnabandh Complex, Bishnupur, Bankura,
                        Giriraj Complex, Siliguri, Jamunadighi Amrapalli Complex, near Valki machan forest, Bardhaman, Sundari and Mnagrove Complex, Henry's Island near Bakkhali, South 24 Parganas, Frasergunj Complex, South 24 parganas, and Nalban Food
                        Park are the eminent complexes attributed to the Corporation. In addition to the above noted facility, SFDC now brings to you food and restaurant service, home delivery of raw, frozen, dry fish and luscious fish food items.</p>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 mt-4 mx-auto">
                    <img src="<?php echo base_url();?>public/frontend_assets/assets/img/slider/02.jpg" class="img-fluid d-block mx-auto radius-20">
                </div>
            </div>
        </div>
    </section>
	
	<section class="bg-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card radius-10" style="background:#00bdd6;">
                        <div class="card-header" style="background:#0090a3;">
                            <h6 class="fw-bold text-white">News & Announcement</h6>
                        </div>
                        <div class="card-body">
                            <marquee width="100%" direction="up" height="248px" onMouseOver="this.stop()" onMouseOut="this.start()">
                                <h4 class="mb-3 text-white"><a href="#.">Lawns and halls are available at Nalban Food Park for the purposes of business conferences, seminars, marriages, parties and cocktails.For booking or details, kindly contact Mr. Tushar Mukherjee (Project- In- Charge) at 9433087402 or at our head office at Bikash Bhawan at (033) 23376469.</a></h4>
                            </marquee>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single-team center-text">
                        <div class="single-team-thumb">
                            <a href="javascript:void(0)"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/Chairmanpic.jpg" alt="img"> </a>
                        </div>
                        <div class="single-team-contents">
                            <h4 class="single-team-contents-title"> Shri Biplab Roy Chowdhury </h4>
                            <p class="single-team-contents-subtitle"> Honourable Chairman </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single-team center-text">
                        <div class="single-team-thumb">
                            <a href="javascript:void(0)"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/MD_Pic.jpg" alt="img"> </a>
                        </div>
                        <div class="single-team-contents">
                            <h4 class="single-team-contents-title"> Dr.Vishwanath [IAS] </h4>
                            <p class="single-team-contents-subtitle"> Managing Director </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single-team center-text">
                        <div class="single-team-thumb">
                            <a href="javascript:void(0)"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/dummy-image.jpg" alt="img"> </a>
                        </div>
                        <div class="single-team-contents">
                            <h4 class="single-team-contents-title"> Shri Bijoy Kumar Das </h4>
                            <p class="single-team-contents-subtitle"> Director </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
	<section class="booking-two-area pat-100 pab-50">
        <div class="container">
            <div class="row g-4">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="section-title-booking">
                        <div class="section-title-three">
                            <h2 class="title"> A New Experience with SFDC </h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-why-two bg-white single-why-two-border radius-10">
                        <div class="single-why-two-flex">
                            <div class="single-why-two-icon">
                                <i class="las la-fish"></i>
                            </div>
                            <div class="single-why-two-contents">
                                <h4 class="single-why-two-contents-title"> <a href="javascript:void(0)"> Retail & Online Fish Sale </a> </h4>
                                <p class="single-why-two-contents-para mt-2"> S.F.D.C LTD. has amplified its activities in sectors like retail fish marketing & has set up fisheries products outlets along with online web based fish sale. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-why-two bg-white single-why-two-border radius-10">
                        <div class="single-why-two-flex">
                            <div class="single-why-two-icon">
                                <i class="las la-utensils"></i>
                            </div>
                            <div class="single-why-two-contents">
                                <h4 class="single-why-two-contents-title"> <a href="javascript:void(0)"> Exclusive Dishes </a> </h4>
                                <p class="single-why-two-contents-para mt-2"> S.F.D.C Ltd. serves the flavours of nature on your platter. Deliciousness jumping into the mouth. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-why-two bg-white single-why-two-border radius-10">
                        <div class="single-why-two-flex">
                            <div class="single-why-two-icon">
                                <i class="las la-star"></i>
                            </div>
                            <div class="single-why-two-contents">
                                <h4 class="single-why-two-contents-title"> <a href="javascript:void(0)"> Eco Tourism </a> </h4>
                                <p class="single-why-two-contents-para mt-2"> S.F.D.C Ltd. has constructed some guest houses amidst exquisite locations inspiring destination within your reach. Journey at its luxurious best. </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-md-10 col-lg-8 mx-auto center-text">
                    <h3 class="mb-4 thm-txt fw-light">The State fisheries Development Corporation Ltd.</h3>
                    <p>was set up by the Department of Fisheries in the year 1966 for promotion of pisciculture in the State of West Bengal. Sewage fed fisheries, Sweet water fisheries and Brackish water fisheries were the main activities of this Corporation.
                        At present the Corporation has diversified its activities and taken up retails and online fish sale service, eco-tourism service and food service in different parts of the State.</p>
                </div>

            </div>
        </div>
    </section>
	
	<section class="attraction-area pat-50 pab-50">
        <div class="container">
            <div class="section-title center-text">
                <h2 class="title"> Explore the Beauty of Eco Tourism</h2>
                <div class="section-title-line"> </div>
            </div>
            <div class="row g-4 mt-4">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-attraction-two radius-20">
                        <div class="single-attraction-two-thumb">
                            <a href="assets/img/13.jpg" class="gallery-popup-two"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/13.jpg" alt="img"> </a>
                        </div>
                        <div class="single-attraction-two-contents center-text">
                            <h4 class="single-attraction-two-contents-title">Image Title</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-attraction-two radius-20">
                        <div class="single-attraction-two-thumb">
                            <a href="assets/img/1.jpg" class="gallery-popup-two"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/1.jpg" alt="img"> </a>
                        </div>
                        <div class="single-attraction-two-contents center-text">
                            <h4 class="single-attraction-two-contents-title">Image Title</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-attraction-two radius-20">
                        <div class="single-attraction-two-thumb">
                            <a href="assets/img/16.jpg" class="gallery-popup-two"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/16.jpg" alt="img"> </a>
                        </div>
                        <div class="single-attraction-two-contents center-text">
                            <h4 class="single-attraction-two-contents-title">Image Title</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-attraction-two radius-20">
                        <div class="single-attraction-two-thumb">
                            <a href="assets/img/17.jpg" class="gallery-popup-two"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/17.jpg" alt="img"> </a>
                        </div>
                        <div class="single-attraction-two-contents center-text">
                            <h4 class="single-attraction-two-contents-title">Image Title</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-attraction-two radius-20">
                        <div class="single-attraction-two-thumb">
                            <a href="assets/img/18.jpg" class="gallery-popup-two"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/18.jpg" alt="img"> </a>
                        </div>
                        <div class="single-attraction-two-contents center-text">
                            <h4 class="single-attraction-two-contents-title">Image Title</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-attraction-two radius-20">
                        <div class="single-attraction-two-thumb">
                            <a href="assets/img/19.jpg" class="gallery-popup-two"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/19.jpg" alt="img"> </a>
                        </div>
                        <div class="single-attraction-two-contents center-text">
                            <h4 class="single-attraction-two-contents-title">Image Title</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-attraction-two radius-20">
                        <div class="single-attraction-two-thumb">
                            <a href="assets/img/20.jpg" class="gallery-popup-two"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/20.jpg" alt="img"> </a>
                        </div>
                        <div class="single-attraction-two-contents center-text">
                            <h4 class="single-attraction-two-contents-title">Image Title</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-attraction-two radius-20">
                        <div class="single-attraction-two-thumb">
                            <a href="assets/img/21.jpg" class="gallery-popup-two"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/21.jpg" alt="img"> </a>
                        </div>
                        <div class="single-attraction-two-contents center-text">
                            <h4 class="single-attraction-two-contents-title">Image Title</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
	<section class="guest-area pat-50 pab-50">
        <div class="container">
            <div class="section-title-three append-flex">
                <h2 class="title"> Thoughts from our guests </h2>
                <div class="append-attraction append-color-two"></div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="global-slick-init guest-two-slider nav-style-one slider-inner-margin" data-appendArrows=".append-attraction" data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="3" data-swipeToSlide="true" data-autoplay="true" data-autoplaySpeed="2500"
                        data-prevArrow="<div class=&quot;prev-icon radius-parcent-50&quot;><i class=&quot;las la-angle-left&quot;></i></div>" data-nextArrow="<div class=&quot;next-icon radius-parcent-50&quot;><i class=&quot;las la-angle-right&quot;></i></div>"
                        data-responsive="[{&quot;breakpoint&quot;: 1400,&quot;settings&quot;: {&quot;slidesToShow&quot;: 3}},{&quot;breakpoint&quot;: 1200,&quot;settings&quot;: {&quot;slidesToShow&quot;: 3}},{&quot;breakpoint&quot;: 992,&quot;settings&quot;: {&quot;slidesToShow&quot;: 2}},{&quot;breakpoint&quot;: 576, &quot;settings&quot;: {&quot;slidesToShow&quot;: 1} }]">
                        <div class="guest-two-item">
                            <div class="single-guest-two single-guest-two-border radius-20">
                                <div class="single-guest-two-flex">
                                    <div class="single-guest-two-thumb">
                                        <a href="javascript:void(0)"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/guest/g1.jpg" alt="img"> </a>
                                    </div>
                                    <div class="single-guest-two-contents">
                                        <h4 class="single-guest-two-contents-title"> <a href="javascript:void(0)"> Amalendu Bagchi </a> </h4>
                                        <div class="single-guest-two-contents-country">
                                            <span class="single-guest-two-contents-country-name"> KOLKATA </span>
                                        </div>
                                    </div>
                                </div>
                                <p class="single-guest-two-para mt-3"> Amet minim mollit non deserunt ullamco est sit aliq dolor do amet sint. Velit officia consequat duis enilk velit mollit. </p>
                            </div>
                        </div>
                        <div class="guest-two-item">
                            <div class="single-guest-two single-guest-two-border radius-20">
                                <div class="single-guest-two-flex">
                                    <div class="single-guest-two-thumb">
                                        <a href="javascript:void(0)"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/guest/g2.jpg" alt="img"> </a>
                                    </div>
                                    <div class="single-guest-two-contents">
                                        <h4 class="single-guest-two-contents-title"> <a href="javascript:void(0)"> Srinjini Chatterjee </a> </h4>
                                        <div class="single-guest-two-contents-country">
                                            <span class="single-guest-two-contents-country-name"> KOLKATA </span>
                                        </div>
                                    </div>
                                </div>
                                <p class="single-guest-two-para mt-3"> Amet minim mollit non deserunt ullamco est sit aliq dolor do amet sint. Velit officia consequat duis enilk velit mollit. </p>
                            </div>
                        </div>
                        <div class="guest-two-item">
                            <div class="single-guest-two single-guest-two-border radius-20">
                                <div class="single-guest-two-flex">
                                    <div class="single-guest-two-thumb">
                                        <a href="javascript:void(0)"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/guest/g3.jpg" alt="img"> </a>
                                    </div>
                                    <div class="single-guest-two-contents">
                                        <h4 class="single-guest-two-contents-title"> <a href="javascript:void(0)"> Antara Samaddar </a> </h4>
                                        <div class="single-guest-two-contents-country">
                                            <span class="single-guest-two-contents-country-name"> KOLKATA </span>
                                        </div>
                                    </div>
                                </div>
                                <p class="single-guest-two-para mt-3"> Amet minim mollit non deserunt ullamco est sit aliq dolor do amet sint. Velit officia consequat duis enilk velit mollit. </p>
                            </div>
                        </div>
                        <div class="guest-two-item">
                            <div class="single-guest-two single-guest-two-border radius-20">
                                <div class="single-guest-two-flex">
                                    <div class="single-guest-two-thumb">
                                        <a href="javascript:void(0)"> <img src="<?php echo base_url();?>public/frontend_assets/assets/img/guest/g2.jpg" alt="img"> </a>
                                    </div>
                                    <div class="single-guest-two-contents">
                                        <h4 class="single-guest-two-contents-title"><a href="javascript:void(0)"> Sri Manas Sarkar </a> </h4>
                                        <div class="single-guest-two-contents-country">
                                            <span class="single-guest-two-contents-country-name"> KOLKATA </span>
                                        </div>
                                    </div>
                                </div>
                                <p class="single-guest-two-para"> Amet minim mollit non deserunt ullamco est sit aliq dolor do amet sint. Velit officia consequat duis enilk velit mollit. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
	<section class="booking-area pat-50 pab-50">
        <div class="section-title center-text">
            <h2 class="title"> CONTACT US</h2>
            <div class="section-title-line"> </div>
        </div>
        <div class="container">
            <div class="row gy-4 mt-5">
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInRight" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInRight;">
                    <div class="single-why center-text bg-white single-why-border radius-10">
                        <div class="single-why-icon">
                            <img src="<?php echo base_url();?>public/frontend_assets/assets/img/android.png">
                        </div>
                        <div class="single-why-contents mt-3">
                            <h4 class="single-why-contents-title"> <a href="javascript:void(0)"> Download the SFDC App </a> </h4>
                            <p class="single-why-contents-para mt-3"> Now you can order fish,fish products and your favourite dish through SFDC App & also book your travel destinations from SFDC App. </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 wow zoomIn" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: zoomIn;">
                    <div class="single-why center-text bg-white single-why-border radius-10">
                        <div class="single-why-icon">
                            <img src="<?php echo base_url();?>public/frontend_assets/assets/img/placeholder.png">
                        </div>
                        <div class="single-why-contents mt-3">
                            <h4 class="single-why-contents-title"> <a href="javascript:void(0)"> Address </a> </h4>
                            <p class="single-why-contents-para mt-3"> Bikash Bhawan, North Block,1st Floor, Salt Lake, Kolkata-700091 </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInLeft" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                    <div class="single-why center-text bg-white single-why-border radius-10">
                        <div class="single-why-icon">
                            <img src="<?php echo base_url();?>public/frontend_assets/assets/img/phone.png">
                        </div>
                        <div class="single-why-contents mt-3">
                            <h4 class="single-why-contents-title"> <a href="javascript:void(0)"> Phone Number </a> </h4>
                            <p class="single-why-contents-para mt-3"> Head Office: (033)-23583123<br> Guest House Booking Query : <br>(033)-23376469 </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInLeft" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                    <div class="single-why center-text bg-white single-why-border radius-10">
                        <div class="single-why-icon">
                            <img src="<?php echo base_url();?>public/frontend_assets/assets/img/message.png">
                        </div>
                        <div class="single-why-contents mt-3">
                            <h4 class="single-why-contents-title"> <a href="javascript:void(0)"> Email </a> </h4>
                            <p class="single-why-contents-para mt-3"> headoffice@wbsfdcltd.com<br>tourism@wbsfdcltd.com </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>