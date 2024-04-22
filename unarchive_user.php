<?php
session_start();
include_once("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $type = $_GET['type'];
    $sql = "SELECT * FROM archive_user WHERE eid = '$id'";
    $result = mysqli_query($mysqli, $sql);
    $inventory = mysqli_fetch_assoc($result);
    if ($inventory) {
        $insertSQL = "INSERT INTO account (username, password, email, department, position, user_type, image_path, iid, iid_image) 
                      VALUES ('".$inventory['username']."', '".$inventory['password']."', '".$inventory['email']."', '".$inventory['department']."', '".$inventory['position']."', '".$inventory['user_type']."', '".$inventory['image_path']."', '".$inventory['iid']."', '".$inventory['iid_image']."')";
        $archiveResult = mysqli_query($mysqli, $insertSQL);
        $username = $inventory['username'];
        $date = date('Y-m-d');
        $time = date('H:i:s');
        mysqli_query($mysqli, "INSERT INTO log (time, date, action) VALUES ('$time', '$date', 'admin has unarchived $username')");
if ($type == 'user') {
    if ($archiveResult) {
        $deleteSql = "DELETE FROM archive_user WHERE eid = '$id'";
        mysqli_query($mysqli, $deleteSql);
        header("Location: archive_user_list.php?unarchive_success=1");
        exit();
    } else {
        header("Location: archive_user_list.php?error=1");
        exit();
    }
} else {
    if ($archiveResult) {
        $deleteSql = "DELETE FROM archive_user WHERE eid = '$id'";
        mysqli_query($mysqli, $deleteSql);
        header("Location: archive_supply_user_list.php?unarchive_success=1");
        exit();
    } else {
        header("Location: archive_supply_user_list.php?error=1");
        exit();
    }
}
    }
}

header("Location: unarchive.php?error=1");
exit();
?>
