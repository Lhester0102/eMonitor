<?php
session_start();
include_once("config.php");


if (isset($_REQUEST['btn_login'])) {
    $un = $_REQUEST['username'];
    $pass = $_REQUEST['password'];
    $btn = $_REQUEST['btn_login'];

    $rs = mysqli_query($mysqli, "SELECT * FROM account WHERE username='$un' AND password='$pass'");
    $count = mysqli_num_rows($rs);

    if ($count == 1) {
        $result = mysqli_fetch_array($rs);
        $type = $result['user_type'];
        $_SESSION['username'] = $un;

        if (strcmp($type, "admin") == 0) {
            header("Location: admin-dashboard.php");
        } elseif (strcmp($type, "user") == 0) {
            header("Location: user_dashboard.php");
        } elseif (strcmp($type, "supply_user") == 0) {
            header("Location: supply_user_dashboard.php");
        } else {
            echo '<script>alert("Error Login")</script>';
        }
    } else {
        echo '<script>alert("Error Login")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            /* Adding space for the logo */
            padding-top: 50px;
            padding-bottom: 50px;
        }

        #logo {
            width: 100px; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
            margin-bottom: 20px; /* Add margin to create space between logo and heading */
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        #show-hide-password {
            color: blue;
            cursor: pointer;
        }

        #show-hide-password:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <form method="post" action="log-in.php">
        <div id="login-container">
            <!-- Add your logo here -->
            <img id="logo" src="dccplogo.png" alt="Logo">
            <h2>Data Center College of <br> Philippines of Laoag City, Inc.</h2>
            <form id="login-form">
                <input type="text" id="username" name="username" placeholder="Username" required>
                <br>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <span id="show-hide-password" onclick="togglePassword()">Show Password</span>
                <br>
                <input type="submit" name="btn_login" value="Login">
            </form>
        </div>
    </form>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var showHideBtn = document.getElementById("show-hide-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                showHideBtn.textContent = "Hide Password";
            } else {
                passwordField.type = "password";
                showHideBtn.textContent = "Show Password";
            }
        }
    </script>
</body>
</html>