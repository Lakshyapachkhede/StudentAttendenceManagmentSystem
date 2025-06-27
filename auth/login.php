<?php
require '../db/db_connector.php';
$error = "";
session_start();

function checkProfileExists($conn, $id, $type)
{
	if ($type == 'teacher') {
		$stmt = $conn->prepare("SELECT * FROM teacher_profile WHERE teacher_id = ?");
	} else {
		$stmt = $conn->prepare("SELECT * FROM student_profile WHERE student_id = ?");
	}
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->store_result();

	if ($stmt->num_rows > 0){
		return true;
	}

	return false;


}

$accountCreated = false;

if (isset($_SESSION['account_created'])) {
	$accountCreated = true;
	unset($_SESSION['account_created']); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){


	$email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
	$password = $_POST['password'];



	if (!$email || !$password) {
		$error = "Please fill all fields correctly.";
	}

	$stmt = $conn->prepare("SELECT * FROM user WHERE email = ? ");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows === 1) {
		$user = $result->fetch_assoc();
		if (password_verify($password, $user['password'])){
			$_SESSION['login'] = true;
			$_SESSION['user_id'] = $user["id"];
			$_SESSION['email'] = $email;
			$_SESSION['name'] = $user["name"];
			$_SESSION['type'] = $user["type"];
			$_SESSION['approved'] = $user["approved"];

			switch ($_SESSION['type']) {
				case 'admin':
				header("Location: /attendence/admin/");
				break;
				case 'teacher':
				if (!checkProfileExists($conn, $_SESSION['user_id'], "teacher")){
					header("Location: /attendence/teacher/profile.php?action=create&id=". $user['id']);
				} else {
					header("Location: /attendence/teacher/");
				}
				break;
				case 'student':
				if (!checkProfileExists($conn, $_SESSION['user_id'], "student")){
					header("Location: /attendence/student/profile.php?action=create&id=". $user['id']);
				}
				else {

					header("Location: /attendence/student/");
				}
				break;
			}
			exit;



		}
		else {
			$error = "Incorect password";

		}
	}

	else {
		$error = "Email does not exist. Sign up instead";

	}








}



?>



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
		<?php if ($accountCreated): ?>
			<div class="alert show" id="alert">
				<img src="/attendence/img/check.png" alt="Check Mark">
				<p class="f-r">Your account was created! Please log in.</p>
			</div>
		<?php endif; ?>

		<form class="form d-f-col" action="login.php" method="POST">

			<h1 class="tac mb10">Log In to SamSystem</h1>

			<input type="email" name="email" class="f-input" placeholder="enter your email" value="<?php if (isset($email)) {echo "$email";}?>" required>

			<div class="f-input p0 d-fcc jc-sb">
				<input type="password" name="password" placeholder="password" class=" f-input input-none " id="password" required minlength="6">
				<img src="/attendence/img/show.png" alt="Show" class="input-icon" id="password-icon">
			</div>		

			<?php if ($error != ""){
				echo "<p class='mb10 mt20 t-warn'>$error</p>";
			}?>

			<button type="submit" class="f-btn mb10 mt20">Log In</button>

			<p class="p-sm tac mt10">Don't have an account? <a href="signup.php" class="link-sm">Signup</a></p>

		</form>
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