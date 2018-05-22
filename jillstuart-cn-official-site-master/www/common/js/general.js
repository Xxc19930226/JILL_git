/*

	General

*/
var pc_topbanner_stt = false;
var smp_menu_stt = false;
var smp_topbanner_stt = false;

function pc_topbanner_oc(flag) {
	if(!flag) {
		$('.hide_banner_show').css('background-image', 'url(/common/images/general/icon_up.png)');
		$('.hide_banner_show').text('CLOSE');
		pc_topbanner_stt = true;
		$('.hide_banner').not(":animated").animate({ height:'show' });
	}
	else {
		$('.hide_banner').animate({ height:'hide' });
		$('.hide_banner_show').css('background-image', 'url(/common/images/general/icon_down.png)');
		$('.hide_banner_show').text('CHECK');
		pc_topbanner_stt = false;
	}
}

function smp_menu_oc(flag) {
	if(!flag) {
		$('.button_area .button_menu').css('background-image', 'url(/common/images/general/smp/button_close.png)');
		$('.button_area .button_menu').css('background-color', '#fae5e1');
		$('.button_area .button_menu').text('CLOSE');
		smp_menu_stt = true;
		$('.gnavi').not(":animated").animate({ height:'show' });
	}
	else {
		$('.gnavi').animate({ height:'hide' });
		$('.button_area .button_menu').css('background-image', 'url(/common/images/general/smp/button_menu.png)');
		$('.button_area .button_menu').css('background-color', '#fff');
		$('.button_area .button_menu').text('MENU');
		smp_menu_stt = false;
	}
}

function smp_topbanner_oc(flag) {
	if(!flag) {
		$('.button_area .button_banner').css('background-image', 'url(/common/images/general/smp/button_close.png)');
		$('.button_area .button_banner').css('background-color', '#eee');
		$('.button_area .button_banner').text('CLOSE');
		smp_topbanner_stt = true;
		$('.hide_banner').not(':animated').animate({ height:'show' });
	}
	else {
		$('.hide_banner').animate({ height:'hide' });
		$('.button_area .button_banner').css('background-image', 'url(/common/images/general/smp/button_banner.png)');
		$('.button_area .button_banner').css('background-color', '#fff');
		$('.button_area .button_banner').text('CHECK');
		smp_topbanner_stt = false;
	}
}

function popup_win(url,windowname,width,height) {
	var features="location=no, menubar=no, status=yes, scrollbars=yes, resizable=yes, toolbar=no";
	if (width) {
		if (window.screen.width > width)
			features+=", left="+(window.screen.width-width)/2;
		else width=window.screen.width;
			features+=", width="+width;
	}
	if (height) {
		if (window.screen.height > height)
			features+=", top="+(window.screen.height-height)/2;
		else height=window.screen.height;
			features+=", height="+height;
	}
	window.open(url,windowname,features);
}

var naviProductFlag = false;
function gnavi_open (fixgnavi) {
	naviProductFlag = true;
	if(!fixgnavi) {
		$('.gnavi.static .product .gnavi_product').animate({ height:'show' });
		$('.gnavi.static .close').not(":animated").fadeIn(500);
	}
	else {
		$('.gnavi.fixed .product .gnavi_product').animate({ height:'show' });
		$('.gnavi.fixed .close').not(":animated").fadeIn(500);
	}
}

function gnavi_close (fixgnavi) {
	naviProductFlag = false;
//	if(!fixgnavi) {
		$('.gnavi.static .product .gnavi_product').animate({ height:'hide' });
		$('.gnavi.static .close').css('display','none');
//	}
//	else {
		$('.gnavi.fixed .product .gnavi_product').animate({ height:'hide' });
		$('.gnavi.fixed .close').css('display','none');
//	}
}

function setTicker(){
	var $this = $('.top_message'),
			timer = null,
			delay = 4000,
			index = 0,
			next = 0,
			$li = $('li', $this),
			total = $li.length,
			containerW = $('.top_message_text', $this).width();

	$('li:first', $this).show();
	if(total > 1) init();

	function init(){
		var $current, $next;

		next = (index + 1) < total ? index + 1 : 0;
		$current = $li.eq(index);
		$next = $li.eq(next);

		if(containerW < $current.width()){
			move($current, function(){
				change($current, $next);
			});
		} else {
			change($current, $next);
		}
	}

	function change($current, $next){
		var timer = setTimeout(function(){
			$current.fadeTo('fast', 0, function(){
				$current.hide();
				$next.css({'left':0}).fadeTo('slow', 1, function(){
					index = next;
					init();
				});
			});
		}, 4000);
	}

	function move($elem, callback){
		var left, moveTimer,
				moveDelay = 500;
		if(containerW < $elem.width()){
			left = -($elem.width() - containerW);
			moveTimer = setTimeout(function(){
				clearTimeout(moveTimer);
				$elem.stop().animate({'left': left}, 25*(-left), 'linear', function(){
					if(callback) callback();
				});
			}, moveDelay);
		} else {
			if(callback) callback();
		}
	}
}


$(document).ready(function(){

//	document.getElementById('googlewebfont').rel = 'stylesheet';
	setTicker();

	if(!is_smartphone()) {

		/* Open/Close PRODUCT MENU */
		var fixgnavi = false;
		var gnaviOpenTimeout;
		var gnaviCloseTimeout;
		$('.gnavi .product').hover(
			function() {
				clearTimeout($(this).data('gnaviOpenTimeout'));
				clearTimeout($(this).data('gnaviCloseTimeout'));
				if( naviProductFlag ) {
					gnavi_open(fixgnavi);
				}
				else {
					gnaviOpenTimeout = setTimeout(function() { gnavi_open(fixgnavi); },300);
					$(this).data('gnaviOpenTimeout', gnaviOpenTimeout);
				}
				naviProductFlag = true;
			},
			function() {
				clearTimeout($(this).data('gnaviOpenTimeout'));
				clearTimeout($(this).data('gnaviCloseTimeout'));
//				if( !naviProductFlag ) {
//					gnavi_close(fixgnavi);
//				}
//				else {
					gnaviCloseTimeout = setTimeout(function() { gnavi_close(fixgnavi); } ,500);
					$(this).data('gnaviCloseTimeout', gnaviCloseTimeout);
//				}
			}
		);

		$('.gnavi .close').click(
			function() {
				$(this).css('display','none');
				$('.gnavi .product .gnavi_product').animate({ height:'hide' },'fast');
				naviProductFlag = false;
			}
		);

		/* Open / Close HEADER TOP BANNER */
		$('.hide_banner_show').click(
			function() {
				pc_topbanner_oc(pc_topbanner_stt);
			}
		);


		/* GLOBAL NAVI FIXED */
		$('<div class="fixed_navi"></div>').appendTo('.header_inner');
		var fnavi = $('.fixed_navi');
		fnavi.css('display','none');

		var gnavi = $('.header_inner .gnavi');
		gnavi.clone(true).appendTo('header .fixed_navi');
		var fgnavi = $('.fixed_navi .gnavi');
		gnavi.addClass('static');
		fgnavi.addClass('fixed');
		fgnavi.find('.snavi').css('display','none');
		fgnavi.find('.snavi').remove();

		$(window).scroll(function () {
			var gnaviTop = gnavi.offset().top;
			var fnaviTop = fgnavi.offset().top;
			var winTop = $(this).scrollTop();
			if(gnaviTop > fnaviTop) {
				fnavi.css('display', 'none');
				fixgnavi = false;
				gnavi.find('.gnavi_product').css('display', 'none');
				fnavi.find('.gnavi_product').css('display', 'none');
			}
			else
			if (winTop >= gnaviTop + 100 && !fixgnavi) {
				fnavi.not(":animated").fadeIn(500, function(){
					fixgnavi = true;
					gnavi.find('.gnavi_product').css('display', 'none');
					fnavi.find('.gnavi_product').css('display', 'none');
				});
			}
			else
			if (winTop <= gnaviTop+200 && fixgnavi) {
				fnavi.not(":animated").fadeOut(100,  function(){
					fixgnavi = false;
					gnavi.find('.gnavi_product').css('display', 'none');
					fnavi.find('.gnavi_product').css('display', 'none');
				});
			}

		});

		/* Open/Close LOCAL MENU */
		var locale = false;
		$('.locale .button').click( function() {
			if(!locale) {
				locale = true;
				$('.locale_list').not(':animated').slideToggle();
				$(this).css('background-image', 'url("/common/images/general/icon_up_s.png")');
			}
			else {
				locale = false;
				$('.locale_list').slideToggle('fast');
				$(this).css('background-image', 'url("/common/images/general/icon_down_s.png")');
			}
		});
	}
	else {

		/* Open/Close GLOBAL NAVI */
		$('.button_area .button_menu').click(
			function() {
				if(!smp_menu_stt && smp_topbanner_stt) {
					smp_topbanner_oc(true);
				}
				smp_menu_oc(smp_menu_stt);
			}
		);

		/* Open/Close HEAEDER TOP BANNER */
		$('.button_area .button_banner').click(
			function() {
				if(!smp_topbanner_stt && smp_menu_stt) {
					smp_menu_oc(true);
				}
				smp_topbanner_oc(smp_topbanner_stt);
			}
		);

		/* Open/Close LOCAL MENU */
		var locale = false;
		$('.locale .button').click( function() {
			if(!locale) {
				locale = true;
				$('.locale_list').not(':animated').slideToggle();
				$(this).css('background-image', 'url("/common/images/general/icon_up.png")');
			}
			else {
				locale = false;
				$('.locale_list').slideToggle('fast');
				$(this).css('background-image', 'url("/common/images/general/icon_down.png")');
			}
		});

		/* for SMP LINK */
		$('a.moresmp').click(
			function() {
				var smphref = $(this).attr('smphref');
				window.location.href = smphref;
				return false;
			}
		);
	}

	var category = false;
	$('.category_navi .current').click( function() {
		if(!category) {
			category = true;
			$('.category_navi .category_list').not(':animated').slideToggle();
			$(this).css('background-image', 'url("/common/images/general/icon_up.png")');
		}
		else {
			category = false;
			$('.category_navi .category_list').slideToggle('fast');
			$(this).css('background-image', 'url("/common/images/general/icon_down.png")');
		}
	});

	$('a[href^=#]').click(function() {
      var speed = 700;
      var href= $(this).attr("href");
      var target = $(href == "#" || href == "" ? 'html' : href);
      var position = target.offset().top;
      $('body,html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });

});

var trackOutboundLink = function(url) {
	ga('send', 'event', 'outbound', 'click', url, {'hitCallback':
		function () {
			document.location = url;
		}
	});
}
