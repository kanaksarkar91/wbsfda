<!-- ======================= Start Banner ===================== -->
<div class="main-banner" style="justify-content:end;">
<!--  style="background-image:url(<?= base_url('public/frontend_assets/images/banner/hall-booking/Hall.jpg');?>);" data-overlay="7"> -->
	
	<div class="container">
		<div data-ride="carousel" class="carousel carousel-fade" id="carousel-example-captions">
		<!--	<ol class="carousel-indicators">
				<li class="active" data-slide-to="0" data-target="#carousel-example-captions"></li>
				<li data-slide-to="1" data-target="#carousel-example-captions" class=""></li>
				<li data-slide-to="2" data-target="#carousel-example-captions" class=""></li>
				<li data-slide-to="3" data-target="#carousel-example-captions" class=""></li>
				<li data-slide-to="4" data-target="#carousel-example-captions" class=""></li>
				<li data-slide-to="5" data-target="#carousel-example-captions" class=""></li>
			</ol>-->
			<div role="listbox" class="carousel-inner">
				<div class="carousel-item active">
					<img class="img-fluid" src="<?= base_url('public/frontend_assets/images/banner/hall-booking/Hall.jpg');?>" alt="...">
					
				</div>
				<!--<div class="carousel-item">
					<img class="img-fluid" src="<?= base_url('public/frontend_assets/images/banner/hall-booking/hall-2.jpg');?>" alt="...">
					<div class="carousel-caption">
					<h3>LET YOURSELF EXPERIENCE</h3>
					<h4>Our Halls & Auditoriums</h4>
					</div>
				</div>
				<div class="carousel-item">
					<img class="img-fluid" src="<?= base_url('public/frontend_assets/images/banner/hall-booking/hall-3.jpg');?>" alt="...">
					<div class="carousel-caption">
					<h3>LET YOURSELF EXPERIENCE</h3>
					<h4>Our Halls & Auditoriums</h4>
					</div>
				</div>
				<div class="carousel-item">
					<img class="img-fluid" src="<?= base_url('public/frontend_assets/images/banner/hall-booking/hall-4.jpg');?>" alt="...">
					<div class="carousel-caption">
					<h3>LET YOURSELF EXPERIENCE</h3>
					<h4>Our Halls & Auditoriums</h4>
					</div>
				</div>
				<div class="carousel-item">
					<img class="img-fluid" src="<?= base_url('public/frontend_assets/images/banner/darjeeling-hills.jpg');?>" alt="...">
					<div class="carousel-caption">
					<h3>LET YOURSELF EXPERIENCE</h3>
					<h4>Darjeeling Hills</h4>
					<p>With us</p>
					</div>
				</div>-->
			</div>
		<!--	<a data-slide="prev" role="button" href="#carousel-example-captions" class="left carousel-control">
				<i class="ti-angle-left"></i>
				<span class="sr-only">Previous</span>
			</a>
			<a data-slide="next" role="button" href="#carousel-example-captions" class="right carousel-control">
				<i class="ti-angle-right"></i>
				<span class="sr-only">Next</span>
			</a>-->
		</div>
		<div id="search-section" class="col header-form-sec" style="display: none;">
		    <h4 class="text-white">Explore our Guesthouses, Homestays & other type of properties</h4>
			<form class="header-form" action="<?= base_url('frontend/booking/search/'); ?>" method="get">
			    <div class="form-group mb-2">
			        <input type="text" class="form-control" name="wish" id="search_keywords" placeholder="Enter your wish words">
			    </div>
			    <div class="form-group mb-2">
			        <select class="form-control" name="landscape" id="landscape">
						<option value="">Select Landscape</option>
						<?php
						if ($terrains)
							foreach ($terrains as $terrain) {
						?>
						<option value="<?= $terrain['terrain_id']; ?>"><?= $terrain['terrain_name']; ?></option>
						<?php } ?>
					</select>
			    </div>
			    <div class="form-group mb-2">
			        <select class="form-control" name="district" id="district">
						<option value="">Select District</option>
						<?php
						if ($districts)
							foreach ($districts as $district) {
						?>
						<option value="<?= $district['district_id']; ?>"><?= $district['district_name']; ?></option>
						<?php } ?>
					</select>
			    </div>
			    <div class="form-group mb-2">
			        <select class="form-control" name="type" id="type">
						<option value="" data-hall="0">Select Type</option>
						<?php
						if (isset($property_types))
							foreach ($property_types as $type) {
						?>
						<option value="<?= $type['id']; ?>" data-hall="<?= $type['is_hall'];?>"><?= $type['property_type_name']; ?></option>
						<?php } ?>
					</select>
			    </div>
			    
			    
			    <button class="btn btn-dark btn-md btn-block rounded">Search</button>
			</form>
		</div>
		
		<section class="banner-form-search banner-form-search-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 text-center">
                        <h3>HALL BOOKING</h3>
                    </div>
                    <div class="col-lg-12 col-md-12">
						<form action="<?= base_url('frontend/booking/search/'); ?>" method="get" class="st-search-form-tour icon-frm withlbl">
							<div class="g-field-search">
								<div class="row">
									<div class="col-lg-3 col-md-6 border-right mxnbr">
										<div class="form-group">
											<i class="ti-home field-icon"></i>
											<label>Type</label>
											<!-- <input type="text" class="form-control" placeholder="Where are you going?"> -->
											<select class="form-control" name="type" id="property_type">
												<option value="" data-hall="0">Select Type</option>
												<?php
												if (isset($property_types))
													foreach ($property_types as $type) {
												?>
												<option value="<?= $type['id']; ?>" data-hall="<?= $type['is_hall'];?>"><?= $type['property_type_name']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 border-right mxnbr">
										<div class="form-group">
											<i class="ti-location-pin field-icon"></i>
											<label>Your Desired Location?</label>
											<input type="text" name="destination" id="destination" class="form-control" placeholder="Type here">
										</div>
									</div>

									<div class="col-lg-3 col-md-6 border-right mxnbr">
										<div class="form-group">
											<i class="ti-calendar field-icon"></i>
											<label>From - To</label>
											<input type="text" id="checkInOut" class="form-control check-in-out" value="<?= date('d/m/Y', strtotime('+1 day'));?> - <?= date('d/m/Y', strtotime('+2 days'));?>" />
											<input type="hidden" name="checkindt" id="checkindt" value="<?= date('dmY', strtotime('+1 day'));?>" />
											<input type="hidden" name="checkoutdt" id="checkoutdt" value="<?= date('dmY', strtotime('+2 days'));?>" />
										</div>
									</div>

									<div class="col-lg-3 col-md-6 p-0">
										<div class="form-group search">
											<button class="btn btn-dark btn-search" type="submit">Book Now</button>
										</div>
									</div>
								</div>
							</div>
						</form>
                    </div>
                </div>
            </div>
        </section>
	</div>
	
<!-- ======================= Search Form ===================== -->
	
<!-- ======================= Search Form ===================== -->

</div>
<!-- ======================= End Banner ===================== -->


<!-- ================= true Facts start ========================= -->
<!-- <section class="facts">
	<div class="container">
		<div class="row">

			<div class="col-lg-4 col-md-4">
				<div class="facts-wrap">
					<div class="facts-icon">
						<i class="theme-cl ti-location-pin"></i>
					</div>
					<div class="facts-detail">
						<h4>1,000+ Hotels & Resorts</h4>
						<p>Morbi semper fames lobortis ac hac</p>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-4">
				<div class="facts-wrap">
					<div class="facts-icon">
						<i class="theme-cl ti-shine"></i>
					</div>
					<div class="facts-detail">
						<h4>Various Destinations</h4>
						<p>Morbi semper fames lobortis ac hac</p>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-4">
				<div class="facts-wrap">
					<div class="facts-icon">
						<i class="theme-cl ti-face-smile"></i>
					</div>
					<div class="facts-detail">
						<h4>98% Happy Customers</h4>
						<p>Morbi semper fames lobortis ac hac</p>
					</div>
				</div>
			</div>

		</div>
	</div>
</section> -->
<!-- ================= End true Facts ========================= -->

<?php if (isset($landscape_properties)) { ?>
<!-- ================= Activities start ========================= -->
<section class="pt-3 pb-3">
	<div class="container">

		<div class="row">
		    <div class="col-md-12 headline">
                    <div class="dine-divider" data-delay="0">
                        <div class="divider-inner">
                            <div class="divider-line line-left"></div>
                            <div class="icon-wrapper">
                                <h2>Landscapes</h2>
                            </div>
                            <div class="divider-line line-right"></div>
                        </div>
                    </div>
                </div>
                
			<!--<div class="col-lg-12 col-md-12">
				<div class="sec-heading center mb-2">
					<!-- <p>Lorem ipsum simply dummy text</p> -->
					<!--<h2>Landscapes</h2>
				</div>
			</div>-->
		</div>

		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="owl-carousel owl-theme" id="lists-slide">

					<?php foreach ($terrains as $ter) { 
							$lnkTerrains = base_url('frontend/booking/search/?wish=&landscape='.$ter['terrain_id'].'&district=&type=');
						?>
					
					<div class="single-item">
						<div class="destination-item">
							<figure class="destination-list-wrap">
								<a class="destination-listlink" href="<?= $lnkTerrains ?>">
									<img class="cover" src="<?= base_url('public/admin_images/landscape_images/' . $ter['landscape_image']); ?>" alt="room">
								</a>
							</figure>
							<div class="destination-listdetails">
								<!-- <span class="destination-list-cat theme-bg"><?= $ter['district_name'] . ', ' . $ter['city']; ?></span> -->
								<h4 class="title"><a class="title-ln" href="<?= $lnkTerrains ?>"><?= $ter['terrain_name']; ?></a></h4>
							</div>
						</div>
					</div>

					<?php } ?>

				</div>
			</div>
		</div>

	</div>
</section>
<!-- ========================= End Activities Section ============================ -->
<?php } ?>


<?php if (isset($districts)) { ?>
<!-- ================= Travel start ========================= -->
<section class="min gray pt-3 pb-3">
	<div class="container">

		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="sec-heading center">
					<!-- <p>Lorem ipsum simply dummy text</p> -->
					<h2>Districts of West Bengal</h2>
				</div>
			</div>
		</div>

		<div class="row">
			
			<?php 
			foreach ($districts as $district) { 
				$lnkDistrict = base_url('frontend/booking/search/?wish=&landscape=&district='.$district['district_id'].'&type=');
			?>
			<!-- Single Tour Place -->
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="tour-simple-wrap">
					<div class="tour-simple-thumb">
						<a href="<?= $lnkDistrict; ?>"><img src="<?= isset($district['district_image']) && $district['district_image'] != '' ? base_url('public/admin_images/district_images/' . $district['district_image']) : base_url('public/frontend_assets/images/alipurduar.jpg'); ?>" class="img-fluid img-responsive" alt="" /></a>
					</div>
					<div class="tour-simple-caption">
						<div class="ts-caption-left d-flex justify-content-between align-items-center">
							<h4 class="ts-title text-center"><a href="<?= $lnkDistrict; ?>"><?= $district['district_name']; ?></a></h4>
							<a href="<?= $lnkDistrict; ?>" class="tv-btn btn-sm btn-dark">View All</a>
							<!-- <span>110 Hotels & Resorts</span> -->
						</div>
					</div>
				</div>
			</div>
			<?php } ?>

		</div>

	</div>
</section>
<!-- ========================= End Travel Section ============================ -->
<?php } ?>