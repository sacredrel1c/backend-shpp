<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="../admin/">Обзор библиотеки</a></li>
                <li><a href="../admin/authors">Авторы</a></li>
                <li class="active"><a href="../admin/addBook">Добавление книги</a></li>
                <li><a href="../admin/addAuthor">Добавление автора</a></li>
                <li><a href="../admin/addAdmin">Добавление админа</a></li>
            </ul>
        </div>

        <div class="col-sm-10 col-sm-offset-4 col-md-10 col-md-offset-2 main">
            <div class="row">
                <div class="col-md-5">
                    <form action="./addBook" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Название книги</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Название книги"
                                   required>
                        </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="year">Год</label>
                        <input type="number" min="1900" max="2099" step="1" value="2020" class="form-control" id="year"
                               required name="year" placeholder="Год">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="pages">Количество страниц</label>
                        <input type="number" required min="0" max="9999" step="1" class="form-control" id="pages"
                               name="pages" placeholder="Количество страниц">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="isbn">Номер ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="description">Описание книги</label>
                        <textarea class="form-control" required id="description" name="description"
                                  rows="10"></textarea>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="author1">Автор 1</label>
                        <select class="form-control" name="author1" id="author1">
                            <option disabled selected>Выберите автора 1</option>
                            <?php
                            foreach ($content as $authors):
                                ?>
                                <option value="<?php echo $authors['id']; ?>"><?php echo $authors['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="author2">Автор 2</label>
                        <select class="form-control" name="author2" id="author2">
                            <option disabled selected>Выберите автора 2</option>
                            <?php
                            foreach ($content as $authors):
                                ?>
                                <option value="<?php echo $authors['id']; ?>"><?php echo $authors['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="author3">Автор 3</label>
                        <select class="form-control" name="author3" id="author3">
                            <option disabled selected>Выберите автора 3</option>
                            <?php
                            foreach ($content as $authors):
                                ?>
                                <option value="<?php echo $authors['id']; ?>"><?php echo $authors['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-group">
                            <label for="image">Выберите обложку книги</label>
                            <input type="file" id="image" name="image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">Добавить</button>
                    </div>
                </div>

                </form>
            </div>
        </div>