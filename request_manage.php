<?php
include_once("config.php");

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'accept') {
        $resultRequest = mysqli_query($mysqli, "SELECT rname FROM request WHERE id = $id");
        $rowRequest = mysqli_fetch_assoc($resultRequest);
        $rname = $rowRequest['rname'];

        $resultInventory = mysqli_query($mysqli, "SELECT equipment_name FROM inventory WHERE id = $id");
        $rowInventory = mysqli_fetch_assoc($resultInventory);
        $equipment_name = $rowInventory['equipment_name'];

        mysqli_query($mysqli, "UPDATE inventory SET request = 0, borrow_no = borrow_no + 1 WHERE id = $id");
        mysqli_query($mysqli, "DELETE FROM request WHERE id = $id");

        $date = date('Y-m-d');
        mysqli_query($mysqli, "INSERT INTO borrowed_item (item_code, borrow_date, borrower, equipment_name) VALUES ('$id', '$date', '$rname', '$equipment_name')");
    } elseif ($action == 'deny') {
        mysqli_query($mysqli, "UPDATE inventory SET request = 0, quantity = quantity + 1 WHERE id = $id");

        mysqli_query($mysqli, "DELETE FROM request WHERE id = $id");
    }
}

header("Location: request.php");
exit();
?>
