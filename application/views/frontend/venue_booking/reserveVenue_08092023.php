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
                                        <?php for($i=1;$i<11;$i++){ $isAvailable = !in_array($i - 1, array_column($dayDiff, 'day_difference'));?>
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
                                        <?php } ?>
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
                            <form action="#" class="custom-form mt-3" id="bookingForm" autocomplete="off">
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
                                                    <label class="label-title"> Full Name<span class="asterisk"> *</span> </label>
                                                    <input class="form-control" type="text" name="indivisual_full_name"  id="indivisual_full_name" placeholder="Type Full Name" required>
                                                </div>
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> e-mail ID <span class="asterisk"> *</span></label>
                                                    <input class="form-control" type="email" name="indivisual_email" id="indivisual_email" placeholder="Type Email-ID" required>
                                                </div>
                                            </div>
                                            <div class="input-flex-item">
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> Contact No.<span class="asterisk"> *</span> </label>
                                                    <input class="form-control contact" type="text" name="indivisual_contact_no" id="indivisual_contact_no" placeholder="Type Contact No" maxlength="10" required>
                                                    <div class="invalid-feedback">
                                                    <span class="text-danger"> Please enter a valid 10-digit contact number.</span>
                                                    </div>
                                                </div>
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> Full Address with Pincode <span class="asterisk"> *</span></label>
                                                    <input class="form-control" type="text" name="indivisual_full_address" id="indivisual_full_address" placeholder="Type Full Address" required>
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
                                                    <label class="label-title"> Name<span class="asterisk"> *</span> </label>
                                                    <input class="form-control" type="text" name="business_full_name" id="business_full_name" placeholder="Type Full Name" required>
                                                </div>
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> e-mail ID<span class="asterisk"> *</span> </label>
                                                    <input class="form-control" type="email" name="business_email"  id="business_email" placeholder="Type Email-ID" required>
                                                </div>
                                            </div>
                                            <div class="input-flex-item">
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> Contact No.<span class="asterisk"> *</span> </label>
                                                    <input class="form-control contact" type="text" name="business_contact_no" id="business_contact_no" placeholder="Type Contact No"  maxlength="10" required>
                                                    <div class="invalid-orgfeedback">
                                                    <span class="text-danger">Please enter a valid 10-digit contact number.</span>
                                                    </div>
                                                </div>
                                                <div class="single-input mt-3 gst-input-container">
                                                    <label class="label-title"> GSTIN </label>
                                                    <input class="form-control gst-input" type="text" name="business_gst_no" placeholder="Type GST No">
                                                    <div class="invalid-orgfeedback"><span class="text-danger">Invalid GST No. Please enter a valid GST No.</span></div>
                                                </div>
                                            </div>
                                            <div class="input-flex-item">
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> Full Address with Pincode<span class="asterisk"> *</span> </label>
                                                    <input class="form-control" type="text" name="business_full_address" id="business_full_address" placeholder="Type Full Address" required>
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
                                                    <label class="label-title">Name<span class="asterisk"> *</span> </label>
                                                    <input class="form-control" type="text" name="contact_person_name" id="contact_person_name" placeholder="Type Person Name" required>
                                                </div>
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> Designation </label>
                                                    <input class="form-control" type="text" name="contact_person_designation" placeholder="Type Designation">
                                                </div>
                                            </div>
                                            <div class="input-flex-item">
                                                <div class="single-input mt-3">
                                                    <label class="label-title"> e-mail ID<span class="asterisk"> *</span> </label>
                                                    <input class="form-control" type="email" name="contact_person_email" id="contact_person_email" placeholder="Type Person Email" required>
                                                </div>
                                                <div class="single-input mt-3">
                                                    <label class="label-title">Contant No. <span class="asterisk"> *</span></label>
                                                    <input class="form-control contact" type="text" name="contact_person_contact_no"  id="contact_person_contact_no" maxlength="10" placeholder="Type Contact No" required>
                                                    <div class="invalid-orgfeedback">
                                                    <span class="text-danger">Please enter a valid 10-digit contact number.</span>
                                                    </div>
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
                                                <label class="label-title"> Name <span class="asterisk"> *</span></label>
                                                <input class="form-control" type="text" name="agency_full_name" id="agency_full_name" placeholder="Type Full Name" required>
                                            </div>
                                            <div class="single-input mt-3">
                                                <label class="label-title">e-mail ID<span class="asterisk"> *</span></label>
                                                <input class="form-control" type="email" name="agency_email" id="agency_email" placeholder="Type Email ID" required>
                                            </div>
                                        </div>
                                        <div class="input-flex-item">
                                            <div class="single-input mt-3">
                                                <label class="label-title">Contact No. <span class="asterisk"> *</span></label>
                                                <input class="form-control contact" type="text" name="agency_contact_no" id="agency_contact_no" placeholder="Type Contact No" maxlength="10"  required>
                                                <div class="invalid-agencyfeedback">
                                                <span class="text-danger"> Please enter a valid 10-digit contact number.</span>
                                                </div>
                                            </div>
                                            <div class="single-input mt-3 gst-input-container">
                                                <label class="label-title"> GSTIN </label>
                                                <input class="form-control gst-input" type="text" name="agency_gst_no" placeholder="Type GST No">
                                                <div class="invalidt-agencyfeedback"><span class="text-danger">Invalid GST No. Please enter a valid GST No.</span></div>
                                            </div>
                                        </div>
                                        <div class="input-flex-item">
                                            <div class="single-input mt-3">
                                                <label class="label-title"> Full Address with Pincode <span class="asterisk"> *</span></label>
                                                <input class="form-control" type="text" name="agency_full_address" id="agency_full_address" placeholder="Type Full Address" required>
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

    $(document).on('click','#submit_request', function() {
        var contactInputs = $('.contact'); // Assuming this class is assigned to your contact number inputs
            var formValid = true; // Assume the form is valid by default
            // Get the selected tab
            var selectedTab = $('.tabs li.active').attr('data-tab');
             // Get the selected radio button value
                var isAgencySelected =  $('input[name="is_agency"]:checked').val();

            // Enable or disable required fields based on the selected tab and radio button value
            if (selectedTab === 'individual') {
            contactInputs.each(function () {
                var $input = $(this);
                var $invalidFeedback = $input.closest('div').find('.invalid-feedback');

                // Check if the input value matches the expected format of a 10-digit number
                var isValid = /^\d{10}$/.test($input.val());

                // Toggle the 'is-invalid' class and hide/show the invalid-feedback accordingly
                if (isValid) {
                    $input.removeClass('is-invalid');
                    $invalidFeedback.hide();
                } else {
                    $input.addClass('is-invalid');
                    $invalidFeedback.show();
                    formValid = false; // Set form validity to false if any input is invalid
                }
            });
        }

             // Enable or disable required fields based on the selected tab and radio button value
             if (selectedTab === 'organisation') {
            contactInputs.each(function () {
                var $input = $(this);
                var $invalidFeedback = $input.closest('div').find('.invalid-orgfeedback');

                // Check if the input value matches the expected format of a 10-digit number
                var isValid = /^\d{10}$/.test($input.val());

                // Toggle the 'is-invalid' class and hide/show the invalid-feedback accordingly
                if (isValid) {
                    $input.removeClass('is-invalid');
                    $invalidFeedback.hide();
                } else {
                    $input.addClass('is-invalid');
                    $invalidFeedback.show();
                    formValid = false; // Set form validity to false if any input is invalid
                }
            });

                   // Additional code for GST validation
        var gstInputs = $('.gst-input'); // Select all GST input fields
                gstInputs.each(function() {
                    var $input = $(this);
                    var gstValue = $input.val();

                    if(gstValue){
                    if (!validateGST(gstValue)) {
                        formValid = false;
                        // GST is invalid, add 'is-invalid' class and show feedback
                        $input.closest('.gst-input-container').addClass('is-invalid');
                        $input.closest('.gst-input-container').find('.invalid-orgfeedback').show();
                    }
                    else
                    {
                        $input.closest('.gst-input-container').removeClass('is-invalid');
                        $input.closest('.gst-input-container').find('.invalid-orgfeedback').hide();
                    }
                }
                else
                {
                    $input.closest('.gst-input-container').removeClass('is-invalid');
                        $input.closest('.gst-input-container').find('.invalid-orgfeedback').hide();
                }
                });
        }

        if(isAgencySelected==='1')
        {
                contactInputs.each(function () {
                var $input = $(this);
                var $invalidFeedback = $input.closest('div').find('.invalid-agencyfeedback');

                // Check if the input value matches the expected format of a 10-digit number
                var isValid = /^\d{10}$/.test($input.val());

                // Toggle the 'is-invalid' class and hide/show the invalid-feedback accordingly
                if (isValid) {
                    $input.removeClass('is-invalid');
                    $invalidFeedback.hide();
                } else {
                    $input.addClass('is-invalid');
                    $invalidFeedback.show();
                    formValid = false; // Set form validity to false if any input is invalid
                }
            });

                   // Additional code for GST validation
        var gstInputs = $('.gst-input'); // Select all GST input fields
                gstInputs.each(function() {
                    var $input = $(this);
                    var gstValue = $input.val();

                    if(gstValue){
                    if (!validateGST(gstValue)) {
                        formValid = false;
                        // GST is invalid, add 'is-invalid' class and show feedback
                        $input.closest('.gst-input-container').addClass('is-invalid');
                        $input.closest('.gst-input-container').find('.invalid-agencyfeedback').show();
                    }
                    else
                    {
                        $input.closest('.gst-input-container').removeClass('is-invalid');
                        $input.closest('.gst-input-container').find('.invalid-agencyfeedback').hide();
                    }
                }
                else
                {
                    $input.closest('.gst-input-container').removeClass('is-invalid');
                        $input.closest('.gst-input-container').find('.invalid-orgfeedback').hide();
                }
                });
            
        }
       
            if (!formValid) {
                // If any contact input is invalid, prevent form submission
                return;
            }
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
                        window.location.replace("<?= base_url('venue-bookings')?>");
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

});
   // Add an input event listener to contact input boxes
   $('.contact').on('input', function() {
                const contactNumber = $(this).val();
                 // Get the selected tab
          var selectedTab = $('.tabs li.active').attr('data-tab');
             // Get the selected radio button value
                var isAgencySelected =  $('input[name="is_agency"]:checked').val();

            // Enable or disable required fields based on the selected tab and radio button value
            if (selectedTab === 'individual') {
                var $invalidFeedback = $(this).closest('div').find('.invalid-feedback');
                const pattern = /^\d{10}$/;

                if (pattern.test(contactNumber)) {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $invalidFeedback.hide();

                } else {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                    $invalidFeedback.show();
                }
            }

               // Enable or disable required fields based on the selected tab and radio button value
               if (selectedTab === 'organisation') {
                var $invalidFeedback = $(this).closest('div').find('.invalid-orgfeedback');
                const pattern = /^\d{10}$/;

                if (pattern.test(contactNumber)) {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $invalidFeedback.hide();

                } else {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                    $invalidFeedback.show();
                }
            }

            if(isAgencySelected === '1')
                {
                    var $invalidFeedback = $(this).closest('div').find('.invalid-agencyfeedback');
                                const pattern = /^\d{10}$/;

                                if (pattern.test(contactNumber)) {
                                    $(this).removeClass('is-invalid').addClass('is-valid');
                                    $invalidFeedback.hide();

                                } else {
                                    $(this).removeClass('is-valid').addClass('is-invalid');
                                    $invalidFeedback.show();
                                }
                }
    });

     // Function to validate a GST number
     function validateGST(input) {
        var gstPattern = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;
        return gstPattern.test(input);
    }

     // Attach an input event listener to GST input fields
     $('.gst-input').on('input', function () {
        var $input = $(this);
          // Get the selected tab
          var selectedTab = $('.tabs li.active').attr('data-tab');
             // Get the selected radio button value
                var isAgencySelected =  $('input[name="is_agency"]:checked').val();

            // Enable or disable required fields based on the selected tab and radio button value
            if (selectedTab === 'organisation') {
        var $container = $input.closest('.gst-input-container');
        var $invalidFeedback = $container.find('.invalid-orgfeedback');
        var gstValue = $input.val();
        if(gstValue){
        if (validateGST(gstValue)) {
            // GST is valid, remove 'is-invalid' class and hide feedback
            $container.removeClass('is-invalid');
            $invalidFeedback.hide();
        } else {
            // GST is invalid, add 'is-invalid' class and show feedback
            $container.addClass('is-invalid');
            $invalidFeedback.show();
        }
    }
    else
    {
        // GST is valid, remove 'is-invalid' class and hide feedback
        $container.removeClass('is-invalid');
            $invalidFeedback.hide(); 
    }
}
if(isAgencySelected === '1')
{
    var $container = $input.closest('.gst-input-container');
        var $invalidFeedback = $container.find('.invalid-agencyfeedback');
        var gstValue = $input.val();
        if(gstValue){
        if (validateGST(gstValue)) {
            // GST is valid, remove 'is-invalid' class and hide feedback
            $container.removeClass('is-invalid');
            $invalidFeedback.hide();
        } else {
            // GST is invalid, add 'is-invalid' class and show feedback
            $container.addClass('is-invalid');
            $invalidFeedback.show();
        }
    }
    else
    {
        // GST is valid, remove 'is-invalid' class and hide feedback
        $container.removeClass('is-invalid');
            $invalidFeedback.hide(); 
    }

}
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
            toggleRequiredField($('#indivisual_full_name'), true);
            toggleRequiredField($('#indivisual_email'), true);
            toggleRequiredField($('#indivisual_contact_no'), true);
            toggleRequiredField($('#indivisual_full_address'), true);
           
            toggleRequiredField($('#business_full_name'), false);
            toggleRequiredField($('#business_email'), false);
            toggleRequiredField($('#business_contact_no'), false);
            toggleRequiredField($('#business_full_address'), false);

            toggleRequiredField($('#contact_person_name'), false);       
            toggleRequiredField($('#contact_person_email'), false);
            toggleRequiredField($('#contact_person_contact_no'), false);

            enableRequiredFieldsForAgency(isAgencySelected === '1'); // Enable agency fields if 'YES' is selected

        } else if (tabId === 'organization') {  
     
            toggleRequiredField($('#indivisual_full_name'), false);
            toggleRequiredField($('#indivisual_email'), false);
            toggleRequiredField($('#indivisual_contact_no'), false);
            toggleRequiredField($('#indivisual_full_address'), false);
           
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
        });



    function enableRequiredFieldsForAgency(enable) {
    toggleRequiredField($('#agency_full_name'), enable);
    toggleRequiredField($('#agency_email'), enable);
    toggleRequiredField($('#agency_full_address'), enable);
    toggleRequiredField($('#agency_contact_no'), enable);
}

});
</script>
