<?php
require_once('new_connection.php');

$query = "SELECT users.user_name, DATE_FORMAT(messages.created_at, '%D %M %Y') as created_at, messages.message, messages.id FROM messages
			JOIN users on messages.user_id = users.id
			ORDER BY messages.id DESC";

		$results = fetch_all($query);

		$htmlString = '';

		foreach($results as $i)
		{
			$query = "SELECT users.user_name, DATE_FORMAT(comments.created_at, '%D %M %Y') as created_at, comments.comment, comments.id FROM comments
			JOIN users on comments.user_id = users.id
			WHERE comments.message_id = ".$i['id']."
			ORDER BY comments.id ASC";

			$results2 = fetch_all($query);

			$htmlString .= "<h1>".$i['user_name']." <span>".$i['created_at']."</span></h1>";
			$htmlString .= "<h2>".$i['message']."</h2>";

			$htmlString .= '<div id="comment'.$i['id'].'">';
			foreach($results2 as $j)
			{
				$htmlString .= "<h4>".$j['user_name']." <span>".$j['created_at']."</span></h4>";
				$htmlString .= "<h4>".$j['comment']."</h4>";
			}
			$htmlString .= '</div>';

			$htmlString .= '<div class="comments">=<form class="submitComment" id="comments'.$i['id'].'">
			<input type="hidden" name="id" value="'.$i['id'].'">
			<input type="text" name="comment"><input type="submit"></form></div>';
		}

		echo $htmlString;
?>