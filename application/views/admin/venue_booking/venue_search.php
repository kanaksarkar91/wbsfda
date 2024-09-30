<style type="text/css">
	.hotel-view-contents-title a{font-size: 18px;line-height: 28px;font-weight: 400;color:#000;}
	.image-bg{background-size: cover;background-repeat: no-repeat;}
	.hotel-view-contents-bottom-title {color: #00bdd6; font-size: 24px;font-weight: 600;}
	.list-property-item{box-shadow: 0 0 10px rgba(0, 0, 0, .15) !important; border-radius: 10px;}
</style>
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">List of Venue</h1>
            </div>
            <div class="col-auto">
                
            </div>
        </div>

        <div class="app-card app-card-settings shadow-sm p-3">
            <div class="app-card-body">
				<form action="" method="get" id="venue_booking_form" class="banner-location-flex venue_booking_form">
                <input type="hidden" name="wish" id="wish" value="<?= isset($search_keywords) && $search_keywords != '' ? $search_keywords : ''; ?>" >
                <input type="hidden" name="property_id" id="property_id" value="<?= isset($property_type) && $property_type != '' ? $property_type : ''; ?>" >
					<div class="row g-3">
                        <div class="col-lg-5 col-sm-12 col-md-4">
                            <label for="" class="form-label">Location</label>
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
                        <div class="col-lg-5 col-sm-12 col-md-4">
                            <label class="form-label"><i class="las la-calendar"></i> Check Availability </label>
                            <input type="text" class="form-control check-in-out" name="dates" id="dates" value="<?= isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '' ? ($from_date . ' - ' . $to_date) : ''; ?>" />
                        </div>
                        <div class="col-lg-2 col-sm-12 col-md-4">
                            <label for="" class="form-label w-100">&nbsp;</label>
                            <button class="btn app-btn-primary w-100" type="submit">SUBMIT</button>
                        </div>
                    </div>
				</form>
            </div>
        </div>


		<div class="app-card app-card-settings shadow-sm mt-3 p-2">
			<div class="row">
				<div class="col-12">
					<div class="d-flex justify-content-between my-3 px-2">
						<span id="property_count"></span>
						<div>
							<select id="priceSort" name="" class="form-select form-select-sm border-0">
								<option value="1">Price: High to Low</option>
								<option value="0" selected>Price: Low to High</option>
							</select>
						<div>
					</div>  
				</div>
			</div>
			<div class="row px-4">
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
</div>

            <script src="<?= base_url('public/admin_assets/js/custom.js'); ?>"></script>

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
	

	var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";
		
	if ((keywords != '' || landscape_property != '') && (date_range == '')) {
		$.ajax({
			url: "<?= base_url('admin/Venue_booking/searchprocess'); ?>",
			type: "post",
			data: {
				type: '1',
				keywords: keywords,
				landscape_property: landscape_property,
				//property_type: hoteltypes,
				"<?= $this->security->get_csrf_token_name(); ?>": csrf_token

			},
			success: function(response) {
				propertyResult(response);
			}
		});
	} else {
		$.ajax({
			url: "<?= base_url('admin/Venue_booking/searchprocess'); ?>",
			type: "post",
			data: {
				type: '2',
				keywords: keywords,
				landscape_property: landscape_property,
				date_range: date_range,
				//property_type: hoteltypes,
				"<?= $this->security->get_csrf_token_name(); ?>": csrf_token
			},
			success: function(response) {
				propertyResult(response);
			}
		});
	}
}

$('#priceSort').change(function() {
        // Get the selected value on change
        selectedOption = $(this).val();
        var keywords = $('#wish').val();
	var landscape_property = $('#landscape_property').val();
	var property_type_id = $('#property_id').val();
	var date_range = $('#dates').val();
	

	var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";
		
	if ((keywords != '' || landscape_property != '') && (date_range == '')) {
		$.ajax({
			url: "<?= base_url('admin/Venue_booking/searchprocess'); ?>",
			type: "post",
			data: {
				type: '1',
				keywords: keywords,
				landscape_property: landscape_property,
                selectedOption:selectedOption,
				//property_type: hoteltypes,
				"<?= $this->security->get_csrf_token_name(); ?>": csrf_token

			},
			success: function(response) {
				propertyResult(response);
			}
		});
	} else {
		$.ajax({
			url: "<?= base_url('admin/Venue_booking/searchprocess'); ?>",
			type: "post",
			data: {
				type: '2',
				keywords: keywords,
				landscape_property: landscape_property,
				date_range: date_range,
                selectedOption:selectedOption,
				//property_type: hoteltypes,
				"<?= $this->security->get_csrf_token_name(); ?>": csrf_token
			},
			success: function(response) {
				propertyResult(response);
			}
		});
	}
});

function propertyResult(response) {
	var st = '';
	var img = '';
	var propertyObj = $.parseJSON(response);
	var check_in_dt = propertyObj.check_in_dt;
	var check_out_dt = propertyObj.check_out_dt;
	$.each(propertyObj.result, function(key, value) {
		
		var lnk = '';
		var img='';
		var img_path='';	
        var chk_avl_lnk='';		
		if (check_in_dt != '' && check_out_dt != '') {
			lnk = '<?= base_url('admin/venue_booking/property_details/'); ?>' + value.property_id + '/'+ value.rate_id + '/' + check_in_dt + '/' + check_out_dt ;
            var chk_avl_lnk="<?= base_url('check-admin-venue-available-rate/') ?>"+ value.rate_id+ '/' + check_in_dt + '/' + check_out_dt ;

        } else {
			lnk = '<?= base_url('admin/venue_booking/property_details/'); ?>' + value.property_id+ '/'+ value.rate_id;
            var chk_avl_lnk="<?= base_url('check-admin-venue-available-rate/') ?>"+ value.rate_id;

        }
				
		if (value.image1 != '' && value.image1 != null) {
			img = value.image1;
            img_path="<?=base_url('/public/admin_images/') ?>"+ img;
		} else {
			img = 'property_images/no-image.jpg';
            img_path="";
		}

        st += '<div class="row mb-3 p-2 list-property-item"><a href="' + lnk + '" class="rounded col-lg-3 col-md-4 image-bg" style="background-image: url('+img_path+');"></a>';
        st += '<div class="hotel-view-contents col-lg-9 col-md-8"><div class="hotel-view-contents-header"><h4 class="hotel-view-contents-title"> <a href="' + lnk + '"> ' + value.venue_names + '</a></h4><div class="row"><div class="col-lg-6 mt-2"><span class="hotel-view-contents-location-icon"> <i class="fa fa-map-marker"></i> </span><span class="hotel-view-contents-location-para">' + value.property_name + '</span></div><div class="col-lg-6 mt-2"><span class="hotel-view-contents-location-icon"> <i class="fa fa-users"></i> </span><span class="hotel-view-contents-location-para"><span class="fw-bold text-dark"> Approx Maximum Capacity: </span>' + value.approx_capacity + '</span></div>';
        st += '<div class="col-lg-6 mt-2 order-4 order-lg-3"><span class="hotel-view-contents-location-icon"> <i class="fa fa-money"></i></span> <span class="hotel-view-contents-bottom-title">Rs.' + formatIndianNumber(value.base_price) +'</span>&nbsp; <span class="hotel-view-contents-location-para">' +((value.is_hourly_booking_rate=='1') ? '  for a duration of '+ value.booking_hours_rate +' hours in a day' :'  per calender day')+'</span></div><div class="col-lg-6 mt-2 order-3"><span class="hotel-view-contents-location-icon"> <i class="fa fa-clock-o"></i> </span><span class="hotel-view-contents-location-para"><span class="fw-bold text-dark"> Available Timing: </span>' + value.available_timming + '</span></div></div>';
        st += '<div class="btn-wrapper mt-2"><a href="' + lnk + '" class="btn app-btn-primary"> View Details </a><a href="'+chk_avl_lnk+'" class="btn app-btn-primary ms-2"> Check Availability & Rates </a></div></div></div> </div>';

	});
	$("#property_list_div").html(st);
	$("#property_count").html(((propertyObj.result)? propertyObj.result.length : '0')+ " Results");
	$('#icon').hide();
}
	  // Function to format a number in the Indian numbering system
	  function formatIndianNumber(number) {
            var parts = number.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }

});
</script>















