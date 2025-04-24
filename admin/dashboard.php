<?php

require '../session.php';
requireType('admin'); 
require '../db/db_connector.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approve_sign_up_req'])){
	$id = $_POST['approve_sign_up_req'];

	$stmt = $conn->prepare("SELECT * FROM signuprequests WHERE id = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();

	if ($result->num_rows > 0){
		$result = $result->fetch_assoc();
		$stmt = $conn->prepare("UPDATE signuprequests SET status  = ? WHERE id=?");
		$status = 'approved';
		$stmt->bind_param("si", $status, $id);
		$stmt->execute();	

		$stmt->close();

		$stmt = $conn->prepare("UPDATE user SET approved  = 1 WHERE id=?");
		$user_id = $result['user_id'];
		$stmt->bind_param("i", $user_id);
		$stmt->execute();
		$stmt->close();
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['decline_sign_up_req'])){
	$id = $_POST['decline_sign_up_req'];

	$stmt = $conn->prepare("SELECT * FROM signuprequests WHERE id = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();

	if ($result->num_rows > 0){
		$result = $result->fetch_assoc();
		$stmt = $conn->prepare("UPDATE signuprequests SET status  = ? WHERE id=?");
		$status = 'declined';
		$stmt->bind_param("si", $status, $id);
		$stmt->execute();	

		$stmt->close();
	}
}




function getTotalUsers($conn, $type)
{

	$stmt1 = $conn->prepare("SELECT COUNT(id) FROM user WHERE type = ?");
	$stmt1->bind_param("s", $type);
	$stmt1->execute();
	$stmt1->bind_result($count);
	$stmt1->fetch();
	$stmt1->close(); 

	return $count;
}

require '../utils.php';



$numStudent = getTotalUsers($conn, "student");
$numTeacher = getTotalUsers($conn, "teacher");
$numClasses = getNumberOfRecords($conn, "class");


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - SAM System</title>
	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

	<?php  require '../components/nav.php';?>

	<div class="container-l">

		<div class="d-fcc jc-sb admin-cards">

			<div class="admin-card">
				<p class="admin-card-num"data-target="<?php echo $numStudent; ?>">0</p>

				<p class="admin-card-text">Total Students</p>
			</div>		


			<div class="admin-card">
				<p class="admin-card-num"data-target="<?php echo $numTeacher; ?>">0</p>

				<p class="admin-card-text">Total Teachers</p>
			</div>		

			<div class="admin-card">
				<p class="admin-card-num" data-target="<?=$numClasses?>">0</p>

				<p class="admin-card-text">Total Classes</p>
			</div>		
			<div class="admin-card">
				<p class="admin-card-num" data-target="250000">0</p>

				<p class="admin-card-text">Total Attendence</p>
			</div>

		</div>


		<div class="d-f-col mt40">

			<?php 
			$status = "pending";
			$stmt = $conn->prepare("SELECT * FROM signuprequests WHERE status = ? ORDER BY date");
			$stmt->bind_param("s", $status);

			$stmt->execute();
			$result = $stmt->get_result();
			if ($result->num_rows > 0){
				echo "<h1 class='mb20'>New User Approval Requests</h1>";
			}
			while ($row = $result->fetch_assoc()) {
				$user_id = $row['user_id'];
				$user = $conn->query("SELECT id,name, date_created, type FROM user WHERE id = $user_id ")->fetch_assoc();



				echo"<div class='user-row'>
				<div class='user-row-left'>
				<a class='user-row-name td-u' href='/attendence/" . $user['type']. "/profile.php?id=". $user['id'] . "&action=view'>" . $user['name'] . "</a>
				<p class='user-row-date'>Date:".  $user['date_created']. " </p>
				<p class='user-row-type'>type: " . $user['type']. "</p>
				</div>

				<div class='user-row-right'>
				<form action='dashboard.php' method='POST'> 
				<input type='hidden' name='approve_sign_up_req' value=". $row['id'] . ">
				<button type='submit' class='btn'>Approve</button>
				</form>

				<form action='dashboard.php' method='POST'> 
				<input type='hidden' name='decline_sign_up_req' value=". $row['id'] . ">
				<button type='submit' class='btn btn-r'>Decline</button>
				</form>
				</div>

				</div>";
			}

			?>

		</div>
	</div>

	<?php require '../components/alert.php';?>

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