<?php
ini_set('display_errors',1);  error_reporting(E_STRICT);

include 'admin.html';
require 'mysqli_connect.php';

$sel_record = $_POST['sel_record'];

//SQL statement to select information
$query = "SELECT * FROM alien_abduction WHERE id = '$sel_record'";

//execute SQL query
$result = mysqli_query($db, $query) or die(mysql_error());

if(!$result) {
	print "<h1>Sorry, something has gone wrong!</h1>";
	} else {
	 //loop record to get values
	 while($record = mysqli_fetch_array($result)) {
 		$id=$record["id"];
		$firstname=$record["firstname"];
    		$lastname=$record["lastname"];
    		$email=$record["email"];
    		$when=$record["mmddyy"];
$pageTitle = "Delete Report";

print <<<HERE

<h2>Are you sure you want to delete this report? It will be permanantly removed.</h2>
<ul>
<li>ID: $id</li>
<li>First Name: $firstname</li>
<li>Last Name: $lastname</li>
<li>Email: $email </li>
</ul>
<p><br>
<form method="POST" action="delete.php">
	<input type="hidden" name="id" value="$id">
	<input type="submit" name="delete" value="Yes Really Delete">
	<input type="button" name="cancel" value=" Cancel " onClick="location.href='readtableresults.php'"></a>
</p></form>
HERE;
}
}
?>
