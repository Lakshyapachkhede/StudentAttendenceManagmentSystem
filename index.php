<?php 
	
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['login'])){
	if ($_SESSION['type'] == 'admin'){
		header("Location: admin/");
	}
	else if ($_SESSION['type'] == 'teacher'){
		header("Location: teacher/");
	} else {
		header("Location: student/");

	}

}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student Attendence Managment System</title>

	<link rel="stylesheet" href="css/util.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" type="image/x-icon" href="/img/logo.ico">
</head>
<body>
	
	<div class="container-l">

		<?php  require 'components/nav.php';?>


		<h1 class="title fq">Student Attendance Management System</h1>

		<div class="content">
			<div class="content-row">
				<img src="img/home1.png">
				<p>Attendance is one of those administrative tasks that must be done at the start of each class. It can take up valuable time at the beginning of class and sometimes be difficult to manage. Attendance books traditionally are big grids with tiny squares that are hard to read and can be easy to make errors in. With QuickSchools' Online Student Information System (also known as Online School Management System), taking and managing attendance is no longer a hassle with our easy to use and robust school attendance system.</p>
			</div>		


			<div class="content-row">
				<p>Attendance is one of those administrative tasks that must be done at the start of each class. It can take up valuable time at the beginning of class and sometimes be difficult to manage. Attendance books traditionally are big grids with tiny squares that are hard to read and can be easy to make errors in. With QuickSchools' Online Student Information System (also known as Online School Management System), taking and managing attendance is no longer a hassle with our easy to use and robust school attendance system.</p>
			</div>
			<div class="content-row">

				<p>Online Parent Tracking</p>
			</div>
			<div class="content-row">
				
				<p>Attendance is one of those administrative tasks that must be done at the start of each class. It can take up valuable time at the beginning of class and sometimes be difficult to manage. Attendance books traditionally are big grids with tiny squares that are hard to read and can be easy to make errors in. With QuickSchools' Online Student Information System (also known as Online School Management System), taking and managing attendance is no longer a hassle with our easy to use and robust school attendance system.</p>
				<img src="img/home2.png">
			</div>
			<div class="content-row">
				<p>Easy to Read Pages</p>
			</div>

			<div class="content-row">
				<p>Another fantastic benefit of QuickSchool’s attendance feature is that the students attendance information is available to parents immediately. Once a teacher saves the attendance record for the period, QuickSchools automatically posts the attendance information to the appropriate Parent Portal without any further action from teachers. Parents can check in with the school through the Parent Portal once a day, once a week, or even period-by-period to ensure their students are attending their classes.</p>
			</div>
		</div>



	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div class="label">
		<p>Experience Effortless Attendence Management with SAM System  </p><a href="auth/signup.php" class="btn-l ml20">Sign Up For Free</a>

	</div>



</body>
</html>