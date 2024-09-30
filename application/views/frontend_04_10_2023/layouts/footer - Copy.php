<!-- ============================ Footer Start ================================== -->
<footer class="light-footer skin-light-footer">
    <div>
        <div class="container">
            <div class="row">

                <div class="col-lg-5 col-md-5">
                    <div class="footer-widget">
                        <a class="nav-brand" href="<?= base_url(); ?>">
                            <img src="<?= base_url('public/frontend_assets/images/logo.png');?>" class="logo img-fluid" alt="">
                            <div class="d-flex flex-column ml-2">
                                <span><b style="font-size: 20px;
    color: #004598;
    font-family: 'Inter';">Panchayat Tourism</b></span>
                                <span>Department of Panchayats & Rural Development</span>
                                <span class="small">Government of West Bengal</span>
                            </div>
                        </a>
                        <div class="footer-add mt-2">
                            <p><strong>Email:</strong> <a href="mailto:panchayatstourism@gmail.com">panchayatstourism@gmail.com</a></p>
                            <p><strong>Call:</strong> <a href="tel:03323340047">033-2334 0047/58</a></p>
                            <ul class="footer-bottom-social mt-2">
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                                <li><a href="#"><i class="ti-linkedin"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-lg-2 col-md-2">
                    <div class="footer-widget">
                        <h4 class="widget-title">Quick Links</h4>
                        <ul class="footer-menu">
                            <li><a href="<?php echo base_url()?>">Home</a></li>
                            <li><a href="<?php echo base_url('frontend/booking/property')?>">Room Booking</a></li>
                            <li><a href="<?php echo base_url('frontend/booking/hall')?>">Hall Booking</a></li>
                            <li><a href="<?php echo base_url('contact-us')?>">Contact</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2">
                    <div class="footer-widget">
                        <h4 class="widget-title">My Account</h4>
                        <ul class="footer-menu">
						<?php
						if($this->session->userdata('logged_in') && $this->session->userdata('user_type') == 'frontend'){
						?>
							<li><a href="<?php echo base_url('my-booking')?>">My Booking</a></li>
                            <li><a href="<?php echo base_url('my-profile')?>">My Profile</a></li>
						<?php
						}
						else{
						?>
                            <li><a href="#" data-target="#login" data-toggle="modal">My Booking</a></li>
                            <li><a href="#" data-target="#login" data-toggle="modal">My Profile</a></li>
						<?php
						}
						?>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3">
                    <div class="footer-widget">
                        <h4 class="widget-title">Policies</h4>
                        <ul class="footer-menu">
                            <li><a href="<?php echo base_url('privacy-policy')?>">Privacy Policy</a></li>
                            <li><a href="<?= base_url('public/frontend_assets/images/Uniform Reservation & Cancellation Policy.pdf');?>" target="_blank">Reservation & Cancellation Policy</a></li>
							<li><a href="<?php echo base_url('faq')?>">FAQ</a></li>
							<li style="display:none;"><a href="<?php echo base_url('cancellation-policy')?>">Cancellation & Refund Policy</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-9 col-md-9">
                    <p class="mb-0">© 2022 Department of Panchayats & Rural Development | Govt. of West Bengal</p>
                </div>

                <div class="col-lg-3 col-md-3 text-right">
                    <img src="<?= base_url('public/frontend_assets//images/payment_card.png'); ?>" class="img-fluid" alt="" />
                </div>

            </div>
        </div>
    </div>
</footer>
<!-- ============================ Footer End ================================== -->

<!-- Log In Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog login-box" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Log In</h5>
                <span class="mod-close" data-dismiss="modal"><i class="ti-close"></i></span>
            </div>
            <div class="modal-body icon-form" id="login-modal-body">
                <div class="login-form">
                <form action="#" method="post" id="loginForm">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                        <div class="form-group">
                            <label>Phone no</label>
                            <div class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Phone no" id="login_mobile" name="login_mobile">
                                <i class="ti-user"></i>
                            </div>
                            <p id="login_mobile-valid" class="hidden mob">
                                <!-- Valid Mobile No -->
                            </p>
                            <p id="login_folio-invalid" class="hidden mob-helpers">
                                Invalid mobile No
                            </p>
                        </div>



                        <div class="form-group login_otp_div">
                            <button type="button" class="btn btn-primary" id="login_getOTP" disabled="">Get OTP</button>
                            <div class="pull-right login_time-block">
                                Resend OTP in
                                <strong class="login_time">59s</strong>
                            </div>
                        </div>

                        <div class="form-group login_otp_div">
                            <label>OTP</label>
                            <div class="input-with-icon">
                                <input type="password" class="form-control" id="login_otp" name="login_otp" placeholder="ENTER OTP">
                                <i class="ti-unlock"></i>
                            </div>
                        </div>


                </div>

                <div class="form-group">
                    <button type="button" id="loginBtn" class="btn btn-md full-width pop-login" disabled>Login</button>
                </div>

                </form>
            </div>
            <div class="text-center">
                <p class="my-3">
                    <a data-toggle="modal" data-target="#signup" data-dismiss="modal" class="link">Don't Have an Account. Signup</a></p>
            </div>
        </div>
    </div>
</div>
< /div>
<!-- End Modal -->

<!-- Sign Up Modal -->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Create An Account</h5>
                <span class="mod-close" data-dismiss="modal"><i class="ti-close"></i></span>
            </div>
            <div class="modal-body icon-form" id="signup-modal-body">
                <div class="login-form">
                    <form action="#" method="post" id="signupForm">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="row">
                        <div class="form-group col-md-6 px-3">
                            <label>First Name</label>
                            <div class="input-with-icon">
                                <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
                                <i class="ti-user"></i>
                            </div>
                        </div>

                        <div class="form-group col-md-6 px-3">
                            <label>Last Name</label>
                            <div class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Last Name" name="last_name" required>
                                <i class="ti-user"></i>
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <label>Email ID</label>
                            <div class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Email ID" name="email" required>
                                <i class="ti-email"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Phone No</label>
                            <div class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Phone no" id="mobile" name="mobile" maxlength="10">
                                <i class="ti-user"></i>

                            </div>
                            <p id="mobile-valid" class="hidden mob">
                                <!-- Valid Mobile No -->
                            </p>
                            <p id="folio-invalid" class="hidden mob-helpers">
                                Invalid mobile No
                            </p>
                        </div>

                        <div class="form-group otp_div">
                            <button type="button" class="btn btn-primary" id="getOTP" disabled="">Get OTP</button>
                            <div class="pull-right time-block">
                                Resend OTP in
                                <strong class="time">59s</strong>
                            </div>
                        </div>

                        <div class="form-group otp_div">
                            <label>OTP</label>
                            <div class="input-with-icon">
                                <input type="password" class="form-control" id="otp" name="otp" placeholder="ENTER OTP">
                                <i class="ti-unlock"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-md full-width pop-login" id="signupBtn" disabled="disabled">Signup</button>
                        </div>

                    </form>
                </div>
                <div class="text-center">
                    <p class="mt-3">Already Have an Account? <a data-toggle="modal" data-dismiss="modal"  data-target="#login" class="link" >Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>



</div>
<style type="text/css">
    .OTPBox,
    .hidden {
        display: none
    }

    .mob-helpers {
        color: red
    }

    .time-block {
        display: none;
    }

    .time {
        font-weight: 800
    }

    .otp_div {
        display: none;
    }

    .login_otp_div {
        display: none;
    }

    .login_time-block {
        display: none;
    }

    .login_time {
        font-weight: 800
    }

    

    
</style>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?= base_url('public/frontend_assets/js/circleMagic.min.js'); ?>"></script>
<script src="<?= base_url('public/frontend_assets/js/popper.min.js'); ?>"></script>
<script src="<?= base_url('public/frontend_assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('public/frontend_assets/js/rangeslider.js'); ?>"></script>
<script src="<?= base_url('public/frontend_assets/js/select2.min.js'); ?>"></script>
<script src="<?= base_url('public/frontend_assets/js/aos.js'); ?>"></script>
<script src="<?= base_url('public/frontend_assets/js/owl.carousel.min.js'); ?>"></script>
<script src="<?= base_url('public/frontend_assets/js/jquery.magnific-popup.min.js'); ?>"></script>
<script src="<?= base_url('public/frontend_assets/js/slick.js'); ?>"></script>
<script src="<?= base_url('public/frontend_assets/js/slider-bg.js'); ?>"></script>
<script src="<?= base_url('public/frontend_assets/js/lightbox.js'); ?>"></script>
<script src="<?= base_url('public/frontend_assets/js/imagesloaded.js'); ?>"></script>
<script src="<?= base_url('public/frontend_assets/js/isotope.min.js'); ?>"></script>
<script src="<?= base_url('public/frontend_assets/js/custom.js'); ?>"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->

<!-- Date Booking Script -->
<script src="<?= base_url('public/frontend_assets/js/moment.min.js'); ?>"></script>
<script src="<?= base_url('public/frontend_assets/js/daterangepicker.js'); ?>"></script>

<script type="text/javascript">
    // $(document).on('click', '#loginBtn', function() {
    //     $("#mobile").val('');
    //     $("#otp").val('');
    //     $("#folio-invalid").addClass("hidden");
    //     $("#mobile-valid").addClass("hidden");
    //     $(".otp").addClass("OTPBox");
    //     $("#getOTP").prop("disabled", true);
    //     $("#signupBtn").prop('disabled', true);

    //     $('#LoginModal').modal('show');
    // });

    $("#check_in_out").daterangepicker();

    $(document).on("keyup", "#mobile", function() {

        $('#signup-modal-body').find('.alert-danger').remove();
        $('#signup-modal-body').find('.time-block').hide();
        $("#getOTP").text('Get OTP'); 
        var mobNum = $(this).val();
        var filter = /^\d*(?:\.\d{1,2})?$/;

        if (filter.test(mobNum)) {
            if (mobNum.length == 10) {

                $("#mobile-valid").removeClass("hidden");
                $("#folio-invalid").addClass("hidden");
                $(".otp").removeClass("OTPBox");
                $("#getOTP").prop("disabled", false);
                $(".otp_div").show();

            } else {
                //alert('Please put 10  digit mobile number');
                $("#folio-invalid").removeClass("hidden");
                $("#mobile-valid").addClass("hidden");
                $(".otp").addClass("OTPBox");
                $("#getOTP").prop("disabled", true);
                $(".otp_div").hide();


                return false;
            }
        } else {

            $("#folio-invalid").removeClass("hidden");
            $("#mobile-valid").addClass("hidden");
            $(".otp").addClass("OTPBox");
            $("#getOTP").prop("disabled", true);
            return false;
        }
    });

    $(document).on('click', '#getOTP', function() {
        
        $(this).prop('disabled', true);
var current_obj = $(this);


        $.ajax({
            url: "<?= base_url('getOTP') ?>",
            cache: false,
            type: "POST",
            data: {
                mobile: $('#mobile').val(),
				type: 'register',
				csrf_test_name: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON", 
            success: function(res) {
                if(res.status){


                    $("#otp").prop('disabled', false);
                    //$("#otp").val(res.otp);
                    $("#signupBtn").prop('disabled', false); 

                    let time = $(".time-block .time");
let closeSeconds = 60;
setTimeout(function() {

    let interval = setInterval(function() {
        
        $(".time-block").show();
        time.html(closeSeconds + 's');
        closeSeconds--;

        if (closeSeconds < 0) {
            $('#getOTP').text('Resend OTP');
            $(".time-block").hide();
            $('#getOTP').prop('disabled', false);
            clearInterval(interval);
        }

    }, 1000)
}, 1000);
                } else {
                    current_obj.prop('disabled', false);
                    $('#signup-modal-body').prepend(`<div class="alert alert-danger">` + res.msg + `</div>`);

                }
                
            }
        });
    });

    $(document).on('click', '#signupBtn', function() {
        $(this).html($(this).text() + ' ' + '<i class="fa fa-spinner fa-pulse fa-x fa-fw"></i>');
        $(this).prop('disabled', true);
        $.ajax({
            url: "<?= base_url('signup') ?>",
            cache: false,
            type: "POST",
            data: $('form#signupForm').serialize(),
            dataType: "JSON",
            success: function(res) {
                //location.reload();
                console.log(res); //return;
                if (res.error == 1) {
                    $('#signup-modal-body').prepend(`<div class="alert alert-danger">` + res.msg + `</div>`);
                    $('#signupBtn').prop('disabled', false);
                    $('html, body').animate({
                        scrollTop: $("#signup-modal-body").offset().top
                    }, 2000);
                } else {
					if ($("#booking_login").data('redirect') == "1") {
						window.location.reload();
					} else {
						window.location.replace("<?php echo base_url('my-profile'); ?>");
					}
                }
            }
        });
    });

    $(document).on('click', '#logoutBtn', function() {
        $.ajax({
            url: "<?= base_url('logout') ?>",
            cache: false,
            type: "POST",
            data: {csrf_test_name: '<?php echo $this->security->get_csrf_hash(); ?>'},
            dataType: "JSON",
            success: function(res) {
                location.reload();
            }
        });
    });


    $(document).on("keyup", "#login_mobile", function() {

        
        $('#login-modal-body').find('.alert-danger').remove();
        $('#login-modal-body').find('.login_time-block').hide();
        $("#login_getOTP").text('Get OTP');
        var mobNum = $(this).val();
        var filter = /^\d*(?:\.\d{1,2})?$/;

        if (filter.test(mobNum)) {
            if (mobNum.length == 10) {

                $("#login_mobile-valid").removeClass("hidden");
                $("#login_folio-invalid").addClass("hidden");
                $("#login_getOTP").prop("disabled", false);
                $(".login_otp_div").show();

            } else {
                //alert('Please put 10  digit mobile number');
                $("#login_folio-invalid").removeClass("hidden");
                $("#login_mobile-valid").addClass("hidden");
                $("#login_getOTP").prop("disabled", true);
                $(".login_otp_div").hide();


                return false;
            }
        } else {

            $("#login_folio-invalid").removeClass("hidden");
            $("#login_mobile-valid").addClass("hidden");
            $("#login_getOTP").prop("disabled", true);
            return false;
        }
    });

    $(document).on('click', '#login_getOTP', function() {
        $(this).prop('disabled', true);
        var current_obj = $(this);
        
        $.ajax({
            url: "<?= base_url('getOTP') ?>",
            cache: false,
            type: "POST",
            data: {
                mobile: $('#login_mobile').val(),
				type: 'login',
				csrf_test_name: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON",
            success: function(res) {
                if(res.status){
                    $("#login_otp").prop('disabled', false);
                    $("#loginBtn").prop('disabled', false);

                    let time = $(".login_time-block .login_time");
        let closeSeconds = 60;
        setTimeout(function() {

            let interval = setInterval(function() {
                $(".login_time-block").show();
                time.html(closeSeconds + 's');
                closeSeconds--;

                if (closeSeconds < 0) {
                $('#login_getOTP').text('Resend OTP');

                    $(".login_time-block").hide();
                    $('#login_getOTP').prop('disabled', false);
                    clearInterval(interval);
                }

            }, 1000)
        }, 1000);


                } else { 
                    current_obj.prop('disabled', false);
                    $('#login-modal-body').prepend(`<div class="alert alert-danger">` + res.msg + `</div>`);

                }
                
            }
        });
    });

    $(document).on('click', '#loginBtn', function() {
        $(this).html($(this).text() + ' ' + '<i class="fa fa-spinner fa-pulse fa-x fa-fw"></i>');
        $(this).prop('disabled', true);
        $.ajax({
            url: "<?= base_url('login') ?>",
            cache: false,
            type: "POST",
            data: $('form#loginForm').serialize(),
            dataType: "JSON",
            success: function(res) {
                //location.reload();
                //console.log(res); //return;
                if (res.error == 1) {
                    $('#login-modal-body').find('.alert-danger').remove();
                    $('#login-modal-body').prepend(`<div class="alert alert-danger">` + res.msg + `</div>`);
                    $('#loginBtn').prop('disabled', false);
                    
                } else {
					if ($("#booking_login").data('redirect') == "1") {
						window.location.reload();
					} else {
						window.location.replace("<?php echo base_url('my-profile'); ?>");
					}
                }
            }
        });
    });
</script>
<script>
$(document).ready(function() {
	$('#search-btn').on("click", function() {
		$("#search-section").toggle('slow', 'linear', function() {
			if ($(this).css('display') == 'block') {
				$(".carousel-caption").css('right', '30%');
			} else {
				$(".carousel-caption").css('right', '0');
			}
		});
	});
});
</script>
</body>

</html>