<?php
session_start();

if (!isset($_SESSION['doctor_id']) && !isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Success</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
      background-color:rgb(156, 213, 254);
    }

    .header {
      background-color: #0077cc;
      color: white;
      padding: 1.5rem;
      text-align: center;
    }

    .container {
      text-align: center;
      background-color:rgb(42, 138, 206);
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .success-icon {
      font-size: 4rem;
      color: #28a745;
      margin-bottom: 1rem;
    }

    h2 {
      color:rgb(255, 255, 255);
    }

    p {
      font-size: 1.1rem;
      color: rgb(255, 255, 255);
    }

    .btn-login {
      display: inline-block;
      margin-top: 2rem;
      background-color:rgb(2, 84, 143);
      color: white;
      padding: 0.8rem 1.5rem;
      border: none;
      border-radius: 6px;
      font-size: 1.5rem;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .btn-login:hover {
      background-color: #005fa3;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="success-icon">✅</div>
    <h2>Registered Successfully!</h2>
    <p>Thank you for registering with MediGo. You can now login to access your dashboard and appointments.</p>
    <a href="login.php" class="btn-login">Go to Login</a>
  </div>

</body>
</html>