<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MediGo Website || Code Camp BD - 2025</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <!-- Header -->
  <header class="header">
  <?php require_once 'include/header.php' ?>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container hero-content">
      <!-- Text -->
      <div class="hero-text">
        <h2>Find the Right Doctor Near You</h2>
        <p>Book appointments with trusted healthcare professionals effortlessly.</p>
        <a href="appointment.php" class="btn">Book Now</a>
      </div>

      <!-- Image -->
      <div class="hero-image">
        <img src="assets/hero.png" alt="Healthcare banner" class="hero-img">
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section class="services">
    <div class="container">
      <h3>Our Services</h3>
      <div class="service-cards">
        <div class="card">
          <h4>Psychiatry</h4>
          <p>Comprehensive mental health support and therapy sessions.</p>
        </div>
        <div class="card">
          <h4>Gynecology</h4>
          <p>Expert care for women's health and reproductive services.</p>
        </div>
        <div class="card">
          <h4>Pediatrics</h4>
          <p>Dedicated healthcare services for infants and children.</p>
        </div>
        <div class="card">
          <h4>Orthopedics</h4>
          <p>Advanced treatment for musculoskeletal conditions.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section class="about">
    <div class="container">
      <h3>About MediGo</h3>
      <p>MediGo bridges the gap between patients and healthcare providers with a seamless appointment platform. Our mission is to improve healthcare accessibility, reduce waiting time, and empower patients with digital tools.</p>
    </div>
  </section>

  <!-- Articles Section -->
  <section class="articles">
    <div class="container">
      <h3>Latest Health Tips</h3>
      <div class="article-cards">
        <div class="article-card">
          <h4>Intermittent Fasting Benefits</h4>
          <p>Discover how intermittent fasting can improve your health and well-being.</p>
          <a href="#">Read More</a>
        </div>
        <div class="article-card">
          <h4>Children's Health During Pandemic</h4>
          <p>Tips on maintaining your child's health and routine amidst global challenges.</p>
          <a href="#">Read More</a>
        </div>
        <div class="article-card">
          <h4>Liver Health Awareness</h4>
          <p>Understand the impact of lifestyle choices on liver health and prevention strategies.</p>
          <a href="#">Read More</a>
        </div>
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
