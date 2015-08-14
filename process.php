<?php
session_start();
require('connection.php');

if(isset($_POST['action']) && $_POST['action'] == 'register'){
	register_user($_POST);
}

elseif(isset($_POST['action']) && $_POST['action'] == 'login'){
	login_user($_POST);
}
else{
	session_destroy();
	header('location: index.php');
	die();
}

function register_user($post){

// --------begin val checks---------------

	$_SESSION['errors'] = array();

	if(empty($post['first_name'])){
		$_SESSION['errors'][] = "first name can't be blank";
	}

	if(empty($post['last_name'])){
		$_SESSION['errors'][] = "last name can't be blank";
	}
	if(empty($post['password'])){
		$_SESSION['errors'][] = "password can't be blank";
	}
	if($post['password'] !== $post['confirm_password']){
		$_SESSION['errors'][] = "password must match";
	}

	if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
		$_SESSION['errors'][] = "please use a valid email";
	}

	//-------end of validation checks
	if(count($_SESSION['errors']) >0){ //if there's any errors at all
	header('location: index.php');
	die();
}
	else{ //insert database
		$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at)
		VALUES ('{$post['first_name']}','{$post['last_name']}','{$post['email']}','{$post['password']}',NOW(),NOW())";

		run_mysql_query($query);
		$_SESSION['success_message'] = 'Yay, you did it!';
		header('location: index.php');
		die();

	}
}

function login_user($post){
	$query = "SELECT * FROM users WHERE users.password = '{$post['password']}' 
	AND users.email = '{$post['email']}'";

	$user = fetch($query);
	if(count($user) > 0)
	{
		$_SESSION['user_id'] = $user[0]['id'];
		$_SESSION['first_name'] = $user[0]['first_name'];
		$_SESSION['logged_in'] = TRUE;
		header('location: success.php');
	}
	else
	{
		$_SESSION['errors'][] = "lies!";
		header('location: index.php');
		die();
	}

}

?>