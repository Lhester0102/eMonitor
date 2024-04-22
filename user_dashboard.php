
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
$image_path = $_SESSION['image_path'];
$position = $_SESSION['position'];
$department = $_SESSION['department'];
$iid = $_SESSION['iid'];
$iid_image = $_SESSION['iid_image'];
$hier = $_SESSION['hierarchy'];


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
    if (mysqli_num_rows($email_query) > 0) {
        $row = mysqli_fetch_array($email_query);
        $email = $row['email'];
        $position = $row['position'];
        $department = $row['department'];
        $image_path = $row['image_path'];
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>User Dashboard</title>
    <style>
        .row.content {
            height: 550px
        }

        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }

        @media screen and (max-width: 767px) {
            .row.content {
                height: auto;
            }
        }
    </style>
</head>

<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <?php include 'navigation_user.php'; ?>

    <div class="col-sm-12" style="text-align:center;color:black;" align="center">
        <div class="well ms-5 me-5 mt-2 bg-primary rounded-2" style="text-align:center;color:white">
            <h1><marquee> <?php echo $hier; ?> Dashboard </marquee></h1>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="well">
                    <div class="card ms-5 me-5 mt-3 p-3">
                        <h1>NON-CONSUMABLE ITEMS</h1>
                        <p>
                            <h1><b><?php echo $totalBorrowedAmount; ?></b></h1>
                        </p>
                        <p><a href="borrowed_item.php" class="btn btn-primary">Full Details</a></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="well">
                    <div class="card ms-5 me-5 mt-3 p-3">
                        <h1>PENDING REQUEST</h1>
                        <p>
                            <h1><b><?php echo $numItems; ?></b></h1>
                        </p>
                        <p><a href="request_index.php" class="btn btn-primary">Full Details</a></p>
                    </div>
                </div>
            </div>
        </div>
<div class="row">
    <div class="col-sm-12" align="center">
        <div class="well">
            <div class="card ms-5 me-5 mt-5 p-3">
                <h1>CONSUMABLE ITEMS</h1>
                <p>
                    <h1><b><?php echo $totalConsumeAmount; ?></b></h1>
                </p>
                <p><a href="item_storage.php" class="btn btn-primary">Full Details</a></p>
            </div>
        </div>
    </div>
</div>

    </div>
</body>

</html>
