<?php
include 'pullasession.php';
include 'pullaconnect.php';

if ($logged_in) { 
    header('Location: submitreview.php');
    exit;   
}    

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cryptedpassword = cryptpassword($password);
    $result = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username' AND password = '$cryptedpassword'");
    if ($result->num_rows==1) {
   login();
   header('Location: submitreview.php');
   exit;
    } else {
        echo "Incorrect username or password";
    }
};

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="pulla.css" />
    <title>Login</title>
  </head>
  <header>
    <nav>
    <h1>Login</h1>
    <a href="pulla.php">Back to homepage</a>
    </nav>
  </header>
  <body>
      <main>


<form id="login" method="POST" action="login.php">
  <label for="username">Username:</label> <input type="text" id="username" name="username"><br>
  <label for="password">Password: </label><input type="password" id="password" name="password"><br>
  <input type="submit" value="Log In">
</form>
  </body>
  </main>
  </html>