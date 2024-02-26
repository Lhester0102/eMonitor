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
		$item_type=$_POST['item_type'];
		$rs=mysqli_query($mysqli,"Insert Into inventory(item_code, equipment_name, equipment_brand, equipment_model, equipment_type, quantity, item_type)values('$i_code','$e_name','$e_brand','$e_model','$e_type','$quanty','$item_type')");
		if($rs)
		{
			echo'<script>alert("Record Save Successfully)</script>';
			header("Location: index.php");
		}
		else
		{
			echo'<script>alert("Save Record Error")</script>';
			header("Location: index.php");
		}
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title> View All Inventory </title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<style>
			body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .card {
            border: none;
            border-radius: 10px;
            padding: 20px;
            margin-top: 50px;
        }

        .card-title {
            color: #333;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn {
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .sidebar {
            width: 100%;
            background-color: #044e85;
            overflow: hidden;
        }

        .sidebar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .sidebar a:hover {
            background-color: #1d6193;
        }
		</style>
	</head>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<body>
		<div class="sidebar">
			<a href="index.php">Back</a>
		</div>
		<form method="post" action="#">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-6">
						<div class="card shadow">
							<form method="post" action="#">
								<div class="mb-3">
									<label for="item_code" class="form-label">Item Code:</label>
									<input type="text" class="form-control" id="item_code" name="item_code" placeholder="Enter the item code" required>
								</div>
								<div class="mb-3">
									<label for="equipment_name" class="form-label">Equipment Name:</label>
									<input type="text" class="form-control" id="equipment_name" name="equipment_name" placeholder="Equipment name" required>
								</div>
								<div class="mb-3">
									<label for="equipment_brand" class="form-label">Equipment Brand:</label>
									<input type="text" class="form-control" id="equipment_brand" name="equipment_brand" placeholder="Equipment brand" required>
								</div>
								<div class="mb-3">
									<label for="equipment_model" class="form-label">Equipment Model:</label>
									<input type="text" class="form-control" id="equipment_model" name="equipment_model" placeholder="Equipment model" required>
								</div>
								<div class="mb-3">
									<label for="equipment_type" class="form-label">Equipment Type:</label>
									<input type="text" class="form-control" id="equipment_type" name="equipment_type" placeholder="Enter the equipment type" required>
								</div>
								<div class="mb-3">
									<label for="quantity" class="form-label">Quantity:</label>
									<input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" required>
								</div>
								<div class="mb-3">
    								<label for="item_type" class="form-label">Item Type:</label>
    								<select class="form-select" id="item_type" name="item_type" required>
        								<option value="consumable">Consumable</option>
        								<option value="non-consumable">Non-Consumable</option>
    								</select>
								</div>
								<div class="d-grid gap-2">
									<button type="reset" class="btn btn-secondary">Reset</button>
									<button type="submit" name="btn_submit" class="btn btn-primary">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</form>
		
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