<?php 
require_once('new_connection.php');

$comment = $_POST['comment'];
$id = $_POST['id'];

$query = "INSERT INTO comments (comment, user_id, message_id, created_at, updated_at) VALUES ('$comment', 7, '$id', NOW(), NOW())";

echo $query;
mysqli_query($connection, $query);

$query = 'SELECT * FROM comments WHERE message_id = '.$_POST['id'].' ORDER BY id DESC LIMIT 1';
echo $query;


 ?>