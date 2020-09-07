<?php
require_once "headers.php";
include "database_conf.php";
$dataFromFront = file_get_contents('php://input');
$dataFromFront = json_decode($dataFromFront, true);
if ($dataFromFront["text"] !== null) {
    $dataFromDB = json_decode(file_get_contents(DB_FILE_NAME), true);
    $maxId = 0;
    foreach ($dataFromDB['items'] as $subArray) {
        if ($subArray['id'] > $maxId) {
            $maxId = $subArray['id'];
        }
    }
    $maxId++;
    $dataFromFront["text"] = strip_tags($dataFromFront["text"]);
    $dataFromFront["text"] = htmlspecialchars($dataFromFront["text"]);
    if(strlen($dataFromFront["text"]) == 0){
        exit();
    }
    $dataToInsert = array("id" => $maxId, "text" => $dataFromFront["text"], "checked" => false);
    $dataFromDB['items'][] = $dataToInsert;
    $outPutData = json_encode($dataToInsert);
    file_put_contents(DB_FILE_NAME, json_encode($dataFromDB));
    echo $outPutData;
}
exit();