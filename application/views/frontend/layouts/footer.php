<footer>
    <div class="big_footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <a href="" class="footer_logo"><img src="<?= base_url(); ?>public/frontend_assets/assets/img/logo.png" alt=""></a>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h4>Quick Links</h4>
                    <ul class="footer_menu">
                        <li><a href="">Home </a></li>
                        <li><a href="">About Us </a></li>
                        <li><a href="">Gallery </a></li>
                        <li><a href="">Holiday Calender </a></li>
                        <li><a href="">Disclaimer </a></li>
                        <li><a href="">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4>Related Links</h4>
                    <ul class="footer_menu">
                        <li><a href="">Wild Bengal </a></li>
                        <li><a href="">West Bengal Forest Development Corporation </a></li>
                        <li><a href="">West Bengal Pulpwood Development Corporation </a></li>
                        <li><a href="">West Bengal Zoo Authority </a></li>
                        <li><a href="">West Bengal Forest and Biodiversity Conservation Project </a></li>
                        <li><a href="">West Bengal Wasteland Development Corporation </a></li>
                        <li><a href="">West Bengal State Forest Development Agency </a></li>
                        <li><a href="">Bengal Nature Trails</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 Contact_list">
                    <h4>Contact Us</h4>
                    <p class="map-ico"><img src="<?= base_url(); ?>public/frontend_assets/assets/img/map_ico.png" alt="">Aranya Bhavan,BLock LA-10A, Sector- III, Salt Lake, Kolkata, West Bengal 700106</p>
                    <p><img src="<?= base_url(); ?>public/frontend_assets/assets/img/ph_ico.png" alt=""> <a href="tel:+918337066882">+91 8337066882</a></p>
                    <p><img src="<?= base_url(); ?>public/frontend_assets/assets/img/mail_ico.png" alt=""> <a href="mailto:wbsfdaecotourism@gmail.com">wbsfdaecotourism@gmail.com</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="copy_footer">
        <div class="container">
            <div class="col-md-12">
                <hr class="mb-0">
                <p>© Copyright 2024 All Rights Reserved by <a href="">WBSFDA</a></p>
            </div>
        </div>
    </div>
</footer>

<!-- Log In Modal -->
<div class="modal" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog login-box">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Log In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body icon-form pb-0" id="login-modal-body">
                <div class="login-form">
                <form class="login-wrapper-contents-form custom-form" action="#" method="post" id="loginForm" autocomplete="off">
				<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                        <div class="form-group">
                            <label>Phone no</label>
                            <div class="input-with-icon">
                                <input autocomplete="off" type="text" class="form-control" placeholder="Phone no" id="login_mobile" name="login_mobile">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <p id="login_mobile-valid" class="hidden mob">
                                <!-- Valid Mobile No -->
                            </p>
                            <p id="login_folio-invalid" class="hidden mob-helpers">
                                Invalid mobile No
                            </p>
                        </div>



                        <div class="form-group login_otp_div">
                            <button type="button" class="btn btn-green w-100 mt-4" id="login_getOTP" disabled="">Get OTP</button>
                            <div class="pull-right login_time-block">
                                Resend OTP in
                                <strong class="login_time">59s</strong>
                            </div>
                        </div>

                        <div class="form-group login_otp_div">
                            <label>OTP</label>
                            <div class="input-with-icon">
                                <input type="password" class="form-control" id="login_otp" name="login_otp" placeholder="ENTER OTP">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
						
						<div class="mb-3">
							<button type="button" id="loginBtn" class="btn btn-green w-100 mt-4 pop-login" disabled>Login</button>
						</div>

                </form>
				</div>
            </div>
            <div class="text-center">
                <p class="my-3 fw-bold text-dark">
                <a data-bs-toggle="modal" data-bs-target="#signup" class="link">Don't Have an Account. Signup</a></p>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Sign Up Modal -->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Create An Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body icon-form" id="signup-modal-body">
                <div class="login-form">
                    <form class="" action="#" method="post" id="signupForm" autocomplete="off">
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <!-- <div class="row"> -->
							<div class="form-group">
								<label>Full Name<i class="req">*</i></label>
								<div class="input-with-icon">
									<input autocomplete="off" type="text" class="form-control" placeholder="Full Name" name="first_name" required>
									<i class="bi bi-person-fill"></i>
								</div>
							</div>
	
							<!--<div class="form-group col-md-6 px-3">
								<label>Last Name<i class="req">*</i></label>
								<div class="input-with-icon">
									<input type="text" class="form-control" placeholder="Last Name" name="last_name" required>
									<i class="bi bi-person-fill"></i>
								</div>
							</div>-->
                        <!-- </div>   -->                      

                        <div class="form-group">
                            <label>Phone No<i class="req">*</i></label>
                            <div class="input-with-icon">
                                <input autocomplete="off" type="text" class="form-control" placeholder="Phone no" id="mobile" name="mobile" maxlength="10">
                                <i class="bi bi-telephone-fill"></i>

                            </div>
                            <p id="mobile-valid" class="hidden mob">
                                <!-- Valid Mobile No -->
                            </p>
                            <p id="folio-invalid" class="hidden mob-helpers">
                                Invalid mobile No
                            </p>
                        </div>

                        <div class="form-group otp_div">
                            <button type="button" class="btn btn-green submit-btn w-100 mt-4" id="getOTP" disabled="">Get OTP</button>
                            <div class="pull-right time-block">
                                Resend OTP in
                                <strong class="time">59s</strong>
                            </div>
                        </div>

                        <div class="form-group otp_div">
                            <label>OTP</label>
                            <div class="input-with-icon">
                                <input autocomplete="off" type="password" class="form-control" id="otp" name="otp" placeholder="ENTER OTP">
                                <i class="bi bi-unlock-fill"></i>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label>Email ID<i class="req">*</i></label>
                            <div class="input-with-icon">
                                <input autocomplete="off" type="text" class="form-control" placeholder="Email ID" name="email" required>
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-green w-100 mt-4 pop-login" id="signupBtn" disabled="disabled">Signup</button>
                        </div>

                    </form>
                </div>
                <div class="text-center">
                    <p class="mt-3 fw-bold text-dark"><a data-bs-toggle="modal" data-bs-target="#login" class="link" >Already Have an Account? Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

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
<!-- Bootstrap core JavaScript -->
<script src="<?= base_url(); ?>public/frontend_assets/assets/js/bootstrap.bundle.min.js"></script>
<script>
    var $ = jQuery.noConflict();
    $(document).ready(function() {
        var header = $(".fixed-header");
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 1 && $(this).width() > 769) {
                header.addClass("fixed-header-top");
            } else {
                header.removeClass('fixed-header-top');
            }
        });
    });
</script>
<script src="<?= base_url(); ?>public/frontend_assets/assets/js/owl.carousel.js"></script>
<!-- For Gallery-->
<script type="text/javascript" src="<?= base_url(); ?>public/frontend_assets/assets/js/simple-lightbox.js"></script>
<!-- / For Gallery-->

<script src="<?= base_url(); ?>public/frontend_assets/assets/js/jquery4a5f.js"></script>
<!-- <script src="<?= base_url(); ?>public/frontend_assets/assets/js/owl.carousel.js"></script> -->

<script src="<?= base_url(); ?>public/frontend_assets/assets/js/stellarnav.js"></script>
<script src="<?= base_url(); ?>public/frontend_assets/assets/js/theme.js"></script>
<script src="<?= base_url(); ?>public/frontend_assets/assets/js/wow.js"></script>

<script src="<?= base_url(); ?>public/frontend_assets/assets/js/waypoint.min.js"></script>
<script src="<?= base_url(); ?>public/frontend_assets/assets/js/jquery.counterup.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->


<script type="text/javascript">
    jQuery(document).ready(function($) {
        jQuery('.stellarnav').stellarNav({
            //theme: 'dark',
            breakpoint: 767,
            position: 'right',
            //phoneBtn: '18009997788',
            //locationBtn: 'https://www.google.com/maps'
        });
    });
</script>

<script>
    wow = new WOW({
        animateClass: 'animated',
        offset: 100,
        mobile: false,
    });
    wow.init();
</script>
<script>
    $(function() {
        $("#datepicker").datepicker();
        $("#datepicker1").datepicker();
        $("#datepicker2").datepicker();
        $("#datepicker3").datepicker();
    });
</script>
<script>
    $(function() {
        $('.destinationCarousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        })
    });
</script>
<script>
    $(function() {
        var $gallery = $('.gallery a').simpleLightbox();

        $gallery.on('show.simplelightbox', function() {
                console.log('Requested for showing');
            })
            .on('shown.simplelightbox', function() {
                console.log('Shown');
            })
            .on('close.simplelightbox', function() {
                console.log('Requested for closing');
            })
            .on('closed.simplelightbox', function() {
                console.log('Closed');
            })
            .on('change.simplelightbox', function() {
                console.log('Requested for change');
            })
            .on('next.simplelightbox', function() {
                console.log('Requested for next');
            })
            .on('prev.simplelightbox', function() {
                console.log('Requested for prev');
            })
            .on('nextImageLoaded.simplelightbox', function() {
                console.log('Next image loaded');
            })
            .on('prevImageLoaded.simplelightbox', function() {
                console.log('Prev image loaded');
            })
            .on('changed.simplelightbox', function() {
                console.log('Image changed');
            })
            .on('nextDone.simplelightbox', function() {
                console.log('Image changed to next');
            })
            .on('prevDone.simplelightbox', function() {
                console.log('Image changed to prev');
            })
            .on('error.simplelightbox', function(e) {
                console.log('No image found, go to the next/prev');
                console.log(e);
            });
    });
</script>

<script type='text/javascript'>
    jQuery(document).ready(function(e) {
        var n;
        e(".numbercount").counterUp({
            delay: 10,
            time: 1e3
        })
    });
    // jQuery(document).ready(function () {

    // 	jQuery(".numbercount").after('<h2 style="margin: 0px;display: inline-block;color: white;"><sup>+</sup></h2>');
    // });
</script>

<script>
$(document).ready(function(){
	$('form').attr('autocomplete', 'off');
	$("input").attr("autocomplete", "off"); 
});
</script>

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
    $(document).ready(function() {
        var previousURL = document.referrer;
        $("a.prevUrl").attr("href", previousURL);
    });

    // $("#check_in_out").daterangepicker();

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
                csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON",
            success: function(res) {
                if (res.status) {


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
                    $('#login-modal-body').prepend(`<div class="alert alert-danger">` + res.msg + `</div>`);

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
                        window.location.replace("<?= base_url('my-profile'); ?>");
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
            data: {
                csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'
            },
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
                csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'
            },
            dataType: "JSON",
            success: function(res) {
                if (res.status) {
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
                        window.location.replace("<?= base_url('my-profile'); ?>");
                    }
                }
            }
        });
    });
</script>




</body>

</html>