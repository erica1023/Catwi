jQuery(function ($) {
  // ログアウト
  $('a#logout').click(function (event) {
    return confirm("ログアウトしますか？");
  });

  // フェードイン
  $('body')
    .css({display: 'None'})
    .fadeIn(500)

  // フェードアウト
  $('body').removeClass('fadeout');
  $('#menu a').on('click', function(e){
    e.preventDefault();
    url = $(this).attr('href');
    if (url !== '') {
      $('body').addClass('fadeout');
      setTimeout(function(){
        window.location = url;
      }, 500);
    }
    return false;
  });
});
