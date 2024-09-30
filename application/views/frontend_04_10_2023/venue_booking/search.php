<!-- ============================ Page Title Start================================== -->
<div class="image-cover page-title" style="background:url(https://panchayet.syscentricdev.com/public/frontend_assets/images/banner/darjeeling-hills.jpg) no-repeat;     background-size: cover;" data-overlay="6">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">

				<h2 class="ipt-title">List of Accommodation</h2>
				

			</div>
		</div>
	</div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- =================== Sidebar Search ==================== -->
<section class="gray">
	<div class="container">
		<div class="row">
			<div class="order-2 col-lg-4 col-md-12 order-lg-1 order-md-2">
				<input type="hidden" name="wish" id="wish" value="<?= isset($search_keywords) && $search_keywords != '' ? $search_keywords : ''; ?>" >
				<input type="hidden" name="property_id" id="property_id" value="<?= isset($property_type) && $property_type != '' ? $property_type : ''; ?>" >
				<input type="hidden" name="adult_pax" id="adult_pax" value="<?= isset($adult_pax) && $adult_pax != '' ? $adult_pax : ''; ?>" >
				<input type="hidden" name="child_pax" id="child_pax" value="<?= isset($child_pax) && $child_pax != '' ? $child_pax : ''; ?>" >
				<!-- property Sidebar -->
				<div class="exlip-page-sidebar">

					<!-- Find New Property -->
					<div class="sidebar-widgets">
						<div class="form-group">
							<div class="input-with-icon">
								<select name="landscape" id="landscape" class="form-control">
										<option value="">All Landscapes</option>
										<?php
										if (isset($terrains))
											foreach ($terrains as $t) {
										?>
										<option value="<?= $t['terrain_id']; ?>" <?= set_select('landscape', $t['terrain_id'], isset($landscape) && $landscape == $t['terrain_id'] ? true : false); ?>><?= $t['terrain_name']; ?></option>
										<?php } ?>
									</select>
								<i class="ti-map-alt"></i>
							</div>
						</div>
						<div class="form-group">
							<div class="input-with-icon">
								<select name="property_district" id="property_district" class="form-control">
										<option value="0">All Districts</option>
										<?php
										if (isset($districts))
											foreach ($districts as $d) {
										?>
										<option value="<?= $d['district_id']; ?>" <?= set_select('property_district', $d['district_id'], isset($district) && $district == $d['district_id'] ? true : false); ?>><?= $d['district_name']; ?></option>
										<?php } ?>
									</select>
								<i class="ti-map-alt"></i>
							</div>
						</div>
						<div class="form-group">
							<div class="input-with-icon">
								<input type="text" name="destination" id="destination" class="form-control" placeholder="Destination" value="<?= isset($destination) && $destination != '' ? $destination : ''; ?>">
								<i class="ti-location-pin"></i>
							</div>
						</div>

						<div class="form-group">
							<div class="input-with-icon">
								<input type="text" class="form-control check-in-out" name="dates" id="dates" value="<?= isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '' ? ($from_date . ' - ' . $to_date) : ''; ?>" />
								<i class="ti-calendar"></i>
							</div>
						</div>

						<div class="ameneties-features mt-3">
							<label class="h6">Hotel Types</label>
							<ul class="no-ul-list">
								<!--<li>
									<input id="hoteltype-1" class="checkbox-custom" name="hoteltype-1" value="" type="checkbox">
									<label for="hoteltype-1" class="checkbox-custom-label">All Types</label>
								</li>-->
								<?php
								$i = 2;
								if (isset($property_types))
									foreach ($property_types as $pt) {
								?>
								<li>
									<input id="hoteltype-<?= $i; ?>" class="checkbox-custom" name="hoteltype[<?= $i; ?>]" value="<?= $pt['id']; ?>" type="checkbox" <?= set_checkbox('hoteltype[' . $i . ']', $pt['id'], $pt['id'] == $property_type ? true : false); ?>>
									<label for="hoteltype-<?= $i; ?>" class="checkbox-custom-label"><?= $pt['property_type_name']; ?></label>
								</li>
								<?php 
									$i++;
								} 
								?>
							</ul>

						</div>

						<div class="ameneties-features mt-3">
							<label class="h6">Advance Features</label>
							<ul class="no-ul-list">
								<?php
								$i = 1;
								if (isset($facilities))
									foreach ($facilities as $f) {
								?>
								<li>
									<input id="a-<?= $i; ?>" class="checkbox-custom" name="facilities[<?= $i; ?>]" type="checkbox" value="<?= $f['facility_id']; ?>">
									<label for="a-<?= $i; ?>" class="checkbox-custom-label"><?= ucwords($f['facility_name']); ?></label>
								</li>
								<?php
									$i++;
								} 
								?>
							</ul>

						</div>

					</div>
				</div>
			</div>
			<!-- Sidebar End -->

			<div class="order-1 content-area col-lg-8 col-md-12 order-md-1 order-lg-2">
				<div class="row">
				
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="shorting-wrap mb-0">
							<h5 class="shorting-title" id="property_count"></h5>
							<!--<div class="shorting-right">
								<label>Short By:</label>
								<div class="dropdown show">
									<a class="btn btn-filter dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<span class="selection">Most Rated</span>
									</a>
									<div class="drp-select dropdown-menu">
										<a class="dropdown-item" href="JavaScript:Void(0);">Most Rated</a>
										<a class="dropdown-item" href="JavaScript:Void(0);">Most Viewd</a>
										<a class="dropdown-item" href="JavaScript:Void(0);">News Listings</a>
										<a class="dropdown-item" href="JavaScript:Void(0);">High Rated</a>
									</div>
								</div>
							</div>-->
						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-md-12 col-sm-12 mt-3" id="property_list_div">
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
</section>
<!-- =================== Sidebar Search ==================== -->
<script>
function property_search() {
	var keywords = $('#wish').val();
	var landscape = $('#landscape').val();
	var property_district = $('#property_district').val();
	var property_type_id = $('#property_id').val();
	var search_string = $('#destination').val();
	var date_range = $('#dates').val();
	var adult_pax = $('#adult_pax').val();
	var child_pax = $('#child_pax').val();
	var destination = $('#destination').val();
	var hoteltypes = '';
	var facilities = '';
	
	var hotelTypeArr = [];
	
	$('input[name^="hoteltype"]:checked').each(function() {
		hotelTypeArr.push($(this).val());
	});
	
	if (hotelTypeArr.length > 0) {
		hoteltypes = hotelTypeArr.join(',');
	}
	
	var facilitiesArr = [];
	
	$('input[name^="facilities"]:checked').each(function() {
		facilitiesArr.push($(this).val());
	});
	
	if (facilitiesArr.length > 0) {
		facilities = facilitiesArr.join(',');
	}
			
	if ((keywords != '' || landscape != '' || property_district != '') && (date_range == '' || adult_pax == '' || child_pax == '')) {
		$.ajax({
			url: "<?= base_url('frontend/booking/searchprocess'); ?>",
			type: "post",
			data: {
				type: '1',
				keywords: keywords,
				landscape: landscape,
				property_district: property_district,
				property_type: hoteltypes,
				facilities: facilities
			},
			success: function(response) {
				propertyResult(response);
			}
		});
	} else {
		$.ajax({
			url: "<?= base_url('frontend/booking/searchprocess'); ?>",
			type: "post",
			data: {
				type: '2',
				search_string: search_string,
				keywords: keywords,
				landscape: landscape,
				property_district: property_district,
				date_range: date_range,
				adult_pax: adult_pax,
				child_pax: child_pax,
				property_type: hoteltypes,
				facilities: facilities
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
	var adult = propertyObj.adult;
	var child = propertyObj.child;
	$.each(propertyObj.result, function(key, value) {
		
		var lnk = '';
				
		if (check_in_dt != '' && check_out_dt != '') {
			lnk = '<?= base_url('frontend/booking/property_details/'); ?>' + value.property_id + '/' + check_in_dt + '/' + check_out_dt + '/' + adult + '/' + child;
		} else {
			lnk = '<?= base_url('frontend/booking/property_details/'); ?>' + value.property_id;
		}
				
		if (value.image1 != '' && value.image1 != null) {
			img = value.image1;
		} else {
			img = 'property_images/no-image.jpg';
		}

		st += '<div class="book_list_box popular_item"><div class="row no-gutters"><div class="col-lg-4 col-md-4"><figure><img src="<?= base_url('public/admin_images/'); ?>' + img + '" class="img-responsive" alt="" /></figure></div><div class="col-lg-6 col-md-6 pl-3 side-br"><div class="book_list_header"><h4 class="book_list_title">' + value.property_name + '</h4><span class="location"><i class="ti-location-pin"></i>' + value.property_address + '</span></div><div class="book_list_description"><p>' + (value.property_desc != null ? (value.property_desc.substr(0, 100) + (value.property_desc.length > 100 ? '...' : '')) : '') + '</p></div><div class="book_list_offers"><ul><li><!--<i class="ti-location-pin"></i>-->' + value.facilities + '</li></ul></div></div><div class="col-lg-2 col-md-2 padd-l-0"><div class="book_list_foot">';
		st += typeof value.lowest_rate !== 'undefined' ? ('<h4 class="book_list_price">₹' + value.lowest_rate + '</h4><span class="booking-time">per night</span>') : '';
		st += '<a href="' + lnk + '" class="book_list_btn btn-theme">Select</a></div></div></div></div>';

	});
	$("#property_list_div").html(st);
	$("#property_count").html(propertyObj.result.length + " Results");
	$('#icon').hide();
}
</script>
<script>
$(document).ready(function() {
	property_search();
	$("#landscape").on("change", function() {
		property_search();
	});
	$("#property_district").on("change", function() {
		property_search();
	});
	$("#destination").on("keyup", function() {
		property_search();
	});
	$('#dates').on('apply.daterangepicker', function(ev, picker) {
		//$("#checkindt").val(picker.startDate.format('DDMMYYYY'));
		//$("#checkoutdt").val(picker.endDate.format('DDMMYYYY'));
		$("#dates").val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
		property_search();
	});
	$('input[name^="hoteltype"]').on("change", function() {
		property_search();
	});
	$('input[name^="facilities"]').on("change", function() {
		property_search();
	});
});
</script>















