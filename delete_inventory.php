<?php
session_start();
include_once("config.php");

if (isset($_GET['id'])) {
    $inventory_id = $_GET['id'];

    $sql = "SELECT * FROM inventory WHERE id = '$inventory_id'";
    $result = mysqli_query($mysqli, $sql);
    $inventory = mysqli_fetch_assoc($result);

    if ($inventory) {
        $archiveSql = "INSERT INTO archive_inventory (id, item_code, equipment_name, equipment_brand, equipment_model, equipment_type, quantity) 
                       VALUES ('{$inventory['id']}', '{$inventory['item_code']}', '{$inventory['equipment_name']}', '{$inventory['equipment_brand']}', '{$inventory['equipment_model']}', '{$inventory['equipment_type']}', '{$inventory['quantity']}')";
        mysqli_query($mysqli, $archiveSql);

        $deleteSql = "DELETE FROM inventory WHERE id = '$inventory_id'";
        mysqli_query($mysqli, $deleteSql);

        header("Location: index.php?archive_success=1");
        exit();
    }
}
header("Location: index.php?error=1");
exit();
?>