<?php
require '../db/db_connector.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$email    = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
	$name = trim($_POST['name']);
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$isTeacher = isset($_POST['teacher']);
	if ($isTeacher == True){
		$type = 'teacher';
	} else{
		$type = "student";
	}

	if (!$name || !$email || !$password) {
		$error = "Please fill all fields correctly.";
	}

	else if (strlen($password) < 6){
		$error = "passwords length must be more than six characters";

	}
	else if ($password != $cpassword){
		$error = "passwords don't match";
	}




	$stmt = $conn->prepare("SELECT id FROM user WHERE email = ? ");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$error = "Email already taken";

	}
	else{
		$stmt->close();

	// NOTE: bypassing verifying email for now 

		// $otp = rand(100000, 999999);

		// $_SESSION['pending_user'] = [
		// 	'email' => $email,
		// 	'name' => $name,
		// 	'pass' => $password,
		// 	'type' => $type,
		// 	'otp' => $otp
		// ];

		// $to = $email;
		// $subject = "Your OTP To Sign Up For SAM System";
		// $message = "Hello $name,\n\n Your Otp is $otp\n\nUse this to complete your registration.";

		// if (mail($to, $subject, $message)){
		// 	header("Location: verify_otp.php");
		// 	exit();
		// } else {
		// 	$error = "Failed to send Otp";
		// }

		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		$stmt = $conn->prepare("INSERT INTO user (name, email, password, type) VALUES(?, ?, ?, ?)");
		$stmt->bind_param("ssss", $name,$email, $hashed_password, $type);


		if ($stmt->execute()){

			$stmt->close();
			$conn->close();
			session_start();
			$_SESSION['account_created'] = true;

			header("Location: login.php");
			exit();

		} else {
			$error = "Failed to create account";
		}

	}




} else {
	$error = "";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SAM - Sign Up</title>
	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

	<div class="container-l ">

		<?php  require '../components/nav.php';?>

		<form class="form d-f-col" action="signup.php" method="post">

			<h1 class="tac mb10">Sign Up to SamSystem</h1>

			<input type="email" name="email" class="f-input" placeholder="enter your email" required value="<?php if (isset($email)) {echo "$email";}?>" autocomplete="email">
			<input type="text" name="name"class="f-input" placeholder="enter your name" required value="<?php if (isset($name)) {echo "$name";}?>" autocomplete="name">

			<?php if ($error != ""){
				echo "<p class='mb10 mt20 t-warn'>$error</p>";
			}?>

			<div class="f-input p0 d-fcc jc-sb">
				<input type="password" name="password" placeholder="password" class=" f-input input-none " id="password" required minlength="6">
				<img src="\attendence\img\show.png" alt="Show" class="input-icon" id="password-icon">
			</div>		

			<div class="f-input p0 d-fcc jc-sb" >
				<input type="password" name="cpassword"placeholder="confirm password" class="f-input input-none" id="cpassword" required>
				<img src="\attendence\img\show.png" alt="Show" class="input-icon" id="cpassword-icon">

			</div>

			<div class="d-fcc mb10 mt20">
				<p class="mr10">Sign up as teacher</p> <input type="checkbox" name="teacher">
				
			</div>

			<button type="submit" class="f-btn mb10 mt20">Sign Up</button>

			<p class="p-sm tac mt10">Already have an account? <a href="login.php" class="link-sm">Login</a></p>

		</form>
	</div>


	<script type="text/javascript">
		let passIcon = document.getElementById("password-icon");
		let cpassIcon = document.getElementById("cpassword-icon");
		let passwordInput = document.getElementById("password");
		let cpasswordInput = document.getElementById("cpassword");


		passIcon.addEventListener("click", function (){
			let isPassword = passwordInput.type === "password";
			passwordInput.type = isPassword ? "text" : "password";

			this.src = isPassword ? "/attendence/img/hide.png" : "/attendence/img/show.png";
		});	

		cpassIcon.addEventListener("click", function (){
			let isPassword = cpasswordInput.type === "password";
			cpasswordInput.type = isPassword ? "text" : "password";

			this.src = isPassword ? "/attendence/img/hide.png" : "/attendence/img/show.png";
		});



	</script>


</body>
</html>