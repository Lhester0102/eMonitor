<?php
session_start();
include_once("config.php");
$name = $_SESSION['username'];
	$rs=mysqli_query($mysqli, "select * from inventory");
	$rt=mysqli_query($mysqli, "select * from request");


?>
<!DOCTYPE html>
<html>
	<head>
		<title>Request</title>
		<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">DCCP</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav">
				<li class="nav-item">
						<a class="nav-link" href="user_dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="Borrow_list.php">Borrowed Items</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="request_index.php">Request</a>
					</li>
			</ul>
			<div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
			<ul class="navbar-nav">
			<li class="nav-item">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">admin@gmail.com</a>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="#">Profile</a></li>
					<li><a class="dropdown-item" href="#">Settings</a></li>
					<li><a class="dropdown-item" href="log-out.php">Sign Out</a></li>
				</ul>
				</li>
			</li>
		</ul>
		</div>
			</div>
		</div>
		</nav>
		<table class="table table-striped w-75" border="1px" align="center">
			<thead >
				<tr align="center" >
					<th><b>ID</b></th>
					<th><b>Barode ID</b></th>
					<th><b>Equipment Name</b></th>
					<th><b>Equipment Brand</b></th>
					<th><b>Available</b></th>
					<th colspan="2"><b>Action</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
while ($res = mysqli_fetch_array($rs)) {
    // Assuming you have a query to fetch $ret based on $res['id']
    $rt = mysqli_query($mysqli, "SELECT * FROM request WHERE id = " . $res['id']);
    
    // Check if there are rows in $rt for the current $res['id']
    if ($ret = mysqli_fetch_array($rt)) {
        if ($ret['rname'] == $name) {
            echo "<tr align='center'>";
            echo "<td>" . $res['id'] . "</td>";
            echo "<td>" . $res['item_code'] . "</td>";
            echo "<td>" . $res['equipment_name'] . "</td>";
            echo "<td>" . $res['equipment_brand'] . "</td>";
            echo "<td>" . $res['quantity'] . "</td>";
            echo "<td><a class='btn btn-sm btn-danger' href='request_item.php?id=" . $res['id'] . "&action=cancel'>Cancel Request</a></td>";
            echo "</tr>";
        }
    } elseif ($res['request'] == 0) {
        // Display only if there is no corresponding entry in $rt
        echo "<tr align='center'>";
        echo "<td>" . $res['id'] . "</td>";
        echo "<td>" . $res['item_code'] . "</td>";
        echo "<td>" . $res['equipment_name'] . "</td>";
        echo "<td>" . $res['equipment_brand'] . "</td>";
        echo "<td>" . $res['quantity'] . "</td>";
        echo "<td><a class='btn btn-sm btn-warning' href='request_item.php?id=" . $res['id'] . "&action=request'>Request Item</a></td>";
        echo "</tr>";
    }
}
?>


			</tbody>
		</table>
	</body>
</html>