<?php
session_start();
include_once("config.php");

$id = mysqli_real_escape_string($mysqli, $_REQUEST['id']);

$rs = mysqli_query($mysqli, "SELECT equipment_name FROM accept WHERE AAID='$id'");
$result = mysqli_fetch_array($rs);
$equipment_name = $result["equipment_name"];

$ty = mysqli_query($mysqli, "SELECT item_type FROM inventory WHERE equipment_name='$equipment_name'");
$type = mysqli_fetch_array($ty);
$item_type = $type["item_type"];

$deleteSql = "DELETE FROM accept WHERE AAID = '$id'";
$deleteResult = mysqli_query($mysqli, $deleteSql);

if ($item_type === "consumable") {
    header("Location: supply_item_storage.php");
    exit();
} elseif ($item_type === "non-consumable") {
    header("Location: supply_borrowed_item.php");
    exit();
}
?>
