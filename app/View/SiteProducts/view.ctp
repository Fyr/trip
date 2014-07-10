<?
	$this->Html->css('jquery.fancybox.css', array('inline' => false));
	$url = '/SiteProducts?data%5BProduct%5D%5Bcat_id%5D='.$article['Category']['id'].'&data%5BProduct%5D%5Bsubcat_id%5D='.$article['Subcategory']['id'];
?>
<div class="section">
	<?=$this->element('/SiteUI/page_title')?>
	<b><?=__('Category')?></b>: <?=$article['Category']['title']?><br/>
	<b><?=__('Subcategory')?></b>: <a href="<?=$url?>"><?=$article['Subcategory']['title']?></a><br/>
<?php
    if (isset($article['Advertiser'])) {
	$allowOwnerParam = array(
	    'title' => 'Name',
	    'descr' => 'Description',
	    'contacts' => 'Contacts',
	    'booking' => 'Booking'
	);
	?>
	<b><?=__('Owner')?></b>:<br/>
	<div class="infoParam">
	    <?php
	    $article['Advertiser']['title'] = $this->Html->link(
		$article['Advertiser']['title'],
		array(
		    'controller' => 'SiteAdvertisers',
		    'action' => 'view',
		    $article['Advertiser']['slug']
		)
	    );
	    foreach ($article['Advertiser'] as $key => $val) {
		if (isset($allowOwnerParam[$key]) && $article['Advertiser'][$key]) {
		    echo '<i>'.__($allowOwnerParam[$key]).'</i>: '.trim($article['Advertiser'][$key]).'<br>';
		}
	    }
	    ?>
	</div>
	<?php
    }
    
    if (isset($company['Company'])) {
	$allowCompanyParam = array(
	    'name' => 'Name',
	    'address' => 'Address',
	    'phone' => 'Phone',
	    'website' => 'Website',
	    'email' => 'Email',
	    'skype' => 'Skype',
	    'facebook' => 'Facebook'
	);
	?>
	<b><?=__('Company')?></b>:<br/>
	<div class="infoParam">
	    <?php
	    foreach ($company['Company'] as $key => $val) {
		if (isset($allowCompanyParam[$key]) && $company['Company'][$key]) {
		    echo '<i>'.__($allowCompanyParam[$key]).'</i>: '.$company['Company'][$key].'<br>';
		}
	    }
	    ?>
	</div>
	<?php
    }
?>
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
<?php
    echo $article['Product']['body'];
    if ($techParams) {
	echo '<h3>'.__('Details').'</h3>';
	foreach($techParams as $row) {
	    echo '<b>'.$row['FormField']['label'].'</b>: '.$row['PMFormValue']['value'].'<br/>';
	}
    }
    if ($related) {
	echo '<h3>'.__('Related products').'</h3>';
	echo '<ul>';
	foreach($related as $rel) {
	    echo '<li>'.$this->Html->link($rel['Product']['title'], array('controller' => 'SiteProducts', 'action' => 'view', $rel['Product']['id'])).'</li>';
	}
	echo '<ul>';
    }
?>
</div>