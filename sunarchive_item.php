<?php
session_start();
include_once("config.php");
$type = $_GET['type'];
if (isset($_GET['id'])) {
    $inventory_id = $_GET['id'];
    $sql = "SELECT * FROM archive_inventory WHERE id = '$inventory_id'";
    $result = mysqli_query($mysqli, $sql);
    $inventory = mysqli_fetch_assoc($result);
    if ($inventory) {
        $unarchiveSql = "INSERT INTO inventory (id, item_code, equipment_name, equipment_brand, equipment_model, item_type, quantity) 
                       VALUES ('{$inventory['id']}', '{$inventory['item_code']}', '{$inventory['equipment_name']}', '{$inventory['equipment_brand']}', '{$inventory['equipment_model']}', '{$inventory['item_type']}', '{$inventory['quantity']}')";
        mysqli_query($mysqli, $unarchiveSql);
        $deleteSql = "DELETE FROM archive_inventory WHERE id = '$inventory_id'";
        mysqli_query($mysqli, $deleteSql);
        
    }
}
if ($type == 'non-consumable') {
header("Location: non_consumable.php");
exit();
} elseif ($type == 'consumable') {
header("Location: consummable.php");
}?>
