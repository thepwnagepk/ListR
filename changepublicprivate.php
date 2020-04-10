<?php
session_start();
require ("connect.php");
$conn = CreateHandle();

$newpublicprivate = $_GET['newpublicprivate'] ;
$listID = $_GET['listID'];




$sqlquery = "UPDATE lists SET  public = '$newpublicprivate' WHERE listID = '$listID'";
echo $sqlquery;

$result = $conn ->query($sqlquery);

header('location: user.php?listID=' .$listID);
?>