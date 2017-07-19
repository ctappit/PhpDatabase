<?php
require 'mysqli_connect.php';

//SQL statement to select everything from table
$query="SELECT * FROM `alien_abduction`";

//Execute SQL statement
$result = mysqli_query($db, $query) or die(mysql_error());
$pageTitle = "Alien Abduction Database";
include "admin.html";

print <<< HERE
<table id="home">
<tr>
<th>Action</th>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Date of Abduction</th>
</tr>

HERE;

//Display results from SQL statement
while ($row=mysqli_fetch_array($result)){
    $id=$row["id"];
    $firstname=$row["firstname"];
    $lastname=$row["lastname"];
    $email=$row["email"];
    $when=$row["mmddyy"];

print <<< REPORT
<tr>
<td>
<form method="POST" action="updateinfo.php">
<input type="hidden" name="sel_record" value="$id">
<input type="submit" name="update" value=" EDIT "> 
</form>

<form method="POST" action="confirmdelete.php">
<input type="hidden" name="sel_record" value="$id">
<input type="submit" name="delete" value=" DELETE ">
</form>

</td>

<td>$id</td>
<td><b>$firstname $lastname</b></td>
<td><a href="mailto:$email">$email</a></td>
<td>$when</td>
</tr>
REPORT;

}

?>