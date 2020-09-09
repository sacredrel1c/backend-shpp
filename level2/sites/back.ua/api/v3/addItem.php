<?php
require_once 'headers.php';
require_once 'db_config.php';

$dataFromFront = file_get_contents('php://input');
$dataFromFront = json_decode($dataFromFront, true);
$text = strip_tags(htmlspecialchars($dataFromFront["text"]));
if($text == null){
    die("Incorrect input-data!");
}
$sth = $dbh->prepare("INSERT INTO items (text,checked,uid) VALUES ('$text',0,-1)");
$sth->execute();
if(!$sth->rowCount()){
    $result = array("id"=>-1);
}else{
    $id = $dbh->lastInsertId();
    $result = array("id"=>$id);
}

$sth = null;
$dbh = null;
echo json_encode($result);