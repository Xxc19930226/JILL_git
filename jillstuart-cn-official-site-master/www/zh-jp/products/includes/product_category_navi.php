		<div class="category_navi">
			<div class="current">
<?
$category_name = array(
'bathandbody' => '沐浴&amp;身体',
'skincare' => '护肤',
'basemake' => '底妆',
'eyes' => '眼妆',
'cheeks' => '腮红',
'lips' => '唇妆',
'nails' => '美甲',
'fragrance' => '香氛',
'tools' => '化妆工具',
'suncare' => '防晒',
'JILL STUART RELAX' => 'JILL STUART RELAX',
'2013 Summer Collection' => '2013 Summer Collection',
'JILL STUART ANGEL' => 'JILL STUART ANGEL',
'JILL STUART BON MARIAGE' => 'JILL STUART BON MARIAGE',
'2013 Fall Collection' => '2013 Fall Collection');

	if(strcmp($p_value,"") == 0) {
		if(strcmp($p_category,"")==0) {
			echo '全部';
		}
		else {
//			echo ucwords(str_replace ("and", " &amp; ", $p_category));
			echo $category_name[$p_category];
		}
	}
	else {
			echo '&quot; ' . $p_value . '&quot';
	}
?>
			</div>
			<div class="category_list">
				<a href="<? echo $_lang; ?>/products/list.php">全部</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=bathandbody">沐浴&amp;身体</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=skincare">护肤</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=basemake">底妆</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=eyes">眼妆</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=cheeks">腮红</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=lips">唇妆</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=nails">美甲</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=fragrance">香水</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=tools">化妆工具</a>
				<a href="<? echo $_lang; ?>/products/list.php?c=suncare">防晒</a>
				<div class="series">系列</div>
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
