<?php 

$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"]== "POST")  {
  include 'partials/_db.connect.php';
  
  $username = $_POST["username"];
  $password = $_POST["password"];
  
  //$sql = "Select * from users where username='$username' AND password='$password'";
  $sql = "Select * from user where username='$username'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1){
      while($row=mysqli_fetch_assoc($result)){ 
        //password_verify : checks if the entered password ($password) matches the hashed password stored in the database ($row['password']).
          if (password_verify($password, $row['password'])){ 
              $login = true;
              session_start();
              $_SESSION['loggedin'] = true; 
              $_SESSION['username'] = $username;
              header("location: welcome.php");
          } 
          else{
              $showError = "Invalid Credentials";
          }
      }
    }
  }  
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>

    

    <?php require 'partials/_nav.php' ?>
      <!-- dismissible alert -->
       <?php
      if($login){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You Are logged in.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      } 
      ?>

       <!-- dismissible alert -->
       <?php
      if($showError){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error</strong> '.$showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      } 
      ?>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style>
  .center-form {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Full viewport height */
  }
  .form-container {
    width: 100%;
    max-width: 400px; /* Adjust this to your desired width */
  }
</style>

<style>
  .center-form {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 100vh;
  }
  .form-container {
    width: 100%;
    max-width: 400px;
  }
  h1 {
    margin-bottom: 20px;
    font-size: 2rem;
    font-weight: bold;
  }
</style>

<div class="center-form">
  <!-- <div class="background-image">
    <img src="your-background-image.jpg" alt="Login Background">
  </div> -->
  <div class="login-form">
    <h1>Login to Our Website</h1>
    <form action="/loginsystem/login.php" method="post" class="form-container">
      <div class="form-group mb-3">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="username" aria-describedby="emailHelp" placeholder="Enter username">
      </div>
      <div class="form-group mb-3">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="password" name="password">
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</div>

  </body>
</html>