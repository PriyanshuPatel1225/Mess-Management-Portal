<?php
session_start();
if (!isset($_SESSION["student"])) {
    header("Location: student_login.php");
    exit;
}
require_once "db.php";

$rollno = $_SESSION["student_rollno"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $meal_type = $_POST["meal_type"];
    $check = $conn->prepare("SELECT * FROM meal_attendance WHERE rollno=? AND meal_type=? AND attendance_date=CURDATE()");
    $check->execute([$rollno, $meal_type]);
    if ($check->rowCount() > 0) {
        $error = "Already marked for this meal today.";
    } else {
        $stmt = $conn->prepare("INSERT INTO meal_attendance (rollno, meal_type) VALUES (?, ?)");
        $stmt->execute([$rollno, $meal_type]);
        $success = "Attendance marked successfully.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Meal Attendance</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background: url('canteen.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: Arial, sans-serif;
      color: #000;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .card {
      background-color: rgba(255,255,255,0.9);
      padding: 30px;
      border-radius: 15px;
      max-width: 420px;
      width: 90%;
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }
    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #0d6efd;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }
    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      background: #fff;
      color: #000;
      font-size: 1rem;
    }
    select:focus {
      outline: 2px solid #0d6efd;
    }
    button,
    .back-button {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s ease;
    }
    button {
      background-color: #0d6efd;
      color: #fff;
    }
    button:hover {
      background-color: #084cdf;
    }
    .back-button {
      background-color: #6c757d;
      color: #fff;
      text-decoration: none;
      text-align: center;
      margin-left: 8px;
    }
    .back-button:hover {
      background-color: #5a6268;
    }
    .alert {
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 8px;
      text-align: center;
      font-weight: bold;
    }
    .alert-success {
      background-color: #d4edda;
      color: #155724;
    }
    .alert-danger {
      background-color: #f8d7da;
      color: #721c24;
    }
    @media(max-width: 500px){
      .card {
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>Mark Meal Attendance</h2>
    <?php if (!empty($success)) { ?>
      <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php } ?>
    <?php if (!empty($error)) { ?>
      <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php } ?>
    <form method="post">
      <label for="meal_type">Select Meal</label>
      <select name="meal_type" id="meal_type" required>
        <option value="">--Select--</option>
        <option value="breakfast">Breakfast</option>
        <option value="lunch">Lunch</option>
        <option value="dinner">Dinner</option>
      </select>
      <button type="submit">Mark Attendance</button>
      <a href="student_dashboard.php" class="back-button">Back to Dashboard</a>
    </form>
  </div>
</body>
</html>
