<?php
//Escapes tags and special chars
function processInputData($inputData)
{
    $inputData = strip_tags($inputData);
    $inputData = htmlspecialchars($inputData);
    return $inputData;
}
//Returns an Error with need status code.
function errorHandler($data, $needToError, $httpCode, $error)
{
    if ($data === $needToError) {
        http_response_code($httpCode);
        echo json_encode(array("error" => $error));
        die();
    }
}
