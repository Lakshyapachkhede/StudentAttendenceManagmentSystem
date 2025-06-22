<?php
require '../session.php';
require '../utils.php';
require '../db/db_connector.php';
requireType('student'); 




?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $_SESSION['name'];?> - Dashboard</title>

	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php require '..\components\nav_sm.php'; ?>

	<div class="container mt20">

		<div class="d-fcc jc-sb">
			<h1>Welcome <?= $_SESSION['name']?></h1>

			<!-- <div class="icon-wrapper">
				<span class="icon-num"><?= $notifications ?></span>
				<img src="/attendence/img/notification.png" alt="notifications" class="icon" id="notification-btn">
			</div> -->

		</div>

		<?php
		$student_id = $_SESSION['user_id'];
		$result = $conn->query("SELECT * FROM attends WHERE student_id = $student_id");




		while($row = $result->fetch_assoc()){

			$totalClass = getNumberOfRecords($conn, "attendence_session WHERE class_id = {$row['class_id']}");
			$totalAttended = $conn->query("SELECT count(*) FROM attendence WHERE student_id = $student_id AND status = 'present' AND session_id IN (SELECT id FROM attendence_session WHERE class_id = {$row['class_id']})")->fetch_array()[0];


			$percentage = $totalClass > 0 
					? round(($totalAttended / $totalClass) * 100, 0)
					: 0;


			echo "<div class='user-row'>
			<div class='user-row-left'>
			<a class='link td-u' href='/attendence/class/class.php?id=". $row['class_id']. " '>" . getAttribute($conn, "class", "name","id", $row['class_id']) . "</a>
			<p>Joined: ".   (new DateTime($row["date_joined"]))->format('F j, Y') . "</p>

			<p>Branch: " . getAttribute($conn, "branch", "full_name","id", getAttribute($conn, "class", "branch","id", $row['class_id'])) . "</p>

			</div>

			<div class='user-row-right'>

			<div class='round ". returnBackColorClass($percentage) ."'><p>$percentage%</p></div>


			<a class='btn btn-s' href='/attendence/class/student_report.php?class_id={$row['class_id']}&student_id={$_SESSION['user_id']}'>Report</a>

			<form action='/attendence/class/mark_student_attendence.php' method='post'>
			<input type='hidden' value='{$row['class_id']}' name='class_id'>
				<button type='submit' class='btn'>Mark Attendance</button>
			</form>



			</div>

			</div>";
		}

		?>



	</div>

	<?php require '../components/alert.php';?>

</body>
</html>