<?php
session_start();
include('dbconnect.php');
if(isset($_GET['token'])){
    $token=$_GET['token'];
    $updatequery="update registration set status='active' where token='$token'";
    $query=mysqli_query($conn,$updatequery);
    if($query){
        echo '<div class="alert alert-success" role="alert">
        check your mail here and activate now.
      </div>';
      header('location:login.php');
    }else{
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>sorry!</strong> you are logged out.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('location:login.php');
    }
}else{  
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>sorry!</strong>Account not updated.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  header('location:form.php');
}
?>