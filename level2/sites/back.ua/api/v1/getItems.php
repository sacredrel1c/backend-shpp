<?php
require_once "headers.php";
include "database_conf.php";
$dataFromDB = file_get_contents(DB_FILE_NAME);
echo $dataFromDB;
exit();