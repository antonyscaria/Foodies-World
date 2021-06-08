<?php 
	require "db.php";
	session_start();
	
	if(!isset($_SESSION['userid'])) {
       header("location:logout.php");
    }

$cus_id=$_SESSION['userid'];
	$sql="SELECT * FROM `customer` WHERE `cus_id`='$cus_id'";
	$result=$db->query($sql);
	$row=$result->fetch_assoc();
	if (isset($_GET['fid']) && isset($_GET['qty'])) {
		$fid = $_GET['fid'];
		$qty = isset($_GET['qty']) ? (int)$_GET['qty'] : 1;

		$wasFound = false;
		$i = 0;
		
		if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) { 
			
			$_SESSION["cart_array"] = array(0 => array("item_id" => $fid, "quantity" => $qty));
		} else {
			
			$qty = isset($_GET['qty']) ? (int)$_GET['qty'] : 1;
			
			
			foreach ($_SESSION["cart_array"] as $each_item) { 
				  $i++;
				  while (list($key, $value) = each($each_item)) {
					  if ($key == "item_id" && $value == $fid) {
						  
						  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $fid, "quantity" => $each_item['quantity'] + $qty)));
						  $wasFound = true;
					  } 
				  } 
			   } 
			   if ($wasFound == false) {
				   array_push($_SESSION["cart_array"], array("item_id" => $fid, "quantity" => $qty));
			   }
		}
		header("location: cart.php"); 
		exit();
	}
	
?>

<?php
 

	if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
		unset($_SESSION["cart_array"]);
	}
	
?>



<?php 

	
	if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "") {
		$key_to_remove = $_POST['index_to_remove'];
		if (count($_SESSION["cart_array"]) <= 1) {
			unset($_SESSION["cart_array"]);
		} else {
			unset($_SESSION["cart_array"]["$key_to_remove"]);
			sort($_SESSION["cart_array"]);
		}
	}
	
?>

<?php 

	
	$cartOutput = "";
	$cartTotal = "0";
	$chkbtn = "";
	$empty_cart = "";
	$chkprice = "";
	$product_id_array = "";
	
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
		
		$cartOutput = "<h3 style=' text-align: center; font-weight: lighter; padding: 10px 0px; background: #ffeeee; color: #333;'>Your shopping basket is empty</h3>";
		
	}else{
		
		$cartOutput = "<div class='single_order_head'>
				
							<h3>Food</h3>
							<h3>Price(N)</h3>
							<h3>Qty</h3>
							<h3>Total</h3>
							<h3>Remove</h3>
							
						</div>";
						
		
		$i = 0;
		
		foreach ($_SESSION["cart_array"] as $each_item) { 
			$item_id = $each_item['item_id'];
			$sql = $db->query("SELECT * FROM food WHERE id='$item_id' LIMIT 1");
			while ($row = $sql->fetch_assoc()) {
				
				$foodName = $row['food_name'];
				$price = $row['food_price'];
				
			}
			$pricetotal = $price * $each_item['quantity'];
			$cartTotal = $pricetotal + $cartTotal;
			$Totalamount=$cartTotal;
			$_SESSION['Tamount']=$Totalamount;
		
			$x = $i + 1;
			
			$empty_cart = '<div class="empty_cart">
				
								<a href="cart.php?cmd=emptycart">Empty Basket</a>
								
							</div>';
			
			
			$product_id_array .= "$foodName-".$each_item['quantity'].", "; 
			
			$cartOutput .= '<form style="display: inline; padding: 0; margin: 0;" action="cart.php" method="post">
			
				<div class="single_order">
					
					<p>' . $foodName . '</p>
					<p>' . $price . '</p>
					<p>'.$each_item['quantity'].'</p>
					<p id="ajax_qty_'.$item_id.'">'.$pricetotal.'</p>
					<p><input name="deleteBtn' . $item_id . '" class="remove" onclick="return verify_choice();" type="submit" value="x" /><input name="index_to_remove" type="hidden" value="' . $i . '" /></p>
					
				</div>
			
			</form>';
			
			$chkprice .= '<input type="hidden" id="chkprice" name="chkprice" value="'.$cartTotal.'" />';
			$chkfood = '<input type="hidden" id="chkfood" name="chkfood" value="'.$product_id_array.'" />';
				
			$i++; 
		}
		
		$cartTotal = '<p class="p_total"><span>Basket Total</span> : #'.$cartTotal.'</p>';
		
	}
	function render_options($qty, $id) {
		
		$option = "";
		
		for($x = 1; $x <= 50; $x++) {
			
			if($x == $qty) {
				
				$option .= "<option value='".$x."_".$id."' selected>$x</option>";
				
			}else{
				
				$option .= "<option value='".$x."_".$id."'>$x</option>";
				
			}
			
		}
		
		return $option;
		
	}

	
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="project.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
	function validate_input() {
	
	cname = $("#name").val();
	caddr = $("#addr").val();
	cemail = $("#email").val();
	cphone = $("#phone").val();
	cfood = $("#chkfood").val();
	cprice = $("#chkprice").val();
	
	if(cname != "" && caddr != "" && cemail != "" && cphone != "") {
		
		$.ajax({
			url: 'process_order.php',
			type: 'post',
			data: {order_info: 'info', name: cname, addr: caddr, email: cemail, phone: cphone, food: cfood, price: cprice},
			success: function(data) {
				
				if(data == 'success') {
					
					window.location = "paymeny.php";
					
				}else{
					
					alert(data);
					
				}
				
			}
		});
		
	}else{
		
		alert('Incomplete form data');
		
	}
	
}
function verify_choice() {
	
	return confirm("Are you sure you want to remove this item from the cart?");
	
}
function openNav() {
      document.getElementById("mySidebar").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
    }
    
    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft= "0";
    }

	</script>
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
div.order_holder {
	padding: 10px;
}

div.single_order_head, div.single_order {
	border-bottom: 1px solid #ccc;
}

div.single_order_head h3 {
	display: inline-block;
	width: 18%;
	font-size: 18px;
	font-weight: 100;
	text-align: center;
	padding: 5px 0px;
}

div.single_order p {
	display: inline-block;
	width: 18%;
	text-align: center;
	padding: 5px 0px;
}

div.single_order p input[type=number] {
	text-align: center;
	border: none;
	border-radius: 0px;
	background: #fff;
}

input.remove {
	border: 1px solid #FF002A;
	background: #FF002A;
	color: #fff;
	padding: 0px 5px 1px 5px;
	font-weight: bold;
	border-radius: 2px;
	cursor: pointer;
}

div.checkout_section {
	padding: 10px;
	height: auto;
}

p.p_total {
	text-align: right;
	padding-right: 30px;
}

p.p_total span {
	color: #333;
	text-transform: uppercase;
	letter-spacing: 2px;
	font-weight: bold;
}

div.empty_cart {
	width: 48%;
	float: left;
	height: auto;
	padding: 10px 0px;
	background: red;
	text-align: center;
}

div.checkout {
	width: 48%;
	float: right;
	height: auto;
	padding: 10px 0px;
	background: green;
}
div.single_order {
		font-size: 14px;
	}
	
	p.p_total span {
		font-size: 15px;
	}

	div.empty_cart {
		padding: 7px 0px;
	}

	div.checkout {
		padding: 7px 0px;
	}

	div.checkout a, div.empty_cart a {
		font-size: 15px;
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
<form action="cart.php" method='POST'>
  <div class="ocontainer">
    <h1>Cart</h1>
    <hr>
    <div>
	<div class="order_holder">
			
			<?php echo $cartOutput; ?>
			
		</div>
		
		<?php echo $cartTotal; ?>
		
		<div class="checkout_section">
			
			<?php echo $empty_cart; ?>
			
			<?php echo $chkbtn; ?>
			
		</div>		
					
    
  </div>
</form>
		<?php
		$cus_id=$_SESSION['userid'];
	$sql="SELECT * FROM `customer` WHERE `cus_id`='$cus_id'";
	$result=$db->query($sql);
	$row=$result->fetch_assoc();
		?>
			
<form method="post" action="process_order.php"  onSubmit="validate_input() return false">
  <div class="container">
    <h1>Delivery Details</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <input type="text" id="name" name="name" placeholder="Enter your full name" value="<?php echo $row["name"];?>" required>
	<input type="text" id="addr"  name="addr" placeholder="Enter your address" value="<?php echo $row["address"];?>" required>
	<input type="Email" id="email" name="email" placeholder="Enter your email" value="<?php echo $row["email"];?>" required>
	<input type="text" id="phone" name="phone" placeholder="Enter your phone number"value="<?php echo $row["phone"];?>" required>	
	<?php echo $chkfood; ?>			
	<?php echo $chkprice; ?>
    <hr>
    <input type="submit" class= "registerbtn" value="PLACE ORDER"  />
      </div>
  </div>
</form>
</body>
</html>
