<?php
require_once "headers.php";
require_once "db_conf.php";
$dataFromFront = file_get_contents('php://input');
$dataFromFront = json_decode($dataFromFront, true);

$id = $dataFromFront["id"];

$mysqli = new mysqli(DB_HOST, DB_USER_NAME, DB_PASSWORD, DB_DATABASE);
if ($mysqli->connect_error) {
    die('Connect error (' . $mysqli->connect_errno . ')' . $mysqli->connect_error);
}
$query = "DELETE FROM items WHERE id='$id'";
if(!$queryResult = $mysqli->query($query)){
    $outPutData = array("ok"=>false);
}
$mysqli->close();
$outPutData = array("ok" => true);

echo json_encode($outPutData);
exit();