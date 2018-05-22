/* for TOP */

$(document).ready(function(){

//	$("img.lazy").unveil({effect:'fadeIn',effectspeed:500,threshold:250});
	var $article_box_handler = $('.article_box');
	setTimeout( function(){
		$("img.lazy").unveil(200, function() {
			$(this).load(function() {
	    		this.style.opacity = 1;
	    		$article_box_handler.wookmark();
			});
		});
	}, 500);

	if(!is_smartphone()) {
/*	$('.visual_flip').imagesLoaded(function() {*/
		$('.visual_flip').slick({
			autoplay:true,
			autoplaySpeed:5000,
			centerMode:true,
			centerPadding:'0',
			dots:true,
			fade:true,
			speed:800,
			cssEase:'ease-in-out'
		});
/*	});*/
	}
	else {
		$('.visual_flip').slick({
			autoplay:true,
			autoplaySpeed:5000,
			centerMode:true,
			centerPadding:'0',
			dots:true,
			fade:false,
			speed:300
		});
	}


	setTimeout( function(){
		$('.visual_flip').animate({ opacity:'1' });
	}, 500);

	$('.main_inner').css({ opacity:'1' });

	if(!is_smartphone()) {
		$article_box_handler.wookmark({
			autoResize: true,
			container: $('.article_box_area'),
			outerOffset: 0,
			offset: 17,
			itemWidth: 302
		});
	}


	/* TOP HEADER BANNER ちらみせ */
	if(!is_smartphone()) {
		setTimeout( function(){
			pc_topbanner_oc(false);
		}, 1000);
		setTimeout( function(){
			pc_topbanner_oc(true);
		}, 6000);
	}
	else {
		setTimeout( function(){
			smp_topbanner_oc(false);
		}, 1000);
		setTimeout( function(){
			smp_topbanner_oc(true);
		}, 4000);
	}


	/* for TOP EFFECTS hover */
	if(!is_smartphone()) {
		$('.normal, .social, .pickupitem').hover(
			function() {
				var h = $(this).find('.thumbnail').height();;
				var w = $(this).find('.thumbnail').width();;
				var t = (h / 2) - ($(this).find('.icon').outerHeight() / 2);
				var l = (w / 2) - ($(this).find('.icon').outerWidth() / 2);
				$(this).find('.cover').css('height', h);
				$(this).find('.cover').css('width', w);
/*				$(this).find('.photo').css('height', h);
				$(this).find('.photo').css('width', w);*/
				$(this).find('.icon').css('margin-top', t);
				$(this).find('.icon').css('margin-left', l);
				$(this).find('.cover').not(":animated").animate({ opacity:'0.4' });
				$(this).find('.icon').not(":animated").animate({ opacity:'1' });
			},
			function() {
				$(this).find('.cover').animate({ opacity:'0' });
				$(this).find('.icon').animate({ opacity:'0' });
			}
		);
	}

	/* for TOP EFFECTS pop */
	if(!is_smartphone()) {
		$('.pop').hover(
			function() {
				var winw = $('.article_box_area').width();
				var bounds = $(this).offset();
				var x = bounds.left;
				if(winw - (x+302) > 320) {
					$(this).find('.popbox').css('left', function() { return 302;});
					$(this).find('.popbox').css('top','-1px');
				}
				else
				if(x > 320) {
					$(this).find('.popbox').css('left', function() { return -322;});
					$(this).find('.popbox').css('top','-1px');
				}
				else {
				}

				$(this).css('z-index', '200');
				$(this).find('.popbox').not(":animated").animate({ height:'show' });
			},
			function() {
				$(this).find('.popbox').animate({ height:'hide' });
				$(this).css('z-index', '1');
			}
		);
	}

	/* for Faceboox Ajax */
	function readFB() {
	    var fb_xhr = window.XDomainRequest ? new XDomainRequest : new XMLHttpRequest;
		try {
  		    fb_xhr.onload = function() {
		        var fb_data = JSON.parse(fb_xhr.responseText);
		        $('.social.facebook .photo img').attr('src', fb_data.data[0].picture);
		        var fb_date = new Date(fb_data.data[0].created_time);
		        $('.social.facebook .date').text(fb_date.getFullYear() + '.' + (fb_date.getMonth()+1) + '.' + fb_date.getDate() + '  posted on FACEBOOK');
		        $('.social.facebook .title').text(fb_data.data[0].message.substring(0,100) + '...');
		    };
		} catch (e) { alert(e.message); }
	    fb_xhr.open("get", "/fb.php");
	    fb_xhr.send(null);
	}
	readFB();

	/* for Instagram Ajax */
	function readIG() {
	    var ig_xhr = window.XDomainRequest ? new XDomainRequest : new XMLHttpRequest;
	    try {
		    ig_xhr.onload = function() {
		        var ig_data = JSON.parse(ig_xhr.responseText);
		        $('.social.instagram a').attr('href', ig_data.data[0].link);
		        $('.social.instagram a').attr('onclick', 'trackOutboundLink(\‘' + ig_data.data[0].link + '\'); return false;');
		        $('.social.instagram .photo img').attr('src', ig_data.data[0].images.standard_resolution.url);
		        var ig_date = new Date(parseInt(ig_data.data[0].caption.created_time + '000'));
		        $('.social.instagram .date').text(ig_date.getFullYear() + '.' + (ig_date.getMonth()+1) + '.' + ig_date.getDate() + '  posted on INSTAGRAM');
		    };
		} catch (e) { alert(e.message); }
	    ig_xhr.open("get", "/ig.php");
	    ig_xhr.send(null);
	}
	readIG();

	function createXMLHttpRequest() {
		var XMLhttpObject = null;
		XMLhttpObject = new XMLHttpRequest();
		return XMLhttpObject;
	}
});


