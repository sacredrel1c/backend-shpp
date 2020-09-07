<?php
require_once "headers.php";
include "database_conf.php";
$dataFromFront = file_get_contents('php://input');
$dataFromFront = json_decode($dataFromFront, true);
$dataFromDB = json_decode(file_get_contents(DB_FILE_NAME), true);

foreach ($dataFromDB['items'] as $index => $subArray) {
    if ($subArray["id"] === $dataFromFront["id"]) {
        unset($dataFromDB["items"][$index]);
        $dataFromDB["items"] = array_values($dataFromDB["items"]);
        $outPutData = array("ok" => true);
    }
}
file_put_contents(DB_FILE_NAME, json_encode($dataFromDB));
if (!isset($outPutData)) {
    $outPutData = array("ok" => false);
}

echo json_encode($outPutData);
exit();