<?php 
	
	session_start();
	require "db.php";
	if(!isset($_SESSION['userid'])) 
	{
		header("location:logout.php");
	 }
	$name = "";
	$desc = "";
	$category = "";
	$price = "";
	$id = "";
	
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		
		if(isset($_GET['fid']) && preg_replace("#[^0-9]#", "", $_GET['fid']) != "") {
			
			$fid = preg_replace("#[^0-9]#", "", $_GET['fid']);
			
			if($fid != "") {
				
				$get_detail = $db->query("SELECT * FROM food WHERE id='".$fid."' LIMIT 1");
				
				if($get_detail->num_rows) {
					
					while($row = $get_detail->fetch_assoc()) {
						
						$id = $row['id'];
						$name = $row['food_name'];
						$desc = $row['food_description'];
						$cat  = $row['food_category'];
						$price  = $row['food_price'];
						
					}
					
				}else{
					
					header("location: home.php");
					
				}
				
			}
			
		}else{
			
			header("location: home.php");
			
		}
		
	}elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if(isset($_POST['submit'])) {
			
			$id = preg_replace("#[^0-9]#", "", $_POST['fid']);
			$qty = preg_replace("#[^0-9]#", "", $_POST['amount']);
			
			header("location:cart.php?fid=".$id."&qty=".$qty."");
			
		}
		
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
  background-color:  rgb(30, 171, 86);
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}
.subtract{
    background-color:  rgb(30, 171, 86);
  color: white;
  padding: 0px 15px 6px 15px;
	display: inline-block;
	margin-top: 1px;
	font-size: 20px;
	border-radius: 4px;
	cursor: pointer;
}
.add{
    background-color:  rgb(30, 171, 86);
  color: white;
  padding: 0px 15px 6px 15px;
	display: inline-block;
	margin-top: 1px;
	font-size: 20px;
	border-radius: 4px;
	cursor: pointer;
}
</style>

</head>
<body>
<form action="fdetails.php" method='POST'>
  <div class="container">
    <h1>FOOD DETAILS</h1>
    <hr>
    <div>
				
					<img src="image/FoodPics/<?php echo $id;?>.jpg" width="100%" alt="no image found" />
					
				</div>
    <h3 ><?php echo $name; ?></h3>
						<p><?php echo $desc; ?> </p>
						<p>Category:<input readonly type="label" id="category" name="category" value="<?php echo $cat; ?>"></p>
                        <p>Price:<input readonly type="label" id="price" name="price" value="<?php echo $price; ?>"></p>
						<div>
							
							<p>Quantity:</p>
                            <p><button type="button"  name ="substract" class="subtract" onclick="decreaseValue()">-</button>
                            <input readonly type="text" id="amount" name="amount" value="1">
                            <button type="button"  name ="add" class="add" onclick="increaseValue()">+</button><p>
							
						</div>
						
						<p>Total Price:<input readonly type="label" id="totalprice" name="totalprice" value="<?php echo $price; ?>"></p>
						
						<div>
							<input type="hidden" name="fid" value="<?php echo $id; ?>">
							<input type="submit" name="submit"  class="registerbtn" value="Add to Order" />
    <hr>
      </div>
  </div>
</form>
</body>
</html>
<script>
    function increaseValue() {
  var value = parseInt(document.getElementById('amount').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById('amount').value = value;
  var price = parseInt(document.getElementById('price').value, 10);
  var totalprice= price * value;
  document.getElementById('totalprice').value = totalprice;


}

function decreaseValue() {
  var value = parseInt(document.getElementById('amount').value, 10);
  value = isNaN(value) ? 0 : value;
  value < 1 ? value = 1 : '';
  value--;
  document.getElementById('amount').value = value;
  var price = parseInt(document.getElementById('price').value, 10);
  var totalprice= price * value;
  document.getElementById('totalprice').value = totalprice;

}
	
</script>