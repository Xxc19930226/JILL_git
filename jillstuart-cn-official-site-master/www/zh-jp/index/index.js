
$(document).ready(function(){
    $('#container .background').imagesLoaded(function() {
        setSize();
        $('#container .background').fadeIn(500)
    });

    $(window).resize(function(){
       setSize();
    });

	/* when across threshold, to reload */
	var resize_timer = false;
	var widewin = false;
	if(!is_smartphone()) {
		widewin = true;
	}
	$(window).resize(function() {
		if (resize_timer !== false) {
			clearTimeout(resize_timer);
		}
		resize_timer = setTimeout(function() {
			if(!is_smartphone() && !widewin ) {
				location.reload();
				widewin = true;
			}
			else
			if(is_smartphone() && widewin ) {
				location.reload();
				widewin = false;
			}
		}, 200);
	});
});

function setSize() {

    var img = new Image();
    img.src = $('#container .background').attr('src');
    var imgW = img.width;
    var imgH = img.height;

    var winW = $(window).width();
    var winH = $(window).height();
    var scaleW = winW / imgW;
    var scaleH = winH / imgH;
    var fixScale = Math.max(scaleW, scaleH);
    var setW = imgW * fixScale;
    var setH = imgH * fixScale;
    var moveX = Math.floor((winW - setW) / 2);
    var moveY = Math.floor((winH - setH) / 2);

    $('#container .background').css({
        'width': setW,
        'height': setH,
        'left' : moveX,
        'top' : moveY
    });
}
