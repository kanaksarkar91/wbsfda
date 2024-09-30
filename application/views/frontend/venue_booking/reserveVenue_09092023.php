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
                                                while ($currentDate <= $endDate) {
                                                    $formattedDate = date('d-m-Y D', $currentDate);
                                                    $chkformattedDate = date('d-m-Y', $currentDate);
                                                    $isAvailable = !in_array(date('Y-m-d', $currentDate), array_column($dayDiff, 'day_difference'));?>
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
                                        <div>
                                            <h6 class="thm-txt fw-normal">Total Payable Amount will be :</h6>
                                            <h4 id="total_price_text" class="thm-txt-2 fw-bold">Rs. 0.00</h4>
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
                                    <a id="submit_request" type="button" href="#."  class="cmn-btn btn-bg-1"> SUBMIT REQUEST </a>
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
<script type="text/javascript">
    let total_price = 0; let date = []; let rate_id =[]; let prices = [];
    $( document ).ready(function() { 
        // Initially, disable the "Proceed" button
    $(document).on('change','.checkboxClass', function(){
        let date_data = ''; let set_selected_date = '';
        if(this.checked) {
            var sel_date_val=convertDateFormat(this.value);
            date.push(this.value);
            rate_id.push($(this).parent().parent().parent().find(".price_"+sel_date_val).data('rate_id'));
            prices.push($(this).parent().parent().parent().find(".price_"+sel_date_val).val());
            total_price = total_price + (+$(this).parent().parent().parent().find(".price_"+sel_date_val).val());
        }else{
            var sel_date_val=convertDateFormat(this.value);

            //date.pop(this.value);
            date.splice(date.indexOf(this.value), 1);
            rate_id.splice(rate_id.indexOf($(this).parent().parent().parent().find(".price_"+sel_date_val).data('rate_id')), 1);
            prices.splice(prices.indexOf($(this).parent().parent().parent().find(".price_"+sel_date_val).val()), 1);
            total_price = total_price - (+$(this).parent().parent().parent().find(".price_"+sel_date_val).val());
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
                // Check GST input fields
                $('.gst-input').each(function () {
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

                if(!form_valid)
                    return false;


        $('#bookingsuccessModal').modal('show'); false;
        $('#booking_id').text('');
        var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";
        // Get the currently active tab with the "active" class
        var selectedTab = $('.tabs li.active');
        var rate_id=<?= $venues[0]->rate_id ?>;
        // Get the data-tab attribute of the selected tab
        var selectedTabValue = selectedTab.attr('data-tab');
        let data = {
            date: date,
            total_price: total_price,
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
