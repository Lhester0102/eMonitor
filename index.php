<?php
	include_once("config.php");
	$rs=mysqli_query($mysqli, "select * from inventory");
?>
<!DOCTYPE html>
<html>
	<head>
		<title> View All </title>
	</head>
	<body>
		<table border="1px" align="center">
			<tr align="center">
				<td><b>ID</b></td>
				<td><b>Item Code</b></td>
				<td><b>Equipment Name</b></td>
				<td><b>Equipment Brand</b></td>
				<td><b>Equipment Model</b></td>
				<td><b>Equipment Type</b></td>
				<td><b>Quantity</b></td>
				<td><b>Borrow ID</b></td>
				<td><b>Date Request</b></td>
				<td><b>Date Return</b></td>
				<td><b>Reason</b></td>
				<td colspan="2">Action</td>
			</tr>
			<?php
				while($res=mysqli_fetch_array($rs))
				{
					echo"<tr> <td>".$res['id']."</td>";
					echo"<td>".$res['item_code']."</td>";
					echo"<td>".$res['equipment_name']."</td>";
					echo"<td>".$res['equipment_brand']."</td>";
					echo"<td>".$res['equipment_model']."</td>";
					echo"<td>".$res['equipment_type']."</td>";
					echo"<td>".$res['quantity']."</td>";
					echo"<td>".$res['borrow_id']."</td>";
					echo"<td>".$res['date_request']."</td>";
					echo"<td>".$res['date_return']."</td>";
					echo"<td>".$res['reason']."</td>";
					echo"<td><button>Add</button></td>";
					echo"<td><button>Delete</button></td></tr>";
				}
			?>
		</table>
	</body>
</html>