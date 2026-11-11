<?php

session_start();

// Remove all session variables
$_SESSION = array();

// Destroy the current session
session_destroy();

// Redirect user to login page
header("Location: login.php");
exit;

?>