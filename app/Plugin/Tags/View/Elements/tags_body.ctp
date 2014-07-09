<?php echo $this->PHTableGrid->render('Tag'); ?>
<script type="text/javascript">
$(document).ready(function(){
	var $grid = $('#grid_Tag');
	
	var vals = $('#TagTags').val().split(',');
	for(var i = 0; i < vals.length; i++) {
		$('.grid-chbx-row[value=' + vals[i] + ']', $grid).click();
	}
	$('.form-3actions button[type=submit]').click(function(){
		var vals = [];
		$('.grid-chbx-row:checked', $grid).each(function(){
			vals.push($(this).val());
		});
		$('#TagTags').val(vals.join(','));
	});
});
</script>
<?php echo $this->PHForm->hidden('Tag.tags', array('value' => $allProductTags)); ?>

