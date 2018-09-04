<?php echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/lang.php"); ?>
<?php
$_COUNT = 40;

$p_category = isset($_REQUEST['c']) ? $_REQUEST['c'] : "";
$p_sort = isset($_REQUEST['s']) ? $_REQUEST['s'] : "";
$p_value = isset($_REQUEST['v']) ? $_REQUEST['v'] : "";
$ps_page  = isset($_REQUEST['p']) ? $_REQUEST['p'] : "1";
$p_page = intval($ps_page);
$ps_count = isset($_REQUEST['cnt']) ? $_REQUEST['cnt'] : $_COUNT;
$p_count = intval($ps_count);


if (file_exists('../products/products1.xml')) {
	$xml = simplexml_load_file("../products/products1.xml");
	/*echo "<h1>SUCCESS</h1>";*/
	/*var_dump($xml);*/
} else {
	/*echo "<h1>ERROR</h1>";*/
}

$items = array();

if (strlen($p_value)>0) {
	/* 検索ワードがある時 */
	foreach ($xml->channel->item as $w_item) {
		if(stristr($w_item->en, $p_value)
		|| stristr($w_item->t0, $p_value)
		|| stristr($w_item->t1, $p_value)){
			$items[] = $w_item;
		}
	}
}
else {
	/* カテゴリががある時 */
	if (strlen($p_category)>0) {
		$items = $xml->xpath('channel/item[@category="' . $p_category . '"]');
	}
	else {
		$items = $xml->xpath('channel/item');
	}
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>

<meta charset="utf-8">
<meta name="description" content="Products Page. Bath and Body, Skincare, Basemake, Eyes, Cheeks, Lips, Nails, Fragrance, Tools, Suncare, Series etc. JILL STUART Beauty Official Site.">
<meta name="keywords" content="Products Page. Bath and Body, Skincare, Basemake, Eyes, Cheeks, Lips, Nails, Fragrance, Tools, Suncare, Series,  <? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/keywords.php"); ?>">

<title>
<?php
if(strcmp($p_value,"")==0) {
	if(strcmp($p_category,"")==0) {
	}else{
		echo ucwords($p_category) . ' | ';
	}
}else{
	echo "Search Result | ";
}
?>PRODUCTS | <? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/title.php"); ?></title>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/meta.php"); ?>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/misc.php"); ?>
<link rel="stylesheet" media="all" href="/common/css/second.css" />
<link rel="stylesheet" type="text/css" href="/common/products/index/index.css">
<script type="text/javascript" src="/common/products/index/index.js"></script>

<!-- Open Graph Protocol -->
<meta property="og:type" content="website">
<meta property="og:title" content=" PRODUCTS - JILL STUART Beauty Official Site.">
<meta property="og:url" content="http://<? echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" />
<meta property="og:description" content="Products Page. Bath and Body, Skincare, Basemake, Eyes, Cheeks, Lips, Nails, Fragrance, Tools, Suncare, Series etc.">
<meta property="og:site_name" content="JILL STUART Beauty">
<meta property="og:image" content="http://www.jillstuart-beauty.com/images/facebook/fb_thumb.jpg">

<style>
.gnavi li.product a{border-color:#333 !important;}
</style>
</head>

<body <? if(is_smartphone()) { echo 'class="smartphone"'; } ?>>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/analyticstracking.php"); ?>

<div class="container">

<form name="product" method="post" action="./index.php">
<input type="hidden" name="c" value="<?php echo $p_category; ?>">	<!-- category -->
<input type="hidden" name="s" value="<?php echo $p_sort; ?>">			<!-- sort (desc/asc) *not use -->
<input type="hidden" name="v" value="<?php echo $p_value; ?>">		<!-- search value -->
<input type="hidden" name="p" value="<?php echo $p_page; ?>">			<!-- page -->
<input type="hidden" name="cnt" value="<?php echo $p_count; ?>">		<!-- items per page -->
</form>

	<?php include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/header.php"); ?>
	<main role="main" class="">
		<h1><a href="<? echo $_lang; ?>/products/">PRODUCTS</a></h1>
		<?php include($_SERVER['DOCUMENT_ROOT'].$_lang."/products/includes/product_category_navi.php"); ?>
		<div class="main_inner">



			<div id="body">

				<article id="content">

						<!-- Menu List -->
						<div class="fac_category-list">
							<div class="fac_find-by-category">
								<ul>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=bathandbody"><span class="img_wrapper"><img src="/common/products/images/category_bath-body_thumbnail.jpg" alt="Bath&amp;Body" width="218" height="78" /></span><span class="img_text">Bath &amp; Body</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=skincare"><span class="img_wrapper"><img src="/common/products/images/category_skincare_thumbnail.jpg" alt="Skincare" width="218" height="78" /></span><span class="img_text">Skincare</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=basemake"><span class="img_wrapper"><img src="/common/products/images/category_basemake_thumbnail.jpg" alt="Basemake" width="218" height="78" /></span><span class="img_text">Basemake</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=eyes"><span class="img_wrapper"><img src="/common/products/images/category_eyes_thumbnail.jpg" alt="Eyes" width="218" height="78" /></span><span class="img_text">Eyes</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=cheeks"><span class="img_wrapper"><img src="/common/products/images/category_cheeks_thumbnail.jpg" alt="Cheeks" width="218" height="78" /></span><span class="img_text">Cheeks</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=lips"><span class="img_wrapper"><img src="/common/products/images/category_lips_thumbnail.jpg" alt="Lips" width="218" height="78" /></span><span class="img_text">Lips</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=nails"><span class="img_wrapper"><img src="/common/products/images/category_nails_thumbnail.jpg" alt="Nails" width="218" height="78" /></span><span class="img_text">Nails</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=fragrance"><span class="img_wrapper"><img src="/common/products/images/category_fragrance_thumbnail.jpg" alt="Fragrance" width="218" height="78" /></span><span class="img_text">Fragrance</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=tools"><span class="img_wrapper"><img src="/common/products/images/category_tools_thumbnail.jpg" alt="Tools" width="218" height="78" /></span><span class="img_text">Tools</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=suncare"><span class="img_wrapper"><img src="/common/products/images/category_suncare_thumbnail.jpg" alt="Suncare" width="218" height="78" /></span><span class="img_text">Suncare</span></a></h4></li>
								</ul>
							</div>
							<div class="fac_find-by-series">
								<h3>Series</h3>
								<ul>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=JILL STUART BON MARIAGE"><span class="img_wrapper"><img width="218" height="78" alt="bon mariage" src="/common/products/images/banner_bon-mariage.jpg"></span><span class="img_text">JILL STUART BON MARIAGE</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=JILL STUART ANGEL"><span class="img_wrapper"><img width="218" height="78" alt="ANGEL" src="/common/products/images/banner_angel.jpg"></span><span class="img_text">JILL STUART ANGEL</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=JILL STUART RELAX"><span class="img_wrapper"><img width="218" height="78" alt="RELAX" src="/common/products/images/banner_relax.jpg"></span><span class="img_text">JILL STUART RELAX</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=crystal bloom"><span class="img_wrapper"><img width="218" height="78" alt="crystal bloom" src="/common/products/images/banner_crystal_bloom.jpg"></span><span class="img_text">JILL STUART Crystal Bloom</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=crystal bloom solid perfume"><span class="img_wrapper"><img width="218" height="78" alt="solid perfume" src="/common/products/images/banner_solid_perfume.jpg"></span><span class="img_text">JILL STUART Crystal Bloom solid perfume</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=ballet stories collection"><span class="img_wrapper"><img width="218" height="78" alt="ballet stories collection" src="/common/products/images/banner_ballet_stories_collection.jpg"></span><span class="img_text">JILL STUART ballet stories collection</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=2015 Spring Collection"><span class="img_wrapper"><img width="218" height="78" alt="2015 spring collection" src="/common/products/images/banner_2015spring_collection.jpg"></span><span class="img_text">JILL STUART 2015 Spring Collection</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=Chiffon Ribbon Collection"><span class="img_wrapper"><img width="218" height="78" alt="Chiffon Ribbon Collection" src="/common/products/images/banner-chiffon.jpg"></span><span class="img_text">JILL STUART Chiffon Ribbon Collection</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=new powder foundation"><span class="img_wrapper"><img width="218" height="78" alt="new powder foundation" src="/common/products/images/banner-new-powder-foundation.jpg"></span><span class="img_text">JILL STUART new powder foundation</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=new cc cream"><span class="img_wrapper"><img width="218" height="78" alt="new cc cream" src="/common/products/images/banner-cc_cream.jpg"></span><span class="img_text">JILL STUART new CC cream & Limited items</span></a></h4></li>
									<li><h4><a href="<? echo $_lang; ?>/products/list.php?c=Aqua Chiffon"><span class="img_wrapper"><img width="218" height="78" alt="Aqua Chiffon" src="/common/products/images/banner-aquachiffon.jpg"></span><span class="img_text">JILL STUART RELAX new item & limited item</span></a></h4></li>
								</ul>
							</div>
						</div>
						<!-- /Menu List -->

				</article>

			</div>
		</div>
	</main>

	<?php include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/footer.php"); ?>
</div>
</body>
</html>
