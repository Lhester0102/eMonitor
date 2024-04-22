<?php
session_start();
include_once("config.php");
if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] !== "admin" && $_SESSION['user_type'] !== "supply_user")) {
    header("Location: log-out.php");
    exit();
}

$name = $_SESSION['username'];
$email_query = mysqli_query($mysqli, "SELECT * FROM account WHERE username = '$name'");
if ($email_query) {
    $row = mysqli_fetch_array($email_query);
    $email = $row['email'];
    $_SESSION['email'] = $email;
} else {
    $email = "Email not found";
}

$inventory = mysqli_query($mysqli, "SELECT COUNT(*) AS count FROM merch");
$inventoryCount = mysqli_fetch_assoc($inventory)['count']; // Corrected variable name
?>


<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Chart.js -->
    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 100px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }

        /* On small screens, set height to 'auto' for the grid */
        @media screen and (max-width: 767px) {
            .row.content {
                height: auto;
            }
        }
        .card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: #fff;
    border-radius: 10px;
    border: 1px solid #e0e0e0;
    padding: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    cursor: pointer;
   
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.card h2 {
    font-size: 24px;
    margin-bottom: 10px;
    color: #333;
}

.card p {
    font-size: 16px;
    line-height: 1.5;
    color: #666;
    text-align: center;
}

.card .btn {
    display: inline-block;
    padding: 10px 20px;
    margin-top: 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.card .btn:hover {
    background-color: #0056b3;
}
        
		canvas.chart {
            width: 200px !important;
            height: 200px !important;
        }
    </style>
</head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  </head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <body>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<body>

<?php include("navigations.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        

    <div class="col-sm-12" style="text-align:center;color:black">
        <div class="well ms-5 me-5 mt-2" style="text-align:center;background:#3498db;color:white">
            <h1>General Merchandise Dashboard</h1>
        </div>

            
            <!-- Inventory Section -->
            <div class="col-sm-6">
                <div class="well">
                    <div class="card ms-5 me-5 mt-6 p-3">
                        <h1>INVENTORY</h1>
<h6>  
    <b>Total:</b> <?php echo $inventoryCount; ?>
</h6>
                        <canvas id="inventoryChart" class="chart" width="200" height="200"></canvas>
                        <br>
                        <p><a class="btn btn-primary" href="index.php">Full Details</a></p>
                    </div>
                </div>
            </div>
    </div>
<script>
var inventoryChart = new Chart(document.getElementById('inventoryChart'), {
    type: 'pie',
    data: {
        labels: ['Inventory'],
        datasets: [{
            data: [<?php echo $inventoryCount; ?>], // Corrected variable name
            backgroundColor: ['#008000'],
            borderColor: ['#ffffff'],
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>

</body>
</html>