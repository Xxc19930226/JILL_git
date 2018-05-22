var anchorflg = 0;
var zoom;
var scrollpx;

$(function(){
	
	$(window).on('scroll', function () {
		scrollpx = $(this).scrollTop(); //スクロール量観測
	});
	
	$('.main_bottom p:nth-child(1) img').click(function(){
		var anchorpoint = ($("#send").position().top + scrollpx - 50) * zoom;
		$('body,html').animate({
				scrollTop: anchorpoint
		}, 1000);
		return false;
	});
	
	$('.main_bottom p:nth-child(2) img').click(function(){
		anchorflg = -1;
		$('#slideOpen').show();
		var anchorpoint = ($("#request").position().top + scrollpx - 70) * zoom;
		$("#request").toggleClass('on');
		if($("#request").hasClass('on')){
			$("#request h2 img").attr('src', $('#request h2 img').attr('src').replace('_off', '_on'));
		}
		$('body,html').animate({
				scrollTop: anchorpoint
		}, 3000);
		return false;
	});
	
	$('#slideOpen').hide();
	
	var click_flg = true;
	$('#request h2 img').click(function(){
		if(click_flg){
			click_flg = false;
			$("#request").toggleClass('on');
			if($("#request").hasClass('on')){
				$("#request h2 img").attr('src', $('#request h2 img').attr('src').replace('_off', '_on'));
				$('#slideOpen').slideDown(3000, function(){click_flg = true;});
			}else if(!$("#request").hasClass('on')){
				anchorflg = 0;
				$("#request h2 img").attr('src', $("#request h2 img").attr('src').replace('_on', '_off'));
				$('#slideOpen').slideUp(500, function(){click_flg = true;});
			}
		}
	});
	
	$('.btn_top').click(function(){
		$('body,html').animate({
				scrollTop: 0
		}, 1000);
	});
	
	
	//zoom
	var portraitWidth,landscapeWidth;
	$(window).bind("resize", function(){
		if(Math.abs(window.orientation) === 0){
			if(/Android/.test(window.navigator.userAgent)){
				if(!portraitWidth)portraitWidth=$(window).width();
			}else{
				portraitWidth=$(window).width();
			}
			$("html").css("zoom" , portraitWidth/640);
			$("html").css("zoom" , $(window).width()/640);
			zoom = $(window).width()/640;
		}else{
			if(/Android/.test(window.navigator.userAgent)){
			if(!landscapeWidth)landscapeWidth=$(window).width();
			}else{
			landscapeWidth=$(window).width();
			}
			$("html").css("zoom" , landscapeWidth/640);
			$("html").css("zoom" , $(window).width()/640);
			zoom = $(window).width()/640;
		}
	}).trigger("resize");
});

window.onload = function(){
	$.fn.sliders = function(options){

        //fadeSlide フェードインアウト
        //leftSlide スライドでループは無し
        //leftSlideLoop スライドでループ
        //leftSlideAnimation 常にスライド・ループ
        //selectAnimation 次へ戻るボタンあり
        //moveOn 重なるスライド

        //デフォルト設定
        var defaults = {
            slideType : 'leftSlide',//上記スライドタイプ
            changeTime: 7000,//次のスライドまでの移動秒数
            showTime: 7000,//表示秒数
            allTime: 15000,//leftSlideAnimation用・全体にかける秒数
            animeType: 'swing'//leftSlide・leftSlideLoop・selectAnimation・moveOn用
        };

        var setting = $.extend(defaults,options);
        var slideChangeTime = setting.changeTime;
        var slideShowTime = setting.showTime;
        var slideAllTime = setting.allTime;
        var animationType = setting.animeType;

       	var slideWrap = this;
        var own = slideWrap.attr('id')
        var slideContent = slideWrap.find('ul');
        var slideList = slideContent.find('li');
        var slideWidth = slideList.find('img').width();
        var slideHeight = slideList.find('img').height();
        var slideNum  = slideList.length;

        //全体を囲む
        this.wrapInner('<div class="sliders"></div>');
        var slideWrapInner = slideWrap.children($('.sliders'));

        //ページャーの表示
        if(setting.slideType == 'leftSlideAnimation'){
        }else {
            slideWrapInner.after('<ul class="pager"></ul>');
            for (i = 1; i < slideNum + 1; i++) {
                var list = '<li><a href="#">' + i +'</a></li>';
                slideWrapInner.next('.pager').append(list);
            };
            $('.pager').each(function(index, el) {
                $(this).children('li:first').addClass('current');
            });
            var pager = slideWrapInner.next('.pager');
            var pagerList = slideWrapInner.next('.pager').find('li');
        }

        //それぞれ実行
        if (setting.slideType == 'fadeSlide'){
            fadeSlide();
        }


        ////////////////////////////////////////////////////

        //  fadeSlide

        ////////////////////////////////////////////////////
        function fadeSlide(){
            slideContent.css({
                'margin-right': 'auto',
                'margin-left': 'auto',
                'width': slideWidth,
                'height': slideHeight,
                'position': 'relative'
            });
            slideList.css({
               'position' : 'absolute',
               'top' : 0,
               'left' : 0
            }).hide();

            $(slideList).first().show().css('z-index','3');

            var currentIndex = 1;
            var index = 1;

            //スライド処理
            function goSlide(index){
                slideList.eq(index - 1).fadeIn(500).css('z-index','2');
                slideList.eq(currentIndex - 1).css('z-index','3').fadeOut(500);
                currentIndex = index;
                clickFlg = true;

                pagerList.removeClass('current');
                pagerList.eq(index - 1).addClass('current')
            };

            //クリック判定
            var clickFlg = true;
            pagerList.click(function() {
                if(clickFlg && currentIndex != $(this).index() + 1){
                    clickFlg = false;
                    index = $(this).index() + 1;
                    goSlide(index);
                    stop();
                    start();
                }
                return false;
            });

            function start(){
                own = setInterval(function() {
                        if(index >= slideNum){
                            index = 0;
                        }
                        index++;
                        goSlide(index);

                    }, slideShowTime);
            }

            function stop () {
               clearInterval(own);
            }

            start();
        }
    }
		
		$("#slide").sliders({
			slideType:'fadeSlide'
		});
		
		//スライダー
		$('.slider1').bind({
                 
				'touchstart': function(e) {
						this.touchX = event.changedTouches[0].pageX;
						this.slideX = $(this).position().left;
				},
		
				'touchmove': function(e) {
						e.preventDefault();
						this.slideX = this.slideX - (this.touchX -  event.changedTouches[0].pageX );
						$(this).css({left:this.slideX});
						this.accel = (event.changedTouches[0].pageX - this.touchX) * 5;
						this.touchX = event.changedTouches[0].pageX;
				},
		
				'touchend': function(e) {
						this.slideX += this.accel
						$(this).animate({left : this.slideX },100,'linear');
						this.accel = 0;
						
						w = - ( $(this).width() - $(this).parent(".step_four").width() );
						if (this.slideX > 0) {
							this.slideX = 0;
							$(this).animate({left:this.slideX},500);
						}
						if (this.slideX < w) {
							this.slideX = w;
							$(this).animate({left:this.slideX},500);
						}
				}
		});
		
		$('.slider2').bind({
                 
				'touchstart': function(e) {
						this.touchX = event.changedTouches[0].pageX;
						this.slideX = $(this).position().left;
				},
		
				'touchmove': function(e) {
						e.preventDefault();
						this.slideX = this.slideX - (this.touchX -  event.changedTouches[0].pageX );
						$(this).css({left:this.slideX});
						this.accel = (event.changedTouches[0].pageX - this.touchX) * 5;
						this.touchX = event.changedTouches[0].pageX;
				},
		
				'touchend': function(e) {
						this.slideX += this.accel
						$(this).animate({left : this.slideX },100,'linear');
						this.accel = 0;
						
						w = - ( $(this).width() - $(this).parent(".step_two").width() );
						if (this.slideX > 0) {
							this.slideX = 0;
							$(this).animate({left:this.slideX},500);
						}
						if (this.slideX < w) {
							this.slideX = w;
							$(this).animate({left:this.slideX},500);
						}
				}
		});
}