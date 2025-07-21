<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us - MediGo</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <!-- Header -->
  <?php require_once 'include/header.php' ?>

  <!-- Contact Section -->
  <section class="contact">
    <div class="container contact-content">
      <!-- Contact Info -->
      <div class="contact-info">
        <h2>Get in Touch</h2>
        <p>We'd love to hear from you! Whether you have a question about our services or need assistance, feel free to contact us.</p>
        <ul>
          <li><strong>Email:</strong> support@medigo.com</li>
          <li><strong>Phone:</strong> +8801874928686</li>
          <li><strong>Address:</strong> 123 MediGo Street, Health City, Bangladesh</li>
        </ul>
      </div>

      <!-- Contact Form -->
      <div class="contact-form">
        <form action="#" method="POST">
          <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required />
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required />
          </div>
          <div class="form-group">
            <label for="message">Your Message</label>
            <textarea id="message" name="message" rows="5" required></textarea>
          </div>
          <button type="submit" class="btn">Send Message</button>
        </form>
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
