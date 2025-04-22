<?php
require '../db/db_connector.php';
require '../session.php';
requireType("teacher");

function getBranchName($id, $conn)
{
	$stmt = $conn->prepare("SELECT full_name FROM branch WHERE id = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->bind_result($result);

	if ($stmt->fetch()) {
		$stmt->close();
		return $result;
	} else {
		$stmt->close();
		return null; 
	}
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Teacher Dashboard SAM</title>
	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

	<?php require '..\components\nav_sm.php'; ?>

	<div class="container mt20">

		<h1>Welcome <?= $_SESSION['name']?></h1>

		<?php
		$teacher_id = $_SESSION['user_id'];
			$result = $conn->query("SELECT * FROM class WHERE teacher_id = $teacher_id");

			while($row = $result->fetch_assoc()){
				echo "<div class='user-row'>
			<div class='user-row-left'>
				<a class='link td-u' href='/attendence/teacher/class.php?id=". $row['id']. " '>" . $row['name'] . "</a>
				<p>Date: ".   (new DateTime($row["date_created"]))->format('F j, Y') . " </p>

				<p>Branch: " . getBranchName($row['branch'], $conn) . "</p>
		
			</div>

			<div class='user-row-right'>
				<a class='btn' href='class.php?id=".  $row["id"] ." '>View</a>


				<a class='btn btn-s' >Attendence</a>
			</div>

		</div>";
			}




		?>


		


	</div>


</body>
</html>