$(function(){
	$('.accordeon_navi > ul > li > a').click(function(e){
		e.preventDefault();
		$('.accordeon_navi > ul > li').removeClass('clicked');
		$('.accordeon_navi > ul > li > ul').hide();
		if ($(this).parents('li').find('ul').length){
		    $(this).parents('li').toggleClass('clicked').find('ul').slideToggle();
		}
		/*
		else{
		  window.location.href=$(this).attr('href');
		}
		*/
	});
	/*
	$('.index_category_img').each(function(){
		$(this).css('backgroundImage','url('+$(this).find('img').attr('src')+')');
	});
	*/
	/*
	$('.accordeon_navi .current').each(function(){
		$(this).removeClass('current');
		if($(this).find('ul').length){
			$(this).addClass('clicked');
		}
	});
	*/
	$('.accordeon_navi .current').each(function(){
		$(this).removeClass('current');
		$('a', this).click();
	});

})
