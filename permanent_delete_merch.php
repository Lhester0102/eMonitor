<?php
session_start();
include_once("config.php");

if (isset($_GET['id'])) {
    $inventory_id = $_GET['id'];

    $deleteSql = "DELETE FROM archive_merch WHERE amid = '$inventory_id'";
    $result = mysqli_query($mysqli, $deleteSql);

    if ($result) {
        header("Location: unarchive_merch.php?delete_success=1");
        exit();
    } else {
        header("Location: unarchive_merch.php?delete_error=1");
        exit();
    }
}

header("Location: unarchive_merch.php?error=1");
exit();
?>