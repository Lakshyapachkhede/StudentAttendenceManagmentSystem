<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SAM - Log In</title>
	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

	<div class="container-l ">

		<?php  require '../components/nav.php';?>

		<div class="form d-f-col">

			<h1 class="tac mb10">Log In to SamSystem</h1>

			<input type="email" name="email" class="f-input" placeholder="enter your email">

			<div class="f-input p0 d-fcc jc-sb">
				<input type="password" name="password" placeholder="password" class=" f-input input-none " id="password">
				<img src="\attendence\img\show.png" alt="Show" class="input-icon" id="password-icon">
			</div>		

			<button type="submit" class="f-btn mb10 mt20">Log In</button>

			<p class="p-sm tac mt10">Don't have an account? <a href="signup.php" class="link-sm">Signup</a></p>

		</div>
	</div>


<script type="text/javascript">
		let passIcon = document.getElementById("password-icon");
		let passwordInput = document.getElementById("password");


		passIcon.addEventListener("click", function (){
			let isPassword = passwordInput.type === "password";
			passwordInput.type = isPassword ? "text" : "password";

			this.src = isPassword ? "/attendence/img/hide.png" : "/attendence/img/show.png";
		});	




	</script>


</body>
</html>