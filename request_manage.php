<?php
include_once("config.php");

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    $reason = $_GET['reason'];

    if ($action == 'accept' || $action == 'deny') {
        $resultRequest = mysqli_query($mysqli, "SELECT rname, request_no, request_destination, return_date FROM request WHERE id = $id");
        if ($resultRequest && mysqli_num_rows($resultRequest) > 0) {
            $rowRequest = mysqli_fetch_assoc($resultRequest);
            $rname = $rowRequest['rname'];
            $requested_amount = $rowRequest['request_no'];
            $request_destination = $rowRequest['request_destination'];
            $request_date = $rowRequest['return_date'];

            $resultInventory = mysqli_query($mysqli, "SELECT equipment_name, item_type FROM inventory WHERE id = $id");
            if ($resultInventory && mysqli_num_rows($resultInventory) > 0) {
                $rowInventory = mysqli_fetch_assoc($resultInventory);
                $equipment_name = $rowInventory['equipment_name'];
                $equipment_type = $rowInventory['item_type'];

                $type = $action;

                if ($action == 'accept') {
                    $date = date('Y-m-d');
                    $insertBorrowedItemQuery = "INSERT INTO borrowed_item (item_code, borrow_date, borrower, equipment_name, item_type, borrowed_amount, request_destination, request_date) VALUES ('$id', '$date', '$rname', '$equipment_name', '$equipment_type', '$requested_amount', '$request_destination', '$request_date')";
                    if (mysqli_query($mysqli, $insertBorrowedItemQuery)) {
                        $successMessage = "Request accepted successfully.";
                    } else {
                        $errorMessage = "Error: " . mysqli_error($mysqli);
                    }
                }

                if (!isset($errorMessage)) {
                    $insertAcceptQuery = "INSERT INTO accept (user, equipment_name, amount, type, reason) VALUES ('$rname', '$equipment_name', '$requested_amount', '$type', '$reason')";
                    $deleteRequestQuery = "DELETE FROM request WHERE id = $id";
                    if (mysqli_query($mysqli, $insertAcceptQuery) && mysqli_query($mysqli, $deleteRequestQuery)) {
                        $successMessage = "Request processed successfully.";
                    } else {
                        $errorMessage = "Error: " . mysqli_error($mysqli);
                    }
                }
            }
        }
    }
}

if (isset($errorMessage)) {
    echo "Error: " . $errorMessage;
} elseif (isset($successMessage)) {
    header("Location: request.php?success=" . urlencode($successMessage));
} else {
    header("Location: request.php");
}
exit();
?>