<?php
session_start();

require_once "../config/db.php";

// Allow administrators only
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login.php");
    exit;
}

// Retrieve all notices and their categories
$sql = "SELECT notices.*, categories.category_name
        FROM notices
        INNER JOIN categories
        ON notices.category_id = categories.id
        ORDER BY notices.created_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Notices | UEAB Smart Noticeboard</title>

    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="container">

    <h1>UEAB SMART NOTICEBOARD</h1>

    <h2>Manage University Notices</h2>

    <p>
        <a href="dashboard.php">Back to Dashboard</a> |
        <a href="add_notice.php">Add New Notice</a>
    </p>

    <hr>

    <?php if ($result && $result->num_rows > 0): ?>

        <table border="1" cellpadding="10" cellspacing="0">

            <tr>
                <th>ID</th>
                <th>Notice Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>

            <?php while ($notice = $result->fetch_assoc()): ?>

                <tr>

                    <td>
                        <?php echo $notice["id"]; ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($notice["title"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($notice["category_name"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($notice["status"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($notice["created_at"]); ?>
                    </td>

                    <td>
                        <a href="edit_notice.php?id=<?php echo $notice["id"]; ?>">
                            Edit
                        </a>

                        |

                        <a href="delete_notice.php?id=<?php echo $notice["id"]; ?>">
                            Delete
                        </a>
                    </td>

                </tr>

            <?php endwhile; ?>

        </table>

    <?php else: ?>

        <p>No notices have been created yet.</p>

    <?php endif; ?>

</div>
<script src="../js/script.js"></script>
</body>
</html>