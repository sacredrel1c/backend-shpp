<?php
require_once 'headers.php'; //headers with credentials and allowed methods. Contains headers of cookie.
require_once 'db_config.php'; // database config
require_once 'inputDataHandler.php';
$dataFromFront = file_get_contents('php://input');
$dataFromFront = json_decode($dataFromFront, true);

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    die();
}

$id = $dataFromFront["id"];

if($_COOKIE['Auth'] == true){
    session_start();
}
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    $sth = $dbh->prepare("DELETE FROM items WHERE id='$id' AND uid='$uid'");
} else {
    $sth = $dbh->prepare("DELETE FROM items WHERE id='$id' AND uid=-1");
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