<!DOCTYPE html>
<html>
	<head>
		<title>Admin Dashboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<div class="header">
			<h1 class="txt_title">ADMINISTRATOR</h1>
		</div>
		<div class="header2"></div>
		<div class="container1"></div>
		<div class="container2"></div>
		<div class="container3"></div>
		<div class="container4"></div>
		<div class="container11">
			<h1 class="txt_supplyOfficer">SUPPLY OFFICER</h1>
			<h2 class="num1">0</h2>
			<h3 class="fd1">Full Details</h3>
		</div>
		<div class="container22">
			<h1 class="txt_inventorys">INVENTORY</h1>
			<?php
				include_once("config.php");
				$dash_category_query = "SELECT * from inventory";
				$dash_category_query_run = mysqli_query($mysqli, $dash_category_query);
				if($category_total = mysqli_num_rows($dash_category_query_run))
				{
					echo '<h2 class="num2"> '.$category_total.' </h2>';
				}
				else
				{
					echo '<h2> No Data </h2>';
				}
			?>
			<a href="index.php" class="fd2">Full Details</a>
		</div>
		<div class="container33">
			<h1 class="txt_instructors">INSTRUCTORS</h1>
			<h2 class="num3">0</h2>
			<h3 class="fd1">Full Details</h3>
		</div>
		<div class="container44">
			<h1 class="txt_reports">REPORTS</h1>
			<h2 class="num4">0</h2>
			<h3 class="fd1">Full Details</h3>
		</div>
	</body>
</html>	    	