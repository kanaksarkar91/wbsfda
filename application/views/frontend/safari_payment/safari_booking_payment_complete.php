<script type="text/javascript">
	window.history.forward();
	function noBack() {
		window.history.forward();
	}
</script>
<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel">
			<?php if ($status == 'SUCCESS') { ?>
				Payment Successful
			<?php } elseif ($status == 'FAILURE') { ?>
				Payment Failure
			<?php } else if($status == 'CANCELED') { ?>
				Payment Canceled
			<?php } ?></h5>
        <?php /*?><a href="<?= base_url(); ?>">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		</a><?php */?>
      </div>
      <div class="modal-body text-center">
        <?php if ($status == 'SUCCESS') { ?>
		<h4 class="text-success text-center mb-3 fw-bold"><i class="bi bi-check-circle-fill fs-1"></i><br>Congratulations!</h4>
		<h5 class="text-success text-center mb-4">Your Payment is Successful and Booking is confirmed.</h5>
		<p class="text-center"><?= isset($booking_det['booking_number']) && $booking_det['booking_number'] != '' ? '<b>Booking No. :</b> ' . $booking_det['booking_number'] : ''; ?><?= isset($booking_det['order_id']) && $booking_det['order_id'] != '' ? '<br><b>Order Number :</b> ' . $booking_det['order_id'] : ''; ?><?= isset($booking_det['amount']) && $booking_det['amount'] != '' ? '<br><b>Amount</b> : ' . formatIndianCurrency($booking_det['amount']) : ''; ?></p>
		
		<a href="<?= base_url('my-booking');?>" class="btn btn-secondary" data-dismiss="modal">Close</a>
		
		<?php } elseif ($status == 'FAILURE') { ?>
		<h4 class="text-danger text-center">Payment Failed. Please try again.</h4>
		<a href="<?= base_url(); ?>" class="btn btn-secondary" data-dismiss="modal">Close</a>
		<?php } elseif ($status == 'CANCELED') { ?>
		<h4 class="text-danger text-center">Payment Canceled. Please try again.</h4>
		<a href="<?= base_url(); ?>" class="btn btn-secondary" data-dismiss="modal">Close</a>
		<?php } ?>
		
      </div>
     <!-- <div class="modal-footer">
        
      </div>-->
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
	var myModal = new bootstrap.Modal(document.getElementById('paymentModal'));
	myModal.show();
});
</script>

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