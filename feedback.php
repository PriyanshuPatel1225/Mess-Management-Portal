<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $message = $_POST["message"];
    
    $stmt = $conn->prepare("INSERT INTO feedback (name, message) VALUES (?, ?)");
    $stmt->execute([$name, $message]);
    
    $success = "Thank you! Your feedback has been submitted.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mess Feedback</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('canteen.jpg') no-repeat center center fixed;
      background-size: cover;
    }

    .feedback-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: rgba(0,0,0,0.6);
      padding: 20px;
    }

    .feedback-card {
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      max-width: 500px;
      width: 100%;
      box-shadow: 0 10px 25px rgba(0,0,0,0.4);
      backdrop-filter: blur(5px);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color:rgb(4, 5, 32);
      text-shadow: 0 0 5px #0ff;
    }

    .success-message {
      background: #d4edda;
      color: #155724;
      padding: 10px;
      border-radius: 8px;
      text-align: center;
      margin-bottom: 15px;
      border: 1px solid #c3e6cb;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #333;
    }

    input[type="text"],
    textarea {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 1rem;
      transition: border 0.3s;
    }

    input[type="text"]:focus,
    textarea:focus {
      outline: none;
      border-color: #4e54c8;
    }

    button,
    .back-btn {
      display: block;
      width: 100%;
      margin-top: 10px;
      padding: 12px;
      font-size: 1rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }

    button {
      background: linear-gradient(135deg, #4e54c8, #8f94fb);
      color: #fff;
    }

    button:hover {
      background: linear-gradient(135deg, #3b3fc1, #7a80f0);
    }

    .back-btn {
      text-align: center;
      background: #6c757d;
      color: #fff;
      text-decoration: none;
    }

    .back-btn:hover {
      background: #5a6268;
    }

    @media (max-width: 576px) {
      .feedback-card {
        padding: 20px;
      }
      button, .back-btn {
        font-size: 0.95rem;
      }
    }
  </style>
</head>
<body>
  <div class="feedback-wrapper">
    <div class="feedback-card">
      <h2>Mess Feedback</h2>

      <?php if (!empty($success)) { ?>
        <div class="success-message"><?php echo $success; ?></div>
      <?php } ?>

      <form method="post">
        <label for="name">Your Name</label>
        <input type="text" name="name" id="name" required />

        <label for="message">Your Feedback</label>
        <textarea name="message" id="message" rows="4" required></textarea>

        <button type="submit">Submit Feedback</button>
        <a href="index.php" class="back-btn">Back to Home</a>
      </form>
    </div>
  </div>
</body>
</html>
