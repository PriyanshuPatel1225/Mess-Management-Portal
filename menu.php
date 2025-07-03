<?php  
session_start();
require_once "db.php";
$stmt = $conn->query("SELECT * FROM menu");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Weekly Menu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
      padding: 20px;
    }
    .content {
      background-color: rgba(255, 255, 255, 0.5); /* transparent white */
      padding: 20px;
      border-radius: 15px;
      max-width: 1000px;
      width: 100%;
      box-shadow: 0 0 20px rgba(0,0,0,0.4);
      backdrop-filter: blur(5px);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color:rgb(5, 52, 122);
    }
    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 8px;
      overflow: hidden;
      background-color: rgba(255,255,255,0.3); /* transparent table */
    }
    thead th {
      background-color: rgba(16, 40, 77, 0.8); /* transparent blue */
      color: #fff;
      padding: 12px;
      font-size: 1rem;
    }
    tbody td {
      padding: 12px;
      border-bottom: 1px solid rgba(0,0,0,0.1);
      color: #000;
      background-color: rgba(255,255,255,0.3); /* transparent rows */
    }
    tbody tr:hover {
      background-color: rgba(255,255,255,0.5);
    }
    a.btn-back {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color:rgb(8, 45, 100);
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      text-align: center;
      transition: background 0.3s ease;
    }
    a.btn-back:hover {
      background-color:rgb(79, 114, 190);
    }
    @media (max-width: 600px) {
      table, thead, tbody, th, td, tr {
        display: block;
        width: 100%;
      }
      thead {
        display: none;
      }
      tbody tr {
        margin-bottom: 15px;
        background-color: rgba(255,255,255,0.3);
        border-radius: 8px;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
      }
      tbody td {
        border: none;
        display: flex;
        justify-content: space-between;
        padding: 8px 10px;
      }
      tbody td::before {
        content: attr(data-label);
        font-weight: bold;
        color:rgb(36, 96, 186);
      }
    }
  </style>
</head>
<body>
  <div class="content">
    <h2>Weekly Menu</h2>
    <table>
      <thead>
        <tr>
          <th>Day</th>
          <th>Breakfast</th>
          <th>Lunch</th>
          <th>Dinner</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $row) { ?>
          <tr>
            <td data-label="Day"><?php echo htmlspecialchars($row["day"]); ?></td>
            <td data-label="Breakfast"><?php echo htmlspecialchars($row["breakfast"]); ?></td>
            <td data-label="Lunch"><?php echo htmlspecialchars($row["lunch"]); ?></td>
            <td data-label="Dinner"><?php echo htmlspecialchars($row["dinner"]); ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <a href="index.php" class="btn-back">Back to Home</a>
  </div>
</body>
</html>
