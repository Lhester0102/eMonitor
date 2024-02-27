<?php
	include_once("config.php");
	$rs=mysqli_query($mysqli, "select * from account");
    session_start();
    $name = $_SESSION['username'];
    $email_query = mysqli_query($mysqli, "SELECT * FROM account WHERE username = '$name'");
    if($email_query) {
        $row = mysqli_fetch_array($email_query);
        $email = $row['email'];
        $_SESSION['email'] = $email;
    } else {
        $email = "Email not found";
    }
?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Dashboard</title>
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
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><?php echo $email;?></a>
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

	<div class="col-sm-12" style="text-align:center;color:black">
		<div class="well ms-5 me-5 mt-2" style="text-align:center;background:blue;color:white">
			<h1>Admin Dashboard</h1>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="well">
					<div class="card ms-5 me-5 mt-3 p-3">
						<h1>SUPPLY OFFICER</h1>
						<p>
						<h1><b>





							<?php
    $rs = mysqli_query($mysqli, "SELECT * FROM account WHERE user_type = 'supply_user'");
    $rowCount = mysqli_num_rows($rs);
    echo $rowCount;
?>


						</b></h1>
						</p>
						<p><a href="supply_officer.php">Full Details</a></p>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="well">
					<div class="card ms-5 me-5 mt-3 p-3">
						<h1>INSTRUCTORS</h1>
						<p>
						<h1><b>





							<?php
    $rs = mysqli_query($mysqli, "SELECT * FROM account WHERE user_type = 'user'");
    $rowCount = mysqli_num_rows($rs);
    echo $rowCount;
?>


						</b></h1>
						</p>
						<p><a href="instructor.php">Full Details</a></p>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="well">
					<div class="card ms-5 me-5 mt-3 p-3">
						<h1>INVENTORY</h1>
						<?php
						include_once("config.php");
						$dash_category_query = "SELECT * from inventory";
						$dash_category_query_run = mysqli_query($mysqli, $dash_category_query);
						if ($category_total = mysqli_num_rows($dash_category_query_run)) {
							echo '<p><h1><b>' . $category_total . ' </b></h1></p> ';
						} else {
							echo '<p><h1><b> No Data </b></h1></p> ';
						}
						?>
						<p><a href="index.php">Full Details</a></p>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="well">
					<div class="card ms-5 me-5 mt-3 p-3">
						<h1>REPORTS</h1>
						<p>
						<h1><b>





							<?php
    $rs = mysqli_query($mysqli, "SELECT * FROM inventory WHERE request = '1'");
    $rowCount = mysqli_num_rows($rs);
    echo $rowCount;
?>


						</b></h1>
						</p>
						<p><a href="reports.php">Full Details</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>