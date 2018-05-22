/*

	is_smartphone

*/
function is_smartphone () {
	var userAgent = window.navigator.userAgent.toLowerCase();
/*	if((navigator.userAgent.indexOf('Android') > 0 && navigator.userAgent.indexOf('Mobile') == -1)
	|| navigator.userAgent.indexOf('A1_07') > 0
	|| navigator.userAgent.indexOf('SC-01C') > 0
	|| navigator.userAgent.indexOf('iPad') > 0){
		return false;
	}
	else*/
	if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf('iPad') == -1)
	|| navigator.userAgent.indexOf('iPod') > 0
	|| navigator.userAgent.indexOf('IEMobile') > 0
	|| (navigator.userAgent.indexOf('Android') > 0 && navigator.userAgent.indexOf('Mobile') > 0)){
		return true;
	}
	else
	if($(window).width() <= 767) {
			return true;
	}
	return false;
}

$(document).ready(function(){
	if(is_smartphone()) {
		$('body').addClass('smartphone');
	}
	else {
		$('body').removeClass('smartphone');
	}

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