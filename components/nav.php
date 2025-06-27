<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
?>

<nav class="navbar d-fcc">

	<div class="nav-left d-fcc">
		<a href="/"><img src="/img/logo.png" alt="Logo" class="logo"></a>
		<p><span>Sam</span>System</p> 
	</div>


	<div class="nav-right d-fcc side-bar" id="side-bar">
		<ul class="nav-links-ul d-fcc ul-sn">
			<img src="/img/remove.png" alt="Close" class="icon-s nav-icon-hide" id="nav-close-btn">
			<li><a href="" class="nav-links">Features</a></li>
			<li><a href="" class="nav-links">Guide</a></li>
			<li><a href="" class="nav-links">About</a></li>
		</ul>
		<ul class="nav-buttons-ul d-fcc ul-sn">

			<?php

			if (isset($_SESSION['login'])){
				echo "<li><a href='/auth/logout.php' class='btn-o'>Log out</a></li>";
			}
			else{
				echo "<li><a href='/auth/login.php'class='login-link'>Log In</a></li>";
				echo "<li><a href='/auth/signup.php' class='btn-o'>Sign Up</a></li>";
			}


			?>


		</ul>

	</div>

	<img src="/img/nav.png" alt="Close" class="icon-s nav-icon-hide"  id="nav-open-btn">
</nav>



<script type="text/javascript">

	let nav = document.getElementById("side-bar");
	let closeBtn = document.getElementById("nav-close-btn");
	let openBtn = document.getElementById("nav-open-btn");

	closeBtn.addEventListener("click", ()=>{
		nav.classList.toggle("show");

	});	

	openBtn.addEventListener("click", ()=>{
		nav.classList.toggle("show");

	});


</script>