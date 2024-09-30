<script type="text/javascript">
	window.history.forward();
	function noBack() {
		window.history.forward();
	}
</script>
<script>
$(document).ready(function() {
	$(location).attr("href", "<?= isset($redirect) && $redirect != '' ? $redirect : '';?>");
});
</script>