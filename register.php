<?php

require_once "config/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect registration details
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate required fields
    if (
        empty($full_name) ||
        empty($email) ||
        empty($password) ||
        empty($confirm_password)
    ) {

        $message = "All fields are required.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message = "Please enter a valid email address.";

    } elseif (strlen($password) < 8) {

        $message = "Password must contain at least 8 characters.";

    } elseif ($password !== $confirm_password) {

        $message = "Passwords do not match.";

    } else {

        // Check whether email already exists
        $check = $conn->prepare(
            "SELECT id FROM users WHERE email = ?"
        );

        $check->bind_param("s", $email);
        $check->execute();

        $result = $check->get_result();

        if ($result->num_rows > 0) {

            $message = "This email is already registered.";

        } else {

            // Securely hash password
            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            // Register student
            $sql = "INSERT INTO users
                    (full_name, email, password, role)
                    VALUES (?, ?, ?, 'student')";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param(
                "sss",
                $full_name,
                $email,
                $hashed_password
            );

            if ($stmt->execute()) {

                header("Location: login.php?registered=1");
                exit;

            } else {

                $message = "Registration failed. Please try again.";

            }

            $stmt->close();
        }

        $check->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Registration | UEAB Smart Noticeboard</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="container">

        <h1>UEAB SMART NOTICEBOARD</h1>

        <p>Create your student account</p>

        <div class="form-container">

            <h2>Student Registration</h2>

            <?php if (!empty($message)): ?>

                <p style="color:red;">
                    <?php echo htmlspecialchars($message); ?>
                </p>

            <?php endif; ?>

            <form method="POST" action="register.php">

                <label>Full Name</label>

                <input
                    type="text"
                    name="full_name"
                    placeholder="Enter your full name"
                    required
                >

                <label>University Email Address</label>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Create a password"
                    required
                >

                <label>Confirm Password</label>

                <input
                    type="password"
                    name="confirm_password"
                    placeholder="Confirm your password"
                    required
                >

                <div class="buttons">

                    <button type="submit">
                        Create Account
                    </button>

                </div>

            </form>

            <p>
                Already registered?
                <a href="login.php">Login Here</a>
            </p>

        </div>

    </div>
<script src="js/script.js"></script>
</body>

</html>