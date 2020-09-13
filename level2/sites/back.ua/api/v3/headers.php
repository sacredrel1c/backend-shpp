<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://front.ua');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS, PUT');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Authorization');

ini_set('session.cookie_secure', true);
ini_set('session.cookie_samesite', 'none');
ini_set('session.cookie_lifetime', 86400);