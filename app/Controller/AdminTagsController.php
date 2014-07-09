<?php
App::uses('AdminController', 'Controller');
class AdminTagsController extends AdminController {
    public $name = 'AdminTags';
    public $components = array('Table.PCtableGrid', 'Article.PCArticle');
    public $uses = array('Tags.Tag');
    
    public function index() {
	$data = $this->PCTableGrid->paginate('Tag');
    }
    
    public function edit($id = 0) {
	if ($this->request->is(array('put', 'post'))) {
	    if ($id) {
		$this->request->data('Tag.id', $id);
	    }

	    $this->Tag->save($this->request->data);
	    $id = $this->Tag->id;
	    $baseRoute = array('action' => 'index');
	    return $this->redirect(($this->request->data('apply')) ? $baseRoute : array($id));
	}  elseif ($id) {
	    $this->request->data = $this->Tag->findById($id);
	}
    }
}