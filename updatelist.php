<?php
session_start();
require ("connect.php");
$conn = CreateHandle();

$json = $_GET['json'] ;
$public = $_GET['public'] ;
$title = $_GET['title'] ;
$listID = $_GET['listID'];

echo $json;
echo $public;


$sqlquery = "UPDATE lists SET listJSON = '$json', title = '$title', public = '$public' WHERE listID = '$listID'";
echo $sqlquery;

$result = $conn ->query($sqlquery);

header('location: user.php?listID=' .$listID. '&saved=1');
?>
