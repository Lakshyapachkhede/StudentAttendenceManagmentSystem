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
</head>
<body>
	<h1>Welcome <?php echo $_SESSION['name'];?></h1>

</body>
</html>