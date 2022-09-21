<?php
require_once("db.php");

if(isset($_POST['Submit']))
{	 
	$x = $_POST['x'];
    $y = $_POST['y'];
	$popis = $_POST['popis'];

    $sql = "INSERT INTO marker (x,y,popis)
		VALUES ('$x','$y','$popis')";
		if (mysqli_query($connection, $sql)) {
		} else {
			echo "Error: " . $sql . " " . mysqli_error($connection);
		}
		header("Location:index.php");
    
}

?>
