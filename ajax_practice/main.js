$(document).ready(function(){
	$.get('ajaxProcess.php', function(res){
		$('.messages').html(res);
		addHandlers();
	}, 'html');
	$('#submitMessage').submit(function(){
		$.post('newMessage.php', $(this).serialize(), function(data){
			console.log(data);
		});
		$('#messageText').val('');
		$.get('ajaxProcess.php', function(res){
			$('.messages').html(res);
			addHandlers();
		}, 'html');
		return false;
	});
});

function addHandlers()
{
	$('.submitComment').on('submit', function(){
		$.post('newComment.php', $(this).serialize(), function(data){
			console.log(data);
		});
		$.get('ajaxProcess.php', function(res){
			$('.messages').html(res);
			addHandlers();
		}, 'html');
		return false;
	});
}