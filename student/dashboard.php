<?php
require '../session.php';
requireType('student'); 

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

	<h1>Welcome <?php echo $_SESSION['name'];?></h1>

</body>
</html>