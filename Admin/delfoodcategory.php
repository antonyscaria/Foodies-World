<?php
 include 'db.php';
$id=$_GET['fid'];
$sql3="DELETE FROM `food_category` WHERE `fcid`=$id";
mysqli_query($db,$sql3);
        header("Location:foodcategory.php");
        ?>