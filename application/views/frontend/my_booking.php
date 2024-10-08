<section class="gray">
	<div class="container">
		<div class="row">

			<div class="col-lg-3 col-md-4 col-sm-12">
				<div class="dashboard-navbar dashboard-left-content">

					<div class="d-user-avater">
						<img src="https://wbsfdc.devserv.in/public/frontend_assets/images/user-icon.jpg" class="img-fluid avater" alt="">
						<h5 class="fw-bold thm-txt mt-3">Sourabh Hazari </h5>
						<span></span>
					</div>

					<div class="d-navigation">
						<ul class="dashboard-list">
							<li class="list"><a href="my-profile.html"><i class="bi bi-person-fill"></i> My Profile</a></li>
							<li class="list active"><a href="my-booking.html"><i class="bi bi-clipboard2-check-fill"></i> My Booking</a></li>
							<li class="list"><a href="index.html"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
						</ul>
					</div>

				</div>
			</div>

			<div class="col-lg-9 col-md-8 col-sm-12">
				<div class="dashboard-wraper single-reservation bg-white base-padding">
					<div class="d-flex justify-content-between align-items-center">
						<h4 class="fw-normal thm-txt">Booking List</h4>
						<div>
							<select id="booking-type" name="booking_type" class="form-select">
								<option value="ALL" selected="selected">All Booking</option>
								<option value="UPCOMING">Upcoming Booking</option>
								<option value="PAST">Past Booking</option>
							</select>
						</div>
					</div>

					<ul class="nav nav-pills mb-3 wbsfda_tab" id="pills-tab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="pills-ght-tab" data-bs-toggle="pill" data-bs-target="#pills-ght" type="button" role="tab" aria-controls="pills-ght" aria-selected="true">Guest House</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="pills-cst-tab" data-bs-toggle="pill" data-bs-target="#pills-cst" type="button" role="tab" aria-controls="pills-cst" aria-selected="false">Car Safari</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="pills-est-tab" data-bs-toggle="pill" data-bs-target="#pills-est" type="button" role="tab" aria-controls="pills-est" aria-selected="false">Elephant Safari</button>
						</li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-ght" role="tabpanel" aria-labelledby="pills-ght-tab" tabindex="0">
							<!--Guest House Tab-->
							<div class="dashboard-gravity-list mt-3">
								<ul class="p-0">
									<li class="pending-booking mb-3">
										<div class="list-box-listing bookings">
											<div class="list-box-listing-img"><img src="https://wbsfdc.devserv.in/public/admin_images/property_images/1667898383172.jpg" alt=""></div>
											<div class="list-box-listing-content">
												<div class="inner">
													<h3>Amrapali Guest House Complex <span class="booking-status pending">Approved</span>
													</h3>
													<div class="inner-booking-list d-flex">
														<span class="thm-txt fw-normal me-3">Booking No.:</span><span>AB20230929518165</span>
													</div>
													<div class="inner-booking-list d-flex">
														<span class="thm-txt fw-normal me-3">Booking Date:</span><span>30-09-2023 to 01-10-2023</span>
													</div>
													<div class="inner-booking-list d-flex">
														<span class="thm-txt fw-normal me-3">Price:</span><span>₹ 3136.00</span>
													</div>
													<div class="mt-3">
														<a class="btn btn-dark btn-sm" href="#." target="_blank">View Details</a>
													</div>
												</div>
											</div>
										</div>
									</li>
									<li class="pending-booking mb-3">
										<div class="list-box-listing bookings">
											<div class="list-box-listing-img"><img src="https://wbsfdc.devserv.in/public/admin_images/property_images/1667898383172.jpg" alt=""></div>
											<div class="list-box-listing-content">
												<div class="inner">
													<h3>Amrapali Guest House Complex <span class="booking-status pending">Approved</span>
													</h3>
													<div class="inner-booking-list d-flex">
														<span class="thm-txt fw-normal me-3">Booking No.:</span>
														<span>AB20231031278835</span>
													</div>
													<div class="inner-booking-list d-flex">
														<span class="thm-txt fw-normal me-3">Booking Date:</span>
														<span>01-11-2023 to 02-11-2023</span>
													</div>
													<div class="inner-booking-list d-flex">
														<span class="thm-txt fw-normal me-3">Price:</span>
														<span>₹ 896.00</span>
													</div>
													<div class="mt-3">
														<a class="btn btn-dark btn-sm" href="#." target="_blank">View Details</a>
													</div>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<!--// Guest House Tab-->
						</div>
						<div class="tab-pane fade" id="pills-cst" role="tabpanel" aria-labelledby="pills-cst-tab" tabindex="0">
							<!--Car Safari Tab-->
							<h5>Car Safari</h5>
							<!--// Car Safari Tab-->
						</div>
						<div class="tab-pane fade" id="pills-est" role="tabpanel" aria-labelledby="pills-est-tab" tabindex="0">
							<!--Elephant Safari Tab-->
							<h5>Elephant Safari</h5>
							<!--// Elephant Safari Tab-->
						</div>
					</div>



					<div id="guest-house" class="tab-content-item active">

					</div>

					<div id="hall-venue" class="tab-content-item">
						<div class="dashboard-gravity-list mt-3">
							<ul>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>