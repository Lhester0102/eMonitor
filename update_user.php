<?php
    include_once("config.php");
    $id=$_REQUEST['id'];
    $uic=$_REQUEST['update_itemCode'];
    $uen=$_REQUEST['update_equipName'];
    $ueb=$_REQUEST['update_equipBrand'];
    $uit=$_REQUEST['update_item_type'];
    
$rs=mysqli_query($mysqli,"update account set username='$uic',password='$uen',email='$ueb',user_type='$uit' where UID='$id'");
if ($uit === "user") {
    header("Location: instructor.php");
} elseif ($uit === "supply_user") {
    header("Location: supply_officer.php");
} else {
    header("Location: admin-dashboard.php");
}


?>




