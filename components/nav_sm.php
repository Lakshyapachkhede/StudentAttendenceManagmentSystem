<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
?>

<nav class="nav-small nav-student d-fcc  jc-sb">

	<div class="nav-left d-fcc ml10">
		<a href="/"><img src="/img/logo.png" alt="Logo" class="logo"></a>
		<p><span>Sam</span>System</p> 
	</div>


	<div class="nav-right d-fcc mr-10">

		
		<ul class="nav-links-ul side-bar d-fcc ul-sn" id="side-bar">
			<!-- <li><a href="" class="nav-links">classes</a></li> -->
			<img src="/img/remove.png" alt="Close" class="icon-s nav-icon-hide" id="nav-close-btn">

			<li><a href="/auth/logout.php" class="nav-links">log out</a></li>

			<?php 
			if ($_SESSION['type'] == "student") {

				echo" <li><a href='/student/profile.php?id=" . $_SESSION['user_id']. "&action=view' class='nav-links'>profile</a></li>";		
			}
			else if ($_SESSION['type'] == "teacher") {
				echo" <li><a href='/teacher/profile.php?id=" .$_SESSION['user_id']. "&action=view' class='nav-links'>profile</a></li>";	

				echo "<li><a href='/class/create_class.php' class='btn'>Create Class</a></li>";
			} else { // for admin

			}




			?>



		</ul>
		<img src="/img/nav.png" alt="Close" class="icon-s nav-icon-hide"  id="nav-open-btn">
	</div>

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

</nav>