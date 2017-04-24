<?php
$host='localhost';
$user='u347329180_yona';
$pass='yonathansm';
$database='u347329180_stbi';


$conn=($GLOBALS["___mysqli_ston"] = mysqli_connect($host, $user, $pass));
mysqli_select_db($GLOBALS["___mysqli_ston"], $database);
?>