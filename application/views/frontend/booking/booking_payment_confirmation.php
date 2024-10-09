<script>
	function preventBack() {
		window.history.forward();
	}

	setTimeout("preventBack()", 0);
	window.onunload = function() {
		null
	};
</script>
<script>
	$(document).ready(function() {
		window.history.forward();
		var start = new Date;

		setInterval(function() {
			var redirectUrl = "<?= isset($redirect) && $redirect != '' ? htmlspecialchars($redirect, ENT_QUOTES, 'UTF-8') : '/default-safe-url'; ?>";
			$(location).attr("href", redirectUrl);
		}, 2000);

	});
</script>
<center>
	<h2>Please wait..</h2>
</center>