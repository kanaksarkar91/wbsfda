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
        line-height: 1 !important;
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
            margin-right: 5px;
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
        for ($i = 1; $i <= 4; $i++) {
            $img_name = 'image' . $i;
            if ($property[$img_name] != '') {
        ?>
		<div>
			<a href="<?= base_url('public/admin_images/' . $property[$img_name]); ?>" class="mfp-gallery"><img src="<?= base_url('public/admin_images/' . $property[$img_name]); ?>" class="img-fluid mx-auto" alt="<?= $property['property_name'] != '' ? $property['property_name'] . ' Image ' . $i : ''; ?>" /></a>
		</div>
		<?php }
        } ?>
	</div>
</div> -->

<!-- ============================ Hero Banner End ================================== -->

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="destination_slider_area p-4 row g-0">
                    <div class="col-md-12">
                        <h3><?= $property['property_name']; ?></h3>
                        <p class="map_ico"><i class="fas fa-map-marker-alt"></i> <?= $property['address_line_1'] . ', ' . $property['address_line_2'] . ', ' . $property['city']; ?></p>
                        <p class="text-green"><small>* Below rates are exclusive of GST</small></p>
                    </div>
                    <div class="clearfix w-100"></div>
                    <div class="destination_slider_img col-md-12 col-lg-6 col-xl-4">
                        <ul class="destination-carousel owl-carousel slider_list">
                            <li>
                                <img src="<?= ($property['image1'] != '') ? base_url('public/admin_images/' . $property['image1']) : base_url('public/admin_images/property_images/no-image.jpg'); ?>" class="d-block w-100" alt="...">
                            </li>
                            <li>
                                <img src="<?= ($property['image2'] != '') ? base_url('public/admin_images/' . $property['image2']) : base_url('public/admin_images/property_images/no-image.jpg'); ?>" class="d-block w-100" alt="...">
                            </li>
                            <li>
                                <img src="<?= ($property['image3'] != '') ? base_url('public/admin_images/' . $property['image3']) : base_url('public/admin_images/property_images/no-image.jpg'); ?>" class="d-block w-100" alt="...">
                            </li>
                            <li>
                                <img src="<?= ($property['image4'] != '') ? base_url('public/admin_images/' . $property['image4']) : base_url('public/admin_images/property_images/no-image.jpg'); ?>" class="d-block w-100" alt="...">
                            </li>
                        </ul>
                    </div>
                    <div class="destination_slider_txt col-md-12 col-lg-6 col-xl-8">
                        <h4>Description:</h4>
                        <p class="destination_p"><?= $property['property_desc']; ?>
                        </p>
                        <hr>
                        <p>Centre in charge Mobile No: <b class="text-green"><?= $property['phone_no']; ?></b></p>
                        <p>Division Office Ph. No: <b class="text-green"><?= $property['phone_no']; ?></b></p>
                        <div class="ameneties_area mt-5">
                            <h4>Ameneties:</h4>
                            <hr>
                            <ul class="ameneties_list">
                                <?php
                                if (isset($facilities))
                                    foreach ($facilities as $f) {
                                ?>
                                    <li>
                                        <a href="">
                                            <div class="ameneties_list_ico"><img src="<?= base_url(); ?>public/frontend_assets/assets/img/children-park-ico.png" alt=""></div>
                                            <?= $f['facility_name']; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <!-- <li>
                                    <a href="">
                                        <div class="ameneties_list_ico"><img src="<?= base_url(); ?>public/frontend_assets/assets/img/conference-hall-ico.png" alt=""></div>
                                        Conference Hall
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <div class="ameneties_list_ico"><img src="<?= base_url(); ?>public/frontend_assets/assets/img/dining-facilities-ico.png" alt=""></div>
                                        Dining Facilities
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <div class="ameneties_list_ico"><img src="<?= base_url(); ?>public/frontend_assets/assets/img/free-parking-ico.png" alt=""></div>
                                        Free Parking
                                    </a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="col-md-12">
                        <div class="map_area mt-5">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29331.052309848426!2d87.04244631508028!3d23.229199144672805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f7a58c5fc2b411%3A0xfdbd0b45c0b4aa70!2sBankura%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1727674582452!5m2!1sen!2sin"
                                width="" height="" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div> -->

                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="destination_slider_area d-block">
                    <form id="room_search_form" action="" method="post">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" name="property_id" id="property_id" value="<?= isset($property_id) && $property_id != '' ? $property_id : ''; ?>">
                        <input type="hidden" name="rate_category" id="rate_category" value="<?= isset($rate_category_id) && $rate_category_id != '' ? $rate_category_id : ''; ?>">
                        <div class=" col-md-12 p-4 pb-1">
                            <div class="row align-items-end">
                                <div class="col-md-3 px-2 mb-3">
                                    <label for="" class="text-green">Check-In</label>
                                    <div class="calenadr_area">
                                        <input type="hidden" name="dates" id="dates" class="form-control" <?= isset($check_in_date) && $check_in_date != '' && isset($check_out_date) && $check_out_date != '' ? 'value="' . set_value("dates", ($check_in_date . ' - ' . $check_out_date)) . '"' : ''; ?> />

                                        <input type="text" readonly="" name="checkIn" id="checkIn" class="form-control check-in-out" <?= isset($check_in_date) && $check_in_date != '' ? 'value="' . set_value("checkIn", $check_in_date) . '"' : ''; ?> />
                                    </div>
                                </div>
                                <div class="col-md-3 px-2 mb-3">
                                    <label for="" class="text-green">Check-Out</label>
                                    <div class="calenadr_area">
                                        <input type="text" readonly="" name="checkOut" id="checkOut" class="form-control check-in-out" <?= isset($check_out_date) && $check_out_date != '' ? 'value="' . set_value("checkOut", $check_out_date) . '"' : ''; ?> />
                                    </div>
                                </div>
                                <div class="col-md-3 px-2 mb-3">
                                    <label for="" class="text-green">Nationality</label>
                                    <div class="select_area">
                                        <select name="nationality" id="nationality" class="form-control">
                                            <option value="" disabled>Select Nationality</option>
                                            <option value="indian" <?= isset($nationality) && $nationality == 'indian' ? 'selected' : ''; ?>>Indian</option>
                                            <option value="foreigner" <?= isset($nationality) && $nationality == 'foreigner' ? 'selected' : ''; ?>>Foreigner</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-auto mb-3">
                                    <button type="submit" class="ms-2 btn btn-green">Search Availability</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <?php
                            if (isset($accommodations) && count($accommodations) > 0) {
                            ?>
                                <table class="table table-roomtype table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="55%">Room Type</th>
                                            <th width="22%">Price for <?= isset($no_of_nights) && $no_of_nights != '' ? $no_of_nights . ($no_of_nights <= 1 ? ' night' : ' nights') : ''; ?> night</th>
                                            <th width="23%">Select Required Room(s)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = $j = 1;
                                        foreach ($accommodations as $accommodation) {
                                        ?>
                                            <tr <?php if ($accommodation['is_offline'] == 2) { ?> style="display:none;" <?php } ?>>
                                                <td>
                                                    <h4><a data-bs-toggle="modal" data-bs-target="#accomodation_detailModal<?= $j; ?>"><?= $accommodation['accommodation_name']; ?></a></h4>
                                                    <h5><img src="<?= base_url(); ?>public/frontend_assets/assets/img/table_user_ico.png" alt="" class="me-2">
                                                        <?php
                                                        if ($accommodation['is_dormitory'] == 'No') {
                                                            if (isset($accommodation['adult']) || isset($accommodation['child'])) {
                                                        ?>
                                                                <?php if (isset($property['property_type_id']) && in_array($property['property_type_id'], array(7, 8, 9, 14))) { ?>
                                                                    <span style="display:none;">Capacity: <?= isset($accommodation['adult']) && $accommodation['adult'] != '' ? $accommodation['adult'] : 'N/A'; ?>
                                                                    <?php } else { ?></span>
                                                                    Capacity: <?= isset($accommodation['adult']) && $accommodation['adult'] != '' ? $accommodation['adult'] . ' Adult(s)' : ''; ?><?= isset($accommodation['child']) && $accommodation['child'] != '' ? ', ' . $accommodation['child'] . ($accommodation['child'] <= 1 ? ' Child' : ' Children') : ''; ?>
                                                                <?php } ?>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </h5>
                                                    <?php if (isset($accommodation['facilities']) && $accommodation['facilities'] != '') { ?>
                                                        <p class="mb-1"><i class="fas fa-hotel thm-txt ms-1 me-3"></i> <?= ucwords(str_replace(',', ', ', $accommodation['facilities'])); ?></p>
                                                    <?php } ?>

                                                    <!-- <?php
                                                            if ($accommodation['is_dormitory'] == 'No') {
                                                                if ($accommodation['extra_bed_price'] > 1) {
                                                            ?>
                                                            <p class="mb-1 small text-dark lh-sm">Only 1 (one) extra person is allowed in addition to the mentioned capacity of this type of room at the rate of Rs. 100.00 + applicable GST for each day.</p>
                                                    <?php
                                                                }
                                                            }
                                                    ?> -->
                                                </td>
                                                <td data-label="Price">
                                                    <h5>₹ <?= isset($accommodation['base_price']) && $accommodation['base_price'] != '' ? $accommodation['base_price'] : ''; ?>
                                                        <?php
                                                        if ($accommodation['is_dormitory'] == 'Yes') {
                                                            echo '/ Per Bed';
                                                        } else {
                                                            echo '/ Per Room';
                                                        }
                                                        ?>
                                                    </h5>
                                                    <br />

                                                    <!-- <?php
                                                            if ($accommodation['is_dormitory'] == 'No') {
                                                                if ($accommodation['extra_bed_price'] > 1) {
                                                            ?>

                                                            <select name="choose_extra_pax" id="choose_extra_pax<?= $accommodation['accommodation_id']; ?>" class="form-select form-select-sm choose_extra_pax" data-extra-pax="<?= $j; ?>">
                                                                <option value="">Select extra pax here (if required)</option>
                                                                <?php
                                                                    if (isset($accommodation['no_of_accomm']))
                                                                        for ($e = 1; $e <= $accommodation['no_of_accomm']; $e++) { ?>
                                                                    <option value="<?= $e; ?>"><?= $e; ?></option>
                                                                <?php } ?>
                                                            </select>

                                                            <?php /*?><input type="number" name="choose_extra_pax" id="choose_extra_pax<?= $accommodation['accommodation_id'];?>" class="form-control choose_extra_pax<?= $j;?>" data-extra-pax="<?= $j;?>" onkeyup="return extra_bed_keypress(<?= $j;?>);" onkeydown="return extra_bed_keypress(<?= $j;?>);" max="<?= $accommodation['no_of_accomm'];?>" placeholder="Enter extra Pax here (if required)" /><?php */ ?>


                                                    <?php
                                                                }
                                                            }
                                                    ?> -->
                                                </td>
                                                <td data-label="Select Rooms">
                                                    <div class="select_area">
                                                        <select name="no_of_rooms" id="no_of_rooms<?= $j; ?>" class="form-control" data-roomid="<?= $accommodation['accommodation_id']; ?>">
                                                            <?php
                                                            if (isset($accommodation['no_of_accomm']))
                                                                for ($i = 0; $i <= $accommodation['no_of_accomm']; $i++) { ?>
                                                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            $j++;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>
                                                <h3>Total Amount <span>(Inclusive of GST)</span></h3>
                                            </th>
                                            <th>
                                                <h3 class="stbooking-title">₹ 0.00</h3>
                                            </th>
                                            <th><button class="w-100 btn btn-green" id="booknow">Book Now</button></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            <?php } else { ?>
                                <table class="table table-roomtype table-bordered">
                                    <tfoot>
                                        <tr>
                                            <th>
                                                <h3>No rooms found for your search criteria.</span></h3>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            <?php } ?>
                        </div>
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
    <div class="modal" id="accomodation_detailModal<?= $j; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Room Name </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div id="sync1" class="owl-carousel owl-theme">
                        <?php if (isset($accommodation['accomm_image1']) && $accommodation['accomm_image1'] != '') { ?>
                            <div class="item">
                                <img src="<?= isset($accommodation['accomm_image1']) && $accommodation['accomm_image1'] != '' ? base_url('public/admin_images/' . $accommodation['accomm_image1']) : base_url('public/admin_images/property_images/no-image.jpg'); ?>">
                            </div>
                        <?php } ?>
                        <?php if (isset($accommodation['accomm_image2']) && $accommodation['accomm_image2'] != '') { ?>
                            <div class="item">
                                <img src="<?= isset($accommodation['accomm_image2']) && $accommodation['accomm_image2'] != '' ? base_url('public/admin_images/' . $accommodation['accomm_image2']) : base_url('public/admin_images/property_images/no-image.jpg'); ?>">
                            </div>
                        <?php } ?>
                        <?php if (isset($accommodation['accomm_image3']) && $accommodation['accomm_image3'] != '') { ?>
                            <div class="item">
                                <img src="<?= isset($accommodation['accomm_image3']) && $accommodation['accomm_image3'] != '' ? base_url('public/admin_images/' . $accommodation['accomm_image3']) : base_url('public/admin_images/property_images/no-image.jpg'); ?>">
                            </div>
                        <?php } ?>
                        <?php if (isset($accommodation['accomm_image4']) && $accommodation['accomm_image4'] != '') { ?>
                            <div class="item">
                                <img src="<?= isset($accommodation['accomm_image4']) && $accommodation['accomm_image4'] != '' ? base_url('public/admin_images/' . $accommodation['accomm_image4']) : base_url('public/admin_images/property_images/no-image.jpg'); ?>">
                            </div>
                        <?php } ?>
                    </div>

                    <div id="sync2" class="owl-carousel owl-theme">
                        <?php if (isset($accommodation['accomm_image1']) && $accommodation['accomm_image1'] != '') { ?>
                            <div class="item">
                                <img src="<?= isset($accommodation['accomm_image1']) && $accommodation['accomm_image1'] != '' ? base_url('public/admin_images/' . $accommodation['accomm_image1']) : base_url('public/admin_images/property_images/no-image.jpg'); ?>">
                            </div>
                        <?php } ?>
                        <?php if (isset($accommodation['accomm_image2']) && $accommodation['accomm_image2'] != '') { ?>
                            <div class="item">
                                <img src="<?= isset($accommodation['accomm_image2']) && $accommodation['accomm_image2'] != '' ? base_url('public/admin_images/' . $accommodation['accomm_image2']) : base_url('public/admin_images/property_images/no-image.jpg'); ?>">
                            </div>
                        <?php } ?>
                        <?php if (isset($accommodation['accomm_image3']) && $accommodation['accomm_image3'] != '') { ?>
                            <div class="item">
                                <img src="<?= isset($accommodation['accomm_image3']) && $accommodation['accomm_image3'] != '' ? base_url('public/admin_images/' . $accommodation['accomm_image3']) : base_url('public/admin_images/property_images/no-image.jpg'); ?>">
                            </div>
                        <?php } ?>
                        <?php if (isset($accommodation['accomm_image4']) && $accommodation['accomm_image4'] != '') { ?>
                            <div class="item">
                                <img src="<?= isset($accommodation['accomm_image4']) && $accommodation['accomm_image4'] != '' ? base_url('public/admin_images/' . $accommodation['accomm_image4']) : base_url('public/admin_images/property_images/no-image.jpg'); ?>">
                            </div>
                        <?php } ?>

                    </div>
                    <div class="col-md-12">
                        <h3><?= $accommodation['accommodation_name']; ?></h3>
                        <h4><b>Room capacity:</b> <?php
                                                    if ($accommodation['is_dormitory'] == 'No') {
                                                        if (isset($accommodation['adult']) || isset($accommodation['child'])) {
                                                    ?>
                                    <?php if (isset($property['property_type_id']) && in_array($property['property_type_id'], array(7, 8, 9, 14))) { ?>
                                        <span style="display:none;">Capacity: <?= isset($accommodation['adult']) && $accommodation['adult'] != '' ? $accommodation['adult'] : 'N/A'; ?>
                                        <?php } else { ?></span>
                                        Capacity: <?= isset($accommodation['adult']) && $accommodation['adult'] != '' ? $accommodation['adult'] . ' Adult(s)' : ''; ?><?= isset($accommodation['child']) && $accommodation['child'] != '' ? ', ' . $accommodation['child'] . ($accommodation['child'] <= 1 ? ' Child' : ' Children') : ''; ?>
                                    <?php } ?>
                            <?php
                                                        }
                                                    }
                            ?> <span class="ms-3"><b>Room Price:</b> ₹ <?= isset($accommodation['base_price']) && $accommodation['base_price'] != '' ? $accommodation['base_price'] : ''; ?>
                                <?php
                                if ($accommodation['is_dormitory'] == 'Yes') {
                                    echo ' / Per Bed';
                                } else {
                                    echo ' / Per Room';
                                }
                                ?> / per night</span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

        var roomId = $('#no_of_rooms' + sl).data('roomid');
        var roomCount = $('#no_of_rooms' + sl).val();
        var is_select_extra_bed = $(".choose_extra_pax" + sl).val();

        console.log(roomCount);

        if (roomId != '' && roomCount != '' && roomCount > 0) {

            if (Number(is_select_extra_bed) > Number(roomCount)) {
                $.alert({
                    title: 'Alert!',
                    content: 'Extra pax is greater than selected room!',
                    type: 'red',
                    typeAnimated: true,
                })
                return false;
            } else {
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
            var is_select_extra_bed = $("#choose_extra_pax" + roomId).val();

            //console.log(stay_date);

            if (Number(is_select_extra_bed) > Number(roomCount)) {
                $.alert({
                    title: 'Alert!',
                    content: 'Extra pax is greater than selected room!',
                    type: 'red',
                    typeAnimated: true,
                })
                return false;
            } else {
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


        $('select[name="choose_extra_pax"]').on('change', function() {
            var rowC = $(this).data('extra-pax');
            var property = $("#property_id").val();
            var rate_category = $("#rate_category").val();
            var stay_date = $("#dates").val();
            var adults = $("#adults").val();
            var children = $("#children").val();

            var roomId = $('#no_of_rooms' + rowC).data('roomid');
            var roomCount = $('#no_of_rooms' + rowC).val();
            var is_select_extra_bed = $(this).val();

            console.log(is_select_extra_bed);

            if (roomId != '' && roomCount != '' && roomCount > 0) {

                if (Number(is_select_extra_bed) > Number(roomCount)) {
                    $.alert({
                        title: 'Alert!',
                        content: 'Extra pax is greater than selected room!',
                        type: 'red',
                        typeAnimated: true,
                    })
                    return false;
                } else {
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