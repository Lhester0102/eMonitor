<?php
	include_once("config.php");
	$rs=mysqli_query($mysqli, "select * from account");
?>
<!DOCTYPE html>
<html>
	<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	</head>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<body>
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
				<a class="nav-link" href="#">Inventory</a>
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
			<a class="me-1 btn btn-primary" href="add.php">Add Supply Officer</a>
		</div>
		<table class="table table-striped w-75" border="1px" align="center">
			<thead >
				<tr align="center" >
					<th><b>UID</b></th>
					<th><b>Username</b></th>
					<th><b>Password</b></th>
					<th colspan="2"><b>Action</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
    while ($res = mysqli_fetch_array($rs)) {
        if ($res['user_type'] == 'supply_user') {
            echo "<tr align='center' ><td>" . $res['UID'] . "</td>";
            echo "<td>" . $res['username'] . "</td>";
            echo "<td>" . $res['password'] . "</td>";
            echo "<td><a class='btn btn-sm btn-warning' href=''>Edit User</a></td>";
            echo "<td><a class='btn btn-sm btn-danger' href=''>Delete User</a></td></tr>";
        }
    }
?>

			</tbody>
		</table>




	</body>
</html>