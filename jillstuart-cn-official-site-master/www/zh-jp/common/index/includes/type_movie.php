					<div class="article_box movie">
						<div class="article_box_inner">
							<div class="video">
								<? echo $w_news->movie; ?>
							</div>

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
								<span class="content">
									<span class="date"><? echo $w_news->icon; ?> / <? echo $w_news->date; ?></span>
									<span class="title" style=""><? echo nl2br($w_news->title); ?></span>
<?		if(strcmp($w_news->subtitle,"")!=0) { ?>
									<span class="subtitle" style=""><? echo nl2br($w_news->subtitle); ?></span>
<?		} ?>
								</span>
							</a>
						</div>
					</div>