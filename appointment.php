<?php
// DB Connection
$host = 'localhost';
$db = 'medigo_website';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $specialty = $_POST['specialty'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $reason = $_POST['reason'];

    // Sanitize inputs
    $fullName = htmlspecialchars($fullName);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Insert into DB
    $sql = "INSERT INTO appointment (patient_name, email_address, phone_number, patient_age, patient_gender, doctor_speciality, appointment_date, appointment_time, reason_for_visit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisssss", $fullName, $email, $phone, $age, $gender, $specialty, $date, $time, $reason);

    if ($stmt->execute()) {
        echo "<script>alert('Appointment successfully booked!'); window.location.href='thank_you.php';</script>";
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MediGo | Book Appointment</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <!-- Header -->
  <?php require_once 'include/header.php' ?>

  <!-- Appointment Section -->
  <section class="appointment-section">
    <div class="container">
      <h2>Book an Appointment</h2>
      <form class="appointment-form" action="appointment.php" method="post">
        
        <fieldset>
          <legend>Personal Information</legend>
          <div class="form-grid">

            <div class="form-group">
              <label for="fullName">Full Name*</label>
              <input type="text" id="fullName" name="fullName" required placeholder="Your full name">
            </div>

            <div class="form-group half-width">
              <label for="email">Email Address*</label>
              <input type="email" id="email" name="email" required placeholder="you@example.com">
            </div>

            <div class="form-group half-width">
              <label for="phone">Phone Number*</label>
              <input type="tel" id="phone" name="phone" required placeholder="(123) 456-7890">
            </div>

            <div class="form-group half-width">
              <label for="age">Age*</label>
              <input type="number" id="age" name="age" min="0" required placeholder="Your age">
            </div>

            <div class="form-group half-width">
              <label for="gender">Gender*</label>
              <select id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
                <option value="NotSay">Prefer not to say</option>
              </select>
            </div>

            <div class="form-group">
              <label for="specialty">Doctor Specialty*</label>
              <select id="specialty" name="specialty" required>
                <option value="">Select a specialty</option>
                <option value="Psychiatry">Psychiatry</option>
                <option value="Gynecology">Gynecology</option>
                <option value="Pediatrics">Pediatrics</option>
                <option value="Orthopedics">Orthopedics</option>
                <option value="General">General Medicine</option>
              </select>
            </div>

          </div>
        </fieldset>

        <fieldset>
          <legend>Appointment Details</legend>
          <div class="form-grid">
            <div class="form-group half-width">
              <label for="date">Appointment Date*</label>
              <input type="date" id="date" name="date" required>
            </div>

            <div class="form-group half-width">
              <label for="time">Appointment Time*</label>
              <input type="time" id="time" name="time" required>
            </div>

            <div class="form-group">
              <label for="reason">Reason for Visit*</label>
              <textarea id="reason" name="reason" rows="4" required placeholder="Describe your reason for the visit"></textarea>
            </div>
          </div>
        </fieldset>

        <button type="submit" class="btn">Submit Appointment</button>
      </form>
    </div>
  </section>

  <!-- Confirmation Modal -->
  <div id="confirmationModal" class="modal hidden">
    <div class="modal-content">
      <p>Are you sure you want to submit this appointment?</p>
      <button id="confirmBtn" class="btn">Yes, Confirm</button>
      <button id="cancelBtn" class="btn cancel">Cancel</button>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <p>&copy; 2025 MediGo. All rights reserved.</p>
    </div>
  </footer>

  <!-- JavaScript -->
  <script>
    const form = document.querySelector(".appointment-form");
    const modal = document.getElementById("confirmationModal");
    const confirmBtn = document.getElementById("confirmBtn");
    const cancelBtn = document.getElementById("cancelBtn");

    form.addEventListener("submit", function (e) {
      e.preventDefault(); // Stop normal submission
      modal.classList.remove("hidden");
    });

    confirmBtn.addEventListener("click", function () {
      modal.classList.add("hidden");
      form.submit(); // Proceed to submit
    });

    cancelBtn.addEventListener("click", function () {
      modal.classList.add("hidden");
    });
  </script>

</body>
</html>
