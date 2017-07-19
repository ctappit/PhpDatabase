<?php
ini_set('display_errors',1);  error_reporting(E_STRICT);

include "admin.html";
require "mysqli_connect.php";

$id = $_POST[id];
$query = "SELECT * alien_abduction WHERE id = '$id'";

$result = mysqli_query($db, $query) or die(mysql_error());

while ($row = mysqli_fetch_array($result)){
$id = $row['id'];
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$email = $row['email'];

print "<p>$firstname $lastname report has been permanantly deleted.</p>";
}

$query="DELETE FROM alien_abduction WHERE id='$id'";
$result = mysqli_query($query) or die(mysql_error());

?>
