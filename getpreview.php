
<?php


session_start();
require ("connect.php");
$conn = CreateHandle();
$previewID = $_GET['previewID'];
$sql="SELECT * FROM lists WHERE listID = '$previewID'"; //change
//$result = $conn ->query($sql);



?>