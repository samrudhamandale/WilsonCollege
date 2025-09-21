<?php
session_start();
include('../includes/dbconn.php');

if (isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Make sure your DB stores MD5 hashed passwords

    // ✅ Correct table and columns
    $stmt = $mysqli->prepare("SELECT Staff_id FROM staff WHERE (Name=? OR Email=?) AND Password=?");

    if ($stmt) {
        $stmt->bind_param('sss', $username, $username, $password);
        $stmt->execute();
        $stmt->bind_result($Staff_id);

        if ($stmt->fetch()) {
            $_SESSION['id'] = $Staff_id;
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Invalid Username/Email or Password');</script>";
        }

        $stmt->close();
    } else {
        // Debugging help if prepare() fails
        die("Query Error: " . $mysqli->error);
    }
}
?>



<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wilson College | Admin Login</title>
    <link rel="icon" href="../assets/images/img1.jpg" type="image/jpeg">


    <script src="https://cdn.tailwindcss.com"></script>


    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Rubik', sans-serif;
            background: linear-gradient(to right, #1c1c1c, #3d0000);
        }

        .fade-in {
            animation: fadeIn 0.7s ease-out forwards;
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

<body class="min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl shadow-lg p-8 fade-in">
        <div class="flex justify-center mb-4">
            <img src="../assets/images/img1.jpg" alt="Admin Icon" class="w-14 h-14">
        </div>
        <h2 class="text-2xl font-semibold text-center text-white mb-6">Admin Login</h2>

        <form method="POST" class="space-y-5">
            <div>
                <label for="username" class="block text-white mb-1">Email or Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your email or username" required
                    class="w-full px-4 py-2 rounded-md bg-white text-black focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>

            <div>
                <label for="password" class="block text-white mb-1">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required
                    class="w-full px-4 py-2 rounded-md bg-white text-black focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>

            <button type="submit" name="login"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition">
                Login
            </button>
        </form>

        <div class="text-center mt-5">
            <a href="../index.php" class="text-sm text-red-300 hover:text-white underline">← Go Back</a>
        </div>
    </div>

</body>

</html>