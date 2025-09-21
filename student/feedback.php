<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

$student_id = $_SESSION['id'];

if (isset($_POST['submit'])) {
    $feedback = $_POST['feedback'];
    $rating = $_POST['rating'];
    $date = date("Y-m-d");

    $stmt = $mysqli->prepare("INSERT INTO feedback (Feedback, Rating, Datetime, Student_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisi", $feedback, $rating, $date, $student_id);
    if ($stmt->execute()) {
        echo "<script>alert('Thank you for your feedback!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Give Feedback</title>
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
            <h2 class="text-2xl font-bold mb-4">Give Feedback</h2>
            <form method="POST" class="space-y-4">
                <textarea name="feedback" required class="w-full border px-3 py-2 rounded" placeholder="Write your feedback..."></textarea>
                <select name="rating" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Select Rating</option>
                    <option value="1">1 - Poor</option>
                    <option value="2">2</option>
                    <option value="3">3 - Average</option>
                    <option value="4">4</option>
                    <option value="5">5 - Excellent</option>
                </select>
                <button type="submit" name="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Submit Feedback</button>
            </form>
        </main>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>