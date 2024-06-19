<?php
require_once '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
$stmt->execute([$id]);

header('Location: index.php');
exit();
?>
