<?php
	include_once("config.php");
	$rs=mysqli_query($mysqli, "select * from inventory");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>e-Monitor</title>
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
						<a class="nav-link" href="admin-dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="supply_officer.php">Supply Officers</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="instructor.php">Instructors</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="borrowed_items.php">Borrowed Items</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php">Inventory</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="request.php">Requests</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="reports.php">Reports</a>
					</li>
				<!-- <li class="nav-item dropdown" stylesheet="float:right">
				<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Dropdown</a>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="#">Link</a></li>
					<li><a class="dropdown-item" href="#">Another link</a></li>
					<li><a class="dropdown-item" href="#">A third link</a></li>
				</ul>
				</li> -->
			</ul>
			<div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
			<ul class="navbar-nav">
			<li class="nav-item">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><?php session_start(); $email = $_SESSION['email']; echo $email;?></a>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="#">Profile</a></li>
					<li><a class="dropdown-item" href="#">Settings</a></li>
					<li><a class="dropdown-item" href="log-in.php">Sign Out</a></li>
				</ul>
				</li>
			</li>
		</ul>
		</div>
			</div>
		</div>
		</nav>
		<div class="sidebar p-1">
			<a class="me-1 btn btn-primary" href="add.php">Add Product</a>
			<a class="me-1 btn btn-secondary"   href="unarchive.php">Archive List</a>
			<a class="me-1 btn btn-secondary"  href="borrowed_list.php">Borrowed List</a>
			<a class="me-1 btn btn-success"  href="match-product.php">Barcode</a>
			<a class="me-1 btn btn-primary" onclick="toggleText()">Switch Item Type</a>
		</div><br>
		<table class="table table-striped w-75" border="1px" align="center">
			<thead >
				<tr align="center" >
					<th><b>ID</b></th>
					<th><b>Barode ID</b></th>
					<th><b>Equipment Name</b></th>
					<th><b>Equipment Brand</b></th>
					<th><b>Available No.</b></th>
					<th><b>Borrowed No.</b></th>
					<th><b>Item Type</b></th>
					<th colspan="2"><b>Action</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
    while ($res = mysqli_fetch_array($rs)) {
        $itemTypeClass = ($res['item_type'] == 'consumable') ? 'consumable' : 'non-consumable';

        echo "<tr align='center' class='$itemTypeClass'> <td>" . $res['id'] . "</td>";
        echo "<td>" . $res['item_code'] . "</td>";
        echo "<td>" . $res['equipment_name'] . "</td>";
        echo "<td>" . $res['equipment_brand'] . "</td>";
        echo "<td>" . $res['quantity'] . "</td>";
        echo "<td>" . $res['borrow_no'] . "</td>";
        echo "<td>" . $res['item_type'] . "</td>";
        echo "<td><a class='btn btn-sm btn-warning' href='edit.php?id=$res[id]'>Edit</a></td>";
        echo "<td><a class='btn btn-sm btn-danger' href='delete_inventory.php?id=$res[id]'>Archive This</a></td></tr>";
    }
?>
			</tbody>
		</table>


<script>
    var showConsumable = false;

    function toggleText() {
        showConsumable = !showConsumable; // Toggle the flag

        var consumableRows = document.getElementsByClassName("consumable");
        var nonConsumableRows = document.getElementsByClassName("non-consumable");

        for (var i = 0; i < consumableRows.length; i++) {
            consumableRows[i].style.display = 'none';
        }
        for (var i = 0; i < nonConsumableRows.length; i++) {
            nonConsumableRows[i].style.display = 'none';
        }

        if (showConsumable) {
            for (var i = 0; i < consumableRows.length; i++) {
                consumableRows[i].style.display = 'table-row';
            }
        } else {
            for (var i = 0; i < nonConsumableRows.length; i++) {
                nonConsumableRows[i].style.display = 'table-row';
            }
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        var nonConsumableRows = document.getElementsByClassName("non-consumable");
        for (var i = 0; i < nonConsumableRows.length; i++) {
            nonConsumableRows[i].style.display = 'table-row';
        }
    });
</script>
	</body>
</html>