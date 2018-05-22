<? include($_SERVER['DOCUMENT_ROOT']."/includes/lang.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Concept and Biography Page. JILL STUART Beauty Official Site.">
<meta name="keywords" content="Concept, Biography, <? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/keywords.php"); ?>">
<title>ABOUT JILL STUART | <? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/title.php"); ?></title>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/meta.php"); ?>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/misc.php"); ?>
<link rel="stylesheet" media="all" href="/common/css/second.css" />
<link rel="stylesheet" media="all" href="/common/about/index/index.css" />

<!-- Open Graph Protocol -->
<meta property="og:type" content="website">
<meta property="og:title" content="ABOUT JILL STUART -  JILL STUART Beauty Official Site.">
<meta property="og:url" content="http://<? echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" />
<meta property="og:description" content="Concept and Biography Page.">
<meta property="og:site_name" content="JILL STUART Beauty">
<meta property="og:image" content="http://www.jillstuart-beauty.com//common/images/facebook/fb_thumb.jpg">


<style>
.gnavi li.about a{border-color:#333 !important;}
</style>

</head>

<body <? if(is_smartphone()) { echo 'class="smartphone"'; } ?>>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/analyticstracking.php"); ?>

<div class="container ">

<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/header.php"); ?>

	<main role="main" class="">
		<h1><a href="<? echo $_lang; ?>/about/">ABOUT JILL STUART</a></h1>
		<div class="main_inner">

			<div class="concept">
				<div class="image">
					<img src="/common/about/images/main.jpg" />
				</div>
				<div class="title">
					<h2>CONCEPT</h2>
					<h3>INNOCENT SEXY</h3>
				</div>
				<div class="contents">
					<p>
Innocent Sexy  Jill has created a crowned jewel for every princess,<br />innocent, sexy, elegant, fun and savvy.
					</p>
					<p class="bold">
Experience the luxurious excitement<br />every time and reach for the stars!
					</p>
				</div>
			</div>

			<div class="biography">
				<div class="title">
					<h2>BIOGRAPHY</h2>
					<h3>Jill Stuart</h3>
				</div>
				<div class="image">
					<img src="/common/about/images/jill.jpg" />
					<p>PHOTO BY MARIO SORRENTI</p>
				</div>
				<div class="contents">
					<p>
						Jill Stuart was born and raised in New York. Her parents managed a ladies’-wear firm, At the tender age of 15, she announced her first collation of Jewelry and handbags, attracting the eye of Bergdorf Goodman. Bloomingdale's, America's premier department stores.<br>
						Jill began studying fashion In earnest, and at the age of 27 established her own fashion line, Jill Stuart.<br>
						She opened her flagship store in New York's SoHo district. where she Unveiled the Jill Stuart 1993 New York collection.<br>
						In 2005, a decade after the launch of her brand, Jill launched the Jill Stuart cosmetics line.<br>
						Today, Jill Stuart is a fashion designer who enjoys the fervent support of young women everywhere, in Japan and around the world.<br>
						<br />
						<a target="_blank" href="http://www.jillstuart.com/" class="link" style="text-decoration:underline;">Jill’s Fashion</a>
					</p>
				</div>
				<div class="message">
					<h2>MESSAGE FROM Jill</h2>
					<p>
						My big dream has come true!<br />
						Producing my own cosmetic products was one of my big dreams.<br />
						Hope you like them and enjoy!<br />
					</p>
					<div class="sign">
						<img src="/common/about/images/sign.jpg" />
					</div>
				</div>
			</div>

		</div>
	</main>

<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/footer.php"); ?>

</div>

</body>

</html>
