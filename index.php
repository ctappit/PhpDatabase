<?php
ini_set('display_errors',1);  error_reporting(E_STRICT);
include 'header.html';

$firstname="";
$lastname="";
$email="";
$when="";
$length="";
$many="";
$look="";
$do="";
$seen="";
$comments="";
$fnameError="";
$lnameError="";
$emailError="";
$seenError="";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	validateForm();
} else {
	showForm($firstname, $lastname, $email, $when, $length, $many, $look, $do, $seen, $comments, $fnameError, $lnameError, $emailError, $seenError);}


//clean and validate data
function validateForm() {
	include 'cleanData.php';

	$firstname = $_POST['fname'];
	if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
			$firstname = null;
			$fnameError = '<p>Only letters and white space allowed</p>'; }

	$lastname = $_POST['lname'];
	if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
		$lastname = null;
		$lnameError = '<p>Only letters and white space allowed</p>'; }

	if (!empty($_POST['email'])) {
		$email = $_POST['email'];
	} else {
		$email = NULL;
		$emailError = '<p>Sorry, you must provide an email address!</p>';
	}

	if (empty($_POST['seen'])) {
		$seen = NULL;
		$seenError = '<p>Sorry you have not told us if you saw Fluffy or not!</p>';
	} else $seen = $_POST['seen'];

//get variables from form post
	$when = $_POST['when'];
	$length = $_POST['length'];
	$look = $_POST['look'];
	$do = $_POST['do'];
	$comments = $_POST['comments'];
	$many = $_POST['many'];

	if(!($firstname && $lastname && $email && $seen)) {
		showform ($firstname,$lastname,$when,$length,$seen,$look,$do,$comments,$email,$many, $fnameError, $lnameError, $emailError, $seenError);
	} else addData(n$firstname, $lastname, $email, $seen, $when, $length, $do, $many, $look, $comments);
}

//Connect to database,print confirmation
function addData($firstname, $lastname, $email, $when, $length, $many, $look, $do, $seen, $comments){
	print <<< HERETEXT
<h1>The following has been added:</h1><BR>
<ul>
<li>First name: $firstname</li>
<li>Last name: $lastname</li>
<li>Email: $email</li>
<li>Did you see fluffy: $seen</li>
<li>Date of Abduction: $when</li>
<li>How long you were gone: $length</li>
<li>What did they do: $do</li>
<li>How many did you see: $many</li>
<li>What did they look like: $look</li>
<li>Additional Comments: $comments</li>
</ul>
HERETEXT;
	require("mysqli_connect.php");
	$query = "INSERT INTO alien_abduction (id, firstname, lastname, email, mmddyy, how_long, many, description, do, fluffy, other)
VALUES (null, '$firstname', '$lastname', '$email', '$when', '$length', '$many', '$look', '$do', '$seen', '$comments')";

	if (mysqli_query($db, $query)) {
		echo "<h2>Thank you, a new record was created successfully.</h2>";
	} else {
		echo "Error: " . $query . "<br>" . $db->error;
	}
}

// call function to connect to DB and confirm input
function confirm($firstname, $lastname, $email, $when, $length, $many, $look, $do, $seen, $comments) {
		addData($firstname, $lastname, $email, $when, $length, $many, $look, $do, $seen, $comments);
}

//Show form include if/else statements to make radio button sticky
function showForm($firstname, $lastname, $email, $when, $length, $many, $look, $do, $seen, $comments, $fnameError, $lnameError, $emailError, $seenError)
{
	if ($seen == "yes") {
		$fluffy = "<input class=\"radio\" type=\"radio\" name=\"seen\" value=\"yes\" checked=\"checked\">
						<label class=\"radio2\">Yes</label>&nbsp; &nbsp;
						<input class=\"radio\" type=\"radio\" name=\"seen\" value=\"no\">
						<label class=\"radio2\"> No</label>";
	} else if ($seen == "no") {
		$fluffy = "<input class=\"radio\" type=\"radio\" name=\"seen\" value=\"yes\">
						<label class=\"radio2\">Yes</label>
						<input class=\"radio\" type=\"radio\" name=\"seen\" value=\"no\" checked=\"checked\">
						<label class=\"radio2\"> No</label>";
	} else {
		$fluffy = "<input class=\"radio\" type=\"radio\" name=\"seen\" value=\"yes\">
						<label class=\"radio2\">Yes</label>
						<input class=\"radio\" type=\"radio\" name=\"seen\" value=\"no\">
						<label class=\"radio2\"> No</label>"; }
	print <<< SOMETEXT
<form method="POST" action="" name="abductreport">
<label for="fname">First Name:<b>*$fnameError</b></label> 
	<input type="text" name="fname" id="fname" placeholder="First Name" value="$firstname"><br>
<label for="lname">Last Name:<b>* $lnameError</b></label>
	<input type="text" name="lname" id="lname" placeholder="Last Name" value="$lastname"><br>
<label for="email">What is your Email address?<b>*$emailError</b></label>
	<input type="email" name="email" id="email" placeholder="Email" value="$email"><br>
<label for="when">When did it happen?</label>
	<input type="date" name="when" id="when" value="$when"><br>
<label for="length">How long were you gone?</label>
	<input type="text" name="length" id="length" placeholder="days, months, years?" value="$length"><br>
<label for="many">How many did you see?</label>
	<input type="number" name="many" id="many" placeholder="Enter a Number" value="$many"><br>
<label for="look">Describe them:</label>
	<input type="text" name="look" id="look" placeholder="What was their appearance?" value="$look"><br>
<label for="do">What did they do you to?</label>
	<input type="text" name="do" id="do" placeholder="Describe what they did" value="$do"><br>
Have you seen my dog fluffy?<b>*$seenError</b><br>
	$fluffy<br>
<img src="fluffy.jpg" alt="Have you seen Fluffy?"><br>
<label for="comments">Anything else you want to Add?</label>
	<textarea rows="3" cols="50" name="comments" id="comments" placeholder="Your comments..." value="$comments"></textarea><br><br>
<input type="submit" id="add" value="Report Abduction"><br>
</form>
SOMETEXT;
}

?>