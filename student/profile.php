<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

$student_id = $_SESSION['id'];
$student = $mysqli->query("SELECT * FROM student WHERE Student_id='$student_id'")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Profile | Willson College</title>
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
            <h2 class="text-2xl font-bold mb-4">My Profile</h2>
            <table class="w-full border">
                <tr>
                    <th class="p-2 border">Name</th>
                    <td class="p-2 border"><?php echo $student['Name']; ?></td>
                </tr>
                <tr>
                    <th class="p-2 border">Email</th>
                    <td class="p-2 border"><?php echo $student['Email']; ?></td>
                </tr>
                <tr>
                    <th class="p-2 border">Phone</th>
                    <td class="p-2 border"><?php echo $student['Phone']; ?></td>
                </tr>
                <tr>
                    <th class="p-2 border">Address</th>
                    <td class="p-2 border"><?php echo $student['Address']; ?></td>
                </tr>
                <tr>
                    <th class="p-2 border">Guardian</th>
                    <td class="p-2 border"><?php echo $student['Guardian_name'] . " (" . $student['Guardian_phone'] . ")"; ?></td>
                </tr>
                <tr>
                    <th class="p-2 border">Course</th>
                    <td class="p-2 border"><?php echo $student['Course']; ?></td>
                </tr>
                <tr>
                    <th class="p-2 border">Semester</th>
                    <td class="p-2 border"><?php echo $student['Semester']; ?></td>
                </tr>
                <tr>
                    <th class="p-2 border">Academic Year</th>
                    <td class="p-2 border"><?php echo $student['Academic_year']; ?></td>
                </tr>
            </table>
        </main>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>