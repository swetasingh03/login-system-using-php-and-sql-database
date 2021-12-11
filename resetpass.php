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
 if(isset($_GET['token'])){
   $token=$_GET['token'];
 $newpassword=mysqli_real_escape_string($conn,$_POST['password']);
$cpassword=mysqli_real_escape_string($conn,$_POST['cpassword']);
$pass=password_hash($newpassword,PASSWORD_BCRYPT);
$cpass=password_hash($cpassword,PASSWORD_BCRYPT);

if($newpassword == $cpassword){
     $updatequery="UPDATE `registration` SET `password`='$pass',`token`='$token' ";
      $iquery=mysqli_query($conn,$updatequery);
    if($iquery){
      echo 'set password';
      header('location:login.php');
    }else{
      echo 'your password not updated';
      header('location:resetpass.php');
    }
}else{
  echo 'password are not matching';
}
}else{
  echo 'no token found';
}
 }
?>

    <div class="container text-center">
        <h3>Reset Password</h3>
      </div>
      
        <div class="container">
        <form action="" method="POST">
      <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" name="cpassword" id="exampleInputPassword1">
  </div>
  
  <button type="submit" class="btn btn-primary" name="submit">Confirm</button>
</form>
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