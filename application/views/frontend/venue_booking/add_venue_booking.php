
<div class="container">
            <div class="banner-location bg-white radius-5">
            <div class="text-center">
                <h6 class="thm-txt fw-normal">Venue Booking</h6><hr>
            </div>
			<form action="<?= base_url('admin/venue_booking/search/'); ?>" method="get" class="st-search-form-tour icon-frm withlbl">
			<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="banner-location-flex">
                    <div class="banner-location-single">
                        <div class="banner-location-single-flex">
                            <div class="banner-location-single-contents">
                                <span class="banner-location-single-contents-subtitle"><i class="las la-map-marker-alt"></i> Location </span>
                                <select class="form-select select2" name="landscape_property" id="landscape_property">
                                    <option value="">Select Location</option>
                                    <?php
                                    if (isset($landscape_properties))
                                        foreach ($landscape_properties as $landscape_property) {
                                    ?>
                                    <option value="<?= $landscape_property['property_id']; ?>"><?= $landscape_property['property_name']; ?></option>
                                    <?php } ?>
						        </select>
                            </div>
                        </div>
                    </div>
                    <div class="banner-location-single">
                        <div class="banner-location-single-flex">
                            <div class="banner-location-single-contents">
                                <span class="banner-location-single-contents-subtitle"><i class="las la-calendar"></i> Check In - Check Out </span>
                                <input type="text" id="checkInOut_venue" class="form-control check-in-out" value="<?= date('d/m/Y', strtotime('+1 day'));?> - <?= date('d/m/Y', strtotime('+2 days'));?>" />
                                <input type="hidden" name="checkindt_venue" id="checkindt_venue" value="<?= date('dmY', strtotime('+1 day'));?>" />
                                <input type="hidden" name="checkoutdt_venue" id="checkoutdt_venue" value="<?= date('dmY', strtotime('+365 days'));?>" /> 
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
        <script src="<?= base_url('public/frontend_assets/js/custom.js'); ?>"></script>
