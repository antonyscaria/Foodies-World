<?php 
	
	session_start();
	require "db.php";
	if(!isset($_SESSION['userid'])) {
        header("location:logout.php");
    }
		$msg = "";
	$Totalamount=$_SESSION['Tamount'];
	$orderid=$_SESSION['orderid'];
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if(isset($_POST['submit'])) {
			
			$cardno = $_POST['cardno'];
			$expiry = $_POST['expiry'];
			$hname = $_POST['hname'];
			$cvv = $_POST['cvv'];
			$pay="paid";
			
			
			if($cardno != "" && $expiry != "" && $hname != "" && $cvv!= "" ) {
				
				$sql="UPDATE `basket` SET `payment`='$pay' WHERE `id`='$orderid'";
				if($db->query($sql)== TRUE)
				{
					header("location: summary.php"); 
				}
				else{
					$msg = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>Invalid Payment Details!</p>";
				}
				
				
			}else{
				
				$msg = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>Incomplete form data or Invalid data type</p>";
				
				//print_r($_POST);
				
			}
			
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
</style>
</head>
<body>
<form action="payment.php" method='POST'>
  <div class="container">
    <h1>Payment</h1>
    <p>Please fill in this form to complete your payment.</p>
    <hr>
    <?php echo "<br/>".$msg; ?>
    <hr>
    <input type="text" name="amount" placeholder="Amount" value="<?php echo $Totalamount ?>"   readonly>
    <input type="text" name="cardno" placeholder="Card Number" maxlength="16"   required>
	<label>Expires</label>
    <input type="month" name="expiry" placeholder="MM/YYYY"  required>
    <input type="text" name="hname" placeholder="Card holders name "  required>
    <input type="password" name="cvv" placeholder="CVV" maxlength="3"  required>
    <hr>
    <input type="submit" class="registerbtn" name="submit" value="Pay <?php echo "Rs". $Totalamount?>"/>
    </div>
  </div>
</form>
</body>
</html>