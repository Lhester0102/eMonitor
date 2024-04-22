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

            $inventory_query = "SELECT item_type, item_code, equipment_name, quantity, Locate FROM inventory WHERE id = ?";
            $stmt = $mysqli->prepare($inventory_query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $inventory_result = $stmt->get_result();

            if ($inventory_result && $inventory_result->num_rows > 0) {
                $row = $inventory_result->fetch_assoc();
                $item_type = $row['item_type'];
                $item_code = $row['item_code'];
                $equipment_name = $row['equipment_name'];
                $quantity = $row['quantity'];
                $locate = $row['Locate'];

                $updateQuantityQuery = "UPDATE inventory SET quantity = quantity - ? WHERE id = ?";
                $stmt = $mysqli->prepare($updateQuantityQuery);
                $stmt->bind_param("ii", $requesta, $id);
                $stmt->execute();

                if ($stmt->error) {
                    $_SESSION['error_message'] = "Error: Unable to update inventory.";
                }

                $insertQuery = "INSERT INTO request (id, rname, request_no, item_code, equipment_name, request_destination, return_date, type, reason) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $mysqli->prepare($insertQuery);
                $stmt->bind_param("ssissssss", $id, $name, $requesta, $item_code, $equipment_name, $request_destination, $return_date, $action, $reason);
                $stmt->execute();

                if ($stmt->error) {
                    $_SESSION['error_message'] = "Error: Unable to insert request.";
                }
            } else {
                $_SESSION['error_message'] = "Error: Inventory not found.";
            }
        } else {
            $_SESSION['error_message'] = "Error: Request quantity is missing.";
        }
    } elseif ($action == 'cancel') {
        $get_no_query = "SELECT * FROM request WHERE id = ?";
        $stmt = $mysqli->prepare($get_no_query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $ret = $result->fetch_assoc();

        if ($ret) {
            $here = $ret['request_no'];
            $updateQuantityQuery = "UPDATE inventory SET quantity = quantity + ? WHERE id = ?";
            $stmt = $mysqli->prepare($updateQuantityQuery);
            $stmt->bind_param("ii", $here, $id);
            $stmt->execute();

            if ($stmt->error) {
                $_SESSION['error_message'] = "Error: Unable to update inventory.";
            }

            $deleteQuery = "DELETE FROM request WHERE id = ? AND rname = ?";
            $stmt = $mysqli->prepare($deleteQuery);
            $stmt->bind_param("is", $id, $name);
            $stmt->execute();

            if ($stmt->error) {
                $_SESSION['error_message'] = "Error: Unable to cancel request.";
            }
        } else {
            $_SESSION['error_message'] = "Error: Request not found.";
        }
    }
}

if ($usertype === 'user') {
    header("Location: request_index_ph.php");
    exit();
} elseif ($usertype === 'supply_user') {
    header("Location: request_index_ph.php");
    exit();
}
?>
