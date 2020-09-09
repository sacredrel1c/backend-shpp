<?php
require_once 'headers.php';
require_once 'db_config.php';

$dataFromFront = file_get_contents('php://input');
$dataFromFront = json_decode($dataFromFront, true);
$login = strtolower(strip_tags(htmlspecialchars($dataFromFront["login"])));
if($login == null){
    die("Incorect input-data or preflight query");
}
$pass = strip_tags(htmlspecialchars($dataFromFront["pass"]));
$passHash = password_hash($pass,PASSWORD_DEFAULT);

$sth = $dbh->prepare("INSERT INTO users (username, passhash) VALUES ('$login','$passHash')");
$sth->execute();
if(!$sth->rowCount()){
    $result = array("ok"=>false);
}else{
    $result = array("ok"=>true);
}

$sth = null;
$dbh = null;
echo json_encode($result);
