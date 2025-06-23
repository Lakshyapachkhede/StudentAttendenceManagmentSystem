<?php
require '../db/db_connector.php';
require '../session.php';
require '../utils.php';
requireType("student");

$class_id = $_GET['class_id'];

if (!isAttends($conn, $class_id, $_SESSION['user_id'])){
	echo "invalid request";
	echo "$class_id";
	die();
}

function haversineDistance($lat1, $lon1, $lat2, $lon2, $earthRadius = 6371000) {
    // Convert degrees to radians
	$lat1 = deg2rad($lat1);
	$lon1 = deg2rad($lon1);
	$lat2 = deg2rad($lat2);
	$lon2 = deg2rad($lon2);

    // Haversine formula
	$deltaLat = $lat2 - $lat1;
	$deltaLon = $lon2 - $lon1;

	$a = sin($deltaLat / 2) ** 2 +
	cos($lat1) * cos($lat2) *
	sin($deltaLon / 2) ** 2;

	$c = 2 * asin(sqrt($a));

    return $earthRadius * $c; // in meters
}

function isWithin100Meters($lat1, $lon1, $lat2, $lon2) {
	$distance = haversineDistance($lat1, $lon1, $lat2, $lon2);
	return $distance <= 100;
}

$longitude = getAttribute($conn, "class", "longitude", "id", $class_id);
$latitude = getAttribute($conn, "class", "latitude", "id", $class_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$Loclatitude = floatval($_POST['latitude']);
	$Loclongitude = floatval($_POST['longitude']);



	$currentOpenSession = getAttribute($conn, "class", "open_session_id", "id", $class_id);

	if ($currentOpenSession == NULL){
		$_SESSION['alert_message'] = "attendence window not open for " . getAttribute($conn, "class", "name", 'id', $class_id);


	} else {
		$time = getAttribute($conn, "attendence_session", "date_time", "id", $currentOpenSession);

		$targetTime = strtotime($time);
		$currentTime = time();

		if ($targetTime <= $currentTime && $targetTime >= ($currentTime - 600)) {

			if(isWithin100Meters($longitude, $latitude, $Loclongitude, $Loclatitude)){


				$stmt = $conn->prepare("UPDATE attendence SET status = 'present' WHERE session_id =? AND student_id = ?");
				$stmt->bind_param("ii", $currentOpenSession, $_SESSION['user_id']);
				$stmt->execute();
				$_SESSION['alert_message'] = "attendence submitted for " . getAttribute($conn, "class", "name", 'id', $class_id);
			} else {
				$_SESSION['alert_message'] = "you are not near class -  " . getAttribute($conn, "class", "name", 'id', $class_id);
			}

		}else {
			$_SESSION['alert_message'] = "attendence window not open for " . getAttribute($conn, "class", "name", 'id', $class_id);


		}






	}

	header("Location: " . $_SERVER['REQUEST_URI']);
	exit;


}



?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Select Class Location - SAM</title>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

	<link rel="stylesheet" href="../css/util.css">
	<link rel="stylesheet" href="../css/style.css">
	<style>
		#map {
			height: 100vh;
		}
	</style>
</head>
<body>
	<?php require '..\components\nav_sm.php'; ?>
	<div class="container mt40">

		<h1>Mark Attendence for class - <?= getAttribute($conn, "class", "name", "id", $class_id) ?></h1>

		<div id="map" ></div>
		<form action="mark_student_attendence.php?class_id=<?=$class_id?>" method="POST" class="d-fcc">

			<input type="hidden" name="longitude" id="longitude">
			<input type="hidden" name="latitude" id="latitude">
			<button type="submit" class="btn mb10 mt20" disabled id="submitBtn">Submit</button>


		</form>
	</div>
	<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
	<script>	

		let longitudeInput = document.getElementById("longitude");
		let latitudeInput = document.getElementById("latitude");
		const submitBtn = document.getElementById("submitBtn");

		let classLat = <?php if ($latitude != NULL){echo $latitude;} ?>;
		let classLon = <?php if ($longitude != NULL){echo $longitude;} ?>;

		const map = L.map('map').setView([classLat, classLon], 6);

		L.marker([classLat, classLon])
		.addTo(map)
		.bindPopup("Class Location")
		.openPopup();

		navigator.geolocation.getCurrentPosition(function (position) {



			const lat = position.coords.latitude;
			const lon = position.coords.longitude; 


			longitudeInput.value = lon;
			latitudeInput.value = lat;

			submitBtn.disabled = false;

			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				attribution: '© OpenStreetMap contributors'
			}).addTo(map);






                // Fetch address using OpenStreetMap Nominatim
			fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`)
			.then(res => res.json())
			.then(data => {
				const displayName = data.display_name || "Unknown location";


				L.marker([lat, lon]).addTo(map)
				.bindPopup(`<b>${displayName}</b>`)
				.openPopup();
			})
			.catch(err => {
				alert("Failed to get location name.");
				console.error(err);
			});
		},


		function (error) {
			if (error.code === 1) {
				alert("Location access denied. Please turn on location and allow location in browser settings to mark attendance.");
			} else {
				alert("Geolocation error: " + error.message);
			}
		});
	</script>
	<?php require '../components/alert.php';?>

</body>
</html>