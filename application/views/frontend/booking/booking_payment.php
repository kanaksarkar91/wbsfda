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
							<li class="active"><span>2</span>Payment</li>
							<li><span>3</span>Confirmation!</li>
						</ul>
					</div>

					<div class="checkout-body">
						<div class="row mb-5">

							<div class="col-lg-12 col-md-12 col-sm-12 text-center">
								<div style="width: 80%; margin:0 auto; padding-top: 30px;" class="text-center">
									<form method="POST" action="<?= $razorpaydata['checkout_url']; ?>" id="razorpayForm">
										<input type="hidden" name="key_id" value="<?= $razorpaydata['key_id']; ?>" />
										<input type="hidden" name="amount" value=<?= $razorpaydata['amount']; ?> />
										<input type="hidden" name="order_id" value="<?= $razorpaydata['order_id']; ?>" />
										<input type="hidden" name="image" value="<?= base_url(); ?>public/frontend_assets/assets/images/wbidc-logo.png" />
										<input type="hidden" name="prefill[name]" value="<?= $razorpaydata['entity_name']; ?>" />
										<input type="hidden" name="prefill[contact]" value="<?= $razorpaydata['phone']; ?>" />
										<input type="hidden" name="prefill[email]" value="<?= $razorpaydata['email']; ?>" />

										<!--<input type="hidden" name="notes[entity_name]" value="<?= $razorpaydata['entity_name']; ?>"/>
									  <input type="hidden" name="notes[industrial_park]" value="<?= $razorpaydata['industrial_park']; ?>"/>
									  <input type="hidden" name="notes[memo_reference_no]" value="<?= $razorpaydata['memo_reference_no']; ?>"/>-->
										<input type="hidden" name="callback_url" value="<?= $razorpaydata['callback_url']; ?>" />
										<input type="hidden" name="cancel_url" value="<?= $razorpaydata['cancel_url']; ?>" />
										<h4 class="text-primary">Please Wait..</h4>
									</form>
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
<script>
	$(document).ready(function() {
		$("#razorpayForm").submit();
	});
</script>