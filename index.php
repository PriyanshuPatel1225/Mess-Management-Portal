<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GCE Mess Management</title>
  <style>
    body {
      background-color: #000;
      margin: 0;
      font-family: Arial, sans-serif;
    }

    h1 {
      text-align: center;
      color: #4d09c3;
      font-size: 4rem;
      letter-spacing: 6px;
      margin-top: 30px;
      margin-bottom: 40px;
      text-shadow:
        0 0 10px #0ff,
        0 0 20px #0ff,
        0 0 30px #0ff,
        0 0 40px #0ff,
        0 0 50px #0ff;
    }

    .cards-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 26px;
      padding: 20px;
      max-width: 1300px;
      margin: auto;
    }

    .card {
      flex: 1 1 260px;
      background: #333;
      border-radius: 12px;
      padding: 35px 30px;
      color: #fff;
      text-align: center;
      box-shadow: 0 0 20px rgba(0,0,0,0.6);
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 0 25px rgba(255, 255, 255, 0.4);
    }

    .card h2 {
      margin-top: 25px;
      margin-bottom: 20px;
      font-size: 1.6rem;
      line-height: 1.3;
    }

    .card a {
      display: inline-block;
      margin-top: 15px;
      padding: 12px 25px;
      font-size: 1.1rem;
      background: #fff;
      color: #000;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s;
    }

    .card a:hover {
      background: #ddd;
    }

    /* color themes for each card */
    .student-login {
      background: linear-gradient(135deg, #4e54c8, #8f94fb);
    }
    .student-register {
      background: linear-gradient(135deg, #43cea2, #185a9d);
    }
    .admin-login {
      background: linear-gradient(135deg, #ff416c, #ff4b2b);
    }
    .weekly-menu {
      background: linear-gradient(135deg, #ffb347, #ffcc33);
      color: #000;
    }
    .feedback {
      background: linear-gradient(135deg, #ff7e5f, #feb47b);
    }

    .icon {
      font-size: 60px;
      margin-bottom: 15px;
    }

    @media (max-width: 992px) {
      .card {
        flex: 1 1 45%;
      }
      h1 {
        font-size: 3rem;
      }
    }

    @media (max-width: 768px) {
      .cards-container {
        flex-direction: column;
        align-items: center;
      }
      .card {
        flex: 1 1 80%;
      }
    }
  </style>
  <script src="https://kit.fontawesome.com/a2c6caaa68.js" crossorigin="anonymous"></script>
</head>
<body>
  <h1>GCE ,Mess Management</h1>
  <div class="cards-container">

    <div class="card student-login">
      <div class="icon"><i class="fas fa-user-circle"></i></div>
      <h2>Student Login</h2>
      <a href="student_login.php">Login</a>
    </div>

    <div class="card student-register">
      <div class="icon"><i class="fas fa-user-plus"></i></div>
      <h2>Student Registration</h2>
      <a href="student_register.php">Register</a>
    </div>

    <div class="card admin-login">
      <div class="icon"><i class="fas fa-shield-alt"></i></div>
      <h2>Admin Login</h2>
      <a href="login.php">Admin</a>
    </div>

    <div class="card weekly-menu">
      <div class="icon"><i class="fas fa-list"></i></div>
      <h2>View Weekly Menu</h2>
      <a href="menu.php">See Menu</a>
    </div>

    <div class="card feedback">
      <div class="icon"><i class="fas fa-comments"></i></div>
      <h2>Submit Feedback</h2>
      <a href="feedback.php">Give Feedback</a>
    </div>

  </div>
</body>
</html>
