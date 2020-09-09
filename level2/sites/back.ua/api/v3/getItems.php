<?php
require_once 'headers.php';
require_once 'db_config.php';

if(isset($_SESSION['uid'])){
    $uid = $_SESSION['uid'];
    $sth = $dbh->prepare("SELECT id,text,checked FROM items WHERE uid='$uid'");
}else {
    $sth = $dbh->prepare('SELECT id,text,checked FROM items');
}
$sth->execute();
while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $result['items'][] = array('id' => intval($row['id']), 'text' => $row['text'], 'checked' => boolval($row['checked']));
}
$sth = null;
$dbh = null;
echo json_encode($result);
die();