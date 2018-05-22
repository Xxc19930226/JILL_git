			<!-- LEFT BEGIN -->

				<div class="products_menu">

					<ul>
						<li class="_bathandbody"><a href="<? echo $_lang; ?>/products/list.php?c=bathandbody">Bath&amp;Body</a></li>
						<li class="_skincare"><a href="<? echo $_lang; ?>/products/list.php?c=skincare">Skincare</a>
						<li class="_fragrance"><a href="<? echo $_lang; ?>/products/list.php?c=fragrance">Fragrance</a></li>
						<li class="_cheeks"><a href="<? echo $_lang; ?>/products/list.php?c=cheeks">Cheeks</a></li>
						<li class="_eyes"><a href="<? echo $_lang; ?>/products/list.php?c=eyes">Eyes</a></li>
						<li class="_lips"><a href="<? echo $_lang; ?>/products/list.php?c=lips">Lips</a></li>
						<li class="_nails"><a href="<? echo $_lang; ?>/products/list.php?c=nails">Nails</a></li>
						<li class="_basemake"><a href="<? echo $_lang; ?>/products/list.php?c=basemake">Basemake</a></li>
						<li class="_suncare"><a href="<? echo $_lang; ?>/products/list.php?c=suncare">Suncare</a></li>
						<li class="_tools"><a href="<? echo $_lang; ?>/products/list.php?c=tools">Tools</a></li>
					</ul>

					<h3>Series</h3>
					<ul>
						<li class="_JILLSTUART_RELAX"><a href="<? echo $_lang; ?>/products/list.php?c=JILLSTUART RELAX">JILLSTUART RELAX</a></li>
						<li class="_2013_Spring_Collection"><a href="<? echo $_lang; ?>/products/list.php?c=2013 Spring Collection">2013 Spring Collection</a>
					</ul>

					<h3>Item Search</h3>
					<div class="search_box">
						<form name="search" method="post" action="./list.php">
						<input class="inputarea search" type="text" name="v" id="search-input" value="<?php echo $p_value; ?>" />
						<input type="hidden" name="c" value="">
						<input type="hidden" name="s" value="">
						<input type="hidden" name="p" value="1">
						<input type="hidden" name="cnt" value="<?php echo $p_count; ?>">
						</form>
						<a href="javascript:document.forms['search'].submit();" class="input_btn">検索</a>
					</div>

				</div>

			<!-- LEFT END -->
