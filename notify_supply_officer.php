
<?php 

session_start();
include_once("config.php");
$name = $_SESSION['username'];
$email_query = mysqli_query($mysqli, "SELECT * FROM account WHERE username = '$name'");
$bor = mysqli_query($mysqli, "SELECT SUM(borrowed_amount) AS total_borrowed_amount FROM borrowed_item WHERE borrower = '$name' AND item_type = 'non-consumable'");
$con = mysqli_query($mysqli, "SELECT SUM(borrowed_amount) AS total_borrowed_amount FROM borrowed_item WHERE borrower = '$name' AND item_type = 'consumable'");
$req = mysqli_query($mysqli, "SELECT * FROM request WHERE rname = '$name'");



$numItems = 0;
$totalBorrowedAmount = 0;
$totalConsumeAmount = 0;
$email = $_SESSION['email'];
$image = "uploads/anonymous.png";


if ($req) {
    $numItems = mysqli_num_rows($req);
}

if ($bor) {
    $row = mysqli_fetch_assoc($bor);
    if ($row !== null) {
        $totalBorrowedAmount = isset($row['total_borrowed_amount']) ? $row['total_borrowed_amount'] : 0;
    }
}

if ($con) {
    $row = mysqli_fetch_assoc($con);
    if ($row !== null) {
        $totalConsumeAmount = isset($row['total_borrowed_amount']) ? $row['total_borrowed_amount'] : 0;
    }
}

if ($email_query) {
    $row = mysqli_fetch_array($email_query);
    if ($row !== null) {
        $email = $row['email'];
        $position = $row['position'];
        $department = $row['department'];
    }
}

$_SESSION['email'] = $email;
$_SESSION['position'] = $position;
$_SESSION['department'] = $department;


include_once("config.php");
    $ro = mysqli_query($mysqli, "SELECT * FROM request");
    $num_due_items_s = mysqli_num_rows($ro);
    
    $alerto = 0;


$query_today = "SELECT * FROM borrowed_item WHERE item_type != 'consumable' AND DATE(request_date) = CURDATE() AND borrower = '$name'";
$res_today = mysqli_query($mysqli, $query_today);
$num_due_today = mysqli_num_rows($res_today);

$query_passed = "SELECT * FROM borrowed_item WHERE item_type != 'consumable' AND DATE(request_date) < CURDATE() AND borrower = '$name'";
$res_passed = mysqli_query($mysqli, $query_passed);
$num_due_passed = mysqli_num_rows($res_passed);

$query_tomorrow = "SELECT * FROM borrowed_item WHERE item_type != 'consumable' AND DATE(request_date) = DATE(DATE_ADD(CURDATE(), INTERVAL 1 DAY)) AND borrower = '$name'";
$res_tomorrow = mysqli_query($mysqli, $query_tomorrow);
$num_due_tomorrow = mysqli_num_rows($res_tomorrow);

$acce = mysqli_query($mysqli, "SELECT * FROM accept WHERE user = '$name'");
$num_acce = mysqli_num_rows($acce);

$alerto = $num_due_items_s + $num_due_today + $num_due_passed + $num_due_tomorrow + $num_acce;

?>


<!DOCTYPE html>
<html>
<head>
        <style>
            /* Reset CSS */
            * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        /* Navigation Bar (sidebar) */
        body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                    }

                    .sidebar {
                        width: 100%;
                        background-color: #044e85;
                        overflow: hidden;
                    }

                    .sidebar a {
                        float: left;
                        display: block;
                        color: white;
                        text-align: center;
                        padding: 14px 16px;
                        text-decoration: none;
                        font-size: 17px;
                    }

                    .sidebar a:hover {
                        background-color: #1d6193;
                    }

        /* Form Styling */
        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
        }

        td {
            padding: 10px;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 5px 0;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #044e85;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #1d6193;
        }

        .circular-image{
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 100%;
        }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<div class="sidebar">
    <a href="supply_user_dashboard.php">Back</a>
</div>
<div align="center">
<div>
	
<?php 
if (!$acce) {
    echo "Error: " . mysqli_error($mysqli);
} else {
    while ($ace = mysqli_fetch_array($acce)) {
        echo "<div class='item-row'>";
        echo "<p>Your Request for <b><u>" . $ace['amount'] . "</u></b> of <b><u>" . $ace['equipment_name'] . "</u></b> is approved. <b><a href='remove_notification_supply.php?id=" . $ace['AAID'] . "'>See and Remove Notification</a></b></p>";
        echo "</div>";
    }
}




while ($roo = mysqli_fetch_assoc($res_today)) {
    echo "<div class='item-row'>";
    echo "<p>The borrowed Equipment <b><u>" . $roo['equipment_name'] . "</u></b> is due today. <b><a href='supply_borrowed_item.php'>See</a></b></p>";
    echo "</div>";
}
while ($roo = mysqli_fetch_assoc($res_passed)) {
    echo "<div class='item-row'>";
    echo "<p>The borrowed Equipment <b><u>" . $roo['equipment_name'] . "</u></b> has passed its due date. <b><a href='supply_borrowed_item.php'>See</a></b></p>";
    echo "</div>";
}
while ($roo = mysqli_fetch_assoc($res_tomorrow)) {
    echo "<div class='item-row'>";
    echo "<p>The borrowed Equipment <b><u>" . $roo['equipment_name'] . "</u></b> is due tomorrow. <b><a href='supply_borrowed_item.php'>See</a></b></p>";
    echo "</div>";
}
?>
	
</div>


</div>


</body>
</html>