<?php

require '../session.php';


session_unset();
session_destroy();


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Logout - Student Attendence Managment System</title>
	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">

</head>
<body>
	<?php  require '../components/nav.php';?>

	<div class="container-l">
		<h1>You have been Logged out!</h1>
		<p class="p-sm">click here to <a href="login.php" class="link-sm">log in</a> again</p>

	</div>

</body>
</html>