<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

$student_id = $_SESSION['id'];

// Fetch vacant rooms
$rooms = $mysqli->query("SELECT * FROM room WHERE Room_status='Available'");

if (isset($_POST['submit'])) {
    $room_id = $_POST['room_id'];
    $reason = $_POST['reason'];
    $status = "Pending";

    $stmt = $mysqli->prepare("INSERT INTO application (Application_status, Request_reason, Room_id, Student_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $status, $reason, $room_id, $student_id);
    if ($stmt->execute()) {
        echo "<script>alert('Application submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Apply for Room</title>
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
            <h2 class="text-2xl font-bold mb-4">Apply for Room</h2>
            <form method="POST" class="space-y-4">
                <label class="block">Select Room</label>
                <select name="room_id" class="w-full border px-3 py-2 rounded" required>
                    <option value="">-- Select Available Room --</option>
                    <?php while ($row = $rooms->fetch_assoc()) { ?>
                        <option value="<?php echo $row['Room_id']; ?>">
                            Room <?php echo $row['Room_id'] . " - " . $row['Type'] . " (Capacity: " . $row['Capacity'] . ")"; ?>
                        </option>
                    <?php } ?>
                </select>

                <label class="block">Reason</label>
                <textarea name="reason" required class="w-full border px-3 py-2 rounded" placeholder="Why do you need this room?"></textarea>

                <button type="submit" name="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Submit Application</button>
            </form>
        </main>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>