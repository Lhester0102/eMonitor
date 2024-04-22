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
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        /* Navigation Bar (sidebar) */
        .sidebar {
            width: 100%;
            background-color: #044e85;
            overflow: hidden;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            font-size: 17px;
            display: block;
            padding: 14px 16px;
            text-align: center;
        }

        .sidebar a:hover {
            background-color: #1d6193;
        }

        /* Form Styling */
        .container {
            max-width: 600px;
            text-align: center;
            padding-top: 20px;
        }

        .form-group {
            text-align: center;
        }

        .form-group input,
        .form-group select {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 5px 0;
            text-align: center;
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

        .col-md-4 {
            margin-top: 20px;
        }

        .formal {
        	text-align: center;
        	align-content: center;
        	align-items: center;
        	align-self: center;
        	align-tracks: center;
        	box-align: center;
        	ruby-align: center;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="formal">
<div class="sidebar" <?php if ($code == 0) { echo "hidden"; } elseif ($how == 1) { echo "hidden"; } else { } ?>>
    <a href="../merch_edit.php?id=<?php echo $id; ?>">Back</a>
</div>
<div class="container"class="formal">
    <div>&nbsp;</div>
    <P>Barcode Generator</P>
    <form method="post" class="formal">
        <div class="row"class="formal">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="formal">Product Name or Number</label>
                    <input type="text" name="barcodeText" class="form-control" value="<?php echo isset($_POST['barcodeText']) ? htmlspecialchars($_POST['barcodeText']) : $code; ?>" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Barcode Type</label>
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
                    <label>Barcode Display</label>
                    <select name="barcodeDisplay" class="form-control" required>
                        <option value="horizontal" <?php echo (isset($_POST['barcodeDisplay']) && $_POST['barcodeDisplay'] == 'horizontal') ? 'selected' : ''; ?>>Horizontal</option>
                        <option value="vertical" <?php echo (isset($_POST['barcodeDisplay']) && $_POST['barcodeDisplay'] == 'vertical') ? 'selected' : ''; ?>>Vertical</option>
                    </select>
                </div>
            </div>
        </div>
        <input type="hidden" name="barcodeSize" id="barcodeSize" value="30">
        <input type="hidden" name="printText" id="printText" value="true">
        <button type="submit" name="generateBarcode" class="btn btn-primary mr-2 mb-4">Generate Barcode</button>
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
                        window.location.href = "update_barcode.php?id='.$id.'&code='.$barcodeText.'&how='.$how.'";
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
