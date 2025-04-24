<?php

require 'db/db_connector.php';

function getAttribute($conn, $table, $attribute, $parameter ,$id){
	$stmt = $conn->prepare("SELECT $attribute FROM $table WHERE $parameter = ?");
	$stmt->bind_param('i', $id);
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

?>