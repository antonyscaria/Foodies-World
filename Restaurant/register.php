<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="project.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

/* Set a style for the submit button */
.registerbtn {
  background-color:  rgb(30, 171, 86);
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}
</style>
</head>
<body>
<form action="register.php" method='POST'>
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <input type="text" placeholder="Enter Name" id="name" name="name" >
    <input type="text" placeholder="Enter Phone No" id="phoneno" name="phoneno" >
    <input type="text" placeholder="Enter Address"  id="address" name="address" >
    <input type="text" placeholder="Enter Email" id="email" name="email" >
    <input type="password" placeholder="Enter Password" name="psw" >
    <input type="password" placeholder="Repeat Password" id="password"  name="password" >
    <hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="submit" name="submit" id="submit" class="registerbtn">Register</button>
        <p>Already have an account?<a href="login.php">Sign in</a>.</p>
      </div>
  </div>
</form>
</body>
</html>
<?php
include 'db.php';
if(isset($_POST['submit']))
{
$name=$_POST["name"];
$phone=$_POST["phoneno"];
$address=$_POST["address"];
$email=$_POST["email"];
$password=$_POST["password"];
$qCount="SELECT * from `customer` where `phone`='$phone'";
$isExist=mysqli_query($db,$qCount);
if (mysqli_num_rows($isExist) ==0)
{
$sql1="INSERT INTO `customer` (`cus_id`, `name`, `email`, `phone`, `address`,  `password`) VALUES (NULL, '$name', '$email', '$phone', '$address', '$password');";

if(mysqli_query($db,$sql1))
{
    echo '<script>window.location.href="login.php"</script>';
}
else
{
    echo "<script> alert('ERROR IN  REGISTRATION');</script>";
}
}
else
{
    echo "<script> alert('Already Exist ');</script>";
}
}
?>
