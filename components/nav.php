<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

		<nav class="navbar d-fcc">

			<div class="nav-left d-fcc">
				<a href="/attendence"><img src="/attendence/img/logo.png" alt="Logo" class="logo"></a>
				<p><span>Sam</span>System</p> 
			</div>


			<div class="nav-right d-fcc">
				<ul class="nav-links-ul d-fcc ul-sn">
					<li><a href="" class="nav-links">Features</a></li>
					<li><a href="" class="nav-links">Guide</a></li>
					<li><a href="" class="nav-links">About</a></li>
				</ul>
				<ul class="nav-buttons-ul d-fcc ul-sn">

				<?php

					if (isset($_SESSION['login'])){
						echo "<li><a href='/attendence/auth/logout.php' class='btn-o'>Log out</a></li>";
					}
					else{
					echo "<li><a href='/attendence/auth/login.php'class='login-link'>Log In</a></li>";
					echo "<li><a href='/attendence/auth/signup.php' class='btn-o'>Sign Up</a></li>";
					}


				?>


				</ul>
			</div>


		</nav>