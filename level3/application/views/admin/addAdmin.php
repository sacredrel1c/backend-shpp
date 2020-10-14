<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="../admin/">Обзор библиотеки</a></li>
                <li><a href="../admin/authors">Авторы</a></li>
                <li><a href="../admin/addBook">Добавление книги</a></li>
                <li><a href="../admin/addAuthor">Добавление автора</a></li>
                <li class="active"><a href="../admin/addAdmin">Добавление админа</a></li>
            </ul>
        </div>

        <div class="col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-2 main">
            <?php
            if(!isset($_POST['username']) && !isset($_POST['password'])):
            ?>
            <form action="./addAdmin" method="post">
                <div class="form-group">
                    <label for="username">Имя пользователя</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Имя пользователя">
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="Пароль">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Создать</button>
                </div>
            </form>
            <?php
            endif;
            if($content){
                echo "Админ успешно добавлен";
            }
            ?>
        </div>