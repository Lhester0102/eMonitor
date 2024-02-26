<?php
include_once("config.php");


$currentType = mysqli_query($mysqli, "SELECT DISTINCT item_type FROM inventory")->fetch_assoc()['item_type'];


$newType = ($currentType == 'consumable') ? 'non-consumable' : 'consumable';

mysqli_query($mysqli, "UPDATE inventory SET item_type = '$newType'");

echo "success";
?>
