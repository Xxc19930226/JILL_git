<? include($_SERVER['DOCUMENT_ROOT']."/includes/lang.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="JILL STUART Beauty Official Site. <? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/description.php"); ?>" />
<meta name="keywords" content="<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/keywords.php"); ?>" />
<title><? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/title.php"); ?></title>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/meta.php"); ?>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/misc.php"); ?>
<link rel="stylesheet" media="all" href="/common/index/index.css" />

<!-- for TOP EFFECTS Movie -->
<link href="/common/js/video-js/video-js.css" rel="stylesheet" />
<script src="/common/js/video-js/video.js" type="text/javascript"></script>
<script type="text/javascript" src="/common/js/unveil-master/jquery.unveil.js"></script>

<link href="/common/js/slick.css" rel="stylesheet" />
<script type="text/javascript" src="/common/js/slick.min.js"></script>
<script type="text/javascript" src="/common/index/index.js"></script>

<!-- Open Graph Protocol -->
<meta property="og:type" content="website">
<meta property="og:title" content="JILL STUART Beauty Official Site.">
<meta property="og:url" content="http://<? echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" />
<meta property="og:description" content="<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/description.php"); ?>">
<meta property="og:site_name" content="JILL STUART Beauty">
<meta property="og:image" content="http://www.jillstuart-beauty.com/common/images/facebook/fb_thumb.jpg">

<style>
.gnavi li.home a{border-color:#333 !important;}
</style>

    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?af2e6dc95f5753ab6ef591890415fd69";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>

</head>

<body <? if(is_smartphone()) { echo 'class="smartphone"'; } ?>>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/analyticstracking.php"); ?>

<div class="container ">

<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/header.php"); ?>

	<main role="main" class="">
<?
if (file_exists($_SERVER['DOCUMENT_ROOT'].$_lang.'/index/main.xml')) {
	$main_xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].$_lang."/index/main.xml");
}
$mainlist = $main_xml->xpath('channel/main');
?>
		<div class="main_banner">
			<div class="visual_flip">
<?
foreach ($mainlist as $w_main) {
?>
				<div class="banner">
<?if(strcmp($w_main["type"], "dual")==0) { ?>
					<div class="dual_banner">
						<div class="left">
<?	if(strcmp($w_main->left->moresmp, "")!=0) { ?>
							<a class="moresmp" href="<? echo $w_main->left->more; ?>" target="<? echo $w_main->left->more["target"];?>" smphref="<? echo $w_main->left->moresmp; ?>">
<?	}
		else { ?>
							<a href="<? echo $w_main->left->more; ?>" target="<? echo $w_main->left->more["target"];?>">
<?	} ?>
								<img border="0" src="<? echo $w_main->left->image; ?>" title="" />
							</a>
						</div>
						<div class="right">
<?	if(strcmp($w_main->right->moresmp, "")!=0) { ?>
							<a class="moresmp" href="<? echo $w_main->right->more; ?>" target="<? echo $w_main->right->more["target"];?>" smphref="<? echo $w_main->right->moresmp; ?>">
<?	}
		else { ?>
							<a href="<? echo $w_main->right->more; ?>" target="<? echo $w_main->right->more["target"];?>">
<?	} ?>
								<img border="0" src="<? echo $w_main->right->image; ?>" title="" />
							</a>
						</div>
					</div>
<?}
	else {
		if(strcmp($w_main->moresmp, "")!=0) { ?>
					<a class="moresmp" href="<? echo $w_main->more; ?>" target="<? echo $w_main->more["target"];?>" smphref="<? echo $w_main->moresmp; ?>">
<?	}
		elseif(strcmp($w_main->more, "")!=0) { ?>
					<a href="<? echo $w_main->more; ?>" target="<? echo $w_main->more["target"];?>">
<?	}
    else {
		} ?>
<?  if(is_smartphone() && strcmp($w_main->imagesmp, "")!=0) { ?>
						<img border="0" src="<? echo $w_main->imagesmp; ?>" title="" />
<?  } else { ?>
						<img border="0" src="<? echo $w_main->image; ?>" title="" />
<?  } ?>
<?  if(strcmp($w_main->moresmp, "")!=0 || strcmp($w_main->more, "")!=0) { ?>
					</a>
<?	} ?>
<?} ?>
				</div>
<?
}
?>

			</div>
		</div>

		<div class="main_inner">

<?
$_COUNT = 20;
if (file_exists($_SERVER['DOCUMENT_ROOT'].$_lang.'/news/news.xml')) {
	$news_xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].$_lang."/news/news.xml");
}
$newslist = $news_xml->xpath('channel/news[@top="on"]');
?>
			<article>

				<div class="page_header">
					<h2 class="page_title">PICKUP CONTENTS</h2>
					<a href="./news/" class="view_all">VIEW ALL</a>
				</div>

				<div class="article_box_area">
<?
$no = 0;
foreach ($newslist as $w_news) {
		if(strcmp($w_news["type"], "standard")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/index/includes/type_standard.php");
		}
		else
		if(strcmp($w_news["type"], "pickupitem")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/index/includes/type_pickupitem.php");
		}
		else
		if(strcmp($w_news["type"], "movie")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/index/includes/type_movie2.php");
		}
		else
		if(strcmp($w_news["type"], "onlytext")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/index/includes/type_standard.php");
		}
		else
		if(strcmp($w_news["type"], "facebook")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/index/includes/type_facebook.php");
		}
		else
		if(strcmp($w_news["type"], "instagram")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/index/includes/type_instagram.php");
		}
		else
		if(strcmp($w_news["type"], "fullpage")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/index/includes/type_standard.php");
		}
		else
		if(strcmp($w_news["type"], "blog")==0) {
			include($_SERVER['DOCUMENT_ROOT']."/common/index/includes/type_standard.php");
		}
}
?>
				</div>

			</article>

		</div>
	</main>

<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/footer.php"); ?>

</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".main_inner .article_box_area .pickupitem .article_box_inner").css('display','none'); 
	});
</script>
</body>

</html>
