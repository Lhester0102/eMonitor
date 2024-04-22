<?php
include_once("config.php");

if(isset($_POST['btn_submit'])) {
    // Initialize variables
    $instructor_id = "";
    $id_image_path = "";
    $username = $_POST['item_code'];
    $password = $_POST['equipment_name'];
    $confirm = $_POST['equipment_namel'];
    $email = $_POST['equipment_brand'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $instructor_id = $_POST['instructor_id'];
    $user_type = "user";
    $uploadDir = "uploads/";
    $idup = "id/";

    // Check if image files are uploaded successfully
    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['user_image']['name'];
        $image_tmp = $_FILES['user_image']['tmp_name'];
        $image_path = $uploadDir . $image_name;
        $id_image_name = $_FILES['instructor_id_image']['name'];
        $id_image_tmp = $_FILES['instructor_id_image']['tmp_name'];
        $id_image_path = $idup . $id_image_name;

        // Move uploaded images to desired directory
        if (move_uploaded_file($image_tmp, $image_path) && move_uploaded_file($id_image_tmp, $id_image_path)) {

            // Check if passwords match
            if ($password == $confirm) {
                // Validate email
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Check password length
                    if (strlen($password) >= 5) {
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        // Prepare SQL statement
                        $stmt = $mysqli->prepare("INSERT INTO account (username, password, email, department, position, user_type, image_path, iid, iid_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        if ($stmt) {
                            // Bind parameters to the prepared statement
                            $stmt->bind_param("sssssssss", $username, $hashed_password, $email, $department, $position, $user_type, $image_path, $instructor_id, $id_image_path);

                            // Execute the prepared statement
                            if($stmt->execute()) {
                                echo '<script>alert("Record Saved Successfully"); window.location.href = "instructor.php";</script>';
                                exit();
                            } else {
                                echo '<script>alert("Error: Record Save Error: ' . $mysqli->error . '")</script>';
                            }
                        } else {
                            echo '<script>alert("Error: Unable to prepare SQL statement: ' . $mysqli->error . '")</script>';
                        }
                    } else {
                        echo '<script>alert("Password must be at least 5 characters long. Please try again.");</script>';
                    }
                } else {
                    echo '<script>alert("You have entered an invalid Email. Please try again.");</script>';
                }
            } else {
                echo '<script>alert("The passwords do not match. Please try again.");</script>';
            }
        } else {
            echo '<script>alert("Error: Image upload failed. Please try again.");</script>';
        }
    } else {
        echo '<script>alert("Error: Please select an image to upload.")</script>';
    }
}
?>



<!DOCTYPE html>
<html>
    <head>
        <title> Add Instructor </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .card {
            border: none;
            border-radius: 10px;
            padding: 20px;
            margin-top: 50px;
        }

        .card-title {
            color: #333;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn {
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
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
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="instructor.php">Back</a>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="item_code" class="form-label">Username:</label><a style="color: red;">*</a>
                                <input type="text" class="form-control" id="item_code" name="item_code" placeholder="Enter the Username" required>
                            </div>
                            <div class="mb-3">
    <label for="equipment_name" class="form-label">Password:</label>
    <div class="input-group">
        <input type="password" class="form-control" id="equipment_name" name="equipment_name" placeholder="Password" required>
        <button class="btn btn-outline-secondary" type="button" id="showPasswordBtn">Show</button>
    </div>
</div>
<div class="mb-3">
    <label for="equipment_namel" class="form-label">Confirm Password:</label>
    <div class="input-group">
        <input type="password" class="form-control" id="equipment_namel" name="equipment_namel" placeholder="Confirm Password" required>
        <button class="btn btn-outline-secondary" type="button" id="showConfirmPasswordBtn">Show</button>
    </div>
</div>

                            <div class="mb-3">
                                <label for="equipment_brand" class="form-label">Email:</label><a style="color: red;">*</a>
                                <input type="email" class="form-control" id="equipment_brand" name="equipment_brand" placeholder="Email" required>
                            </div>

                            <div class="mb-3">
    <label for="position" class="form-label">Position:</label><a style="color: red;">*</a>
    <input type="text" class="form-control" id="position" name="position" placeholder="Position" required value="Instructor" readonly>
</div>


                            <div class="mb-3">
                                <label for="equipment_brand" class="form-label">User Image:</label><a style="color: red;">*</a>
                                <input type="file" class="form-control" id="user_image" name="user_image" accept="image/*" required> 
                            </div>
                            <div class="mb-3">
                                <label for="equipment_brand" class="form-label">Instructor ID Image:</label>
                                <input type="file" class="form-control" id="instructor_id_image" name="instructor_id_image" accept="image/*">
                            </div>

                         
                            <div class="mb-3">
    <label for="instructor_id" class="form-label">Instructor ID:</label>
    <input type="text" class="form-control" id="instructor_id" name="instructor_id" placeholder="Instructor ID:" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8)" required>
</div>

                            <div class="mb-3">
                                <label for="department" class="form-label">Instructor Department:</label><a style="color: red;">*</a>
                                <select name="department" class="form-control" required>
                                    <option value="">-- choose department --</option>
                                    <option value="BSBA">BSBA</option>
                                    <option value="BSIT">BSIT</option>
                                    <option value="BSCRIM">BSCRIM</option>
                                    <option value="BEED">BEED</option>
                                    <option value="BSHM">BSHM</option>
                                    <option value="HCS">HCS</option>
                                    <option value="SHS">SHS</option>
                                </select>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" name="btn_submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<script>
    document.getElementById('showPasswordBtn').addEventListener('click', function() {
        var passwordInput = document.getElementById('equipment_name');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });

    document.getElementById('showConfirmPasswordBtn').addEventListener('click', function() {
        var confirmPasswordInput = document.getElementById('equipment_namel');
        if (confirmPasswordInput.type === 'password') {
            confirmPasswordInput.type = 'text';
        } else {
            confirmPasswordInput.type = 'password';
        }
    });
</script>
