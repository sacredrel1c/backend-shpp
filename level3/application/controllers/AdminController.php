<?php


namespace application\controllers;


use application\core\Controller;
use application\core\View;

class AdminController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        $this->basicAuth();
    }


    public function showAdminPageAction()
    {
        if(isset($this->route['id'])){
            $this->model->deleteBook($this->route['id']);
        }
        $data = $this->model->showLibrary();
        $this->view->setLayout('admin');
        $this->view->render('Обзор библиотеки',$data);


    }

    private function basicAuth()
    {
        if (!$this->model->getStatusLogin()) {
            header('WWW-Authenticate: Basic realm="SH++"');
            header('HTTP/1.0 401 Unauthorized');
            die();
        } else {
            session_start();
            $_SESSION['login'] = true;
        }
    }

    public function logoutAction()
    {
        $this->view->setLayout('admin');
        $this->view->render('Log Out from Admin Panel!');
    }

    public function addAdminAction()
    {
        $status = '';
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $status = $this->model->addAdmin($_POST['username'], $_POST['password']);
        }
        $this->view->setLayout('admin');
        $this->view->render('Добавление администратора', $status);
    }
    public function addAuthorAction(){
        $status = '';
        if (isset($_POST['authorName'])) {
            $status = $this->model->addAuthor($_POST['authorName']);
        }
        $this->view->setLayout('admin');
        $this->view->render('Добавление автора', $status);
    }
    public function addBookAction(){
        if(isset($_POST['title']) && isset($_POST['year']) &&
            isset($_POST['pages']) && isset($_POST['description'])){
            $title = strip_tags(htmlspecialchars($_POST['title']));
            $year = (int)strip_tags(htmlspecialchars($_POST['year']));
            $pages = (int)strip_tags(htmlspecialchars($_POST['pages']));
            $description = strip_tags(htmlspecialchars($_POST['description']));
            $isbn = strip_tags(htmlspecialchars($_POST['isbn']));
            $image = $this->model->uploadImage();
            $result = $this->model->addBook($title,$description,$year,$pages,$isbn,$image);
            $this->view->setLayout('admin');
            $this->view->render('Добавление книги');
        }else {
            $authors = $this->model->getAuthors();
            $this->view->setLayout('admin');
            $this->view->render('Добавление книги',$authors);
        }

    }
    public function showAuthorsAction(){
        $data = $this->model->showAuthors();
        $this->view->setLayout('admin');
        $this->view->render('Авторы',$data);
    }


}