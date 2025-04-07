<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Student Hostel Management System">
  <meta name="keywords" content="hostel, accommodation, student housing, dormitory">
  <meta name="author" content="NTTF">
  <title>NTTF Student Hostel</title>

  <!-- Favicon -->
  <link rel="icon" href="/api/placeholder/32/32" alt="favicon" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" />

  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">

  <!-- AOS Animation -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

  <style>
    :root {
      --primary: #0d6efd;
      --secondary: #e63946;
      --light: #f8f9fa;
      --dark: #212529;
      --gray: #6c757d;
      --success: #198754;
    }

    body {
      font-family: 'Poppins', sans-serif;
      line-height: 1.6;
      color: #333;
      overflow-x: hidden;
    }

    /* Header */
    .header {
      background: linear-gradient(90deg, var(--primary) 0%, #0099ff 100%);
      padding: 15px 0;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .logo-container img {
      max-height: 50px;
    }

    .nav-links {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      margin: 0;
      padding: 0;
    }

    .nav-links li {
      list-style: none;
      margin-left: 25px;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      font-size: 16px;
      text-transform: uppercase;
      position: relative;
      transition: all 0.3s ease;
    }

    .nav-links a::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      background: white;
      bottom: -5px;
      left: 0;
      transition: width 0.3s ease;
    }

    .nav-links a:hover::after {
      width: 100%;
    }

    /* Hero Section */
    .hero {
      height: 80vh;
      background-position: center;
      background-size: cover;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      margin-top: 80px;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
    }

    .hero-content {
      position: relative;
      z-index: 2;
      text-align: center;
      color: white;
    }

    .hero-content h1 {
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .hero-content p {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto 30px;
    }

    .hero-btn {
      display: inline-block;
      background: var(--secondary);
      color: white;
      padding: 12px 30px;
      border-radius: 30px;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      border: 2px solid var(--secondary);
    }

    .hero-btn:hover {
      background: transparent;
      color: white;
    }

    /* Room Types Section */
    .section-title {
      text-align: center;
      margin-bottom: 50px;
    }

    .section-title h2 {
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--dark);
      position: relative;
      display: inline-block;
      padding-bottom: 15px;
    }

    .section-title h2::after {
      content: '';
      position: absolute;
      width: 70px;
      height: 3px;
      background: var(--secondary);
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
    }

    .room-types {
      background: #f8f9fa;
      padding: 80px 0;
    }

    .room-card {
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      margin-bottom: 30px;
      height: 100%;
      border: none;
    }

    .room-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .room-img-container {
      height: 220px;
      overflow: hidden;
      position: relative;
    }

    .room-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .room-card:hover .room-img {
      transform: scale(1.1);
    }

    .room-details {
      padding: 20px;
    }

    .room-title {
      color: var(--primary);
      font-weight: 700;
      font-size: 1.5rem;
      margin-bottom: 15px;
    }

    .room-features {
      list-style: none;
      padding: 0;
      margin: 0 0 20px;
    }

    .room-features li {
      position: relative;
      padding-left: 25px;
      margin-bottom: 10px;
      color: #666;
    }

    .room-features li::before {
      content: '\f00c';
      font-family: 'Font Awesome 6 Free';
      font-weight: 900;
      position: absolute;
      left: 0;
      color: var(--success);
    }

    .room-btn {
      display: inline-block;
      background: var(--primary);
      color: white;
      padding: 8px 20px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .room-btn:hover {
      background: var(--primary);
      opacity: 0.9;
      color: white;
    }

    /* Location Section */
    .location-section {
      padding: 80px 0;
    }

    .map-container {
      height: 450px;
      width: 100%;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Footer */
    footer {
      background: var(--dark);
      color: #ccc;
      padding: 60px 0 30px;
    }

    .footer-logo img {
      max-height: 60px;
      margin-bottom: 20px;
    }

    .footer-column h3 {
      color: white;
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 10px;
    }

    .footer-column h3::after {
      content: '';
      position: absolute;
      width: 50px;
      height: 2px;
      background: var(--secondary);
      bottom: 0;
      left: 0;
    }

    .footer-column p,
    .footer-column a {
      color: #aaa;
      margin-bottom: 10px;
      transition: all 0.3s ease;
      text-decoration: none;
      display: block;
    }

    .footer-column a:hover {
      color: white;
      padding-left: 5px;
    }

    .footer-column .contact-info i {
      margin-right: 10px;
      color: var(--secondary);
    }

    .social-links {
      display: flex;
      margin-top: 20px;
    }

    .social-links a {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      margin-right: 10px;
      color: white;
      font-size: 18px;
      transition: all 0.3s ease;
    }

    .social-links a:hover {
      background: var(--secondary);
      transform: translateY(-5px);
    }

    .footer-bottom {
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      padding-top: 20px;
      margin-top: 40px;
      text-align: center;
    }

    /* Responsive */
    @media (max-width: 991px) {
      .hero-content h1 {
        font-size: 2.5rem;
      }
      .nav-links {
        justify-content: center;
        margin-top: 15px;
      }
      .nav-links li {
        margin: 0 10px;
      }
    }

    @media (max-width: 767px) {
      .hero {
        height: 60vh;
      }
      .hero-content h1 {
        font-size: 2rem;
      }
      .section-title h2 {
        font-size: 2rem;
      }
      .footer-column {
        margin-bottom: 30px;
      }
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header class="header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-3 col-md-4">
          <div class="logo-container">
            <img src="images/nttf logo white back.jpeg" alt="NTTF Logo">
          </div>
        </div>
        <div class="col-lg-9 col-md-8">
          <nav>
            <ul class="nav-links">
              <li><a href="#home">Home</a></li>
              <li><a href="#rooms">Rooms</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li><a href="login.html" class="btn btn-outline-light btn-sm">Login</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section id="home" class="hero" style="background-image: url('images/41e75691.jpg');">
    <div class="container">
      <div class="hero-content">
        <h1>Welcome to NTTF Student Hostel</h1>
        <p>A comfortable and secure place for students to live and excel in their academic journey</p>
        <a href="#rooms" class="hero-btn">Explore Rooms</a>
      </div>
    </div>
  </section>

  <!-- Room Types Section -->
  <section id="rooms" class="room-types">
    <div class="container">
      <div class="section-title">
        <h2>Our Accommodations</h2>
        <p>Choose the perfect room type for your stay</p>
      </div>

      <div class="row">
        <!-- Single Room -->
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000">
          <div class="room-card">
            <div class="room-img-container">
              <img src="images/single bed 1.png" alt="Single Room" class="room-img">
            </div>
            <div class="room-details">
              <h3 class="room-title">Single Occupancy Room</h3>
              <ul class="room-features">
                <li>Private room for one student</li>
                <li>8-12 square meters (80-120 square feet)</li>
                <li>One bed, study table, chair, and wardrobe</li>
                <li>24/7 high-speed internet access</li>
              </ul>
              <p style="font-weight: 500; color: var(--primary); font-size: 1.1rem;">₹8,000/month</p>
            </div>
          </div>
        </div>

        <!-- Double Room -->
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
          <div class="room-card">
            <div class="room-img-container">
              <img src="images/two bed.jpeg" alt="Double Room" class="room-img">
            </div>
            <div class="room-details">
              <h3 class="room-title">Double Occupancy Room</h3>
              <ul class="room-features">
                <li>Shared room for two students</li>
                <li>12-18 square meters (120-180 square feet)</li>
                <li>Two beds, study tables, chairs, and shared wardrobe</li>
                <li>Comfortable study environment</li>
              </ul>
              <p style="font-weight: 500; color: var(--primary); font-size: 1.1rem;">₹6,000/month</p>
            </div>
          </div>
        </div>

        <!-- Dormitory Room -->
<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
  <div class="room-card">
    <div class="room-img-container">
      <img src="images/bunk bed.png" alt="Dormitory Room" class="room-img">
    </div>
    <div class="room-details">
      <h3 class="room-title">Dormitory Room</h3>
      <ul class="room-features">
        <li>Shared room for multiple students</li>
        <li>20-40 square meters (200-400 square feet)</li>
        <li>Multiple beds, shared study area and facilities</li>
        <li>Great for social interaction and teamwork</li>
      </ul>
      <p style="font-weight: 500; color: var(--primary); font-size: 1.1rem;">₹4,000/month</p>
    </div>
  </div>
</div>

  </section>

  <!-- Location Section -->
  <section id="location" class="location-section">
    <div class="container">
      <div class="section-title">
        <h2>Our Location</h2>
        <p>Find us at RD Tata Technical Education Centre</p>
      </div>

      <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3678.138860337592!2d86.21001529678954!3d22.797318!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f5e31d96c0c597%3A0x10b6532ac1b8e7cb!2sR.D.%20Tata%20Technical%20Education%20Center!5e0!3m2!1sen!2sin!4v1737966792263!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="footer-column">
            <div class="footer-logo">
              <img src="images/nttf logo white back.jpeg" alt="NTTF Logo">
            </div>
            <p>Providing quality accommodation for students since 1985. Our mission is to create a safe, comfortable, and conducive environment for students to live and learn.</p>
            <div class="social-links">
              <a href="https://www.facebook.com/NTTFTechnicalTraining/" target="_blank"><i class="fab fa-facebook-f"></i></a>
              <a href="https://x.com/NTTFindia"><i class="fab fa-twitter" target="_blank"></i></a>
              <a href="https://www.instagram.com/nttf_india/" target="_blank"><i class="fab fa-instagram"></i></a>
              <a href="https://www.linkedin.com/school/nttf-nettur-technical-training-foundation-/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="footer-column">
            <h3>Contact Info</h3>
            <div class="contact-info">
              <p><i class="fas fa-map-marker-alt"></i> RD Tata Technical Education Centre</p>
              <p><i class="fas fa-phone"></i> (0039) 333 12 68 347</p>
              <p><i class="fas fa-envelope"></i> <a href="mailto:rntc_nttf@nttf.co.in">rntc_nttf@nttf.co.in</a></p>
              <p><i class="fab fa-skype"></i> you_online</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="footer-column">
            <h3>Quick Links</h3>
            <a href="#home">Home</a>
            <a href="#rooms">Rooms</a>
            <a href="#about">About Us</a>
            <a href="#facilities">Facilities</a>
            <a href="login.html">Login</a>
            <a href="#contact">Contact</a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p>© 2025 NTTF Student Hostel. All Rights Reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
  
  <!-- AOS Animation JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  
  <script>
    // Initialize AOS
    AOS.init();
    
    // Add smooth scrolling to nav links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });
    
    // Fixed header on scroll
    window.addEventListener('scroll', function() {
      const header = document.querySelector('.header');
      if (window.scrollY > 100) {
        header.style.padding = '10px 0';
      } else {
        header.style.padding = '15px 0';
      }
    });
  </script>
</body>
</html>