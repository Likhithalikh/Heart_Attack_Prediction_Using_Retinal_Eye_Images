<?php
session_start();

if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] !== true) {
  header('Location: login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>About - Heart Attack Prediction</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <style>
    .about-content {
      padding: 2rem;
    }

    .content-wrapper {
      max-width: 600px;
    }

    .section-heading {
      color: #2b2b2b;
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      position: relative;
      padding-bottom: 1rem;
    }

    .section-heading::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      height: 3px;
      width: 70px;
      background-color: #1977cc;
    }

    .lead {
      font-size: 1.1rem;
      line-height: 1.8;
      color: #555;
    }

    .features-list {
      list-style: none;
      padding: 0;
      margin: 2rem 0;
    }

    .feature-item {
      display: flex;
      align-items: flex-start;
      margin-bottom: 1rem;
      padding: 0.5rem 0;
    }

    .feature-icon {
      color: #1977cc;
      font-size: 1.25rem;
      margin-right: 1rem;
      flex-shrink: 0;
    }

    .feature-item span {
      color: #444;
      line-height: 1.6;
    }

    .mission-statement {
      font-size: 1.1rem;
      line-height: 1.8;
      color: #555;
      border-left: 4px solid #1977cc;
      padding-left: 1.5rem;
      margin-top: 2rem;
    }

    .section-title {
      margin-bottom: 4rem;
    }

    .section-title h2 {
      font-size: 2.5rem;
      font-weight: 700;
      color: #2b2b2b;
      position: relative;
      padding-bottom: 1.5rem;
      margin-bottom: 1rem;
    }

    .section-title h2::after {
      content: '';
      position: absolute;
      left: 50%;
      bottom: 0;
      transform: translateX(-50%);
      width: 50px;
      height: 3px;
      background-color: #1977cc;
    }

    .about-img {
      border-radius: 8px;
      overflow: hidden;
      position: relative;
    }

    .about-img img {
      transition: transform 0.5s ease;
    }

    .about-img:hover img {
      transform: scale(1.02);
    }

    .experience-badge {
      position: absolute;
      bottom: 30px;
      right: -30px;
      background: #1977cc;
      color: white;
      padding: 1.5rem;
      border-radius: 8px;
      text-align: center;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .experience-badge h4 {
      font-size: 2rem;
      margin: 0;
      font-weight: 700;
    }

    .experience-badge p {
      margin: 0;
      font-size: 0.9rem;
    }

    @media (max-width: 991px) {
      .about-content {
        padding: 2rem 0;
      }
      
      .experience-badge {
        right: 0;
      }
    }

    @media (max-width: 768px) {
      .about-content {
        padding: 1rem;
      }

      .section-title h2 {
        font-size: 2rem;
      }
      
      .section-heading {
        font-size: 1.75rem;
      }
      
      .lead, .mission-statement {
        font-size: 1rem;
      }
      
      .experience-badge {
        position: relative;
        bottom: auto;
        right: auto;
        margin-top: 2rem;
        display: inline-block;
      }
    }
  </style>
</head>

<body>

<?php include 'include/header.php'; ?>

<main class="main">
  <section id="about" class="about section">
    <!-- Section Title -->
    <div class="container section-title text-center" data-aos="fade-up">
      <h2>About Us</h2>
      <p>Learn more about our innovative approach to heart attack prediction using retinal imaging.</p>
    </div>

    <div class="container">
      <div class="row gy-5 align-items-center">
        <!-- Image Column -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
          <div class="about-img position-relative">
            <img src="assets/img/about.jpg" class="img-fluid rounded shadow" alt="About Us Image">
            <div class="experience-badge">
              <h4>10+</h4>
              <p>Years of Experience</p>
            </div>
          </div>
        </div>

        <!-- Content Column -->
        <div class="col-lg-6 about-content" data-aos="fade-up" data-aos-delay="200">
          <div class="content-wrapper">
            <h3 class="section-heading">Heart Attack Prediction Using Retinal Imaging</h3>
            <p class="lead">
              Our cutting-edge technology leverages advanced retinal imaging to predict the risk of heart attacks. By analyzing the blood vessels in the retina, we can detect early signs of cardiovascular issues and provide timely interventions.
            </p>
            <ul class="features-list">
              <li class="feature-item">
                <i class="bi bi-check-circle-fill feature-icon"></i>
                <span>Non-invasive and painless procedure</span>
              </li>
              <li class="feature-item">
                <i class="bi bi-check-circle-fill feature-icon"></i>
                <span>Early detection of heart attack risks</span>
              </li>
              <li class="feature-item">
                <i class="bi bi-check-circle-fill feature-icon"></i>
                <span>Personalized care plans based on retinal analysis</span>
              </li>
            </ul>
            <p class="mission-statement">
              Our mission is to use innovative technology to improve heart health and save lives. With our retinal imaging services, you can take proactive steps to protect your heart and overall well-being.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include 'include/footer.php'; ?>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

</body>
</html>