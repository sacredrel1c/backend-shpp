<?php


namespace application\core;
use PDO;
class DataBase
{
    protected $db;

    public function __construct()
    {
        $config = require 'application/config/database.php';
        $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'], $config['user'], $config['pass']);
    }

    public function query($query, $params = [],$pdoParam = 1)
    {
        $sth = $this->db->prepare($query);
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $sth->bindValue(':' . $key, $value,$pdoParam);
            }
        }
        $sth->execute();
        return $sth;
    }

    public function row($query, $params = [],$pdoParam = 1)
    {
        $row = $this->query($query, $params,$pdoParam);
        return $row->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($query, $params = [])
    {
        $column = $this->query($query, $params);
        return $column->fetchColumn();
    }
}