<?php
require '../db/db_connector.php';
require '../session.php';
require '../utils.php';


$user_type = $_SESSION['type'];

$class_id = $_GET['class_id'];
$student_id = $_GET['student_id'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student Report -  <?=getAttribute($conn, "class", "name", "id", $class_id)?> SAM</title>
	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
	
	<?php require '..\components\nav_sm.php'; ?>

	<div class="container d-f-col mt20">

	</div>

</body>

</html>
