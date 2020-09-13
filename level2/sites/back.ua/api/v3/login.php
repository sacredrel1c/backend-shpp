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

$sth = $dbh->prepare("SELECT * FROM users WHERE username='$login'");
errorHandler($sth, false, 500, "No results from DB or query is invalid!");
$sth->execute();
if (!$sth->rowCount()) {
    $result = array("ok" => false);
} else {
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    if (password_verify($pass, $row['passhash'])) {
        $result = array("ok" => true);

        $paramsOfCookie = array(
            'expires' => time() + 86400,
            'path' => '/',
            'domain' => 'back.ua',
            'secure' => true,
            'httponly' => false,
            'samesite' => 'None'
        );
        setcookie('Auth', true, $paramsOfCookie);

        session_start();
        $_SESSION['uid'] = $row['id'];
        $_SESSION['username'] = $row['username'];
    } else {
        $result = array("ok" => false);
    }
}

$sth = null;
$dbh = null;
echo json_encode($result);
die();
