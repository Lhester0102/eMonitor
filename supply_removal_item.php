<?php
session_start();
include_once("config.php");

if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $query = "DELETE FROM borrowed_item WHERE useless = $delete_id";
    if(mysqli_query($mysqli, $query)) {
        header("Location: supply_item_storage.php");
        exit();
    } else {
        echo "Error deleting row: " . mysqli_error($mysqli);
        header("Location: supply_item_storage.php");
        exit();
    }
}
?>
