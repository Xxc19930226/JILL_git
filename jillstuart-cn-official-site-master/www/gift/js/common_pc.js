var anchorflg = 0;

$(function() {
	
	var alertText = "クリップボードにコピーが完了しました。\nこのままメールやSNSに貼り付けてください。"
	
	//zeroclip 2.3.0
	var btn1 = document.getElementById("btn_copy_url1");
	var btn2 = document.getElementById("btn_copy_url2");
	var btn3 = document.getElementById("btn_copy_url3");
	var btn4 = document.getElementById("btn_copy_url4");
	var btn5 = document.getElementById("btn_copy_url5");
	
	var text1 = document.getElementById("copy_text1");
	var text2 = document.getElementById("copy_text2");
	var text3 = document.getElementById("copy_text3");
	var text4 = document.getElementById("copy_text4");
	var text5 = document.getElementById("copy_text5");
	
	var clip1 = new ZeroClipboard(btn1);
	clip1.on("ready beforecopy", function() {
		btn1.dataset.clipboardText = text1.value;
		text1.select();
	});
	clip1.on("aftercopy", function() {
		alert(alertText);
	});
	var clip2 = new ZeroClipboard(btn2);
	clip2.on("ready beforecopy", function() {
		btn2.dataset.clipboardText = text2.value;
		text2.select();
	});
	clip2.on("aftercopy", function() {
		alert(alertText);
	});
	var clip3 = new ZeroClipboard(btn3);
	clip3.on("ready beforecopy", function() {
		btn3.dataset.clipboardText = text3.value;
		text3.select();
	});
	clip3.on("aftercopy", function() {
		alert(alertText);
	});
	var clip4 = new ZeroClipboard(btn4);
	clip4.on("ready beforecopy", function() {
		btn4.dataset.clipboardText = text4.value;
		text4.select();
	});
	clip4.on("aftercopy", function() {
		alert(alertText);
	});
	var clip5 = new ZeroClipboard(btn5);
	clip5.on("ready beforecopy", function() {
		btn5.dataset.clipboardText = text5.value;
		text5.select();
	});
	clip5.on("aftercopy", function() {
		alert(alertText);
	});
	
	//zeroclip 1.3.5
	/*var btn1 = new ZeroClipboard($("#btn_copy_url1"));
	var btn2 = new ZeroClipboard($("#btn_copy_url2"));
	var btn3 = new ZeroClipboard($("#btn_copy_url3"));
	var btn4 = new ZeroClipboard($("#btn_copy_url4"));
	var btn5 = new ZeroClipboard($("#btn_copy_url5"));
	
	var text1 = $("#copy_text1");
	var text2 = $("#copy_text2");
	var text3 = $("#copy_text3");
	var text4 = $("#copy_text4");
	var text5 = $("#copy_text5");
	
	btn1.on( "complete", function( event ) {
		text1.select();
		alert(alertText);
	});
	btn2.on( "complete", function( event ) {
		text2.select();
		alert(alertText);
	});
	btn3.on( "complete", function( event ) {
		text3.select();
		alert(alertText);
	});
	btn4.on( "complete", function( event ) {
		text4.select();
		alert(alertText);
	});
	btn5.on( "complete", function( event ) {
		text5.select();
		alert(alertText);
	});*/
	
	//zeroclip 1.1.1
	/*var clipfn = function(){
		$("#btn_copy_url1").zclip({
			path: "./js/ZeroClipboard.swf",
			copy: $("#copy_text1").val(),
			afterCopy: function(){
					$("#copy_text1").select();
					alert(alertText);
			}
		});
		$("#btn_copy_url2").zclip({
			path: "./js/ZeroClipboard.swf",
			copy: $("#copy_text2").val(),
			afterCopy: function(){
					$("#copy_text2").select();
					alert(alertText);
			}
		});
		$("#btn_copy_url3").zclip({
			path: "./js/ZeroClipboard.swf",
			copy: $("#copy_text3").val(),
			afterCopy: function(){
					$("#copy_text3").select();
					alert(alertText);
			}
		});
		$("#btn_copy_url4").zclip({
			path: "./js/ZeroClipboard.swf",
			copy: $("#copy_text4").val(),
			afterCopy: function(){
					$("#copy_text4").select();
					alert(alertText);
			}
		});
		$("#btn_copy_url5").zclip({
			path: "./js/ZeroClipboard.swf",
			copy: $("#copy_text5").val(),
			afterCopy: function(){
					$("#copy_text5").select();
					alert(alertText);
			}
		});
	}*/
	
	$(window).on('scroll', function () {
		var scrollpx = $(this).scrollTop(); //スクロール量観測
	});
	
	$('.main_bottom p:nth-child(1) img').click(function(){
		var anchorpoint = $("#send").position().top;
		$('body,html').animate({
				scrollTop: anchorpoint
		}, 1000);
		return false;
	});
	
	$('.main_bottom p:nth-child(2) a').click(function(){
		anchorflg = -1;
		var anchorpoint = $("#request").position().top;
		$("#request").toggleClass('on');
		if($("#request").hasClass('on')){
			$("#request img").attr('src', $('#request img').attr('src').replace('_off', '_on'));
		}
		$('body,html').animate({
				scrollTop: anchorpoint
		}, 1000, "swing", function(){
			$('#slideOpen').slideDown(3000);
			//clipfn();
		});
		return false;
	});
	
	$('#slideOpen').hide();
	
	var click_flg = true;
	$('#request').click(function(){
		if(click_flg){
			click_flg = false;
			$("#request").toggleClass('on');
			if($("#request").hasClass('on')){
				$("#request img").attr('src', $('#request img').attr('src').replace('_off', '_on'));
				$('#slideOpen').slideDown(3000, function(){click_flg = true;});
				//clipfn();
			}else if(!$("#request").hasClass('on')){
				anchorflg = 0;
				$("#request img").attr('src', $("#request img").attr('src').replace('_on', '_off'));
				$('#slideOpen').slideUp(1000, function(){click_flg = true;});
			}
		}
	});

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
            showTime: 10000,//表示秒数
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
        if(setting.slideType == 'leftSlide'){
            leftSlide();
        }
        if (setting.slideType == 'leftSlideLoop'){
            leftSlideLoop();
        }
        if(setting.slideType == 'leftSlideAnimation'){
            leftSlideAnimation();
        }
        if(setting.slideType == 'selectAnimation'){
            selectAnimation();
        }
        if(setting.slideType == 'moveOn'){
            moveOn();
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
});