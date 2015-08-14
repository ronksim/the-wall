<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>login_registration</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


	<style>
	.main-container{
		max-width: 960px;
		margin: 0 auto;
		padding: 20px;
	}
	.error{
		color: red;
	}

	.success{
		color: green;
	}
	</style>

</head>

<body>
	<?php
	if(isset($_SESSION['errors']))
	{
		foreach ($_SESSION['errors'] as $error)
		{
			echo "<p class='error'>{$error} </p>";
		}

		unset($_SESSION['errors']);
	}

	if(isset($_SESSION['success_message']))
	{
		echo "<p class='success'>{$_SESSION['success_message']} </p>";
		unset($_SESSION['success_message']);
	}

	?>
	

	<div class="main-container">
		<h2>Login</h2>
		<form action='process.php' method='post'>
			<input type='hidden' name='action' value='register'>
			Email: <input type='text' name='email'></br>
			Password: <input type='password' name='password'></br>
			<input type='hidden' name='action' value='login'>
			<input type='submit' value='sign in!'>
		</form>

		<h2>Register</h2>
		<form action='process.php' method='post'>
			<input type='hidden' name='action' value='register'>
			First Name: <input type='text' name='first_name'></br>
			Last name: <input type='text' name='last_name'></br>
			Email: <input type='email' name='email'></br>
			Password: <input type='password' name='password'></br>
			Confrim Password: <input type='password' name='confirm_password'></br>
			<input type='hidden' name='action' value='register'>
			<input type='submit' value='sign up!'>
		</form>

		<button class="btn btn-default">
			<a href="main.php" name="action" value"Skip to Quote">sign in with facebook!</a>
		</button>
	</body>
	</html>