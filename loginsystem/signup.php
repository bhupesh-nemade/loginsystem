<?php 

$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"]== "POST")  {
  include 'partials/_db.connect.php';
   
  $username = $_POST["username"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  // $exists = false;
  //check wheather username exsit.
  $existSql = "SELECT * FROM `user` WHERE username = '$username'";
  $result = mysqli_query($conn,$existSql);  // function in PHP used to execute queries against a MySQL database
  $numExistRows = mysqli_num_rows($result); //checks how many rows are returned. If more than 0, it means the username already exists, and an error message is set.

  if($numExistRows > 0){
    // $exists = true;
    $showError = "Username already exist.";
  }
    else{
      // $exist = false;

    if($password == $cpassword) {
      $hash = password_hash($password,PASSWORD_DEFAULT); // run defalt hasing alogo.
      $sql = "INSERT INTO `user` (`username`, `password`, `Date time`) VALUES ( '$username','$hash', current_timestamp())";
      $result = mysqli_query($conn,$sql);
      if($result){
        $showAlert = true;
      }
    }
    else{
      $showError = "Password and Confirm password do not match.";
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

    <title>Signup</title>
  </head>
  <body>

    

    <?php require 'partials/_nav.php' ?>
      <!-- dismissible alert -->
       <?php
      if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You Account is created.
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
  <h1>Signup to Our Website</h1>
  <form action="/loginsystem/signup.php" method="post" class="form-container">
    <div class="form-group mb-3">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="exampleInputEmail1" name="username" aria-describedby="emailHelp" placeholder="Enter username">
    </div>
    <div class="form-group mb-3">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" placeholder="password" name="password">
    </div>
    <div class="form-group mb-3">
      <label for="cpassword">Confirm Password</label>
      <input type="password" class="form-control" id="cpassword" placeholder="confirm password" name="cpassword">
    </div>
    <button type="submit" class="btn btn-primary">Signup</button>
    <p>Already have an account? <a href="/loginsystem/login.php">Login</a></p>
  </form>
</div>

  </body>
</html>