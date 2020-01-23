// ハンバーガーボタン
jQuery(document).ready(function(){
  /* open */
  $('.header__icon').on('click',function(){
    $('.l-sidebar').css('display','block').animate({
      left:'0'
    }, 
      300
    );
    $('.l-sidebar-bg').css('display','block').animate({
      opacity:'0.5'
    },
      300
    )
  });

  /* close */
  $('.l-sidebar__icon').on('click',function(){
    $('.l-sidebar').animate({
      left:'-200px'
    },
      300
    );
    $('.l-sidebar-bg').animate({
      opacity:'0'
    },
      300
    );
    setTimeout(function(){
      $('.l-sidebar').css('display','none');
      $('.l-sidebar-bg').css('display','none');
    },
      300
    );
  });
});