
				<div class="article_box <? echo $w_news["pattern"]; ?> blog">
<?	if(strlen($w_news->photo)>0) { ?>
					<div class="image_wrapper">
<?		if(strlen($w_news->more)>0) {
			if(strcmp($w_news->moresmp, "")!=0) { ?>
						<a class="moresmp" href="<? echo $w_news->more; ?>" target="<? echo $w_news->moresmp["target"];?>" smphref="<? echo $w_news->moresmp; ?>">
<?			}
			else { ?>
						<a href="<? echo $w_news->more; ?>" target="<? echo $w_news->more["target"];?>">
<?			}
		} ?>
							<div class="photo">
								<img class="lazy" data-src="<? echo $w_news->photo; ?>" src="/common/fashionshows/index/image.gif" alt="<? echo $w_news->title; ?>" />
							</div>
<?		if(strlen($w_news->more)>0) { ?>
						</a>
<?		} ?>
					</div>
<?	}
	if(strlen($w_news->icon)>0) { ?>
					<div class="icon_wrapper">
						<div class="icon"><? echo str_replace("AND", " <span class=and>&amp;</span> ", $w_news->icon); ?></div>
					</div>
<?	} ?>
					<div class="date"><? echo $w_news->date; ?></div>

<?	if(strlen($w_news->title)>0) {
		if(strlen($w_news->more)>0) {
			if(strcmp($w_news->moresmp, "")!=0) { ?>
					<a class="moresmp" href="<? echo $w_news->more; ?>" target="<? echo $w_news->moresmp["target"];?>" smphref="<? echo $w_news->moresmp; ?>">
<?			}
			else { ?>
					<a href="<? echo $w_news->more; ?>" target="<? echo $w_news->more["target"];?>">
<?			}
		} ?>
						<div class="title"> <? echo $w_news->title; ?> </div>
<?		if(strlen($w_news->more)>0) { ?>
					</a>
<?		}
	}
	if(strlen($w_news->subtitle)>0) { ?>
					<div class="subtitle"> <? echo $w_news->subtitle; ?> </div>
<?	}
	if(strlen($w_news->detail)>0) {
		if(strcmp($w_news->detail["type"], "html")==0) { ?>
					<div class="detail"><? echo $w_news->detail; ?></div>
<?		}
		else { ?>
					<div class="detail"><? echo nl2br($w_news->detail); ?></div>
<?		}
	}
	if(strlen($w_news->more)>0) { ?>
					<div class="more">
<?		if(strcmp($w_news->moresmp, "")!=0) { ?>
						<a class="moresmp" href="<? echo $w_news->more; ?>" target="<? echo $w_news->moresmp["target"];?>" smphref="<? echo $w_news->moresmp; ?>">more</a>
<?		}
		else { ?>
						<a href="<? echo $w_news->more; ?>" target="<? echo $w_news->more["target"];?>">more</a>
<?		} ?>
					</div>
<?	} ?>
				</div>