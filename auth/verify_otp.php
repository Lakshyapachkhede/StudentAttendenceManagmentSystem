

<?php
// bypassing verifying email for now 
$error = "";
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$entered_otp = $_POST['otp'];
	$stored_otp = $_SESSION['pending_user']['otp'];
	if ($entered_otp == $stored_otp) {
		require '../db/db_connector.php';


		$u = $_SESSION['pending_user'];
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		$stmt = $conn->prepare("INSERT INTO user (name, email, password, type) VALUES(?, ?, ?, ?)");
		$stmt->bind_param("ssss", $u['name'], $u['email'], $u['pass'], $u['type']);

		if ($stmt->execute()){
			header("Location: login.php");
			$stmt->close();
			$conn->close();
			unset($_SESSION['pending_user']);
		}

	}

	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>SAM - Verify Otp to signup</title>
		<link rel="stylesheet" href="../css/util.css">
		<link rel="stylesheet" href="../css/style.css">
	</head>
	<body>

		<div class="container-l ">

			<?php  require '../components/nav.php';?>

			<form class="form d-f-col" action="verify_otp.php" method="post">

				<h1 class="tac mb10">Enter Otp to Sign Up</h1>


				<input type="text" name="otp"class="f-input" placeholder="enter otp" required >

				<?php if ($error != ""){
					echo "<p class='mb10 mt20 t-warn'>$error<p>";
				}?>

				<button type="submit" class="f-btn mb10 mt20">Verify</button>

				<!-- <p class="p-sm tac mt10">Resend Otp <a href="login.php" class="link-sm">Login</a></p> -->

			</form>
		</div>
	</body>
	</html>