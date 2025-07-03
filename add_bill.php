<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rollno = $_POST["rollno"];
    $amount = $_POST["amount"];
    $description = $_POST["description"];
    $status = $_POST["status"];

    try {
        $stmt = $conn->prepare("INSERT INTO billing (rollno, amount, description, status) VALUES (?, ?, ?, ?)");
        $stmt->execute([$rollno, $amount, $description, $status]);
        $success = "Bill added successfully.";
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Bill</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background: url('canteen.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }
    .container {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(5px);
      padding: 30px;
      border-radius: 15px;
      max-width: 600px;
      width: 100%;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      animation: fadeIn 0.4s ease-in-out;
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(15px);}
      to {opacity: 1; transform: translateY(0);}
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      color: #333;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 15px;
      transition: border 0.3s;
    }
    input:focus, select:focus {
      border-color: #4a148c;
      outline: none;
    }
    .alert {
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 15px;
      text-align: center;
      font-weight: bold;
    }
    .alert-success {
      background: #d4edda;
      color: #155724;
    }
    .alert-danger {
      background: #f8d7da;
      color: #721c24;
    }
    .btn-group {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      justify-content: space-between;
    }
    button, .button-link {
      flex: 1;
      text-align: center;
      border: none;
      border-radius: 8px;
      padding: 12px;
      cursor: pointer;
      font-weight: bold;
      background: linear-gradient(to right, #4a148c, #880e4f);
      color: #fff;
      transition: background 0.3s;
      text-decoration: none;
    }
    button:hover, .button-link:hover {
      background: linear-gradient(to right, #6a1b9a, #ad1457);
    }
    @media (max-width: 500px) {
      .btn-group {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Add Mess Bill</h2>
    <?php if (!empty($success)) { ?>
      <div class="alert alert-success"><?php echo $success; ?></div>
    <?php } ?>
    <?php if (!empty($error)) { ?>
      <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>
    <form method="post">
      <label for="rollno">Student Roll Number</label>
      <input type="text" id="rollno" name="rollno" required />

      <label for="amount">Amount</label>
      <input type="number" id="amount" name="amount" step="0.01" required />

      <label for="description">Description</label>
      <input type="text" id="description" name="description" />

      <label for="status">Status</label>
      <select id="status" name="status">
        <option value="unpaid">Unpaid</option>
        <option value="paid">Paid</option>
      </select>

      <div class="btn-group">
        <button type="submit">Add Bill</button>
        <a href="dashboard.php" class="button-link">Back to Dashboard</a>
      </div>
    </form>
  </div>
</body>
</html>
