<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

$totalStudents = $mysqli->query("SELECT COUNT(*) FROM student")->fetch_row()[0];
$totalRooms = $mysqli->query("SELECT COUNT(*) FROM room")->fetch_row()[0];
$pendingApplications = $mysqli->query("SELECT COUNT(*) FROM application WHERE Application_status='Pending'")->fetch_row()[0];
$totalFeedback = $mysqli->query("SELECT COUNT(*) FROM feedback")->fetch_row()[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reports</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include("../layout/header.php"); ?>
    <div class="flex">
        <?php include("../layout/sidebar.php"); ?>
        <main class="flex-1 p-6 bg-white">
            <h2 class="text-2xl font-bold mb-4">System Reports</h2>

            <ul class="list-disc pl-6 text-lg">
                <li>Total Students: <b><?php echo $totalStudents; ?></b></li>
                <li>Total Rooms: <b><?php echo $totalRooms; ?></b></li>
                <li>Pending Applications: <b><?php echo $pendingApplications; ?></b></li>
                <li>Total Feedback Entries: <b><?php echo $totalFeedback; ?></b></li>
            </ul>
        </main>
    </div>
    <?php include("../layout/footer.php"); ?>
</body>

</html>