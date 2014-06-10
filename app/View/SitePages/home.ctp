<ul class="index_categories_list">
<?
	$aColors = array('CC51A4', 'DB4132', '454BDD', '15A78C', '8FBD22', 'E7713B');
	$pickColor = 0;
	foreach($aCategoryArticles as $article) {
		$this->ArticleVars->init($article, 'Category', $url, $title, $teaser, $src, '190x', $featured, $id);
		$url = $this->Html->url(array('controller' => 'SiteProducts', '?' => 'data[Product][cat_id]='.$id));
		
		$cat = $article['Category'];
		$bkg = ($cat['color']) ? $cat['color'] : $aColors[$pickColor];
		$pickColor++;
		if ($pickColor >= count($aColors)) {
			$pickColor = 0;
		}
		$src = ($src) ? 'background: url('.$src.') no-repeat;' : '';
		
?><!--
				--><li class="index_category" style="background: #<?=$bkg?>">
					<a href="<?=$url?>">
						<span class="index_category_img" style="<?=$src?>">
						</span>
						<span class="index_category_head">
							<span class="index_category_head_t">
								<span class="index_category_head_tc"><?=$title?></span>
							</span>
							<span class="index_category_arr"></span>
						</span>
					</a>
				</li><!--
--><?
	}
?>
			</ul>