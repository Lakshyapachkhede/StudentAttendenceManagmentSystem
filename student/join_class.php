<?php
require '../db/db_connector.php';
require '../session.php';
requireType("student");

function checkAlreadyJoined($conn, $class_id)
{
	$user_id = $_SESSION['user_id'];
	$result = $conn->query("SELECT class_id FROM attends WHERE student_id = $user_id");
	while($row = $result->fetch_assoc()){
		if ($row["class_id"] == $class_id){
			return true;
		}
	}

	return false;
}

function checkCanRequestJoin($conn, $class_id)
{
	$user_id = $_SESSION['user_id'];

	$result = $conn->query("SELECT class_id FROM join_requests WHERE student_id = $user_id ");


	while($row = $result->fetch_assoc()){
		if ($row["class_id"] == $class_id){
			return false;
		}
	}

	return true;

}

function checkValidId($conn, $class_id){
	$stmt = $conn->prepare("SELECT * FROM class WHERE id = ?");
	$stmt->bind_param("i", $class_id);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0){
		return true;
	} else{
		return false;
	}


}
if (isset($_GET['id'])){
	$class_id= $_GET['id'];
	$isValidClass =checkValidId($conn, $class_id);
	$canRequest = checkCanRequestJoin($conn, $class_id);
	if ($isValidClass && !checkAlreadyJoined($conn, $class_id) && $canRequest){
		$user_id = $_SESSION['user_id'];

		$result = $conn->query("SELECT name, teacher_id FROM class WHERE id = $class_id")->fetch_assoc();
		$class_name = $result["name"];
		$teacher_id = $result["teacher_id"];


		$stmt = $conn->prepare("INSERT INTO join_requests (student_id, class_id, teacher_id) VALUES (?, ?, ?)");
		$stmt->bind_param("iii", $user_id, $class_id, $teacher_id);
		$stmt->execute();




		$_SESSION['alert_message'] = "Class Joining Request Sent <a href='/attendence/teacher/class.php?id=$class_id'> $class_name </a>";
		header("Location: /attendence/teacher/class.php?id=$class_id");
		exit();

	} else {
		if ($isValidClass){

			$_SESSION['alert_message'] = "Class Already Joined or already requested<a href='/attendence/teacher/class.php?id=$class_id'> $class_name </a>";
			header("Location: /attendence/teacher/class.php?id=$class_id");
			exit();
		} else {
			echo "Invalid Class id";
		}
	}

	


}






?>
