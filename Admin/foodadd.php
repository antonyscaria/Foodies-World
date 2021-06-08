<?php 
	
	session_start();
	require "db.php";

    if(!isset($_SESSION['user'])) {
        header("location: logout.php");
    }
	
	$msg = "";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if(isset($_POST['submit']) && isset($_FILES['file'])) {
			
      $cat = htmlentities($_POST['category'], ENT_QUOTES, 'UTF-8');
      $cat1 = htmlentities($_POST['category1'], ENT_QUOTES, 'UTF-8');
      $cat2 = htmlentities($_POST['category2'], ENT_QUOTES, 'UTF-8');
			$name = htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8');
			$price = htmlentities($_POST['price'], ENT_QUOTES, 'UTF-8');
			$desc = htmlentities($_POST['desc'], ENT_QUOTES, 'UTF-8');
			$file = $_FILES['file'];
			$allowed_ext = array("jpg", "jpeg", "JPG", "JPEG", "png", "PNG");
			
			if($cat != "" && $name != "" && $price != "" && $desc != "" && empty($file) == false) {
				
				$ext = explode(".", $_FILES['file']['name']);
				
				if(in_array($ext[1], $allowed_ext)) {
					
					$check = $db->query("SELECT * FROM food WHERE food_name='".$name."' LIMIT 1");
					
					if($check->num_rows) {
						
						$msg = "<p style='color:red; padding: 10px; background: #ffeeee;'>No duplicate  food name allowed. Try again!!!</p>";
						
					}else{
						
            $insert = $db->query("INSERT INTO food(food_name, food_category, food_price, food_description,category1,category2) VALUES('".$name."', '".$cat."', '".$price."', '".$desc."', '".$cat1."', '".$cat2."')");

						
						if($insert) {
							
							$ins_id = $db->insert_id;
							
							$image_url = "../Restaurant/image/FoodPics/$ins_id.jpg";
							
							if(move_uploaded_file($_FILES['file']['tmp_name'], $image_url)) {
								
								$msg = "<p style='color:green; padding: 10px; background: #eeffee;'>Food record successfully saved</p>";
								
							}else{
								
								$msg = "<p style='color:red; padding: 10px; background: #ffeeee;'>Could not insert record, try again</p>";
								
							}
							
						}
						
					}
					
				}else{
					
					$msg = "<p style='color:red; padding: 10px; background: #ffeeee;'>Invalid image file format</p>";
					
				}
				
			}else{
				
				$msg = "<p style='color:red; padding: 10px; background: #ffeeee;'>Incomplete form data</p>";
				
			}
			
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
                                <form method="post" action="foodadd.php" enctype="multipart/form-data">
                                <div class="container">
      <h1>Add Food</h1>
      <hr>
      <?php echo $msg; ?>
      <hr>
      <select name="category"required >
    <option value="">Select food category</option>
         <?php
           $fcategory= $db->query("SELECT * FROM food_category");
            while($data=mysqli_fetch_array($fcategory))
      {
         echo"<option value='".$data['fcname']."'>".$data['fcname']."</option>";
       }
       ?>
    </select>
    <select name="category1"required >
    <option value="">Select food category</option>
         <?php
           $fcategory= $db->query("SELECT * FROM category1");
            while($data=mysqli_fetch_array($fcategory))
      {
         echo"<option value='".$data['cat1id']."'>".$data['cat1name']."</option>";
       }
       ?>
    </select>
    <select name="category2"required >
    <option value="">Select food category</option>
         <?php
           $fcategory= $db->query("SELECT * FROM category2");
            while($data=mysqli_fetch_array($fcategory))
      {
         echo"<option value='".$data['cat2id']."'>".$data['cat2name']."</option>";
       }
       ?>
    </select>
      <input type="text" name="name" id='name' placeholder="Food Name" required ><br>
      <input type="text" name="price" id='price' placeholder="Price" required ><br>
      <input type="text" name="desc" id='desc' placeholder="Description" required ><br>
      <label style="display: block; border-radius: 5px; letter-spacing: 2px; background: #fff; color: #333; padding: 10px; border: 1px solid #ccc; cursor: pointer; text-align: center; font-size: 15px; font-weight: bold;" for="file" class="file_lbl"><i style="font-weight: bold; font-size: 19px;" class="pe-7s-upload"></i>Select Image<input type="file"  style="display: none;" id="file" name="file" required /></label>
      <input type="submit" class="registerbtn" name="submit" id="submit"  onclick="return valdate2()" value="Add">
    </div>
</div>


</body>

</html>
