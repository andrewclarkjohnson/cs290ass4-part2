<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'johnsan3-db';
$dbuser = 'johnsan3-db';
$dbpass = 'xIjWTTPPRNZD7mZg';

// $dbhost = 'localhost';
// $dbname = 'cs290';
// $dbuser = 'root';
// $dbpass = 'root';

$id_to_update=$_POST['video_id'];
$previous_availability=$_POST['previous_availability'];
$genreTypes=$_POST['genre_filter'];
// echo("$id_to_delete");

// $mysqli = new mysqli("localhost", "root", "root", "cs290");
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
// $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "johnsan3-db", "johnsan3-db", "xIjWTTPPRNZD7mZg");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else 
{ 
		if ($previous_availability == 0) {$current_availability = 1;} else {$current_availability=0;}
		$update_string = "UPDATE VideoList SET rented = ".$current_availability." WHERE id = ".$id_to_update;
		// echo($delete_string."<br>");
	

	if ($mysqli->query($update_string) === TRUE) {
		header('Location: https://web.engr.oregonstate.edu/~johnsan3/CS290/ass4b/cs290-ass4b.php?genreTypes='.$genreTypes);
	    // header('Location: http://localhost:8888/assignment4-part2/src/cs290-ass4b.php?genreTypes='.$genreTypes);
	} else {
	    echo "Error updating record: " . $mysqli->error;
	}
}


?>