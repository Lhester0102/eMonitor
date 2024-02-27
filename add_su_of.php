<?php
	include_once("config.php");
	if(isset($_POST['btn_submit']))
	{
		$username=$_POST['item_code'];
		$password=$_POST['equipment_name'];
		$email=$_POST['equipment_brand'];
        $user_type="supply_user";
		$rs=mysqli_query($mysqli,"Insert Into account(username, password, email, user_type)values('$username','$password','$email','$user_type')");
		if($rs)
		{
			echo'<script>alert("Record Save Successfully)</script>';
			header("Location: supply_officer.php");
		}
		else
		{
			echo'<script>alert("Save Record Error")</script>';
			header("Location: supply_officer.php");
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
			<a href="supply_officer.php">Back</a>
		</div>
		<form method="post" action="#">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-6">
						<div class="card shadow">
							<form method="post" action="#">
								<div class="mb-3">
									<label for="item_code" class="form-label">Username:</label>
									<input type="text" class="form-control" id="item_code" name="item_code" placeholder="Enter the Username" required>
								</div>
								<div class="mb-3">
									<label for="equipment_name" class="form-label">Password:</label>
									<input type="text" class="form-control" id="equipment_name" name="equipment_name" placeholder="Equipment Password" required>
								</div>
								<div class="mb-3">
									<label for="equipment_brand" class="form-label">Email:</label>
									<input type="text" class="form-control" id="equipment_brand" name="equipment_brand" placeholder="Equipment Email" required>
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
		</script>
	</body>
</html>