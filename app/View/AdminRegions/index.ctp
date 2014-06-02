<?
	$title = $this->ObjectType->getTitle('index', $objectType);
	if ($objectType == 'City' && $objectID) {
		$title = $country['Country']['title'].': '.$title;
	}
    $createURL = $this->Html->url(array('action' => 'edit', 0, $objectType, $objectID));
    $createTitle = $this->ObjectType->getTitle('create', $objectType);
    $actions = $this->PHTableGrid->getDefaultActions($objectType);
    $actions['table']['add']['href'] = $createURL;
    $actions['table']['add']['label'] = $createTitle;

    if ($objectType == 'Country') {
    	$actions['row']['edit']['href'] = $this->Html->url(array('action' => 'edit')).'/{$id}/Country';
    	$actions['row'][] = array(
    		'label' => $this->ObjectType->getTitle('index', 'City'), 
    		'class' => 'icon-color icon-open-folder', 
    		'href' => $this->Html->url(array('action' => 'index', 'City')).'/{$id}'
    	);
    } elseif ($objectType == 'City') {
    	$actions['row']['edit']['href'] = $this->Html->url(array('action' => 'edit')).'/{$id}/City';
    } 
?>
<?=$this->element('admin_title', compact('title'))?>
<div class="text-center">
    <a class="btn btn-primary" href="<?=$createURL?>">
        <i class="icon-white icon-plus"></i> <?=$createTitle?>
    </a>
</div>
<br/>
<?
    echo $this->PHTableGrid->render($objectType, array(
        'baseURL' => $this->ObjectType->getBaseURL($objectType, $objectID),
        'actions' => $actions
    ));
?>