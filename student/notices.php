<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

// Fetch all notices
$notices = $mysqli->query("SELECT * FROM notice ORDER BY Post_date DESC");
$hasNotices = $notices->num_rows > 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Notices | Willson College</title>
  

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    

<script src="https://cdn.tailwindcss.com"></script>
<style>
    .bg-overlay {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
            url('../assets/images/img3.jpg') no-repeat center center;
        background-size: cover;
        background-attachment: fixed;
    }

    .notice-card {
        background: linear-gradient(to right, #2563eb, #1e40af);
        color: white;
    }
</style>
</head>

<body class="bg-overlay text-white min-h-screen flex flex-col">

    <?php include("header.php"); ?>

    <div class="flex-1 flex flex-col lg:flex-row p-6 backdrop-blur-sm bg-white/10 rounded-lg m-6 shadow-xl min-h-screen">
        <?php include("sidebar.php"); ?>

        <main class="flex-1 space-y-6">
            <h2 class="text-2xl font-bold mb-6">Notices</h2>

            <?php if ($hasNotices) { ?>
                <!-- Swiper Container -->
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php while ($row = $notices->fetch_assoc()) { ?>
                            <div class="swiper-slide">
                                <div class="notice-card p-6 rounded-lg shadow-lg text-center">
                                    <h3 class="text-xl font-bold mb-2"><?php echo $row['Title']; ?></h3>
                                    <p class="text-sm mb-2"><?php echo $row['Content']; ?></p>
                                    <p class="text-xs">📅 Posted: <?php echo $row['Post_date']; ?> | ⏳ Expires: <?php echo $row['Expiry_date']; ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- Navigation -->
                    <div class="swiper-pagination mt-4"></div>
                    <div class="swiper-button-next text-blue-700"></div>
                    <div class="swiper-button-prev text-blue-700"></div>
                </div>
            <?php } else { ?>
                <!-- Default Notices -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="notice-card p-6 rounded-lg shadow-lg">
                        <h3 class="text-lg font-bold mb-2">Discipline Reminder</h3>
                        <p class="text-sm">Maintain discipline in classrooms and hostel premises. Respect teachers, staff, and fellow students.</p>
                    </div>
                    <div class="notice-card p-6 rounded-lg shadow-lg">
                        <h3 class="text-lg font-bold mb-2">Motivational Quote</h3>
                        <p class="text-sm italic">“Success is the sum of small efforts, repeated day in and day out.”</p>
                    </div>
                    <div class="notice-card p-6 rounded-lg shadow-lg">
                        <h3 class="text-lg font-bold mb-2">Campus Safety</h3>
                        <p class="text-sm">Follow safety guidelines, carry your ID card at all times, and report suspicious activities.</p>
                    </div>
                </div>
            <?php } ?>
        </main>
    </div>
    <?php include("footer.php"); ?>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 5000
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
        });
    </script>
</body>

</html>