<?php
include_once("config.php");
$rs = mysqli_query($mysqli, "select * from account");
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
	<!--  -->
	<?php include("navigations.php"); ?>
	<div class="card w-75 mt-2" style="margin:auto;">
		<div class="card-header">
			<h3>Supply Officers</h3>
		</div>
		<div class="card-body">
			<div class="table-responsive">

				<div class="sidebar p-1">
					<a class="me-1 btn btn-primary" href="add_su_of.php">Add Supply Officer</a>
				</div>

				<table class="table table-striped table-hover w-100">
					<thead>
						<tr align="center">
							<th><b>UID</b></th>
							<th><b>Username</b></th>
							<th><b>Password</b></th>
							<th><b>Email</b></th>
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
								echo "<td>" . $res['email'] . "</td>";
								echo "<td><a class='btn btn-sm btn-warning' href='edit_user.php?id=$res[UID]'>Edit User</a></td>";
								echo "<td><a class='btn btn-sm btn-danger' href='delete_user.php?id=$res[UID]'>Delete User</a></td></tr>";
							}
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>

</html>