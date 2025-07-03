<?php
$host = "localhost";
$dbname = "mess_management_db";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // you can uncomment to test
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
