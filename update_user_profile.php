<?php
session_start();
include_once("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSubmit'])) {
    $id = $_POST['id'];
    $username = $_POST['update_itemCode'];
    $password = $_POST['update_equipName'];
    $confirm = $_POST['update_equipBrand'];
    $uploadDir = "uploads/";

    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['user_image']['name'];
        $image_tmp = $_FILES['user_image']['tmp_name'];
        $image_path = $uploadDir . $image_name;

        if (move_uploaded_file($image_tmp, $image_path)) {
            if (!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $rs = mysqli_query($mysqli, "UPDATE account SET username='$username', password='$hashed_password', email='$confirm', image_path='$image_path' WHERE UID='$id'");
            } else {
                $rs = mysqli_query($mysqli, "UPDATE account SET username='$username', email='$confirm', image_path='$image_path' WHERE UID='$id'");
            }
        }
    } else {
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $rs = mysqli_query($mysqli, "UPDATE account SET username='$username', password='$hashed_password', email='$confirm' WHERE UID='$id'");
        } else {
            $rs = mysqli_query($mysqli, "UPDATE account SET username='$username', email='$confirm' WHERE UID='$id'");
        }
    }

    $_SESSION['email'] = $confirm;
    $_SESSION['username'] = $username;

    header("Location: user_dashboard.php");
    exit();
}
?>
