<?php
session_start();
if (!isset($_SESSION["student"])) {
    header("Location: student_login.php");
    exit;
}
require_once "db.php";

if (isset($_GET["id"])) {
    $bill_id = $_GET["id"];
    $stmt = $conn->prepare("UPDATE billing SET status = 'paid' WHERE id = ?");
    $stmt->execute([$bill_id]);
    header("Location: student_bills.php");
    exit;
} else {
    echo "Invalid bill ID.";
}
?>
