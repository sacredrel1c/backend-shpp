<?php
require_once "db_conf.php";
require_once "headers.php";
$dataFromFront = file_get_contents('php://input');
$dataFromFront = json_decode($dataFromFront, true);
$text = strip_tags(htmlspecialchars($dataFromFront["text"]));
if(strlen($text) > 0){
    $mysqli = new mysqli(DB_HOST,DB_USER_NAME,DB_PASSWORD,DB_DATABASE);
    if($mysqli->connect_error){
        die('Connect error ('.$mysqli->connect_errno.')'.$mysqli->connect_error);
    }
    $query = "INSERT INTO items (text,checked) VALUES ('$text',0)";
    $queryResult = $mysqli->query($query);
    $id = $mysqli->insert_id;
    $mysqli->close();
    echo json_encode(array("id"=>$id));
}else{
    die("Input data is not valid");
}
