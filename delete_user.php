<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "<script>alert('No user ID provided.'); window.location.href='admin.php';</script>";
    exit();
}

$id = $_GET['id'];

if ($_SESSION['id'] == $id) {
    echo "<script>alert('You cannot delete your own account.'); window.location.href='admin.php';</script>";
    exit();
}

$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
if ($stmt->execute([$id])) {
    echo "<script>alert('User deleted successfully.'); window.location.href='admin.php';</script>";
} else {
    echo "<script>alert('Failed to delete user.'); window.location.href='admin.php';</script>";
}
?>