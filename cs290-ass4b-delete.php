<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// $dbhost = 'oniddb.cws.oregonstate.edu';
// $dbname = 'johnsan3-db';
// $dbuser = 'johnsan3-db';
// $dbpass = 'xIjWTTPPRNZD7mZg';

$dbhost = 'localhost';
$dbname = 'cs290';
$dbuser = 'root';
$dbpass = 'root';

$id_to_delete=$_POST['delete_video'];
echo("$id_to_delete");

// $mysqli = new mysqli("localhost", "root", "root", "cs290");
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "johnsan3-db", "johnsan3-db", "xIjWTTPPRNZD7mZg");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else 
{ 
	if(strcmp($id_to_delete,"All"))
	{
		$delete_string = "DELETE FROM VideoList";
		// echo("ALL<br>");

	}
	else
	{
		$delete_string = "DELETE FROM VideoList WHERE id = ".$id_to_delete;
		// echo("Individual delete<br>");
	}
	

	if ($mysqli->query($delete_string) === TRUE) {
	    header("Location: http://localhost:8888/assignment4-part2/src/cs290-ass4b.php", true);
	} else {
	    echo "Error deleting record: " . $mysqli->error;
	}
}


?>