<? include($_SERVER['DOCUMENT_ROOT']."/includes/lang.php"); ?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Shop List (Kyushu - Japan). JILL STUART Beauty Official Site.">
<meta name="keywords" content="Kyushu,Japan,Shop List,<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/>includes/keywords.php"); ?>"><title>九州|日本|商铺名单|<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/title.php"); ?></title><? include($_SERVER['DOCUMENT_ROOT']."/includes/meta.php"); ?><? include($_SERVER['DOCUMENT_ROOT']."/includes/misc.php"); ?><link rel="stylesheet" media="all" href="/common/css/second.css" />
<link rel="stylesheet" type="text/css" href="/common/shop/index/index.css"><!-- Open Graph Protocol --><meta property="og:type" content="website">
<meta property="og:title" content=" Shop List (Kyushu - Japan) - JILL STUART Beauty Official Site.">
<meta property="og:url" content="http://<? echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" /><meta property="og:description" content="Shop List (Kyushu - Japan)">
<meta property="og:site_name" content="JILL STUART Beauty">
<meta property="og:image" content="http://www.jillstuart-beauty.com/common/images/facebook/fb_thumb.jpg">

<style>
.gnavi li.shop a{border-color:#333 !important;}
.country ul li.kyushu a {color:#999;}
</style>

</head>

<body <? if(is_smartphone()) { echo 'class="smartphone"'; } ?>><?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/analyticstracking.php"); ?><div class="container "><? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/header.php"); ?><main role="main" class="">
		<h1><a href="<? echo $_lang; ?>/shop/"">商铺名单</a></h1><? $p_category = "Kyusyu - Japan" ?><? include($_SERVER['DOCUMENT_ROOT']. $_lang . "/shop/includes/shop_category_navi.php"); ?><div class="main_inner">

		<article id="content"><a id="fukuoka" name="fukuoka"></a><div class="shoplist">
	<div class="fac_header">
		<h4>福冈</h4>
	</div>
	<ul>
		<li>
			<h5>阪急博多（3月3日开张）</h5>
			<address>1-1 Fukuoka Hakata Station center town, Hakata-ku, Fukuoka City, Fukuoka Pref, 812-0012<br />电话号码：092-419-5305</address><!--
			<div class="news">
				<small>2012.02.17</small>
				<h6>title</h6>
				<p>contents</p>
			</div>
			--></li>
		<li>
			<h5>岩田屋</h5>
			<address>2-5-35, Tenjin, Chuo-ku, Fukuoka City, Fukuoka Pref, 810-8680<br />电话号码：092-771-3043</address>
		</li>
		<li>
			<h5>大丸天神</h5>
			<address>1-4-1, Tenjin, Chuo-ku, Fukuoka City, Fukuoka Pref, 810-8717<br />电话号码：092-771-2960</address>
		</li>
	</ul>
</div><a id="nagasaki" name="nagasaki"></a><div class="shoplist">
	<div class="fac_header">
		<h4>长崎</h4>
	</div>
	<ul>
		<li>
			<h5>Oshare no TAITOKU</h5>
			<address>3-12, Motoshimacho, Sasebo-shi, Nagasaki, 857-0871<br />电话号码：0956-22-8176</address>
		</li>
	</ul>
</div><a id="miyazaki" name="miyazaki"></a><div class="shoplist">
	<div class="fac_header">
		<h4>宫崎市</h4>
	</div>
	<ul>
		<li>
			<h5>BonBelta Tachibana</h5>
			<address>3-10-32, Tachibanadori Nishi, Miyazaki City, Miyazaki Pref, 880-0001<br />电话号码：0985-24-2350</address>
		</li>
	</ul>
</div><a id="kagoshima" name="kagoshima"></a><div class="shoplist">
	<div class="fac_header">
		<h4>鹿儿岛</h4>
	</div>
	<ul>
		<li>
			<h5>BENIYA</h5>
			<address>2-13,Nakamachi, Kagoshima City, Kagoshima Pref, 892-0827<br />电话号码：099-226-7520</address>
		</li>
	</ul>
</div>

		</article><? include($_SERVER['DOCUMENT_ROOT'].$_lang."/shop/includes/aside.php"); ?></div>
	</main><? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/footer.php"); ?></div>

</body>

</html>