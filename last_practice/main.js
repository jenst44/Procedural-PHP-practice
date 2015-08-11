$(document).ready(function(){
	$.get('trips.php', function(res){
		console.log(res);
		$('#table').append(res);
	});
	$('#addTrip').on('submit', function(){
		$.post('newTrip.php', $(this).serialize(), function(data){
			console.log(data);
			$('#newTrip').append(data);
		});
		return false;
	});
});