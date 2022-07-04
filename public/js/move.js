//投稿フォームのカスタマイズ
$('input').on('change', function () {
    var file = $(this).prop('files')[0];
    $('.posts_filename').text(file.name);
});
// お気に入りボタン
$('.like_button').on('click',(event)=>{
    $(event.currentTarget).next().submit();
});

// ハンバーガーボタン
$(function(){
    $('.header_menu_btn').on('click', function(){
      $('.header_list').addClass('is_active');
    });
  }());
  $(function(){
    $('.header_menu_cansel_btn').on('click', function(){
      $('.header_list').removeClass('is_active');
    });
  }());
