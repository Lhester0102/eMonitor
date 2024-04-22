<?php
session_start();
include_once("config.php");
if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] !== "admin" && $_SESSION['user_type'] !== "supply_user")) {
    header("Location: log-out.php");
    exit();
}

$searchTerm = "";

if(isset($_POST['search_btn'])) {
    $searchTerm = mysqli_real_escape_string($mysqli, $_POST['search']);
    $query = "SELECT * FROM borrowed_item WHERE (item_code LIKE '%$searchTerm%' OR borrower LIKE '%$searchTerm%' OR equipment_name LIKE '%$searchTerm%') AND item_type = 'non-consumable'";
    $rs = mysqli_query($mysqli, $query);

    if(!$rs) {
        die("Error in SQL query: " . mysqli_error($mysqli));
    }
} elseif(isset($_POST['search_reset'])) {
    $searchTerm = "";
    $rs = mysqli_query($mysqli, "SELECT * FROM borrowed_item WHERE item_type = 'non-consumable'");

    if(!$rs) {
        die("Error in SQL query: " . mysqli_error($mysqli));
    }
} else {
    $rs = mysqli_query($mysqli, "SELECT * FROM borrowed_item WHERE item_type = 'non-consumable'");

    if(!$rs) {
        die("Error in SQL query: " . mysqli_error($mysqli));
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php include("navigations.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>



<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Borrowed Items</h3>
        </div>
        <div class="card-body">
            <div class="row">
            <div class="col-md-14 mb-3">

                    <form method="POST" class="search-form row g-3 align-items-center">
                        <div class="col-md-10">
                            
                            <input class="form-control" type="text" name="search" placeholder="Search" value="<?php echo $searchTerm; ?>">
                        </div>

                        <div class="col">
                            <button class="btn btn-success search-btn" type="submit" name="search_btn">Search</button>
                        </div>

                        <div class="col">
                        <button class="btn btn-secondary reset-btn" type="button" data-bs-toggle="modal" data-bs-target="#confirmResetModal">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                            <tr align="center">
                                <th><b>Barcode ID</b></th>
                                <th><b>Date Borrowed</b></th>
                                <th><b>Borrowed</b></th>
                                <th><b>Equipment Name</b></th>
                                <th><b>Borrowed Amount</b></th>
                                <th><b>Location</b></th>
                                <th><b>Return Date</b></th>
                                <th colspan="2"><b>Action</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Your table body content here -->
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
    $totalBorrowed = 0;
    if ($rs) {
        if (mysqli_num_rows($rs) > 0) {
            while($res=mysqli_fetch_array($rs))
            {
                echo"<tr>";
                echo"<td align='center'>".$res['item_code']."</td>";
                echo"<td align='center'>".$res['borrow_date']."</td>";
                echo"<td align='center'>".$res['borrower']."</td>";
                echo"<td align='center'>".$res['equipment_name']."</td>";
                echo"<td align='center'>".$res['borrowed_amount']."</td>";
                echo"<td align='center'>".$res['request_destination']."</td>";
                echo"<td align='center'>".$res['request_date']."</td>";
                echo "<td align='center'><a class='btn btn-sm btn-warning reset-item-btn' data-bs-toggle='modal' data-bs-target='#confirmResetModal' data-reset-link='return_a_item.php?id=".$res['useless']."&iid=".$res['item_code']."&use=a'>Reset</a></td>";
                echo"</tr>";
                // Increment total borrowed items by the amount of this specific item
                $totalBorrowed ++;
            }
        } else {
            echo "<tr align='center'><td colspan='8'><b>No item found.</b></td></tr>";
        }
    } else {
        echo "Error: Unable to fetch data from the borrowed_item table.";
    }
    // Print total items count after the table
    echo "<tfoot><tr><td colspan='9' align='center'><b>Total Borrowed List: $totalBorrowed</b></td></tr></tfoot>";
    ?>
    </tbody>
    
</table>
<!-- Confirm Reset Modal -->
<div class="modal fade" id="confirmResetModal" tabindex="-1" aria-labelledby="confirmResetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmResetModalLabel">Confirm Reset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to reset this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a id="resetItemLink" class="btn btn-primary" href="#" style="background-color: red; border-color: red; color: white;">Reset</a>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript to handle resetting item confirmation
    document.querySelectorAll('.reset-item-btn').forEach(item => {
        item.addEventListener('click', event => {
            const resetLink = item.getAttribute('data-reset-link');
            document.getElementById('resetItemLink').href = resetLink;
        });
    });


</script>
</body>
</html>
