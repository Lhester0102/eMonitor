<?php
session_start();
include_once("config.php");

$name = $_SESSION['username'];
$email_query = mysqli_query($mysqli, "SELECT * FROM account WHERE username = '$name'");
$bor = mysqli_query($mysqli, "SELECT * FROM inventory WHERE item_type = 'non-consumable'");
$nbor = mysqli_num_rows($bor);
$con = mysqli_query($mysqli, "SELECT * FROM inventory WHERE item_type = 'consumable'");
$ncon = mysqli_num_rows($con); // Corrected variable name from $bor to $con
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


if ($req) {
    $numItems = mysqli_num_rows($req);
}

if ($email_query) {
    $row = mysqli_fetch_array($email_query);
    if ($row !== null) {
        $email = $row['email'];
    }
}

$_SESSION['email'] = $email;
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

    <?php include 'navigation_supply_user.php'; ?>

    <div class="col-sm-12" style="text-align:center;color:black">
        <div class="well ms-5 me-5 mt-2" style="text-align:center;background:blue;color:white">
            <h1>Supply Officer Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="well">
                    <div class="card ms-5 me-5 mt-3 p-3">
                        <h1>Consumable</h1>
                        <p>
                            <h1><b><?php echo $ncon ?></b></h1>
                        </p>
                        <p><a href="conusmable.php">Full Details</a></p>
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
                        <p><a href="request_index.php">Full Details</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="well">
                    <div class="card ms-5 me-5 mt-3 p-3">
                        <h1>Non-Consumable</h1>
                        <p>
                            <h1><b><?php echo $nbor ?></b></h1>
                        </p>
                        <p><a href="non_conusmable.php">Full Details</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
