<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}
require_once "db.php";

// handle form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST["day"];
    $breakfast = $_POST["breakfast"];
    $lunch = $_POST["lunch"];
    $dinner = $_POST["dinner"];

    $stmt = $conn->prepare("SELECT * FROM menu WHERE day = ?");
    $stmt->execute([$day]);
    if ($stmt->rowCount() > 0) {
        $update = $conn->prepare("UPDATE menu SET breakfast=?, lunch=?, dinner=? WHERE day=?");
        $update->execute([$breakfast, $lunch, $dinner, $day]);
        $message = "Menu updated successfully.";
    } else {
        $insert = $conn->prepare("INSERT INTO menu (day, breakfast, lunch, dinner) VALUES (?, ?, ?, ?)");
        $insert->execute([$day, $breakfast, $lunch, $dinner]);
        $message = "Menu added successfully.";
    }
}

// fetch current menu
$rows = $conn->query("SELECT * FROM menu")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Weekly Menu</title>
  <style>
    body {
      margin: 0;
      background: #f0f2f5;
      font-family: 'Segoe UI', sans-serif;
    }

    .container {
      max-width: 960px;
      margin: 40px auto;
      padding: 20px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    h1, h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #4e54c8;
      text-shadow: 0 0 4px #0ff;
    }

    form {
      margin-bottom: 30px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
    }

    input[type="text"],
    select {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }

    input[type="text"]:focus,
    select:focus {
      border-color: #4e54c8;
      outline: none;
    }

    button,
    .btn-secondary {
      display: inline-block;
      padding: 10px 20px;
      margin-top: 10px;
      text-decoration: none;
      color: #fff;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease;
      font-size: 1rem;
    }

    button {
      background: linear-gradient(135deg, #4e54c8, #8f94fb);
    }

    button:hover {
      background: linear-gradient(135deg, #3b3fc1, #7a80f0);
    }

    .btn-secondary {
      background: #6c757d;
      margin-left: 10px;
    }

    .btn-secondary:hover {
      background: #5a6268;
    }

    .message {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 20px;
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    table th, table td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }

    table th {
      background: linear-gradient(135deg, #4e54c8, #8f94fb);
      color: #fff;
    }

    table tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    @media(max-width: 600px) {
      .container {
        margin: 20px;
      }
      table th, table td {
        padding: 8px;
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Manage Weekly Menu</h1>
    <?php if (!empty($message)) { ?>
      <div class="message"><?php echo $message; ?></div>
    <?php } ?>
    <form method="post">
      <label>Day</label>
      <select name="day" required>
        <option value="">Select Day</option>
        <option>Monday</option>
        <option>Tuesday</option>
        <option>Wednesday</option>
        <option>Thursday</option>
        <option>Friday</option>
        <option>Saturday</option>
        <option>Sunday</option>
      </select>

      <label>Breakfast</label>
      <input type="text" name="breakfast" required />

      <label>Lunch</label>
      <input type="text" name="lunch" required />

      <label>Dinner</label>
      <input type="text" name="dinner" required />

      <button type="submit">Save Menu</button>
      <a href="dashboard.php" class="btn-secondary">Back to Dashboard</a>
    </form>

    <h2>Current Weekly Menu</h2>
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
            <td><?php echo htmlspecialchars($row["day"]); ?></td>
            <td><?php echo htmlspecialchars($row["breakfast"]); ?></td>
            <td><?php echo htmlspecialchars($row["lunch"]); ?></td>
            <td><?php echo htmlspecialchars($row["dinner"]); ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>
</html>
