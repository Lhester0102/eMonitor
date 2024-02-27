<?php 

include_once("config.php");



    $useless=$_REQUEST['useless'];
    $item_code=$_REQUEST['item_code'];

    $rs = mysqli_query($mysqli, "UPDATE inventory SET quantity = quantity + 1, borrow_no = borrow_no - 1 WHERE id = '$item_code'");
    
    $deleteSql = "DELETE FROM borrowed_item WHERE useless = '$useless'";
    $deleteResult = mysqli_query($mysqli, $deleteSql);
    header("Location: borrowed_items.php");


?>