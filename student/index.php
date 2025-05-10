<?php
require '../session.php';
require '../db/db_connector.php';
requireType('student'); 


function getAttribute($conn, $table, $attribute, $parameter ,$id){
	$stmt = $conn->prepare("SELECT $attribute FROM $table WHERE $parameter = ?");
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$result = $stmt->get_result()->fetch_assoc()[$attribute] ?? null;
	return $result;

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $_SESSION['name'];?> - Dashboard</title>

	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php require '..\components\nav_sm.php'; ?>

	<div class="container mt20">

		<div class="d-fcc jc-sb">
			<h1>Welcome <?= $_SESSION['name']?></h1>

			<!-- <div class="icon-wrapper">
				<span class="icon-num"><?= $notifications ?></span>
				<img src="/attendence/img/notification.png" alt="notifications" class="icon" id="notification-btn">
			</div> -->


		</div>

		<?php
		$student_id = $_SESSION['user_id'];
		$result = $conn->query("SELECT * FROM attends WHERE student_id = $student_id");

		while($row = $result->fetch_assoc()){
			echo "<div class='user-row'>
			<div class='user-row-left'>
			<a class='link td-u' href='/attendence/class/class.php?id=". $row['class_id']. " '>" . getAttribute($conn, "class", "name","id", $row['class_id']) . "</a>
			<p>Joined: ".   (new DateTime($row["date_joined"]))->format('F j, Y') . "</p>

			<p>Branch: " . getAttribute($conn, "branch", "full_name","id", getAttribute($conn, "class", "branch","id", $row['class_id'])) . "</p>

			</div>

			<div class='user-row-right'>
			<a class='btn' href='class.php?id=".  $row["class_id"] ." '>View</a>


			<a class='btn btn-s' >Attendence</a>
			</div>

			</div>";
		}

		?>



	</div>

	<?php require '../components/alert.php';?>

</body>
</html>