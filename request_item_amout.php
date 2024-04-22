<?php
include_once("config.php");
$id = $_REQUEST['id'];

$type = mysqli_query($mysqli, "SELECT item_type FROM inventory WHERE id = '$id'");
$quantity = $_REQUEST['quantity'];
$current_date = date('Y-m-d');
$next_day_date = date('Y-m-d', strtotime($current_date . ' +1 day'));

if ($type) {
    $row = mysqli_fetch_array($type);
    if ($row !== null) {
        $item_type = $row['item_type'];

        $hide_return_date = ($item_type == 'consumable');
    }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Request Amount </title>
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
        <a href="request_index.php">Back</a>
    </div>  

    <form id="requestForm" method="post" action="request_item.php?id=<?php echo $id; ?>&action=request&quantity=<?php echo $quantity; ?>" required>
        <table>
            <tr>
                <td>Request Amount: <input max="<?php echo $quantity; ?>" type="number" name="requesta" id="requestAmount" min=1 style="width: 100%;" required> </td>
            </tr>
            <?php if (!$hide_return_date): ?>
            <tr>
                <td>Return Date: <input type="date" name="return_date" min="<?php echo $next_day_date; ?>" style="width: 100%;"> </td>
            </tr>
            <?php endif; ?>
            <tr>
                <td>Request Destination:
                    <select id="destinationSelect" name="request_destination" style="width: 100%;" required>
                        <option>- Choose Destination -</option>
                        <option value="Old Building">Old Building</option>
                        <option value="New Building">New Building</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Reason: <input type="text" name="reason" id="requestAmount" min=1 style="width: 100%;" required> </td>
            </tr>
            <tr>
                <td align="center" colspan="2"><input type="submit" id="submitButton" name="btnSubmit" value="Request"></td>
            </tr>
        </table>
    </form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('form').addEventListener('submit', function(event) {
            var requestAmount = document.getElementById('requestAmount').value.trim();
            var destinationSelect = document.getElementById('destinationSelect').value;

            if (requestAmount === '' || destinationSelect === '- Choose Destination -') {
                event.preventDefault();
                alert('Please select a destination or enter a valid request amount.');
            }
        });
    });
</script>


    
	</body>
</html>