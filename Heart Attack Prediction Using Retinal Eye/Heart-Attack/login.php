<?php
session_start();

require_once 'include/connection.php';

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM registration WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) { 
            $_SESSION['isLogin'] = true;
            $_SESSION['username'] = $row['username'];

            echo "<script>alert('Login successful!'); location.href = 'home.php';</script>";
        } else {
            echo "<script>alert('Incorrect password. Please try again.'); location.href = 'login.php';</script>";
        }
    } else {
        echo "<script>alert('No user found with the provided username.'); location.href = 'login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login - Medilab</title>
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
          <h2 class="mb-4"><i class="bi bi-heart-eyes text-danger"></i> Login</h2>
          <form action="login.php" method="POST">
            <div class="mb-3 text-start">
              <label for="username" class="form-label"><i class="bi bi-person-circle"></i> Username</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3 text-start">
              <label for="password" class="form-label"><i class="bi bi-lock-fill"></i> Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="d-grid">
              <button type="submit" name="login" class="btn btn-primary">
                <i class="bi bi-box-arrow-in-right"></i> Login
              </button>
            </div>
          </form>
          <div class="text-center mt-3">
            <p>Don't have an account? <a href="registration.php">Register <i class="bi bi-arrow-right-circle-fill"></i></a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
