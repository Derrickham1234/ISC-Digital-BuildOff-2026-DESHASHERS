<?php

session_start();

require_once "config/db.php";

$message = "";

// Check whether the registration was successful
if (isset($_GET['registered'])) {
    $message = "Registration successful! You can now log in.";
}

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {

        $message = "Please enter your email and password.";

    } else {

        // Find user by email
        $sql = "SELECT * FROM users WHERE email = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 1) {

            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {

                // Create secure session
                session_regenerate_id(true);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                // Redirect according to user role
                if ($user['role'] == 'admin') {

                    header("Location: admin/dashboard.php");
                    exit;

                } else {

                    header("Location: student/dashboard.php");
                    exit;

                }

            } else {

                $message = "Incorrect email or password.";

            }

        } else {

            $message = "Incorrect email or password.";

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

    <title>Login | UEAB Smart Noticeboard</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="container">

        <h1>UEAB SMART NOTICEBOARD</h1>

        <p>Your university announcements, all in one place.</p>

        <div class="form-container">

            <h2>Login to Your Account</h2>

            <?php if (!empty($message)): ?>

                <p>
                    <?php echo htmlspecialchars($message); ?>
                </p>

            <?php endif; ?>

            <form method="POST" action="login.php">

                <label>Email Address</label>

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
                    placeholder="Enter your password"
                    required
                >

                <div class="buttons">

                    <button type="submit">
                        Login
                    </button>

                </div>

            </form>

            <p>
                Don't have an account?
                <a href="register.php">Register Here</a>
            </p>

        </div>

    </div>
<script src="js/script.js"></script>
</body>

</html>