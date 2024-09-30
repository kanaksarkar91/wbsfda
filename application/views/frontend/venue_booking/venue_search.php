<div class="breadcrumb-area section-bg-2 breadcrumb-padding">
                <div class="container custom-container-one">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb-contents">
                                <h4 class="breadcrumb-contents-title"> Halls & Venues Booking </h4>
                                <ul class="breadcrumb-contents-list list-style-none">
                                    <li class="breadcrumb-contents-list-item"> <a href="<?=base_url()?>" class="breadcrumb-contents-list-item-link"> Home </a> </li>
                                    <li class="breadcrumb-contents-list-item"> Halls & Venues Booking </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section class="py-0">
                <div class="container">
                    <div class="banner-location bg-white radius-5">
                    <div class="text-center mb-3">    
                        <h3 class="title-txt mb-2">Online Booking Options</h3>
                        <!-- <span class="thm-txt">You may also avail multiple venues in a single booking</span> -->
                    </div>
                    <hr>
                        <form action="" method="get" id="venue_booking_form" class="venue_booking_form"> <!-- banner-location-flex -->
                        <input type="hidden" name="wish" id="wish" value="<?= isset($search_keywords) && $search_keywords != '' ? $search_keywords : ''; ?>" >
                        <input type="hidden" name="property_id" id="property_id" value="<?= isset($property_type) && $property_type != '' ? $property_type : ''; ?>" >
    
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input venueBookingOptions" type="radio" name="venueBookingOptions" id="venueRadio1" value="option1" checked>
                                <label class="form-check-label fw-bold text-dark pl-0" for="venueRadio1">Any one of our venues<!--Book venues for your events--></label>
                            </div>
                            <div class="form-check form-check-inline ms-0">
                                <input class="form-check-input venueBookingOptions" type="radio" name="venueBookingOptions" id="venueRadio2" value="option2">
                                <label class="form-check-label fw-bold text-dark pl-0" for="venueRadio2">You may also avail multiple venues in a single booking</label>
                            </div>
                        </div>

                            <!-- <div class="banner-location-single">
                                <div class="banner-location-single-flex">
                                    <div class="banner-location-single-contents">
                                        <span class="banner-location-single-contents-subtitle"><i class="las la-home"></i> Venue Type </span>
                                        <select class="form-select" name="venue_type" id="venue_type">
											<option value="">Single Venues</option>
											<option value="">Multiple Venues</option>
                               			 </select>
                                    </div>
                                </div>
                            </div> -->
                        
                        
                            <!-- <div class="banner-location-single">
                                <div class="banner-location-single-flex">
                                    <div class="banner-location-single-contents">
                                        <span class="banner-location-single-contents-subtitle"><i class="las la-home"></i> Type </span>
                                        <select class="form-select" name="venue_type" id="venue_type"> -->
											<!--<option value="" data-hall="0">Select Type</option>-->
											<!-- <option value="">Hall & Venue</option> -->
                                            <!--<option value="" data-hall="0">Select Type</option>-->
                                            <!-- <?php
                                            if (isset($property_types))
                                                foreach ($property_types as $type) { if($type['is_hall']){
                                            ?>
                                            <option value="<?= $type['id']; ?>" data-hall="<?= $type['is_hall'];?>"><?= $type['property_type_name']; ?></option>
                                            <?php }} ?> -->
                               			 <!-- </select>
                                    </div>
                                </div>
                            </div> -->
                            <div class="d-flex flex-column flex-md-row gap-2">
                                <div class="banner-location-single mb-2">
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
                                <div class="banner-location-single mb-2">
                                    <div class="banner-location-single-flex">
                                        <div class="banner-location-single-contents">
                                            <span class="banner-location-single-contents-subtitle"><i class="las la-calendar"></i> Check Availability </span>
                                            <input type="text" class="form-control check-in-out" name="dates" id="dates" value="<?= isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '' ? ($from_date . ' - ' . $to_date) : ''; ?>" />

                                        </div>
                                    </div>
                                </div>
                                <div class="banner-location-single-search mt-3">
                                    <button type="submit" class="cmn-btn btn-bg-1 w-100">Submit <i class="las la-chevron-circle-right"></i></button>
                                </div>
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
                                <div class="grid-list-contents-para">
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
                        <!-- <div class="row g-0 w-100"> -->
                            <div class="row g-2 w-100" id="property_list_div">
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
                        <!-- </div> -->
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

    var veneuOption = $(".venueBookingOptions:checked").val(); 	

	var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";
		
	if ((keywords != '' || landscape_property != '') && (date_range == '')) {
		$.ajax({
			url: "<?= base_url('frontend/Venue_booking/searchprocess'); ?>",
			type: "post",
			data: {
				type: '1',
				keywords: keywords,
				landscape_property: landscape_property,
                veneuOption: veneuOption,
				//property_type: hoteltypes,
				"<?= $this->security->get_csrf_token_name(); ?>": csrf_token

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
                veneuOption: veneuOption,
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
			url: "<?= base_url('frontend/Venue_booking/searchprocess'); ?>",
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
			url: "<?= base_url('frontend/Venue_booking/searchprocess'); ?>",
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

    //console.log(propertyObj);

	var check_in_dt = propertyObj.check_in_dt;
	var check_out_dt = propertyObj.check_out_dt;
	$.each(propertyObj.result, function(key, value) {  
		
		var lnk = '';
		var img='';
		var img_path='';
        var noimg_path='';	
        var chk_avl_lnk='';		
		if (check_in_dt != '' && check_out_dt != '') {
			lnk = '<?= base_url('frontend/venue_booking/property_details/'); ?>' + value.property_id + '/'+ value.rate_id + '/' + check_in_dt + '/' + check_out_dt ;
            var chk_avl_lnk="<?= base_url('check-venue-available-rate/') ?>"+ value.rate_id+ '/' + check_in_dt + '/' + check_out_dt ;

        } else {
			lnk = '<?= base_url('frontend/venue_booking/property_details/'); ?>' + value.property_id+ '/'+ value.rate_id;
            var chk_avl_lnk="<?= base_url('check-venue-available-rate/') ?>"+ value.rate_id;

        }
				
		/*if (value.image1 != '' && value.image1 != null) {
			img = value.image1;
            img_path="<?=base_url('/public/admin_images/') ?>"+ img;
		} else {
			img = 'property_images/no-image.jpg';
            img_path="";
		}*/

        img_path = "<?=base_url('/public/admin_images/') ?>";
        noimg_path = "<?=base_url('/public/frontend_assets/images/') ?>"

        var approx_cap='';
        if(value.approx_capacity)
            approx_cap='<span class="hotel-view-contents-location-icon"><i class="las la-users"></i> </span><span class="hotel-view-contents-location-para ms-1"><span class="fw-bold text-dark"> Approx Maximum Capacity :</span> ' + value.approx_capacity + '</span>';

        var avail_time='';
        if(value.available_timming)
            avail_time='<div class="col-lg-12 mt-2 order-3"><span class="hotel-view-contents-location-icon"> <i class="las la-user-clock"></i> </span><span class="hotel-view-contents-location-para ms-1"><span class="fw-bold text-dark"> Available Timing :</span> ' + value.available_timming + '</span></div>';
	
        //st += '<div class="hotel-view bg-white radius-10 shadow"><div class="row hotel-view-flex"><a href="' + lnk + '" class="col-lg-3 col-md-4 hotel-view-thumb hotel-view-list-thumb bg-image" style="background-image: url('+img_path+');"></a>';
        st += '<div class="hotel-view radius-10 col-lg-4 col-md-6"><div class="row g-0 hotel-view-flex">';
        st += '<a class="col-12" href="' + lnk + '">';
        st += '<div id="carouselExampleControls'+key+'" class="carousel slide carousel-fade" data-bs-ride="carousel">';
        st += '<div class="carousel-inner">';

        if(value.venue_image){           

            $.each(value.venue_image, function(keyim, valueim) {

                console.log();

                if(keyim == 0){
                    var claSs = 'active';
                } else {
                    var claSs = '';
                }

                st += '<div class="carousel-item '+claSs+'"><img src="'+img_path+valueim.image_path+'" class="d-block w-100" alt=""></div>';

            });

        } else {
            st += '<div class="carousel-item active"><img src="'+noimg_path+'placeholder.jpg" class="d-block w-100" alt=""></div>';
        }


        
        /*if(value.image1 || value.image2 || value.image3 || value.image4){
            if(value.image1){                

                if(value.is_multiple_venues == 1){
                    var imG1 = value.image1.split(",");
                    $.each(imG1,function(i){
                        if(i == 0){
                            var claSs = 'active';
                        } else {
                            var claSs = '';
                        }
                        st += '<div class="carousel-item '+claSs+'"><img src="'+img_path+imG1[i]+'" class="d-block w-100" alt=""></div>';
                    });
                } else {
                    st += '<div class="carousel-item active"><img src="'+img_path+value.image1+'" class="d-block w-100" alt=""></div>';
                } 
            } 
            if(value.image2){
                if(value.is_multiple_venues == 1){
                    var imG2 = value.image2.split(",");
                    $.each(imG2,function(i){
                        if(i == 0){
                            var claSs = '';
                        } else {
                            var claSs = '';
                        }
                        st += '<div class="carousel-item '+claSs+'"><img src="'+img_path+imG2[i]+'" class="d-block w-100" alt=""></div>';
                    });
                } else {
                    st += '<div class="carousel-item"><img src="'+img_path+value.image2+'" class="d-block w-100" alt=""></div>';
                } 
            } 
            if(value.image3){
                if(value.is_multiple_venues == 1){
                    var imG3 = value.image3.split(",");
                    $.each(imG3,function(i){
                        if(i == 0){
                            var claSs = '';
                        } else {
                            var claSs = '';
                        }
                        st += '<div class="carousel-item '+claSs+'"><img src="'+img_path+imG3[i]+'" class="d-block w-100" alt=""></div>';
                    });
                } else {
                    st += '<div class="carousel-item"><img src="'+img_path+value.image3+'" class="d-block w-100" alt=""></div>';
                } 
            }
            if(value.image4){
                if(value.is_multiple_venues == 1){
                    var imG4 = value.image4.split(",");
                    $.each(imG4,function(i){
                        if(i == 0){
                            var claSs = '';
                        } else {
                            var claSs = '';
                        }
                        st += '<div class="carousel-item '+claSs+'"><img src="'+img_path+imG4[i]+'" class="d-block w-100" alt=""></div>';
                    });
                } else {
                    st += '<div class="carousel-item"><img src="'+img_path+value.image4+'" class="d-block w-100" alt=""></div>';
                } 
            }
        } else {
            st += '<div class="carousel-item active"><img src="'+noimg_path+'placeholder.jpg" class="d-block w-100" alt=""></div>';
        }*/
        
        //st += '<div class="carousel-item active"><img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/19.jpg" class="d-block w-100" alt=""></div>';
        //st += '<div class="carousel-item"><img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/20.jpg" class="d-block w-100" alt=""></div>';
        //st += '<div class="carousel-item"><img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/19.jpg" class="d-block w-100" alt=""></div>';
        //st += '<div class="carousel-item"><img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/20.jpg" class="d-block w-100" alt=""></div>';
        st += '</div>';
        st += '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls'+key+'" data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button> <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls'+key+'" data-bs-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>';
        st += '</div>';
        st += '</a>';
        st += '<div class="hotel-view-contents col-12"><div class="hotel-view-contents-header"><h3 class="hotel-view-contents-title"> <a href="' + lnk + '"> ' + value.venue_names + '</a></h3><div class="row"><div class="col-lg-12 mt-2"><span class="hotel-view-contents-location-icon"> <i class="las la-map-marker-alt"></i> </span><span class="hotel-view-contents-location-para ms-1">' + value.property_name + '</span></div> <div class="col-lg-12 mt-2">'+approx_cap+'</div>';
        st += '<div class="col-lg-12 mt-2 order-4"><span class="hotel-view-contents-location-icon"> <i class="las la-money-bill"></i></span> <span class="hotel-view-contents-bottom-title">Rs.' + formatIndianNumber(value.base_price) +'</span>&nbsp; <span class="hotel-view-contents-location-para ms-1">' +((value.is_hourly_booking_rate=='1') ? '  for a duration of '+ value.booking_hours_rate +' hours in a day' :'  per calender day')+'</span></div>'+avail_time+'</div>';
        st += '<div class="btn-wrapper mt-4"><a href="' + lnk + '" class="cmn-btn btn-bg-1 me-2 mt-1"> View Details </a><a href="'+chk_avl_lnk+'" class="cmn-btn btn-bg-1 mt-1"> Check Availability & Rates </a></div></div></div> </div></div>';
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















