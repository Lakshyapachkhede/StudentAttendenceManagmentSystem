<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="nav-small nav-student d-fcc  jc-sb">

	<div class="nav-left d-fcc ml10">
		<a href="/attendence"><img src="/attendence/img/logo.png" alt="Logo" class="logo"></a>
		<p><span>Sam</span>System</p> 
	</div>


	<div class="nav-right d-fcc mr-10">
		<ul class="nav-links-ul d-fcc ul-sn">
			<!-- <li><a href="" class="nav-links">classes</a></li> -->

			<?php 
			if ($_SESSION['type'] == "student") {

			echo" <li><a href='/attendence/student/profile.php?id=" . $_SESSION['user_id']. "&action=view' class='nav-links'>profile</a></li>";		
}
			else {
				echo" <li><a href='/attendence/teacher/profile.php?id=" .$_SESSION['user_id']. "&action=view' class='nav-links'>profile</a></li>";

			}




		?>



			<li><a href="/attendence/auth/logout.php" class="nav-links">log out</a></li>
		</ul>
		<ul class="nav-buttons-ul d-fcc ul-sn">

		</ul>
	</div>


</nav>