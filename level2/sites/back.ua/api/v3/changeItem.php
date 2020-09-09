<?php
require_once 'headers.php';
require_once 'db_config.php';

$dataFromFront = file_get_contents('php://input');
$dataFromFront = json_decode($dataFromFront, true);
if ($dataFromFront["text"] !== null) {

    $text = strip_tags(htmlspecialchars($dataFromFront["text"]));
    $checked = intval($dataFromFront["checked"]);
    $id = $dataFromFront["id"];
}else{
    die("Text field is empty or incorrect!");
}
$sth = $dbh->prepare("UPDATE items SET text='$text',checked='$checked' WHERE id='$id'");
$sth->execute();
if(!$sth->rowCount()){
    $result = array("ok"=>false);
}else{
    $result = array("ok"=>true);
}

$sth = null;
$dbh = null;
echo json_encode($result);