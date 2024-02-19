
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
				header("Location: admin-dashboard2.php");
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
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body style="background-color: gray;">
    <div class="container mt-5 w-75" >
        <div class="row">
            <div class="col-md-6 offset-md-3" >
  
                <form method="post" action="login2.php" accept="" class="shadow p-4" style="background-color: white; border-radius:10px;">
                <div class="mb-3" style="text-align:center">
                <img width="100px" src="dccplogo.png" class="logo">
				<h3 class="title"> Data Center College of the Philippines </h3>
                    <h3>Login Form</h3>
                </div>
                    <div class="mb-3">
                        <label for="username">Email/Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>

                    <div class="mb-3">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" name="password" id="Password"
                            placeholder="Password">
                    </div>

                    <label class="mb-3">
                        <input type="checkbox" name="RememberMe"> Remember Me
                    </label>

                    <a href="#" class="float-end text-decoration-none">Reset Password</a>

                    <div class="mb-3">
                        <button name="btn_login" type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <hr>
                    <p class="text-center mb-0">If you have not account <a href="#">Register Now</a></p>

                </form>
            </div>
        </div>
    </div>
</body>
</html>