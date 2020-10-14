<section id="main" class="main-wrapper">
    <div class="container">
        <div id="content" class="book_block col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="id" book-id="<?php echo $content['id']?>">
                <div id="bookImg" class="col-xs-12 col-sm-3 col-md-3 item" style="margin:;"><img src="../images/<?php echo $content['image']?>" alt="Responsive image" class="img-responsive">

                    <hr>
                </div>
                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 info">
                    <div class="bookInfo col-md-12">
                        <div id="title" class="titleBook"><?php echo $content['title']?></div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="bookLastInfo">
                            <div class="bookRow"><span class="properties">автор:</span><span id="author"><?php echo $content['author']?></span></div>
                            <div class="bookRow"><span class="properties">год:</span><span id="year"><?php echo $content['year']?></span></div>
                            <div class="bookRow"><span class="properties">страниц:</span><span id="pages"><?php echo $content['pages']?></span></div>
                            <div class="bookRow"><span class="properties">isbn:</span><span id="isbn"><?php echo $content['isbn']?></span></div>
                        </div>
                    </div>
                    <div class="btnBlock col-xs-12 col-sm-12 col-md-12">
                        <button type="button" class="btnBookID btn-lg btn btn-success">Хочу читать!</button>
                    </div>
                    <div class="bookDescription col-xs-12 col-sm-12 col-md-12 hidden-xs hidden-sm">
                        <h4>О книге</h4>
                        <hr>
                        <p id="description"><?php echo $content['description']?></p>
                    </div>
                </div>
                <div class="bookDescription col-xs-12 col-sm-12 col-md-12 hidden-md hidden-lg">
                    <h4>О книге</h4>
                    <hr>
                    <p class="description"><?php echo $content['description']?></p>
                </div>
            </div>
            <script src="../js/book.js" defer=""></script>
        </div>
    </div>
</section>