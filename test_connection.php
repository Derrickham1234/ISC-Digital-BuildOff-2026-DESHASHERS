<?php

// Import database connection
require_once "db.php";

// Display connection status
if ($conn) {

    echo "<h1>UEAB SMART NOTICEBOARD</h1>";
    echo "<h2>Database Connected Successfully!</h2>";
    echo "<p>Database: ueab_smart_noticeboard</p>";
    echo "<p>System Status: Operational</p>";

}

?>