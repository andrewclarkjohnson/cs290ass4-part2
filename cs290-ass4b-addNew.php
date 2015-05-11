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

$title = $_POST['title']; 
$title = str_replace("'", "", $title);
$title = trim($title);

echo ($title."<br>");
echo (strcmp($title,"")."<br>");

if( (strcmp($title,"")==0) AND (!(is_numeric($_POST["length"])) ) )
{
	// echo("A");
	// header("Location: http://localhost:8888/assignment4-part2/src/cs290-ass4b.php?error=3", true);	

		header('Location: https://web.engr.oregonstate.edu/~johnsan3/CS290/ass4b/cs290-ass4b.php?error=3',true);

}
else
{
	// check if missing title	
	// if(empty($_POST["title"])) 
	if( (strcmp($title,"")==0))
	{
		echo("B");
		// header("Location: http://localhost:8888/assignment4-part2/src/cs290-ass4b.php?error=1", true);	
		header('Location: https://web.engr.oregonstate.edu/~johnsan3/CS290/ass4b/cs290-ass4b.php?error=1',true);
	}
	elseif (!(is_numeric($_POST["length"])) ) // check if legnth isn't integer	
	{
		echo("C");
		// header("Location: http://localhost:8888/assignment4-part2/src/cs290-ass4b.php?error=2", true);
		header('Location: https://web.engr.oregonstate.edu/~johnsan3/CS290/ass4b/cs290-ass4b.php?error=2',true);
	}
}
// if made it this far, data was entered successfully by user
// $mysqli = new mysqli("localhost", "root", "root", "cs290");
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
// $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "johnsan3-db", "johnsan3-db", "xIjWTTPPRNZD7mZg");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else 
{ 
	
	$genre = $_POST['genre'];
	$length = $_POST['length'];
	$insert = "INSERT INTO VideoList (name, category, length) VALUES ('$title', '$genre', $length)";

	if ($mysqli->query($insert) === TRUE) {
	    // header("Location: http://localhost:8888/assignment4-part2/src/cs290-ass4b.php?error=0", true);
	    header('Location: https://web.engr.oregonstate.edu/~johnsan3/CS290/ass4b/cs290-ass4b.php?error=0',true);
	} else {
	    echo "Error: " . $insert . "<br>" . $mysqli->error;
	}


}



?>