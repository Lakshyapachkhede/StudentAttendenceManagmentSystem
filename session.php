<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['type'])){
	 header("Location: /attendence/auth/login.php");
	 exit();
}

function requireType($type){
	if ($_SESSION['type'] !== $type){
		header("Location: /attendence/index.php"); // Redirecting to index if not required type of user
        exit();
	}
}

?>