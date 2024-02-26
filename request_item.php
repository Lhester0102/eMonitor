<?php
session_start();
include_once("config.php");
$name = $_SESSION['username'];

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'request') {
        $updateRequestQuery = "UPDATE inventory SET request = 1 WHERE id = $id";
        $updateQuantityQuery = "UPDATE inventory SET quantity = quantity - 1 WHERE id = $id";
        $insertQuery = "INSERT INTO request (id, rname) VALUES ($id, '$name')";

        if (mysqli_query($mysqli, $updateRequestQuery) && mysqli_query($mysqli, $updateQuantityQuery)) {
            if (!mysqli_query($mysqli, $insertQuery)) {
                $_SESSION['error_message'] = "Error: Unable to request item.";
            }
        } else {
            $_SESSION['error_message'] = "Error: Unable to update inventory.";
        }
    } elseif ($action == 'cancel') {
        $updateQuery = "UPDATE inventory SET request = 0 WHERE id = $id";
        $deleteQuery = "DELETE FROM request WHERE id = $id AND rname = '$name'";

        if (mysqli_query($mysqli, $updateQuery) && mysqli_query($mysqli, $deleteQuery)) {
            // Both queries were successful
        } else {
            $_SESSION['error_message'] = "Error: Unable to cancel request.";
        }
    }
}

header("Location: request_index.php");
exit();
?>



