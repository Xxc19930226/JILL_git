<? include($_SERVER['DOCUMENT_ROOT']."/includes/lang.php"); ?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Shop List (Chugoku, Shikoku - Japan). JILL STUART Beauty Official Site.">
<meta name="keywords" content="Chugoku, Shikoku ,Japan,Shop List,<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/>includes/keywords.php"); ?>"><title>中国与四国| 日本 | 商铺名单 |<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/title.php"); ?></title><? include($_SERVER['DOCUMENT_ROOT']."/includes/meta.php"); ?><? include($_SERVER['DOCUMENT_ROOT']."/includes/misc.php"); ?><link rel="stylesheet" media="all" href="/common/css/second.css" />
<link rel="stylesheet" type="text/css" href="/common/shop/index/index.css"><!-- Open Graph Protocol --><meta property="og:type" content="website">
<meta property="og:title" content=" Shop List (Chugoku, Shikoku - Japan) - JILL STUART Beauty Official Site.">
<meta property="og:url" content="http://<? echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" /><meta property="og:description" content="Shop List (Chugoku, Shikoku - Japan)">
<meta property="og:site_name" content="JILL STUART Beauty">
<meta property="og:image" content="http://www.jillstuart-beauty.com/common/images/facebook/fb_thumb.jpg">

<style>
.gnavi li.shop a{border-color:#333 !important;}
.country ul li.chugoku a {color:#999;}
</style>

</head>

<body <? if(is_smartphone()) { echo 'class="smartphone"'; } ?>><?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/analyticstracking.php"); ?><div class="container "><? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/header.php"); ?><main role="main" class="">
		<h1><a href="<? echo $_lang; ?>/shop/"">商铺名单</a></h1><? $p_category = "Chugoku &amp; Shikoku - Japan" ?><? include($_SERVER['DOCUMENT_ROOT']. $_lang . "/shop/includes/shop_category_navi.php"); ?><div class="main_inner">

		<article id="content"><a id="hiroshima" name="hiroshima"></a><div class="shoplist">
	<div class="fac_header">
		<h4>广岛市</h4>
	</div>
	<ul>
		<li>
			<h5>flance-ya</h5>
			<address>YALEYALE A B2F, 9-1, Matsubaracho, Minami-ku, Hiroshima City, Hiroshima Pref, 732-0822<br />电话：082-261-5333</address><!--
			<div class="news">
				<small>2012.02.17</small>
				<h6>title</h6>
				<p>contents</p>
			</div>
			--></li>
		<li>
			<h5>LOOK SUN-STE</h5>
			<address>SUN-STE 1F, Sannomarucho, Fukuyama City, Hiroshima Pref, 720-0066<br />电话：084-927-2173</address>
		</li>
		<li>
			<h5>jour france-ya</h5>
			<address>Hiroshima Zero Gate 1F, 2-7, Shintenchi, Naka-ku, Hiroshima City, Hiroshima Pref, 730-0034<br>电话：082-247-2320</address>
		</li>
	</ul>
</div><a id="tokushima" name="tokushima"></a><div class="shoplist">
	<div class="fac_header">
		<h4>德岛</h4>
	</div>
	<ul>
		<li>
			<h5>HIKARIYA WAIWAI PLAZA Omichi</h5>
			<address>645, Muyacho Minamihama Aza Higashi Town, Naruto City, Tokushima Pref, 772-0003<br />电话：088-685-0101</address>
		</li>
	</ul>
</div><a id="kagawa" name="kagawa"></a><div class="shoplist">
	<div class="fac_header">
		<h4>香川县</h4>
	</div>
	<ul>
		<li>
			<h5>cosmetique SENKOYA</h5>
			<address>12-4, Marukamecho, Takamatsu City, Kagawa Pref, 760-0029<br />电话：087-821-9080</address>
		</li>
	</ul>
</div>

		</article><? include($_SERVER['DOCUMENT_ROOT'].$_lang."/shop/includes/aside.php"); ?></div>
	</main><? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/footer.php"); ?></div>

</body>

</html>