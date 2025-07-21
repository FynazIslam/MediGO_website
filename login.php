<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'medigo_website';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Doctor Registration
  if (isset($_POST['specialty'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $specialty = $_POST['specialty'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO doctors (name, phone, email, specialty, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $phone, $email, $specialty, $password);

    if ($stmt->execute()) {
        $_SESSION['doctor_id'] = $conn->insert_id;
        header("Location: register_success.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
  }
  // Patient Registration
  elseif (isset($_POST['birthdate'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO patients (name, phone, email, birthdate, gender, address, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $phone, $email, $birthdate, $gender, $address, $password);

    if ($stmt->execute()) {
        $_SESSION['patient_id'] = $conn->insert_id; 
        header("Location: register_success.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
  }


    // Doctor Login
    elseif (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['login_type']) && $_POST['login_type'] === 'doctor') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT id, password FROM doctors WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($doctor_id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['doctor_id'] = $doctor_id;
                $stmt->close();
                header("Location: doctor_dashboard.php");
                exit();
            } else {
                echo "Incorrect doctor password.";
            }
        } else {
            echo "Doctor not found.";
        }
        $stmt->close();
    }

    // Patient Login
    elseif (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['login_type']) && $_POST['login_type'] === 'patient') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT id, password FROM patients WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($patient_id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['patient_id'] = $patient_id;
                $_SESSION['email'] = $email;
                $stmt->close();
                header("Location: patient_dashboard.php");
                exit();
            } else {
                echo "Incorrect patient password.";
            }
        } else {
            echo "Patient not found.";
        }
        $stmt->close();
    }

    else {
        echo "Unrecognized request.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MediGo - Login / Signup</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f8ff;
    }

    .header {
      background-color: #0077cc;
      color: white;
      padding: 1rem 0;
    }

    .header .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 1rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .logo {
      font-size: 1.8rem;
      font-weight: bold;
    }

    .nav a {
      color: white;
      margin: 0 0.75rem;
      text-decoration: none;
    }

    .nav .active {
      text-decoration: underline;
    }

    .auth-section {
      padding: 3rem 1rem;
      background-color: #f9f9f9;
    }

    .auth-container {
      max-width: 600px;
      margin: 0 auto;
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .auth-toggle {
      text-align: center;
      margin-bottom: 2rem;
    }

    .auth-toggle button {
      background-color: #0077cc;
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      margin: 0 0.5rem;
      border-radius: 6px;
      cursor: pointer;
      font-size: 1rem;
    }

    .auth-form {
      display: none;
    }

    .auth-form.active {
      display: block;
    }

    .form-group {
      margin-bottom: 1.25rem;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    input, select, textarea {
      width: 100%;
      padding: 0.7rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }

    textarea {
      resize: vertical;
    }

    .btn {
      background-color: #0077cc;
      color: white;
      padding: 0.75rem;
      width: 100%;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
      cursor: pointer;
    }

    .switch-text {
      margin-top: 1rem;
      font-size: 0.9rem;
      text-align: center;
    }

    .switch-text a {
      color: #0077cc;
      cursor: pointer;
      text-decoration: underline;
    }

    footer.footer {
      background-color: #0077cc;
      color: white;
      padding: 1rem 0;
      text-align: center;
      margin-top: 23rem;
    }

    @media (max-width: 600px) {
      .auth-toggle button {
        margin: 0.5rem 0;
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <?php require_once 'include/header.php' ?>

  <!-- Auth Section -->
  <section class="auth-section">
    <div class="container auth-container">

      <!-- Toggle User Type -->
      <div class="auth-toggle">
        <button onclick="selectUser('patient')">I'm a Patient</button>
        <button onclick="selectUser('doctor')">I'm a Doctor</button>
      </div>

      <!-- Patient Login -->
      <form id="patientLogin" class="auth-form" method="post" action="login.php">
        <h2>Patient Login</h2>
        <!-- Hidden input to identify patient login -->
         <input type="hidden" name="login_type" value="patient" />

        <div class="form-group">
          <label for="pLoginEmail">Email</label>
          <input type="email" id="pLoginEmail" name="email" required />
        </div>
        <div class="form-group">
          <label for="pLoginPassword">Password</label>
          <input type="password" id="pLoginPassword" name="password" required />
        </div>
        <button type="submit" class="btn">Login</button>
        <p class="switch-text">Don't have an account? <a onclick="switchForm('patientSignup')">Register</a></p>
      </form>

      <!-- Patient Signup -->
      <form id="patientSignup" class="auth-form" method="post" action="login.php">
        <h2>Patient Registration</h2>
        <div class="form-group">
          <label for="pName">Full Name</label>
          <input type="text" id="pName" name="name" required />
        </div>
        <div class="form-group">
          <label for="pPhone">Phone Number</label>
          <input type="tel" id="pPhone" name="phone" pattern="01[0-9]{9}" placeholder="e.g. 01XXXXXXXXX" required />
        </div>
        <div class="form-group">
          <label for="pEmail">Email</label>
          <input type="email" id="pEmail" name="email" required />
        </div>
        <div class="form-group">
          <label for="pBirthdate">Birthdate</label>
          <input type="date" id="pBirthdate" name="birthdate" required />
        </div>
        <div class="form-group">
          <label for="pGender">Gender</label>
          <select id="pGender" name="gender" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="female">Female</option>
            <option value="male">Male</option>
            <option value="other">Other</option>
          </select>
        </div>
        <div class="form-group">
          <label for="pAddress">Address</label>
          <textarea id="pAddress" name="address" rows="3" required></textarea>
        </div>
        <div class="form-group">
          <label for="pPassword">Password</label>
          <input type="password" id="pPassword" name="password" required />
        </div>
        <button type="submit" class="btn">Register</button>
        <p class="switch-text">Already have an account? <a onclick="switchForm('patientLogin')">Login</a></p>
      </form>

      <!-- Doctor Login -->
      <form id="doctorLogin" class="auth-form" method="post" action="login.php">
        <h2>Doctor Login</h2>
        <input type="hidden" name="login_type" value="doctor">

        <div class="form-group">
          <label for="dLoginEmail">Email</label>
          <input type="email" id="dLoginEmail" name="email" required />
        </div>
        <div class="form-group">
          <label for="dLoginPassword">Password</label>
          <input type="password" id="dLoginPassword" name="password" required />
        </div>
        <button type="submit" class="btn">Login</button>
        <p class="switch-text">Don't have an account? <a onclick="switchForm('doctorSignup')">Register</a></p>
      </form>

      <!-- Doctor Signup -->
      <form id="doctorSignup" class="auth-form" method="post" action="login.php" enctype="multipart/form-data">
        <h2>Doctor Registration</h2>
        <div class="form-group">
          <label for="dName">Full Name</label>
          <input type="text" id="dName" name="name" required />
        </div>
        <div class="form-group">
          <label for="dPhone">Phone Number</label>
          <input type="tel" id="dPhone" name="phone" pattern="01[0-9]{9}" placeholder="e.g. 01XXXXXXXXX" required />
        </div>
        <div class="form-group">
          <label for="dEmail">Email</label>
          <input type="email" id="dEmail" name="email" required />
        </div>
        <div class="form-group">
          <label for="dSpecialty">Specialty</label>
          <input type="text" id="dSpecialty" name="specialty" required />
        </div>
      
        <div class="form-group">
          <label for="dPassword">Password</label>
          <input type="password" id="dPassword" name="password" required />
        </div>
        <button type="submit" class="btn">Register</button>
        <p class="switch-text">Already have an account? <a onclick="switchForm('doctorLogin')">Login</a></p>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <p>&copy; 2025 MediGo. All rights reserved.</p>
    </div>
  </footer>

  <script>
    function selectUser(type) {
      document.querySelectorAll(".auth-form").forEach(form => form.classList.remove("active"));
      document.getElementById(type + "Login").classList.add("active");
    }

    function switchForm(formId) {
      document.querySelectorAll(".auth-form").forEach(form => form.classList.remove("active"));
      document.getElementById(formId).classList.add("active");
    }
  </script>

</body>
</html>
