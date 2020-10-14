<!DOCTYPE html>
<!-- saved from url=(0054)file:///home/andy/Desktop/books-page/shpp-library.html -->
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="library Sh++">
    <link rel="stylesheet" href="../css/libs.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
          crossorigin="anonymous"/>

    <link rel="shortcut icon" href="http://localhost/favicon.ico">
    <style>
        .details {
            display: none;
        }
    </style>
</head>

<body data-gr-c-s-loaded="true">
<section id="header" class="header-wrapper">
    <nav class="navbar navbar-default"">
        <div class="container">
            <div class="col-xs-5 col-sm-2 col-md-2 col-lg-2">
                <div class="logo"><a href="http://localhost/" class="navbar-brand"><span class="sh">Ш</span><span
                                class="plus">++</span></a></div>
            </div>
            <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8">
                <div class="main-menu">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <form class="navbar-form navbar-right"">
                            <div class="form-group">
                                <input id="search" type="text" placeholder="Найти книгу" class="form-control"
                                       onkeyup="showResult(this.value)" list="list">

                                <ul class="list-group" id="list" style="position:absolute;width:100%;text-align:left;z-index: 10;margin-top: -20px">

                                </ul>
                                <script>

                                    $("#search").bind("keypress", function (e) {
                                        if (e.keyCode == 13) {
                                            e.preventDefault();
                                            var search = document.getElementById("search");
                                            var valueOfSearch = search.value;
                                            //alert(valueOfSearch);
                                        }
                                    })
                                </script>

                                <div class="loader"><img src="../images/loading.gif"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-2 col-sm-3 col-md-2 col-lg-2 hidden-xs">
                <div class="social"><a href="https://www.facebook.com/shpp.kr/" target="_blank"><span
                                class="fa-stack fa-sm"><i class="fa fa-facebook fa-stack-1x"></i></span></a>
                    <a href="http://programming.kr.ua/ru/courses#faq" target="_blank"><span class="fa-stack fa-sm">
                            <i class="fa fa-book fa-stack-1x"></i></span></a>
                    <?php
                    session_start();
                    if (isset($_SESSION['login'])):
                        ?>
                        <a href="../admin/logout"><span class="fa-stack fa-sm">
                            <i class="fa fa-sign-out fa-stack-1x"></i></span></a>
                    <?php
                    endif;
                    ?>
                    <?php
                    if (!isset($_SESSION['login'])):
                        ?>
                        <a href="../admin"><span class="fa-stack fa-sm">
                            <i class="fa fa-sign-in fa-stack-1x"></i></span></a>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>

    </nav>
</section>

<script>
    function showResult(str) {
        if (str.length == 0) {
            document.getElementById("list").innerHTML = "";
            return;
        }
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("list").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "/?q=" + str, true);
        xmlhttp.send();
    }
</script>