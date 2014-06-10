<p><?=__('Check parameters that will be used for Products and click Save (Apply) button')?></p>
<?
	$actions = $this->PHTableGrid->getDefaultActions('FormField');
	$url = $this->Html->url(array('controller' => 'AdminFields', 'action' => 'edit', '0'));
    $actions['table']['add']['href'] = $url;
    $actions['table']['add']['label'] = $this->ObjectType->getTitle('create', 'FormField');
    unset($actions['table']['filter']);
    
    echo $this->PHTableGrid->render('FormField', array(
        'actions' => $actions
    ));
    
?>
<script type="text/javascript">
$(document).ready(function(){
	var $grid = $('#grid_FormField');
	
	var vals = $('#FormKeyFieldId').val().split(',');
	for(var i = 0; i < vals.length; i++) {
		$('.grid-chbx-row[value=' + vals[i] + ']', $grid).click();
	}
	$('.form-3actions button[type=submit]').click(function(){
		var vals = [];
		$('.grid-chbx-row:checked', $grid).each(function(){
			vals.push($(this).val());
		});
		$('#FormKeyFieldId').val(vals.join(','));
	});
});
</script>
	