<?php
	include_once("config.php");
	$rs=mysqli_query($mysqli, "select * from inventory");
?>
<!DOCTYPE html>
<html>
	<head>
        <title>Barcode Scanner</title>
        <style>
            /* styles.css */

            body {
                font-family: Arial, sans-serif;
                background-color: #f7f7f7;
                margin: 0;
                padding: 0;
            }

            .container {
                width: 80%;
                margin: 50px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h2 {
                text-align: center;
            }

            form {
                text-align: center;
                margin-bottom: 20px;
            }

            label {
                font-weight: bold;
            }

            input[type="text"] {
                width: 100%;
                padding: 10px;
                margin-top: 5px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 3px;
                box-sizing: border-box;
            }

            input[type="button"] {
                background-color: #007bff;
                color: #fff;
                border: none;
                padding: 10px 20px;
                cursor: pointer;
                border-radius: 3px;
            }

            input[type="button"]:hover {
                background-color: #0056b3;
            }

            .product-info {
                background-color: #f9f9f9;
                padding: 20px;
                border-radius: 5px;
            }

            .back-link {
                display: block;
                text-align: center;
                margin-top: 20px;
                text-decoration: none;
                color: #007bff;
            }

            .back-link:hover {
                color: #0056b3;
            }

            /*Navigation Bar (sidebar)*/
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

                    .buttones {
                        width: 50px;
                        height: 20px;
                    }
                    
    .blue-button {
        background-color: #007bff;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

        </style>
        <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('barcode').addEventListener('input', function(event) {
            var barcode = event.target.value.trim();
            if (barcode !== '') {
                document.getElementById('barcodeForm').submit();
            }
        });
    });

    </script>
    </head>
<body>
    <div class="sidebar">
        <a href="index.php">Back</a>
    </div>
    <div class="container">
        <h2>Barcode Scanner</h2>
        <form method="GET">
            <label for="barcode">Barcode:</label>
            <input type="text" id="barcode" name="barcode" required>
            <input type="submit" value="Scan" onclick="scanBarcode()" class="blue-button">
        </form>
        <?php
            include_once("config.php");
            if(isset($_GET['barcode'])) {
                $barcode = $_GET['barcode'];
                $sql = "SELECT * FROM inventory WHERE item_code = '$barcode'";
                $result = $mysqli->query($sql);
                if ($result->num_rows > 0) {
                    $product = $result->fetch_assoc();
        ?>
        <div class="product-info">
            <h2>Product Information</h2>
            <div align="center">
                <img class='myImg' src='barcode/<?php echo $product['item_code']; ?>.png' alt='<?php echo $product['item_code']; ?>' style='height: 40px; border: 2px solid #000;'> <br><br>
                <label>Name:</label>
                <input type="text" value="<?php echo $product['equipment_name']; ?>" readonly><br><br>
                <label>Brand:</label>
                <input type="text" value="<?php echo $product['equipment_brand']; ?>" readonly><br><br>
                <label>Model:</label>
                <input type="text" value="<?php echo $product['equipment_model']; ?>" readonly><br><br>
                <label>Type:</label>
                <input type="text" value="<?php echo $product['item_type']; ?>" readonly><br><br>
                <label>Quantity:</label>
                <input type="text" value="<?php echo $product['quantity']; ?>" readonly><br><br>
                <label>Barcode:</label>
                <input type="text" value="<?php echo $product['item_code']; ?>" readonly><br><br>
            </div>
        </div>
        <?php
                } else {
                    echo "<p>No product found with the provided barcode.</p>";
                }
            }
        ?>
    </div>
    <script>
        function scanBarcode() {
            var barcode = document.getElementById("barcode").value;
            window.location.href = "your_page.php?barcode=" + barcode;
        }
    </script>
</body>

</html>


