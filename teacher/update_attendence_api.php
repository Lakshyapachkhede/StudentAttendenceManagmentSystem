<?php
require '../session.php';
require '../db/db_connector.php';
require '../utils.php';

requireType("teacher");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	header('Content-Type: application/json');

	$session_id = $_POST['session_id'];
	$student_id = $_POST['student_id'];
	$status = $_POST['status'];




	if (!$session_id || !$student_id || !in_array($status, ['present', 'absent'])) {
		echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
		exit();
	}
	$class_id = getAttribute($conn, "attendence_session", "class_id", "id", $session_id);
	if ($class_id == null) {
		echo json_encode(['success' => false, 'message' => 'Invalid session']);
		exit();
	}

	$teacher_id = getAttribute($conn, "class", "teacher_id", "id", $class_id);

	if (!$teacher_id || !isLoggedInUser($teacher_id)) {
		echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
		exit();
	}

	$stmt = $conn->prepare("SELECT student_id FROM attendence WHERE session_id = ? AND student_id = ?");
	$stmt->bind_param("ii", $session_id, $student_id);
	$stmt->execute();
	$result = $stmt->get_result()->fetch_assoc();

	if ($result == null){

		if (insertAttendenceRecord($conn, $session_id, $student_id, $status)) {
			echo json_encode(['success' => true, 'message' => 'Record inserted']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Insert failed']);
		}

	} else {

		$stmt = $conn->prepare("UPDATE attendence SET status=? WHERE session_id=? AND student_id=?");
		$stmt->bind_param("sii",$status, $session_id, $student_id);
		$stmt->execute();
		$stmt->close();

		echo json_encode(['success' => true, 'message' => 'Record updated']);

	}




} else {

}









?>