<?php
function calculateAlerto($mysqli) {
    $alerto = 0;

    $ro = mysqli_query($mysqli, "SELECT * FROM request");
    $num_due_items_s = mysqli_num_rows($ro);
$query_today = "SELECT * FROM borrowed_item WHERE item_type != 'consumable' AND DATE(request_date) = CURDATE()";
$res_today = mysqli_query($mysqli, $query_today);
$num_due_today = mysqli_num_rows($res_today);

$query_passed = "SELECT * FROM borrowed_item WHERE item_type != 'consumable' AND DATE(request_date) < CURDATE()";
$res_passed = mysqli_query($mysqli, $query_passed);
$num_due_passed = mysqli_num_rows($res_passed);

$query_tomorrow = "SELECT * FROM borrowed_item WHERE item_type != 'consumable' AND DATE(request_date) = DATE(DATE_ADD(CURDATE(), INTERVAL 1 DAY))";
$res_tomorrow = mysqli_query($mysqli, $query_tomorrow);
$num_due_tomorrow = mysqli_num_rows($res_tomorrow);


if(isset($_POST['submit_btn'])) {
    $name = $_SESSION['username'];

    $current_password = mysqli_real_escape_string($mysqli, $_POST['cpassword']);
    $new_password = mysqli_real_escape_string($mysqli, $_POST['npassword']);
    $confirm_password = mysqli_real_escape_string($mysqli, $_POST['copassword']);

    $current_password_query = mysqli_query($mysqli, "SELECT password FROM account WHERE username = '$name'");
    if($current_password_query) {
        $row = mysqli_fetch_assoc($current_password_query);
        $stored_password = $row['password'];

        if(password_verify($current_password, $stored_password)) {
            if($new_password === $confirm_password) {
                if($current_password !== $new_password) { // Check if new password is different from current password
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $update_query = mysqli_query($mysqli, "UPDATE account SET password = '$hashed_password' WHERE username = '$name'");
                    if($update_query) {
                        echo "<script>alert('Password updated successfully.');</script>";
                    } else {
                        echo "<script>alert('Error updating password: " . mysqli_error($mysqli) . "');</script>";
                    }
                } else {
                    echo "<script>alert('New password must be different from the current password.');</script>";
                }
            } else {
                echo "<script>alert('New password and confirm password do not match.');</script>";
            }
        } else {
            echo "<script>alert('Current password is incorrect.');</script>";
        }
    } else {
        echo "<script>alert('Error: " . mysqli_error($mysqli) . "');</script>";
    }
} else {
}

    $alerto = $num_due_items_s + $num_due_today + $num_due_passed + $num_due_tomorrow;

    return $alerto;
}

$alerto = calculateAlerto($mysqli);
$general = $_SESSION['general'];
?>

<style>

body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    color: #333; /* Set default text color */
}

.container-fluid {
    padding: 0 15px; /* Adjust padding for better spacing */
    margin: 0 auto; /* Center container horizontally */
}

.navbar {
    background-color: #343a40 !important;
}

.navbar-brand {
    color: #ffffff !important;
    font-weight: bold;
}

.navbar-nav .nav-link {
    color: #ffffff; /* Set default link color */
    transition: background-color 0.3s ease, color 0.3s ease; /* Add smooth transition effect */
    padding: 10px 20px; /* Add padding to links */
    border-radius: 10px; /* Add border radius to links */
    margin-right: 25px; /* Add margin between links */
}

.navbar-nav .nav-link:hover {
    color: #fff; /* Change text color on hover */
    background: linear-gradient(to right, #007bff, #0056b3); /* Gradient background on hover */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add box shadow on hover */
}

.dropdown-menu .dropdown-item:hover {
    background: linear-gradient(to right, #007bff, #0056b3); /* Gradient background when active */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add box shadow when active */
    }
    
    .dropdown-menu .dropdown-item {
        color: black; /* Change to your desired default text color */
        background-color: transparent !important; /* Reset background color */
    }



.navbar-nav .nav-link.active {
    color: #fff; /* Change text color when active */
    background: linear-gradient(to right, #007bff, #0056b3); /* Gradient background when active */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add box shadow when active */
}

.notification {
    background-color: #555;
    color: white;
    text-decoration: none;
    width: 40px; /* Set width */
    height: 40px; /* Set height */
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    animation: bellAnimation 2s infinite; /* Apply animation */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Add shadow */
}

.notification:hover {
    background: #e74c3c; /* Change color on hover */
    animation: none; /* Disable animation on hover */
}

.notification .badge {
    position: absolute;
    top: -10px;
    right: -10px;
    padding: 5px;
    border-radius: 50%;
    background: #c0392b; /* Badge color */
    color: white;
    font-size: 12px; /* Adjust font size */
}

@keyframes bellAnimation {
    0% { transform: translateX(-2px) rotate(0deg); }
    25% { transform: translateX(2px) rotate(5deg); }
    50% { transform: translateX(-2px) rotate(0deg); }
    75% { transform: translateX(2px) rotate(-5deg); }
    100% { transform: translateX(-2px) rotate(0deg); }
}

/* Loading Overlay Styles */


/* Loading Spinner Styles */



@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}
.navbar-dark .navbar-nav .nav-link {
        color: rgba(255,255,255,.5); /* Change text color */
    }

    .navbar-dark .navbar-nav .nav-link:hover {
        color: rgba(255,255,255,.75); /* Change text color on hover */
    }

    .navbar-dark .navbar-nav .nav-link:focus {
        color: rgba(255,255,255,.75); /* Change text color on focus */
    }

    .navbar-dark .navbar-nav .nav-link.dropdown-toggle::after {
        border-top-color: rgba(255,255,255,.75); /* Change dropdown arrow color */
    }

    .navbar-dark .navbar-nav .dropdown-menu {
        background-color: #343a40; /* Change dropdown background color */
    }

    .navbar-dark .navbar-nav .dropdown-item {
        color: rgba(255,255,255,.5); /* Change dropdown item text color */
    }

    .navbar-dark .navbar-nav .dropdown-item:hover {
        background-color: rgba(255,255,255,.1); /* Change dropdown item background color on hover */
        color: rgba(255,255,255,.75); /* Change dropdown item text color on hover */
    }

    @media (orientation: portrait) {
    .vertical-only {
        display: block;
    }
}

@media (orientation: landscape) {
    .vertical-only {
        display: none;
    }
}

.scrollable-navbar {
    max-height: 500px; /* Set the maximum height you desire */
    overflow-y: auto; /* Enable vertical scrollbar when content exceeds the height */
}

.scrollable-navbar.show-scroll {
    overflow-y: hidden; /* Hide scrollbar when navbar is collapsed */
}



.nav-item.dropdown .dropdown-toggle::after {
  transition: transform 0.3s ease;
}

.nav-item.dropdown.show .dropdown-toggle::after {
  transform: rotate(180deg);
}




</style>
<body style="background-color: lightblue;"> <!-- Light blue background color -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</style><meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="position: fixed; width: 100%; z-index: 900;">
    <div class="container-fluid" style="position: relative;">

    <a class="navbar-brand" href="admin-dashboard.php">
    <img src="dccplogo.png" alt="DCCP Logo" width="50" height="auto">
</a>

<span class="navbar-text d-sm-none" style="font-size: 40px; color: white; text-shadow: 2px 2px 2px black;">DCCP INVENTORY</span>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav" <?php if ($general == 'general') { echo 'hidden'; } ?>>
                <li class="nav-item">
                    <a class="nav-link" href="admin-dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="supply_officer.php"><i class="fa fa-user"></i>Program Head</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="instructor.php"><i class="fa fa-user"></i>Instructors</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="borrowed_items.php"><i class="fa fa-list"></i>Borrowed Items</a>
                </li>


                <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdowns" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-archive"></i> Inventory
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdowns">
    <a class="dropdown-item" href="index.php">All Inventory</a>
        <a class="dropdown-item" href="SO_index.php">Admin Inventory</a>
        <a class="dropdown-item" href="bshm_index.php">BSHM Inventory</a>
        <a class="dropdown-item" href="bsit_index.php">BSIT INventory</a>
        <a class="dropdown-item" href="beed_index.php">BEED Inventory</a>
        <a class="dropdown-item" href="hcs_index.php">HCS Inventory</a>
        <a class="dropdown-item" href="shs_index.php">SHS Inventory</a>
        <a class="dropdown-item" href="bsba_index.php">BSBA Inventory</a>
        <a class="dropdown-item" href="bscrim_index.php">BSCRIM Inventory</a>
    </div>
</li>
                
                <li class="nav-item">
                    <a class="nav-link" href="request.php"><i class="fa fa-file"></i>Requests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reports.php"><i class="fa fa-bar-chart"></i>Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logs.php"><i class="fa fa-book"></i>Logs</a>
                </li>

                
<li class="nav-item vertical-only">
    <a class="nav-link" href="notify.php"><i class="fa fa-bell"></i>Notifications <b><?php echo $alerto; ?></b></a>
</li>

<li class="nav-item dropdown vertical-only">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="uploads/admin.jpg" style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #000; margin-right: 10px;">
        <?php echo $_SESSION['email'];?>
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" onclick="showChangePasswordModal()">Change Password</a></li>
        <li><a class="dropdown-item" onclick="signOutConfirmation()">Sign Out</a></li>
    </ul>
</li>
            </ul>
            <ul class="navbar-nav" <?php if ($general == 'none') { echo 'hidden'; } ?>>
                <li class="nav-item">
                    <a class="nav-link" href="general-merch-dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="general_index.php"><i class="fa fa-archive"></i>Inventory</a>
                </li>

<li class="nav-item vertical-only">
    <a class="nav-link" href="notify.php"><i class="fa fa-bell"></i>Notifications <b><?php echo $alerto; ?></b></a>
</li>

<li class="nav-item dropdown vertical-only">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="uploads/admin.jpg" style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #000; margin-right: 10px;">
        <?php echo $_SESSION['email'];?>
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" onclick="showChangePasswordModal()">Change Password</a></li>
        <li><a class="dropdown-item" onclick="signOutConfirmation()">Sign Out</a></li>
    </ul>
</li>

            </ul>




<div id="loading" class="loading-overlay">
    <div class="loading-spinner"></div>
</div>

<script>
$(document).ready(function(){
    $(document).click(function(event) {
        var clickover = $(event.target);
        var $navbar = $(".navbar-collapse");               
        var _opened = $navbar.hasClass("show");
        var isDropdown = clickover.hasClass('dropdown-toggle') || clickover.parents('.dropdown-menu').length > 0;
        if (_opened === true && !clickover.hasClass("navbar-toggler") && !isDropdown) {      
            $navbar.collapse('hide');
        }
    });
});

</script>

<script>
    
   document.addEventListener('DOMContentLoaded', function () {
    // Function to handle scrollbar visibility
    function handleScrollbar() {
        var navbar = document.querySelector('.navbar-nav');
        var navbarCollapse = document.getElementById('collapsibleNavbar');
        if (navbarCollapse.classList.contains('show') || navbar.scrollHeight > navbar.clientHeight) {
            navbar.classList.add('scrollable-navbar');
        } else {
            navbar.classList.remove('scrollable-navbar');
        }
    }

    // Add event listener for navbar collapse events
    document.getElementById('collapsibleNavbar').addEventListener('hidden.bs.collapse', function () {
        handleScrollbar();
    });

    document.getElementById('collapsibleNavbar').addEventListener('shown.bs.collapse', function () {
        handleScrollbar();
    });

    // Add event listener for window resize
    window.addEventListener('resize', function () {
        handleScrollbar();
    });

    // Initial scrollbar check
    handleScrollbar();
});



</script>


        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const links = document.querySelectorAll('.nav-link');

                function handleLinkClick(event) {
                    // Remove 'active' class from all links
                    links.forEach(link => link.classList.remove('active'));

                    // Add 'active' class to the clicked link
                    this.classList.add('active');
                }

                // Add event listener to navigation links
                links.forEach(link => {
                    link.addEventListener('click', handleLinkClick);
                });

                // Highlight the active link on page load
                const currentPage = window.location.href;
                links.forEach(link => {
                    if (link.href === currentPage) {
                        link.classList.add('active');
                    }
                });
            });
        </script>


        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const loading = document.getElementById('loading');
                const links = document.querySelectorAll('.nav-link');

                // Function to show loading animation
                function showLoadingAnimation() {
                    loading.style.display = 'block';
                }

                // Function to hide loading animation
                function hideLoadingAnimation() {
                    loading.style.display = 'none';
                }


                // Add event listener to navigation links
                links.forEach(link => {
                    link.addEventListener('click', function (event) {
                        // Get the href attribute of the clicked link
                        const href = this.getAttribute('href');

                        // Check if the href is not empty and not equal to the current URL
                        if (href && href !== window.location.href) {
                            // Show loading animation if the URL is different
                            showLoadingAnimation();
                        }
                    });
                });

                // Add event listener to admin link
                const adminLink = document.querySelector('.dropdown-toggle');
                adminLink.addEventListener('click', function (event) {
                    // Toggle the dropdown menu
                    const dropdownMenu = this.nextElementSibling;
                    dropdownMenu.classList.toggle('show');
                    
                    // Hide loading animation when toggling dropdown
                    hideLoadingAnimation();
                });

                // Hide loading animation when content is loaded
                window.addEventListener('load', function () {
                    hideLoadingAnimation();
                });
            });
        </script>
        
        <script>
    document.addEventListener("DOMContentLoaded", function () {
        const loading = document.getElementById('loading');
        const links = document.querySelectorAll('.nav-link');
        const adminLink = document.querySelector('.dropdown-toggle');

        // Function to show loading animation
        function showLoadingAnimation() {
            loading.style.display = 'block';
        }

        // Function to hide loading animation
        function hideLoadingAnimation() {
            loading.style.display = 'none';
        }

        // Function to handle link click
        function handleLinkClick(event) {
            // Remove 'active' class from all links
            links.forEach(link => link.classList.remove('active'));

            // Add 'active' class to the clicked link
            this.classList.add('active');
        }

        // Function to handle admin dropdown toggle
        function handleAdminDropdownToggle(event) {
            // Toggle the dropdown menu
            const dropdownMenu = this.nextElementSibling;
            dropdownMenu.classList.toggle('show');

            // Hide loading animation whenever the dropdown is toggled
            hideLoadingAnimation();
        }

        // Add event listener to navigation links
        links.forEach(link => {
            link.addEventListener('click', function (event) {
                // Get the href attribute of the clicked link
                const href = this.getAttribute('href');

                // Check if the href is not empty and not equal to the current URL
                if (href && href !== window.location.href) {
                    // Show loading animation if the URL is different
                    showLoadingAnimation();
                }

                // Handle link click
                handleLinkClick.call(this, event);
            });
        });

        // Add event listener to admin dropdown toggle
        adminLink.addEventListener('click', handleAdminDropdownToggle);

        // Add event listener to admin dropdown menu items
        const dropdownItems = document.querySelectorAll('.dropdown-item');
        dropdownItems.forEach(item => {
            item.addEventListener('click', function (event) {
                // Hide loading animation when a dropdown item is clicked
                hideLoadingAnimation();
            });
        });

        // Hide loading animation when content is loaded
        window.addEventListener('load', function () {
            hideLoadingAnimation();
        });
    });
</script>





</body>
</html>

            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
<a class="notification" href="notify.php">
    <span href="notify.php"><i class="fa fa-bell" href="notify.php"></i></span>
    <span class='badge' href="notify.php"><?php echo $alerto; ?></span>
</a>
&nbsp; &nbsp;

		<ul class="navbar-nav">
			<li class="nav-item">

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="uploads/admin.jpg" style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #000; margin-right: 10px;">
        <?php echo $_SESSION['email'];?>
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" onclick="showChangePasswordModal()">Change Password</a></li>
        <li><a class="dropdown-item" onclick="signOutConfirmation()">Sign Out</a></li>
    </ul>
</li>

			</li>
		</ul>

       
      <script>
        function signOutConfirmation() {
            var modalContent = `<div class="modal fade" id="signOutConfirmationModal" tabindex="-1" aria-labelledby="signOutConfirmationModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="signOutConfirmationModalLabel">Sign Out Confirmation</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div> <div class="modal-body">Are you sure you want to sign out?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><a href='log-out.php' class="btn btn-danger">Sign Out</a></div></div></div></div>`;
            var existingModals = document.querySelectorAll('.modal');
            existingModals.forEach(modal => modal.remove());
            document.body.insertAdjacentHTML('beforeend', modalContent);
            var myModal = new bootstrap.Modal(document.getElementById('signOutConfirmationModal'));
            myModal.show();
        }
        function showChangePasswordModal() {
    var modalContent = `
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="changePasswordForm" method="POST">
                            <div class="mb-3">
                                <label for="currentPassword" class="form-label">Current Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="currentPassword"  name="cpassword" required>
                                    <button class="btn btn-outline-secondary" type="button" id="showCurrentPasswordButton" onclick="togglePassword('currentPassword')">Show</button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="newPassword"  name="npassword" required>
                                    <button class="btn btn-outline-secondary" type="button" id="showNewPasswordButton" onclick="togglePassword('newPassword')">Show</button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confirmPassword"  name="copassword" required>
                                    <button class="btn btn-outline-secondary" type="button" id="showConfirmPasswordButton" onclick="togglePassword('confirmPassword')">Show</button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" type="submit" value="submit" name="submit_btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>`;
    var existingModals = document.querySelectorAll('.modal');
    existingModals.forEach(modal => modal.remove());
    document.body.insertAdjacentHTML('beforeend', modalContent);
    var myModal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
    myModal.show();
}
function togglePassword(inputId) {
    var input = document.getElementById(inputId);
    var button = document.getElementById('show' + inputId.charAt(0).toUpperCase() + inputId.slice(1) + 'Button');
    if (input.type === "password") {
        input.type = "text";
        button.textContent = "Hide";
    } else {
        input.type = "password";
        button.textContent = "Show";
    }
}
    </script>
		</div>
			</div>
		</div>
		</nav>
        
    <br><br><br>