<?php
require_once 'headers.php';
require_once 'db_config.php';

$dataFromFront = file_get_contents('php://input');
$dataFromFront = json_decode($dataFromFront, true);
$login = strtolower(strip_tags(htmlspecialchars($dataFromFront["login"])));
$pass = strip_tags(htmlspecialchars($dataFromFront["pass"]));


$sth = $dbh->prepare("SELECT * FROM users WHERE username='$login'");
$sth->execute();
if(!$sth->rowCount()){
    $result = array("ok"=>false);
}else{
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    if(password_verify($pass,$row['passhash'])){
        $result = array("ok"=>true);
        $time = 86400;
        setcookie('username',$login,time()+$time,['samesite' => 'None', 'secure' => true]);
        setcookie('passhash',$pass,['samesite' => 'None', 'secure' => true]);
        $_SESSION['uid'] = $row['id'];
        $_SESSION['username'] = $row['username'];
    }else{
        $result = array("ok"=>false);
    }
}

$sth = null;
$dbh = null;
echo json_encode($result);
die();
