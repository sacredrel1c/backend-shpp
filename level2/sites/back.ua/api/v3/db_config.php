<?php
$dsn = 'mysql:host=localhost;dbname=backendDB';
define(USER,'root');
define(PASS,'root');
try{
    $dbh = new PDO($dsn,USER,PASS);
}catch (PDOException $e){
    print $e->getMessage();
    die();
}
