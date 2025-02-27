<?php
$servername="localhost";
$username="root";
$password="";
$database="code";
// creating database connection
$conn =mysqli_connect($servername, $username, $password,$database);

//check connection

if(!$conn)
{
    die("Faild to connect". mysqli_connect_eorro());
}


?>