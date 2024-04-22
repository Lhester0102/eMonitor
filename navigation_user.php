<style> 

  @keyframes bellAnimation {
    0% { transform: translateX(-2px) rotate(0deg); }
    25% { transform: translateX(2px) rotate(5deg); }
    50% { transform: translateX(-2px) rotate(0deg); }
    75% { transform: translateX(2px) rotate(-5deg); }
    100% { transform: translateX(-2px) rotate(0deg); }
  }

  .notification {
    background-color: #555;
    color: white;
    text-decoration: none;
    padding: 10px;
    position: relative;
    display: inline-block;
    border-radius: 50%;
    animation: bellAnimation 2s infinite; /* Apply animation */
  }

  .notification:hover {
    background: red;
    animation: none; /* Disable animation on hover */
  }

  .notification .badge {
    position: absolute;
    top: -10px;
    right: -10px;
    padding: 5px;
    border-radius: 50%;
    background: red;
    color: white;
  }

.profile-image {
    transition: transform 0.5s ease;
}

.profile-image:hover {
    transform: scale(5);
}

</style>


<?php 

    $alerto = 0;
$dep = $_SESSION['department'];
$hier = $_SESSION['hierarchy'];


$query_today = "SELECT * FROM borrowed_item WHERE item_type != 'consumable' AND DATE(request_date) = CURDATE() AND borrower = '$name'";
$res_today = mysqli_query($mysqli, $query_today);
$num_due_today = mysqli_num_rows($res_today);

$query_passed = "SELECT * FROM borrowed_item WHERE item_type != 'consumable' AND DATE(request_date) < CURDATE() AND borrower = '$name'";
$res_passed = mysqli_query($mysqli, $query_passed);
$num_due_passed = mysqli_num_rows($res_passed);

$query_tomorrow = "SELECT * FROM borrowed_item WHERE item_type != 'consumable' AND DATE(request_date) = DATE(DATE_ADD(CURDATE(), INTERVAL 1 DAY)) AND borrower = '$name'";
$res_tomorrow = mysqli_query($mysqli, $query_tomorrow);
$num_due_tomorrow = mysqli_num_rows($res_tomorrow);

$acce = mysqli_query($mysqli, "SELECT * FROM accept WHERE user = '$name'");
$num_acce = mysqli_num_rows($acce);

$alerto = $num_due_today + $num_due_passed + $num_due_tomorrow + $num_acce;


$email_query = mysqli_query($mysqli, "SELECT * FROM account WHERE username = '$name'");
if ($email_query) {
    if (mysqli_num_rows($email_query) > 0) {
        $row = mysqli_fetch_array($email_query);
        $email = $row['email'];
        $position = $row['position'];
        $department = $row['department'];
        $image_path = $row['image_path'];
    }
}





?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">DCCP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="user_dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="borrowed_item.php">Borrowed List</a>
                </li>

                <?php
                if ($hier == 'Instructor') {
                    // code...
                } else {
                echo "<li class='nav-item'>";
                echo     "<a class='nav-link' href='item_storage.php'>Consumable List</a>";
                echo "</li>";
                }
                ?>

                <li class="nav-item">
                    <a class="nav-link" href="dep_inventory.php"><?php echo $dep; ?> Inventory</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href=" <?php if ($hier == 'Instructor') { echo    'request_index.php'; } else { echo    'request_ph_manage.php'; } ?> ">

                <?php if ($hier == 'Instructor') { echo    'Request'; } else { echo    $dep. ' Instructor Requests'; } ?>
                </a>
                </li>

                <?php
                if ($hier == 'Instructor') {
              
                } else {
                echo "<li class='nav-item'>";
                echo     "<a class='nav-link' href='request_index_ph.php'>Request</a>";
                echo "</li>";
                }
                ?>
            </ul>

            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <a href="notify_instructor.php" class="notification" >
                    <span><i class="fa fa-bell"></i></span>
<?php
                            echo "<span class='badge'>" . $alerto . "</span>";
?>
                </a>




&nbsp; &nbsp;

					<ul class="navbar-nav">
						<li class="nav-item">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><img src="<?php echo $image_path ?>"  style='width: 40px; height: 40px; border-radius: 50%; border: 2px solid #000; margin-right: 10px'><?php echo $email;?></a>
							<ul class="dropdown-menu">



								<li><a class="dropdown-item"  onclick="profile()">Profile</a></li>
					<script>
        function profile() {
            var modalContent = `
<div class="modal fade" id="signOutConfirmationModal" tabindex="-1" aria-labelledby="signOutConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signOutConfirmationModalLabel">
                    <?php echo $name; ?>'s Profile
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
<table width="100%">
    <tr>
        <td align="center">
            <div><b>User Image</b></div>
            <img class="profile-image" src="<?php echo $image_path; ?>" style="width: 75px; height: 75px; border: 2px solid #000; margin-right: 10px;">
        </td>
        <td align="center">
            <div><b>ID Image</b></div>
            <img class="profile-image" src="<?php echo $iid_image; ?>" style="width: 75px; height: 75px; border: 2px solid #000; margin-right: 10px;">
        </td>
    </tr>
    <tr>
        <td><b>Name:</b></td>
        <td><?php echo $name; ?></td>
    </tr>
    <tr>
        <td><b>User Id:</b></td>
        <td><?php echo $iid; ?></td>
    </tr>
    <tr>
        <td><b>Department:</b></td>
        <td><?php echo $department; ?></td>
    </tr>
    <tr>
        <td><b>Position:</b></td>
        <td><?php echo $position; ?></td>
    </tr>
    <tr>
        <td><b>Email:</b></td>
        <td><?php echo $email; ?></td>
    </tr>
</table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Exit</button>
                <a href="Edit_user_profile.php" class="btn btn-danger">Edit Profile</a>
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
        }
    </script>






								<li><a class="dropdown-item"  onclick="signOutConfirmation()">Sign Out</a></li>
    <script>
        function signOutConfirmation() {
            var modalContent = `<div class="modal fade" id="signOutConfirmationModal" tabindex="-1" aria-labelledby="signOutConfirmationModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="signOutConfirmationModalLabel">Sign Out Confirmation</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div> <div class="modal-body">Are you sure you want to sign out?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><a href='log-out.php' class="btn btn-danger">Sign Out</a></div></div></div></div>`;
            var existingModals = document.querySelectorAll('.modal');
            existingModals.forEach(modal => modal.remove());
            document.body.insertAdjacentHTML('beforeend', modalContent);
            var myModal = new bootstrap.Modal(document.getElementById('signOutConfirmationModal'));
            myModal.show();
        }
    </script>
							</ul>
						</li>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>