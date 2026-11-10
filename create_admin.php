<?php

require_once "config/db.php";

$message = "";

// Check whether an administrator already exists
$check = $conn->query(
    "SELECT id FROM users WHERE role = 'admin' LIMIT 1"
);

if ($check->num_rows > 0) {

    die("An administrator account already exists. Setup is disabled.");

}

// Process administrator registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($full_name) || empty($email) || empty($password)) {

        $message = "All fields are required.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message = "Enter a valid email address.";

    } elseif (strlen($password) < 8) {

        $message = "Password must have at least 8 characters.";

    } else {

        // Securely hash the administrator password
        $hashed_password = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        // Create administrator account
        $sql = "INSERT INTO users
                (full_name, email, password, role)
                VALUES (?, ?, ?, 'admin')";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "sss",
            $full_name,
            $email,
            $hashed_password
        );

        if ($stmt->execute()) {

            $message = "Administrator account created successfully!";

        } else {

            $message = "Unable to create administrator account.";

        }

        $stmt->close();

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Create Administrator</title>

</head>

<body>

    <h1>UEAB SMART NOTICEBOARD</h1>

    <h2>Create Administrator Account</h2>

    <p>
        <?php echo htmlspecialchars($message); ?>
    </p>

    <form method="POST">

        <label>Administrator Full Name</label>

        <input type="text" name="full_name" required>

        <br><br>

        <label>Email Address</label>

        <input type="email" name="email" required>

        <br><br>

        <label>Password</label>

        <input type="password" name="password" minlength="8" required>

        <br><br>

        <button type="submit">
            Create Administrator
        </button>

    </form>

</body>

</html>
