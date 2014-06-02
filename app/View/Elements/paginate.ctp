<style type="text/css">
.paging {
	text-align: center;
}
</style>
<?
	if ($this->Paginator->numbers()) {
?>
<div class="paging">
	<?=__('Page')?>: <?=$this->Paginator->numbers()?>
</div>
<?
	}
?>