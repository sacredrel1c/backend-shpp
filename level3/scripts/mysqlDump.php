<?php
$database = "library";
$fileName = date("Y-m-d_H:i:s")."_".$database.".sql";
$folderName = $_SERVER['DOCUMENT_ROOT']."/archive/";
$command = "mysqldump --user=root --password=root --host=localhost ".$database." > ".$folderName.$fileName;
exec($command);
die();