<?php

session_start();

// Check whether a user is logged in
if (isset($_SESSION["user_id"])) {

    // Redirect administrator
    if ($_SESSION["role"] === "admin") {

        header("Location: admin/dashboard.php");
        exit;

    }

    // Redirect student
    if ($_SESSION["role"] === "student") {

        header("Location: student/dashboard.php");
        exit;

    }

}

// Redirect visitors to login
header("Location: login.php");
exit;

?>