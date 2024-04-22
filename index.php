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
        $query = "SELECT inventory.*, COALESCE(SUM(borrowed_item.borrowed_amount), 0) AS total_borrowed_amount 
              FROM inventory 
              LEFT JOIN (SELECT item_code, SUM(borrowed_amount) AS borrowed_amount FROM borrowed_item GROUP BY item_code) AS borrowed_item 
              ON inventory.id = borrowed_item.item_code 
              WHERE inventory.id LIKE '%$searchTerm%' OR inventory.item_code LIKE '%$searchTerm%' OR inventory.equipment_name LIKE '%$searchTerm%' OR inventory.equipment_brand LIKE '%$searchTerm%' OR inventory.quantity LIKE '%$searchTerm%' 
              GROUP BY inventory.id";
        $rs = mysqli_query($mysqli, $query);
    } else {
        $rs = mysqli_query($mysqli, "SELECT inventory.*, COALESCE(SUM(borrowed_amount), 0) AS total_borrowed_amount 
          FROM inventory 
          LEFT JOIN borrowed_item ON inventory.id = borrowed_item.item_code 
          GROUP BY inventory.id");
    }



if (!isset($_SESSION['nom'])) {
    $_SESSION['nom'] = 0;
}

if (isset($_POST['switch'])) {
    if ($_SESSION['nom'] === 0) {
        $query = "SELECT inventory.*, COALESCE(SUM(borrowed_amount), 0) AS total_borrowed_amount 
              FROM inventory 
              LEFT JOIN borrowed_item ON inventory.id = borrowed_item.item_code 
              WHERE inventory.item_type = 'non-consumable'
              GROUP BY inventory.id";
        $rs = mysqli_query($mysqli, $query);
        $_SESSION['nom'] = 1;
    } elseif ($_SESSION['nom'] === 1) {
        $query = "SELECT inventory.*, COALESCE(SUM(borrowed_amount), 0) AS total_borrowed_amount 
              FROM inventory 
              LEFT JOIN borrowed_item ON inventory.id = borrowed_item.item_code 
              WHERE inventory.item_type = 'consumable'
              GROUP BY inventory.id";
        $rs = mysqli_query($mysqli, $query);
        $_SESSION['nom'] = 2;
    } else {
        $query = "SELECT inventory.*, COALESCE(SUM(borrowed_amount), 0) AS total_borrowed_amount 
              FROM inventory 
              LEFT JOIN borrowed_item ON inventory.id = borrowed_item.item_code 
              GROUP BY inventory.id";
        $rs = mysqli_query($mysqli, $query);
        $_SESSION['nom'] = 0;
    }
}




?>




<!DOCTYPE html>
<html>
	<head>
		<title>e-Monitor</title>
		<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
		
        
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

        
             
body {font-family: Arial, Helvetica, sans-serif;}

.user-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #000;
            cursor: pointer; /* Add cursor pointer for clickable effect */
        }
        .id-image {
            width: 40px;
            height: 40px;
            border: 2px solid #000;
            cursor: pointer; /* Add cursor pointer for clickable effect */
        }

.modal-content img {
            width: 100%;
            height: auto;
        }
        @media only screen and (max-width: 768px) {
            .modal-content {
                width: 90%;
            }
        }


    .btn-group .btn {
        border-radius: 0;
    }

    .btn-group .btn:first-child {
        border-radius: 0.25rem 0 0 0.25rem;
    }

    .btn-group .btn:last-child {
        border-radius: 0 0.25rem 0.25rem 0;
    }

    .btn-group .btn:not(:last-child) {
        border-right: none;
    }
		</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	</head>

		
	<?php include("navigations.php"); ?>



		<div class="sidebar p-1">
			<a class="me-1 btn btn-primary" href="add.php" style="">Add Product</a>
			<a class="me-1 btn btn-secondary"   href="unarchive.php?where=all">Archive List</a>
			<a class="me-1 btn btn-success"  href="match-product.php">Barcode</a>
		</div>
    <br><br><br>





<style type="text/css">
    .btn-group .btn {
        border-radius: 0;
    }

    .btn-group .btn:first-child {
        border-radius: 0.25rem 0 0 0.25rem;
    }

    .btn-group .btn:last-child {
        border-radius: 0 0.25rem 0.25rem 0;
    }

    .btn-group .btn:not(:last-child) {
        border-right: none;
    }
</style>


<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">All Inventory</h3>
        </div>
        <br>
        <div class="btn-toolbar mb-3 d-flex flex-wrap justify-content-center" role="toolbar" aria-label="Inventory Categories">
    <a href="index.php" class="btn btn-primary">All Inventory</a>
    <a href="SO_index.php" class="btn btn-outline-primary">Admin Inventory</a>
    <a href="bshm_index.php" class="btn btn-outline-primary">BSHM Inventory</a>
    <a href="bsit_index.php" class="btn btn-outline-primary">BSIT Inventory</a>
    <a href="beed_index.php" class="btn btn-outline-primary">BEED Inventory</a>
    <a href="hcs_index.php" class="btn btn-outline-primary">HCS Inventory</a>
    <a href="shs_index.php" class="btn btn-outline-primary">SHS Inventory</a>
    <a href="bsba_index.php" class="btn btn-outline-primary">BSBA Inventory</a>
    <a href="bscrim_index.php" class="btn btn-outline-primary">BSCRIM Inventory</a>
    <a href="unspecified_index.php" class="btn btn-outline-primary">Unspecified Inventory</a>
</div>

        <div class="card-body">
            <div class="row">
            <div class="col-md-14 mb-3">

            
                    <form method="POST" class="search-form row g-3 align-items-center">
                        <div class="col-md-10">

                            <input type="text" class="form-control" name="search" placeholder="Search" value="<?php echo $searchTerm; ?>">
                            
                        </div>

                        <div class="col">
                                <button class="btn btn-success search-btn" type="submit" name="search_btn">Search</button>
                       
                        </div>
                        <div class="col">
                                <button class="btn btn-secondary reset-btn" type="submit" name="search_reset">Reset</button>
                            </div>
                        </form>

                </div>
              <div class="table-responsive">
                <table class="table table-hover">
                
                        <thead>
        <tr align="center">
            <th><b>Image</b></th>
            <th><b>Barcode ID</b></th>
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
        $totalItems = 0;
        $totalConsumables = 0;
        $totalNonConsumables = 0;
        if ($rs) {
            if(mysqli_num_rows($rs) > 0) {
            while ($res = mysqli_fetch_array($rs)) {
                $img = empty($res['img']) ? "inventory/not.jpg" : $res['img'];
                echo "<tr>";
                echo "<td style='text-align: center;'><img class='myImg' src='" . $img . "' alt='" . $res['equipment_name'] . "' style='width: 40px; height: 40px; border-radius: 50%; border: 2px solid #000;'></td>";

                echo "<td style='text-align: center;'><img class='myImg' src='barcode/" . $res['item_code'] . ".png' alt='" . $res['item_code'] . "' style='height: 40px; border: 2px solid #000;'></td>";
                echo "<td style='text-align: center;' hidden>" . $res['item_code'] . "</td>";
                echo "<td style='text-align: center;'>" . $res['equipment_name'] . "</td>";
                echo "<td style='text-align: center;'>" . $res['equipment_brand'] . "</td>";
                echo "<td style='text-align: center;'>" . $res['quantity'] . "</td>";
                echo "<td style='text-align: center;'>" . $res['total_borrowed_amount'] . "</td>";
                echo "<td style='text-align: center;'>" . $res['item_type'] . "</td>";
                echo "<td style='text-align: center;'><a class='btn btn-warning' href='edit.php?id={$res['id']}'>Edit</a></td>";
                echo "<td style='text-align: center;'><a class='btn btn-danger' href='#' onclick='archiveItemConfirmation({$res['id']});'>Archive</a></td>";
                echo "</tr>";
                  // Increment total items count
            $totalItems++;

            // Increment consumables count if item type is 'consumable'
            if ($res['item_type'] == 'consumable') {
                $totalConsumables++;
            }
            // Increment non-consumables count if item type is 'non-consumable'
            elseif ($res['item_type'] == 'non-consumable') {
                $totalNonConsumables++;
            }
        }
        } else {
            // Display search not found message
            echo "<tr><td colspan='8No item ' class='text-center'>No item found.</td></tr>";
        }
    } else {
        // Display error message if query fails
        echo "<tr><td colspan='8No item ' class='text-center'>Error fetching inventory data: " . mysqli_error($mysqli) . "</td></tr>";
    }
    echo "<tfoot><tr><td colspan='9' align='center'>"
    . "<b>Total Consumables: $totalConsumables  |  </b>"
    . "<b>Total Non-Consumables: $totalNonConsumables  |  </b>"
    . "<b>Total Items: $totalItems  |  </b>"
    . "</td></tr></tfoot>";
 ?>
    
    </tbody>
</table>




















<!-- Modal for viewing user profile -->
<div class="modal fade" id="userProfileModal" tabindex="-1" aria-labelledby="userProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userProfileModalLabel">Item Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Here you can display user profile information -->
                <img id="userProfileImage" src="#" alt="User Profile Image">
                <div id="userDetails">
                    <p><strong>Barcode ID: </strong><span id="item_code"></span></p>
                    <p><strong>Equipment name: </strong><span id="equipment_name"></span></p>
                    <p><strong>Equipment brand: </strong><span id="equipment_brand"></span></p>
                    <p><strong>Available number: </strong><span id="quantity"></span></p>
                    <p><strong>Borrowed number: </strong><span id="total_borrowed_amount"></span></p>
                    <p><strong>Item type: </strong><span id="item_type"></span></p>
                    <!-- Include other user details as needed -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Function to display user profile modal
    function displayUserProfile(item_code, equipment_name, equipment_brand, quantity, total_borrowed_amount, item_type, profileImage) {
        // Update modal content with user details
        document.getElementById('userProfileImage').src = profileImage;
        document.getElementById('item_code').textContent = item_code;
        document.getElementById('equipment_name').textContent = equipment_name;
        document.getElementById('equipment_brand').textContent = equipment_brand;
        document.getElementById('quantity').textContent = quantity;
        document.getElementById('total_borrowed_amount').textContent = total_borrowed_amount;
        document.getElementById('item_type').textContent = item_type;

        // Display the modal
        var userProfileModal = new bootstrap.Modal(document.getElementById('userProfileModal'));
        userProfileModal.show();
    }

    // Attach event listener to user images to display profile modal
    document.addEventListener('DOMContentLoaded', function() {
        var userImages = document.getElementsByClassName('myImg');
        for (var i = 0; i < userImages.length; i++) {
            userImages[i].addEventListener('click', function() {
                var item_code = this.parentNode.nextElementSibling.textContent;
                var equipment_name = this.parentNode.nextElementSibling.nextElementSibling.textContent;
                var equipment_brand = this.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
                var quantity = this.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
                var total_borrowed_amount = this.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
                var item_type = this.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
                var profileImage = this.src;
                displayUserProfile(item_code, equipment_name, equipment_brand, quantity, total_borrowed_amount, item_type, profileImage);
            });
        }
    });
</script>



<script>
    var modal = document.getElementById('myModal');
    var images = document.getElementsByClassName('myImg');
    var modalImg = document.getElementById('img01');
    var captionText = document.getElementById('caption');
    var span = document.getElementsByClassName('close')[0];

    for (var i = 0; i < images.length; i++) {
        images[i].onclick = function() {
            modal.style.display = 'block';
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }
    }

    span.onclick = function() {
        modal.style.display = 'none';
    }
</script>

    </tbody>
</table>



<script>

    function archiveItemConfirmation(itemId) {
        var modalContent = `
            <div class="modal fade" id="archiveConfirmationModal" tabindex="-1" aria-labelledby="archiveConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="archiveConfirmationModalLabel">Archive Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to archive this item?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a href='delete_inventory.php?id=${itemId}' class="btn btn-danger">Archive</a>
                        </div>
                    </div>
                </div>
            </div>
        `;

        var existingModals = document.querySelectorAll('.modal');
        existingModals.forEach(modal => modal.remove());

        document.body.insertAdjacentHTML('beforeend', modalContent);

        var myModal = new bootstrap.Modal(document.getElementById('archiveConfirmationModal'));
        myModal.show();
    }
</script>


	</body>
</html>


