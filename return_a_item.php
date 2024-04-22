<?php 
include_once("config.php");
$id = $_GET['id'];
$iid = $_GET['iid'];
$use = $_GET['use'];

$resultInventory = mysqli_query($mysqli, "SELECT * FROM inventory WHERE id = $iid");
$resultRequest = mysqli_query($mysqli, "SELECT * FROM borrowed_item WHERE useless = $id");

$rowRequest = mysqli_fetch_assoc($resultRequest);

$borrowed_amount = $rowRequest['borrowed_amount'];

mysqli_query($mysqli, "DELETE FROM borrowed_item WHERE useless = $id");
mysqli_query($mysqli, "UPDATE inventory SET quantity = quantity + $borrowed_amount WHERE id = $iid");

if ($use == 'a') {
    header("Location: borrowed_items.php");
} elseif ($use == 'i') {
    header("Location: borrowed_item.php");
} elseif ($use == 's') {
    header("Location: borrowed_itemss.php");
} else {
    header("Location: log_in.php");
}
?>
