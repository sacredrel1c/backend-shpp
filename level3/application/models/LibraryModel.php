<?php

namespace application\models;

use application\core\Model;

class LibraryModel extends Model

{
    public function getCollection()
    {
        $sql = 'SELECT books.id, books.title, books.image,GROUP_CONCAT(name) as author FROM books LEFT JOIN books_authors
    as t2 ON books.id = t2.book_id  LEFT JOIN authors as t3 ON t2.author_id = t3.id WHERE deletedAt is null GROUP BY books.id LIMIT :offset ,:countItems';
        $currentOffset = 0;
        if (isset($_GET['offset'])) {
            $currentOffset = $_GET['offset'];
        }
        $paginator = new PaginatorModel('books', $sql, 0, 10, $currentOffset, $this->db);
        return $paginator->paginate();

    }

    public function getBook($id)
    {
        $result = $this->db->row('SELECT books.id, books.title, books.year, books.pages, books.isbn, books.description, books.image,GROUP_CONCAT(name) as author 
FROM books LEFT JOIN books_authors as t2 ON books.id = t2.book_id LEFT JOIN
 authors as t3 ON t2.author_id = t3.id WHERE books.id=:id GROUP BY books.id ', ['id' => $id]);
        if ($result) {
            return $result[0];
        } else {
            return false;
        }

    }

    public function search($query)
    {
        $query = urldecode($query);
        $params = ['query' => '%'.$query.'%'];

        return $this->db->row('SELECT books.id, books.title, books.year, GROUP_CONCAT(name) as author
FROM `books`
         LEFT JOIN books_authors as t2 ON books.id = t2.book_id
         LEFT JOIN authors as t3 ON t2.author_id = t3.id
WHERE books.deletedAt is null AND books.title LIKE :query OR name LIKE :query AND books.deletedAt is NULL GROUP BY books.id, books.title, books.year', $params,2);
    }

    public function click($bookId){
        $this->db->query('UPDATE `books` SET clicks = clicks+1 WHERE id = :id',['id'=>$bookId],1);
    }
    public function increaseViews($bookId){
        $this->db->query('UPDATE `books` SET views = views+1 WHERE id = :id',['id'=>$bookId],1);
    }
}