<?php 
	require_once('new_connection.php');

	$message = $_POST['message'];

	$query = "INSERT INTO messages (message, user_id, created_at, updated_at) VALUES ('$message', '7', NOW(), NOW())";
	echo $query;

	mysqli_query($connection, $query);

 ?>