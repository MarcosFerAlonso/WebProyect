<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['user_password'];
        $email = $_POST['user_email'];
		if(!empty($user_name) && !empty($password) && !empty($email) && !is_numeric($user_name))
		{

			//save to database
			$user_id = random_num(20);
			$query = "insert into users (users_id,user_email,user_password,user_name) values ('$user_id','$email','$password','$user_name')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="loginCSS.css">
	<title>Signup</title>
</head>
<body>
	<div id="box">
		
		<form method="post">
			<div id="title">Signup</div>

			<input id="text" type="text" name="user_name" autofocus placeholder="User name"><br><br>
            <input id="text" type="text" name="user_email" autofocus placeholder="User e-mail"><br><br>
			<input id="text" type="password" name="user_password" autofocus placeholder="User password"><br><br>

			<input id="button" type="submit" value="Register"><br><br>
			<img id="imgfb" src="facebook.png">
			<img id="img" src="google.png">
			<img id="img" src="twitter.png">
			<img id="img" src="discord.png">
			<p id="sg">You already have an account?
			<a id="link" href="login.php">Login</a><br><br>
			</p>
		</form>
	</div>
</body>
</html>