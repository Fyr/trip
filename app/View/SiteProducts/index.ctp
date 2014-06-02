<style type="text/css">
.product {
	padding-bottom: 10px;
	border-bottom: 1px solid #000;
	margin-bottom: 10px;
}
.more {
	float: right;
}
</style>
<div class="section">
	<?=$this->element('/SiteUI/page_title')?>
<?
	foreach($products as $article) {
		$this->ArticleVars->init($article, 'Product', $url, $title, $teaser, $src, '150x');
?>
	<div class="product">
		<div style="float: left; width: 160px">
<?
		if ($src) {
?>
			<a href="<?=$url?>"><img src="<?=$src?>" alt="<?=$title?>" style="margin-right: 10px"></a>
<?
		}
?>
		</div>
		<div class="side_news_h"><a href="<?=$url?>"><?=$title?></a></div>
		<p><?=$teaser?></p>
		<a class="more" href="<?=$url?>"><?=__('read more')?> &raquo; </a>
		<div class="clearfix"></div>
	</div>
<?
	}
?>
<?
	echo $this->element('paginate');
?>
</div>