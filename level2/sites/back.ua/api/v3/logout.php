<?php
require_once 'headers.php';
if ($_SERVER['REQUEST_METHOD'] != POST) {
    die();
} else {
    unset($_SESSION);
    session_destroy();
    $paramsOfCookie = array(
        'expires' => time() + 864000,
        'path' => '/',
        'domain' => 'back.ua',
        'secure' => true,
        'httponly' => false,
        'samesite' => 'None'
    );
    setcookie('Auth', false, $paramsOfCookie);
    echo json_encode(array("ok" => true));
}

