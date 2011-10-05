<?php
	
	require_once('Shell.class.php');
	
	$cmd = ( isset( $_POST['c'] ) ) ? $_POST['c'] : '';
	$autocomplete = ( isset( $_POST['a'] ) ) ? $_POST['a'] : '';
	
	$Shell->set_autocomplete( $autocomplete );
	
	header('Content-Type: application/json');
	echo $Shell->execute( $cmd );
	
?>