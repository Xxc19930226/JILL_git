		<div class="category_navi">
			<div class="current">
<?
	if(strcmp($p_value,"") == 0) {
		if(strcmp($p_category,"")==0) {
			echo 'All';
		}
		else {
			echo ucwords(str_replace ("and", " &amp; ", $p_category));
		}
	}
	else {
			echo '&quot; ' . $p_value . '&quot';
	}
?>
			</div>
			<div class="category_list">
				<a href="<? echo $_lang; ?>/products/list.php">All</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=bathandbody">Bath &amp; Body</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=skincare">Skincare</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=basemake">Basemake</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=eyes">Eyes</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=cheeks">Cheeks</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=lips">Lips</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=nails">Nails</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=fragrance">Fragrance</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=tools">Tools</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=suncare">Suncare</a>
				<div class="series">Series</div>
				<a href="<? echo $_lang; ?>/products/list.php?c=JILL STUART RELAX">JILL STUART RELAX</a>
				<!--<a href="<? echo $_lang; ?>/products/list.php?c=2013 Summer Collection">2013 Summer Collection</a>-->
				<a href="<? echo $_lang; ?>/products/list.php?c=JILL STUART ANGEL">JILL STUART ANGEL</a>
				<!--<a href="<? echo $_lang; ?>/products/list.php?c=JILL STUART BON MARIAGE">JILL STUART BON MARIAGE</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=2013 Fall Collection">2013 Fall Collection</a>-->
				<div class="search">
<form name="search" method="post" action="<? echo $_lang; ?>/products/list.php">
<input type="hidden" name="c" value="">
<input type="hidden" name="s" value="">
<input type="hidden" name="p" value="1">
<input type="hidden" name="cnt" value="40">
					<input type="text" value="" placeholder="SEARCH" name="v" class="inputarea search" id="searchSuggest" value="<?php echo $p_value; ?>">
					<input type="submit" value="検索">
</form>
				</div>
			</div>
		</div>
<ul>
