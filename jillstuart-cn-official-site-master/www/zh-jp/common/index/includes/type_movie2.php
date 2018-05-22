					<div class="article_box movie">
						<div class="article_box_inner">
<?		if(strcmp($w_news->more, "")!=0) {
			if(strcmp($w_news->moresmp, "")!=0) { ?>
							<a class="moresmp" href="<? echo $w_news->more; ?>" target="<? echo $w_news->moresmp["target"];?>" smphref="<? echo $w_news->moresmp; ?>">
<?			}
			else { ?>
							<a href="<? echo $w_news->more; ?>" target="<? echo $w_news->more["target"];?>">
<?			}
		}
		else { ?>
							<a href="<? echo $_lang; ?>/news/?i=<? echo $w_news->id; ?>">
<?		} ?>
							<div class="video">
								<div class="thumb">
									<img src="http://img.youtube.com/vi/<? echo $w_news->movieurl; ?>/hqdefault.jpg" style="margin-top:-60px; cursor:pointer;"/>
								</div>
							</div>
								<span class="content">
									<span class="date"><? echo $w_news->icon; ?> / <? echo $w_news->date; ?></span>
									<span class="title" style=""><? echo nl2br($w_news->title); ?></span>
<?		if(strcmp($w_news->subtitle,"")!=0) { ?>
									<span class="subtitle" style=""><? echo nl2br($w_news->subtitle); ?></span>
<?		} ?>
								</span>
						</div>
							</a>
					</div>

