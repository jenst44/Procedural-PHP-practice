<?php 
session_start();
require_once('last_connection.php');

$query = "SELECT destination, description, DATE_FORMAT(date_from, '%D %M %Y') as date_from, DATE_FORMAT(date_to, '%D %M %Y') as date_to FROM trips";

$results = fetch_all($query);

$htmlString = "<table><thead><tr><td>Destination</td><td>Description</td><td>Trip date from</td><td>Trip date to</td></tr>
</thead><tbody id='newTrip'>";

foreach($results as $i)
{
	$htmlString .= '<tr><td>'.$i['destination'].'</td><td>'.$i['description'].'</td><td>'.$i['date_from'].'</td>
	<td>'.$i['date_to'].'</td></tr>';
}

$htmlString .= '</tbody></table>';

echo $htmlString;

 ?>