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
        <form action="<?= $ccavenue_redirect_url;?>" method="post" name="redirect" id="ccAvenueForm">
            <input type="hidden" name="encRequest" value="<?= $encrypted_data;?>" />
            <input type="hidden" name="access_code" value="<?= $access_code;?>"/>
            <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
            <h4 class="text-primary">Please Wait..</h4>
        </form>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
	$("#ccAvenueForm").submit();
});
</script>
