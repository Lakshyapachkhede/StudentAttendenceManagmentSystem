<?php
require '../db/db_connector.php';
require '../session.php';
require '../utils.php';
requireType("student");

$class_id = $_POST['class_id'];

if (!isAttends($conn, $class_id, $_SESSION['user_id'])){
	echo "invalid request";
	echo "$class_id";
	die();
}


$currentOpenSession = getAttribute($conn, "class", "open_session_id", "id", $class_id);

if ($currentOpenSession == NULL){
	$_SESSION['alert_message'] = "attendence window not open for" . getAttribute($conn, "class", "name", 'id', $class_id);


} else {
	$time = getAttribute($conn, "attendence_session", "date_time", "id", $currentOpenSession);

	$targetTime = strtotime($time);
	$currentTime = time();
	if ($targetTime <= $currentTime && $targetTime >= ($currentTime - 600)) {

		$stmt = $conn->prepare("UPDATE attendence SET status = 'present' WHERE session_id =? AND student_id = ?");
		$stmt->bind_param("ii", $currentOpenSession, $_SESSION['user_id']);
		$stmt->execute();
		$_SESSION['alert_message'] = "attendence submitted for" . getAttribute($conn, "class", "name", 'id', $class_id);

	}else {
		$_SESSION['alert_message'] = "attendence window not open for" . getAttribute($conn, "class", "name", 'id', $class_id);


	}






}
header("Location: /attendence/index.php");

?>