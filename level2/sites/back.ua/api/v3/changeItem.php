<?php
require_once 'headers.php'; //headers with credentials and allowed methods. Contains headers of cookie.
require_once 'db_config.php'; // database config
require_once 'inputDataHandler.php'; // handler to work with input data and errors

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') { // need to die script with options request (preflight)
    die();
}
$dataFromFront = file_get_contents('php://input');
$dataFromFront = json_decode($dataFromFront, true);

$text = processInputData($dataFromFront["text"]);
$checked = intval($dataFromFront["checked"]);
$id = $dataFromFront["id"];
errorHandler($text, null, 400, 'Bad Request!');
if ($_COOKIE['Auth'] == true) {
    session_start();
}
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    $sth = $dbh->prepare("UPDATE items SET text='$text',checked='$checked' WHERE id='$id' AND uid='$uid'");
} else {
    $sth = $dbh->prepare("UPDATE items SET text='$text',checked='$checked' WHERE id='$id' AND uid=-1");
}
errorHandler($sth, false, 500, "No results from DB or query is invalid!");
$sth->execute();
if (!$sth->rowCount()) {
    $result = array("ok" => false);
} else {
    $result = array("ok" => true);
}

$sth = null;
$dbh = null;
echo json_encode($result);