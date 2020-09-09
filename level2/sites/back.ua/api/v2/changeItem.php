<?php
require_once "headers.php";
require_once "db_conf.php";
$dataFromFront = file_get_contents('php://input');
$dataFromFront = json_decode($dataFromFront, true);
if ($dataFromFront["text"] !== null) {

    $text = strip_tags(htmlspecialchars($dataFromFront["text"]));
    $checked = intval($dataFromFront["checked"]);
    $id = $dataFromFront["id"];

    $mysqli = new mysqli(DB_HOST, DB_USER_NAME, DB_PASSWORD, DB_DATABASE);
    if ($mysqli->connect_error) {
        die('Connect error (' . $mysqli->connect_errno . ')' . $mysqli->connect_error);
    }
    $query = "UPDATE items SET text='$text', checked ='$checked' WHERE id='$id'";
    $queryResult = $mysqli->query($query);
    $mysqli->close();
    $outPutData = array("ok" => true);
} else {
    $outPutData = array("ok" => false);
}
echo json_encode($outPutData);
exit();