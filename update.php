<?php
ini_set('display_errors',1);  error_reporting(E_STRICT);

include "admin.html";
require "mysqli_connect.php";

$sel = $_POST[sel_record];


$id = $_POST[id];
$firstname = $_POST[firstname];
$lastname = $_POST[lastname];
$email = $_POST[email];
$when = $_POST[when];

$query = "UPDATE alien_abduction SET id = '$id',
	firstname = '$firstname',
	lastname = '$lastname',
	email = '$email',
	mmddyy = '$when'
	WHERE id = '$id'";

$result = mysqli_query($query) or die(mysql_error());

print '<h1>Here is the updated Record:</h1>
	<p><b>First Name:  </b> $firstname</p>
	<p><b>Last Name:  </b> $lastname</p>
	<p><b>Email:  </b> $email</p>
	<p><b>Date of Abduction:  </b> $when</p>';
?>