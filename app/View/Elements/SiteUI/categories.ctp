<ul>
<?
	$subcat = $aSubcategories[0];
?>
	<li id="cat-<?=$subcat['Category']['id']?>">
		<a href=""><?=$subcat['Category']['title']?></a>
		<ul>

<?
	$cat = Hash::get($aSubcategories[0], 'Category.id');
	foreach($aSubcategories as $subcat) {
		if ($cat != $subcat['Category']['id']) {
			$cat = $subcat['Category']['id'];
?>
		</ul>
	</li>
<?
			$current = (isset($currCat) && $currCat == $cat) ? ' class="current"' : '';
?>
	<li id="cat-<?=$subcat['Category']['id']?>"<?=$current?>>
		<a href=""><?=$subcat['Category']['title']?></a>
		<ul>
<?			
		}
		$url = array('controller' => 'SiteProducts', 'action' => 'index', '?' => array('data[Product][cat_id]' => $subcat['Category']['id'], 'data[Product][subcat_id]' => $subcat['Subcategory']['id']));
		$current = (isset($currSubcat) && $currSubcat == $subcat['Subcategory']['id']) ? ' class="active"' : '';
?>
			<li<?=$current?>><a href="<?=$this->Html->url($url)?>"><?=$subcat['Subcategory']['title']?></a></li>
<?
	}
?>
		</ul>
	</li>
</ul>
