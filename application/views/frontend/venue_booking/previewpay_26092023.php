<section class="page">
    <div class="page-header" style="position: relative;">
        <div class="overlay" style="top: 0;
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 0;
        background-image: linear-gradient(180deg, black, #808080);"></div>
    </div>
</section>

<section class="section">
    <div class="container text-center">
         <!--<h1 class="title">Proceed</h1> -->
    </div>
    <div style="width: 80%; margin:0 auto; padding-top: 30px; text-align:center;">
        <form action="<?= $payudata['PAYU_BASE_URL'].'/_payment';?>" method="post" class="" name="payuForm" id="payuForm">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
            <input type="hidden" name="key" value="<?= $payudata['MERCHANT_KEY'] ?>" />
            <input type="hidden" name="hash" value="<?= $payudata['hash'] ?>"/>
            <input type="hidden" name="txnid" id="txnid" value="<?= $payudata['txnid'] ?>" />
            <input type="hidden" name="amount" id="amount" value="<?= $payudata['amount'] ?>" />
            <input type="hidden" name="productinfo" id="productinfo" value="<?= $payudata['productinfo'] ?>" />
            <input type="hidden" name="firstname" id="firstname" value="<?= $payudata['firstname'] ?>" />
            <input type="hidden" name="email" id="email" value="<?= $payudata['email'] ?>" />
            <input type="hidden" name="phone" id="phone" value="<?= $payudata['phone'] ?>" />
            <input type="hidden" name="surl" value="<?= $payudata['surl']?>"/>
            <input type="hidden" name="furl" value="<?= $payudata['furl']?>" />
            <!--<button class="btn btn-blue" id="ajaxSubmit">Proceed to Pay <i class="fa fa-long-arrow-right ml-2"></i></button>-->
            <h4 class="text-primary">Please Wait..</h4>

        </form>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
	$("#payuForm").submit();
});
</script>
