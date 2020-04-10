<?php
session_start();
require ("connect.php");
$conn = CreateHandle();

$json = $_GET['json'] ;
$public = $_GET['public'] ;
$title = $_GET['title'] ;
$createdby = $_SESSION['userID'];

echo $json;
echo $public;

$sqlquery = "INSERT INTO lists (listJSON, createdBy, public, title) VALUES ('$json', '$createdby', '$public', '$title')";
echo $sqlquery;

$result = $conn ->query($sqlquery);

header('location: user.php?saved=1');
?>
