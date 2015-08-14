<?php
session_start();
require('connection.php');

if (isset($_POST['action']) && $_POST['action'] == 'post') {
	wall_post($_POST);


}



function wall_post($wall_post){
	$query = "INSERT INTO messages (message, created_at, updated_at, users_id)
	VALUES ('{$wall_post['wall']}', NOW(), NOW(), {$_SESSION['user_id']})";
	
	// var_dump($query);
	// die();

	run_mysql_query($query);

	header('location: success.php');
	die();


}

?>
