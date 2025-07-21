<!-- thank_you.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Appointment Confirmed</title>
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

    .message-box {
      text-align: center;
      background-color: #0077cc;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .message-box h2 {
      color:rgb(255, 255, 255);
      margin-bottom: 20px;
    }

    .message-box a {
      display: inline-block;
      padding: 10px 20px;
      background-color:rgb(4, 70, 116);
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }

    .message-box a:hover {
      background-color: #0077cc;
    }
  </style>
</head>
<body>

  <div class="message-box">
    <h2>Your appointment has been successfully booked!</h2>
    <a href="appointment.php">Book another</a>
  </div>

</body>
</html>
