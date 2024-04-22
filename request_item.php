<?php
session_start();
include_once("config.php");

$name = $_SESSION['username'];
$requesta = isset($_SESSION['requesta']) ? $_SESSION['requesta'] : null;
$usertype = $_SESSION['user_type'];
$dept = $_SESSION['department'];

if (isset($_GET['id'], $_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'request') {
        if (isset($_REQUEST['requesta'])) {
            $requesta = $_REQUEST['requesta'];
            $return_date = !empty($_REQUEST['return_date']) ? $_REQUEST['return_date'] : '-';
            $request_destination = $_REQUEST['request_destination'];
            $reason = $_REQUEST['reason'];




$inventory_query = "SELECT item_type, item_code, equipment_name, quantity, Locate FROM inventory WHERE id = $id";
$inventory_result = mysqli_query($mysqli, $inventory_query);

if ($inventory_result) {
    $row = mysqli_fetch_assoc($inventory_result);
    $item_type = $row['item_type'];
    $item_code = $row['item_code'];
    $equipment_name = $row['equipment_name'];
    $quantity = $row['quantity'];
    $locate = $row['Locate'];
} else {
}




            $inventory_row = mysqli_fetch_assoc($inventory_result);
            // $updateQuantityQuery = "UPDATE inventory SET quantity = quantity - $requesta WHERE id = $id";
            $insertQuery = "INSERT INTO request_to_ph (id, rname, request_no, item_code, equipment_name, quantity, request_destination, return_date, type, reason, dept) VALUES ('$id', '$name', '$requesta', '$item_code', '$equipment_name', '$quantity', '$request_destination', '$return_date', '$item_type', '$reason', '$locate')";

            if (mysqli_query($mysqli, $insertQuery)) {
            } else {
                $_SESSION['error_message'] = "Error: Unable to update inventory or insert request.";
            }
        } else {
            $_SESSION['error_message'] = "Error: Request quantity is missing.";
        }
    } elseif ($action == 'cancel') {
        $get_no_query = "SELECT * FROM request_to_ph WHERE id = $id";
        $go = mysqli_query($mysqli, $get_no_query);
        $ret = mysqli_fetch_array($go);
        $here = $ret['request_no'];
        // $updateQuantityQuery = "UPDATE inventory SET quantity = quantity + $here WHERE id = $id";
        $deleteQuery = "DELETE FROM request_to_ph WHERE id = $id AND rname = '$name'";

        if (mysqli_query($mysqli, $deleteQuery)) {
        } else {
            $_SESSION['error_message'] = "Error: Unable to cancel request.";
        }
    }
}

if ($usertype === 'user') {
    header("Location: request_index.php");
    exit();
} elseif ($usertype === 'supply_user') {
    header("Location: request_index_supply.php");
    exit();
}
?>




