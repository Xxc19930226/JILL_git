/* for FASHION SHOWS */

$(document).ready(function(){

	var $handler = $('.photo');
	$handler.wookmark({
		autoResize: true,
		container: $('.photo_list'),
		outerOffset: 0,
		offset: 20,
		itemWidth: 220
	});

	$("img.lazy").unveil(200, function() {
		$(this).load(function() {
    		this.style.opacity = 1;
    		$handler.wookmark();
		});
	});

	var season = false;
	$('.season_navi').click( function() {
		if(!season) {
			season = true;
			$(this).find('.season_list').not(':animated').slideToggle();
			$(this).css('background-image', 'url("/common/images/general/icon_up.png")');
		}
		else {
			season = false;
			$(this).find('.season_list').slideToggle('fast');
			$(this).css('background-image', 'url("/common/images/general/icon_down.png")');
		}
	});

	var theme = false;
	$('.season_theme').click( function() {
		if(!theme) {
			theme = true;
			$('.season_theme_contents').not(':animated').slideToggle();
		}
	});
	$('.season_theme_close').click( function() {
		if(theme) {
			theme = false;
			$('.season_theme_contents').slideToggle('fast');
		}
	});

});