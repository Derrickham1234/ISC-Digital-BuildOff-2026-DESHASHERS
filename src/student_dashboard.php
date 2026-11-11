<?php
session_start();

require_once "db.php";

// Any logged-in user may open this page
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$search = trim($_GET["q"] ?? "");
$notices = [];
$error = "";

try {
    if ($search !== "") {
        // Search published notices by title or content
        $like = "%" . $search . "%";
        $stmt = $conn->prepare(
            "SELECT * FROM notices
             WHERE status = 'published' AND (title LIKE ? OR content LIKE ?)
             ORDER BY id DESC"
        );
        $stmt->bind_param("ss", $like, $like);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        // Show all published notices, newest first
        $result = $conn->query(
            "SELECT * FROM notices WHERE status = 'published' ORDER BY id DESC"
        );
    }

    while ($row = $result->fetch_assoc()) {
        $notices[] = $row;
    }
} catch (Throwable $e) {
    $error = "Sorry, the notices could not be loaded right now.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Dashboard | UEAB Smart Noticeboard</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">

        <h1>UEAB SMART NOTICEBOARD</h1>

        <h2>Student Dashboard</h2>

        <p>
            Welcome,
            <?php echo htmlspecialchars($_SESSION["full_name"]); ?>!
        </p>

        <hr>

        <h3>Search Notices</h3>

        <form method="GET" action="student_dashboard.php">
            <input
                type="text"
                name="q"
                placeholder="Search by title or content"
                value="<?php echo htmlspecialchars($search); ?>"
            >
            <div class="buttons">
                <button type="submit">Search</button>
            </div>
        </form>

        <?php if ($search !== ""): ?>
            <p>
                Results for "<?php echo htmlspecialchars($search); ?>".
                <a href="student_dashboard.php">Show all notices</a>
            </p>
        <?php endif; ?>

        <hr>

        <h3>Latest Notices</h3>

        <?php if ($error !== ""): ?>

            <p><?php echo htmlspecialchars($error); ?></p>

        <?php elseif (count($notices) === 0): ?>

            <p>No notices found.</p>

        <?php else: ?>

            <?php foreach ($notices as $notice): ?>

                <div class="card">

                    <h3>
                        <a href="view_notice.php?id=<?php echo (int)$notice["id"]; ?>">
                            <?php echo htmlspecialchars($notice["title"] ?? "Untitled notice"); ?>
                        </a>
                    </h3>

                    <?php if (!empty($notice["created_at"])): ?>
                        <p><small>Posted: <?php echo htmlspecialchars(substr($notice["created_at"], 0, 10)); ?></small></p>
                    <?php endif; ?>

                    <p>
                        <?php
                        $text = $notice["content"] ?? "";
                        echo htmlspecialchars(strlen($text) > 150 ? substr($text, 0, 150) . "..." : $text);
                        ?>
                    </p>

                    <p>
                        <a href="view_notice.php?id=<?php echo (int)$notice["id"]; ?>">Read more</a>
                    </p>

                </div>

            <?php endforeach; ?>

        <?php endif; ?>

        <hr>

        <p>
            <a href="logout.php">Logout</a>
        </p>

    </div>

    <script src="script.js"></script>
</body>

</html>
