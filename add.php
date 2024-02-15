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
		$rs=mysqli_query($mysqli,"Insert Into inventory(item_code, equipment_name, equipment_brand, equipment_model, equipment_type, quantity)values('$i_code','$e_name','$e_brand','$e_model','$e_type','$quanty')");
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
					<td><input type="text" name="item_code"  id="item_code"  placeholder="Enter the item code" required></td>
				</tr>
				<tr>
					<td>Equipment Name:</td>
					<td><input type="text" name="equipment_name"   id="equipment_name"  placeholder="Equipment name" required></td>
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
					<td align="center"><input type="reset" name="btn_reset" value="RESET"></td>
					<td align="center"><input type="submit" name="btn_submit" value="SAVE"></td>
				</tr>
			</table>
		</form>
		<br>
		<a href="index.php">Back</a>
		

		<script>
document.addEventListener('DOMContentLoaded', function() {
    var scannedValue = ''; // Variable to accumulate scanned barcode

    // Timestamp of the last keypress
    var lastKeypressTimestamp = 0;

    // Delay threshold between consecutive keypresses (in milliseconds)
    var keypressDelayThreshold = 50;

    document.addEventListener('keypress', function(event) {
        var currentTimestamp = new Date().getTime();

        // Calculate the time difference between this and the last keypress
        var timeDiff = currentTimestamp - lastKeypressTimestamp;

        // Reset scannedValue if there was a long delay between keypresses (indicating manual typing)
        if (timeDiff > keypressDelayThreshold * 2) {
            scannedValue = '';
        }

        // Update the lastKeypressTimestamp with the current timestamp
        lastKeypressTimestamp = currentTimestamp;

        // Append the pressed key to scannedValue
        scannedValue += event.key;-

        // Check if the value is a valid barcode
        if (isValidBarcode(scannedValue)) {
            // Do something with the valid barcode (e.g., assign it to a field)
            document.getElementById('item_code').value = scannedValue;
        }
    });
});

function isValidBarcode(value) {
    return /^[a-zA-Z0-9]+$/.test(value);
}

</script>


	</body>
</html>