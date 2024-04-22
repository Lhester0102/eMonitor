<?php
session_start();
include_once("config.php");
$id = mysqli_real_escape_string($mysqli, $_REQUEST['id']);
$rs = mysqli_query($mysqli, "SELECT user_type, username FROM account WHERE UID='$id'");

if ($rs && mysqli_num_rows($rs) > 0) {
    $result = mysqli_fetch_array($rs);
    $item_type = $result["user_type"];
    $username = $result['username'];
    $date = date('Y-m-d');
    $time = date('H:i:s');
    mysqli_query($mysqli, "INSERT INTO log (time, date, action) VALUES ('$time', '$date', 'admin has archived $username')");

    $insertSQL = "INSERT INTO archive_user (username, password, email, department, position, user_type, image_path, iid, iid_image) SELECT username, password, email, department, position, user_type, image_path, iid, iid_image FROM account WHERE UID = '$id'";
    $archiveResult = mysqli_query($mysqli, $insertSQL);

    $deleteSql = "DELETE FROM account WHERE UID = '$id'";
    $deleteResult = mysqli_query($mysqli, $deleteSql);

    if ($deleteResult) {
        if ($item_type === "user") {
            header("Location: instructor.php");
            exit();
        } elseif ($item_type === "supply_user") {
            header("Location: supply_officer.php");
            exit();
        } else {
            header("Location: admin-dashboard.php");
            exit();
        }
    } else {
        echo "Error deleting user.";
    }
} else {
    echo "User not found.";
}
?>

