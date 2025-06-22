<?php
require '../db/db_connector.php';
require '../session.php';
require '../utils.php';


$user_type = $_SESSION['type'];

$class_id = $_GET['class_id'];
$student_id = ($user_type == 'student') ? $_SESSION['user_id'] : $_GET['student_id'];

$stmt = $conn->prepare("SELECT * FROM attends WHERE student_id = ? AND class_id = ?");
$stmt->bind_param("ii", $student_id, $class_id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row === null) {
	echo "Invalid Params";
	exit();
}




$totalClass = getNumberOfRecords($conn, "attendence_session WHERE class_id = $class_id");
$totalAttended = $conn->query("SELECT count(*) FROM attendence WHERE student_id = $student_id AND status = 'present' AND session_id IN (SELECT id FROM attendence_session WHERE class_id = $class_id)")->fetch_array()[0];

$percentage = $totalClass > 0 
? round(($totalAttended / $totalClass) * 100, 0)
: 0;

$totalAbsent = $totalClass - $totalAttended;

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

	<div class="container mt20">

		<h1><?= getAttribute($conn, "user", "name", "id", $student_id) ?> - <?= getAttribute($conn, "class", "name", "id", $class_id) ?></h1>

		<div class="d-fcc jc-sb admin-cards mt20">

			<div class="admin-card">
				<p class="admin-card-num text-green"data-target="<?php echo $totalAttended; ?>">0</p>

				<p class="admin-card-text">Present</p>
			</div>		


			<div class="admin-card">
				<p class="admin-card-num text-red"data-target="<?php echo $totalAbsent; ?>">0</p>

				<p class="admin-card-text">Absent</p>
			</div>		

			<div class="admin-card">
				<p class="admin-card-num1 <?=returnTextColorClass($percentage)?>"><?=$percentage?>%</p>

				<p class="admin-card-text">Percent</p>
			</div>		

		</div>
		<?php require '../components/alert.php';?>
		<table class="styled-table">
			<thead>
				<tr>
					<th>Date - Time</th>
					<th>Status</th>
				</tr>

			</thead>
			<tbody>

				<?php
				$sessions = $conn->query("SELECT * FROM attendence_session WHERE class_id=$class_id");

				while($sess = $sessions->fetch_assoc()){

					echo "<tr>";
					echo "<td>" . getFormattedDate($sess["date_time"]) . " - ". date('H:i A', strtotime($sess['date_time'])).  "</td>";

					$result = $conn->query("
						SELECT status 
						FROM attendence 
						WHERE student_id = $student_id 
						AND session_id = {$sess['id']}
						");

					$row = $result->fetch_assoc();
					$status = $row['status'] ?? "absent";

					echo "<td class='". returnStatusTextColorClass($status). "'>$status</td>";






					echo "</tr>";

				}



				?>


			</tbody>
		</table>

	</div>

	<script>

		let counters = document.querySelectorAll(".admin-card-num");

		const duration = 2000;

		counters.forEach(counter=>{
			const updateCount = ()=> {
				const target = +counter.getAttribute('data-target');
				const count = +counter.innerText;

				const increment = target / (duration / 16);
				if (count < target) {
					counter.innerText = Math.ceil(count + increment);
					requestAnimationFrame(updateCount);
				} else {
        counter.innerText = target; // Final fix to exact number
    }
}

updateCount();
})


</script>

</body>

</html>
