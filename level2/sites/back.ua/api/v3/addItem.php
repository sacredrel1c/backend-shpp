<?php
require_once 'headers.php'; //headers with credentials and allowed methods. Contains headers of cookie.
require_once 'db_config.php'; // database config
require_once 'inputDataHandler.php'; // handler to work with input data and errors

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { // need to die script with options request (preflight)
    die();
}
$dataFromFront = file_get_contents('php://input');
$dataFromFront = json_decode($dataFromFront, true);

$text = processInputData($dataFromFront['text']);
errorHandler($text,null,400,'Bad request!');
if ($_COOKIE['Auth'] == true) {
    session_start();
}
/*Prepare and run query to db*/
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    $sth = $dbh->prepare("INSERT INTO items (text,checked,uid) VALUES ('$text',0,'$uid')");
} else {
    $sth = $dbh->prepare("INSERT INTO items (text,checked,uid) VALUES ('$text',0,-1)");
}
errorHandler($sth,false,500,"No results from DB or query is invalid!");
$sth->execute();
if (!$sth->rowCount()) {
    $result = array("id" => -1);
} else {
    $id = $dbh->lastInsertId();
    $result = array("id" => $id);
}

$sth = null;
$dbh = null;
echo json_encode($result);