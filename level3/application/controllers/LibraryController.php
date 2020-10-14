<?php

namespace application\controllers;

use application\core\Controller;
use application\core\View;

class LibraryController extends Controller
{
    public function showCollectionAction()
    {

        $data = $this->model->getCollection();
        $this->view->render('Коллекция книг', $data);

    }

    public function showBookAction()
    {
        $bookId = $this->route['id'];
        $data = $this->model->getBook($bookId);
        if($data){
            $this->view->render($data['title'],$data);
            $this->model->increaseViews($bookId);
        }else {
            View::errorCode(404);
        }
    }
    public function searchAction(){

        $result = $this->model->search($this->route['query']);
        foreach ($result as $option){
            //echo  '<option value="../book/'.$option['id'].'">'.$option['title'].'  Автор:'.$option['author'].'</option>';
            echo '<li class="list-group-item" style="position: relative;z-index: 2;"><a href="../book/'.$option['id'].'"> '.$option['title'].'  Автор:'.$option['author'].'</a></li>';
        }
    }
    public function clickAction(){
        $this->model->click($_GET['click']);
    }
}