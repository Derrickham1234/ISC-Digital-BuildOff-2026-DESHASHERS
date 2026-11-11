<?php
session_start();

require_once "db.php";

// Protect this page: administrators only
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit;
}

$message = "";

// Get notice categories
$categories = $conn->query("SELECT * FROM categories ORDER BY category_name");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = trim($_POST["title"]);
    $content = trim($_POST["content"]);
    $category_id = intval($_POST["category_id"]);
    $status = $_POST["status"];

    if (empty($title) || empty($content) || $category_id <= 0) {

        $message = "Please complete all required fields.";

    } elseif (!in_array($status, ["draft", "published"], true)) {

        $message = "Invalid notice status.";

    } else {

        $sql = "INSERT INTO notices
                (title, content, category_id, created_by, status)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ssiis",
            $title,
            $content,
            $category_id,
            $_SESSION["user_id"],
            $status
        );

        if ($stmt->execute()) {
            $message = "Notice created successfully!";
        } else {
            $message = "Unable to create notice.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Notice | UEAB Smart Noticeboard</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>UEAB SMART NOTICEBOARD</h1>

    <h2>Publish a University Notice</h2>

    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST" action="add_notice.php">

        <label>Notice Title</label>
        <input
            type="text"
            name="title"
            maxlength="200"
            required
        >

        <br><br>

        <label>Notice Content</label>
        <textarea
            name="content"
            rows="7"
            required
        ></textarea>

        <br><br>

        <label>Notice Category</label>

        <select name="category_id" required>

            <option value="">Select Category</option>

            <?php while ($category = $categories->fetch_assoc()): ?>

                <option value="<?php echo $category["id"]; ?>">
                    <?php echo htmlspecialchars($category["category_name"]); ?>
                </option>

            <?php endwhile; ?>

        </select>

        <br><br>

        <label>Notice Status</label>

        <select name="status" required>

            <option value="published">Publish Immediately</option>

            <option value="draft">Save as Draft</option>

        </select>

        <br><br>

        <button type="submit">Save Notice</button>

    </form>

    <br>

    <a href="dashboard.php">Back to Dashboard</a>

</div>
<script src="script.js"></script>
</body>
</html>
