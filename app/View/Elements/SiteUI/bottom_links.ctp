			<ul>
<?
	foreach($aBottomLinks as $id => $item) {
		$class = (strtolower($id) == strtolower($currLink)) ? ' class="current"' : '';
?>
				<li<?=$class?>><?=$this->Html->link($item['label'], $item['href'])?></li>
<?
	}
?>
			</ul>
