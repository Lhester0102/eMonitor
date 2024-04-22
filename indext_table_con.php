<?php
// Include the database configuration file
include_once("config.php");

// Initialize the search term
$searchTerm = "";

// Check if the search button is clicked
if(isset($_POST['search_btn'])) {
    // Sanitize the search term to prevent SQL injection
    $searchTerm = mysqli_real_escape_string($mysqli, $_POST['search']);
    // Construct the query to search for items with the specified term
    $query = "SELECT inventory.*, COALESCE(SUM(borrowed_amount), 0) AS total_borrowed_amount 
              FROM inventory 
              LEFT JOIN borrowed_item ON inventory.id = borrowed_item.item_code 
              WHERE inventory.item_type = 'consumable'
              AND (inventory.id LIKE '%$searchTerm%' OR inventory.item_code LIKE '%$searchTerm%' OR inventory.equipment_name LIKE '%$searchTerm%' OR inventory.equipment_brand LIKE '%$searchTerm%' OR inventory.quantity LIKE '%$searchTerm%')
              GROUP BY inventory.id";
    // Execute the query
    $rs = mysqli_query($mysqli, $query);
} else {
    // If search button is not clicked, fetch all items
    $rs = mysqli_query($mysqli, "SELECT inventory.*, COALESCE(SUM(borrowed_amount), 0) AS total_borrowed_amount 
                                 FROM inventory 
                                 LEFT JOIN borrowed_item ON inventory.id = borrowed_item.item_code 
                                 WHERE inventory.item_type = 'consumable'
                                 GROUP BY inventory.id");
}

// Check if query execution was successful
if ($rs) {
    // Loop through the results and display them in a table
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
    // If query execution failed, display an error message
    echo "Error fetching inventory data: " . mysqli_error($mysqli);
}
?>
