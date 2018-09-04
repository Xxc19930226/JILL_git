<? echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/lang.php"); ?>
<?
	$_COUNT = 20;
	$p_jan = isset($_GET['jan']) ? $_GET['jan'] : "";
	if (file_exists('products1.xml')) {
		$xml = simplexml_load_file("products1.xml");
	}
	$items = array();
	$items = $xml->xpath('channel/item[code="' . $p_jan. '"]');
	/*var_dump($items);*/
	/*if(count($items)>0) {*/
?>
<!DOCTYPE html>
<html lang="ja">
<head>

<meta charset="utf-8">
<meta name="description" content="<? echo $items[0]->en; ?> Products Detail Page. JILL STUART Beauty Official Site.">
<meta name="keywords" content="<? echo $items[0]->en; ?>, Product, <? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/keywords.php"); ?>">
<title><? echo $items[0]->en; ?> | PRODUCTS | <? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/title.php"); ?></title>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/meta.php"); ?>
<? include($_SERVER['DOCUMENT_ROOT']."/includes/misc.php"); ?>
<script type="text/javascript" src="/common/js/unveil-master/jquery.unveil.js"></script>

<link rel="stylesheet" media="all" href="/common/css/second.css" />
<link rel="stylesheet" type="text/css" href="/common/products/index/index.css">
<script type="text/javascript" src="/common/products/index/index.js"></script>

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

<!-- Open Graph Protocol -->
<meta property="og:type" content="website">
<meta property="og:title" content="<? echo $items[0]->en; ?>" />
<meta property="og:url" content="http://<? echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" />
<meta property="og:site_name" content="JILL STUART Beauty" />
<meta property="og:image" content="<? echo "http://" . $_SERVER["HTTP_HOST"] . $_lang . "/products/" . $items[0]->photo->detail0; ?>" />
<meta property="og:description" content="<? echo $items[0]->t0; ?>" />

<script type="text/javascript">
<!--
var photos = new Array(
<?
if(strcmp($items[0]->photo->detail0, "")!=0) {
/* リストの場合 */
	if(strcmp($items[0]->photo->detail1, "")!=0) {
?>
		"<? echo $items[0]->photo->detail0; ?>",
		"<? echo $items[0]->photo->detail1; ?>",
		"<? echo $items[0]->photo->detail2; ?>",
		"<? echo $items[0]->photo->detail3; ?>",
		"<? echo $items[0]->photo->detail4; ?>"
<?
	}
}
else {
/* 配列の場合 */
	if( count($items[0]->photo->details->detail) > 1 ) {
			$details = array();
			foreach ( $items[0]->photo->details->detail as $detail) {
				$details[] = "'" . $detail . "'";
			}
			echo implode(",", $details );
	 	}
	}
?>
);

function changePhoto(no){
	$('.itempict img.photo').fadeOut("fast", function(){ ($('.itempict img.photo').attr("src",photos[no])).fadeIn("slow"); });
}
-->
</script>
<?	if(count($items)<=0) { ?>
<script language="JavaScript"><!--
function relocale(){
    time = 5000;
    setTimeout('location.href="<? echo $_lang; ?>/"',time);
}
//--></script>
<?	} ?>

<style type="text/css">
.gnavi li.product a{border-color:#333 !important;}
</style>
</head>

<?	if(count($items)>0) { ?>
<body <? if(is_smartphone()) { echo 'class="smartphone"'; } ?>>
<?	}
	else { ?>
<body onLoad="relocale()">
<?	} ?>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/analyticstracking.php"); ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="container">
<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/header.php"); ?>
	<main role="main" class="">
		<h1><a href="<? echo $_lang; ?>/products/">PRODUCTS</a></h1>
		<div class="main_inner">
			<div id="body">
				<article id="content_wide">
<?	if(count($items)>0) { ?>
					<? include($_SERVER['DOCUMENT_ROOT']."/common/products/includes/product_detail.php"); ?>
<?	}
	else { ?>
				<div class="itemdetail">
					<div class="fac_item">
						<h3>Not Found</h3>
						<p>The requested URL was not found on this server. </p>
						<div id="product_detail_short">
							<div class="list"><p>You will be redirected to the <a href="<? echo $_lang; ?>/">Top page</a> in 5 seconds.</p></div>
						</div>
						<p></p>
					</div>
				</div>
<?	} ?>
				</article>
			</div>
		</div>
	</main>
	<? include($_SERVER['DOCUMENT_ROOT'].$_lang."/includes/footer.php"); ?>
</div>
</body>
</html>
