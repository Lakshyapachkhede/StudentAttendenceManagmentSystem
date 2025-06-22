<?php
require '../db/db_connector.php';
require '../session.php';
require '../utils.php';
requireType("teacher");


$class_id = $_GET['id'];

$teacher_id = getAttribute($conn, "class", "teacher_id", "id", $class_id);

if ($teacher_id == null){
	echo "Invalid Class";
	exit();
} else if (!isLoggedInUser($teacher_id)) {
	echo "Un authorized access";
	exit();
}

$class_data = getRecords($conn, "class", "id", $class_id)->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == "POST"){

	$action = $_POST['action'];
	$student_id = $_POST['remove_student_id'];
	if ($action == "remove_student"){

		if (!$student_id){
			echo "Invalid Parameters";
			exit();
		}


		$stmt = $conn->prepare("DELETE FROM attends WHERE class_id = ? AND student_id = ?");
		$stmt->bind_param("ii", $class_id, $student_id);

		if ($stmt->execute()){
			$_SESSION['alert_message'] = "Removed " . getAttribute($conn, "user","name", "id", $student_id) . " from " . getAttribute($conn, "class","name", "id", $class_id);
		} else {
			echo "Error occured while processing request";
			exit();
		}





	}
	
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Students -  <?=$class_data['name']?> SAM</title>
	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	
	<?php require '..\components\nav_sm.php'; ?>

	<div class="container mt20 d-f-col jc-sb">

			
			<?php 
			
			$result =getRecords($conn, "attends", "class_id", $class_id);

			if ($result->num_rows > 0){
				echo "<h1 class='mb20'>Students - " . $class_data['name'] . "</h1>";
			} else {
				echo "<h1 class='mb20'>No students in " . $class_data['name'] . "</h1>";

			}

			while ($row = $result->fetch_assoc()) {
				$user_id = $row['student_id'];
				$user_data = getRecords($conn, "user", "id", $user_id)->fetch_assoc();
				$user_profile_data = getRecords($conn, "student_profile", "student_id", $user_id)->fetch_assoc();



				echo"<div class='user-row' style='width:100%;'>
				<div class='user-row-left'>
				<a class='user-row-name td-u' href='/attendence/" . $user_data['type']. "/profile.php?id=". $user_data['id'] . "&action=view'>" . $user_data['name'] . "</a>
				<p>". $user_profile_data['roll_no'] ."</p>
				<p class='user-row-date'>Joined: ".  getFormattedDate($row['date_joined']). " </p>

				</div>

				<div class='user-row-right'>

				<form action='class_students.php?id=$class_id' method='POST'> 
				<input type='hidden' name='remove_student_id' value='$user_id'>
				<input type='hidden' name='action' value='remove_student'>
				<button type='submit' class='btn btn-r'>Remove</button>
				</form>
				</div>

				</div>";
			}

			?>

			


	</div>

	<?php require '../components/alert.php';?>



</body>
</html>