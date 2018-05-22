<? include($_SERVER['DOCUMENT_ROOT']."/includes/lang.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Shop List (Hong Kong). JILL STUART Beauty Official Site.">
<meta name="keywords" content="Hong Kong,Shop List,<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/keywords.php"); ?>">
<title>Hong Kong | Shop List | <? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/title.php"); ?></title>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/meta.php"); ?>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/misc.php"); ?>
<link rel="stylesheet" media="all" href="/common/css/second.css" />
<link rel="stylesheet" type="text/css" href="/common/shop/index/index.css">

<!-- Open Graph Protocol -->
<meta property="og:type" content="website">
<meta property="og:title" content=" Shop List (Hong Kong) - JILL STUART Beauty Official Site.">
<meta property="og:url" content="http://<? echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" />
<meta property="og:description" content="Shop List (Hong Kong)">
<meta property="og:site_name" content="JILL STUART Beauty">
<meta property="og:image" content="http://www.jillstuart-beauty.com/common/images/facebook/fb_thumb.jpg">

<style>
.gnavi li.shop a{border-color:#333 !important;}
.country ul li.hongkong a {color:#999;}
</style>

</head>

<body <? if(is_smartphone()) { echo 'class="smartphone"'; } ?>>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/analyticstracking.php"); ?>

<div class="container ">

<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/header.php"); ?>

	<main role="main" class="">
		<h1><a href="<? echo $_lang; ?>/shop/"">SHOP LIST</a></h1>
		<? $p_category = "Hong Kong" ?>
		<? include($_SERVER['DOCUMENT_ROOT']. $_lang . "/shop/includes/shop_category_navi.php"); ?>
		<div class="main_inner">

		<article id="content">


<a id="hongkong" name="hongkong"></a>
<div class="shoplist">
	<ul>
		<li>
			<h5>HARVEY NICHOLS</h5>
			<address>
				Pacific Place, 88 Queensway, Hong Kong<br />
				Tel: 2918 1125
			</address>
			<!--
			<div class="news">
				<small>2012.02.17</small>
				<h6>2012 New Base Makeup Debut2012年3月2日より発売</h6>
				<p>クチコミランキングで１位獲得！人気の商品がお得な限定セットとして発売。</p>
			</div>
			-->
		</li>
		<li>
			<h5>New Yaohan (Macau)</h5>
			<address>
				1/F, New Yaohan, Av. Comercial de Macau<br />
				Tel: (853) 2872 3211
			</address>
			<!--
			<div class="news">
				<small>2012.02.17</small>
				<h6>2012 New Base Makeup Debut2012年3月2日より発売</h6>
				<p>クチコミランキングで１位獲得！人気の商品がお得な限定セットとして発売。</p>
			</div>
			-->
		</li>
		<li>
			<h5>JILL STUART Langham Place Seibu</h5>
			<address>
				Langham Place, Mongkok<br />
				Tel: 3514 9050
			</address>
			<!--
			<div class="news">
				<small>2012.02.17</small>
				<h6>2012 New Base Makeup Debut2012年3月2日より発売</h6>
				<p>クチコミランキングで１位獲得！人気の商品がお得な限定セットとして発売。</p>
			</div>
			-->
		</li>
		<li>
			<h5>Times Square Flagship Shop</h5>
			<address>
				Shop B238, Basement 2, Times Square, Causeway Bay<br />
				Tel: 2506 0116
			</address>
			<!--
			<div class="news">
				<small>2012.02.17</small>
				<h6>2012 New Base Makeup Debut2012年3月2日より発売</h6>
				<p>クチコミランキングで１位獲得！人気の商品がお得な限定セットとして発売。</p>
			</div>
			-->
		</li>
		<li>
			<h5>FACES</h5>
			<address>
				Ocean Terminal, Habour City, Tsim Sha Tsui, Kowloon.<br />
				Tel: 27367712
			</address>
			<!--
			<div class="news">
				<small>2012.02.17</small>
				<h6>2012 New Base Makeup Debut2012年3月2日より発売</h6>
				<p>クチコミランキングで１位獲得！人気の商品がお得な限定セットとして発売。</p>
			</div>
			-->
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