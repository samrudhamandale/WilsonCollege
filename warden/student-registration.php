<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

if (isset($_POST['submit'])) {
    $name = $_POST['fname'] . " " . $_POST['mname'] . " " . $_POST['lname']; // Combine full name
    $email = $_POST['email'];
    $phone = $_POST['contact'];
    $address = $_POST['address'];
    $guardian_name = $_POST['guardian_name'];
    $guardian_phone = $_POST['guardian_phone'];
    $academic_year = $_POST['academic_year'];
    $semester = $_POST['semester'];
    $course = $_POST['course'];
    $password = md5($_POST['password']); // hashing (same as login)

    $query = "INSERT INTO student (Name, Email, Phone, Address, Password, Guardian_name, Guardian_phone, Academic_year, Semester, Course)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ssssssssss', $name, $email, $phone, $address, $password, $guardian_name, $guardian_phone, $academic_year, $semester, $course);

    if ($stmt->execute()) {
        echo "<script>alert('Student has been Registered!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Registration | Willson College</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function validatePassword() {
            let pass = document.forms["registration"]["password"].value;
            let confirm = document.forms["registration"]["cpassword"].value;
            if (pass !== confirm) {
                alert("Passwords do not match!");
                return false;
            }
            return true;
        }
    </script>
</head>

<body class="bg-gray-100">

    <?php include("../layout/header.php"); ?>

    <div class="flex">
        <?php include("../layout/sidebar.php"); ?>

        <main class="flex-1 p-6 bg-white">
            <h2 class="text-2xl font-bold text-blue-900 mb-6">Student Registration Form</h2>

            <form method="POST" name="registration" onsubmit="return validatePassword();">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block mb-1 text-sm font-medium">First Name</label>
                        <input type="text" name="fname" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Middle Name</label>
                        <input type="text" name="mname" class="w-full border px-3 py-2 rounded">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Last Name</label>
                        <input type="text" name="lname" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Email</label>
                        <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Phone</label>
                        <input type="text" name="contact" maxlength="10" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Address</label>
                        <input type="text" name="address" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Guardian Name</label>
                        <input type="text" name="guardian_name" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Guardian Phone</label>
                        <input type="text" name="guardian_phone" maxlength="10" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Academic Year</label>
                        <input type="text" name="academic_year" placeholder="2024-25" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Semester</label>
                        <input type="number" name="semester" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Course</label>
                        <input type="text" name="course" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Password</label>
                        <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Confirm Password</label>
                        <input type="password" name="cpassword" class="w-full border px-3 py-2 rounded" required>
                    </div>
                </div>

                <div class="mt-6 flex justify-center space-x-4">
                    <button type="submit" name="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Register</button>
                    <button type="reset" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">Reset</button>
                </div>
            </form>
        </main>
    </div>

    <?php include("../layout/footer.php"); ?>
</body>

</html>