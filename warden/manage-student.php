<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

$result = $mysqli->query("SELECT * FROM student");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Students</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include("../layout/header.php"); ?>
    <div class="flex">
        <?php include("../layout/sidebar.php"); ?>

        <main class="flex-1 p-6 bg-white">
            <h2 class="text-2xl font-bold mb-4">Manage Students</h2>

            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Course</th>
                        <th class="border px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo $row['Student_id']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['Name']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['Email']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['Course']; ?></td>
                            <td class="border px-4 py-2">
                                <a href="edit-student.php?id=<?php echo $row['Student_id']; ?>" class="text-blue-600">Edit</a> |
                                <a href="delete-student.php?id=<?php echo $row['Student_id']; ?>" class="text-red-600">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </main>
    </div>
    <?php include("../layout/footer.php"); ?>
</body>

</html>