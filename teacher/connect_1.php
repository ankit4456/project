<?php
try {
    $con = new PDO("mysql:host=localhost;port=3307;dbname=attendance;charset=utf8", 'root', '');
    // Set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
