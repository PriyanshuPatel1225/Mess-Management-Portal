<?php
session_start();
if (!isset($_SESSION["student"])) {
    header("Location: student_login.php");
    exit;
}
require_once "db.php";

$rollno = $_SESSION["student_rollno"];
$stmt = $conn->prepare("SELECT * FROM billing WHERE rollno = ?");
$stmt->execute([$rollno]);
$bills = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Bills</title>
  <style>
    body {
      margin: 0;
      background: #222;
      color: #f0f0f0;
      font-family: Arial, sans-serif;
      padding: 20px;
      display: flex;
      justify-content: center;
    }
    .container {
      width: 100%;
      max-width: 1000px;
      background: rgba(34,34,34,0.95);
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(255,255,255,0.2);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #0ff;
    }
    .btn-back {
      display: inline-block;
      background: #0ff;
      color: #000;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 6px;
      margin-bottom: 15px;
    }
    .btn-back:hover {
      background: #0cc;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: rgba(40,40,40,0.9);
    }
    thead {
      background: #111;
    }
    thead th {
      color: #0ff;
      padding: 12px;
    }
    tbody td {
      padding: 10px;
      text-align: center;
      border-bottom: 1px solid #333;
    }
    tbody tr:hover {
      background: rgba(0,255,255,0.1);
    }
    .badge {
      padding: 5px 10px;
      border-radius: 5px;
      font-weight: bold;
    }
    .badge-success {
      background: #2ecc71;
      color: #fff;
    }
    .badge-danger {
      background: #e74c3c;
      color: #fff;
    }
    .btn-action {
      background: #0ff;
      color: #000;
      padding: 6px 12px;
      border-radius: 5px;
      text-decoration: none;
    }
    .btn-action:hover {
      background: #0cc;
    }
    .btn-disabled {
      background: #555;
      color: #999;
      padding: 6px 12px;
      border-radius: 5px;
      cursor: not-allowed;
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
        background: rgba(30,30,30,0.9);
        margin-bottom: 15px;
        border-radius: 8px;
        padding: 10px;
      }
      tbody td {
        display: flex;
        justify-content: space-between;
        padding: 8px;
      }
      tbody td::before {
        content: attr(data-label);
        color: #0ff;
        font-weight: bold;
      }
    }
  </style>
  <script>
    function confirmPayment() {
      return confirm("Are you sure you want to pay this bill?");
    }
  </script>
</head>
<body>
  <div class="container">
    <h2>My Mess Bills</h2>
    <a href="student_dashboard.php" class="btn-back">Back to Dashboard</a>
    <table>
      <thead>
        <tr>
          <th>Amount</th>
          <th>Description</th>
          <th>Status</th>
          <th>Bill Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($bills as $bill) { ?>
        <tr>
          <td data-label="Amount">₹<?php echo htmlspecialchars($bill['amount']); ?></td>
          <td data-label="Description"><?php echo htmlspecialchars($bill['description']); ?></td>
          <td data-label="Status">
            <?php if ($bill['status'] == 'unpaid') { ?>
              <span class="badge badge-danger">Unpaid</span>
            <?php } else { ?>
              <span class="badge badge-success">Paid</span>
            <?php } ?>
          </td>
          <td data-label="Bill Date"><?php echo htmlspecialchars($bill['bill_date']); ?></td>
          <td data-label="Action">
            <?php if ($bill['status'] == 'unpaid') { ?>
              <a href="pay_bill.php?id=<?php echo $bill['id']; ?>" class="btn-action" onclick="return confirmPayment();">Pay Now</a>
            <?php } else { ?>
              <span class="btn-disabled">Paid</span>
            <?php } ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>
</html>
