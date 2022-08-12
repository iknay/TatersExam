<?php

session_start();
$errors = [];
$user_id = "";
// connect to database
$db = mysqli_connect('sql6.freemysqlhosting.net', 'sql6512385', 'm1s5QWN7mu', 'sql6512385');

if (isset($_POST['new_password'])) {
  $new_pass = mysqli_real_escape_string($db, $_POST['new_pass']);
  $new_pass_c = mysqli_real_escape_string($db, $_POST['new_pass_c']);

  // Grab to token that came from the email link
  $token = $_SESSION['token'];
  if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
  if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
  if (count($errors) == 0) {
    // select username of user from the password_reset table 
    $sql = "SELECT username FROM users WHERE token='$token' LIMIT 1";
    $results = mysqli_query($db, $sql);
    $username = mysqli_fetch_assoc($results)['username'];

    if ($username) {
      $new_pass = md5($new_pass);
      $sql = "UPDATE users SET password='$new_pass' WHERE username='$username'";
      $results = mysqli_query($db, $sql);
      $_SESSION['message'] = "You are now signed in";
      $_SESSION['type'] = 'alert-success';
      header('location: signinform.php');
      
    }
  }
}
?>