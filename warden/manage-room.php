<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

$result = $mysqli->query("SELECT * FROM room");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Rooms</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include("../layout/header.php"); ?>
    <div class="flex">
        <?php include("../layout/sidebar.php"); ?>
        <main class="flex-1 p-6 bg-white">
            <h2 class="text-2xl font-bold mb-4">Manage Rooms</h2>
            <table class="w-full border border-gray-300">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="border px-4 py-2">Room ID</th>
                        <th class="border px-4 py-2">Type</th>
                        <th class="border px-4 py-2">Fees</th>
                        <th class="border px-4 py-2">Capacity</th>
                        <th class="border px-4 py-2">Occupacy</th>
                        <th class="border px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo $row['Room_id']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['Type']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['Fees']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['Capacity']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['Occupacy']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['Room_status']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </main>
    </div>
    <?php include("../layout/footer.php"); ?>
</body>

</html>