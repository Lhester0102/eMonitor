<?php
    include_once("config.php");

    if(isset($_POST['btn_submit'])) {
        $i_code = $_POST['name'];
        $e_name = "0";
        $quanty = $_POST['quantity'];
        $e_brand = $_POST['measurement'];
        $item_type = $_POST['item_type'];
        $locate = $_POST['department'];
        $uploadDir = "inventory/";

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_name = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_path = $uploadDir . $image_name;

            if (move_uploaded_file($image_tmp, $image_path)) {
                $rs = mysqli_query($mysqli, "INSERT INTO merch(name, barcode, quantity, measurement, image) VALUES ('$i_code', '$e_name', '$quanty', '$e_brand','$image_path')");

                if($rs) {
    $id = mysqli_insert_id($mysqli); // Fetch the inserted ID
    header("Location: generator/generator.php?id=" . $id . "&code=0");
    exit();
                } else {
                    $error_message = "Error: Save Record Error";
                }
            } else {
                $error_message = "Error: Failed to upload image.";
            }
        } else {
            $error_message = "Error: Please select an image to upload.";
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
			<a href="general_index.php">Back</a>
		</div>
		<form method="post" action="#" enctype="multipart/form-data">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-6">
						<div class="card shadow">
							<form method="post" action="#">
								<div class="mb-3">
									<label for="name" class="form-label">Name:</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
								</div>
								<div class="mb-3">
									<label for="quantity" class="form-label">Quantity:</label>
									<input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" required>
								</div>
								<div class="mb-3">
									<label for="measurement" class="form-label">Measurement:</label>
									<input type="text" class="form-control" id="measurement" name="measurement" placeholder="Measuremt" required>
								</div>                                
	<div class="mb-3">
        <label for="image" class="form-label">Item Image:</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
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