<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

$student_id = $_SESSION['id'];
$student = $mysqli->query("SELECT * FROM student WHERE Student_id='$student_id'")->fetch_assoc();

// Get assigned room if any
$room = $mysqli->query("SELECT r.* FROM application a 
                        JOIN room r ON a.Room_id=r.Room_id 
                        WHERE a.Student_id='$student_id' AND a.Application_status='Approved' 
                        LIMIT 1")->fetch_assoc();

// Get latest notices
$notices = $mysqli->query("SELECT * FROM notice ORDER BY Post_date DESC LIMIT 3");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Dashboard | Willson College</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-overlay {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('../assets/images/img3.jpg') no-repeat center center;
            background-size: cover;
        }
    </style>
</head>

<body class="bg-overlay text-white min-h-screen flex flex-col">
    <?php include("header.php"); ?>
    <div class="flex-1 flex flex-col lg:flex-row p-6 backdrop-blur-sm bg-white/10 rounded-lg m-6 shadow-xl">
        <?php include("sidebar.php"); ?>
        <main class="flex-1 space-y-6">
            <h2 class="text-3xl font-semibold text-blue-100 mb-2">Welcome, <?php echo $student['Name']; ?></h2>
            <p class="text-blue-200">Here’s your personalized dashboard.</p>

            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                <div class="bg-white text-black p-4 rounded shadow-md">
                    <h3 class="text-lg font-semibold text-blue-800">Room Information</h3>
                    <?php if ($room) { ?>
                        <p class="mt-2">Room No: <strong><?php echo $room['Room_id']; ?></strong><br>
                            Type: <strong><?php echo $room['Type']; ?></strong></p>
                    <?php } else {
                        echo "<p class='mt-2 text-gray-500'>No room assigned yet.</p>";
                    } ?>
                </div>
                <div class="bg-white text-black p-4 rounded shadow-md">
                    <h3 class="text-lg font-semibold text-blue-800">My Course</h3>
                    <p class="mt-2"><strong><?php echo $student['Course']; ?></strong> (Semester <?php echo $student['Semester']; ?>)</p>
                </div>
                <div class="bg-white text-black p-4 rounded shadow-md">
                    <h3 class="text-lg font-semibold text-blue-800">Profile Summary</h3>
                    <p class="mt-2">Name: <strong><?php echo $student['Name']; ?></strong><br>
                        Email: <strong><?php echo $student['Email']; ?></strong></p>
                </div>
                <div class="bg-white text-black p-4 rounded shadow-md">
                    <h3 class="text-lg font-semibold text-blue-800">Latest Notices</h3>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        <?php while ($row = $notices->fetch_assoc()) { ?>
                            <li><?php echo $row['Title']; ?> (till <?php echo $row['Expiry_date']; ?>)</li>
                        <?php } ?>
                    </ul>
                </div>
            </section>
        </main>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>