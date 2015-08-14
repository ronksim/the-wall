<?php
session_start();
	// echo "whats up, {$_SESSION['first_name']}";
require('connection.php');

$query = "SELECT users.first_name,  messages.created_at, messages.message
FROM users JOIN messages ON messages.users_id = users.id"; 

$user = fetch($query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<meta charset="UTF-8">
	<title></title>
	<h1>
		<?php echo "whats up, {$_SESSION['first_name']}"; ?>
	</h1>
	<a href= 'process.php'>Good Bye</a>
</head>
<style>

.wall{
	max-width: 960px;
	margin: 0 auto;
	padding: 20px;
	
	.container_wall{
		max-width: 960px;
		margin-top: 20px;

	}
}

</style>
<body>
	<div class="wall">
		<center><h2>Post to Wallie</h2></center>
		<form action='message.php' method='post'>
			<input type='hidden' name='action' value='post'>
			<textarea name= 'wall' class="form-control" rows="3"></textarea></br>
			<center><input type='submit' value='postit!'></center>
		</form>


			<div class='container_wall'></div>
			<center><h3>Wallies</h3></center>
			<?php 

			foreach ($user as $post){
				echo $post['first_name'] . ' | ' . $post['created_at'] . ' <br> ' . 
				$post['message'] . ' <br> ';
			}

			?>
	</div>

		<?php

		if(isset($_POST['action']) && $_POST['action'] == 'postit'){
			postit_user($_POST);
		}

		?>
</body>
</html>

