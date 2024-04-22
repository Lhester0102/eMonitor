<?php
session_start();
include_once("config.php");

if(isset($_SESSION['user_type'])) {
    $type = $_SESSION['user_type'];
    if ($type != "admin") {
        session_destroy();
        header("Location: log-in.php");
        exit();
    }
} else {
    header("Location: log-in.php");
    exit();
}

$name = '';

$rs = mysqli_query($mysqli, "SELECT inventory.*, COALESCE(SUM(borrowed_amount), 0) AS total_borrowed_amount 
          FROM inventory 
          LEFT JOIN borrowed_item ON inventory.id = borrowed_item.item_code 
          WHERE inventory.item_type = 'consumable'
          GROUP BY inventory.id");

$rt = mysqli_query($mysqli, "SELECT inventory.*, COALESCE(SUM(borrowed_amount), 0) AS total_borrowed_amount 
          FROM inventory 
          LEFT JOIN borrowed_item ON inventory.id = borrowed_item.item_code 
          WHERE inventory.item_type = 'non-consumable'
          GROUP BY inventory.id");

    $rr = mysqli_query($mysqli, "SELECT * FROM borrowed_item WHERE item_type = 'non-consumable'");
    $rb = mysqli_query($mysqli, "SELECT * FROM borrowed_item WHERE item_type = 'consumable'");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Inventory Report</title>
    <style>
    .sidebar {
        display: none;
    }
    
    table {
        border-collapse: collapse;
        width: 100%;
    }
    
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    
    th {
        background-color: #dddddd;
    }
    </style>
</head>

<body onload="window.print()">
    <div class="table-responsive">
        <table style="width: 75%;" align="center">
            <tr> <th colspan="5">Consumable Items Inventory</th> </tr>
            <tr style="border: black;"> 
                <th>Barcode</th> 
                <th>Equipment Name</th> 
                <th>Equipment Brand</th> 
                <th>Quantity</th> 
                <th>Amount of Borrowed</th> 
            </tr>
            <?php
            if ($rs) {
                if(mysqli_num_rows($rs) > 0) {
                    while ($res = mysqli_fetch_array($rs)) {
                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . $res['item_code'] . "</td>";
                        echo "<td style='text-align: center;'>" . $res['equipment_name'] . "</td>";
                        echo "<td style='text-align: center;'>" . $res['equipment_brand'] . "</td>";
                        echo "<td style='text-align: center;'>" . $res['quantity'] . "</td>";
                        echo "<td style='text-align: center;'>" . $res['total_borrowed_amount'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Search not found.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Error fetching inventory data: " . mysqli_error($mysqli) . "</td></tr>";
            }
            ?>
        </table><br><br>
        <table style="width: 75%;" align="center">
            <tr> <th colspan="5">Non-Consumable Items Inventory</th> </tr>
            <tr style="border: black;"> 
                <th>Barcode</th> 
                <th>Equipment Name</th> 
                <th>Equipment Brand</th> 
                <th>Quantity</th> 
                <th>Amount of Borrowed</th> 
            </tr>
            <?php
            if ($rt) {
                if(mysqli_num_rows($rt) > 0) {
                    while ($ret = mysqli_fetch_array($rt)) {
                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . $ret['item_code'] . "</td>";
                        echo "<td style='text-align: center;'>" . $ret['equipment_name'] . "</td>";
                        echo "<td style='text-align: center;'>" . $ret['equipment_brand'] . "</td>";
                        echo "<td style='text-align: center;'>" . $ret['quantity'] . "</td>";
                        echo "<td style='text-align: center;'>" . $ret['total_borrowed_amount'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Search not found.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Error fetching inventory data: " . mysqli_error($mysqli) . "</td></tr>";
            }
            ?>
        </table><br><br>
        <table style="width: 75%;" align="center">
            <tr> <th colspan="7">Borrowed Non-Consumable Items Inventory</th> </tr>
            <tr style="border: black;"> 
                <th>Barcode</th> 
                <th>Equipment Name</th> 
                <th>Borrower</th> 
                <th>Borrowed Amount</th> 
                <th>Date of Acquisition</th> 
                <th>Building Destination</th> 
                <th>Date of Ceding</th> 
            </tr>
            <?php
            if ($rr) {
                if(mysqli_num_rows($rr) > 0) {
                    while ($rer = mysqli_fetch_array($rr)) {
                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . $rer['item_code'] . "</td>";
                        echo "<td style='text-align: center;'>" . $rer['equipment_name'] . "</td>";
                        echo "<td style='text-align: center;'>" . $rer['borrower'] . "</td>";
                        echo "<td style='text-align: center;'>" . $rer['borrowed_amount'] . "</td>";
                        echo "<td style='text-align: center;'>" . $rer['borrow_date'] . "</td>";
                        echo "<td style='text-align: center;'>" . $rer['request_destination'] . "</td>";
                        echo "<td style='text-align: center;'>" . $rer['request_date'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Search not found.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Error fetching inventory data: " . mysqli_error($mysqli) . "</td></tr>";
            }
            ?>
        </table><br><br>
        <table style="width: 75%;" align="center">
            <tr> <th colspan="7">Borrowed Consumable Items Inventory</th> </tr>
            <tr style="border: black;"> 
                <th>Barcode</th> 
                <th>Equipment Name</th> 
                <th>Borrower</th> 
                <th>Borrowed Amount</th> 
                <th>Date of Acquisition</th> 
                <th>Building Destination</th> 
                <th>Date of Ceding</th> 
            </tr>
            <?php
            if ($rb) {
                if(mysqli_num_rows($rb) > 0) {
                    while ($reb = mysqli_fetch_array($rb)) {
                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . $reb['item_code'] . "</td>";
                        echo "<td style='text-align: center;'>" . $reb['equipment_name'] . "</td>";
                        echo "<td style='text-align: center;'>" . $reb['borrower'] . "</td>";
                        echo "<td style='text-align: center;'>" . $reb['borrowed_amount'] . "</td>";
                        echo "<td style='text-align: center;'>" . $reb['borrow_date'] . "</td>";
                        echo "<td style='text-align: center;'>" . $reb['request_destination'] . "</td>";
                        echo "<td style='text-align: center;'>" . $reb['request_date'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Search not found.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Error fetching inventory data: " . mysqli_error($mysqli) . "</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
<script>
//    function redirectToReports() {
//        window.location.href = "reports.php";
//    }
//    window.onafterprint = redirectToReports;
</script>


</html>
