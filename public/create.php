<?php
require_once '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("INSERT INTO items (name, description, price) VALUES (?, ?, ?)");
    $stmt->execute([$name, $description, $price]);

    header('Location: index.php');
    exit();
}
?>
