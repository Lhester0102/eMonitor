<?php
session_start();
include_once("config.php");

if (isset($_GET['id'])) {
    $inventory_id = $_GET['id'];

    // Delete the inventory from the archive table
    $deleteSql = "DELETE FROM archive_inventory WHERE id = '$inventory_id'";
    $result = mysqli_query($mysqli, $deleteSql);

    if ($result) {
        // Redirect to the main page with a success message
        header("Location: unarchive.php?delete_success=1");
        exit();
    } else {
        // If deletion fails, redirect with an error message
        header("Location: unarchive.php?delete_error=1");
        exit();
    }
}

// If the inventory ID is not provided, redirect with an error message
header("Location: unarchive.php?error=1");
exit();
?>