<?php
require '../db/db_connector.php';
require '../session.php';
require '../utils.php';
requireType("teacher");




$class_id = $_GET['id'];
$class_data = getRecords($conn, "class", "id", $class_id)->fetch_assoc();
$teacher_id = getAttribute($conn, "class", "teacher_id", "id", $class_id);

if ($teacher_id == null){
	echo "Invalid Class";
	exit();
} else if (!isLoggedInUser($teacher_id)) {
	echo "Un authorized access";
	exit();
}


if ($_SERVER['REQUEST_METHOD'] == "POST"){
	$present = isset($_POST['present']) ? $_POST['present'] : [];
	$all_students = isset($_POST['all_students']) ? $_POST['all_students'] : [];
	$datetime = str_replace('T', ' ', $_POST['attendence_time']);

	if (count($all_students) == 0){
		$_SESSION['alert_message'] = $class_data['name'] . "has no students";
	} else {
		$atten_sess_id = createAttendenceSession($conn, $class_id, $datetime);
	}


	foreach ($all_students as $student_id) {
		$status = in_array($student_id, $present) ? 'present' : 'absent';
		insertAttendenceRecord($conn, $atten_sess_id, $student_id, $status);
	}

	$_SESSION['alert_message'] = "attendence done for class " . $class_data['name'] ;
	header("Location: /attendence/teacher/");
	exit();


}





?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Class - <?= $class_data["name"] ?></title>
	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php require '..\components\nav_sm.php'; ?>

	<div class="container mt40">

		<form action="take_attendence.php?id=<?=$class_id?>" method="POST">
			




			<div class="d-f-col">
				<div class="d-fcc">
					<h2 class="text-dark"><?=$class_data['name']?></h2>
					<input type="datetime-local" id="attendence_time" class="ml10 f-input w-i" name="attendence_time" value="<?=date('Y-m-d\TH:i')?>">
				</div>
				<div class="scroll-wrapper">

					<table class="styled-table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Roll No</th>
								<th>Mark</th>
							</tr>
						</thead>
						<tbody>


							<?php


							$all_students = getRecords($conn, "attends", "class_id", $class_id);

							while($row = $all_students->fetch_assoc()){
								$user_id = $row['student_id'];
								$user_data = getRecords($conn, "user", "id", $user_id)->fetch_assoc();
								$user_profile_data = getRecords($conn, "student_profile", "student_id", $user_id)->fetch_assoc();




								echo"
								<tr>
								<td>" . $user_data['name'] . "</td>
								<td>". $user_profile_data['roll_no'] ."</td>
								<td class='tac'><input type='checkbox' name='present[]' value='".$user_data['id']."'></td>
								</tr>
								<input type='hidden' name='all_students[]' value='".$user_data['id']."'>
								";
							}



							?>



						</tbody>
					</table>
				</div>
				<button class="btn btn-form" type="submit">Done</button>

			</div>




		</form>


	</div>


	<?php require '../components/alert.php';?>


</body>


</html>


