<?php
    include_once("config.php");
    $id=$_REQUEST['id'];
	$itemCode="";
	$equipName="";
	$equipBrand="";
	$equipMOdel="";
	$equipType="";
	$quantity="";
    $borrow_no="";
    $item_type="";
    $img = "";
	$rs=mysqli_query($mysqli,"select * from inventory where id=$id");
	if($result=mysqli_fetch_array($rs))
	{
		$itemCode=$result['item_code'];
		$equipName=$result["equipment_name"];
		$equipBrand=$result["equipment_brand"];
		$equipModel=$result["equipment_model"];
		$quantity=$result["quantity"];
        $item_type=$result["item_type"];
        $img = $result["img"];
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

        input[type="button"] {
            width: 100%;
            background-color: white;
            color: black;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

		</style>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></head>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="sidebar">
			<a href="index.php">Back</a>
		</div>
		<form method="post" action="update_inventory.php" enctype="multipart/form-data">
        <table>
            <tr>
                <td>ID:</td>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <td><?php echo $id ?></td>
            </tr>
            <tr>
                <td>Barcode:</td>
                <td><a href="generator/generator2.php?id=<?php echo $id; ?>&code=<?php echo $itemCode; ?>"><input type="button" name="update_itemCode" value="<?php echo $itemCode; ?>" ></a></td>
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
                <td>Avilable No.:</td>
                <td><input type="number" name="update_quantity" value="<?php echo $quantity; ?>" placeholder="Quantity" required></td>
            </tr>
            <tr>
            <tr>
                <td>Item Type:</td>
                <td>
                    <select name="update_item_type" required>
                    <option value="consumable" <?php echo ($item_type === 'consumable') ? 'selected' : ''; ?>>Consumable</option>
                    <option value="non-consumable" <?php echo ($item_type === 'non-consumable') ? 'selected' : ''; ?>>Non-Consumable</option>
                    </select>
                </td>
            </tr>

<tr>
    <td>Item Image:</td>
    <td>
        <input type="file" class="form-control" id="img" name="img" accept="image/*">
    </td>
</tr>

                            <dtr>
                                <td for="locate" class="form-label">Inventory Location:</td>
                                <td>
                                <select name="locate" class="form-control">
                                    <option value="">-- choose inventory --</option>
                                    <option value="BSBA">BSBA</option>
                                    <option value="BSIT">BSIT</option>
                                    <option value="BSCRIM">BSCRIM</option>
                                    <option value="BEED">BEED</option>
                                    <option value="BSHM">BSHM</option>
                                    <option value="HCS">HCS</option>
                                    <option value="SHS">SHS</option>
                                    <option value="Supply Officer">Supply Officer</option>
                                    <option value="Unspecified">Unspecified</option>
                                </select>
                                </td>
                            </tr>
            <tr>
                <td align="center" colspan="2"><input type="submit" name="btnSubmit" value="UPDATE"></td>
            </tr>
        </table>
    </form>
	</body>
</html>