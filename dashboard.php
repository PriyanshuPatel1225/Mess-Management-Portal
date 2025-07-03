<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <style>
    /* Reset and base styles */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body, html {
      height: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea, #764ba2);
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .dashboard-card {
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border-radius: 25px;
      padding: 60px 40px;
      width: 100%;
      max-width: 1200px;
      min-height: 90vh;
      color: #fff;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.98);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .dashboard-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .dashboard-header h1 {
      font-size: 3rem;
      text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
      margin-bottom: 10px;
    }

    .dashboard-header p {
      font-size: 1.2rem;
      font-weight: 500;
      text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
    }

    .btn-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 25px;
      flex-grow: 1;
      padding: 20px 0;
    }

    .btn-gradient {
      padding: 18px 22px;
      border-radius: 16px;
      font-size: 1.1rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      border: none;
      cursor: pointer;
      color: white;
      gap: 12px;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .btn-gradient i {
      font-size: 1.3rem;
    }

    .btn-menu {
      background: linear-gradient(135deg, #f7971e, #ffd200);
      color: #222;
    }
    .btn-menu:hover {
      background: linear-gradient(135deg, #ffd200, #f7971e);
      box-shadow: 0 8px 30px #ffd200;
      transform: scale(1.05);
    }

    .btn-attendance {
      background: linear-gradient(135deg, #43cea2, #185a9d);
    }
    .btn-attendance:hover {
      background: linear-gradient(135deg, #185a9d, #43cea2);
      box-shadow: 0 8px 30px #43cea2;
      transform: scale(1.05);
    }

    .btn-bill {
      background: linear-gradient(135deg, #ff5f6d, #ffc371);
      color: #222;
    }
    .btn-bill:hover {
      background: linear-gradient(135deg, #ffc371, #ff5f6d);
      box-shadow: 0 8px 30px #ffc371;
      transform: scale(1.05);
    }

    .btn-feedback {
      background: linear-gradient(135deg, #667eea, #764ba2);
    }
    .btn-feedback:hover {
      background: linear-gradient(135deg, #764ba2, #667eea);
      box-shadow: 0 8px 30px #764ba2;
      transform: scale(1.05);
    }

    .btn-logout {
      background: #e63946;
      color: white;
      font-weight: 700;
    }
    .btn-logout:hover {
      background: #b71c1c;
      box-shadow: 0 8px 30px #b71c1c;
      transform: scale(1.05);
    }

    @media (max-width: 768px) {
      .dashboard-card {
        padding: 40px 25px;
      }
      .dashboard-header h1 {
        font-size: 2.2rem;
      }
      .btn-gradient {
        font-size: 1rem;
        padding: 14px 16px;
      }
    }

    @media (max-width: 480px) {
      .dashboard-header h1 {
        font-size: 1.8rem;
      }
      .dashboard-header p {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="dashboard-card">
    <div class="dashboard-header">
      <h1>Welcome to Admin Dashboard</h1>
      <p>You are logged in as <strong><?php echo htmlspecialchars($_SESSION["admin"]); ?></strong></p>
    </div>

    <div class="btn-grid">
      <a href="manage_menu.php" class="btn-gradient btn-menu"><i class="fas fa-utensils"></i> Manage Weekly Menu</a>
      <a href="attendance_report.php" class="btn-gradient btn-attendance"><i class="fas fa-calendar-check"></i> View Attendance Report</a>
      <a href="add_bill.php" class="btn-gradient btn-bill"><i class="fas fa-file-invoice-dollar"></i> Add Bill</a>
      <a href="view_feedback.php" class="btn-gradient btn-feedback"><i class="fas fa-comments"></i> View Feedback</a>
      <a href="logout.php" class="btn-gradient btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>
</body>
</html>
