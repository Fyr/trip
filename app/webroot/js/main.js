$(function(){
      $('.accordeon_navi > ul > li > a').click(function(e){
        e.preventDefault();
        if ($(this).parents('li').find('ul').length){
            $(this).parents('li').toggleClass('clicked').find('ul').slideToggle();
        }
        /*
        else{
          window.location.href=$(this).attr('href');
        }
        */
      })

      $('.index_category_img').each(function(){
        $(this).css('backgroundImage','url('+$(this).find('img').attr('src')+')');
      })

      $('.accordeon_navi .current').each(function(){
        if($(this).find('ul').length){
          $(this).addClass('clicked');
        }
      })

})
