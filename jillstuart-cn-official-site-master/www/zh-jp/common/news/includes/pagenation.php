					<div class="pagenavi">
						<p class="result">
<?php
/* Total Page */
$w_totalnews = count($newslist);
$w_totalpage = floor($w_totalnews/$p_count) + ($w_totalnews%$p_count>0?1:0);
$w_currentcount = ($w_totalpage == $p_page ? ($w_totalnews%$p_count>0?$w_totalnews%$p_count:$p_count) : $p_count);
$w_startcount = ($p_page-1)*$p_count+1;
?>
						Showing <?php echo $w_startcount; ?> - <?php echo $w_startcount+$w_currentcount-1; ?> of <? echo $w_totalnews; ?>
						</p>
<?php if(1 < $w_totalpage) { ?>
						<ul class="navi">
							<li class="previous">
<?php if(1 < $p_page) { ?>
								<a href="javascript:view('<?php echo $p_category; ?>', '', '<?php echo $p_value; ?>', '<?php echo $p_page-1;?>', '<?php echo $p_count; ?>');" class="act">&#9668;</a>
<?php }else{ ?>
								<a href="javascript:view('<?php echo $p_category; ?>', '', '<?php echo $p_value; ?>', '<?php echo $p_page;?>', '<?php echo $p_count; ?>');">&#9668;</a>
<?php } ?>
							</li>

<?php for($i=1; $i<=$w_totalpage; $i++) { ?>
							<li><a href="javascript:view('<?php echo $p_category; ?>', '', '<?php echo $p_value; ?>', '<?php echo $i; ?>', '<?php echo $p_count; ?>');"<?php if(strcmp($p_page,$i)!=0){ ?> class="act"<?php } ?>><?php echo $i; ?></a></li>
<?php } ?>
							<li class="next">
<?php if($w_totalpage > $p_page) { ?>
								<a href="javascript:view('<?php echo $p_category; ?>', '', '<?php echo $p_value; ?>', '<?php echo $p_page+1;?>', '<?php echo $p_count; ?>');" class="act">&#9658;</a>
<?php }else{ ?>
								<a href="javascript:view('<?php echo $p_category; ?>', '', '<?php echo $p_value; ?>', '<?php echo $p_page;?>', '<?php echo $p_count; ?>');">&#9658;</a>
<?php } ?>
							</li>
						</ul>
<?php } ?>
					</div>

