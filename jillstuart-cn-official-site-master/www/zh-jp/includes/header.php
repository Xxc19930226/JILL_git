<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-41491855-8', 'auto');
	  ga('send', 'pageview');

</script>

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
											<li><a href="<? echo $_lang; ?>/products/list.php?c=bathandbody">沐浴&amp;身体</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="skincare">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=skincare">护肤</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="fragrance">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=fragrance">香水</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="cheeks">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=cheeks">腮红</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="eyes">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=eyes">眼妆</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="lips">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=lips">唇妆</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="nails">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=nails">美甲</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="tools">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=tools">化妆工具</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="basemake">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=basemake">底妆</a></li>
										</ul>
									</div>
									<div class="col span_2">
										<ul class="suncare">
											<li><a href="<? echo $_lang; ?>/products/list.php?c=suncare">防晒</a></li>
										</ul>
									</div>
								</div>
								<div class="gnavi_product_inner row series">
									<div class="series_title">系列</div>
									<div class="col">
										<!--
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=2013 Fall Collection">2013 Fall Collection</a></div>
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=JILL STUART BON MARIAGE">JILL STUART BON MARIAGE</a></div>
									-->
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=JILL STUART ANGEL">JILL STUART ANGEL</a> </div>
										<!--
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=2013 Summer Collection">2013 Summer Collection</a></div>
									-->
										<div class="li"><a href="<? echo $_lang; ?>/products/list.php?c=JILL STUART RELAX">JILL STUART RELAX</a></div>
										<div class="li"><a href="<? echo $_lang; ?>/new-item/2016/0104_xp/">JILL STUART 2017 Spring Collection</a></div>
									</div>
								</div>
							</div>
							<div class="close">CLOSE</div>
						</li>
						<li class="newon"><a href="<? echo $_lang; ?>/news/?c=new item"><span>NEWS</span></a></li>
						<li class="fashion"><a href="<? echo $_lang; ?>/fashionshows/"><span>FASHION SHOWS</span></a></li>
						<li class="shoplist"><a href="<? echo $_lang; ?>/shop/"><span>SHOP LIST</span></a></li>
						<li class="shoplist"><a href="http://kose.oms.d1mgroup.com" target="_blank"><span>MEMBERS CLUB</span></a></li>
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

