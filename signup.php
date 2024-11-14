<?php
 require 'components/_nav.php';
 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
      include 'components/_dbconnect.php';
      $username=$_POST['username'];
      $password=$_POST['password'];
      $cpassword=$_POST['cpassword'];
      $existSql="SELECT * FROM `user` WHERE username ='$username'";
      $result=mysqli_query($conn,$existSql);
      $numExists=mysqli_num_rows($result);
      if($numExists>0){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Sorry!</strong> Your username already exists.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }else{
        if($password==$cpassword){
          $hash=password_hash($password, PASSWORD_DEFAULT);
          $sql="INSERT INTO `user` ( `username`, `password`, `datetime`) VALUES ( '$username', '$hash', current_timestamp())";
          $result=mysqli_query($conn,$sql);
          if($result){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your account has been successfully created. You can now login.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
          }
                }else{
                  echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> Your passwords don't match.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
                }
              }
      }
    

    ?>
  <div class="container col-md-7 my-4">
    <h2 class="text-center my-3">Signup in iSafe</h2>
    <form action="/loginsystem/signup.php" method="POST">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" maxlength="11" id="username" name="username" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" maxlength="20" id="password" name="password">
  </div>
  <div class="mb-3">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" maxlength="20" id="cpassword" name="cpassword">
    <div id="emailHelp" class="form-text">Make sure to write the same password.</div>
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
     </form></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>