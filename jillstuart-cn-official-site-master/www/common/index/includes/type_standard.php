					<div class="article_box normal standard">
						<div class="article_box_inner">
<?	if(strcmp($w_news->more, "")!=0) {
		if(strcmp($w_news->moresmp, "")!=0) { ?>
							<a class="moresmp" href="<? echo $w_news->more; ?>" target="<? echo $w_news->moresmp["target"];?>" smphref="<? echo $w_news->moresmp; ?>">
<?		}
		else { ?>
							<a href="<? echo $w_news->more; ?>" target="<? echo $w_news->more["target"];?>">
<?		}
	}
	else { ?>
							<a href="<?  echo $_lang; ?>/news/?i=<? echo $w_news->id;  ?>"> 
<?	} ?>

								<div class="photo">
									<img class="thumbnail lazy" data-src="<? echo $w_news->thumbnail; ?>" src="/common/fashionshows/index/image.gif" alt="<? echo $w_news->title; ?>" />
								</div>
								<span class="cover"></span>
								<span class="icon_wrapper"><span class="icon"><? echo $w_news->icon; ?></span></span>
								<span class="content">
									<? /*<span class="date"><? echo $w_news->icon; ?> / <? echo $w_news->date; ?></span> */?>
									<span class="title" style="padding: 1em 0 8px;"><? echo nl2br($w_news->title); ?></span>
<?		if(strcmp($w_news->subtitle,"")!=0) { ?>
									<span class="subtitle" style=""><? echo nl2br($w_news->subtitle); ?></span>
<?		} ?>
								</span>
							</a>
						</div>
					</div>

<!--					 <img src="bg.png" data-src="img2.jpg" data-src-retina="img2-retina.jpg" />-->
