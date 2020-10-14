var pathname = $(location).attr('pathname');
var bookIdPosition = pathname.lastIndexOf('/') + 1;
var bookId = pathname.substring(bookIdPosition,pathname.length);


$('.btnBookID').click(function(event) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "/?click=" + bookId, true);
    xmlhttp.send();
        alert(
            "Книга свободна и ты можешь прийти за ней." +
            " Наш адрес: г. Кропивницкий, переулок Васильевский 10, 5 этаж." +
            " Лучше предварительно прозвонить и предупредить нас, чтоб " +
            " не попасть в неловкую ситуацию. Тел. 099 196 24 69"
        );
});
