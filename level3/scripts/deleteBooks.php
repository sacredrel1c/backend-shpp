<?php
$config = require '../application/config/database.php';
$pdo = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'], $config['user'], $config['pass']);

$books = (getDeletedBooks($pdo));
if(!empty($books)){
    foreach ($books as $book){
       deleteBooks($pdo,$book['id'],$book['title'],$book['image']);
    }
}

function getDeletedBooks($pdo){
    $result = $pdo->query('SELECT books.id,books.title,books.image FROM books WHERE books.deletedAt is not null',PDO::FETCH_ASSOC);
    return $result->fetchAll();
}
function deleteBooks($pdo,$bookId,$bookTitle,$bookImage){
    $image = $_SERVER['DOCUMENT_ROOT']."/images/".$bookImage;
    $sql = "DELETE FROM `books` WHERE id =$bookId";
    if($pdo->query($sql,PDO::FETCH_ASSOC)){
        if($bookImage == 'default.jpg'){
            echo date("Y-m-d H:i:s")." - была удаленa книга ".$bookTitle." с id - ".$bookId."<br>";
            deleteRelations($pdo,$bookId);
        }else{
            if(unlink($image)){
                echo date("Y-m-d H:i:s")." - была удаленa книга ".$bookTitle." с id - ".$bookId.
                    "а также была удалена картинка книги<br>";
                deleteRelations($pdo,$bookId);
            }
        }

    }

}
function deleteRelations($pdo,$bookId){
    $sql = "DELETE FROM `books_authors` WHERE book_id = $bookId";
    if($pdo->query($sql,PDO::FETCH_ASSOC)){
        echo date("Y-m-d H:i:s")." - была удаленa связь  книги с id - ".$bookId."<br>";
    }
}

