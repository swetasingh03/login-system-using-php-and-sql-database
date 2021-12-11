<?php
$servername="localhost";
$username="root";
$password="";
$database="signup";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    ?>
    <script>
        alert("connection not successful");
        </script>
        <?php
}
?>
