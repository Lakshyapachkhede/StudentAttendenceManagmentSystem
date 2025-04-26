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
	<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
</head>
<body>
	
	<?php require '..\components\nav_sm.php'; ?>

	<div class="container d-fcc">
		<!-- <canvas id="myLineChart" width="800" height="400"></canvas> -->
		<div class="scroll-wrapper">


			<table class="styled-table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Roll No</th>
						<?php

						$sessions = getRecords($conn, "attendence_session", "class_id", $class_id);
						$sessions_array = [];
						while($session = $sessions->fetch_assoc()){
							$sessions_array[] = $session;
							echo "<th>". date('d-m-y', strtotime($session['date_time']))."<br>". date('H:i A', strtotime($session['date_time'])) ."</th>";

						}


						?>




					</tr>
				</thead>
				<tbody>



					<?php


					$all_students = getRecords($conn, "attends", "class_id", $class_id);

					while($row = $all_students->fetch_assoc()){

						$user_id = $row['student_id'];
						$student_name = getAttribute($conn, "user", "name", "id", $user_id);
						$student_roll_no = getAttribute($conn, "student_profile", "roll_no","student_id", $user_id);




						echo"
						<tr>
						<td>$student_name</td>
						<td>$student_roll_no</td>";

						foreach($sessions_array  as $sess ){
							echo "<td>";
							$stmt = $conn->prepare("SELECT * FROM attendence WHERE session_id = ? AND student_id = ?");
							$stmt->bind_param("ii", $sess['id'], $user_id);

							$stmt->execute();
							$result = $stmt->get_result();
							$r = $result->fetch_assoc();
							if ($r['status'] === 'present'){
								echo "<img src='/attendence/img/check.png' alt='' class='icon p0' >";
							} else if ($r['status'] === 'absent'){
								echo "<img src='/attendence/img/remove.png' alt='' class='icon p0' >";
							} else {
								echo "-";
							}

							echo "</td>";

						}

						echo "</tr>";
					}


					?>




				</tbody>
			</table>
		</div>



	</div>

	<?php require '../components/alert.php';?>




	<!-- <script>
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
				responsive: false,
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
	-->


</body>
</html>
