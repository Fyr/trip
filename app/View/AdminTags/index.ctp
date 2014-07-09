<?
    $title = $this->ObjectType->getTitle('index', 'Tag');
    $createTag = $this->Html->url(array('action' => 'edit', 0));
    $actions = $this->PHTableGrid->getDefaultActions('Tag');
    $backURL = $this->Html->url(array('action' => 'index'));
    $deleteURL = $this->Html->url(array('action' => 'delete')).'/{$id}?model=Tags.Tag&backURL='.urlencode($backURL);
    $actions['row']['delete'] = $this->Html->link('', $deleteURL, array('class' => 'icon-color icon-delete', 'title' => __('Delete record')), __('Are you sure to delete this record?'))
?>
<?=$this->element('admin_title', compact('title'))?>
<div class="text-center">
    <a class="btn btn-primary" href="<?=$createTag?>">
        <i class="icon-white icon-plus"></i> <?= __('Create new tag') ?>
    </a>
</div>
<br/>
<?
    echo $this->PHTableGrid->render('Tag', array(
        'actions' => $actions
    ));
?>