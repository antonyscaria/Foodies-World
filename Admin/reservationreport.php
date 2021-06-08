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
  grid-template-columns: auto auto auto auto auto auto auto auto auto auto auto ;
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
    function valdate2()
    {
      var b=document.getElementById("date").value;
      var d=new Date(); 
      if(!d>b)
      {
        alert('Invalid date');
        return false;
      } 
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
    <form action="reservationreport2.php" method='POST'>   
    <div class="ocontainer">
      <h1>Reservation Report</h1>
      <hr>
      <input type="date" name="date" id='date' placeholder="Enter Date" required ><br>
      <input type="submit" class="registerbtn" name="submit"  onclick="return validate2()" value="Generate">
          </div>
        </div>
    </div>
    </div>
    
   
  </form>
  
  </body>
  </html>