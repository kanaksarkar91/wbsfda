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
.hidden{
    display:none;
}

</style>

<style type="">
    :root {
    --main-color-one: #00bdd6;
    --main-color-one-rgb: 0, 189, 214;
    --input-color: #EAECF0;
    }
    .accordion {
    border: 1px solid #e2e6ea;
    border-radius: 4px;
    }
    .accordion-item:first-of-type {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}
.accordion-item:last-of-type {
    border-bottom-right-radius: 15px;
    border-bottom-left-radius: 15px;
}
.accordion-item:not(:first-of-type) {
    border-top: 0;
}
.accordion-item {
    border: 1px solid rgba(0, 0, 0, 0);
    margin-bottom: 5px;
}
.shadow-sm {
    box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075)!important;
}
.accordion-item {
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, .125);
}
.accordion-button {
    font-size: 1.3rem;
    text-align: left;
    background-color: rgba(var(--main-color-one-rgb), 0.1);
    color: var(--main-color-one);
}
.accordion-button:not(.collapsed) {
    background-color: #1e787c;
    color: #fff;
    box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .125);
}
.accordion-button:not(.collapsed)::after {
    filter: brightness(20);
}
.accordion-button::after {
    filter: saturate(288);
}
.checkbox-inline .check-input:checked {
    background: var(--main-color-one);
    border-color: var(--main-color-one);
    background: var(--main-color-one);
}
.checkbox-inline .check-input {
    height: 18px;
    width: 18px;
    background: #fff;
    border: 1px solid #000;
    border-radius: 0;
}
.selected-reservation-date .reservation-dates {
    padding: 0;
    margin-top: 10px;
}
.details-tab-border {
    border-bottom: 1px solid var(--input-color);
    margin-top: 15px;
}
.tabs {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    gap: 10px;
    list-style: none;
    /* margin: 0; */
    padding: 0;
}

.details-tab li:not(:last-child) {
    margin-right: 20px;
}
.details-tab li {
    position: relative;
    margin-left: 20px;
    padding-bottom: 15px;
    font-weight: 600;
    color: #000;
}
.tabs li {
    font-size: 16px;
    line-height: 28px;
    cursor: pointer;
    -webkit-transition: 300ms;
    transition: 300ms;
}
.details-tab li.active::before {
    width: 100%;
    visibility: visible;
    opacity: 1;
}
.details-tab li::before {
    content: "";
    position: absolute;
    width: 0%;
    height: 2px;
    bottom: -2px;
    left: 0;
    background-color: var(--main-color-one);
    -webkit-transition: .3s;
    transition: .3s;
    visibility: hidden;
    opacity: 0;
}
.details-contents-tab .tab-content-item {
    padding: 20px;
}
.tab-content-item {
    display: none;
}
.tab-content-item.active {
    display: block;
    -webkit-animation: 1s fade-effects;
    animation: 1s fade-effects;
}
@-webkit-keyframes fade-effects {
    0% {
        opacity: 0;
        -webkit-transform: translateY(-20px);
        transform: translateY(-20px)
    }
    100% {
        opacity: 1;
        -webkit-transform: translateY(0px);
        transform: translateY(0px)
    }
}

@keyframes fade-effects {
    0% {
        opacity: 0;
        -webkit-transform: translateY(-20px);
        transform: translateY(-20px)
    }
    100% {
        opacity: 1;
        -webkit-transform: translateY(0px);
        transform: translateY(0px)
    }
}
</style>

<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Reserve Venue</h1>
            </div>
            <!-- <div class="col-auto">
                
            </div> -->
        </div>

        <div class="row g-3">
            <div class="col-xl-8 col-lg-7">
                <div class="app-card app-card-settings shadow-sm p-3">
                    <h4 class="mb-3"> <?=$venues[0]->venue_names?> </h4>
                    <div class="accordion border-0" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item shadow-sm">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                            <i class="fa fa-calendar me-3 fs-4"></i> Please submit your Reservation Request
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body border-0 bg-white p-2">
                                        <table class="table table-borderless table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th width="<?php if($venues[0]->is_multiple_venues == '0' && $venues[0]->single_venue_id == '11'){ echo '15%'; } else { echo '20%'; }?>" class="text-center">Please Select</th>
                                                        <th width="<?php if($venues[0]->is_multiple_venues == '0' && $venues[0]->single_venue_id == '11'){ echo '20%'; } else { echo '25%'; }?>" class="text-center">Date</th>
                                                        <th width="<?php if($venues[0]->is_multiple_venues == '0' && $venues[0]->single_venue_id == '11'){ echo '15%'; } else { echo '23%'; }?>" class="text-center">Status</th>
                                                        <th width="<?php if($venues[0]->is_multiple_venues == '0' && $venues[0]->single_venue_id == '11'){ echo '25%'; } else { echo '32%'; }?>" class="text-center"><?=($venues[0]->is_hourly_booking_rate==1 )?$venues[0]->booking_hours_rate.' Hours in a Day':' Price Per Calender Day'?></th>

                                                        <?php if($venues[0]->is_multiple_venues == '0' && $venues[0]->single_venue_id == '11'){ ?>

                                                            <th width="25%" class="text-center">Select Additional Hours</th>

                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="<?php if($venues[0]->is_multiple_venues == '0' && $venues[0]->single_venue_id == '11'){ echo '5'; } else { echo '4'; } ?>" class="p-0">
                                                            <div style="height:auto; max-height:225px; overflow-y: scroll;">
                                                                <table class="table table-borderless table-responsive table-hover shadow-none mb-0">
                                                                    <tr>
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
                                                            $chkformattedDate=date('d-m-Y',$currentDate);
                                                            // Get the number of days
                                                            $dayDifference = $interval->days;
        
                                                            $isAvailable = !in_array( $dayDifference, array_column($dayDiff, 'day_difference'));
                                                        }?>
                                                            <tr class="mainParent">
                                                            <td width="<?php if($venues[0]->is_multiple_venues == '0' && $venues[0]->single_venue_id == '11'){ echo '15%'; } else { echo '20%'; }?>" class="text-center">
                                                                <div class="checkbox-inline">
                                                                    <?php if($isAvailable){?>
                                                                    <input class="check-input checkboxClass" type="checkbox" id="agree" value="<?= $chkformattedDate;?>">
                                                                    <?php } ?>                                              
                                                                </div>
                                                            </td>
                                                            <td width="<?php if($venues[0]->is_multiple_venues == '0' && $venues[0]->single_venue_id == '11'){ echo '20%'; } else { echo '25%'; }?>" class="text-center"><?= $formattedDate;?></td>
                                                            <td width="<?php if($venues[0]->is_multiple_venues == '0' && $venues[0]->single_venue_id == '11'){ echo '15%'; } else { echo '25%'; }?>" class="text-center"><span class="<?= $isAvailable  ? 'bg-success' : 'bg-secondary'; ?> p-1 rounded text-white"><?= $isAvailable ? 'Available' : 'Not-Available'; ?></span></td>
                                                            <td width="<?php if($venues[0]->is_multiple_venues == '0' && $venues[0]->single_venue_id == '11'){ echo '25%'; } else { echo '30%'; }?>" class="text-center">₹ <?= number_format($venues[0]->{strtolower(date('D', $currentDate)) . '_price'}, 2, ".", ",") ;?>

                                                            <?php if($venues[0]->is_multiple_venues == '0' && $venues[0]->single_venue_id == '11'){ ?>

                                                                <td width="25%" class="text-center">
                                                                    <select class="extra_hours_<?= date('dmY',$currentDate)?> extraDrop" disabled>
                                                                        <option value="0">Select Hours</option>
                                                                        <?php if(!empty($extra_hours)){ ?>

                                                                            <?php foreach($extra_hours as $hours){ ?>

                                                                                <option value="<?= $hours['hours']; ?>"><?= $hours['hours']; ?></option>

                                                                            <?php } ?>

                                                                        <?php } ?>
                                                                    </select>
                                                                </td>

                                                            <?php } ?>

                                                            <input type="hidden" class="price_<?= date('dmY',$currentDate)?>" data-rate_id = "<?= $venues[0]->rate_id?>" value="<?= $venues[0]->{strtolower(date('D', $currentDate)) . '_price'}?>" >
                                                            
                                                            </td>
                                                        </tr>
                                                <?php $currentDate = strtotime('+1 day', $currentDate);
                                                $i++;
                                            } ?>  
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                
                                            </tbody>
                                        </table>

                                        <div class="selected-reservation-date">
                                            <h6 class="thm-txt fw-normal">You have selected this venue for reservation on :</h6>
                                            <ul class="reservation-dates list-unstyled">
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

                                                <!--<div>
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
                                                </div>-->
                                            </div>
                                                <div class="btn-wrapper w-100 text-center">
                                                        <button type="button" class="btn app-btn-primary rounded-0 w-100 text-uppercase" data-toggle="modal" data-target="#bookingModal" id="proceed" disabled="disabled">Proceed</button>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div id="bookingSection" class="accordion-item shadow-sm">
                                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                        <i class="fa fa-user-circle-o me-3 fs-4"></i> 
                                        <div class="d-flex flex-column">
                                            <span>Reservation to be done for</span>
                                            <span class="fs-6 fw-normal">(After final payment the Tax Invoice will be generated according to the details given hereunder)</span>
                                        </div>
                                    </button>                                    
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                    <div class="accordion-body border-0 bg-white p-2">
                                        <div id="bookingSection">
                                            <form action="#" class="custom-form" id="bookingForm" autocomplete="off"  method="post">
                                                    <input type="hidden" class="form-control" name="user_id" value="<?= $customer_details['customer_id'] ?>">
                                                <!--<h6 class="thm-txt fw-normal mb-3"> Reservation to be done for </h6> -->
                                                <div class="details-contents-tab">
                                                    <div class="input-flex-item">
                                                        <div class="single-input mt-6">
                                                            <label for="cust" class="label-title">Select Customer </label>
                                                            <select class="form-select select2" id="customer_id" name="customer_id">
                                                                <option value="">Search with Customer Name or Contact No</option>
                                                                <option value="0">Add New Customer</option>
                                                                <?php if (!empty($customer_list)) { ?>
                                                                    <?php foreach ($customer_list as $customer) { ?>
                                                                        <option value="<?= $customer['customer_id']; ?>" data-customer_data='<?= json_encode($customer) ?>'><?= $customer['first_name']  . ' - ' . $customer['mobile'] ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <ul class="tabs details-tab details-tab-border">
                                                        <li class="active" data-tab="individual" style="margin-left: 0;"> Individual </li>
                                                        <li data-tab="organisation" style="margin-left: 0;"> Organisation </li>
                                                    </ul>
                                                    <div id="individual" class="tab-content-item p-0 active">
                                                        <div class="row">
                                                            <div class="col-md-6 mt-3">
                                                                <label class="label-title">Name <span class="asterisk text-danger"> *</span></label>
                                                                <input class="form-control required-field" type="text" name="indivisual_full_name"  id="indivisual_full_name" placeholder="Type Full Name" required>
                                                                <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                            </div>
                                                            <div class="col-md-6 mt-3">
                                                                <label class="label-title"> e-mail ID <span class="asterisk text-danger"> *</span> </label>
                                                                <input class="form-control required-field" type="email" name="indivisual_email" id="indivisual_email" placeholder="Type Email-ID" required>
                                                                <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mt-3">
                                                                <label class="label-title"> Contact No. <span class="asterisk text-danger"> *</span> </label>
                                                                <input class="form-control required-field contact" type="text" name="indivisual_contact_no" id="indivisual_contact_no" placeholder="Type Contact No" required>
                                                                <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                                <span id="mob-invalid" class="hidden small text-danger">
                                                                    You have entered an Invalid Mobile Number
                                                                </span>
                                                                <span id="mob-invalid_digits" class="hidden small text-danger">
                                                                Please enter 10 digits Mobile Number
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 mt-3">
                                                                <label class="label-title"> Full Address with Pincode <span class="asterisk text-danger"> *</span></label>
                                                                <input class="form-control required-field" type="text" name="indivisual_full_address" id="indivisual_full_address" placeholder="Type Full Address" required>
                                                                <span class="validation-message text-danger hidden">Please enter the input field.</span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="organisation" class="tab-content-item p-0">
                                                        <div class="row">
                                                            <div class="col-md-6 mt-3">
                                                                <label class="label-title"> Name<span class="asterisk text-danger"> *</span> </label>
                                                                <input class="form-control required-field" type="text" name="business_full_name" id="business_full_name" placeholder="Type Full Name" required>
                                                                <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                            </div>
                                                            <div class="col-md-6 mt-3">
                                                                <label class="label-title"> e-mail ID<span class="asterisk text-danger"> *</span> </label>
                                                                <input class="form-control required-field" type="email" name="business_email"  id="business_email" placeholder="Type Email-ID" required>
                                                                <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mt-3">
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
                                                            <div class="col-md-6 mt-3 gst-input-container">
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
                                                        <div class="row">
                                                            <div class="col-md-12 mt-3">
                                                                <label class="label-title"> Full Address with Pincode<span class="asterisk text-danger"> *</span> </label>
                                                                <input class="form-control required-field" type="text" name="business_full_address" id="business_full_address" placeholder="Type Full Address" required>
                                                                <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3"><small class="fw-bold thm-txt-2">Details of the contact person on behalf of the organisation:</small></div>
                                                        <div class="row">
                                                            <div class="col-md-6 mt-3">
                                                                <label class="label-title">Name<span class="asterisk text-danger"> *</span> </label>
                                                                <input class="form-control required-field" type="text" name="contact_person_name" id="contact_person_name" placeholder="Type Person Name" required>
                                                                <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                            </div>
                                                            <div class="col-md-6 mt-3">
                                                                <label class="label-title"> Designation </label>
                                                                <input class="form-control" type="text" name="contact_person_designation" placeholder="Type Designation">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mt-3">
                                                                <label class="label-title"> e-mail ID<span class="asterisk text-danger"> *</span> </label>
                                                                <input class="form-control required-field" type="email" name="contact_person_email" id="contact_person_email" placeholder="Type Person Email" required>
                                                                <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                            </div>
                                                            <div class="col-md-6 mt-3">
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
                                                  
                                                 <!--<div class="d-flex align-items-center">
                                                    <h6 class="thm-txt fw-normal me-3"> Is the booking request initiated by a third-party agency ? </h6>
                                                    <div class="custom-radio custom-radio-inline d-flex align-items-center">
                                                        <div class="custom-radio-single me-3 active">
                                                            <input class="radio-input" type="radio" id="radio1" value='1' name="is_agency">
                                                            <label for="radio1" class="mb-0">YES</label>
                                                        </div>
                                                        <div class="custom-radio-single">
                                                            <input class="radio-input" type="radio" id="radio2" value='0' name="is_agency" checked="checked">
                                                            <label for="radio2" class="mb-0">NO</label>
                                                        </div>
                                                    </div>
                                                </div>
                                               <div id="agencyInformationBlock" class="mb-3">
                                                    <small class="fw-bold thm-txt-2">Add Agency Information:</small>
                                                    <div class="row">
                                                        <div class="col-md-6 mt-3">
                                                            <label class="label-title"> Name <span class="asterisk text-danger"> *</span></label>
                                                            <input class="form-control required-field" type="text" name="agency_full_name" id="agency_full_name" placeholder="Type Full Name" required>
                                                            <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                        </div>
                                                        <div class="col-md-6 mt-3">
                                                            <label class="label-title">e-mail ID<span class="asterisk text-danger"> *</span></label>
                                                            <input class="form-control required-field" type="email" name="agency_email" id="agency_email" placeholder="Type Email ID" required>
                                                            <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mt-3">
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
                                                        <div class="col-md-6 mt-3 gst-input-container">
                                                            <label class="label-title"> GSTIN </label>
                                                            <input class="form-control gst-input" type="text" name="agency_gst_no" placeholder="Type GST No">
                                                            <span id="invalid_gst" class="hidden small text-danger">Please Enter Valid GSTIN Number</span>
                                                        <span id="invalid_gst_length" class="hidden small text-danger">Please enter valid 15 digits GSTIN Number</span>                                            
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 t mt-3">
                                                            <label class="label-title"> Full Address with Pincode <span class="asterisk text-danger"> *</span></label>
                                                            <input class="form-control required-field" type="text" name="agency_full_address" id="agency_full_address" placeholder="Type Full Address" required>
                                                            <span class="validation-message text-danger hidden">Please enter the input field.</span>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                <div class="btn-wrapper text-center mt-3">
                                                    <a id="submit_request" type="button" href="#."  class="btn app-btn-primary rounded-0 w-100"> SUBMIT REQUEST </a>
                                                </div>
                                            </form>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item shadow-sm">
                                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                        <i class="fa fa-money me-3 fs-4"></i> Payment Details
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                    <div class="accordion-body border-0 bg-white p-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="thm-txt fw-normal">Total Amount :</h6>
                                                <h4 id="total_price_text" class="thm-txt-2 fw-bold">₹0.00</h4>
                                                </div>
                                            <div>
                                                <h6 class="thm-txt fw-normal"> GST Amount :</h6>
                                                <h4 id="gst_amount" class="thm-txt-2 fw-bold">₹0.00</h4>
                                                </div>
                                            <div>       
                                                <h6 class="thm-txt fw-normal">Total Payable Amount :</h6>
                                                <h4 id="net_amount" class="thm-txt-2 fw-bold">₹0.00</h4>
                                            </div>
                                        </div>
                                        <div class="mt-3 alert alert-primary p-2 notes" role="alert">
                                            <ul class="small mb-0 ps-3">
                                                <li>Minimum <b><span class="percForInputAdvPay"></span></b> of the Total Payable Amount i.e. <b><span class="advAmt"></span></b> is required to be paid in Advance to reserve the venue. </li>
                                                <li>The rest amount (if any) is required to be paid on or before <b><span class="nod"></span></b> of the date/first date of your booking as applicable. </li>
                                                <li>GST Invoice will be provided only upon payment of the Total Payable Amount in full.</li>
                                            </ul>
                                            <!-- <span>Please write the amount you want to pay as advance for this booking.</span> -->
                                        </div>

                                        <p class="mb-2">Type Discount Percentage(%) or Discount Amount below</p>
                                        <div class="d-flex">
                                            <div class="flex-fill input-group" id="">
                                                <span class="input-group-text rounded-0" id="">Percent(%)</span>
                                                <input type="text" class="form-control rounded-0" id="disc_perc" value="">
                                                <span class="input-group-text rounded-0" id="">Discount Amount</span>
                                                <input type="text" class="form-control rounded-0" id="disc_amt" value="" readonly>
                                            </div>
                                            <!--<div class="flex-fill w-25">
                                                <button class="btn w-100 btn-success rounded-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGSTchart" aria-expanded="false" aria-controls="collapseGSTchart">ADD DISCOUNT</button>
                                            </div>-->
                                        </div>
                                        <span class="invalid-feedback-discperc text-danger" style="display:block;"></span>

                                        <!--<div class="collapse" id="collapseGSTchart">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered align-middle">
                                                    <thead class="small">
                                                        <tr class="table-info">
                                                            <th rowspan="2">Selectd Date</th>
                                                            <th rowspan="2">Rack Rate / Amount before Discount </th>
                                                            <th colspan="2">Discount</th>
                                                            <th rowspan="2">Amount after Discount / Amount before GST / Base or Basic Parice</th>
                                                            <th rowspan="2">GST Rate</th>
                                                            <th colspan="2">CGST</th>
                                                            <th colspan="2">SGST</th>
                                                            <th rowspan="2">GST Amount</th>
                                                            <th rowspan="2">Price After GST</th>
                                                        </tr>
                                                        <tr class="table-info">
                                                            <th>Percent(%)</th>
                                                            <th>Amount</th>
                                                            <th>Rate</th>
                                                            <th>Amount</th>
                                                            <th>Rate</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="small" id="tableDiscountBody">
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>-->
                                        <div class="mt-3">
                                            <p class="text-dark textForInputAdvPay"></p>
                                            <div class="d-flex">
                                                <div class="flex-fill input-group me-2" id="advanceAmountInput">
                                                    <input type="hidden" id="advperc" value="">
                                                    <input type="hidden" id="noOfDaysThreshold" value="">
                                                    <span class="input-group-text" id="">₹</span>
                                                    <input type="text" class="form-control" id="advanceAmount" value="">
                                                    <span class="invalid-feedback" style="display:block;"></span>
                                                </div>
                                                <!--<div class="flex-fill w-100"><button class="btn w-100 app-btn-primary rounded-0 pay_now" type="button">SUBMIT</button></div>-->
                                                <button class="btn w-100 app-btn-primary rounded-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMakePayment" aria-expanded="false" aria-controls="collapseMakePayment">
                                                    Make Payment
                                                </button>
                                            </div>

                                            <div class="collapse" id="collapseMakePayment">
                                                <form id="booking_payment_form" class="settings-form" method="post" enctype="multipart/form-data" autocomplete="off">

                                                    <table class="mb-3 w-100 table-sm table table-bordered">
                                                        <tr>
                                                            <th>Money Receipt No<span class="asterisk"> *</span></th>
                                                            <th>Receipt Date<span class="asterisk"> *</span></th>
                                                            <th>Select Payment Mode<span class="asterisk"> *</span></th>
                                                            <th colspan="2">Remarks<span class="asterisk"></span></th>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                <input type="text" class="form-control" id="receipt_no" name="receipt_no" required="">
                                                                <span class="receipt_no_error" style="color: #CC0000;"></span>
                                                            </td>
                                                            <td width="25%">
                                                                <input type="date" class="form-control" id="payment_date" name="payment_date" min="<?= date('Y-m-d') ?>" required="">
                                                                <span class="payment_date_error" style="color: #CC0000;"></span>
                                                            </td>
                                                            <td width="25%">
                                                                <select class="form-select" id="payment_mode_admin" name="payment_mode_admin">
                                                                    <option value="Cash">Cash</option>
                                                                    <option value="Cheque">Cheque</option>
                                                                    <!--<option value="Bank Transfer">Bank Transfer</option>                                                
                                                                    <option value="EDC">EDC</option>-->
                                                                    <option value="Standalone EDC">Standalone EDC</option>
                                                                    <!--<option value="UPI">UPI</option>-->
                                                                    <!--<option value="Adjustment">Adjustment</option>-->
                                                                </select>
                                                            </td>
                                                            <td width="25%">
                                                                <textarea class="form-control" id="admin_remarks" name="remarks_admin"></textarea>
                                                            </td>
                                                            <td class="text-end">
                                                                <!--<button class="btn app-btn-primary paymentSubmit" type="button">Submit</button>-->
                                                                <div class="flex-fill w-100"><button class="btn w-100 app-btn-primary rounded-0 pay_now" type="button">SUBMIT</button></div>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </form>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="app-card app-card-settings shadow-sm">
                <?php if(isset($venues)){?>

                
                    <img src="<?=base_url('/public/admin_images/').$venues[0]->image1?>" alt="img" class="img-fluid d-block mx-auto rounded p-3">                    
                        <ul class="list-unstyled px-3">
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-map-marker"></i> </span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Location:</span> <?=$venues[0]->property_name?> </span>
                            </li>
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-street-view"></i> </span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Address:</span> <?=$venues[0]->property_address_line_1?> </span>
                            </li>
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-phone"></i> </span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Contact No.:</span> <?=$venues[0]->property_phone_no?> </span>
                            </li>
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-envelope-o"></i> </span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">e-mail ID:</span> <?=$venues[0]->property_email?> </span>
                            </li>
                            <?php if($venues[0]->approx_capacity) {?>
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-users"></i> </span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Approx Capacity:</span> <?=$venues[0]->approx_capacity?></span>
                            </li>
                            <?php }?>
                            <?php if($venues[0]->available_timming) {?>
                            <li class="hotel-view-contents-location mt-2">
                                <span class="hotel-view-contents-location-icon"> <i class="fa fa-clock-o"></i> </span>
                                <span class="hotel-view-contents-location-para"> <span class="text-dark fw-bold">Available Timming:</span> <?=$venues[0]->available_timming?></span>
                            </li>
                            <?php }?>
                        </ul>
                    <div class="p-2 mt-3" style="background: #000;"><h5 class="text-white mb-0">Booking Details</h5></div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Total Amount : <span id="total_price_text_booking" class="h6">₹0.00</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">GST Amount : <span id="gst_amount_booking" class="h6">₹0.00</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center totalprice">Payble Amount <span id="net_amount_booking" class="fs-4">₹0.00</span></li>                            
                        </ul>

                        <input type="hidden" class="hidden_total">
                        <input type="hidden" class="hidden_total_hour">

                        <?php if($venues[0]->is_multiple_venues == '0' && $venues[0]->single_venue_id == '11'){ ?>
                            <input type="hidden" class="hidden_extra" value="1">
                        <?php } else { ?>
                            <input type="hidden" class="hidden_extra" value="0">
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


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
<div id="add_modal" class="modal fade show" tabindex="-1" aria-modal="true" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 style="font-size: 24px;color: #4caf50;"><i class="fa fa-folder"></i> Booking Confirmation</h3>
      </div>
      <div class="modal-body">
       <p></p><span id="modal_msg"></span><p></p>
      </div>
      <div class="modal-footer">
        <a id="redirect_link" href="" class="btn app-btn-primary" data-dismiss="modal"> Ok</a>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).on('click', 'ul.tabs li', function() {
            var tab_id = $(this).attr('data-tab');
            $('ul.tabs li').removeClass('active');
            $('.tab-content-item').removeClass('active');
            $(this).addClass('active');
            $("#" + tab_id).addClass('active');
        });
    let total_price = 0; let date = []; let rate_id =[]; let prices = [];let gst_amt = 0;let net_amt = 0;let net_amount=0;let is_advance_pay=false;let advanced_amount=0;
    let data_arr=[];let gst_perc_each=0;let cgst_each=0;let sgst_each=0;let igst_each=0; let total_extra_hour =0; //let extra_hr_rate = [];
    $( document ).ready(function() { 
        // Initially, disable the "Proceed" button
    $(document).on('change','.checkboxClass', function(){
        let date_data = ''; let set_selected_date = '';
        var sel_date_val=convertDateFormat(this.value);
        var is_checked=this.checked;

        var tHis = $(this);        

        var checkedCheckboxes = $(".checkboxClass:checked");

        if(this.checked) {

            //alert($(this).closest('tr').attr('class'));

            $(this).closest('tr').find('.extraDrop').prop('disabled', false);

            $('.extraDrop').val('0');

            var date_curr=this.value;
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
            
            var price_curr=$(this).parent().parent().parent().find(".price_" + sel_date_val).val();
            var rate_curr=$(this).parent().parent().parent().find(".price_"+sel_date_val).data('rate_id');   

            //alert(total_price);
            //alert(price_curr);
            //alert(rate_curr);

            calculateGSTAmount($(this).parent().parent().parent().find(".price_"+sel_date_val).val(),total_price, function() {
            updateUIElement(total_price,total_extra_hour);
            data_arr_bind(is_checked,date_curr,price_curr,rate_curr,gst_perc_each,cgst_each,sgst_each,igst_each);         
            }, function(error) {
                // Error Callback
                console.error('Error calculating GST amount:', error);
            });
        }else{

            if (checkedCheckboxes.length > 0) {

                //alert('unchecked');
                $(this).closest('tr').find('.extraDrop').val('0').prop('disabled', true);

                $('.extraDrop').val('0');

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
                
                calculateGSTAmount($(this).parent().parent().parent().find(".price_"+sel_date_val).val(),total_price, function() {
                updateUIElement(total_price,total_extra_hour);         
                data_arr_bind(is_checked,sel_date_val,$(this).parent().parent().parent().find(".price_" + sel_date_val).val(),$(this).parent().parent().parent().find(".price_" + sel_date_val).data('rate_id'),gst_perc_each,cgst_each,sgst_each,igst_each);         
                }, function(error) {
                    // Error Callback
                    console.error('Error calculating GST amount:', error);
                });

            } else {

                alert('Sorry! You cannot de-select the current selection as consecutive dates are required.');

                $(this).prop('checked', true)

            }

        }
      
    });


    //Extra Hour Calculation
    $(document).on('change','.extraDrop', function(){   

        var date_curr = $(this).closest('tr').find('.checkboxClass').val();

        var sel_date_val=convertDateFormat(date_curr);
        var is_checked=$(this).closest('tr').find('.checkboxClass').is(':checked');

        var price_curr = $(this).closest('tr').find(".price_" + sel_date_val).val();
        var rate_curr = $(this).closest('tr').find(".price_"+sel_date_val).data('rate_id');

        var extra_hr_curr = $(this).val();

        //alert(extra_hr_curr);

        var finalRatehour = calculateextraSum();
        var finalRate = (finalRatehour * 1000) + total_price;   

        calculateGSTAmount($(this).parent().parent().parent().find(".price_"+sel_date_val).val(),finalRate, function() {
        updateUIElement(finalRate,finalRatehour);
        data_arr_bind(is_checked,date_curr,price_curr,rate_curr,gst_perc_each,cgst_each,sgst_each,igst_each,extra_hr_curr);         
        }, function(error) {
        // Error Callback
        console.error('Error calculating GST amount:', error);
        });               

    }); 


    function calculateextraSum() {

      var sum = 0;
      $('.extraDrop').each(function() {
        var value = parseFloat($(this).val()) || 0;
        sum += value;
      });

      return sum;
      
    }

function updateUIElement(total_price,total_extra_hour)
{
    let date_data = ''; let set_selected_date = '';

    console.log('date : ', date);
        console.log('total : ', total_price);
        console.log('rate_id : ', rate_id);
        console.log('prices : ', prices);
        if (isNaN(total_price)) {
        // It's not a number (NaN)
        total_price=0;
        } 
        $('#total_price').val(total_price);
        $('#total_price_text').text('₹'+total_price.toFixed(2));
        $('#total_price_text_booking').text('₹'+total_price.toFixed(2));

        $('.hidden_total').val(total_price);
        $('.hidden_total_hour').val(total_extra_hour);

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
        $('#total_rent').text('₹'+total_price.toFixed(2));

        if(date.length > 0 && total_price > 0) {
            $('#proceed').prop('disabled', false);
        }else{
            alert('Please select available date to continue venue reservation process.');
            //$("#bookingSection").hide();
            // Remove data-bs-toggle attribute to disable collapse
            $('#panelsStayOpen-collapseTwo .accordion-button').removeAttr('data-bs-toggle');
            $('#panelsStayOpen-collapseThree .accordion-button').removeAttr('data-bs-toggle');
            $('#proceed').prop('disabled', true);
        }
}

function data_arr_bind(is_checked,date,price,rate,gst_perc_each,cgst_each,sgst_each,igst_each,extra_hr_curr=0){
        if(is_checked)
        {
        // Push the selection record into the data array
            data_arr.push({
                        date: date,
                        price: price,
                        rate: rate,
                        gst_perc:gst_perc_each,
                        cgst_each:cgst_each,
                        sgst_each:sgst_each,
                        igst_each:igst_each,
                        extra_hour:extra_hr_curr,
                    });
        }
        else
        {
                // Find the index of the selection record in the data array
                var dataIndexToRemove = data_arr.findIndex(function(item) {
                        return convertDateFormat(item.date) === date;
                    });

                    // If found, remove it from the data array
                    if (dataIndexToRemove !== -1) {
                        data_arr.splice(dataIndexToRemove, 1);
                    }
        }
}
let totalPriceAfterDiscount=0;
// Bind an event handler to the input event of #disc_perc
$('#disc_perc').on('input', function() {

    var hidden_total = $('.hidden_total').val();

    //alert(hidden_total);

    // Get the discount percentage value from the input
    var discountPercentage = parseFloat($(this).val());
    if (isNaN(discountPercentage)) {
        discountPercentage=0;
    }
    // Get the error message element
    var errorElement = $(".invalid-feedback-discperc");

    // Check if the discountPercentage is a valid number and within the valid range (0-100)
    if (!isNaN(discountPercentage) && discountPercentage >= 0 && discountPercentage <= 100) {
        // If it's a valid number within the range, clear the error message
        errorElement.text("");
        //var discountAmount = (discountPercentage / 100) * total_price;
        var discountAmount = (discountPercentage / 100) * hidden_total;

        // Update the discount amount field
        $('#disc_amt').val(discountAmount.toFixed(2));

        // Calculate the new total price after discount
        //totalPriceAfterDiscount = total_price - discountAmount;
        totalPriceAfterDiscount = hidden_total - discountAmount;
        // Update the total price field
        $('#total_price_text').text('₹' + totalPriceAfterDiscount.toFixed(2));
        $('#total_price_text_booking').text('₹' + totalPriceAfterDiscount.toFixed(2));

        // Calculate the GST and net amount based on the new total price
        calculateGSTAmount(totalPriceAfterDiscount,totalPriceAfterDiscount, function() {
            }, function(error) {
                // Error Callback
                console.error('Error calculating GST amount:', error);
            });
       // calculateGSTAmount(totalPriceAfterDiscount);
    } else {
        // Handle invalid input (e.g., non-numeric value or out-of-range value)

        // Clear the input field
        $(this).val("");
        discountPercentage=0;
        //var discountAmount = (discountPercentage / 100) * total_price;
        var discountAmount = (discountPercentage / 100) * hidden_total;

        // Update the discount amount field
        $('#disc_amt').val(discountAmount.toFixed(2));

        // Calculate the new total price after discount
        //totalPriceAfterDiscount = total_price - discountAmount;
        totalPriceAfterDiscount = hidden_total - discountAmount;
        // Update the total price field
        $('#total_price_text').text('₹' + totalPriceAfterDiscount.toFixed(2));
        $('#total_price_text_booking').text('₹' + totalPriceAfterDiscount.toFixed(2));

        // Calculate the GST and net amount based on the new total price
        calculateGSTAmount(totalPriceAfterDiscount,totalPriceAfterDiscount, function() {
            }, function(error) {
                // Error Callback
                console.error('Error calculating GST amount:', error);
            });
        // Set the error message
        if (isNaN(discountPercentage)) {
            errorElement.text("Please enter a valid number.");
        } else {
            errorElement.text("Discount percentage must be between 0 and 100.");
        }

    }
});

 // Add a keypress event handler to allow only numbers and decimals
 $("#disc_perc").keypress(function(event) {
        var charCode = event.which;
        // Allow numbers, decimals, and the backspace key
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
            event.preventDefault();
        }
    });

    $(document).on('click', '.pay_now', function() {    
        var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";

        /**Payment Related Data**/
        var receiptNo = $('#receipt_no').val();
        var paymentDate = $('#payment_date').val();
        var paymentMode = $('#payment_mode_admin').val();
        var paymentRemarks = $('#admin_remarks').val();
        /**Payment Related Data**/

        //alert(paymentDate);

        if(receiptNo == ''){

            $('.receipt_no_error').text('Please provide receipt no.');
            $('.payment_date_error').text('');

            $('#receipt_no').focus();
            return false;

        } else if(paymentDate == ''){

            $('.receipt_no_error').text('');
            $('.payment_date_error').text('Please select date.');

            $('#payment_date').focus();
            return false;

        } else {

            $('.receipt_no_error').text('');
            $('.payment_date_error').text('');

            var adv_amt=0.00;
            var adv_perc=0.00;

            var totalAmt = $('.hidden_total').val();
            var totalextraHour = $('.hidden_total_hour').val();
            var hidden_extra = $('.hidden_extra').val();        

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

            if(is_advance_pay){
                adv_amt=parseFloat($('#advanceAmount').val()).toFixed(2);
                adv_perc=$('#advperc').val();
            }
                    // Sort the data_arr by date
            data_arr.sort(function (a, b) {
                // Convert date strings to JavaScript Date objects
                var dateA = new Date(a.date);
                var dateB = new Date(b.date);

                // Compare dates
                return dateA - dateB;
            });
            var dis_perc=$('#disc_perc').val();
            if(isNaN(dis_perc))
            {
                dis_perc=0;
            }
            var disc_amt=$('#disc_amt').val();
            if(isNaN(dis_perc))
            {
                disc_amt=0;
            }
            if(totalPriceAfterDiscount>0){
                total_price=totalPriceAfterDiscount;
            } else {
                total_price=totalAmt;
            }
            // Get the data-tab attribute of the selected tab
            var selectedTabValue = selectedTab.attr('data-tab');
            let data = {
                hidden_extra: hidden_extra,
                date: date,
                json_data_arr:JSON.stringify(data_arr),
                total_price: total_price,
                total_extra_hours: totalextraHour,
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
                adv_amt:adv_amt,
                adv_perc:adv_perc,
                is_advance_pay:is_advance_pay,
                dis_perc:dis_perc,
                disc_amt:disc_amt,
                totalPriceAfterDiscount:totalPriceAfterDiscount,
                selected_tab_value: (selectedTabValue === 'individual') ? 1 : 0,
                prices: prices,
                receiptNo: receiptNo,
                paymentDate: paymentDate,
                paymentMode: paymentMode,
                paymentRemarks: paymentRemarks,
                "<?= $this->security->get_csrf_token_name(); ?>": csrf_token,
                form_data: $('form#bookingForm').serializeArray()
            };

            $.ajax({
                url: "<?=base_url('booking-admin-venue')?>",
                cache: false,
                type: "POST",
                data: data,
                dataType: "JSON",
                success: function(res){
                    if(res.status){
                        var url = '<?= base_url('admin/venue_reservation');?>';
                        $("#redirect_link").attr("href", url);
                        $('#modal_msg').html(res.message);
                        $('#add_modal').modal('show'); 
                    } else{                        
                        $('#modalMessage').html("There have some issue to continue your booking process.Please try again!");
                        $('#customModal').modal('show'); 
                    }
                }
            }); 

        }

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
    
    function calculateGSTAmount(per_day_rate,total_price, successCallback, errorCallback) {
        var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";
        per_day_rate_val=parseFloat(per_day_rate).toFixed(2);
    // Make an AJAX request to fetch GST slab based on total_price
    $.ajax({
        url: "<?=base_url('admin/venue_booking/getGSTSlab')?>", // Replace with your actual endpoint URL
        method: 'POST',
        data: { per_day_rate: per_day_rate_val,"<?= $this->security->get_csrf_token_name(); ?>": csrf_token
 },
        dataType: 'json',
        success: function (response) {
            if (response) {
                // Calculate GST amount based on GST percentage
                var gst_percentage = response.gst_percentage;
                gst_perc_each=response.gst_percentage;
                cgst_each=response.cgst_percentage;
                sgst_each=response.sgst_percentage;
                igst_each=response.igst_percentage;

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
                $('#gst_amount').text('₹' + gst_amount.toFixed(2));
                $('#net_amount').text('₹' + net_amount.toFixed(2));
                $('#gst_amount_booking').text('₹' + gst_amount.toFixed(2));
                $('#net_amount_booking').text('₹' + net_amount.toFixed(2));
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
                    url: "<?=base_url('admin/venue_booking/getAdvancedAmountOrNot')?>", // Replace with your actual endpoint URL
                    type: 'POST',
                    data: { numberOfDays: numberOfDays , net_amount:net_amount,"<?= $this->security->get_csrf_token_name(); ?>": csrf_token},
                    success: function(response) {
                        try {
                        // Deserialize the response from the server
                        var responseData = JSON.parse(response);
                        // Update the "daysAndAdvancedAmount" span with the calculated values
                        if (responseData.status) {
                            is_advance_pay=true;
                            advanced_amount=responseData.advanced_amount;
                            $('#advanceAmountInput').removeClass('hidden');
                            $('.textForInputAdvPay').removeClass('hidden'); 
                            $('#adv_perc').val(responseData.advancePaymentPercentage);  
                            $('#noOfDaysThreshold').val(responseData.noOfDaysThreshold);  
                            $(".percForInputAdvPay").text(responseData.advancePaymentPercentage+'%');
                            $(".nod").text(responseData.noOfDaysThreshold+' days');
                            $(".textForInputAdvPay").text('* Before '+ responseData.noOfDaysThreshold +' Days '+ responseData.advancePaymentPercentage+'%-100% Payment Scale');
                            $("#advanceAmount").val(responseData.advanced_amount);
                            $(".advAmt").text('₹'+parseFloat(responseData.advanced_amount).toFixed(2));
                        } else {
                            $("#advanceAmount").val('');
                            $('#advanceAmountInput').addClass('hidden');
                            $('.textForInputAdvPay').addClass('hidden');  
                            $('.notes').addClass('hidden');                         
                        }
                            successCallback();
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                            errorCallback(e);
                         }
                    },
                    error: function() {
                        // Handle AJAX error
                        console.log('Error in AJAX request');
                        errorCallback('Error in AJAX request');
                    }
                });
            } else {
                console.log('No GST slab found for the given total_price.');
                errorCallback('No GST slab found');           
             }
        },
        error: function (error) {
            console.error('Error fetching GST slab:', error);
            errorCallback(error);
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
                    blocksToValidate.push('#individual','#agencyInformationBlock');
                }
                else
                {
                    blocksToValidate.push('#individual');
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

$('#panelsStayOpen-headingThree .accordion-button').attr('data-bs-toggle', 'collapse');
    //$("#bookingSection").show();
    $('#panelsStayOpen-collapseThree').collapse('show');
// When an accordion panel is shown, focus on its heading
        $('#panelsStayOpen-collapseThree').on('show.bs.collapse', function (e) {
            const panelHeading = $(e.target).prev('.accordion-header');
            panelHeading.find('.accordion-button').focus();
        });
        // Programmatically trigger the collapse event on the accordion panel
        $('#panelsStayOpen-collapseOne').collapse('hide');    
        $('#panelsStayOpen-collapseTwo').collapse('hide');                
     
        
        // Initialize discount percentage as 0
  /*  var discount_percentage = 0;

// Check if data_arr is not empty
if (data_arr.length > 0) {
       // Sort the data_arr by date
       data_arr.sort(function (a, b) {
            // Convert date strings to JavaScript Date objects
            var dateA = new Date(a.date);
            var dateB = new Date(b.date);

            // Compare dates
            return dateA - dateB;
        });
    // Loop through the data array and populate the table
    $.each(data_arr, function (index, item) {
        var row = '<tr>';
        row += '<td>' + item.date + '</td>';
        row += '<td>' + item.price + '</td>';
        row += '<td>' + discount_percentage + '%</td>';
        var discount_amt = (item.price * discount_percentage) / 100;
        row += '<td>' + discount_amt + '</td>';
        // Calculate the amount after discount
        var amount_after_discount = item.price - (item.price * discount_percentage / 100);
        row += '<td>' + amount_after_discount + '</td>';
 
        // Calculate GST amount
        var gst_amount = calculateTypeWiseGST(amount_after_discount, item.gst_perc);
        var cgst_amount = calculateTypeWiseGST(amount_after_discount, item.cgst_each);
        var sgst_amount = calculateTypeWiseGST(amount_after_discount, item.sgst_each);

        row += '<td>' + item.gst_perc + '%</td>';
        row += '<td>' + item.cgst_each + '%</td>';
        row += '<td>' +  cgst_amount.toFixed(2) + '</td>'; // Assuming equal CGST and SGST
        row += '<td>' + item.sgst_each + '%</td>';
        row += '<td>' +  sgst_amount.toFixed(2) + '</td>'; // Assuming equal CGST and SGST
        row += '<td>' + gst_amount.toFixed(2) + '</td>';

        // Calculate price after GST
        var price_after_gst = amount_after_discount + gst_amount;
        row += '<td>' + price_after_gst.toFixed(2) + '</td>';

        row += '</tr>';

        $('#tableDiscountBody').append(row);
    });
} else {
    // Handle the case where data_arr is empty
    console.log('No data to populate.');
}*/

     });

    const changeDateFormatTo = date => {
      const [dd, mm, YYYY] = date.split(/-/g);
      return `${dd}-${mm}-${YYYY}`;
    };

     // Function to calculate GST amount based on GST percentage and price
     function calculateTypeWiseGST(price, gst_perc) {
        return (price * gst_perc) / 100;
    }
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
   // $("#bookingSection").hide();
   $('#panelsStayOpen-headingTwo .accordion-button').removeAttr('data-bs-toggle');
   $('#panelsStayOpen-headingThree .accordion-button').removeAttr('data-bs-toggle');
    // Listen for the "Proceed" button click event
    $('#proceed').on('click', function() {
    // Enable the collapse functionality by adding the data-bs-toggle attribute
    $(' #panelsStayOpen-headingTwo .accordion-button').attr('data-bs-toggle', 'collapse');
    //$("#bookingSection").show();
    $('#panelsStayOpen-collapseTwo').collapse('show');
        // When an accordion panel is shown, focus on its heading
        $('#panelsStayOpen-collapseTwo').on('show.bs.collapse', function (e) {
                    const panelHeading = $(e.target).prev('.accordion-header');
                    panelHeading.find('.accordion-button').focus();
                });
        // Programmatically trigger the collapse event on the accordion panel
        $('#panelsStayOpen-collapseOne').collapse('hide');
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
       /* $('html, body').animate({
            scrollTop: $("#bookingSection").offset().top
        }, 1000);*/
    });


    $('#advanceAmount').on('input', function() {
        // Get the entered value and parse it as a floating-point number
        var enteredAmount = parseFloat($(this).val());
        
        // Define your advance amount and net amount variables here
        var advanceAmount = advanced_amount; // Replace with your desired advance amount
        var netAmount = net_amount; // Replace with your desired net amount
        
        // Check if the entered amount is less than the advance amount
        if (enteredAmount < advanceAmount) {
            // Show the error message and block the form
            $('.invalid-feedback').text('Error: Amount must be greater than or equal to ' + advanceAmount).show();
            $('.pay_now').prop('disabled',true);
            // You can disable the form submit button here if needed
            // $('#submitButton').prop('disabled', true);
        } else if (enteredAmount > netAmount) {
            // Show the error message and block the form
            $('.invalid-feedback').text('Error: Amount cannot exceed the net amount ' + netAmount).show();
            $('.pay_now').prop('disabled',true);
            // You can disable the form submit button here if needed
            // $('#submitButton').prop('disabled', true);
        } else {
            // Hide the error message and allow the form submission
            $('.invalid-feedback').hide();
            $('.pay_now').prop('disabled',false);

            // You can enable the form submit button here if needed
            // $('#submitButton').prop('disabled', false);
        }
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

    $(document).on('change', '#customer_id', function() {
           
        //$(".customer_type").removeClass('active');
        var customer_id = $(this).val();
        
        if (customer_id > 0) {

            //$('#individual input').prop('readonly', true);
            //$('#individual select').prop('disabled', true);

           // $('#organisation input').prop('readonly', true);
            //$('#organisation select').prop('disabled', true);

            //$(".customer_type").prop('disabled', true);

            $("#indivisual_full_name").val('');
            $("#indivisual_email").val('');
            $("#indivisual_contact_no").val('');
            $("#indivisual_full_address").val('');

            $("#business_full_name").val('');
            $("#business_email").val('');
            $("#business_contact_no").val('');
            $('input[name="business_gst_no"]').val('');
            $("#business_full_address").val('');
            $("#contact_person_name").val('');
            $("#contact_person_email").val('');
            $("#contact_person_contact_no").val('');


            var customer_data = $(this).find('option:selected').data('customer_data');

            //console.log(customer_data);

            if (customer_data.customer_type == 'I') {

                var ind_name= customer_data.first_name +((customer_data.middle_name)?' '+customer_data.middle_name+' ' : ' ') + customer_data.last_name  ; 

                if(customer_data.contact_person_name){
                    $("#contact_person_name").val(customer_data.contact_person_name);
                } else {
                    $("#contact_person_name").val(customer_data.first_name);
                }

                if(customer_data.contact_person_email){
                    $("#contact_person_email").val(customer_data.contact_person_email);
                } else {
                    $("#contact_person_email").val(customer_data.email);
                }

                if(customer_data.contact_person_mobile){
                    $("#contact_person_contact_no").val(customer_data.contact_person_mobile);
                } else {
                    $("#contact_person_contact_no").val(customer_data.mobile);
                }  


                $("#indivisual_full_name").val(customer_data.first_name);
                $("#indivisual_email").val(customer_data.email);
                $("#indivisual_contact_no").val(customer_data.mobile);
                $("#indivisual_full_address").val(customer_data.address);

                if(!$('#individual').hasClass('active'))
                    $('#individual').addClass('active');
                if($('#organisation').hasClass('active'))
                    $('#organisation').removeClass('active');

                // Assuming you want to set the "active" class on a specific tab, e.g., with data-tab="organisation"
                var tabNameToActivate = "individual";

                // Find the list item with the matching data-tab attribute and add the "active" class to it
                $('ul.tabs li').removeClass('active');
                $('ul.tabs li[data-tab="' + tabNameToActivate + '"]').addClass('active');   

            } else {

                $("#indivisual_full_name").val(customer_data.first_name);
                $("#indivisual_email").val(customer_data.email);
                $("#indivisual_contact_no").val(customer_data.mobile);
                $("#indivisual_full_address").val(customer_data.address);

                $("#business_full_name").val(customer_data.company_name);
                $("#business_email").val(customer_data.company_email);
                $("#business_contact_no").val(customer_data.company_phone);
                $('input[name="business_gst_no"]').val(customer_data.gst_number);
                $("#business_full_address").val(customer_data.company_address);

                if(customer_data.contact_person_name){
                    $("#contact_person_name").val(customer_data.contact_person_name);
                } else {
                    $("#contact_person_name").val(customer_data.first_name);
                }

                if(customer_data.contact_person_email){
                    $("#contact_person_email").val(customer_data.contact_person_email);
                } else {
                    $("#contact_person_email").val(customer_data.email);
                }

                if(customer_data.contact_person_mobile){
                    $("#contact_person_contact_no").val(customer_data.contact_person_mobile);
                } else {
                    $("#contact_person_contact_no").val(customer_data.mobile);
                } 

                //$("#contact_person_name").val(customer_data.contact_person_name);
                //$("#contact_person_email").val(customer_data.contact_person_email);
                //$("#contact_person_contact_no").val(customer_data.contact_person_mobile);
                
                // Assuming you want to set the "active" class on a specific tab, e.g., with data-tab="organisation"
                var tabNameToActivate = "organisation";

                // Find the list item with the matching data-tab attribute and add the "active" class to it
                $('ul.tabs li').removeClass('active');
                $('ul.tabs li[data-tab="' + tabNameToActivate + '"]').addClass('active');

                if(!$('#organisation').hasClass('active'))
                    $('#organisation').addClass('active');
                if($('#individual').hasClass('active'))
                    $('#individual').removeClass('active');

            }

        } else {
        
            // Assuming you want to set the "active" class on a specific tab, e.g., with data-tab="organisation"
            var tabNameToActivate = "individual";

            // Find the list item with the matching data-tab attribute and add the "active" class to it
            $('ul.tabs li').removeClass('active');
            $('ul.tabs li[data-tab="' + tabNameToActivate + '"]').addClass('active');    

            if(!$('#individual').hasClass('active'))
                $('#individual').addClass('active');
            $('#individual input').prop('readonly', false);
            $('#individual select').prop('disabled', false);

            $('#organisation input').prop('readonly', false);
            $('#organisation select').prop('disabled', false);

            $('#individual input').val('');
            $('#organisation input').val('');

            $('#individual select').val('');
            $('#organisation select').val('');

        }

    })
});

// JavaScript for validation

</script>
