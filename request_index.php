
<?php
session_start();
include_once("config.php");
$name = $_SESSION['username'];
	$rs=mysqli_query($mysqli, "select * from inventory where quantity > 0");
	$rt=mysqli_query($mysqli, "select * from request_to_ph");

    $email_query = mysqli_query($mysqli, "SELECT * FROM account WHERE username = '$name'");
	if($email_query) {
        $row = mysqli_fetch_array($email_query);
        $email = $row['email'];
        $_SESSION['email'] = $email;
    } else {
        $email = "Email not found";
    }

        $image = empty($row['image']) ? "uploads/anonymous.png" : $row['image'];
        $_SESSION['image'] = $image;
    
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Request</title>
		<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	</head>
	<body>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
		
		<?php include 'navigation_user.php'; ?>

		<table class="table table-striped w-75" border="1px" align="center">
			<thead >
				<tr align="center" >
					<th><b>Barode ID</b></th>
					<th><b>Equipment Name</b></th>
					<th><b>Equipment Brand</b></th>
					<th><b>Available</b></th>
					<th><b>Item Type</b></th>
                    <th><b>Department</b></th>
					<th colspan="2"><b>Action</b></th>
				</tr>
			</thead>
			<tbody>
<?php
while ($res = mysqli_fetch_array($rs)) {

    $rt = mysqli_query($mysqli, "SELECT * FROM request_to_ph WHERE id = " . $res['id']);
    
    if ($ret = mysqli_fetch_array($rt)) {
        if ($ret['rname'] == $name) {
            echo "<tr align='center'>";
            echo "<td>" . $res['item_code'] . "</td>";
            echo "<td>" . $res['equipment_name'] . "</td>";
            echo "<td>" . $res['equipment_brand'] . "</td>";
            echo "<td>" . $res['quantity'] . "</td>";
            echo "<td>" . $res['item_type'] . "</td>";
            echo "<td>" . $res['Locate'] . "</td>"; // Make sure 'dept' column is present in $res array
            echo "<td><a class='btn btn-sm btn-danger' href='request_item.php?id=" . $res['id'] . "&action=cancel'>Cancel Request</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr align='center'>";
        echo "<td>" . $res['item_code'] . "</td>";
        echo "<td>" . $res['equipment_name'] . "</td>";
        echo "<td>" . $res['equipment_brand'] . "</td>";
        echo "<td>" . $res['quantity'] . "</td>";
        echo "<td>" . $res['item_type'] . "</td>";
        echo "<td>" . $res['Locate'] . "</td>"; // Make sure 'dept' column is present in $res array
        echo "<td><a class='btn btn-sm btn-warning' href='request_item_amout.php?id=" . $res['id'] . "&action=request&quantity=" . $res['quantity'] . "&user_type=user'>Request Item</a></td>";
        echo "</tr>";
    }
}
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quantity = <?php echo $quantity; ?>;
        
        document.querySelector('form').addEventListener('submit', function(event) {
            var requestAmount = parseInt(document.querySelector('input[name="requesta"]').value);
            if (requestAmount > quantity) {
                event.preventDefault();
                alert('Error: Requested amount exceeds available quantity.');
                var hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'btnSubmit';
                hiddenInput.value = 'Request';
                this.appendChild(hiddenInput);
            }
        });
    });
</script>


			</tbody>
		</table>
	</body>
</html>