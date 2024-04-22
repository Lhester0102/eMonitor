<?php
include_once("config.php");

$id = $_REQUEST['id'];
$uic = $_REQUEST['update_itemCode'];
$uen = $_REQUEST['update_equipName'];
$ueb = $_REQUEST['update_equipBrand'];
$uem = $_REQUEST['update_equipModel'];
$uploadDir = "uploads/";

if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
    $img_name = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
    $img_path = $uploadDir . $img_name;

    if (move_uploaded_file($img_tmp, $img_path)) {
        $rs = mysqli_query($mysqli, "UPDATE merch SET name='$uen', quantity='$ueb', measurement='$uem', image='$img_path' WHERE mid=$id");
        
        if ($rs) {
            header("Location: general_index.php");
            exit();
        } else {
            echo "Error updating inventory data: " . mysqli_error($mysqli);
        }
    } else {
        echo "Error moving uploaded file.";
    }
} else {
    $rs = mysqli_query($mysqli, "UPDATE merch SET name='$uen', quantity='$ueb', measurement='$uem' WHERE mid=$id");
    
    if ($rs) {
        header("Location: general_index.php");
        exit();
    } else {
        echo "Error updating inventory data: " . mysqli_error($mysqli);
    }
}
?>
