<?php


namespace application\models;


class PaginatorModel
{
    private $sql = '';
    private $startOffset = 0;
    private $limitPerPage = 0;
    private $currentOffset = 0;
    private $tableName = '';
    private $db;

    public function __construct($tableName,$sql,$startOffset,$limitPerPage,$currentOffset,$pdoObject)
    {
        $this->sql = $sql;
        $this->startOffset =$startOffset;
        $this->limitPerPage = $limitPerPage;
        $this->currentOffset = $currentOffset;
        $this->tableName = $tableName;
        $this->db = $pdoObject;
    }

    public function paginate (){
        $countOfAllItems = $this->db->row("SELECT COUNT(*) FROM books WHERE deletedAt is null");
        $countOfAllItems = $countOfAllItems[0]['COUNT(*)'];

        if($this->currentOffset > $countOfAllItems) {
            $this->currentOffset = 0;
        }
        $countOfPages = ceil($countOfAllItems/$this->limitPerPage);
        $result = $this->db->row($this->sql, ['offset'=>$this->currentOffset,'countItems'=>$this->limitPerPage]);
        $result = ['data'=>$result,'pagination'=>
            ['countOfPages'=>$countOfPages, 'limit'=>$this->limitPerPage,'offset'=>$this->currentOffset]];
        return $result;
    }
}