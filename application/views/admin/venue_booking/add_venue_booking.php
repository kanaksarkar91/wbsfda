
<!-- <div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Venue Booking</h1>
            </div>
            <div class="col-auto">
                
            </div>
        </div>

        <div class="app-card app-card-settings shadow-sm p-2">
            <div class="app-card-body">

            </div>
        </div>
    </div>
</div> -->

<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Venue Booking</h1>
            </div>
            <div class="col-auto">
                
            </div>
        </div>

        <div class="app-card app-card-settings shadow-sm p-3">
            <div class="app-card-body">
                <form action="<?= base_url('admin/venue_booking/search/'); ?>" method="get" class="st-search-form-tour icon-frm withlbl">
			    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="row g-3">
                        <div class="col-lg-5 col-sm-12 col-md-4">
                            <label for="" class="form-label">Location</label>
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
                        <div class="col-lg-5 col-sm-12 col-md-4">
                            <label class="form-label"><i class="las la-calendar"></i> Check Availability </label>
                            <input type="text" id="checkInOut_venue" class="form-control check-in-out" value="<?= date('d/m/Y', strtotime('+1 day'));?> - <?= date('d/m/Y', strtotime('+7 days'));?>" />
                            <input type="hidden" name="checkindt_venue" id="checkindt_venue" value="<?= date('dmY', strtotime('+1 day'));?>" />
                            <input type="hidden" name="checkoutdt_venue" id="checkoutdt_venue" value="<?= date('dmY', strtotime('+7 days'));?>" />
                        </div>
                        <div class="col-lg-2 col-sm-12 col-md-4">
                            <label for="" class="form-label w-100">&nbsp;</label>
                            <button class="btn app-btn-primary w-100" type="submit">BOOK NOW</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

        <!-- <div class="container">
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
                                <span class="banner-location-single-contents-subtitle"><i class="las la-calendar"></i> Check Availability </span>
                                <input type="text" id="checkInOut_venue" class="form-control check-in-out" value="<?= date('d/m/Y', strtotime('+1 day'));?> - <?= date('d/m/Y', strtotime('+7 days'));?>" />
                                <input type="hidden" name="checkindt_venue" id="checkindt_venue" value="<?= date('dmY', strtotime('+1 day'));?>" />
                                <input type="hidden" name="checkoutdt_venue" id="checkoutdt_venue" value="<?= date('dmY', strtotime('+7 days'));?>" /> 
                </div>
                        </div>
                    </div>
                    <div class="banner-location-single-search">
                        <button class="btn btn-primary w-100" type="submit">BOOK NOW <i class="las la-chevron-circle-right"></i></button>
                    </div>
                </div>
			</form>
            </div>
        </div> -->
        <script src="<?= base_url('public/admin_assets/js/custom.js'); ?>"></script>
