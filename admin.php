<?php
session_start();
require 'db.php';

// Redirect if not logged in or not admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch all data from DB
$users = $pdo->query("SELECT id, username, email, role FROM users ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
$memberships = $pdo->query("SELECT * FROM memberships ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
$payments = $pdo->query("SELECT * FROM payments ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
$products = $pdo->query("SELECT * FROM products ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard - Mobile Legends Club</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/style.css">
</head>
<body class="dashboard">

<header class="navbar">
  <div class="nav-left">
    <div class="logo">
      <img src="pictures/logo.png" alt="MLBB Logo">
    </div>
    <nav class="nav-links">
      <a href="index.php">Home</a>
      <a href="admin.php">Dashboard</a>
      <a href="logout.php">Logout</a>
    </nav>
  </div>
  <div class="admin-text">
    <span>Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
  </div>
</header>

<div class="dashboard-grid">
  <!-- Manage Warriors -->
  <div class="dashboard-section">
    <h3>Manage Warriors</h3>
    <table id="users-table">
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>User Type</th>
        <th>Actions</th>
      </tr>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= htmlspecialchars($user['id']) ?></td>
          <td><?= htmlspecialchars($user['username']) ?></td>
          <td><?= htmlspecialchars($user['email']) ?></td>
          <td><?= htmlspecialchars($user['role']) ?></td>
          <td class="actions">
  <a href="edit_user.php?id=<?= $user['id'] ?>">Edit</a>
  <a href="delete_user.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
</td>
        </tr>
      <?php endforeach; ?>
    </table>
    <form action="add_user.php" method="get" style="display:inline;">
  <button type="submit" class="join-btn">Summon Users</button>
</form>
  </div>

  <!-- Manage Clans -->
  <div class="dashboard-section">
    <h3>Manage Clans</h3>
    <table id="memberships-table">
      <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Type</th>
        <th>Status</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Actions</th>
      </tr>
      <?php foreach ($memberships as $m): ?>
        <tr>
          <td><?= $m['id'] ?></td>
          <td><?= $m['user_id'] ?></td>
          <td><?= $m['type'] ?></td>
          <td><?= $m['status'] ?></td>
          <td><?= $m['start_date'] ?></td>
          <td><?= $m['end_date'] ?></td>
          <td><button>Edit</button></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <button class="join-btn">Load Clans</button>
  </div>

  <!-- Manage Treasures -->
  <div class="dashboard-section">
    <h3>Manage Treasures</h3>
    <table id="payments-table">
      <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Membership ID</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
      <?php foreach ($payments as $p): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= $p['user_id'] ?></td>
          <td><?= $p['membership_id'] ?></td>
          <td><?= $p['amount'] ?></td>
          <td><?= $p['status'] ?></td>
          <td><?= $p['date'] ?></td>
          <td><button>Edit</button></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <button class="join-btn">Collect Treasures</button>
  </div>

  <!-- Manage Gear -->
  <div class="dashboard-section">
    <table id="products-table">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Actions</th>
      </tr>
      <?php foreach ($products as $product): ?>
        <tr>
          <td><?= $product['id'] ?></td>
          <td><?= $product['name'] ?></td>
          <td><?= $product['description'] ?></td>
          <td><?= $product['price'] ?></td>
          <td><?= $product['stock'] ?></td>
          <td><button>Edit</button></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <button class="join-btn">Display Gear</button>
  </div>    

</body>
</html>