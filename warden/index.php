<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

// Get counts dynamically
$totalStudents = $mysqli->query("SELECT COUNT(*) FROM student")->fetch_row()[0];
$availableRooms = $mysqli->query("SELECT COUNT(*) FROM room WHERE Room_status='Available'")->fetch_row()[0];
$pendingRequests = $mysqli->query("SELECT COUNT(*) FROM application WHERE Application_status='Pending'")->fetch_row()[0];
$totalStaff = $mysqli->query("SELECT COUNT(*) FROM staff")->fetch_row()[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Warden Dashboard | Willson College</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-cover bg-fixed bg-center text-black"
    style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
      url('../assets/images/img3.jpg') no-repeat center center;
      background-size: cover;">

    <?php include("../layout/header.php"); ?>

    <div class="flex flex-col lg:flex-row">
        <?php include("../layout/sidebar.php"); ?>

        <main class="flex-1 p-6 bg-white bg-opacity-90">
            <h2 class="text-2xl font-bold text-blue-900 mb-4">Welcome, Warden</h2>

            <!-- Dynamic Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-4 rounded shadow-md border-l-4 border-blue-600">
                    <p class="text-sm text-gray-500">Total Students</p>
                    <h3 class="text-3xl font-bold text-black"><?php echo $totalStudents; ?></h3>
                </div>
                <div class="bg-white p-4 rounded shadow-md border-l-4 border-blue-600">
                    <p class="text-sm text-gray-500">Available Rooms</p>
                    <h3 class="text-3xl font-bold text-black"><?php echo $availableRooms; ?></h3>
                </div>
                <div class="bg-white p-4 rounded shadow-md border-l-4 border-blue-600">
                    <p class="text-sm text-gray-500">Pending Requests</p>
                    <h3 class="text-3xl font-bold text-black"><?php echo $pendingRequests; ?></h3>
                </div>
                <div class="bg-white p-4 rounded shadow-md border-l-4 border-blue-600">
                    <p class="text-sm text-gray-500">Staff Members</p>
                    <h3 class="text-3xl font-bold text-black"><?php echo $totalStaff; ?></h3>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <h4 class="text-xl font-semibold text-blue-800 mb-3">Quick Actions</h4>
                <div class="flex flex-wrap gap-4">
                    <a href="manage-student.php" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Manage Students</a>
                    <a href="manage-room.php" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Manage Rooms</a>
                    <a href="manage-report.php" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Reports</a>
                </div>
            </div>
        </main>
    </div>

    <?php include("../layout/footer.php"); ?>
</body>

</html>