<?php
$host = 'localhost';
$user = 'root';
$password ='';
$db_name='rental';

$mysqli = new mysqli($host, $user, $password, $db_name);
$mysqli->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
$mysqli->query("SET CHARSET utf8");

if($error = $mysqli ->connect_errno){
    die("Wystąpił błąd z połączeniem do bazy danych" .$error);
}
?>