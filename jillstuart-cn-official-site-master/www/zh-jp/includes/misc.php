<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat" id="googlewebfont" />
<meta name="robots" content="follow,index">
<?
$_uri =  $_SERVER["REQUEST_URI"];
$_langs = array('ja-jp/', 'en-jp/', 'zh-jp/', 'ko-jp/', 'th-jp/');
$_uri = str_replace($_langs, "", $_uri);
?>
<link rel="alternate" hreflang="ja-JP" href="http://www.jillstuart-beauty.com/ja-jp<? echo $_uri; ?>" />
<link rel="alternate" hreflang="en-JP" href="http://www.jillstuart-beauty.com/en-jp<? echo $_uri; ?>" />
<link rel="alternate" hreflang="zh-JP" href="http://www.jillstuart-beauty.com/zh-jp<? echo $_uri; ?>" />
<link rel="alternate" hreflang="ko-JP" href="http://www.jillstuart-beauty.com/ko-jp<? echo $_uri; ?>" />
<link rel="alternate" hreflang="th-JP" href="http://www.jillstuart-beauty.com/th-jp<? echo $_uri; ?>" />
<link rel="alternate" hreflang="zh-TW" href="http://www.jillstuart-beauty.com.tw<? echo $_uri; ?>" />
<link rel="alternate" hreflang="zh-HK" href="http://hk.jillstuart-beauty.com<? echo $_uri; ?>" />

<link rel="stylesheet" media="all" href="/common/css/reset.css" />
<link rel="stylesheet" media="all" href="/common/css/general.css" />
<link rel="stylesheet" media="all" href="<? echo $_lang; ?>/index/general.css" />

<script src="/common/js/jquery-1.11.1.min.js"></script>
<script src="/common/js/jquery-migrate-1.2.1.min.js"></script>

<script src="/common/js/jquery.imagesloaded.min.js"></script>
<script src="/common/js/jquery.wookmark.min.js"></script>
<script src="/common/js/jquery.timers.js"></script>
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js"></script>-->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<script type="text/javascript" src="/common/js/is_smartphone.js"></script>
<script type="text/javascript" src="/common/js/general.js"></script>
<script type="text/javascript" src="<? echo $_lang; ?>/index/general.js"></script>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/is_smartphone.php"); ?>
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '431217457040325']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=431217457040325&amp;ev=PixelInitialized" /></noscript>
