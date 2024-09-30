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
							<li><span><i class="ti-check"></i></span>Venue Booking Detail</li>
							<li><span><i class="ti-check"></i></span>Payment</li>
							<li class="active"><span>3</span>Confirmation!</li>
						</ul>
					</div>

					<div class="checkout-body">
						<div class="row mb-5">

							<div class="col-lg-12 col-md-12 col-sm-12 text-center">
								<div style="width: 80%; margin:0 auto; padding-top: 30px;" class="text-center">
									<?php if ($status == 'SUCCESS') { ?>
									<h4 class="text-success">Congratulations! Your Payment Successful and Booking is confirmed.<br><br><?= ($booking_id && $booking_id != '') ? 'Your Booking No. ' . $booking_id : ''; ?></h4>
									<?php } elseif ($status == 'FAILURE') { ?>
									<h4 class="text-danger">Payment Failed. Please try again.</h4>
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
<script type="text/javascript">
    $(window).on('load', function() {
        $('#paymentstatusModal').modal('show');
    });
</script>
<div class="modal hide fade" id="paymentstatusModal">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-body text-center">
        <?php if ($status == 'SUCCESS') { ?>
		<h6 class="text-success">Congratulations! Your Payment is successfully completed and Booking Confirmed.<br><br><?= ($booking_id) && $booking_id!= '' ? 'Booking No. ' . $booking_id : ''; ?><?= isset($booking_det->txnid) && $booking_det->txnid != '' ? '<br>Transaction Ref. No. ' . $booking_det->txnid : ''; ?><?= isset($booking_det->amount) && $booking_det->amount != '' ? '<br>Amount ₹' . $booking_det->amount : ''; ?></h6>
		<?php } elseif ($status == 'FAILURE') { ?>
		<h6 class="text-danger">Payment Failed. Please try again.</h6>
		<?php } ?>

		<?php 
		if ($status == 'SUCCESS') 
			$lnk = base_url('admin/venue_reservation');
		if ($status == 'FAILURE')
			$lnk = base_url();
		?>
        <div><a href="<?= $lnk; ?>" class="btn btn-primary">OK</a></div>
    </div>
    <!-- <div class="modal-footer">
		<?php 
		if ($status == 'SUCCESS') 
			$lnk = base_url('admin/venue_reservation');
		if ($status == 'FAILURE')
			$lnk = base_url();
		?>
        <a href="<?= $lnk; ?>" class="btn btn-primary">OK</a>
    </div> -->
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