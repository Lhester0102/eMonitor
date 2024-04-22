<?php
session_start();
include_once("config.php");

if (isset($_POST['btn_login_a'])) {
    $un = $_POST['username'];
    $pass = $_POST['password'];

    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    $query = "SELECT * FROM account WHERE username=? AND user_type='admin' AND user_type='admin'";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $un);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $user = $result->fetch_assoc();

        if ($user !== null && password_verify($pass, $user['password'])) {
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['UID'] = $user['UID'];
            $_SESSION['image_path'] = $user['image_path'];
            $_SESSION['position'] = $user['position'];
            $position = $user['position'];
            $_SESSION['department'] = $user['department'];
            $_SESSION['iid'] = $user['iid'];
            $_SESSION['iid_image'] = $user['iid_image'];


            if ($position == 'General Merchandise') {
            $_SESSION['general'] = 'general';
            } else {
            $_SESSION['general'] = 'none';
            }
            session_regenerate_id(true);


            if ($position == 'General Merchandise') {
            header("Location: general-merch-dashboard.php");
            exit();
            } else {
            header("Location: admin-dashboard.php");
            exit();
            }
        } else {
            echo '<script>alert("Invalid username or password. Please try again.")</script>';
        }
    } else {
        echo '<script>alert("Error: Unable to fetch user data")</script>';
    }
}

if (isset($_POST['btn_login_i'])) {
    $un = $_POST['username'];
    $pass = $_POST['password'];

    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    $query = "SELECT * FROM account WHERE username=? AND user_type = 'user'";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $un);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $user = $result->fetch_assoc();

        if ($user !== null && password_verify($pass, $user['password'])) {
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['UID'] = $user['UID'];
            $_SESSION['image_path'] = $user['image_path'];
            $_SESSION['position'] = $user['position'];
            $_SESSION['department'] = $user['department'];
            $_SESSION['iid'] = $user['iid'];
            $_SESSION['iid_image'] = $user['iid_image'];
            $_SESSION['hierarchy'] = 'Instructor';

            session_regenerate_id(true);

            header("Location: user_dashboard.php");
            exit();
        } else {
            echo '<script>alert("Invalid username or password. Please try again.")</script>';
        }
    } else {
        echo '<script>alert("Error: Unable to fetch user data")</script>';
    }
}

if (isset($_POST['btn_login_p'])) {
    $un = $_POST['username'];
    $pass = $_POST['password'];

    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    $query = "SELECT * FROM account WHERE username=? AND position = 'Program Head' ";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $un);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $user = $result->fetch_assoc();

        if ($user !== null && password_verify($pass, $user['password'])) {
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['UID'] = $user['UID'];
            $_SESSION['image_path'] = $user['image_path'];
            $_SESSION['position'] = $user['position'];
            $_SESSION['department'] = $user['department'];
            $_SESSION['iid'] = $user['iid'];
            $_SESSION['iid_image'] = $user['iid_image'];
            $_SESSION['hierarchy'] = 'Program Head';

            session_regenerate_id(true);

            header("Location: user_dashboard.php");
            exit();
        } else {
            echo '<script>alert("Invalid username or password. Please try again.")</script>';
        }
    } else {
        echo '<script>alert("Error: Unable to fetch user data")</script>';
    }
}

















?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Login Page</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <script>
       function togglePassword(passwordId) {
    var passwordField = document.getElementById(passwordId);
    var showHideBtn = document.getElementById("show-hide-" + passwordId);
    if (passwordField.type === "password") {
        passwordField.type = "text";
        showHideBtn.textContent = "Hide Password";
    } else {
        passwordField.type = "password";
        showHideBtn.textContent = "Show Password";
    }
}
 
</script>

        <style>
            @import url("https://font.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Poppins", sans-serif;
            }

            body{
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                background: url('dccp.jpg') no-repeat;
                background-size: cover;
                background-position: center;
            }

            .wrapper{
                width: 420px;
                background: transparent;
                border: 2px solid rgba(255, 255, 255, .2);
                backdrop-filter: blur(20px);
                box-shadow: 0 0 10px rgba(0, 0, 0, .2);
                color: #fff;
                border-radius: 10px;
                padding: 30px 40px;
            }

            #logo {
                display: block;
                margin: 0 auto; /* This centers the image horizontally */
                width: 100px; /* Adjust the width as needed */
                height: auto; /* Maintain aspect ratio */
                margin-bottom: 20px; /* Add margin to create space between logo and heading */
            }

            .wrapper h1 {
                font-size: 23px;
                text-align: center;
            } 

            h2 {
                color: white;
            }


            .wrapper .input-box {
                position: relative;
                width: 100%;
                height: 50px;
                margin: 30px 0;
            }

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 10;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
    padding-top: -10px;
}

.modal-content {
    background: transparent;
    backdrop-filter: blur(100px);
    margin: 5% auto 0; /* Adjust the top margin here */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    width: 80%;
    max-width: 400px;

}


.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding-bottom: 10px;
    border-bottom: 1px solid #ccc;
    text-align: center;
}

.modal-header h2 {
    margin: 0;
    font-size: 24px;
}

.modal-body {
    padding: 20px 0;
}

.input-box {
    position: relative;
    margin-bottom: 20px;
}

.input-box input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.input-box input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.btn {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    border: none;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    border: black;
}

.btn:hover {
    background-color: #0056b3;
}

.ShowHidePassword {
    text-align: center;
}

.ShowHidePassword p {
    margin-top: 10px;
}

.ShowHidePassword p span {
    color: #007bff;
    cursor: pointer;
}

.ShowHidePassword p span:hover {
    text-decoration: underline;
}
span[id^="show-hide-password"] {
    color: white;
}


        </style>
    </head>
<body>
    <div class="wrapper">
        <img id="logo" src="dccplogo.png" alt="Logo">
        <h1>Data Center College of the <br> Philippines of Laoag City, Inc.</h1><br><br>
        <button class="btn" data-target="admin-modal">Administrators</button><br><br>
        <button class="btn" data-target="programhead-modal">Program Heads</button><br><br>
        <button class="btn" data-target="instructor-modal">Instructors</button><br><br>
    </div>

<div id="admin-modal" class="modal">
    <div class="modal-content" style="margin: 10% auto 0;">
        <span class="close">&times;</span>
        <h2><center>Administrator Login</h2></center>
        <form method="post" action="log-in.php" id="login-form-1">
            <img id="logo" src="dccplogo.png" alt="Logo">
            <div class="input-box">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="input-box">
            <input type="password" id="password1" name="password" placeholder="Password" required>
            </div>
            <div class="ShowHidePassword">
            <span id="show-hide-password1" onclick="togglePassword('password1')">Show Password</span>
            </div>
            <button type="submit" name="btn_login_a" class="btn">Login</button>
        </form>
    </div>
</div>

<div id="programhead-modal" class="modal">
    <div class="modal-content" style="margin: 10% auto 0;">
        <span class="close">&times;</span>
        <h2><center>Program Head Department</h2></center>
        <form method="post" action="log-in.php" id="login-form-1">
            <img id="logo" src="dccplogo.png" alt="Logo">
            <div class="input-box">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="input-box">
            <input type="password" id="password1" name="password" placeholder="Password" required>
            </div>
            <div class="ShowHidePassword">
            <span id="show-hide-password1" onclick="togglePassword('password1')">Show Password</span>
            </div>
            <button type="submit" name="btn_login_p" class="btn">Login</button>
        </form>
    </div>
</div>

<div id="instructor-modal" class="modal">
    <div class="modal-content" style="margin: 10% auto 0;">
        <span class="close">&times;</span>
        <h2><center>Instructor Department</h2></center>
        <form method="post" action="log-in.php" id="login-form-1">
            <img id="logo" src="dccplogo.png" alt="Logo">
            <div class="input-box">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="input-box">
            <input type="password" id="password1" name="password" placeholder="Password" required>
            </div>
            <div class="ShowHidePassword">
            <span id="show-hide-password1" onclick="togglePassword('password1')">Show Password</span>
            </div>
            <button type="submit" name="btn_login_i" class="btn">Login</button>
        </form>
    </div>
</div>
















<script>



    document.addEventListener('DOMContentLoaded', function () {
        var buttons = document.querySelectorAll('.btn');

        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                var targetModalId = button.getAttribute('data-target');
                var modal = document.getElementById(targetModalId);
                modal.style.display = 'block';

                var closeButton = modal.querySelector('.close');

                closeButton.addEventListener('click', function () {
                    modal.style.display = 'none';
                });

                window.addEventListener('click', function (event) {
                    if (event.target === modal) {
                        modal.style.display = 'none';
                    }
                });
            });
        });
    });
</script>

</body>
</html>





