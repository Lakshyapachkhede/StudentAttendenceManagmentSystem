<?php
$error = "";
require '../db/db_connector.php';
require '../session.php';
require '../utils.php';
requireType("teacher");

if (getAttribute($conn, "user", "approved",  "id", $_SESSION['user_id'])){
	$_SESSION['approved'] = 1;
}
else{
	header("Location: /attendence/index.php"); 
	$_SESSION['alert_message'] = "your account is not approved yet please wait till getting approved";
	exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST"){
	$name = $_POST["class_name"];
	$desc = $_POST["class_desc"];
	$branch = $_POST["branch"];

	$stmt = $conn->prepare("INSERT INTO class (teacher_id, name, description, branch) VALUES (?, ? ,? ,?)");

	$stmt->bind_param("issi", $_SESSION['user_id'], $name, $desc, $branch);

	$stmt->execute();

	$id = $conn->insert_id;



	header("Location: select_class_location.php?class_id=$id");





}





?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Create Class - SAM</title>
	
	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">

	</style>
</head>
<body>
	

	<?php require '../components/nav_sm.php'; ?>

	<div class="container mt40">
		
		<form class="form f-l d-f-col form-create-class" action="create_class.php" method="POST">

			<h1 class="tac mb10">Create Class</h1>


			<div class="row">
				<p>Class Name</p>

				<input type="text" name="class_name" class="f-input" placeholder="class name" value="<?php if (isset($class_name)) {echo "$class_name";}?>" required>

			</div>


			<div class="row">
				<p>Description</p>

				<textarea type="text" name="class_desc" class="f-input"><?= $class_name ?? "About Class"; ?></textarea>



			</div>

			<div class="row jc-sb">
				<p>Branch</p>
				<select name="branch" id="branch" style="max-width: 77%;">

					<?php 
					$stmt = $conn->prepare("SELECT id, full_name FROM branch");
					$stmt->execute();
					$result=$stmt->get_result();
					$stmt->close();
					while ($row = $result->fetch_assoc()) {
						if ($row['id'] == $profile_data['branch']){
							echo "<option value=" . $row['id'] . " selected>" . $row['full_name'] .  "</option> ";
						}else{
							echo "<option value=" . $row['id'] . ">" . $row['full_name'] .  "</option>";
						}

					}


					?>


				</select>

			</div>


			<?php if ($error != ""){
				echo "<p class='mb10 mt20 t-warn'>$error</p>";
			}?>

			<button type="submit" class="btn mb10 mt20">Create</button>
		</form>




	</div>
	
</body>
</html>