<div class="breadcrumb-area section-bg-2 breadcrumb-padding">
    <div class="container custom-container-one">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-contents">
                    <h4 class="breadcrumb-contents-title"> Check Availability & Rate </h4>
                    <ul class="breadcrumb-contents-list list-style-none">
                        <li class="breadcrumb-contents-list-item"> <a href="<?= base_url()?>" class="breadcrumb-contents-list-item-link"> Home </a> </li>
                        <li class="breadcrumb-contents-list-item"> <a href="#." class="breadcrumb-contents-list-item-link prevUrl">Hall &amp; Venue Booking </a> </li>
                        <li class="breadcrumb-contents-list-item"> Check Availability & Rate </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

            <section class="py-0">
                <div class="container">
                    <div class="banner-location bg-white radius-5">
                        <form action="<?= base_url('check-venue-available-rate/' . $venues[0]['rate_id'])?>" class="banner-location-flex" id="venue-form">
                        <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
   
                        <!-- <div class="banner-location-single">
                        <div class="banner-location-single-flex">
                            <div class="banner-location-single-contents">
                                <span class="banner-location-single-contents-subtitle"><i class="las la-home"></i> Type </span>
                                <select class="form-select" name="state">
                                        <option value="2">Conference / Banquet Hall</option>
                                        <option value="3">Lawn / Picnic Spot</option>
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="banner-location-single">
                        <div class="banner-location-single-flex">
                            <div class="banner-location-single-contents">
                                <span class="banner-location-single-contents-subtitle"><i class="las la-map-marker-alt"></i> Location </span>
                                <select class="form-select" name="state">
                                        <option value="1">Nalban Food Park</option>
                                        <option value="2">Oceana Guest House Complex</option>
                                        <option value="3">Amarabati Park</option>
                                    </select>
                            </div>
                        </div>
                    </div> -->
                            <div class="banner-location-single">
                                <div class="banner-location-single-flex">
                                    <div class="banner-location-single-contents">
                                        <span class="banner-location-single-contents-subtitle"><i class="las la-calendar"></i> Check Availability & Rate </span>
                                        <!--<input class="form-control check-in-out" type="text" name="date_range"  id="dates" value="<?=$check_in_date?> - <?= $check_out_date?>" />-->
                                        <input type="text" class="form-control check-in-out" name="date_range" id="dates" value="<?= isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '' ? ($from_date . ' - ' . $to_date) : ''; ?>" />
                                        <input type="hidden" name="start_date" id="checkindt_venue" value="<?= isset($from_date) && $from_date != ''? $from_date : ''?>" />
                                        <input type="hidden" name="end_date" id="checkoutdt_venue" value="<?=isset($to_date) && $to_date != ''? $to_date : ''?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="banner-location-single-search">
                            <button type="button" class="cmn-btn btn-bg-1 w-100" id="submit-button">
                                Submit <i class="las la-chevron-circle-right"></i> 
                            </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <section class="hotel-details-area pat-30 pab-30">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-xl-8 col-lg-7">
                            <div class="details-left-wrapper">
                                <div class="details-contents bg-white radius-10">
                                    <div class="details-contents-header">
                                        <h4 class="mb-3"> <?=$venues[0]['venue_names'] ?> </h4>
                                        <table class="table table-borderless table-responsive table-hover">
                                            <tbody>
                                                <tr>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center"><?=($venues[0]['is_hourly_booking_rate']==1 )?$venues[0]['booking_hours_rate'].' Hours in a Day':' Price Per Calender Day'?></th>

                                                    <?php if($venues[0]['is_multiple_venues'] == '0' && $venues[0]['single_venue_id'] == '11'){ ?>

                                                        <th class="text-center">Additional Hours in a Day</th>

                                                    <?php } ?>
                                                </tr>
                                                <?php
                                                $from_date = str_replace('/', '-', $from_date); // Convert dd/mm/YYYY to dd-mm-YYYY
                                                $to_date = str_replace('/', '-', $to_date);     // Convert dd/mm/YYYY to dd-mm-YYYY
                                                
                                                $currentDate = strtotime($from_date);
                                                $endDate = strtotime($to_date);
                                                
                                                while ($currentDate <= $endDate) {
                                                    $formattedDate = date('d-m-Y D', $currentDate);
                                                    // Determine availability based on blocked_venue data
                                                    $isAvailable = true; // Default to available
                                                    $dayDifference = 0; // Default to 0 days
                                                    if (!empty($blockedVenueData)) {
                                                    foreach ($blockedVenueData as $blockedVenue) {
                                                        if ($currentDate >= strtotime($blockedVenue->from_date) && $currentDate <= strtotime($blockedVenue->to_date)) {
                                                            // The current date is within a blocked period
                                                            $isAvailable = false; // Not available
                                                            $dayDifference = 1; // Default to 0 days
                                                            break; // No need to continue checking
                                                        }
                                                    }
                                                }
                                              
                                                
                                                if ($dayDifference === 0) {
                                                    $currentDateObj = new DateTime();
                                                    $dateObj = new DateTime(date('Y-m-d',$currentDate));
                                                    // Calculate the difference between the two dates
                                                    $interval = $currentDateObj->diff( $dateObj);

                                                    // Get the number of days
                                                    $dayDifference = $interval->days;

                                                    $isAvailable = !in_array( $dayDifference, array_column($dayDiff, 'day_difference'));
                                                }
                                                ?>
                                                    <tr>
                                                    <td class="text-center"><?= $formattedDate;?></td>
                                                    <td class="text-center"><span class="<?= $isAvailable  ? 'bg-success' : 'bg-secondary'; ?> p-1 rounded text-white"><?= $isAvailable ? 'Available' : 'Not-Available'; ?></span></td>
                                                    <td class="text-center">
                                                        <?php $priceDay = strtolower(date('D', $currentDate)); ?>
                                                        Rs. <?= number_format($venues[0][$priceDay . '_price'], 2, ".", ",") ;?>
                                                    </td>

                                                    <?php if($venues[0]['is_multiple_venues'] == '0' && $venues[0]['single_venue_id'] == '11'){ ?>

                                                        <td class="text-center">Rs. 1000 (per additional hour)</td>

                                                    <?php } ?>
                                                </tr>
                                        <?php $currentDate = strtotime('+1 day', $currentDate);
                                     } ?>   
                                            </tbody>
                                        </table>
                                        <div class="col-sm-12 text-center m_top20">
                                            <?php if($this->session->userdata('logged_in') && $this->session->userdata('user_type') == 'frontend'):?>
                                                <?php 
                                                $start_date = ($this->input->get('start_date'))? str_replace('/', '-', $this->input->get('start_date')): $from_date;
                                                $end_date = ($this->input->get('end_date'))? str_replace('/', '-', $this->input->get('end_date')): $to_date;
                                                if($start_date && $end_date):?>
                                                <div class="btn-wrapper text-center">
                                                    <a class="cmn-btn btn-bg-1 btn-small mb-3" href="<?= base_url()?>reserve-venue/<?= $venues[0]['rate_id']?>?start_date=<?= $start_date?>&&end_date=<?= $end_date?>">Proceed to Reserve</a>
                                                </div>
                                                    <?php else:?>
                                                <div class="btn-wrapper text-center">      
                                                    <a class="cmn-btn btn-bg-1 btn-small mb-3" href="<?= base_url()?>reserve-venue/<?= $venues[0]['rate_id']?>">Proceed to Reserve</a>
                                                </div>
                                                    <?php endif?>
                                            <?php else:?>
                                                <div class="btn-wrapper text-center">
                                                    <a class="cmn-btn btn-bg-1 btn-small mb-3" href="#" data-toggle="modal" id="booking_login" data-target="#login" data-redirect="1">Login/Sign Up to Reserve</a>
                                                </div>
                                                <?php endif?>
                                            
                                            <!-- Modal -->
                                            
                                        </div>
                                        <!--<div class="btn-wrapper text-center">
                                            <a href="venue-reservation.html" class="cmn-btn btn-bg-1 btn-small mb-3"> Proceed To Reserve </a>
                                        </div>-->
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php if(isset($venues)){?>

                        <div class="col-xl-4 col-lg-5">
                            <div class="details-contents bg-white radius-10 mb-3">
                                <img src="<?=base_url('/public/admin_images/').$venues[0]['venue_image'][0]['image_path']?>" alt="img" class="img-fluid d-block mx-auto">
                                <div class="hotel-view-contents">
                                    <div class="hotel-view-contents-header">
                                        <div class="hotel-view-contents-location mt-2">
                                            <span class="hotel-view-contents-location-icon"> <i class="las la-map-marker-alt"></i> </span>
                                            <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Location:</span> <?=$venues[0]['property_name'];?> </span>
                                        </div>
                                        <div class="hotel-view-contents-location mt-2">
                                            <span class="hotel-view-contents-location-icon"> <i class="las la-map-marked-alt"></i> </span>
                                            <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Address:</span> <?=$venues[0]['property_address_line_1']; ?> </span>
                                        </div>
                                        <div class="hotel-view-contents-location mt-2">
                                            <span class="hotel-view-contents-location-icon"> <i class="las la-phone"></i> </span>
                                            <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Contact No.:</span> <?=$venues[0]['property_phone_no']; ?> </span>
                                        </div>
                                        <div class="hotel-view-contents-location mt-2">
                                            <span class="hotel-view-contents-location-icon"> <i class="las la-envelope"></i> </span>
                                            <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">e-mail ID:</span> <?=$venues[0]['property_email']; ?> </span>
                                        </div>
                                        <?php if($venues[0]['approx_capacity']) {?>
                                            <div class="hotel-view-contents-location mt-2">
                                                <span class="hotel-view-contents-location-icon"> <i class="las la-users"></i> </span>
                                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Approx Maximum Capacity:</span> <?=$venues[0]['approx_capacity']; ?></span>
                                            </div>
                                            <?php }?>
                                            <?php if($venues[0]['available_timming']) {?>
                                            <div class="hotel-view-contents-location mt-2">
                                                <span class="hotel-view-contents-location-icon"><i class="las la-user-clock"></i> </span>
                                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Available Timming:</span> <?=$venues[0]['available_timming']; ?></span>
                                            </div>
                                            <?php }?>
                                    </div>
                                </div>
                            </div>


                            <div class="details-contents bg-white radius-10 p-3">
                                <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDK4rMTf9bUlqpg1g8SF2zUnV4HQmatsVo&q=<?= $venues[0]['property_google_map_address']; ?>"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </section>
    
<script>
$(document).ready(function() {    

    $('#submit-button').click(function(e) {

        e.preventDefault();

        var form = $('#venue-form');
        var dateRange = $('#dates').val();
        var dateParts = dateRange.split(' - ');
        var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";

        if (dateParts.length === 2) {
            var from_date = moment(dateParts[0], 'DD/MM/YYYY').format('DDMMYYYY');
            var to_date = moment(dateParts[1], 'DD/MM/YYYY').format('DDMMYYYY');

            $.ajax({
                url: "<?= base_url('frontend/Venue_booking/rate_searchprocess'); ?>",
                type: "post",
                data: {
                    property_id: <?= $venues[0]['property_id']; ?>,
                    single_venue_id: <?= $venues[0]['single_venue_id']; ?>,
                    multiple_venue_ids: <?php if( $venues[0]['multiple_venue_ids'] != ''){ echo $venues[0]['multiple_venue_ids']; } else { echo '0'; } ?>,
                    is_multiple: <?= $venues[0]['is_multiple_venues']; ?>,
                    date_range: dateRange,
                    "<?= $this->security->get_csrf_token_name(); ?>": csrf_token
                },
                success: function(response) {
                    //propertyResult(response);
                    var res = $.parseJSON(response);

                    $.each(res.result, function(key, value) { 
                        //alert(value.rate_id);

                        form.attr('action', '<?= base_url('check-venue-available-rate/') ?>'+value.rate_id + '/' + from_date + '/' + to_date);

                        form.submit();
                    });

                }
            });

            //form.attr('action', '<?php //echo base_url('check-venue-available-rate/' . $venues[0]['rate_id']) ?>' + '/' + from_date + '/' + to_date);
        }

        // Submit the form
        //form.submit();
    });

    
    $('#dates').on('apply.daterangepicker', function(ev, picker) {
			//$("#checkindt").val(picker.startDate.format('DDMMYYYY'));
			//$("#checkoutdt").val(picker.endDate.format('DDMMYYYY'));
            var form = $('.banner-location-flex');
            $("#dates").val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));

            var from_date = picker.startDate.format('DDMMYYYY');
             var to_date = picker.endDate.format('DDMMYYYY');
             var chk_from_date = picker.startDate.format('DD/MM/YYYY');
        var chk_to_date = picker.endDate.format('DD/MM/YYYY');
        // Update the form's action attribute
        form.attr('action', '<?= base_url('check-venue-available-rate/' . $venues[0]['rate_id']) ?>' + '/' + from_date + '/' + to_date);
        $('#checkindt_venue').val(chk_from_date);
        $('#checkoutdt_venue').val(chk_to_date);


		});
});


</script>            
   