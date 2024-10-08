<!-- ============================ Page Title Start================================== -->
<div class="image-cover page-title" style="background:url(<?= base_url('public/frontend_assets/assets/img/slider/06.jpg'); ?>) no-repeat; background-size: cover; background-position: center;" data-overlay="6">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">

				<h2 class="ipt-title">Checkout</h2>
				<span class="ipn-subtitle text-light">Checkout page short tagline</span>

			</div>
		</div>
	</div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- =================== Sidebar Search ==================== -->
<section class="gray">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">

				<!-- 2st Step Checkout -->
				<div class="checkout-wrap">

					<div class="checkout-head">
						<ul>
							<li><span><i class="ti-check"></i></span>Customer Detail</li>
							<li><span><i class="ti-check"></i></span>Payment</li>
							<li class="active"><span>3</span>Confirmation!</li>
						</ul>
					</div>

					<div class="checkout-body">
						<div class="row mb-5">

							<div class="col-lg-12 col-md-12 col-sm-12 text-center">
								<div style="width: 80%; margin:0 auto; padding-top: 30px;" class="text-center">
									<?php if ($status == 'SUCCESS') { ?>
										<h4 class="text-success text-center mb-3 fw-bold"><i class="bi bi-check-circle-fill fs-1"></i><br>Congratulations!</h4>
										<h5 class="text-success text-center mb-4">Your Payment is Successful and Booking is confirmed.</h5>
										<p class="text-center"><?= isset($booking_det->booking_no) && $booking_det->booking_no != '' ? '<b>Your Booking No.: </b> ' . $booking_det->booking_no : ''; ?></p>
									<?php } elseif ($status == 'FAILURE') { ?>
										<h4 class="text-danger text-center">Payment Failed. Please try again.</h4>
									<?php } elseif ($status == 'CANCELED') { ?>
										<h4 class="text-danger text-center">Payment Canceled. Please try again.</h4>
									<?php } ?>
								</div>
							</div>

						</div>

					</div>

				</div>

			</div>
		</div>
	</div>
</section>
<!-- =================== Sidebar Search ==================== -->


<!------MODAL SHOW WHEN PAGE LOAD---->

<div class="modal hide fade" id="paymentstatusModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<?php if ($status == 'SUCCESS') { ?>
					<h4 class="text-success text-center mb-3 fw-bold"><i class="bi bi-check-circle-fill fs-1"></i><br>Congratulations!</h4>
					<h5 class="text-success text-center mb-4">Your Payment is Successful and Booking is Confirmed.</h5>
					<p class="text-center"><?= isset($booking_det->booking_no) && $booking_det->booking_no != '' ? '<b>Booking No.: </b> ' . $booking_det->booking_no : ''; ?><?= isset($booking_det->transaction_ref_id) && $booking_det->transaction_ref_id != '' ? '<br><b>Transaction Ref. No.: </b> ' . $booking_det->transaction_ref_id : ''; ?><?= isset($booking_det->order_id) && $booking_det->order_id != '' ? '<br><b>Order Number: </b> ' . $booking_det->order_id : ''; ?><?= isset($booking_det->amount) && $booking_det->amount != '' ? '<br><b>Amount: </b> ₹' . $booking_det->amount : ''; ?></p>
				<?php } elseif ($status == 'FAILURE') { ?>
					<h5 class="text-danger text-center">Payment Failed. Please try again.</h5>
				<?php } elseif ($status == 'CANCELED') { ?>
					<h5 class="text-danger text-center">Payment Canceled. Please try again.</h5>
				<?php } ?>
			</div>
			<div class="modal-footer">
				<?php
				if ($status == 'SUCCESS')
					$lnk = base_url('my-booking');
				if ($status == 'FAILURE')
					$lnk = base_url();
				if ($status == 'CANCELED')
					$lnk = base_url();
				?>
				<a href="<?= $lnk; ?>" class="btn btn-primary">OK</a>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		function disableBack() {
			window.history.forward()
		}
		window.onload = disableBack();
		window.onpageshow = function(e) {
			if (e.persisted)
				disableBack();
		}
	});
</script>

<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		var myModal = new bootstrap.Modal(document.getElementById('paymentstatusModal'));
		myModal.show();
	});
</script>