<?php

// ======================================
// DATABASE CONNECTION CONFIGURATION
// ======================================

// Database server
$host = "localhost";

// MySQL username
$username = "root";

// MySQL password (default XAMPP password)
$password = "";

// Database name
$database = "ueab_smart_noticeboard";


// ======================================
// ESTABLISH DATABASE CONNECTION
// ======================================

$conn = new mysqli(
    $host,
    $username,
    $password,
    $database
);


// ======================================
// CHECK DATABASE CONNECTION
// ======================================

if ($conn->connect_error) {

    die("Database Connection Failed: " . $conn->connect_error);

}


// Set character encoding
$conn->set_charset("utf8mb4");

?>