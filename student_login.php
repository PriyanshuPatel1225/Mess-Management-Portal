<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rollno = $_POST["rollno"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM student WHERE rollno = ?");
    $stmt->execute([$rollno]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($student && password_verify($password, $student["password"])) {
        $_SESSION["student"] = $student["name"];
        $_SESSION["student_rollno"] = $student["rollno"];
        header("Location: student_dashboard.php");
        exit;
    } else {
        $error = "Invalid roll number or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Student Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body, html {
      height: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('canteen.jpg') no-repeat center center fixed;
      background-size: cover;
      position: relative;
      color: #fff;
    }
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.6);
      z-index: 0;
    }
    .login-container {
      position: relative;
      z-index: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      padding: 20px;
    }
    .login-card {
      background: #fff;
      color: #000;
      padding: 30px;
      border-radius: 15px;
      max-width: 400px;
      width: 100%;
      box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .login-card h2 {
      color: #111;
      margin-bottom: 20px;
      font-size: 24px;
    }
    form {
      display: flex;
      flex-direction: column;
    }
    label {
      margin-bottom: 5px;
      font-weight: 600;
      display: flex;
      align-items: center;
      color: #111;
    }
    label i {
      margin-right: 8px;
      color: #0d6efd;
    }
    input[type="text"],
    input[type="password"] {
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      width: 100%;
    }
    .btn-primary, .btn-secondary {
      padding: 12px;
      margin-top: 10px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      text-decoration: none;
      text-align: center;
      display: block;
      transition: background 0.3s ease;
    }
    .btn-primary {
      background: #0d6efd;
      color: #fff;
    }
    .btn-primary:hover {
      background: #084cdf;
    }
    .btn-secondary {
      background: #6c757d;
      color: #fff;
    }
    .btn-secondary:hover {
      background: #555;
    }
    .alert {
      background: #f44336;
      color: #fff;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 15px;
      text-align: center;
    }
    @media (max-width: 480px) {
      .login-card {
        padding: 20px;
      }
      .login-card h2 {
        font-size: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <h2><i class="fas fa-user-graduate"></i> Student Login</h2>
      <?php if (!empty($error)) { ?>
        <div class="alert"><?php echo htmlspecialchars($error); ?></div>
      <?php } ?>
      <form method="post" novalidate>
        <label><i class="fas fa-id-card"></i> Roll Number</label>
        <input type="text" name="rollno" required />
        <label><i class="fas fa-lock"></i> Password</label>
        <input type="password" name="password" required />
        <button type="submit" class="btn-primary">Login</button>
        <a href="index.php" class="btn-secondary">Back to Home</a>
      </form>
    </div>
  </div>
</body>
</html>
