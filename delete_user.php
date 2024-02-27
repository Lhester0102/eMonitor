<?php
session_start();
include_once("config.php");
$id = mysqli_real_escape_string($mysqli, $_REQUEST['id']);
$rs = mysqli_query($mysqli, "SELECT user_type FROM account WHERE UID='$id'");

if ($rs && mysqli_num_rows($rs) > 0) {
    $result = mysqli_fetch_array($rs);
    $item_type = $result["user_type"];

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
