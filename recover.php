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

$email=mysqli_real_escape_string($conn,$_POST['email']);




$emailquery="SELECT * FROM `registration` WHERE email='$email' ";
$query=mysqli_query($conn,$emailquery);
$emailcount=mysqli_num_rows($query);
if($emailcount){
$userdata=mysqli_fetch_array($query);
$username=$userdata['username'];
$token=$userdata['token'];
      $subject="Password Reset";
      $body="hiii, $username .click here to reset your password
      http://localhost/php%20project/formvalidation/resetpass.php?token = $token";
      $header="From: swetasingh03052000@gmail.com";
      if(mail($email,$subject,$body,$header)){
          echo '<div class="alert alert-success" role="alert">
          check your mail here and activate now '.$email.'
        </div>';
        header('location:login.php');
      }
    else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> OOPS!</strong> Password are not matching.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
}else{
    echo 'no email found';
}
}
?>

    <div class="container text-center">
        <h3>Recover Your Account</h3>
        <p>Please fill Email Id properly</p>
    </div>

    <div class="container">
        <form action="" method="POST">
            <div class="mb-3">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                        aria-describedby="emailHelp" autocomplete="off">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Send mail</button>
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