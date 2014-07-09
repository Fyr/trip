<?
	$this->Html->css('jquery.fancybox.css', array('inline' => false));
	$url = '/SiteProducts?data%5BProduct%5D%5Bcat_id%5D='.$article['Category']['id'].'&data%5BProduct%5D%5Bsubcat_id%5D='.$article['Subcategory']['id'];
?>
<div class="section">
	<?=$this->element('/SiteUI/page_title')?>
	<b><?=__('Category')?></b>: <?=$article['Category']['title']?><br/>
	<b><?=__('Subcategory')?></b>: <a href="<?=$url?>"><?=$article['Subcategory']['title']?></a><br/>
	<b><?=__('Owner')?></b>: <a href="<?=$this->Html->url(array('controller' => 'SiteAdvertisers', 'action' => 'view', $article['Advertiser']['slug']))?>"><?=$article['Advertiser']['title']?></a><br/>
	<br/>
<?
	if ($aMedia) {
		foreach($aMedia as $media) {
?>
	<a class="fancybox" href="<?=$this->Media->imageUrl($media, 'noresize')?>" rel="gallery">
		<img src="<?=$this->Media->imageUrl($media, '100x80')?>" alt="" />
	</a>
<?
		}
?>
<script type="text/javascript">
$(document).ready(function(){
	$('.fancybox').fancybox({
		padding: 5
	});
});
</script>
<?
	}
?>
<?=$article['Product']['body']?>
<h3><?=__('Details')?></h3>
<?
	foreach($techParams as $row) {
?>
<b><?=$row['FormField']['label']?></b>: <?=$row['PMFormValue']['value']?><br/>
<?
	}
?>
<?php if ($related) { ?>
<h3><?=__('Related products')?></h3>
<ul>
<?php foreach($related as $rel) : ?>
    <li><?= $this->Html->link($rel['Product']['title'], array('controller' => 'SiteProducts', 'action' => 'view', $rel['Product']['id'])) ?></li>
<?php endforeach; ?>
</ul>
<?php } ?>
</div>