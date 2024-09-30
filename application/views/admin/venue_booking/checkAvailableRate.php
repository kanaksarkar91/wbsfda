<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Check Availability & Rate</h1>
            </div>
            <div class="col-auto">
                
            </div>
        </div>

        <div class="app-card app-card-settings shadow-sm p-3 mb-2">
            <div class="app-card-body">
                <form action="<?= base_url('check-admin-venue-available-rate/' . $venues[0]->rate_id)?>" class="banner-location-flex" id="venue-form">
                <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
                    <div class="row g-3">
                        <div class="col-lg-10 col-sm-8 col-md-8">
                            <label class="form-label"><i class="las la-calendar"></i> Check Availability & Rate </label>
                            <input type="text" class="form-control check-in-out" name="date_range" id="dates" value="<?= isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '' ? ($from_date . ' - ' . $to_date) : ''; ?>" />
                            <input type="hidden" name="start_date" id="checkindt_venue" value="<?= isset($from_date) && $from_date != ''? $from_date : ''?>" />
                            <input type="hidden" name="end_date" id="checkoutdt_venue" value="<?=isset($to_date) && $to_date != ''? $to_date : ''?>" />
                        </div>
                        <div class="col-lg-2 col-sm-4 col-md-4">
                            <label for="" class="form-label w-100">&nbsp;</label>
                            <button type="button" class="btn app-btn-primary w-100" id="submit-button">
                                SUBMIT
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-3">
            
        <div class="col-xl-8 col-lg-7">
        <div class="app-card app-card-settings shadow-sm p-3">
                    <div class="app-card-body">
                                        <h4 class="mb-3"> <?=$venues[0]->venue_names ?> </h4>
                                        <table class="table table-borderless table-responsive table-hover">
                                            <tbody>
                                                <tr>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center"><?=($venues[0]->is_hourly_booking_rate==1 )?$venues[0]->booking_hours_rate.' Hours in a Day':' Price Per Calender Day'?></th>

                                                    <?php if($venues[0]->is_multiple_venues == '0' && $venues[0]->single_venue_id == '11'){ ?>

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
                                                    <td class="text-center">Rs. <?= number_format($venues[0]->{strtolower(date('D', $currentDate)) . '_price'}, 2, ".", ",") ;?></td>

                                                    <?php if($venues[0]->is_multiple_venues == '0' && $venues[0]->single_venue_id == '11'){ ?>

                                                        <td class="text-center">Rs. 1000 (per additional hour)</td>

                                                    <?php } ?>
                                                </tr>
                                        <?php $currentDate = strtotime('+1 day', $currentDate);
                                     } ?>   
                                            </tbody>
                                        </table>
                                        <div class="col-sm-12 text-center m_top20">
                                                <?php 
                                                $start_date = ($this->input->get('start_date'))? $this->input->get('start_date'): $from_date;
                                                $end_date = ($this->input->get('end_date'))? $this->input->get('end_date'): $to_date;
                                                if($start_date && $end_date):?>
                                                <div class="btn-wrapper text-center">
                                                    <a class="btn app-btn-primary mb-3" href="<?= base_url()?>reserve-admin-venue/<?= $venues[0]->rate_id?>?start_date=<?= $start_date?>&&end_date=<?= $end_date?>">Proceed to Reserve</a>
                                                </div>
                                                    <?php else:?>
                                                <div class="btn-wrapper text-center">      
                                                    <a class="btn app-btn-primary mb-3" href="<?= base_url()?>reserve-admin-venue/<?= $venues[0]->rate_id?>">Proceed to Reserve</a>
                                                </div>
                                                    <?php endif?>
                                            
                                            <!-- Modal -->
                                            
                                        </div>
                                        </div>
                </div>
                        </div>
                        <?php if(isset($venues)){?>

            <div class="col-xl-4 col-lg-5">
                <div class="app-card app-card-settings shadow-sm p-3">
                    <div class="app-card-body">
                        <img src="<?=base_url('/public/admin_images/').$venues[0]->image1?>" alt="img" class="img-fluid d-block mx-auto rounded">
                        <ul class="list-unstyled">
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-map-marker"></i></span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Location:</span> <?=$venues[0]->property_name?> </span>
                            </li>
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-street-view"></i></span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Address:</span> <?=$venues[0]->property_address_line_1?> </span>
                            </li>
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-phone"></i></span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Contact No.:</span> <?=$venues[0]->property_phone_no?> </span>
                            </li>
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-envelope-o"></i></span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">e-mail ID:</span> <?=$venues[0]->property_email?> </span>
                            </li>
                            <?php if($venues[0]->approx_capacity) {?>
                                <li class="hotel-view-contents-location mt-2">
                                    <span class="hotel-view-contents-location-icon"> <i class="fa fa-users"></i></span>
                                    <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Approx Capacity:</span> <?=$venues[0]->approx_capacity?></span>
                                </li>
                                <?php }?>
                                <?php if($venues[0]->available_timming) {?>
                                <li class="hotel-view-contents-location mt-2">
                                    <span class="hotel-view-contents-location-icon"> <i class="fa fa-clock-o"></i></span>
                                    <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Available Timming:</span> <?=$venues[0]->available_timming?></span>
                                </li>
                                <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>








<script src="<?= base_url('public/admin_assets/js/custom.js'); ?>"></script>
    
<script>
$(document).ready(function() {    

    $('#submit-button').click(function() {
        var form = $('#venue-form');
        var dateRange = $('#dates').val();
        var dateParts = dateRange.split(' - ');

        if (dateParts.length === 2) {
            var from_date = moment(dateParts[0], 'DD/MM/YYYY').format('DDMMYYYY');
            var to_date = moment(dateParts[1], 'DD/MM/YYYY').format('DDMMYYYY');

            form.attr('action', '<?= base_url('check-admin-venue-available-rate/' . $venues[0]->rate_id) ?>' + '/' + from_date + '/' + to_date);
        }

        // Submit the form
        form.submit();
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
        form.attr('action', '<?= base_url('check-admin-venue-available-rate/' . $venues[0]->rate_id) ?>' + '/' + from_date + '/' + to_date);
        $('#checkindt_venue').val(chk_from_date);
        $('#checkoutdt_venue').val(chk_to_date);


		});
});


</script>            
   