<?php
session_start();

require_once "db.php";

// Students only
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "student") {
    header("Location: login.php");
    exit;
}

// Validate notice ID
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("Invalid notice ID.");
}

// Retrieve a published notice
$sql = "SELECT notices.*, categories.category_name
        FROM notices
        INNER JOIN categories
        ON notices.category_id = categories.id
        WHERE notices.id = ? AND notices.status = 'published'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$notice = $result->fetch_assoc();

$stmt->close();

if (!$notice) {
    die("Notice not found or is no longer available.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo htmlspecialchars($notice["title"]); ?>
        | UEAB Smart Noticeboard
    </title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>UEAB SMART NOTICEBOARD</h1>

    <h2>University Announcement</h2>

    <hr>

    <div class="notice-card">

        <h2>
            <?php echo htmlspecialchars($notice["title"]); ?>
        </h2>

        <p>
            <strong>Category:</strong>
            <?php echo htmlspecialchars($notice["category_name"]); ?>
        </p>

        <hr>

        <p>
            <?php echo nl2br(htmlspecialchars($notice["content"])); ?>
        </p>

        <hr>

        <p>
            <strong>Date Published:</strong>
            <?php echo htmlspecialchars($notice["created_at"]); ?>
        </p>

    </div>

    <br>

    <a href="dashboard.php">Back to Student Dashboard</a>

    <br><br>

    <a href="logout.php">Logout</a>

</div>
<script src="script.js"></script>
</body>

</html>