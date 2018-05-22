		<div class="category_navi">
			<div class="current"><?
	if(strcmp($p_value,"") == 0) {
		if(strcmp($p_category,"")==0) {
			echo 'All';
		}
		else {
			echo strtoupper(str_replace ("and", " &amp; ", $p_category));
		}
	}
	else {
			echo 'Search Result &quot; ' . $p_value . '&quot';
	}
?></div>
			<div class="category_list"><!--<a href="<? echo $_lang; ?>/news/?c=campaign">CAMPAIGN</a>--><a href="<? echo $_lang; ?>/news/?c=new item">新品</a> <a href="<? echo $_lang; ?>/news/?c=pickup item">热销商品</a> <!--<a href="<? echo $_lang; ?>/news/?c=news and event">NEWS &amp; EVENT</a>--> <a href="<? echo $_lang; ?>/news/?c=fashion shows">时装秀</a> <a href="<? echo $_lang; ?>/news/?c=social">社交</a><!--li><a href="<? echo $_lang; ?>/news/?c=staff blog">STAFF BLOG</a>--></div>
		</div>
<ul>
