<?php
include_once("config.php");

$requests_query = "SELECT * FROM request";
$requests_result = mysqli_query($mysqli, $requests_query);

$today_query = "SELECT * FROM borrowed_item WHERE item_type != 'consumable' AND DATE(request_date) = CURDATE()";
$today_result = mysqli_query($mysqli, $today_query);

$tomorrow_query = "SELECT * FROM borrowed_item WHERE item_type != 'consumable' AND DATE(request_date) = DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
$tomorrow_result = mysqli_query($mysqli, $tomorrow_query);

$passed_query = "SELECT * FROM borrowed_item WHERE item_type != 'consumable' AND DATE(request_date) < CURDATE()";
$passed_result = mysqli_query($mysqli, $passed_query);

$total_alerts = mysqli_num_rows($requests_result) + mysqli_num_rows($today_result) + mysqli_num_rows($tomorrow_result) + mysqli_num_rows($passed_result);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            background-color: #044e85;
            overflow: hidden;
        }

        .sidebar a {
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #1d6193;
        }

        /* Notification Styles */
        .notification-container {
            max-width: 800px; /* Increased max-width for better readability */
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .notification {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .notification:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .notification .avatar {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 15px;
        }

        .notification .details {
            flex: 1;
        }

        .notification .title {
            font-weight: bold;
            color: #333; /* Darkened title color for better readability */
        }

        .notification .message {
            color: #666;
            margin-top: 5px; /* Added margin-top for better separation */
        }
        .notification .message a {
            color: #007bff; /* Blue color for links */
            text-decoration: none;
        }

        .notification .message a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <a href="admin-dashboard.php">Back</a>
    </div>
    <div class="notification-container">
        <?php
while ($request_row = mysqli_fetch_assoc($requests_result)) {
    $name = $request_row['rname'];
    $image_query = mysqli_query($mysqli, "SELECT image_path FROM account WHERE username = '$name'");
    $image_row = mysqli_fetch_assoc($image_query);
    $image_path = $image_row['image_path'];

    echo "<div class='notification'>";
    echo "<img src='" . $image_path . "' alt='Avatar' class='avatar'>";
    echo "<div class='details'>";
    echo "<div class='title'>Request Notification</div>";
    echo "<div class='message'>" . $request_row['rname'] . " has requested <b>" . $request_row['request_no'] . "</b> of <b>" . $request_row['equipment_name'] . "</b>. Reason: <u>";
    
    if (!empty($request_row['reason'])) {
        echo $request_row['reason'];
    } else {
        echo "N/A";
    }
    
    echo "</u>. <a href='request.php'>See</a></div>";
    echo "</div>";
    echo "</div>";
}



        while ($today_row = mysqli_fetch_assoc($today_result)) {
    $name = $today_row['borrower'];
    $image_query = mysqli_query($mysqli, "SELECT image_path FROM account WHERE username = '$name'");
    $image_row = mysqli_fetch_assoc($image_query);
    $image_path = $image_row['image_path'];

    echo "<div class='notification'>";
    echo "<img src='" . $image_path . "' alt='Avatar' class='avatar'>";
            echo "<div class='details'>";
            echo "<div class='title'>Due Today Notification</div>";
            echo "<div class='message'>The Equipment <b>" . $today_row['equipment_name'] . "</b> borrowed by <b>" . $today_row['borrower'] . "</b> is due today. <a href='borrowed_items.php'>See</a></div>";
            echo "</div>";
            echo "</div>";
        }

        while ($tomorrow_row = mysqli_fetch_assoc($tomorrow_result)) {
    $name = $tomorrow_row['borrower'];
    $image_query = mysqli_query($mysqli, "SELECT image_path FROM account WHERE username = '$name'");
    $image_row = mysqli_fetch_assoc($image_query);
    $image_path = $image_row['image_path'];

    echo "<div class='notification'>";
    echo "<img src='" . $image_path . "' alt='Avatar' class='avatar'>";
            echo "<div class='details'>";
            echo "<div class='title'>Due Tomorrow Notification</div>";
            echo "<div class='message'>The Equipment <b>" . $tomorrow_row['equipment_name'] . "</b> borrowed by <b>" . $tomorrow_row['borrower'] . "</b> is due tomorrow. <a href='borrowed_items.php'>See</a></div>";
            echo "</div>";
            echo "</div>";
        }

        while ($passed_row = mysqli_fetch_assoc($passed_result)) {
    $name = $passed_row['borrower'];
    $image_query = mysqli_query($mysqli, "SELECT image_path FROM account WHERE username = '$name'");
    $image_row = mysqli_fetch_assoc($image_query);
    $image_path = $image_row['image_path'];

    echo "<div class='notification'>";
    echo "<img src='" . $image_path . "' alt='Avatar' class='avatar'>";
            echo "<div class='details'>";
            echo "<div class='title'>Passed Due Date Notification</div>";
            echo "<div class='message'>The Equipment <b>" . $passed_row['equipment_name'] . "</b> borrowed by <b>" . $passed_row['borrower'] . "</b> has passed its due date. <a href='borrowed_items.php'>See</a></div>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>