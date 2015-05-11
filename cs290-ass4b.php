<?php
$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'johnsan3-db';
$dbuser = 'johnsan3-db';
$dbpass = 'xIjWTTPPRNZD7mZg';

// $dbhost = 'localhost';
// $dbname = 'cs290';
// $dbuser = 'root';
// $dbpass = 'root';

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
		echo ("<span class='success_message'>The video was added to the database!<br></span>");
	} 
	?>
    <span class="title_field">Video Title</span>:  <input type="text" name="title" required/><br />
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
				// echo("Successful: ". $_GET["genreTypes"]."<br>");
				
				$select_categories_string = "SELECT * FROM VideoList ";
				
				// $category_query = mysqli_query($mysqli, $select_categories_string);	
				
					//echo ("Records exist<br>");
					$genres=array();
					// echo("123<br>");
					if ($genre_result = $mysqli->query($select_categories_string))
	 			   			{
	 			   				// MAKE LIST OF EXISTING GENRES
							while ($row = $genre_result->fetch_assoc())
			 			   			{
			 			   				$genres[]=$row[category];
			 			   			}
	 			   			
	 			   			$unique_genres = array_unique($genres);
	 			   			

 			   				// MAKE SELECT STRING
							$select_string = "SELECT * FROM VideoList ";
	 						if(!empty($_GET["genreTypes"])) 
							{
								
								$genre_type =trim($_GET["genreTypes"]);
			
								
							} 



	 			   			?>
	 			   			<form action="cs290-ass4b.php" id="filterGenreForm" method="GET">
		 			   					
		 			   				    <select id="genreTypes" name="genreTypes" >
		 			   				    	<option >-ALL-</option>
		 			   				    <?php
		 			   				    foreach ($unique_genres as $this_genre)
		 			   				    {
		 			   				    	if(strcmp($genre_type,$this_genre) == 0)
								{
									$selected = "SELECTED=1";
									$select_string .= "WHERE category = '".$genre_type."'";
								}
								else
								{
									$selected="";
								}
		 			   				    	echo("<option ".$selected.">".$this_genre."</option>");
		 			   				    	//echo("<option>1</option>");
		 			   				    }
		 			   				    	
		 			   				    ?>
		 			   				</select>
		 			   				    <input type="submit" name="submit" value="Filter by Genre" /> 
		 			   				    </form>



		 			   				    <?php
	 			   		}
	 			   			// echo("ABC<br>");
	 			   		
					?>
					<table>
				    	<tbody>
				    		<tr>
				   			<td><b>Title</b><td><b>Category</b><td><b>Length</b><td><b>Availability</b><td><b>Delete</b> 
	 		<?php

							
	 			   			if ($result = $mysqli->query($select_string))
	 			   			{
								while ($row = $result->fetch_assoc())
		 			   			{
		 			   				if($row[rented]==1) {$availability="Available";} else { $availability="Checked out";}
		 			   				$video_id=$row[id];
		 			   				echo("<tr>
		 			   						<td>".$row[name].
		 			   						"<td>".$row[category].
		 			   				        "<td>".$row[length].
		 			   				        "<td>");
?>
		 			   				<form action="cs290-ass4b-availability.php" id="updateAvailabilityForm" method="POST">
		 			   					<input type="hidden" name="video_id" value=' <?php echo($video_id); ?> '>
		 			   					<input type="hidden" name="previous_availability" value=' <?php echo($row[rented]); ?> '>
		 			   					<input type="hidden" name="genre_filter" value=' <?php echo($genre_type); ?> '>
		 			   				    <input type="submit" name="submit" value=' <?php echo($availability); ?> '/> 
		 			   				    </form>
		 			   				
<?php
		 			   				        echo("<td>");
		 			   				        ?>
		 			   				<form action="cs290-ass4b-delete.php" id="deleteVideoForm" method="POST">
		 			   					<input type="hidden" name="delete_video" value=' <?php echo($video_id); ?> '>
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