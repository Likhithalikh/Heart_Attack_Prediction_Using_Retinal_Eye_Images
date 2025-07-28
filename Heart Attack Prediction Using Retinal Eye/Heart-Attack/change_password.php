<?php
session_start();

require_once 'include/connection.php';

if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] !== true) {
  header('Location: login.php');
  exit;
}

if (isset($_POST['change_password'])) {
  $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
  $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
  $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
  $username = $_SESSION['username'];

  if ($new_password !== $confirm_password) {
    echo "<script>alert('New password and confirm password do not match.'); location.href = 'change_password.php';</script>";
    exit;
  }

  $query = "SELECT password FROM registration WHERE username = '$username'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    if (password_verify($current_password, $row['password'])) {
      $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

      $update_query = "UPDATE registration SET password = '$hashed_password' WHERE username = '$username'";
      if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Password updated successfully.'); location.href = 'home.php';</script>";
      } else {
        echo "<script>alert('Failed to update the password. Please try again.'); location.href = 'change_password.php';</script>";
      }
    } else {
      echo "<script>alert('Current password is incorrect.'); location.href = 'change_password.php';</script>";
    }
  } else {
    echo "<script>alert('User not found.'); location.href = 'login.php';</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Change Password - Heart Attack Prediction</title>
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
    .change-password-section {
      padding: 80px 0;
      min-height: 100vh;
      display: flex;
      align-items: center;
    }

    .form-container {
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      padding: 40px;
      max-width: 500px;
      margin: 0 auto;
    }

    .section-title {
      margin-bottom: 2rem;
      text-align: center;
    }

    .section-title h2 {
      font-size: 2rem;
      font-weight: 700;
      color: #2b2b2b;
      margin-bottom: 1rem;
    }

    .section-title p {
      color: #555;
    }

    .form-control {
      height: 50px;
      padding: 10px 20px;
      border-radius: 5px;
      border: 1px solid #ddd;
      margin-bottom: 20px;
    }

    .form-control:focus {
      border-color: #1977cc;
      box-shadow: 0 0 0 0.2rem rgba(25, 119, 204, 0.25);
    }

    .btn-primary {
      background-color: #1977cc;
      border-color: #1977cc;
      padding: 12px 30px;
      border-radius: 5px;
      font-weight: 600;
      width: 100%;
    }

    .btn-primary:hover {
      background-color: #1565c0;
      border-color: #1565c0;
    }

    .back-link {
      text-align: center;
      margin-top: 20px;
    }

    .back-link a {
      color: #555;
      text-decoration: none;
    }

    .back-link a:hover {
      color: #1977cc;
    }
  </style>
</head>

<body>

  <?php include 'include/header.php'; ?>

  <main class="main">
    <section class="change-password-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="form-container" data-aos="fade-up">
              <div class="section-title">
                <h2>Change Password</h2>
                <p>Update your account password securely</p>
              </div>

              <form action="" method="post" onsubmit="return validatePassword()">
                <div class="form-group">
                  <input type="password" name="current_password" class="form-control" placeholder="Current Password" required>
                </div>
                <div class="form-group">
                  <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required>
                </div>
                <div class="form-group">
                  <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm New Password" required>
                </div>
                <div class="form-group">
                  <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                </div>
                <div class="back-link">
                  <a href="home.php"><i class="bi bi-arrow-left"></i> Back to Home</a>
                </div>
              </form>
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
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
    function validatePassword() {
      const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{6,}$/;
      const newPassword = document.getElementById('new_password').value;
      const confirmPassword = document.getElementById('confirm_password').value;

      if (!passwordPattern.test(newPassword)) {
        alert('Password must be at least 6 characters long and contain at least one digit, one lowercase letter, one uppercase letter, and one special character.');
        return false;
      }

      if (newPassword !== confirmPassword) {
        alert('New password and confirm password do not match.');
        return false;
      }

      return true;
    }
  </script>

</body>

</html>