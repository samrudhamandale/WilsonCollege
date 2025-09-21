<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

$result = $mysqli->query("SELECT f.Feedback_id, f.Feedback, f.Rating, f.Datetime, s.Name 
                          FROM feedback f 
                          JOIN student s ON f.Student_id=s.Student_id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Feedback</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include("../layout/header.php"); ?>
    <div class="flex">
        <?php include("../layout/sidebar.php"); ?>
        <main class="flex-1 p-6 bg-white">
            <h2 class="text-2xl font-bold mb-4">Manage Feedback</h2>
            <table class="w-full border border-gray-300">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Student</th>
                        <th class="border px-4 py-2">Feedback</th>
                        <th class="border px-4 py-2">Rating</th>
                        <th class="border px-4 py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo $row['Feedback_id']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['Name']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['Feedback']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['Rating']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['Datetime']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </main>
    </div>
    <?php include("../layout/footer.php"); ?>
</body>

</html>