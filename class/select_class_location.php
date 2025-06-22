<?php

require '../db/db_connector.php';
require '../session.php';
require '../utils.php';
requireType("teacher");

$class_id = $_GET['class_id'];

if(!isLoggedInUser(getAttribute($conn, "class", "teacher_id", "id", $class_id))){
	header("Location: /attendence/index.php");
}


if (getAttribute($conn, "user", "approved",  "id", $_SESSION['user_id'])){
	$_SESSION['approved'] = 1;
}
else{
	header("Location: /attendence/index.php"); 
	$_SESSION['alert_message'] = "your account is not approved yet please wait till getting approved";
	exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$longitude = $_POST['longitude'];
	$latitude = $_POST['latitude'];

	$stmt = $conn->prepare("UPDATE class SET longitude=? ,latitude=? WHERE id = ?");
	$stmt->bind_param("ddi", $longitude, $latitude, $class_id);
	$stmt->execute();

	header("Location: class.php?id=$class_id");

}

$longitude = getAttribute($conn, "class", "longitude", "id", $class_id);
$latitude = getAttribute($conn, "class", "latitude", "id", $class_id);




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

		<h1>Select Location for class - <?= getAttribute($conn, "class", "name", "id", $class_id) ?></h1>

		<div id="map" ></div>
		<form action="select_class_location.php?class_id=<?=$class_id?>" method="POST" class="d-fcc">
			
			<input type="hidden" name="longitude" id="longitude">
			<input type="hidden" name="latitude" id="latitude">
			<button type="submit" class="btn mb10 mt20">Done</button>


		</form>
	</div>
	<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
	<script>
			let longitudeInput = document.getElementById("longitude");
			let latitudeInput = document.getElementById("latitude");


			navigator.geolocation.getCurrentPosition(function (position) {



				const lat = <?php if ($latitude != NULL){echo $latitude;} else {echo "position.coords.latitude";} ?> ;
				const lon = <?php if ($longitude != NULL){echo $longitude;} else {echo "position.coords.longitude";} ?> ;
				longitudeInput.value = lon;
				latitudeInput.value = lat;


				const map = L.map('map').setView([lat, lon], 13);

				L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '© OpenStreetMap contributors'
				}).addTo(map);

            // Show current location
				L.marker([lat, lon]).addTo(map)
				.bindPopup("Selected Location")
				.openPopup();

            // Add marker for selection
				let selectedMarker;

            // Listen for clicks on the map
				map.on('click', function (e) {
					const selectedLat = e.latlng.lat;
					const selectedLon = e.latlng.lng;
					longitudeInput.value = selectedLon.toFixed(5);
					latitudeInput.value = selectedLat.toFixed(5);

                // Fetch address using OpenStreetMap Nominatim
					fetch(`https://nominatim.openstreetmap.org/reverse?lat=${selectedLat}&lon=${selectedLon}&format=json`)
					.then(res => res.json())
					.then(data => {
						const displayName = data.display_name || "Unknown location";

						if (selectedMarker) {
							selectedMarker.setLatLng(e.latlng);
						} else {
							selectedMarker = L.marker(e.latlng).addTo(map);
						}

						selectedMarker.bindPopup(`<b>${displayName}</b><br>Lat: ${selectedLat.toFixed(5)}, Lng: ${selectedLon.toFixed(5)}`).openPopup();
						console.log("Selected Location:", displayName);
					})
					.catch(err => {
						alert("Failed to get location name.");
						console.error(err);
					});
				});


			}, function (error) {
				alert("Geolocation error: " + error.message);
			});
		</script>
	<?php require '../components/alert.php';?>
		
	</body>
	</html>