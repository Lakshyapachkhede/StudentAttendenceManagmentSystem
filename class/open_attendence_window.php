<?php 
require '../db/db_connector.php';
require '../session.php';
require '../utils.php';
requireType("teacher");

function openWindow($conn, $class_id){

	$newSessionId = createAttendenceSession($conn, $class_id, date("Y-m-d H:i:s"));



	$stmt = $conn->prepare("UPDATE class SET open_session_id=? WHERE id = ?");
	$stmt->bind_param("ii", $newSessionId, $class_id);
	$stmt->execute();

	$_SESSION['alert_message'] = "attendence session opened for " . getAttribute($conn, "class", "name", 'id', $class_id);

	// marking all students as absent
	$all_students = getRecords($conn, "attends", "class_id", $class_id);
	$status ="absent";
	while($row = $all_students->fetch_assoc()){
		$student_id = $row['student_id'];
		$stmt = $conn->prepare("INSERT INTO attendence(session_id, student_id, status) VALUES(?,?,?)");
		$stmt->bind_param("iis", $newSessionId, $student_id, $status);
		$stmt->execute();
	}

	header("Location: /attendence/index.php");

}





$class_id = $_GET['class_id'];
$teacher_id = getAttribute($conn, "class", "teacher_id", "id", $class_id);

if(!isLoggedInUser($teacher_id)){
	header("Location: /attendence/index.php");

}


if (getAttribute($conn, "user", "approved",  "id", $_SESSION['user_id'])){
	$_SESSION['approved'] = 1;
}
else{
	header("Location: /attendence/index.php"); 
	$_SESSION['alert_message'] = "your account is not approved yet please wait till getting approved";
	exit();
}

$currentOpenSession = getAttribute($conn, "class", "open_session_id", "id", $class_id);

if ($currentOpenSession == NULL){
	openWindow($conn, $class_id);


} else {
	$time = getAttribute($conn, "attendence_session", "date_time", "id", $currentOpenSession);

	$targetTime = strtotime($time);
	$currentTime = time();
	if ($targetTime <= $currentTime && $targetTime >= ($currentTime - 600)) {
		$_SESSION['alert_message'] = "Window already open for" . getAttribute($conn, "class", "name", 'id', $class_id) . " at ". getFormattedDate($time) . " - ". date('H:i A', strtotime($time));
	}else {
		openWindow($conn, $class_id);


	}
}








header("Location: /attendence/index.php");

?>

