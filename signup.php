<?php
$showalert= false;
$showerror= false;
if ($_SERVER['REQUEST_METHOD'] == "POST"){
include 'partial/_dbconnect.php';
$username = $_POST["username"];
$password = $_POST["password"];
$cpassword = $_POST["cpassword"];
//$exists=false;
$existsql="SELECT * FROM `users` WHERE username ='$username'";
$result= mysqli_query($conn,$existsql);
$numexistrows= mysqli_num_rows($result);
if($numexistrows > 0){
  //$exists = true;
  $showerror = " username already exists";
  }
  else{
    //$exists=false;
  

if(($password == $cpassword)){
  $hash = password_hash($password,PASSWORD_DEFAULT);
  $sql ="INSERT INTO `users` ( `username`, `password`, `date`) VALUES ( '$username', '$hash', current_timestamp())";
  $result= mysqli_query($conn,$sql);
  if($result){
    $showalert= true;

  }

}
else{
  $showerror = "Password do not match ";

}}
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>signup/register</title>
  </head>
  <body>
    <?php require 'partial/_nav.php' ?>
    <?php 
    if($showalert){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success!</strong> user has been created successfully.and you can login now
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
    if($showerror){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>error!</strong> '. $showerror .'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
?>
    <div class="container my-4" >
        <h1>signup in our website</h1>
        <form action="/loginsystem/signup.php" method="POST">
  <div class="form-group">
    <label for="username">username</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
    
  </div>
  <div class="form-group">
    <label for="Password">Password</label>
    <input type="password" class="form-control" id="Password" name="password">
  </div>
  <div class="form-group">
    <label for="cpassword">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
    <small id="emailHelp" class="form-text text-muted">Make sure you have entered a same password.</small>
  </div>
 
  <button type="submit" class="btn btn-primary">SignUp</button>
</form>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>