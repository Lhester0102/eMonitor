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
          WHERE inventory.item_type = 'consumable'
          GROUP BY inventory.id");

$rt = mysqli_query($mysqli, "SELECT inventory.*, COALESCE(SUM(borrowed_amount), 0) AS total_borrowed_amount 
          FROM inventory 
          LEFT JOIN borrowed_item ON inventory.id = borrowed_item.item_code 
          WHERE inventory.item_type = 'non-consumable'
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
        <a href="reports.php" class="btn btn-primary">All Inventory</a>
        <a href="reports_bshm.php" class="btn btn-outline-primary">BSHM Inventory</a>
        <a href="reports_bsit.php" class="btn btn-outline-primary">BSIT Inventory</a>
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
        window.location.href = 'text_file.php?what=report';
    }
</script>

                            
                        </div>
                    </form>  
                
                    <div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">  
                <table class="table table-striped" style="border: 1px solid black;">
                    <thead>
                        <tr> 
                            <th colspan="5" class="text-center"><b><center>Consumable Items Inventory</b></th> </center>
                        </tr>
                        <tr>
                            <th style='border: 1px solid black;'><b>Barcode</b></th> 
                            <th style='border: 1px solid black;'><b>Equipment Name</b></th> 
                            <th style='border: 1px solid black;'><b>Equipment Brand</b></th> 
                            <th style='border: 1px solid black;'><b>Quantity</b></th> 
                            <th style='border: 1px solid black;'><b>Amount of Borrowed</b></th> 
                        </tr>
                    </thead>
                    
            <?php
            if ($rs) {
                if(mysqli_num_rows($rs) > 0) {
                    while ($res = mysqli_fetch_array($rs)) {
                        echo "<tr style='border: 1px solid black;'>";
                        echo "<td style='border: 1px solid black;'>" . $res['item_code'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $res['equipment_name'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $res['equipment_brand'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $res['quantity'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $res['total_borrowed_amount'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr style='border: 1px solid black;'><td colspan='5' class='text-center'>Search not found.</td></tr>";
                }
            } else {
                echo "<tr style='border: 1px solid black;'><td colspan='5' class='text-center'>Error fetching inventory data: " . mysqli_error($mysqli) . "</td></tr>";
            }
            ?>
        
        <div class="container mt-4">
        <div class="card-body">
            <div class="table-responsive">  
                <table class="table table-striped" style="border: 1px solid black;">
                <thead>
                        <tr> 
            <tr> <th colspan="5"><b><center>Non-Consumable Items Inventory</b></th></center>
            </tr>
                        <tr>
            <tr style="border: black; border: 1px solid black;"> 
                <th style='border: 1px solid black;'><b>Barcode</b></th> 
                <th style='border: 1px solid black;'><b>Equipment Name</b></th> 
                <th style='border: 1px solid black;'><b>Equipment Brand</b></th> 
                <th style='border: 1px solid black;'><b>Quantity</b></th> 
                <th style='border: 1px solid black;'><b>Amount of Borrowed</b></th> 
            </tr>
                        </tr>
                        </tr>
                </thead>
        

            <?php
            if ($rt) {
                if(mysqli_num_rows($rt) > 0) {
                    while ($ret = mysqli_fetch_array($rt)) {
                        echo "<tr style='border: 1px solid black;'>";
                        echo "<td style='border: 1px solid black;'>" . $ret['item_code'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $ret['equipment_name'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $ret['equipment_brand'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $ret['quantity'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $ret['total_borrowed_amount'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr style='border: 1px solid black;'><td colspan='5' class='text-center'>Search not found.</td></tr>";
                }
            } else {
                echo "<tr style='border: 1px solid black;'><td colspan='5' class='text-center'>Error fetching inventory data: " . mysqli_error($mysqli) . "</td></tr>";
            }
            ?>
   
   <div class="container mt-4">
        <div class="card-body">
            <div class="table-responsive">  
                <table class="table table-striped" style="border: 1px solid black;">
                    <thead>
                        <tr> 
            <tr> <th colspan="7"><b><center>Borrowed Non-Consumable Items Inventory</b></th> </tr></center>
            <tr style="border: black; border: 1px solid black;"> 
                <th style='border: 1px solid black;'><b>Barcode</b></th> 
                <th style='border: 1px solid black;'><b>Equipment Name</b></th> 
                <th style='border: 1px solid black;'><b>Borrower</b></th> 
                <th style='border: 1px solid black;'><b>Borrowed Amount</b></th> 
                <th style='border: 1px solid black;'><b>Date of Acquisition</b></th> 
                <th style='border: 1px solid black;'><b>Building Destination</b></th> 
                <th style='border: 1px solid black;'><b>Date of Ceding</b></th> 
                </tr>
                        </tr>
                        </tr>
                </thead>
           

            <?php
            if ($rr) {
                if(mysqli_num_rows($rr) > 0) {
                    while ($rer = mysqli_fetch_array($rr)) {
                        echo "<tr style='border: 1px solid black;'>";
                        echo "<td style='border: 1px solid black;'>" . $rer['item_code'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $rer['equipment_name'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $rer['borrower'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $rer['borrowed_amount'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $rer['borrow_date'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $rer['request_destination'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $rer['request_date'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr style='border: 1px solid black;'><td colspan='5' class='text-center'>Search not found.</td></tr>";
                }
            } else {
                echo "<tr style='border: 1px solid black;'><td colspan='5' class='text-center'>Error fetching inventory data: " . mysqli_error($mysqli) . "</td></tr>";
            }
            ?>
       
       <div class="container mt-4">
        <div class="card-body">
            <div class="table-responsive">  
                <table class="table table-striped" style="border: 1px solid black;">
                    <thead>
                        <tr> 
            <tr> <th colspan="7"><b><center>Borrowed Consumable Items Inventory</b></th> </tr></center>
            <tr style="border: black; border: 1px solid black;"> 
                <th style='border: 1px solid black;'><b>Barcode</b></th> 
                <th style='border: 1px solid black;'><b>Equipment Name</b></th> 
                <th style='border: 1px solid black;'><b>Borrower</b></th> 
                <th style='border: 1px solid black;'><b>Borrowed Amount</b></th> 
                <th style='border: 1px solid black;'><b>Date of Acquisition</b></th> 
                <th style='border: 1px solid black;'><b>Building Destination</b></th> 
                <th style='border: 1px solid black;'><b>Date of Ceding</b></th> 
                </tr>
                        </tr>
                        </tr>
                </thead>
            <br>
            

            <?php
            if ($rb) {
                if(mysqli_num_rows($rb) > 0) {
                    while ($reb = mysqli_fetch_array($rb)) {
                        echo "<tr style='border: 1px solid black;'>";
                        echo "<td style='border: 1px solid black;'>" . $reb['item_code'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $reb['equipment_name'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $reb['borrower'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $reb['borrowed_amount'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $reb['borrow_date'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $reb['request_destination'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $reb['request_date'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr style='border: 1px solid black;'><td colspan='5' class='text-center'>Search not found.</td></tr>";
                }
            } else {
                echo "<tr style='border: 1px solid black;'><td colspan='5' class='text-center'>Error fetching inventory data: " . mysqli_error($mysqli) . "</td></tr>";
            }
            ?>
        
            
                    </div>  
                </div> 
            </th> 
        </tr>
    </table>
</body>
</html>