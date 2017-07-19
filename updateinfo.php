<?php
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
	}
	
$pageTitle = "Edit Content";
print <<<EditForm
	<h2>Modify Report for $firstname $lastname</h2>
	<p>Change the values in the textbox then click the 'Modify button</p>
	
	<form id="abductionform" method="POST" action="update.php">
	<input type="hidden" name="id" value="$id">
	<div>
		<label form="firstname">First Name:*  </label>
		<input type="text" name="firstname" id="firstname" value="$firstname">
	</div>
	
	<div>
		<label form="lastname">Last Name:*  </label>
		<input type="text" name="lastname" id="lastname" value="$lastname">
	</div>
	
	<div>
		<label form="when">Date of Abduction:  </label>
		<input type="text" name="when" id="when" value="$when">
	</div>
	
	<div>
		<label form="email">Email:*  </label>
		<input type="text" name="email" id="email" value="$email">
	</div>
	<div>
		<input type="submit" name="submit" value="Modify Record">
	</div>
	</form>
	
EditForm;
}
?>