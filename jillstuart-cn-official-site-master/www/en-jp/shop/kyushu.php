<? include($_SERVER['DOCUMENT_ROOT']."/includes/lang.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Shop List (Kyushu - Japan). JILL STUART Beauty Official Site.">
<meta name="keywords" content="Kyushu,Japan,Shop List,<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/keywords.php"); ?>">
<title>Kyushu| Japan | Shop List | <? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/title.php"); ?></title>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/meta.php"); ?>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/misc.php"); ?>
<link rel="stylesheet" media="all" href="/common/css/second.css" />
<link rel="stylesheet" type="text/css" href="/common/shop/index/index.css">

<!-- Open Graph Protocol -->
<meta property="og:type" content="website">
<meta property="og:title" content=" Shop List (Kyushu - Japan) - JILL STUART Beauty Official Site.">
<meta property="og:url" content="http://<? echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" />
<meta property="og:description" content="Shop List (Kyushu - Japan)">
<meta property="og:site_name" content="JILL STUART Beauty">
<meta property="og:image" content="http://www.jillstuart-beauty.com//common/images/facebook/fb_thumb.jpg">

<style>
.gnavi li.shop a{border-color:#333 !important;}
.country ul li.kyushu a {color:#999;}
</style>

</head>

<body <? if(is_smartphone()) { echo 'class="smartphone"'; } ?>>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/analyticstracking.php"); ?>

<div class="container ">

<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/header.php"); ?>

	<main role="main" class="">
		<h1><a href="<? echo $_lang; ?>/shop/"">SHOP LIST</a></h1>
		<? $p_category = "Kyusyu - Japan" ?>
		<? include($_SERVER['DOCUMENT_ROOT']. $_lang . "/shop/includes/shop_category_navi.php"); ?>
		<div class="main_inner">

		<article id="content">



<a id="fukuoka" name="fukuoka"></a>
<div class="shoplist">
	<div class="fac_header">
		<h4>
		Fukuoka
		</h4>
	</div>
	<ul>
		<li>
			<h5>HANKYU Hakata (March 3 OPEN)</h5>
			<address>
			1-1 Fukuoka Hakata Station center town, Hakata-ku, Fukuoka City, Fukuoka Pref, 812-0012<br />
			Tel : 092-419-5305
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
			<h5>IWATAYA</h5>
			<address>
			2-5-35, Tenjin, Chuo-ku, Fukuoka City, Fukuoka Pref, 810-8680<br />
			Tel : 092-771-3043
			</address>
		</li>
		<li>
			<h5>DAIMARU Tenjin</h5>
			<address>
			1-4-1, Tenjin, Chuo-ku, Fukuoka City, Fukuoka Pref, 810-8717<br />
			Tel : 092-771-2960
			</address>
		</li>
	</ul>
</div>
<a id="nagasaki" name="nagasaki"></a>
<div class="shoplist">
	<div class="fac_header">
		<h4>
		Nagasaki
		</h4>
	</div>
	<ul>
		<li>
			<h5>Oshare no TAITOKU</h5>
			<address>
			3-12, Motoshimacho, Sasebo-shi, Nagasaki, 857-0871<br />
			Tel : 0956-22-8176
			</address>
		</li>
	</ul>
</div>
<a id="oita" name="oita"></a>
<div class="shoplist">
	<div class="fac_header">
		<h4>
		Oita
		</h4>
	</div>
	<ul>
		<li>
			<h5>TOKIHA</h5>
			<address>
			2-1-4, Funaimachi, Oita-shi, Oita Pref, 870-8688<br />
			Tel : 097-536-7999
			</address>
		</li>
	</ul>
	<ul>
		<li>
			<h5>ALFLEUR Oita</h5>
			<address>
			1-14, Kanamemachi, Oita-shi, Oita Pref, 870-0831<br />
			Tel : 097-513-1501
			</address>
		</li>
	</ul>
</div>
<a id="miyazaki" name="miyazaki"></a>
<div class="shoplist">
	<div class="fac_header">
		<h4>
		Miyazaki
		</h4>
	</div>
	<ul>
		<li>
			<h5>Message BonBelta Tachibana</h5>
			<address>
			3-10-32, Tachibanadori Nishi, Miyazaki City, Miyazaki Pref, 880-0001<br />
			Tel : 0985-24-2350
			</address>
		</li>
	</ul>
	<ul>
		<li>
			<h5>Message MIYAZAKI Ichibangai</h5>
			<address>
			3-9-1, Tachibanadori Nishi, Miyazaki City, Miyazaki Pref, 880-0001<br />
			Tel : 0985-34-9995
			</address>
		</li>
	</ul>
</div>
<a id="kagoshima" name="kagoshima"></a>
<div class="shoplist">
	<div class="fac_header">
		<h4>
		Kagoshima
		</h4>
	</div>
	<ul>
		<li>
			<h5>BENIYA</h5>
			<address>
			2-13,Nakamachi, Kagoshima City, Kagoshima Pref, 892-0827<br />
			Tel : 099-226-7520
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