<?php
session_start();
require "db.php";
if(!isset($_SESSION['userid'])) {
  header("location:logout.php");
}
$msg="";
$cus_id=$_SESSION['userid'];
$sql="SELECT `email`,`phone` FROM `customer` WHERE `cus_id`='$cus_id'";
$result=$db->query($sql);
$row=$result->fetch_assoc();



$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  if(isset($_POST['submit'])) {
    
    $guest = preg_replace("#[^0-9]#", "", $_POST['guest']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = preg_replace("#[^0-9]#", "", $_POST['phone']);
    $date_res = htmlentities($_POST['date_res'], ENT_QUOTES, 'UTF-8');
    $time = htmlentities($_POST['time'], ENT_QUOTES, 'UTF-8');
    $suggestions = htmlentities($_POST['suggestions'], ENT_QUOTES, 'UTF-8');
    echo $guest;
    if($guest != "" && $email && $phone != "" && $date_res != "" && $time != "" && $suggestions != "") {
      
      //Check for remaining table space;
      $table_array = array();
      $mtime = strftime("%H", time());
      $mdate = strftime("%Y-%m-%d", time());
      $get_table_count = $db->query("SELECT tcount FROM tablecount");
      $row_count = $get_table_count->fetch_assoc();
      $table_count = $row_count['tcount'];
      $fetch = $db->query("SELECT * FROM reservation");
        $cus_id=$_SESSION['userid'];
      if($fetch->num_rows) {
        while($row_fetch = $fetch->fetch_assoc()) {
          if(($row_fetch['date_res'] >= $mdate) && ($row_fetch['time'] >= $mtime)) {
            $table_array[] = $row_fetch['reserve_id'];
          }
        }
      }
      echo(count($table_array));
      if(count($table_array) < $table_count) {
        $check = $db->query("SELECT * FROM reservation WHERE no_of_guest='".$guest."' AND email='".$email."' AND phone='".$phone."' AND date_res='".$date_res."' AND time='".$time."' LIMIT 1");
        
        if($check->num_rows) {
          
          $msg = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>You have already placed a reservation with the same information</p>";
          
        }else{
          
          $insert = $db->query("INSERT INTO reservation(no_of_guest, email, phone, date_res, time, suggestions,cus_id) VALUES('".$guest."', '".$email."', '".$phone."', '".$date_res."', '".$time."', '".$suggestions."', '".$cus_id."')");
          
          if($insert) {
            
            $ins_id = $db->insert_id;
            
            $reserve_code = "UNIQUE_$ins_id".substr($phone, 3, 8);
            
            $msg = "<p style='padding: 15px; color: green; background: #eeffee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>Reservation placed successfully. Your reservation code is $reserve_code. Please Note thatyour reservation expires after One hour</p>";
            
          }else{
            
            $msg = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>Could not place reservation. Please try again</p>";
            
          }
          
        }
      }else{
        
        $msg = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>No table space available.Please check back after one hour</p>";
        
      }
      
    }else{
      
      $msg = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>Incomplete form data or Invalid data type</p>";
      
      //print_r($_POST);
      
    }
    
  }
  
}

?>
	
?>
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
#main {
  transition: margin-left .5s;
  padding: 16px;
}
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
</style>
<script>
    function openNav() {
      document.getElementById("mySidebar").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
    }
    
    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft= "0";
    }
    function valdate2()
    {
      
    }
    </script>
</head>
<body>
<div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="home.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="tablereservation.php">Table Reservation</a>
        <a href="logout.php">Log Out</a>
      
      
      </div>
      
      <div id="main">
        <button class="openbtn" onclick="openNav()">☰</button>  
      </div>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
  <div class="container">
    <h1>Table Reservation</h1>
    <p>Please fill in this form reserve a table.</p>
    <hr>
    <?php echo "<br/>".$msg; ?>
    <hr>
					<input type="number" placeholder="How many guests" min="1" name="guest" id="guest" required>
		
					<input type="email" name="email" placeholder="Enter your email" value="<?php echo $row["email"];?>" required>
	
					<input type="text" name="phone" placeholder="Enter your phone number" value="<?php echo $row["phone"];?>"  required>
					<input type="date" name="date_res" placeholder="Select date for booking" required>
			
					<input type="time" name="time" placeholder="Select time for booking" required>
					
					<textarea name="suggestions" placeholder="your suggestions" required></textarea>
					
					
					<input type="submit" class="registerbtn" name="submit" id="submit" value="MAKE YOUR BOOKING" />
					
  </div>
</form>
</body>
</html>