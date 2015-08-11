<?php
session_start();
require_once('last_connection.php');

$destination = mysqli_real_escape_string($connection, $_POST['destination']);
$description = mysqli_real_escape_string($connection, $_POST['description']);

$query = "INSERT into trips (destination, description, date_from, date_to, created_at, updated_at)
VALUES ('$destination', '$description', '{$_POST['date_from']}', '{$_POST['date_to']}', NOW(), NOW())";

mysqli_query($connection, $query);

$query = "SELECT destination, description, DATE_FORMAT(date_from, '%D %M %Y') as date_from, DATE_FORMAT(date_to, '%D %M %Y') as date_to 
FROM trips ORDER BY id DESC LIMIT 1";

$result = fetch_all($query);

echo "<tr><td>".$result[0]['destination']."</td><td>".$result[0]['description']."</td><td>"
.$result[0]['date_from']."</td><td>".$result[0]['date_to']."</td></tr>";

 ?>