<section class="inner-banner-section" style="background: url(<?= base_url(); ?>public/frontend_assets/assets/img/destinations-banner.png); background-size: cover; background-position: center;">
    <div class="container-xxl">
        <h1 class="text-center">Eco Tourism Destinations</h1>

        <div class="tab_area rounded-4">
            <div class="form-content" id="">
                <form action="" class="row g-2 align-items-center">
                    <div class="col-md-6 col-lg-6 col-xl-2 mb-3">
                        <div class="select_area">
                            <select name="landscape" id="landscape" class="form-control">
                                <option value="">All Locations</option>
                                <?php
                                if (isset($terrains))
                                    foreach ($terrains as $t) {
                                ?>
                                    <option value="<?= $t['terrain_id']; ?>" <?= set_select('landscape', $t['terrain_id'], isset($landscape) && $landscape == $t['terrain_id'] ? true : false); ?>><?= $t['terrain_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 col-lg-6 col-xl-2 mb-3">
                        <div class="select_area">
                            <select name="" id="" class="form-control">
                                <option value="" disabled>Select Type</option>
                                <option value="" selected>Safari</option>
                            </select>
                        </div>
                    </div> -->
                    <div class="col-md-4 col-lg-3 col-xl-2 mb-3">
                        <div class="calenadr_area">
                            <input type="hidden" class="form-control check-in-out" name="dates" id="dates" value="<?= isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '' ? ($from_date . ' - ' . $to_date) : ''; ?>" />
                            <input type="text" class="form-control" name="checkIn" id="checkIn" value="<?= isset($from_date) && $from_date != '' ? $from_date : ''; ?>" readonly="" placeholder="From Date">
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-2 mb-3">
                        <div class="calenadr_area">
                            <input type="text" class="form-control" name="checkOut" id="checkOut" value="<?= isset($to_date) && $to_date != '' ? $to_date : ''; ?>" readonly="" placeholder="To Date">
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-2 mb-3">
                        <div class="select_area">
                            <select name="nationality" id="nationality" class="form-control">
                                <option value="" disabled>Select Nationality</option>
                                <option value="indian" <?= isset($nationality) && $nationality == 'indian' ? 'selected' : ''; ?>>Indian</option>
                                <option value="foreigner" <?= isset($nationality) && $nationality == 'foreigner' ? 'selected' : ''; ?>>Foreigner</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-3 col-xl-2 mb-3">
                        <button type="button" onclick="property_search()" class="w-100 btn btn-green">
                            <span id="search-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            <span class="button-text">Search Availability</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
<section>
    <div class="container">
        <div class="row" id="property_list_div">
            <!-- <?php foreach ($property as $prop) { ?>
                <div class="col-md-12 mb-4">
                    <div class="destination_slider_area row g-0">
                        <div class="destination_slider_img col-md-12 col-lg-6 col-xl-4">
                            <ul class="destination-carousel owl-carousel slider_list">
                                <?php for ($i = 1; $i <= 3; $i++) {
                                    $image = $prop["image$i"];
                                    if (!empty($image)) { ?>
                                        <li>
                                            <img src="<?= base_url(); ?>public/admin_assets/<?= $image; ?>" alt="">
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                        </div>
                        <div class="destination_slider_txt col-md-12 col-lg-6 col-xl-8">
                            <h3><?= $prop['property_name']; ?></h3>
                            <p class="map_ico"><i class="fas fa-map-marker-alt"></i> <?= $prop['google_map_address']; ?></p>
                            <h4>Description:</h4>
                            <p class="destination_p"><?= $prop['property_desc']; ?></p>
                            <div class="row price_area">
                                <div class="col-md-5">
                                    <h5>Price starts from</h5>
                                    <h4><b>₹300.00</b> <span>per night</span></h4>
                                </div>
                                <div class="col-md-7">
                                    <h5>Timing:</h5>
                                    <p>Check in: <b><?= $prop['checkin_time']; ?> AM</b> Check out: <b><?= $prop['checkout_time']; ?> AM</b></p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="<?= base_url('frontend/booking/property_details/' . $prop['property_id']); ?>" class="btn btn-green px-5 py-2">Select</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?> -->
        </div>
    </div>
</section>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).on('click', '.notifyMe', function() {
        $('#notify_property_id').val($(this).attr('data-property-id'));
        $('#notify_from_date').val($(this).attr('data-from-date'));
        $('#notify_to_date').val($(this).attr('data-to-date'));
    });


    $(document).on('click', '#notifyMeBtn', function() {
        $(this).html($(this).text() + ' ' + '<i class="fa fa-spinner fa-pulse fa-x fa-fw"></i>');
        $(this).prop('disabled', true);
        $.ajax({
            url: "<?= base_url('index/notify_me') ?>",
            cache: false,
            type: "POST",
            data: $('form#notifyForm').serialize(),
            dataType: "JSON",
            success: function(res) {
                //location.reload();
                console.log(res); //return;
                if (res.error == 1) {
                    $('#notify_popup-modal-body').prepend(`<div class="alert alert-danger">` + res.msg + `</div>`);
                    $('#notifyMeBtn').html('Notify');
                    $('#notifyMeBtn').prop('disabled', false);
                    $('html, body').animate({
                        scrollTop: $("#notify_popup-modal-body").offset().top
                    }, 2000);
                } else {
                    $('#notify_popup').modal('hide');
                    swal('Success', res.msg, 'success');
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);

                }
            }
        });
    });


    function property_search() {
        // Show spinner and disable button
        $('#search-spinner').removeClass('d-none');
        $('.button-text').text('Searching...');
        $('button[onclick="property_search()"]').prop('disabled', true);

        var keywords = $('#wish').val();
        var landscape = $('#landscape').val();
        var property_district = $('#property_district').val();
        var property_type_id = $('#property_id').val();
        var search_string = $('#destination').val();
        //var date_range = $('#dates').val();
        var adult_pax = $('#adult_pax').val();
        var child_pax = $('#child_pax').val();
        var destination = $('#destination').val();
        var hoteltypes = '';
        var facilities = '';

        var checkIn = $('#checkIn').val();
        var checkOut = $('#checkOut').val();
        var date_range = checkIn + ' - ' + checkOut;

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
                    facilities: facilities,
                    csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>',
                },
                success: function(response) {
                    propertyResult(response);
                    // Hide spinner and enable button
                    $('#search-spinner').addClass('d-none');
                    $('.button-text').text('Search Availability');
                    $('button[onclick="property_search()"]').prop('disabled', false);
                },
                error: function() {
                    // Hide spinner, enable button, and show error message
                    $('#search-spinner').addClass('d-none');
                    $('.button-text').text('Search Availability');
                    $('button[onclick="property_search()"]').prop('disabled', false);
                    alert('An error occurred. Please try again.');
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
                    facilities: facilities,
                    csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>',
                },
                success: function(response) {
                    propertyResult(response);
                    // Hide spinner and enable button
                    $('#search-spinner').addClass('d-none');
                    $('.button-text').text('Search Availability');
                    $('button[onclick="property_search()"]').prop('disabled', false);
                },
                error: function() {
                    // Hide spinner, enable button, and show error message
                    $('#search-spinner').addClass('d-none');
                    $('.button-text').text('Search Availability');
                    $('button[onclick="property_search()"]').prop('disabled', false);
                    alert('An error occurred. Please try again.');
                }
            });
        }
    }

    function propertyResult(response) {
        var st = '';
        var img = '';
        var action = '';
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

            if (value.image2 != '' && value.image2 != null) {
                img2 = value.image2;
            } else {
                img2 = value.image1;
            }

            if (value.image3 != '' && value.image3 != null) {
                img3 = value.image3;
            } else {
                img3 = value.image1;
            }

            if (value.image4 != '' && value.image4 != null) {
                img4 = value.image4;
            } else {
                img4 = value.image1;
            }

            if (value.available_status == 'Y') {
                action = '<a href="' + lnk + '" class="btn btn-green px-5 py-2">Select</a>';

            }
            // else {
            //     action = '<button type="button" class="btn btn-primary notifyMe" data-bs-toggle="modal" data-bs-target="#notify_popup" data-property-id="' + value.property_id + '" data-from-date="<?= $from_date; ?>" data-to-date="<?= $to_date; ?>">Notify Me</button>';
            // }

            st += '<div class="col-md-12 mb-4">';
            st += '<div class="destination_slider_area row g-0">';
            st += '<div class="destination_slider_img col-md-12 col-lg-6 col-xl-4">';
            st += '<ul class="destination-carousel owl-carousel slider_list">';
            st += '<li><img src="<?= base_url(); ?>public/admin_images/' + img + '" alt=""></li>';
            st += '<li><img src="<?= base_url(); ?>public/admin_images/' + img2 + '" alt=""></li>';
            st += '<li><img src="<?= base_url(); ?>public/admin_images/' + img3 + '" alt=""></li>';
            st += '</ul></div>';
            st += '<div class="destination_slider_txt col-md-12 col-lg-6 col-xl-8">';
            st += '<h3>' + value.property_name + '</h3>';
            st += '<p class="map_ico"><i class="fas fa-map-marker-alt"></i> ' + value.property_address + '</p>';
            st += '<h4>Description:</h4>';
            st += '<p class="destination_p">' + value.property_desc + '</p>';
            st += '<div class="row price_area">';
            st += '<div class="col-md-5">';
            st += '<h5>Price starts from</h5>';
            st += '<h4><b>₹' + value.lowest_rate + '</b> <span>per night</span></h4>';
            st += '</div>';
            st += '<div class="col-md-7">';
            st += '<h5>Timing:</h5>';
            st += '<p>Check in: <b>' + value.checkin_time + '</b> Check out: <b>' + value.checkout_time + '</b></p>';
            st += '</div></div>';
            st += '<div class="d-flex justify-content-end">';
            st += action;
            st += '</div></div></div></div>';

        });
        $("#property_list_div").html(st);
        $("#property_count").html(propertyObj.result.length + " Results");
        $('#icon').hide();

        var ds = $('.destination-carousel');
        ds.owlCarousel({
            autoplay: false,
            //autoplayTimeout:1000,
            //autoplaySpeed:700,
            loop: true,
            nav: true,
            dots: false,
            //animateOut: 'fadeOut',
            items: 1,
            navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
        });
    }
</script>
<script>
    $(document).ready(function() {
        property_search();
        // $("#landscape").on("change", function() {
        //     property_search();
        // });
        // $("#property_district").on("change", function() {
        //     property_search();
        // });
        // $("#destination").on("keyup", function() {
        //     property_search();
        // });
        // $('#dates').on('apply.daterangepicker', function(ev, picker) {
        //     //$("#checkindt").val(picker.startDate.format('DDMMYYYY'));
        //     //$("#checkoutdt").val(picker.endDate.format('DDMMYYYY'));
        //     $("#dates").val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        //     property_search();
        // });
        // $('input[name^="hoteltype"]').on("change", function() {
        //     property_search();
        // });
        // $('input[name^="facilities"]').on("change", function() {
        //     property_search();
        // });


        $(function() {
            var today = new Date();
            var maxcheckoutdt = new Date();
            maxcheckoutdt.setMonth(today.getMonth() + 3);
            var mincheckoutdate = new Date();
            mincheckoutdate.setDate(today.getDate() + 2);

            $("#checkIn").datepicker({
                minDate: new Date,
                maxDate: maxcheckoutdt,
                dateFormat: "dd/mm/yy",
                onSelect: function(selectedDate) {
                    var minDate = $(this).datepicker('getDate'); // Get selected date
                    minDate.setDate(minDate.getDate() + 1); // Add one day
                    $("#checkOut").datepicker("option", "minDate", minDate); // Set minimum date for check-out

                    var dateWithoutSlash = selectedDate.replace(/\//g, "");
                    $("#checkindt").val(dateWithoutSlash);

                    property_search();
                }
            });

            $("#checkOut").datepicker({
                minDate: mincheckoutdate,
                maxDate: maxcheckoutdt,
                dateFormat: "dd/mm/yy",
                onSelect: function(selectedDate) {
                    var maxDate = $(this).datepicker('getDate'); // Get selected date
                    maxDate.setDate(maxDate.getDate() - 1); // Subtract one day
                    $("#checkIn").datepicker("option", "maxDate", maxDate); // Set maximum date for check-in

                    var dateWithoutSlash = selectedDate.replace(/\//g, "");
                    $("#checkoutdt").val(dateWithoutSlash);

                    property_search();
                }
            });
        });


    });
</script>