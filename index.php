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
				<a class="nav-link" href="#">Supply Officers</a>
				</li>
				<li class="nav-item">
				<a class="nav-link" href="instructor.php">Instructors</a>
				</li>  
				<li class="nav-item">
				<a class="nav-link" href="index.php">Inventory</a>
				</li>
				<li class="nav-item">
				<a class="nav-link" href="#">Reports</a>
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
				<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">admin@gmail.com</a>
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
		<div class="sidebar">
			<a href="add.php">Add Product</a>
			<a href="unarchive.php">Archive List</a>
			<a href="match-product.php">Barcode</a>
		</div>
		<table class="table table-striped" border="1px" align="center">
			<thead>
				<tr align="center">
					<th><b>ID</b></th>
					<th><b>Barode ID</b></th>
					<th><b>Equipment Name</b></th>
					<th><b>Equipment Brand</b></th>
					<th><b>Quantity</b></th>
					<th colspan="2"><b>Action</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
					while($res=mysqli_fetch_array($rs))
					{
						echo"<tr> <td>".$res['id']."</td>";
						echo"<td>".$res['item_code']."</td>";
						echo"<td>".$res['equipment_name']."</td>";
						echo"<td>".$res['equipment_brand']."</td>";
						echo"<td>".$res['quantity']."</td>";
						echo"<td><a class='btn btn-sm btn-warning' href='edit.php?id=$res[id]'>Edit</a></td>";
						echo"<td><a class='btn btn-sm btn-danger' href='delete_inventory.php?id=$res[id]'>Archive This</a></td></tr>";
					}
				?>
			</tbody>
		</table>
	</body>
</html>