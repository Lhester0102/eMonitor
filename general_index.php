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
        $query = "SELECT * FROM merch WHERE merch.id LIKE '%$searchTerm%' OR merch.name LIKE '%$searchTerm%' OR merch.barcode LIKE '%$searchTerm%' OR merch.quantity LIKE '%$searchTerm%' OR inventory.measurement LIKE '%$searchTerm%' 
              GROUP BY inventory.id";
        $rs = mysqli_query($mysqli, $query);
    } else {
        $rs = mysqli_query($mysqli, "SELECT * FROM merch");
    }

if (!isset($_SESSION['nom'])) {
    $_SESSION['nom'] = 0;
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
			<a class="me-1 btn btn-primary" href="add_merch.php" style="">Add Product</a>
			<a class="me-1 btn btn-secondary"   href="unarchive_merch.php">Archive List</a>
			<a class="me-1 btn btn-success"  href="merch_match-product.php">Barcode</a>
		</div>
    <br>


<?php 

?>



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
            <h3 class="text-center">Inventory</h3>
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
                <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover" border="1px" align="center">
                        <thead>
        <tr align="center">
            <th><b>Image</b></th>
            <th colspan="2"><b>Barcode ID</b></th>
            <th><b>Name</b></th>
            <th><b>Quantity</b></th>
            <th><b>Measurement</b></th>
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
                $img = empty($res['image']) ? "inventory/not.jpg" : $res['image'];
                echo "<tr>";
                echo "<td style='text-align: center;'><img class='myImg' src='" . $img . "' alt='" . $res['name'] . "' style='width: 40px; height: 40px; border-radius: 50%; border: 2px solid #000;'></td>";
                echo "<td style='text-align: center;'>" . $res['barcode'] . "</td>";
                echo "<td style='text-align: center;'><img class='myImg' src='barcode/" . $res['barcode'] . ".png' alt='" . $res['barcode'] . "' style='height: 40px; border: 2px solid #000;'></td>";
                echo "<td style='text-align: center;'>" . $res['name'] . "</td>";
                echo "<td style='text-align: center;'>" . $res['quantity'] . "</td>";
                echo "<td style='text-align: center;'>" . $res['measurement'] . "</td>";
                echo "<td style='text-align: center;'><a class='btn btn-warning' href='merch_edit.php?id={$res['mid']}'>Edit</a></td>";
                echo "<td style='text-align: center;'><a class='btn btn-danger' href='#' onclick='archiveItemConfirmation({$res['mid']});'>Archive</a></td>";
                echo "</tr>";
            $totalItems++;
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
                    <p><strong>Name: </strong><span id="equipment_name"></span></p>
                    <p><strong>Quantity: </strong><span id="equipment_brand"></span></p>
                    <p><strong>Measurement: </strong><span id="quantity"></span></p>
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
    function displayUserProfile(item_code, equipment_name, equipment_brand, quantity, profileImage) {
        // Update modal content with user details
        document.getElementById('userProfileImage').src = profileImage;
        document.getElementById('item_code').textContent = item_code;
        document.getElementById('equipment_name').textContent = equipment_name;
        document.getElementById('equipment_brand').textContent = equipment_brand;
        document.getElementById('quantity').textContent = quantity;

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
                var profileImage = this.src;
                displayUserProfile(item_code, equipment_name, equipment_brand, quantity, profileImage);
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
                            <a href='delete_merch_inventory.php?id=${itemId}' class="btn btn-danger">Archive</a>
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


