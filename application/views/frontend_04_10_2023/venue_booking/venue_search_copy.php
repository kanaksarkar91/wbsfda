<div class="breadcrumb-area section-bg-2 breadcrumb-padding">
                <div class="container custom-container-one">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb-contents">
                                <h4 class="breadcrumb-contents-title"> Hall & Venue Booking </h4>
                                <ul class="breadcrumb-contents-list list-style-none">
                                    <li class="breadcrumb-contents-list-item"> <a href="index.html" class="breadcrumb-contents-list-item-link"> Home </a> </li>
                                    <li class="breadcrumb-contents-list-item"> Hall & Venue Booking </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section>
                <div class="container">
                    <div class="banner-location bg-white radius-5">
                        <form action="" method="get" class="banner-location-flex venue_booking_form">
                        <input type="hidden" name="wish" id="wish" value="<?= isset($search_keywords) && $search_keywords != '' ? $search_keywords : ''; ?>" >
                        <input type="hidden" name="property_id" id="property_id" value="<?= isset($property_type) && $property_type != '' ? $property_type : ''; ?>" >
    
                            <div class="banner-location-single">
                                <div class="banner-location-single-flex">
                                    <div class="banner-location-single-contents">
                                        <span class="banner-location-single-contents-subtitle"><i class="las la-home"></i> Type </span>
                                        <select class="form-select" name="venue_type" id="venue_type">
											<!--<option value="" data-hall="0">Select Type</option>-->
											<?php
											if (isset($property_types))
												foreach ($property_types as $type) { if($type['is_hall']){
											?>
											<option value="<?= $type['id']; ?>" data-hall="<?= $type['is_hall'];?>"><?= $type['property_type_name']; ?></option>
											<?php }} ?>
                               			 </select>
                                    </div>
                                </div>
                            </div>
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
										<option value="<?= $landscape_property['property_id']; ?>" <?= set_select('landscape_property', $landscape_property['property_id'], isset($landscape) && $landscape == $landscape_property['property_id'] ? true : false); ?>><?= $landscape_property['property_name']; ?></option>
											<?php } ?>
										</select>
                                    </div>
                                </div>
                            </div>
                            <div class="banner-location-single">
                                <div class="banner-location-single-flex">
                                    <div class="banner-location-single-contents">
                                        <span class="banner-location-single-contents-subtitle"><i class="las la-calendar"></i> Check In - Check Out </span>
                                        <input type="text" class="form-control check-in-out" name="dates" id="dates" value="<?= isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '' ? ($from_date . ' - ' . $to_date) : ''; ?>" />

                                    </div>
                                </div>
                            </div>

                            <div class="banner-location-single-search">
                                <button type="submit" class="btn btn-primary w-100">
                            SUBMIT <i class="las la-chevron-circle-right"></i> 
                       			 </button>
                            </div>
						</form>
                    </div>
                </div>
            </section>

            <section class="pat-30 pab-30">
                <div class="container">
                    <div class="shop-grid-contents">
                        <div class="grid-list-contents mb-4">
                            <div class="grid-list-contents-flex">
                                <p class="grid-list-contents-para"> <span id="property_count"></span> </p>
                            </div>
                        </div>
                        <div class="row gy-4">
                            <div class="col-12" id="property_list_div">
                                <div class="text-center" id="icon">
                                    <div class="spinner-grow text-danger" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-warning" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-success" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script>
                $(function() {
                    $('input[name="daterange"]').daterangepicker({
                        opens: 'left'
                    }, function(start, end, label) {
                        console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
                    });
                });
            </script>


<script>

</script>
<script>
$(document).ready(function() {
	property_search();
    $("#venue_booking_form").submit(function(e) {
    e.preventDefault();
    property_search();
	});

	$('#dates').on('apply.daterangepicker', function(ev, picker) {
		//$("#checkindt").val(picker.startDate.format('DDMMYYYY'));
		//$("#checkoutdt").val(picker.endDate.format('DDMMYYYY'));
		$("#dates").val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
		property_search();
	});

    function property_search() {
	var keywords = $('#wish').val();
	var landscape_property = $('#landscape_property').val();
	var property_type_id = $('#property_id').val();
	var date_range = $('#dates').val();
	

	var csrf_token = "<?php echo $this->security->get_csrf_hash(); ?>";
		
	if ((keywords != '' || landscape_property != '') && (date_range == '')) {
		$.ajax({
			url: "<?= base_url('frontend/Venue_booking/searchprocess'); ?>",
			type: "post",
			data: {
				type: '1',
				keywords: keywords,
				landscape_property: landscape_property,
				//property_type: hoteltypes,
				"<?php echo $this->security->get_csrf_token_name(); ?>": csrf_token

			},
			success: function(response) {
				propertyResult(response);
			}
		});
	} else {
		$.ajax({
			url: "<?= base_url('frontend/Venue_booking/searchprocess'); ?>",
			type: "post",
			data: {
				type: '2',
				keywords: keywords,
				landscape_property: landscape_property,
				date_range: date_range,
				//property_type: hoteltypes,
				"<?php echo $this->security->get_csrf_token_name(); ?>": csrf_token
			},
			success: function(response) {
				propertyResult(response);
			}
		});
	}
}

function propertyResult(response) {
	var st = '';
	var img = '';
	var propertyObj = $.parseJSON(response);
	var check_in_dt = propertyObj.check_in_dt;
	var check_out_dt = propertyObj.check_out_dt;
	$.each(propertyObj.result, function(key, value) {
		
		var lnk = '';
				
		if (check_in_dt != '' && check_out_dt != '') {
			lnk = '<?= base_url('frontend/venue_booking/property_details/'); ?>' + value.property_id + '/'+ value.rate_id + '/' + check_in_dt + '/' + check_out_dt ;
		} else {
			lnk = '<?= base_url('frontend/venue_booking/property_details/'); ?>' + value.property_id+ '/'+ value.rate_id;
		}
				
		if (value.image1 != '' && value.image1 != null) {
			img = value.image1;
            img_path="<?=base_url('/public/admin_images/') ?>"+ img;
		} else {
			img = 'property_images/no-image.jpg';
		}
        st += '<div class="hotel-view bg-white radius-10 shadow"><div class="hotel-view-flex"><a href="' + lnk + '" class="hotel-view-thumb hotel-view-list-thumb bg-image" style="background-image: url('+img_path+');"></a>';
        st += '<div class="hotel-view-contents"><div class="hotel-view-contents-header"><h3 class="hotel-view-contents-title"> <a href="' + lnk + '"> ' + value.venue_names + '</a></h3><div class="mt-2"><span class="hotel-view-contents-location-icon"> <i class="las la-map-marker-alt"></i> </span><span class="hotel-view-contents-location-para">' + value.property_name + '</span></div>';
        st += '<div class="mt-2"><span class="hotel-view-contents-location-icon"> <i class="las la-money-bill"></i> </span><span class="hotel-view-contents-location-para"> Rs.' + value.base_price + ((value.is_hourly_booking=='1') ? 'for a duration of '+value.booking_hours +' hours' :' per calender day')+'</span></div>';
        st += '<div class="btn-wrapper mt-4"><a href="' + lnk + '" class="cmn-btn btn-bg-1"> View Details </a><a href="check-availability-rates.html" class="cmn-btn btn-bg-1"> Check Availability & Rates </a></div></div></div> </div></div>';
	});
	$("#property_list_div").html(st);
	$("#property_count").html(((propertyObj.result)? propertyObj.result.length : '0')+ " Results");
	$('#icon').hide();
}
	
});
</script>















