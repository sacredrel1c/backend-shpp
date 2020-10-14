<?php


namespace application\models;


use application\core\Model;

class AdminModel extends Model
{
    public function getStatusLogin()
    {
        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
            $login = strtolower($_SERVER['PHP_AUTH_USER']);
            $password = $_SERVER['PHP_AUTH_PW'];
            $result = $this->db->row('SELECT * FROM `admins` WHERE username = :username', ['username' => $login],2);
            if (!empty($result)) {
                if (password_verify($password, $result[0]['pwhash'])) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function addAdmin($login, $pass)
    {
        $login = strtolower($login);
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $params = ['username' => $login, 'pwhash' => $pass];
        return $this->db->query('INSERT INTO `admins`(id,username,pwhash) VALUES (null ,:username,:pwhash)', $params);

    }

    public function addAuthor($name)
    {
        return $this->db->query('INSERT INTO `authors`(id,name) VALUES (null ,:name)', ['name' => $name]);
    }

    public function showLibrary()
    {
        $sql = 'SELECT books.id, books.title, books.image,books.year,books.clicks,books.views,GROUP_CONCAT(name) as author FROM books LEFT JOIN books_authors 
as t2 ON books.id = t2.book_id  LEFT JOIN authors as t3 ON t2.author_id = t3.id WHERE deletedAt is null GROUP BY books.id LIMIT :offset ,:countItems;';
        $currentOffset = 0;
        if (isset($_GET['offset'])) {
            $currentOffset = $_GET['offset'];
        }
        $paginator = new PaginatorModel('books', $sql, 0, 7, $currentOffset, $this->db);
        return $paginator->paginate();
    }

    public function deleteBook($id)
    {
        $this->db->query('UPDATE `books` SET deletedAt = :time WHERE id = :id',['id'=>$id,'time'=>time()],2);
    }

    public function getAuthors()
    {
        return $this->db->row('SELECT id,name FROM authors');
    }

    public function addBook($title, $description, $year, $pages, $isbn,$image)
    {
        if(!$image){
            $image = 'default.jpg';
        }
        $params = ['title' => $title,
            'description' => $description,
            'year' => $year,
            'pages' => $pages,
            'isbn' => $isbn,
            'image' => $image];
        $result = $this->db->query('INSERT INTO `books` (id,title,year,pages,isbn,description,image,clicks,views,deletedAt) VALUES (null,:title,:year,:pages,:isbn,:description,:image,0,0,null)', $params,2);
        $id = $this->db->row('SELECT LAST_INSERT_ID()');
        $id =  $id[0]['LAST_INSERT_ID()'];

        if (isset($_POST['author1'])) {
            $author1 = (int)strip_tags(htmlspecialchars($_POST['author1']));
            $this->db->query('INSERT INTO `books_authors` (book_id,author_id) VALUES (:book_id,:author_id)',['book_id'=>$id,'author_id'=>$author1]);
        }
        if (isset($_POST['author2'])) {
            $author2 = (int)strip_tags(htmlspecialchars($_POST['author2']));
            $this->db->query('INSERT INTO `books_authors` (book_id,author_id) VALUES (:book_id,:author_id)',['book_id'=>$id,'author_id'=>$author2]);
        }
        if (isset($_POST['author3'])) {
            $author3 = (int)strip_tags(htmlspecialchars($_POST['author3']));
            $this->db->query('INSERT INTO `books_authors` (book_id,author_id) VALUES (:book_id,:author_id)',['book_id'=>$id,'author_id'=>$author3]);
        }
    }
    public function uploadImage(){
        function canUpload($file){
            if($file['name'] == ''){
                return false;
            }
            if($file['size'] == 0){
                return false;
            }
            $getMime = explode('.',$file['name']);
            $getMime = strtolower(end($getMime));
            $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
            if(!in_array($getMime,$types)){
                return false;
            }
            return true;
        }
        function doUpload($file){
            $name = mt_rand(0, 10000) . $file['name'];
            if(copy($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/images/' . $name)){
                return $name;
            }else {
                return false;
            }

        }
        if(isset($_FILES['image'])){
            if(canUpload($_FILES['image'])){
               return doUpload($_FILES['image']);
            }
        }

    }
    public function showAuthors(){
        $sql = 'SELECT name FROM `authors` LIMIT :offset ,:countItems;';
        $currentOffset = 0;
        if (isset($_GET['offset'])) {
            $currentOffset = $_GET['offset'];
        }
        $paginator = new PaginatorModel('authors', $sql, 0, 7, $currentOffset, $this->db);
        return $paginator->paginate();
    }
}