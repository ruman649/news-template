<?php

$host = "localhost";
$user = "root";
$pass = '';
$db_name = 'news_site';

$connect = mysqli_connect($host, $user, $pass, $db_name) or die("connection error". mysqli_connect_error());
$root = "http://localhost:3000";

?>