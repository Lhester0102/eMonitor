<?php
session_start();
include_once("config.php");
$name = $_SESSION['username'];
$rs = mysqli_query($mysqli, "SELECT * FROM borrowed_item WHERE item_type = 'consumable'");
$email_query = mysqli_query($mysqli, "SELECT * FROM account WHERE username = '$name'");

if ($email_query) {
    $row = mysqli_fetch_array($email_query);
    $email = $row['email'];
    $_SESSION['email'] = $email;
} else {
    $email = "Email not found";
}

$image = empty($row['image']) ? "uploads/anonymous.png" : $row['image'];
$_SESSION['image'] = $image;

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    mysqli_query($mysqli, "DELETE FROM borrowed_item WHERE useless = $delete_id");
    header("Location: borrowed_item.php"); // Redirect to refresh the page
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Request</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
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
    </style>
</head>
<body>
    <?php include 'navigation_user.php'; ?>
    <table class="table table-striped w-75" border="1px" align="center">
        <thead>
            <tr align="center">
                <th><b>ID</b></th>
                <th><b>Item Name</b></th>
                <th><b>Date of Requisition</b></th>
                <th><b>Amount</b></th>
                <th><b>Action</b></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($res = mysqli_fetch_array($rs)) {
                if ($res['borrower'] == $name) {
                    echo "<tr align='center'>";
                    echo "<td>" . $res['item_code'] . "</td>";
                    echo "<td>" . $res['equipment_name'] . "</td>";
                    echo "<td>" . $res['borrow_date'] . "</td>";
                    echo "<td>" . $res['borrowed_amount'] . "</td>";
                    echo "<td><a class='btn btn-sm btn-warning' href='removal_item.php?delete_id=" . $res['useless'] . "'>Remove</a></td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>
