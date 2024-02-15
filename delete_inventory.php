<?php
session_start();
include_once("config.php");

if (isset($_GET['id'])) {
    $inventory_id = $_GET['id'];

    // Retrieve the inventory information from the database
    $sql = "SELECT * FROM inventory WHERE id = '$inventory_id'";
    $result = mysqli_query($mysqli, $sql);
    $inventory = mysqli_fetch_assoc($result);

    if ($inventory) {
        // Move the inventory information to an archive table
        $archiveSql = "INSERT INTO archive_inventory (id, item_code, equipment_name, equipment_brand, equipment_model, equipment_type, quantity, borrow_id, date_request, date_return, reason) 
                       VALUES ('{$inventory['id']}', '{$inventory['item_code']}', '{$inventory['equipment_name']}', '{$inventory['equipment_brand']}', '{$inventory['equipment_model']}', '{$inventory['equipment_type']}', '{$inventory['quantity']}', '{$inventory['borrow_id']}', '{$inventory['date_request']}', '{$inventory['date_return']}', '{$inventory['reason']}')";
        mysqli_query($mysqli, $archiveSql);

        // Delete the inventory from the main table
        $deleteSql = "DELETE FROM inventory WHERE id = '$inventory_id'";
        mysqli_query($mysqli, $deleteSql);

        // Redirect to the main page with a success message
        header("Location: index.php?archive_success=1");
        exit();
    }
}

// If the inventory ID is not provided or the inventory doesn't exist, redirect to the main page with an error message
header("Location: index.php?error=1");
exit();
?>