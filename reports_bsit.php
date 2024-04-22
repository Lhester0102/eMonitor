<?php
session_start();
include_once("config.php");
if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] !== "admin" && $_SESSION['user_type'] !== "supply_user")) {
    header("Location: log-out.php");
    exit();
}

$name = '';



$rs = mysqli_query($mysqli, "SELECT inventory.*, COALESCE(SUM(borrowed_amount), 0) AS total_borrowed_amount 
          FROM inventory 
          LEFT JOIN borrowed_item ON inventory.id = borrowed_item.item_code 
          WHERE inventory.item_type = 'consumable' AND inventory.locate = 'BSIT'
          GROUP BY inventory.id");

$rt = mysqli_query($mysqli, "SELECT inventory.*, COALESCE(SUM(borrowed_amount), 0) AS total_borrowed_amount 
          FROM inventory 
          LEFT JOIN borrowed_item ON inventory.id = borrowed_item.item_code 
          WHERE inventory.item_type = 'non-consumable' AND inventory.locate = 'BSIT'
          GROUP BY inventory.id");

    $rr = mysqli_query($mysqli, "SELECT * FROM borrowed_item WHERE item_type = 'non-consumable'");
    $rb = mysqli_query($mysqli, "SELECT * FROM borrowed_item WHERE item_type = 'consumable'");

if(isset($_POST["generate_pdf"]))  
{  
    require_once('tcpdf/tcpdf.php');  
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $obj_pdf->SetCreator(PDF_CREATOR);  
    $obj_pdf->SetTitle("PHP Report Generation");  
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $obj_pdf->SetDefaultMonospacedFont('helvetica');  
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $obj_pdf->setPrintHeader(false);  
    $obj_pdf->setPrintFooter(false);  
    $obj_pdf->SetAutoPageBreak(TRUE, 10);  
    $obj_pdf->SetFont('helvetica', '', 11);  
    $obj_pdf->AddPage();  
    $content = '';  
    $content .= '<h1 align="center">INVENTORY REPORT</h1><br /> 
                 <table border="1" cellspacing="0" cellpadding="3">  
                    <tr width="100%">  
                        <th>Item Code</th>  
                        <th>Equipment Name</th>  
                        <th>Equipment Brand</th>  
                        <th>Quantity</th>  
                    </tr>';  
    $content .= fetch_data($mysqli, $name);  
    $content .= '</table>';  
    $obj_pdf->writeHTML($content);  
    $obj_pdf->Output('file.pdf', 'I');  
} 
?>





<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        table th,
        table td {
            font-weight: normal;
        }

    </style>
</head>
<body>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
	
	<?php include("navigations.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>



    <table align="center" width="75%" style="margin-top: 10px;">
        <tr> 
            <th>
                <div class="container">  
                    <h1 align="center">INVENTORY REPORTS</h1><br />  
                    <form method="post">
                        <div class="col-md-12" align="right">

                        <button type="button" class="btn btn-success" onclick="printAndRedirect()">Print</button>

                        <br>
                        <br>
                        
<div class="btn-toolbar mb-3" role="toolbar" aria-label="Inventory Categories" style="justify-content: center;">
    <div class="btn-group" role="group" aria-label="Inventory Categories">
        <a href="reports.php" class="btn btn-outline-primary">All Inventory</a>
        <a href="reports_bshm.php" class="btn btn-outline-primary">BSHM Inventory</a>
        <a href="reports_bsit.php" class="btn btn-primary">BSIT Inventory</a>
        <a href="reports_beed.php" class="btn btn-outline-primary">BEED Inventory</a>
        <a href="reports_hcs.php" class="btn btn-outline-primary">HCS Inventory</a>
        <a href="reports_shs.php" class="btn btn-outline-primary">SHS Inventory</a>
        <a href="reports_bsba.php" class="btn btn-outline-primary">BSBA Inventory</a>
        <a href="reports_bscrim.php" class="btn btn-outline-primary">BSCRIM Inventory</a>
        <a href="reports_unspecified.php" class="btn btn-outline-primary">Unspecified Inventory</a>
    </div>
</div>
    </br>

<script>
    function printAndRedirect() {
        window.location.href = 'text_file.php?what=BSIT';
    }
</script>

<div class="container mt-4">
<div class="card">
        <div class="card-body">
            <div class="table-responsive">  
                <table class="table table-striped" style="border: 1px solid black;">
                <thead>
                        <tr> 
    <tr> <th colspan="6"><b><center>BSIT Inventory</b></th> </tr></center>
    <tr style="border: 1px solid black;"> 
        <th style='border: 1px solid black;'><b>Barcode ID</b></th> 
        <th style='border: 1px solid black;'><b>Equipment Name</b></th> 
        <th style='border: 1px solid black;'><b>Equipment Brand</b></th> 
        <th style='border: 1px solid black;'><b>Available Number</b></th> 
        <th style='border: 1px solid black;'><b>Borrowed Number</b></th> 
        <th style='border: 1px solid black;'><b>Item Type</b></th> 
    </tr>
                        </tr>
                    </thead>
    <?php
    $bsit_query = mysqli_query($mysqli, "SELECT inventory.item_code AS barcode_id, 
    inventory.equipment_name AS equipment_name, 
    inventory.equipment_brand AS equipment_brand, 
    inventory.quantity AS available_number, 
    COALESCE(SUM(borrowed_item.borrowed_amount), 0) AS borrowed_number, 
    inventory.item_type AS item_type 
    FROM inventory 
    LEFT JOIN (SELECT item_code, SUM(borrowed_amount) AS borrowed_amount 
            FROM borrowed_item GROUP BY item_code) AS borrowed_item 
    ON inventory.id = borrowed_item.item_code 
    WHERE inventory.locate = 'BSIT' 
    GROUP BY inventory.item_code");
    if ($bsit_query) {
        if(mysqli_num_rows($bsit_query) > 0) {
            while ($bsit_row = mysqli_fetch_array($bsit_query)) {
                echo "<tr style='border: 1px solid black;'>";
                echo "<td style='border: 1px solid black;'>" . $bsit_row['barcode_id'] . "</td>";
                echo "<td style='border: 1px solid black;'>" . $bsit_row['equipment_name'] . "</td>";
                echo "<td style='border: 1px solid black;'>" . $bsit_row['equipment_brand'] . "</td>";
                echo "<td style='border: 1px solid black;'>" . $bsit_row['available_number'] . "</td>";
                echo "<td style='border: 1px solid black;'>" . $bsit_row['borrowed_number'] . "</td>";
                echo "<td style='border: 1px solid black;'>" . $bsit_row['item_type'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr style='border: 1px solid black;'><td colspan='6' class='text-center'>No BSIT inventory data found.</td></tr>";
        }
    } else {
        echo "<tr style='border: 1px solid black;'><td colspan='6' class='text-center'>Error fetching BSIT inventory data: " . mysqli_error($mysqli) . "</td></tr>";
    }
    ?>
</table>

</table><br><br>


                            
                        </div>
                    </form>  
                    <br/><br/>
                