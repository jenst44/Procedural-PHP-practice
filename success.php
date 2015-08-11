<?php 
session_start();
require_once('connection.php');

if(!isset($_SESSION['user_id']))
{
	session_destroy();
	header('login.php');
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Success</title>
	<link rel="stylesheet" href="styling.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		$('.button').click(function(){

		});
	});
	</script>
</head>
<body>
	<h1>Welcome <?= $_SESSION['user_name'] ?></h1>
	<div class="messageBox">
		<h2>Send Message</h2>
		<form action="messageProcess.php" method="post">
			<input type="hidden" name="action" value="message">
			<input type="text" name="message">
			<button>Post</button>
		</form>
	</div>
	<?php 
		$query1 = "SELECT messages.id as message_id, messages.message, users.user_name, DATE_FORMAT(messages.created_at, '%M %D %Y') as created_at 
		FROM messages
		JOIN users ON messages.user_id = users.id
		ORDER BY messages.id DESC";

		$messageResult = fetch_all($query1);
		if(count($messageResult)>0)
		{
			foreach($messageResult as $message)
			{ ?>
				<div class="newMessage"></div>
				<div class="messageDisplay">
					<h3><?= $message['user_name'] ?> <span><?= $message['created_at'] ?></span></h3>
					<h4><?= $message['message']?></h4>
					<div class="commentDisplay">
						<?php 
						$query2 = "SELECT comments.id as comment_id, comments.comment, users.user_name, DATE_FORMAT(comments.created_at, '%M %D %Y') as created_at
						FROM comments
						JOIN users ON comments.user_id = users.id
						Join messages ON comments.message_id = messages.id
						WHERE comments.message_id = {$message['message_id']}
						ORDER BY comments.id"; 

						$commentResult = fetch_all($query2);
						if(count($commentResult)>0)
						{ ?>
							<?php foreach ($commentResult as $comment): ?>
								<h3><?= $comment['user_name'] ?> <span><?= $comment['created_at'] ?></span></h3>
								<h4><?= $comment['comment']?></h4>
							<?php endforeach; } ?>
					</div>
					<form action="messageProcess.php" method="post">
						<input type="hidden" name="action" value="comment">
						<input type="hidden" name="message_id" value="<?= $message['message_id'] ?>">
						<input type="text" name="comment">
						<button>Comment</button>
					</form>
				</div>
		<?php
			}
		}

	 ?>
</body>
</html>