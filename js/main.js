// ハンバーガーボタン
jQuery(document).ready(function(){
  /* open */
  $('.header__icon').on('click',function(){
    $('.l_sidebar').css(
      'display','block'
    ).animate({
      left:'0'
    }, 
      300
    );
    $('.l_sidebar-bg').css(
      'display','block'
    ).animate({
      opacity:'0.5'
    },
      300
    )
  });

  /* close */
  $('.l_sidebar__icon').on('click',function(){
    $('.l_sidebar').animate({
      left:'-200px'
    },
      300
    );
    $('.l_sidebar-bg').animate({
      opacity:'0'
    },
      300
    );
    setTimeout(function(){
      $('.l_sidebar').css('display','none');
      $('.l_sidebar-bg').css('display','none');
    },
      300
    );
  });
});