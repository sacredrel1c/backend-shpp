<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://front.ua');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Authorization');
ini_set('session.cookie_samesite', 'None');
ini_set('session.cookie_secure', true);
session_start();