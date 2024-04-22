<style> 

.notification {
  background-color: #555;
  color: white;
  text-decoration: none;
  padding: 10px 10px 10px 10px;
  position: relative;
  display: inline-block;
  border-radius: 100%;

}

.notification:hover {
  background: red;
}

.notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 5px;
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

.dropbtn {
  padding: 7px 7px;
  background-color: transparent;
  border-color: none;
  border: none;
  color: #9B9D9E;
}

.dropbtn:hover, .dropbtn:focus {
    color: white;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #212529;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  color: #9B9D9E;
}

.dropdown-content a:hover {
  color: white;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
}

    .dropdown:hover .dropbtn,
    .dropdown-content:hover .dropbtn {
        color: white;
    }
</style>


<?php 

    $alerto = 0;


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
?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="supply_user_dashboard.php">DCCP</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
<li class="nav-item">
    <a class="nav-link" href="supply_user_dashboard.php">Dashboard</a>
</li>
<li class="nav-item">
    <div class="dropdown">
        <button class="dropbtn">Inventory</button>
        <div class="dropdown-content">
            <a class="nav-item" href="non_consumable.php">Non-Consumable</a>
            <a class="nav-item" href="consumable.php">Consumable</a>
        </div>
    </div>
</li>

				</ul>
				<div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <a href="notify_supply_officer.php" class="notification" >
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