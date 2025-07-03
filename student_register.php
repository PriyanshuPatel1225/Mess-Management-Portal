<?php 
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $rollno = $_POST["rollno"];
    $password = $_POST["password"];
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO student (name, rollno, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $rollno, $hashed]);
        $success = "Student registered successfully.";
    } catch(PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Student Registration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    * { margin:0; padding:0; box-sizing:border-box; }
    html, body {
      height: 100%;
      font-family: Arial, sans-serif;
      background: url('canteen.jpg') no-repeat center center fixed;
      background-size: cover;
      position: relative;
      color: #fff;
    }
    body::before {
      content:"";
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.55);
      z-index: 0;
    }
    .container {
      position: relative;
      z-index: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
      padding: 20px;
    }
    .card {
      background: rgba(255,255,255,0.95);
      color: #000;
      padding: 30px;
      border-radius: 15px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.4);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #0d6efd;
      font-weight: 600;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    label {
      font-weight: 600;
      margin-bottom: 5px;
      color: #0d6efd;
    }
    input[type="text"], input[type="password"] {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      width: 100%;
    }
    .btn {
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease;
      text-align: center;
      display: inline-block;
      margin-top: 5px;
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
      text-decoration: none;
      display: block;
    }
    .btn-secondary:hover {
      background: #555;
    }
    .alert {
      background: #f44336;
      color: #fff;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 10px;
      text-align: center;
    }
    .success {
      background: #28a745;
      color: #fff;
    }
    @media (max-width:480px) {
      .card {
        padding: 20px;
      }
      h2 {
        font-size: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <h2><i class="fas fa-user-plus"></i> Student Registration</h2>

      <?php if (!empty($success)) { ?>
        <div class="alert success"><?= htmlspecialchars($success) ?></div>
      <?php } ?>
      <?php if (!empty($error)) { ?>
        <div class="alert"><?= htmlspecialchars($error) ?></div>
      <?php } ?>

      <form method="post" novalidate>
        <div>
          <label for="name"><i class="fas fa-user"></i> Name</label>
          <input type="text" name="name" id="name" required />
        </div>
        <div>
          <label for="rollno"><i class="fas fa-id-card"></i> Roll Number</label>
          <input type="text" name="rollno" id="rollno" required />
        </div>
        <div>
          <label for="password"><i class="fas fa-lock"></i> Password</label>
          <input type="password" name="password" id="password" required />
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <a href="index.php" class="btn btn-secondary">Back to Home</a>
      </form>
    </div>
  </div>
</body>
</html>
