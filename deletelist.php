<?php
session_start();
require ("connect.php");
$conn = CreateHandle();

$listID = $_GET['listID'];
$sqlquery = "DELETE FROM lists WHERE listID = '$listID' ";
echo $sqlquery;

$result = $conn ->query($sqlquery);

header('location:user.php');
?>