
<script>
$(document).ready(function(){
	if(!is_smartphone()) {

		$('#fullpage_article_<? echo $w_news->id; ?>').click(function(){
			var scroll_top = $(window).scrollTop() ;
			$.ajax({
				url: "<? echo $w_news->fullpage->url; ?>",
				dataType: "html",
				cache: false,
				success: function(data, textStatus){
					var h_height = $('html').height();
					var b_height = $('body').height();
					var h_width  = $('html').width();
					var b_width  = $('body').width();
					$('#fullpage_html_area_<? echo $w_news->id; ?>').html(data);
					$('#fullpage_html_area_<? echo $w_news->id; ?>').css('opacity','0');
					$('#fullpage_html_area_<? echo $w_news->id; ?> .fullpage').fullpage({
						'verticalCentered': false,
						'resize' : true,
						'css3': true,
						'navigation': true,
						'navigationPosition': 'right',
						'anchors': ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'],
						'scrollOverflow': true,
						'easing':'swing',
				        onLeave: function(index, nextIndex, direction){<? echo $w_news->fullpage->onLeave; ?>},
				        afterLoad: function(anchorLink, index){<? echo $w_news->fullpage->afterLoad; ?>},
				        afterRender: function(){<? echo $w_news->fullpage->afterRender; ?>},
				        afterResize: function(){<? echo $w_news->fullpage->afterResize; ?>},
				        afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex){<? echo $w_news->fullpage->afterSlideLoad; ?>},
				        onSlideLeave: function(anchorLink, index, slideIndex, direction){<? echo $w_news->fullpage->onSlideLeave; ?>}
					});
					$('html').css('height', function(){return window.innerHeight ? window.innerHeight: $(window).height();});
					$('body').css('height', function(){return window.innerHeight ? window.innerHeight: $(window).height();});
					$('html').css('width',function(){return window.innerWidth ? window.innerWidth: $(window).width();});
					$('body').css('width',function(){return window.innerWidth ? window.innerWidth: $(window).width();});
					$(window).scrollTop(scroll_top);
					$('.section').css('height', function(){return window.innerHeight ? window.innerHeight: $(window).height();})
					$('<div id="fullpage_html_area_<? echo $w_news->id; ?>_close" class="html_area_close"></div>').appendTo('#fullpage_html_area_<? echo $w_news->id; ?>');
					$('<div id="fullpage_html_area_<? echo $w_news->id; ?>_down" class="html_area_down"></div>').appendTo('#fullpage_html_area_<? echo $w_news->id; ?> #section1');
					setTimeout( function(){
						init_fullpage_html_area_<? echo $w_news->id; ?>();
						$('#fullpage_html_area_<? echo $w_news->id; ?>').animate({ opacity:'1' });
					}, 300);


				    $('#fullpage_html_area_<? echo $w_news->id; ?>_close').click(function() {
						$.fn.fullpage.destroy('all');
						$('html').removeAttr('style');
						$('body').removeAttr('style');
						$('html').css('height', 'auto');
						$('body').css('height', 'auto');
						$('html').css('width', 'auto');
						$('body').css('width', 'auto');
				    	$(window).scrollTop(scroll_top);
						$('#fullpage_html_area_<? echo $w_news->id; ?> .fullpage').remove();
						$('#fullpage_html_area_<? echo $w_news->id; ?> .html_area_close').remove();
		    		});
				},
				error: function(xhr, textStatus, errorThrown){
				}
			});

		});
	}
	else {
		$('#fullpage_article_<? echo $w_news->id; ?>').click(function(){
			if($('#fullpage_html_area_<? echo $w_news->id; ?> .fullpage').size() <= 0){
				$.ajax({
					url: "<? echo $w_news->fullpage->urlsmp; ?>",
					dataType: "html",
					cache: false,
					success: function(data, textStatus){
						$('#fullpage_html_area_<? echo $w_news->id; ?>').html(data);
						$('<div id="fullpage_html_area_<? echo $w_news->id; ?>_close" class="html_area_close"></div>').appendTo('#fullpage_html_area_<? echo $w_news->id; ?>');
						$('#fullpage_html_area_<? echo $w_news->id; ?>_close').css('top',$('#fullpage_html_area_<? echo $w_news->id; ?>').offset().top+20);

						$('#fullpage_html_area_<? echo $w_news->id; ?>').not(':animated').slideToggle();
						var position = $('#fullpage_html_area_<? echo $w_news->id; ?>').offset().top-150;
     					$('body,html').animate({scrollTop:position}, 1000, 'swing');

						$(window).scroll(function () {
							var html_top = $('#fullpage_html_area_<? echo $w_news->id; ?>').offset().top+20;
							var html_bottom = $('#fullpage_html_area_<? echo $w_news->id; ?>').offset().top+20
							 + $('#fullpage_html_area_<? echo $w_news->id; ?>').height();
							var win_top = $(this).scrollTop();
							if(html_top < win_top && html_bottom > win_top) {
								$('#fullpage_html_area_<? echo $w_news->id; ?>_close').css('top','20px');
							}
							else {
								$('#fullpage_html_area_<? echo $w_news->id; ?>_close').css('top',html_top-win_top);
							}

						});

				    	$('#fullpage_html_area_<? echo $w_news->id; ?>_close').click(function() {
							$('#fullpage_html_area_<? echo $w_news->id; ?>').not(':animated').slideToggle();
							var position = $('#fullpage_html_area_<? echo $w_news->id; ?>').offset().top-150;
	     					$('body,html').animate({scrollTop:position}, 1000, 'swing');
				        });
				        $('#fullpage_article_<? echo $w_news->id; ?>').click(function() {
							$('#fullpage_html_area_<? echo $w_news->id; ?>').not(':animated').slideToggle();
							var position = $('#fullpage_html_area_<? echo $w_news->id; ?>').offset().top-150;
	     					$('body,html').animate({scrollTop:position}, 1000, 'swing');
			    		});
					},
					error: function(xhr, textStatus, errorThrown){
					}
				});
			}
		});
	}
});
</script>
			<div id="fullpage_article_<? echo $w_news->id; ?>" class="fullpage_article">
<? 				include($_SERVER['DOCUMENT_ROOT']."/common/news/includes/type_standard.php"); ?>
			</div>

			<div id="fullpage_html_area_<? echo $w_news->id; ?>" class="fullpage_html_area"></div>
