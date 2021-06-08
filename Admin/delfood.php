<?php
 include 'db.php';
$id=$_GET['uid'];
echo $id;
$sql3="DELETE FROM `food` WHERE `id`=$id";
mysqli_query($db,$sql3);
        header("Location:foodlist.php");
        ?>