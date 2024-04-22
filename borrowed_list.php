<?php
	include_once("config.php");
	$searchTerm = "";

    if(isset($_POST['search_btn'])) {
        $searchTerm = mysqli_real_escape_string($mysqli, $_POST['search']);
        $query = "SELECT * FROM borrowed_item WHERE item_code LIKE '%$searchTerm%' OR equipment_name LIKE '%$searchTerm%' OR borrow_date LIKE '%$searchTerm%' OR borrower LIKE '%$searchTerm%'";
        $rs = mysqli_query($mysqli, $query);

        if(!$rs) {
            die("Error in SQL query: " . mysqli_error($mysqli));
        }
    } elseif(isset($_POST['search_reset'])) {
        $searchTerm = "";
        $rs = mysqli_query($mysqli, "SELECT * FROM borrowed_item");

        if(!$rs) {
            die("Error in SQL query: " . mysqli_error($mysqli));
        }
    } else {
        $rs = mysqli_query($mysqli, "SELECT * FROM borrowed_item");

        if(!$rs) {
            die("Error in SQL query: " . mysqli_error($mysqli));
        }
    }
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
    <tr>
        <form method="POST" class="row g-3 align-items-center">
            <th colspan="5">
                <input align='center' type="text" style="width: 100%;" name="search" placeholder="Search" value="<?php echo $searchTerm; ?>" >
            </th>
            <th colspan="1.5">
                <input class='btn btn-sm'  type="submit" value="Search" name="search_btn" style="width: 100%; height: 100%; background-color: green; color: white;">
            </th>
            <th colspan="1.5">
                <input class='btn btn-sm'  type="submit" value="Reset" name="search_reset" style="width: 100%; height: 100%; background-color: gray; color: white;">
            </th>
        </form>
    </tr>
			<tr align="center">
				<th><b>Item ID</b></th>
				<th><b>Date Borrowed</b></th>
				<th><b>Borrowed</b></th>
				<th><b>Equipment Name</b></th>
				<th><b>Useless</b></th>
				<th colspan="2"><b>Action</b></th>
			</tr>
			</thead>
			<tbody>
			<?php
				while($res=mysqli_fetch_array($rs))
				{
					echo"<td align='center'>".$res['item_code']."</td>";
					echo"<td align='center'>".$res['borrow_date']."</td>";
					echo"<td align='center'>".$res['borrower']."</td>";
					echo"<td align='center'>".$res['equipment_name']."</td>";
					echo"<td align='center'>".$res['useless']."</td>";
					echo"<td  align='center' colspan='2'><a class='btn btn-sm btn-warning' href=''>Reset</a></td></tr>";
				}
			?>
			</tbody>
		</table>
	</body>
</html>