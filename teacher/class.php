<?php
require '../db/db_connector.php';
require '../session.php';

$class_id = $_GET['id'];


$stmt = $conn->prepare("SELECT name, description, teacher_id, branch, date_created FROM class WHERE id = ?");
$stmt->bind_param("i", $class_id);

$stmt->execute();
$result = $stmt->get_result();
$class_data = $result->fetch_assoc();

$teacher_id =  $class_data['teacher_id'];

$teacher_name = $conn->query("SELECT name from user WHERE id = $teacher_id")->fetch_assoc()['name'];






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
					
					<div class="d-f g-10">
						<a class = "link"href="profile.php?id=<?=$teacher_id?>"><?= $teacher_name ?></a>
						<p> <?php echo (new DateTime($class_data["date_created"]))->format('F j, Y'); ?></p>
					</div>

					<img src="/attendence/img/share.png" style="width: 20px;" id="shareBtn">

				</div>


				<hr class="">

				<h1 class="text-dark mt10"><?= $class_data["name"] ?></h1>


				<p class="text"><?= $class_data["description"] ?></p>
			</div>

		</div>

	</div>

	<script type="text/javascript">
		document.getElementById('shareBtn').addEventListener('click', () => {
			navigator.clipboard.writeText("<?=SERVER_URL?>/attendence/teacher/class.php?id=<?=$class_id?>");
		});


	</script>

</body>
</html>


