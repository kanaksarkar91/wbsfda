<section class="section">
    <div class="container text-center">
        <!-- <h1 class="title">Proceed</h1> -->
    </div>
    <div style="width: 80%; margin:0 auto; padding-top: 30px; display: none">
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
            <button class="btn btn-blue" id="ajaxSubmit">Proceed to Pay <i class="fa fa-long-arrow-right ml-2"></i></button>
        </form>
    </div>
</section>

<script type="text/javascript">
    window.onload = function(){
        $('#preloader').css('display','block');
        document.forms['payuForm'].submit();
	}
</script>
