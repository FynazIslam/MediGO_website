<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Our Doctors | MediGo</title>
  <link rel="stylesheet" href="doctors.css" />
</head>
<body>

  <!-- Header -->
  <?php require_once 'include/header.php' ?>

  <!-- Doctors Section -->
  <section class="doctors-section">
    <div class="container">
      <h2>Meet Our Specialists</h2>
      <div class="doctors-grid">

        <!-- Doctor cards generated from full list -->
        <!-- Replace the image src with correct file paths -->

        <div class="doctor-card">
          <img src="assets/PS.D1 [ Prof.-Dr.-M-A-Salam ].jpg" alt="Prof. Dr. Md. Abdus Salam">
          <div class="doctor-info">
            <h3>Prof. Dr. Md. Abdus Salam</h3>
            <p class="speciality">Psychiatry & Psychotherapy Specialist</p>
            <p class="bio">MBBS, DPM (DU), MCPS (Psychiatry). Former Professor at BSMMU. Available 10am–2pm (Sat & Fri closed) at Bangladesh Psychiatric Care.</p>
          </div>
        </div>

        <div class="doctor-card">
          <img src="assets/G.D1 [ Dr.-Kamrun-Nahar-1 ].jpg" alt="Dr. Kamrun Nahar">
          <div class="doctor-info">
            <h3>Dr. Kamrun Nahar</h3>
            <p class="speciality">Gynecology & Infertility Specialist</p>
            <p class="bio">MBBS, MCPS, DGO (OBGYN). Consultant at Cumilla Medical Center. Available 11am–8pm (Closed: Friday).</p>
          </div>
        </div>

        <div class="doctor-card">
          <img src="assets/P.D1 [ Prof.-Dr.-Syed-Khairul-Amin ].jpg" alt="Prof. Dr. Syed Khairul Amin">
          <div class="doctor-info">
            <h3>Prof. Dr. Syed Khairul Amin</h3>
            <p class="speciality">Child Blood & Cancer Specialist</p>
            <p class="bio">MBBS, DCH (Glasgow), MRCP (UK). Professor at Anwer Khan Modern Medical College. 9am–1pm & 5pm–9pm (Closed: Friday).</p>
          </div>
        </div>

        <div class="doctor-card">
          <img src="assets/O.D1 [ Prof.-Dr.-Syed-Anwaruzzaman ].jpg" alt="Prof. Dr. Syed Anwaruzzaman"> 
          <div class="doctor-info">
            <h3>Prof. Dr. Syed Anwaruzzaman</h3>
            <p class="speciality">Orthopedics & Trauma Specialist</p>
            <p class="bio">MBBS (CMC), MS (ORTHO). Former Professor at Cumilla Medical College. 10am–1pm & 5pm–9pm (Sun & Wed).</p>
          </div>
        </div>

        <!-- Repeat for all other doctors as needed -->

      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <p>&copy; 2025 MediGo. All rights reserved.</p>
    </div>
  </footer>

</body>
</html>
