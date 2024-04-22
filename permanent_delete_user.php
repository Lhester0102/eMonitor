<?php
session_start();
include_once("config.php");
$id = $_GET['id'];
$rs = mysqli_query($mysqli, "SELECT user_type, username FROM account WHERE UID='$id'");

if ($rs && mysqli_num_rows($rs) > 0) {
    $result = mysqli_fetch_array($rs);
    $username = $result['username'];
    $date = date('Y-m-d');
    $time = date('H:i:s');
    mysqli_query($mysqli, "INSERT INTO log (time, date, action) VALUES ('$time', '$date', 'admin has permanently deleted $username')");
}


if (isset($_GET['id'])) {
    $inventory_id = $_GET['id'];
    $type = $_GET['type'];

    $deleteSql = "DELETE FROM archive_user WHERE eid = '$inventory_id'";
    $result = mysqli_query($mysqli, $deleteSql);
if ($type == 'user') {
    if ($result) {
        header("Location: archive_user_list.php?delete_success=1");
        exit();
    } else {
        header("Location: archive_user_list.php?delete_error=1");
        exit();
    }
} else {
    if ($result) {
        header("Location: archive_supply_user_list.php?delete_success=1");
        exit();
    } else {
        header("Location: archive_supply_user_list.php?delete_error=1");
        exit();
    }
}


}

header("Location: unarchive.php?error=1");
exit();
?>