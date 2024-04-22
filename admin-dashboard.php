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

$supplyOfficers = mysqli_query($mysqli, "SELECT COUNT(*) AS count FROM account WHERE user_type = 'supply_user'");
$supplyOfficersCount = mysqli_fetch_assoc($supplyOfficers)['count'];

$supplyOfficerst = mysqli_query($mysqli, "SELECT position, COUNT(*) AS count FROM account WHERE user_type = 'supply_user' GROUP BY position");

$computer_tech_no = 0;
$gen_merch_no = 0;
$supply_officer_no = 0;
$others_no = 0;

while ($row = mysqli_fetch_assoc($supplyOfficerst)) {
    $position = $row['position'];
    $count = $row['count'];

    if ($position === 'Computer Technician') {
        $computer_tech_no += $count;
    } elseif ($position === 'General Merchandise') {
        $gen_merch_no += $count;
    } elseif ($position === 'Supply Officer') {
        $supply_officer_no += $count;
    } else {
        $others_no += $count;
    }
}




$instructors_by_department = mysqli_query($mysqli, "
    SELECT 
        SUM(CASE WHEN department = 'BSBA' THEN 1 ELSE 0 END) AS BSBA_count,
        SUM(CASE WHEN department = 'BSIT' THEN 1 ELSE 0 END) AS BSIT_count,
        SUM(CASE WHEN department = 'BSCRIM' THEN 1 ELSE 0 END) AS BSCRIM_count,
        SUM(CASE WHEN department = 'BEED' THEN 1 ELSE 0 END) AS BEED_count,
        SUM(CASE WHEN department = 'BSHM' THEN 1 ELSE 0 END) AS BSHM_count,
        SUM(CASE WHEN department = 'HCS' THEN 1 ELSE 0 END) AS HCS_count,
        SUM(CASE WHEN department = 'SHS' THEN 1 ELSE 0 END) AS SHS_count,
        SUM(CASE WHEN department = ' ' THEN 1 ELSE 0 END) AS NOTHING_count
    FROM account 
    WHERE user_type = 'user'
");

$instructors_by_department_counts = mysqli_fetch_assoc($instructors_by_department);

$BSBA_count = $instructors_by_department_counts['BSBA_count'];
$BSIT_count = $instructors_by_department_counts['BSIT_count'];
$BSCRIM_count = $instructors_by_department_counts['BSCRIM_count'];
$BEED_count = $instructors_by_department_counts['BEED_count'];
$BSHM_count = $instructors_by_department_counts['BSHM_count'];
$HCS_count = $instructors_by_department_counts['HCS_count'];
$SHS_count = $instructors_by_department_counts['SHS_count'];
$NOTHING_count = $instructors_by_department_counts['NOTHING_count'];
$amounted=$BSBA_count + $BSIT_count + $BSCRIM_count + $BEED_count + $BSHM_count + $HCS_count + $SHS_count + $NOTHING_count;

$program_head_by_department = mysqli_query($mysqli, "
    SELECT 
        SUM(CASE WHEN department = 'BSBA' THEN 1 ELSE 0 END) AS BSBA_counted,
        SUM(CASE WHEN department = 'BSIT' THEN 1 ELSE 0 END) AS BSIT_counted,
        SUM(CASE WHEN department = 'BSCRIM' THEN 1 ELSE 0 END) AS BSCRIM_counted,
        SUM(CASE WHEN department = 'BEED' THEN 1 ELSE 0 END) AS BEED_counted,
        SUM(CASE WHEN department = 'BSHM' THEN 1 ELSE 0 END) AS BSHM_counted,
        SUM(CASE WHEN department = 'HCS' THEN 1 ELSE 0 END) AS HCS_counted,
        SUM(CASE WHEN department = 'SHS' THEN 1 ELSE 0 END) AS SHS_counted
    FROM account 
    WHERE position = 'Program Head'
");

$program_head_by_department_counts = mysqli_fetch_assoc($program_head_by_department);

$BSBA_counted = $program_head_by_department_counts['BSBA_counted'];
$BSIT_counted = $program_head_by_department_counts['BSIT_counted'];
$BSCRIM_counted = $program_head_by_department_counts['BSCRIM_counted'];
$BEED_counted = $program_head_by_department_counts['BEED_counted'];
$BSHM_counted = $program_head_by_department_counts['BSHM_counted'];
$HCS_counted = $program_head_by_department_counts['HCS_counted'];
$SHS_counted = $program_head_by_department_counts['SHS_counted'];
$amounted_ph=$BSBA_counted + $BSIT_counted + $BSCRIM_counted + $BEED_counted + $BSHM_counted + $HCS_counted + $SHS_counted;

$inventoryConsumable = mysqli_query($mysqli, "SELECT COUNT(*) AS count FROM inventory WHERE item_type = 'consumable'");
$inventoryConsumableCount = mysqli_fetch_assoc($inventoryConsumable)['count'];

$inventoryNonConsumable = mysqli_query($mysqli, "SELECT COUNT(*) AS count FROM inventory WHERE item_type = 'non-consumable'");
$inventoryNonConsumableCount = mysqli_fetch_assoc($inventoryNonConsumable)['count'];

$requestsconsumable = mysqli_query($mysqli, "SELECT COUNT(*) AS count FROM request WHERE type = 'consumable'");
$requestsCountconsumable = mysqli_fetch_assoc($requestsconsumable)['count'];

$requestsnonconsumable = mysqli_query($mysqli, "SELECT COUNT(*) AS count FROM request WHERE type = 'non-consumable'");
$requestsCountnonconsumable = mysqli_fetch_assoc($requestsnonconsumable)['count'];

$requestsnonconsumable = mysqli_query($mysqli, "SELECT COUNT(*) AS count FROM request WHERE type = 'non-consumable'");
$requestsCountnonconsumable = mysqli_fetch_assoc($requestsnonconsumable)['count'];
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
            <h1>Admin Dashboard</h1>
        </div>
        <div class="row">


            <!-- Supply Officer Section -->
            <div class="col-sm-6">
                <div class="well">
                    <div class="card ms-5 me-5 mt-3 p-3">
                        <h1>Program Head</h1>
<h6>

<div style="display: inline-block; margin-right: 5px; background-color: #FF6384; width: 10px; height: 10px;"></div>
BSBA: <?php echo $BSBA_counted; ?>   ||    
<div style="display: inline-block; margin-right: 5px; background-color: #36A2EB; width: 10px; height: 10px;"></div>
BSIT: <?php echo $BSIT_counted; ?>   ||    
<div style="display: inline-block; margin-right: 5px; background-color: #FFCE56; width: 10px; height: 10px;"></div>
BSCRIM: <?php echo $BSCRIM_counted; ?>   ||    
<div style="display: inline-block; margin-right: 5px; background-color: #4BC0C0; width: 10px; height: 10px;"></div>
BEED: <?php echo $BEED_counted; ?>   ||    
<div style="display: inline-block; margin-right: 5px; background-color: #9966FF; width: 10px; height: 10px;"></div>
BSHM: <?php echo $BSHM_counted; ?>   ||    
<div style="display: inline-block; margin-right: 5px; background-color: #FF9900; width: 10px; height: 10px;"></div>
HCS: <?php echo $HCS_counted; ?>   ||    
<div style="display: inline-block; margin-right: 5px; background-color: #FF99FF; width: 10px; height: 10px;"></div>
SHS: <?php echo $SHS_counted; ?>   ||       
<b>Total:</b> <?php echo $amounted_ph; ?>
</h6>
                        <canvas id="supplyChart" class="chart" width="200" height="200"></canvas>
                        <br>
                        <p><a class="btn btn-primary" href="supply_officer.php">Full Details</a></p>
                    </div>
                </div>
            </div>

            <!-- Instructor Section -->
            <div class="col-sm-6">
                <div class="well">
                    <div class="card ms-5 me-5 mt-3 p-3">
                        <h1>INSTRUCTORS</h1>
<h6>

<div style="display: inline-block; margin-right: 5px; background-color: #FF6384; width: 10px; height: 10px;"></div>
BSBA: <?php echo $BSBA_count; ?>   ||    
<div style="display: inline-block; margin-right: 5px; background-color: #36A2EB; width: 10px; height: 10px;"></div>
BSIT: <?php echo $BSIT_count; ?>   ||    
<div style="display: inline-block; margin-right: 5px; background-color: #FFCE56; width: 10px; height: 10px;"></div>
BSCRIM: <?php echo $BSCRIM_count; ?>   ||    
<div style="display: inline-block; margin-right: 5px; background-color: #4BC0C0; width: 10px; height: 10px;"></div>
BEED: <?php echo $BEED_count; ?>   ||    
<div style="display: inline-block; margin-right: 5px; background-color: #9966FF; width: 10px; height: 10px;"></div>
BSHM: <?php echo $BSHM_count; ?>   ||    
<div style="display: inline-block; margin-right: 5px; background-color: #FF9900; width: 10px; height: 10px;"></div>
HCS: <?php echo $HCS_count; ?>   ||    
<div style="display: inline-block; margin-right: 5px; background-color: #FF99FF; width: 10px; height: 10px;"></div>
SHS: <?php echo $SHS_count; ?>   ||    
<div style="display: inline-block; margin-right: 5px; background-color: #C0C0C0; width: 10px; height: 10px;"></div>
Others: <?php echo $NOTHING_count; ?>   ||    
<b>Total:</b> <?php echo $amounted; ?>
</h6>
                        <canvas id="instructorChart" class="chart" width="200" height="200"></canvas>
                        <br>
                        <p><a class="btn btn-primary" href="instructor.php">Full Details</a></p>
                    </div>
                </div>
            </div>

            
            <!-- Inventory Section -->
            <div class="col-sm-6">
                <div class="well">
                    <div class="card ms-5 me-5 mt-3 p-3">
                        <h1>INVENTORY</h1>
<h6>
    <div style="display: inline-block; margin-right: 5px; background-color: #ffce56; width: 10px; height: 10px;"></div>
    Consumable: <?php echo $inventoryConsumableCount; ?>   ||    
    <div style="display: inline-block; margin-right: 5px; background-color: #008000; width: 10px; height: 10px;"></div>
    Non-Consumable: <?php echo $inventoryNonConsumableCount; ?>   ||    
    <b>Total:</b> <?php $inventoryeCount=$inventoryConsumableCount+$inventoryNonConsumableCount; echo $inventoryeCount; ?>
</h6>
                        <canvas id="inventoryChart" class="chart" width="200" height="200"></canvas>
                        <br>
                        <p><a class="btn btn-primary" href="index.php">Full Details</a></p>
                    </div>
                </div>
            </div>
            <!-- Request Section -->
            <div class="col-sm-6">
                <div class="well">
                    <div class="card ms-5 me-5 mt-3 p-3">
                        <h1>REQUESTS</h1>
<h6>
    <div style="display: inline-block; margin-right: 5px; background-color: #ffce56; width: 10px; height: 10px;"></div>
    Consumable: <?php echo $requestsCountconsumable; ?>   ||    
    <div style="display: inline-block; margin-right: 5px; background-color: #008000; width: 10px; height: 10px;"></div>
    Non-Consumable: <?php echo $requestsCountnonconsumable; ?>   ||    
    <b>Total:</b> <?php $requestsCount=$requestsCountconsumable+$requestsCountnonconsumable; echo $requestsCount; ?>
</h6>
                        <canvas id="requestChart" class="chart" width="200" height="200"></canvas>
                        <br>
                        <p><a class="btn btn-primary" href="request.php">Full Details</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for creating charts -->
    <script>
        // Supply Officer Chart
        var supplyChart = new Chart(document.getElementById('supplyChart'), {
    type: 'pie',
    data: {
        labels: ['BSBA', 'BSIT', 'BSCRIM', 'BEED', 'BSHM', 'HCS', 'SHS'],
        datasets: [{
            data: [<?php echo $BSBA_counted; ?>, <?php echo $BSIT_counted; ?>, <?php echo $BSCRIM_counted; ?>, <?php echo $BEED_counted; ?>, <?php echo $BSHM_counted; ?>, <?php echo $HCS_counted; ?>, <?php echo $SHS_counted; ?>],
            backgroundColor: [
                '#FF6384', // BSBA - Red
                '#36A2EB', // BSIT - Blue
                '#FFCE56', // BSCRIM - Yellow
                '#4BC0C0', // BEED - Cyan
                '#9966FF', // BSHM - Purple
                '#FF9900', // HCS - Orange
                '#FF99FF', // SHS - Pink
                '#C0C0C0'  // NOTHING - Grey
            ],
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

var instructorChart = new Chart(document.getElementById('instructorChart'), {
    type: 'pie',
    data: {
        labels: ['BSBA', 'BSIT', 'BSCRIM', 'BEED', 'BSHM', 'HCS', 'SHS', 'NOTHING'],
        datasets: [{
            data: [<?php echo $BSBA_count; ?>, <?php echo $BSIT_count; ?>, <?php echo $BSCRIM_count; ?>, <?php echo $BEED_count; ?>, <?php echo $BSHM_count; ?>, <?php echo $HCS_count; ?>, <?php echo $SHS_count; ?>, <?php echo $NOTHING_count; ?>],
            backgroundColor: [
                '#FF6384', // BSBA - Red
                '#36A2EB', // BSIT - Blue
                '#FFCE56', // BSCRIM - Yellow
                '#4BC0C0', // BEED - Cyan
                '#9966FF', // BSHM - Purple
                '#FF9900', // HCS - Orange
                '#FF99FF', // SHS - Pink
                '#C0C0C0'  // NOTHING - Grey
            ],
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


var inventoryChart = new Chart(document.getElementById('inventoryChart'), {
    type: 'pie',
    data: {
        labels: ['Non-consumable', 'Consumable'],
        datasets: [{
            data: [<?php echo $inventoryNonConsumableCount; ?>, <?php echo $inventoryConsumableCount; ?>],
            backgroundColor: ['#008000', '#ffce56'],
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

<?php 
if ($requestsCountnonconsumable == 0 && $requestsCountconsumable == 0) {
echo "var requestChart = new Chart(document.getElementById('requestChart'), {";
echo "    type: 'pie',";
echo "    data: {";
echo "        labels: ['Empty'],";
echo "        datasets: [{";
echo "            data: [1],";
echo "            backgroundColor: ['#808080'],";
echo "            borderColor: ['#ffffff'],";
echo "            borderWidth: 1";
echo "        }]";
echo "    },";
echo "    options: {";
echo "        plugins: {";
echo "            legend: {";
echo "                display: false";
echo "           }";
echo "       }";
echo "    }";
echo "});";
} else {
echo "var requestChart = new Chart(document.getElementById('requestChart'), {";
echo "    type: 'pie',";
echo "    data: {";
echo "        labels: ['Non-consumable', 'Consumable'],";
echo "        datasets: [{";
echo "            data: [" . $requestsCountnonconsumable . ", " . $requestsCountconsumable . "],";
echo "            backgroundColor: ['#008000', '#ffce56'],";
echo "            borderColor: ['#ffffff'],";
echo "            borderWidth: 1";
echo "        }]";
echo "    },";
echo "    options: {";
echo "        plugins: {";
echo "            legend: {";
echo "                display: false";
echo "           }";
echo "       }";
echo "    }";
echo "});";
}
 ?>


</script>
</body>
</html>