<?php
session_start();
include_once("config.php");

if (isset($_GET['id'])) {
    $inventory_id = $_GET['id'];

    // Retrieve the inventory information from the archive table
    $sql = "SELECT * FROM archive_inventory WHERE id = '$inventory_id'";
    $result = mysqli_query($mysqli, $sql);
    $inventory = mysqli_fetch_assoc($result);

    if ($inventory) {
        // Move the inventory information back to the main table
        $unarchiveSql = "INSERT INTO inventory (id, item_code, equipment_name, equipment_brand, equipment_model, equipment_type, quantity, borrow_id, date_request, date_return, reason) 
                       VALUES ('{$inventory['id']}', '{$inventory['item_code']}', '{$inventory['equipment_name']}', '{$inventory['equipment_brand']}', '{$inventory['equipment_model']}', '{$inventory['equipment_type']}', '{$inventory['quantity']}', '{$inventory['borrow_id']}', '{$inventory['date_request']}', '{$inventory['date_return']}', '{$inventory['reason']}')";
        mysqli_query($mysqli, $unarchiveSql);

        // Delete the inventory information from the archive table
        $deleteSql = "DELETE FROM archive_inventory WHERE id = '$inventory_id'";
        mysqli_query($mysqli, $deleteSql);

        // Redirect to the main page with a success message
        header("Location: inventoryArchive.php?unarchive_success=1");
        exit();
    }
}

// If the inventory ID is not provided or the inventory doesn't exist, redirect to the main page with an error message
header("Location: index.php?error=1");
exit();
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Unarchive</title>
    </head>
    <body>
        <a href="###">Back</a>
        <table class="table table-striped" border="1px" align="center">
		<thead>
			<tr align="center">
				<th><b>ID</b></th>
				<th><b>Barode ID</b></th>
				<th><b>Equipment Name</b></th>
				<th><b>Equipment Brand</b></th>
				<th><b>Quantity</b></th>
				<th colspan="2"><b>Action</b></th>
			</tr>
			</thead>
			<tbody>
			<?php
				while($res=mysqli_fetch_array($rs))
				{
					echo"<tr> <td>".$res['id']."</td>";
					echo"<td>".$res['item_code']."</td>";
					echo"<td>".$res['equipment_name']."</td>";
					echo"<td>".$res['equipment_brand']."</td>";
					echo"<td>".$res['quantity']."</td>";
					echo"<td><a class='btn btn-sm btn-warning' href='edit.php?id=$res[id]'>Edit</a></td>";
					echo"<td><a class='btn btn-sm btn-danger' href='delete_inventory.php?id=$res[id]'>Archive This</a></td></tr>";
				}
			?>
			</tbody>
		</table>
		<a href="admin-dashboard.php">Back</a>
	</body>
</html>