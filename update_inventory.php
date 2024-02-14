<?php
    include_once("config.php");
    $id=$_REQUEST['id'];
    $uic=$_REQUEST['update_itemCode'];
    $uen=$_REQUEST['update_equipName'];
    $ueb=$_REQUEST['update_equipBrand'];
    $uem=$_REQUEST['update_equipModel'];
    $uet=$_REQUEST['update_equipType'];
    $uqt=$_REQUEST['update_quantity'];
    $ubi=$_REQUEST['update_borrowId'];
    $udq=$_REQUEST['update_dateRequest'];
    $udr=$_REQUEST['update_dateReturn'];
    $urs=$_REQUEST['update_reaSon'];
    $rs=mysqli_query($mysqli,"update inventory set item_code='$uic',equipment_name='$uen',equipment_brand='$ueb',equipment_model='$uem',equipment_type='$uet',quantity='$uqt',borrow_id='$ubi',date_request='$udq',date_return='$udr',reason='$urs' where id='$id'");
    header("Location:index.php");
?>