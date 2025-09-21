<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

$student_id = $_SESSION['id'];
$student = $mysqli->query("SELECT Course, Semester FROM student WHERE Student_id='$student_id'")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Courses | Willson College</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-overlay {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('../assets/images/img3.jpg') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
</head>

<body class="bg-overlay text-white min-h-screen flex flex-col">

    <?php include("header.php"); ?>

    <div class="flex-1 flex flex-col lg:flex-row p-6 backdrop-blur-sm bg-white/10 rounded-lg m-6 shadow-xl min-h-screen">
        <?php include("sidebar.php"); ?>

        <main class="flex-1 space-y-6">
            <h2 class="text-2xl font-bold mb-4">My Courses</h2>
            <p><strong>Course:</strong> <?php echo $student['Course']; ?></p>
            <p><strong>Semester:</strong> <?php echo $student['Semester']; ?></p>
            <p class="mt-4 text-gray-600">Course details can be added here (subject-wise breakdown).</p>
        </main>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>