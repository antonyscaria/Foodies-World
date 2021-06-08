<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
 <style>
body {
  font-family: Arial, Helvetica, sans-serif; 
  position: relative;
  background-image:url(res2.jpg);
  background-repeat: no-repeat;
  background-attachment:fixed;
  background-size: cover;
}
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border-radius: 3px;
  box-sizing: border-box;
  border:none;
  background-color: #ffffff;
  color:#2b2b2b;
}

button {
  background-color:  rgb(30, 171, 86);
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}
button:hover {
  opacity: 0.8;
}
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}
span.psw {
  float: right;
  padding-top: 16px;
}
.modal {
  display: none; 
  position: fixed; 
  z-index: 1; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  padding-top: 60px;
}
.modal-content {
  background-color:transparent;
  margin: 20% auto 10% auto;
  border: 0px solid #888;
  width: 30%; 
}
p{
 color: white;
}
a {
  color:white;
}

</style>
<script>
  function validate()
  {
   var a=document.getElementById("uname").value;
   var b=document.getElementById("psw").value;
   var regid=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
   var reg=/^[a-zA-Z0-9]{6-12}$/
   if(!regid.test(a))
   {
     alert('Invalid UserId Format');
     return false;
   }
  }
</script>
</head>
<body>
  <form class="modal-content animate" action="login.php" method="post">
    <div class="imgcontainer">
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      
      <input type="text" placeholder="Enter Phone Number" id="phone" name="phone" required>

      
      <input type="password" placeholder="Enter Password" id="psw" name="psw" required>
        
      <button type="submit" name="submit" id="submit" onclick="return validate()">Login</button>
        <p>Do not  have an account?<a href="register.php">Sign up</a>.</p>
    </div>

    
  </form>
</body>
</html>
<?php
include 'db.php';
if(isset($_POST['submit']))
{
$user = $_POST['phone'];
$pass = $_POST['psw'];
			
				
				$verify = $db->query("SELECT * FROM `customer` WHERE phone='$user' and password = '$pass';");
				
				if($verify->num_rows) {
					
					$row = $verify->fetch_assoc();
					session_start();
					$_SESSION["userid"] = $row['cus_id'];
          
                   echo '<script>window.location.href="home.php"</script>';

				}else{
					
					echo "<script>alert('Invalid login credentials. Please try again')</script>";
					
        }
      }
    
?>