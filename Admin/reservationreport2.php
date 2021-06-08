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
  grid-template-columns: auto auto auto auto auto auto auto auto ;
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
    document.getElementById('view').style.display = "none";
    function openNav() {
      document.getElementById("mySidebar").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
    }
    
    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft= "0";
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
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method='POST'>   
    <div class="ocontainer">
      <h1>Reservation report</h1>
      <hr>
      <div id="view" style="display:block">
      <div class="grid-container">
            <div class="grid-item">id </div>
            <div class="grid-item">Name </div>
            <div class="grid-item">Phone </div>
            <div class="grid-item">Address </div>
            <div class="grid-item">Email </div>
            <div class="grid-item">No of Guest </div>
            <div class="grid-item">Date </div>
            <div class="grid-item">Time </div>
            <?php
            $date=$_POST["date"];
            $result=mysqli_query($db,"SELECT * FROM `reservation`,`customer` WHERE reservation.cus_id=customer.cus_id and date(reservation.date_res)='$date';");
            while($row=mysqli_fetch_array($result))
            {?>
                <div class="grid-item"><?php echo $row['reserve_id'];?></div>
                <div class="grid-item"><?php echo $row['name'];?></div>  
                <div class="grid-item"><?php echo $row['phone'];?></div>  
                <div class="grid-item"><?php echo $row['address'];?></div>  
                <div class="grid-item"><?php echo $row['email'];?></div>  
                <div class="grid-item"><?php echo $row['no_of_guest'];?></div>
                <div class="grid-item"><?php echo $row['date_res'];?></div>  
                <div class="grid-item"><?php echo $row['time'];?></div> 
                
           <?php }
            ?>
          </div>
        </div>
    </div>
    </div>
    
   
  </form>
  
  </body>
  </html>
 