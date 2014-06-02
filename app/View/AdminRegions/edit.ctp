<div class="span8 offset2">
<?
    $id = $this->request->data($objectType.'.id');
    // $objectType = $this->request->data('Article.object_type');
    // $objectID = $this->request->data('Article.object_id');
    
    $title = $this->ObjectType->getTitle(($id) ? 'edit' : 'create', $objectType);
    if ($objectType == 'City' && $objectID) {
		$title = $country['Country']['title'].': '.$title;
	}
	
	echo $this->element('admin_title', compact('title'));
	echo $this->PHForm->create($objectType);
	echo $this->element('admin_content');
    echo $this->PHForm->input('title');
	if ($objectType == 'City' && $objectID) {
		echo $this->PHForm->hidden('country_id', array('value' => $objectID));
	}
    
    echo $this->element('admin_content_end');
    $backURL = $this->Html->url(array('action' => 'index', $objectType));
    echo $this->element('Form.form_actions', array('backURL' => $backURL));
    echo $this->PHForm->end();
?>
</div>
