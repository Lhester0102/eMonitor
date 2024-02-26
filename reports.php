
<!DOCTYPE html>
<html>

<head>
	<title>Reports</title>
	<style>
		/* Set height of the grid so .sidenav can be 100% (adjust as needed) */
		.row.content {
			height: 550px
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


	<table class="table table-striped" border="1px" align="center">
    <thead>
        <tr align="center">
            <th><b>ID</b></th>
            <th><b>Item Code</b></th>
            <th><b>Equipment Name</b></th>
            <th><b>Equipment Brand</b></th>
            <th><b>Quantities</b></th>
            <th><b>Requester</b></th>
            <th><b>Actions</b></th>
        </tr>
    </thead>
    <tbody>



<?php
include_once("config.php");
$rs = mysqli_query($mysqli, "SELECT * FROM inventory");
while ($res = mysqli_fetch_array($rs)) {
    if ($res['request'] == 1) {
        echo "<tr> <td>" . $res['id'] . "</td>";
        echo "<td>" . $res['item_code'] . "</td>";
        echo "<td>" . $res['equipment_name'] . "</td>";
        echo "<td>" . $res['equipment_brand'] . "</td>";
        echo "<td>" . $res['quantity'] . "</td>";
        $rt = mysqli_query($mysqli, "SELECT rname FROM request WHERE id = " . $res['id']);
        if ($rt) {
            if (mysqli_num_rows($rt) > 0) {
                while ($ret = mysqli_fetch_array($rt)) {
                    echo "<td>" . $ret['rname'] . "</td>";
                }
            } else {
                echo "<td>No data found</td>";
            }
        } else {
            echo "<td>Error: " . mysqli_error($mysqli) . "</td>";
        }
        $acceptURL = 'request_manage.php?id=' . $res['id'] . '&action=accept';
        $denyURL = 'request_manage.php?id=' . $res['id'] . '&action=deny';
        echo "<td><a class='btn btn-sm btn-warning' href='$acceptURL'>Accept Request</a></td>";
        echo "<td><a class='btn btn-sm btn-danger' href='$denyURL'>Deny Request</a></td></tr>";
    }
}
?>





    </tbody>
</table>



</body>
</html>