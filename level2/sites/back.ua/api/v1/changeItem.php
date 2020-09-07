<?php
require_once "headers.php";
include "database_conf.php";
$dataFromFront = file_get_contents('php://input');
$dataFromFront = json_decode($dataFromFront, true);
if ($dataFromFront["text"] !== null) {
    $dataFromFront["text"] = strip_tags($dataFromFront["text"]);
    $dataFromFront["text"] = htmlspecialchars($dataFromFront["text"]);
    if(strlen($dataFromFront["text"]) == 0){
        exit();
    }

    $dataFromDB = json_decode(file_get_contents(DB_FILE_NAME), true);
    foreach ($dataFromDB['items'] as $index => $subArray) {
       if($subArray["id"] == $dataFromFront["id"]){
           $dataFromDB["items"][$index]["text"] = $dataFromFront["text"];
           $dataFromDB["items"][$index]["checked"] = $dataFromFront["checked"];
       }
    }
    $outPutData = array("ok"=>true);
    file_put_contents(DB_FILE_NAME, json_encode($dataFromDB));
}else{
    $outPutData = array("ok"=>false);
}
echo json_encode($outPutData);
exit();