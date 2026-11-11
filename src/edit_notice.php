<?php
session_start();

require_once "db.php";

// Administrators only
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit;
}

$message = "";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("Invalid notice ID.");
}

// Fetch the existing notice
$stmt = $conn->prepare("SELECT * FROM notices WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$notice = $result->fetch_assoc();
$stmt->close();

if (!$notice) {
    die("Notice not found.");
}

// Fetch categories
$categories = $conn->query("SELECT * FROM categories ORDER BY category_name");

// Update notice
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

        $sql = "UPDATE notices
                SET title = ?, content = ?, category_id = ?, status = ?
                WHERE id = ?";

        $update = $conn->prepare($sql);

        $update->bind_param(
            "ssisi",
            $title,
            $content,
            $category_id,
            $status,
            $id
        );

        if ($update->execute()) {

            header("Location: manage_notices.php?updated=1");
            exit;

        } else {

            $message = "Unable to update notice.";

        }

        $update->close();
    }

    // Keep submitted values visible if validation fails
    $notice["title"] = $title;
    $notice["content"] = $content;
    $notice["category_id"] = $category_id;
    $notice["status"] = $status;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Notice | UEAB Smart Noticeboard</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>UEAB SMART NOTICEBOARD</h1>

    <h2>Edit University Notice</h2>

    <p><?php echo htmlspecialchars($message); ?></p>

    <form method="POST">

        <label>Notice Title</label>

        <input
            type="text"
            name="title"
            maxlength="200"
            value="<?php echo htmlspecialchars($notice["title"]); ?>"
            required
        >

        <br><br>

        <label>Notice Content</label>

        <textarea name="content" rows="7" required><?php
            echo htmlspecialchars($notice["content"]);
        ?></textarea>

        <br><br>

        <label>Category</label>

        <select name="category_id" required>

            <?php while ($category = $categories->fetch_assoc()): ?>

                <option
                    value="<?php echo $category["id"]; ?>"
                    <?php
                    if ($notice["category_id"] == $category["id"]) {
                        echo "selected";
                    }
                    ?>
                >
                    <?php echo htmlspecialchars($category["category_name"]); ?>
                </option>

            <?php endwhile; ?>

        </select>

        <br><br>

        <label>Status</label>

        <select name="status" required>

            <option value="published"
                <?php echo $notice["status"] == "published" ? "selected" : ""; ?>>
                Published
            </option>

            <option value="draft"
                <?php echo $notice["status"] == "draft" ? "selected" : ""; ?>>
                Draft
            </option>

        </select>

        <br><br>

        <button type="submit">Update Notice</button>

    </form>

    <br>

    <a href="manage_notices.php">Back to Notice Management</a>

</div>
<script src="script.js"></script>
</body>
</html>