

<?php
session_start();
include_once("config.php");

$id = $_SESSION['UID'];

$itemCode = "";
$equipName = "";
$equipBrand = "";
$item_type = "";
$image_path = "";

$rs = mysqli_query($mysqli, "SELECT * FROM account WHERE UID = $id");

if ($result = mysqli_fetch_array($rs)) {
    $itemCode = $result['username'];
    $equipBrand = $result['email'];
    $item_type = $result['user_type'];
    $image_path = $result['image_path'];
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

        input[type="submit"]:hover {
            background-color: #1d6193;
        }

        .circular-image{
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 100%;
        }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body>




<div class="sidebar">
    <a href="supply_user_dashboard.php">Back</a>
</div>

<form method="post" action="update_supply_user_profile.php" enctype="multipart/form-data">
    <table>
        <tr>
            <td>ID:</td>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <td style="position: relative;" colspan="2"><?php echo $id ?></td>
        </tr>

        <tr>
            <td>Username:</td>
            <td colspan="2"><input type="text" name="update_itemCode" value="<?php echo $itemCode; ?>" placeholder="Username" required></td>
        </tr>

        <tr>
            <td>Password:</td>
            <td colspan="2"><input type="text" name="update_equipName" placeholder="Password"></td>
        </tr>

        <tr>
            <td>Email:</td>
            <td colspan="2"><input type="text" name="update_equipBrand" value="<?php echo $equipBrand; ?>" placeholder="Email" required></td>
        </tr>

        <tr>
            <td>User Image:</td>
            <td>
                <input type="file" class="form-control" id="user_image" name="user_image" accept="image/*">
            </td>
        </tr>

        <tr>
            <td align="center" colspan="3">
                <input type="submit" name="btnSubmit" value="UPDATE" style="width: 100%;">
            </td>
        </tr>
    </table>
</form>






    </body>
</html>


