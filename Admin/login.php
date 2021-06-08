<?php
include 'db.php';
if(isset($_POST['submit'])) 
{
$user = $_POST['username'];
$pass = $_POST['psw'];
			
				
				$verify = $db->query("SELECT * FROM `admin` WHERE username='$user' and password = '$pass';");
				
				if($verify->num_rows) {
					
					$row = $verify->fetch_assoc();
					session_start();
					$_SESSION["user"] = $row['username'];
          
                    echo '<script>window.location.href="foodlist.php"</script>';
					
				}else{
					
					echo "<script>alert('Invalid login credentials. Please try again')</script>";
					
				}
      }
    
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
 <style>
body {
  font-family: Arial, Helvetica, sans-serif; 
  position: relative;
  background-image:url(res3.jpg);
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
.registerbtn {
  background-color:  rgb(30, 171, 86);
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
text-align: center;
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
</style>
<script>
  function validate()
  {
   var a=document.getElementById("username").value;
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
  <form class="modal-content animate" action="" method='POST'>
    <div class="imgcontainer">
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      
      <input type="text" placeholder="Enter Username" id="username" name="username" required>

      
      <input type="password" placeholder="Enter Password" id="psw" name="psw" required>
        
      <input type="submit" class="registerbtn" name="submit" id="submit"  onclick="return valdate()" value="login">
    </div>

    
  </form>
</body>
</html>
