<?php
function check_login() {
    // session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: ../index.php");
        exit();
    }
}
?>