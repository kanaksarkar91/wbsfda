<section class="banner_sec p-0">
    <div class="container-xxl facilitySec">
        <h1><span class="title1">BOOK OUR FACILITIES</span> <br> <span class="title2">EXPLORE THE WILD</span></h1>
        <!-- <h2></h2> -->
        <div class="tab_area rounded-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php
                if (!empty($safariTypes)) {
                    foreach ($safariTypes as $key => $row) {
                ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?= $key == 0 ? 'active' : ''; ?> serviceType" id="safari-tab-<?= $row['safari_type_id']; ?>" data-bs-toggle="tab" data-bs-target="#safari-<?= $row['safari_type_id']; ?>" type="button" role="tab" aria-controls="safari-<?= $row['safari_type_id']; ?>" data-typeid="<?= $row['safari_type_id']; ?>" aria-selected="true"><i class="<?= $row['safari_type_id'] == 1 ? 'fas fa-truck-pickup me-2' : 'fas fa-republican me-2'; ?>"></i> <?= $row['type_name']; ?></button>
                        </li>
                <?php }
                } ?>
                <!--<li class="nav-item" role="presentation">
                    <button class="nav-link" id="elephant-safari-tab" data-bs-toggle="tab" data-bs-target="#elephant-safari" type="button" role="tab" aria-controls="elephant-safari" aria-selected="false"><i class="fas fa-republican me-2"></i> Elephant Safari</button>
                </li>-->
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="eco-tourism-tab" data-bs-toggle="tab" data-bs-target="#eco-tourism" type="button" role="tab" aria-controls="eco-tourism" aria-selected="false"><i class="fas fa-hotel me-2"></i> Eco Tourism</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div id="tabContentHtml">
                    <div class="tab-pane fade show active" id="safari" role="tabpanel" aria-labelledby="safari-tab">
                        <form action="<?= base_url('search-availability'); ?>" class="row g-2 align-items-center" method="post">
                            <input type="hidden" name="safari_type_id" id="safari_type_id" value="1" />
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <div class="col-md-6 col-lg-3 mb-3">
                                <div class="select_area">
                                    <select name="division_id" id="division_id" class="form-control" required>
                                        <option value="">Select Park</option>
                                        <?php
                                        if (!empty($divisionData)) {
                                            foreach ($divisionData as $row) {
                                        ?>
                                                <option value="<?= $row['division_id']; ?>"><?= $row['division_name']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <div class="select_area">
                                    <select name="safari_service_header_id" id="safari_service_header_id" class="form-control" required>
                                        <option value="">Select Safari</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-2 mb-3">
                                <div class="calenadr_area">
                                    <input type="text" class="form-control" name="saf_booking_date" id="saf_booking_date" autocomplete="off" placeholder="Date" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-2 mb-3">
                                <div class="select_area">
                                    <select name="safari_cat_id" id="safari_cat_id" class="form-control" required>
                                        <?php
                                        if (!empty($safariCat)) {
                                            foreach ($safariCat as $row) {
                                        ?>
                                                <option value="<?= $row['safari_cat_id']; ?>"><?= $row['cat_name']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-2 mb-3">
                                <button type="submit" class="w-100 btn btn-green" name="safari">Search Availability</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-pane fade" id="eco-tourism" role="tabpanel" aria-labelledby="eco-tourism-tab">
                    <form action="<?= base_url('frontend/booking/search/'); ?>" method="get" class="row g-2 align-items-center">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="col-md-4 col-lg-4 col-xl-4 mb-3">
                            <div class="select_area">
                                <select name="landscape" id="landscape" class="form-control">
                                    <option value="">Select Location</option>
                                    <?php foreach ($terrains as $key => $value) { ?>
                                        <option value="<?= $value['terrain_id']; ?>"><?= $value['terrain_name']; ?></option>
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
                        <div class="col-6 col-md-4 col-lg-2 col-xl-2 mb-3">
                            <div class="calenadr_area">
                                <input type="text" class="form-control" id="checkIn" value="<?= date('d/m/Y', strtotime('+1 day')); ?>" placeholder="From Date">
                                <input type="hidden" class="form-control check-in-out" name="checkindt" id="checkindt" value="<?= date('dmY', strtotime('+1 day')); ?>" />
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-2 col-xl-2 mb-3">
                            <div class="calenadr_area">
                                <input type="text" class="form-control" id="checkOut" placeholder="To Date" value="<?= date('d/m/Y', strtotime('+2 days')); ?>">
                                <input type="hidden" class="form-control check-in-out" name="checkoutdt" id="checkoutdt" value="<?= date('dmY', strtotime('+2 days')); ?>" />
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2 col-xl-2 mb-3">
                            <div class="select_area">
                                <select name="nationality" id="nationality" class="form-control">
                                    <option value="" disabled>Select Nationality</option>
                                    <option value="indian" selected>Indian</option>
                                    <option value="foreigner">Foreigner</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-2 col-xl-2 mb-3">
                            <button type="submit" class="w-100 btn btn-green">Search Availability</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="white_bg_area"><img src="<?= base_url(); ?>public/frontend_assets/assets/img/banner-bottom-bg.png" class="w-100" alt=""></div>
</section>

<section class="pt-0 destination_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center headline">
                <h2>Destination</h2>
            </div>
            <div class="col-md-12">
                <div class="owl-carousel owl-theme destinationCarousel destination_list">
                    <div class="item">
                        <div class="destination_area">
                            <img src="<?= base_url(); ?>public/frontend_assets/assets/img/destination_image.png" alt="">
                            <div class="destination_txt">
                                <h4>Beharinath ETC</h4>
                                <a href="" class="btn btn-yellow">Book&nbsp;now</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="destination_area">
                            <img src="<?= base_url(); ?>public/frontend_assets/assets/img/destination_image1.png" alt="">
                            <div class="destination_txt">
                                <h4>Matha Tree House</h4>
                                <a href="" class="btn btn-yellow">Book&nbsp;now</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="destination_area">
                            <img src="<?= base_url(); ?>public/frontend_assets/assets/img/destination_image2.png" alt="">
                            <div class="destination_txt">
                                <h4>Duarsini</h4>
                                <a href="" class="btn btn-yellow">Book&nbsp;now</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="destination_area">
                            <img src="<?= base_url(); ?>public/frontend_assets/assets/img/destination_image3.png" alt="">
                            <div class="destination_txt">
                                <h4>Chandrakona <br>Road</h4>
                                <a href="" class="btn btn-yellow">Book&nbsp;now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<section class="book_safari_sec">
    <div class="container z-index2">
        <div class="row">
            <div class="col-md-12 headline text-center">
                <h2>Book Safari</h2>
            </div>
            <div class="col-md-9 mx-auto z-index2">
                <div class="book_safari_area">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-booksafari-tab" data-bs-toggle="tab" data-bs-target="#nav-booksafari" type="button" role="tab" aria-controls="nav-booksafari" aria-selected="true">Car Safari</button>
                            <button class="nav-link" id="nav-booksafari1-tab" data-bs-toggle="tab" data-bs-target="#nav-booksafari1" type="button" role="tab" aria-controls="nav-booksafari1" aria-selected="false">Elephant Safari</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-booksafari" role="tabpanel" aria-labelledby="nav-booksafari-tab">
                            <div class="row">
                                <div class="col-md-6 px-4">
                                    <div class="destination_area">
                                        <img src="<?= base_url(); ?>public/frontend_assets/assets/img/book_safari_img.png" alt="">
                                        <div class="destination_txt">
                                            <h4>Jaldapara National Park</h4>
                                            <a href="" class="btn btn-yellow"><i class="fas fa-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 px-4">
                                    <div class="destination_area">
                                        <img src="<?= base_url(); ?>public/frontend_assets/assets/img/book_safari_img1.png" alt="">
                                        <div class="destination_txt">
                                            <h4>Gorumara National Park</h4>
                                            <a href="" class="btn btn-yellow"><i class="fas fa-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-booksafari1" role="tabpanel" aria-labelledby="nav-booksafari1-tab">
                            <div class="row">
                                <div class="col-md-6 px-4">
                                    <div class="destination_area">
                                        <img src="<?= base_url(); ?>public/frontend_assets/assets/img/book_safari_img.png" alt="">
                                        <div class="destination_txt">
                                            <h4>Jaldapara National Park</h4>
                                            <a href="" class="btn btn-yellow"><i class="fas fa-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 px-4">
                                    <div class="destination_area">
                                        <img src="<?= base_url(); ?>public/frontend_assets/assets/img/book_safari_img1.png" alt="">
                                        <div class="destination_txt">
                                            <h4>Gorumara National Park</h4>
                                            <a href="" class="btn btn-yellow"><i class="fas fa-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="gallery_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 headline text-center">
                <h2>Our Trips Gallery</h2>
            </div>
            <div class="col-md-12">
                <ul class="gallery_list gallery">
                    <li>
                        <div class="gallery_area">
                            <a href="<?= base_url(); ?>public/frontend_assets/assets/img/galler_img.png" class="big ">
                                <div class="gallery-img">
                                    <img src="<?= base_url(); ?>public/frontend_assets/assets/img/galler_img.png" width="100%" alt="" title="Khudiram Bose Park" />
                                </div>
                            </a>
                            <div class="gallery_txt">
                                <h4>Khudiram Bose Park</h4>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="gallery_area">
                            <a href="<?= base_url(); ?>public/frontend_assets/assets/img/galler_img1.png" class="big ">
                                <div class="gallery-img">
                                    <img src="<?= base_url(); ?>public/frontend_assets/assets/img/galler_img1.png" width="100%" alt="" title="Beharinath ETC" />
                                </div>
                            </a>
                            <div class="gallery_txt">
                                <h4>Beharinath ETC</h4>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="gallery_area">
                            <a href="<?= base_url(); ?>public/frontend_assets/assets/img/galler_img2.png" class="big ">
                                <div class="gallery-img">
                                    <img src="<?= base_url(); ?>public/frontend_assets/assets/img/galler_img2.png" width="100%" alt="" title="Duarsini Eco-tourism Centre" />
                                </div>
                            </a>
                            <div class="gallery_txt">
                                <h4>Duarsini Eco-tourism Centre</h4>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="gallery_area">
                            <a href="<?= base_url(); ?>public/frontend_assets/assets/img/galler_img3.png" class="big ">
                                <div class="gallery-img">
                                    <img src="<?= base_url(); ?>public/frontend_assets/assets/img/galler_img3.png" width="100%" alt="" title="Parimal Kanan" />
                                </div>
                            </a>
                            <div class="gallery_txt">
                                <h4>Parimal Kanan</h4>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="gallery_area">
                            <a href="<?= base_url(); ?>public/frontend_assets/assets/img/galler_img4.png" class="big ">
                                <div class="gallery-img">
                                    <img src="<?= base_url(); ?>public/frontend_assets/assets/img/galler_img4.png" width="100%" alt="" title="Matha Tree House" />
                                </div>
                            </a>
                            <div class="gallery_txt">
                                <h4>Matha Tree House</h4>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="p-0 counter_sec">
    <ul class="counter_list">
        <li>
            <div class="counter">
                <div class="counter_ico"><img src="<?= base_url(); ?>public/frontend_assets/assets/img/counter_ico.png" alt=""></div>
                <h2 class="numbercount count-title">28874</h2>
                <p class="count-text ">TOTAL TOURISTS</p>
            </div>
        </li>
        <li>
            <div class="counter">
                <div class="counter_ico"><img src="<?= base_url(); ?>public/frontend_assets/assets/img/counter_ico1.png" alt=""></div>
                <h2 class="numbercount count-title">4</h2>
                <p class="count-text ">DESTINATIONS</p>
            </div>
        </li>
        <li>
            <div class="counter">
                <div class="counter_ico"><img src="<?= base_url(); ?>public/frontend_assets/assets/img/counter_ico2.png" alt=""></div>
                <h2 class="numbercount count-title">5</h2>
                <p class="count-text ">ECO TOURISM CENTRES</p>
            </div>
        </li>
    </ul>
</section>

<section class="map_sec">
    <div class="map_txt">
        <h3>Eco Tourism Center</h3>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117925.21689619735!2d88.2649499507587!3d22.535564937865654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f882db4908f667%3A0x43e330e68f6c2cbc!2sKolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1727481846773!5m2!1sen!2sin"
        width="" height="" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>

<script>
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
            }
        });
    });
    $(document).ready(function() {
        var today = new Date();
        var maxbookingdt = new Date();
        maxbookingdt.setMonth(today.getMonth() + 3);

        $("#saf_booking_date").datepicker({
            minDate: new Date,
            maxDate: maxbookingdt,
            dateFormat: "dd-mm-yy"
        });

        $(".serviceType").click(function() {
            var safari_type_id = $(this).data('typeid');
            console.log(safari_type_id);
            $("#tabContentHtml").show();
            $.ajax({
                    type: 'POST',
                    url: '<?= base_url("index/getTabHtml"); ?>',
                    data: {
                        safari_type_id: safari_type_id,
                        csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: 'json',
                    encode: true,
                    async: false
                })
                //ajax response
                .done(function(response) {
                    if (response.status) {
                        $("#tabContentHtml").html(response.html);

                        $("#division_id").change(function() {
                            getServices();
                        });

                        $("#saf_booking_date").datepicker({
                            minDate: new Date,
                            dateFormat: "dd-mm-yy"
                        });
                    } else {
                        $("#tabContentHtml").html(response.html);
                    }

                });
        });

        $("#eco-tourism-tab").click(function() {
            $("#tabContentHtml").hide();
        });

        $("#division_id").change(function() {
            getServices();
        });

    });

    function getServices() {
        var division_id = $('#division_id').val();
        var safari_type_id = $('#safari_type_id').val();
        console.log({
            safari_type_id: safari_type_id,
            division_id: division_id
        });
        var result = '';
        $.ajax({
                type: 'POST',
                url: '<?= base_url("index/getServices"); ?>',
                data: {
                    safari_type_id: safari_type_id,
                    division_id: division_id,
                    csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'
                },
                dataType: 'json',
                encode: true,
                //async: false
            })
            //ajax response
            .done(function(response) {
                if (response.status) {
                    result += '<option value="">Select Safari</option>';
                    $.each(response.list, function(key, value) {
                        result += '<option value="' + value.safari_service_header_id + '">' + value.service_definition + '</option>';
                    });
                } else {
                    result += '<option value="">No Data found</option>'
                }
                $("#safari_service_header_id").html(result);
            });
    }

    function safari_search() {
        var division_id = $('#division_id').val();
        var safari_type_id = $('#safari_type_id').val();
        var safari_service_header_id = $('#safari_service_header_id').val();
        var saf_booking_date = $('#saf_booking_date').val();
        var safari_cat_id = $('#safari_cat_id').val();

        $.ajax({
            url: "<?= base_url('frontend/safari_booking/searchAvailability'); ?>",
            type: "post",
            data: {
                division_id: division_id,
                safari_type_id: safari_type_id,
                safari_service_header_id: safari_service_header_id,
                saf_booking_date: saf_booking_date,
                safari_cat_id: safari_cat_id,
                csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>',
            },
            success: function(response) {
                propertyResult(response);
            }
        });
    }
</script>