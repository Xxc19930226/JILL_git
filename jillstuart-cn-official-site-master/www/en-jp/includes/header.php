	<header role="banner" class="">
<?
if (file_exists($_SERVER['DOCUMENT_ROOT'].$_lang.'/index/banner.xml')) {
	$xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].$_lang."/index/banner.xml");
}
$bannerlist = $xml->xpath('channel/banner');
$tickerlist = $xml->xpath('channel/ticker');

if(count($bannerlist) > 0 || count($tickerlist) > 0) {
?>
		<div class="top_banner">
<?
	if(count($bannerlist) > 0) {
?>
			<div class="hide_banner">
				<div class="hide_banner_inner">
					<div class="hide_banner_img">
						<ul>
<?		foreach ($bannerlist as $w_banner) { ?>
							<li>
<?			if(strcmp($w_banner->more,"")!=0) {
				if(strcmp($w_banner->moresmp, "")!=0) { ?>
								<a class="moresmp" href="<? echo $w_banner->more; ?>" target="<? echo $w_banner->moresmp["target"];?>" smphref="<? echo $w_banner->moresmp; ?>">
<?				}
				else { ?>
								<a href="<? echo $w_banner->more; ?>" target="<? echo $w_banner->more["target"];?>">
<?				} ?>
									<img width="" height="" alt="" src="<? echo $w_banner->image; ?>" draggable="false">
								</a>
<?			}
			else { ?>
								<img width="" height="" alt="" src="<? echo $w_banner->image; ?>" draggable="false">
<?			} ?>
							</li>
<?		} ?>
						</ul>
					</div>
				</div>
			</div>
<?	}
	if(count($bannerlist) > 0 || count($tickerlist) > 0) { ?>
			<div class="top_message">
				<div class="top_message_inner">
<?
		if(count($bannerlist) > 0) {
?>
					<div class="hide_banner_show">CHECK</div>
<?		}
		if(count($tickerlist) > 0) { ?>
					<div class="top_message_text">
						<ul>
<?			foreach ($tickerlist as $w_ticker) { ?>
							<li class="news_item">
<?				if(strcmp($w_ticker->more,"")!=0) {
					if(strcmp($w_ticker->moresmp, "")!=0) { ?>
								<a class="moresmp" href="<? echo $w_ticker->more; ?>" target="<? echo $w_ticker->moresmp["target"];?>" smphref="<? echo $w_ticker->moresmp; ?>">
<?					}
					else { ?>
								<a href="<? echo $w_ticker->more; ?>" target="<? echo $w_ticker->more["target"];?>">
<?					} ?>
									<? echo $w_ticker->text; ?>
								</a>
<?				}
				else { ?>
								<? echo $w_ticker->text; ?>
<?				} ?>
							</li>
<?			} ?>
						</ul>
					</div>
<?		} ?>
				</div>
			</div>
<?	} ?>
		</div>
<?
}
?>
		<div class="header_inner">
			<div class="logo_area">
				<div class="logo"><a href='<? echo $_lang; ?>/'>JILL STUART Beauty</a></div>

			</div>
			<div class="button_area">
				<div class="button_menu">MENU</div>
<?	if(count($bannerlist) > 0) { ?>
				<div class="button_banner">CHECK</div>
<?	} ?>
			</div>

			<div class="gnavi">
				<div class="gnavi_inner">
					<ul class="first">
						<li class="home"><a href="<? echo $_lang; ?>/"><span>HOME</span></a></li>
						<li class="about"><a href="<? echo $_lang; ?>/about/"><span>ABOUT JILL STUART</span></a></li>
						<li class="product"><a href="<? echo $_lang; ?>/products/"><span>PRODUCTS</span></a>
							<div class="gnavi_product">
								<div class="gnavi_product_inner row">
									<div class="col span_2">
										<ul class="body">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=bathandbody">BATH &amp; BODY</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="skincare">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=skincare">SKINCARE</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="fragrance">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=fragrance">FRAGRANCE</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="cheeks">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=cheeks">CHEEKS</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="eyes">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=eyes">EYES</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="lips">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=lips">LIPS</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="nails">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=nails">NAILS</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="tools">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=tools">TOOLS</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="basemake">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=basemake">BASEMAKE</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="suncare">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=suncare">SUNCARE</a></li>
										</ul>
									</div>
								</div>
								<div class="gnavi_product_inner row series">
									<div class="series_title">SERIES</div>
									<div class="col">
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=JILL STUART BON MARIAGE">JILL STUART BON MARIAGE</a></div>
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=JILL STUART ANGEL">JILL STUART ANGEL</a> </div>
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=JILL STUART RELAX">JILL STUART RELAX</a></div>
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=crystal bloom">JILL STUART Crystal Bloom</a></div>
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=crystal bloom solid perfume">JILL STUART Crystal Bloom solid perfume</a></div>
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=ballet stories collection">JILL STUART ballet stories collection</a></div>
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=2015 Spring Collection">JILL STUART 2015 Spring Collection</a></div>
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=Chiffon Ribbon Collection">JILL STUART Chiffon Ribbon Collection</a></div>
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=new powder foundation">JILL STUART new powder foundation</a></div>
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=new cc cream">JILL STUART new CC cream & Limited items</a></div>
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=Aqua Chiffon">JILL STUART RELAX new item & limited item</a></div>
									</div>
								</div>
							</div>
							<div class="close">CLOSE</div>
						</li>
						<li class="newon"><a href="<? echo $_lang; ?>/news/"><span>NEWS</span></a></li>
						<li class="fashion"><a href="<? echo $_lang; ?>/fashionshows/"><span>FASHION SHOWS</span></a></li>
						<li class="shoplist"><a href="<? echo $_lang; ?>/shop/"><span>SHOP LIST</span></a></li>
					</ul>
				</div>

				<div class="snavi">
					<div class="snavi_sparator"></div>
					<div class="snavi_innner">
						<ul>
							<li class="search">
<form name="search" method="post" action="<? echo $_lang; ?>/products/list.php">
<input type="hidden" name="c" value="">
<input type="hidden" name="s" value="">
<input type="hidden" name="p" value="1">
<input type="hidden" name="cnt" value="40">
									<input type="text" value="" placeholder="SEARCH" name="v" class="inputarea search" id="searchSuggest" value="<?php echo $p_value; ?>">
									<input type="submit" value="検索">
</form>
							</li>
						</ul>
					</div>
				</div>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/locale.php"); ?>


			</div>
		</div>

	</header>

