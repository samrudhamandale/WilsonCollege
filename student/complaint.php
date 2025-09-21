<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

$student_id = $_SESSION['id'];

if (isset($_POST['submit'])) {
    $desc = $_POST['description'];
    $status = "Pending";

    $stmt = $mysqli->prepare("INSERT INTO complaint (Description, Status, Student_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $desc, $status, $student_id);
    if ($stmt->execute()) {
        echo "<script>alert('Complaint submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lodge Complaint</title>
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
            <h2 class="text-2xl font-bold mb-4">Lodge a Complaint</h2>
            <form method="POST">
                <textarea name="description" required class="w-full border px-3 py-2 rounded" placeholder="Describe your complaint..."></textarea>
                <button type="submit" name="submit" class="mt-4 bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Submit Complaint</button>
            </form>
        </main>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>