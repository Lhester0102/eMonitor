<?php
include_once("config.php");

$id = $_REQUEST['id'];
$uen = $_REQUEST['update_equipName'];
$ueb = $_REQUEST['update_equipBrand'];
$uem = $_REQUEST['update_equipModel'];
$uqt = $_REQUEST['update_quantity'];
$uit = $_REQUEST['update_item_type'];
$lo = !empty($_REQUEST['locate']) ? $_REQUEST['locate'] : 'Unspecified'; // Set $lo to 'Unspecified' if it's empty
$uploadDir = "uploads/";

if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
    $img_name = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
    $img_path = $uploadDir . $img_name;

    if (move_uploaded_file($img_tmp, $img_path)) {
        $rs = mysqli_query($mysqli, "UPDATE inventory SET equipment_name='$uen', equipment_brand='$ueb', equipment_model='$uem', quantity='$uqt', item_type='$uit', img='$img_path', locate='$lo' WHERE id='$id'");
        
        if ($rs) {
                    header("Location: index.php");
                    exit();
        } else {
            echo "Error updating inventory data: " . mysqli_error($mysqli);
        }
    } else {
        echo "Error moving uploaded file.";
    }
} else {
    $rs = mysqli_query($mysqli, "UPDATE inventory SET equipment_name='$uen', equipment_brand='$ueb', equipment_model='$uem', quantity='$uqt', item_type='$uit', locate='$lo' WHERE id='$id'");
    
    if ($rs) {
                    header("Location: index.php");
                    exit();
    } else {
        echo "Error updating inventory data: " . mysqli_error($mysqli);
    }
}
?>

