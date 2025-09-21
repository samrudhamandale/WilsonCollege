<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

$student_id = $_SESSION['id'];
$room = $mysqli->query("SELECT r.* FROM application a 
                        JOIN room r ON a.Room_id=r.Room_id 
                        WHERE a.Student_id='$student_id' AND a.Application_status='Approved' 
                        LIMIT 1")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Room | Willson College</title>
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
            <h2 class="text-2xl font-bold mb-4">My Room</h2>
            <?php if ($room) { ?>
                <p><strong>Room No:</strong> <?php echo $room['Room_id']; ?></p>
                <p><strong>Type:</strong> <?php echo $room['Type']; ?></p>
                <p><strong>Floor:</strong> <?php echo $room['Floor']; ?></p>
                <p><strong>Capacity:</strong> <?php echo $room['Capacity']; ?></p>
                <p><strong>Status:</strong> <?php echo $room['Room_status']; ?></p>
            <?php } else {
                echo "<p class='text-gray-500'>No room assigned yet.</p>";
            } ?>
        </main>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>