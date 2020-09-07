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
echo(json_encode($http, JSON_PRETTY_PRINT));
