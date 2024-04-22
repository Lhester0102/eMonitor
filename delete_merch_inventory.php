<?php
session_start();
include_once("config.php");

if (isset($_GET['id'])) {
    $inventory_id = $_GET['id'];

    $sql = "SELECT * FROM merch WHERE mid = '$inventory_id'";
    $result = mysqli_query($mysqli, $sql);
    $inventory = mysqli_fetch_assoc($result);

    if ($inventory) {
        $archiveSql = "INSERT INTO archive_merch (mid, name, barcode, quantity, measurement, image) 
                       VALUES ('{$inventory['mid']}', '{$inventory['name']}', '{$inventory['barcode']}', '{$inventory['quantity']}', '{$inventory['measurement']}', '{$inventory['image']}')";
        mysqli_query($mysqli, $archiveSql);

        $deleteSql = "DELETE FROM merch WHERE mid = '$inventory_id'";
        mysqli_query($mysqli, $deleteSql);

        header("Location: general_index.php?archive_success=1");
        exit();
    }
}
header("Location: general_index.php?error=1");
exit();
?>
