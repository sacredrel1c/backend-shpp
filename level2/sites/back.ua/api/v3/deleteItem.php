<?php
require_once 'headers.php';
require_once 'db_config.php';

$dataFromFront = file_get_contents('php://input');
$dataFromFront = json_decode($dataFromFront, true);
$id = $dataFromFront["id"];

$sth = $dbh->prepare("DELETE FROM items WHERE id='$id'");
$sth->execute();
if(!$sth->rowCount()){
    $result = array("ok"=>false);
}else{
    $result = array("ok"=>true);
}

$sth = null;
$dbh = null;
echo json_encode($result);