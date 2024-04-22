<?php
    $id=$_REQUEST['id'];
    $code=$_REQUEST['code'];
    $how = 0;
    if ($code == 0) { $how = "1"; } else { $how = "0"; } 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Inventory Admin</title>
    <style>
        /* Reset CSS */
 /* Reset CSS */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box; /* Added to include padding and border in element's total width and height */
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    color: #333; /* Changed text color for better contrast */
}

/* Navigation Bar (sidebar) */
.sidebar {
    width: 100%;
    background-color: #044e85;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Added subtle shadow */
}

.sidebar a {
    color: #fff;
    text-decoration: none;
    font-size: 17px;
    display: block;
    padding: 14px 16px;
    text-align: center;
    transition: background-color 0.3s ease; /* Added smooth transition */
}

.sidebar a:hover {
    background-color: #1d6193;
}

/* Form Styling */
.container {
    max-width: 600px;
    margin: 40px auto;
    padding: 30px; /* Increased padding for better spacing */
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 7px 10px rgba(0, 0, 0, 0.1); /* Added slightly stronger shadow */
}

.barcode-title {
    text-align: center;
    margin-bottom: 30px; /* Increased margin for better separation */
    font-size: 24px; /* Increased font size for emphasis */
}

.form-group {
    text-align: center;
    margin-bottom: 30px;
}

.form-group label {
    display: block;
    text-align: center;
    margin-bottom: 10px; /* Increased margin for better separation */
}

.form-group input[type="text"],
.form-group select {
    width: calc(100% - 20px);
    padding: 14px;
    border: 2px solid #ccc;
    border-radius: 5px;
    margin: 10px auto; 
    display: block;
    text-align: center;
    transition: border-color 0.3s ease; /* Added smooth transition for input focus */
}

.form-group input[type="text"]:focus,
.form-group select:focus {
    border-color: #1d6193; /* Highlight border color on focus */
}

input[type="submit"] {
    width: 100%;
    background: linear-gradient(to right, #044e85, #1d6193); /* Gradient background */
    color: #fff;
    padding: 14px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.3s ease; /* Smooth background transition */
}

input[type="submit"]:hover {
    background: linear-gradient(to right, #1d6193, #044e85); /* Reverse gradient on hover */
}

.col-md-6 {
    display: inline-block;
    margin: 0 auto;
    float: none;
}

.col-md-4 {
    margin: 0 auto;
    text-align: center;
}

/* Hide the sidebar if code is 0 */
.sidebar[hidden] {
    display: none;
}

/* Hide the container if code is 0 */
.container[hidden] {
    display: none;
}


    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="formal">
<div class="sidebar" <?php if ($code == 0) { echo "hidden"; } elseif ($how == 1) { echo "hidden"; } else { } ?>>
    <a href="../edit.php?id=<?php echo $id; ?>">Back</a>
</div>
<div class="container"class="formal">
    <div>&nbsp;</div>
    <p style="text-align:center; font-size: 36px;">GENERATE BARCODE</p>

 <br>
    <form method="post" class="formal">
        <div class="row"class="formal">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="formal">Product Name or Number:</label>
                    
                    <input type="text" name="barcodeText" class="form-control" value="<?php echo isset($_POST['barcodeText']) ? htmlspecialchars($_POST['barcodeText']) : $code; ?>" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Barcode Type:</label>
                
                    <select name="barcodeType" id="barcodeType" class="form-control">
                        <option value="code128" <?php echo (isset($_POST['barcodeType']) && $_POST['barcodeType'] == 'code128') ? 'selected' : ''; ?>>Code128</option>
                        <option value="code39" <?php echo (isset($_POST['barcodeType']) && $_POST['barcodeType'] == 'code39') ? 'selected' : ''; ?>>Code39</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Barcode Display:</label>
                 
                    <select name="barcodeDisplay" class="form-control" required>
                        <option value="horizontal" <?php echo (isset($_POST['barcodeDisplay']) && $_POST['barcodeDisplay'] == 'horizontal') ? 'selected' : ''; ?>>Horizontal</option>
                        <option value="vertical" <?php echo (isset($_POST['barcodeDisplay']) && $_POST['barcodeDisplay'] == 'vertical') ? 'selected' : ''; ?>>Vertical</option>
                    </select>
                </div>
            </div>
        </div>
        <input type="hidden" name="barcodeSize" id="barcodeSize" value="30">
        <input type="hidden" name="printText" id="printText" value="true">
       
        <div class="text-center">
    <button type="submit" name="generateBarcode" class="btn btn-primary mr-2 mb-4">Generate Barcode</button>
</div>

    </form>
    <div class="col-md-4">
        <?php
        if(isset($_POST['generateBarcode'])) {
            $barcodeText = trim($_POST['barcodeText']);
            $barcodeType=$_POST['barcodeType'];
            $barcodeDisplay=$_POST['barcodeDisplay'];
            $barcodeSize=$_POST['barcodeSize'];
            $printText=$_POST['printText'];
            if($barcodeText != '') {
                echo '<h4>Barcode:</h4>';
                echo '<img class="barcode" alt="'.$barcodeText.'" src="barcode.php?text='.$barcodeText.'&codetype='.$barcodeType.'&orientation='.$barcodeDisplay.'&size='.$barcodeSize.'&print='.$printText.'"/>';

        // Adding download button with JavaScript redirect
        echo '<br><a id="downloadLink" href="barcode.php?text='.$barcodeText.'&codetype='.$barcodeType.'&orientation='.$barcodeDisplay.'&size='.$barcodeSize.'&print='.$printText.'" download="'.$barcodeText.'.png" class="btn btn-success mt-2">Download Barcode And Proceed</a>';

        // JavaScript to redirect after download
        echo '<script>
                document.getElementById("downloadLink").addEventListener("click", function() {
                    setTimeout(function() {
                        window.location.href = "update_barcode2.php?id='.$id.'&code='.$barcodeText.'&how='.$how.'";
                    }, 1000);
                });
              </script>';
            } else {
                echo '<div class="alert alert-danger">Enter product name or number to generate barcode!</div>';
            }
        }
        ?>
    </div>
</div>
<!-- Loading Scripts -->
<script src="js/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
