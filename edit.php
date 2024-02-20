<?php
    include_once("config.php");
    $id=$_REQUEST['id'];
	$itemCode="";
	$equipName="";
	$equipBrand="";
	$equipMOdel="";
	$equipType="";
	$quantity="";
	$rs=mysqli_query($mysqli,"select * from inventory where id=$id");
	if($result=mysqli_fetch_array($rs))
	{
		$itemCode=$result['item_code'];
		$equipName=$result["equipment_name"];
		$equipBrand=$result["equipment_brand"];
		$equipModel=$result["equipment_model"];
		$equipType=$result["equipment_type"];
		$quantity=$result["quantity"];
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

		</style>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></head>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="sidebar">
			<a href="index.php">Back</a>
		</div>
		<form method="post" action="update_inventory.php">
        <table>
            <tr>
                <td>ID:</td>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <td><?php echo $id ?></td>
            </tr>
            <tr>
                <td>Item Code:</td>
                <td><input type="text" name="update_itemCode" value="<?php echo $itemCode; ?>" placeholder="Enter the item code" required></td>
            </tr>
            <tr>
                <td>Equipment Name:</td>
                <td><input type="text" name="update_equipName" value="<?php echo $equipName; ?>" placeholder="Equipment name" required></td>
            </tr>
            <tr>
                <td>Equipment Brand:</td>
                <td><input type="text" name="update_equipBrand" value="<?php echo $equipBrand; ?>" placeholder="Equipment brand" required></td>
            </tr>
            <tr>
                <td>Equipment Model:</td>
                <td><input type="text" name="update_equipModel" value="<?php echo $equipModel; ?>" placeholder="Equipment model" required></td>
            </tr>
            <tr>
                <td>Equipment Type:</td>
                <td><input type="text" name="update_equipType" value="<?php echo $equipType; ?>" placeholder="Enter the equipment type" required></td>
            </tr>
            <tr>
                <td>Quantity:</td>
                <td><input type="number" name="update_quantity" value="<?php echo $quantity; ?>" placeholder="Quantity" required></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><input type="submit" name="btnSubmit" value="UPDATE"></td>
            </tr>
        </table>
    </form>
	</body>
</html>