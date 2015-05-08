<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// echo ("hello");

// check title exists AND length is integer
// echo($_POST["title"]);
// echo($_POST["length"]);
if( (empty($_POST["title"])) AND (!(is_numeric($_POST["length"])) ) )
{

	header("Location: http://localhost:8888/assignment4-part2/src/cs290-ass4b.php?error=3", true);	

}
else
{
	// check if missing title	
	if(empty($_POST["title"])) 
	{
		header("Location: http://localhost:8888/assignment4-part2/src/cs290-ass4b.php?error=1", true);	
	}
	elseif (!(is_numeric($_POST["length"])) ) // check if legnth isn't integer	
	{
		header("Location: http://localhost:8888/assignment4-part2/src/cs290-ass4b.php?error=2", true);
	}
}
// if made it this far, data was entered successfully by user
// $mysqli = new mysqli("localhost", "root", "root", "cs290");
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "johnsan3-db", "johnsan3-db", "xIjWTTPPRNZD7mZg");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else { echo("Successful");}

$title = $_POST['title']; 
$genre = $_POST['genre'];
$length = $_POST['length'];
$insert = "INSERT INTO VideoList (name, category, length) VALUES ('$title', '$genre', $length)";

if ($mysqli->query($insert) === TRUE) {
    header("Location: http://localhost:8888/assignment4-part2/src/cs290-ass4b.php?error=0", true);
} else {
    echo "Error: " . $insert . "<br>" . $mysqli->error;
}


?>