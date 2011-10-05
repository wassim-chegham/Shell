<?php	

	require_once('Shell.class.php');
	
	$login = ( isset($_POST['login']) ) ? $_POST['login'] : '';
	$password = ( isset($_POST['password']) ) ? $_POST['password'] : '';
	
	header('Content-Type: application/json');
	echo $Shell->check_user( $login, $password );
	
?>