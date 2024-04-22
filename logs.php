<?php
session_start();
include_once("config.php");
if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] !== "admin" && $_SESSION['user_type'] !== "supply_user")) {
    header("Location: log-out.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 95%; /* Adjust the width as needed */
            margin: 50px auto;
        }
        .table {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 10px;
            vertical-align: middle; /* Ensures content is vertically centered */
            font-size: 14px; /* Adjust font size */
        }
        .table th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase; /* Uppercase text */
            font-weight: bold; /* Bold font */
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 123, 255, 0.1);
        }
        h1 {
            color: black;
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px; /* Adjust font size */
        }
        .no-logs {
            text-align: center;
            padding: 20px;
            color: #6c757d;
            font-style: italic;
        }
    </style>
</head>
<body>
    <?php include("navigations.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr align="center">
                <th colspan="3" style="font-size: 40px; font-weight: normal;">Admin Logs</th>
                </tr>
                    <tr align="center">
                        <th>Action</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rs = mysqli_query($mysqli, "SELECT * FROM log ORDER BY log_id DESC");
                    if(mysqli_num_rows($rs) > 0) {
                        while ($res = mysqli_fetch_array($rs)) {
                            echo "<tr>";
                            echo "<td>" . $res['action'] . "</td>";
                            echo "<td class='text-center'>" . $res['date'] . "</td>";
                            echo "<td class='text-center'>" . $res['time'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' class='no-logs'>No logs found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
