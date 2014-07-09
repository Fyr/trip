<div class="span8 offset2">
<?
    $id = $this->request->data('Tag.id');
    $title = $this->ObjectType->getTitle(($id) ? 'edit' : 'create', 'Tag');
    echo $this->element('admin_title', compact('title'));
    echo $this->PHForm->create('Tag');
    echo $this->element('admin_content');
    echo $this->PHForm->input('title');
    echo $this->element('admin_content_end');
    $backURL = $this->Html->url(array('action' => 'index', 'Tag'));
    echo $this->element('Form.form_actions', array('backURL' => $backURL));
    echo $this->PHForm->end();
?>
</div>