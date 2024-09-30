<!-- ============================ Page Title Start================================== -->
<div class="image-cover page-title" style="background:url(<?= base_url('public/frontend_assets/images/banner2.jpg'); ?>) no-repeat; background-size: cover; background-position: center;" data-overlay="6">
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
									<form action="<?php echo $payudata['PAYU_BASE_URL'].'/_payment';?>" method="post" class="" name="payuForm" id="payuForm">
										<input type="hidden" name="key" value="<?php echo $payudata['MERCHANT_KEY'] ?>" />
										<input type="hidden" name="hash" value="<?php echo $payudata['hash'] ?>"/>
										<input type="hidden" name="txnid" id="txnid" value="<?php echo $payudata['txnid'] ?>" />
										<input type="hidden" name="amount" id="amount" value="<?php echo $payudata['amount'] ?>" />
										<input type="hidden" name="productinfo" id="productinfo" value="<?php echo $payudata['productinfo'] ?>" />
										<input type="hidden" name="firstname" id="firstname" value="<?php echo $payudata['firstname'] ?>" />
										<input type="hidden" name="email" id="email" value="<?php echo $payudata['email'] ?>" />
										<input type="hidden" name="phone" id="phone" value="<?php echo $payudata['phone'] ?>" />
										<input type="hidden" name="surl" value="<?php echo $payudata['surl']?>"/>
										<input type="hidden" name="furl" value="<?php echo $payudata['furl']?>" />
										<input type="hidden" name="udf1" value="<?php echo $payudata['udf1']?>" />
										<input type="hidden" name="udf2" value="<?php echo $payudata['udf2']?>" />
										<input type="hidden" name="udf3" value="<?php echo $payudata['udf3']?>" />
										<input type="hidden" name="udf5" value="<?php echo $payudata['udf5']?>" />
										<!--<input type="submit" class="btn btn-theme" value="Proceed to Pay">-->
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
	$("#payuForm").submit();
});
</script>