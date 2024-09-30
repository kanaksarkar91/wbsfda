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
									<form action="<?php echo $ccavenue_redirect_url;?>" method="post" name="redirect" id="ccAvenueForm">
										<input type="hidden" name="encRequest" value="<?php echo $encrypted_data;?>" />
										<input type="hidden" name="access_code" value="<?php echo $access_code;?>"/>
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
	$("#ccAvenueForm").submit();
});
</script>