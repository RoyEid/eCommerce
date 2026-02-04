<?php
$dsn = 'mysql:host=localhost;dbname=shop';
$user = 'root';
$pass = '';
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
try {
    $con = new PDO($dsn, $user, $pass, $option); //connection to db 
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) { //catchnif error
    echo 'Failed To connect' . $e->getMessage();
}
