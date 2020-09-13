<?php
require_once 'headers.php'; //headers with credentials and allowed methods. Contains headers of cookie.
require_once 'db_config.php'; // database config
require_once 'inputDataHandler.php'; // handler to work with input data and errors

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    die();
}
if ($_COOKIE['Auth'] == true) {
    session_start();
}
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    $sth = $dbh->prepare("SELECT id,text,checked FROM items WHERE uid='$uid'");
} else {
    $sth = $dbh->prepare('SELECT id,text,checked FROM items WHERE uid=-1');
}
errorHandler($sth, false, 500, "No results from DB or query is invalid!");
$sth->execute();
while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $result['items'][] = array('id' => intval($row['id']), 'text' => $row['text'], 'checked' => boolval($row['checked']));
}
$sth = null;
$dbh = null;
echo json_encode($result);
die();