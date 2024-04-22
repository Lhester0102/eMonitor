<?php
session_start();
include_once("config.php");
$name = $_SESSION['username'];
$department = $_SESSION['department'];
$rs = mysqli_query($mysqli, "SELECT * FROM borrowed_item WHERE item_type = 'consumable'");
$email_query = mysqli_query($mysqli, "SELECT * FROM account WHERE username = '$name'");

    $searchTerm = "";

    if(isset($_POST['search_btn'])) {
        $searchTerm = mysqli_real_escape_string($mysqli, $_POST['search']);
        $query = "SELECT * FROM request_to_ph WHERE (rname LIKE '%$searchTerm%' OR request_no LIKE '%$searchTerm%' OR item_code LIKE '%$searchTerm%') AND dept LIKE '$department'";
    } elseif(isset($_POST['search_reset'])) {
        $query = "SELECT * FROM request_to_ph WHERE dept LIKE '$department'";
    } else {
        $query = "SELECT * FROM request_to_ph WHERE dept LIKE '$department'";
    }

    $rs = mysqli_query($mysqli, $query);

    if(!$rs) {
        die("Error in SQL query: " . mysqli_error($mysqli));
    }





?>
<!DOCTYPE html>
<html>
<head>
    <title>Request</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
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
    </style>
</head>
<body>
    <?php include 'navigation_user.php'; ?>
    <table class="table table-striped w-80" border="1px" align="center">
        <thead>
            <tr>
                <td colspan="10">
                    <h3> <center> Requests </center></h3>
                </td>
            </tr>
            <tr>
                <form method="POST">
                    <th colspan="8"> 
                        <input align='center' type="text" style="width: 100%;" name="search" placeholder="Search" value="<?php echo $searchTerm; ?>" > 
                    </th> 
                    <th>
                        <input class='btn btn-sm'  type="submit" value="Search" name="search_btn" style="width: 100%; height: 100%; background-color: green; color: white;">
                    </th> 
                    <th>
                        <input class='btn btn-sm'  type="submit" value="Reset" name="search_reset" style="width: 100%; height: 100%; background-color: gray; color: white;">
                    </th>
                </form>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><b>Barcode</b></th>
                <th><b>Equipment Name</b></th>
                <th><b>Available Amount</b></th>
                <th><b>Requester</b></th>
                <th><b>Requested Amount</b></th>
                <th><b>Requested Destination</b></th>
                <th><b>Return Date</b></th>
                <th><b>Reason</b></th>
                <th colspan="2"><b>Actions</b></th>
            </tr>

            <?php
            $totalRequest = 0;
            if ($rs && mysqli_num_rows($rs) > 0) {
                while ($res = mysqli_fetch_array($rs)) {
                    echo "<tr>";
                    echo "<td>{$res['item_code']}</td>";
                    echo "<td>{$res['equipment_name']}</td>";
                    echo "<td>{$res['quantity']}</td>";
                    echo "<td>{$res['rname']}</td>";
                    echo "<td>{$res['request_no']}</td>";
                    echo "<td>{$res['request_destination']}</td>";
                    echo "<td>";
                    echo $res['return_date'] == '0000-00-00' ? "-" : $res['return_date'];
                    echo "</td>";
                    echo "<td>{$res['reason']}</td>";

                    // Modify the Accept Request button to trigger the confirmation modal
                    echo "<td><button class='btn btn-sm btn-success' onclick='openAcceptRequestModal({$res['id']})'>Accept Request</button></td>";
                    echo "<td><button class='btn btn-sm btn-danger' onclick='openDenyRequestModal({$res['id']})'>Deny Request</button></td>";
                    echo "</tr>";
                    $totalRequest ++;
                }
            } else {
                echo "<tr align='center'><td colspan='10'><b>There are currently no requests <a href='request_ph_manage.php'>Refresh</b></td></tr>";
            }
echo "<tfoot><tr><td colspan='9' align='center'><b>Total Request: $totalRequest</b></td></tr></tfoot>";
            ?>

        </tbody>
    </table>


    <!-- Confirmation Modal for Accepting Request -->
    <div class="modal fade" id="confirmAcceptModal" tabindex="-1" aria-labelledby="confirmAcceptModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmAcceptModalLabel">Confirm Acceptance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to accept the request?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <!-- Modify the Accept Request button to trigger the modal -->
                    <button id="acceptRequestBtn" class="btn btn-success" onclick="acceptRequest()">Accept Request</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Deny Request Modal -->
    <div class="modal fade" id="denyRequestModal" tabindex="-1" aria-labelledby="denyRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="denyRequestModalLabel">Deny Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to deny the request?</p>
                    <div class="mb-3">
                        <label for="denyReason" class="form-label">Reason for Denial:</label>
                        <textarea class="form-control" id="denyReason" name="denyReason" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="submitDenyRequest()">Deny Request</button>
                    <input type="hidden" id="requestId" name="requestId" value="">
                </div>
            </div>
        </div>
    </div>

    <script>
        function openAcceptRequestModal(requestId) {
            $('#confirmAcceptModal').modal('show');
            // Set the onclick event for accept request button to trigger acceptRequest function with the request ID
            $('#acceptRequestBtn').attr('onclick', 'acceptRequest(' + requestId + ')');
        }

        function acceptRequest(requestId) {
            // This function will be called when the user confirms the acceptance
            var acceptUrl = 'request_ph_manage_manage.php?action=accept&id=' + requestId;
            window.location.href = acceptUrl;
        }




        
        function openDenyRequestModal(requestId) {
            $('#requestId').val(requestId);
            $('#denyRequestModal').modal('show');
        }



        function submitDenyRequest() {
            var reason = $('#denyReason').val();
            var requestId = $('#requestId').val();
            if (reason) {
                var denialUrl = 'request_ph_manage_manage.php?action=deny&id=' + requestId + '&reason=' + encodeURIComponent(reason);
                window.location.href = denialUrl;
            }
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
