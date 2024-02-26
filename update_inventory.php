<?php
    include_once("config.php");
    $id=$_REQUEST['id'];
    $uic=$_REQUEST['update_itemCode'];
    $uen=$_REQUEST['update_equipName'];
    $ueb=$_REQUEST['update_equipBrand'];
    $uem=$_REQUEST['update_equipModel'];
    $uet=$_REQUEST['update_equipType'];
    $uqt=$_REQUEST['update_quantity'];
    $ubn=$_REQUEST['update_borrow_no'];
    $uit=$_REQUEST['update_item_type'];
    $rs=mysqli_query($mysqli,"update inventory set item_code='$uic',equipment_name='$uen',equipment_brand='$ueb',equipment_model='$uem',equipment_type='$uet',quantity='$uqt',borrow_no='$ubn',item_type='$uit' where id='$id'");
    header("Location:index.php");
?>