<?php

require 'db/db_connector.php';
date_default_timezone_set('Asia/Kolkata');



function getAttribute($conn, $table, $attribute, $parameter ,$value){
	$stmt = $conn->prepare("SELECT $attribute FROM $table WHERE $parameter = ?");
	$stmt->bind_param('i', $value);
	$stmt->execute();
	$result = $stmt->get_result()->fetch_assoc()[$attribute] ?? null;
	return $result;

}



function getNumberOfRecords($conn, $table)
{
	$stmt = $conn->prepare("SELECT COUNT(*) FROM $table");
	$stmt->execute();
	$stmt->bind_result($count);
	$stmt->fetch();
	$stmt->close();

	return $count;
}

function getRecords($conn, $table, $parameter, $value){
	$stmt = $conn->prepare("SELECT * FROM $table WHERE $parameter = ?");
	$stmt->bind_param('i', $value);
	$stmt->execute();
	$result = $stmt->get_result();
	return $result;
}

function getFormattedDate($str){
	return (new DateTime($str))->format('F j, Y');
}

function parseHtmlInputDate($str){
	return str_replace('T', ' ', $_POST['attendence_time']);
}

function getHtmlInputDate($str){
	return (new DateTime($str))->format('Y-m-d\TH:i');
}

function insertAttendenceRecord($conn, $session_id, $student_id, $status)
{
	$stmt = $conn->prepare("INSERT INTO attendence VALUES(?, ?, ?)");
	$stmt->bind_param("iis", $session_id, $student_id, $status);
	if ($stmt->execute()){
		return true;
	} else {
		return false;
	}

}


function createAttendenceSession($conn, $class_id, $datetime){
	$stmt = $conn->prepare("INSERT INTO attendence_session(class_id, date_time) VALUES(?, ?)");
	$stmt->bind_param("is", $class_id, $datetime);

	if ($stmt->execute()){
		return $conn->insert_id;
	} else{
		return null;
	}

}

function executeSql($conn, $sql){
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	return $result;
}

function returnTextColorClass($num)
{
	if($num > 75){
		return " text-green";
	} else if ($num > 50){
		return " text-orange";
	} else {
		return " text-red";
	}
}

function returnStatusTextColorClass($status)
{
	if($status == "present"){
		return " text-green";
	} else {
		return " text-red";
	}
}

function returnBackColorClass($num)
{
	if($num > 75){
		return " back-green";
	} else if ($num > 50){
		return " back-orange";
	} else {
		return " back-red";
	}
}
function isAttends($conn, $class_id, $student_id)
{
    $stmt = $conn->prepare("SELECT 1 FROM attends WHERE student_id = ? AND class_id = ?");
    $stmt->bind_param("ii", $student_id, $class_id);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

function getFormattedCurrentDate() {
    return date('F j, Y'); 

}



?>