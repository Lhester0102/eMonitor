<?php
include_once("config.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSubmit'])) {
    $id = $_POST['id'];
    $update_query = "UPDATE account SET ";

    if (isset($_POST['username']) && !empty($_POST['username'])) {
        $update_query .= "username='" . $_POST['username'] . "', ";
    }

    // Password
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $update_query .= "password='" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "', ";
    }

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $update_query .= "email='" . $_POST['email'] . "', ";
    }

    if (isset($_POST['user_type']) && !empty($_POST['user_type'])) {
        $update_query .= "user_type='" . $_POST['user_type'] . "', ";
    }

    if (isset($_POST['department'])) {
        $update_query .= "department='" . $_POST['department'] . "', ";
    }

    if (isset($_POST['position']) && !empty($_POST['position'])) {
        $update_query .= "position='" . $_POST['position'] . "', ";
    }

    if (isset($_POST['userid']) && !empty($_POST['userid'])) {
        $update_query .= "iid='" . $_POST['userid'] . "', ";
    }

    // Handle image uploads
    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['user_image']['name'];
        $image_tmp = $_FILES['user_image']['tmp_name'];
        $image_path = "uploads/" . $image_name;
        if (move_uploaded_file($image_tmp, $image_path)) {
            $update_query .= "image_path='$image_path', ";
        }
    }

    if (isset($_FILES['id_image']) && $_FILES['id_image']['error'] === UPLOAD_ERR_OK) {
        $id_name = $_FILES['id_image']['name'];
        $id_tmp = $_FILES['id_image']['tmp_name'];
        $id_path = "id/" . $id_name;
        if (move_uploaded_file($id_tmp, $id_path)) {
            $update_query .= "iid_image='$id_path', ";
        }
    }

    // Remove the trailing comma and space
    $update_query = rtrim($update_query, ", ");

    // Add WHERE clause
    $update_query .= " WHERE UID='$id'";

    $rs = mysqli_query($mysqli, $update_query);

    if ($rs) {
        echo '<script>alert("User information updated successfully.");</script>';
    } else {
        echo '<script>alert("Error updating user information.");</script>';
    }

    // Redirect based on user type
    if ($_POST['user_type'] === "user") {
        header("Location: instructor.php");
        exit();
    } elseif ($_POST['user_type'] === "supply_user") {
        header("Location: supply_officer.php");
        exit();
    } else {
        header("Location: admin-dashboard.php");
        exit();
    }
}
?>
