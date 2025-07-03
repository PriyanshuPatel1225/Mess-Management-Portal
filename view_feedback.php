<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

require_once "db.php";

$stmt = $conn->query("SELECT * FROM feedback ORDER BY date DESC");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>View Feedback</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: Arial, sans-serif;
      background-color: #000;
      color: #fff;
      padding: 20px;
    }
    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #0d6efd;
    }
    .btn {
      display: inline-block;
      padding: 10px 20px;
      background: #333;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      margin-bottom: 20px;
      transition: background 0.3s ease;
    }
    .btn:hover {
      background: #555;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #111;
      border-radius: 10px;
      overflow: hidden;
    }
    th, td {
      padding: 12px 15px;
      border: 1px solid #333;
      text-align: center;
    }
    th {
      background-color: #222;
      color: #fff;
    }
    tr:nth-child(even) {
      background-color: #222;
    }
    tr:hover {
      background-color: #333;
    }
    @media (max-width: 600px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead {
        display: none;
      }
      tr {
        margin-bottom: 15px;
      }
      td {
        background: #111;
        text-align: right;
        padding-left: 50%;
        position: relative;
      }
      td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        width: 45%;
        padding-left: 5px;
        font-weight: bold;
        color: #0d6efd;
        text-align: left;
      }
    }
  </style>
</head>
<body>
  <h1>Student Feedback</h1>
  <a href="dashboard.php" class="btn">Back to Dashboard</a>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Message</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $row) { ?>
        <tr>
          <td data-label="Name"><?= htmlspecialchars($row["name"]) ?></td>
          <td data-label="Message"><?= htmlspecialchars($row["message"]) ?></td>
          <td data-label="Date"><?= $row["date"] ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>
