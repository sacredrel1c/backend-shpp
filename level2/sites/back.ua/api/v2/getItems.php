<?php
require_once "db_conf.php";
require_once "headers.php";
$mysqli = new mysqli(DB_HOST,DB_USER_NAME,DB_PASSWORD,DB_DATABASE);
if($mysqli->connect_error){
    die('Connect error ('.$mysqli->connect_errno.')'.$mysqli->connect_error);
}
$query = "SELECT id, text, checked FROM items";
$queryResult = $mysqli->query($query);
while ($row = $queryResult->fetch_assoc()){
    $result['items'][]= array("id"=>intval($row['id']),"text"=>$row['text'],"checked"=>boolval($row['checked']));
}
$mysqli->close();
echo json_encode($result);
