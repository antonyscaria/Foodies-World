<?php
include 'db.php';
session_start();
if(!isset($_SESSION['user'])) 
{
  header("location: logout.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="project.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
/* Set a style for the submit button */
.registerbtn {
  background-color: rgb(30, 171, 86);
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
  margin: 1px;
}
#main {
  transition: margin-left .5s;
  padding: 16px;
}
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
.grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto auto ;
  background-color: rgb(249, 249, 250);
  padding: 5px;
}
.grid-item {
  background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.8);
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
</head>
<body>
    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="foodlist.php">Food List</a>
        <a href="foodcategory.php">Add Food Category</a>
        <a href="addsubcat.php">Add Food Sub Category</a> 
        <a href="foodadd.php">Add Food</a>
        <a href="foodupdate.php">Update Food</a>
        <a href="orders.php">Orders</a>
        <a href="reservation.php">Table Reservations</a>
        <a href="orderreport.php">Order Report</a>
        <a href="reservationreport.php">Reservation Report</a>
        <a href="customerlist.php">Customer List</a>
        <a href="logout.php">Log Out</a>
      
      
      </div>
      
      <div id="main">
        <button class="openbtn" onclick="openNav()">☰</button>  
      </div>
    <form action="#" method='POST'>   
    <div class="container">
      <h1>Food List</h1>
      <hr>
      <div id="view">
      <div class="grid-container">
            <div class="grid-item">id </div>
            <div class="grid-item">Name </div>
            <div class="grid-item">Category </div>
            <div class="grid-item">Price </div>
            <div class="grid-item">Action</div>

            <?php
            $x=1;
             $result=mysqli_query($db,"SELECT * FROM `food`;");
            while($row=mysqli_fetch_array($result))
            {?>
                <div class="grid-item"><?php echo $x;?></div>
                <div class="grid-item"><?php echo $row['food_name'];?></div>  
                <div class="grid-item"><?php echo $row['food_category'];?></div>  
                <div class="grid-item"><?php echo $row['food_price'];?></div>  
                <div class="grid-item"><button type="button"  name ="delete" value="delete" class="registerbtn"onclick="location.href='delfood.php?uid=<?php echo $row['id']?>;'">Delete</button></div>    
           <?php $x=$x+1;}
            ?>
          </div>
        </div>
    </div>
    
   
  </form>
  
  </body>
  </html>