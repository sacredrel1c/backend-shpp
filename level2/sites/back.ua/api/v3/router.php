<?php
$action = strtolower($_GET['action']);
switch ($action) {
    case 'additem':
        require_once 'addItem.php';
        break;
    case 'changeitem':
        require_once 'changeItem.php';
        break;
    case 'deleteitem':
        require_once 'deleteItem.php';
        break;
    case 'getitems':
        require_once 'getItems.php';
        break;
    case 'login':
        require_once 'login.php';
        break;
    case 'register':
        require_once 'register.php';
        break;
    case 'logout':
        require_once 'logout.php';
        break;
    default:
        echo $_GET['action']." - This action not support!";
}
