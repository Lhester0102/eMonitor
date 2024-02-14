<?php
	include_once("config.php");
	$rs=mysqli_query($mysqli, "select * from inventory");
?>
<!DOCTYPE html>
<html>
	<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	</head>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<body>
		<h1 align="center">Instructor Product List</h1>
		<a class='btn btn-danger' href="log-in.php">Log-out</a>
		<table class="table table-striped" border="1px" align="center">
		<thead>
			<tr align="center">
				<th><b>ID</b></th>
				<th><b>Item Code</b></th>
				<th><b>Equipment Name</b></th>
				<th><b>Equipment Brand</b></th>
				<th><b>Quantity</b></th>
				<th><b>Borrow ID</b></th>
				<th><b>Date Request</b></th>
				<th><b>Date Return</b></th>
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
					echo"<td>".$res['borrow_id']."</td>";
					echo"<td>".$res['date_request']."</td>";
					echo"<td>".$res['date_return']."</td>";
				}
			?>
			</tbody>
		</table>
	</body>
</html>