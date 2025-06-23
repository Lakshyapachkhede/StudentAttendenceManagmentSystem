<?php
require '../db/db_connector.php';
require '../session.php';
require '../utils.php';
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

function getMonthAndYear($dateString) {
	$date = new DateTime($dateString);
	return $date->format('M Y'); 
}


function getMonthNumber($dateString) {
	$date = new DateTime($dateString);
    return $date->format('m'); // 'm' gives month number with leading zero
}


function getMonth($monthNum) {
    $date = DateTime::createFromFormat('!m', $monthNum); // 'm' = month number, '!' resets date
    return $date->format('M'); // 'M' = short month name
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
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
	
	<?php require '..\components\nav_sm.php'; ?>

	<div class="container d-f-col mt20">


		

		<?php if ($error != ""){
			echo "<p class='mb10 mt20 t-warn'>$error</p>";
		}?>

		<h1 >Class Report - <?= getAttribute($conn, "class", "name", "id", $class_id) ?></h1>

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
						<td ><a class='text-link' href='student_report.php?student_id=$user_id&class_id=$class_id'>$student_name</a></td>
						<td>$student_roll_no</td>";

						foreach($sessions_array  as $sess ){
							echo "<td class='tac'>";
							$stmt = $conn->prepare("SELECT * FROM attendence WHERE session_id = ? AND student_id = ?");
							$stmt->bind_param("ii", $sess['id'], $user_id);

							$stmt->execute();
							$result = $stmt->get_result();
							$r = $result->fetch_assoc();



							if ($r == null){
								echo "<input type='checkbox' class='attendence-checkbox' data-session-id=" . $sess['id'] ." data-student-id=". $user_id . ">";

							}



							else if ($r['status'] === 'present'){
								echo "<input type='checkbox' class='attendence-checkbox' data-session-id=" . $sess['id'] ." data-student-id=". $user_id . " checked>";
							}



							else if ($r['status'] === 'absent'){
								echo "<input type='checkbox' class='attendence-checkbox' data-session-id=" . $sess['id'] ." data-student-id=". $user_id . ">";
							}

							echo "</td>";

						}

						echo "</tr>";
					}


					?>




				</tbody>
			</table>





		</div>
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

		<h1 class="mt40">Attendance Chart</h1>


		<canvas id="attendenceChart" width="800" height="400"></canvas>

		<h1 class="mt40">Month Report</h1>

		<table class="styled-table">
			<thead>
				<tr>
					<th>Month</th>
					<th>Total<br>Classes</th>
					<th>Attendence<br>Percentage</th>

				</tr>
			</thead>
			<tbody>

				<?php

				$monthsAndYear = $conn->query("SELECT DISTINCT MONTH(date_time) AS month, YEAR(date_time) AS year
					FROM attendence_session
					WHERE class_id = $class_id
					ORDER BY year, month;
					");

				while($row = $monthsAndYear->fetch_assoc() ){
					echo "<tr>";
					echo "<td>". getMonth($row['month'])." ". $row['year'] ."</td>";

					$totalClasses = $conn->query("SELECT COUNT(*) FROM attendence_session WHERE class_id = $class_id AND MONTH(date_time) =".$row["month"]." AND YEAR(date_time)=". $row['year'])->fetch_array()[0];
					
					echo "<td>$totalClasses</td>";


					$query = "
					SELECT COUNT(*) AS total 
					FROM attendence 
					WHERE session_id IN (
						SELECT id 
						FROM attendence_session 
						WHERE class_id = $class_id 
						AND MONTH(date_time) = {$row['month']} 
						AND YEAR(date_time) = {$row['year']}
						) AND status = 'present'
					";



					$result = $conn->query($query);
					$totalPresentMonth = $result->fetch_assoc()['total'];


					$totalStudents = getNumberOfRecords($conn, "attends WHERE class_id = $class_id");

					$sessionQuery = "
					SELECT COUNT(*) AS total_sessions 
					FROM attendence_session 
					WHERE class_id = $class_id 
					AND MONTH(date_time) = {$row['month']} 
					AND YEAR(date_time) = {$row['year']}
					";
					$sessionResult = $conn->query($sessionQuery);
					$totalSessions = $sessionResult->fetch_assoc()['total_sessions'];

					$totalPossible = $totalStudents * $totalSessions;

					$percentage = $totalPossible > 0 
					? round(($totalPresentMonth / $totalPossible) * 100, 2)
					: 0;

					echo "<td>$percentage</td>";







					echo "</tr>";

				}

				?>






			</tbody>



		</div>








		<?php require '../components/alert.php';?>




		<script>
			const ctx = document.getElementById('attendenceChart').getContext('2d');
			const attendenceChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: [
						<?php
						foreach($sessions_array  as $sess ){
							echo " ' ". date('d-m-y', strtotime($sess['date_time'])) ." ',";
						}


						?>


					],
					datasets: [{
						label: 'Present',
						data: [


							<?php
							foreach($sessions_array  as $sess ){
								echo getNumberOfRecords($conn, "attendence WHERE session_id =". $sess['id'] ." AND status='present'") .",";
							}


							?>


						],
						fill: false,
						borderColor: 'rgb(75, 192, 192)',
						tension: 0.1
					}]
				},
				options: {
					responsive: true,

					plugins: {

					},
					scales: {
						y: {
							beginAtZero: true,
							min: 0,
							max: 1 + <?php echo getNumberOfRecords($conn, "attends WHERE class_id = $class_id") ?>
						}
					}
				}
			});
		</script>


		<script type="text/javascript">

			document.querySelectorAll(".attendence-checkbox").forEach(checkbox => {
				checkbox.addEventListener("change", function(){

					const status = this.checked ? "present" : "absent";
					const session_id = this.dataset.sessionId;
					const student_id = this.dataset.studentId;

					fetch("update_attendence_api.php", {
						method:'POST',
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded'
						},
						body: `session_id=${session_id}&student_id=${student_id}&status=${status}`
					})
					.then(response => response.json())

					.then(data => {
						console.log(`Updated attendance for student ${student_id}:`, data);
					}).catch(error => {
						console.error('Error updating attendance:', error);
					});


				});

			});


		</script>






	</body>
	</html>
