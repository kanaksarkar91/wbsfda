
<section class="py-0">
                <div class="container">
                    <div class="banner-location bg-white radius-5">
                        <form action="<?= base_url('check-venue-available-rate/' . $venues[0]->rate_id)?>" class="banner-location-flex">
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
                                        <span class="banner-location-single-contents-subtitle"><i class="las la-calendar"></i> CHECK AVAILABILITY & RATE </span>
                                        <!--<input class="form-control check-in-out" type="text" name="date_range"  id="dates" value="<?=$check_in_date?> - <?= $check_out_date?>" />-->
                                        <input type="text" class="form-control check-in-out" name="date_range" id="dates" value="<?= isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '' ? ($from_date . ' - ' . $to_date) : ''; ?>" />
                                        <input type="hidden" name="start_date" id="checkindt_venue" value="<?= isset($from_date) && $from_date != ''? $from_date : ''?>" />
                                        <input type="hidden" name="end_date" id="checkoutdt_venue" value="<?=isset($to_date) && $to_date != ''? $to_date : ''?>" />
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

            <section class="hotel-details-area pat-30 pab-30">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-xl-8 col-lg-7">
                            <div class="details-left-wrapper">
                                <div class="details-contents bg-white radius-10">
                                    <div class="details-contents-header">
                                        <h4 class="mb-3"> <?=$venues[0]->venue_names ?> </h4>
                                        <table class="table table-borderless table-responsive table-hover">
                                            <tbody>
                                                <tr>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center"><?=($venues[0]->is_hourly_booking_rate==1 )?$venues[0]->booking_hours_rate.' Hours in a Day':' Price Per Calender Day'?></th>
                                                </tr>
                                                <?php
                                                $from_date = str_replace('/', '-', $from_date); // Convert dd/mm/YYYY to dd-mm-YYYY
                                                $to_date = str_replace('/', '-', $to_date);     // Convert dd/mm/YYYY to dd-mm-YYYY
                                                
                                                $currentDate = strtotime($from_date);
                                                $endDate = strtotime($to_date);
                                             
                                                while ($currentDate <= $endDate) {
                                                    $formattedDate = date('d-m-Y D', $currentDate);
                                                    $currentDateObj = new DateTime();
                                                    $dateObj = new DateTime(date('Y-m-d',$currentDate));
                                                    // Calculate the difference between the two dates
                                                    $interval = $currentDateObj->diff( $dateObj);

                                                    // Get the number of days
                                                    $dayDifference = $interval->days;
													                                                
                                                    $isAvailable = !in_array( $dayDifference, array_column($dayDiff, 'day_difference'));?>
                                                    <tr>
                                                    <td class="text-center"><?= $formattedDate;?></td>
                                                    <td class="text-center"><span class="<?= $isAvailable  ? 'bg-success' : 'bg-secondary'; ?> p-1 rounded text-white"><?= $isAvailable ? 'Available' : 'Not-Available'; ?></span></td>
                                                    <td class="text-center">Rs. <?= number_format($venues[0]->{strtolower(date('D', $currentDate)) . '_price'}, 2, ".", ",") ;?></td>
                                                </tr>
                                        <?php $currentDate = strtotime('+1 day', $currentDate);
                                     }    ?>   
                                            </tbody>
                                        </table>
                                        <div class="col-sm-12 text-center m_top20">
                                            <?php if($this->session->userdata('logged_in') && $this->session->userdata('user_type') == 'frontend'):?>
                                                <?php 
                                                $start_date = ($this->input->get('start_date'))? $this->input->get('start_date'): $from_date;
                                                $end_date = ($this->input->get('end_date'))? $this->input->get('end_date'): $to_date;
                                                if($start_date && $end_date):?>
                                                <div class="btn-wrapper text-center">
                                                    <a class="cmn-btn btn-bg-1 btn-small mb-3" href="<?= base_url()?>reserve-venue/<?= $venues[0]->rate_id?>?start_date=<?= $start_date?>&&end_date=<?= $end_date?>">Proceed to Reserve</a>
                                                </div>
                                                    <?php else:?>
                                                <div class="btn-wrapper text-center">      
                                                    <a class="cmn-btn btn-bg-1 btn-small mb-3" href="<?= base_url()?>reserve-venue/<?= $venues[0]->rate_id?>">Proceed to Reserve</a>
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
                                <img src="<?=base_url('/public/admin_images/').$venues[0]->image1?>" alt="img" class="img-fluid d-block mx-auto">
                                <div class="hotel-view-contents">
                                    <div class="hotel-view-contents-header">
                                        <div class="hotel-view-contents-location mt-2">
                                            <span class="hotel-view-contents-location-icon"> <i class="las la-map-marker-alt"></i> </span>
                                            <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Location:</span> <?=$venues[0]->property_name?> </span>
                                        </div>
                                        <div class="hotel-view-contents-location mt-2">
                                            <span class="hotel-view-contents-location-icon"> <i class="las la-map-marked-alt"></i> </span>
                                            <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Address:</span> <?=$venues[0]->property_address_line_1?> </span>
                                        </div>
                                        <div class="hotel-view-contents-location mt-2">
                                            <span class="hotel-view-contents-location-icon"> <i class="las la-phone"></i> </span>
                                            <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Contact No.:</span> <?=$venues[0]->property_phone_no?> </span>
                                        </div>
                                        <div class="hotel-view-contents-location mt-2">
                                            <span class="hotel-view-contents-location-icon"> <i class="las la-envelope"></i> </span>
                                            <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">e-mail ID:</span> <?=$venues[0]->property_email?> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="details-contents bg-white radius-10 p-3">
                                <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDK4rMTf9bUlqpg1g8SF2zUnV4HQmatsVo&q=<?= $venues[0]->property_google_map_address ?>"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </section>
    
<script>
$(document).ready(function() {    


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
        form.attr('action', '<?= base_url('check-venue-available-rate/' . $venues[0]->rate_id) ?>' + '/' + from_date + '/' + to_date);
        $('#checkindt_venue').val(chk_from_date);
        $('#checkoutdt_venue').val(chk_to_date);


		});
    });    

</script>            
   