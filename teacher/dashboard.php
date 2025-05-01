<?php
require '../db/db_connector.php';
require '../session.php';
require '../utils.php';
requireType("teacher");

$notifications = 0;


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



function approveJoinRequest($conn, $student_id, $class_id){
	$stmt = $conn->prepare("DELETE FROM join_requests  WHERE student_id = ? AND class_id = ?");
	$stmt->bind_param("ii", $student_id, $class_id);
	$stmt->execute();

	$stmt->close();

	$stmt = $conn->prepare("INSERT INTO attends(student_id, class_id) VALUES(?, ?)");
	$stmt->bind_param("ii", $student_id, $class_id);

	$stmt->execute();



}

function rejectJoinRequest($conn, $student_id, $class_id){
	$stmt = $conn->prepare("DELETE FROM join_requests  WHERE student_id = ? AND class_id = ?");
	$stmt->bind_param("ii", $student_id, $class_id);
	$stmt->execute();

	$stmt->close();



}



if ($_SERVER['REQUEST_METHOD'] == "POST"){

	$student_id = $_POST['student_id'];
	$class_id = $_POST['class_id'];
	$action = $_POST['action'];

	$student_name = getAttribute($conn, "user", "name", "id", $student_id);
	$class_name = getAttribute($conn, "class", "name", "id", $class_id);

	if ($action == "approve"){
		approveJoinRequest($conn, $student_id, $class_id);
		$_SESSION['alert_message'] = "$student_name has been added to the class '$class_name'.";


		
	} else {
		rejectJoinRequest($conn, $student_id, $class_id);
		$_SESSION['alert_message'] = "$student_name's request to join the class '$class_name' has been declined.";

	}

	header("Location: dashboard.php");
	exit();


}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Teacher Dashboard SAM</title>
	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	
	<?php require '..\components\nav_sm.php'; ?>


	<div class="notification-con" id="notification-con">
		
		<img src="/attendence/img/remove.png" alt="Close" class="icon" id="notification-close-btn">
		<?php

		$stmt = $conn->prepare("SELECT * FROM join_requests WHERE teacher_id = ?");
		$stmt->bind_param("i", $_SESSION['user_id']);
		$stmt->execute();
		$result = $stmt->get_result();
		$notifications += $result->num_rows;

		if ($result->num_rows == 0){
			echo "<p class='text-dark' style='align-self:center;'>No new notifications.</p>";
		}

		while($row = $result->fetch_assoc()){


			echo" <div class='user-row notification-row'>
			<div class='user-row-left'>
			<a class='link'>".  getAttribute($conn, "user", "name", "id", $row["student_id"]) ."</a>
			<p>Roll No: ". getAttribute($conn, "student_profile", "roll_no", "student_id", $row["student_id"]). "</p>
			<a class='link'>Class: ".getAttribute($conn, "class", "name", "id", $row["class_id"]) ."</a>
			<p>Date: ". (new DateTime($row["requested_at"]))->format('F j, Y') ."</p>


			</div>

			<div class='user-row-right'>
			<form action='/attendence/teacher/dashboard.php' method='POST'>
			<input type='hidden' value='". $row["student_id"]."'  name='student_id'>
			<input type='hidden' value='". $row["class_id"]."'  name='class_id'>
			<input type='hidden' name='action' value='approve'>
			<button type='submit' class='btn-reset'><img src='/attendence/img/check.png' alt='' class='icon p0' ></button>

			</form>	

			<form action='/attendence/teacher/dashboard.php' method='POST'>
			<input type='hidden' value='". $row["student_id"]."' name='student_id'>
			<input type='hidden' value='". $row["class_id"]."' name='class_id'>
			<input type='hidden' name='action' value='reject'>
			<button type='submit'  class='btn-reset'><img src='/attendence/img/remove.png' alt='' class='icon p0'></button>

			</form>
			</div>
			</div>";
		}

		?>

	</div>


	<div class="container mt20">

		<div class="d-fcc jc-sb">
			<h1>Welcome <?= $_SESSION['name']?></h1>

			<div class="icon-wrapper">
				<?php if ($notifications > 0): ?>
					<span class="icon-num"><?= $notifications ?></span>
				<?php endif ?>
				<img src="/attendence/img/notification.png" alt="notifications" class="icon " id="notification-btn">
			</div>


		</div>

		<?php
		$teacher_id = $_SESSION['user_id'];
		$result = $conn->query("SELECT * FROM class WHERE teacher_id = $teacher_id");

		while($row = $result->fetch_assoc()){
			echo "<div class='user-row'>
			<div class='user-row-left'>
			<a class='link td-u' href='/attendence/teacher/class.php?id=". $row['id']. " '>" . $row['name'] . "</a>
			<p>Date: ".   (new DateTime($row["date_created"]))->format('F j, Y') . " </p>

			<p>Branch: " . getBranchName($row['branch'], $conn) . "</p>

			</div>

			<div class='user-row-right'>
			<a class='btn' href='class_report.php?id=".  $row["id"] ." '>Record</a>


			<a class='btn btn-s' href='take_attendence.php?id=".  $row["id"] ." '>Attendence</a>
			</div>

			</div>";
		}

		?>



	</div>

	<?php require '../components/alert.php';?>

	<script type="text/javascript">
		const notificationBtn = document.getElementById("notification-btn");
		const notificationCloseBtn = document.getElementById("notification-close-btn");
		const notificationCon = document.getElementById("notification-con");

		notificationBtn.addEventListener("click", ()=>{

			notificationCon.classList.toggle("show");

		});
		notificationCloseBtn.addEventListener("click", ()=>{

			notificationCon.classList.toggle("show");

		});


	</script>


</body>
</html>