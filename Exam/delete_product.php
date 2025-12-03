<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db_name = "exam_db";

// Connect to database
$db = new mysqli($host, $user, $pass, $db_name);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$id = $_GET['id'] ?? null;
if ($id === null) {
    die("No product ID provided.");
}
// Prepare and execute delete statement
$stmt = $db->prepare("DELETE FROM manufacfacture WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $_SESSION['success_message'] = "Manufacturer deleted successfully!";
    header("Location: Manufacture_Product.php");
    exit();
} else {
    $_SESSION['success_message'] = "Manufacturer deleted successfully!";
}
