				<!-- 商品詳細 -->
				<div class="itemdetail">
					<h3><? echo $items[0]->en; ?></h3>
					<div class="fac_item">


<?
if(strcmp($items[0]->photo->detail0, "")!=0) {
/* リストの場合 */
?>
						<div class="itempict">
							<? if(strcmp($items[0]["newIcon"], "on")==0) {?><i>NEW</i><? } ?>
							<img src="<? echo $items[0]->photo->detail0; ?>" alt="<? echo $items[0]->en; ?>" name="photo" class="photo" width="380" height="380" />
						</div>
<?
	if(strcmp($items[0]->photo->detail1, "")!=0) {
?>
						<p>
							<? echo nl2br($items[0]->t0); ?>
						</p>
<?	if(strcmp($items[0]->photo->detail1, "")!=0) { ?>
						<ul class="variation">
							<li><a href="javascript:return false;" onClick="javascript:changePhoto(0);"><img src="<? echo $items[0]->photo->detail0; ?>" width="60" height="60" alt="" /></a></li>
							<li><a href="javascript:return false;" onClick="javascript:changePhoto(1);"><img src="<? echo $items[0]->photo->detail1; ?>" width="60" height="60" alt="" /></a></li>
<?		if(strcmp($items[0]->photo->detail2, "")!=0) { ?>
							<li><a href="javascript:return false;" onClick="javascript:changePhoto(2);"><img src="<? echo $items[0]->photo->detail2; ?>" width="60" height="60" alt="" /></a></li>
<?		} ?>
<?		if(strcmp($items[0]->photo->detail3, "")!=0) { ?>
							<li><a href="javascript:return false;" onClick="javascript:changePhoto(3);"><img src="<? echo $items[0]->photo->detail3; ?>" width="60" height="60" alt="" /></a></li>
<?		} ?>
<?		if(strcmp($items[0]->photo->detail4, "")!=0) { ?>
							<li><a href="javascript:return false;" onClick="javascript:changePhoto(4);"><img src="<? echo $items[0]->photo->detail4; ?>" width="60" height="60" alt="" /></a></li>
<?		} ?>
						</ul>
<? 	}
	}
}
else {
/* 配列の場合 */
		$details = array();
		$details = $items[0]->photo->details->detail;
?>
						<div class="itempict">
							<? if(strcmp($items[0]["newIcon"], "on")==0) {?><i>NEW</i><? } ?>
							<img src="<? echo $details[0]; ?>" alt="<? echo $items[0]->en; ?>" name="photo" class="photo" width="380" height="380" />
						</div>
<?
	if( count($items[0]->photo->details->detail) > 1 ) {
?>
						<p>
							<? echo nl2br($items[0]->t0); ?>
						</p>
<?	if(count($details) > 0) { ?>
						<ul class="variation">
<?		for ($i = 0 ; $i < count($details); $i++) { ?>
							<li><a href="javascript:return false;" onClick="javascript:changePhoto(<? echo $i; ?>);"><img src="<? echo $details[$i]; ?>" width="60" height="60" alt="" /></a></li>
<?		} ?>
						</ul>
<?  }
	}
}
?>

<?	if(substr_count(nl2br($items[0]->t1), "<br />") > 20) { ?>
						<div id="product_detail" >
							<div class="list">
								<p>
									<? echo nl2br($items[0]->t1); ?>
								</p>
							</div>
						</div>
<script>
	if(!is_smartphone()) { $('#product_detail .list').width(420); }
	else { $('#product_detail .list').width(auto); }
//	var scrollbar = new ScrollBar('#product_detail .list p', '#product_detail .list');
</script>
<?	}
	else { ?>
						<div id="product_detail_short" >
							<div class="list">
								<p>
									<? echo nl2br($items[0]->t1); ?>
								</p>
							</div>
						</div>
<?	} ?>

<?	if(strcmp($items[0]->banner["src"], "")!=0) { ?>
						<div id="product_banner" >
							<a href="<? echo $items[0]->banner["href"]; ?>" target="<? echo $items[0]->banner["target"]; ?>"><img src="<? echo $items[0]->banner["src"]; ?>"></a>
						</div>
<?	} ?>
<?	if(strcmp($items[0]->photo->color, "")!=0) { ?>
					<div class="fac_colors">
						<div id="product_color" >
							<img src="<? echo $items[0]->photo->color; ?>" alt="<? echo $items[0]->en; ?>" name="photo" class="photo" width="" height="" />
						</div>
					</div>
<?	} ?>
<?	if(count($items[0]->photo->colors->col)>0) { ?>
					<div class="fac_colors">
						<ul>
<?
		$cols = array();
		$cols = $items[0]->photo->colors->col;
		foreach ($cols as $col) {
?>
							<li>
								<img class="thumbnail" src="<? echo $col["src"]; ?>" width="70" height="70" />
								<h6>
									<? echo str_replace(" ", "<br />", $col["name"]); ?>
<?			if(strcmp($col["newIcon"], "on")==0) { ?>
									<br /><span style="color:#E87C6F;">[new color]</span>
<?			} ?>
								</h6>
							</li>
<?		} ?>
						</ul>
					</div>
<?	} ?>
						<div class="CMP_SNSbutton">
							<div class="twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>

							<div class="facebook"><div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true" style="border:none; overflow:hidden; width:115px; height:20px;" ></div></div>

<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
							<div class="googleplus"><g:plusone size="medium"></g:plusone></div>

<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
							<div class="pinterest"><a target="_blank" data-pin-config="none" href="//pinterest.com/pin/create/button/?url=<? echo urlencode("http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>&media=<? echo urlencode("http://" . $_SERVER["HTTP_HOST"] . $_lang ."/products/" . $items[0]->photo->detail0); ?>&description=<? echo $items[0]->en; ?> | JILL STUART Beauty" data-pin-do="buttonPin" ><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a></div>
						</div>
					</div>
				</div>
				<!-- /商品詳細 -->
