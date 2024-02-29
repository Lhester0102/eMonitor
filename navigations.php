

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