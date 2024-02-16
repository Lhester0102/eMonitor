<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">eMonitor</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="#">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid ">
  <div class="row content ">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>eMonitor</h2>
      <ul class="nav nav-items nav-stacked" style="font-size:16px;font-weight:bold;color:black">
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="#">Logout</a></li>
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-9" style="text-align:center;color:black">
      <div class="well" style="text-align:center;background:gray;color:black">
        <h1>Admin Dashboard</h1>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="well">
            <h1>SUPPLY OFFICER</h1>
            <p><h1><b>0</b></h1></p> 
			<p><a href="#">Full Details</a></p> 
          </div>
        </div>
        <div class="col-sm-6">
          <div class="well">
            <h1>INSTRUCTORS</h1>
            <p><h1><b>0</b></h1></p> 
			<p><a href="#">Full Details</a></p> 
          </div>
        </div>
        <div class="col-sm-6">
          <div class="well">
            <h1>INVENTORY</h1>
			<?php
				include_once("config.php");
				$dash_category_query = "SELECT * from inventory";
				$dash_category_query_run = mysqli_query($mysqli, $dash_category_query);
				if($category_total = mysqli_num_rows($dash_category_query_run))
				{
					echo '<p><h1><b>'.$category_total.' </b></h1></p> ';
				}
				else
				{
					echo '<p><h1><b> No Data </b></h1></p> ';
				}
			?>
			<p><a href="index.php">Full Details</a></p> 
          </div>
        </div>
        <div class="col-sm-6">
          <div class="well">
            <h1>REPORTS</h1>
            <p><h1><b>0</b></h1></p> 
			<p><a href="#">Full Details</a></p> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>



<!-- <!DOCTYPE html>
<html>
	<head>
		<title>Admin Dashboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<div class="">
			<h1 class="txt_title">ADMINISTRATOR</h1>
		</div>
		<div class="">
			<button class="btn_settings">SETTINGS</button>
			<form action="log-in.php">
				<button class="btn_logout">LOG OUT</button>
			</form>
		</div>
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
</html>	    	 -->