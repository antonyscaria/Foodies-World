<?php
include 'db.php';
session_start();
if(!isset($_SESSION['user'])) {
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
.ocontainer {
    float: center;
    margin-top: 10%;
    margin-right: auto;
    margin-left: auto;
    margin-bottom: auto;
    width: auto;
    height: auto;
  padding: 16px;
  background-color: white;
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
  grid-template-columns: auto auto auto auto auto auto auto auto auto auto auto auto;
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
    <div class="ocontainer">
      <h1>Order List</h1>
      <hr>
      <div id="view">
      <div class="grid-container">
            <div class="grid-item">id </div>
            <div class="grid-item">Name </div>
            <div class="grid-item">Phone </div>
            <div class="grid-item">Address </div>
            <div class="grid-item">Email </div>
            <div class="grid-item">Date </div>
            <div class="grid-item">Food </div>
            <div class="grid-item">Qty </div>
            <div class="grid-item">Price </div>
            <div class="grid-item">Payment </div>
            <div class="grid-item">Status </div>
             <div class="grid-item">Action</div>

            <?php
            $x=1;
             $result=mysqli_query($db,"SELECT * FROM `basket`,`items` WHERE basket.id=items.order_id and basket.status='pending';");
            while($row=mysqli_fetch_array($result))
            {?>
               <div class="grid-item"><?php echo $x;?></div>
                <div class="grid-item"><?php echo $row['customer_name'];?></div>  
                <div class="grid-item"><?php echo $row['contact_number'];?></div>  
                <div class="grid-item"><?php echo $row['address'];?></div>  
                <div class="grid-item"><?php echo $row['email'];?></div>  
                <div class="grid-item"><?php echo $row['date_made'];?></div>  
                <div class="grid-item"><?php echo $row['food'];?></div>  
                <div class="grid-item"><?php echo $row['qty'];?></div>  
                <div class="grid-item"><?php echo $row['total'];?></div>  
                <div class="grid-item"><?php echo $row['payment'];?></div>  
                <div class="grid-item"><?php echo $row['status'];?></div>  
                <div class="grid-item"><button type="button"  name ="confirm" value="Confirm" class="registerbtn"onclick="location.href='orderupdate.php?uid=<?php echo $row['id'];?>;'">Confirm</button></div>    
           <?php  $x=$x+1;}
            ?>
          </div>
        </div>
    </div>
    
   
  </form>
  
  </body>
  </html>