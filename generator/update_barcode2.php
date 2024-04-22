<?php
include_once("../config.php");
$id=$_REQUEST['id'];
$code=$_REQUEST['code'];
$how=$_REQUEST['how'];
$itemCode="";
$rs=mysqli_query($mysqli,"select item_code from inventory where id=$id");
if($result=mysqli_fetch_array($rs))
{
    $itemCode=$result['item_code'];
}

// Handle file upload
if(isset($_POST['btnSubmit'])) {
    $targetDir = "../barcode/";
    $targetFile = $targetDir . basename($_FILES["barcode_img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["btnSubmit"])) {
        $check = getimagesize($_FILES["barcode_img"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["barcode_img"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Check if the uploaded file name matches $code
$uploadedFileName = basename($_FILES["barcode_img"]["name"]);
if ($uploadedFileName != $code . '.' . $imageFileType) {
    echo "Sorry, the uploaded file name doesn't match the barcode code.";
    $uploadOk = 0;
}

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo " Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["barcode_img"]["tmp_name"], $targetFile)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["barcode_img"]["name"])). " has been uploaded.";
            $filePath = $targetFile;

            // Update the database with the new barcode value
            $updateQuery = "UPDATE inventory SET item_code='$code' WHERE id=$id";
            mysqli_query($mysqli, $updateQuery);
            
            header("Location: ../index.php");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title> Edit Inventory Admin</title>
    <style>
        /* Reset CSS */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        /* Navigation Bar (sidebar) */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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

        /* Form Styling */
        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
        }

        td {
            padding: 10px;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 5px 0;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #044e85;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="button"] {
            width: 100%;
            background-color: white;
            color: black;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #1d6193;
        }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<div class="sidebar" <?php if ($how == 1) { echo "hidden"; } else { } ?>>
    <a href="generator2.php?id=<?php echo $id; ?>&code=<?php echo $code; ?>" >Back</a>
</div>
<form method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Barcode No./Name:</td>
            <td><input type="text" name="barcode" value="<?php echo $code; ?>" readonly></td>
        </tr>
        <tr>
            <td>Barcode Image:</td>
            <td>
                <input type="file" class="form-control" id="barcode_img" name="barcode_img" accept="image/*" required>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2"><input type="submit" name="btnSubmit" value="UPDATE"></td>
        </tr>
    </table>
</form>
</body>
</html>
