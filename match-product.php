<?php
	include_once("config.php");
	$rs=mysqli_query($mysqli, "select * from inventory");
?>
<!DOCTYPE html>
<html>
	<head>
        <title>Barcode Scanner</title>
        <link rel="stylesheet" href="styles.css">
        <script type="text/javascript">
        function scanBarcode() {
            var barcode = document.getElementById('barcode').value;
            // You can use AJAX to send the barcode to the server and fetch the product name
            // Here, for demonstration, we'll just redirect to a new page with the barcode
            window.location.href = "index.php?barcode=" + barcode;
        }
    </script>
    </head>
    <body>
    <div class="container">
        <h2>Barcode Scanner</h2>
        <form>
            <label for="barcode">Barcode:</label>
            <input type="text" id="barcode" name="barcode" required>
            <input type="button" value="Scan" onclick="scanBarcode()">
        </form>

        <?php
            include_once("config.php");

            // Check if barcode is provided in the URL
            if(isset($_GET['barcode'])) {
                $barcode = $_GET['barcode'];

                // Query the database to find the product with the given barcode
                $sql = "SELECT * FROM inventory WHERE item_code = '$barcode'";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    $product = $result->fetch_assoc();
        ?>

        <div class="product-info">
            <h2>Product Information</h2>
            <div>
                <label>Name:</label>
                <input type="text" value="<?php echo $product['equipment_name']; ?>" readonly><br><br>
                <label>Brand:</label>
                <input type="text" value="<?php echo $product['equipment_brand']; ?>" readonly><br><br>
                <label>Model:</label>
                <input type="text" value="<?php echo $product['equipment_model']; ?>" readonly><br><br>
                <label>Type:</label>
                <input type="text" value="<?php echo $product['equipment_type']; ?>" readonly><br><br>
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
        <a href="index.php" class="back-link">Back</a>
    </div>
    </body>
</html>