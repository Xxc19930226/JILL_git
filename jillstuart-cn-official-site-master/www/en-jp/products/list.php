<? echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/lang.php"); ?>
<?
$_COUNT = 20;

$p_category = isset($_REQUEST['c']) ? $_REQUEST['c'] : "";
$p_sort = isset($_REQUEST['s']) ? $_REQUEST['s'] : "";
$p_value = isset($_REQUEST['v']) ? $_REQUEST['v'] : "";
$ps_page  = isset($_REQUEST['p']) ? $_REQUEST['p'] : "1";
$p_page = intval($ps_page);
$ps_count = isset($_REQUEST['cnt']) ? $_REQUEST['cnt'] : $_COUNT;
$p_count = intval($ps_count);


if (file_exists('products1.xml')) {
	$xml = simplexml_load_file("products1.xml");
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
		|| stristr($w_item->code, $p_value)
		|| stristr($w_item->t0, $p_value)
		|| stristr($w_item->t1, $p_value)){
			$items[] = $w_item;
		}
	}
}
else {
	/* カテゴリががある時 */
	if (strlen($p_category)>0) {
		$items = $xml->xpath('channel/item[@category="' . $p_category . '" or @category2="' . $p_category . '" or @category3="' . $p_category . '"]');
	}
	else {
		$items = $xml->xpath('channel/item');
	}
}

/* delete
foreach($xml->channel->item as $item) {
	if ( strlen($p_category) > 0 && strcmp($item["category"], $p_category) ) {
	}
	else {
		$items2[] = array(
			"thumb"=>$item->thumb,
			"code"=>$item->code,
			"en"=>$item->en
		);
		$name[] = array($item->en); /* ソート用名前
	}
}
*/
/* Sort *
if(strcmp($p_sort, "") != 0) {
	$wsort = strcmp($p_sort ,"desc")==0 ? SORT_DESC : SORT_ASC;
	array_multisort($name, $wsort, $items);
}
*/
?>

<!DOCTYPE html>
<html lang="ja">
<head>

<meta charset="utf-8">
<?
$_CATE_NAME = "";
if(strcmp($p_value,"")==0) {
	if(strcmp($p_category,"")==0) {}
	else{$_CATE_NAME = ucwords($p_category);}
}
else{$_CATE_NAME = "Search Result";}
?>
<meta name="description" content="<? echo $_CATE_NAME; ?> Products Page. JILL STUART Beauty Official Site.">
<meta name="keywords" content="<? echo $_CATE_NAME; ?>, Product, <? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/keywords.php"); ?>">
<title><? echo $_CATE_NAME; ?><? if(strcmp($_CATE_NAME,"")!=0) { ?> | <? } ?>PRODUCTS | <? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/title.php"); ?></title>

<? include($_SERVER['DOCUMENT_ROOT']."/includes/meta.php"); ?>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/misc.php"); ?>
<script type="text/javascript" src="/common/js/unveil-master/jquery.unveil.js"></script>

<link rel="stylesheet" media="all" href="/common/css/second.css" />
<link rel="stylesheet" type="text/css" href="/common/products/index/index.css">
<script type="text/javascript" src="/common/products/index/index.js"></script>

<!-- Open Graph Protocol -->
<meta property="og:type" content="website">
<meta property="og:title" content=" <? echo $_CATE_NAME; ?> - JILL STUART Beauty Official Site.">
<meta property="og:url" content="http://<? echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" />
<meta property="og:description" content="<? echo $_CATE_NAME; ?>, Product List Page.">
<meta property="og:site_name" content="JILL STUART Beauty">
<meta property="og:image" content="http://www.jillstuart-beauty.com/common/images/facebook/fb_thumb.jpg">

<script type="text/javascript"><!--
function view(c, s, v, p, cnt){
    var obj = document.forms["product"];
    obj.method = "post";
    obj.c.value = c;
    obj.s.value = s;
    obj.v.value = v;
    obj.p.value = p;
    obj.cnt.value = cnt;
    obj.submit();
}
--></script>
<style type="text/css">
.gnavi li.product a{border-color:#333 !important;}
.products_menu ul li.<? echo "_" . str_replace (" ", "_", $p_category); ?> {border-bottom-color:#E9AEA7;}
</style>
</head>

<body <? if(is_smartphone()) { echo 'class="smartphone"'; } ?>>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/analyticstracking.php"); ?>

<div class="container">

<form name="product" method="post" action="./list.php">
<input type="hidden" name="c" value="<? echo $p_category; ?>">	<!-- category -->
<input type="hidden" name="s" value="<? echo $p_sort; ?>">			<!-- sort (desc/asc) *not use -->
<input type="hidden" name="v" value="<? echo $p_value; ?>">		<!-- search value -->
<input type="hidden" name="p" value="<? echo $p_page; ?>">			<!-- page -->
<input type="hidden" name="cnt" value="<? echo $p_count; ?>">		<!-- items per page -->
</form>

<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/header.php"); ?>
	<main role="main" class="">
		<h1><a href="<? echo $_lang; ?>/products/">PRODUCTS</a></h1>
		<? include($_SERVER['DOCUMENT_ROOT']."/common/products/includes/product_category_navi.php"); ?>
		<div class="main_inner">

	<div id="body">

		<article id="content">
<?
if(count($items) > 0) {
?>
					<? include($_SERVER['DOCUMENT_ROOT']."/common/products/includes/product_pagenation.php"); ?>

					<!-- 一覧 -->
					<div class="CMP_itemlist_3">

						<ul>
<?
	$no = 0;
	foreach ($items as $w_item) {
		$no++;
		if((($p_page-1)*$p_count) < $no && ($p_page*$p_count) >= $no) {
?>
								<li> <a href="detail.php?jan=<? echo $w_item->code; ?>"> <img class="thumbnail lazy" data-src="<? echo $w_item->photo->thumb; ?>" src="/common/fashionshows/index/image.gif" width="198" height="198" alt="<? echo $w_item->en; ?>" />
									<h5><? echo $w_item->en; ?><? if(strcmp($w_item["newIcon"], "on")==0) { ?><br /><span style="color:#fff; background:#000; padding:4px 16px; font-size:10px;">NEW</span><? } ?> </h5>
									<!--strong>no data</strong--> </a>
								</li>
<?
		}
	}
?>
						</ul>

					</div>
					<div class="bottom">
					<? include($_SERVER['DOCUMENT_ROOT']."/common/products/includes/product_pagenation.php"); ?>
					</div>
<?
}
else { ?>
	<div style="font-size:20px; text-align:left; margin:20px 0 170px;">"<? echo $p_value; ?>" not found.</div>
<?
}
?>
		</article>

			</div>
		</div>
	</main>
	<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/footer.php"); ?>
</div>
</body>
</html>
