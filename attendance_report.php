<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}
require_once "db.php";

$stmt = $conn->query("SELECT meal_type, attendance_date, COUNT(*) as total FROM meal_attendance GROUP BY meal_type, attendance_date ORDER BY attendance_date DESC");
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Meal Attendance Report</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f0f2f5;
      color: #333;
    }
    .container {
      max-width: 1100px;
      margin: 40px auto;
      padding: 20px;
    }
    h2 {
      text-align: center;
      font-size: 2rem;
      margin-bottom: 20px;
      color: #4d09c3;
      text-shadow:
        0 0 5px #0ff,
        0 0 10px #0ff;
    }
    .back-btn {
      display: inline-block;
      margin-bottom: 20px;
      padding: 10px 20px;
      background: #4e54c8;
      color: #fff;
      text-decoration: none;
      border-radius: 6px;
      transition: background 0.3s;
    }
    .back-btn:hover {
      background: #383ea8;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0,0,0,0.15);
    }
    thead {
      background: linear-gradient(135deg, #4e54c8, #8f94fb);
      color: #fff;
    }
    th, td {
      padding: 16px;
      text-align: left;
    }
    tbody tr {
      border-bottom: 1px solid #ddd;
      transition: background 0.3s;
    }
    tbody tr:hover {
      background: #f2f2f2;
    }
    @media(max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead {
        display: none;
      }
      tr {
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
        background: #fff;
        padding: 12px;
      }
      td {
        padding-left: 50%;
        position: relative;
        text-align: left;
        border-bottom: none;
      }
      td::before {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-weight: bold;
        content: attr(data-label);
        color: #4e54c8;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Meal Attendance Report</h2>
    <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
    <table>
      <thead>
        <tr>
          <th>Date</th>
          <th>Meal</th>
          <th>Total Students Present</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($records as $row) { ?>
          <tr>
            <td data-label="Date"><?php echo htmlspecialchars($row["attendance_date"]); ?></td>
            <td data-label="Meal"><?php echo ucfirst(htmlspecialchars($row["meal_type"])); ?></td>
            <td data-label="Total Students Present"><?php echo $row["total"]; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>
</html>
