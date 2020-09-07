<?php

// не обращайте на эту функцию внимания
// она нужна для того чтобы правильно считать входные данные
function readHttpLikeInput() {
    $f = fopen( 'php://stdin', 'r' );
    $store = "";
    $toread = 0;
    while( $line = fgets( $f ) ) {
        $store .= preg_replace("/\r/", "", $line);
        if (preg_match('/Content-Length: (\d+)/',$line,$m)) 
            $toread=$m[1]*1; 
        if ($line == "\r\n") 
              break;
    }
    if ($toread > 0) 
        $store .= fread($f, $toread);
    return $store;
}

$contents = readHttpLikeInput();

function outputHttpResponse($statuscode, $statusmessage, $headers, $body) {
    
    echo "HTTP/1.1 ".$statuscode." ".$statusmessage."\n";
    for($i = 0; $i < count($headers); $i++){
        echo $headers[$i][0].": ".$headers[$i][1]."\n";
    }
    echo $body;
}


function processHttpRequest($method, $uri, $headers, $body) {
        $statuscode = 404;
        $statusmessage = "Not Found";
        $body = "not found";
    
        if($method = "GET" && preg_match("/\/sum\?nums=(\d*,){1,}/", $uri) == 1) {
                $tempUri = explode("=", $uri);
                $tempUri = explode(",", $tempUri[1]);
                $body = 0;
                for($i = 0; $i < count($tempUri); $i++){
                    $body += $tempUri[$i];
                }
                $statuscode = 200;
                $statusmessage = "OK";
        
        }
        elseif ($method != "GET" || preg_match("?nums=", $uri) == 0) {
            $body = "bad request";
            $statuscode = 400;
            $statusmessage = "Bad Request";
        }
        //Task3 (f) - use headers to create response
        unset($headers);
        $headers[] = array("Server","Apache/2.2.14 (Win32)");
        $headers[] = array("Connection","Closed");
        $headers[] = array("Content-Type", "text/html; charset=utf-8");
        $headers[] = array("Content-Length", strlen($body));

    outputHttpResponse($statuscode, $statusmessage, $headers, $body);
}


function parseTcpStringAsHttpRequest($string) {

    $method = explode(" ", $string)[0];
    $uri = explode(" ", $string)[1];
    $body = explode("\n", $string);
    $body = $body[count($body) - 1];
    $tempHeaders = explode("\n", $string);
    for($i = 1 ; $i < count($tempHeaders) - 1; $i++){
        $headers[] = explode(": ", $tempHeaders[$i]);
    }


    return array(
        "method" => $method,
        "uri" => $uri,
        "headers" => $headers,
        "body" => $body,
    );
}
$http = parseTcpStringAsHttpRequest($contents);
processHttpRequest($http["method"], $http["uri"], $http["headers"], $http["body"]);
