<?php
session_start();
require ("connect.php");
$conn = CreateHandle();

$userID = $_GET['userID'];
$listID = $_GET['listID'];


$sqlquerysearch = "SELECT * FROM lists WHERE listID = '$listID'";
$result = $conn ->query($sqlquerysearch);
$listdetails = $result->fetch_array(MYSQLI_NUM);
$sqlqueryinsert = "INSERT INTO lists (listJSON, createdBy, public, title) VALUES ('$listdetails[1]', '$userID', '0', '$listdetails[5]')";
$result2 = $conn ->query($sqlqueryinsert);

header('location: marketplace.php');
?>
