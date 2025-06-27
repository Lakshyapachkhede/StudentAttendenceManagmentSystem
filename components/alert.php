<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}


if (isset($_SESSION['alert_message'])){
	echo "	<div class='alert show'>
	<img src='/img/check.png' alt='Check Mark'>
	<p class='f-r'>" . $_SESSION['alert_message'] ."</p>
	</div>";
	unset($_SESSION['alert_message']) ;
}
?>

<script type="text/javascript">
	let messages = document.querySelectorAll(".alert");

	messages.forEach(function(message) {
		message.addEventListener("click", function() {
        // Do something on click
			message.classList.toggle("show");
		});
	});






</script>