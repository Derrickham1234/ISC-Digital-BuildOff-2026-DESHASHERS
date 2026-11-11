<?php
session_start();

require_once "db.php";

// Administrators only
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit;
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("Invalid notice ID.");
}

// Retrieve the notice
$stmt = $conn->prepare("SELECT title FROM notices WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$notice = $result->fetch_assoc();
$stmt->close();

if (!$notice) {
    die("Notice not found.");
}

// Delete only after administrator confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $delete = $conn->prepare("DELETE FROM notices WHERE id = ?");
    $delete->bind_param("i", $id);

    if ($delete->execute()) {
        $delete->close();

        header("Location: manage_notices.php?deleted=1");
        exit;
    }

    $delete->close();

    $message = "Unable to delete notice.";

} else {

    $message = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Delete Notice | UEAB Smart Noticeboard</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>UEAB SMART NOTICEBOARD</h1>

    <h2>Delete University Notice</h2>

    <p>
        Are you sure you want to delete this notice?
    </p>

    <h3>
        <?php echo htmlspecialchars($notice["title"]); ?>
    </h3>

    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST">

        <button type="submit">
            Yes, Delete Notice
        </button>

        <a href="manage_notices.php">
            Cancel
        </a>

    </form>

</div>
<script src="script.js"></script>
</body>
</html>