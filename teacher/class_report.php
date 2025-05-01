<?php
require '../db/db_connector.php';
require '../session.php';
require '../utils.php';
require '../fpdf/fpdf.php';
requireType("teacher");

$class_id = $_GET['id'];

$error = "";


$teacher_id = getAttribute($conn, "class", "teacher_id", "id", $class_id);

if ($teacher_id == null){
	echo "Invalid Class";
	exit();
} else if (!isLoggedInUser($teacher_id)) {
	echo "Un authorized access";
	exit();
}

$min_session_date = executeSql($conn, "SELECT MIN(date_time) FROM attendence_session WHERE class_id = $class_id");
$min_session_date = (getHtmlInputDate($min_session_date->fetch_assoc()['MIN(date_time)']));


$max_session_date = executeSql($conn, "SELECT MAX(date_time) FROM attendence_session WHERE class_id = $class_id");
$max_session_date = (getHtmlInputDate($max_session_date->fetch_assoc()['MAX(date_time)']));





if (isset($_GET['download'])){
	downloadPdf($conn, $class_id);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' AND isset($_GET['start_date']) AND isset($_GET['end_date'])) {
	$start_date = new DateTime($_GET['start_date']);
	$end_date = new DateTime($_GET['end_date']);

	$start_date_str = $start_date->format('Y-m-d');
	$end_date_str = $end_date->format('Y-m-d');

	if ($start_date > $end_date) {
		$error = 'Start date cannot be after end date.';
	} else{
		$error = '';
	}


}


function downloadPdf($conn, $class_id) {
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 10);

    // Table headers
	$pdf->Cell(60, 10, 'Name', 1);
	$pdf->Cell(30, 10, 'Roll No', 1);

    // Get all sessions
	$sessions = getRecords($conn, "attendence_session", "class_id", $class_id);
	$sessions_array = [];
	foreach ($sessions as $session) {
		$sessions_array[] = $session;
        // Make session header compact
		$pdf->Cell(20, 10, date('d-m', strtotime($session['date_time'])), 1); 
	}

	$pdf->Ln();

    // Get all students
	$all_students = getRecords($conn, "attends", "class_id", $class_id);
	while ($row = $all_students->fetch_assoc()) {
		$user_id = $row['student_id'];
		$student_name = getAttribute($conn, "user", "name", "id", $user_id);
		$student_roll_no = getAttribute($conn, "student_profile", "roll_no", "student_id", $user_id);

		$pdf->Cell(60, 10, $student_name, 1);
		$pdf->Cell(30, 10, $student_roll_no, 1);

		foreach ($sessions_array as $sess) {
			$stmt = $conn->prepare("SELECT status FROM attendence WHERE session_id = ? AND student_id = ?");
			$stmt->bind_param("ii", $sess['id'], $user_id);
			$stmt->execute();
			$result = $stmt->get_result();
			$r = $result->fetch_assoc();

			$status = '-';
			if ($r) {
				$status = ($r['status'] === 'present') ? 'P' : 'A';
			}

			$pdf->Cell(20, 10, $status, 1);
		}

		$pdf->Ln();
	}

	$pdf->Output('D', 'attendance_report.pdf');
}






?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Class Data -  <?=getAttribute($conn, "class", "name", "id", $class_id)?> SAM</title>
	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">
	<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
</head>
<body>
	
	<?php require '..\components\nav_sm.php'; ?>

	<div class="container d-f-col mt20">
		<!-- <canvas id="myLineChart" width="800" height="400"></canvas> -->


		<form class="d-fcc jc-sb record-date-filter" method="GET" action="class_report.php">
			<input type="hidden" name="id" value="<?=$class_id?>">

			<div class="d-fcc record-date-filter-row">
				<h2 class="text-dark">From</h2>
				<input type="datetime-local"  class="ml10 f-input w-i" name="start_date" value="<?php if (isset($start_date)) {echo $_GET['start_date'];} else {echo "$min_session_date";}?>" min='<?=$min_session_date?>' max='<?=$max_session_date?>'>
			</div>	


			<div class="d-fcc record-date-filter-row">
				<h2 class="text-dark">To</h2>
				<input type="datetime-local"  class="ml10 f-input w-i" name="end_date" min='<?=$min_session_date?>' max='<?=$max_session_date?>' value="<?php if (isset($end_date)) {echo $_GET['end_date'];} else {echo "$max_session_date";}?>">
			</div>

			<button class="btn" type="submit">Done</button>


		</form>

		<?php if ($error != ""){
			echo "<p class='mb10 mt20 t-warn'>$error</p>";
		}?>

		<div class="scroll-wrapper">


			<table class="styled-table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Roll No</th>
						<?php

						if (isset($start_date) && isset($end_date))
						{
							$sessions = executeSql($conn, "SELECT * FROM attendence_session WHERE class_id = $class_id AND DATE(date_time) >= '$start_date_str' AND DATE(date_time) <= '$end_date_str'");
						}
						else {
							$sessions =	getRecords($conn, "attendence_session", "class_id", $class_id);
						}
						$sessions_array = [];
						while($session = $sessions->fetch_assoc()){
							$sessions_array[] = $session;
							echo "<th class='tac'>". date('d-m-y', strtotime($session['date_time']))."<br>". date('H:i A', strtotime($session['date_time'])) ."</th>";

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
							echo "<td class='tac'>";
							$stmt = $conn->prepare("SELECT * FROM attendence WHERE session_id = ? AND student_id = ?");
							$stmt->bind_param("ii", $sess['id'], $user_id);

							$stmt->execute();
							$result = $stmt->get_result();
							$r = $result->fetch_assoc();
							if ($r == null){
								echo "-";

							}
							else if ($r['status'] === 'present'){
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
