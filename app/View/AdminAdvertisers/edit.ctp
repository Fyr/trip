<div class="span8 offset2">
<?
    $id = $this->request->data('Advertiser.id');
    $title = $this->ObjectType->getTitle(($id) ? 'edit' : 'create', $objectType);
    echo $this->element('admin_title', compact('title'));
    if ($id) {
		echo $this->Html->link(
			'<i class="icon-search"></i> '.__('Preview'), 
			array('controller' => 'SiteAdvertisers', 'action' => 'view', $this->request->data('Advertiser.slug')), 
			array('escape' => false, 'class' => 'pull-right btn btn-mini', 'target' => '_blank')
		);
	}
    echo $this->PHForm->create('Advertiser');
    // echo $this->element('admin_content');
	$aTabs = array(
		'General' => $this->element('/AdminAdvertisers/admin_edit'),
		'Description' => $this->PHForm->editor('descr', array('fullwidth' => true)),
		'Contacts' => $this->PHForm->editor('contacts', array('fullwidth' => true)),
		'Booking' => $this->PHForm->editor('booking', array('fullwidth' => true)),
	);
	if ($id) {
        $aTabs['Logo'] = $this->element('Media.edit', array('object_type' => $objectType, 'object_id' => $id));
    }
	echo $this->element('admin_tabs', compact('aTabs'));
    // echo $this->element('admin_content_end');
	echo $this->element('Form.form_actions', array('backURL' => $this->Html->url(array('action' => 'index'))));
    echo $this->PHForm->end();
?>
</div>
