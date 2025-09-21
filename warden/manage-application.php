<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

$result = $mysqli->query("SELECT a.Application_id, a.Application_status, a.Request_reason, s.Name as StudentName, r.Type as RoomType 
                          FROM application a
                          JOIN student s ON a.Student_id=s.Student_id
                          JOIN room r ON a.Room_id=r.Room_id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Applications</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include("../layout/header.php"); ?>
    <div class="flex">
        <?php include("../layout/sidebar.php"); ?>
        <main class="flex-1 p-6 bg-white">
            <h2 class="text-2xl font-bold mb-4">Manage Applications</h2>
            <table class="w-full border border-gray-300">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Student</th>
                        <th class="border px-4 py-2">Room</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Reason</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo $row['Application_id']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['StudentName']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['RoomType']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['Application_status']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['Request_reason']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </main>
    </div>
    <?php include("../layout/footer.php"); ?>
</body>

</html>