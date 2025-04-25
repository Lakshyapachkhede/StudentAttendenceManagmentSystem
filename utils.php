<?php

require 'db/db_connector.php';

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




?>