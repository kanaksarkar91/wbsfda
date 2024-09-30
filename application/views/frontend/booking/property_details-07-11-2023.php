<style type="text/css">
.hotelroom_lg_carousel .item {
  background: #0c83e7;
  padding: 0;
  margin: 0;
  color: #fff;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  text-align: center;
}

.hotelroom_sm_carousel .item {
  background: #fcfcfc;
  padding: 2px;
  margin: 2px;
  color: #fff;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  text-align: center;
  cursor: pointer;
}
.hotelroom_sm_carousel .current .item {
  background: #004698;
}

.owl-theme .owl-nav {
  /*default owl-theme theme reset .disabled:hover links */
}
.owl-theme .owl-nav [class*=owl-] {
  transition: all 0.3s ease;
}
.owl-theme .owl-nav [class*=owl-].disabled:hover {
  background-color: #d6d6d6;
}

.hotelroom_lg_carousel.owl-theme {
  position: relative;
}
.hotelroom_lg_carousel.owl-theme .owl-next,
.hotelroom_lg_carousel.owl-theme .owl-prev {
  width: 24px;
  height: 24px;
  margin-top: -10px;
  position: absolute;
  top: 50%;
  line-height: 1!important;
}
.hotelroom_lg_carousel.owl-theme .owl-prev {
  left: 10px;
}
.hotelroom_lg_carousel.owl-theme .owl-next {
  right: 10px;
}

@media screen and (max-width: 600px) {
  table.room-type-tbl {
    border: 0;
  }

  table.room-type-tbl caption {
    font-size: 1.3em;
  }
  
  table.room-type-tbl thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table.room-type-tbl tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table.room-type-tbl td {
    border-bottom: 1px solid #ddd;
    display: block;
    text-align: left;
  }
  
  table.room-type-tbl td::before {
    content: attr(data-label);
    float: left;
    margin-right:5px;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table.room-type-tbl td:last-child {
    border-bottom: 0;
  }
}
</style>
<!-- ============================ Hero Banner  Start================================== -->
<!-- <div class="featured-slick">
	<div class="featured-slick-slide">
		<?php 
		for($i = 1; $i <= 4; $i++) { 
			$img_name = 'image' . $i;
			if ($property[$img_name] != '') {
		?>
		<div>
			<a href="<?= base_url('public/admin_images/' . $property[$img_name]); ?>" class="mfp-gallery"><img src="<?= base_url('public/admin_images/' . $property[$img_name]); ?>" class="img-fluid mx-auto" alt="<?= $property['property_name'] != '' ? $property['property_name'] . ' Image '. $i : ''; ?>" /></a>
		</div>
		<?php } } ?>
	</div>
</div> -->

<!-- ============================ Hero Banner End ================================== -->

<!-- ============================ Property Detail Start ================================== -->
<section class="gray pt-3">
	<div class="container">
		<div class="row">

			
		
			<div class="col-md-12 room_details bg_grey mt-3">
				<div class="block-wrap mb-3 pb-0">
					<div class="block-header border-0 mb-0">
						<h3 class="block-title fw-normal mb-3 thm-txt"><?= $property['property_name']; ?></h3>
						<h5 class="mb-0"><i class="ti-location-pin"></i><?= $property['address_line_1'] . ', ' . $property['address_line_2'] . ', ' . $property['city']; ?></h5>
					</div>
					<div class="row">
						<div class="col-12 p-0">
						<p class="small fw-bold text-primary my-2 mx-3">* Below rates are exclusive of GST</p>
						<div class="table-responsive availability-table p-3 pt-0">
							<?= $available_html;?>
						</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- <div class="col-md-12 room_details bg_grey mt-3">
				<div class="row">
					<div class="table-responsive">
						<?= $available_html;?>
					</div>
				</div>
			</div> -->
			
			<!-- property main detail -->
			<div class="col-lg-8 col-md-8 col-sm-12"><!--order-lg-1 order-md-2 order-2-->
				<!-- Single Block Wrap -->
				<div class="block-wrap mb-3">
					<!-- <div class="block-header">
					<?php
					//echo '<pre>'; print_r($property); die;
					?>
						<h3 class="block-title fw-normal mb-3 thm-txt"><?= $property['property_name']; ?></h3>
						<h5 class="mb-3"><i class="ti-location-pin"></i><?= $property['address_line_1'] . ', ' . $property['address_line_1'] . ', ' . $property['city']; ?></h5>
					</div> -->

					<div class="details-contents-header p-0">
						<div class="details-contents-thumb details-contents-main-thumb bg-image">
							<img src="<?= ($property['image1'] != '') ? base_url('public/admin_images/' . $property['image1']) : base_url('public/admin_images/property_images/no-image.jpg'); ?>" alt="img" class="img-fluid d-block mx-auto">
						</div>
						<div class="details-contents-header-flex">
							<div class="details-contents-header-thumb">
								<img src="<?= ($property['image2'] != '') ? base_url('public/admin_images/' . $property['image2']) : base_url('public/admin_images/property_images/no-image.jpg'); ?>" alt="img">
							</div>
							<div class="details-contents-header-thumb">
								<img src="<?= ($property['image3'] != '') ? base_url('public/admin_images/' . $property['image3']) : base_url('public/admin_images/property_images/no-image.jpg'); ?>" alt="img">
							</div>
						</div>
					</div>

					<div class="block-body mt-3">
						<p><?= $property['property_desc']; ?></p>
					</div>
					<div class="mt-3">
						<?php /*?><span style="font-weight:bold;">Contact Person:</span> <?= $property['contact_person_1_name']; ?><br /><?php */?>
						<span style="font-weight:bold;">Contact Mobile:</span> <?= $property['phone_no']; ?><br />
						<span style="font-weight:bold;">Contact Email:</span> <?= $property['email']; ?>
					</div>
				</div>
				<!-- Single Block Wrap -->
				<div class="block-wrap">
					<div class="block-header">
						<h4 class="block-title">Ameneties</h4>
					</div>
					<div class="block-body">
						<ul class="avl-features third">
						<?php
						if (isset($facilities))
							foreach ($facilities as $f) {
						?>
							<li><?= $f['facility_name']; ?></li>
						<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="block-wrap">
					<div id="map"></div>
					<iframe width="100%" height="380" frameborder="0" style="border:0" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDK4rMTf9bUlqpg1g8SF2zUnV4HQmatsVo&q=<?= $property['google_map_address']; ?>" allowfullscreen></iframe><br /><br />
				</div>
				<style>
				/*.youtube_video a::before {
				  content: "\25B6";
				  position: relative;
				  color: white;
				  left: 105px;
				  top: 27px;
				  z-index: 999;
				  font-size: 80px;
				  opacity: 0.7;
				  text-shadow: 0 3px #666666;
				  margin-right:-44px;
				}*/
				
				.youtube_video a { 
				  background: red;
				  border-radius: 50% / 10%;
				  color: #FFFFFF;
				  font-size: 1em; /* change this to change size */
				  height: 3em;
				  margin: 20px auto;
				  padding: 0;
				  position: relative;
				  text-align: center;
				  text-indent: 0.1em;
				  transition: all 150ms ease-out;
				  width: 4em;
				}
				
				.youtube_video a::before { 
				  background: inherit;
				  border-radius: 5% / 50%;
				  bottom: -61%;
				  content: "";
				  left: 38%;
				  position: absolute;
				  right: 39%;
				  top: -61%;
				}
				
				.youtube_video a::after {
				  border-style: solid;
				  border-width: 1em 0 1em 1.732em;
				  border-color: transparent transparent transparent rgba(255, 255, 255, 0.75);
				  content: ' ';
				  font-size: 0.75em;
				  height: 0;
				  margin: -1em 0 0 -0.75em;
				  top: 50%;
				  left:50%;
				  position: absolute;
				  width: 0;
				}
				</style>
				<?php
				if($property['youtube_video_link'] != ''){
				?>
				<div class="youtube_video">
					<h4 style="margin-bottom:10px;">Property Video:</h4>
					<a href="<?= $property['youtube_video_link'];?>" target="_blank"><img src="https://img.youtube.com/vi/<?= $videoId; ?>/hqdefault.jpg" width="370" /></a>
				</div>
				<?php
				}
				?>
			</div>
			<!-- property Sidebar -->
			<div class="col-lg-12 col-md-12 col-sm-12"><!-- order-lg-2 order-md-1 order-1-->
				<div class="side-booking-wraps mt-3">
					<div class="side-booking-wrap hotel-booking mb-0">
						<div class="side-booking-body pb-0">
							<form id="room_search_form" action="" method="post">
							<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
							<input type="hidden" name="property_id" id="property_id" value="<?= isset($property_id) && $property_id != '' ? $property_id : ''; ?>">
							<input type="hidden" name="rate_category" id="rate_category" value="<?= isset($rate_category_id) && $rate_category_id != '' ? $rate_category_id : ''; ?>">
							<div class="row mb-4">
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="form-group">
										<label class="thm-txt">Stay Date(s)</label>
										<div class="cld-box">
											<input type="text" name="dates" id="dates" class="form-control" <?= isset($check_in_date) && $check_in_date != '' && isset($check_out_date) && $check_out_date != '' ? 'value="' . set_value("dates", ($check_in_date . ' - ' . $check_out_date)) . '"' : ''; ?> />
											<i class="ti-calendar"></i>
										</div>
									</div>
								</div>
								<?php if (isset($property['property_type_id']) && !in_array($property['property_type_id'], array(7,8,9,14))) { ?>
								<div class="col-lg-3 col-md-3 col-sm-6 border-right dropdown form-select-guests mnbr" <?= isset($property['property_type_id']) && in_array($property['property_type_id'], array(7,8,9,14)) ? 'style="display: none;"' : ''; ?>>
									<div class="form-group">
										<label class="thm-txt">Guests</label>
										<div class="form-content dropdown-toggle" data-toggle="dropdown" style="height:39px!important; padding:5px;">
											<div class="wrapper-more">
												
												<div class="render">
													<span class="adults"><span class="one "><?= isset($adult_pax) && $adult_pax != '' ? $adult_pax : '1'; ?> Adult</span> <span class=" d-none  multi" data-html=":count Adults"><?= isset($adult_pax) && $adult_pax != '' ? $adult_pax : '1'; ?> Adults</span></span>-
													<span class="children">
													<span class="one " data-html=":count Child"><?= isset($child_pax) && $child_pax != '' ? $child_pax : '0'; ?> Child</span>
													<span class="multi  d-none" data-html=":count Children"><?= isset($child_pax) && $child_pax != '' ? $child_pax : '0'; ?> Children</span>
													</span>
												</div>
											</div>
										</div>
										<div class="dropdown-menu select-guests-dropdown">
											<input type="hidden" name="adults" id="adults" value="<?= isset($adult_pax) && $adult_pax != '' ? $adult_pax : '1'; ?>" min="1" max="20">
											<input type="hidden" name="children" id="children" value="<?= isset($child_pax) && $child_pax != '' ? $child_pax : '0'; ?>" min="0" max="20">
											<div class="dropdown-item-row">
												<div class="label">Adults</div>
												<div class="val">
													<span class="btn-minus" data-input="adults"><i class="ti-minus"></i></span>
													<span class="count-display"><?= isset($adult_pax) && $adult_pax != '' ? $adult_pax : '1'; ?></span>
													<span class="btn-add" data-input="adults"><i class="ti-plus"></i></span>
												</div>
											</div>
											<div class="dropdown-item-row">
												<div class="label">Children</div>
												<div class="val">
													<span class="btn-minus" data-input="children"><i class="ti-minus"></i></span>
													<span class="count-display"><?= isset($child_pax) && $child_pax != '' ? $child_pax : '0'; ?></span>
													<span class="btn-add" data-input="children"><i class="ti-plus"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php } ?>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-dark btn-sm p-2">Search</button>
                                    </div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label>&nbsp;</label><?= validation_errors(); ?>
                                    </div>
								</div>	
							</div>
							</form>
							<div class="row no-gutters">
								<?php
								if (isset($accommodations) && count($accommodations) > 0) {
								?>
							    <div class="col-md-9">
							        <div class="table-responsive">
										<table class="table table-hover table-bordered mb-0 room-type-tbl">
											<tr>
												<th scope="col">Room Type</th>
												<th scope="col">Price for <?= isset($no_of_nights) && $no_of_nights != '' ? $no_of_nights . ($no_of_nights <= 1 ? ' night' : ' nights') : ''; ?></th>
												<th scope="col">Select Required Room(s)</th>
											</tr>
											<?php
											$i = $j = 1;
											foreach ($accommodations as $accommodation) {
											?>
											<tr <?php if($accommodation['is_offline'] == 2){ ?> style="display:none;" <?php } ?>>
												<td class="p-2">
													<div class="d-flex flex-column flex-md-row" data-toggle="modal" data-target="#accomodation_detailModal<?= $j; ?>">
														<!-- <div>
															<?php if (isset($accommodation['accomm_image1']) && $accommodation['accomm_image1'] != '') { ?>
															<img src="<?= base_url('public/admin_images/' . $accommodation['accomm_image1']); ?>" class="mr-2" width="108" alt="..." />
															<?php } elseif (isset($accommodation['accomm_image2']) && $accommodation['accomm_image2'] != '') { ?>
															<img src="<?= base_url('public/admin_images/' . $accommodation['accomm_image2']); ?>" class="mr-2" width="108" alt="..." />
															<?php } elseif (isset($accommodation['accomm_image3']) && $accommodation['accomm_image3'] != '') { ?>
															<img src="<?= base_url('public/admin_images/' . $accommodation['accomm_image3']); ?>" class="mr-2" width="108" alt="..." />
															<?php } elseif (isset($accommodation['accomm_image4']) && $accommodation['accomm_image4'] != '') { ?>
															<img src="<?= base_url('public/admin_images/' . $accommodation['accomm_image4']); ?>" class="mr-2" width="108" alt="..." />
															<?php } else { ?>
															<img src="<?= base_url('public/admin_images/property_images/no-image.jpg'); ?>" class="mr-2" width="108" alt="...">
															<?php } ?>
														</div> -->
														<div class="media-body">
															<h5 class="mt-1"><?= $accommodation['accommodation_name']; ?></h5>
															<!--<p class="mb-0"><i class="fas fa-bed text-primary"></i> 1 Kingsize Bed, 1 Single Bed</p>-->
															<?php 
															if($accommodation['is_dormitory'] == 'No'){
																if (isset($accommodation['adult']) || isset($accommodation['child'])) { 
															?>
																<p class="mb-1 text-dark"><i class="fas fa-users thm-txt"></i> 
																<?php if (isset($property['property_type_id']) && in_array($property['property_type_id'], array(7,8,9,14))) { ?>
																<span style="display:none;">Capacity: <?= isset($accommodation['adult']) && $accommodation['adult'] != '' ? $accommodation['adult'] : 'N/A'; ?>
																<?php } else { ?></span>
															        Capacity: <?= isset($accommodation['adult']) && $accommodation['adult'] != '' ? $accommodation['adult'] . ' Adult(s)' : ''; ?><?= isset($accommodation['child']) && $accommodation['child'] != '' ? ', ' . $accommodation['child'] . ($accommodation['child'] <= 1 ? ' Child' : ' Children') : ''; ?>
																<?php } ?>
																</p>
															<?php 
																} 
															}
															?>
															
															<?php if (isset($accommodation['facilities']) && $accommodation['facilities'] != '') { ?>
															<p class="mb-1"><i class="fas fa-hotel thm-txt"></i> <?= ucwords(str_replace(',', ', ', $accommodation['facilities'])); ?></p>
															<?php } ?>
															
															<?php
															if($accommodation['is_dormitory'] == 'No'){
																if($accommodation['extra_bed_price'] > 1){
															?>
																<p class="mb-1">Maximum 1 extra Pax allowed in a room (if required)</p>
															<?php
																}
															}
															?>
														</div>
													</div>
												</td>
												<td data-label="Price" class="p-1">₹ <?= isset($accommodation['base_price']) && $accommodation['base_price'] != '' ? $accommodation['base_price'] : ''; ?>
												<?php
												if($accommodation['is_dormitory'] == 'Yes'){
													echo '/ Per Bed';
												} else{
													echo '/ Per Room';
												}
												?>
												<br />
												
												<?php
												if($accommodation['is_dormitory'] == 'No'){
													if($accommodation['extra_bed_price'] > 1){
												?>
																										
													<select name="choose_extra_pax" id="choose_extra_pax<?= $accommodation['accommodation_id'];?>" class="form-select form-select-sm choose_extra_pax" data-extra-pax="<?= $j;?>">
														<option value="">Select extra Pax here (if required)</option>
														<?php 
														if (isset($accommodation['no_of_accomm']))
															for ($e = 1; $e <= $accommodation['no_of_accomm']; $e++) { ?>
																<option value="<?= $e; ?>"><?= $e; ?></option>
														<?php } ?>
													</select>
													
													<?php /*?><input type="number" name="choose_extra_pax" id="choose_extra_pax<?= $accommodation['accommodation_id'];?>" class="form-control choose_extra_pax<?= $j;?>" data-extra-pax="<?= $j;?>" onkeyup="return extra_bed_keypress(<?= $j;?>);" onkeydown="return extra_bed_keypress(<?= $j;?>);" max="<?= $accommodation['no_of_accomm'];?>" placeholder="Enter extra Pax here (if required)" /><?php */?>
													
													
												<?php
													}
												}
												?>
												</td>
												<td data-label="Select Rooms" class="p-1">
													<select name="no_of_rooms" id="no_of_rooms<?= $j; ?>" class="form-control form-control-sm" data-roomid="<?= $accommodation['accommodation_id'];?>">
														<?php 
														if (isset($accommodation['no_of_accomm']))
															for ($i = 0; $i <= $accommodation['no_of_accomm']; $i++) { ?>
																<option value="<?= $i; ?>"><?= $i; ?></option>
														<?php } ?>
													</select>
												</td>
											</tr>
											<?php 
												$j++;
											} 
											?>
										</table>
									</div>
							    </div>
							    <div class="col-md-3">
							        <div class="side-booking-footer light">
            							<div class="stbooking-footer-top">
            								<div class="stbooking-left">
            									<h5 class="st-subtitle">Total Amount</h5>
            									<!--<span>Expected Tax</span>-->
            								</div>
            								<h4 class="stbooking-title">₹ 0.00</h4>
            							</div>
            							<div class="stbooking-footer-bottom">
											<input type="hidden" id="tots" value="" />
            								<input type="button" id="booknow" class="btn btn-block btn-theme" value="Book Now">
            								<!-- <a href="#" class="books-btn black">Instant Booking</a> -->
            							</div>
            						</div>
							    </div>
								<?php } else { ?>
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-hover table-bordered mb-0">
											<tr>
												<td>
													<h4 class="text-info" style="line-height: 2rem;">No rooms found for your search criteria.</h4>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
$j = 1;
foreach ($accommodations as $accommodation) {
?>
<div class="modal fade" id="accomodation_detailModal<?= $j; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="width: 100%;">
      <div class="modal-header">
        <h5 class="modal-title">Room Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-3">
          <div class="row">
                <div class="col-md-7 col-sm-12">
                  <div id="sync1_<?= $j;?>" class="owl-carousel owl-theme hotelroom_lg_carousel">
					<?php if (isset($accommodation['accomm_image1']) && $accommodation['accomm_image1'] != '') { ?>
                    <div class="item">
                        <img src="<?= base_url('public/admin_images/' . $accommodation['accomm_image1']); ?>"/>
                    </div>
					<?php } ?>
					<?php if (isset($accommodation['accomm_image2']) && $accommodation['accomm_image2'] != '') { ?>
                    <div class="item">
                        <img src="<?= isset($accommodation['accomm_image2']) && $accommodation['accomm_image2'] != '' ? base_url('public/admin_images/' . $accommodation['accomm_image2']) : base_url('public/admin_images/property_images/no-image.jpg') ; ?>">
                    </div>
					<?php } ?>
					<?php if (isset($accommodation['accomm_image3']) && $accommodation['accomm_image3'] != '') { ?>
                    <div class="item">
                        <img src="<?= isset($accommodation['accomm_image3']) && $accommodation['accomm_image3'] != '' ? base_url('public/admin_images/' . $accommodation['accomm_image3']) : base_url('public/admin_images/property_images/no-image.jpg') ; ?>">
                    </div>
					<?php } ?>
					<?php if (isset($accommodation['accomm_image4']) && $accommodation['accomm_image4'] != '') { ?>
                    <div class="item">
                        <img src="<?= isset($accommodation['accomm_image4']) && $accommodation['accomm_image4'] != '' ? base_url('public/admin_images/' . $accommodation['accomm_image4']) : base_url('public/admin_images/property_images/no-image.jpg') ; ?>">
                    </div>
					<?php } ?>
                </div>
                <div id="sync2_<?= $j;?>" class="owl-carousel owl-theme hotelroom_sm_carousel">
                    <?php if (isset($accommodation['accomm_image1']) && $accommodation['accomm_image1'] != '') { ?>
                    <div class="item">
                        <img src="<?= base_url('public/admin_images/' . $accommodation['accomm_image1']); ?>" />
                    </div>
					<?php } ?>
					<?php if (isset($accommodation['accomm_image2']) && $accommodation['accomm_image2'] != '') { ?>
                    <div class="item">
                        <img src="<?= isset($accommodation['accomm_image2']) && $accommodation['accomm_image2'] != '' ? base_url('public/admin_images/' . $accommodation['accomm_image2']) : base_url('public/admin_images/property_images/no-image.jpg') ; ?>">
                    </div>
					<?php } ?>
					<?php if (isset($accommodation['accomm_image3']) && $accommodation['accomm_image3'] != '') { ?>
                    <div class="item">
                        <img src="<?= isset($accommodation['accomm_image3']) && $accommodation['accomm_image3'] != '' ? base_url('public/admin_images/' . $accommodation['accomm_image3']) : base_url('public/admin_images/property_images/no-image.jpg') ; ?>">
                    </div>
					<?php } ?>
					<?php if (isset($accommodation['accomm_image4']) && $accommodation['accomm_image4'] != '') { ?>
                    <div class="item">
                        <img src="<?= isset($accommodation['accomm_image4']) && $accommodation['accomm_image4'] != '' ? base_url('public/admin_images/' . $accommodation['accomm_image4']) : base_url('public/admin_images/property_images/no-image.jpg') ; ?>">
                    </div>
					<?php } ?>
                </div>
              </div>
                <div class="col-md-5 col-sm-12">
					<h4><?= $accommodation['accommodation_name']; ?></h4><br>
					<h6><i class="fas fa-users text-primary"></i> Room capacity:</h6>
					<p>
					<?php if (isset($property['property_type_id']) && in_array($property['property_type_id'], array(7,8,9,14))) { ?>
					<span style="display:none;">Capacity: <?= isset($accommodation['adult']) && $accommodation['adult'] != '' ? $accommodation['adult'] : 'N/A'; ?>
					<?php } else { ?></span>
					Sleeps: <?= isset($accommodation['adult']) && $accommodation['adult'] != '' ? $accommodation['adult'] . ' Adult(s)' : ''; ?><?= isset($accommodation['child']) && $accommodation['child'] != '' ? ', ' . $accommodation['child'] . ($accommodation['child'] <= 1 ? ' Child' : ' Children') : ''; ?>
					<?php } ?>
					</p>
					<h6><i class="fas fa-hotel text-primary"></i>  Amenities:</h6>
					<p><?= str_replace(',', ', ', $accommodation['facilities']); ?></p>
					<h6><i class="fas fa-rupee-sign text-primary"></i> Room Price:</h6>
					<p>₹ <?= isset($accommodation['base_price']) && $accommodation['base_price'] != '' ? $accommodation['base_price'] : ''; ?><?= isset($property['property_type_id']) && !in_array($property['property_type_id'], array(7,8,9,14)) ? '/per night' : ''; ?></p>
                </div>
          </div>
      </div>
    </div>
  </div>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$(document).ready(function() {
	$(document).on('click', '.applyBtn', function() {
	   $('#room_search_form').submit();
    });
});
</script>


<script>
    $(document).ready(function() {

    var sync1 = $("#sync1_<?= $j;?>");
    var sync2 = $("#sync2_<?= $j;?>");
    var slidesPerPage = 4;
    var syncedSecondary = true;

    sync1.owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: true,
        autoplay: false, 
        dots: false,
        loop: true,
        responsiveRefreshRate: 200,
        navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
    }).on('changed.owl.carousel', syncPosition);

  sync2.on('initialized.owl.carousel', function() {
    sync2.find(".owl-item.center").eq(0).addClass("current");
  })
  
  /* centered items */
  sync2.find('.owl-item').each(function(index) {
    var item = $(this).attr('data-position', index);
  })
  
  sync2.owlCarousel({
    items: slidesPerPage,
    dots: false,
    nav: false,
    loop: true,
    center: true,
    smartSpeed: 200,
    slideSpeed: 1000,
    slideBy: slidesPerPage,
    responsiveRefreshRate: 100
  }).on('click', '.owl-item', function(e) {
        var carouselSync1 = $('#sync1').data('owl.carousel');
        e.preventDefault();
    
        var current = $(this).index();
        carouselSync1.to(carouselSync1.relative(current));
        
        /* centered items */
        sync2.trigger('to.owl-carousel', $(this).data('position'));
      });

    function syncPosition(el) {
       
        var current = el.item.index;
      
        sync2.find(".owl-item").removeClass("current").eq(current).addClass("current");
        var onscreen = sync2.find('.owl-item.active').length - 1;
        var start = sync2.find('.owl-item.active').first().index();
        var end = sync2.find('.owl-item.active').last().index();
      
        console.log('currentSync1: ' + current)
      
        if (current > end) {
          sync2.data('owl.carousel').to(current, 100, true);
        }
        if (current < start) {
          sync2.data('owl.carousel').to(current - onscreen, 100, true);
        }
    }

    function syncPosition2(el) {
      if (syncedSecondary) {
        var number = el.item.index;
        sync1.data('owl.carousel').to(number, 100, true);
      }
    }
});
</script>
<?php 
		$j++;
	} 
?>
<!-- ============================ Property Detail End ================================== -->
<script>

function extra_bed_keypress(sl) {
       
	var property = $("#property_id").val();
	var rate_category = $("#rate_category").val();
	var stay_date = $("#dates").val();
	var adults = $("#adults").val();
	var children = $("#children").val();
	
	var roomId = $('#no_of_rooms'+sl).data('roomid');
	var roomCount = $('#no_of_rooms'+sl).val();
	var is_select_extra_bed = $(".choose_extra_pax"+sl).val();
	
	console.log(roomCount);
		
	if (roomId != '' && roomCount != '' && roomCount > 0) {
		
		if(Number(is_select_extra_bed) > Number(roomCount)){
			$.alert({
				title: 'Alert!',
				content: 'Extra pax is greater than selected room!',
				type: 'red',
				typeAnimated: true,
			})
			return false;
		}
		else{
			$.ajax({
				url: "<?= base_url('frontend/booking/booking_cart'); ?>",
				type: "post",
				data: {
					property: property,
					stay_date: stay_date,
					adult: adults,
					child: children,
					rate_category: rate_category,
					room: roomId,
					roomCount: roomCount,
					csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>',
					is_select_extra_bed: is_select_extra_bed
				},
				success: function(response) {
					var responseObj = $.parseJSON(response);
					$('.stbooking-title').html('₹' + parseFloat(responseObj.amount).toFixed(2));
				}
			});
		}
	}
		
}

$(document).ready(function() {
	$('select[name="no_of_rooms"]').on('change', function() {
		var property = $("#property_id").val();
		var rate_category = $("#rate_category").val();
		var stay_date = $("#dates").val();
		var adults = $("#adults").val();
		var children = $("#children").val();
		
		var roomId = $(this).data('roomid');
		var roomCount = $(this).val();
		var is_select_extra_bed = $("#choose_extra_pax"+roomId).val();
		
		//console.log(is_select_extra_bed);
		
		if(Number(is_select_extra_bed) > Number(roomCount)){
			$.alert({
                title: 'Alert!',
                content: 'Extra pax is greater than selected room!',
                type: 'red',
                typeAnimated: true,
            })
            return false;
		}
		else{
			if (roomId != '' && roomCount != '') {
				$.ajax({
					url: "<?= base_url('frontend/booking/booking_cart'); ?>",
					type: "post",
					data: {
						property: property,
						stay_date: stay_date,
						adult: adults,
						child: children,
						rate_category: rate_category,
						room: roomId,
						roomCount: roomCount,
						csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>',
						is_select_extra_bed: is_select_extra_bed
					},
					success: function(response) {
						var responseObj = $.parseJSON(response);
						$('.stbooking-title').html('₹' + parseFloat(responseObj.amount).toFixed(2));
					}
				});
			}
		}
	});
	
	
	$('select[name="choose_extra_pax"]').on('click', function() {
		var rowC = $(this).data('extra-pax');
		var property = $("#property_id").val();
		var rate_category = $("#rate_category").val();
		var stay_date = $("#dates").val();
		var adults = $("#adults").val();
		var children = $("#children").val();
		
		var roomId = $('#no_of_rooms'+rowC).data('roomid');
		var roomCount = $('#no_of_rooms'+rowC).val();
		var is_select_extra_bed = $(this).val();
		
		console.log(is_select_extra_bed);
		
		if (roomId != '' && roomCount != '' && roomCount > 0) {
		
			if(Number(is_select_extra_bed) > Number(roomCount)){
				$.alert({
					title: 'Alert!',
					content: 'Extra pax is greater than selected room!',
					type: 'red',
					typeAnimated: true,
				})
				return false;
			}
			else{
				$.ajax({
					url: "<?= base_url('frontend/booking/booking_cart'); ?>",
					type: "post",
					data: {
						property: property,
						stay_date: stay_date,
						adult: adults,
						child: children,
						rate_category: rate_category,
						room: roomId,
						roomCount: roomCount,
						csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>',
						is_select_extra_bed: is_select_extra_bed
					},
					success: function(response) {
						var responseObj = $.parseJSON(response);
						$('.stbooking-title').html('₹' + parseFloat(responseObj.amount).toFixed(2));
					}
				});
			}
		}
	});
	
	
});
</script>
<script>
$(document).ready(function() {
	$('#booknow').on('click', function() {
		var property = $("#property_id").val();
		var rate_category = $("#rate_category").val();
		var stay_date = $("#dates").val();
		var adult = $("#adults").val();
		var child = $("#children").val();
		
		$.ajax({
			url: "<?= base_url('frontend/booking/init_booking'); ?>",
			type: "post",
			data: {
				property: property,
				stay_date: stay_date,
				rate_category: rate_category,
				adult: adult,
				child: child,
				csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>',
			},
			success: function(response) {
				var responseObj = $.parseJSON(response);
				console.log(responseObj);
				if (responseObj.success == true) {
					$(location).attr("href", responseObj.link);
				} else {
					alert(responseObj.msg);
				}
				
			}
		});
	});
});
</script>
