<section id="main" class="main-wrapper" style="position: relative;z-index: 0">
    <div class="container">
        <div id="content" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php
            foreach ($content['data'] as $book):
                ?>
                <div data-book-id="<?php echo $book['id'] ?>" class="book_item col-xs-6 col-sm-3 col-md-2 col-lg-2">
                    <div class="book">
                        <a href="./book/<?php echo $book['id'] ?>"><img src="./images/<?php echo $book['image'] ?>"
                                                                        alt="<?php echo $book['title'] ?>">
                            <div data-title="<?php echo $book['title'] ?>" class="blockI" style="height: 46px;">
                                <div data-book-title="<?php echo $book['title'] ?>"
                                     class="title size_text"><?php echo $book['title'] ?></div>
                                <div data-book-author="<?php echo $book['author'] ?>"
                                     class="author"><?php echo $book['author'] ?></div>
                            </div>
                        </a>
                        <a href="./book/<?php echo $book['id'] ?>">
                            <button type="button" class="details btn btn-success">Читать</button>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
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
                        echo '<li class="page-item"><a class="page-link" href="./?offset=' . ($offset - $limit) . '">Назад</a></li>';
                    }
                    if ($offset < ($countOfPages - 1) * $limit) {
                        $up = '<li class="page-item"><a class="page-link" href="./?offset=' . ($offset + $limit) . '">Вперед</a></li>';
                    }
                    for ($i = 0; $i < $countOfPages; $i++) {
                        if ($offset == $i * $limit) {
                            echo '<li class="page-item active"><a class="page-link" href="./?offset=' . $i * $limit . '">' . ($i + 1) . '</a></li>';
                        } else {
                            echo '<li class="page-item"><a class="page-link" href="./?offset=' . $i * $limit . '">' . ($i + 1) . '</a></li>';

                        }
                    }
                    echo $up;
                    ?>
                </ul>
            </nav>
        </div>

</section>