<?php
session_start();

// Check if the user is logged in by verifying session data
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If the session does not indicate a valid login, redirect to login page
    header("Location: http://localhost/collegecgu/index.php");
    exit();
}
?>
