<?php
 include 'db.php';
$id=$_GET['uid'];
$sql3="UPDATE `basket` SET `status`='confirmed' WHERE `id`=$id";
mysqli_query($db,$sql3);
        header("Location:orders.php");
        ?>