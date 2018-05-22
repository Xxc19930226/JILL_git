$(document).ready(function(){
	$("img.lazy").unveil(200, function() {
		$(this).load(function() {
    		this.style.opacity = 1;
		});
	});

	/* for Faceboox Ajax */
	function readFB() {
	    var fb_xhr = window.XDomainRequest ? new XDomainRequest : new XMLHttpRequest;
		try {
  		    fb_xhr.onload = function() {
		        var fb_data = JSON.parse(fb_xhr.responseText);
		        $('.article_box.facebook .photo img').attr('src', fb_data.data[0].picture);
		        var fb_date = new Date(fb_data.data[0].created_time);
		        $('.article_box.facebook .date').text(fb_date.getFullYear() + '.' + (fb_date.getMonth()+1) + '.' + fb_date.getDate() + '  posted on FACEBOOK');
		        $('.article_box.facebook .detail').text(fb_data.data[0].message.substring(0,200) + '...');
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
		        $('.article_box.instagram a').attr('href', ig_data.data[0].link);
		        $('.article_box.instagram .comments').attr('href', ig_data.data[0].link);
		        $('.article_box.instagram .likes').attr('href', ig_data.data[0].link);
		        $('.article_box.instagram a').attr('onclick', 'trackOutboundLink(\‘' + ig_data.data[0].link + '\'); return false;');
		        $('.article_box.instagram .comments').attr('onclick', 'trackOutboundLink(\‘' + ig_data.data[0].link + '\'); return false;');
		        $('.article_box.instagram .likes').attr('onclick', 'trackOutboundLink(\‘' + ig_data.data[0].link + '\'); return false;');
		        $('.article_box.instagram .comments').text(ig_data.data[0].comments.count);
		        $('.article_box.instagram .likes').text(ig_data.data[0].likes.count)
		        $('.article_box.instagram .photo img').attr('src', ig_data.data[0].images.standard_resolution.url);
		        var ig_date = new Date(parseInt(ig_data.data[0].caption.created_time + '000'));
		        $('.article_box.instagram .date').text(ig_date.getFullYear() + '.' + (ig_date.getMonth()+1) + '.' + ig_date.getDate() + '  posted on INSTAGRAM');
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