<? include($_SERVER['DOCUMENT_ROOT']."/includes/lang.php"); ?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Shop List (Kantou - Japan). JILL STUART Beauty Official Site.">
<meta name="keywords" content="Kantou,Japan,Shop List,<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/>includes/keywords.php"); ?>"><title>中国|商铺名单|<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/title.php"); ?></title><? include($_SERVER['DOCUMENT_ROOT']."/includes/meta.php"); ?><? include($_SERVER['DOCUMENT_ROOT']."/includes/misc.php"); ?><link rel="stylesheet" media="all" href="/common/css/second.css" />
<link rel="stylesheet" type="text/css" href="/common/shop/index/index.css"><!-- Open Graph Protocol --><meta property="og:type" content="website">
<meta property="og:title" content=" Shop List (Kantou - Japan) - JILL STUART Beauty Official Site.">
<meta property="og:url" content="http://<? echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" /><meta property="og:description" content="Shop List (Kantou - Japan)">
<meta property="og:site_name" content="JILL STUART Beauty">
<meta property="og:image" content="http://www.jillstuart-beauty.com/common/images/facebook/fb_thumb.jpg">

<style>
.gnavi li.shop a{border-color:#333 !important;}
.country ul li.kantou a {color:#999;}
.country ul li.kantou ul.sub{display:block;}
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

<body <? if(is_smartphone()) { echo 'class="smartphone"'; } ?>><?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/analyticstracking.php"); ?><div class="container "><? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/header.php"); ?><main role="main" class="">
		<h1><a href="<? echo $_lang; ?>/shop/"">商铺名单</a></h1><? $p_category = "Kantou - Japan" ?><? include($_SERVER['DOCUMENT_ROOT']. $_lang . "/shop/includes/shop_category_navi.php"); ?><div class="main_inner">

		<article id="content">
				<a id="tokyo" name="tokyo"></a>
				<div class="shoplist">
					<div class="fac_header">
						<h4>线下实体店</h4>
					</div>
					<ul>
						<li>
							<h5 style="text-align: center;width: 100%;">北京SKP专柜</h5><!--ul class="fac_tag">
								<li><img src="../images/itemicons/shop-list_label_relax-line.gif" alt="Relax Line" /></li>
							</ul--><address style="text-align: center;">北京市朝阳区建国路87号北京SKP</address>
						</li>
					</ul>
				</div>
				<a id="gunma" name="gunma"></a>
				<div class="shoplist">
					<div class="fac_header">
						<h4>线上旗舰店</h4>
					</div>
					<div class="fac_header">
						<h4><a href="https://jillstuart.tmall.com/?spm=a1z10.1-b.w5001-14438711952.3.ftea9x&scene=taobao_shop" target="_blank">JILL STUART天猫旗舰店</a></h4>
					</div>
				</div>

		</article><? include($_SERVER['DOCUMENT_ROOT'].$_lang."/shop/includes/aside.php"); ?></div>
	</main><? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/footer.php"); ?></div>

</body>

</html>
