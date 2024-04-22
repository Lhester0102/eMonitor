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
        $query = "SELECT * FROM account WHERE (username LIKE '%$searchTerm%' OR UID LIKE '%$searchTerm%' OR password LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%') AND user_type LIKE 'user'";
        $rs = mysqli_query($mysqli, $query);
        if(!$rs) {
            die("Error in SQL query: " . mysqli_error($mysqli));
        }
    } elseif(isset($_POST['search_reset'])) {
        $searchTerm = "";
        $rs = mysqli_query($mysqli, "SELECT * FROM account  WHERE user_type = 'user' ");
        if(!$rs) {
            die("Error in SQL query: " . mysqli_error($mysqli));
        }
    } else {
        $rs = mysqli_query($mysqli, "SELECT * FROM account  WHERE user_type = 'user' ");
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
    <title>Instructors</title>
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

        #userProfileImage {
            border: solid;
            margin-right: 10px;
            /* Example custom design */
            border-color: blue; /* Blue border */
            border-width: 5px; /* Thick border */
            border-radius: 50%; /* Rounded border */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); /* Shadow effect */
        }
        #iid_Image {
            border: solid;
            margin-right: 10px;
            /* Example custom design */
            border-color: blue; /* Blue border */
            border-width: 5px; /* Thick border */
            border-radius: 50%; /* Rounded border */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); /* Shadow effect */
        }

        .modal-content img {
                width: 50%;
                height: 50%;
        
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
                <h3 class="text-center">Instructors</h3>
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
            <a class="btn btn-primary" href="add_ins.php">Add Instructor</a>
        </div>
        <div class="col">
            <a class="btn btn-primary" href="archive_user_list.php">Archive List</a>
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
                                <th>Department</th>
                                <th>Position</th>
                                <th>Email</th>
                                <th>Instructor ID</th>
                                <th align="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
$totalInstructor = 0;
if ($rs) {
    if (mysqli_num_rows($rs) > 0) {
        while ($res = mysqli_fetch_array($rs)) {
            $image_path = empty($res['image_path']) ? "uploads/anonymous.png" : $res['image_path'];
            $iid_image = empty($res['iid_image']) ? "uploads/anonymous.png" : $res['iid_image'];
            ?>
            <tr>
                <td>
                    <img class="user-image" src="<?php echo $image_path; ?>" alt="<?php echo $res['username']; ?>">
                    <img class="iid_image" src="<?php echo $iid_image; ?>" alt="<?php echo $res['username']; ?>" hidden>
                </td>
                <td><?php echo $res['username']; ?></td>
                <td><?php echo $res['department']; ?></td>
                <td><?php echo $res['position']; ?></td>
                <td><?php echo $res['email']; ?></td>
                <td><?php echo $res['iid']; ?></td>
                <td>
                    <a class="btn btn-warning btn-sm" href="edit_user.php?id=<?php echo $res['UID']; ?>">Edit User</a>
                    <a class="btn btn-danger btn-sm" onclick="deleteUserConfirmation(<?php echo $res['UID']; ?>);">Archive User</a>
                </td>
            </tr>
            <?php
            // Increment total instructor count
            $totalInstructor++;
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>Search not found.</td></tr>";
    }
} else {
    echo "<tr><td colspan='7' class='text-center'>Error fetching user data: " . mysqli_error($mysqli) . "</td></tr>";
}
// Print total instructor count after the table
echo "<tfoot><tr><td colspan='7' align='center'><b>Total Instructors: $totalInstructor</b></td></tr></tfoot>";
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
                <h5 class="modal-title" id="userProfileModalLabel">User Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                 <!-- Container for userProfileImage and its caption -->
                 <div class="d-flex align-items-center">
                    <!-- userProfileImage with caption -->
                    <div class="d-flex flex-column align-items-center">
                        <!-- Caption for the userProfileImage -->
                        <p>Instructor Picture</p>
                <img id="userProfileImage" src="#" alt="User Profile Image" style="border: solid; margin-right: 10px;">
                    </div>
 <!-- iidImage with caption -->
 <div class="d-flex flex-column align-items-center">
     <!-- Caption for the iidImage -->
     <p>Instructor ID</p>
     <img id="iid_Image" src="#" alt="User ID Image" style="border: solid;">
 </div>
                 </div>
                <div id="userDetails">
                    <p><strong>Username: </strong><span id="username"></span></p>
                    <p><strong>Department: </strong><span id="department"></span></p>
                    <p><strong>Position: </strong><span id="position"></span></p>
                    <p><strong>Email: </strong><span id="email"></span></p>
                    <p><strong>User ID: </strong><span id="userId"></span>
                </div>
            </div>
        </div>
    </div>
</div>






<script>
    function toggleIdImage() {
        var image = document.getElementById('iid_Image');
        var button = document.querySelector('.btn-show-id');

        if (image.style.display === 'none') {
            image.style.display = 'block';
            button.textContent = 'Hide ID Image';
        } else {
            image.style.display = 'none';
            button.textContent = 'Show ID Image';
        }
    }
</script>




<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
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
    var iidImage = document.getElementById('iid_Image');
    var usernameSpan = document.getElementById('username');
    var departmentSpan = document.getElementById('department');
    var positionSpan = document.getElementById('position');
    var emailSpan = document.getElementById('email');
    var userIdSpan = document.getElementById('userId');
    var userImages = document.getElementsByClassName('user-image');

    for (var i = 0; i < userImages.length; i++) {
        userImages[i].addEventListener('click', function() {
            userProfileImage.src = this.src;
            var parentRow = this.parentNode.parentNode;
            usernameSpan.textContent = parentRow.querySelector('td:nth-child(2)').textContent;
            departmentSpan.textContent = parentRow.querySelector('td:nth-child(3)').textContent;
            positionSpan.textContent = parentRow.querySelector('td:nth-child(4)').textContent;
            emailSpan.textContent = parentRow.querySelector('td:nth-child(5)').textContent;
            userIdSpan.textContent = parentRow.querySelector('td:nth-child(6)').textContent;
            iidImage.src = parentRow.querySelector('.iid_image').src; // Setting iid_image source in the modal
            userProfileModal.show();
        });
    }
</script>

</body>
</html>