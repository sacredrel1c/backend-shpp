<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="../admin/">Обзор библиотеки</a></li>
                <li class="active"><a href="../admin/authors">Авторы</a></li>
                <li><a href="../admin/addBook">Добавление книги</a></li>
                <li><a href="../admin/addAuthor">Добавление автора</a></li>
                <li><a href="../admin/addAdmin">Добавление админа</a></li>
            </ul>
        </div>
        <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-2 main">
            <div class="table-responsive">
                <table class="table table-responsive table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Автор</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach ($content['data'] as $author):
                        ?>
                        <tr>
                            <td><?php echo $author['name'] ?></td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <div style="text-align: center;">
                <nav aria-label="...">
                    <ul class="pagination">

                        <?php
                        $up = '';
                        $offset = $content['pagination']['offset'];
                        $limit = $content['pagination']['limit'];
                        $countOfPages = $content['pagination']['countOfPages'];
                        if ($offset != 0) {
                            echo '<li class="page-item"><a class="page-link" href="../admin/authors?offset=' . ($offset - $limit) . '">Назад</a></li>';
                        }
                        if ($offset < ($countOfPages - 1) * $limit) {
                            $up = '<li class="page-item"><a class="page-link" href="../admin/authors?offset=' . ($offset + $limit) . '">Вперед</a></li>';
                        }
                        for ($i = 0; $i < $countOfPages; $i++) {
                            if ($offset == $i * $limit) {
                                echo '<li class="page-item active"><a class="page-link" href="../admin/authors?offset=' . $i * $limit . '">' . ($i + 1) . '</a></li>';
                            } else {
                                echo '<li class="page-item"><a class="page-link" href="../admin/authors?offset=' . $i * $limit . '">' . ($i + 1) . '</a></li>';

                            }
                        }
                        echo $up;
                        ?>
                    </ul>
                </nav>
            </div>
        </div>