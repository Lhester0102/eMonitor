<?php
session_start();
include_once("config.php");
$name = $_SESSION['username'];
$email_query = mysqli_query($mysqli, "SELECT * FROM account WHERE username = '$name'");
$email = $_SESSION['email'];
$image = "uploads/anonymous.png";

if ($email_query) {
    $row = mysqli_fetch_array($email_query);
    if ($row !== null) {
        $email = $row['email'];
    }
}

$rt = mysqli_query($mysqli, "SELECT * FROM archive_inventory where item_type = 'non-consumable'");

$searchTerm = "";
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$start = ($page - 1) * $limit;


if (isset($_POST['search_barcode'])) {
    $searchTerm = mysqli_real_escape_string($mysqli, $_POST['barcode_search']);
    $query = "SELECT inventory.*, COALESCE(SUM(borrowed_item.borrowed_amount), 0) AS total_borrowed_amount 
              FROM inventory 
              LEFT JOIN (SELECT item_code, SUM(borrowed_amount) AS borrowed_amount FROM borrowed_item GROUP BY item_code) AS borrowed_item 
              ON inventory.id = borrowed_item.item_code 
              WHERE (inventory.item_code LIKE '%$searchTerm%')
              AND inventory.item_type = 'non-consumable'
              GROUP BY inventory.id
              LIMIT $start, $limit";
    $rs = mysqli_query($mysqli, $query);
} else {



if(isset($_POST['search_btn'])) {
    $searchTerm = mysqli_real_escape_string($mysqli, $_POST['search']);
    $query = "SELECT inventory.*, COALESCE(SUM(borrowed_item.borrowed_amount), 0) AS total_borrowed_amount 
              FROM inventory 
              LEFT JOIN (SELECT item_code, SUM(borrowed_amount) AS borrowed_amount FROM borrowed_item GROUP BY item_code) AS borrowed_item 
              ON inventory.id = borrowed_item.item_code 
              WHERE (inventory.id LIKE '%$searchTerm%' OR inventory.item_code LIKE '%$searchTerm%' OR inventory.equipment_name LIKE '%$searchTerm%' OR inventory.equipment_brand LIKE '%$searchTerm%' OR inventory.quantity LIKE '%$searchTerm%')
              AND inventory.item_type = 'non-consumable'
              GROUP BY inventory.id
              LIMIT $start, $limit";
    $rs = mysqli_query($mysqli, $query);
} else {
    $rs = mysqli_query($mysqli, "SELECT inventory.*, COALESCE(SUM(borrowed_amount), 0) AS total_borrowed_amount 
                                  FROM inventory 
                                  LEFT JOIN borrowed_item ON inventory.id = borrowed_item.item_code 
                                  WHERE inventory.item_type = 'non-consumable'
                                  GROUP BY inventory.id
                                  LIMIT $start, $limit");
}




}




$total_pages = ceil(mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM inventory WHERE item_type = 'non-consumable'")) / $limit);

$_SESSION['email'] = $email;


    if(isset($_POST['btn_submit']))
    {
        $i_code=$_POST['item_code'];
        $e_name=$_POST['equipment_name'];
        $e_brand=$_POST['equipment_brand'];
        $e_model=$_POST['equipment_model'];
        $quanty=$_POST['quantity'];
        $item_type="non-consumable";
        $rs=mysqli_query($mysqli,"Insert Into inventory(item_code, equipment_name, equipment_brand, equipment_model, quantity, item_type)values('$i_code','$e_name','$e_brand','$e_model','$quanty','$item_type')");
        if($rs)
        {
            echo'<script>alert("Record Save Successfully)</script>';
            header("Location: non_consumable.php");
        }
        else
        {
            echo'<script>alert("Save Record Error")</script>';
            header("Location: non_consumable.php");
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        .row.content {
            height: 550px
        }

        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }

        @media screen and (max-width: 767px) {
            .row.content {
                height: auto;
            }
        }
    </style>
</head>

<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <?php include 'navigation_supply_user.php'; ?>

    <div class="sidebar p-1">


        <a class="me-1 btn btn-primary" onclick="add()">Add Non-Consumable</a>
<script>
    function add() {
        var modalContent = `
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Add Non-Consumable</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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
                                    <label for="quantity" class="form-label">Quantity:</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" name="btn_submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Exit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        `;
        var existingModals = document.querySelectorAll('.modal');
        existingModals.forEach(modal => modal.remove());
        document.body.insertAdjacentHTML('beforeend', modalContent);
        var myModal = new bootstrap.Modal(document.getElementById('addProductModal'));
        myModal.show();
    }
</script>


    
<a class="me-1 btn btn-secondary" onclick="arc()">Archive List</a>

<script>
    function arc() {
        var modalContent = `
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Archive List</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="#">
                                <div class="mb-3" style="width: 100%; overflow-y: auto;">
                                    <table class="table table-striped" style="border: 1px solid #000;" align="center">
                                        <thead>
                                            <tr align="center">
                                                <th><b>Barcode ID</b></th>
                                                <th><b>Equipment Name</b></th>
                                                <th><b>Quantity</b></th>
                                                <th><b>Equipment Model</b></th>
                                                <th colspan="2"><b>Action</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($ret=mysqli_fetch_array($rt)) {
                                                    echo "<tr align='center'>";
                                                    echo "<td>".$ret['item_code']."</td>";
                                                    echo "<td>".$ret['equipment_name']."</td>";
                                                    echo "<td>".$ret['equipment_model']."</td>";
                                                    echo "<td>".$ret['quantity']."</td>";
                                                    echo "<td><a style='height:50%' class='btn btn-sm btn-danger' href='sunarchive_item.php?id=".$ret['id']."&type=non-consumable'>Restore</a>&nbsp;&nbsp;<a style='height:50%' class='btn btn-sm btn-danger' href='spermanent_delete.php?id=".$ret['id']."&type=non-consumable'>Remove</a></td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Exit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        `;
        var existingModals = document.querySelectorAll('.modal');
        existingModals.forEach(modal => modal.remove());
        document.body.insertAdjacentHTML('beforeend', modalContent);
        var myModal = new bootstrap.Modal(document.getElementById('addProductModal'));
        myModal.show();
    }
</script>







        <a class="me-1 btn btn-success" onclick="bar()">Barcode</a>
<script>
    function bar() {
        var modalContent = `

<div class="modal fade" id="signOutConfirmationModal" tabindex="-1" aria-labelledby="signOutConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signOutConfirmationModalLabel">
                    Barcode
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="barcodeForm" method="POST" class="row g-3 align-items-center">
                    <table width="100%">
                        <tr>
                            <td colspan="2" align="center">
                                <input align='center' type="text" style="width: 100%;" name="barcode_search" id="barcode_search" placeholder="Barcode" >
                            </td>
                        </tr>
                        <tr align='center'>
                            <td>
                                <input class="btn btn-primary" type="submit" value="Scan" name="search_barcode" id="scan_button">
                            </td>
                        </tr>
                        <tr align='center'>
                            <td><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Exit</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

            `;
        var existingModals = document.querySelectorAll('.modal');
        existingModals.forEach(modal => modal.remove());
        document.body.insertAdjacentHTML('beforeend', modalContent);
        var myModal = new bootstrap.Modal(document.getElementById('signOutConfirmationModal'));
        myModal.show();

        // Add event listener to the input field to check if it's empty
        document.getElementById('barcode_search').addEventListener('input', function() {
            var scanButton = document.getElementById('scan_button');
            if (this.value.trim() === '') {
                // Disable the button if the input is empty
                scanButton.disabled = true;
            } else {
                // Enable the button if there's text in the input
                scanButton.disabled = false;
            }
        });
    }
</script>


    </div><br>

    <table class="table table-striped" border="1px" align="center" style="width: 80%">
        <thead>
            <tr>
                <td colspan="9">
                    <h3>Non-Consumable List</h3>
                </td>
            </tr>
            <form method="POST" class="row g-3 align-items-center">
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
                <tr align="center">
                    <th><b>ID</b></th>
                    <th><b>Barcode ID</b></th>
                    <th><b>Equipment Name</b></th>
                    <th><b>Equipment Brand</b></th>
                    <th><b>Available No.</b></th>
                    <th><b>Borrowed No.</b></th>
                    <th colspan="2"><b>Action</b></th>
                </tr>
            </form>
        </thead>
        <tbody>
            <?php
            if ($rs) {
                while ($res = mysqli_fetch_array($rs)) {
                    echo "<tr>";
                    echo "<td>" . $res['id'] . "</td>";
                    echo "<td>" . $res['item_code'] . "</td>";
                    echo "<td>" . $res['equipment_name'] . "</td>";
                    echo "<td>" . $res['equipment_brand'] . "</td>";
                    echo "<td>" . $res['quantity'] . "</td>";
                    echo "<td>" . $res['total_borrowed_amount'] . "</td>";
                    echo "<td><a class='btn btn-warning' href='edit.php?id={$res['id']}'>Edit</a></td>";
                    echo "<td><a class='btn btn-danger' href='#' onclick='archiveItemConfirmation({$res['id']});'>Archive</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "Error fetching inventory data: " . mysqli_error($mysqli);
            }
            ?>
        </tbody>
    </table>




<div style="text-align: center;">
    <?php if ($page > 1): ?>
        <div style="display: inline-block; width: 30px; height: 30px; border: 1px solid #ccc; margin: 5px;">
            <a href="?page=<?php echo ($page - 1); ?>" style="text-decoration: none; color: black; font-weight: bold;">&lt;</a>
        </div>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <div style="display: inline-block; width: 30px; height: 30px; border: 1px solid #ccc; margin: 5px; <?php if ($i == $page) echo 'background-color: #007bff;'; ?>">
            <a href="?page=<?php echo $i; ?>" style="text-decoration: none; color: black; font-weight: bold;"><?php echo $i; ?></a>
        </div>
    <?php } ?>

    <?php if ($page < $total_pages && $total_pages > 1): ?>
        <div style="display: inline-block; width: 30px; height: 30px; border: 1px solid #ccc; margin: 5px;">
            <a href="?page=<?php echo ($page + 1); ?>" style="text-decoration: none; color: black; font-weight: bold;">&gt;</a>
        </div>
    <?php endif; ?>
</div>





</body>
</html>
