<?php
session_start();
include_once("config.php");

if (isset($_GET['id'])) {
    $inventory_id = $_GET['id'];

    $sql = "SELECT * FROM inventory WHERE id = '$inventory_id'";
    $result = mysqli_query($mysqli, $sql);
    $inventory = mysqli_fetch_assoc($result);

    if ($inventory) {
        $archiveSql = "INSERT INTO archive_inventory (id, item_code, equipment_name, equipment_brand, equipment_model, item_type, quantity, img, Locate) 
                       VALUES ('{$inventory['id']}', '{$inventory['item_code']}', '{$inventory['equipment_name']}', '{$inventory['equipment_brand']}', '{$inventory['equipment_model']}', '{$inventory['item_type']}', '{$inventory['quantity']}', '{$inventory['img']}', '{$inventory['Locate']}')";
        mysqli_query($mysqli, $archiveSql);

        $deleteSql = "DELETE FROM inventory WHERE id = '$inventory_id'";
        mysqli_query($mysqli, $deleteSql);

        // Check if there's a referer URL
        $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
        header("Location: $referer?archive_success=1");
        exit();
    } else {
        // If the inventory item is not found, redirect back with an error message
        $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
        header("Location: $referer?error=1");
        exit();
    }
}

// If 'id' is not set, redirect back with an error message
$referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $referer?error=1");
exit();
?>
