<?php
require '../db/db_connector.php';
require '../session.php';

$error = "";

function getBranchName($id, $conn)
{
	$stmt = $conn->prepare("SELECT full_name FROM branch WHERE id = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->bind_result($result);

	if ($stmt->fetch()) {
		$stmt->close();
		return $result;
	} else {
		$stmt->close();
		return null; 
	}
}


function checkError($conn , $email,  &$error, $id){
	$stmt = $conn->prepare("SELECT id FROM user WHERE email = ? ");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$stmt->store_result();

	if ($email != $_SESSION["email"]){


		if ($stmt->num_rows > 0) {


			$error = "Email already taken";
			$stmt->close();
			return true;
		}
	}




	return false;

}

function checkProfileExists($conn, $id)
{

	$stmt = $conn->prepare("SELECT teacher_id FROM teacher_profile WHERE teacher_id = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();


	if($result->num_rows > 0){
		echo "true";
		return true;
	}

		echo "fasle";
	return false;
}


$action = $_GET['action'] ?? "view";
$id = $_GET['id'] ?? null;

if ($id == null){
	die("Invalid Parameters");
}

$valid_actions = ["view", "create", "update"];

if (!in_array($action, $valid_actions)) {
    header("Location: ?action=view&id=$id");
    exit();
}

if ($action == "create" || $action == "update"){
	requireType("teacher");
	if ($_SESSION["user_id"] != $id){
			echo "Unauthorized access";
			exit();
	}
}

if ($action == "create" && checkProfileExists($conn, $id))
{

	header("Location: ?action=update&id=$id");

}

$isPost = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($isPost){
	$teacher_id = $_POST['id'];

	if ($_SESSION['user_id'] != $teacher_id){
		echo "Unauthorized access";
		exit();
	}

	$name = $_POST['name'];
	$email = $_POST['email'];
	$branch = $_POST['branch'];
	$about = $_POST['about'];


	if ($action == "create"){

		if(!checkError($conn , $email,  $error, $teacher_id))
		{


			$stmt = $conn->prepare("INSERT INTO teacher_profile (teacher_id, branch, about) VALUES (?, ?, ?)");
			$stmt->bind_param("iis", $teacher_id, $branch, $about);
			$stmt->execute();


			$stmt = $conn->prepare("UPDATE user SET name=?, email=? WHERE id=?");
			$stmt->bind_param("ssi", $name, $email, $teacher_id);
			$stmt->execute();
			$stmt->close();

			$stmt2 = $conn->prepare("INSERT INTO signuprequests (user_id) VALUES(?)");
			$stmt2->bind_param("i", $teacher_id);
			$stmt2->execute();
			$stmt2->close();

			header("Location: ?action=view&id=$teacher_id");
			exit();
		} 
	} 




	else if ($action == "update"){

		if(!checkError($conn , $email, $error, $teacher_id))
		{
			$stmt = $conn->prepare("UPDATE teacher_profile SET  branch=?, about=? WHERE teacher_id=?");
			$stmt->bind_param("isi",  $branch, $about, $teacher_id);
			$stmt->execute();
			$stmt->close();	

			$stmt = $conn->prepare("UPDATE user SET name=?, email=? WHERE id=?");
			$stmt->bind_param("ssi", $name, $email, $teacher_id);
			$stmt->execute();
			$stmt->close();
			header("Location: ?action=view&id=$teacher_id");
			exit();
		}


	}



}

$data = null;

if (($action === 'update' || $action === 'view') && $id) {
	$stmt = $conn->prepare("SELECT * FROM teacher_profile WHERE teacher_id=?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$profile_data = $result->fetch_assoc();
	$stmt->close();	


}

$stmt = $conn->prepare("SELECT * FROM user WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();
$stmt->close();



?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Profile - SAM</title>
	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

	<?php require '..\components\nav_sm.php'; ?>

	<div class="container">


		<?php if ($action === 'view' && $profile_data): ?> 

			<div class="profile">
				
				<div class="profile-left">
					<img src="../img/user.jpg" alt="User Image" class="profile-img">

					<p class="profile-name"><?= $user_data['name'] ?></p>
					<p class="profile-bio mt10"><?=$profile_data['about']?></p>

					<?php 
					if ($_SESSION["user_id"] == $user_data['id']){
						echo "<a href='/attendence/teacher/profile.php?id=" .  $_SESSION['user_id'] . "&action=update' class='btn mt20'>Update Profile</a>	";
					}

					?>
				</div>

				<div class="profile-right">
					<h1 class="ml10">About</h1>
					<table class="profile-table">
						<tr>
							<td class="text-dark">Full Name</td>
							<td ><?= $user_data['name'] ?></td>
						</tr>


						<tr>
							<td class="text-dark">Email</td>
							<td><?= $user_data['email']?></td>
						</tr>


						<tr>
							<td class="text-dark">Branch</td>
							<td ><?= getBranchName($profile_data['branch'],$conn)?></td>
						</tr>



					</table>
				</div>


			</div>

		<?php else: ?>

			<div class="profile">

				<div class="profile-left">
					<img src="../img/user.jpg" alt="User Image" class="profile-img">

					<p class="profile-name">Your Name</p>
					<p class="profile-bio mt10">Something about you</p>




				</div>

				<form class="profile-right form-profile-update" method="post" accept="<?= $_SERVER['PHP_SELF'] ?>">
					<h1 class="ml10">About</h1>
					<input type="hidden" name="id" value="<?= $id ?>">
					<table class="profile-table" style="width:100%;">
						<tr>
							<td class="text-dark">Full Name</td>
							<td ><input type="text" class="f-input" name="name" placeholder="Full Name" value="<?= $user_data['name'] ?? '' ?>" required></td>
						</tr>	

						<tr>
							<td class="text-dark">Email</td>
							<td ><input type="email" class="f-input" name="email" placeholder="enter your email" value="<?= $user_data['email'] ?? '' ?>" required></td>
						</tr>


						<tr>
							<td class="text-dark">Branch</td>
							<td >    <select name="branch" id="branch">

								<?php 
								$stmt = $conn->prepare("SELECT id, full_name FROM branch");
								$stmt->execute();
								$result=$stmt->get_result();
								$stmt->close();
								while ($row = $result->fetch_assoc()) {
									if ($row['id'] == $profile_data['branch']){
										echo "<option value=" . $row['id'] . " selected>" . $row['full_name'] .  "</option> ";
									}else{
										echo "<option value=" . $row['id'] . ">" . $row['full_name'] .  "</option>";
									}

								}


								?>


							</select></td>
						</tr>

						<tr>
							<td class="text-dark">About</td>
							<td > <textarea name="about" class="f-input"><?= $profile_data['about'] ?? '' ?></textarea> </td>
						</tr>
					</table>

					<?php if ($error != ""){
						echo "<p class='mb10 mt20 t-warn as-c'>$error</p>";
					}?>

					<button class="btn btn-form" type="submit"><?= $action ?></button>
				</form>


			</div>
		<?php endif; ?>

	</div>


</body>
</html>