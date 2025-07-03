<?php
session_start();
require_once "db.php";

// if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        $_SESSION["admin"] = $row["username"];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('canteen.jpg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .login-container {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 30px;
      border-radius: 15px;
      width: 90%;
      max-width: 400px;
      box-shadow: 0 0 20px rgba(0,0,0,0.4);
    }
    .login-title {
      text-align: center;
      margin-bottom: 20px;
      color: #4e54c8;
      text-shadow: 0 0 5px #0ff;
    }
    .input-group {
      margin-bottom: 15px;
    }
    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #333;
    }
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
      transition: border 0.3s;
    }
    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: #4e54c8;
      outline: none;
    }
    button {
      width: 100%;
      padding: 12px;
      font-size: 1rem;
      background: linear-gradient(135deg, #4e54c8, #8f94fb);
      color: #fff;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }
    button:hover {
      background: linear-gradient(135deg, #3b3fc1, #7a80f0);
    }
    .error-message {
      background: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 15px;
      text-align: center;
    }
    @media (max-width: 576px) {
      .login-container {
        padding: 20px;
      }
      button {
        font-size: 0.95rem;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2 class="login-title">Admin Login</h2>
    <?php if (!empty($error)) { ?>
      <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
    <?php } ?>
    <form method="post">
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required />
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required />
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
