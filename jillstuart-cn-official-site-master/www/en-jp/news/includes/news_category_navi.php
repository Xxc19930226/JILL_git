<?
	if(strcmp($p_value,"") == 0) {
?>
		<div class="category_navi">
			<div class="current">
<?
		if(strcmp($p_category,"")==0) {
			echo 'All';
		}
		else {
			echo strtoupper(str_replace ("and", " &amp; ", $p_category));
		}
?>
			</div>
			<div class="category_list">
				<!--<a href="<? echo $_lang; ?>/news/?c=campaign">CAMPAIGN</a>-->
				<a href="<? echo $_lang; ?>/news/?c=new item">NEW ITEM</a>
				<a href="<? echo $_lang; ?>/news/?c=pickup item">PICKUP ITEM</a>
				<!--<a href="<? echo $_lang; ?>/news/?c=news and event">NEWS &amp; EVENT</a>-->
				<a href="<? echo $_lang; ?>/news/?c=fashion shows">FASHION SHOWS</a>
				<a href="<? echo $_lang; ?>/news/?c=social">SOCIAL</a>
				<!--li><a href="<? echo $_lang; ?>/news/?c=staff blog">STAFF BLOG</a>-->
			</div>
		</div>
<?
	}
	else {
			/*echo 'Search Result &quot; ' . $p_value . '&quot';*/
	}
?>
