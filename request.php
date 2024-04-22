<!DOCTYPE html>
<html>
<head>
    <title>Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php 
    session_start();
    include_once("config.php");
if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] !== "admin" && $_SESSION['user_type'] !== "supply_user")) {
    header("Location: log-out.php");
    exit();
}

    $searchTerm = "";

    if(isset($_POST['search_btn'])) {
        $searchTerm = mysqli_real_escape_string($mysqli, $_POST['search']);
        $query = "SELECT * FROM request WHERE rname LIKE '%$searchTerm%' OR request_no LIKE '%$searchTerm%' OR item_code LIKE '%$searchTerm%'";
    } elseif(isset($_POST['search_reset'])) {
        $query = "SELECT * FROM request";
    } else {
        $query = "SELECT * FROM request";
    }

    // Execute the query
    $rs = mysqli_query($mysqli, $query);

    if(!$rs) {
        die("Error in SQL query: " . mysqli_error($mysqli));
    }
    ?>
    
    <?php include("navigations.php"); ?>

    

    <div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Requests</h3>
        </div>
        <div class="card-body">
            <div class="row">
            <div class="col-md-14 mb-3">
                    <form method="POST" class="search-form row g-3 align-items-center">
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="search" placeholder="Search" value="<?php echo $searchTerm; ?>">
                        </div>
                        <div class="col">
                            <input class="btn btn-sm btn-success form-control" type="submit" value="Search" name="search_btn">
                        </div>
                        <div class="col">
                            <input class="btn btn-sm btn-secondary form-control" type="submit" value="Reset" name="search_reset">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped" style="width: 100%;" border="1px" align="center">
                        <thead>
                            <tr align="center">
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
                    
echo "<td><button class='btn btn-sm btn-success' onclick='openAcceptRequestModal({$res['id']})'>Accept Request</button></td>";

echo "<td><button class='btn btn-sm btn-danger' onclick='openDenyRequestModal({$res['id']})'>Deny Request</button></td>";

                    echo "</tr>";
                    $totalRequest ++;
                }
            } else {
                echo "<tr align='center'><td colspan='10'><b>There are currently no requests <a href='request.php'>Refresh</b></td></tr>";
            }
echo "<tfoot><tr><td colspan='10' align='center'><b>Total Request: $totalRequest</b></td></tr></tfoot>";
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
        $('#acceptRequestBtn').off('click').on('click', function() {
            acceptRequest(requestId);
        });
    }

    function acceptRequest(requestId) {
        var reason = prompt("Enter reason for acceptance:");
        if (reason != null) {
            var acceptUrl = 'request_manage.php?action=accept&id=' + requestId + '&reason=' + encodeURIComponent(reason);
            window.location.href = acceptUrl;
        }
    }

    function openDenyRequestModal(requestId) {
        $('#requestId').val(requestId);
        $('#denyRequestModal').modal('show');
    }

    function submitDenyRequest() {
        var reason = $('#denyReason').val();
        var requestId = $('#requestId').val();
        if (reason) {
            var denialUrl = 'request_manage.php?action=deny&id=' + requestId + '&reason=' + encodeURIComponent(reason);
            window.location.href = denialUrl;
        }
    }

    $(document).ready(function() {
        $('#denyRequestBtn').click(submitDenyRequest);
    });
</script>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

