<?php
// $dbhost = 'oniddb.cws.oregonstate.edu';
// $dbname = 'johnsan3-db';
// $dbuser = 'johnsan3-db';
// $dbpass = 'xIjWTTPPRNZD7mZg';

$dbhost = 'localhost';
$dbname = 'cs290';
$dbuser = 'root';
$dbpass = 'root';

$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
    or die("Error connecting to database server");
?>
<!DOCTYPE html>
<html>
 <head>
 	<meta charset="UTF-8">
 	 <script src="cs290ass4b.js"></script> 
  <title>Video Store</title>
 </head>
 <body>
<h2>Add New Video</h2>
<div id="messages"></div>
<form action="cs290-ass4b-addNew.php" id="inputNewVideoForm" method="POST">
	<!-- get will put parameters in URL --> 
	<?php
	if($_GET["error"]=="1")
	{
		echo ("<span class='error_message'>Title is required.<br></span>");
	} 
	if($_GET["error"]=="2")
	{
		echo ("<span class='error_message'>The length must be a positive integer (in minutes)<br></span>");
	} 
	if($_GET["error"]=="3")
	{
		echo ("<span class='error_message'>The title is missing AND the length must be a positive integer (in minutes)<br></span>");
	} 
	if($_GET["error"]=="0")
	{
		echo ("<span class='error_message'>The video was added to the database!<br></span>");
	} 
	?>
    <span class="title_field">Video Title</span>:  <input type="text" name="title" /><br />
    <span class="genre_field">Genre</span>: <input type="text" name="genre" /><br />
    <span class="length_field">Length (min)</span>:  <input type="text" name="length" /><br />
    <input type="submit" name="submit" value="Add" />
</form>
    <h2>View Existing Videos</h2>
    <?php
    		// $mysqli = new mysqli("localhost", "root", "root", "cs290");
    		$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    		

			if ($mysqli->connect_errno) {
			    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			else 
			{ 
				echo("Successful: ". $_GET["genreTypes"]."<br>");
				
				$select_categories_string = "SELECT * FROM VideoList ";
				
				// $category_query = mysqli_query($mysqli, $select_categories_string);	
				
					//echo ("Records exist<br>");
					$genres=array();
					// echo("123<br>");
					if ($genre_result = $mysqli->query($select_categories_string))
	 			   			{
							while ($row = $genre_result->fetch_assoc())
			 			   			{
			 			   				$genres[]=$row[category];
			 			   			}
	 			   			// var_dump($genres);
	 			   			$unique_genres = array_unique($genres);
	 			   			var_dump($unique_genres);
	 			   			?>
	 			   			<form action="cs290-ass4b.php" id="filterGenreForm" method="GET">
		 			   					
		 			   				    <select id="genreTypes" name="genreTypes" >
		 			   				    	<option selected="selected">-ALL-</option>
		 			   				    <?php
		 			   				    foreach ($unique_genres as $this_genre)
		 			   				    {
		 			   				    	echo("<option>".$this_genre."</option>");
		 			   				    	//echo("<option>1</option>");
		 			   				    }
		 			   				    	
		 			   				    ?>
		 			   				</select>
		 			   				    <input type="submit" name="submit" value="Filter by Genre" /> 
		 			   				    </form>



		 			   				    <?php
	 			   		}
	 			   			// echo("ABC<br>");
	 			   		$select_string = "SELECT * FROM VideoList ";
	 						if(!empty($_GET["genreTypes"]))
							{
								echo ("hello <br>");
								$select_string .= "WHERE category = '".$_GET["genreTypes"]."'";
							} 
							echo $select_string. "<br>";
					?>
					<table>
				    	<tbody>
				    		<tr>
				   			<td>Title<td>Category<td>Length<td>Availability<td>Delete 
	 		<?php

							
	 			   			if ($result = $mysqli->query($select_string))
	 			   			{
								while ($row = $result->fetch_assoc())
		 			   			{
		 			   				if($row[rented]==1) {$availability="Available";} else { $availability="Checked out";}
		 			   				$delete_id=$row[id];
		 			   				echo("<tr>
		 			   						<td>".$row[name].
		 			   						"<td>".$row[category].
		 			   				        "<td>".$row[length].
		 			   				        "<td>".$availability.
		 			   				        "<td>");
		 			   				        ?>
		 			   				<form action="cs290-ass4b-delete.php" id="deleteVideoForm" method="POST">
		 			   					<input type="hidden" name="delete_video" value=' <?php echo($delete_id); ?> '>
		 			   				    <input type="submit" name="submit" value="Delete" /> 
		 			   				    </form>
		 			   				
<?php
		 			   				

	 			   				} 
	 			   			
	 			   			echo("</tbody>
	 			   			</table>");

	 			   			}
	 			   			?>
	 			   			<form action="cs290-ass4b-delete.php" id="deleteAllVideoForm" method="POST">
		 			   					<input type="hidden" name="delete_video" value="all">
		 			   				    <input type="submit" name="submit" value="Delete ALL" /> 
		 			   				    </form>
		 			   				   <?php
				}
			
    		?>	
    

</body>
</html>