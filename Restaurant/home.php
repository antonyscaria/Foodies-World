<?php
session_start();
	require "db.php";
  if(!isset($_SESSION['userid'])) {
    header("location:logout.php");
}?>
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
}#main {
  transition: margin-left .5s;
  padding: 16px;
}
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
.grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto auto auto auto ;
  background-color: rgb(249, 249, 250);
  padding: 5px;
}
.grid-item {
  background-color: rgba(255, 255, 255, 0.8);
  border: 0px solid rgba(0, 0, 0, 0.8);
  padding: 5px;
  font-size: 20px; 
  text-align: center;
}
.label{
    size:15px;
    text-decoration-color: rgb(22, 87, 152);
}
.text{
    width:40% !important;
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
<form action="home.php" method='POST'>
  <div class="container">
  <button type="button"  name ="acart" value="Cart" class="registerbtn"onclick="location.href='tablereservation.php'">BOOK A TABLE</button>
    <hr>
    <div id="view">
      <div class="grid-container">
            <?php
             $result=mysqli_query($db,"SELECT * FROM food,category2,category1 WHERE category1=category1.cat1id and category2=category2.cat2id;");

            while($row=mysqli_fetch_array($result))
            { $id=$row['id'];
                $resultpic="<a href='fdetails.php?fid=".$row['id']."'><img src='image/FoodPics/".$row['id'].".jpg' width='80px' height='80px' /></a>";
                ?>
            
                <div class="grid-item"><?php echo  $resultpic ?></div>
                <div class="grid-item"><?php echo $row['food_name'];?></div>  
                <div class="grid-item"><?php echo $row['food_category'];?></div>  
                <div class="grid-item"><?php echo $row['food_price'];?></div>  
                <div class="grid-item"><?php echo $row['cat2name'];?></div> 
                <div class="grid-item"><?php echo $row['cat1name'];?></div> 
                <div class="grid-item"><button type="button"  name ="acart" value="Cart" class="registerbtn"onclick="location.href='fdetails.php?fid=<?php echo $id ?>;'">View</button></div>       
           <?php }
            ?>
          </div>
        </div>
      </div>
  </div>
</form>
</body>
</html>