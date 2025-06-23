<?php
require '../db/db_connector.php';
require '../session.php';
require '../utils.php';


$class_id = $_GET['id'];


$stmt = $conn->prepare("SELECT name, description, teacher_id, branch, date_created FROM class WHERE id = ?");
$stmt->bind_param("i", $class_id);

$stmt->execute();
$result = $stmt->get_result();
$class_data = $result->fetch_assoc();

$teacher_id =  $class_data['teacher_id'];

$teacher_name = $conn->query("SELECT name from user WHERE id = $teacher_id")->fetch_assoc()['name'];



$message = "Link Copied to Clipboard.";


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Class - <?= $class_data["name"] ?></title>
	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php require '..\components\nav_sm.php'; ?>

	<div class="container mt40">
		<div class="class">
			<div class="class-left">
				<img src="/attendence/img/user.jpg" alt="">
			</div>
			<div class="class-right  mw-80">

				<div class="d-f jc-sb  mb10 ai-c">
					
					<div class="d-f g-10 class-name-date">
						<a class = "link"href="/attendence/teacher/profile.php?id=<?=$teacher_id?>"><?= $teacher_name ?></a>
						<p> <?php echo (new DateTime($class_data["date_created"]))->format('F j, Y'); ?></p>
					</div>

					<?php if ($_SESSION['type'] == "teacher"):?>
						<div class="d-f">
							<img src="/attendence/img/copy.png"  class="icon" id="shareBtn"
							>
							<a href="select_class_location.php?class_id=<?=$class_id?>"><img src="/attendence/img/location.png"  class="icon"></a>
						</div>


					<?php else: ?>	
						<a class="btn" href="/attendence/class/join_class.php?id=<?=$class_id?>">Join</a>


					<?php endif; ?>



				</div>


				<hr class="">

				<h1 class="text-dark mt10"><?= $class_data["name"] ?></h1>


				<p class="text"><?= $class_data["description"] ?></p>
			</div>

		</div>

		<div class="class-data mt40">
			

			<?php


			if (isLoggedInUser($teacher_id)){



				$result =getRecords($conn, "attends", "class_id", $class_id);

				if ($result->num_rows > 0){
					echo "<div class='d-fcc jc-sb short-col'><h1 class='mb20'>Students - " . $class_data['name'] . "</h1><a class='link td-u mr20' href='class_students.php?id=$class_id'>all students</a></div>";
				} else {
					echo "<h1 class='mb20'>No students in " . $class_data['name'] . "</h1>";

				}
				$count = 0;

				while (($row = $result->fetch_assoc() ) && $count < 5) {
					$count++;
					$user_id = $row['student_id'];
					$user_data = getRecords($conn, "user", "id", $user_id)->fetch_assoc();
					$user_profile_data = getRecords($conn, "student_profile", "student_id", $user_id)->fetch_assoc();



					echo"<div class='user-row'>
					<div class='user-row-left'>
					<a class='user-row-name td-u' href='/attendence/" . $user_data['type']. "/profile.php?id=". $user_data['id'] . "&action=view'>" . $user_data['name'] . "</a>
					<p>". $user_profile_data['roll_no'] ."</p>
					<p class='user-row-date'>Joined: ".  getFormattedDate($row['date_joined']). " </p>

					</div>

					<div class='user-row-right'>

					</div>

					</div>";
				}

			}

			?>





		</div>
	</div>


	<div class="alert" id="alert">
		<img src="/attendence/img/check.png" alt="Check Mark">
		<p class="f-r"><?= $message ?></p>
	</div>

	<?php require '../components/alert.php';?>


	<script type="text/javascript">
		let alert = document.getElementById("alert");
		document.getElementById('shareBtn').addEventListener('click', () => {
			navigator.clipboard.writeText("<?=SERVER_URL?>/attendence/class/class.php?id=<?=$class_id?>");


			alert.classList.toggle("show");


		});


	</script>

</body>
</html>


