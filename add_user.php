<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    // Check if username already exists
    $check = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $check->execute([$username]);

    if ($check->rowCount() > 0) {
        echo "<script>alert('Username already exists.'); window.location.href='admin.php';</script>";
        exit();
    }

    // Insert new user
    $stmt = $pdo->prepare("INSERT INTO users (username, password, email, full_name, role) VALUES (?, ?, ?, ?, ?)");
    $success = $stmt->execute([$username, $password, $email, $full_name, $role]);

    if ($success) {
        echo "<script>alert('User added successfully.'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Failed to add user.'); window.location.href='admin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
    <link rel="stylesheet" href="styles/style.css">
    <style>
        body {
            font-family: 'Orbitron', sans-serif;
            background-color: #0f1923;
            color: white;
            padding: 40px;
        }
        .form-container {
            background-color: #1a1f2e;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            box-shadow: 0 0 20px rgba(255, 70, 85, 0.5);
        }
        h2 {
            text-align: center;
            color: #ff4655;
        }
        label {
            display: block;
            margin-top: 15px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            background: #2b2f40;
            color: white;
            border: 1px solid #ff4655;
            border-radius: 5px;
        }
        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #ff4655;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1rem;
            border-radius: 5px;
        }
        button:hover {
            background-color: #e03e4e;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Summon a New User</h2>
        <form method="POST">
            <label>Full Name:
                <input type="text" name="full_name" required>
            </label>
            <label>Username:
                <input type="text" name="username" required>
            </label>
            <label>Password:
                <input type="password" name="password" required>
            </label>
            <label>Email:
                <input type="email" name="email" required>
            </label>
            <label>Role:
                <select name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </label>
            <button type="submit">Add User</button>
        </form>
    </div>
</body>
</html>