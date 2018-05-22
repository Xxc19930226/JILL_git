<? include($_SERVER['DOCUMENT_ROOT']."/includes/lang.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Shop List (Hokkaido, Tohoku - Japan). JILL STUART Beauty Official Site.">
<meta name="keywords" content="Hokkaido, Tohoku,Japan,Shop List,<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/keywords.php"); ?>">
<title>Hokkaido & Tohoku | Japan | Shop List | <? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/title.php"); ?></title>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/meta.php"); ?>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/misc.php"); ?>
<link rel="stylesheet" media="all" href="/common/css/second.css" />
<link rel="stylesheet" type="text/css" href="/common/shop/index/index.css">

<!-- Open Graph Protocol -->
<meta property="og:type" content="website">
<meta property="og:title" content=" Shop List (Hokkaido, Tohoku - Japan) - JILL STUART Beauty Official Site.">
<meta property="og:url" content="http://<? echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" />
<meta property="og:description" content="Shop List (Hokkaido, Tohoku - Japan)">
<meta property="og:site_name" content="JILL STUART Beauty">
<meta property="og:image" content="http://www.jillstuart-beauty.com/common/images/facebook/fb_thumb.jpg">

<style>
.gnavi li.shop a{border-color:#333 !important;}
.country ul li.hokkaido a {color:#999;}
</style>

</head>

<body <? if(is_smartphone()) { echo 'class="smartphone"'; } ?>>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/analyticstracking.php"); ?>

<div class="container ">

<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/header.php"); ?>

	<main role="main" class="">
		<h1><a href="<? echo $_lang; ?>/shop/"">SHOP LIST</a></h1>
		<? $p_category = "Hokkaido &amp; Tohoku - Japan" ?>
		<? include($_SERVER['DOCUMENT_ROOT']. $_lang . "/shop/includes/shop_category_navi.php"); ?>
		<div class="main_inner">

		<article id="content">

<a id="hokkaidou" name="hokkaidou"></a>
<div class="shoplist">
	<div class="fac_header">
		<h4>
			Hokkaido
		</h4>
	</div>
	<ul>
		<li>
			<h5>DAIMARU Sapporo</h5>
			<address>
			4-7, Kita Gojyo Nishi, Chuo-ku, Sapporo City, Hokkaido, 060 - 0005<br />
			011-241-5376
			</address>
		</li>
	</ul>
</div>

<a id="miyagi" name="miyagi"></a>
<div class="shoplist">
	<div class="fac_header">
		<h4>
			Miyagi
		</h4>
	</div>
	<ul>
		<li>
			<h5>Perfumerie Sukiya SELVA</h5>
			<address>
			1-4-1 2F, Izumi Chuo, Izumi-ku, Sendai City, Miyagi Pref, 981-3133<br />
			Tel : 022-371-0135
			</address>
			<!--
			<div class="news">
				<small>2012.02.17</small>
				<h6>title</h6>
				<p>contents</p>
			</div>
			-->
		</li>
		<li>
			<h5> Perfumerie Sukiya Ichibancho</h5>
			<address>
			3-6-11, Ichiban Town, Aoba-ku, Sendai City, Miyagi Pref, 980-0811<br />
			Tel : 022-221-5588
			</address>
		</li>
		<li>
			<h5>Perfumerie Sukiya S-PAL</h5>
			<address>
			1-1-1 1F, Chuo , Aoba-ku, Sendai City, Miyagi Pref, 980-0021<br />
			Tel : 022-214-3777
			</address>
		</li>
	</ul>
</div>
		</article>

<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/shop/includes/aside.php"); ?>

		</div>
	</main>

<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/footer.php"); ?>

</div>

</body>

</html>