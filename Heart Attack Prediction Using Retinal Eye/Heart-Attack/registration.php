<?php
require_once 'include/connection.php';

if (isset($_POST['register'])) {
  $u_name = mysqli_real_escape_string($conn, $_POST['username']);
  $u_email = mysqli_real_escape_string($conn, $_POST['email']);
  $u_phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $u_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

  $check_email = "SELECT * FROM registration WHERE email = '$u_email'";
  $email_result = mysqli_query($conn, $check_email);

  if (mysqli_num_rows($email_result) > 0) {
    echo "<script>alert('Email already registered. Please use a different email.');</script>";
  } else {
    $sql = "INSERT INTO registration (username, email, phone, password, user_type, status, created_at) 
        VALUES ('$u_name', '$u_email', '$u_phone', '$u_password', 'User', 'Active', NOW())";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      echo "<script>alert('You have registered successfully'); location.href='login.php';</script>";
    } else {
      echo "<script>alert('Unable to process your request');</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Register - Medilab</title>
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="login-page d-flex align-items-center justify-content-center" style="height: 100vh; background-color: #f8f9fa;">
  <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
    <div class="card shadow-lg p-4 text-center">
      <h2 class="mb-4"><i class="bi bi-person-plus-fill text-primary"></i> Register</h2>
      <form action="registration.php" method="POST" onsubmit="return validateForm()">
      <div class="mb-3 text-start">
        <label for="username" class="form-label"><i class="bi bi-person-circle"></i> Username</label>
        <input type="text" name="username" class="form-control" required pattern="^[a-zA-Z_]+$">
        <div class="form-text">Username can only contain letters and underscores.</div>
      </div>
      <div class="mb-3 text-start">
        <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i> Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3 text-start">
        <label for="phone" class="form-label"><i class="bi bi-telephone-fill"></i> Phone</label>
        <input type="text" name="phone" class="form-control" required>
      </div>
      <div class="mb-3 text-start">
        <label for="password" class="form-label"><i class="bi bi-lock-fill"></i> Password</label>
        <input type="password" name="password" class="form-control" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{6,}">
        <div class="form-text">Password must be at least 6 characters long, contain at least one number, one symbol, and both uppercase and lowercase letters.</div>
      </div>
      <div class="d-grid">
        <button type="submit" name="register" class="btn btn-primary">
        <i class="bi bi-person-check-fill"></i> Register
        </button>
      </div>
      </form>
      <div class="text-center mt-3">
      <p>Already have an account? <a href="login.php">Login <i class="bi bi-box-arrow-in-right"></i></a></p>
      </div>
    </div>
    </div>
  </div>
  </div>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    function validateForm() {
  const username = document.querySelector('input[name="username"]').value;
  const password = document.querySelector('input[name="password"]').value;
  const phone = document.querySelector('input[name="phone"]').value;
  
  // Username validation
  if (username.trim() === '') {
    alert('Username cannot be empty');
    return false;
  }
  if (!/^[a-zA-Z_]+$/.test(username)) {
    alert('Username can only contain letters and underscores');
    return false;
  }
  
  // Phone validation
  if (phone.trim() === '') {
    alert('Phone number cannot be empty');
    return false;
  }
  if (!/^\d{10}$/.test(phone.replace(/[-\s]/g, ''))) {
    alert('Please enter a valid 10-digit phone number');
    return false;
  }
  
  // Password validation
  if (password.length < 6) {
    alert('Password must be at least 6 characters long');
    return false;
  }
  if (!/[a-z]/.test(password)) {
    alert('Password must contain at least one lowercase letter');
    return false;
  }
  if (!/[A-Z]/.test(password)) {
    alert('Password must contain at least one uppercase letter');
    return false;
  }
  if (!/\d/.test(password)) {
    alert('Password must contain at least one number');
    return false;
  }
  if (!/[\W_]/.test(password)) {
    alert('Password must contain at least one special character');
    return false;
  }
  
  return true;
}
  </script>
</body>
</html>
