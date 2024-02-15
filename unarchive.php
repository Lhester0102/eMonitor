<?php
	include_once("config.php");
	$rs=mysqli_query($mysqli, "select * from  archive_inventory");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>e-Monitor</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	</head>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<body>
		<h1 align="center">Archive List (Admin)</h1>
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
					echo"<td><a class='btn btn-sm btn-danger' href='unarchive_item.php?id=$res[id]'>Unarchive This</a> &nbsp;&nbsp; <a class='btn btn-sm btn-danger' href='permanent_delete.php?id=$res[id]'>Permanent Delete</a></td></tr>";
				}
			?>
			</tbody>
		</table>
		<a href="index.php">Back</a>
	</body>
</html>