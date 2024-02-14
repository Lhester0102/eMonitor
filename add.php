<?php
	include_once("config.php");
	if(isset($_POST['btn_submit']))
	{
		$i_code=$_POST['item_code'];
		$e_name=$_POST['equipment_name'];
		$e_brand=$_POST['equipment_brand'];
		$e_model=$_POST['equipment_model'];
		$e_type=$_POST['equipment_type'];
		$quanty=$_POST['quantity'];
		$b_id=$_POST['borrow_id'];
		$d_request=$_POST['date_request'];
		$d_return=$_POST['date_return'];
		$reason=$_POST['reason'];
		$rs=mysqli_query($mysqli,"Insert Into inventory(item_code, equipment_name, equipment_brand, equipment_model, equipment_type, quantity, borrow_id, date_request, date_return, reason)values('$i_code','$e_name','$e_brand','$e_model','$e_type','$quanty','$b_id','$d_request','$d_return','$reason')");
		if($rs)
		{
			echo'<script>alert("Record Save Successfully)</script>';
		}
		else
		{
			echo'<script>alert("Save Record Error")</script>';
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> View All Inventory </title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></head>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<body>
		<h1>Add Product (Admin)</h1>
		<form method="post" action="#">
			<table border="1px">
				<tr>
					<td>Item Code:</td>
					<td><input type="text" name="item_code" placeholder="Enter the item code" required></td>
				</tr>
				<tr>
					<td>Equipment Name:</td>
					<td><input type="text" name="equipment_name" placeholder="Equipment name" required></td>
				</tr>
				<tr>
					<td>Equipment Brand:</td>
					<td><input type="text" name="equipment_brand" placeholder="Equipment brand" required></td>
				</tr>
				<tr>
					<td>Equipment Model:</td>
					<td><input type="text" name="equipment_model" placeholder="Equipment model" required></td>
				</tr>
				<tr>
					<td>Equipment Type:</td>
					<td><input type="text" name="equipment_type" placeholder="Enter the equipment type" required></td>
				</tr>
				<tr>
					<td>Quantity:</td>
					<td><input type="number" name="quantity" placeholder="Quantity" required></td>
				</tr>
				<tr>
					<td>Borrow ID:</td>
					<td><input type="number" name="borrow_id" placeholder="Borrow ID" required></td>
				</tr>
				<tr>
					<td>Date Request:</td>
					<td><input type="date" name="date_request" placeholder="Date request" required></td>
				</tr>
				<tr>
					<td>Date Return:</td>
					<td><input type="date" name="date_return" placeholder="Date return" required></td>
				</tr>
				<tr>
					<td>Reason:</td>
					<td><textarea name="reason" placeholder="What is your reason" required></textarea></td>
				</tr>
				<tr>
					<td align="center"><input type="reset" name="btn_reset" value="RESET"></td>
					<td align="center"><input type="submit" name="btn_submit" value="SAVE"></td>
				</tr>
			</table>
		</form>
		<br>
		<a href="index.php" class="backButton" style="text-decoration: none;"><h1 class="font-family"><i class="fa-regular fa-circle-left" style="color: #525CEB;"></i>   BACK</h1></a>
	</body>
</html>