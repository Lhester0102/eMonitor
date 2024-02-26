<?php
	include_once("config.php");
	$rs=mysqli_query($mysqli, "select * from  borrowed_item");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>e-Monitor | Borrowed List</title>
		<style>
			body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	</head>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<body>
		<div class="sidebar">
			<a href="index.php">Back</a>
		</div><br>
		<table class="table table-striped w-75" border="1px" align="center">
		<thead>
			<tr align="center">
				<th><b>Item ID</b></th>
				<th><b>Date Borrowed</b></th>
				<th><b>Borrowed</b></th>
				<th colspan="2"><b>Action</b></th>
			</tr>
			</thead>
			<tbody>
			<?php
				while($res=mysqli_fetch_array($rs))
				{
					echo"<td align='center'>".$res['item-code']."</td>";
					echo"<td align='center'>".$res['borrow-date']."</td>";
					echo"<td align='center'>".$res['borrower']."</td>";
					echo"<td  align='center'><a class='btn btn-sm btn-warning' href=''>Reset</a></td></tr>";
				}
			?>
			</tbody>
		</table>
	</body>
</html>