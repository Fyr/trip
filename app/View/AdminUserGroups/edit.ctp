<div class="span8 offset2">
<?
    $id = $this->request->data($objectType.'.id');
    $title = $this->ObjectType->getTitle(($id) ? 'edit' : 'create', $objectType);
    echo $this->element('admin_title', compact('title'));
    echo $this->PHForm->create($objectType);
    echo $this->element('admin_content');
    echo $this->PHForm->input('UserGroup.title', array('label' => array('text' => __('Group name'), 'class' => 'control-label')));
    echo $this->element('admin_content_end');
    /*
	$aTabs = array(
		'General' => $this->element('/AdminUsers/admin_edit_User'),
		// 'Rights' => $this->element('/AdminUsers/admin_edit_UserRights'),
	);
	echo $this->element('admin_tabs', compact('aTabs'));
	*/
	echo $this->element('Form.form_actions', array('backURL' => $this->Html->url(array('action' => 'index'))));
    echo $this->PHForm->end();
?>
</div>
