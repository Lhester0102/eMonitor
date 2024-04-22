<?php
include_once("config.php");

// Validate input and prevent SQL injection
if (isset($_GET['id']) && isset($_GET['action']) && in_array($_GET['action'], ['accept', 'deny'])) {
    $id = mysqli_real_escape_string($mysqli, $_GET['id']);
    $action = mysqli_real_escape_string($mysqli, $_GET['action']);

    // Fetch request details
    $resultRequest = mysqli_query($mysqli, "SELECT rid, rname, request_no, item_code, request_destination, return_date, reason FROM request_to_ph WHERE id = '$id'");
    if ($resultRequest && mysqli_num_rows($resultRequest) > 0) {
        $rowRequest = mysqli_fetch_assoc($resultRequest);
        $rname = $rowRequest['rname'];
        $requested_amount = $rowRequest['request_no'];
        $request_destination = $rowRequest['request_destination'];
        $request_date = $rowRequest['return_date'];
        $reason = $rowRequest['reason'];

        // Fetch inventory details
        $resultInventory = mysqli_query($mysqli, "SELECT equipment_name, item_type FROM inventory WHERE id = '$id'");
        if ($resultInventory && mysqli_num_rows($resultInventory) > 0) {
            $rowInventory = mysqli_fetch_assoc($resultInventory);
            $equipment_name = $rowInventory['equipment_name'];
            $equipment_type = $rowInventory['item_type'];

            // Perform actions based on action type
            if ($action == 'accept') {
                // Perform insert operation
                $insertQuery = "INSERT INTO request (id, rname, request_no, item_code, equipment_name, request_destination, return_date, type, reason) VALUES ('$id', '$rname', '$requested_amount', '$id', '$equipment_name', '$request_destination', '$request_date', '$action', '$reason')";
                $deleteRequestQuery = "DELETE FROM request_to_ph WHERE id = '$id'";
            } elseif ($action == 'deny') {
                // Perform delete operation
                $deleteRequestQuery = "DELETE FROM request_to_ph WHERE id = '$id'";
            }

            // Execute queries within a transaction
            mysqli_autocommit($mysqli, false);
            $error = false;

            if (!mysqli_query($mysqli, $insertQuery)) {
                $error = true;
            }

            if (!mysqli_query($mysqli, $deleteRequestQuery)) {
                $error = true;
            }

            if ($error) {
                mysqli_rollback($mysqli);
                $errorMessage = "Error processing request. Please try again.";
            } else {
                mysqli_commit($mysqli);
                $successMessage = "Request processed successfully.";
            }

            mysqli_autocommit($mysqli, true); // Restore autocommit mode
        } else {
            $errorMessage = "Error: Could not fetch inventory details.";
        }
    } else {
        $errorMessage = "Error: Request not found.";
    }
} else {
    $errorMessage = "Invalid request.";
}

// Redirect based on outcome
if (isset($errorMessage)) {
    header("Location: request_ph_manage.php?error=" . urlencode($errorMessage));
} elseif (isset($successMessage)) {
    header("Location: request_ph_manage.php?success=" . urlencode($successMessage));
} else {
    header("Location: request_ph_manage.php");
}
exit();
?>
