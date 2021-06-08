<?php 
	
	session_start();
	require "db.php";

    if(!isset($_SESSION['user'])) {
        header("location: logout.php");
    }
	
	$msg = "";
        if(isset($_POST['submit'])) 
        {
			$name = htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8');
            if( $name != "") 
            {
					$check = $db->query("SELECT * FROM category2 WHERE cat2name='".$name."' LIMIT 1");
					
					if($check->num_rows) {
						
						$msg = "<p style='color:red; padding: 10px; background: #ffeeee;'>No duplicate  food name allowed. Try again!!!</p>";
						
					}else{
						
						$insert = $db->query("INSERT INTO category2(cat2name) VALUES('".$name."')");
						
						if($insert) {
							
								$msg = "<p style='color:green; padding: 10px; background: #eeffee;'>Food record successfully saved</p>";
								
							}else{
								
								$msg = "<p style='color:red; padding: 10px; background: #ffeeee;'>Could not insert record, try again</p>";
								
							}
							
						
						
					}
					
				}else{
					
					$msg = "<p style='color:red; padding: 10px; background: #ffeeee;'>Aleady Exist</p>";
					
				}
				
            }
        
        
    
	
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
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
  grid-template-columns: auto auto auto ;
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
                                <form method="post" action="addsubcat.php" enctype="multipart/form-data">
                                <div class="container">
      <h1>Add Food</h1>
      <hr>
      <?php echo $msg; ?>
      <hr>
      <input type="text" name="name" id='name' placeholder="category Name" required ><br>
      <input type="submit" class="registerbtn" name="submit" id="submit"  onclick="return valdate2()" value="Add">
    </div>
</div>


</body>

</html