<?php
session_start();
include_once("config.php");

if (isset($_GET['id'])) {
    $inventory_id = $_GET['id'];
    
    // Retrieve item from archive
    $sql = "SELECT * FROM archive_merch WHERE amid = '$inventory_id'";
    $result = mysqli_query($mysqli, $sql);

    if ($result) {
        $merch = mysqli_fetch_assoc($result);
        
        if ($merch) {
            // Unarchive the item
            $unarchiveSql = "INSERT INTO merch (mid, name, barcode, quantity, measurement, image) 
                           VALUES ('{$merch['mid']}', '{$merch['name']}', '{$merch['barcode']}', '{$merch['quantity']}', '{$merch['measurement']}', '{$merch['image']}')";
            $unarchiveResult = mysqli_query($mysqli, $unarchiveSql);

            if ($unarchiveResult) {
                // Delete the item from the archive
                $deleteSql = "DELETE FROM archive_merch WHERE amid = '$inventory_id'";
                $deleteResult = mysqli_query($mysqli, $deleteSql);

                if ($deleteResult) {
                    // Redirect with success message
                    header("Location: unarchive_merch.php?unarchive_success=1");
                    exit();
                } else {
                    // Log deletion error
                    error_log("Error deleting item from archive: " . mysqli_error($mysqli));
                    header("Location: unarchive_merch.php?error=1");
                    exit();
                }
            } else {
                // Log unarchive error
                error_log("Error unarchiving item: " . mysqli_error($mysqli));
                header("Location: unarchive_merch.php?error=1");
                exit();
            }
        } else {
            // Item not found in archive
            header("Location: unarchive_merch.php?error=2");
            exit();
        }
    } else {
        // SQL query error
        error_log("Error executing SQL query: " . mysqli_error($mysqli));
        header("Location: unarchive_merch.php?error=3");
        exit();
    }
} else {
    // Invalid or missing 'id' parameter
    header("Location: unarchive_merch.php?error=4");
    exit();
}
?>
