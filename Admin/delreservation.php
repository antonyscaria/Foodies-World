<?php
 include 'db.php';
$id=$_GET['uid'];
$sql3="DELETE FROM `reservation` WHERE `reserve_id`=$id";
mysqli_query($db,$sql3);
        header("Location:reservation.php");
        ?>