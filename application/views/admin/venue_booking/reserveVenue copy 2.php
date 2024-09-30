<style>
/* Custom styles for the alert message */
.alert-message {
    font-size: 18px;
    font-weight: bold;
    padding: 20px;
    margin-bottom: 0;
}

/* Center the modal content */
.modal-body.text-center {
    text-align: center;
}

/* Adjust the modal button position */
.modal .btn-primary {
    margin-top: 20px;
}


</style>
<section class="hotel-details-area pat-30 pab-30">
        <div class="container">
            <div class="row g-4">
                <div class="col-xl-8 col-lg-7">
                    <div class="details-left-wrapper">
                        <div class="details-contents bg-white radius-10">
                            <div class="details-contents-header">
                                <h4 class="mb-3"> <?=$venues[0]->venue_names?> </h4>
                                <h6 class="thm-txt mb-3 fw-normal">Please submit your Reservation Request</h6>
                                <table class="table table-borderless table-responsive table-hover">
                                    <tbody>
                                        <tr>
                                            <th class="text-center">Please Select</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center"><?=($venues[0]->is_hourly_booking_rate==1 )?$venues[0]->booking_hours_rate.' Hours in a Day':' Price Per Calender Day'?></th>
                                        </tr>
                                        <!--<?php for($i=1;$i<11;$i++){ $isAvailable = !in_array($i - 1, array_column($dayDiff, 'day_difference'));?>
                                        <tr>
                                            <td class="text-center">
                                                <div class="checkbox-inline">
                                                    <?php if($isAvailable){?>
                                                    <input class="check-input checkboxClass" type="checkbox" id="agree" value="<?= date('d-m-Y', strtotime(+$i.' day'));?>">
                                                    <?php } ?>                                              
                                                </div>
                                            </td>
                                            <td class="text-center"><?= date('d-m-Y D', strtotime(+$i.' day'));?></td>
                                            <td class="text-center"><span class="<?= $isAvailable  ? 'bg-success' : 'bg-secondary'; ?> p-1 rounded text-white"><?= $isAvailable ? 'Available' : 'Not-Available'; ?></span></td>
                                            <td class="text-center">Rs. <?php $dayPrefix = strtolower(date('D', strtotime(+$i.' day')));
                                            $priceColumnName = $dayPrefix . '_price'; 
                                            echo number_format($venues[0]->$priceColumnName,2,".",",")?><input type="hidden" class="price_<?= date('dmY',strtotime(+$i.' day'))?>" data-rate_id = "<?= $venues[0]->rate_id?>" value="<?= $venues[0]->$priceColumnName?>" ></td>
                                        </tr>
                                        <?php } ?>-->
                                        <?php
                                                $from_date = str_replace('/', '-', $from_date); // Convert dd/mm/YYYY to dd-mm-YYYY
                                                $to_date = str_replace('/', '-', $to_date);     // Convert dd/mm/YYYY to dd-mm-YYYY
                                                
                                                $currentDate = strtotime($from_date);
                                                $endDate = strtotime($to_date);
                                                $i=1;
                                                while ($currentDate <= $endDate) {
                                                    $formattedDate = date('d-m-Y D', $currentDate);
                                                    $currentDateObj = new DateTime();
                                                    $dateObj = new DateTime(date('Y-m-d',$currentDate));
                                                    // Calculate the difference between the two dates
                                                    $interval = $currentDateObj->diff( $dateObj);
                                                    $chkformattedDate=date('d-m-Y',$currentDate);
                                                    // Get the number of days
                                                    $dayDifference = $interval->days;
                                                    $isAvailable = !in_array( $dayDifference, array_column($dayDiff, 'day_difference'));?>
                                                    <tr>
                                                    <td class="text-center">
                                                        <div class="checkbox-inline">
                                                            <?php if($isAvailable){?>
                                                            <input class="check-input checkboxClass" type="checkbox" id="agree" value="<?= $chkformattedDate;?>">
                                                            <?php } ?>                                              
                                                        </div>
                                                    </td>
                                                    <td class="text-center"><?= $formattedDate;?></td>
                                                    <td class="text-center"><span class="<?= $isAvailable  ? 'bg-success' : 'bg-secondary'; ?> p-1 rounded text-white"><?= $isAvailable ? 'Available' : 'Not-Available'; ?></span></td>
                                                    <td class="text-center">Rs. <?= number_format($venues[0]->{strtolower(date('D', $currentDate)) . '_price'}, 2, ".", ",") ;?>
                                                    <input type="hidden" class="price_<?= date('dmY',$currentDate)?>" data-rate_id = "<?= $venues[0]->rate_id?>" value="<?= $venues[0]->{strtolower(date('D', $currentDate)) . '_price'}?>" >
                                                    </td>
                                                </tr>
                                        <?php $currentDate = strtotime('+1 day', $currentDate);
                                        $i++;
                                     } ?>   
                                    </tbody>
                                </table>

                                <div class="selected-reservation-date pb-3">
                                    <h6 class="thm-txt fw-normal">You have selected this venue for reservation on :</h6>
                                    <ul class="reservation-dates">
                                        <li id="selected_date">
                                            
                                        </li>
                                    </ul>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <input type="hidden" id="gst_perc" value="">
                                        <input type="hidden" id="sgst_perc" value="">
                                        <input type="hidden" id="cgst_perc" value="">
                                        <input type="hidden" id="igst_perc" value="">
                                        <input type="hidden" id="sgst_amt" value="">
                                        <input type="hidden" id="cgst_amt" value="">
                                        <input type="hidden" id="igst_amt" value="">

                                        <div>
                                            <h6 class="thm-txt fw-normal">Total Amount :</h6>
                                            <h4 id="total_price_text" class="thm-txt-2 fw-bold">Rs. 0.00</h4>
                                        </div>
                                        <div>
                                            <h6 class="thm-txt fw-normal"> GST Amount :</h6>
                                            <h4 id="gst_amount" class="thm-txt-2 fw-bold">Rs. 0.00</h4>
                                        </div>
                                        <div>
                                            <h6 class="thm-txt fw-normal">Total Payable Amount :</h6>
                                            <h4 id="net_amount" class="thm-txt-2 fw-bold">Rs. 0.00</h4>
                                        </div>
                                        <div class="btn-wrapper text-center">
                                            <button type="button" class="cmn-btn btn-bg-1" data-toggle="modal" data-target="#bookingModal" id="proceed" disabled="disabled">Proceed</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="bookingSection" class="details-contents bg-white radius-10 mt-3">
                            <form action="#" class="custom-form mt-3" id="bookingForm" autocomplete="off"  method="post">
                            <input type="hidden" class="form-control" name="user_id" value="<?= $customer_details['customer_id'] ?>">

                                <div class="p-3">
                                    <h6 class="thm-txt fw-normal mb-3"> Reservation to be done for </h6>

                                    <div class="details-contents-tab">
                                        <ul class="tabs details-tab details-tab-border">
                                            <li class="active" data-tab="individual" style="margin-left: 0;"> Individual </li>
                                            <li data-tab="organisation" style="margin-left: 0;"> Organisation </li>
                                        </ul>
                                        <div id="individual" class="tab-content-item p-0 active">
                                            <div class="input-flex-item">
                                                <div class="single-input mt-3">
                                                    <label class="label-title">Name</label>
                                                    <input class="form-control" type="text" name="indivisual_full_name"  id="indivisual_full_name" placeholder="Type Full Name"  value="<?= $customer_details['first_name']. ' '.  $customer_details['middle_name']. ' '.$customer_details['last_name']?>" readonly>
                                                </div>
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> e-mail ID </label>
                                                    <input class="form-control" type="email" name="indivisual_email" id="indivisual_email" placeholder="Type Email-ID" value="<?= $customer_details['email'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="input-flex-item">
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> Contact No. </label>
                                                    <input class="form-control " type="text" name="indivisual_contact_no" id="indivisual_contact_no" placeholder="Type Contact No" value="<?= $customer_details['mobile'] ?>" readonly>
                                                </div>
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> Full Address with Pincode</label>
                                                    <input class="form-control" type="text" name="indivisual_full_address" id="indivisual_full_address" placeholder="Type Full Address" value="<?= $customer_details['address'] .' '.$customer_details['city'].'-'.$customer_details['pincode']?>" readonly>
                                                </div>
                                            </div>
                                            <div class="input-flex-item">
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> Purpose </label>
                                                    <input class="form--control" type="text" name="indivisual_purpose" placeholder="Type Purpose">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="organisation" class="tab-content-item p-0">
                                            <div class="input-flex-item">
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> Name<span class="asterisk text-danger"> *</span> </label>
                                                    <input class="form-control required-field" type="text" name="business_full_name" id="business_full_name" placeholder="Type Full Name" required>
                                                    <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                </div>
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> e-mail ID<span class="asterisk text-danger"> *</span> </label>
                                                    <input class="form-control required-field" type="email" name="business_email"  id="business_email" placeholder="Type Email-ID" required>
                                                    <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                </div>
                                            </div>
                                            <div class="input-flex-item">
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> Contact No.<span class="asterisk text-danger"> *</span> </label>
                                                    <input class="form-control contact required-field" type="text" name="business_contact_no" id="business_contact_no" placeholder="Type Contact No"  maxlength="10" required>
                                                    <span id="mob-invalid" class="hidden small text-danger">
                                                        You have entered an Invalid Mobile Number
                                                    </span>
                                                            <span id="mob-invalid_digits" class="hidden small text-danger">
                                                            Please enter 10 digits Mobile Number
                                                    </span>
                                                    <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                </div>
                                                <div class="single-input mt-3 gst-input-container">
                                                    <label class="label-title"> GSTIN </label>
                                                    <input class="form-control gst-input" type="text" name="business_gst_no" placeholder="Type GST No">
                                                    <span id="invalid_gst" class="hidden small text-danger">
                                                    Please Enter Valid GSTIN Number
                                                    </span>
                                                    <span id="invalid_gst_length" class="hidden small text-danger">
                                                    Please enter valid 15 digits GSTIN Number
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="input-flex-item">
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> Full Address with Pincode<span class="asterisk text-danger"> *</span> </label>
                                                    <input class="form-control required-field" type="text" name="business_full_address" id="business_full_address" placeholder="Type Full Address" required>
                                                    <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                </div>
                                            </div>
                                            <div class="input-flex-item">
                                                <div class="single-input mt-3">
                                                    <label class="label-title">  Purpose </label>
                                                    <input class="form--control" type="text" name="business_purpose" placeholder="Type Purpose">
                                                </div>
                                            </div>
                                            <div class="mt-3"><small class="fw-bold thm-txt-2">Details of the contact person on behalf of the organisation:</small></div>
                                            <div class="input-flex-item">
                                                <div class="single-input mt-3">
                                                    <label class="label-title">Name<span class="asterisk text-danger"> *</span> </label>
                                                    <input class="form-control required-field" type="text" name="contact_person_name" id="contact_person_name" placeholder="Type Person Name" required>
                                                    <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                </div>
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> Designation </label>
                                                    <input class="form-control" type="text" name="contact_person_designation" placeholder="Type Designation">
                                                </div>
                                            </div>
                                            <div class="input-flex-item">
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> e-mail ID<span class="asterisk text-danger"> *</span> </label>
                                                    <input class="form-control required-field" type="email" name="contact_person_email" id="contact_person_email" placeholder="Type Person Email" required>
                                                    <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                </div>
                                                <div class="single-input mt-3">
                                                    <label class="label-title">Contant No. <span class="asterisk text-danger"> *</span></label>
                                                    <input class="form-control contact required-field" type="text" name="contact_person_contact_no"  id="contact_person_contact_no" maxlength="10" placeholder="Type Contact No" required>
                                                    <span id="mob-invalid" class="hidden small text-danger">
                                                        You have entered an Invalid Mobile Number
                                                    </span>
                                                            <span id="mob-invalid_digits" class="hidden small text-danger">
                                                            Please enter 10 digits Mobile Number
                                                    </span>
                                                    <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-3 pt-0 bg-light">
                                    <div class="d-flex align-items-center">
                                        <h6 class="thm-txt fw-normal me-3"> Is the booking request initiated by a third-party agency ? </h6>
                                        <div class="custom-radio custom-radio-inline">
                                            <div class="custom-radio-single active">
                                                <input class="radio-input" type="radio" id="radio1" value='1' name="is_agency">
                                                <label for="radio1" class="mb-0">YES</label>
                                            </div>
                                            <div class="custom-radio-single">
                                                <input class="radio-input" type="radio" id="radio2" value='0' name="is_agency" checked="checked">
                                                <label for="radio2" class="mb-0">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="agencyInformationBlock">
                                        <small class="fw-bold thm-txt-2">Add Agency Information:</small>
                                        <div class="input-flex-item">
                                            <div class="single-input mt-3">
                                                <label class="label-title"> Name <span class="asterisk text-danger"> *</span></label>
                                                <input class="form-control required-field" type="text" name="agency_full_name" id="agency_full_name" placeholder="Type Full Name" required>
                                                <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                            </div>
                                            <div class="single-input mt-3">
                                                <label class="label-title">e-mail ID<span class="asterisk text-danger"> *</span></label>
                                                <input class="form-control required-field" type="email" name="agency_email" id="agency_email" placeholder="Type Email ID" required>
                                                <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                            </div>
                                        </div>
                                        <div class="input-flex-item">
                                            <div class="single-input mt-3">
                                                <label class="label-title">Contact No. <span class="asterisk text-danger"> *</span></label>
                                                <input class="form-control contact required-field" type="text" name="agency_contact_no" id="agency_contact_no" placeholder="Type Contact No" maxlength="10"  required>
                                                <span id="mob-invalid" class="hidden small text-danger">
                                                        You have entered an Invalid Mobile Number
                                                    </span>
                                                            <span id="mob-invalid_digits" class="hidden small text-danger">
                                                            Please enter 10 digits Mobile Number
                                                    </span>
                                                    <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                            </div>
                                            <div class="single-input mt-3 gst-input-container">
                                                <label class="label-title"> GSTIN </label>
                                                <input class="form-control gst-input" type="text" name="agency_gst_no" placeholder="Type GST No">
                                                <span id="invalid_gst" class="hidden small text-danger">
                                            Please Enter Valid GSTIN Number
                                            </span>
                                            <span id="invalid_gst_length" class="hidden small text-danger">
                                            Please enter valid 15 digits GSTIN Number
                                            </span>                                            
                                        </div>
                                        </div>
                                        <div class="input-flex-item">
                                            <div class="single-input mt-3">
                                                <label class="label-title"> Full Address with Pincode <span class="asterisk text-danger"> *</span></label>
                                                <input class="form-control required-field" type="text" name="agency_full_address" id="agency_full_address" placeholder="Type Full Address" required>
                                                <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="btn-wrapper text-center py-3">
                                <span id="daysAndAdvancedAmount"></span> 
                                    <!--<a id="submit_request" type="button" href="#."  class="cmn-btn btn-bg-1"> PROCEED TO PAY </a>-->
                                    <a id="pay_now" type="button" href="#."  class="cmn-btn btn-bg-1"> PROCEED TO PAY </a>
                                </div>

                            </form>
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
    <div class="modal fade" id="bookingsuccessModal" tabindex="-1" role="dialog" aria-labelledby="bookingsuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Booking Requested Successfully</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center"><b>Your request for reservation has been received with the 
                    Reservation Request ID : <span id="booking_id"></span>.
                    WBSFDC will contact with you shortly</b></p>
            </div>
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn_visitor_book" type="button" href="#." data-toggle="modal" data-target="#bookingsuccessModal">Submit</a>
            </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p id="modalMessage" class="alert-message"></p>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<form action="<?= base_url('proceed-to-booking-payment')?>" method="POST" id="proceedPayment" style="display: none">
<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <button class="btn btn-blue" id="ajaxSubmit">Proceed to Pay <i class="fa fa-long-arrow-right ml-2"></i></button>
</form>
<script type="text/javascript">
    let total_price = 0; let date = []; let rate_id =[]; let prices = [];let gst_amt = 0;let net_amt = 0;let net_amount=0;let is_advance_pay=false;let advanced_amount=0;
    $( document ).ready(function() { 
        // Initially, disable the "Proceed" button
    $(document).on('change','.checkboxClass', function(){
        let date_data = ''; let set_selected_date = '';
        var sel_date_val=convertDateFormat(this.value);

        if(this.checked) {
            date.push(this.value);
            if (!areDatesConsecutive(date)) {
                // Uncheck the checkbox
                $(this).prop('checked', false);
                //$("#bookingSection").hide();
                //$('#proceed').prop('disabled', true);
            // Show a modal popup with an error message
            $('#customModal').modal('show');
            $('#modalMessage').text('Please select consecutive dates to continue the venue reservation process.');
            date.splice(date.indexOf(this.value), 1);
            return false; // Return false to prevent further processing
            }
            rate_id.push($(this).parent().parent().parent().find(".price_"+sel_date_val).data('rate_id'));
            prices.push($(this).parent().parent().parent().find(".price_"+sel_date_val).val());
            total_price = total_price + (+$(this).parent().parent().parent().find(".price_"+sel_date_val).val());
            calculateGSTAmount($(this).parent().parent().parent().find(".price_"+sel_date_val).val(),total_price);

        }else{
            //date.pop(this.value);
            date.splice(date.indexOf(this.value), 1);
            if (!areDatesConsecutive(date)) {
                // check the checkbox
                $(this).prop('checked', true);
                //$("#bookingSection").hide();
                //$('#proceed').prop('disabled', true);
            // Show a modal popup with an error message
            $('#customModal').modal('show');
            $('#modalMessage').text('Sorry! You cannot de-select the current selection as consecutive dates are required.');
            date.push(this.value);
            return false; // Return false to prevent further processing
            }
            rate_id.splice(rate_id.indexOf($(this).parent().parent().parent().find(".price_"+sel_date_val).data('rate_id')), 1);
            prices.splice(prices.indexOf($(this).parent().parent().parent().find(".price_"+sel_date_val).val()), 1);
            total_price = total_price - (+$(this).parent().parent().parent().find(".price_"+sel_date_val).val());
            calculateGSTAmount($(this).parent().parent().parent().find(".price_"+sel_date_val).val(),total_price);

        }
        console.log('date : ', date);
        console.log('total : ', total_price);
        console.log('rate_id : ', rate_id);
        console.log('prices : ', prices);

        
 
        if (isNaN(total_price)) {
        // It's not a number (NaN)
        total_price=0;
        } 

        $('#total_price').val(total_price);
        $('#total_price_text').text('Rs. '+total_price.toFixed(2));
        for (let i = 0; i < date.length; i++) {
            date_data +=  '<span>' +changeDateFormatTo(date[i])+ '</span>, ';
            set_selected_date += date[i]+',';
        }
        set_selected_date=set_selected_date.substring(0, set_selected_date.length - 1);
        //date_data=date_data.substring(0, date_data.length - 2);
        console.log(date_data);
        $('#selected_date').html('');
        $('#selected_date').html(date_data);
        $('#preview_selected_date').html(date_data);
        $('#total_rent').text('Rs. '+total_price.toFixed(2));

        if(date.length > 0 && total_price > 0) {
            $('#proceed').prop('disabled', false);
        }else{
            alert('Please select available date to continue venue reservation process.');
            $("#bookingSection").hide();
            $('#proceed').prop('disabled', true);
        }
    });


    $(document).on('click', '#pay_now', function() {
        //let amount = $(this).data('amount');
        let surl = "<?= base_url('booking-venue-success')?>";
        let furl = "<?= base_url('booking-venue-failure')?>";
        var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";

        //alert(amount);
        $.ajax({
            url:'<?= base_url('generate-venue-txnid')?>',
            method: 'post',
            data: {booking_id:booking_id,surl:surl,furl:furl, "<?= $this->security->get_csrf_token_name(); ?>": csrf_token,
},
            dataType: 'json',
            success: function(response){
                //console.log(response.txnid);
                if(response) {
                    
                    $( "#proceedPayment" ).submit();
                }
            }
        });
    });
     // Function to check if selected dates are consecutive
     function areDatesConsecutive(dates) {
        if (dates.length <= 1) {
            return true; // Single date or no dates are considered consecutive
        }

        dates.sort(); // Sort the dates in ascending order

        for (let i = 1; i < dates.length; i++) {
            const currentDate = new Date(parseDate(dates[i]));
            const prevDate = new Date(parseDate(dates[i - 1]));
            const oneDay = 24 * 60 * 60 * 1000; // One day in milliseconds

            // Check if the difference between consecutive dates is not one day
            if (Math.abs(currentDate - prevDate) !== oneDay) {
                return false; // Dates are not consecutive
            }
        }

        return true; // All dates are consecutive
    }

    function parseDate(dateString) {
        const parts = dateString.split('-'); // Split the date string by hyphens
        const day = parseInt(parts[0], 10);  // Parse the day part as an integer
        const month = parseInt(parts[1], 10); // Parse the month part as an integer
        const year = parseInt(parts[2], 10);  // Parse the year part as an integer

        // Create a JavaScript Date object using the parsed values
        // Note: Months in JavaScript Date objects are 0-based (0 = January, 1 = February, etc.)
        return new Date(year, month - 1, day); // Subtract 1 from the month to get the correct month value
    }
    
    function calculateGSTAmount(per_day_rate,total_price) {
        var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";
        per_day_rate_val=parseFloat(per_day_rate).toFixed(2);
    // Make an AJAX request to fetch GST slab based on total_price
    $.ajax({
        url: "<?=base_url('frontend/venue_booking/getGSTSlab')?>", // Replace with your actual endpoint URL
        method: 'POST',
        data: { per_day_rate: per_day_rate_val,"<?= $this->security->get_csrf_token_name(); ?>": csrf_token
 },
        dataType: 'json',
        success: function (response) {
            if (response) {
                // Calculate GST amount based on GST percentage
                var gst_percentage = response.gst_percentage;
                var gst_amount = (gst_percentage / 100) * total_price;
                $('#gst_perc').val(gst_percentage);
                // Additional calculations for CGST, SGST, IGST, etc. if needed
                 var cgst_percentage = response.cgst_percentage;
                 var sgst_percentage = response.sgst_percentage;
                 var igst_percentage = response.igst_percentage;
                var cgst_amount = (cgst_percentage / 100) * total_price;
                 var sgst_amount = (sgst_percentage / 100) * total_price;
                 var igst_amount = (igst_percentage / 100) * total_price;

                 $('#cgst_perc').val(cgst_percentage);
                 $('#sgst_perc').val(sgst_percentage);
                 $('#igst_perc').val(igst_percentage);
                 $('#cgst_amt').val(cgst_amount);
                 $('#sgst_amt').val(sgst_amount);
                 $('#igst_amt').val(igst_amount);

                // Calculate total GST amount
                // var total_gst_amount = gst_amount + cgst_amount + sgst_amount + igst_amount;

                // Calculate the net payable amount
                 net_amount = total_price + gst_amount;

                // Update the HTML to display GST amount and net amount
                gst_amt=gst_amount.toFixed(2);
                net_amt= net_amount.toFixed(2);
                $('#gst_amount').text('Rs. ' + gst_amount.toFixed(2));
                $('#net_amount').text('Rs. ' + net_amount.toFixed(2));
                    // Convert date strings to JavaScript Date objects
                var dateObjects = date.map(function(dateStr) {
                    var parts = dateStr.split('-');
                    return new Date(parts[2], parts[1] - 1, parts[0]); // Year, month (0-based), day
                });

                // Find the minimum date in the array
                var minDate = new Date(Math.min.apply(null, dateObjects));
                        // Calculate the previous date of minDate
                var previousDate = new Date(minDate);
                previousDate.setDate(minDate.getDate() - 1);
                // Get the current date
                var currentDate = new Date();
                
                // Calculate the number of days between minDate and currentDate
                var timeDifference = previousDate - currentDate;
                var numberOfDays = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));
                var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";

                // Make an AJAX call to your controller method
                $.ajax({
                    url: "<?=base_url('frontend/venue_booking/getAdvancedAmountOrNot')?>", // Replace with your actual endpoint URL
                    type: 'POST',
                    data: { numberOfDays: numberOfDays , net_amount:net_amount,"<?= $this->security->get_csrf_token_name(); ?>": csrf_token},
                    success: function(response) {
                        // Deserialize the response from the server
                        var responseData = JSON.parse(response);
                        // Update the "daysAndAdvancedAmount" span with the calculated values
                        if (responseData.status) {
                            is_advance_pay=true;
                            advanced_amount=responseData.advanced_amount;
                            $("#daysAndAdvancedAmount").text('Number of Days: ' + numberOfDays + ', Advanced Amount: ' + responseData.advanced_amount);
                        } else {
                            $("#daysAndAdvancedAmount").text('Number of Days: ' + numberOfDays);
                        }
                    },
                    error: function() {
                        // Handle AJAX error
                        console.log('Error in AJAX request');
                    }
                });
            } else {
                console.log('No GST slab found for the given total_price.');
            }
        },
        error: function (error) {
            console.error('Error fetching GST slab:', error);
        }
    });
}
    function convertDateFormat(inputDate) {
    var parts = inputDate.split('-');
    if (parts.length === 3) {
        // Rearrange the parts to the "dmY" format
        return parts[0] + parts[1] + parts[2];
    }
    // Return the original input if it's not in the expected format
    return inputDate;
}

// Attach input event handlers to all required fields
$('.required-field').on('input', function () {
    const $input = $(this);
    const $validationMessage = $input.closest('.input-flex-item').find('.validation-message');
    
    if ($input.val().trim() === '') {
        $validationMessage.removeClass("hidden");
    } else {
        $validationMessage.addClass("hidden");
    }
});


    $(document).on('click','#submit_request', function() {
                // Check contact input fields
                var form_valid=true;
                var isAgency = $('input[name="is_agency"]:checked').val();

                // Define an array of block IDs to validate
                var blocksToValidate = [];
                var selectedTab = $('.tabs li.active');
                // Get the data-tab attribute of the selected tab
                var selectedTabValue = selectedTab.attr('data-tab');

               if(selectedTabValue === 'individual')
               {
                if (isAgency === '1') {
                    // If not an agency, add the block IDs that need validation
                    blocksToValidate.push('#agencyInformationBlock');
                }
               }
               else {
                if (isAgency === '1') {
                    // If not an agency, add the block IDs that need validation
                    blocksToValidate.push('#organisation', '#agencyInformationBlock');
                } else {
                    // If an agency, add the agency block for validation
                    blocksToValidate.push('#organisation');
                }
            }
                // Iterate through the blocks and validate required fields
                blocksToValidate.forEach(function (blockID) {               
                    $(blockID + ' .required-field').each(function () {
                        var $input = $(this);
                        var $validationMessage = $input.closest('.input-flex-item').find('.validation-message'); // Assuming the validation message is a sibling element

                        // Check if the input field is empty
                        if ($input.val().trim() === '') {
                            $validationMessage.removeClass('hidden'); // Show the validation message
                            form_valid = false; // Set the form as invalid
                        } else {
                            $validationMessage.addClass('hidden'); // Hide the validation message
                        }
                    });
                 });


                    if (!form_valid) {
                        // If the form is not valid (i.e., there are empty required fields), stop form submission
                        return false;
                    }


                    blocksToValidate.forEach(function (blockID) {               
                    $(blockID +' .contact').each(function () {
                    const $input = $(this);
                    const $invalidContact = $input.closest('div').find('#mob-invalid');
                        const $invalid_digitsContact = $input.closest('div').find('#mob-invalid_digits');
                        var mobNum=$input.val();
                        var filter = /^\d*(?:\.\d{1,2})?$/;
                        if (mobNum != null || typeof mobNum != 'undefined') {

                            if (filter.test(mobNum)) {
                                if (mobNum.length == 10) {
                                    if(!$invalidContact.hasClass("hidden"))
                                    $invalidContact.addClass("hidden");
                                $invalid_digitsContact.addClass("hidden");
                                } else {
                                    //alert('Please put 10  digit mobile number');
                                if(!$invalidContact.hasClass("hidden"))
                                $invalidContact.addClass("hidden");
                                $invalid_digitsContact.removeClass("hidden");
                                    form_valid=false;
                                }
                            } else {
                                $invalidContact.removeClass("hidden");
                        if(!$invalid_digitsContact.hasClass("hidden"))
                            $invalid_digitsContact.addClass("hidden");
                            form_valid=false;
                            }
                    }
                });
            });
                if(!form_valid)
                    return false;

                    
               if(selectedTabValue === 'individual')
               {
                if (isAgency === '1') {
                    // If not an agency, add the block IDs that need validation
                    blocksToValidate.push('#agencyInformationBlock');
                }
               }
               else {
                if (isAgency === '1') {
                    // If not an agency, add the block IDs that need validation
                    blocksToValidate.push('#organisation', '#agencyInformationBlock');
                } else {
                    // If an agency, add the agency block for validation
                    blocksToValidate.push('#organisation');
                }
            }
                // Check GST input fields
                blocksToValidate.forEach(function (blockID) {               
                    $(blockID +'.gst-input').each(function () {
                    const $input = $(this);

                    const $invalid_gst = $input.closest('div').find('#invalid_gst');
                    const $invalid_gst_length = $input.closest('div').find('#invalid_gst_length');                    
                    var gstinformat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');
                    var inputvalues = $(this).val();
                    if (inputvalues != null || typeof inputvalues != 'undefined') {

                        if(inputvalues.length>0)
                        {
                            if (inputvalues.length == 15) {
                            if (gstinformat.test(inputvalues)) {
                                if(!$invalid_gst.hasClass("hidden"))			
                                    $invalid_gst.addClass("hidden");
                                if(!$invalid_gst_length.hasClass("hidden"))
                                    $invalid_gst_length.addClass("hidden");
                                    form_valid=false;
                                } 
                            else {
                                $invalid_gst.removeClass("hidden");
                                if(!$invalid_gst_length.hasClass("hidden"))
                                    $invalid_gst_length.addClass("hidden");
                                $(this).focus();
                                form_valid=false;
                                }             
                            }
                            else
                            {
                                $invalid_gst_length.removeClass("hidden");
                                    if(!$invalid_gst.hasClass("hidden"))			
                                        $invalid_gst.addClass("hidden");
                                $(this).focus();
                                form_valid=false;
                            }
                        }
                        else{
                            if(!$invalid_gst.hasClass("hidden"))			
                                    $invalid_gst.addClass("hidden");
                            if(!$invalid_gst_length.hasClass("hidden"))
                                    $invalid_gst_length.addClass("hidden");
                        }	
                    }
                });
            });
                if(!form_valid)
                    return false;


        $('#bookingsuccessModal').modal('show'); false;
        $('#booking_id').text('');
        var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";
        // Get the currently active tab with the "active" class
        var selectedTab = $('.tabs li.active');
        var rate_id=<?= $venues[0]->rate_id ?>;
        var gst_perc=$('#gst_perc').val();
        var cgst_perc=$('#cgst_perc').val();
        var sgst_perc=$('#sgst_perc').val();
        var igst_perc=$('#igst_perc').val();
        var cgst_amt=$('#cgst_amt').val();
        var sgst_amt=$('#sgst_amt').val();
        var igst_amt=$('#igst_amt').val();
        // Get the data-tab attribute of the selected tab
        var selectedTabValue = selectedTab.attr('data-tab');
        let data = {
            date: date,
            total_price: total_price,
            gst_amt:gst_amt,
            net_amt:net_amt,
            gst_perc:gst_perc,
            cgst_perc:cgst_perc,
            sgst_perc:sgst_perc,
            igst_perc:igst_perc,
            cgst_amt:cgst_amt,
            sgst_amt:sgst_amt,
            igst_amt:igst_amt,
            rate_id: rate_id,
            selected_tab_value: (selectedTabValue === 'individual') ? 1 : 0,
            prices: prices,
            "<?= $this->security->get_csrf_token_name(); ?>": csrf_token,
            form_data: $('form#bookingForm').serializeArray()
        };
        $.ajax({
            url: "<?=base_url('booking-venue')?>",
            cache: false,
            type: "POST",
            data: data,
            dataType: "JSON",
            success: function(res){
                $('#booking_id').text(res.booking_id);
                $('#bookingModal').modal('hide');
                $('#bookingsuccessModal').modal('show');
                setTimeout(function() {
                        $('#bookingsuccessModal').modal('hide');
                        window.location.replace("<?= base_url('my-booking?tab=hall-venue')?>");
                    }, 3000);
            }
        });
    });
    const changeDateFormatTo = date => {
      const [dd, mm, YYYY] = date.split(/-/g);
      return `${dd}-${mm}-${YYYY}`;
    };


    
    $(document).ready(function() {
    // Initially hide the agency information block
    $("#agencyInformationBlock").hide();

    // Listen for changes in the radio button selection
    $('input[type="radio"]').change(function() {
        if (this.id === "radio1") {
            // If "YES" is selected, show the agency information block
            $("#agencyInformationBlock").show();
        } else {
            // If "NO" is selected, hide the agency information block
            $("#agencyInformationBlock").hide();
        }
    });

    // Initially hide the "Booking to be done for" section
    $("#bookingSection").hide();

    // Listen for the "Proceed" button click event
    $('#proceed').on('click', function() {
        
        // Show the "Booking to be done for" section
        $("#bookingSection").show();
        // Find all <li> elements with the class "tabs"
        var tabs = $('.tabs li');

        // Loop through each <li> element
        tabs.each(function() {
            // Check if the data-tab attribute equals "individual"
            if ($(this).attr('data-tab') === 'individual') {
                // Add the "active" class to the current <li> element
                $(this).addClass('active');
            } else {
                // Remove the "active" class from all other <li> elements
                $(this).removeClass('active');
            }
        });
             
        // Scroll to the "Booking to be done for" section
        $('html, body').animate({
            scrollTop: $("#bookingSection").offset().top
        }, 1000);
    });

    $(document).on("input", ".contact", function() {
		var mobNum = $(this).val();
		var filter = /^\d*(?:\.\d{1,2})?$/;
        const $input = $(this);
        const $invalidContact = $input.closest('div').find('#mob-invalid');
        const $invalid_digitsContact = $input.closest('div').find('#mob-invalid_digits');

		if (filter.test(mobNum)) {
			if (mobNum.length == 10) {
				if(!$invalidContact.hasClass("hidden"))
                $invalidContact.addClass("hidden");
            $invalid_digitsContact.addClass("hidden");
			} else {
				//alert('Please put 10  digit mobile number');
			if(!$invalidContact.hasClass("hidden"))
			$invalidContact.addClass("hidden");
			$invalid_digitsContact.removeClass("hidden");
					return false;
			}
		} else {
			$invalidContact.removeClass("hidden");
      if(!$invalid_digitsContact.hasClass("hidden"))
          $invalid_digitsContact.addClass("hidden");
			return false;
		}
	});


    $(document).on('input',".gst-input", function() {    
    var inputvalues = $(this).val();
    var gstinformat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');
    const $input = $(this);
    const $invalid_gst = $input.closest('div').find('#invalid_gst');
    const $invalid_gst_length = $input.closest('div').find('#invalid_gst_length');
	if(inputvalues.length>0)
	{
		if (inputvalues.length == 15) {
		if (gstinformat.test(inputvalues)) {
			if(!$invalid_gst.hasClass("hidden"))			
				$invalid_gst.addClass("hidden");
			if(!$invalid_gst_length.hasClass("hidden"))
				$invalid_gst_length.addClass("hidden");
			return true;
			} 
		else {
			$invalid_gst.removeClass("hidden");
			if(!$invalid_gst_length.hasClass("hidden"))
				$invalid_gst_length.addClass("hidden");
			$(this).focus();
			return false;
			}             
		}
		else
		{
			$invalid_gst_length.removeClass("hidden");
				if(!$invalid_gst.hasClass("hidden"))			
					$invalid_gst.addClass("hidden");
			$(this).focus();
			return false;
		}
	}
	else{
		if(!$invalid_gst.hasClass("hidden"))			
				$invalid_gst.addClass("hidden");
		if(!$invalid_gst_length.hasClass("hidden"))
				$invalid_gst_length.addClass("hidden");
	}	
});


});

    // Function to enable or disable the required attribute for a field
    function toggleRequiredField($field, enable) {
        if (enable) {
            $field.prop('required', true);
        } else {
            $field.prop('required', false);
        }
    }

    // Function to switch tabs and update required fields
    function switchTab(tabId) {
        // Remove the 'active' class from all tabs
        $('.tabs li').removeClass('active');

        // Add the 'active' class to the selected tab
        $('#' + tabId).addClass('active');
            // Get the selected radio button value
            var isAgencySelected = $('input[name="is_agency"]:checked').val();
        // Enable required for fields based on the selected tab
        if (tabId === 'individual') {
           
            toggleRequiredField($('#business_full_name'), false);
            toggleRequiredField($('#business_email'), false);
            toggleRequiredField($('#business_contact_no'), false);
            toggleRequiredField($('#business_full_address'), false);

            toggleRequiredField($('#contact_person_name'), false);       
            toggleRequiredField($('#contact_person_email'), false);
            toggleRequiredField($('#contact_person_contact_no'), false);

            enableRequiredFieldsForAgency(isAgencySelected === '1'); // Enable agency fields if 'YES' is selected

        } else if (tabId === 'organisation') {  
           
            toggleRequiredField($('#business_full_name'), true);
            toggleRequiredField($('#business_email'), true);
            toggleRequiredField($('#business_contact_no'), true);
            toggleRequiredField($('#business_full_address'), true);

            toggleRequiredField($('#contact_person_name'), true);       
            toggleRequiredField($('#contact_person_email'), true);
            toggleRequiredField($('#contact_person_contact_no'), true);
            
            enableRequiredFieldsForAgency(isAgencySelected === '1'); // Enable agency fields if 'YES' is selected
        }
    }

    // Listen for tab clicks
    $('.tabs li').click(function() {
        var selectedTab = $(this).attr('data-tab');
        switchTab(selectedTab);
    });

    // Initialize with the default tab
    switchTab('individual');

        // Add a change event listener to the radio buttons
        $('input[name="is_agency"]').change(function() {

                        // Get the selected radio button value
                        var isAgencySelected = $(this).val();
                        enableRequiredFieldsForAgency(isAgencySelected === '1'); // Enable agency fields if 'YES' is selected
                        // Define an array of block IDs to validate

                if (isAgencySelected === '0') {
                    $('#agencyInformationBlock .required-field').each(function () {
                        var $input = $(this);
                        var $validationMessage = $input.closest('.input-flex-item').find('.validation-message'); // Assuming the validation message is a sibling element
                            $validationMessage.addClass('hidden'); // Hide the validation message
                            
                          });
                        }
         });



    function enableRequiredFieldsForAgency(enable) {
    toggleRequiredField($('#agency_full_name'), enable);
    toggleRequiredField($('#agency_email'), enable);
    toggleRequiredField($('#agency_full_address'), enable);
    toggleRequiredField($('#agency_contact_no'), enable);
}

 // Function to validate GST format (customize as needed)
 function isValidGSTListener(value) {
        // Add your GST validation logic here
        // For example, check if it matches a specific pattern
        // Return true for valid, false for invalid
        return /^[A-Z]{5}\d{4}[A-Z]{1}[1-9A-Z]{1}[Z]{1}[A-Z\d]{1}$/.test(value);
    }


});

// JavaScript for validation

</script>
