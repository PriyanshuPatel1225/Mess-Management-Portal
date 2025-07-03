<?php
session_start();
if (!isset($_SESSION["student"])) {
    header("Location: student_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Dashboard</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <style>
    body {
      margin: 0;
      background-color: #000;
      color: #fff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .dashboard-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 50px 40px;
      text-align: center;
    }
    h2 {
      margin-bottom: 8px;
      font-size: 30px;
    }
    p {
      margin-bottom: 30px;
      font-size: 18px;
      color: #ddd;
    }
    .grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 28px;
    }
    .card-option {
      flex: 1 1 220px;
      max-width: 250px;
      padding: 30px 20px;
      border-radius: 15px;
      color: #fff;
      text-decoration: none;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-option:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.5);
    }
    .card-option i {
      font-size: 40px;
      margin-bottom: 25px;
    }
    .card-title {
      font-size: 18px;
      font-weight: bold;
    }
    .menu-card { background: linear-gradient(135deg, #4facfe, #00f2fe); }
    .feedback-card { background: linear-gradient(135deg, #43e97b, #38f9d7); }
    .attendance-card { background: linear-gradient(135deg, #f093fb, #f5576c); }
    .bills-card { background: linear-gradient(135deg, #f6d365, #fda085); }
    .logout-card { background: linear-gradient(135deg, #ff758c, #ff7eb3); }
    @media (max-width: 600px) {
      .card-option {
        flex: 1 1 100%;
      }
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <h2>🎓 Welcome, <?php echo htmlspecialchars($_SESSION["student"]); ?></h2>
    <p>Roll Number: <?php echo htmlspecialchars($_SESSION["student_rollno"]); ?></p>
    <div class="grid">
      <a href="menu.php" class="card-option menu-card">
        <i class="fas fa-utensils"></i>
        <div class="card-title">Weekly Menu</div>
      </a>
      <a href="feedback.php" class="card-option feedback-card">
        <i class="fas fa-comment-dots"></i>
        <div class="card-title">Submit Feedback</div>
      </a>
      <a href="mark_meal.php" class="card-option attendance-card">
        <i class="fas fa-check-circle"></i>
        <div class="card-title">Meal Attendance</div>
      </a>
      <a href="student_bills.php" class="card-option bills-card">
        <i class="fas fa-file-invoice-dollar"></i>
        <div class="card-title">My Bills</div>
      </a>
      <a href="student_logout.php" class="card-option logout-card">
        <i class="fas fa-sign-out-alt"></i>
        <div class="card-title">Logout</div>
      </a>
    </div>
  </div>
</body>
</html>
