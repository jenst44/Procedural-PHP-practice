<?php
session_start();
require_once('last_connection.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Get it right Jens</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="main.js"></script>
</head>
<body>
	<h1>Good Luck</h1>
	<form id="addTrip">
		<p>Destination:</p>
		<input type="text" name="destination">
		<p>Description:</p>
		<input type="text" name="description">
		<p>Travel Date From:</p>
		<input type="date" name="date_from">
		<p>Travel Date To:</p>
		<input type="date" name="date_to">
		<p></p>
		<input type="submit" value="Add">
	</form>
	<div id="table"></div>
</body>
</html>