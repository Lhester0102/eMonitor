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
        $query = "SELECT * FROM account WHERE (username LIKE '%$searchTerm%' OR UID LIKE '%$searchTerm%' OR password LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%') AND position = 'Program Head'";
        $rs = mysqli_query($mysqli, $query);


        if(!$rs) {
            die("Error in SQL query: " . mysqli_error($mysqli));
        }
    } elseif(isset($_POST['search_reset'])) {
        $searchTerm = "";
        $rs = mysqli_query($mysqli, "SELECT * FROM account WHERE position = 'Program Head'");


        if(!$rs) {
            die("Error in SQL query: " . mysqli_error($mysqli));
        }
    } else {
        $rs = mysqli_query($mysqli, "SELECT * FROM account WHERE position = 'Program Head'");

        if(!$rs) {
            die("Error in SQL query: " . mysqli_error($mysqli));
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supply Officer</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        .card-header h3 {
            margin-bottom: 0;
        }
        .search-form {
            margin-bottom: 20px;
        }
        .search-form input[type="text"] {
            width: 100%;
        }
        .search-btn,
        .reset-btn {
            width: 100%;
        }
        .user-image {
            width: 70px; /* Square dimensions */
            height: 70px; /* Square dimensions */
            object-fit: cover; /* Maintain aspect ratio */
            border-radius: 8px; /* Rounded corners */
            cursor: pointer; /* Add cursor pointer for clickable effect */
        }
        .id-image {
            width: 70px; /* Square dimensions */
            height: 70px; /* Square dimensions */
            object-fit: cover; /* Maintain aspect ratio */
            border-radius: 8px; /* Rounded corners */
            cursor: pointer; /* Add cursor pointer for clickable effect */
     
        }
            .modal-content img {
                width: 50%;
                height: 50%;
            }

            #userProfileImage {
            border: solid;
            margin-right: 10px;
            /* Example custom design */
            border-color: blue; /* Blue border */
            border-width: 5px; /* Thick border */
            border-radius: 50%; /* Rounded border */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); /* Shadow effect */
        }

        #iidImage {
            border: solid;
            margin-right: 10px;
            /* Example custom design */
            border-color: blue; /* Blue border */
            border-width: 5px; /* Thick border */
            border-radius: 50%; /* Rounded border */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); /* Shadow effect */
        }

        
                @media only screen and (max-width: 768px) {
            .modal-content {
                width: 90%;
            }
        }

    
    </style>
</head>
<body>
    <?php include("navigations.php"); ?>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Program Head</h3>
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
                                <button class="btn btn-secondary reset-btn" type="submit" name="search_reset">Reset</button>
                            </div>
                        </form>
                    </div>

                    
                    
<div class="col-md-4">
    <div class="row">
        <div class="col">
            <a class="btn btn-primary" href="add_su_of.php">Add Program Head</a>
        </div>
        <div class="col">
            <a class="btn btn-primary" href="archive_supply_user_list.php">Archive List</a>
        </div>
    </div>
</div>

                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Profile</th>
                                <th>Username</th>
                                <th>Position</th>
                                <th>Email</th>
                                <th>Program Head ID</th>
                                <th align="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $totalSupplyOfficer = 0;
if ($rs) {
    if (mysqli_num_rows($rs) > 0) {
        while ($res = mysqli_fetch_array($rs)) {
            $image_path = empty($res['image_path']) ? "uploads/anonymous.png" : $res['image_path'];
            $iid_image = empty($res['iid_image']) ? "uploads/anonymous.png" : $res['iid_image'];
            $iid = empty($res['iid']) ? "No ID" : $res['iid'];
?>
            <tr>
                <td>
                    <img class="user-image" src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($res['username']); ?>">
                    <img class="iid-image" src="<?php echo htmlspecialchars($iid_image); ?>" alt="<?php echo htmlspecialchars($res['username']); ?>" hidden>
                </td>
                <td><?php echo htmlspecialchars($res['username']); ?></td>
                <td><?php echo htmlspecialchars($res['position']); ?></td>
                <td><?php echo htmlspecialchars($res['email']); ?></td>
                <td><?php echo htmlspecialchars($iid); ?></td>
                <td>
                    <a class="btn btn-warning btn-sm" href="edit_user.php?id=<?php echo htmlspecialchars($res['UID']); ?>">Edit User</a>
                    <button class="btn btn-danger btn-sm" onclick="deleteUserConfirmation(<?php echo htmlspecialchars($res['UID']); ?>);">Archive User</button>
                </td>
            </tr>
<?php
$totalSupplyOfficer++;
        }
    } else {
        echo "<tr><td colspan='6' class='text-center'>Search not found.</td></tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>Error fetching user data: " . mysqli_error($mysqli) . "</td></tr>";
}
// Print total instructor count after the table
echo "<tfoot><tr><td colspan='7' align='center'><b>Total Program Head: $totalSupplyOfficer</b></td></tr></tfoot>";
?>


</tbody>
</table>
</div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="userProfileModal" tabindex="-1" aria-labelledby="userProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userProfileModalLabel">Program Head Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Container for userProfileImage and its caption -->
                <div class="d-flex align-items-center">
                    <!-- userProfileImage with caption -->
                    <div class="d-flex flex-column align-items-center">
                        <!-- Caption for the userProfileImage -->
                        <p>Program Head Picture</p>
                        <img id="userProfileImage" src="#" alt="User Profile Image" style="border: solid; margin-right: 10px;">
                    </div>
                    <!-- iidImage with caption -->
                    <div class="d-flex flex-column align-items-center">
                        <!-- Caption for the iidImage -->
                        <p>Program Head ID</p>
                        <img id="iidImage" src="#" alt="User ID Image" style="border: solid; margin-right: 10px;">
                    </div>
                </div>
                <div id="userDetails">
                    <p><strong>Username: </strong><span id="username"></span></p>
                    <p><strong>Position: </strong><span id="position"></span></p>
                    <p><strong>Email: </strong><span id="email"></span></p>
                    <p><strong>User ID: </strong><span id="userId"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleIdImage() {
        var image = document.getElementById('iidImage');
        var button = document.querySelector('.btn-show-id');

        if (image.style.display === 'none') {
            image.style.display = 'block';
            button.textContent = 'Hide ID Image';
        } else {
            image.style.display = 'none';
            button.textContent = 'Show ID Image';
        }
    }

    function deleteUserConfirmation(UID) {
        var deleteUserModal = `
            <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteUserModalLabel">Archive User Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to archive this user?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a href='delete_user.php?id=${UID}' class="btn btn-danger">Archive User</a>
                        </div>
                    </div>
                </div>
            </div>
        `;

        var existingModal = document.getElementById('deleteUserModal');
        if (existingModal) {
            existingModal.remove();
        }

        document.body.insertAdjacentHTML('beforeend', deleteUserModal);

        var deleteUserModalInstance = new bootstrap.Modal(document.getElementById('deleteUserModal'));
        deleteUserModalInstance.show();
    }

    var userProfileModal = new bootstrap.Modal(document.getElementById('userProfileModal'));
    var userProfileImage = document.getElementById('userProfileImage');
    var iidImage = document.getElementById('iidImage');
    var usernameSpan = document.getElementById('username');
    var positionSpan = document.getElementById('position');
    var emailSpan = document.getElementById('email');
    var userIdSpan = document.getElementById('userId');
    var userImages = document.getElementsByClassName('user-image');

    for (var i = 0; i < userImages.length; i++) {
        userImages[i].addEventListener('click', function() {
            userProfileImage.src = this.src;
            var parentRow = this.parentNode.parentNode;
            usernameSpan.textContent = parentRow.querySelector('td:nth-child(2)').textContent;
            positionSpan.textContent = parentRow.querySelector('td:nth-child(3)').textContent;
            emailSpan.textContent = parentRow.querySelector('td:nth-child(4)').textContent;
            userIdSpan.textContent = parentRow.querySelector('td:nth-child(5)').textContent;
            iidImage.src = parentRow.querySelector('.iid-image').src; // Setting iid_image source in the modal
            userProfileModal.show();
        });
    }
</script>
