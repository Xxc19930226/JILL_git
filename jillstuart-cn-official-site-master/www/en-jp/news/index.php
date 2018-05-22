<? include($_SERVER['DOCUMENT_ROOT']."/includes/lang.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="News Page. Campaign, New Items, Pickup Items, Social etc. JILL STUART Beauty Official Site.">
<meta name="keywords" content="<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/keywords.php"); ?>">
<title>NEWS | <? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/title.php"); ?></title>

<? include($_SERVER['DOCUMENT_ROOT']."/includes/meta.php"); ?>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/misc.php"); ?>
<link rel="stylesheet" media="all" href="/common/css/second.css" />
<link rel="stylesheet" type="text/css" href="/common/js/jquery.fullPage.css" />
<script type="text/javascript" src="/common/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/common/js/vendors/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/common/js/jquery.fullPage.min.js"></script>
<script type="text/javascript" src="/common/js/unveil-master/jquery.unveil.js"></script>

<link rel="stylesheet" media="all" href="/common/news/index/general.css" />
<link rel="stylesheet" media="all" href="/common/news/index/index.css" />
<script type="text/javascript" src="/common/news/index/index.js"></script>

<!-- Open Graph Protocol -->
<meta property="og:type" content="website">
<meta property="og:title" content=" NEWS - JILL STUART Beauty Official Site.">
<meta property="og:url" content="http://<? echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" />
<meta property="og:description" content="News Page. Campaign, New Items, Pickup Items, Social etc.">
<meta property="og:site_name" content="JILL STUART Beauty">
<meta property="og:image" content="http://www.jillstuart-beauty.com/common/images/facebook/fb_thumb.jpg">

<style>
.gnavi li.newon a{border-color:#333 !important;}
</style>
<script type="text/javascript">
function view(c, s, v, p, cnt){
    var obj = document.forms["news"];
    obj.method = "post";
    obj.c.value = c;
    obj.s.value = s;
    obj.v.value = v;
    obj.p.value = p;
    obj.cnt.value = cnt;
    obj.submit();
}
</script>
<?
$_COUNT = 10;
$p_category = isset($_REQUEST['c']) ? $_REQUEST['c'] : "";
$p_id = isset($_REQUEST['i']) ? $_REQUEST['i'] : "";
$p_sort = isset($_REQUEST['s']) ? $_REQUEST['s'] : "";
$p_value = isset($_REQUEST['v']) ? $_REQUEST['v'] : "";
$ps_page  = isset($_REQUEST['p']) ? $_REQUEST['p'] : "1";
$p_page = intval($ps_page);
$ps_count = isset($_REQUEST['cnt']) ? $_REQUEST['cnt'] : $_COUNT;
$p_count = intval($ps_count);

if (file_exists('./news.xml')) {
	$xml = simplexml_load_file("./news.xml");
	/*echo "<h1>SUCCESS</h1>";*/
	/*var_dump($xml);*/
} else {
	/*echo "<h1>ERROR</h1>";*/
}

$newslist = array();
if (strlen($p_value)>0) {
	/* 検索ワードがある時 */
	foreach ($xml->channel->news as $w_news) {
		if(stristr($w_news->id, $p_value)){
			$newslist[] = $w_news;
		}
	}
}
elseif (strlen($p_category)>0) {
	/* カテゴリががある時 */
	$newslist = $xml->xpath('channel/news[@category="' . $p_category . '" or @category2="' . $p_category . '" or @category3="' . $p_category . '"]');
}
elseif (strlen($p_id)>0) {
	/* IDががある時 */
	$_counter = 0;
	foreach ($xml->channel->news as $w_news) {
		if(stristr($w_news->id, $p_id)){
			break;
		}
		$_counter++;
	}
	$p_page = floor($_counter / $p_count) + 1;
	$newslist = $xml->xpath('channel/news');
?>
<script type="text/javascript">
$(document).ready(function(){

  var $ablock = $('.article_block');
  $ablock.each(function(){
    if($(this).attr('id') == 'block_<? print $p_id;?>') {
      $("body").oneTime(800, function() {
        var speed = 800;
        var position = $('#<? print $p_id?>').offset().top-100;
        $("html, body").animate({scrollTop:position}, speed, "swing");
        return false;
      });
      return false;
    }
    var img = $(this).find('img.lazy');
    if(img) {
      $("img").trigger("unveil");
    }
  });


});
</script>
<?
}
else {
	$newslist = $xml->xpath('channel/news');
}
?>

</head>

<body <? if(is_smartphone()) { echo 'class="smartphone"'; } ?>>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/analyticstracking.php"); ?>

<script>
$(window).load(function(){
	if(!is_smartphone()) {
		$(".fb-post").attr("data-width", 576);
	}
	else {
		$(".fb-post").attr("data-width", function(){ return Math.floor($(window).width() * 0.875); });
		$(".fb-post").css("width", function(){ return Math.floor($(window).width() * 0.875); });
	}
});
</script>

<div class="container ">

<form name="news" method="post" action="./">
<input type="hidden" name="c" value="<? echo $p_category; ?>">	<!-- category -->
<input type="hidden" name="s" value="<? echo $p_sort; ?>">		<!-- sort (desc/asc) *not use -->
<input type="hidden" name="v" value="<? echo $p_value; ?>">		<!-- search value -->
<input type="hidden" name="p" value="<? echo $p_page; ?>">		<!-- page -->
<input type="hidden" name="cnt" value="<? echo $p_count; ?>">	<!-- newslist per page -->
</form>

<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/header.php"); ?>

	<main role="main" class="">
		<h1><a href="<? echo $_lang; ?>/news/">NEWS</a>
<?
		if(!strcmp($p_category,"")==0) {
			echo strtoupper(" - " . str_replace ("and", " &amp; ", $p_category));
		}
?>
    </h1>
		<? include($_SERVER['DOCUMENT_ROOT']. $_lang . "/news/includes/news_category_navi.php"); ?>

		<div class="main_inner">

			<article>


<?
$no = 0;
foreach ($newslist as $w_news) {
	$no++;
	if((($p_page-1)*$p_count) < $no && ($p_page*$p_count) >= $no) {
?>
        <div class="article_block" id="block_<? echo $w_news->id; ?>">
				<a id="<? echo $w_news->id; ?>" name="<? echo $w_news->id; ?>" style="height:1px;" /></a>
<?
		if(strcmp($w_news["type"], "standard")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/news/includes/type_standard.php");
		}
		else
		if(strcmp($w_news["type"], "pickupitem")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/news/includes/type_pickupitem.php");
		}
		else
		if(strcmp($w_news["type"], "movie")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/news/includes/type_movie.php");
		}
		else
		if(strcmp($w_news["type"], "onlytext")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/news/includes/type_onlytext.php");
		}
		else
		if(strcmp($w_news["type"], "facebook")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/news/includes/type_facebook.php");
		}
		else
		if(strcmp($w_news["type"], "instagram")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/news/includes/type_instagram.php");
		}
		else
		if(strcmp($w_news["type"], "fullpage")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/news/includes/type_fullpage.php");
		}
		else
		if(strcmp($w_news["type"], "blog")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/news/includes/type_blog.php");
		}
?>
        </div>
<?
	}
}
if (strlen($p_value)==0) {
?>
				<div class="bottom">
				<? include($_SERVER['DOCUMENT_ROOT']."/common/news/includes/pagenation.php"); ?>
				</div>
<?
}
?>


			</article>

<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/news/includes/aside.php"); ?>

		</div>
	</main>

<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/footer.php"); ?>

</div>

</body>

</html>
