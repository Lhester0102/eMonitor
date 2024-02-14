<?php
    include_once("config.php");
    $id=$_REQUEST['id'];
	$itemCode="";
	$equipName="";
	$equipBrand="";
	$equipMOdel="";
	$equipType="";
	$quantity="";
	$borrowId="";
	$dateRequest="";
	$dateReturn="";
	$reaSon="";
	$rs=mysqli_query($mysqli,"select * from inventory where id=$id");
	if($result=mysqli_fetch_array($rs))
	{
		$itemCode=$result['item_code'];
		$equipName=$result["equipment_name"];
		$equipBrand=$result["equipment_brand"];
		$equipModel=$result["equipment_model"];
		$equipType=$result["equipment_type"];
		$quantity=$result["quantity"];
		$borrowId=$result["borrow_id"];
		$dateRequest=$result["date_request"];
		$dateReturn=$result["date_return"];
		$reaSon=$result["reason"];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Edit Inventory Admin</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></head>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	</head>
	<body>
		<h1>Edit Inventory (Admin)</h1>
		<form method="post" action="update_inventory.php">
			<table border="1px">
				<tr>
					<td>ID:</td>
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<td><?php echo $id ?></td>
				</tr>
				<tr>
					<td>Item Code:</td>
					<td><input type="text" name="update_itemCode" value="<?php echo $itemCode; ?>" placeholder="Enter the item code" required></td>
				</tr>
				<tr>
					<td>Equipment Name:</td>
					<td><input type="text" name="update_equipName" value="<?php echo $equipName; ?>" placeholder="Equipment name" required></td>
				</tr>
				<tr>
					<td>Equipment Brand:</td>
					<td><input type="text" name="update_equipBrand" value="<?php echo $equipBrand; ?>" placeholder="Equipment brand" required></td>
				</tr>
				<tr>
					<td>Equipment Model:</td>
					<td><input type="text" name="update_equipModel" value="<?php echo $equipModel; ?>" placeholder="Equipment model" required></td>
				</tr>
				<tr>
					<td>Equipment Type:</td>
					<td><input type="text" name="update_equipType" value="<?php echo $equipType; ?>" placeholder="Enter the equipment type" required></td>
				</tr>
				<tr>
					<td>Quantity:</td>
					<td><input type="number" name="update_quantity" value="<?php echo $quantity; ?>" placeholder="Quantity" required></td>
				</tr>
				<tr>
					<td>Borrow ID:</td>
					<td><input type="number" name="update_borrowId" value="<?php echo $borrowId; ?>" placeholder="Borrow ID" required></td>
				</tr>
				<tr>
					<td>Date Request:</td>
					<td><input type="date" name="update_dateRequest" value="<?php echo $dateRequest; ?>" placeholder="Date request" required></td>
				</tr>
				<tr>
					<td>Date Return:</td>
					<td><input type="date" name="update_dateReturn" value="<?php echo $dateReturn; ?>" placeholder="Date return" required></td>
				</tr>
				<tr>
					<td>Reason:</td>
					<td><textarea name="update_reaSon" placeholder="What is your reason" required> <?php echo $reaSon; ?> </textarea></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="submit" name="btnSubmit" value="UPDATE"></td>
				</tr>
			</table>
		</form>
		<a href="index.php">Back</a>
	</body>
</html>