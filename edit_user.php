<?php
include_once("config.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
$id = $_REQUEST['id'];
$itemCode = "";
$equipBrand = "";
$item_type = "";
$email = "";
$department = "";
$position = "";
$rs = mysqli_query($mysqli, "select * from account where UID=$id");
if ($result = mysqli_fetch_array($rs)) {
    $itemCode = $result['username'];
    $password = "";
    $equipBrand = $result["email"];
    $item_type = $result["user_type"];
    $department = $result["department"];
    $position = $result["position"];
    $userid = $result["iid"];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Inventory Admin</title>
        <style>
            * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
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
    <a href="<?php 
        if ($item_type === "user") {
            echo "instructor.php";
        } elseif ($item_type === "supply_user") {
            echo "supply_officer.php";
        } else {
            echo "admin-dashboard.php";
        }
    ?>">Back</a>
</div>
<form method="post" action="update_user.php" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Username:</td>
            <td colspan="2"><input type="text" name="username" value="<?php echo $itemCode; ?>" placeholder="Username" required></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td colspan="2"><input type="text" name="password" placeholder="Password"></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td colspan="2"><input type="text" name="email" value="<?php echo $equipBrand; ?>" placeholder="Email" required></td>
        </tr>
        <tr>
            <td>User Type:</td>
            <td colspan="2">
                <select name="user_type" required>
                    <option value="user" <?php echo ($item_type === 'user') ? 'selected' : ''; ?>>Instructor</option>
                    <option value="supply_user" <?php echo ($item_type === 'supply_user') ? 'selected' : ''; ?>>Supply Officer</option>
                </select>
            </td>
        </tr>

        <tr>
            <td <?php if ($item_type == 'user') {
                } else {
                    echo 'hidden';
                }
                 ?>>Department:</td>
            <td colspan="2">
                <select name="department" <?php if ($item_type == 'user') {
                } else {
                    echo 'hidden';
                }
                 ?>>
                    <option value="" <?php echo ($department === '') ? 'selected' : ''; ?>>-- choose department --</option>
                    <option value="BSBA" <?php echo ($department === 'BSBA') ? 'selected' : ''; ?>>BSBA</option>
                    <option value="BSIT" <?php echo ($department === 'BSIT') ? 'selected' : ''; ?>>BSIT</option>
                    <option value="BSCRIM" <?php echo ($department === 'BSCRIM') ? 'selected' : ''; ?>>BSCRIM</option>
                    <option value="BSEDUC" <?php echo ($department === 'BEED') ? 'selected' : ''; ?>>BEED</option>
                    <option value="BSHM" <?php echo ($department === 'BSHM') ? 'selected' : ''; ?>>BSHM</option>
                    <option value="HCS" <?php echo ($department === 'HCS') ? 'selected' : ''; ?>>HCS</option>
                    <option value="SHS" <?php echo ($department === 'SHS') ? 'selected' : ''; ?>>SHS</option>
                </select>
            </td>
        </tr>

        <tr>
            <?php
            if ($item_type == 'user') {
                echo "<td>Position:</td>";
                echo "<td colspan='3'><input type='text' name='position' value='" . $position . "' placeholder='Position'></td>";
            } else {
                echo "<td>";
                echo "<label for='positionl' class='form-label'>Position:</label><a style='color: red;'>*</a></td>";
                echo "<td><select name='position' class='form-control'>";
                echo     "<option value=''>-- choose position --</option>";
                echo     "<option value='Supply Officer'>Supply Officer</option>";
                echo     "<option value='General Merchandise'>General Merchandise</option>";
                echo     "<option value='Computer Technician'>Computer Technician</option>";
                echo "</select>";
                echo "</td>";
            }
            ?>
        </tr>
        <tr>
            <td>User Image:</td>
            <td>
                <input type="file" class="form-control" id="user_image" name="user_image" accept="image/*">
            </td>
        </tr>
        <tr>
            <td>User ID:</td>
            <td><input type="text" name="userid" value="<?php echo $userid; ?>" placeholder="User ID"></td>
        </tr>
        <tr>
            <td>User ID Image:</td>
            <td>
                <input type="file" id="id_image" name="id_image" accept="image/*">
            </td>
        </tr>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <tr>
            <td align="center" colspan="3">
                <input type="submit" name="btnSubmit" value="UPDATE" style="width: 100%;">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
