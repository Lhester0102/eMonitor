<?php
	include_once("config.php");
	if(isset($_REQUEST['btn_login']))
	{
		$un=$_REQUEST['username'];
		$pass=$_REQUEST['password'];
		$btn=$_REQUEST['btn_login'];
		$rs=mysqli_query($mysqli,"select * from account where username='$un' and password='$pass'");
		$count=mysqli_num_rows($rs);
		if($count==1)
		{
			$result = mysqli_fetch_array($rs);
			$type = $result['user_type'];
			if(strcmp($type,"admin")==0)
			{
				header("Location: admin-dashboard.php");
			}
			else
			{
				header("Location:instructor.php");
			}
		}
		else
		{
			echo '<script>alert("Error Login")</script>';
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title> E-monitor(A web-based Application for the Inventory Management of DCCP Laoag City) </title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body> 
		<form method="post" action="log-in.php">
			<div class="login">
				<img src="dccplogo.png" class="logo">
				<h1 class="title"> Data Center College of the Philippines </h1>
				<h1 class="txt_username"> Username </h1>
				<input type="Username" name="username" class="txtfield_username" placeholder="Username as your ID Number" required>
				<h1 class="txt_password"> Password </h1>
				<input type="Password" name="password" class="txtfield_password" placeholder="Password should haveat least 8 characters" required>
				<button type="submit" name="btn_login" class="btn_login" value="Login" style="color: white;"> Login </button>
				<p><a href="###" style="text-decoration: none;" class="sign-up_link"> Register </a></p>
			</div>
		</form>
	</body>
</html>