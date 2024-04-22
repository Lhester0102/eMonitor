<?php
session_start();
include_once("config.php");
$type = $_GET['type'];

if (isset($_GET['id'])) {
    $inventory_id = $_GET['id'];

    $deleteSql = "DELETE FROM archive_inventory WHERE id = '$inventory_id'";
    $result = mysqli_query($mysqli, $deleteSql);

}
if ($type == 'non-consumable') {
header("Location: non_consumable.php");
exit();
} elseif ($type == 'consumable') {
header("Location: consumable.php");
}


?>