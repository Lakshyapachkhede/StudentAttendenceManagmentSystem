<?php
require '../session.php';
require '../db/db_connector.php';
require '../utils.php';
requireType("teacher");

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=report.xls");
echo "\xEF\xBB\xBF"; // UTF-8 BOM

$class_id = $_GET['id'];

$teacher_id = getAttribute($conn, "class", "teacher_id", "id", $class_id);

if ($teacher_id == null){
    echo "Invalid Class";
    exit();
} else if (!isLoggedInUser($teacher_id)) {
    echo "Un authorized access";
    exit();
}







    // Get all students



echo "<html><head><meta charset='UTF-8'></head><body>";

echo "<h2>Attendance Report -" . getAttribute($conn, "class", "name", "id", $class_id).  getFormattedCurrentDate() . "</h2>";


?>



<table border="1">
    <tr>
        <th>Name</th>
        <th>Roll No</th>

        <?php
        $sessions = getRecords($conn, "attendence_session", "class_id", $class_id);
        $sessions_array = [];
        foreach ($sessions as $session) {
            $sessions_array[] = $session;

            echo "<th>" . date('d-m-y h:i A', strtotime($session['date_time'])) . "</th>";
        }

        ?>

    </tr>

    <?php

    $all_students = getRecords($conn, "attends", "class_id", $class_id);
    while ($row = $all_students->fetch_assoc()) {
        echo "<tr>";
        $user_id = $row['student_id'];
        $student_name = getAttribute($conn, "user", "name", "id", $user_id);
        $student_roll_no = getAttribute($conn, "student_profile", "roll_no", "student_id", $user_id);

        echo "<td>$student_name</td>";
        echo "<td>$student_roll_no</td>";


        foreach ($sessions_array as $sess) {
            $stmt = $conn->prepare("SELECT status FROM attendence WHERE session_id = ? AND student_id = ?");
            $stmt->bind_param("ii", $sess['id'], $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $r = $result->fetch_assoc();

            $status = '-';
            if ($r) {
                $status = ($r['status'] === 'present') ? 'P' : 'A';
            }

            echo "<td>$status</td>";
            
        }


        echo "</tr>";

    }

    ?>
</table>

<?php 
echo "</body></html>";
 ?>