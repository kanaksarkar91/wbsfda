<section class="gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7">

                <?php
                if (!$this->session->userdata('logged_in') && !$this->session->userdata('user_type') == 'frontend') {
                ?>
                    <div class="checkout-wrap">
                        <div class="checkout-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h5 class="text-center fw-bold mb-3">Please Login to continue with the booking.</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group text-center">
                                        <input id="checkbox" type="checkbox" checked="checked" class="checkbox-custom" autocomplete="off">
                                        <label for="checkbox" class="checkbox-custom-label"><a href="#." class="text-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewTerms">I accept Terms & Conditions, Privacy Policy and Cancellation Rules.</a></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group text-center">
                                        <a href="#" id="booking_login" class="btn-green px-4" data-bs-toggle="modal" data-bs-target="#login" data-redirect="1">Login to Continue</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                if ($this->session->userdata('logged_in') && $this->session->userdata('user_type') == 'frontend') {
                ?>

                    <!-- 1st Step Checkout -->
                    <div class="checkout-wrap">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group text-center <?php if (!empty(validation_errors())) { ?> alert alert-danger <?php } ?>">
                                <?= validation_errors(); ?>
                                <?= isset($err_msg) && $err_msg != '' ? $err_msg : ''; ?>
                            </div>
                        </div>
                        <div class="checkout-head">
                            <ul>
                                <li class="active"><span><i class="bi bi-check-lg"></i></span>Guest Detail</li>
                                <li><span>2</span>Payment Information</li>
                                <li><span>3</span>Confirmation!</li>
                            </ul>
                        </div>

                        <form action="" method="post" id="paymentForm" autocomplete="off">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <div class="checkout-body">
                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group text-center ">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <h5 class="mb-3 fw-bold thm-txt">Guest Detail</h5>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="guest_type" id="guestType1" value="1" checked="checked" autocomplete="off" <?= set_checkbox('guest_type', '1', true); ?>>
                                            <label class="form-check-label" for="guestType1">Individual</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="guest_type" id="guestType2" value="2" autocomplete="off" <?= set_checkbox('guest_type', '2'); ?>>
                                            <label class="form-check-label" for="guestType2">Organization</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Full Name Of The Primary Guest <i class="req">*</i></label>
                                            <input type="text" name="booking_fname" id="booking_fname" class="form-control text_capitalized" autocomplete="off">
                                        </div>
                                    </div>

                                    <!--<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label>Last Name<i class="req">*</i></label>
										<input type="text" name="booking_lname" id="booking_lname" class="form-control text_capitalized">
									</div>
								</div>-->

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Gender <i class="req">*</i></label>
                                            <select class="form-control" name="booking_gender" id="booking_gender">
                                                <option value="">Select Gender</option>
                                                <option value="Male" <?= set_select('booking_gender', 'Male'); ?>>Male</option>
                                                <option value="Female" <?= set_select('booking_gender', 'Female'); ?>>Female</option>
                                                <option value="Other" <?= set_select('booking_gender', 'Other'); ?>>Transgender</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Age <i class="req">*</i></label>
                                            <select class="form-control" name="booking_age" id="booking_age">
                                                <?php for ($i = 18; $i <= 120; $i++) { ?>
                                                    <option value="<?= $i; ?>" <?= set_select('booking_age', $i); ?>><?= $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Email <i class="req">*</i></label>
                                            <input type="email" name="booking_email" id="booking_email" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Mobile No.<i class="req">*</i></label>
                                            <input type="number" name="booking_mobile" id="booking_mobile" class="form-control" autocomplete="off">
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="form-group mb-0">
                                            <label>Whether any of the guest is a foreign national? <i class="req">*</i></label><br>
                                        </div>
                                        <div class="form-check form-check-inline mb-3">
                                            <input class="form-check-input" type="radio" name="guest_type_foreign" id="guestTypeForeign1" value="2" checked="checked" autocomplete="off">
                                            <label class="form-check-label text-dark fw-normal" for="guestTypeForeign1">No</label>
                                        </div>
                                        <div class="form-check form-check-inline mb-3">
                                            <input class="form-check-input" type="radio" name="guest_type_foreign" id="guestTypeForeign2" value="1" autocomplete="off">
                                            <label class="form-check-label text-dark fw-normal" for="guestTypeForeign2">Yes</label>
                                        </div>
                                    </div>



                                    <div class="col-12" id="show_when_foreigner" style="display:none;">

                                        <div class="col-12">

                                            <div class="table-responsive applicants-data-add-table" id="after_accommo_change_show">
                                                <table class="table table-sm align-middle table-bordered mb-0" id="myTableForeigner">
                                                    <tbody>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Age</th>
                                                            <th>Gender</th>
                                                            <th>Nationality</th>
                                                            <th></th>
                                                        </tr>

                                                        <tr class="text-box">
                                                            <td><input type="text" class="form-control" name="foreigner_name[]" id="foreigner_name" placeholder="Name" required="" autocomplete="off">
                                                            </td>

                                                            <td>
                                                                <select class="form-control" name="foreigner_age[]" id="foreigner_age" required="">
                                                                    <option value="">Age</option>
                                                                    <?php for ($a = 1; $a <= 120; $a++) { ?>
                                                                        <option value="<?= $a; ?>"><?= $a; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>

                                                            <td>
                                                                <select class="form-control" name="foreigner_gender[]" id="foreigner_gender" required="">
                                                                    <option value="">Gender</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                    <option value="Other">Transgender</option>
                                                                </select>
                                                            </td>

                                                            <td>
                                                                <select class="form-control" name="foreigner_nationality[]" id="foreigner_nationality" required="">
                                                                    <option value="">Nationality</option>
                                                                    <?php
                                                                    if (!empty($nationalities)) {
                                                                        foreach ($nationalities as $natio) {
                                                                    ?>
                                                                            <option value="<?= $natio['nationality']; ?>"><?= $natio['nationality']; ?></option>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </td>
                                                            <td></td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="text-end mt-3">
                                                <button type="button" class="btn btn-info text-white" id="add_row_foreigner"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>


                                    </div>


                                    <div class="col-lg-6 col-md-6 col-sm-12" id="org_name" style="display: none;">
                                        <div class="form-group">
                                            <label>Organisation Name</label>
                                            <input type="text" name="booking_organisation_name" id="booking_organisation_name" class="form-control text_capitalized" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12" id="org_gstin" style="display: none;">
                                        <div class="form-group">
                                            <label>GSTIN</label>
                                            <input type="text" name="booking_organisation_gstin" id="booking_organisation_gstin" class="form-control" autocomplete="off">
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <input id="checkbox" type="checkbox" checked="checked" class="checkbox-custom" autocomplete="off">
                                            <label for="checkbox" class="checkbox-custom-label"><a href="#." class="text-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewTerms">I accept Terms & Conditions, Privacy Policy and Cancellation Rules.</a></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-green px-4" value="Proceed To Pay" id="pay_btn" autocomplete="off">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="col-lg-4 col-md-5">
                <div class="checkout-side">
                    <div class="booking-short">
                        <h5 class="thm-txt fw-bold pt-3"><?= $property['property_name']; ?></h5>
                        <p><?php
                            $address_parts = array();
                            if (!empty($property['address_line_1'])) {
                                $address_parts[] = $property['address_line_1'];
                            }
                            if (!empty($property['address_line_2'])) {
                                $address_parts[] = $property['address_line_2'];
                            }
                            if (!empty($property['city'])) {
                                $address_parts[] = $property['city'];
                            }
                            echo implode(', ', $address_parts);
                            ?></p>
                        <p>
                            <span class="text-dark fw-bold">Total Length of Stay:</span><br>
                            <span><?= $no_nights; ?> Night <?= $no_nights + 1; ?> Days</span>
                        </p>
                    </div>

                    <div class="booking-short-side">

                        <div class="card border-0 rounded-0">
                            <div class="card-header bg-dark rounded-0" id="bookinDet">
                                <h5 class="text-white mb-0">Booking Details</h5>
                            </div>
                            <div id="bookinSer" class="collapse show" aria-labelledby="bookinDet" data-parent="#accordionExample">
                                <div class="card-body p-0 paybox">
                                    <ul class="booking-detail-list">
                                        <li>
                                            Check in - Check out:
                                            <span class="w-100"><?= date('d M Y', strtotime($checkInDt)) . ' - ' . date('d M Y', strtotime($checkOutDt)); ?></span>
                                        </li>
                                        <li>
                                            Total Length of Stay:
                                            <span class="w-100"><?= $no_nights; ?> Night <?= $no_nights + 1; ?> Days</span>
                                        </li>
                                        <li>Adults:<span><?= '2'; ?></span></li>
                                        <li>Children:<span><?= '1'; ?></span></li>
                                        <li>Price (Rs.): <span class="h6">₹<?= isset($amounts['total_amount']) && $amounts['total_amount'] != '' ? number_format(floatval($amounts['total_amount'] + $amounts['total_extra_bed_price']), 2, '.', ',') : ''; ?></span></li>
                                        <li>GST: <span class="h6">₹<?= isset($amounts['gst_amount']) && $amounts['gst_amount'] != '' ? number_format(floatval($amounts['gst_amount']), 2, '.', ',') : '0.00'; ?></span></li>
                                        <li class="totalprice">Total Payment (Rs.) <span class="h5">₹<?= isset($amounts['grand_total']) && $amounts['grand_total'] != '' ? number_format(floatval($amounts['grand_total']), 2, '.', ',') : ''; ?></span></li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!--View Terms Modal -->
<div class="modal fade" id="viewTerms" tabindex="-1" aria-labelledby="viewTermsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header light-grn-bg">
                <h1 class="modal-title fw-bold thm-txt fs-5" id="viewTermsModalLabel">Terms & Conditions, Privacy Policy and Cancellation Rules.</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Terms & Conditions:</h5>
                <ol class="small text-justify">
                    <li>Visitors are required to carry the same ID proof in original at the time of visiting the national park.</li>
                    <li>The reservations of safari/ride are not transferable. The visitor should carry with him/her Print-out of the Electronic Reservation Slip.</li>
                    <li>One child below 5 years of age may ride with parents without additional charges.</li>
                    <li>Reservation may be cancelled in acute administrative requirement. No cancellation charge will be deducted in such case.</li>
                    <li>WBSFDA will not be liable against non-availability of amenities/services caused by irreparable technical faults or natural inconvenience.</li>
                </ol>

                <h5>Privacy Policy:</h5>
                <ol class="small text-justify">
                    <li>As a general rule, this web site does not collect personal Information about you when you visit the site. You can generally visit this site, without revealing any personal information, unless you choose to provide such information.</li>
                    <li>Any personal information collected shall be used only for the stated purpose and shall NOT be shared with any other department/organization (Public/private).</li>
                    <li>This site may contain links to Governmental/Non-governmental sites whose data protection and privacy practices may differ from ours. We are not responsible for the content and privacy practices of these other websites and encourage
                        you to consult the privacy notices of those sites.</li>
                </ol>

                <h5>Cancellation Rules :</h5>
                <ol class="small text-justify">
                    <li>More than clear 16 (Sixteen) days: 20% of the entry fee will be deducted.</li>
                    <li>Between Clear 08(Eight) to clear15(Fifteen)days:40% of the entry fee will be deducted.</li>
                    <li>Between Clear04(Four)to clear 07(Seven)days:80% of the entry fee will be deducted.</li>
                    <li>Less than or equal to 3 (Three)days: No refund.</li>
                    <li>"Clear Days" means that the date of occupation and the date of cancellation would not be counted. Moreover, Sunday & Holiday would not be excluded for calculation of cancellation charges.</li>
                    <li>For part cancellation, normal refund rules will be charged as per rules.</li>
                    <li>Refund admissible only upon production of the original reservation ticket.</li>
                    <li>Visitors have to pay vehicle entry free, Guide charge, Vehicle hiring charge and other requires charges at the entry gate/reporting point.</li>
                    <li>Visitors have to pay other charges for Folk dance, Handicrafts etc. for afternoon trips of Gorumara at the entry gate/reporting point.</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    window.history.forward();

    function noBack() {
        window.history.forward();
    }
</script>
<script>
    $(document).ready(function() {
        customerSection();
    });

    function customerSection() {
        var guestType = $('input:radio[name="guest_type"]:checked').val();
        var firstName = "<?= isset($customer_det) && $customer_det->first_name != '' ? $customer_det->first_name : ''; ?>";
        var lastName = "<?= isset($customer_det) && $customer_det->last_name != '' ? $customer_det->last_name : ''; ?>";
        var gender = "<?= isset($customer_det) && $customer_det->gender != '' ? $customer_det->gender : ''; ?>";
        var age = "<?= isset($customer_det) && $customer_det->age != '' ? $customer_det->age : ''; ?>";
        var email = "<?= isset($customer_det) && $customer_det->email != '' ? $customer_det->email : ''; ?>";
        var mobile = "<?= isset($customer_det) && $customer_det->mobile != '' ? $customer_det->mobile : ''; ?>";

        if (guestType == "1") {
            $("#booking_fname").val(firstName);
            $("#booking_lname").val(lastName);
            $('#booking_gender [value=' + gender + ']').attr('selected', 'true');
            $('#booking_age [value=' + <?= $customer_det->age; ?> + ']').attr('selected', 'true');
            $("#booking_email").val("<?= $customer_det->email; ?>");
            $("#booking_mobile").val(mobile);

            //$("#booking_fname").attr("readonly", "true");
            //$("#booking_lname").attr("readonly", "true");
            //$("#booking_gender").attr("readonly", "true");
            //$("#booking_age").attr("readonly", "true");
            //$("#booking_email").attr("readonly", "true");
            //$("#booking_mobile").attr("readonly", "true");
            $("#org_name").css("display", "none");
            $("#org_gstin").css("display", "none");
        }
        if (guestType == "2") {
            $("#booking_fname").val("<?= set_value('booking_fname'); ?>");
            $("#booking_lname").val("<?= set_value('booking_lname'); ?>");
            //$("#booking_gender").val("<?= set_value('booking_gender'); ?>");
            //$("#booking_age").val("<?= set_value('booking_age'); ?>");
            $("#booking_email").val("<?= set_value('booking_email'); ?>");
            $("#booking_mobile").val("<?= set_value('booking_mobile'); ?>");
            $("#booking_organisation_name").val("<?= set_value('booking_organisation_name'); ?>");
            $("#booking_organisation_gstin").val("<?= set_value('booking_organisation_gstin'); ?>");

            //$("#booking_fname").removeAttr("readonly");
            //$("#booking_lname").removeAttr("readonly");
            //$("#booking_gender").removeAttr("disabled");
            //$("#booking_age").removeAttr("disabled");
            //$("#booking_email").removeAttr("readonly");
            //$("#booking_mobile").removeAttr("readonly");
            $("#org_name").css("display", "block");
            $("#org_gstin").css("display", "block");
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('input[name="guest_type"]').on("change", function() {
            customerSection();
        });
    });
</script>
<script>
    customerSection();
</script>
<script>
    $(document).ready(function() {
        $("#coupon_action").on("click", function() {
            if ($(this).data('type') == 'apply') {
                var coupon_code = $("#coupon").val();
                var property_id = $("#coupon_property_id").val();
                $('#coupon_msg').html("");

                if (coupon_code != '') {
                    $.ajax({
                        url: '<?= base_url('frontend/booking/booking_coupon'); ?>',
                        method: 'post',
                        data: {
                            coupon_code: coupon_code,
                            propertyId: property_id,
                            csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'
                        },
                        dataType: 'json',
                    }).done(function(data) {
                        if (data != null) {
                            if (data.success) {
                                window.location.reload(true);
                            } else {
                                $('#coupon_msg').html(data.msg);
                            }
                        } else {
                            $('#coupon_msg').html("An unexpected error occured.");
                        }
                    });
                } else {
                    alert('Please enter a coupon code first.');
                }
            }
            if ($(this).data('type') == 'remove') {
                $.ajax({
                    url: '<?= base_url('frontend/booking/booking_coupon'); ?>',
                    method: 'post',
                    data: {
                        type: 'remove',
                        csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: 'json',
                }).done(function(data) {
                    if (data != null) {
                        if (data.success) {
                            window.location.reload(true);
                        } else {
                            $('#coupon_msg').html(data.msg);
                        }
                    } else {
                        $('#coupon_msg').html("An unexpected error occured.");
                    }
                });
            }
            console.log($(this).data('type'));
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#pay_btn").on("click", function() {
            $("#pay_btn").attr('disabled', 'disabled');
            $("#paymentForm").submit();
        });

        $(document).on('click', '#view_terms', function() {
            $('#myModal').modal('show');
        });

        $(document).on('click', '#close_button', function() {
            $('#myModal').modal('hide');
        });

        $('#checkbox').click(function() {
            if (!$(this).is(':checked')) {
                $('#booking_login').bind('click', function() {

                    return false;

                });
                $('#pay_btn').attr("disabled", "disabled");
            } else {
                $('#booking_login').unbind('click');
                $('#pay_btn').removeAttr('disabled');
            }
        });

        $('input[name="guest_type_foreign"]').on("change", function() {
            var guest_type_foreign = $('input:radio[name="guest_type_foreign"]:checked').val();

            if (guest_type_foreign == 1) {
                $("#show_when_foreigner").show();
            } else {
                $("#show_when_foreigner").hide();
            }
        });

        $('#myTableForeigner').on('click', '#delete_row_foreigner', function() {
            $(this).closest('tr').remove();
        });


        $('#add_row_foreigner').click(function() {

            var counter = $('.text-box').length + 1;

            $('#myTableForeigner').append('<tr class="text-box">' +
                '<td><input type="text" class="form-control" name="foreigner_name[]" id="foreigner_name" placeholder="Name" required></td>' +
                '<td><select class="form-control" name="foreigner_age[]" id="foreigner_age" required>' +
                '<option value="">Age</option>' +
                '<?php for ($a = 1; $a <= 120; $a++) { ?>' +
                '<option value="<?= $a; ?>"><?= $a; ?></option>' +
                '<?php } ?>' +
                '</select></td>' +
                '<td><select class="form-control" name="foreigner_gender[]" id="foreigner_gender" required>' +
                '<option value="">Gender</option>' +
                '<option value="Male">Male</option>' +
                '<option value="Female">Female</option>' +
                '<option value="Other">Transgender</option>' +
                '</select></td>' +
                '<td><select class="form-control" name="foreigner_nationality[]" id="foreigner_nationality" required>' +
                '<option value="">Nationality</option>' +
                '<?php if (!empty($nationalities)) { ?>' +
                '<?php foreach ($nationalities as $natio) { ?>' +
                '<option value="<?= $natio['nationality']; ?>"><?= $natio['nationality']; ?></option>' +
                '<?php } ?>' +
                '<?php } ?>' +
                '</select></td>' +
                '<td><button type="button" class="btn btn-danger btn-sm text-white" id="delete_row_foreigner"><i class="fa fa-sm fa-trash"></i></button></td>' +
                '</tr>');

        });

    });
</script>