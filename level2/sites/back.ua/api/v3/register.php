<?php
require_once 'headers.php'; //headers with credentials and allowed methods. Contains headers of cookie.
require_once 'db_config.php'; // database config
require_once 'inputDataHandler.php'; // handler to work with input data and errors

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die();
}

$dataFromFront = file_get_contents('php://input');
$dataFromFront = json_decode($dataFromFront, true);

$login = strtolower(processInputData($dataFromFront["login"]));
$pass = processInputData($dataFromFront["pass"]);
$passHash = password_hash($pass, PASSWORD_DEFAULT);

$sth = $dbh->prepare("INSERT INTO users (username, passhash) VALUES ('$login','$passHash')");
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
