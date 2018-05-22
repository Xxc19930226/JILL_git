<? include($_SERVER['DOCUMENT_ROOT']."/includes/lang.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Shop List (Kinki - Japan). JILL STUART Beauty Official Site.">
<meta name="keywords" content="Kinki,Japan,Shop List,<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/keywords.php"); ?>">
<title>Kinki | Japan | Shop List | <? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/title.php"); ?></title>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/meta.php"); ?>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/misc.php"); ?>
<link rel="stylesheet" media="all" href="/common/css/second.css" />
<link rel="stylesheet" type="text/css" href="/common/shop/index/index.css">

<!-- Open Graph Protocol -->
<meta property="og:type" content="website">
<meta property="og:title" content=" Shop List (Kinki - Japan) - JILL STUART Beauty Official Site.">
<meta property="og:url" content="http://<? echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" />
<meta property="og:description" content="Shop List (Kinki - Japan)">
<meta property="og:site_name" content="JILL STUART Beauty">
<meta property="og:image" content="http://www.jillstuart-beauty.com/common/images/facebook/fb_thumb.jpg">


<style>
.gnavi li.shop a{border-color:#333 !important;}
.country ul li.kinki a {color:#999;}
</style>

</head>

<body <? if(is_smartphone()) { echo 'class="smartphone"'; } ?>>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/analyticstracking.php"); ?>

<div class="container ">

<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/header.php"); ?>

	<main role="main" class="">
		<h1><a href="<? echo $_lang; ?>/shop/"">SHOP LIST</a></h1>
		<? $p_category = "Kinki - Japan" ?>
		<? include($_SERVER['DOCUMENT_ROOT']. $_lang . "/shop/includes/shop_category_navi.php"); ?>
		<div class="main_inner">

		<article id="content">

<a id="kyoto" name="kyoto"></a>
<div class="shoplist">
	<div class="fac_header">
		<h4>
		Kyoto
		</h4>
	</div>
	<ul>
		<li>
			<h5>TAKASHIMAYA Kyoto</h5>
			<address>
			52, Nishiiru Shincho, Shijo-dori kawaramachi, Shimogyo-ku, Kyoto Pref, 600-8520<br />
			Tel : 075-252-7568
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
			<h5>DAIMARU Kyoto</h5>
			<address>
			1F, Sijyo Takakura, Shimogyo-ku, Kyoto City, Kyoto Pref, 600-8511<br />
			Tel : 075-211-2650
			</address>
		</li>
	</ul>
</div>
<a id="oosaka" name="oosaka"></a>
<div class="shoplist">
	<div class="fac_header">
		<h4>
		Osaka
		</h4>
	</div>
	<ul>
		<li>
			<h5>TAKASHIMAYA Osaka</h5>
			<address>
			5-1-5,Namba, Chuo-ku, Osaka Pref, 542-8510<br />
			Tel : 06-6632-9620
			</address>
		</li>
		<li>
			<h5>HANKYU Osaka,Umeda</h5>
			<address>
			8-7, Kakudacho, Kita-ku, Osaka City, Osaka Pref, 530-0017<br />
			Tel : 06-6313-7491
			</address>
		</li>
		<li>
			<h5>DAIMARU Shinsaibashi</h5>
			<address>
			1-7-1 1F, Shinsaibashi, Chuo-ku, Osaka City, Osaka Pref, 542-8501<br />
			Tel : 06-6244-8166
			</address>
		</li>
		<li>
			<h5>DAIMARU Umeda</h5>
			<address>
			3-1-1 2F, Umeda, kita-ku, Osaka City, Osaka Pref, 530-8202<br />
			Tel : 06-6344-8890
			</address>
		</li>
		<li>
			<h5>
				ABENO HARUKAS</h5>
			<address>
				1−1−43, Abeno-suji, Abeno-ku, Osaka City, Osaka Pref, 545-8545<br>
				Tel : 06-6625-2198</address>
		</li>
	</ul>
</div>
<a id="hyougo" name="hyougo"></a>
<div class="shoplist">
	<div class="fac_header">
		<h4>
		Hyogo
		</h4>
	</div>
	<ul>
		<li>
			<h5>DAIMARU Kobe</h5>
			<address>
			40 1F, Akashi, Chuo-ku, Kobe City, Hyogo Pref, 650-0037<br />
			Tel : 078-393-8225
			</address>
		</li>
		<li>
			<h5>SOGO Kobe</h5>
			<address>
			8-1-8, Onoedori, Chuo-ku, Kobe City, Hyogo Pref, 651-8511<br />
			Tel : 078-232-4880
			</address>
		</li>
		<li>
			<h5>LOOK HIMEJI Grand Festa</h5>
			<address>
				Grand Festa 1st avenue, 188-1, Ekimae-cho, Himeji City, Hyogo Pref, 670-0927<br />
				Tel : 079-263-7373</address>
		</li>
		<li>
			<h5>KOTOBUKIYA CLUB</h5>
			<address>
				65, Kamei-cho, Himeji City, Hyogo Pref, 670-0925<br>
				Tel : 079-282-0037</address>
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