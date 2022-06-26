//投稿フォームのカスタマイズ
$('input').on('change', function () {
    var file = $(this).prop('files')[0];
    $('.posts_filename').text(file.name);
});
// お気に入りボタン

$('.like_button').on('click',(event)=>{
    $(event.currentTarget).next().submit();
});
