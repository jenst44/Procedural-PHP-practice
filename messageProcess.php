<?php 
session_start();
require_once('connection.php');

if($_POST['action'] == 'message')
{
	postMessage($connection, $_POST);
}
else if ($_POST['action'] == 'comment') 
{
	postComment($connection, $_POST);
}
else
{
	session_destroy();
	header('Location: login.php');
}

function postMessage($connection, $post)
{
	$_SESSION['message_errors'] = array();

	if(empty($post['message']))
	{
		header('Location: success.php');
	}
	else
	{
		$message = mysqli_real_escape_string($connection, $post['message']);
		$query = "INSERT INTO messages (message, user_id, created_at, updated_at) VALUES ('$message', '{$_SESSION['user_id']}', NOW(), NOW())";

		mysqli_query($connection, $query);

		header('Location: success.php');
	}
}

function postComment($connection, $post)
{
	$_SESSION['comment_errors'] = array();

	if(empty($post['comment']))
	{
		header('Location: success.php');
	}
	else
	{
		$comment = mysqli_real_escape_string($connection, $post['comment']);
		$user_id = $_SESSION['user_id'];
		$message_id = $post['message_id'];
		$query = "INSERT INTO comments (comment, user_id, message_id, created_at, updated_at) 
		VALUES ('$comment', '$user_id', '$message_id', NOW(), NOW())";

		mysqli_query($connection, $query);

		header('Location: success.php');
	}
}


 ?>