<?php
session_start();
require 'db.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $agree = isset($_POST["agree"]);

    if (!$agree) {
        $error = "You must agree to the terms and conditions.";
    } elseif (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        try {
            // Check if user or email already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            if ($stmt->fetch()) {
                $error = "Username or email already exists.";
            } else {
                $stmt = $pdo->prepare("INSERT INTO users (username, full_name, email, password, role) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$username, $full_name, $email, $password, 'user']);

                $success = "Registration successful. You can now <a href='login.php'>login</a>.";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <style>
    body {
      background-color: #0f1923;
      font-family: 'Orbitron', sans-serif;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .register-box {
      background-color: #1a1f2e;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 10px #ff4655;
      width: 350px;
      text-align: center;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
      display: block;
      width: 100%;
      margin: 1rem 0;
      padding: 0.5rem;
      font-size: 1rem;
      box-sizing: border-box;
    }
    .checkbox {
      text-align: left;
      font-size: 0.85rem;
      margin: 0.5rem 0 1rem;
    }
    .checkbox input {
      margin-right: 0.5rem;
    }
    button {
      padding: 0.6rem 1.5rem;
      font-size: 1rem;
      background-color: #ff4655;
      color: white;
      border: none;
      cursor: pointer;
      width: 100%;
    }
    .message {
      margin: 1rem 0;
      font-size: 0.9rem;
    }
    .error {
      color: #ff4c4c;
    }
    .success {
      color: #4caf50;
    }
    .login-link {
      margin-top: 1rem;
      font-size: 0.9rem;
    }
    .login-link a {
      color: #ff4655;
      text-decoration: none;
    }
    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="register-box">
    <h2>Create Account</h2>

    <?php if ($error): ?>
      <p class="message error"><?= htmlspecialchars($error) ?></p>
    <?php elseif ($success): ?>
      <p class="message success"><?= $success ?></p>
    <?php endif; ?>

    <form method="POST">
      <input type="text" name="full_name" placeholder="Full Name" required/>
      <input type="text" name="username" placeholder="Username" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />

      <div class="checkbox">
        <label>
          <input type="checkbox" name="agree" required />
          I agree to the <a href="#">terms and conditions</a>
        </label>
      </div>

      <button type="submit">Register</button>
    </form>

    <div class="login-link">
      <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
  </div>
</body>
</html>