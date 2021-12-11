<?php
session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>form validation</title>
</head>

<body>

<?php
 include ('dbconnect.php');

if(isset($_POST['submit'])){
$username=mysqli_real_escape_string($conn,$_POST['username']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
$password=mysqli_real_escape_string($conn,$_POST['password']);
$cpassword=mysqli_real_escape_string($conn,$_POST['cpassword']);
$pass=password_hash($password,PASSWORD_BCRYPT);
$cpass=password_hash($cpassword,PASSWORD_BCRYPT);
$token=bin2hex(random_bytes(15));

$emailquery="SELECT * FROM `registration` WHERE email='$email' ";
$query=mysqli_query($conn,$emailquery);
$emailcount=mysqli_num_rows($query);
if($emailcount>0){
  echo '<div class="alert alert-warning d-flex align-items-center" role="alert">
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>
  <div>
    Email Id already exist.
  </div>
</div>';
}else{
  if($password == $cpassword){
    $insertquery="INSERT INTO `registration`(`username`, `email`, `mobile`, `password`, `cpassword`,`token`,`status`) VALUES ('$username','$email','$mobile','$pass','$cpass','$token','inactive')";
    $iquery=mysqli_query($conn,$insertquery);
    if($iquery){
      $subject="Email activation";
      $body="hiii, $username .click here to activate your account
      http://localhost/php%20project/formvalidation/activate.php?token = $token";
      $header="From: swetasingh03052000@gmail.com";
      if(mail($email,$subject,$body,$header)){
          echo '<div class="alert alert-success" role="alert">
          check your mail here and activate now.
        </div>';
        header('location:login.php');
      }
    else{
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>sorry!</strong> Email sending failed due to some error.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
  }
  else{
  echo 'not inserted';
  }
  }else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> OOPS!</strong> Password are not matching.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
}
}
?>

    <div class="container text-center">
        <h3>Create Account</h3>
        <p>Get started with your free account</p>
      </div>
      <div class="container text-center">
        <div class="d-grid gap-2 my-2">
          <a href="https://mail.google.com/"> <button class="btn btn-success" type="button" id="google"><i
          class="bi bi-google"></i> Login via gmail</button></a>
          <a href="https://www.facebook.com/"> <button class="btn btn-primary" type="button" id="facebook"><i
          class="bi bi-facebook"></i> Login via facebook</button></a>
        </div>
        </div>
        <div class="container">
        <form action="" method="POST">
        <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Username</label>
    <input type="text" class="form-control"  name="username" id="exampleInputPassword1" autocomplete="off">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" autocomplete="off">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Phone number</label>
    <input type="number" class="form-control" name="mobile" id="exampleInputPassword1" autocomplete="off">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" name="cpassword" id="exampleInputPassword1">
  </div>
  
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
<p>Have an account?<a href="login.php">  Log in</a></p>
</div>
  

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>