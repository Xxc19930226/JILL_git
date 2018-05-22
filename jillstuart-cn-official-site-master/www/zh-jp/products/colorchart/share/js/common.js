

/* 
---------------------------------------------------------------------------------------------------- */
function specialBirthStone(){
x = screen.width;
y = screen.height;
window.open('/products/nails/special/index.html','top', 'width='+ x +',height='+ y +',top=0,left=0,scrollbar=no, toolbar=no,status=no,resizable=no,location=no');
}
function specialFragrance(){
window.open('/special/08_fragrance/index.html', '_Pop', 'directories=no,location=no,menubar=no,scrollbars=no,status=no,resizable=no,width=850,height=550')
}
function specialFragranceEn(){
window.open('/en-jp/special/08_fragrance/index.html', '_Pop', 'directories=no,location=no,menubar=no,scrollbars=no,status=no,resizable=no,width=850,height=550')
}

function special(url){
x = screen.width;
y = screen.height;
window.open(url,'top', 'width='+ x +',height='+ y +',top=0,left=0,scrollbar=no, toolbar=no,status=no,resizable=no,location=no');
}


/* opwin
---------------------------------------------------------------------------------------------------- */
function opwin(url, width, height,trg){
if (!!window && url) {
if (!trg) trg = "_blank";
options = "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,favorites=no";
var whop = "width="+width+",height="+height+","+options;
win = window.open(url, trg, whop);
win.focus();
}
}

function opwin_c(url, trg, w, h, scroll) {
var win_width = (screen.width - w) / 2;
var win_height = (screen.height - h) / 2;
win_detail = 'height='+h+',width='+w+',top='+win_height+',left='+win_width+',scrollbars='+scroll;
win = window.open(url, trg, win_detail)
 if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}


/* disp
---------------------------------------------------------------------------------------------------- */
function disp(url){
	if(!window.opener || window.opener.closed){
	}else{
		window.opener.location.href = url;
		window.opener.location.reload();
	}
}