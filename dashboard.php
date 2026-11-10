<?php
session_start();

require_once "../config/db.php";

// Ensure the user is logged in as an administrator
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login.php");
    exit;
}

// Get dashboard statistics
$total_users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()["total"];

$total_notices = $conn->query("SELECT COUNT(*) AS total FROM notices")->fetch_assoc()["total"];

$published_notices = $conn->query("SELECT COUNT(*) AS total FROM notices WHERE status = 'published'")->fetch_assoc()["total"];

$draft_notices = $conn->query("SELECT COUNT(*) AS total FROM notices WHERE status = 'draft'")->fetch_assoc()["total"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administrator Dashboard | UEAB Smart Noticeboard</title>

    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div class="container">

        <h1>UEAB SMART NOTICEBOARD</h1>

        <h2>Administrator Dashboard</h2>

        <p>
            Welcome, 
            <?php echo htmlspecialchars($_SESSION["full_name"]); ?>!
        </p>

        <hr>

        <h3>System Overview</h3>

        <div class="dashboard-cards">

            <div class="card">
                <h3>Total Users</h3>
                <h2><?php echo $total_users; ?></h2>
            </div>

            <div class="card">
                <h3>Total Notices</h3>
                <h2><?php echo $total_notices; ?></h2>
            </div>

            <div class="card">
                <h3>Published Notices</h3>
                <h2><?php echo $published_notices; ?></h2>
            </div>

            <div class="card">
                <h3>Draft Notices</h3>
                <h2><?php echo $draft_notices; ?></h2>
            </div>

        </div>

        <hr>

        <h3>Notice Management</h3>

        <p>
            <a href="add_notice.php">Add New Notice</a>
        </p>

        <p>
            <a href="manage_notices.php">Manage Notices</a>
        </p>

        <hr>

        <h3>System Navigation</h3>

        <p>
            <a href="../student/dashboard.php">Student Dashboard</a>
        </p>

        <p>
            <a href="../logout.php">Logout</a>
        </p>

    </div>
<script src="../js/script.js"></script>
</body>
</html>