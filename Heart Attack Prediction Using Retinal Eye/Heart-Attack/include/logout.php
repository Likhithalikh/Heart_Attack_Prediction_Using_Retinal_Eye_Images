<?php

    session_start();

    unset($_SESSION['isLogin']);
    unset($_SESSION['email']);
    unset($_SESSION['type']);

    echo "<script>alert('You have logged out successfully');location.href='../login.php'</script>";

?>
