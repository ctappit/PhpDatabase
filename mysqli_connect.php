
<?php
// mysqli connect script, based of Ullman script pg 268
ini_set('display_errors',1);  error_reporting(E_STRICT);
//set up database constants
$USER="caitap_dpr206";
$PASSWORD= "corbin1";
$HOST= "localhost";
$DBN= "caitap_dpr206";

//make connection
$db = mysqli_connect($HOST, $USER, $PASSWORD)
OR die ('Could not connect to MySQL' . mysqli_connect_error());
mysqli_select_db($db, $DBN);

?>
