<?php
require '../db/db_connector.php';
require '../session.php';
require '../utils.php';
requireType("teacher");

$class_id = $_GET['id'];
$record_id = $_GET['record'] ?? null;

$teacher_id = getAttribute($conn, "class", "teacher_id", "id", $class_id);

if ($teacher_id == null){
	echo "Invalid Class";
	exit();
} else if (!isLoggedInUser($teacher_id)) {
	echo "Un authorized access";
	exit();
}

if ($record_id){




}




?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Class Data -  <?=$class_data['name']?> SAM</title>
	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
	
	<?php require '..\components\nav_sm.php'; ?>

	<div class="container mt20">
		<canvas id="myLineChart" width="300" height="200"></canvas>
	</div>

	<?php require '../components/alert.php';?>
	<script>
		const ctx = document.getElementById('myLineChart').getContext('2d');
		const myLineChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ['January', 'February', 'March', 'April', 'May', 'June'],
				datasets: [{
					label: 'Sales',
					data: [65, 59, 80, 81, 56, 75],
					fill: false,
					borderColor: 'rgb(75, 192, 192)',
					tension: 0.1
				}]
			},
			options: {
				responsive: true,
				plugins: {
					title: {
						display: true,
						text: 'Monthly Sales Data'
					}
				},
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	</script>



</body>
</html>
