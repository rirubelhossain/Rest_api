<?php
$hostname = "localhost";
$username = "root";
$pass = "";
$db = "rest_api";


$conn = new mysqli($hostname , $username , $pass , $db );

if($conn -> connect_error)
{
    die("connection lost") ;
}
else{
    echo "yes yes" ;
}

?>