<?php
include_once("config.php");
	$searchTerm = "";

    if(isset($_POST['search_btn'])) {
        $searchTerm = mysqli_real_escape_string($mysqli, $_POST['search']);
        $query = "SELECT * FROM archive_merch WHERE barcode LIKE '%$searchTerm%' OR name LIKE '%$searchTerm%' OR quantity LIKE '%$searchTerm%'OR measurement LIKE '%$searchTerm%'";
        $rs = mysqli_query($mysqli, $query);
    } elseif(isset($_POST['search_reset'])) {
        $searchTerm = "";
        $rs = mysqli_query($mysqli, "SELECT * FROM archive_merch");
    } else {
        $rs = mysqli_query($mysqli, "SELECT * FROM archive_merch");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>e-Monitor</title>
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

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 50%; /* Full width */
  height: 50%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

.modal-content {
  margin: auto;
  display: block;
  width: 50%;
  max-width: 500px;
}

#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}


    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="sidebar">
    <a href="general_index.php">Back</a>
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
        <th><b>Image</b></th>
        <th colspan="2"><b>Barcode</b></th>
        <th><b>Name</b></th>
        <th><b>Quantity</b></th>
        <th><b>Measurement</b></th>
        <th colspan='2'><b>Action</b></th>
    </tr>
    </thead>
    <tbody>
    <?php
if (mysqli_num_rows($rs) > 0) {
    while ($res = mysqli_fetch_array($rs)) {
        $img = empty($res['image']) ? "inventory/not.jpg" : $res['image'];
        echo "<tr>";
        echo "<td><img class='myImg' src='" . $img . "' alt='" . $res['name'] . "' style='width: 40px; height: 40px; border-radius: 50%; border: 2px solid #000;'></td>";
        echo "<td align='center'>" . $res['barcode'] . "</td>";
        echo "<td style='text-align: center;'><img class='myImg' src='barcode/" . $res['barcode'] . ".png' alt='" . $res['barcode'] . "' style='height: 40px; border: 2px solid #000;'></td>";
        echo "<td align='center'>" . $res['name'] . "</td>";
        echo "<td align='center'>" . $res['quantity'] . "</td>";
        echo "<td align='center'>" . $res['measurement'] . "</td>";
            echo "<td align='center' colspan='2'>
                    <a class='btn btn-sm btn-danger' href='#' onclick='unarchiveItemConfirmation({$res['amid']});'>Unarchive This</a> 
                    <a class='btn btn-sm btn-danger' href='#' onclick='permanentDeleteConfirmation({$res['amid']});'>Permanently Delete</a>
                  </td>";
            echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7' align='center'><b>No Search found</b></td></tr>";
}
?>

<!-- Modal for viewing item details -->
<div class="modal fade" id="userProfileModal" tabindex="-1" aria-labelledby="userProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userProfileModalLabel">Item Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="userProfileImage" src="#" alt="Item Image" style="size: 25%;">
                <div id="itemDetails">
                    <p><strong>Barcode: </strong><span id="item_code"></span></p>
                    <p><strong>Name: </strong><span id="equipment_name"></span></p>
                    <p><strong>Quantity: </strong><span id="equipment_brand"></span></p>
                    <p><strong>Measurement: </strong><span id="quantity"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript code for handling item details modal -->
<script>
    // Function to display item details modal
    function displayItemDetails(item_code, equipment_name, equipment_brand, quantity, itemImage) {
        document.getElementById('userProfileImage').src = itemImage;
        document.getElementById('item_code').textContent = item_code;
        document.getElementById('equipment_name').textContent = equipment_name;
        document.getElementById('equipment_brand').textContent = equipment_brand;
        document.getElementById('quantity').textContent = quantity;

        var userProfileModal = new bootstrap.Modal(document.getElementById('userProfileModal'));
        userProfileModal.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
    var itemImages = document.getElementsByClassName('myImg');
    for (var i = 0; i < itemImages.length; i++) {
        itemImages[i].addEventListener('click', function() {
            var item_code = this.parentNode.nextElementSibling.textContent;
            var equipment_name = this.parentNode.nextElementSibling.nextElementSibling.textContent;
            var equipment_brand = this.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
            var quantity = this.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
            var item_type = this.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
            var itemImage = this.src;
            displayItemDetails(item_code, equipment_name, equipment_brand, quantity, itemImage);
        });
    }
});

</script>
<!-- JavaScript code for handling archive confirmation -->
<div class="modal fade" id="unarchiveConfirmationModal" tabindex="-1" aria-labelledby="unarchiveConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unarchiveConfirmationModalLabel">Unarchive Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to unarchive this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmUnarchiveBtn">Unarchive</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="permanentDeleteConfirmationModal" tabindex="-1" aria-labelledby="permanentDeleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="permanentDeleteConfirmationModalLabel">Permanent Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to permanently delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmPermanentDeleteBtn">Permanently Delete</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript code for handling unarchive and permanent delete confirmation -->
<script>
    function unarchiveItemConfirmation(itemId) {
        var unarchiveConfirmationModal = new bootstrap.Modal(document.getElementById('unarchiveConfirmationModal'));
        unarchiveConfirmationModal.show();

        document.getElementById('confirmUnarchiveBtn').addEventListener('click', function() {
            window.location.href = 'unarchive_mecrh_item.php?id=' + itemId;
        });
    }

    function permanentDeleteConfirmation(itemId) {
        var permanentDeleteConfirmationModal = new bootstrap.Modal(document.getElementById('permanentDeleteConfirmationModal'));
        permanentDeleteConfirmationModal.show();

        document.getElementById('confirmPermanentDeleteBtn').addEventListener('click', function() {
            window.location.href = 'permanent_delete_merch.php?id=' + itemId;
        });
    }
</script>
</body>
</html>
