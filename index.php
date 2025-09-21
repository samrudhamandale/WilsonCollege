<?php
session_start();
include('includes/dbconn.php');

if (isset($_SESSION['id'])) {
    header("Location: student/dashboard.php");
    exit();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // must match registration hash

    // ✅ Use Student_id (correct column in DB)
    $stmt = $mysqli->prepare("SELECT Student_id FROM student WHERE Email=? AND Password=?");
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $stmt->bind_result($student_id);

    if ($stmt->fetch()) {
        $_SESSION['id'] = $student_id; // store student session ID
        header("Location: student/dashboard.php");
        exit();
    } else {
        echo "<script>alert('Sorry, Invalid Email or Password!');</script>";
    }

    $stmt->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wilson College | Student Login</title>
    <link rel="icon" href="assets/images/img1.jpg" type="image/jpeg" />


    <script src="https://cdn.tailwindcss.com"></script>


    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Rubik', sans-serif;
            background: linear-gradient(to right, #1c1c1c, rgb(79, 61, 221));
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl shadow-xl p-8 fade-in">
        <div class="flex justify-center mb-4">
            <img src="assets/images/img1.jpg" alt="Wilson Logo" class="w-14 h-14">
        </div>
        <h2 class="text-2xl font-semibold text-center text-white mb-6">Student Login</h2>

        <form method="POST" class="space-y-5">
            <div>
                <label class="text-white block mb-1" for="email">Email</label>
                <input id="email" name="email" type="email" required
                    class="w-full px-4 py-2 rounded-md bg-white text-black focus:outline-none focus:ring-2 focus:ring-red-500" />
            </div>

            <div>
                <label class="text-white block mb-1" for="password">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full px-4 py-2 rounded-md bg-white text-black focus:outline-none focus:ring-2 focus:ring-red-500" />
            </div>

            <div>
                <button type="submit" name="login"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                    Login
                </button>
            </div>
        </form>

        <div class="text-center mt-5">
            <a href="warden/login.php" class="text-sm text-blue-300 hover:text-white underline transition">Go to Admin Panel</a>
        </div>
    </div>

</body>

</html>