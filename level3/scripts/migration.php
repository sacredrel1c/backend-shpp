<?php

$config = require '../application/config/database.php';
$pdo = new PDO("mysql:host=" . $config['host'], $config['user'], $config['pass']);
$sqlDir = $_SERVER['DOCUMENT_ROOT'] . '/application/migrations/';

migrate($pdo, $sqlDir);

function migrate($pdo, $sqlDir)
{
    $files = scandir($sqlDir);
    $basefile = $sqlDir . '0.0.0.baseline.sql';
    if (file_exists($basefile)) {
        importSQL($pdo, $basefile);
        echo "База создана, таблица миграций импортирована<br>";
    }
    foreach ($files as $file) {
        if (substr(trim($file), -3, 3) != 'sql' || $file == '0.0.0.baseline.sql') {
            continue;
        }

        $fileParts = explode('.', $file);
        $majorVer = $fileParts[0];
        $minorVer = $fileParts[1];
        $fileNumber = $fileParts[2];
        $comments = $fileParts[3];
        if (checkVersion($majorVer, $minorVer, $fileNumber, $pdo)) {
            $sqlToInsert = "INSERT INTO migrations (id,MajorVersion,MinorVersion,FileNumber,Comment,DateApplied) VALUES (null,$majorVer,$minorVer,$fileNumber,'$comments',NOW())";
            $pdo->exec($sqlToInsert);
            importSQL($pdo, $_SERVER['DOCUMENT_ROOT'] . '/application/migrations/' . $file);
            echo $file . "- файл обработан!<br>";
        } else {
            echo $file . " - файл уже был в работе!<br>";
        }


    }


}

function checkVersion($majorVer, $minorVer, $fileNumber, $pdo)
{
    $pdo->exec('USE library');
    $sqlToSelect = "SELECT id FROM migrations WHERE MajorVersion = " . $majorVer . " AND MinorVersion = " . $minorVer . " AND FileNumber = " . $fileNumber;
    $currentVersions = $pdo->query($sqlToSelect);
    if ($currentVersions) {
        if (empty($currentVersions->fetchAll())) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function importSQL($pdo, $sqlFile)
{
    $pdo->setAttribute(PDO::MYSQL_ATTR_LOCAL_INFILE, true);
    $tempLine = '';
    $linesFromSQL = file($sqlFile);
    foreach ($linesFromSQL as $line) {
        if (substr($line, 0, 2) == '--' || trim($line) == '') {
            continue;
        }
        $tempLine .= $line;
        if (substr(trim($line), -1, 1) == ';') {
            try {
                $pdo->exec($tempLine);
            } catch (PDOException $e) {
                echo "<br><pre>Запрос из файла " . $sqlFile . ": '<strong>" . $tempLine . " возвратил ошибку</strong>': " . $e->getMessage() . "</pre>\n";
            }
            $tempLine = '';
        }
    }
}