<?
	echo $this->PHTableGrid->render('Category');
	echo $this->PHForm->hidden('User.category_rights', array('value' => $this->request->data('User.category_rights')));
?>
<script type="text/javascript">
$(document).ready(function(){
	var $grid = $('#grid_Category');
	
	var vals = $('#UserCategoryRights').val().split(',');
	for(var i = 0; i < vals.length; i++) {
		$('.grid-chbx-row[value=' + vals[i] + ']', $grid).click();
	}
	$('.form-3actions button[type=submit]').click(function(){
		var vals = [];
		$('.grid-chbx-row:checked', $grid).each(function(){
			vals.push($(this).val());
		});
		$('#UserCategoryRights').val(vals.join(','));
	});
});
</script>
