<?php
	include_once("config.php");
	$searchTerm = "";
    if(isset($_POST['search_btn'])) {
        $searchTerm = mysqli_real_escape_string($mysqli, $_POST['search']);
        $query = "SELECT * FROM inventory WHERE id LIKE '%$searchTerm%' OR item_code LIKE '%$searchTerm%' OR equipment_name LIKE '%$searchTerm%' OR equipment_brand LIKE '%$searchTerm%' OR quantity LIKE '%$searchTerm%'";
        $rs = mysqli_query($mysqli, $query);
    } else {
        $rs = mysqli_query($mysqli, "SELECT * FROM inventory");
    }
?>
<form method="POST" class="row g-3 align-items-center">
	<table class="table table-striped" border="1px" align="center" style="width: 80%">
		<thead>
			<tr>
				<th colspan="7"> 
					<input align='center' type="text" style="width: 100%;" name="search" placeholder="Search" value="<?php echo $searchTerm; ?>" > 
				</th> 
				<th>
					<input class='btn btn-sm'  type="submit" value="Search" name="search_btn" style="width: 100%; height: 100%; background-color: green; color: white;">
				</th> 
				<th>
					<input class='btn btn-sm'  type="submit" value="Reset" name="search_reset" style="width: 100%; height: 100%; background-color: gray; color: white;">
				</th>
			</tr>
			<tr align="center" >
				<th><b>ID</b></th>
				<th><b>Barode ID</b></th>
				<th><b>Equipment Name</b></th>
				<th><b>Equipment Brand</b></th>
				<th><b>Available No.</b></th>
				<th><b>Borrowed No.</b></th>
				<th><b>Item Type</b></th>
				<th colspan="2"><b>Action</b></th>
			</tr>
		</thead>
	<tbody>
		<?php
			$query = "SELECT inventory.*, COALESCE(SUM(borrowed_amount), 0) AS total_borrowed_amount 
					  FROM inventory 
					  LEFT JOIN borrowed_item ON inventory.id = borrowed_item.item_code 
					  GROUP BY inventory.id";

			$rs = mysqli_query($mysqli, $query);

			if ($rs) {
				while ($res = mysqli_fetch_array($rs)) {
					echo "<tr>";
					echo "<td>" . $res['id'] . "</td>";
					echo "<td>" . $res['item_code'] . "</td>";
					echo "<td>" . $res['equipment_name'] . "</td>";
					echo "<td>" . $res['equipment_brand'] . "</td>";
					echo "<td>" . $res['quantity'] . "</td>";
					echo "<td>" . $res['total_borrowed_amount'] . "</td>"; // Display total borrowed amount
					echo "<td>" . $res['item_type'] . "</td>";
					echo "<td><a class='btn btn-warning' href='edit.php?id={$res['id']}'>Edit</a></td>";
					echo "<td><a class='btn btn-danger' href='#' onclick='archiveItemConfirmation({$res['id']});'>Archive</a></td>";
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan='9'>Error fetching inventory data: " . mysqli_error($mysqli) . "</td></tr>";
			}
		?>
	</tbody>
	</table>
</form>
